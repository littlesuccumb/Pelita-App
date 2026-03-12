@extends('auth.layout')

@section('title', 'Login - Cimahi Techno Park')

@section('header-title', 'Welcome Back')
@section('header-subtitle', 'Masuk ke sistem')

@section('content')

<!-- Success Message (Registration, Password Reset, etc) -->
@if (session('success'))
    <div class="mb-4 p-4 bg-green-500/20 border border-green-400/30 rounded-lg backdrop-blur-sm fade-in session-message">
        <div class="flex items-start">
            <i class="fas fa-check-circle text-green-400 mr-3 text-lg mt-0.5"></i>
            <div>
                <p class="text-green-100 text-sm font-medium mb-1">Berhasil!</p>
                <p class="text-green-100 text-xs">{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

<!-- Status Message (for password.request, etc) -->
@if (session('status'))
    <div class="mb-4 p-3 bg-blue-500/20 border border-blue-400/30 rounded-lg backdrop-blur-sm fade-in session-message">
        <div class="flex items-center">
            <i class="fas fa-info-circle text-blue-400 mr-2 text-sm"></i>
            <p class="text-blue-100 text-sm">{{ session('status') }}</p>
        </div>
    </div>
@endif

<!-- Error Message -->
@if (session('error'))
    <div class="mb-4 p-4 bg-red-500/20 border border-red-400/30 rounded-lg backdrop-blur-sm fade-in session-message">
        <div class="flex items-start">
            <i class="fas fa-exclamation-circle text-red-400 mr-3 text-lg mt-0.5"></i>
            <div>
                <p class="text-red-100 text-sm font-medium mb-1">Gagal!</p>
                <p class="text-red-100 text-xs">{{ session('error') }}</p>
            </div>
        </div>
    </div>
@endif

<!-- Compact Login Form -->
<form method="POST" action="{{ route('login') }}" class="form-spacing" style="display: flex; flex-direction: column; gap: 1.25rem;">
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
                   autocomplete="off"
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

    <!-- Password Field - Compact -->
    <div class="space-y-1">
        <label for="password" class="block text-white/90 text-sm font-semibold">
            <i class="fas fa-lock mr-2 text-white/70"></i>
            Password
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-lock text-white/50 text-sm"></i>
            </div>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="current-password"
                   class="input-focus input-height w-full pl-10 pr-10 bg-white/10 border border-white/30 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 backdrop-blur-sm @error('password') border-red-400 focus:ring-red-400 shake-animation @enderror"
                   style="padding-top: 0.875rem; padding-bottom: 0.875rem;"
                   placeholder="Kata sandi">
            <button type="button" 
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-white/50 hover:text-white/80 transition-colors"
                    onclick="togglePassword()">
                <i id="toggleIcon" class="fas fa-eye text-xs"></i>
            </button>
        </div>
        @error('password')
            <p class="text-red-300 text-xs mt-1 flex items-center">
                <i class="fas fa-exclamation-triangle mr-1"></i>
                {{ $message }}
            </p>
        @enderror
    </div>

    <!-- Compact Remember Me & Forgot Password -->
    <div class="flex items-center justify-between text-xs">
        <label class="flex items-center cursor-pointer group">
            <input type="checkbox" 
                   name="remember" 
                   class="rounded border-white/30 text-techno-blue focus:ring-white/50 focus:ring-offset-0 bg-white/10 transition-colors duration-200"
                   style="width: 0.875rem; height: 0.875rem;">
            <span class="ml-2 text-white/80 group-hover:text-white transition-colors">Remember me</span>
        </label>
        
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" 
               class="text-white/80 hover:text-white transition-colors font-medium">
                Lupa password?
            </a>
        @endif
    </div>

    <!-- Compact Login Button -->
    <button type="submit" id="loginBtn"
            class="btn-hover w-full py-3 px-6 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-300 shadow-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
        <span id="loginBtnText">
            <i class="fas fa-sign-in-alt mr-2"></i>
            Masuk
        </span>
        <span id="loginBtnLoading" style="display: none;">
            <i class="fas fa-spinner fa-spin mr-2"></i>
            Memproses...
        </span>
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

<!-- Compact Register Link -->
    <div class="text-center space-y-3">
        <div>
            <p class="text-white/70 text-xs mb-3">
                Belum punya akun?
            </p>
            <a href="{{ route('register') }}" 
               class="inline-flex items-center px-5 py-2.5 border-2 border-white/30 text-white font-semibold rounded-xl hover:bg-white/10 hover:border-white/50 transition-all duration-300 group text-sm">
                <i class="fas fa-user-plus mr-2 group-hover:scale-110 transition-transform"></i>
                Daftar Baru
            </a>
        </div>
        
        <div class="pt-3 border-t border-white/10">
            <a href="{{ route('aset.public') }}" 
               class="inline-flex items-center text-white/70 hover:text-white text-sm transition-colors group">
                <i class="fas fa-home mr-2 group-hover:scale-110 transition-transform"></i>
                Kembali ke Halaman Awal
            </a>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    // Password visibility toggle
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }

    // Auto-hide session messages with animation
    document.addEventListener('DOMContentLoaded', function() {
        const sessionMessages = document.querySelectorAll('.session-message');
        
        sessionMessages.forEach(message => {
            // Add entrance animation
            message.style.animation = 'slideInDown 0.5s ease-out';
            
            // Auto hide after 5 seconds
            setTimeout(() => {
                message.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                message.style.opacity = '0';
                message.style.transform = 'translateY(-20px)';
                
                setTimeout(() => {
                    message.remove();
                }, 500);
            }, 5000);
        });

        // Login form submit animation
        document.querySelector('form').addEventListener('submit', function(e) {
            const loginBtn = document.getElementById('loginBtn');
            const loginBtnText = document.getElementById('loginBtnText');
            const loginBtnLoading = document.getElementById('loginBtnLoading');
            
            loginBtn.disabled = true;
            loginBtnText.style.display = 'none';
            loginBtnLoading.style.display = 'inline';
        });
    });
</script>

<style>
    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .fade-in {
        animation: slideInDown 0.5s ease-out;
    }
</style>
@endpush