<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsetController extends Controller
{
    
    public function index(Request $request)
    {
        // Hitung statistik untuk Hero Section
        $stats = [
            'barang_tersedia' => Barang::tersediaDanDapatDipinjam()->count(),
            'total_kategori' => KategoriBarang::count(),
            'total_stok_tersedia' => Barang::dapatDipinjam()
                ->where('status', 'tersedia')
                ->sum('jumlah_tersedia'),
        ];

        // Statistik untuk CTA Section
        $ctaStats = [
            'total_peminjaman' => \App\Models\Peminjaman::whereIn('status', ['disetujui', 'selesai'])->count(),
            'pengguna_aktif' => \App\Models\User::where('role', 'user')
                ->whereHas('peminjaman', function($query) {
                    $query->where('created_at', '>=', now()->subDays(90));
                })
                ->count(),
        ];

        // Ambil 6 barang terbaru untuk preview - dengan eager load fotos
        $recentBarang = Barang::with(['kategori', 'fotoPrimary'])
            ->tersediaDanDapatDipinjam()
            ->latest()
            ->take(6)
            ->get();

        return view('aset.index', compact('stats', 'ctaStats', 'recentBarang'))
            ->with('isLandingPage', true);
    }

    public function barang(Request $request)
    {
        // Base query dengan eager loading kategori dan foto primary
        $query = Barang::with(['kategori', 'fotoPrimary'])
            ->where('status', 'tersedia')
            ->dapatDipinjam(); // Hanya barang yang dapat dipinjam

        // Filter by category
        if ($request->filled('kategori')) {
            $query->byKategori($request->kategori);
        }

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by condition
        if ($request->filled('kondisi')) {
            $query->byCondition($request->kondisi);
        }

        // Filter by availability
        if ($request->filled('tersedia')) {
            if ($request->tersedia == 'ya') {
                $query->where('jumlah_tersedia', '>', 0);
            } else {
                $query->where('jumlah_tersedia', '=', 0);
            }
        }

        // Sort - dengan validasi
        $sortBy = $request->get('sort', 'nama_barang');
        $sortOrder = $request->get('order', 'asc');
        
        $allowedSorts = ['nama_barang', 'kode_barang', 'created_at', 'harga_sewa'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'nama_barang';
        }
        
        // Special handling untuk sort by harga
        if ($sortBy === 'harga_sewa') {
            $query->orderByRaw('CASE WHEN harga_sewa = 0 THEN 1 ELSE 0 END, harga_sewa ' . $sortOrder);
        } else {
            $query->orderBy($sortBy, $sortOrder);
        }

        // ✅ PAGINATION - 9 items per page (untuk guest), atau lebih jika sudah login
        $perPage = Auth::check() ? 24 : 12;
        
        // Jika user request perPage tertentu dan sudah login
        if (Auth::check() && $request->filled('per_page')) {
            $requestedPerPage = $request->get('per_page');
            $perPage = in_array($requestedPerPage, [12, 24, 36, 48]) ? $requestedPerPage : 24;
        }
        
        $barang = $query->paginate($perPage)->withQueryString();
        
        // Load semua kategori untuk filter
        $kategori = KategoriBarang::orderBy('nama_kategori', 'asc')->get();

        // Hitung statistik untuk Hero Section - SAMA DENGAN INDEX
        $stats = [
            'barang_tersedia' => Barang::tersediaDanDapatDipinjam()->count(),
            'total_kategori' => KategoriBarang::count(),
            'total_stok_tersedia' => Barang::dapatDipinjam()
                ->where('status', 'tersedia')
                ->sum('jumlah_tersedia'),
        ];

        // ✅ Pass authentication status ke view
        $isAuthenticated = Auth::check();

        return view('aset.barang', compact('barang', 'kategori', 'stats', 'isAuthenticated'));
    }

    /**
     * List barang untuk user yang sudah login - dengan rekomendasi personal
     */
    public function userBarang(Request $request)
    {
        // Validasi user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $user = Auth::user();

        // Base query - HANYA load fotoPrimary untuk list (bukan semua fotos)
        $query = Barang::with(['kategori', 'fotoPrimary'])
            ->where('status', 'tersedia')
            ->dapatDipinjam();

        // Filter by category
        if ($request->filled('kategori')) {
            $query->byKategori($request->kategori);
        }

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by condition
        if ($request->filled('kondisi')) {
            $query->byCondition($request->kondisi);
        }

        // Filter by availability
        if ($request->filled('tersedia')) {
            if ($request->tersedia == 'ya') {
                $query->where('jumlah_tersedia', '>', 0);
            } else {
                $query->where('jumlah_tersedia', '=', 0);
            }
        }

        // Filter by price range
        if ($request->filled('harga_min') && $request->filled('harga_max')) {
            $hargaMin = (int) $request->harga_min;
            $hargaMax = (int) $request->harga_max;
            $query->whereBetween('harga_sewa', [$hargaMin, $hargaMax]);
        }

        // Sort - dengan validasi
        $sortBy = $request->get('sort', 'nama_barang');
        $sortOrder = $request->get('order', 'asc');
        
        $allowedSorts = ['nama_barang', 'kode_barang', 'created_at', 'harga_sewa'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'nama_barang';
        }
        
        // Special handling untuk sort by harga
        if ($sortBy === 'harga_sewa') {
            $query->orderByRaw('CASE WHEN harga_sewa = 0 THEN 1 ELSE 0 END, harga_sewa ' . $sortOrder);
        } else {
            $query->orderBy($sortBy, $sortOrder);
        }

        // ✨ PAGINATION WITH CUSTOM PER PAGE (Support "all" option)
        $perPage = $request->get('per_page', '12');
        
        if ($perPage === 'all') {
            // Jika pilih "Semua Item", ambil semua data
            $allBarang = $query->get();
            
            // Convert ke LengthAwarePaginator agar tetap kompatibel dengan blade pagination
            $barang = new \Illuminate\Pagination\LengthAwarePaginator(
                $allBarang,
                $allBarang->count(),
                $allBarang->count(), // per_page = total items (semua dalam 1 halaman)
                1, // current page always 1
                [
                    'path' => $request->url(),
                    'query' => $request->query()
                ]
            );
        } else {
            // Pagination normal dengan validasi
            $perPage = in_array((int)$perPage, [12, 24, 36, 48]) ? (int)$perPage : 12;
            $barang = $query->paginate($perPage)->withQueryString();
        }
        
        // Load semua kategori untuk filter
        $kategori = KategoriBarang::orderBy('nama_kategori', 'asc')->get();

        // Ambil rekomendasi barang - hanya fotoPrimary (max 6 items untuk performance)
        $recommendedBarang = Barang::with(['kategori', 'fotoPrimary'])
            ->where('status', 'tersedia')
            ->dapatDipinjam()
            ->where('jumlah_tersedia', '>', 0)
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('user.barang', compact('barang', 'kategori', 'recommendedBarang', 'user'));
    }

    public function showBarang($id)
    {
        // Eager load relasi yang dibutuhkan termasuk SEMUA foto (ordered)
        $barang = Barang::with(['kategori', 'fotos'])->findOrFail($id);
        
        // Related items dari kategori yang sama - dengan foto primary
        $relatedBarang = Barang::with(['kategori', 'fotoPrimary'])
            ->where('kategori_id', $barang->kategori_id)
            ->where('id', '!=', $barang->id)
            ->where('status', 'tersedia')
            ->where('dapat_dipinjam', 1)
            ->where('jumlah_tersedia', '>', 0)
            ->inRandomOrder()
            ->take(4)
            ->get();
        
        return view('aset.barang-detail', compact('barang', 'relatedBarang'));
    }

    /**
 * Tampilkan detail barang untuk user yang sudah login
 * BARU DI SINI LOAD SEMUA FOTO
 */
public function userShowBarang($id)
{
    // Validasi user sudah login
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    
    $user = Auth::user();

    // Eager load relasi TERMASUK SEMUA FOTO (fotos) untuk gallery
    $barang = Barang::with(['kategori', 'fotos'])->findOrFail($id);
    
    // Related items - hanya perlu fotoPrimary
    $relatedBarang = Barang::with(['kategori', 'fotoPrimary'])
        ->where('kategori_id', $barang->kategori_id)
        ->where('id', '!=', $barang->id)
        ->where('status', 'tersedia')
        ->where('dapat_dipinjam', 1)
        ->where('jumlah_tersedia', '>', 0)
        ->inRandomOrder()
        ->take(4)
        ->get();
    
    return view('user.barang-detail', compact('barang', 'relatedBarang', 'user'));
}
    /**
     * Dedicated "How It Works" page
     */
    public function howItWorks()
    {
        return view('aset.how-it-works');
    }

    /**
     * API method untuk lazy loading/infinite scroll
     */
    public function loadMoreBarang(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = 6;
        
        $barang = Barang::with(['kategori', 'fotoPrimary'])
            ->where('status', 'tersedia')
            ->where('dapat_dipinjam', 1)
            ->where('jumlah_tersedia', '>', 0)
            ->latest()
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        // Transform data untuk include foto URL
        $barangData = $barang->map(function($item) {
            return [
                'id' => $item->id,
                'nama_barang' => $item->nama_barang,
                'kode_barang' => $item->kode_barang,
                'foto_url' => $item->foto_url, // Menggunakan accessor dari model
                'harga_sewa' => $item->harga_sewa,
                'formatted_harga_sewa' => $item->formatted_harga_sewa,
                'kategori' => $item->kategori ? $item->kategori->nama_kategori : null,
                'jumlah_tersedia' => $item->jumlah_tersedia,
                'url' => route('aset.barang.detail', $item->id)
            ];
        });

        return response()->json([
            'data' => $barangData,
            'hasMore' => $barang->count() === $perPage,
            'currentPage' => $page,
            'perPage' => $perPage
        ]);
    }

    /**
     * API untuk search autocomplete
     */
    public function searchSuggestions(Request $request)
    {
        $search = $request->get('q', '');
        
        if (strlen($search) < 2) {
            return response()->json([]);
        }

        $suggestions = Barang::with('fotoPrimary')
            ->where('status', 'tersedia')
            ->where('dapat_dipinjam', 1)
            ->where(function ($q) use ($search) {
                $q->where('nama_barang', 'LIKE', "%{$search}%")
                  ->orWhere('kode_barang', 'LIKE', "%{$search}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$search}%");
            })
            ->select('id', 'nama_barang', 'kode_barang', 'harga_sewa')
            ->limit(5)
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'nama' => $item->nama_barang,
                    'kode' => $item->kode_barang,
                    'foto' => $item->foto_url, // Menggunakan accessor
                    'harga' => $item->harga_sewa > 0 ? 'Rp ' . number_format($item->harga_sewa, 0, ',', '.') : 'Gratis',
                    'url' => route('aset.barang.detail', $item->id)
                ];
            });

        return response()->json($suggestions);
    }

    /**
     * Filter barang berdasarkan kategori (untuk AJAX)
     */
    public function filterByKategori(Request $request, $kategoriId)
    {
        $barang = Barang::with(['kategori', 'fotoPrimary'])
            ->where('kategori_id', $kategoriId)
            ->where('status', 'tersedia')
            ->where('dapat_dipinjam', 1)
            ->where('jumlah_tersedia', '>', 0)
            ->latest()
            ->paginate(24);

        if ($request->ajax()) {
            // Transform data untuk include foto URL
            $items = $barang->getCollection()->map(function($item) {
                return [
                    'id' => $item->id,
                    'nama_barang' => $item->nama_barang,
                    'kode_barang' => $item->kode_barang,
                    'foto_url' => $item->foto_url,
                    'harga_sewa' => $item->harga_sewa,
                    'formatted_harga_sewa' => $item->formatted_harga_sewa,
                    'kategori' => $item->kategori ? $item->kategori->nama_kategori : null,
                    'jumlah_tersedia' => $item->jumlah_tersedia,
                    'url' => route('aset.barang.detail', $item->id)
                ];
            });

            return response()->json([
                'data' => $items,
                'pagination' => [
                    'current_page' => $barang->currentPage(),
                    'last_page' => $barang->lastPage(),
                    'per_page' => $barang->perPage(),
                    'total' => $barang->total()
                ]
            ]);
        }

        $kategori = KategoriBarang::orderBy('nama_kategori', 'asc')->get();
        return view('aset.barang', compact('barang', 'kategori'));
    }

    /**
     * API untuk mendapatkan semua foto barang (untuk gallery/lightbox)
     */
    public function getBarangPhotos($id)
    {
        $barang = Barang::with('fotos')->findOrFail($id);
        
        $photos = $barang->fotos->map(function($foto) {
            return [
                'id' => $foto->id,
                'url' => $foto->foto_url,
                'is_primary' => $foto->is_primary,
                'keterangan' => $foto->keterangan,
                'urutan' => $foto->urutan
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $photos
        ]);
    }

    public function getBarangDetail($id)
{
    try {
        $barang = Barang::with(['kategori', 'fotos']) // ✅ Load ALL photos for gallery
            ->where('status', 'tersedia')
            ->where('dapat_dipinjam', true)
            ->findOrFail($id);

        // Prepare foto primary (first photo or default)
        $fotoPrimary = $barang->fotos->where('is_primary', true)->first() 
                       ?? $barang->fotos->first();
        
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $barang->id,
                'nama_barang' => $barang->nama_barang,
                'kode_barang' => $barang->kode_barang,
                'kategori' => $barang->kategori ? $barang->kategori->nama_kategori : null,
                'kategori_nama' => $barang->kategori ? $barang->kategori->nama_kategori : null,
                'harga_sewa' => $barang->harga_sewa,
                'kondisi' => $barang->kondisi,
                'jumlah_tersedia' => $barang->jumlah_tersedia,
                'jumlah_total' => $barang->jumlah_total,
                'lokasi' => $barang->lokasi,
                'deskripsi' => $barang->deskripsi,
                'spesifikasi' => $barang->spesifikasi,
                'merk' => $barang->merk,
                'type' => $barang->type,
                // ✅ Primary foto for main display
                'foto' => $fotoPrimary 
                    ? asset('storage/' . $fotoPrimary->foto)
                    : asset('images/no-image.png'),
                'foto_primary' => $fotoPrimary 
                    ? asset('storage/' . $fotoPrimary->foto)
                    : asset('images/no-image.png'),
                // ✅ ALL photos for gallery
                'fotos' => $barang->fotos->map(function($foto) {
                    return [
                        'id' => $foto->id,
                        'foto' => asset('storage/' . $foto->foto),
                        'foto_url' => asset('storage/' . $foto->foto),
                        'is_primary' => $foto->is_primary,
                        'keterangan' => $foto->keterangan,
                        'urutan' => $foto->urutan
                    ];
                })->toArray()
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Barang tidak ditemukan atau tidak tersedia'
        ], 404);
    }
}
}