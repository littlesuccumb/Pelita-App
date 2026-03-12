<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;
use App\Models\LogAktivitas;
use App\Models\PasswordResetOtp;
use App\Mail\PasswordResetOtpMail;

class ProfileController extends Controller
{
    /**
     * Display user profile
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get user statistics hanya untuk role 'user'
        $stats = null;
        if ($user->role === 'user') {
            $stats = [
                'total_permohonan' => $user->permohonan()->count(),
                'permohonan_disetujui' => $user->permohonan()->where('status', 'Disetujui')->count(),
                'total_peminjaman' => $user->peminjaman()->count(),
                'peminjaman_aktif' => $user->peminjaman()->where('status', 'disetujui')->count(),
            ];
        }
        
        // Get recent activities
        $recentActivities = LogAktivitas::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();
        
        return view('profile.index', compact('user', 'stats', 'recentActivities'));
    }
    
    /**
     * Show edit profile form
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }
    
    /**
     * Update profile information
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Max 2MB
            'no_telp' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string', 'max:500'],
            'no_ktp' => ['nullable', 'string', 'max:16'],
            'kelurahan' => ['nullable', 'string', 'max:100'],
            'kecamatan' => ['nullable', 'string', 'max:100'],
            'kabupaten' => ['nullable', 'string', 'max:100'],
            'kode_pos' => ['nullable', 'string', 'max:10'],
            'jabatan' => ['nullable', 'string', 'max:100'],
            'instansi' => ['nullable', 'string', 'max:255'],
            'nama_organisasi' => ['nullable', 'string', 'max:255'],
        ]);
        
        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar
            $user->deleteAvatar();
            
            // Upload new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }
        
        $user->update($validated);
        
        LogAktivitas::create([
            'user_id' => $user->id,
            'aksi' => 'Mengubah Profil',
            'detail' => 'Memperbarui informasi profil: ' . $user->name,
        ]);
        
        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
    }
    
    /**
     * Delete avatar
     */
    public function deleteAvatar()
    {
        $user = Auth::user();
        
        if ($user->avatar) {
            $user->deleteAvatar();
            $user->update(['avatar' => null]);
            
            LogAktivitas::create([
                'user_id' => $user->id,
                'aksi' => 'Menghapus Avatar',
                'detail' => 'Menghapus foto profil',
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Avatar berhasil dihapus',
                'avatar_url' => $user->avatar_url
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Avatar tidak ditemukan'
        ], 404);
    }
    
    /**
     * Request OTP untuk ganti password
     */
    public function requestPasswordOtp(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
        ]);
        
        $user = Auth::user();
        
        // Generate OTP
        $otp = PasswordResetOtp::generateOtp($user->id);
        
        // Kirim email OTP
        try {
            Mail::to($user->email)->send(new PasswordResetOtpMail($otp, $user->name));
            
            LogAktivitas::create([
                'user_id' => $user->id,
                'aksi' => 'Request OTP Password',
                'detail' => 'Meminta kode OTP untuk ganti password',
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Kode OTP telah dikirim ke email Anda. Silakan cek inbox/spam.'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim OTP. Silakan coba lagi.'
            ], 500);
        }
    }
    
    /**
     * Verify OTP dan update password
     */
    public function updatePasswordWithOtp(Request $request)
    {
        $validated = $request->validate([
            'otp' => ['required', 'string', 'size:6'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);
        
        $user = Auth::user();
        
        // Verifikasi OTP
        if (!PasswordResetOtp::verify($user->id, $validated['otp'])) {
            return back()->withErrors([
                'otp' => 'Kode OTP tidak valid atau sudah kadaluarsa.'
            ])->withInput();
        }
        
        // Update password
        $user->update([
            'password' => Hash::make($validated['password'])
        ]);
        
        LogAktivitas::create([
            'user_id' => $user->id,
            'aksi' => 'Mengubah Password',
            'detail' => 'Memperbarui password akun dengan verifikasi OTP',
        ]);
        
        return redirect()->route('profile.index')->with('success', 'Password berhasil diperbarui!');
    }
    
    /**
     * Delete account
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);
        
        $user = Auth::user();
        
        LogAktivitas::create([
            'user_id' => $user->id,
            'aksi' => 'Menghapus Akun',
            'detail' => 'Pengguna menghapus akun: ' . $user->name,
        ]);
        
        Auth::logout();
        
        $user->delete();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('aset.public')->with('success', 'Akun berhasil dihapus.');
    }
}