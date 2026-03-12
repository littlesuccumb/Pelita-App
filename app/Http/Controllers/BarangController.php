<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\LogAktivitas;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BarangExport;
use App\Imports\BarangImport;
use App\Exports\BarangTemplateExport;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Barang::with(['kategori','fotos']);
        
        // Filter berdasarkan kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }
        
        // ✅ FILTER STATUS (SIMPLE - Tanpa eager load peminjaman)
        if ($request->filled('status')) {
            $status = $request->status;
            
            if ($status == 'dipinjam') {
                // Cari barang yang sedang dipinjam
                $barangDipinjamIds = Peminjaman::whereIn('status', ['disetujui', 'dipinjam'])
                    ->where('jenis_aset', 'barang')
                    ->pluck('aset_id')
                    ->unique()
                    ->toArray();
                
                if (!empty($barangDipinjamIds)) {
                    $query->whereIn('id', $barangDipinjamIds);
                } else {
                    $query->whereRaw('1 = 0'); // Tidak ada barang dipinjam
                }
                
            } elseif ($status == 'maintenance') {
                // Cari barang yang sedang maintenance
                $barangMaintenanceIds = Maintenance::whereIn('status', ['dijadwalkan', 'dalam_proses'])
                    ->where('jenis_aset', 'barang')
                    ->pluck('aset_id')
                    ->unique()
                    ->toArray();
                
                if (!empty($barangMaintenanceIds)) {
                    $query->whereIn('id', $barangMaintenanceIds);
                } else {
                    $query->whereRaw('1 = 0'); // Tidak ada barang maintenance
                }
                
            } else {
                // Filter status biasa (tersedia)
                $query->where('status', $status);
            }
        }
        
        // Filter berdasarkan kondisi
        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }
        
        // Filter berdasarkan dapat_dipinjam
        if ($request->filled('dapat_dipinjam')) {
            $query->where('dapat_dipinjam', $request->dapat_dipinjam);
        }
        
        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }
        
        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        if (in_array($sortBy, ['nama_barang', 'kode_barang', 'status', 'kondisi', 'created_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        }
        
        $barangs = $query->paginate(10)->withQueryString();
        $kategoris = KategoriBarang::all();
        
        // ✅ Hitung stats dengan akurat
        $barangDipinjamIds = Peminjaman::whereIn('status', ['disetujui', 'dipinjam'])
            ->where('jenis_aset', 'barang')
            ->pluck('aset_id')
            ->unique();
        
        $stats = [
            'total_barang' => Barang::count(),
            'stok_tersedia' => Barang::where('status', 'tersedia')
                                    ->where('jumlah_tersedia', '>', 0)
                                    ->sum('jumlah_tersedia'),
            'barang_dipinjam' => $barangDipinjamIds->count(),
            'barang_maintenance' => Maintenance::whereIn('status', ['dijadwalkan', 'dalam_proses'])
                ->where('jenis_aset', 'barang')
                ->sum('jumlah'),
        ];
        
        return view('admin.barang.index', compact('barangs', 'kategoris', 'stats'));
    }
    
    public function create()
    {
        $kategoris = KategoriBarang::all();
        return view('admin.barang.create', compact('kategoris'));
    }

    public function store(Request $request)
{
    // ✅ DEBUG LOG - Cek file yang masuk
    \Log::info('=== STORE BARANG REQUEST ===', [
        'has_foto' => $request->hasFile('foto'),
        'has_foto_detail' => $request->hasFile('foto_detail'),
        'foto_detail_count' => $request->hasFile('foto_detail') ? count($request->file('foto_detail')) : 0,
        'foto_detail_files' => $request->hasFile('foto_detail') 
            ? array_map(fn($f) => $f->getClientOriginalName(), $request->file('foto_detail'))
            : [],
        'all_files' => array_keys($request->allFiles())
    ]);

    $validator = Validator::make($request->all(), [
        'kategori_id' => 'required|exists:kategori_barang,id',
        'nama_barang' => 'required|string|max:255',
        'merk' => 'nullable|string|max:255',
        'type' => 'nullable|string|max:255',
        'seri' => 'nullable|string|max:255',
        'tahun_produksi' => 'nullable|integer|min:1900|max:' . date('Y'),
        'spesifikasi' => 'nullable|string',
        'warna' => 'nullable|string|max:255',
        'berat' => 'nullable|numeric|min:0',
        'dimensi' => 'nullable|string|max:255',
        'garansi' => 'nullable|string|max:255',
        'tanggal_pembelian' => 'nullable|date|before_or_equal:today',
        'harga_beli' => 'nullable|numeric|min:0',
        'deskripsi' => 'nullable|string',
        'jumlah_total' => 'required|integer|min:1',
        'kondisi' => 'required|in:' . implode(',', [Barang::KONDISI_BAIK, Barang::KONDISI_RUSAK_RINGAN, Barang::KONDISI_RUSAK_BERAT]),
        'lokasi' => 'nullable|string|max:255',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'foto_detail' => 'nullable|array|max:4',
        'foto_detail.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'harga_sewa' => 'required|numeric|min:0',
        'lainnya' => 'nullable|string',
        'kode_manual' => 'nullable|string|max:10',
        'dapat_dipinjam' => 'nullable|boolean',
    ]);

    if ($validator->fails()) {
        \Log::warning('Validation failed:', $validator->errors()->toArray());
        return back()
            ->withErrors($validator)
            ->withInput();
    }

    try {
        $data = $validator->validated();

        // Handle checkbox dapat_dipinjam
        $data['dapat_dipinjam'] = $request->has('dapat_dipinjam') ? true : false;
        
        // Generate kode barang otomatis
        $data['kode_barang'] = $this->generateKodeBarang($data['kategori_id'], $request->kode_manual);
        
        // Set jumlah tersedia sama dengan total saat pertama dibuat
        $data['jumlah_tersedia'] = $data['jumlah_total'];
        
        // Set status default
        $data['status'] = Barang::STATUS_TERSEDIA;
        
        // ✅ HANDLE FOTO UTAMA (Backward Compatibility)
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = 'barang_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('barang', $filename, 'public');
            $data['foto'] = 'barang/' . $filename;
            
            \Log::info('Foto utama uploaded', ['filename' => $filename]);
        }

        // Create barang
        $barang = Barang::create($data);
        
        \Log::info('Barang created successfully', [
            'id' => $barang->id,
            'kode' => $barang->kode_barang
        ]);

        // ✅ HANDLE MULTIPLE FOTO
        $uploadedPhotos = 0;
        $photoErrors = [];
        
        // 1️⃣ Upload foto utama ke tabel barang_foto sebagai PRIMARY
        if ($request->hasFile('foto')) {
            try {
                $file = $request->file('foto');
                $filename = 'barang_' . $barang->id . '_primary_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('barang', $filename, 'public');
                
                $fotoRecord = $barang->fotos()->create([
                    'foto' => 'barang/' . $filename,
                    'is_primary' => true,
                    'urutan' => 0,
                    'keterangan' => 'Foto Utama',
                ]);
                
                $uploadedPhotos++;
                
                \Log::info('Primary foto saved to barang_foto', [
                    'foto_id' => $fotoRecord->id,
                    'filename' => $filename
                ]);
                
            } catch (\Exception $e) {
                \Log::error('Error uploading primary photo: ' . $e->getMessage(), [
                    'barang_id' => $barang->id,
                    'trace' => $e->getTraceAsString()
                ]);
                $photoErrors[] = 'Foto utama gagal diupload ke tabel barang_foto';
            }
        }
        
        // 2️⃣ Upload foto detail ke tabel barang_foto (maksimal 4)
        if ($request->hasFile('foto_detail')) {
            \Log::info('Processing foto detail', [
                'count' => count($request->file('foto_detail'))
            ]);
            
            $detailFiles = $request->file('foto_detail');
            $maxDetailPhotos = 4;
            $detailFilesToProcess = array_slice($detailFiles, 0, $maxDetailPhotos);
            
            foreach ($detailFilesToProcess as $index => $file) {
                try {
                    // Validasi ukuran file
                    if ($file->getSize() > 2048 * 1024) {
                        $photoErrors[] = "Foto detail " . ($index + 1) . " melebihi ukuran maksimal (2MB)";
                        \Log::warning('File too large', [
                            'index' => $index + 1,
                            'size' => $file->getSize()
                        ]);
                        continue;
                    }
                    
                    // Validasi tipe file
                    $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                    if (!in_array($file->getMimeType(), $allowedMimes)) {
                        $photoErrors[] = "Foto detail " . ($index + 1) . " format tidak didukung";
                        \Log::warning('Invalid mime type', [
                            'index' => $index + 1,
                            'mime' => $file->getMimeType()
                        ]);
                        continue;
                    }
                    
                    $filename = 'barang_' . $barang->id . '_detail_' . ($index + 1) . '_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('barang', $filename, 'public');
                    
                    $fotoRecord = $barang->fotos()->create([
                        'foto' => 'barang/' . $filename,
                        'is_primary' => false,
                        'urutan' => $index + 1,
                        'keterangan' => 'Foto Detail ' . ($index + 1),
                    ]);
                    
                    $uploadedPhotos++;
                    
                    \Log::info('Detail foto saved', [
                        'foto_id' => $fotoRecord->id,
                        'index' => $index + 1,
                        'filename' => $filename
                    ]);
                    
                } catch (\Exception $e) {
                    \Log::error('Error uploading detail photo ' . ($index + 1), [
                        'barang_id' => $barang->id,
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    $photoErrors[] = 'Foto detail ' . ($index + 1) . ' gagal diupload';
                }
            }
            
            // Log jika ada foto yang melebihi batas
            if (count($detailFiles) > $maxDetailPhotos) {
                $exceeded = count($detailFiles) - $maxDetailPhotos;
                $photoErrors[] = "{$exceeded} foto detail melebihi batas maksimal (4 foto) dan tidak diupload";
                \Log::warning('Exceeded max photos', [
                    'total' => count($detailFiles),
                    'max' => $maxDetailPhotos,
                    'exceeded' => $exceeded
                ]);
            }
        } else {
            \Log::info('No foto_detail files in request');
        }
        
        // Prepare log message
        $fotoLog = $uploadedPhotos > 0 ? " dengan {$uploadedPhotos} foto" : "";
        $errorLog = !empty($photoErrors) ? " (Warning: " . implode(', ', $photoErrors) . ")" : "";
        
        \Log::info('Barang store completed', [
            'barang_id' => $barang->id,
            'uploaded_photos' => $uploadedPhotos,
            'errors' => $photoErrors
        ]);
        
        // Catat log aktivitas
        LogAktivitas::catat(
            'Menambahkan Barang Baru',
            'Menambahkan barang: ' . $barang->nama_barang . ' dengan kode: ' . $barang->kode_barang . 
            ' (Kategori: ' . $barang->kategori->nama_kategori . ', Jumlah: ' . $barang->jumlah_total . ' unit)' . 
            $fotoLog . $errorLog
        );

        // ✅ ENHANCED: Prepare success message dengan detail
        $successMessage = 'Barang berhasil ditambahkan!';
        
        if ($uploadedPhotos > 0) {
            $successMessage .= " {$uploadedPhotos} foto berhasil diupload.";
        }

        // ✅ Prepare data untuk notifikasi
        $barangData = [
            'id' => $barang->id,
            'nama' => $barang->nama_barang,
            'kode' => $barang->kode_barang,
            'jumlah' => $barang->jumlah_total,
            'kategori' => $barang->kategori->nama_kategori ?? 'N/A',
            'foto_count' => $uploadedPhotos,
            'harga_sewa' => 'Rp ' . number_format($barang->harga_sewa, 0, ',', '.'),
            'kondisi' => ucfirst($barang->kondisi),
            'dapat_dipinjam' => $barang->dapat_dipinjam,
        ];

        // ✅ Return dengan notifikasi
        $redirect = redirect()->route('admin.barang.index')
            ->with('success', $successMessage)
            ->with('barang_data', $barangData); // Untuk notifikasi enhanced

        // ✅ Tambahkan warning jika ada foto yang gagal
        if (!empty($photoErrors)) {
            $redirect->with('warning', 'Beberapa foto gagal diupload: ' . implode(', ', $photoErrors));
        }

        return $redirect;
                
    } catch (\Exception $e) {
        \Log::error('Critical error in barang store', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'request' => $request->except(['foto', 'foto_detail', '_token'])
        ]);
        
        // Rollback: Hapus barang dan foto jika sudah terbuat
        if (isset($barang) && $barang->exists) {
            try {
                // Hapus foto utama di kolom 'foto'
                if ($barang->foto && Storage::disk('public')->exists($barang->foto)) {
                    Storage::disk('public')->delete($barang->foto);
                }
                
                // Hapus semua foto di tabel barang_foto
                foreach ($barang->fotos as $foto) {
                    if ($foto->foto && Storage::disk('public')->exists($foto->foto)) {
                        Storage::disk('public')->delete($foto->foto);
                    }
                    $foto->delete();
                }
                
                // Hapus barang
                $barang->delete();
                
                \Log::info('Rollback completed successfully');
                
            } catch (\Exception $cleanupError) {
                \Log::error('Error during cleanup/rollback', [
                    'error' => $cleanupError->getMessage()
                ]);
            }
        }
        
        // ✅ ENHANCED: Error message dengan detail
        $errorMessage = '❌ Terjadi kesalahan saat menyimpan data barang';
        $errorDetails = [];
        
        // Parse error untuk info yang lebih jelas
        if (str_contains($e->getMessage(), 'Duplicate entry')) {
            $errorDetails[] = 'Kode barang sudah ada dalam sistem';
        } elseif (str_contains($e->getMessage(), 'foreign key')) {
            $errorDetails[] = 'Kategori barang tidak valid';
        } else {
            $errorDetails[] = $e->getMessage();
        }
        
        return back()
            ->withInput()
            ->with('error', $errorMessage)
            ->with('error_details', $errorDetails);
    }
}

    public function show(Barang $barang)
    {
        $barang->load('kategori', 'maintenances', 'peminjamanDetails.peminjaman.user', 'fotos'); // ← tambah 'fotos'
        
        return view('admin.barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        $kategoris = KategoriBarang::all();
        return view('admin.barang.edit', compact('barang', 'kategoris'));
    }

public function update(Request $request, Barang $barang)
{
    // ✅ DEBUG LOG - Cek file yang masuk
    \Log::info('=== UPDATE BARANG REQUEST ===', [
        'has_foto' => $request->hasFile('foto'),
        'has_foto_detail' => $request->hasFile('foto_detail'),
        'foto_detail_count' => $request->hasFile('foto_detail') ? count($request->file('foto_detail')) : 0,
        'foto_detail_files' => $request->hasFile('foto_detail') 
            ? array_map(fn($f) => $f->getClientOriginalName(), $request->file('foto_detail'))
            : [],
        'all_files' => array_keys($request->allFiles())
    ]);

    $validator = Validator::make($request->all(), [
        'kategori_id' => 'required|exists:kategori_barang,id',
        'nama_barang' => 'required|string|max:255',
        'merk' => 'nullable|string|max:255',
        'type' => 'nullable|string|max:255',
        'seri' => 'nullable|string|max:255',
        'tahun_produksi' => 'nullable|integer|min:1900|max:' . date('Y'),
        'spesifikasi' => 'nullable|string',
        'warna' => 'nullable|string|max:255',
        'berat' => 'nullable|numeric|min:0',
        'dimensi' => 'nullable|string|max:255',
        'garansi' => 'nullable|string|max:255',
        'tanggal_pembelian' => 'nullable|date|before_or_equal:today',
        'harga_beli' => 'nullable|numeric|min:0',
        'deskripsi' => 'nullable|string',
        'jumlah_total' => 'required|integer|min:1',
        'kondisi' => 'required|in:' . implode(',', [Barang::KONDISI_BAIK, Barang::KONDISI_RUSAK_RINGAN, Barang::KONDISI_RUSAK_BERAT]),
        'lokasi' => 'nullable|string|max:255',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'foto_detail' => 'nullable|array|max:4', // ✅ TAMBAH VALIDASI FOTO DETAIL
        'foto_detail.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'lainnya' => 'nullable|string',
        'harga_sewa' => 'required|numeric|min:0',
        'dapat_dipinjam' => 'nullable|boolean',
    ]);

    if ($validator->fails()) {
        \Log::warning('Validation failed:', $validator->errors()->toArray());
        return back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Terdapat kesalahan pada form. Silakan periksa kembali.');
    }

    try {
        $data = $validator->validated();
        
        // Handle checkbox dapat_dipinjam
        $data['dapat_dipinjam'] = $request->has('dapat_dipinjam') ? true : false;

        // Validasi jumlah total
        $jumlahDipinjam = $barang->jumlah_total - $barang->jumlah_tersedia;
        if ($data['jumlah_total'] < $jumlahDipinjam) {
            return back()
                ->withErrors(['jumlah_total' => 'Jumlah total tidak boleh kurang dari yang sedang dipinjam (' . $jumlahDipinjam . ')'])
                ->withInput()
                ->with('error', 'Validasi gagal: Jumlah total tidak mencukupi.');
        }
        
        // Update jumlah tersedia
        $selisih = $data['jumlah_total'] - $barang->jumlah_total;
        $data['jumlah_tersedia'] = $barang->jumlah_tersedia + $selisih;
        
        // ✅ Track foto changes
        $fotoUpdated = false;
        $uploadedPhotos = 0;
        $photoErrors = [];
        
        // ==========================================
        // HANDLE FOTO UTAMA (Backward Compatibility)
        // ==========================================
        if ($request->hasFile('foto')) {
            // Delete old photo if exists (dari kolom 'foto')
            if ($barang->foto && Storage::disk('public')->exists($barang->foto)) {
                Storage::disk('public')->delete($barang->foto);
            }
            
            // Delete old primary foto dari barang_foto table
            $oldPrimaryFoto = $barang->fotos()->where('is_primary', true)->first();
            if ($oldPrimaryFoto) {
                $oldPrimaryFoto->deleteFoto();
            }
            
            $file = $request->file('foto');
            $filename = 'barang_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('barang', $filename, 'public');
            $data['foto'] = 'barang/' . $filename;
            $fotoUpdated = true;
            
            \Log::info('Foto utama updated', ['filename' => $filename]);
            
            // ✅ TAMBAH: Upload foto utama ke tabel barang_foto sebagai PRIMARY
            try {
                $fotoRecord = $barang->fotos()->create([
                    'foto' => 'barang/' . $filename,
                    'is_primary' => true,
                    'urutan' => 0,
                    'keterangan' => 'Foto Utama',
                ]);
                
                $uploadedPhotos++;
                
                \Log::info('Primary foto saved to barang_foto', [
                    'foto_id' => $fotoRecord->id,
                    'filename' => $filename
                ]);
                
            } catch (\Exception $e) {
                \Log::error('Error saving primary photo to barang_foto: ' . $e->getMessage());
                $photoErrors[] = 'Foto utama gagal disimpan ke tabel barang_foto';
            }
        }

        // ==========================================
        // HANDLE FOTO DETAIL (NEW!)
        // ==========================================
        if ($request->hasFile('foto_detail')) {
            \Log::info('Processing foto detail for update', [
                'count' => count($request->file('foto_detail'))
            ]);
            
            $detailFiles = $request->file('foto_detail');
            $maxDetailPhotos = 4;
            $detailFilesToProcess = array_slice($detailFiles, 0, $maxDetailPhotos);
            
            // ✅ Get current max urutan untuk foto detail (non-primary)
            $currentMaxUrutan = $barang->fotos()
                ->where('is_primary', false)
                ->max('urutan') ?? 0;
            
            foreach ($detailFilesToProcess as $index => $file) {
                try {
                    // Validasi ukuran file
                    if ($file->getSize() > 2048 * 1024) {
                        $photoErrors[] = "Foto detail " . ($index + 1) . " melebihi ukuran maksimal (2MB)";
                        \Log::warning('File too large', [
                            'index' => $index + 1,
                            'size' => $file->getSize()
                        ]);
                        continue;
                    }
                    
                    // Validasi tipe file
                    $allowedMimes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                    if (!in_array($file->getMimeType(), $allowedMimes)) {
                        $photoErrors[] = "Foto detail " . ($index + 1) . " format tidak didukung";
                        \Log::warning('Invalid mime type', [
                            'index' => $index + 1,
                            'mime' => $file->getMimeType()
                        ]);
                        continue;
                    }
                    
                    $filename = 'barang_' . $barang->id . '_detail_' . ($currentMaxUrutan + $index + 1) . '_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('barang', $filename, 'public');
                    
                    $fotoRecord = $barang->fotos()->create([
                        'foto' => 'barang/' . $filename,
                        'is_primary' => false,
                        'urutan' => $currentMaxUrutan + $index + 1,
                        'keterangan' => 'Foto Detail ' . ($currentMaxUrutan + $index + 1),
                    ]);
                    
                    $uploadedPhotos++;
                    
                    \Log::info('Detail foto saved', [
                        'foto_id' => $fotoRecord->id,
                        'index' => $index + 1,
                        'filename' => $filename
                    ]);
                    
                } catch (\Exception $e) {
                    \Log::error('Error uploading detail photo ' . ($index + 1), [
                        'barang_id' => $barang->id,
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    $photoErrors[] = 'Foto detail ' . ($index + 1) . ' gagal diupload';
                }
            }
            
            // Log jika ada foto yang melebihi batas
            if (count($detailFiles) > $maxDetailPhotos) {
                $exceeded = count($detailFiles) - $maxDetailPhotos;
                $photoErrors[] = "{$exceeded} foto detail melebihi batas maksimal (4 foto) dan tidak diupload";
                \Log::warning('Exceeded max photos', [
                    'total' => count($detailFiles),
                    'max' => $maxDetailPhotos,
                    'exceeded' => $exceeded
                ]);
            }
        } else {
            \Log::info('No foto_detail files in update request');
        }

        // ==========================================
        // UPDATE BARANG DATA
        // ==========================================
        $barang->update($data);

        // ==========================================
        // LOG AKTIVITAS
        // ==========================================
        $fotoLog = '';
        if ($fotoUpdated) {
            $fotoLog = ' Foto utama diperbarui.';
        }
        if ($uploadedPhotos > 0) {
            $fotoLog .= " {$uploadedPhotos} foto berhasil diupload.";
        }
        
        $errorLog = !empty($photoErrors) ? " (Warning: " . implode(', ', $photoErrors) . ")" : "";
        
        LogAktivitas::catat(
            'Mengubah Data Barang',
            'Mengubah data barang: ' . $barang->nama_barang . ' (Kode: ' . $barang->kode_barang . ') - ' .
            'Kategori: ' . $barang->kategori->nama_kategori . $fotoLog . $errorLog
        );

        // ==========================================
        // PREPARE SUCCESS MESSAGE
        // ==========================================
        $successMessage = 'Data barang berhasil diperbarui!';
        
        if ($fotoUpdated) {
            $successMessage .= ' Foto utama telah diperbarui.';
        }
        
        if ($uploadedPhotos > 0) {
            $successMessage .= " {$uploadedPhotos} foto berhasil diupload.";
        }

        \Log::info('Barang update completed', [
            'barang_id' => $barang->id,
            'foto_updated' => $fotoUpdated,
            'uploaded_photos' => $uploadedPhotos,
            'errors' => $photoErrors
        ]);

        // ✅ Return dengan notifikasi
        $redirect = redirect()->route('admin.barang.index')
            ->with('success', $successMessage)
            ->with('info', 'Perubahan telah disimpan untuk: ' . $barang->nama_barang);

        // ✅ Tambahkan warning jika ada foto yang gagal
        if (!empty($photoErrors)) {
            $redirect->with('warning', 'Beberapa foto gagal diupload: ' . implode(', ', $photoErrors));
        }

        return $redirect;
            
    } catch (\Exception $e) {
        \Log::error('Critical error in barang update', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'request' => $request->except(['foto', 'foto_detail', '_token'])
        ]);
        
        return back()
            ->withInput()
            ->with('error', 'Gagal memperbarui data barang.')
            ->with('error_details', $e->getMessage());
    }
}
    public function destroy(Barang $barang)
{
    try {
        // Check if barang sedang dipinjam
        if ($barang->jumlah_tersedia < $barang->jumlah_total) {
            return back()->with('error', 'Barang sedang dipinjam dan tidak dapat dihapus.');
        }
        
        // Check if barang ada di permohonan yang masih aktif
        $activePermohonan = $barang->permohonanItems()
            ->whereHas('permohonan', function($q) {
                $q->whereIn('status', ['Dalam Proses', 'Disetujui']);
            })
            ->exists();
            
        if ($activePermohonan) {
            return back()->with('error', 'Barang masih ada dalam permohonan aktif dan tidak dapat dihapus.');
        }
        
        // Simpan info untuk notifikasi
        $namaBarang = $barang->nama_barang;
        $kodeBarang = $barang->kode_barang;
        $kategoriNama = $barang->kategori->nama_kategori;
        
        // Delete photo if exists
        if ($barang->foto && Storage::disk('public')->exists($barang->foto)) {
            Storage::disk('public')->delete($barang->foto);
        }
        
        // Delete all fotos in barang_foto table
        foreach ($barang->fotos as $foto) {
            $foto->deleteFoto(); // Menggunakan method dari model
        }
        
        $barang->delete();

        // Catat log aktivitas
        LogAktivitas::catat(
            'Menghapus Barang',
            'Menghapus barang: ' . $namaBarang . ' (Kode: ' . $kodeBarang . ') - Kategori: ' . $kategoriNama
        );

        return redirect()
            ->route('admin.barang.index')
            ->with('success', 'Barang berhasil dihapus!')
            ->with('info', 'Data: ' . $namaBarang . ' (' . $kodeBarang . ') telah dihapus dari sistem.');
            
    } catch (\Exception $e) {
        \Log::error('Delete Barang Error: ' . $e->getMessage());
        
        return back()->with('error', 'Gagal menghapus barang: ' . $e->getMessage());
    }
}

    public function updateStatus(Request $request, Barang $barang)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', [Barang::STATUS_TERSEDIA, Barang::STATUS_DIPINJAM, Barang::STATUS_MAINTENANCE])
        ]);
        
        $statusLama = $barang->status;
        $barang->update(['status' => $request->status]);
        
        // Catat log aktivitas
        LogAktivitas::catat(
            'Mengubah Status Barang',
            'Mengubah status barang: ' . $barang->nama_barang . ' (Kode: ' . $barang->kode_barang . ') dari "' . ucfirst($statusLama) . '" ke "' . ucfirst($request->status) . '"'
        );
        
        return response()->json([
            'success' => true,
            'message' => 'Status barang berhasil diperbarui',
            'new_status' => $barang->status_badge
        ]);
    }

    public function updateKondisi(Request $request, Barang $barang)
    {
        $request->validate([
            'kondisi' => 'required|in:' . implode(',', [Barang::KONDISI_BAIK, Barang::KONDISI_RUSAK_RINGAN, Barang::KONDISI_RUSAK_BERAT])
        ]);
        
        $kondisiLama = $barang->kondisi;
        $barang->update(['kondisi' => $request->kondisi]);
        
        // Catat log aktivitas
        LogAktivitas::catat(
            'Mengubah Kondisi Barang',
            'Mengubah kondisi barang: ' . $barang->nama_barang . ' (Kode: ' . $barang->kode_barang . ') dari "' . ucfirst($kondisiLama) . '" ke "' . ucfirst($request->kondisi) . '"'
        );
        
        return response()->json([
            'success' => true,
            'message' => 'Kondisi barang berhasil diperbarui',
            'new_kondisi' => $barang->kondisi_badge
        ]);
    }

    public function generateCode()
    {
        $kategoris = KategoriBarang::all();
        $preview_codes = [];
        
        foreach($kategoris as $kategori) {
            $preview_codes[$kategori->id] = $this->generateKodeBarang($kategori->id, '12345');
        }
        
        return response()->json([
            'preview_codes' => $preview_codes
        ]);
    }

    public function getAvailable(Request $request)
    {
        // Gunakan scope tersedia Dan Dapat Dipinjam yang sudah dibuat di Model
        $query = Barang::tersediaDanDapatDipinjam()->with('kategori');
        
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }
        
        $barangs = $query->get();
        
        return response()->json($barangs);
    }

/**
 * Toggle status dapat_dipinjam barang (untuk quick action)
 */
public function toggleDapatDipinjam(Request $request, $id)
{
    try {
        $barang = Barang::findOrFail($id);
        $newStatus = $request->input('dapat_dipinjam');
        
        // ✅ TAMBAHKAN VALIDASI INPUT
        if (!is_bool($newStatus) && !in_array($newStatus, [0, 1, '0', '1', true, false, 'true', 'false'])) {
            return response()->json([
                'success' => false,
                'message' => 'Nilai status tidak valid'
            ], 400);
        }
        
        // ✅ CONVERT TO BOOLEAN
        $newStatus = filter_var($newStatus, FILTER_VALIDATE_BOOLEAN);
        
        // Update status
        $barang->update(['dapat_dipinjam' => $newStatus]);
        
        // Log aktivitas
        LogAktivitas::catat(
            'Toggle Status Dapat Dipinjam',
            'Mengubah status dapat dipinjam barang: ' . $barang->nama_barang . 
            ' (Kode: ' . $barang->kode_barang . ') menjadi ' . 
            ($newStatus ? 'DAPAT dipinjam' : 'TIDAK DAPAT dipinjam')
        );
        
        return response()->json([
            'success' => true,
            'message' => 'Status dapat dipinjam berhasil diubah menjadi ' . ($newStatus ? 'Ya' : 'Tidak'),
            'dapat_dipinjam' => $newStatus,
            'status_text' => $newStatus ? 'Ya' : 'Tidak' // ✅ TAMBAHAN INFO
        ]);
        
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Barang tidak ditemukan'
        ], 404);
        
    } catch (\Exception $e) {
        // ✅ TAMBAHKAN LOGGING ERROR
        \Log::error('Toggle Dapat Dipinjam Error: ' . $e->getMessage(), [
            'barang_id' => $id,
            'user_id' => Auth::id(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return response()->json([
            'success' => false,
            'message' => 'Gagal mengubah status: ' . $e->getMessage()
        ], 500);
    }
}

    public function checkAvailability(Request $request, Barang $barang)
    {
        $jumlah = $request->get('jumlah', 1);
        $tanggal_mulai = $request->get('tanggal_mulai');
        $tanggal_selesai = $request->get('tanggal_selesai');
        
        $available = $barang->canBeBorrowed($jumlah);
        
        // TODO: Check against existing bookings in date range
        
        return response()->json([
            'available' => $available,
            'jumlah_tersedia' => $barang->jumlah_tersedia,
            'message' => $available ? 'Barang tersedia' : 'Barang tidak tersedia dalam jumlah yang diminta'
        ]);
    }

    public function export(Request $request)
    {
        $filename = 'barang_export_' . date('Y-m-d_H-i-s') . '.xlsx';
        
        return Excel::download(new BarangExport($request->all()), $filename);
    }

    /** 
 * Download template Excel untuk import barang 
 */
public function downloadTemplate()
{
    $filename = 'template_import_barang_' . now()->format('Y-m-d') . '.xlsx';
    
    return Excel::download(
        new BarangTemplateExport(),
        $filename
    );
}

/** 
 * Import data barang dari Excel dengan error tracking 
 */
public function import(Request $request)
{
    // Validasi file upload
    $request->validate([
        'file' => 'required|file|mimes:xlsx,xls|max:5120' // Max 5MB
    ], [
        'file.required' => 'File Excel wajib diupload',
        'file.mimes' => 'File harus berformat Excel (.xlsx atau .xls)',
        'file.max' => 'Ukuran file maksimal 5MB',
    ]);

    try {
        // Buat instance import
        $import = new BarangImport();
        
        // Proses import
        Excel::import($import, $request->file('file'));
        
        // Dapatkan statistik hasil import
        $stats = $import->getStats();
        
        // Log aktivitas
        \App\Models\LogAktivitas::create([
            'user_id' => Auth::id(),
            'aksi' => 'Import Barang',
            'detail' => "Import {$stats['success']} barang berhasil, {$stats['skipped']} dilewati dari total {$stats['total']} baris",
        ]);
        
        // Jika ada error, tampilkan detail
        if ($stats['skipped'] > 0) {
            // Ambil maksimal 10 error pertama untuk ditampilkan
            $errorDetails = collect($stats['errors'])
                ->take(10)
                ->map(function($error) {
                    $rowInfo = isset($error['row']) && $error['row'] !== 'N/A' 
                        ? "Baris {$error['row']}" 
                        : "Data";
                    $dataInfo = isset($error['data']) ? " ({$error['data']})" : "";
                    return "{$rowInfo}{$dataInfo}: {$error['error']}";
                })
                ->toArray();
            
            // Simpan error ke session untuk ditampilkan di view
            session()->flash('import_errors', $errorDetails);
            session()->flash('more_errors', $stats['skipped'] > 10 ? $stats['skipped'] - 10 : 0);
            
            // Jika semua gagal
            if ($stats['success'] === 0) {
                return back()->with('error', 
                    "Import gagal! Semua {$stats['skipped']} baris memiliki error. Silakan periksa file Anda."
                );
            }
            
            // Jika sebagian berhasil
            return back()->with([
                'warning' => "Import selesai dengan {$stats['skipped']} baris dilewati karena error.",
                'success' => "✅ {$stats['success']} data barang berhasil diimport!",
            ]);
        }
        
        // Jika semua berhasil
        return back()->with('success', "🎉 Berhasil import {$stats['success']} data barang!");
        
    } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        // Handle validation exception dari Laravel Excel
        $failures = $e->failures();
        $errorMessages = [];
        
        foreach ($failures as $failure) {
            $errorMessages[] = "Baris {$failure->row()}: " . implode(', ', $failure->errors());
            
            // Maksimal 10 error ditampilkan
            if (count($errorMessages) >= 10) {
                break;
            }
        }
        
        session()->flash('import_errors', $errorMessages);
        session()->flash('more_errors', count($failures) > 10 ? count($failures) - 10 : 0);
        
        return back()->with('error', 'Validasi gagal! Silakan perbaiki error berikut:');
        
    } catch (\Exception $e) {
        // Handle error umum
        \Log::error('Import error: ' . $e->getMessage(), [
            'user_id' => Auth::id(),
            'file' => $request->file('file')->getClientOriginalName(),
            'trace' => $e->getTraceAsString()
        ]);
        
        return back()->with('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
    }
}

    private function generateKodeBarang($kategoriId, $kodeManual = null)
    {
        $kategori = KategoriBarang::find($kategoriId);
        
        // Generate kode kategori (3 huruf pertama, uppercase)
        $kodeKategori = strtoupper(substr($kategori->nama_kategori, 0, 3));
        
        // Jika ada kode manual dari user
        if ($kodeManual) {
            $kode = sprintf("CTP-%s-%05s-%d", $kodeKategori, $kodeManual, date('Y'));
        } else {
            // Generate otomatis berdasarkan urutan
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
        }
        
        // Pastikan kode unik
        $counter = 1;
        $originalKode = $kode;
        while (Barang::where('kode_barang', $kode)->exists()) {
            $kode = $originalKode . '-' . $counter;
            $counter++;
        }
        
        return $kode;
    }

/**
 * Set barang ke status maintenance dengan jumlah unit tertentu
 */
public function maintenance(Request $request, Barang $barang)
{
    $request->validate([
        'jenis_maintenance' => 'required|in:preventif,korektif,emergency',
        'deskripsi' => 'required|string|min:10',
        'biaya' => 'nullable|numeric|min:0',
        'teknisi' => 'nullable|string|max:255',
        'jumlah' => 'required|integer|min:1|max:' . $barang->jumlah_tersedia,
    ]);

    try {
        DB::beginTransaction(); // ✅ TAMBAH TRANSACTION
        
        $jumlahMaintenance = $request->jumlah;

        // Cek ketersediaan
        if ($jumlahMaintenance > $barang->jumlah_tersedia) {
            return back()->with('error', 'Jumlah unit yang diminta melebihi stok tersedia.');
        }

        // ✅ PERBAIKAN: Update barang dengan jumlah_maintenance
        $barang->update([
            'jumlah_tersedia' => $barang->jumlah_tersedia - $jumlahMaintenance,
            'jumlah_maintenance' => $barang->jumlah_maintenance + $jumlahMaintenance, // ✅ TAMBAH INI
            'status' => ($barang->jumlah_tersedia - $jumlahMaintenance) == 0 
                        ? Barang::STATUS_MAINTENANCE 
                        : $barang->status
        ]);

        // Buat maintenance record
        $barang->maintenances()->create([
            'jenis_aset' => 'barang',
            'aset_id' => $barang->id,
            'jumlah' => $jumlahMaintenance,
            'tanggal' => now(),
            'deskripsi' => $request->deskripsi,
            'jenis_maintenance' => $request->jenis_maintenance,
            'status' => 'dijadwalkan', // ✅ ATAU 'dalam_proses' sesuai kebutuhan
            'biaya' => $request->biaya ?? 0,
            'teknisi' => $request->teknisi
        ]);

        // Log aktivitas
        $logDetail = 'Menjadwalkan maintenance ' . $request->jenis_maintenance . 
            ' untuk ' . $jumlahMaintenance . ' unit barang: ' . 
            $barang->nama_barang . ' (Kode: ' . $barang->kode_barang . ')';
        
        if ($request->teknisi) {
            $logDetail .= ' - Teknisi: ' . $request->teknisi;
        }
        
        if ($request->biaya && $request->biaya > 0) {
            $logDetail .= ' - Estimasi Biaya: Rp ' . number_format($request->biaya, 0, ',', '.');
        }

        LogAktivitas::catat('Menambah Maintenance', $logDetail);

        DB::commit(); // ✅ COMMIT TRANSACTION

        // ✅ Enhanced notification
        $successMsg = $jumlahMaintenance . ' unit barang berhasil dijadwalkan untuk maintenance.';
        $infoMsg = 'Jenis: ' . ucfirst($request->jenis_maintenance);
        if ($request->teknisi) {
            $infoMsg .= ' | Teknisi: ' . $request->teknisi;
        }

        return redirect()->back()
            ->with('success', $successMsg)
            ->with('info', $infoMsg);
            
    } catch (\Exception $e) {
        DB::rollBack(); // ✅ ROLLBACK ON ERROR
        \Log::error('Maintenance Error: ' . $e->getMessage());
        
        return back()->with('error', 'Gagal menjadwalkan maintenance: ' . $e->getMessage());
    }
}

/**
 * Aktifkan barang dari maintenance
 */
public function activate(Request $request, Barang $barang)
{
    $request->validate([
        'catatan' => 'nullable|string',
        'maintenance_id' => 'required|exists:maintenance,id'
    ]);

    try {
        $maintenance = Maintenance::findOrFail($request->maintenance_id);
        
        // ✅ Validasi tambahan
        if ($maintenance->aset_id != $barang->id || $maintenance->jenis_aset != 'barang') {
            return response()->json([
                'success' => false,
                'message' => 'Maintenance tidak valid untuk barang ini'
            ], 400);
        }
        
        if ($maintenance->status !== 'dalam_proses') {
            return response()->json([
                'success' => false,
                'message' => 'Maintenance sudah diselesaikan atau dibatalkan'
            ], 400);
        }
        
        // Kembalikan jumlah tersedia
        $barang->update([
            'jumlah_tersedia' => $barang->jumlah_tersedia + $maintenance->jumlah,
            'jumlah_maintenance' => $barang->jumlah_maintenance - $maintenance->jumlah, // ✅ Kurangi jumlah_maintenance
            // Update status ke tersedia jika ada stok yang tersedia
            'status' => ($barang->jumlah_tersedia + $maintenance->jumlah) > 0 
                        ? Barang::STATUS_TERSEDIA 
                        : $barang->status
        ]);

        // Update maintenance record
        $maintenance->update([
            'status' => 'selesai',
            'tanggal_selesai' => now(),
            'catatan_penyelesaian' => $request->catatan
        ]);

        // Catat log aktivitas
        LogAktivitas::catat(
            'Aktivasi Barang',
            'Menyelesaikan maintenance ' . $maintenance->jumlah . ' unit barang: ' . 
            $barang->nama_barang . ' (Kode: ' . $barang->kode_barang . ')' .
            ($request->catatan ? ' - Catatan: ' . $request->catatan : '')
        );

        // ✅ Enhanced JSON response
        return response()->json([
            'success' => true,
            'message' => $maintenance->jumlah . ' unit barang berhasil diaktifkan kembali!',
            'info' => 'Barang kembali tersedia untuk dipinjam.',
            'data' => [
                'jumlah_tersedia' => $barang->fresh()->jumlah_tersedia,
                'jumlah_maintenance' => $barang->fresh()->jumlah_maintenance,
                'status' => $barang->fresh()->status,
                'status_badge' => $barang->fresh()->status_badge
            ]
        ]);
        
    } catch (\Exception $e) {
        \Log::error('Activate Maintenance Error: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Gagal menyelesaikan maintenance.',
            'error' => $e->getMessage()
        ], 500);
    }
}
/**
 * Check status barang (API untuk real-time update)
 */
public function checkStatus(Barang $barang)
{
    // Load relasi untuk data lengkap
    $barang->load('kategori', 'maintenances', 'peminjamanDetails.peminjaman.user');

    return response()->json([
        'status' => $barang->status,
        'jumlah_tersedia' => $barang->jumlah_tersedia,
        'jumlah_total' => $barang->jumlah_total,
        'is_available' => $barang->is_available,
        'status_badge' => $barang->status_badge,
        'updated_at' => $barang->updated_at->toISOString(),
        'active_loans' => $barang->peminjamanDetails->where('peminjaman.status', 'disetujui')->count(),
        'active_maintenance' => $barang->maintenances()->where('status', 'dalam_proses')->exists()
    ]);
}

/**
 * Upload foto tambahan untuk barang
 */
public function uploadFoto(Request $request, Barang $barang)
{
    $request->validate([
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'keterangan' => 'nullable|string|max:255',
    ]);

    try {
        // Upload file
        $file = $request->file('foto');
        $filename = 'barang_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('barang', $filename, 'public');

        // Hitung urutan berikutnya
        $maxUrutan = $barang->fotos()->max('urutan') ?? 0;

        // Simpan ke database
        $foto = $barang->fotos()->create([
            'foto' => 'barang/' . $filename,
            'is_primary' => $barang->fotos()->count() === 0, // Set primary jika foto pertama
            'urutan' => $maxUrutan + 1,
            'keterangan' => $request->keterangan,
        ]);

        // Log aktivitas
        LogAktivitas::catat(
            'Upload Foto Barang',
            'Menambahkan foto untuk barang: ' . $barang->nama_barang . ' (Kode: ' . $barang->kode_barang . ')'
        );

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil diupload',
            'foto' => [
                'id' => $foto->id,
                'url' => $foto->foto_url,
                'is_primary' => $foto->is_primary,
                'keterangan' => $foto->keterangan,
            ]
        ]);

    } catch (\Exception $e) {
        \Log::error('Upload Foto Error: ' . $e->getMessage());
        
        return response()->json([
            'success' => false,
            'message' => 'Gagal upload foto: ' . $e->getMessage()
        ], 500);
    }
}

/**
 * Set foto sebagai primary
 */
public function setPrimaryFoto(Request $request, Barang $barang, $fotoId)
{
    try {
        $foto = $barang->fotos()->findOrFail($fotoId);
        $foto->setPrimary();

        // Log aktivitas
        LogAktivitas::catat(
            'Set Foto Primary',
            'Mengatur foto primary untuk barang: ' . $barang->nama_barang . ' (Kode: ' . $barang->kode_barang . ')'
        );

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil diset sebagai primary'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal set foto primary: ' . $e->getMessage()
        ], 500);
    }
}

/**
 * Update keterangan foto
 */
public function updateKeteranganFoto(Request $request, Barang $barang, $fotoId)
{
    $request->validate([
        'keterangan' => 'nullable|string|max:255',
    ]);

    try {
        $foto = $barang->fotos()->findOrFail($fotoId);
        $foto->update(['keterangan' => $request->keterangan]);

        return response()->json([
            'success' => true,
            'message' => 'Keterangan foto berhasil diupdate'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal update keterangan: ' . $e->getMessage()
        ], 500);
    }
}

/**
 * Update urutan foto (drag & drop)
 */
public function updateUrutanFoto(Request $request, Barang $barang)
{
    $request->validate([
        'urutan' => 'required|array',
        'urutan.*' => 'required|integer|exists:barang_foto,id',
    ]);

    try {
        foreach ($request->urutan as $index => $fotoId) {
            $barang->fotos()->where('id', $fotoId)->update(['urutan' => $index]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Urutan foto berhasil diupdate'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal update urutan: ' . $e->getMessage()
        ], 500);
    }
}

/**
 * Hapus foto
 */
public function deleteFoto(Barang $barang, $fotoId)
{
    try {
        $foto = $barang->fotos()->findOrFail($fotoId);
        
        // Cek jika ini satu-satunya foto
        if ($barang->fotos()->count() === 1) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat menghapus foto terakhir. Barang harus memiliki minimal 1 foto.'
            ], 422);
        }

        $foto->deleteFoto();

        // Log aktivitas
        LogAktivitas::catat(
            'Hapus Foto Barang',
            'Menghapus foto dari barang: ' . $barang->nama_barang . ' (Kode: ' . $barang->kode_barang . ')'
        );

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil dihapus'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal hapus foto: ' . $e->getMessage()
        ], 500);
    }
}

/**
 * Get semua foto barang (untuk gallery/lightbox)
 */
public function getFotos(Barang $barang)
{
    try {
        $fotos = $barang->fotos()->ordered()->get()->map(function($foto) {
            return [
                'id' => $foto->id,
                'url' => $foto->foto_url,
                'thumbnail_url' => $foto->thumbnail_url,
                'is_primary' => $foto->is_primary,
                'urutan' => $foto->urutan,
                'keterangan' => $foto->keterangan,
            ];
        });

        return response()->json([
            'success' => true,
            'fotos' => $fotos
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal mengambil data foto: ' . $e->getMessage()
        ], 500);
    }
}
}
