@extends('auth.layout')

@section('title', 'Lupa Password - Cimahi Techno Park')

@section('header-title', 'Lupa Password?')
@section('header-subtitle', 'Reset kata sandi Anda')

@section('content')
<!-- Compact Session Status -->
@if (session('status'))
    <div class="mb-4 p-3 bg-green-500/20 border border-green-400/30 rounded-lg backdrop-blur-sm fade-in session-message">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-400 mr-2 text-sm"></i>
            <p class="text-green-100 text-sm">{{ session('status') }}</p>
        </div>
    </div>
@endif

<!-- Information Text -->
<div class="mb-6 p-4 bg-blue-500/20 border border-blue-400/30 rounded-lg backdrop-blur-sm">
    <div class="flex items-start">
        <i class="fas fa-info-circle text-blue-400 mr-3 text-sm mt-0.5"></i>
        <div>
            <p class="text-blue-100 text-sm">
                Masukkan alamat email Anda dan kami akan mengirimkan link untuk reset password.
            </p>
        </div>
    </div>
</div>

<!-- Compact Forgot Password Form -->
<form method="POST" action="{{ route('password.email') }}" class="form-spacing" style="display: flex; flex-direction: column; gap: 1.25rem;">
    @csrf

    <!-- Email Field - Compact -->
    <div class="space-y-1">
        <label for="email" class="block text-white/90 text-sm font-semibold">
            <i class="fas fa-envelope mr-2 text-white/70"></i>
            Email
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-envelope text-white/50 text-sm"></i>
            </div>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus
                   class="input-focus input-height w-full pl-10 pr-4 bg-white/10 border border-white/30 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 backdrop-blur-sm @error('email') border-red-400 focus:ring-red-400 shake-animation @enderror"
                   style="padding-top: 0.875rem; padding-bottom: 0.875rem;"
                   placeholder="nama@email.com">
        </div>
        @error('email')
            <p class="text-red-300 text-xs mt-1 flex items-center">
                <i class="fas fa-exclamation-triangle mr-1"></i>
                {{ $message }}
            </p>
        @enderror
    </div>

    <!-- Compact Send Reset Link Button -->
    <button type="submit" 
            class="btn-hover w-full py-3 px-6 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-300 shadow-lg transition-colors">
        <i class="fas fa-paper-plane mr-2"></i>
        Kirim Link Reset
    </button>

    <!-- Compact Divider -->
    <div class="relative py-2">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-white/20"></div>
        </div>
        <div class="relative flex justify-center text-xs">
            <span class="px-3 bg-transparent text-white/60 font-medium">ATAU</span>
        </div>
    </div>

    <!-- Compact Back to Login Link -->
    <div class="text-center">
        <p class="text-white/70 text-xs mb-3">
            Ingat password Anda?
        </p>
        <a href="{{ route('login') }}" 
           class="inline-flex items-center px-5 py-2.5 border-2 border-white/30 text-white font-semibold rounded-xl hover:bg-white/10 hover:border-white/50 transition-all duration-300 group text-sm">
            <i class="fas fa-arrow-left mr-2 group-hover:scale-110 transition-transform"></i>
            Kembali ke Login
        </a>
    </div>
</form>
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
            }, 8000); // Show longer for important messages
        }
    });
</script>
@endpush