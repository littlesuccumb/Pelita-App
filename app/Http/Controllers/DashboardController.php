<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\Permohonan;
use App\Models\PermohonanItem;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\LogAktivitas;
use App\Models\KategoriBarang;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'super_admin') {
            return $this->superAdminDashboard();
        } elseif ($user->role === 'admin') {
            return $this->adminDashboard();
        } elseif ($user->role === 'pengurus_aset') {
            return $this->pengurusAsetDashboard();
        } else {
            return $this->userDashboard();
        }
    }

private function superAdminDashboard()
{
    // Hitung total stok barang berdasarkan jumlah_tersedia
    $totalStokTersedia = Barang::where('status', 'tersedia')->sum('jumlah_tersedia');
    
    // Hitung barang dipinjam dari peminjaman aktif
    try {
        $barangDipinjam = Peminjaman::where('status', 'disetujui')
            ->where('jenis_aset', 'barang')
            ->distinct()
            ->count('aset_id');
    } catch (\Exception $e) {
        $barangDipinjam = Barang::where('status', 'dipinjam')->count();
    }
    
    // ✅ HANYA HITUNG MAINTENANCE DALAM PROSES
    $barangMaintenance = Maintenance::where('jenis_aset', 'barang')
        ->where('status', 'dalam_proses')
        ->sum('jumlah');
    
    $stats = [
        'total_barang' => $totalStokTersedia,
        'barang_tersedia' => Barang::where('status', 'tersedia')->sum('jumlah_tersedia'),
        'barang_dipinjam' => $barangDipinjam,
        'barang_maintenance' => $barangMaintenance, // ✅ CHANGED: hanya dalam_proses
        'total_users' => User::where('role', 'user')->count(),
        'total_admin' => User::whereIn('role', ['admin', 'pengurus_aset'])->count(),
        'total_permohonan' => Permohonan::count(),
        'permohonan_pending' => Permohonan::where('status', 'Dalam Proses')->count(),
        'total_peminjaman' => Peminjaman::count(),
        'peminjaman_pending' => Peminjaman::where('status', 'menunggu')->count(),
        'peminjaman_aktif' => Peminjaman::where('status', 'disetujui')->count(),
        'total_kategori' => KategoriBarang::count(),
        'total_maintenance' => Maintenance::count(),
    ];

    // Recent permohonan dengan items
    $recentPermohonan = Permohonan::with([
        'user:id,name,email',
        'permohonanItems.barang:id,nama_barang,kode_barang,kategori_id',
        'permohonanItems.barang.kategori:id,nama_kategori'
    ])
        ->latest()
        ->take(5)
        ->get();

    // Active peminjaman untuk tabel
    $activePeminjaman = Peminjaman::with([
        'user:id,name,email',
        'permohonan.permohonanItems.barang:id,nama_barang,kode_barang,kategori_id',
        'permohonan.permohonanItems.barang.kategori:id,nama_kategori'
    ])
        ->where('status', 'disetujui')
        ->latest()
        ->take(5)
        ->get();

    // Monthly stats untuk chart (Permohonan & Peminjaman)
    $currentYear = Carbon::now()->year;
    
    $permohonanMonthly = Permohonan::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->whereYear('created_at', $currentYear)
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('total', 'month')
        ->toArray();

    $peminjamanMonthly = Peminjaman::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->whereYear('created_at', $currentYear)
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('total', 'month')
        ->toArray();

    $monthlyTrendData = [];
    for ($i = 1; $i <= 12; $i++) {
        $monthlyTrendData[] = [
            'month' => Carbon::create()->month($i)->format('M'),
            'permohonan' => $permohonanMonthly[$i] ?? 0,
            'peminjaman' => $peminjamanMonthly[$i] ?? 0,
        ];
    }

    $statusDistribution = [
        'barang_tersedia' => $stats['barang_tersedia'],
        'barang_dipinjam' => $stats['barang_dipinjam'],
        'barang_maintenance' => $stats['barang_maintenance'],
    ];

    $topKategori = KategoriBarang::withCount('barang')
        ->orderBy('barang_count', 'desc')
        ->take(5)
        ->get();

    // ✅ HANYA MAINTENANCE DALAM PROSES
    $recentMaintenance = Maintenance::with([
        'barang:id,nama_barang,kode_barang,kategori_id',
        'barang.kategori:id,nama_kategori'
    ])
        ->where('jenis_aset', 'barang')
        ->where('status', 'dalam_proses') // ✅ FILTER HANYA DALAM PROSES
        ->latest()
        ->take(5)
        ->get();

    // System activities (Real Log Aktivitas)
    $systemActivities = LogAktivitas::with('user:id,name,email')
        ->whereNotNull('user_id')
        ->latest()
        ->limit(10)
        ->get();

    return view('dashboard.super-admin', compact(
        'stats', 
        'recentPermohonan', 
        'activePeminjaman',
        'monthlyTrendData',
        'statusDistribution',
        'topKategori',
        'recentMaintenance',
        'systemActivities'
    ));
}

private function adminDashboard()
{
    // Essential stats untuk admin
    $stats = [
        'permohonan_pending' => Permohonan::where('status', 'Dalam Proses')->count(),
        'peminjaman_aktif' => Peminjaman::where('status', 'disetujui')->count(),
        'pembayaran_pending' => Pembayaran::where('status', 'pending')->count(),
        'permohonan_hari_ini' => Permohonan::whereDate('created_at', Carbon::today())->count(),
        'barang_maintenance' => Barang::where('status', 'maintenance')->count(),
        'barang_stok_menipis' => Barang::where('jumlah_tersedia', '<=', 2)->where('jumlah_tersedia', '>', 0)->count(),
        'peminjaman_overdue' => Peminjaman::where('status', 'disetujui')
            ->where('tanggal_selesai', '<', Carbon::now())
            ->count(),
        'total_barang' => Barang::count(),
    ];

    // Pending permohonan dengan items
    $pendingPermohonan = Permohonan::with([
        'user:id,name,email,no_telp',
        'permohonanItems' => function($query) {
            $query->with([
                'barang:id,nama_barang,kode_barang,kategori_id,harga_sewa,jumlah_tersedia',
                'barang.kategori:id,nama_kategori'
            ]);
        }
    ])
    ->where('status', 'Dalam Proses')
    ->latest()
    ->take(10)
    ->get();

    // Pending peminjaman
    $pendingPeminjaman = Peminjaman::with([
        'user:id,name,email,no_telp',
        'permohonan.permohonanItems.barang:id,nama_barang,kode_barang,kategori_id',
        'permohonan.permohonanItems.barang.kategori:id,nama_kategori'
    ])
    ->where('status', 'menunggu')
    ->latest() 
    ->take(10)
    ->get();

    // Pending pembayaran
    $pendingPembayaran = Pembayaran::with([
        'peminjaman' => function($query) {
            $query->with([
                'user:id,name,email',
                'permohonan.permohonanItems.barang:id,nama_barang,kode_barang'
            ]);
        }
    ])
    ->where('status', 'pending')
    ->latest()
    ->take(5)
    ->get();

    // Overdue peminjaman
    $overduePeminjaman = Peminjaman::with([
        'user:id,name,email,no_telp',
        'permohonan.permohonanItems.barang:id,nama_barang,kode_barang'
    ])
    ->where('status', 'disetujui')
    ->where('tanggal_selesai', '<', Carbon::now())
    ->latest()
    ->take(5)
    ->get();

    // Recent activities
    $recentActivities = LogAktivitas::with('user:id,name')
        ->whereNotNull('user_id')
        ->latest()
        ->limit(10)
        ->get();

    // ========== PERBAIKAN: Monthly stats untuk chart (Full Year) ==========
    $currentYear = Carbon::now()->year;
    
    // Data Permohonan per bulan
    $permohonanMonthly = Permohonan::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->whereYear('created_at', $currentYear)
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('total', 'month')
        ->toArray();

    // Data Peminjaman per bulan
    $peminjamanMonthly = Peminjaman::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->whereYear('created_at', $currentYear)
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('total', 'month')
        ->toArray();

    // Gabungkan data untuk chart (fill missing months dengan 0)
    $monthlyTrendData = [];
    for ($i = 1; $i <= 12; $i++) {
        $monthlyTrendData[] = [
            'month' => Carbon::create()->month($i)->format('M'),
            'permohonan' => $permohonanMonthly[$i] ?? 0,
            'peminjaman' => $peminjamanMonthly[$i] ?? 0,
        ];
    }

    return view('dashboard.admin', compact(
        'stats', 
        'pendingPermohonan', 
        'pendingPeminjaman', 
        'pendingPembayaran',
        'overduePeminjaman',
        'recentActivities',
        'monthlyTrendData'  // GANTI dari monthlyStats
    ));
}

private function pengurusAsetDashboard()
{
    // Hitung barang dipinjam dari peminjaman aktif
    try {
        $barangDipinjam = Peminjaman::where('status', 'disetujui')
            ->where('jenis_aset', 'barang')
            ->distinct()
            ->count('aset_id');
    } catch (\Exception $e) {
        $barangDipinjam = Barang::where('status', 'dipinjam')->count();
    }

    // PERBAIKAN UTAMA: Hitung maintenance dari tabel maintenance (bukan dari status barang)
    $barangMaintenance = Maintenance::where('status', 'dalam_proses')
        ->where('jenis_aset', 'barang')
        ->sum('jumlah') ?? 0;

    // Stats khusus untuk pengurus aset
    $stats = [
        'total_barang' => Barang::count(),
        'barang_tersedia' => Barang::where('status', 'tersedia')->sum('jumlah_tersedia') ?? 0,
        'barang_dipinjam' => $barangDipinjam,
        'barang_maintenance' => $barangMaintenance, // Dari tabel maintenance
        'barang_rusak' => Barang::whereIn('kondisi', ['rusak ringan', 'rusak berat'])->count(),
        'barang_stok_menipis' => Barang::where('jumlah_tersedia', '<=', 2)->where('jumlah_tersedia', '>', 0)->count(),
        'total_kategori' => KategoriBarang::count(),
        'kategori_kosong' => KategoriBarang::doesntHave('barang')->count(),
    ];

    // Barang yang perlu perhatian
    $barangPerluPerhatian = Barang::with('kategori:id,nama_kategori')
        ->where(function($query) {
            $query->where('status', 'maintenance')
                  ->orWhere('kondisi', 'rusak ringan')
                  ->orWhere('kondisi', 'rusak berat')
                  ->orWhere('jumlah_tersedia', '<=', 2);
        })
        ->latest()
        ->limit(8)
        ->get();

    // PERBAIKAN: Kategori dengan jumlah barang (hitung maintenance dari tabel maintenance)
    $kategoriStats = KategoriBarang::withCount([
        'barang as total_barang',
        'barang as barang_tersedia' => function($query) {
            $query->where('status', 'tersedia');
        }
    ])
    ->get()
    ->map(function($kategori) {
        // Hitung barang dipinjam dari peminjaman aktif
        $kategori->barang_dipinjam = DB::table('peminjaman')
            ->join('barang', function($join) use ($kategori) {
                $join->on('peminjaman.aset_id', '=', 'barang.id')
                     ->where('barang.kategori_id', '=', $kategori->id);
            })
            ->where('peminjaman.status', 'disetujui')
            ->where('peminjaman.jenis_aset', 'barang')
            ->distinct('peminjaman.aset_id')
            ->count();
        
        // PERBAIKAN: Hitung maintenance dari tabel maintenance berdasarkan kategori
        $kategori->barang_maintenance = DB::table('maintenance')
            ->join('barang', function($join) use ($kategori) {
                $join->on('maintenance.aset_id', '=', 'barang.id')
                     ->where('barang.kategori_id', '=', $kategori->id);
            })
            ->where('maintenance.status', 'dalam_proses')
            ->where('maintenance.jenis_aset', 'barang')
            ->sum('maintenance.jumlah') ?? 0;
        
        return $kategori;
    })
    ->sortByDesc('total_barang')
    ->values();

    // Recent barang activities
    $recentBarangActivities = LogAktivitas::with('user:id,name')
        ->where(function($query) {
            $query->where('aksi', 'like', '%barang%')
                  ->orWhere('aksi', 'like', '%kategori%');
        })
        ->latest()
        ->limit(10)
        ->get();

    // Barang terbaru
    $recentBarang = Barang::with('kategori:id,nama_kategori')
        ->latest()
        ->take(5)
        ->get();

    // Monthly barang stats
    $monthlyBarangStats = Barang::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->whereYear('created_at', Carbon::now()->year)
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('total', 'month')
        ->toArray();

    // Fill missing months with 0
    $chartData = [];
    for ($i = 1; $i <= 12; $i++) {
        $chartData[] = [
            'month' => Carbon::create()->month($i)->format('M'),
            'barang' => $monthlyBarangStats[$i] ?? 0,
        ];
    }

    // PERBAIKAN: Status distribution (maintenance dari tabel maintenance)
    $statusDistribution = [
        'tersedia' => Barang::where('status', 'tersedia')->sum('jumlah_tersedia') ?? 0,
        'dipinjam' => $barangDipinjam,
        'maintenance' => $barangMaintenance, // Dari tabel maintenance
    ];

    // Kondisi distribution
    $kondisiDistribution = [
        'baik' => Barang::where('kondisi', 'baik')->count(),
        'rusak_ringan' => Barang::where('kondisi', 'rusak ringan')->count(),
        'rusak_berat' => Barang::where('kondisi', 'rusak berat')->count(),
    ];

    return view('dashboard.pengurus_aset', compact(
        'stats',
        'barangPerluPerhatian',
        'kategoriStats',
        'recentBarangActivities',
        'recentBarang',
        'chartData',
        'statusDistribution',
        'kondisiDistribution'
    ));
}

private function userDashboard()
{
    $userId = Auth::id();
    
    $stats = [
        // Permohonan stats
        'total_permohonan' => Permohonan::where('user_id', $userId)->count(),
        'permohonan_pending' => Permohonan::where('user_id', $userId)->where('status', 'Dalam Proses')->count(),
        'permohonan_disetujui' => Permohonan::where('user_id', $userId)->where('status', 'Disetujui')->count(),
        'permohonan_ditolak' => Permohonan::where('user_id', $userId)->where('status', 'Ditolak')->count(),
        
        // Peminjaman stats
        'total_peminjaman' => Peminjaman::where('user_id', $userId)->count(),
        'peminjaman_pending' => Peminjaman::where('user_id', $userId)->where('status', 'menunggu')->count(),
        'peminjaman_aktif' => Peminjaman::where('user_id', $userId)->where('status', 'disetujui')->count(),
        'peminjaman_selesai' => Peminjaman::where('user_id', $userId)->where('status', 'selesai')->count(),
        
        // Pembayaran stats - HANYA dari peminjaman yang DISETUJUI
            'pembayaran_pending' => Pembayaran::whereHas('peminjaman', function($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->where('status', 'disetujui'); // ✅ TAMBAHKAN INI
            })->where('status', 'pending')->count(),
        ];

    // 🔥 PERBAIKAN: Permohonan user terbaru dengan SEMUA items
    $myPermohonan = Permohonan::where('user_id', $userId)
        ->with([
            'permohonanItems' => function($query) {
                $query->with([
                    'barang:id,nama_barang,kode_barang,kategori_id,lokasi,harga_sewa',
                    'barang.kategori:id,nama_kategori'
                ]);
            }
        ])
        ->latest()
        ->take(5)
        ->get();

    // 🔥 PERBAIKAN: Peminjaman user HANYA yang DISETUJUI dengan SEMUA detail barang
    $myPeminjaman = Peminjaman::where('user_id', $userId)
        ->where('status', 'disetujui') // ✅ TAMBAHKAN INI: Hanya peminjaman yang disetujui
        ->with([
            // Ambil semua detail barang dari peminjaman_detail
            'peminjamanDetail' => function($query) {
                $query->with([
                    'barang:id,nama_barang,kode_barang,kategori_id,lokasi',
                    'barang.kategori:id,nama_kategori'
                ]);
            },
            // Load permohonan untuk info tambahan
            'permohonan:id,no_permohonan,keperluan',
            'pembayaran:id,peminjaman_id,jumlah,status,metode'
        ])
        ->latest()
        ->take(5)
        ->get();

    // Available assets
$availableAssets = [
    'barang_tersedia' => Barang::where('status', 'tersedia')->sum('jumlah_total'), // ✅ Total stok semua barang
    'barang_by_kategori' => KategoriBarang::withCount(['barang' => function($query) {
        $query->where('status', 'tersedia');
    }])
    ->having('barang_count', '>', 0)
    ->orderBy('barang_count', 'desc')
    ->get(),
];

    // Pembayaran pending user - HANYA untuk peminjaman yang DISETUJUI
    $pendingPembayaran = Pembayaran::whereHas('peminjaman', function($query) use ($userId) {
        $query->where('user_id', $userId)
            ->where('status', 'disetujui'); // ✅ TAMBAHKAN INI: Hanya peminjaman yang disetujui
    })
    ->where('status', 'pending')
    ->with([
        'peminjaman' => function($query) {
            $query->with([
                'peminjamanDetail.barang:id,nama_barang,kode_barang',
                'permohonan:id,no_permohonan' // Optional: untuk nomor permohonan
            ]);
        }
    ])
    ->latest()
    ->take(3)
    ->get();

    // Upcoming Returns
    $upcomingReturns = Peminjaman::where('user_id', $userId)
        ->where('status', 'disetujui')
        ->whereBetween('tanggal_selesai', [
            Carbon::now(), 
            Carbon::now()->addDays(7)
        ])
        ->with([
            'peminjamanDetail' => function($query) {
                $query->with('barang:id,nama_barang,kode_barang');
            },
            'permohonan:id,no_permohonan,keperluan'
        ])
        ->orderBy('tanggal_selesai', 'asc')
        ->get();

    return view('dashboard.user', compact(
        'stats', 
        'myPermohonan', 
        'myPeminjaman', 
        'availableAssets',
        'pendingPembayaran',
        'upcomingReturns'
    ));
}

    public function getBarangStats()
    {
        $stats = [
            'total' => Barang::count(),
            'tersedia' => Barang::where('status', 'tersedia')->count(),
            'dipinjam' => Barang::where('status', 'dipinjam')->count(),
            'maintenance' => Barang::where('status', 'maintenance')->count(),
            'kondisi' => [
                'baik' => Barang::where('kondisi', 'baik')->count(),
                'rusak_ringan' => Barang::where('kondisi', 'rusak ringan')->count(),
                'rusak_berat' => Barang::where('kondisi', 'rusak berat')->count(),
            ],
            'kategori' => KategoriBarang::withCount('barang')->get()
        ];

        return response()->json($stats);
    }

    public function getChartData(Request $request)
    {
        $period = $request->get('period', 'monthly'); // monthly, weekly, daily
        $year = $request->get('year', Carbon::now()->year);
        $type = $request->get('type', 'permohonan'); // permohonan, peminjaman, barang

        if ($period === 'monthly') {
            if ($type === 'permohonan') {
                $data = Permohonan::selectRaw('MONTH(created_at) as period, COUNT(*) as total')
                    ->whereYear('created_at', $year)
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get()
                    ->pluck('total', 'period')
                    ->toArray();
            } elseif ($type === 'peminjaman') {
                $data = Peminjaman::selectRaw('MONTH(created_at) as period, COUNT(*) as total')
                    ->whereYear('created_at', $year)
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get()
                    ->pluck('total', 'period')
                    ->toArray();
            } elseif ($type === 'barang') {
                $data = Barang::selectRaw('MONTH(created_at) as period, COUNT(*) as total')
                    ->whereYear('created_at', $year)
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get()
                    ->pluck('total', 'period')
                    ->toArray();
            }

            $chartData = [];
            for ($i = 1; $i <= 12; $i++) {
                $chartData[] = [
                    'label' => Carbon::create()->month($i)->format('M'),
                    'value' => $data[$i] ?? 0,
                ];
            }
        } else {
            // Bisa ditambahkan logika untuk weekly/daily
            $chartData = [];
        }

        return response()->json($chartData);
    }
}