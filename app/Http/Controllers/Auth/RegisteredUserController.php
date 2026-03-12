<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\RegistrationOtp;
use App\Mail\RegistrationOtpMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Step 1: Validasi data dan kirim OTP
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', 'min:8'],
            'terms' => ['required', 'accepted'],
            'jabatan' => ['nullable', 'string', 'max:255'],
            'no_telp' => ['nullable', 'string', 'max:20'],
            'instansi' => ['nullable', 'string', 'max:255'],
            'nama_organisasi' => ['nullable', 'string', 'max:255'],
            'no_ktp' => ['nullable', 'string', 'size:16', 'regex:/^[0-9]{16}$/', 'unique:users'],
            'alamat' => ['nullable', 'string', 'max:500'],
            'kelurahan' => ['nullable', 'string', 'max:100'],
            'kecamatan' => ['nullable', 'string', 'max:100'],
            'kabupaten' => ['nullable', 'string', 'max:100'],
            'kode_pos' => ['nullable', 'string', 'size:5', 'regex:/^[0-9]{5}$/'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'terms.required' => 'Anda harus menyetujui syarat dan ketentuan.',
            'no_ktp.size' => 'Nomor KTP harus 16 digit.',
            'no_ktp.unique' => 'Nomor KTP sudah terdaftar.',
            'kode_pos.size' => 'Kode pos harus 5 digit.',
        ]);

        // Generate OTP
        $otp = RegistrationOtp::generateOTP();
        
        // Hapus OTP lama yang belum terpakai untuk email ini
        RegistrationOtp::where('email', $request->email)
            ->where('is_used', false)
            ->delete();
        
        // Simpan OTP baru
        RegistrationOtp::create([
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);

        // Kirim email OTP
        try {
            Mail::to($request->email)->send(new RegistrationOtpMail($otp, $request->name));
            
            // Simpan data registrasi di session (tanpa password hash)
            session([
                'registration_data' => [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password, // Akan di-hash saat verifikasi
                    'jabatan' => $request->jabatan,
                    'instansi' => $request->instansi,
                    'no_telp' => $request->no_telp,
                    'alamat' => $request->alamat,
                    'nama_organisasi' => $request->nama_organisasi,
                    'no_ktp' => $request->no_ktp,
                    'kelurahan' => $request->kelurahan,
                    'kecamatan' => $request->kecamatan,
                    'kabupaten' => $request->kabupaten,
                    'kode_pos' => $request->kode_pos,
                ]
            ]);

            return redirect()->route('register.verify')
                ->with('success', 'Kode OTP telah dikirim ke email Anda. Silakan cek inbox/spam.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal mengirim OTP. Silakan coba lagi.');
        }
    }

    /**
     * Step 2: Tampilkan form verifikasi OTP
     */
    public function showVerifyForm()
    {
        if (!session()->has('registration_data')) {
            return redirect()->route('register')
                ->with('error', 'Session expired. Silakan registrasi ulang.');
        }

        return view('auth.verify-otp');
    }

    /**
     * Step 3: Verifikasi OTP dan buat user
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => ['required', 'string', 'size:6', 'regex:/^[0-9]{6}$/'],
        ], [
            'otp.required' => 'Kode OTP wajib diisi.',
            'otp.size' => 'Kode OTP harus 6 digit.',
            'otp.regex' => 'Kode OTP harus berupa angka.',
        ]);

        $registrationData = session('registration_data');
        
        if (!$registrationData) {
            return back()->with('error', 'Session expired. Silakan registrasi ulang.');
        }

        // Cari OTP yang valid
        $otpRecord = RegistrationOtp::where('email', $registrationData['email'])
            ->where('otp', $request->otp)
            ->where('is_used', false)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otpRecord) {
            return back()->with('error', 'Kode OTP tidak valid atau sudah kedaluwarsa.');
        }

        try {
            DB::beginTransaction();

            // Tandai OTP sebagai terpakai
            $otpRecord->markAsUsed();

            // Buat user baru
            $user = User::create([
                'name' => $registrationData['name'],
                'email' => $registrationData['email'],
                'password' => Hash::make($registrationData['password']),
                'role' => 'user',
                'jabatan' => $registrationData['jabatan'],
                'instansi' => $registrationData['instansi'],
                'no_telp' => $registrationData['no_telp'],
                'alamat' => $registrationData['alamat'],
                'nama_organisasi' => $registrationData['nama_organisasi'],
                'no_ktp' => $registrationData['no_ktp'],
                'kelurahan' => $registrationData['kelurahan'],
                'kecamatan' => $registrationData['kecamatan'],
                'kabupaten' => $registrationData['kabupaten'],
                'kode_pos' => $registrationData['kode_pos'],
            ]);

            event(new Registered($user));

            DB::commit();

            // Hapus session registrasi
            session()->forget('registration_data');

            return redirect()->route('login')
                ->with('success', 'Registrasi berhasil! Silakan login untuk melanjutkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    /**
     * Kirim ulang OTP
     */
    public function resendOtp(Request $request)
    {
        $registrationData = session('registration_data');
        
        if (!$registrationData) {
            return response()->json([
                'success' => false,
                'message' => 'Session expired. Silakan registrasi ulang.'
            ], 400);
        }

        // Generate OTP baru
        $otp = RegistrationOtp::generateOTP();
        
        // Hapus OTP lama
        RegistrationOtp::where('email', $registrationData['email'])
            ->where('is_used', false)
            ->delete();
        
        // Simpan OTP baru
        RegistrationOtp::create([
            'email' => $registrationData['email'],
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);

        // Kirim email
        try {
            Mail::to($registrationData['email'])->send(
                new RegistrationOtpMail($otp, $registrationData['name'])
            );

            return response()->json([
                'success' => true,
                'message' => 'Kode OTP baru telah dikirim ke email Anda.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim OTP. Silakan coba lagi.'
            ], 500);
        }
    }
}