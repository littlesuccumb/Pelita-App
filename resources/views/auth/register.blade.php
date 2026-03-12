@extends('auth.layout')

@section('title', 'Daftar - Cimahi Techno Park')

@section('header-title', 'Daftar Akun Baru')
@section('header-subtitle', 'Bergabung dengan kami')

@section('content')
<!-- Progress Steps -->
<div class="mb-6">
    <div class="flex items-center justify-between relative">
        <!-- Progress Line Background -->
        <div class="absolute top-5 left-0 right-0 h-0.5 bg-white/20 -z-10"></div>
        <div id="progress-line" class="absolute top-5 left-0 h-0.5 bg-blue-400 transition-all duration-500 -z-10" style="width: 0%"></div>
        
        <!-- Step 1 -->
        <div class="flex flex-col items-center step-indicator active" data-step="1">
            <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-sm mb-2 step-circle transition-all duration-300">
                1
            </div>
            <span class="text-xs text-white/80 step-label">Data Pribadi</span>
        </div>
        
        <!-- Step 2 -->
        <div class="flex flex-col items-center step-indicator" data-step="2">
            <div class="w-10 h-10 rounded-full bg-white/20 text-white flex items-center justify-center font-bold text-sm mb-2 step-circle transition-all duration-300">
                2
            </div>
            <span class="text-xs text-white/60 step-label">Alamat</span>
        </div>
        
        <!-- Step 3 -->
        <div class="flex flex-col items-center step-indicator" data-step="3">
            <div class="w-10 h-10 rounded-full bg-white/20 text-white flex items-center justify-center font-bold text-sm mb-2 step-circle transition-all duration-300">
                3
            </div>
            <span class="text-xs text-white/60 step-label">Keamanan</span>
        </div>
        
        <!-- Step 4 -->
        <div class="flex flex-col items-center step-indicator" data-step="4">
            <div class="w-10 h-10 rounded-full bg-white/20 text-white flex items-center justify-center font-bold text-sm mb-2 step-circle transition-all duration-300">
                4
            </div>
            <span class="text-xs text-white/60 step-label">Konfirmasi</span>
        </div>
    </div>
</div>

<!-- Registration Form -->
<form method="POST" action="{{ route('register.send-otp') }}" class="space-y-6" autocomplete="off">
    @csrf

    <!-- STEP 1: Data Pribadi -->
    <div class="wizard-step active" data-step="1">
        <div class="space-y-4">
            <div class="p-3 bg-blue-500/20 border border-blue-400/30 rounded-lg backdrop-blur-sm">
                <div class="flex items-start">
                    <i class="fas fa-id-card text-blue-400 mr-2 text-sm"></i>
                    <p class="text-blue-100 text-xs">
                        Isi data sesuai KTP. Data tidak sesuai dapat menyebabkan permohonan ditolak.
                    </p>
                </div>
            </div>

            <!-- Name -->
            <div class="space-y-1">
                <label for="name" class="block text-white/90 text-sm font-semibold">
                    <i class="fas fa-user mr-2 text-white/70"></i>
                    Nama Lengkap <span class="text-red-300">*</span>
                </label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required
                       class="w-full px-3 py-2.5 bg-white/10 border border-white/30 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 text-sm"
                       placeholder="Nama lengkap sesuai KTP">
                @error('name')
                    <p class="text-red-300 text-xs mt-1"><i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="space-y-1">
                <label for="email" class="block text-white/90 text-sm font-semibold">
                    <i class="fas fa-envelope mr-2 text-white/70"></i>
                    Email <span class="text-red-300">*</span>
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                       class="w-full px-3 py-2.5 bg-white/10 border border-white/30 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 text-sm"
                       placeholder="nama@email.com">
                @error('email')
                    <p class="text-red-300 text-xs mt-1"><i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>

            <!-- Jabatan & Phone -->
            <div class="grid grid-cols-2 gap-3">
                <div class="space-y-1">
                    <label for="jabatan" class="block text-white/90 text-sm font-semibold">
                        <i class="fas fa-briefcase mr-1 text-white/70"></i>
                        Jabatan
                    </label>
                    <input id="jabatan" type="text" name="jabatan" value="{{ old('jabatan') }}"
                           class="w-full px-3 py-2.5 bg-white/10 border border-white/30 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 text-sm"
                           placeholder="Jabatan">
                </div>

                <div class="space-y-1">
                    <label for="no_telp" class="block text-white/90 text-sm font-semibold">
                        <i class="fas fa-phone mr-1 text-white/70"></i>
                        No. Telepon
                    </label>
                    <input id="no_telp" type="tel" name="no_telp" value="{{ old('no_telp') }}"
                           class="w-full px-3 py-2.5 bg-white/10 border border-white/30 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 text-sm"
                           placeholder="08xxxxxxxxxx">
                </div>
            </div>

            <!-- Instansi & Organisasi -->
            <div class="grid grid-cols-2 gap-3">
                <div class="space-y-1">
                    <label for="instansi" class="block text-white/90 text-sm font-semibold">
                        <i class="fas fa-building mr-1 text-white/70"></i>
                        Instansi
                    </label>
                    <input id="instansi" type="text" name="instansi" value="{{ old('instansi') }}"
                           class="w-full px-3 py-2.5 bg-white/10 border border-white/30 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 text-sm"
                           placeholder="Nama instansi">
                </div>

                <div class="space-y-1">
                    <label for="nama_organisasi" class="block text-white/90 text-sm font-semibold">
                        <i class="fas fa-users mr-1 text-white/70"></i>
                        Organisasi
                    </label>
                    <input id="nama_organisasi" type="text" name="nama_organisasi" value="{{ old('nama_organisasi') }}"
                           class="w-full px-3 py-2.5 bg-white/10 border border-white/30 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 text-sm"
                           placeholder="Nama organisasi">
                </div>
            </div>

            <!-- KTP Number -->
            <div class="space-y-1">
                <label for="no_ktp" class="block text-white/90 text-sm font-semibold">
                    <i class="fas fa-id-card mr-2 text-white/70"></i>
                    Nomor KTP
                </label>
                <input id="no_ktp" type="text" name="no_ktp" value="{{ old('no_ktp') }}" maxlength="16"
                       class="w-full px-3 py-2.5 bg-white/10 border border-white/30 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 text-sm"
                       placeholder="16 digit nomor KTP">
                @error('no_ktp')
                    <p class="text-red-300 text-xs mt-1"><i class="fas fa-exclamation-triangle mr-1"></i>{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- STEP 2: Alamat -->
    <div class="wizard-step" data-step="2" style="display: none;">
        <div class="space-y-4">
            <!-- Address -->
            <div class="space-y-1">
                <label for="alamat" class="block text-white/90 text-sm font-semibold">
                    <i class="fas fa-map-marker-alt mr-2 text-white/70"></i>
                    Alamat Lengkap
                </label>
                <textarea id="alamat" name="alamat" rows="3"
                          class="w-full px-3 py-2.5 bg-white/10 border border-white/30 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 resize-none text-sm"
                          placeholder="Alamat lengkap sesuai KTP">{{ old('alamat') }}</textarea>
            </div>

            <!-- Kelurahan & Kecamatan -->
            <div class="grid grid-cols-2 gap-3">
                <div class="space-y-1">
                    <label for="kelurahan" class="block text-white/90 text-sm font-semibold">
                        <i class="fas fa-map-pin mr-1 text-white/70"></i>
                        Kelurahan
                    </label>
                    <input id="kelurahan" type="text" name="kelurahan" value="{{ old('kelurahan') }}"
                           class="w-full px-3 py-2.5 bg-white/10 border border-white/30 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 text-sm"
                           placeholder="Kelurahan">
                </div>

                <div class="space-y-1">
                    <label for="kecamatan" class="block text-white/90 text-sm font-semibold">
                        <i class="fas fa-map-pin mr-1 text-white/70"></i>
                        Kecamatan
                    </label>
                    <input id="kecamatan" type="text" name="kecamatan" value="{{ old('kecamatan') }}"
                           class="w-full px-3 py-2.5 bg-white/10 border border-white/30 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 text-sm"
                           placeholder="Kecamatan">
                </div>
            </div>

            <!-- Kabupaten & Kode Pos -->
            <div class="grid grid-cols-2 gap-3">
                <div class="space-y-1">
                    <label for="kabupaten" class="block text-white/90 text-sm font-semibold">
                        <i class="fas fa-map-pin mr-1 text-white/70"></i>
                        Kabupaten/Kota
                    </label>
                    <input id="kabupaten" type="text" name="kabupaten" value="{{ old('kabupaten') }}"
                           class="w-full px-3 py-2.5 bg-white/10 border border-white/30 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 text-sm"
                           placeholder="Kabupaten/Kota">
                </div>

                <div class="space-y-1">
                    <label for="kode_pos" class="block text-white/90 text-sm font-semibold">
                        <i class="fas fa-mail-bulk mr-1 text-white/70"></i>
                        Kode Pos
                    </label>
                    <input id="kode_pos" type="text" name="kode_pos" value="{{ old('kode_pos') }}" maxlength="5"
                           class="w-full px-3 py-2.5 bg-white/10 border border-white/30 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 text-sm"
                           placeholder="5 digit">
                </div>
            </div>
        </div>
    </div>

    <!-- STEP 3: Password -->
    <div class="wizard-step" data-step="3" style="display: none;">
        <div class="space-y-4">
            <!-- Password -->
            <div class="space-y-1">
                <label for="password" class="block text-white/90 text-sm font-semibold">
                    <i class="fas fa-lock mr-2 text-white/70"></i>
                    Password <span class="text-red-300">*</span>
                </label>
                <div class="relative">
                    <input id="password" type="password" name="password" required
                           class="w-full px-3 py-2.5 pr-10 bg-white/10 border border-white/30 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 text-sm"
                           placeholder="Minimal 8 karakter">
                    <button type="button" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-white/50 hover:text-white/80"
                            onclick="togglePassword('password', 'toggleIcon1')">
                        <i id="toggleIcon1" class="fas fa-eye text-xs"></i>
                    </button>
                </div>
            </div>

            <!-- Password Confirmation -->
            <div class="space-y-1">
                <label for="password_confirmation" class="block text-white/90 text-sm font-semibold">
                    <i class="fas fa-lock mr-2 text-white/70"></i>
                    Konfirmasi Password <span class="text-red-300">*</span>
                </label>
                <div class="relative">
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                           class="w-full px-3 py-2.5 pr-10 bg-white/10 border border-white/30 rounded-lg text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-white/50 text-sm"
                           placeholder="Ulangi password">
                    <button type="button" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-white/50 hover:text-white/80"
                            onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                        <i id="toggleIcon2" class="fas fa-eye text-xs"></i>
                    </button>
                </div>
            </div>

            <!-- Password Requirements -->
            <div class="space-y-3 p-4 bg-white/5 rounded-lg border border-white/10">
                <div class="text-xs text-white/80 font-semibold">
                    <i class="fas fa-shield-alt mr-1"></i>
                    Syarat Password:
                </div>
                <div class="grid grid-cols-2 gap-2 text-xs">
                    <div id="req-length" class="flex items-center text-white/60">
                        <i class="fas fa-circle text-[6px] mr-2"></i>
                        Min. 8 karakter
                    </div>
                    <div id="req-case" class="flex items-center text-white/60">
                        <i class="fas fa-circle text-[6px] mr-2"></i>
                        Huruf besar & kecil
                    </div>
                    <div id="req-number" class="flex items-center text-white/60">
                        <i class="fas fa-circle text-[6px] mr-2"></i>
                        Min. 1 angka
                    </div>
                    <div id="req-special" class="flex items-center text-white/60">
                        <i class="fas fa-circle text-[6px] mr-2"></i>
                        Karakter spesial (!@#$%^&*)
                    </div>
                </div>
                <div class="pt-2 border-t border-white/10">
                    <div class="text-xs text-white/70 mb-1">Kekuatan:</div>
                    <div class="flex space-x-1">
                        <div id="strength-1" class="h-1.5 w-full bg-white/20 rounded-full transition-all"></div>
                        <div id="strength-2" class="h-1.5 w-full bg-white/20 rounded-full transition-all"></div>
                        <div id="strength-3" class="h-1.5 w-full bg-white/20 rounded-full transition-all"></div>
                        <div id="strength-4" class="h-1.5 w-full bg-white/20 rounded-full transition-all"></div>
                    </div>
                    <div id="strength-text" class="text-xs text-white/60 mt-1">Masukkan password</div>
                </div>
            </div>
        </div>
    </div>

    <!-- STEP 4: Konfirmasi -->
    <div class="wizard-step" data-step="4" style="display: none;">
        <div class="space-y-4">
            <!-- Summary -->
            <div class="p-4 bg-white/5 rounded-lg border border-white/10 space-y-3">
                <h3 class="text-white font-semibold text-sm mb-3">Ringkasan Data Anda:</h3>
                
                <div class="space-y-2 text-xs">
                    <div class="flex justify-between py-2 border-b border-white/10">
                        <span class="text-white/60">Nama:</span>
                        <span class="text-white font-medium" id="summary-name">-</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-white/10">
                        <span class="text-white/60">Email:</span>
                        <span class="text-white font-medium" id="summary-email">-</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-white/10">
                        <span class="text-white/60">No. Telepon:</span>
                        <span class="text-white font-medium" id="summary-phone">-</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-white/10">
                        <span class="text-white/60">No. KTP:</span>
                        <span class="text-white font-medium" id="summary-ktp">-</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-white/60">Alamat:</span>
                        <span class="text-white font-medium text-right" id="summary-address">-</span>
                    </div>
                </div>
            </div>

            <!-- Terms -->
            <div class="flex items-start space-x-3 p-4 bg-white/5 rounded-lg border border-white/10">
                <input type="checkbox" id="terms" name="terms" required
                       class="mt-0.5 rounded border-white/30 text-blue-500 focus:ring-white/50 bg-white/10"
                       style="width: 1rem; height: 1rem;">
                <label for="terms" class="text-white/80 text-xs leading-relaxed cursor-pointer">
                    Saya menyetujui 
                    <a href="#" class="text-blue-300 hover:text-blue-200 font-medium">Syarat & Ketentuan</a> 
                    dan 
                    <a href="#" class="text-blue-300 hover:text-blue-200 font-medium">Kebijakan Privasi</a>, 
                    serta menyatakan data yang saya berikan benar sesuai KTP.
                </label>
            </div>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="flex justify-between items-center pt-4 border-t border-white/20">
        <button type="button" id="prevBtn" 
                class="px-6 py-2.5 border-2 border-white/30 text-white font-semibold rounded-lg hover:bg-white/10 transition-all text-sm"
                style="display: none;">
            <i class="fas fa-arrow-left mr-2"></i>
            Sebelumnya
        </button>
        
        <div class="flex-1"></div>
        
        <button type="button" id="nextBtn" 
                class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition-colors text-sm">
            Selanjutnya
            <i class="fas fa-arrow-right ml-2"></i>
        </button>
        
        <button type="submit" id="submitBtn" 
                class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg transition-colors text-sm disabled:opacity-50 disabled:cursor-not-allowed"
                style="display: none;">
            <span id="submitBtnText">
                <i class="fas fa-paper-plane mr-2"></i>
                Daftar & Kirim Kode Verifikasi
            </span>
            <span id="submitBtnLoading" style="display: none;">
                <i class="fas fa-spinner fa-spin mr-2"></i>
                Mengirim kode verifikasi...
            </span>
        </button>
    </div>

<!-- Back & Register Links - Alternative with Arrow -->
    <div class="text-center space-y-3">
        <div>
            <p class="text-white/70 text-xs mb-3">
                Sudah punya akun?
            </p>
            <a href="{{ route('login') }}" 
               class="inline-flex items-center px-5 py-2.5 border-2 border-white/30 text-white font-semibold rounded-xl hover:bg-white/10 hover:border-white/50 transition-all duration-300 group text-sm">
                <i class="fas fa-sign-in-alt mr-2 group-hover:translate-x-1 transition-transform"></i>
                Masuk
            </a>
        </div>
        
        <div class="pt-3 border-t border-white/10">
            <a href="{{ route('aset.public') }}" 
               class="inline-flex items-center text-white/70 hover:text-white text-sm transition-colors group">
                <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                Kembali ke Halaman Awal
            </a>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
let currentStep = 1;
const totalSteps = 4;

// Toggle password visibility
function togglePassword(fieldId, iconId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(iconId);
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

// Update requirement indicator
function updateRequirement(elementId, isMet) {
    const element = document.getElementById(elementId);
    if (isMet) {
        element.className = 'flex items-center text-green-300 font-medium';
        element.querySelector('i').classList.replace('fa-circle', 'fa-check-circle');
    } else {
        element.className = 'flex items-center text-white/60';
        element.querySelector('i').classList.replace('fa-check-circle', 'fa-circle');
    }
}

// Password strength checker
function checkPasswordStrength(password) {
    const hasLength = password.length >= 8;
    const hasCase = /[a-z]/.test(password) && /[A-Z]/.test(password);
    const hasNumber = /\d/.test(password);
    const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);

    let strength = 0;
    if (hasLength) strength++;
    if (hasCase) strength++;
    if (hasNumber) strength++;
    if (hasSpecial) strength++;

    updateRequirement('req-length', hasLength);
    updateRequirement('req-case', hasCase);
    updateRequirement('req-number', hasNumber);
    updateRequirement('req-special', hasSpecial);

    const indicators = ['strength-1', 'strength-2', 'strength-3', 'strength-4'];
    const colors = ['bg-red-400', 'bg-yellow-400', 'bg-blue-400', 'bg-green-400'];
    const texts = ['Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'];

    indicators.forEach(id => {
        document.getElementById(id).className = 'h-1.5 w-full bg-white/20 rounded-full transition-all';
    });

    if (strength > 0) {
        const colorIndex = strength - 1;
        for (let i = 0; i < strength; i++) {
            document.getElementById(indicators[i]).classList.add(colors[colorIndex]);
        }
    }

    const strengthText = document.getElementById('strength-text');
    if (password.length === 0) {
        strengthText.textContent = 'Masukkan password';
        strengthText.className = 'text-xs text-white/60 mt-1';
    } else {
        strengthText.textContent = texts[strength - 1] || 'Lemah';
        strengthText.className = `text-xs mt-1 font-medium ${
            strength >= 4 ? 'text-green-300' :
            strength >= 3 ? 'text-blue-300' :
            strength >= 2 ? 'text-yellow-300' : 'text-red-300'
        }`;
    }
}

// Update summary
function updateSummary() {
    document.getElementById('summary-name').textContent = document.getElementById('name').value || '-';
    document.getElementById('summary-email').textContent = document.getElementById('email').value || '-';
    document.getElementById('summary-phone').textContent = document.getElementById('no_telp').value || '-';
    document.getElementById('summary-ktp').textContent = document.getElementById('no_ktp').value || '-';
    
    const address = [
        document.getElementById('alamat').value,
        document.getElementById('kelurahan').value,
        document.getElementById('kecamatan').value,
        document.getElementById('kabupaten').value,
        document.getElementById('kode_pos').value
    ].filter(v => v).join(', ') || '-';
    
    document.getElementById('summary-address').textContent = address;
}

// Show step
function showStep(step) {
    document.querySelectorAll('.wizard-step').forEach(el => el.style.display = 'none');
    document.querySelector(`[data-step="${step}"].wizard-step`).style.display = 'block';
    
    // Update progress
    document.querySelectorAll('.step-indicator').forEach(el => {
        const stepNum = parseInt(el.dataset.step);
        const circle = el.querySelector('.step-circle');
        const label = el.querySelector('.step-label');
        
        if (stepNum < step) {
            circle.className = 'w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center font-bold text-sm mb-2 step-circle transition-all duration-300';
            circle.innerHTML = '<i class="fas fa-check"></i>';
            label.className = 'text-xs text-white/80 step-label';
        } else if (stepNum === step) {
            circle.className = 'w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-sm mb-2 step-circle transition-all duration-300';
            circle.textContent = stepNum;
            label.className = 'text-xs text-white step-label font-semibold';
        } else {
            circle.className = 'w-10 h-10 rounded-full bg-white/20 text-white flex items-center justify-center font-bold text-sm mb-2 step-circle transition-all duration-300';
            circle.textContent = stepNum;
            label.className = 'text-xs text-white/60 step-label';
        }
    });
    
    // Update progress line
    const progressPercent = ((step - 1) / (totalSteps - 1)) * 100;
    document.getElementById('progress-line').style.width = progressPercent + '%';
    
    // Update buttons
    document.getElementById('prevBtn').style.display = step === 1 ? 'none' : 'block';
    document.getElementById('nextBtn').style.display = step === totalSteps ? 'none' : 'block';
    document.getElementById('submitBtn').style.display = step === totalSteps ? 'block' : 'none';
    
    // Update summary on last step
    if (step === 4) {
        updateSummary();
    }
}

// Validate step
function validateStep(step) {
    let valid = true;
    
    if (step === 1) {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const ktp = document.getElementById('no_ktp').value;
        
        if (!name || !email) {
            alert('Nama dan Email harus diisi!');
            return false;
        }
        
        if (ktp && ktp.length !== 16) {
            alert('Nomor KTP harus 16 digit!');
            return false;
        }
    }
    
    if (step === 2) {
        const kodePos = document.getElementById('kode_pos').value;
        
        if (kodePos && kodePos.length !== 5) {
            alert('Kode pos harus 5 digit!');
            return false;
        }
    }
    
    if (step === 3) {
        const password = document.getElementById('password').value;
        const confirmation = document.getElementById('password_confirmation').value;
        
        if (!password || password.length < 8) {
            alert('Password minimal 8 karakter!');
            return false;
        }
        
        if (password !== confirmation) {
            alert('Password dan konfirmasi password tidak cocok!');
            return false;
        }
    }
    
    return valid;
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    // Show first step
    showStep(1);
    
    // Next button
    document.getElementById('nextBtn').addEventListener('click', function() {
        if (validateStep(currentStep)) {
            currentStep++;
            showStep(currentStep);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
    
    // Previous button
    document.getElementById('prevBtn').addEventListener('click', function() {
        currentStep--;
        showStep(currentStep);
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    
    // Password strength checker
    document.getElementById('password').addEventListener('input', function() {
        checkPasswordStrength(this.value);
    });
    
    // Format KTP
    document.getElementById('no_ktp').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '').substring(0, 16);
    });
    
    // Format Kode Pos
    document.getElementById('kode_pos').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '').substring(0, 5);
    });
    
    // Format Phone
    document.getElementById('no_telp').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
    });
    
    // Auto-capitalize
    const nameFields = ['name', 'jabatan', 'instansi', 'nama_organisasi', 'kelurahan', 'kecamatan', 'kabupaten'];
    nameFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (field) {
            field.addEventListener('input', function() {
                this.value = this.value.replace(/\b\w/g, l => l.toUpperCase());
            });
        }
    });
    
// Form submit validation
document.querySelector('form').addEventListener('submit', function(e) {
    const terms = document.getElementById('terms');
    if (!terms.checked) {
        e.preventDefault();
        alert('Harap setujui Syarat & Ketentuan untuk melanjutkan.');
        return false;
    }
    
    // Show loading animation
    const submitBtn = document.getElementById('submitBtn');
    const submitBtnText = document.getElementById('submitBtnText');
    const submitBtnLoading = document.getElementById('submitBtnLoading');
    
    submitBtn.disabled = true;
    submitBtnText.style.display = 'none';
    submitBtnLoading.style.display = 'inline';
});
});
</script>
@endpush