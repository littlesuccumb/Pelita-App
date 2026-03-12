<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Permohonan;
use App\Services\NotificationService;
use App\Models\Barang;
use App\Models\PeminjamanDetail;
use App\Models\Pembayaran;
use App\Models\Dokumen;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Exports\PeminjamanExport;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\Shared\Converter;


class PeminjamanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | USER ROUTES - VIEW ONLY (Peminjaman dibuat dari Permohonan)
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
{
    $userId = Auth::id();
    
    // Query dengan relasi lengkap - menggunakan relasi yang benar sesuai model Barang
    $query = Peminjaman::with([
        'permohonan', 
        'pembayaran', 
        'peminjamanDetail.barang.kategori',
        'peminjamanDetail.barang.fotos', // Gunakan ordered() scope dari relasi
        'peminjamanDetail.barang.fotoPrimary' // Load foto primary secara spesifik
    ])
        ->where('user_id', $userId)
        ->where('jenis_aset', 'barang');

    // Filter by status peminjaman
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter by status pembayaran
    if ($request->filled('pembayaran_status')) {
        $query->whereHas('pembayaran', function($q) use ($request) {
            $q->where('status', $request->pembayaran_status);
        });
    }

    // Filter by tanggal mulai
    if ($request->filled('tanggal_mulai')) {
        $query->whereDate('tanggal_mulai', '>=', $request->tanggal_mulai);
    }

    // Filter by tanggal selesai
    if ($request->filled('tanggal_selesai')) {
        $query->whereDate('tanggal_selesai', '<=', $request->tanggal_selesai);
    }

    // Search barang atau keperluan
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            // Search di nama barang atau kode barang
            $q->whereHas('peminjamanDetail.barang', function($barangQuery) use ($search) {
                $barangQuery->where('nama_barang', 'LIKE', "%{$search}%")
                        ->orWhere('kode_barang', 'LIKE', "%{$search}%")
                        ->orWhere('merk', 'LIKE', "%{$search}%")
                        ->orWhere('type', 'LIKE', "%{$search}%");
            })
            // Search di keperluan
            ->orWhere('keperluan', 'LIKE', "%{$search}%");
        });
    }

    $peminjaman = $query->latest()->paginate(10);

    return view('peminjaman.index', compact('peminjaman'));
}

    public function show(Peminjaman $peminjaman)
    {
        // User cuma bisa liat peminjaman mereka sendiri
        if (Auth::user()->role === 'user' && $peminjaman->user_id !== Auth::id()) {
            abort(403);
        }

        // Only allow barang type
        if ($peminjaman->jenis_aset !== 'barang') {
            abort(404);
        }

        // Load semua relasi yang dibutuhkan
        $peminjaman->load([
            'user', 
            'permohonan', 
            'pembayaran', 
            'dokumen',
            'peminjamanDetail.barang' => function($query) {
                $query->with('kategori');
            }
        ]);

        return view('peminjaman.show', compact('peminjaman'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES - MANAGE PEMINJAMAN
    |--------------------------------------------------------------------------
    */

    public function adminIndex(Request $request)
    {
        $query = Peminjaman::with(['user', 'permohonan', 'pembayaran', 'barang.kategori','peminjamanDetail.barang.kategori' // Tambahkan ini
])
            ->where('jenis_aset', 'barang'); // Only barang

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by kategori barang
        if ($request->filled('kategori')) {
            $query->whereHas('barang', function($q) use ($request) {
                $q->where('kategori_id', $request->kategori);
            });
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                // Search user
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('name', 'LIKE', "%{$search}%")
                             ->orWhere('email', 'LIKE', "%{$search}%");
                })
                // Search barang
                ->orWhereHas('barang', function($barangQuery) use ($search) {
                    $barangQuery->where('nama_barang', 'LIKE', "%{$search}%")
                               ->orWhere('kode_barang', 'LIKE', "%{$search}%")
                               ->orWhere('merk', 'LIKE', "%{$search}%");
                })
                // Search keperluan
                ->orWhere('keperluan', 'LIKE', "%{$search}%");
            });
        }

        // Date range filter
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('tanggal_mulai', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('tanggal_selesai', '<=', $request->tanggal_selesai);
        }

        $peminjaman = $query->latest()->paginate(10);

        // Get categories for filter dropdown
        $kategori = \App\Models\KategoriBarang::select('id', 'nama_kategori')->get();

        return view('admin.peminjaman.index', compact('peminjaman', 'kategori'));
    }

    public function adminShow(Peminjaman $peminjaman)
    {
        // Only allow barang type
        if ($peminjaman->jenis_aset !== 'barang') {
            abort(404);
        }

        $peminjaman->load([
            'user', 
            'permohonan', 
            'pembayaran', 
            'dokumen',
            'peminjamanDetail.barang' => function($query) {
                $query->with('kategori');
            }
        ]);
        
        return view('admin.peminjaman.show', compact('peminjaman'));
    }

    public function edit(Peminjaman $peminjaman)
    {
        // ❌ Tidak bisa edit jika bukan status menunggu
        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Peminjaman hanya dapat diedit saat status masih "Menunggu".');
        }

        if ($peminjaman->jenis_aset !== 'barang') {
            abort(404);
        }

        // Load barang yang tersedia
        $barang = Barang::where('status', 'tersedia')
            ->where('jumlah_tersedia', '>', 0)
            ->with('kategori')
            ->get();

        return view('admin.peminjaman.edit', compact('peminjaman', 'barang'));
    }

  public function update(Request $request, Peminjaman $peminjaman)
{
    // ❌ Validasi status
    if ($peminjaman->status !== 'menunggu') {
        return back()->with('error', 'Peminjaman hanya dapat diedit saat status masih "Menunggu".');
    }

    if ($peminjaman->jenis_aset !== 'barang') {
        abort(404);
    }

    // ✅ Validasi input
    $request->validate([
        'barang' => 'required|array|min:1',
        'barang.*.id' => 'required|exists:barang,id',
        'barang.*.jumlah' => 'required|integer|min:1',
        'tanggal_mulai' => 'required|date|after_or_equal:today',
        'tanggal_selesai' => [
            'required',
            'date',
            'after:tanggal_mulai',
            function ($attribute, $value, $fail) use ($request) {
                $tanggalMulai = Carbon::parse($request->tanggal_mulai);
                $tanggalSelesai = Carbon::parse($value);
                $selisihHari = $tanggalMulai->diffInDays($tanggalSelesai);
                
                if ($selisihHari > 2) { // 0-2 days = max 3 hari
                    $fail('Durasi peminjaman maksimal 3 hari.');
                }
            },
        ],
        'keperluan' => 'nullable|string|max:1000',
    ], [
        'barang.required' => 'Minimal pilih 1 barang.',
        'barang.*.id.required' => 'Barang harus dipilih.',
        'barang.*.id.exists' => 'Barang tidak valid.',
        'barang.*.jumlah.required' => 'Jumlah harus diisi.',
        'barang.*.jumlah.min' => 'Jumlah minimal 1.',
        'tanggal_mulai.after_or_equal' => 'Tanggal mulai tidak boleh kurang dari hari ini.',
        'tanggal_selesai.after' => 'Tanggal selesai harus setelah tanggal mulai.',
    ]);

    DB::beginTransaction();
    try {
        // ✅ Hitung durasi
        $tanggalMulai = Carbon::parse($request->tanggal_mulai);
        $tanggalSelesai = Carbon::parse($request->tanggal_selesai);
        $jumlahHari = $tanggalMulai->diffInDays($tanggalSelesai) + 1;

        // ✅ Validasi & hitung biaya untuk semua barang
        $totalBiaya = 0;
        $barangDetails = [];
        
        foreach ($request->barang as $item) {
            $barang = Barang::findOrFail($item['id']);
            
            // Cek ketersediaan
            if (!$barang->canBeBorrowed($item['jumlah'])) {
                DB::rollback();
                return back()->withInput()->with('error', 
                    "Barang '{$barang->nama_barang}' tidak tersedia dalam jumlah {$item['jumlah']} unit atau kondisi tidak baik."
                );
            }
            
            $subtotal = $barang->harga_sewa * $item['jumlah'] * $jumlahHari;
            $totalBiaya += $subtotal;
            
            $barangDetails[] = [
                'barang' => $barang,
                'jumlah' => $item['jumlah'],
                'subtotal' => $subtotal,
            ];
        }

        // ✅ Update data peminjaman
        $peminjaman->update([
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'keperluan' => $request->keperluan,
            'biaya' => $totalBiaya,
        ]);

        // ✅ Hapus detail lama
        $peminjaman->peminjamanDetail()->delete();
        
        // ✅ Buat detail baru
        foreach ($barangDetails as $detail) {
            PeminjamanDetail::create([
                'peminjaman_id' => $peminjaman->id,
                'barang_id' => $detail['barang']->id,
                'jumlah' => $detail['jumlah'],
                'harga_satuan' => $detail['barang']->harga_sewa,
                'subtotal' => $detail['subtotal'],
            ]);
        }

        // ✅ Update/Create pembayaran
        if ($peminjaman->pembayaran) {
            $peminjaman->pembayaran->update([
                'jumlah' => $totalBiaya,
                'metode' => $totalBiaya > 0 ? null : 'gratis',
                'status' => $totalBiaya > 0 ? 'pending' : 'lunas',
            ]);
        } else {
            Pembayaran::create([
                'peminjaman_id' => $peminjaman->id,
                'jumlah' => $totalBiaya,
                'status' => $totalBiaya > 0 ? 'pending' : 'lunas',
                'metode' => $totalBiaya > 0 ? null : 'gratis',
            ]);
        }

        // ✅ Log aktivitas
        $namaBarang = collect($barangDetails)->pluck('barang.nama_barang')->implode(', ');
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aksi' => 'Mengedit Peminjaman',
            'detail' => "Edit peminjaman ID: {$peminjaman->id}. Barang: {$namaBarang}. Periode: {$request->tanggal_mulai} s/d {$request->tanggal_selesai}. Total: Rp " . number_format($totalBiaya, 0, ',', '.'),
        ]);

        DB::commit();

        // ✅ NOTIFIKASI YANG LEBIH INFORMATIF
        $jumlahItem = count($barangDetails);
        $durasiText = $jumlahHari . ' hari';
        $periodeText = $tanggalMulai->format('d M Y') . ' - ' . $tanggalSelesai->format('d M Y');
        
        return redirect()->route('admin.peminjaman.show', $peminjaman)
            ->with('updated', 
                "Peminjaman berhasil diperbarui! " .
                "📦 {$jumlahItem} barang • " .
                "📅 {$periodeText} ({$durasiText}) • " .
                "💰 Rp " . number_format($totalBiaya, 0, ',', '.')
            );

    } catch (\Exception $e) {
        DB::rollback();
        \Log::error('Error updating peminjaman: ' . $e->getMessage());
        return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

public function approve(Request $request, Peminjaman $peminjaman)
{
    if ($peminjaman->status !== 'menunggu') {
        return back()->with('error', 'Peminjaman tidak dapat disetujui.');
    }

    if ($peminjaman->jenis_aset !== 'barang') {
        return back()->with('error', 'Jenis aset tidak valid.');
    }

    DB::beginTransaction();
    try {
        // 🔥 REFRESH DATA PEMINJAMAN SEBELUM PROSES (penting setelah edit)
        $peminjaman->refresh();
        
        // 🔥 LOAD ULANG SEMUA RELASI YANG DIBUTUHKAN UNTUK BERITA ACARA
        $peminjaman->load([
            'user', 
            'permohonan', 
            'pembayaran', 
            'dokumen',
            'peminjamanDetail.barang.kategori'
        ]);

        // ✅ Loop SEMUA detail barang
        foreach ($peminjaman->peminjamanDetail as $detail) {
            $barang = Barang::find($detail->barang_id);
            
            if (!$barang) {
                DB::rollback();
                return back()->with('error', "Barang dengan ID {$detail->barang_id} tidak ditemukan.");
            }
            
            if (!$barang->canBeBorrowed($detail->jumlah)) {
                DB::rollback();
                return back()->with('error', "Barang '{$barang->nama_barang}' tidak tersedia dalam jumlah yang diminta ({$detail->jumlah} unit).");
            }
            
            // ✅ Kurangi stok untuk setiap barang
            $barang->updateKetersediaan($detail->jumlah, 'subtract');
            
            \Log::info("Approve: Mengurangi stok {$barang->nama_barang} sebanyak {$detail->jumlah} unit. Sisa: {$barang->jumlah_tersedia}");
        }

        $peminjaman->update(['status' => 'disetujui']);
        
        // 🔥 GENERATE BERITA ACARA DENGAN DATA YANG SUDAH DI-REFRESH
        $this->generateBeritaAcara($peminjaman);

        $namaBarang = $peminjaman->peminjamanDetail->pluck('barang.nama_barang')->implode(', ');
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aksi' => 'Menyetujui Peminjaman',
            'detail' => "Menyetujui peminjaman ID: {$peminjaman->id} - Barang: {$namaBarang} untuk user: {$peminjaman->user->name}",
        ]);

        NotificationService::peminjamanDisetujui($peminjaman);

        DB::commit();
        return back()->with('success', 'Peminjaman berhasil disetujui dan stok semua barang telah dikurangi. Berita acara telah di-generate.');
        
    } catch (\Exception $e) {
        DB::rollback();
        \Log::error('Error approving peminjaman: ' . $e->getMessage());
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

    public function reject(Request $request, Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Peminjaman tidak dapat ditolak.');
        }

        $request->validate([
            'alasan_penolakan' => 'required|string|max:500'
        ]);

        $peminjaman->update([
            'status' => 'ditolak',
            'keperluan' => $peminjaman->keperluan . "\n\nAlasan Penolakan: " . $request->alasan_penolakan
        ]);

        // Log aktivitas
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aksi' => 'Menolak Peminjaman',
            'detail' => "Menolak peminjaman ID: {$peminjaman->id} - {$peminjaman->barang->nama_barang} dari user: {$peminjaman->user->name}. Alasan: {$request->alasan_penolakan}",
        ]);

        NotificationService::peminjamanDitolak($peminjaman);

        return back()->with('success', 'Peminjaman berhasil ditolak.');
    }

    public function selesai(Peminjaman $peminjaman)
{
    if ($peminjaman->status !== 'disetujui') {
        return back()->with('error', 'Peminjaman tidak dapat diselesaikan.');
    }

    if ($peminjaman->jenis_aset !== 'barang') {
        return back()->with('error', 'Jenis aset tidak valid.');
    }

    DB::beginTransaction();
    try {
        $peminjaman->update(['status' => 'selesai']);

        // ✅ PERBAIKAN: Loop SEMUA detail barang
        foreach ($peminjaman->peminjamanDetail as $detail) {
            $barang = Barang::find($detail->barang_id);
            
            if (!$barang) {
                \Log::warning("Barang dengan ID {$detail->barang_id} tidak ditemukan saat menyelesaikan peminjaman.");
                continue;
            }
            
            // ✅ Kembalikan stok untuk setiap barang
            $barang->updateKetersediaan($detail->jumlah, 'add');
            
            \Log::info("Selesai: Mengembalikan stok {$barang->nama_barang} sebanyak {$detail->jumlah} unit. Total: {$barang->jumlah_tersedia}");
        }

        $namaBarang = $peminjaman->peminjamanDetail->pluck('barang.nama_barang')->implode(', ');
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aksi' => 'Menyelesaikan Peminjaman',
            'detail' => "Menyelesaikan peminjaman ID: {$peminjaman->id} - Barang: {$namaBarang} dari user: {$peminjaman->user->name}",
        ]);

        NotificationService::peminjamanSelesai($peminjaman);

        DB::commit();
        return back()->with('success', 'Peminjaman berhasil diselesaikan dan stok semua barang telah dikembalikan.');
        
    } catch (\Exception $e) {
        DB::rollback();
        \Log::error('Error completing peminjaman: ' . $e->getMessage());
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

    
    /*
    |--------------------------------------------------------------------------
    | PRIVATE METHODS
    |--------------------------------------------------------------------------
    */

    private function generateBeritaAcara(Peminjaman $peminjaman)
    {
        $peminjaman->refresh();
        $peminjaman->load([
        'user', 
        'permohonan', 
        'pembayaran', 
        'dokumen',
        'peminjamanDetail.barang.kategori'
    ]);
        $filename = 'berita-acara-' . $peminjaman->id . '-' . time() . '.docx';
        $relativePath = 'dokumen/berita_acara/' . $filename;
        $fullPath = storage_path('app/public/' . $relativePath);
        
        $peminjaman->load([
            'user', 
            'permohonan', 
            'pembayaran', 
            'dokumen',
            'peminjamanDetail.barang' => function($query) {
                $query->with('kategori');
            }
        ]);
        
        // Pastikan folder exists
        $directory = storage_path('app/public/dokumen/berita_acara');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        
        $phpWord = new PhpWord();
        
        // Set default font
        $phpWord->setDefaultFontName('Arial');
        $phpWord->setDefaultFontSize(12);
        
        $section = $phpWord->addSection([
            'marginLeft' => 1134,
            'marginRight' => 1134,
            'marginTop' => 1134,
            'marginBottom' => 1134,
        ]);
        
        // 1. Header - Kop Surat (Gambar)
        $kopSuratPath = public_path('images/kop-surat-ctp.png');
        if (file_exists($kopSuratPath)) {
            $section->addImage($kopSuratPath, [
                'width' => 450,
                'height' => 100,
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
            ]);
        }
        
        $section->addTextBreak(1);
        
        // 2. Judul
        $section->addText(
            'BERITA ACARA PEMINJAMAN BARANG',
            ['bold' => true, 'size' => 12, 'underline' => 'single'],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
        );
        
        
        // 3. Nomor
        $section->addText(
            'Nomor : ......../......../UPT.CTP/....../'. \Carbon\Carbon::parse($peminjaman->created_at)->format('Y'),
            ['size' => 12],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
        );
        
        $section->addTextBreak(1);
        
        // 4. Tanggal
        $tanggal = \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->locale('id');
        $section->addText(
            'Pada hari ini ' . ucfirst($tanggal->isoFormat('dddd')) . ' Tanggal ' . 
            $tanggal->isoFormat('D') . ' Bulan ' . ucfirst($tanggal->isoFormat('MMMM')) . 
            ' Tahun ' . $tanggal->isoFormat('YYYY') . ' (' . $tanggal->format('d-m-Y') . 
            ') bertanda tangan di bawah ini :',
            ['size' => 12],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'spaceAfter' => 200]
        );
        
        // 5. Tabel Pihak-pihak (TANPA BORDER)
        $fancyTableStyle = ['borderSize' => 0, 'borderColor' => 'FFFFFF'];
        $phpWord->addTableStyle('PihakTable', $fancyTableStyle);
        $table = $section->addTable('PihakTable');
        
        $table->addRow();
        $table->addCell(400)->addText('1.', ['size' => 12]);
        $table->addCell(2500)->addText('A. LUKMAN HADIANSYAH, S.AP', ['size' => 12]);
        $table->addCell(200)->addText(':', ['size' => 12]);
        $table->addCell(6000)->addText('Kepala UPTD. Cimahi Techno Park selanjutnya disebut PIHAK PERTAMA', ['size' => 12, 'bold' => true]);
        
        $table->addRow();
        $table->addCell(400)->addText('2.', ['size' => 12]);
        $table->addCell(2500)->addText(strtoupper($peminjaman->user->name), ['size' => 12]);
        $table->addCell(200)->addText(':', ['size' => 12]);
        
        $instansi = $peminjaman->user->nama_instansi ?? $peminjaman->user->nama_organisasi ?? '';
        $jabatan = $peminjaman->user->jabatan ?? 'Pemohon';
        $table->addCell(6000)->addText($instansi . ($instansi ? ', ' : '') . $jabatan . ', untuk selanjutnya disebut PIHAK KEDUA', ['size' => 12, 'bold' => true]);
        
        $section->addTextBreak(1);
        
        // 6. Isi
        $section->addText(
            'Bersama ini menerangkan bahwa, PIHAK PERTAMA menyerahkan kepada PIHAK KEDUA dan PIHAK KEDUA menerima dari PIHAK PERTAMA barang milik/kekayaan Pemerintah Daerah Kota Cimahi sebagai pinjam pakai berupa:',
            ['size' => 12],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'spaceAfter' => 200]
        );
        
        // 7. Tabel Barang (DENGAN BORDER)
        $barangTableStyle = [
            'borderSize' => 6,
            'borderColor' => '000000',
            'cellMargin' => 80
        ];
        $phpWord->addTableStyle('BarangTable', $barangTableStyle);
        $tableBarang = $section->addTable('BarangTable');
        
        // Header
        $tableBarang->addRow(400);
        $tableBarang->addCell(800)->addText('No', ['bold' => true, 'size' => 12], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $tableBarang->addCell(3500)->addText('Jenis', ['bold' => true, 'size' => 12], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $tableBarang->addCell(3000)->addText('Merk/Type', ['bold' => true, 'size' => 12], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $tableBarang->addCell(1500)->addText('Unit', ['bold' => true, 'size' => 12], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $tableBarang->addCell(1500)->addText('Kondisi', ['bold' => true, 'size' => 12], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        
        // Data
        foreach ($peminjaman->peminjamanDetail as $index => $detail) {
            $tableBarang->addRow();
            $tableBarang->addCell(800)->addText($index + 1, ['size' => 12], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $tableBarang->addCell(3500)->addText($detail->barang->nama_barang, ['size' => 12]);
            
            $merkType = ($detail->barang->merk ?? '-') . ' ' . ($detail->barang->type ?? '');
            $tableBarang->addCell(3000)->addText(trim($merkType), ['size' => 12]);
            
            $tableBarang->addCell(1500)->addText($detail->jumlah . ' Unit', ['size' => 12], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
            $tableBarang->addCell(1500)->addText(ucfirst($detail->barang->kondisi), ['size' => 12], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        }
        
        $section->addTextBreak(1);
        
        // 8. Ketentuan
        $section->addText(
            'Berita Acara ini diterima oleh PIHAK KEDUA dengan ketentuan sebagai berikut:',
            ['size' => 12],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'spaceAfter' => 100]
        );
        
        // Manual numbering - lebih reliable
        $section->addText(
            '1.  PIHAK KEDUA tidak diperkenankan mengalihkan dan atau mengubah peruntukan yang telah ditetapkan, kecuali ditentukan lain dengan keputusan pejabat atau aturan yang sudah ditetapkan;',
            ['size' => 12],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'spaceAfter' => 100, 'indentation' => ['left' => 360, 'hanging' => 360]]
        );
        
        $section->addText(
            '2.  Apabila terjadi kehilangan dan/atau kerusakan berat sebagai akibat kelalaian menjadi tanggung jawab PIHAK KEDUA sesuai dengan ketentuan yang berlaku;',
            ['size' => 12],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'spaceAfter' => 100, 'indentation' => ['left' => 360, 'hanging' => 360]]
        );
        
        $section->addText(
            '3.  Sejak penandatangan berita acara serah terima ini, maka barang tersebut menjadi tanggungjawab PIHAK KEDUA dengan seluruh resiko yang melekat atas barang tersebut;',
            ['size' => 12],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'spaceAfter' => 100, 'indentation' => ['left' => 360, 'hanging' => 360]]
        );
        
        $section->addText(
            '4.  Masa peminjaman berlaku dari tanggal ' . \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->format('d-m-Y') . 
            ' sampai dengan ' . \Carbon\Carbon::parse($peminjaman->tanggal_selesai)->format('d-m-Y') . '.',
            ['size' => 12],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'spaceAfter' => 100, 'indentation' => ['left' => 360, 'hanging' => 360]]
        );
        
        $section->addTextBreak(1);
        
        // 9. Penutup
        $section->addText(
            'Demikian Berita Acara ini dibuat dalam rangkap 3 (tiga) untuk dipergunakan sebagaimana mestinya.',
            ['size' => 12],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'spaceAfter' => 200]
        );
        
        // 10. Lokasi & Tanggal
        $section->addText(
            'Cimahi, ' . \Carbon\Carbon::parse($peminjaman->created_at)->locale('id')->isoFormat('D MMMM YYYY'),
            ['size' => 12],
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END, 'spaceAfter' => 400]
        );
        
        // 11. Tabel Tanda Tangan (TANPA BORDER)
        $phpWord->addTableStyle('TTDTable', ['borderSize' => 0, 'borderColor' => 'FFFFFF']);
        $tableTTD = $section->addTable('TTDTable');
        $tableTTD->addRow();
        
        $cellPihak1 = $tableTTD->addCell(4500);
        $cellPihak1->addText('PIHAK PERTAMA', ['bold' => true, 'size' => 12], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $cellPihak1->addTextBreak(3);
        $cellPihak1->addText('A. LUKMAN HADIANSYAH, S.AP', ['underline' => 'single', 'size' => 12], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $cellPihak1->addText('Kepala UPTD CTP', ['size' => 12], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        
        $cellPihak2 = $tableTTD->addCell(4500);
        $cellPihak2->addText('PIHAK KEDUA', ['bold' => true, 'size' => 12], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $cellPihak2->addTextBreak(3);
        $cellPihak2->addText($peminjaman->user->name, ['underline' => 'single', 'size' => 12], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        $cellPihak2->addText($peminjaman->user->jabatan ?? 'Pemohon', ['size' => 12], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
        
        // Simpan file
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($fullPath);
        
        // Update database
        $peminjaman->update(['berita_acara' => $relativePath]);
        
        Dokumen::create([
            'peminjaman_id' => $peminjaman->id,
            'jenis_dokumen' => 'berita_acara',
            'file_path' => $relativePath,
        ]);
    }

    public function printBeritaAcara(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'disetujui' || !$peminjaman->berita_acara) {
            abort(404);
        }

        if ($peminjaman->jenis_aset !== 'barang') {
            abort(404);
        }

        // Build full path
        $filePath = storage_path('app/public/' . $peminjaman->berita_acara);
        
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return response()->download($filePath, 'berita-acara-' . $peminjaman->id . '.docx');
    }

    public function export(Request $request)
    {
        $filename = 'peminjaman_' . now()->format('Y-m-d_His') . '.xlsx';
        
        return Excel::download(
            new PeminjamanExport($request->all()), 
            $filename
        );
    }
}