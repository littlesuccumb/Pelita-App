{{-- Features Section - Cimahi Technopark Color Theme --}}
<section id="features" class="py-24 bg-gradient-to-b from-gray-900 via-gray-800 to-black relative overflow-hidden">
    {{-- Animated Grid Background --}}
    <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
    
    {{-- Floating Particles --}}
    <div class="particles-container">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    {{-- Large Gradient Orbs - Cimahi Colors --}}
    <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-[#0EA5E9] rounded-full mix-blend-screen filter blur-3xl opacity-15 animate-pulse-slow"></div>
    <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-[#8B5CF6] rounded-full mix-blend-screen filter blur-3xl opacity-15 animate-pulse-slow" style="animation-delay: 3s"></div>
    <div class="absolute top-1/2 left-1/2 w-[500px] h-[500px] bg-[#06B6D4] rounded-full mix-blend-screen filter blur-3xl opacity-12 animate-pulse-slow" style="animation-delay: 6s"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center mb-20" data-aos="fade-up">
            <div class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-[#0EA5E9]/20 to-[#8B5CF6]/20 backdrop-blur-xl rounded-full mb-6 border border-white/10 shadow-2xl">
                <span class="relative flex h-3 w-3 mr-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#22D3EE] opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-[#0EA5E9]"></span>
                </span>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#22D3EE] to-[#A78BFA] font-bold text-sm uppercase tracking-widest">Fitur Unggulan</span>
            </div>
            
            <h2 class="text-6xl lg:text-7xl font-extrabold mb-8">
                <span class="text-white">Mengapa Memilih</span>
                <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#0EA5E9] via-[#8B5CF6] to-[#06B6D4] animate-gradient">Pelita App?</span>
            </h2>
            
            <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
                Sistem manajemen aset modern dengan fitur lengkap untuk Cimahi Technopark
            </p>
        </div>

        {{-- Features Grid with 3D Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Feature 1: Sistem Permohonan Digital --}}
            <div class="feature-card-3d" data-aos="zoom-in" data-aos-delay="0">
                <div class="card-3d-wrapper">
                    <div class="card-3d-content">
                        <div class="card-border-glow"></div>
                        
                        <div class="relative z-10">
                            <div class="icon-container mb-6">
                                <div class="icon-glow bg-[#0EA5E9]"></div>
                                <div class="icon-inner bg-gradient-to-br from-[#0EA5E9] to-[#06B6D4]">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            
                            <h3 class="text-3xl font-bold text-white mb-4">
                                Permohonan Digital
                            </h3>
                            
                            <p class="text-gray-300 leading-relaxed mb-6">
                                Upload surat permohonan dan kop surat secara digital dengan sistem tracking otomatis.
                            </p>
                            
                            <div class="stats-grid">
                                <div class="stat-box">
                                    <div class="stat-number text-[#22D3EE]">
                                        Paperless
                                    </div>
                                    <div class="stat-label">System</div>
                                </div>
                                <div class="stat-box">
                                    <div class="stat-number text-[#06B6D4]">
                                        Real-time
                                    </div>
                                    <div class="stat-label">Tracking</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Feature 2: Manajemen Stok Barang --}}
            <div class="feature-card-3d" data-aos="zoom-in" data-aos-delay="100">
                <div class="card-3d-wrapper">
                    <div class="card-3d-content">
                        <div class="card-border-glow"></div>
                        
                        <div class="relative z-10">
                            <div class="icon-container mb-6">
                                <div class="icon-glow bg-[#06B6D4]"></div>
                                <div class="icon-inner bg-gradient-to-br from-[#06B6D4] to-[#0EA5E9]">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                            </div>
                            
                            <h3 class="text-3xl font-bold text-white mb-4">
                                Manajemen Stok
                            </h3>
                            
                            <p class="text-gray-300 leading-relaxed mb-6">
                                Kelola {{ $stats['barang_tersedia'] ?? 0 }}+ jenis barang dengan tracking ketersediaan real-time dan 5 kategori lengkap.
                            </p>
                            
                            <div class="stats-grid">
                                <div class="stat-box">
                                    <div class="stat-number text-[#06B6D4]">
                                        {{ $stats['barang_tersedia'] ?? 0 }}+
                                    </div>
                                    <div class="stat-label">Jenis Barang</div>
                                </div>
                                <div class="stat-box">
                                    <div class="stat-number text-[#22D3EE]">
                                        {{ $stats['total_kategori'] ?? 0 }}
                                    </div>
                                    <div class="stat-label">Kategori</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Feature 3: Sistem Pembayaran --}}
            <div class="feature-card-3d" data-aos="zoom-in" data-aos-delay="200">
                <div class="card-3d-wrapper">
                    <div class="card-3d-content">
                        <div class="card-border-glow"></div>
                        
                        <div class="relative z-10">
                            <div class="icon-container mb-6">
                                <div class="icon-glow bg-[#8B5CF6]"></div>
                                <div class="icon-inner bg-gradient-to-br from-[#8B5CF6] to-[#A78BFA]">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                </div>
                            </div>
                            
                            <h3 class="text-3xl font-bold text-white mb-4">
                                Pembayaran Fleksibel
                            </h3>
                            
                            <p class="text-gray-300 leading-relaxed mb-6">
                                Mendukung pembayaran cash, transfer, dan gratis dengan verifikasi bukti transfer otomatis.
                            </p>
                            
                            <div class="stats-grid">
                                <div class="stat-box">
                                    <div class="stat-number text-[#A78BFA]">
                                        3
                                    </div>
                                    <div class="stat-label">Metode Bayar</div>
                                </div>
                                <div class="stat-box">
                                    <div class="stat-number text-[#8B5CF6]">
                                        Auto
                                    </div>
                                    <div class="stat-label">Verifikasi</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Feature 4: Maintenance Management --}}
            <div class="feature-card-3d" data-aos="zoom-in" data-aos-delay="300">
                <div class="card-3d-wrapper">
                    <div class="card-3d-content">
                        <div class="card-border-glow"></div>
                        
                        <div class="relative z-10">
                            <div class="icon-container mb-6">
                                <div class="icon-glow bg-[#F97316]"></div>
                                <div class="icon-inner bg-gradient-to-br from-[#F97316] to-[#FBBF24]">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            
                            <h3 class="text-3xl font-bold text-white mb-4">
                                Maintenance Tracking
                            </h3>
                            
                            <p class="text-gray-300 leading-relaxed mb-6">
                                Jadwal maintenance preventif, korektif, dan emergency dengan tracking biaya dan teknisi.
                            </p>
                            
                            <div class="stats-grid">
                                <div class="stat-box">
                                    <div class="stat-number text-[#FB923C]">
                                        3
                                    </div>
                                    <div class="stat-label">Jenis</div>
                                </div>
                                <div class="stat-box">
                                    <div class="stat-number text-[#FBBF24]">
                                        Track
                                    </div>
                                    <div class="stat-label">Biaya</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Feature 5: Log Aktivitas --}}
            <div class="feature-card-3d" data-aos="zoom-in" data-aos-delay="400">
                <div class="card-3d-wrapper">
                    <div class="card-3d-content">
                        <div class="card-border-glow"></div>
                        
                        <div class="relative z-10">
                            <div class="icon-container mb-6">
                                <div class="icon-glow bg-[#06B6D4]"></div>
                                <div class="icon-inner bg-gradient-to-br from-[#06B6D4] to-[#0EA5E9]">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            
                            <h3 class="text-3xl font-bold text-white mb-4">
                                Log Aktivitas
                            </h3>
                            
                            <p class="text-gray-300 leading-relaxed mb-6">
                                Semua aktivitas tercatat otomatis untuk audit trail dan transparansi penuh.
                            </p>
                            
                            <div class="stats-grid">
                                <div class="stat-box">
                                    <div class="stat-number text-[#22D3EE]">
                                        100%
                                    </div>
                                    <div class="stat-label">Tracked</div>
                                </div>
                                <div class="stat-box">
                                    <div class="stat-number text-[#0EA5E9]">
                                        Auto
                                    </div>
                                    <div class="stat-label">Logged</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Feature 6: Multi Role Management --}}
            <div class="feature-card-3d" data-aos="zoom-in" data-aos-delay="500">
                <div class="card-3d-wrapper">
                    <div class="card-3d-content">
                        <div class="card-border-glow"></div>
                        
                        <div class="relative z-10">
                            <div class="icon-container mb-6">
                                <div class="icon-glow bg-[#8B5CF6]"></div>
                                <div class="icon-inner bg-gradient-to-br from-[#8B5CF6] to-[#0EA5E9]">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            
                            <h3 class="text-3xl font-bold text-white mb-4">
                                Multi Role System
                            </h3>
                            
                            <p class="text-gray-300 leading-relaxed mb-6">
                                Akses berbeda untuk Super Admin, Admin, Pengurus Aset, dan User dengan keamanan terjamin.
                            </p>
                            
                            <div class="stats-grid">
                                <div class="stat-box">
                                    <div class="stat-number text-[#A78BFA]">
                                        4
                                    </div>
                                    <div class="stat-label">Role Level</div>
                                </div>
                                <div class="stat-box">
                                    <div class="stat-number text-[#8B5CF6]">
                                        Secure
                                    </div>
                                    <div class="stat-label">Access</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    
    /* Pulse Slow */
    @keyframes pulse-slow {
        0%, 100% { opacity: 0.15; }
        50% { opacity: 0.25; }
    }

    .animate-pulse-slow {
        animation: pulse-slow 8s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    /* Particles */
    .particles-container {
        position: absolute;
        inset: 0;
        overflow: hidden;
    }

    .particle {
        position: absolute;
        background: white;
        border-radius: 50%;
        opacity: 0.3;
    }

    .particle:nth-child(1) {
        width: 4px;
        height: 4px;
        top: 20%;
        left: 20%;
        animation: float 6s infinite;
    }

    .particle:nth-child(2) {
        width: 6px;
        height: 6px;
        top: 60%;
        left: 80%;
        animation: float 8s infinite;
        animation-delay: 1s;
    }

    .particle:nth-child(3) {
        width: 3px;
        height: 3px;
        top: 40%;
        left: 40%;
        animation: float 7s infinite;
        animation-delay: 2s;
    }

    .particle:nth-child(4) {
        width: 5px;
        height: 5px;
        top: 80%;
        left: 60%;
        animation: float 9s infinite;
        animation-delay: 3s;
    }

    .particle:nth-child(5) {
        width: 4px;
        height: 4px;
        top: 30%;
        left: 70%;
        animation: float 10s infinite;
        animation-delay: 4s;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0) translateX(0);
        }
        25% {
            transform: translateY(-30px) translateX(20px);
        }
        50% {
            transform: translateY(-60px) translateX(-20px);
        }
        75% {
            transform: translateY(-30px) translateX(20px);
        }
    }

    /* 3D Card Effects */
    .feature-card-3d {
        perspective: 1500px;
        height: 100%;
    }

    .card-3d-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
        transition: transform 0.6s;
        transform-style: preserve-3d;
    }

    .feature-card-3d:hover .card-3d-wrapper {
        transform: rotateY(5deg) rotateX(5deg);
    }

    .card-3d-content {
        position: relative;
        background: linear-gradient(135deg, rgba(30, 30, 40, 0.9), rgba(20, 20, 30, 0.95));
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 2.5rem;
        height: 100%;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        transition: all 0.5s ease;
    }

    .feature-card-3d:hover .card-3d-content {
        border-color: rgba(14, 165, 233, 0.5);
        box-shadow: 0 40px 80px -20px rgba(14, 165, 233, 0.4);
    }

    /* Animated Border Glow - Cimahi Colors */
    .card-border-glow {
        position: absolute;
        inset: 0;
        border-radius: 24px;
        padding: 2px;
        background: linear-gradient(45deg, #0EA5E9, #8B5CF6, #06B6D4, #0EA5E9);
        background-size: 300% 300%;
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0;
        animation: gradient 4s ease infinite;
        transition: opacity 0.5s;
    }

    .feature-card-3d:hover .card-border-glow {
        opacity: 1;
    }

    /* Icon Container */
    .icon-container {
        position: relative;
        width: fit-content;
    }

    .icon-glow {
        position: absolute;
        inset: -10px;
        border-radius: 20px;
        opacity: 0.5;
        filter: blur(20px);
        transition: all 0.5s;
    }

    .feature-card-3d:hover .icon-glow {
        opacity: 0.8;
        filter: blur(30px);
    }

    .icon-inner {
        position: relative;
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.5);
        transition: all 0.5s;
    }

    .feature-card-3d:hover .icon-inner {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.7);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin: 1.5rem 0;
        padding: 1.5rem;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .stat-box {
        text-align: center;
    }

    .stat-number {
        font-size: 1.75rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.75rem;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }
</style>
@endpush