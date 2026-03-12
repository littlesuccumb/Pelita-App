@extends('auth.layout')

@section('title', 'Verifikasi Email - Cimahi Techno Park')

@section('header-title', 'Verifikasi Email')
@section('header-subtitle', 'Aktifkan akun Anda')

@section('content')
<!-- Compact Session Status -->
@if (session('status') == 'verification-link-sent')
    <div class="mb-4 p-3 bg-green-500/20 border border-green-400/30 rounded-lg backdrop-blur-sm fade-in session-message">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-400 mr-2 text-sm"></i>
            <p class="text-green-100 text-sm">
                Link verifikasi baru telah dikirim ke alamat email yang Anda daftarkan.
            </p>
        </div>
    </div>
@endif

<!-- Main Information -->
<div class="mb-6 p-4 bg-blue-500/20 border border-blue-400/30 rounded-lg backdrop-blur-sm">
    <div class="flex items-start">
        <i class="fas fa-envelope-open-text text-blue-400 mr-3 text-sm mt-0.5"></i>
        <div>
            <p class="text-blue-100 text-sm mb-2">
                Terima kasih sudah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik link yang telah kami kirimkan.
            </p>
            <p class="text-blue-200 text-xs">
                Jika Anda tidak menerima email, kami dengan senang hati akan mengirimkan yang baru.
            </p>
        </div>
    </div>
</div>

<!-- User Email Display -->
<div class="mb-6 p-3 bg-white/5 border border-white/20 rounded-lg backdrop-blur-sm">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <i class="fas fa-user text-white/50 mr-3 text-sm"></i>
            <div>
                <p class="text-white/90 text-sm font-medium">{{ Auth::user()->name }}</p>
                <p class="text-white/60 text-xs">{{ Auth::user()->email }}</p>
            </div>
        </div>
        <div class="px-2 py-1 bg-yellow-500/20 border border-yellow-400/30 rounded-full">
            <span class="text-yellow-300 text-xs font-medium">
                <i class="fas fa-clock mr-1"></i>
                Pending
            </span>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="form-spacing" style="display: flex; flex-direction: column; gap: 1.25rem;">
    
    <!-- Resend Verification Button -->
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" 
                class="btn-hover w-full py-3 px-6 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-300 shadow-lg transition-colors">
            <i class="fas fa-paper-plane mr-2"></i>
            Kirim Ulang Email Verifikasi
        </button>
    </form>

    <!-- Email Instructions -->
    <div class="p-4 bg-gray-500/10 border border-gray-400/20 rounded-lg backdrop-blur-sm">
        <div class="text-center">
            <i class="fas fa-lightbulb text-yellow-400 text-lg mb-2"></i>
            <h4 class="text-white/90 text-sm font-semibold mb-2">Tips Verifikasi</h4>
            <ul class="text-white/70 text-xs space-y-1 text-left">
                <li class="flex items-center">
                    <i class="fas fa-check text-green-400 mr-2 text-xs"></i>
                    Periksa folder inbox email Anda
                </li>
                <li class="flex items-center">
                    <i class="fas fa-check text-green-400 mr-2 text-xs"></i>
                    Cek juga folder spam/junk
                </li>
                <li class="flex items-center">
                    <i class="fas fa-check text-green-400 mr-2 text-xs"></i>
                    Email mungkin membutuhkan beberapa menit
                </li>
                <li class="flex items-center">
                    <i class="fas fa-check text-green-400 mr-2 text-xs"></i>
                    Pastikan alamat email benar
                </li>
            </ul>
        </div>
    </div>

    <!-- Compact Divider -->
    <div class="relative py-2">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-white/20"></div>
        </div>
        <div class="relative flex justify-center text-xs">
            <span class="px-3 bg-transparent text-white/60 font-medium">ATAU</span>
        </div>
    </div>

    <!-- Update Email Option -->
    <div class="text-center">
        <p class="text-white/70 text-xs mb-3">
            Email salah? Update profil Anda
        </p>
        <a href="{{ route('profile.edit') }}" 
           class="inline-flex items-center px-5 py-2.5 border-2 border-white/30 text-white font-semibold rounded-xl hover:bg-white/10 hover:border-white/50 transition-all duration-300 group text-sm">
            <i class="fas fa-edit mr-2 group-hover:scale-110 transition-transform"></i>
            Update Profil
        </a>
    </div>

    <!-- Logout Option -->
    <div class="text-center pt-4 border-t border-white/10">
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" 
                    class="text-white/60 hover:text-white/80 transition-colors text-xs font-medium">
                <i class="fas fa-sign-out-alt mr-1"></i>
                Keluar dari Akun
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-hide session messages
    document.addEventListener('DOMContentLoaded', function() {
        const sessionMessage = document.querySelector('.session-message');
        if (sessionMessage) {
            setTimeout(() => {
                sessionMessage.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                sessionMessage.style.opacity = '0';
                sessionMessage.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    sessionMessage.remove();
                }, 300);
            }, 8000); // Show longer for verification messages
        }

        // Countdown timer for resend button
        let resendButton = document.querySelector('button[type="submit"]');
        let canResend = true;
        let countdown = 60;

        function startCountdown() {
            if (!canResend) return;
            
            canResend = false;
            let originalText = resendButton.innerHTML;
            
            const timer = setInterval(() => {
                resendButton.innerHTML = `<i class="fas fa-clock mr-2"></i>Tunggu ${countdown}s`;
                resendButton.disabled = true;
                resendButton.classList.add('opacity-50', 'cursor-not-allowed');
                
                countdown--;
                
                if (countdown < 0) {
                    clearInterval(timer);
                    resendButton.innerHTML = originalText;
                    resendButton.disabled = false;
                    resendButton.classList.remove('opacity-50', 'cursor-not-allowed');
                    canResend = true;
                    countdown = 60;
                }
            }, 1000);
        }

        // Start countdown if verification was just sent
        if (sessionMessage && sessionMessage.textContent.includes('Link verifikasi baru')) {
            startCountdown();
        }

        // Add countdown on form submit
        if (resendButton) {
            resendButton.closest('form').addEventListener('submit', function(e) {
                if (!canResend) {
                    e.preventDefault();
                    return false;
                }
                setTimeout(startCountdown, 1000);
            });
        }
    });
</script>
@endpush