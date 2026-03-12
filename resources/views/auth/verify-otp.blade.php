@extends('auth.layout')

@section('title', 'Verifikasi OTP - Cimahi Techno Park')

@section('header-title', 'Verifikasi Email')
@section('header-subtitle', 'Masukkan kode OTP yang telah dikirim')

@section('content')
<!-- Email Info -->
<div class="mb-6 p-4 bg-blue-500/20 border border-blue-400/30 rounded-lg backdrop-blur-sm">
    <div class="flex items-start">
        <i class="fas fa-envelope text-blue-400 mr-3 text-lg mt-0.5"></i>
        <div>
            <p class="text-blue-100 text-sm font-medium mb-1">Kode OTP telah dikirim</p>
            <p class="text-blue-100 text-xs">
                Silakan cek email <strong>{{ session('registration_data.email') }}</strong> 
                (termasuk folder spam)
            </p>
        </div>
    </div>
</div>

<!-- OTP Form -->
<form method="POST" action="{{ route('register.verify.post') }}" id="otpForm">
    @csrf

    <!-- OTP Input -->
    <div class="space-y-2 mb-6">
        <label class="block text-white/90 text-sm font-semibold text-center">
            <i class="fas fa-key mr-2 text-white/70"></i>
            Kode Verifikasi (6 Digit)
        </label>
        
        <!-- OTP Digit Inputs -->
        <div class="flex justify-center gap-2" id="otpInputs">
            <input type="text" 
                   maxlength="1" 
                   class="otp-input w-12 h-14 text-center text-2xl font-bold bg-white/10 border-2 border-white/30 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 backdrop-blur-sm transition-all @error('otp') border-red-400 @enderror"
                   data-index="0"
                   pattern="[0-9]"
                   inputmode="numeric">
            <input type="text" 
                   maxlength="1" 
                   class="otp-input w-12 h-14 text-center text-2xl font-bold bg-white/10 border-2 border-white/30 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 backdrop-blur-sm transition-all @error('otp') border-red-400 @enderror"
                   data-index="1"
                   pattern="[0-9]"
                   inputmode="numeric">
            <input type="text" 
                   maxlength="1" 
                   class="otp-input w-12 h-14 text-center text-2xl font-bold bg-white/10 border-2 border-white/30 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 backdrop-blur-sm transition-all @error('otp') border-red-400 @enderror"
                   data-index="2"
                   pattern="[0-9]"
                   inputmode="numeric">
            
            <div class="flex items-center mx-2">
                <span class="text-white/50 text-2xl font-bold">-</span>
            </div>
            
            <input type="text" 
                   maxlength="1" 
                   class="otp-input w-12 h-14 text-center text-2xl font-bold bg-white/10 border-2 border-white/30 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 backdrop-blur-sm transition-all @error('otp') border-red-400 @enderror"
                   data-index="3"
                   pattern="[0-9]"
                   inputmode="numeric">
            <input type="text" 
                   maxlength="1" 
                   class="otp-input w-12 h-14 text-center text-2xl font-bold bg-white/10 border-2 border-white/30 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 backdrop-blur-sm transition-all @error('otp') border-red-400 @enderror"
                   data-index="4"
                   pattern="[0-9]"
                   inputmode="numeric">
            <input type="text" 
                   maxlength="1" 
                   class="otp-input w-12 h-14 text-center text-2xl font-bold bg-white/10 border-2 border-white/30 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-white/50 backdrop-blur-sm transition-all @error('otp') border-red-400 @enderror"
                   data-index="5"
                   pattern="[0-9]"
                   inputmode="numeric">
        </div>

        <!-- Hidden input untuk submit -->
        <input type="hidden" name="otp" id="otpValue">

        @error('otp')
            <p class="text-red-300 text-xs mt-2 text-center flex items-center justify-center">
                <i class="fas fa-exclamation-triangle mr-1"></i>
                {{ $message }}
            </p>
        @enderror
    </div>

    <!-- Timer Countdown -->
    <div class="text-center mb-6">
        <p class="text-white/70 text-sm">
            <i class="fas fa-clock mr-1"></i>
            Kode berlaku selama: <span id="timer" class="font-bold text-white">10:00</span>
        </p>
    </div>

    <!-- Verify Button -->
    <button type="submit" 
            id="verifyBtn"
            class="w-full py-3 px-6 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl focus:outline-none focus:ring-4 focus:ring-green-300 shadow-lg transition-all disabled:opacity-50 disabled:cursor-not-allowed">
        <i class="fas fa-check-circle mr-2"></i>
        Verifikasi & Selesaikan Registrasi
    </button>

    <!-- Resend OTP -->
    <div class="mt-6 text-center">
        <p class="text-white/70 text-sm mb-2">Tidak menerima kode?</p>
        <button type="button" 
                id="resendBtn"
                class="text-blue-300 hover:text-blue-200 font-semibold text-sm transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                disabled>
            <i class="fas fa-redo mr-1"></i>
            Kirim Ulang (<span id="resendTimer">60</span>s)
        </button>
    </div>

    <!-- Back to Register -->
    <div class="mt-6 text-center">
        <a href="{{ route('register') }}" 
           class="text-white/70 hover:text-white text-sm transition-colors">
            <i class="fas fa-arrow-left mr-1"></i>
            Kembali ke Registrasi
        </a>
    </div>
</form>

<style>
    .otp-input::-webkit-outer-spin-button,
    .otp-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .otp-input[type=number] {
        -moz-appearance: textfield;
    }
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const otpInputs = document.querySelectorAll('.otp-input');
    const otpValue = document.getElementById('otpValue');
    const verifyBtn = document.getElementById('verifyBtn');
    const resendBtn = document.getElementById('resendBtn');
    const otpForm = document.getElementById('otpForm');
    let timerSeconds = 600; // 10 minutes
    let resendSeconds = 60; // 1 minute
    let isSubmitting = false; // Flag untuk mencegah double submit

    // OTP Input Handler
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            
            if (this.value.length === 1 && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
            
            updateOTPValue();
        });

        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !this.value && index > 0) {
                otpInputs[index - 1].focus();
            }
            
            if (e.key === 'ArrowLeft' && index > 0) {
                otpInputs[index - 1].focus();
            }
            if (e.key === 'ArrowRight' && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
        });

        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '');
            
            for (let i = 0; i < pastedData.length && index + i < otpInputs.length; i++) {
                otpInputs[index + i].value = pastedData[i];
            }
            
            updateOTPValue();
            
            const nextEmptyIndex = Array.from(otpInputs).findIndex(input => !input.value);
            if (nextEmptyIndex !== -1) {
                otpInputs[nextEmptyIndex].focus();
            }
        });
    });

    function updateOTPValue() {
        const otp = Array.from(otpInputs).map(input => input.value).join('');
        otpValue.value = otp;
        verifyBtn.disabled = otp.length !== 6 || isSubmitting;
    }

    // Form Submit Handler
    otpForm.addEventListener('submit', function(e) {
        if (isSubmitting) {
            e.preventDefault();
            return false;
        }
        
        isSubmitting = true;
        verifyBtn.disabled = true;
        verifyBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memverifikasi...';
    });

    // Timer Countdown
    function startTimer() {
        const timerElement = document.getElementById('timer');
        
        const interval = setInterval(() => {
            timerSeconds--;
            
            const minutes = Math.floor(timerSeconds / 60);
            const seconds = timerSeconds % 60;
            
            timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
            
            if (timerSeconds <= 0) {
                clearInterval(interval);
                timerElement.textContent = 'Kedaluwarsa';
                timerElement.classList.add('text-red-300');
                verifyBtn.disabled = true;
                alert('Kode OTP sudah kedaluwarsa. Silakan kirim ulang kode.');
            }
        }, 1000);
    }

    function startResendTimer() {
        resendBtn.disabled = true;
        resendSeconds = 60;
        
        const resendTimerElement = document.getElementById('resendTimer');
        
        const interval = setInterval(() => {
            resendSeconds--;
            resendTimerElement.textContent = resendSeconds;
            
            if (resendSeconds <= 0) {
                clearInterval(interval);
                resendBtn.disabled = false;
                resendBtn.innerHTML = '<i class="fas fa-redo mr-1"></i> Kirim Ulang';
            }
        }, 1000);
    }

    resendBtn.addEventListener('click', async function() {
        try {
            const response = await fetch('{{ route('register.resend-otp') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            const data = await response.json();

            if (data.success) {
                alert(data.message);
                timerSeconds = 600;
                startTimer();
                startResendTimer();
                
                otpInputs.forEach(input => input.value = '');
                otpInputs[0].focus();
                isSubmitting = false;
                updateOTPValue();
            } else {
                alert(data.message);
            }
        } catch (error) {
            alert('Terjadi kesalahan. Silakan coba lagi.');
        }
    });

    // Initialize
    startTimer();
    startResendTimer();
    otpInputs[0].focus();
});
</script>
@endpush

@endsection