@extends('auth.layout')

@section('title', 'Konfirmasi Password - Cimahi Techno Park')

@section('header-title', 'Konfirmasi Password')
@section('header-subtitle', 'Verifikasi identitas Anda')

@section('content')
<!-- Information Text -->
<div class="mb-6 p-4 bg-amber-500/20 border border-amber-400/30 rounded-lg backdrop-blur-sm">
    <div class="flex items-start">
        <i class="fas fa-shield-alt text-amber-400 mr-3 text-sm mt-0.5"></i>
        <div>
            <p class="text-amber-100 text-sm">
                Ini adalah area yang aman. Mohon konfirmasi password Anda untuk melanjutkan.
            </p>
        </div>
    </div>
</div>

<!-- Compact Confirm Password Form -->
<form method="POST" action="{{ route('password.confirm') }}" class="form-spacing" style="display: flex; flex-direction: column; gap: 1.25rem;">
    @csrf

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
                   autofocus
                   class="input-focus input-height w-full pl-10 pr-10 bg-white/10 border border-white/30 rounded-xl text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 backdrop-blur-sm @error('password') border-red-400 focus:ring-red-400 shake-animation @enderror"
                   style="padding-top: 0.875rem; padding-bottom: 0.875rem;"
                   placeholder="Masukkan password Anda">
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

    <!-- Security Notice -->
    <div class="p-3 bg-blue-500/10 border border-blue-400/20 rounded-lg backdrop-blur-sm">
        <div class="flex items-center text-blue-200 text-xs">
            <i class="fas fa-info-circle mr-2"></i>
            <span>Konfirmasi password diperlukan untuk mengakses fitur keamanan tinggi</span>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col space-y-3">
        <!-- Compact Confirm Button -->
        <button type="submit" 
                class="btn-hover w-full py-3 px-6 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl focus:outline-none focus:ring-4 focus:ring-blue-300 shadow-lg transition-colors">
            <i class="fas fa-check-circle mr-2"></i>
            Konfirmasi Password
        </button>

        <!-- Compact Cancel Button -->
        <a href="{{ url()->previous() }}" 
           class="inline-flex items-center justify-center px-5 py-2.5 border-2 border-white/30 text-white font-semibold rounded-xl hover:bg-white/10 hover:border-white/50 transition-all duration-300 group text-sm">
            <i class="fas fa-times mr-2 group-hover:scale-110 transition-transform"></i>
            Batal
        </a>
    </div>

    <!-- Help Section -->
    <div class="text-center pt-4 border-t border-white/10">
        <p class="text-white/60 text-xs mb-2">
            Lupa password?
        </p>
        <a href="{{ route('password.request') }}" 
           class="text-blue-300 hover:text-blue-200 transition-colors text-xs font-medium">
            <i class="fas fa-key mr-1"></i>
            Reset Password
        </a>
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

    // Auto-focus on password field
    document.addEventListener('DOMContentLoaded', function() {
        const passwordField = document.getElementById('password');
        if (passwordField) {
            passwordField.focus();
        }
    });
</script>
@endPush