<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use App\Models\PermohonanItem;
use App\Models\Peminjaman;
use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\Pembayaran;
use App\Models\PeminjamanDetail;
use App\Models\LogAktivitas;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Converter;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PermohonanExport;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\Style\Paragraph;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class PermohonanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | USER ROUTES - PRIMARY FLOW
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $userId = Auth::id();
        
        $query = Permohonan::byUser($userId)
            ->with([
                'items.barang:id,nama_barang,harga_sewa,kategori_id',
                'items.barang.kategori:id,nama_kategori',
                'items.barang.fotoPrimary',
                'peminjaman:id,permohonan_id,status,tanggal_mulai,tanggal_selesai,biaya'
            ]);

        // Filter berdasarkan status jika ada
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal_mulai')) {
            $query->whereDate('created_at', '>=', $request->tanggal_mulai);
        }
        
        if ($request->filled('tanggal_selesai')) {
            $query->whereDate('created_at', '<=', $request->tanggal_selesai);
        }

        // Filter berdasarkan kategori barang
        if ($request->filled('kategori')) {
            $query->whereHas('items.barang', function ($q) use ($request) {
                $q->where('kategori_id', $request->kategori);
            });
        }

        // Search berdasarkan nomor permohonan atau nama barang
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('no_permohonan', 'like', "%{$search}%")
                  ->orWhere('nama_pemohon', 'like', "%{$search}%")
                  ->orWhere('nama_instansi', 'like', "%{$search}%")
                  ->orWhereHas('items.barang', function ($barangQuery) use ($search) {
                      $barangQuery->where('nama_barang', 'like', "%{$search}%");
                  });
            });
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        if (in_array($sortBy, ['created_at', 'no_permohonan', 'status'])) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->latest();
        }

        $permohonan = $query->paginate(10)->withQueryString();

        // Data untuk filter dropdown
        $statusOptions = [
            'Dalam Proses' => 'Dalam Proses',
            'Disetujui' => 'Disetujui', 
            'Ditolak' => 'Ditolak'
        ];

        // Ambil kategori untuk filter
        $kategoriOptions = \App\Models\KategoriBarang::pluck('nama_kategori', 'id');

        return view('permohonan.index', compact('permohonan', 'statusOptions', 'kategoriOptions'));
    }

    public function create(Request $request)
    {
        // Data untuk dropdown - hanya barang yang tersedia DAN dapat dipinjam
        $barang = Barang::tersediaDanDapatDipinjam()
            ->with('kategoriBarang')
            ->get();
            
        $kategori = KategoriBarang::all();
        
        // ✅ BARU: Handle data dari cart
        $cartItems = [];
        $totalEstimasi = 0;
        $duration = 1; // Default durasi 1 hari
        
        // Jika ada parameter cart dari query string (dari cart checkout)
        if ($request->has('cart')) {
            $cartParam = $request->get('cart');
            $duration = $request->get('duration', 1);
            
            // Format: "1:2,3:1,5:3" → barang_id:quantity
            $items = explode(',', $cartParam);
            
            foreach ($items as $item) {
                if (strpos($item, ':') !== false) {
                    list($barangId, $quantity) = explode(':', $item);
                    
                    $barangData = Barang::with('kategoriBarang')->find($barangId);
                    
                    if ($barangData && $barangData->dapat_dipinjam && $barangData->status === 'tersedia') {
                        $subtotal = $barangData->harga_sewa * $quantity * $duration;
                        
                        $cartItems[] = [
                            'barang_id' => $barangData->id,
                            'nama_barang' => $barangData->nama_barang,
                            'kategori' => $barangData->kategoriBarang->nama_kategori ?? '-',
                            'harga_sewa' => $barangData->harga_sewa,
                            'quantity' => $quantity,
                            'jumlah_tersedia' => $barangData->jumlah_tersedia,
                            'subtotal' => $subtotal,
                            'foto' => $barangData->fotoPrimary ? asset('storage/' . $barangData->fotoPrimary->foto) : null
                        ];
                        
                        $totalEstimasi += $subtotal;
                    }
                }
            }
        }
        
        // Jika ada parameter barang_id langsung (dari "Order Now")
        if ($request->has('barang_id') && $request->has('qty')) {
            $barangData = Barang::with('kategoriBarang')->find($request->barang_id);
            
            if ($barangData && $barangData->dapat_dipinjam && $barangData->status === 'tersedia') {
                $quantity = (int)$request->qty;
                $subtotal = $barangData->harga_sewa * $quantity * $duration;
                
                $cartItems[] = [
                    'barang_id' => $barangData->id,
                    'nama_barang' => $barangData->nama_barang,
                    'kategori' => $barangData->kategoriBarang->nama_kategori ?? '-',
                    'harga_sewa' => $barangData->harga_sewa,
                    'quantity' => $quantity,
                    'jumlah_tersedia' => $barangData->jumlah_tersedia,
                    'subtotal' => $subtotal,
                    'foto' => $barangData->fotoPrimary ? asset('storage/' . $barangData->fotoPrimary->foto) : null
                ];
                
                $totalEstimasi += $subtotal;
            }
        }
        
        return view('permohonan.create', compact('barang', 'kategori', 'cartItems', 'totalEstimasi', 'duration'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // Data Pemohon
            'nama_pemohon' => 'nullable|string|max:255',
            'alamat_pemohon' => 'nullable|string|max:500',
            'kabupaten' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kelurahan' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'no_telp' => 'nullable|string|max:20',
            'no_ktp' => 'nullable|string|max:20',
            
            // Data Instansi
            'nama_instansi' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'bidang_instansi' => 'nullable|string|max:255',
            'alamat_instansi' => 'nullable|string|max:500',
            
            // Upload kop surat
            'kop_surat' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            
            // Multiple items validation
            'items' => 'required|array|min:1',
            'items.*.barang_id' => 'required|exists:barang,id',
            'items.*.jumlah' => 'required|integer|min:1',
            
            // Data peminjaman dengan validasi maksimal 3 hari
            'tanggal_mulai' => 'required|date|after:today',
            'tanggal_selesai' => [
                'required',
                'date',
                'after_or_equal:tanggal_mulai',
                function ($attribute, $value, $fail) use ($request) {
                    $tanggalMulai = Carbon::parse($request->tanggal_mulai);
                    $tanggalSelesai = Carbon::parse($value);
                    $selisihHari = $tanggalMulai->diffInDays($tanggalSelesai);
                    
                    if ($selisihHari > 3) {
                        $fail('Durasi peminjaman maksimal 3 hari.');
                    }
                },
            ],
            'keperluan' => 'required|string|min:10|max:1000',
        ], [
            'tanggal_mulai.after' => 'Tanggal mulai harus lebih dari hari ini.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
        ]);

        DB::beginTransaction();
        try {
            $user = Auth::user();

            $noPermohonan = $this->generateNomorPermohonan();

            // Validasi setiap item barang
            foreach ($request->items as $item) {
                $barang = Barang::findOrFail($item['barang_id']);
                
                // Validasi dapat dipinjam
                if (!$barang->dapat_dipinjam) {
                    return back()->with('error', "Barang '{$barang->nama_barang}' tidak dapat dipinjam");
                }
                
                if ($barang->status !== 'tersedia' || $barang->jumlah_tersedia < $item['jumlah']) {
                    return back()->with('error', "Barang '{$barang->nama_barang}' tidak tersedia dalam jumlah yang diminta");
                }
            }

    // Upload kop surat dengan auto-resize
    $kopSuratPath = null;
    if ($request->hasFile('kop_surat')) {
        $file = $request->file('kop_surat');
        $filename = 'kop_surat_' . time() . '_' . uniqid() . '.jpg';
        
        // Buat direktori jika belum ada
        $kopDir = storage_path('app/public/dokumen/kop_surat');
        if (!file_exists($kopDir)) {
            mkdir($kopDir, 0755, true);
        }
        
        $fullPath = $kopDir . '/' . $filename;
        
        // Auto-resize ke ukuran standard: 1500x400px
        Image::make($file->getRealPath())
            ->fit(1500, 400, function ($constraint) {
                $constraint->upsize();
            })
            ->save($fullPath, 85);
        
        $kopSuratPath = 'dokumen/kop_surat/' . $filename;
    }

            // Buat permohonan dengan SEMUA DATA TERMASUK DATA PEMINJAMAN
            $permohonan = Permohonan::create([
                'user_id' => $user->id,
                'no_permohonan' => $noPermohonan,
                
                // Data Pemohon (dari form atau user)
                'nama_pemohon' => $request->nama_pemohon ?? $user->name,
                'alamat_pemohon' => $request->alamat_pemohon ?? $user->alamat,
                'kabupaten' => $request->kabupaten ?? $user->kabupaten,
                'kecamatan' => $request->kecamatan ?? $user->kecamatan,
                'kelurahan' => $request->kelurahan ?? $user->kelurahan,
                'kode_pos' => $request->kode_pos ?? $user->kode_pos,
                'no_telp' => $request->no_telp ?? $user->no_telp,
                'no_ktp' => $request->no_ktp ?? $user->no_ktp,
                
                // Data Instansi
                'nama_instansi' => $request->nama_instansi ?? $user->instansi,
                'jabatan' => $request->jabatan ?? $user->jabatan,
                'bidang_instansi' => $request->bidang_instansi,
                'alamat_instansi' => $request->alamat_instansi,
                
                // DATA PEMINJAMAN - DISIMPAN LANGSUNG DI PERMOHONAN
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'keperluan' => $request->keperluan,
                
                // File kop surat
                'kop_surat' => $kopSuratPath,
                'status' => 'Dalam Proses'
            ]);

            // Buat item-item permohonan
            $namaBarang = [];
            foreach ($request->items as $item) {
                $barang = Barang::find($item['barang_id']);
                $namaBarang[] = $barang->nama_barang;
                
                PermohonanItem::create([
                    'permohonan_id' => $permohonan->id,
                    'jenis_aset' => 'barang',
                    'aset_id' => $item['barang_id'],
                    'jumlah' => $item['jumlah'],
                ]);
            }

            // Generate draft surat permohonan otomatis
            $this->generateDraftSurat($permohonan);

            // Log aktivitas
            LogAktivitas::create([
                'user_id' => $user->id,
                'aksi' => 'Mengajukan Permohonan',
                'detail' => "Mengajukan permohonan untuk: " . implode(', ', $namaBarang),
            ]);
            
            NotificationService::permohonanBaruAdmin($permohonan);

            DB::commit();

            return redirect()->route('permohonan.show', $permohonan)
                ->with('success', 'Permohonan berhasil diajukan dan draft surat permohonan telah dibuat. Silakan download, cetak, dan tanda tangan.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Permohonan $permohonan)
    {
        // User cuma bisa liat permohonan mereka sendiri
        if (Auth::user()->role === 'user' && $permohonan->user_id !== Auth::id()) {
            abort(403);
        }

        // Load relasi dengan items
        $permohonan->load(['user', 'items.barang.kategoriBarang', 'peminjaman']);

        return view('permohonan.show', compact('permohonan'));
    }

    public function edit(Permohonan $permohonan)
    {
        // User cuma bisa edit permohonan yang masih dalam proses
        if ($permohonan->status !== 'Dalam Proses' || $permohonan->user_id !== Auth::id()) {
            return back()->with('error', 'Permohonan tidak dapat diedit.');
        }

        // Ambil SEMUA barang yang tersedia DAN dapat dipinjam (untuk add item baru)
        $barang = Barang::tersediaDanDapatDipinjam()
            ->with(['kategoriBarang', 'fotoPrimary'])
            ->get();
            
        $kategori = KategoriBarang::all();
        
        // Load permohonan dengan items dan barang details
        $permohonan->load([
            'items.barang.kategoriBarang',
            'items.barang.fotoPrimary'
        ]);

        // Siapkan data existing items untuk pre-populate di wizard step 2
        $existingItems = $permohonan->items->map(function($item) {
            return [
                'barang_id' => $item->aset_id,
                'jumlah' => $item->jumlah,
                'nama_barang' => $item->barang->nama_barang,
                'kategori' => $item->barang->kategoriBarang->nama_kategori ?? 'N/A',
                'harga_sewa' => $item->barang->harga_sewa,
                'jumlah_tersedia' => $item->barang->jumlah_tersedia,
                'foto' => $item->barang->fotoPrimary ? $item->barang->fotoPrimary->foto : null
            ];
        })->toArray(); // PENTING: Convert to array

        return view('permohonan.edit', compact('permohonan', 'barang', 'kategori', 'existingItems'));
    }

    public function update(Request $request, Permohonan $permohonan)
    {
        if ($permohonan->status !== 'Dalam Proses' || $permohonan->user_id !== Auth::id()) {
            return back()->with('error', 'Permohonan tidak dapat diedit.');
        }

        $request->validate([
            'nama_instansi' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'bidang_instansi' => 'nullable|string|max:255',
            'alamat_instansi' => 'nullable|string|max:255',
            'kop_surat' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'items' => 'required|array|min:1',
            'items.*.barang_id' => 'required|exists:barang,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date|after:today',
            'tanggal_selesai' => [
                'required',
                'date',
                'after_or_equal:tanggal_mulai',
                function ($attribute, $value, $fail) use ($request) {
                    $tanggalMulai = Carbon::parse($request->tanggal_mulai);
                    $tanggalSelesai = Carbon::parse($value);
                    $selisihHari = $tanggalMulai->diffInDays($tanggalSelesai);
                    
                    if ($selisihHari > 3) {
                        $fail('Durasi peminjaman maksimal 3 hari.');
                    }
                },
            ],
            'keperluan' => 'required|string|min:10|max:1000',
        ], [
            'tanggal_mulai.after' => 'Tanggal mulai harus lebih dari hari ini.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
        ]);

        DB::beginTransaction();
        try {
            // Validasi setiap item barang
            foreach ($request->items as $item) {
                $barang = Barang::findOrFail($item['barang_id']);
                
                // Validasi dapat dipinjam
                if (!$barang->dapat_dipinjam) {
                    return back()->with('error', "Barang '{$barang->nama_barang}' tidak dapat dipinjam");
                }
                
                if ($barang->status !== 'tersedia') {
                    return back()->with('error', "Barang '{$barang->nama_barang}' tidak tersedia");
                }
            }

        // Update kop surat jika ada dengan auto-resize
        $kopSuratPath = $permohonan->kop_surat;
        if ($request->hasFile('kop_surat')) {
            // Hapus file lama
            if ($kopSuratPath) {
                Storage::disk('public')->delete($kopSuratPath);
            }

            // Upload file baru dengan auto-resize
            $file = $request->file('kop_surat');
            $filename = 'kop_surat_' . time() . '_' . uniqid() . '.jpg';
            
            // Buat direktori jika belum ada
            $kopDir = storage_path('app/public/dokumen/kop_surat');
            if (!file_exists($kopDir)) {
                mkdir($kopDir, 0755, true);
            }
            
            $fullPath = $kopDir . '/' . $filename;
            
            // Auto-resize ke ukuran standard: 1500x400px
            Image::make($file->getRealPath())
                ->fit(1500, 400, function ($constraint) {
                    $constraint->upsize();
                })
                ->save($fullPath, 85);
            
            $kopSuratPath = 'dokumen/kop_surat/' . $filename;
        }

            // Update permohonan
            $permohonan->update([
                'nama_instansi' => $request->nama_instansi,
                'jabatan' => $request->jabatan,
                'bidang_instansi' => $request->bidang_instansi,
                'alamat_instansi' => $request->alamat_instansi,
                'kop_surat' => $kopSuratPath,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'keperluan' => $request->keperluan,
            ]);

            // Hapus items lama dan buat yang baru
            $permohonan->items()->delete();
            foreach ($request->items as $item) {
                PermohonanItem::create([
                    'permohonan_id' => $permohonan->id,
                    'jenis_aset' => 'barang',
                    'aset_id' => $item['barang_id'],
                    'jumlah' => $item['jumlah'],
                ]);
            }

            // Regenerate draft surat jika ada perubahan
            $this->generateDraftSurat($permohonan);

            // Log aktivitas
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aksi' => 'Mengedit Permohonan',
                'detail' => "Mengedit permohonan ID: {$permohonan->id}",
            ]);

            DB::commit();

            return redirect()->route('permohonan.show', $permohonan)
                ->with('success', 'Permohonan berhasil diperbarui dan draft surat telah diupdate.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Permohonan $permohonan)
    {
        // User cuma bisa hapus permohonan yang masih dalam proses
        if ($permohonan->status !== 'Dalam Proses' || $permohonan->user_id !== Auth::id()) {
            return back()->with('error', 'Permohonan tidak dapat dihapus.');
        }

        // Hapus file kop surat
        if ($permohonan->kop_surat) {
            Storage::disk('public')->delete($permohonan->kop_surat);
        }

        // Hapus draft surat jika ada
        if ($permohonan->draft_surat) {
            Storage::disk('public')->delete($permohonan->draft_surat);
        }

        // Items akan auto-delete karena cascade
        $permohonan->delete();

        return redirect()->route('permohonan.index')
            ->with('success', 'Permohonan berhasil dibatalkan.');
    }

    // FUNGSI BARU: Download draft surat
public function downloadDraft(Permohonan $permohonan)
{
    try {
        // Pastikan user cuma bisa download permohonannya sendiri
        if (Auth::user()->role === 'user' && $permohonan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mendownload draft surat ini.');
        }

        // Check apakah draft surat ada
        if (!$permohonan->draft_surat) {
            return back()->with('error', 'Draft surat belum dibuat untuk permohonan ini.');
        }

        // Check apakah file exists di storage
        if (!Storage::disk('public')->exists($permohonan->draft_surat)) {
            \Log::error('Draft surat file not found: ' . $permohonan->draft_surat . ' for permohonan: ' . $permohonan->id);
            return back()->with('error', 'File draft surat tidak ditemukan. Silakan hubungi admin.');
        }

        // Get full path untuk additional check
        $fullPath = storage_path('app/public/' . $permohonan->draft_surat);
        if (!file_exists($fullPath)) {
            \Log::error('Draft surat file not found at full path: ' . $fullPath);
            return back()->with('error', 'File draft surat tidak dapat diakses.');
        }

        // Check file size (RTF files are typically smaller than DOCX)
        $fileSize = filesize($fullPath);
        if ($fileSize === false || $fileSize < 500) {  // Lower threshold for RTF
            \Log::error('Draft surat file size is suspicious: ' . $fileSize . ' bytes for file: ' . $fullPath);
            return back()->with('error', 'File draft surat bermasalah. Silakan generate ulang atau hubungi admin.');
        }

        // Sanitize no_permohonan untuk filename download
        $cleanNoPermohonan = str_replace(
            ['/', '\\', ':', '*', '?', '"', '<', '>', '|', ' '], 
            ['_', '_', '_', '_', '_', '_', '_', '_', '_', '_'], 
            $permohonan->no_permohonan
        );

        // Buat filename yang aman untuk download - GANTI KE .rtf
        $downloadFilename = 'Draft_Surat_Permohonan_' . $cleanNoPermohonan . '.rtf';

        // Log download activity
        \Log::info('User ' . Auth::id() . ' downloading RTF draft surat for permohonan: ' . $permohonan->id . ' as filename: ' . $downloadFilename);

        // Download file dengan filename yang sudah di-sanitize
        return Storage::disk('public')->download($permohonan->draft_surat, $downloadFilename);

    } catch (\Exception $e) {
        \Log::error('Error downloading RTF draft surat for permohonan ' . $permohonan->id . ': ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        
        return back()->with('error', 'Terjadi kesalahan saat mendownload draft surat. Silakan coba lagi atau hubungi admin.');
    }
}
    // FUNGSI BARU: Upload surat yang sudah ditandatangani
    public function uploadSuratTtd(Request $request, Permohonan $permohonan)
    {
        // Pastuser cuma bisa upload untuk permohonannya sendiri
        if ($permohonan->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'surat_ttd' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120'
        ]);

        try {
            // Upload surat yang sudah ditandatangani
            $file = $request->file('surat_ttd');
            $filename = 'surat_ttd_' . $permohonan->no_permohonan . '_' . time() . '.' . $file->getClientOriginalExtension();
            $suratTtdPath = $file->storeAs('dokumen/surat_ttd', $filename, 'public');

            // Hapus file lama jika ada
            if ($permohonan->surat_permohonan) {
                Storage::disk('public')->delete($permohonan->surat_permohonan);
            }

            // Update permohonan
            $permohonan->update([
                'surat_permohonan' => $suratTtdPath
            ]);

            // Log aktivitas
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aksi' => 'Upload Surat Bertanda Tangan',
                'detail' => "Upload surat bertanda tangan untuk permohonan: {$permohonan->no_permohonan}",
            ]);

            return back()->with('success', 'Surat permohonan bertanda tangan berhasil diupload.');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal upload surat: ' . $e->getMessage());
        }
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES - REVIEW PERMOHONAN
    |--------------------------------------------------------------------------
    */

    public function adminIndex(Request $request)
    {
        $query = Permohonan::with(['user', 'items.barang']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_pemohon', 'LIKE', "%{$search}%")
                  ->orWhere('no_permohonan', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'LIKE', "%{$search}%")
                               ->orWhere('email', 'LIKE', "%{$search}%");
                  });
            });
        }

        $permohonan = $query->latest()->paginate(10);

        // Statistik untuk dashboard cards
        $stats = [
            'dalam_proses' => Permohonan::where('status', 'Dalam Proses')->count(),
            'disetujui' => Permohonan::where('status', 'Disetujui')->count(),
            'ditolak' => Permohonan::where('status', 'Ditolak')->count(),
            'total' => Permohonan::count()
        ];

        return view('admin.permohonan.index', compact('permohonan', 'stats'));
    }

    public function adminShow(Permohonan $permohonan)
    {
        // Load semua relasi yang dibutuhkan
        $permohonan->load([
            'user', 
            'items.barang.kategoriBarang',
            'peminjaman',
            'peminjaman.pembayaran',
            'peminjaman.dokumen'
        ]);

        // Hitung statistik user
        $userStats = [
            'total_permohonan' => Permohonan::where('user_id', $permohonan->user_id)->count(),
            'disetujui' => Permohonan::where('user_id', $permohonan->user_id)->where('status', 'Disetujui')->count(),
            'ditolak' => Permohonan::where('user_id', $permohonan->user_id)->where('status', 'Ditolak')->count(),
            'dalam_proses' => Permohonan::where('user_id', $permohonan->user_id)->where('status', 'Dalam Proses')->count(),
        ];

        // Estimasi biaya dari semua items
        $biayaInfo = $this->hitungEstimasiBiaya($permohonan);

        return view('admin.permohonan.show', compact('permohonan', 'userStats', 'biayaInfo'));
    }

    private function hitungEstimasiBiaya($permohonan)
    {
        $totalBiaya = $permohonan->total_biaya;
        $gratis = $totalBiaya == 0;
        
        return [
            'biaya' => $totalBiaya,
            'gratis' => $gratis,
            'formatted' => $gratis ? 'GRATIS' : 'Rp ' . number_format($totalBiaya, 0, ',', '.')
        ];
    }

    public function approve(Permohonan $permohonan)
    {
        if ($permohonan->status !== 'Dalam Proses') {
            return back()->with('error', 'Permohonan tidak dapat disetujui.');
        }

        DB::beginTransaction();
        try {
            // Update status permohonan
            $permohonan->update(['status' => 'Disetujui']);

            // Auto create peminjaman dari permohonan (untuk setiap item)
            $this->createPeminjamanFromPermohonan($permohonan);

            // Log aktivitas
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aksi' => 'Menyetujui Permohonan',
                'detail' => "Menyetujui permohonan ID: {$permohonan->id} dari user: {$permohonan->user->name}",
            ]);

            NotificationService::permohonanDisetujui($permohonan);

            DB::commit();

            return back()->with('success', 'Permohonan berhasil disetujui dan peminjaman telah dibuat.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, Permohonan $permohonan)
    {
        if ($permohonan->status !== 'Dalam Proses') {
            return back()->with('error', 'Permohonan tidak dapat ditolak.');
        }

        $request->validate([
            'alasan_penolakan' => 'required|string|min:10|max:500'
        ], [
            'alasan_penolakan.required' => 'Alasan penolakan wajib diisi.',
            'alasan_penolakan.min' => 'Alasan penolakan minimal 10 karakter.',
            'alasan_penolakan.max' => 'Alasan penolakan maksimal 500 karakter.'
        ]);

        // Update status permohonan
        $permohonan->update([
            'status' => 'Ditolak',
            'alasan_penolakan' => $request->alasan_penolakan // gunakan field ini untuk alasan
        ]);

        // Log aktivitas
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aksi' => 'Menolak Permohonan',
            'detail' => "Menolak permohonan ID: {$permohonan->id}. Alasan: {$request->alasan_penolakan}",
        ]);

        NotificationService::permohonanDitolak($permohonan);


        return back()->with('success', 'Permohonan berhasil ditolak.');
    }

    /*
    |--------------------------------------------------------------------------
    | PRIVATE METHODS
    |--------------------------------------------------------------------------
    */

private function generateNomorPermohonan()
{
    $tahun = date('Y');
    $bulan = date('m');

    // Jalankan di dalam transaksi agar aman
    return DB::transaction(function () use ($tahun, $bulan) {
        // Kunci baris terakhir untuk mencegah bentrok
        $last = DB::table('permohonan')
            ->whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->lockForUpdate()
            ->orderByDesc('id')
            ->first();

        $nextNumber = 1;
        if ($last) {
            $lastNumber = (int) substr($last->no_permohonan, -3);
            $nextNumber = $lastNumber + 1;
        }

        return sprintf('PRM/%s/%s/%03d', $tahun, $bulan, $nextNumber);
    });
}



    // FUNGSI BARU: Generate draft surat permohonan otomatis
private function generateDraftSurat(Permohonan $permohonan)
{
    try {
        // Log untuk debugging
        \Log::info('Starting draft generation for permohonan: ' . $permohonan->id);

        // Muat permohonan dengan relasi items dan barang
        $permohonan->load(['items.barang.kategoriBarang', 'user']);

        // Check apakah ada items
        if ($permohonan->items->isEmpty()) {
            \Log::error('No items found for permohonan: ' . $permohonan->id);
            return false;
        }

        // Buat instance PhpWord
        $phpWord = new PhpWord();
        
        // Set document properties untuk compatibility
        $phpWord->getDocInfo()
            ->setCreator('Pelita App')
            ->setCompany('Cimahi Technopark')
            ->setTitle('Draft Surat Permohonan')
            ->setDescription('Generated by Pelita Application');

        $section = $phpWord->addSection([
            'marginTop' => Converter::cmToTwip(2),
            'marginBottom' => Converter::cmToTwip(2),
            'marginLeft' => Converter::cmToTwip(3),
            'marginRight' => Converter::cmToTwip(2),
        ]);

        // Masukkan kop surat jika ada (SIMPLIFIED - karena sudah auto-resize)
        if ($permohonan->kop_surat && Storage::disk('public')->exists($permohonan->kop_surat)) {
            $kopPath = storage_path('app/public/' . $permohonan->kop_surat);
            if (file_exists($kopPath)) {
                try {
                    // Karena sudah di-resize, langsung pakai ukuran fixed yang pas
                    $section->addImage($kopPath, [
                        'width' => Converter::cmToTwip(8),
                        'height' => Converter::cmToTwip(4),
                        'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
                    ]);
                    $section->addTextBreak(2);
                } catch (\Exception $imgError) {
                    \Log::warning('Failed to add kop surat image: ' . $imgError->getMessage());
                    // Fallback text
                    $section->addText(
                        strtoupper($permohonan->nama_instansi ?? $permohonan->user->instansi ?? 'INSTANSI'),
                        ['size' => 16, 'bold' => true],
                        ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 240]
                    );
                }
            }
        } else {
            // Fallback text header
            $section->addText(
                strtoupper($permohonan->nama_instansi ?? $permohonan->user->instansi ?? 'INSTANSI'),
                ['size' => 16, 'bold' => true],
                ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 240]
            );
        }

        // Tambah garis horizontal setelah header
        $section->addLine([
            'weight' => 1,
            'width' => Converter::cmToTwip(19),
            'height' => 0,
            'positioning' => 'absolute'
        ]);
        $section->addTextBreak(1);

        // Header surat
        $section->addText('Nomor : ___________________', ['size' => 12], ['spaceAfter' => 120]);
        $section->addText('Sifat : Biasa', ['size' => 12], ['spaceAfter' => 120]);
        $section->addText('Lampiran : ___________________', ['size' => 12], ['spaceAfter' => 120]);
        $section->addText('Hal : Permohonan Peminjaman Barang', ['size' => 12, 'bold' => true], ['spaceAfter' => 360]);

        $section->addText('Yth. Kepala Dinas Perdagangan Koperasi UKM dan Perindustrian', ['size' => 12], ['spaceAfter' => 0]);
        $section->addText('di', ['size' => 12], ['spaceAfter' => 0]);
        $section->addText('Cimahi', ['size' => 12], ['spaceAfter' => 240]);

        // Isi surat dengan data dari permohonan
        $keperluan = $permohonan->keperluan ?? 'Keperluan kegiatan instansi';
        
        $section->addText(
            "Sehubungan dengan akan dilaksanakan kegiatan {$keperluan}, kami bermaksud meminjam barang milik Cimahi Technopark sebagai berikut:",
            ['size' => 12], 
            ['spaceAfter' => 240, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH]
        );

        // LIST BARANG (bukan tabel)
        $no = 1;
        foreach ($permohonan->items as $item) {
            // Format: 1. Nama Barang (Kategori) sejumlah X unit
            $listText = $no . '. ' . $item->barang->nama_barang;
            
            // Tambah kategori dalam kurung jika ada
            if ($item->barang->kategoriBarang) {
                $listText .= ' (' . $item->barang->kategoriBarang->nama_kategori . ')';
            }
            
            // Tambah jumlah
            $listText .= ' sejumlah ' . $item->jumlah . ' unit';
            
            $section->addText($listText, ['size' => 12], [
                'spaceAfter' => 120,
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH,
                'indentation' => ['left' => 360] // Indent untuk list
            ]);
            
            $no++;
        }

        $section->addTextBreak(2);

        // Penutup surat
        $section->addText(
            'Demikian kami sampaikan, atas perhatian dan kerja samanya kami ucapkan terima kasih.',
            ['size' => 12], 
            ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::BOTH, 'spaceAfter' => 480]
        );

        // Tanda tangan
        $section->addText('Cimahi, ' . Carbon::now()->locale('id')->translatedFormat('d F Y'), ['size' => 12], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END]);
        $section->addText($permohonan->nama_instansi ?? $permohonan->user->instansi ?? 'Instansi', ['size' => 12], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END]);
        
        $section->addTextBreak(7);
        
        $section->addText($permohonan->nama_pemohon, ['size' => 12, 'bold' => true], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END]);
        $section->addText($permohonan->jabatan ?? 'Pemohon', ['size' => 12], ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::END]);

        // Buat direktori jika belum ada
        $draftDir = 'dokumen/draft_surat';
        if (!Storage::disk('public')->exists($draftDir)) {
            Storage::disk('public')->makeDirectory($draftDir);
            \Log::info('Created directory: ' . $draftDir);
        }

        // Sanitize filename - GANTI EKSTENSI KE .rtf
        $cleanNoPermohonan = str_replace(['/', '\\', ':', '*', '?', '"', '<', '>', '|'], '_', $permohonan->no_permohonan);
        $filename = 'draft_surat_' . $cleanNoPermohonan . '_' . time() . '.rtf';  // CHANGE: .docx to .rtf
        $filepath = $draftDir . '/' . $filename;
        $fullPath = storage_path('app/public/' . $filepath);
        
        // Pastikan parent directory writable
        $parentDir = dirname($fullPath);
        if (!is_dir($parentDir)) {
            mkdir($parentDir, 0755, true);
            \Log::info('Created parent directory: ' . $parentDir);
        }

        \Log::info('Attempting to save RTF file to: ' . $fullPath);
        
        // Save dokumen sebagai RTF
        $objWriter = IOFactory::createWriter($phpWord, 'RTF');  // CHANGE: 'Word2007' to 'RTF'
        $objWriter->save($fullPath);

        // Verify file was created dan readable
        if (!file_exists($fullPath)) {
            \Log::error('RTF file was not created: ' . $fullPath);
            return false;
        }

        if (!is_readable($fullPath)) {
            \Log::error('RTF file is not readable: ' . $fullPath);
            return false;
        }

        $fileSize = filesize($fullPath);
        if ($fileSize === false || $fileSize < 500) {  // RTF files are smaller, so lower threshold
            \Log::error('RTF file size is suspicious: ' . $fileSize . ' bytes for file: ' . $fullPath);
            return false;
        }

        \Log::info('RTF file created successfully: ' . $fullPath . ' (Size: ' . $fileSize . ' bytes)');

        // Hapus draft lama jika ada
        if ($permohonan->draft_surat && Storage::disk('public')->exists($permohonan->draft_surat)) {
            Storage::disk('public')->delete($permohonan->draft_surat);
            \Log::info('Deleted old draft: ' . $permohonan->draft_surat);
        }

        // Update permohonan dengan path draft surat
        $updateResult = $permohonan->update(['draft_surat' => $filepath]);
        
        if (!$updateResult) {
            \Log::error('Failed to update draft_surat field in database for permohonan: ' . $permohonan->id);
            return false;
        }

        \Log::info('Updated permohonan with draft_surat path: ' . $filepath);

        // Verify update berhasil
        $permohonan->refresh();
        if (empty($permohonan->draft_surat)) {
            \Log::error('Database update verification failed - draft_surat field is still empty');
            return false;
        }

        // Final check - file masih ada setelah database update
        if (!Storage::disk('public')->exists($permohonan->draft_surat)) {
            \Log::error('RTF file disappeared after database update: ' . $permohonan->draft_surat);
            return false;
        }

        \Log::info('RTF draft generation completed successfully for permohonan: ' . $permohonan->id);
        return true;

    } catch (\Exception $e) {
        \Log::error('Error generating RTF draft surat for permohonan ' . $permohonan->id . ': ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        return false;
    }
}

private function createPeminjamanFromPermohonan(Permohonan $permohonan)
{
    // AMBIL DATA LANGSUNG DARI PERMOHONAN (bukan dari session)
    $tanggalMulai = Carbon::parse($permohonan->tanggal_mulai);
    $tanggalSelesai = Carbon::parse($permohonan->tanggal_selesai);
    $keperluan = $permohonan->keperluan;
    
    // Hitung durasi peminjaman
    $durasi = $tanggalMulai->diffInDays($tanggalSelesai) + 1;
    
    // Hitung total biaya dari semua items
    $totalBiaya = 0;
    foreach ($permohonan->items as $item) {
        $subtotal = $item->barang->harga_sewa * $item->jumlah * $durasi;
        $totalBiaya += $subtotal;
    }

    // Buat peminjaman utama (ambil barang pertama sebagai aset_id utama)
    $firstItem = $permohonan->items->first();
    
    $peminjaman = Peminjaman::create([
        'user_id' => $permohonan->user_id,
        'permohonan_id' => $permohonan->id,
        'jenis_aset' => 'barang',
        'aset_id' => $firstItem->aset_id, // barang pertama
        'tanggal_mulai' => $tanggalMulai,
        'tanggal_selesai' => $tanggalSelesai,
        'keperluan' => $keperluan,
        'status' => 'menunggu', // Admin masih perlu approve peminjaman
        'biaya' => $totalBiaya,
    ]);

    // Buat pembayaran
    Pembayaran::create([
        'peminjaman_id' => $peminjaman->id,
        'jumlah' => $totalBiaya,
        'status' => $totalBiaya > 0 ? 'pending' : 'lunas',
        'metode' => $totalBiaya > 0 ? null : 'gratis',
    ]);

    // Buat detail peminjaman untuk setiap item
    foreach ($permohonan->items as $item) {
        $subtotalPerItem = $item->barang->harga_sewa * $item->jumlah * $durasi;
        
        PeminjamanDetail::create([
            'peminjaman_id' => $peminjaman->id,
            'barang_id' => $item->aset_id,
            'jumlah' => $item->jumlah,
            'harga_satuan' => $item->barang->harga_sewa,
            'subtotal' => $subtotalPerItem,
        ]);
    }

    return $peminjaman;
}
    public function export(Request $request)
    {
        $filename = 'permohonan_export_' . date('Y-m-d_H-i-s') . '.xlsx';
        
        return Excel::download(new PermohonanExport($request->all()), $filename);
    }
    /**
 * Method untuk view/preview surat yang sudah di-TTD
 * User: untuk melihat surat yang mereka upload
 * Admin: untuk melihat dan download surat (keperluan arsip)
 */
public function viewSuratTtd(Permohonan $permohonan)
{
    try {
        // Pastikan user cuma bisa lihat permohonannya sendiri (kecuali admin)
        if (Auth::user()->role === 'user' && $permohonan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk melihat surat ini.');
        }

        // Check apakah surat permohonan sudah diupload
        if (!$permohonan->surat_permohonan) {
            return back()->with('error', 'Surat permohonan belum diupload.');
        }

        // Check apakah file exists di storage
        if (!Storage::disk('public')->exists($permohonan->surat_permohonan)) {
            \Log::error('Surat permohonan file not found: ' . $permohonan->surat_permohonan . ' for permohonan: ' . $permohonan->id);
            return back()->with('error', 'File surat permohonan tidak ditemukan.');
        }

        // Get full path
        $fullPath = storage_path('app/public/' . $permohonan->surat_permohonan);
        
        if (!file_exists($fullPath)) {
            \Log::error('Surat permohonan file not found at full path: ' . $fullPath);
            return back()->with('error', 'File surat permohonan tidak dapat diakses.');
        }

        // Sanitize filename untuk download
        $cleanNoPermohonan = str_replace(
            ['/', '\\', ':', '*', '?', '"', '<', '>', '|', ' '], 
            ['_', '_', '_', '_', '_', '_', '_', '_', '_', '_'], 
            $permohonan->no_permohonan
        );

        // Get file extension
        $extension = pathinfo($permohonan->surat_permohonan, PATHINFO_EXTENSION);
        
        // Buat filename yang aman
        $downloadFilename = 'Surat_Permohonan_TTD_' . $cleanNoPermohonan . '.' . $extension;

        // Log activity
        \Log::info('User ' . Auth::id() . ' viewing surat TTD for permohonan: ' . $permohonan->id);

        // Return file untuk di-view inline di browser
        return response()->file($fullPath, [
            'Content-Type' => Storage::disk('public')->mimeType($permohonan->surat_permohonan),
            'Content-Disposition' => 'inline; filename="' . $downloadFilename . '"'
        ]);

    } catch (\Exception $e) {
        \Log::error('Error viewing surat TTD for permohonan ' . $permohonan->id . ': ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        
        return back()->with('error', 'Terjadi kesalahan saat membuka surat permohonan.');
    }
}

/**
 * Method untuk download surat TTD (KHUSUS ADMIN - untuk keperluan arsip)
 */
public function downloadSuratTtd(Permohonan $permohonan)
{
    try {
        // Hanya admin yang bisa download (user tidak perlu karena mereka sudah punya file asli)
        if (Auth::user()->role === 'user') {
            abort(403, 'Akses ditolak. Anda sudah memiliki file surat asli.');
        }

        // Check apakah surat permohonan sudah diupload
        if (!$permohonan->surat_permohonan) {
            return back()->with('error', 'Surat permohonan belum diupload.');
        }

        // Check apakah file exists
        if (!Storage::disk('public')->exists($permohonan->surat_permohonan)) {
            return back()->with('error', 'File surat permohonan tidak ditemukan.');
        }

        // Sanitize filename
        $cleanNoPermohonan = str_replace(
            ['/', '\\', ':', '*', '?', '"', '<', '>', '|', ' '], 
            ['_', '_', '_', '_', '_', '_', '_', '_', '_', '_'], 
            $permohonan->no_permohonan
        );

        // Get file extension
        $extension = pathinfo($permohonan->surat_permohonan, PATHINFO_EXTENSION);
        
        // Buat filename yang aman
        $downloadFilename = 'Surat_Permohonan_TTD_' . $cleanNoPermohonan . '.' . $extension;

        // Log download activity (admin)
        \Log::info('Admin ' . Auth::id() . ' downloading surat TTD for permohonan: ' . $permohonan->id);
        
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aksi' => 'Download Surat TTD',
            'detail' => "Admin mendownload surat permohonan TTD untuk permohonan: {$permohonan->no_permohonan}",
        ]);

        // Download file
        return Storage::disk('public')->download($permohonan->surat_permohonan, $downloadFilename);

    } catch (\Exception $e) {
        \Log::error('Error downloading surat TTD for permohonan ' . $permohonan->id . ': ' . $e->getMessage());
        
        return back()->with('error', 'Terjadi kesalahan saat mendownload surat permohonan.');
    }
}
}