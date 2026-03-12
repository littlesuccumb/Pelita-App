<?php

namespace App\Imports;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Facades\Log;

class BarangImport implements 
    ToModel, 
    WithHeadingRow, 
    WithValidation, 
    SkipsOnError,
    SkipsOnFailure,
    WithBatchInserts,
    WithChunkReading
{
    use SkipsErrors;

    protected $errors = [];
    protected $successCount = 0;
    protected $skippedCount = 0;

    /**
     * Process each row from Excel
     */
    public function model(array $row)
    {
        // Cari kategori berdasarkan nama
        $kategori = KategoriBarang::where('nama_kategori', $row['kategori'])->first();
        
        if (!$kategori) {
            $this->errors[] = [
                'row' => 'N/A',
                'error' => "Kategori '{$row['kategori']}' tidak ditemukan",
                'data' => $row['nama_barang'] ?? 'Unknown'
            ];
            $this->skippedCount++;
            return null;
        }

        // Cek duplikat (optional - sesuaikan kebutuhan)
        $exists = Barang::where('nama_barang', $row['nama_barang'])
            ->where('kategori_id', $kategori->id)
            ->where('merk', $row['merk'] ?? null)
            ->exists();
        
        if ($exists) {
            $this->errors[] = [
                'row' => 'N/A',
                'error' => "Barang '{$row['nama_barang']}' sudah ada di database",
                'data' => $row['nama_barang']
            ];
            $this->skippedCount++;
            return null;
        }

        // Parse dapat_dipinjam
        $dapatDipinjam = $this->parseDapatDipinjam($row['dapat_dipinjam'] ?? 'Ya');

        try {
            $barang = new Barang([
                'kategori_id' => $kategori->id,
                'nama_barang' => $row['nama_barang'],
                'merk' => $row['merk'] ?? null,
                'type' => $row['type'] ?? null,
                'seri' => $row['seri'] ?? null,
                'tahun_produksi' => $row['tahun_produksi'] ?? null,
                'spesifikasi' => $row['spesifikasi'] ?? null,
                'warna' => $row['warna'] ?? null,
                'berat' => $row['berat_kg'] ?? null,
                'dimensi' => $row['dimensi'] ?? null,
                'garansi' => $row['garansi'] ?? null,
                'tanggal_pembelian' => $this->parseDate($row['tanggal_pembelian'] ?? null),
                'harga_beli' => $this->parseRupiah($row['harga_beli'] ?? 0),
                'kondisi' => $this->parseKondisi($row['kondisi'] ?? 'baik'),
                'lokasi' => $row['lokasi'] ?? null,
                'harga_sewa' => $this->parseRupiah($row['harga_sewa'] ?? 0),
                'deskripsi' => $row['deskripsi'] ?? null,
                'jumlah_total' => $row['jumlah_total'] ?? 1,
                'jumlah_tersedia' => $row['jumlah_tersedia'] ?? ($row['jumlah_total'] ?? 1),
                'status' => Barang::STATUS_TERSEDIA,
                'dapat_dipinjam' => $dapatDipinjam,
                'kode_barang' => $this->generateKodeBarang($kategori->id),
            ]);

            $this->successCount++;
            return $barang;

        } catch (\Exception $e) {
            $this->errors[] = [
                'row' => 'N/A',
                'error' => 'Error saat membuat barang: ' . $e->getMessage(),
                'data' => $row['nama_barang'] ?? 'Unknown'
            ];
            $this->skippedCount++;
            Log::error('Import error: ' . $e->getMessage(), ['row' => $row]);
            return null;
        }
    }

    /**
     * Track validation failures dengan nomor baris
     */
    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $failure) {
            $this->errors[] = [
                'row' => $failure->row(), // Nomor baris di Excel
                'error' => implode(', ', $failure->errors()),
                'data' => $failure->values()['nama_barang'] ?? 'Unknown',
                'column' => $failure->attribute(),
            ];
            $this->skippedCount++;
        }
    }

    /**
     * Validation rules untuk import
     */
    public function rules(): array
    {
        return [
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|exists:kategori_barang,nama_kategori',
            'jumlah_total' => 'nullable|integer|min:1',
            'jumlah_tersedia' => 'nullable|integer|min:0',
            'harga_sewa' => 'nullable|numeric|min:0',
            'harga_beli' => 'nullable|numeric|min:0',
            'kondisi' => 'nullable|in:baik,Baik,BAIK,rusak ringan,Rusak Ringan,RUSAK RINGAN,rusak berat,Rusak Berat,RUSAK BERAT',
            'dapat_dipinjam' => 'nullable|in:Ya,ya,YA,Tidak,tidak,TIDAK,1,0,true,false,TRUE,FALSE',
        ];
    }

    /**
     * Custom validation messages
     */
    public function customValidationMessages()
    {
        return [
            'nama_barang.required' => 'Nama barang wajib diisi',
            'kategori.required' => 'Kategori barang wajib diisi',
            'kategori.exists' => 'Kategori tidak ditemukan dalam database',
            'jumlah_total.min' => 'Jumlah total minimal 1',
            'jumlah_tersedia.min' => 'Jumlah tersedia minimal 0',
            'kondisi.in' => 'Kondisi harus: baik, rusak ringan, atau rusak berat',
            'dapat_dipinjam.in' => 'Dapat dipinjam harus: Ya atau Tidak',
        ];
    }

    /**
     * Get import statistics
     */
    public function getStats()
    {
        return [
            'success' => $this->successCount,
            'skipped' => $this->skippedCount,
            'errors' => $this->errors,
            'total' => $this->successCount + $this->skippedCount,
        ];
    }

    /**
     * Batch insert untuk performa (100 rows at once)
     */
    public function batchSize(): int
    {
        return 100;
    }

    /**
     * Chunk reading untuk memory efficiency
     */
    public function chunkSize(): int
    {
        return 100;
    }

    /**
     * Parse nilai dapat_dipinjam dari berbagai format
     */
    private function parseDapatDipinjam($value)
    {
        if (is_bool($value)) {
            return $value;
        }

        $value = strtolower(trim($value));
        
        // Nilai yang dianggap TRUE (dapat dipinjam)
        $trueValues = ['ya', 'yes', 'y', '1', 'true', 'dapat', 'boleh', 'iya'];
        
        // Nilai yang dianggap FALSE (tidak dapat dipinjam)
        $falseValues = ['tidak', 'no', 'n', '0', 'false', 'tidak dapat', 'tidak boleh'];
        
        if (in_array($value, $trueValues)) {
            return true;
        }
        
        if (in_array($value, $falseValues)) {
            return false;
        }
        
        // Default: dapat dipinjam
        return true;
    }

    /**
     * Parse kondisi barang
     */
    private function parseKondisi($value)
    {
        $value = strtolower(trim($value));
        
        $kondisiMap = [
            'baik' => Barang::KONDISI_BAIK,
            'rusak ringan' => Barang::KONDISI_RUSAK_RINGAN,
            'rusak berat' => Barang::KONDISI_RUSAK_BERAT,
        ];
        
        return $kondisiMap[$value] ?? Barang::KONDISI_BAIK;
    }

    /**
     * Parse format Rupiah (hapus Rp, titik, koma)
     */
    private function parseRupiah($value)
    {
        if (empty($value) || $value === '-') {
            return 0;
        }

        // Hapus "Rp", spasi, titik (thousand separator)
        $value = str_replace(['Rp', 'rp', '.', ' '], '', $value);
        
        // Ganti koma dengan titik untuk decimal
        $value = str_replace(',', '.', $value);
        
        return floatval($value);
    }

    /**
     * Parse tanggal dari berbagai format
     */
    private function parseDate($value)
    {
        if (empty($value) || $value === '-') {
            return null;
        }

        try {
            // Coba parse dengan Carbon
            return \Carbon\Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Generate kode barang otomatis
     */
    private function generateKodeBarang($kategoriId)
    {
        $kategori = KategoriBarang::find($kategoriId);
        
        if (!$kategori) {
            return 'CTP-UNK-00001-' . date('Y');
        }
        
        // Generate kode kategori (3 huruf pertama, uppercase)
        $kodeKategori = strtoupper(substr($kategori->nama_kategori, 0, 3));
        
        // Cari nomor terakhir
        $lastBarang = Barang::where('kategori_id', $kategoriId)
            ->where('kode_barang', 'like', "CTP-{$kodeKategori}-%")
            ->orderBy('id', 'desc')
            ->first();
        
        $nextNumber = 1;
        if ($lastBarang) {
            // Extract number from last kode
            preg_match('/CTP-[A-Z]+-(\d+)-\d{4}/', $lastBarang->kode_barang, $matches);
            if (isset($matches[1])) {
                $nextNumber = intval($matches[1]) + 1;
            }
        }
        
        $kode = sprintf("CTP-%s-%05d-%d", $kodeKategori, $nextNumber, date('Y'));
        
        // Pastikan kode unik
        $counter = 1;
        $originalKode = $kode;
        while (Barang::where('kode_barang', $kode)->exists()) {
            $kode = $originalKode . '-' . $counter;
            $counter++;
        }
        
        return $kode;
    }
}