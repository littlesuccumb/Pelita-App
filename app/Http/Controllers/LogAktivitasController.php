<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        $query = LogAktivitas::with('user')->orderBy('created_at', 'desc');
        
        // Filter berdasarkan user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        
        // Filter berdasarkan aksi
        if ($request->filled('aksi')) {
            $query->byAksi($request->aksi);
        }
        
        // Filter berdasarkan tanggal
        if ($request->filled('tanggal_mulai')) {
            $startDate = Carbon::parse($request->tanggal_mulai)->startOfDay();
            
            if ($request->filled('tanggal_selesai')) {
                $endDate = Carbon::parse($request->tanggal_selesai)->endOfDay();
                $query->whereBetween('created_at', [$startDate, $endDate]);
            } else {
                $query->whereDate('created_at', $startDate);
            }
        }
        
        // Search dalam detail aktivitas
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('aksi', 'LIKE', "%{$search}%")
                  ->orWhere('detail', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        $logs = $query->paginate(20)->withQueryString();
        $users = User::orderBy('name')->get();
        
        // Statistik untuk dashboard
        $totalHariIni = LogAktivitas::whereDate('created_at', today())->count();
        $totalMingguIni = LogAktivitas::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();
        $totalBulanIni = LogAktivitas::whereMonth('created_at', Carbon::now()->month)
                                   ->whereYear('created_at', Carbon::now()->year)
                                   ->count();
        
        $stats = [
            'hari_ini' => $totalHariIni,
            'minggu_ini' => $totalMingguIni,
            'bulan_ini' => $totalBulanIni
        ];
        
        return view('admin.log-aktivitas.index', compact('logs', 'users', 'stats'));
    }

    public function show(LogAktivitas $logAktivitas)
    {
        $logAktivitas->load('user');
        
        return view('admin.log-aktivitas.show', compact('logAktivitas'));
    }

    public function destroy(LogAktivitas $logAktivitas)
    {
        // Hanya super admin yang bisa menghapus log
        if (!Auth::user() || Auth::user()->role !== 'super_admin') {
            return back()->with('error', 'Anda tidak memiliki izin untuk menghapus log aktivitas');
        }
        
        $logAktivitas->delete();
        
        // Catat penghapusan log (ironis tapi perlu untuk audit)
        LogAktivitas::catat(
            'Menghapus Log Aktivitas',
            'Menghapus log aktivitas ID: ' . $logAktivitas->id . ' - Aksi: ' . $logAktivitas->aksi
        );
        
        return redirect()
            ->route('admin.log-aktivitas.index')
            ->with('success', 'Log aktivitas berhasil dihapus');
    }

    public function clearOldLogs(Request $request)
    {
        // Hanya super admin yang bisa clear log
        if (!Auth::user() || Auth::user()->role !== 'super_admin') {
            return back()->with('error', 'Anda tidak memiliki izin untuk menghapus log aktivitas');
        }
        
        $request->validate([
            'days' => 'required|integer|min:30|max:365'
        ]);
        
        $cutoffDate = Carbon::now()->subDays($request->days);
        $deletedCount = LogAktivitas::where('created_at', '<', $cutoffDate)->delete();
        
        // Catat pembersihan log
        LogAktivitas::catat(
            'Pembersihan Log Lama',
            "Menghapus {$deletedCount} log aktivitas yang lebih lama dari {$request->days} hari"
        );
        
        return back()->with('success', "Berhasil menghapus {$deletedCount} log aktivitas lama");
    }

    public function export(Request $request)
    {
        $query = LogAktivitas::with('user')->orderBy('created_at', 'desc');
        
        // Apply same filters as index
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        
        if ($request->filled('aksi')) {
            $query->byAksi($request->aksi);
        }
        
        if ($request->filled('tanggal_mulai')) {
            $startDate = Carbon::parse($request->tanggal_mulai)->startOfDay();
            
            if ($request->filled('tanggal_selesai')) {
                $endDate = Carbon::parse($request->tanggal_selesai)->endOfDay();
                $query->whereBetween('created_at', [$startDate, $endDate]);
            } else {
                $query->whereDate('created_at', $startDate);
            }
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('aksi', 'LIKE', "%{$search}%")
                  ->orWhere('detail', 'LIKE', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'LIKE', "%{$search}%");
                  });
            });
        }
        
        $logs = $query->get();
        
        $filename = 'log_aktivitas_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];
        
        $callback = function() use ($logs) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($file, [
                'ID',
                'Tanggal/Waktu',
                'User',
                'Aksi',
                'Detail'
            ]);
            
            // Data
            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->id,
                    $log->created_at->format('d/m/Y H:i:s'),
                    $log->nama_user,
                    $log->aksi,
                    $log->detail
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    public function getRecentActivities(Request $request)
    {
        $limit = $request->get('limit', 10);
        
        $activities = LogAktivitas::with('user')
                                 ->orderBy('created_at', 'desc')
                                 ->limit($limit)
                                 ->get()
                                 ->map(function($log) {
                                     return [
                                         'id' => $log->id,
                                         'waktu' => $log->created_at->diffForHumans(),
                                         'waktu_lengkap' => $log->created_at->format('d/m/Y H:i:s'),
                                         'user' => $log->nama_user,
                                         'aksi' => $log->aksi,
                                         'detail' => Str::limit($log->detail, 100),
                                         'detail_lengkap' => $log->detail
                                     ];
                                 });
        
        return response()->json($activities);
    }

    public function getStatistics(Request $request)
    {
        $period = $request->get('period', '7days'); // 7days, 30days, 3months, 1year
        
        switch ($period) {
            case '7days':
                $startDate = Carbon::now()->subDays(6)->startOfDay();
                break;
            case '30days':
                $startDate = Carbon::now()->subDays(29)->startOfDay();
                break;
            case '3months':
                $startDate = Carbon::now()->subMonths(3)->startOfMonth();
                break;
            case '1year':
                $startDate = Carbon::now()->subYear()->startOfMonth();
                break;
            default:
                $startDate = Carbon::now()->subDays(6)->startOfDay();
        }
        
        $logs = LogAktivitas::where('created_at', '>=', $startDate)
                           ->selectRaw('DATE(created_at) as date, COUNT(*) as count, aksi')
                           ->groupBy('date', 'aksi')
                           ->orderBy('date')
                           ->get();
        
        // Group by date and prepare chart data
        $chartData = [];
        $aksiCounts = [];
        
        foreach ($logs as $log) {
            $date = Carbon::parse($log->date)->format('Y-m-d');
            
            if (!isset($chartData[$date])) {
                $chartData[$date] = 0;
            }
            $chartData[$date] += $log->count;
            
            if (!isset($aksiCounts[$log->aksi])) {
                $aksiCounts[$log->aksi] = 0;
            }
            $aksiCounts[$log->aksi] += $log->count;
        }
        
        return response()->json([
            'chart_data' => $chartData,
            'aksi_counts' => $aksiCounts,
            'total_activities' => array_sum($chartData)
        ]);
    }
}