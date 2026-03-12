@extends('auth.layout')

@section('title', 'Reset Password - Cimahi Techno Park')

@section('header-title', 'Reset Password')
@section('header-subtitle', 'Buat kata sandi baru')

@section('content')
<!-- Information Text -->
<div class="mb-6 p-4 bg-blue-500/20 border border-blue-400/30 rounded-lg backdrop-blur-sm">
    <div class="flex items-start">
        <i class="fas fa-shield-alt text-blue-400 mr-3 text-sm mt-0.5"></i>
        <div>
            <p class="text-blue-100 text-sm">
                Buat password baru yang kuat. Password minimal 8 karakter.
            </p>
        </div>
    </div>
</div>

<!-- Compact Reset Password Form -->
<form method="POST" action="{{ route('password.store') }}" class="form-spacing" style="display: flex; flex-direction: column; gap: 1.25rem;">
    @csrf

    <!-- Password Reset Token -->
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                   value="{{ old('email', $request->email) }}" 
                   required 
                   autofocus
                   autocomplete="username"
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
            Password Baru
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-lock text-white/50 text-sm"></i>
            </div>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="new-password"
                   class="input-focus input-height w-full pl-10 pr-10 bg-white/10 border border-white/30 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 backdrop-blur-sm @error('password') border-red-400 focus:ring-red-400 shake-animation @enderror"
                   style="padding-top: 0.875rem; padding-bottom: 0.875rem;"
                   placeholder="Kata sandi baru (min. 8 karakter)">
            <button type="button" 
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-white/50 hover:text-white/80 transition-colors"
                    onclick="togglePassword('password', 'toggleIcon1')">
                <i id="toggleIcon1" class="fas fa-eye text-xs"></i>
            </button>
        </div>
        @error('password')
            <p class="text-red-300 text-xs mt-1 flex items-center">
                <i class="fas fa-exclamation-triangle mr-1"></i>
                {{ $message }}
            </p>
        @enderror
    </div>

    <!-- Password Confirmation Field - Compact -->
    <div class="space-y-1">
        <label for="password_confirmation" class="block text-white/90 text-sm font-semibold">
            <i class="fas fa-lock mr-2 text-white/70"></i>
            Konfirmasi Password
        </label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-lock text-white/50 text-sm"></i>
            </div>
            <input id="password_confirmation" 
                   type="password" 
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password"
                   class="input-focus input-height w-full pl-10 pr-10 bg-white/10 border border-white/30 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 backdrop-blur-sm @error('password_confirmation') border-red-400 focus:ring-red-400 shake-animation @enderror"
                   style="padding-top: 0.875rem; padding-bottom: 0.875rem;"
                   placeholder="Ulangi kata sandi baru">
            <button type="button" 
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-white/50 hover:text-white/80 transition-colors"
                    onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                <i id="toggleIcon2" class="fas fa-eye text-xs"></i>
            </button>
        </div>
        @error('password_confirmation')
            <p class="text-red-300 text-xs mt-1 flex items-center">
                <i class="fas fa-exclamation-triangle mr-1"></i>
                {{ $message }}
            </p>
        @enderror
    </div>

    <!-- Password Strength Indicator -->
    <div class="space-y-2">
        <div class="text-xs text-white/70">Kekuatan Password:</div>
        <div class="flex space-x-1">
            <div id="strength-1" class="h-1 w-full bg-white/20 rounded-full transition-colors"></div>
            <div id="strength-2" class="h-1 w-full bg-white/20 rounded-full transition-colors"></div>
            <div id="strength-3" class="h-1 w-full bg-white/20 rounded-full transition-colors"></div>
            <div id="strength-4" class="h-1 w-full bg-white/20 rounded-full transition-colors"></div>
        </div>
        <div id="strength-text" class="text-xs text-white/60">Masukkan password</div>
    </div>

    <!-- Compact Reset Password Button -->
    <button type="submit" 
            class="btn-hover w-full py-3 px-6 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-300 shadow-lg transition-colors">
        <i class="fas fa-key mr-2"></i>
        Reset Password
    </button>
</form>
@endsection

@push('scripts')
<script>
    // Password visibility toggle
    function togglePassword(fieldId, iconId) {
        const passwordField = document.getElementById(fieldId);
        const toggleIcon = document.getElementById(iconId);
        
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

    // Password strength checker
    function checkPasswordStrength(password) {
        let strength = 0;
        let feedback = '';

        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
        if (/\d/.test(password)) strength++;
        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength++;

        const indicators = ['strength-1', 'strength-2', 'strength-3', 'strength-4'];
        const colors = ['bg-red-400', 'bg-yellow-400', 'bg-blue-400', 'bg-green-400'];
        const texts = ['Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'];

        // Reset all indicators
        indicators.forEach(id => {
            const element = document.getElementById(id);
            element.className = 'h-1 w-full bg-white/20 rounded-full transition-colors';
        });

        // Set active indicators
        for (let i = 0; i < strength; i++) {
            const element = document.getElementById(indicators[i]);
            element.classList.add(colors[Math.min(strength - 1, 3)]);
        }

        // Update text
        const strengthText = document.getElementById('strength-text');
        if (password.length === 0) {
            strengthText.textContent = 'Masukkan password';
            strengthText.className = 'text-xs text-white/60';
        } else {
            strengthText.textContent = texts[Math.min(strength - 1, 3)] || 'Lemah';
            strengthText.className = `text-xs ${strength >= 3 ? 'text-green-300' : strength >= 2 ? 'text-blue-300' : 'text-red-300'}`;
        }
    }

    // Add event listener for password strength
    document.addEventListener('DOMContentLoaded', function() {
        const passwordField = document.getElementById('password');
        passwordField.addEventListener('input', function() {
            checkPasswordStrength(this.value);
        });
    });
</script>
@endpush