<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Peminjaman;
use App\Models\LogAktivitas;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Exports\PembayaranExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class PembayaranController extends Controller
{
    // User Routes
    public function index()
    {
        $userId = Auth::id();
        
        // Query pembayaran dengan filter peminjaman status disetujui atau selesai
        $pembayaran = Pembayaran::whereHas('peminjaman', function($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->whereIn('status', ['disetujui', 'selesai']); // Hanya peminjaman yang disetujui atau selesai
            })
            ->with([
                'peminjaman.peminjamanDetail.barang.fotoPrimary', // Load foto barang
                'peminjaman.peminjamanDetail.barang.kategori'
            ])
            ->latest()
            ->paginate(10);

        // Hitung total pembayaran lunas untuk user ini (hanya dari peminjaman yang disetujui)
        $totalLunas = Pembayaran::whereHas('peminjaman', function($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->whereIn('status', ['disetujui', 'selesai']);
            })
            ->where('status', 'lunas')
            ->sum('jumlah');

        return view('pembayaran.index', compact('pembayaran', 'totalLunas'));
    }

    public function show(Pembayaran $pembayaran)
    {
        // Pastikan user hanya bisa melihat pembayarannya sendiri
        if (Auth::user()->role === 'user' && $pembayaran->peminjaman->user_id !== Auth::id()) {
            abort(403);
        }

        // Load relasi yang diperlukan - hanya barang, tidak ada ruangan
        $pembayaran->load([
            'peminjaman.user',
            'peminjaman.permohonan.items.barang.kategoriBarang'
        ]);

        return view('pembayaran.show', compact('pembayaran'));
    }

    public function bayar(Request $request, Peminjaman $peminjaman)
    {
        // Validasi ownership
        if ($peminjaman->user_id !== Auth::id()) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access.'
                ], 403);
            }
            abort(403);
        }

        $pembayaran = $peminjaman->pembayaran;
        
        // Validasi status pembayaran
        if (!$pembayaran || $pembayaran->status !== 'pending') {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pembayaran tidak tersedia atau sudah diproses.'
                ], 400);
            }
            return back()->with('error', 'Pembayaran tidak tersedia atau sudah diproses.');
        }

        // Validasi input
        $request->validate([
            'metode' => 'required|in:cash,transfer',
            'bukti_transfer' => 'required_if:metode,transfer|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        try {
            $data = [
                'metode' => $request->metode,
                'tanggal_bayar' => now(),
            ];

            // Upload bukti transfer jika metode transfer
            if ($request->metode === 'transfer' && $request->hasFile('bukti_transfer')) {
                $file = $request->file('bukti_transfer');
                $filename = 'bukti_transfer_' . $pembayaran->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('dokumen/bukti_transfer', $filename, 'public');
                $data['bukti_transfer'] = $path;
            }

            // Jika cash, langsung lunas
            if ($request->metode === 'cash') {
                $data['status'] = 'lunas';
            }

            $pembayaran->update($data);

            // Log aktivitas
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aksi' => 'Melakukan Pembayaran',
                'detail' => "Melakukan pembayaran untuk peminjaman barang ID: {$peminjaman->id} dengan metode: {$request->metode}",
            ]);

            if ($request->metode === 'transfer') {
                NotificationService::pembayaranBaruAdmin($pembayaran);
            }

            $message = $request->metode === 'cash' 
                ? 'Pembayaran berhasil dicatat dan sudah lunas.'
                : 'Bukti pembayaran berhasil diupload dan menunggu konfirmasi admin.';

            // Return JSON untuk AJAX request
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'data' => [
                        'pembayaran_id' => $pembayaran->id,
                        'status' => $pembayaran->status,
                        'metode' => $pembayaran->metode,
                    ]
                ]);
            }

            // Return redirect untuk non-AJAX
            return redirect()->route('pembayaran.show', $pembayaran)
                ->with('success', $message);

        } catch (\Exception $e) {
            \Log::error('Payment error: ' . $e->getMessage());
            
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function uploadBukti(Request $request, Pembayaran $pembayaran)
    {
        // Validasi ownership
        if ($pembayaran->peminjaman->user_id !== Auth::id()) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access.'
                ], 403);
            }
            abort(403);
        }

        // Validasi status
        if ($pembayaran->status !== 'pending') {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pembayaran sudah diproses.'
                ], 400);
            }
            return back()->with('error', 'Pembayaran sudah diproses.');
        }

        $request->validate([
            'bukti_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        try {
            // Hapus bukti lama jika ada
            if ($pembayaran->bukti_transfer) {
                Storage::disk('public')->delete($pembayaran->bukti_transfer);
            }

            // Upload bukti baru
            $file = $request->file('bukti_transfer');
            $filename = 'bukti_transfer_' . $pembayaran->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('dokumen/bukti_transfer', $filename, 'public');

            $pembayaran->update([
                'bukti_transfer' => $path,
                'tanggal_bayar' => now(),
            ]);

            // Log aktivitas
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aksi' => 'Upload Bukti Pembayaran',
                'detail' => "Mengupload bukti pembayaran untuk peminjaman barang ID: {$pembayaran->peminjaman_id}",
            ]);

            NotificationService::pembayaranBaruAdmin($pembayaran);

            // Return JSON untuk AJAX request
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Bukti pembayaran berhasil diupload.',
                    'data' => [
                        'pembayaran_id' => $pembayaran->id,
                        'bukti_transfer' => $pembayaran->bukti_transfer,
                    ]
                ]);
            }

            return back()->with('success', 'Bukti pembayaran berhasil diupload.');

        } catch (\Exception $e) {
            \Log::error('Upload error: ' . $e->getMessage());
            
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Admin Routes
    public function adminIndex(Request $request)
    {
        $query = Pembayaran::with(['peminjaman.user', 'peminjaman.barang']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by metode
        if ($request->filled('metode')) {
            $query->where('metode', $request->metode);
        }

        // Filter by date range
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal_bayar', '>=', $request->tanggal_dari);
        }
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal_bayar', '<=', $request->tanggal_sampai);
        }

        // Search by user atau nama barang
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('peminjaman.user', function($subQ) use ($search) {
                    $subQ->where('name', 'LIKE', "%{$search}%")
                         ->orWhere('email', 'LIKE', "%{$search}%");
                })->orWhereHas('peminjaman.barang', function($subQ) use ($search) {
                    $subQ->where('nama_barang', 'LIKE', "%{$search}%")
                         ->orWhere('kode_barang', 'LIKE', "%{$search}%");
                });
            });
        }

        // Sort
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $pembayaran = $query->paginate(10);

        return view('admin.pembayaran.index', compact('pembayaran'));
    }

    public function adminShow(Pembayaran $pembayaran)
    {
        $pembayaran->load(['peminjaman.user', 'peminjaman.barang']);
        return view('admin.pembayaran.show', compact('pembayaran'));
    }

    public function konfirmasi(Pembayaran $pembayaran)
    {
        if ($pembayaran->status !== 'pending') {
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pembayaran sudah diproses.'
                ], 400);
            }
            return back()->with('error', 'Pembayaran sudah diproses.');
        }

        if (!$pembayaran->bukti_transfer && $pembayaran->metode === 'transfer') {
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bukti transfer belum diupload.'
                ], 400);
            }
            return back()->with('error', 'Bukti transfer belum diupload.');
        }

        try {
            $pembayaran->update(['status' => 'lunas']);

            // Log aktivitas
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aksi' => 'Konfirmasi Pembayaran',
                'detail' => "Mengkonfirmasi pembayaran ID: {$pembayaran->id} untuk peminjaman barang ID: {$pembayaran->peminjaman_id}",
            ]);

            NotificationService::pembayaranDikonfirmasi($pembayaran);

            if (request()->wantsJson() || request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pembayaran berhasil dikonfirmasi.'
                ]);
            }

            return back()->with('success', 'Pembayaran berhasil dikonfirmasi.');

        } catch (\Exception $e) {
            \Log::error('Konfirmasi error: ' . $e->getMessage());
            
            if (request()->wantsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function tolakPembayaran(Request $request, Pembayaran $pembayaran)
    {
        if ($pembayaran->status !== 'pending') {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pembayaran sudah diproses.'
                ], 400);
            }
            return back()->with('error', 'Pembayaran sudah diproses.');
        }

        $request->validate([
            'alasan_penolakan' => 'required|string|max:500'
        ]);

        try {
            $pembayaran->update(['status' => 'batal']);

            // Log aktivitas
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aksi' => 'Menolak Pembayaran',
                'detail' => "Menolak pembayaran ID: {$pembayaran->id} untuk peminjaman barang. Alasan: {$request->alasan_penolakan}",
            ]);

            NotificationService::pembayaranDitolak($pembayaran, $request->alasan_penolakan);

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pembayaran berhasil ditolak.'
                ]);
            }

            return back()->with('success', 'Pembayaran berhasil ditolak.');

        } catch (\Exception $e) {
            \Log::error('Tolak pembayaran error: ' . $e->getMessage());
            
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Method untuk mendapatkan statistik pembayaran (untuk dashboard admin)
     */
    public function getStatistik()
    {
        return [
            'total_pembayaran' => Pembayaran::count(),
            'pembayaran_lunas' => Pembayaran::where('status', 'lunas')->count(),
            'pembayaran_pending' => Pembayaran::where('status', 'pending')->count(),
            'total_pendapatan' => Pembayaran::where('status', 'lunas')->sum('jumlah'),
            'pendapatan_bulan_ini' => Pembayaran::where('status', 'lunas')
                ->whereMonth('tanggal_bayar', now()->month)
                ->whereYear('tanggal_bayar', now()->year)
                ->sum('jumlah'),
        ];
    }

    public function export(Request $request)
    {
        $filename = 'pembayaran_' . now()->format('Y-m-d_His') . '.xlsx';
        
        return Excel::download(
            new PembayaranExport($request->all()), 
            $filename
        );
    }
}