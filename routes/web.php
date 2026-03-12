<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\LogAktivitasController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| AUTHENTICATION FIX
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', function() {
        return view('auth.login');
    })->name('login');

    // Register - Step 1: Form Registrasi
    Route::get('/register', function() {
        return view('auth.register');
    })->name('register');
    
    // Register - Step 2: Kirim OTP
    Route::post('/register/send-otp', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'sendOtp'])
        ->name('register.send-otp');
    
    // Register - Step 3: Form Verifikasi OTP
    Route::get('/register/verify', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'showVerifyForm'])
        ->name('register.verify');
    
    // Register - Step 4: Verifikasi OTP dan Buat User
    Route::post('/register/verify', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'verifyOtp'])
        ->name('register.verify.post');
    
    // Register - Resend OTP
    Route::post('/register/resend-otp', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'resendOtp'])
        ->name('register.resend-otp');
});

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('aset.public');
})->name('home');

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/aset', [AsetController::class, 'index'])->name('aset.public');
Route::get('/aset/barang', [AsetController::class, 'barang'])->name('aset.barang');
Route::get('/aset/barang/{id}', [AsetController::class, 'showBarang'])->name('aset.barang.detail');
Route::get('/aset/barang/{id}/photos', [AsetController::class, 'getBarangPhotos'])->name('aset.barang.photos');


Route::get('/profil', function () {
    return view('profil');
})->name('profil');
/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Logout
    Route::post('/logout', function(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('aset.public')->with('success', 'Anda berhasil logout.');
    })->name('logout');

    // Assets (User)
    Route::get('/user/barang', [AsetController::class, 'userBarang'])->name('user.barang');
    Route::get('/user/barang/{id}', [AsetController::class, 'userShowBarang'])->name('user.barang.detail');

    // Cart Routes
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', function() {
            return view('cart.index');
        })->name('index');
    });

    // Profile Routes dengan OTP & Avatar
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/update', [ProfileController::class, 'update'])->name('update');
        
        // Password OTP Routes
        Route::post('/password/request-otp', [ProfileController::class, 'requestPasswordOtp'])->name('password.request-otp');
        Route::patch('/password', [ProfileController::class, 'updatePasswordWithOtp'])->name('password.update');
        
        // Avatar Routes
        Route::delete('/avatar', [ProfileController::class, 'deleteAvatar'])->name('avatar.delete');
        
        // Delete Account
        Route::delete('/destroy', [ProfileController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [\App\Http\Controllers\NotificationController::class, 'index'])->name('index');
        Route::get('/unread', [\App\Http\Controllers\NotificationController::class, 'getUnread'])->name('unread');
        Route::post('/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('read');
        Route::post('/mark-all-read', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('mark-all-read');
        Route::delete('/{id}', [\App\Http\Controllers\NotificationController::class, 'destroy'])->name('destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | USER ROUTES - PERMOHONAN (PRIMARY FLOW)
    |--------------------------------------------------------------------------
    */
    Route::prefix('permohonan')->name('permohonan.')->group(function () {
        Route::get('/', [PermohonanController::class, 'index'])->name('index');
        Route::get('/create', [PermohonanController::class, 'create'])->name('create');
        Route::post('/', [PermohonanController::class, 'store'])->name('store');
        Route::get('/{permohonan}', [PermohonanController::class, 'show'])->name('show');
        Route::get('/{permohonan}/edit', [PermohonanController::class, 'edit'])->name('edit');
        Route::patch('/{permohonan}', [PermohonanController::class, 'update'])->name('update');
        Route::delete('/{permohonan}', [PermohonanController::class, 'destroy'])->name('destroy');
        Route::get('/{permohonan}/download-draft', [PermohonanController::class, 'downloadDraft'])->name('downloadDraft');
        Route::post('/{permohonan}/upload-surat-ttd', [PermohonanController::class, 'uploadSuratTtd'])->name('uploadSuratTtd');
        Route::get('/{permohonan}/view-surat-ttd', [PermohonanController::class, 'viewSuratTtd'])->name('viewSuratTtd');
    });

    /*
    |--------------------------------------------------------------------------
    | USER ROUTES - PEMINJAMAN (VIEW ONLY)
    |--------------------------------------------------------------------------
    */
    Route::prefix('peminjaman')->name('peminjaman.')->group(function () {
        Route::get('/', [PeminjamanController::class, 'index'])->name('index');
        Route::get('/{peminjaman}', [PeminjamanController::class, 'show'])->name('show');
    });

    /*
    |--------------------------------------------------------------------------
    | USER ROUTES - PEMBAYARAN
    |--------------------------------------------------------------------------
    */
    Route::prefix('pembayaran')->name('pembayaran.')->group(function () {
        Route::get('/', [PembayaranController::class, 'index'])->name('index');
        Route::get('/{pembayaran}', [PembayaranController::class, 'show'])->name('show');
        Route::post('/{peminjaman}/bayar', [PembayaranController::class, 'bayar'])->name('bayar');
        Route::post('/{pembayaran}/upload-bukti', [PembayaranController::class, 'uploadBukti'])->name('upload-bukti');
    });

        /*
        |--------------------------------------------------------------------------
        | ADMIN & SUPER ADMIN ROUTES
        |--------------------------------------------------------------------------
        */
        Route::middleware(['role:admin,super_admin'])->group(function () {
        
        /*
        | ADMIN PERMOHONAN MANAGEMENT
        */
        Route::prefix('admin/permohonan')->name('admin.permohonan.')->group(function () {
            Route::get('/', [PermohonanController::class, 'adminIndex'])->name('index');
            Route::get('/export', [PermohonanController::class, 'export'])->name('export');
            Route::get('/{permohonan}', [PermohonanController::class, 'adminShow'])->name('show');
            Route::post('/{permohonan}/approve', [PermohonanController::class, 'approve'])->name('approve');
            Route::post('/{permohonan}/reject', [PermohonanController::class, 'reject'])->name('reject');

            Route::get('/{permohonan}/view-surat-ttd', [PermohonanController::class, 'viewSuratTtd'])->name('viewSuratTtd');
            Route::get('/{permohonan}/download-surat-ttd', [PermohonanController::class, 'downloadSuratTtd'])->name('downloadSuratTtd');
        });

        /*
        | ADMIN PEMINJAMAN MANAGEMENT 
        */
        Route::prefix('admin/peminjaman')->name('admin.peminjaman.')->group(function () {
            Route::get('/', [PeminjamanController::class, 'adminIndex'])->name('index');
            Route::get('/export', [PeminjamanController::class, 'export'])->name('export');
            Route::get('/{peminjaman}', [PeminjamanController::class, 'adminShow'])->name('show');
            Route::get('/{peminjaman}/edit', [PeminjamanController::class, 'edit'])->name('edit');
            Route::patch('/{peminjaman}', [PeminjamanController::class, 'update'])->name('update');
            Route::post('/{peminjaman}/approve', [PeminjamanController::class, 'approve'])->name('approve');
            Route::post('/{peminjaman}/reject', [PeminjamanController::class, 'reject'])->name('reject');
            Route::post('/{peminjaman}/selesai', [PeminjamanController::class, 'selesai'])->name('selesai');
            
            // Berita Acara
            Route::get('/{peminjaman}/berita-acara/download', [PeminjamanController::class, 'printBeritaAcara'])->name('berita-acara.download');

        });

        /*
        | ADMIN PEMBAYARAN MANAGEMENT
        */
        Route::prefix('admin/pembayaran')->name('admin.pembayaran.')->group(function () {
            Route::get('/', [PembayaranController::class, 'adminIndex'])->name('index');
            Route::get('/export', [PembayaranController::class, 'export'])->name('export');
            Route::get('/{pembayaran}', [PembayaranController::class, 'adminShow'])->name('show');
            Route::post('/{pembayaran}/konfirmasi', [PembayaranController::class, 'konfirmasi'])->name('konfirmasi');
            Route::post('/{pembayaran}/tolak', [PembayaranController::class, 'tolakPembayaran'])->name('tolak');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | SUPER ADMIN + PENGURUS ASET ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:super_admin,pengurus_aset'])->group(function () {
        // Kategori Barang
        Route::prefix('admin/kategori-barang')->name('admin.kategori-barang.')->group(function () {
            Route::resource('/', KategoriBarangController::class)->parameters(['' => 'kategoriBarang']);
        });

        // Barang Management
        Route::prefix('admin/barang')->name('admin.barang.')->group(function () {
            Route::post('/{barang}/maintenance', [BarangController::class, 'maintenance'])->name('maintenance');
            Route::post('/{barang}/activate', [BarangController::class, 'activate'])->name('activate');
            Route::post('/{barang}/update-status', [BarangController::class, 'updateStatus'])->name('update-status');
            Route::post('/{barang}/update-kondisi', [BarangController::class, 'updateKondisi'])->name('update-kondisi');
            Route::post('/{id}/toggle-dapat-dipinjam', [BarangController::class, 'toggleDapatDipinjam'])->name('toggle-dapat-dipinjam');
            Route::get('/template', [BarangController::class, 'downloadTemplate'])->name('template');
            Route::get('/export', [BarangController::class, 'export'])->name('export');
            Route::post('/import', [BarangController::class, 'import'])->name('import');
            Route::get('/generate-code', [BarangController::class, 'generateCode'])->name('generate-code');
            
            Route::prefix('{barang}/foto')->name('foto.')->group(function () {
            Route::get('/', [BarangController::class, 'getFotos'])->name('list'); 
            Route::post('/', [BarangController::class, 'uploadFoto'])->name('upload'); 
            Route::post('{foto}/set-primary', [BarangController::class, 'setPrimaryFoto'])->name('set-primary');
            Route::put('{foto}/keterangan', [BarangController::class, 'updateKeteranganFoto'])->name('update-keterangan');
            Route::post('{foto}/urutan', [BarangController::class, 'updateUrutanFoto'])->name('update-urutan'); 
            Route::delete('{foto}', [BarangController::class, 'deleteFoto'])->name('delete');
        });

            //Resource routes TERAKHIR
            Route::resource('', BarangController::class)->parameters(['' => 'barang']);
        });

        //Maintenance Management (untuk halaman list maintenance)
        Route::prefix('admin/maintenance')->name('admin.maintenance.')->group(function () {
            Route::get('/', [MaintenanceController::class, 'index'])->name('index');
            Route::get('/create', [MaintenanceController::class, 'create'])->name('create');
            Route::get('/export', [MaintenanceController::class, 'export'])->name('export'); 
            Route::post('/', [MaintenanceController::class, 'store'])->name('store');
            Route::get('/{maintenance}', [MaintenanceController::class, 'show'])->name('show');
            Route::get('/{maintenance}/edit', [MaintenanceController::class, 'edit'])->name('edit');
            Route::patch('/{maintenance}', [MaintenanceController::class, 'update'])->name('update');
            Route::delete('/{maintenance}', [MaintenanceController::class, 'destroy'])->name('destroy');
            Route::post('/{maintenance}/complete', [MaintenanceController::class, 'complete'])->name('complete');
            Route::post('/{maintenance}/cancel', [MaintenanceController::class, 'cancel'])->name('cancel');
        });
    });
    /*
    |--------------------------------------------------------------------------
    | SUPER ADMIN ONLY ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:super_admin'])->group(function () {
        // User Management
        Route::prefix('admin/users')->name('admin.users.')->group(function () {
            Route::resource('/', UserController::class)->parameters(['' => 'user']);
        });
      
        // Log Aktivitas
        Route::prefix('admin/log-aktivitas')->name('admin.log-aktivitas.')->group(function () {
            Route::get('/', [LogAktivitasController::class, 'index'])->name('index');
            Route::get('/{logAktivitas}', [LogAktivitasController::class, 'show'])->name('show');
            Route::delete('/{logAktivitas}', [LogAktivitasController::class, 'destroy'])->name('destroy');
            Route::delete('/clear-old/{days}', [LogAktivitasController::class, 'clearOldLogs'])->name('clear-old');
            Route::get('/export/csv', [LogAktivitasController::class, 'export'])->name('export');
            
            // API Routes
            Route::get('/api/recent', [LogAktivitasController::class, 'getRecentActivities'])->name('api.recent');
            Route::get('/api/statistics', [LogAktivitasController::class, 'getStatistics'])->name('api.statistics');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | AJAX ROUTES (untuk dynamic dropdown, dll)
    |--------------------------------------------------------------------------
    */
    Route::prefix('api')->name('api.')->group(function () {
        Route::get('/aset/{jenis}', [AsetController::class, 'getAsetByJenis'])->name('aset.by-jenis');
        Route::get('/barang/available', [BarangController::class, 'getAvailable'])->name('barang.available');
        Route::get('/barang/{barang}/check-availability', [BarangController::class, 'checkAvailability'])->name('barang.check-availability');
        Route::get('/barang/{id}', [AsetController::class, 'getBarangDetail'])->name('barang.detail');
        Route::get('/dashboard/barang-stats', [DashboardController::class, 'getBarangStats'])->name('dashboard.barang-stats');
        Route::get('/dashboard/chart-data', [DashboardController::class, 'getChartData'])->name('dashboard.chart-data');
        Route::get('/users', [UserController::class, 'getUsers'])->name('users.list');
        Route::get('/api/super-admin-dashboard-stats', [DashboardController::class, 'getStats']);
        Route::get('/barang/{barang}/status', [BarangController::class, 'checkStatus'])->name('barang.status');
    });
});

require __DIR__.'/auth.php';