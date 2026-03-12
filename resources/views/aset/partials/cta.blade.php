{{-- CTA Section - Cimahi Theme (2 Stats Only) --}}
<section class="relative py-24 overflow-hidden">
    {{-- Dark Gradient Background with Cimahi Colors --}}
    <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-[#0F172A] to-black"></div>
    
    {{-- Grid Pattern Overlay --}}
    <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
    
    {{-- Animated Background Orbs - Cimahi Colors --}}
    <div class="absolute inset-0">
        <div class="absolute top-20 left-10 w-96 h-96 bg-[#0EA5E9]/20 rounded-full blur-3xl animate-float-slow"></div>
        <div class="absolute bottom-20 right-10 w-80 h-80 bg-[#8B5CF6]/20 rounded-full blur-3xl animate-float-slower"></div>
        <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-[#06B6D4]/15 rounded-full blur-3xl animate-pulse-slow"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- CTA Content --}}
        <div class="text-center mb-16" data-aos="zoom-in">
            {{-- Badge --}}
            <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-[#0EA5E9]/20 to-[#8B5CF6]/20 backdrop-blur-xl rounded-full border border-white/10 mb-8 shadow-2xl">
                <span class="relative flex h-3 w-3 mr-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#06B6D4] opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-[#06B6D4]"></span>
                </span>
                <span class="text-sm text-transparent bg-clip-text bg-gradient-to-r from-[#22D3EE] to-[#A78BFA] font-bold uppercase tracking-wider">Mulai Sekarang - Gratis!</span>
            </div>
            
            {{-- Heading --}}
            <h2 class="text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                <span class="text-white">Siap Memulai</span>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#0EA5E9] via-[#8B5CF6] to-[#06B6D4] animate-gradient"> Peminjaman?</span>
            </h2>
            
            {{-- Description --}}
            <p class="text-xl text-gray-300 mb-10 max-w-3xl mx-auto leading-relaxed">
                Bergabunglah dengan ribuan pengguna yang telah merasakan kemudahan sistem peminjaman modern kami
            </p>
            
            {{-- CTA Buttons --}}
            @guest
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('register') }}" class="group relative px-8 py-4 bg-gradient-to-r from-[#0EA5E9] via-[#8B5CF6] to-[#06B6D4] text-white rounded-xl font-semibold text-lg overflow-hidden transform transition-all duration-300 hover:scale-105 shadow-2xl shadow-[#0EA5E9]/30 hover:shadow-[#0EA5E9]/50">
                        <span class="relative z-10 flex items-center">
                            <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Daftar Sekarang
                        </span>
                    </a>
                    <a href="{{ route('login') }}" class="group px-8 py-4 bg-white/10 backdrop-blur-xl text-white rounded-xl font-semibold text-lg border-2 border-[#0EA5E9]/30 hover:bg-[#0EA5E9]/20 hover:border-[#0EA5E9]/50 transition-all duration-300 transform hover:scale-105">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Sudah Punya Akun?
                        </span>
                    </a>
                </div>
            @else
                <a href="{{ route('permohonan.create') }}" class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-[#0EA5E9] via-[#8B5CF6] to-[#06B6D4] text-white rounded-xl font-semibold text-lg shadow-2xl shadow-[#0EA5E9]/30 hover:shadow-[#0EA5E9]/50 transition-all duration-300 transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Buat Peminjaman Baru
                </a>
            @endguest
        </div>
            
        {{-- Stats Section - 2 Stats Inline (NO ICONS) --}}
        <div class="stats-variant-medium flex flex-wrap justify-center gap-16 max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            {{-- Stat 1: Total Peminjaman - Blue --}}
            <div class="group stats-card text-center relative">
                <div class="text-5xl lg:text-6xl font-bold text-white mb-2 stat-container transform group-hover:scale-105 transition-transform duration-500 flex items-center justify-center">
                    <span class="counter-number drop-shadow-xl" data-value="{{ $ctaStats['total_peminjaman'] ?? 0 }}" style="text-shadow: 0 0 20px rgba(14, 165, 233, 0.6)">0</span><span class="text-[#22D3EE] drop-shadow-lg ml-1" style="font-size: 4rem;">+</span>
                </div>
                
                <div class="text-white/90 text-base font-semibold mb-2 tracking-wide">Total Peminjaman</div>
                <div class="h-1 w-20 bg-gradient-to-r from-[#0EA5E9] to-[#06B6D4] rounded-full mx-auto transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 shadow-lg shadow-[#0EA5E9]/50"></div>
            </div>

            {{-- Stat 2: Pengguna Aktif - Purple --}}
            <div class="group stats-card text-center relative">
                <div class="text-5xl lg:text-6xl font-bold text-white mb-2 stat-container transform group-hover:scale-105 transition-transform duration-500 flex items-center justify-center">
                    <span class="counter-number drop-shadow-xl" data-value="{{ $ctaStats['pengguna_aktif'] ?? 0 }}" style="text-shadow: 0 0 20px rgba(139, 92, 246, 0.6)">0</span><span class="text-[#A78BFA] drop-shadow-lg ml-1" style="font-size: 4rem;">+</span>
                </div>
                
                <div class="text-white/90 text-base font-semibold mb-2 tracking-wide">Pengguna Aktif</div>
                <div class="h-1 w-20 bg-gradient-to-r from-[#8B5CF6] to-[#A78BFA] rounded-full mx-auto transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 shadow-lg shadow-[#8B5CF6]/50"></div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
/* Grid Pattern */
.bg-grid-pattern {
    background-image: linear-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                      linear-gradient(90deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
    background-size: 50px 50px;
}

/* Gradient Animation */
@keyframes gradient {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 3s ease infinite;
}

/* Float Animations */
@keyframes float-slow {
    0%, 100% {
        transform: translateY(0px) translateX(0px);
    }
    50% {
        transform: translateY(-20px) translateX(10px);
    }
}

@keyframes float-slower {
    0%, 100% {
        transform: translateY(0px) translateX(0px);
    }
    50% {
        transform: translateY(30px) translateX(-15px);
    }
}

.animate-float-slow {
    animation: float-slow 6s ease-in-out infinite;
}

.animate-float-slower {
    animation: float-slower 8s ease-in-out infinite;
}

/* Pulse Slow */
@keyframes pulse-slow {
    0%, 100% { opacity: 0.15; }
    50% { opacity: 0.25; }
}

.animate-pulse-slow {
    animation: pulse-slow 8s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

/* Stats Variant Medium (from landing-page.css) */
.stats-variant-medium .stats-card .counter-number {
    font-size: 3.5rem !important;
}

.stats-variant-medium .stats-card .counter-number + span {
    font-size: 3.5rem !important;
}

.stats-variant-medium .stats-card .text-base {
    font-size: 1rem !important;
}

.stats-variant-medium .h-1 {
    height: 4px !important;
    width: 80px !important;
}

.stats-variant-medium .grid.gap-10 {
    gap: 2.5rem !important;
}

/* Counter Number */
.counter-number {
    display: inline-block;
    transition: all 0.3s ease;
}

.stats-card:hover .counter-number {
    transform: scale(1.1);
}

/* Responsive */
@media (max-width: 768px) {
    .stats-variant-medium .stats-card .counter-number {
        font-size: 2.5rem !important;
    }
    
    .stats-variant-medium .grid.gap-10 {
        gap: 2rem !important;
    }
}

@media (max-width: 640px) {
    .stats-variant-medium .stats-card .counter-number {
        font-size: 2rem !important;
    }
    
    .stats-variant-medium .stats-card .text-base {
        font-size: 0.875rem !important;
    }
    
    .stats-variant-medium .grid.gap-10 {
        gap: 1.5rem !important;
    }
}
</style>
@endpush

{{-- Pastikan CountUp.js sudah dimuat --}}
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.6.2/countUp.umd.js"></script>
@endpush