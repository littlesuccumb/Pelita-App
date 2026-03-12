<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Barang;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Exports\MaintenanceExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\KategoriBarang;
use Carbon\Carbon;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of maintenance records
     */
    public function index(Request $request)
    {
        $this->autoUpdateScheduledMaintenance();
        $query = Maintenance::with(['barang.kategori']);

        // ✅ PERBAIKAN: Filter by status (default: semua)
        $status = $request->get('status', 'all');
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        // ✅ PERBAIKAN: Filter by jenis maintenance
        if ($request->filled('jenis_maintenance')) {
            $query->where('jenis_maintenance', $request->jenis_maintenance);
        }

        // Filter by date range
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('deskripsi', 'LIKE', "%{$search}%")
                  ->orWhere('teknisi', 'LIKE', "%{$search}%")
                  ->orWhere('jenis_maintenance', 'LIKE', "%{$search}%")
                  ->orWhereHas('barang', function($subQ) use ($search) {
                      $subQ->where('nama_barang', 'LIKE', "%{$search}%")
                           ->orWhere('kode_barang', 'LIKE', "%{$search}%");
                  });
            });
        }

        // Sort
        $sortBy = $request->get('sort', 'tanggal');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $maintenance = $query->paginate(15)->appends($request->except('page'));

        // ✅ TAMBAHAN: Statistics untuk header
        $stats = [
            'total' => Maintenance::count(),
            'aktif' => Maintenance::whereIn('status', ['dijadwalkan', 'dalam_proses'])->count(),
            'selesai' => Maintenance::where('status', 'selesai')->count(),
            'dibatalkan' => Maintenance::where('status', 'dibatalkan')->count(),
            'total_biaya' => Maintenance::where('status', 'selesai')->sum('biaya'),
            'total_unit_maintenance' => Maintenance::whereIn('status', ['dijadwalkan', 'dalam_proses'])->sum('jumlah'),
            'dijadwalkan' => Maintenance::where('status', 'dijadwalkan')->count(),
            'dalam_proses' => Maintenance::where('status', 'dalam_proses')->count(),
        ];

        return view('admin.maintenance.index', compact('maintenance', 'stats', 'status'));
    }

    
    /**
     * Show the form for creating a new maintenance
     */
    public function create(Request $request)
    {
        $query = Barang::with(['kategori', 'fotoPrimary'])
            ->where('jumlah_tersedia', '>', 0);
        
        // Filter by kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }
        
        // Filter by kondisi
        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_barang', 'LIKE', "%{$search}%")
                ->orWhere('kode_barang', 'LIKE', "%{$search}%")
                ->orWhere('merk', 'LIKE', "%{$search}%");
            });
        }
        
        // Sort
        $sortBy = $request->get('sort', 'nama_barang');
        $sortOrder = $request->get('order', 'asc');
        $query->orderBy($sortBy, $sortOrder);
        
        // Pagination
        $perPage = $request->get('per_page', 12); // Default 12 items per page
        $barangs = $query->paginate($perPage)->appends($request->except('page'));
        
        // Get all barang for JavaScript (only basic data)
        $allBarangs = Barang::where('jumlah_tersedia', '>', 0)
            ->select('id', 'kode_barang', 'nama_barang', 'kategori_id', 'kondisi', 'jumlah_tersedia', 'jumlah_total', 'merk')
            ->with('kategori:id,nama_kategori')
            ->get();
        
        $barangData = $allBarangs->mapWithKeys(function($item) {
            return [
                $item->id => [
                    'kode' => $item->kode_barang,
                    'nama' => $item->nama_barang,
                    'kategori' => optional($item->kategori)->nama_kategori ?? '-',
                    'kondisi' => $item->kondisi,
                    'jumlah_tersedia' => $item->jumlah_tersedia ?? 0,
                    'jumlah_total' => $item->jumlah_total ?? 0,
                    'merk' => $item->merk ?? '-',
                ]
            ];
        });
        
        // Get categories for filter
        $kategoris = \App\Models\KategoriBarang::orderBy('nama_kategori')->get();
        
        // Statistics
        $stats = [
            'total_barang' => Barang::where('jumlah_tersedia', '>', 0)->count(),
            'total_unit' => Barang::where('jumlah_tersedia', '>', 0)->sum('jumlah_tersedia'),
            'kategori_count' => $kategoris->count(),
        ];
        
        return view('admin.maintenance.create', compact('barangs', 'barangData', 'kategoris', 'stats'));
    }

        /**
     * Store a newly created maintenance
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|integer|exists:barang,id',
            'jenis_maintenance' => 'required|in:preventif,korektif,emergency',
            'tanggal_maintenance' => 'required|date|after_or_equal:today',
            'jumlah' => 'required|integer|min:1',
            'deskripsi_masalah' => 'required|string|max:1000',
            'tindakan' => 'required|string|max:1000',
            'teknisi' => 'nullable|string|max:255',
            'biaya' => 'nullable|numeric|min:0',
            'status' => 'required|in:dijadwalkan,dalam_proses,selesai,dibatalkan',
            'catatan' => 'nullable|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            $barang = Barang::findOrFail($request->barang_id);
            $jumlahMaintenance = $request->jumlah;
            
            // ✅ FIX: Gunakan Carbon untuk parsing tanggal
            $tanggalMaintenance = Carbon::parse($request->tanggal_maintenance)->startOfDay();
            $today = Carbon::today();
            
            $status = $request->status;
            
            // ✅ FIX: Logika status yang lebih robust
            if ($tanggalMaintenance->isSameDay($today)) {
                // Hari ini: default dalam_proses kecuali user pilih selesai/dibatalkan
                if (!in_array($status, ['selesai', 'dibatalkan'])) {
                    $status = 'dalam_proses';
                }
            } elseif ($tanggalMaintenance->isFuture()) {
                // Masa depan: HARUS dijadwalkan (tidak boleh status lain)
                $status = 'dijadwalkan';
            } else {
                // ⚠️ CASE INI SEHARUSNYA TIDAK TERJADI karena validasi after_or_equal:today
                // Tapi kita handle untuk safety
                return back()
                    ->with('error', 'Tanggal maintenance tidak valid!')
                    ->withInput();
            }

            // ✅ FIX: Validasi stok SEBELUM create maintenance
            $shouldReduceStock = false;
            
            if ($status === 'dijadwalkan' && $tanggalMaintenance->isFuture()) {
                // Dijadwalkan di masa depan: TIDAK kurangi stok
                $shouldReduceStock = false;
            } elseif (in_array($status, ['dalam_proses', 'selesai'])) {
                // Aktif: HARUS kurangi stok
                $shouldReduceStock = true;
                
                // ✅ VALIDASI STOK DI SINI!
                if ($barang->jumlah_tersedia < $jumlahMaintenance) {
                    return back()
                        ->with('error', "Stok tidak mencukupi! Tersedia: {$barang->jumlah_tersedia} unit, diminta: {$jumlahMaintenance} unit")
                        ->withInput();
                }
            }

            // Gabungkan deskripsi
            $deskripsiLengkap = "MASALAH: " . $request->deskripsi_masalah . 
                            "\n\nTINDAKAN: " . $request->tindakan;
            
            if ($request->filled('catatan')) {
                $deskripsiLengkap .= "\n\nCATATAN: " . $request->catatan;
            }

            // Create maintenance record
            $maintenance = Maintenance::create([
                'jenis_aset' => 'barang',
                'aset_id' => $request->barang_id,
                'jenis_maintenance' => $request->jenis_maintenance,
                'tanggal' => $tanggalMaintenance,
                'jumlah' => $jumlahMaintenance,
                'deskripsi' => $deskripsiLengkap,
                'biaya' => $request->biaya ?? 0,
                'teknisi' => $request->teknisi,
                'status' => $status,
            ]);

            // Update stok jika perlu
            if ($shouldReduceStock) {
                $barang->jumlah_tersedia -= $jumlahMaintenance;
                $barang->jumlah_maintenance += $jumlahMaintenance;

                // Update status barang
                if ($barang->jumlah_tersedia == 0) {
                    $barang->status = 'maintenance';
                }
                // ❌ HAPUS bagian 'sebagian_maintenance' ini:
                // elseif ($barang->jumlah_maintenance > 0) {
                //     $barang->status = 'sebagian_maintenance';
                // }
                
                $barang->save();
            }

            // Log aktivitas
            $statusText = match($status) {
                'dijadwalkan' => 'dijadwalkan untuk ' . $tanggalMaintenance->format('d/m/Y'),
                'dalam_proses' => 'sedang dalam proses',
                'selesai' => 'selesai',
                'dibatalkan' => 'dibatalkan',
                default => $status
            };
                
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aksi' => 'Menambah Maintenance',
                'detail' => "Menambahkan maintenance {$request->jenis_maintenance} untuk {$jumlahMaintenance} unit barang: {$barang->nama_barang} ({$barang->kode_barang}) - Status: {$statusText}",
            ]);

            DB::commit();

            // Pesan sukses
            $message = match($status) {
                'dijadwalkan' => "Maintenance untuk {$jumlahMaintenance} unit berhasil dijadwalkan untuk tanggal " . $tanggalMaintenance->format('d/m/Y'),
                'dalam_proses' => "Maintenance untuk {$jumlahMaintenance} unit berhasil dimulai!",
                'selesai' => "Maintenance untuk {$jumlahMaintenance} unit berhasil diselesaikan!",
                'dibatalkan' => "Maintenance untuk {$jumlahMaintenance} unit dibatalkan.",
                default => "Maintenance berhasil disimpan!"
            };

            return redirect()->route('admin.maintenance.index')
                ->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error maintenance store: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified maintenance
     */
    public function show(Maintenance $maintenance)
    {
        $maintenance->load(['barang.kategori', 'barang.fotoPrimary']);
        
        // ✅ TAMBAHAN: History maintenance untuk barang yang sama
        $historyMaintenance = Maintenance::where('aset_id', $maintenance->aset_id)
            ->where('id', '!=', $maintenance->id)
            ->where('status', 'selesai')
            ->latest()
            ->limit(5)
            ->get();
        
        return view('admin.maintenance.show', compact('maintenance', 'historyMaintenance'));
    }

    /**
     * Show the form for editing maintenance
     */
    public function edit(Maintenance $maintenance)
    {
        // ✅ PERBAIKAN: Include barang yang sedang di-maintenance ini
        $barangs = Barang::with('kategori')
            ->where(function($query) use ($maintenance) {
                $query->where('jumlah_tersedia', '>', 0)
                      ->orWhere('id', $maintenance->aset_id);
            })
            ->orderBy('nama_barang')
            ->get();
        
        $barangData = $barangs->mapWithKeys(function($item) use ($maintenance) {
            $jumlahTersediaAdjusted = $item->jumlah_tersedia;
            
            // Jika ini barang yang sama dengan maintenance, tambahkan jumlah yang sedang di-maintenance
            if ($item->id == $maintenance->aset_id) {
                $jumlahTersediaAdjusted += ($maintenance->jumlah ?? 1);
            }
            
            return [
                $item->id => [
                    'kode' => $item->kode_barang,
                    'nama' => $item->nama_barang,
                    'kategori' => optional($item->kategori)->nama_kategori ?? '-',
                    'kondisi' => $item->kondisi,
                    'jumlah_tersedia' => $jumlahTersediaAdjusted,
                    'jumlah_total' => $item->jumlah_total ?? 0,
                ]
            ];
        });
        
        return view('admin.maintenance.edit', compact('maintenance', 'barangs', 'barangData'));
    }

    /**
     * Update the specified maintenance
     */
        public function update(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'aset_id' => 'required|integer|exists:barang,id',
            'jenis_maintenance' => 'required|in:preventif,korektif,emergency',
            'tanggal' => 'required|date|after_or_equal:today',
            'jumlah' => 'required|integer|min:1',
            'deskripsi' => 'required|string',
            'biaya' => 'required|numeric|min:0',
            'teknisi' => 'nullable|string|max:255',
            'status' => 'required|in:dijadwalkan,dalam_proses,selesai,dibatalkan',
            'catatan_penyelesaian' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $oldBarang = $maintenance->barang;
            $newBarang = Barang::findOrFail($request->aset_id);
            $oldJumlah = $maintenance->jumlah ?? 1;
            $newJumlah = $request->jumlah;
            $oldStatus = $maintenance->status;
            $newStatus = $request->status;
            
            // ✅ FIX: Parse tanggal dengan Carbon
            $tanggalMaintenance = Carbon::parse($request->tanggal)->startOfDay();
            $oldTanggal = Carbon::parse($maintenance->tanggal)->startOfDay();
            $today = Carbon::today();
            
            // Auto-adjust status berdasarkan tanggal
            if ($tanggalMaintenance->isSameDay($today)) {
                if (!in_array($newStatus, ['selesai', 'dibatalkan'])) {
                    $newStatus = 'dalam_proses';
                }
            } elseif ($tanggalMaintenance->isFuture()) {
                if ($newStatus !== 'dibatalkan') {
                    $newStatus = 'dijadwalkan';
                }
            }

            // ✅ FIX: Handle perubahan stok dengan lebih hati-hati
            $needsStockAdjustment = (
                $oldBarang->id !== $newBarang->id || 
                $oldJumlah !== $newJumlah || 
                $oldStatus !== $newStatus ||
                !$oldTanggal->isSameDay($tanggalMaintenance) // ✅ TAMBAH: Deteksi perubahan tanggal
            );

            if ($needsStockAdjustment) {
                // 1. Kembalikan stok barang lama (jika sudah dikurangi)
                $oldWasActive = in_array($oldStatus, ['dalam_proses', 'selesai']) || 
                            ($oldStatus === 'dijadwalkan' && $oldTanggal->isPast());
                
                if ($oldWasActive && $oldBarang) {
                    $oldBarang->jumlah_tersedia += $oldJumlah;
                    $oldBarang->jumlah_maintenance -= $oldJumlah;
                    
                    if ($oldBarang->jumlah_maintenance <= 0) {
                        $oldBarang->status = 'tersedia';
                    }
                    $oldBarang->save();
                }

                // 2. Kurangi stok barang baru (jika perlu)
                $newShouldReduceStock = in_array($newStatus, ['dalam_proses', 'selesai']) ||
                                    ($newStatus === 'dijadwalkan' && $tanggalMaintenance->isPast());
                
                if ($newShouldReduceStock) {
                    // ✅ VALIDASI STOK
                    if ($newBarang->jumlah_tersedia < $newJumlah) {
                        DB::rollBack();
                        return back()
                            ->with('error', "Stok tidak mencukupi! Tersedia: {$newBarang->jumlah_tersedia} unit")
                            ->withInput();
                    }

                    $newBarang->jumlah_tersedia -= $newJumlah;
                    $newBarang->jumlah_maintenance += $newJumlah;
                    
                    if ($newBarang->jumlah_tersedia == 0) {
                        $newBarang->status = 'maintenance';
                    }
                    $newBarang->save();
                }
            }

            // Update maintenance record
            $updateData = [
                'aset_id' => $request->aset_id,
                'jenis_maintenance' => $request->jenis_maintenance,
                'tanggal' => $tanggalMaintenance,
                'jumlah' => $newJumlah,
                'deskripsi' => $request->deskripsi,
                'biaya' => $request->biaya,
                'teknisi' => $request->teknisi,
                'status' => $newStatus,
            ];

            // Set tanggal selesai jika status berubah ke selesai
            if ($newStatus === 'selesai' && $oldStatus !== 'selesai') {
                $updateData['tanggal_selesai'] = now();
            }

            if ($request->filled('catatan_penyelesaian')) {
                $updateData['catatan_penyelesaian'] = $request->catatan_penyelesaian;
            }

            $maintenance->update($updateData);

            // Log aktivitas
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aksi' => 'Mengubah Maintenance',
                'detail' => "Mengubah data maintenance untuk {$newJumlah} unit barang: {$newBarang->nama_barang} ({$newBarang->kode_barang}) - Status: {$newStatus}",
            ]);

            DB::commit();

            return redirect()->route('admin.maintenance.index')
                ->with('success', 'Data maintenance berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error maintenance update: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

        /**
     * Remove the specified maintenance
     */
    public function destroy(Maintenance $maintenance)
    {
        try {
            DB::beginTransaction();

            // ✅ PERBAIKAN: Cek apakah barang masih ada
            $barang = $maintenance->barang;
            $jumlahMaintenance = $maintenance->jumlah ?? 1;
            $status = $maintenance->status;

            // Simpan info untuk log sebelum dihapus
            $namaBarang = $barang ? $barang->nama_barang : 'Barang Terhapus';
            $kodeBarang = $barang ? $barang->kode_barang : 'N/A';

            // ✅ PERBAIKAN: Hanya update stok jika barang masih ada dan maintenance masih aktif
            if ($barang && in_array($status, ['dijadwalkan', 'dalam_proses'])) {
                $barang->jumlah_tersedia += $jumlahMaintenance;
                $barang->jumlah_maintenance -= $jumlahMaintenance;

                // Update status barang
                if ($barang->jumlah_maintenance == 0) {
                    $barang->status = 'tersedia';
                }
                
                $barang->save();
            }

            // Delete maintenance record
            $maintenance->delete();

            // Log aktivitas
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aksi' => 'Menghapus Maintenance',
                'detail' => "Menghapus data maintenance {$jumlahMaintenance} unit untuk barang: {$namaBarang} ({$kodeBarang})",
            ]);

            DB::commit();

            return redirect()->route('admin.maintenance.index')
                ->with('success', "Data maintenance untuk {$jumlahMaintenance} unit berhasil dihapus.");

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error maintenance destroy: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Complete maintenance - mengembalikan barang dari maintenance ke tersedia
     */
        public function complete(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'catatan_penyelesaian' => 'nullable|string',
            'kondisi_akhir' => 'required|in:baik,rusak ringan,rusak berat',
        ]);

        try {
            DB::beginTransaction();

            $barang = $maintenance->barang;
            
            if (!$barang) {
                return back()->with('error', 'Barang sudah tidak ada! Silakan hapus maintenance ini.');
            }

            $jumlahMaintenance = $maintenance->jumlah ?? 1;

            // ✅ FIX: Validasi lebih ketat
            if ($maintenance->status === 'selesai') {
                return back()->with('info', 'Maintenance ini sudah diselesaikan sebelumnya.');
            }

            if ($maintenance->status === 'dibatalkan') {
                return back()->with('error', 'Maintenance yang dibatalkan tidak dapat diselesaikan!');
            }

            // ✅ FIX: Handle jika maintenance dijadwalkan tapi belum waktunya
            $tanggalMaintenance = Carbon::parse($maintenance->tanggal)->startOfDay();
            if ($maintenance->status === 'dijadwalkan' && $tanggalMaintenance->isFuture()) {
                return back()->with('error', 'Maintenance belum bisa diselesaikan karena masih dijadwalkan untuk masa depan!');
            }

            // Update status maintenance
            $maintenance->status = 'selesai';
            $maintenance->tanggal_selesai = now();
            $maintenance->catatan_penyelesaian = $request->catatan_penyelesaian;
            $maintenance->save();

            // KEMBALIKAN STOK
            $barang->jumlah_tersedia += $jumlahMaintenance;
            $barang->jumlah_maintenance -= $jumlahMaintenance;
            $barang->kondisi = $request->kondisi_akhir;
            
            if ($barang->jumlah_maintenance <= 0) {
                $barang->status = 'tersedia';
            }
            
            $barang->save();

            // Log aktivitas
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aksi' => 'Menyelesaikan Maintenance',
                'detail' => "Menyelesaikan maintenance {$jumlahMaintenance} unit barang: {$barang->nama_barang} (Kode: {$barang->kode_barang}) - Kondisi Akhir: {$request->kondisi_akhir}",
            ]);

            DB::commit();

            return redirect()->route('admin.maintenance.index')
                ->with('success', "Maintenance untuk {$jumlahMaintenance} unit berhasil diselesaikan!");

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error completing maintenance: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    /**
         * ✅ TAMBAHAN BARU: Cancel maintenance
         */
        public function cancel(Request $request, Maintenance $maintenance)
        {
            $request->validate([
                'alasan' => 'required|string|max:500',
            ]);

            try {
                DB::beginTransaction();

                $barang = $maintenance->barang;
                
                // ✅ FIX: Validasi status lebih ketat
                if ($maintenance->status === 'selesai') {
                    return back()->with('error', 'Maintenance yang sudah selesai tidak dapat dibatalkan!');
                }

                if ($maintenance->status === 'dibatalkan') {
                    return back()->with('info', 'Maintenance ini sudah dibatalkan sebelumnya.');
                }

                $jumlahMaintenance = $maintenance->jumlah ?? 1;

                // Update status maintenance
                $maintenance->status = 'dibatalkan';
                $maintenance->catatan_penyelesaian = "DIBATALKAN: " . $request->alasan;
                $maintenance->tanggal_selesai = now();
                $maintenance->save();

                // KEMBALIKAN STOK (jika barang masih ada)
                if ($barang) {
                    // ✅ FIX: Hanya kembalikan stok jika sudah dikurangi
                    $tanggalMaintenance = Carbon::parse($maintenance->tanggal)->startOfDay();
                    $wasActive = in_array($maintenance->status, ['dalam_proses', 'selesai']) ||
                                ($maintenance->status === 'dijadwalkan' && $tanggalMaintenance->isPast());
                    
                    if ($wasActive) {
                        $barang->jumlah_tersedia += $jumlahMaintenance;
                        $barang->jumlah_maintenance -= $jumlahMaintenance;

                        if ($barang->jumlah_maintenance <= 0) {
                            $barang->status = 'tersedia';
                        }
                        
                        $barang->save();
                    }
                }

                // Log aktivitas
                $namaBarang = $barang ? $barang->nama_barang : 'Barang Terhapus';
                
                LogAktivitas::create([
                    'user_id' => Auth::id(),
                    'aksi' => 'Membatalkan Maintenance',
                    'detail' => "Membatalkan maintenance {$jumlahMaintenance} unit untuk barang: {$namaBarang}. Alasan: {$request->alasan}",
                ]);

                DB::commit();

                return redirect()->route('admin.maintenance.index')
                    ->with('success', "Maintenance berhasil dibatalkan!");

            } catch (\Exception $e) {
                DB::rollBack();
                \Log::error('Error canceling maintenance: ' . $e->getMessage());
                return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }
        /**
         * Export maintenance data to Excel or PDF
         */
        public function export(Request $request)
        {
            try {
                $format = $request->get('format', 'excel'); // excel atau pdf
                $filters = [
                    'status' => $request->get('status', 'all'),
                    'jenis_maintenance' => $request->get('jenis_maintenance'),
                    'tanggal_dari' => $request->get('tanggal_dari'),
                    'tanggal_sampai' => $request->get('tanggal_sampai'),
                    'search' => $request->get('search'),
                ];

                $filename = 'maintenance_' . date('Y-m-d_His');

                if ($format === 'pdf') {
                    return $this->exportPdf($filters, $filename);
                }

                // Default: Export to Excel
                return Excel::download(
                    new MaintenanceExport($filters), 
                    "{$filename}.xlsx"
                );

            } catch (\Exception $e) {
                \Log::error('Error exporting maintenance: ' . $e->getMessage());
                return back()->with('error', 'Gagal export data: ' . $e->getMessage());
            }
        }

        /**
         * Export to PDF
         */
        private function exportPdf($filters, $filename)
        {
            $query = Maintenance::with(['barang.kategori']);

            // Apply filters (sama seperti di MaintenanceExport)
            if ($filters['status'] !== 'all') {
                $query->where('status', $filters['status']);
            }

            if ($filters['jenis_maintenance']) {
                $query->where('jenis_maintenance', $filters['jenis_maintenance']);
            }

            if ($filters['tanggal_dari']) {
                $query->whereDate('tanggal', '>=', $filters['tanggal_dari']);
            }

            if ($filters['tanggal_sampai']) {
                $query->whereDate('tanggal', '<=', $filters['tanggal_sampai']);
            }

            if ($filters['search']) {
                $search = $filters['search'];
                $query->where(function ($q) use ($search) {
                    $q->where('deskripsi', 'LIKE', "%{$search}%")
                    ->orWhere('teknisi', 'LIKE', "%{$search}%")
                    ->orWhereHas('barang', function($subQ) use ($search) {
                        $subQ->where('nama_barang', 'LIKE', "%{$search}%")
                            ->orWhere('kode_barang', 'LIKE', "%{$search}%");
                    });
                });
            }

            $maintenance = $query->orderBy('tanggal', 'desc')->get();

            // Statistics
            $stats = [
                'total' => $maintenance->count(),
                'aktif' => $maintenance->whereIn('status', ['dijadwalkan', 'dalam_proses'])->count(),
                'selesai' => $maintenance->where('status', 'selesai')->count(),
                'total_biaya' => $maintenance->where('status', 'selesai')->sum('biaya'),
            ];

            $pdf = Pdf::loadView('admin.maintenance.pdf', compact('maintenance', 'stats', 'filters'))
                ->setPaper('a4', 'landscape')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'defaultFont' => 'sans-serif',
                ]);

            return $pdf->download("{$filename}.pdf");
        }


    /**
     * Auto-update scheduled maintenance yang sudah waktunya
     * Dipanggil setiap kali halaman index dibuka
     */
    private function autoUpdateScheduledMaintenance()
    {
        $today = Carbon::now()->startOfDay();
        
        // Ambil maintenance yang dijadwalkan dan sudah waktunya
        $scheduledMaintenance = Maintenance::where('status', 'dijadwalkan')
            ->with('barang')
            ->get()
            ->filter(function($maintenance) use ($today) {
                $tanggalMaintenance = Carbon::parse($maintenance->tanggal)->startOfDay();
                return $tanggalMaintenance->lte($today);
            });

        if ($scheduledMaintenance->isEmpty()) {
            return;
        }

        foreach ($scheduledMaintenance as $maintenance) {
            try {
                DB::beginTransaction();
                
                $barang = $maintenance->barang;
                
                // Skip jika barang tidak ada
                if (!$barang) {
                    $maintenance->status = 'dibatalkan';
                    $maintenance->catatan_penyelesaian = 'DIBATALKAN OTOMATIS: Barang sudah tidak ada';
                    $maintenance->tanggal_selesai = now();
                    $maintenance->save();
                    
                    DB::commit();
                    continue;
                }
                
                $jumlah = $maintenance->jumlah ?? 1;
                
                // Skip jika stok tidak mencukupi
                if ($barang->jumlah_tersedia < $jumlah) {
                    DB::rollBack();
                    continue;
                }
                
                // Update status maintenance
                $maintenance->status = 'dalam_proses';
                $maintenance->save();
                
                // Update stok barang
                $barang->jumlah_tersedia -= $jumlah;
                $barang->jumlah_maintenance += $jumlah;
                
                if ($barang->jumlah_tersedia == 0) {
                    $barang->status = 'maintenance';
                }
                
                $barang->save();
                
                // Log aktivitas
                LogAktivitas::create([
                    'user_id' => Auth::id() ?? 1,
                    'aksi' => 'Auto-Update Maintenance',
                    'detail' => "Maintenance otomatis dimulai untuk {$jumlah} unit barang: {$barang->nama_barang} ({$barang->kode_barang})",
                ]);
                
                DB::commit();
                
            } catch (\Exception $e) {
                DB::rollBack();
                \Log::error('Error auto-update maintenance ID ' . $maintenance->id . ': ' . $e->getMessage());
            }
        }
    }
}