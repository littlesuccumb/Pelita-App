{{-- How It Works Section - Professional Light Theme with Cimahi Colors --}}
<section class="py-24 bg-gradient-to-br from-slate-50 via-blue-50 to-cyan-50 relative overflow-hidden">
    {{-- Subtle Grid Pattern --}}
    <div class="absolute inset-0 bg-grid-pattern-light opacity-30"></div>
    
    {{-- Animated Background Orbs - Subtle Cimahi Colors --}}
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-slow"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-purple-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-slow" style="animation-delay: 3s"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-pulse-slow" style="animation-delay: 6s"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center px-6 py-3 bg-white/80 backdrop-blur-sm rounded-full mb-6 shadow-lg border border-blue-500/20">
                <span class="relative flex h-3 w-3 mr-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-500 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-500"></span>
                </span>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 font-bold text-sm uppercase tracking-wider">Cara Kerja</span>
            </div>
            
            <h2 class="text-5xl lg:text-6xl font-bold mb-6">
                <span class="text-gray-900">Mudah dalam</span>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-purple-600 to-cyan-500 animate-gradient"> 6 Langkah</span>
            </h2>
            
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Proses peminjaman yang simpel, cepat, dan terstruktur untuk kenyamanan Anda
            </p>
        </div>

        {{-- Swiper Slider --}}
        <div class="relative" data-aos="fade-up" data-aos-delay="200">
            <div class="swiper stepsSwiper pb-16">
                <div class="swiper-wrapper">
                    {{-- Step 1: Buat Permohonan --}}
                    <div class="swiper-slide">
                        <div class="glass-card-light rounded-3xl p-8 h-full shadow-xl hover:shadow-2xl hover:shadow-blue-500/20 transition-all duration-500 group border border-blue-500/20">
                            <div class="progress-line" style="width: 16.66%; background: linear-gradient(90deg, #3B82F6 0%, #2563EB 100%);"></div>
                            
                            <div class="flex items-center justify-between mb-6">
                                <div class="step-number-wrapper">
                                    <div class="step-number w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex flex-col items-center justify-center text-white shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform duration-300">
                                        <span class="text-xs font-semibold opacity-90">Langkah</span>
                                        <span class="text-2xl font-bold">01</span>
                                    </div>
                                </div>
                                <div class="flex-1 h-1 bg-gradient-to-r from-blue-500/30 to-transparent ml-4"></div>
                            </div>

                            <div class="floating-icon mb-6">
                                <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-50 rounded-2xl flex items-center justify-center mx-auto group-hover:shadow-lg group-hover:shadow-blue-500/20 transition-all duration-300 border border-blue-500/20">
                                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </div>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">
                                Buat Permohonan
                            </h3>
                            <p class="text-gray-600 leading-relaxed mb-6">
                                Registrasi akun dan buat permohonan peminjaman dengan mengisi form dan upload surat bertanda tangan
                            </p>

                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold border border-blue-300">Registrasi</span>
                                <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-semibold border border-blue-200">Upload Surat</span>
                            </div>
                        </div>
                    </div>

                    {{-- Step 2: Permohonan Disetujui --}}
                    <div class="swiper-slide">
                        <div class="glass-card-light rounded-3xl p-8 h-full shadow-xl hover:shadow-2xl hover:shadow-emerald-500/20 transition-all duration-500 group border border-emerald-500/20">
                            <div class="progress-line" style="width: 33.33%; background: linear-gradient(90deg, #10B981 0%, #059669 100%);"></div>
                            
                            <div class="flex items-center justify-between mb-6">
                                <div class="step-number-wrapper">
                                    <div class="step-number w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-2xl flex flex-col items-center justify-center text-white shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform duration-300">
                                        <span class="text-xs font-semibold opacity-90">Langkah</span>
                                        <span class="text-2xl font-bold">02</span>
                                    </div>
                                </div>
                                <div class="flex-1 h-1 bg-gradient-to-r from-emerald-500/30 to-transparent ml-4"></div>
                            </div>

                            <div class="floating-icon mb-6" style="animation-delay: 0.5s">
                                <div class="w-20 h-20 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-2xl flex items-center justify-center mx-auto group-hover:shadow-lg group-hover:shadow-emerald-500/20 transition-all duration-300 border border-emerald-500/20">
                                    <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                    </svg>
                                </div>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-emerald-600 transition-colors">
                                Permohonan Disetujui
                            </h3>
                            <p class="text-gray-600 leading-relaxed mb-6">
                                Admin akan mereview permohonan Anda. Setelah disetujui, sistem otomatis membuat data peminjaman
                            </p>

                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold border border-emerald-300">Review Admin</span>
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-xs font-semibold border border-emerald-200">Auto Create</span>
                            </div>
                        </div>
                    </div>

                    {{-- Step 3: Approve Peminjaman --}}
                    <div class="swiper-slide">
                        <div class="glass-card-light rounded-3xl p-8 h-full shadow-xl hover:shadow-2xl hover:shadow-indigo-500/20 transition-all duration-500 group border border-indigo-500/20">
                            <div class="progress-line" style="width: 50%; background: linear-gradient(90deg, #6366F1 0%, #4F46E5 100%);"></div>
                            
                            <div class="flex items-center justify-between mb-6">
                                <div class="step-number-wrapper">
                                    <div class="step-number w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-2xl flex flex-col items-center justify-center text-white shadow-lg shadow-indigo-500/30 group-hover:scale-110 transition-transform duration-300">
                                        <span class="text-xs font-semibold opacity-90">Langkah</span>
                                        <span class="text-2xl font-bold">03</span>
                                    </div>
                                </div>
                                <div class="flex-1 h-1 bg-gradient-to-r from-indigo-500/30 to-transparent ml-4"></div>
                            </div>

                            <div class="floating-icon mb-6" style="animation-delay: 1s">
                                <div class="w-20 h-20 bg-gradient-to-br from-indigo-100 to-indigo-50 rounded-2xl flex items-center justify-center mx-auto group-hover:shadow-lg group-hover:shadow-indigo-500/20 transition-all duration-300 border border-indigo-500/20">
                                    <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-indigo-600 transition-colors">
                                Approve Peminjaman
                            </h3>
                            <p class="text-gray-600 leading-relaxed mb-6">
                                Admin mereview detail peminjaman dan ketersediaan barang, lalu menyetujui atau menolak peminjaman
                            </p>

                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-xs font-semibold border border-indigo-300">Verifikasi</span>
                                <span class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-full text-xs font-semibold border border-indigo-200">Cek Stok</span>
                            </div>
                        </div>
                    </div>

                    {{-- Step 4: Proses Pembayaran --}}
                    <div class="swiper-slide">
                        <div class="glass-card-light rounded-3xl p-8 h-full shadow-xl hover:shadow-2xl hover:shadow-purple-500/20 transition-all duration-500 group border border-purple-500/20">
                            <div class="progress-line" style="width: 66.66%; background: linear-gradient(90deg, #8B5CF6 0%, #7C3AED 100%);"></div>
                            
                            <div class="flex items-center justify-between mb-6">
                                <div class="step-number-wrapper">
                                    <div class="step-number w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-700 rounded-2xl flex flex-col items-center justify-center text-white shadow-lg shadow-purple-500/30 group-hover:scale-110 transition-transform duration-300">
                                        <span class="text-xs font-semibold opacity-90">Langkah</span>
                                        <span class="text-2xl font-bold">04</span>
                                    </div>
                                </div>
                                <div class="flex-1 h-1 bg-gradient-to-r from-purple-500/30 to-transparent ml-4"></div>
                            </div>

                            <div class="floating-icon mb-6" style="animation-delay: 1.5s">
                                <div class="w-20 h-20 bg-gradient-to-br from-purple-100 to-purple-50 rounded-2xl flex items-center justify-center mx-auto group-hover:shadow-lg group-hover:shadow-purple-500/20 transition-all duration-300 border border-purple-500/20">
                                    <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                </div>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-purple-600 transition-colors">
                                Proses Pembayaran
                            </h3>
                            <p class="text-gray-600 leading-relaxed mb-6">
                                Lakukan pembayaran sesuai biaya sewa. Upload bukti transfer untuk pembayaran non-cash
                            </p>

                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-semibold border border-purple-300">Transfer</span>
                                <span class="px-3 py-1 bg-purple-50 text-purple-600 rounded-full text-xs font-semibold border border-purple-200">Upload Bukti</span>
                            </div>
                        </div>
                    </div>

                    {{-- Step 5: Ambil Barang --}}
                    <div class="swiper-slide">
                        <div class="glass-card-light rounded-3xl p-8 h-full shadow-xl hover:shadow-2xl hover:shadow-orange-500/20 transition-all duration-500 group border border-orange-500/20">
                            <div class="progress-line" style="width: 83.33%; background: linear-gradient(90deg, #F97316 0%, #EA580C 100%);"></div>
                            
                            <div class="flex items-center justify-between mb-6">
                                <div class="step-number-wrapper">
                                    <div class="step-number w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-700 rounded-2xl flex flex-col items-center justify-center text-white shadow-lg shadow-orange-500/30 group-hover:scale-110 transition-transform duration-300">
                                        <span class="text-xs font-semibold opacity-90">Langkah</span>
                                        <span class="text-2xl font-bold">05</span>
                                    </div>
                                </div>
                                <div class="flex-1 h-1 bg-gradient-to-r from-orange-500/30 to-transparent ml-4"></div>
                            </div>

                            <div class="floating-icon mb-6" style="animation-delay: 2s">
                                <div class="w-20 h-20 bg-gradient-to-br from-orange-100 to-orange-50 rounded-2xl flex items-center justify-center mx-auto group-hover:shadow-lg group-hover:shadow-orange-500/20 transition-all duration-300 border border-orange-500/20">
                                    <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                    </svg>
                                </div>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-orange-600 transition-colors">
                                Ambil Barang
                            </h3>
                            <p class="text-gray-600 leading-relaxed mb-6">
                                Setelah pembayaran dikonfirmasi, ambil barang sesuai jadwal yang telah ditentukan dengan Berita Acara
                            </p>

                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-semibold border border-orange-300">Berita Acara</span>
                                <span class="px-3 py-1 bg-orange-50 text-orange-600 rounded-full text-xs font-semibold border border-orange-200">Serah Terima</span>
                            </div>
                        </div>
                    </div>

                    {{-- Step 6: Pengembalian --}}
                    <div class="swiper-slide">
                        <div class="glass-card-light rounded-3xl p-8 h-full shadow-xl hover:shadow-2xl hover:shadow-cyan-500/20 transition-all duration-500 group border border-cyan-500/20">
                            <div class="progress-line" style="width: 100%; background: linear-gradient(90deg, #06B6D4 0%, #0891B2 100%);"></div>
                            
                            <div class="flex items-center justify-between mb-6">
                                <div class="step-number-wrapper">
                                    <div class="step-number w-16 h-16 bg-gradient-to-br from-cyan-500 to-cyan-700 rounded-2xl flex flex-col items-center justify-center text-white shadow-lg shadow-cyan-500/30 group-hover:scale-110 transition-transform duration-300">
                                        <span class="text-xs font-semibold opacity-90">Langkah</span>
                                        <span class="text-2xl font-bold">06</span>
                                    </div>
                                </div>
                                <div class="flex items-center ml-4">
                                    <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-cyan-700 rounded-full flex items-center justify-center shadow-lg shadow-cyan-500/30">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="floating-icon mb-6" style="animation-delay: 2.5s">
                                <div class="w-20 h-20 bg-gradient-to-br from-cyan-100 to-cyan-50 rounded-2xl flex items-center justify-center mx-auto group-hover:shadow-lg group-hover:shadow-cyan-500/20 transition-all duration-300 border border-cyan-500/20">
                                    <svg class="w-10 h-10 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z"></path>
                                    </svg>
                                </div>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-cyan-600 transition-colors">
                                Pengembalian
                            </h3>
                            <p class="text-gray-600 leading-relaxed mb-6">
                                Kembalikan barang tepat waktu dalam kondisi baik. Admin akan memverifikasi dan menyelesaikan peminjaman
                            </p>

                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-cyan-100 text-cyan-700 rounded-full text-xs font-semibold border border-cyan-300">Verifikasi</span>
                                <span class="px-3 py-1 bg-cyan-50 text-cyan-600 rounded-full text-xs font-semibold border border-cyan-200">Selesai</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Navigation Buttons --}}
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                
                {{-- Pagination --}}
                <div class="swiper-pagination"></div>
            </div>
        </div>

        {{-- CTA Button --}}
        <div class="text-center mt-16" data-aos="fade-up" data-aos-delay="300">
            <a href="#" class="group inline-flex items-center px-10 py-5 bg-gradient-to-r from-blue-600 via-purple-600 to-cyan-500 text-white rounded-2xl font-bold text-lg shadow-xl shadow-blue-500/30 hover:shadow-2xl hover:shadow-blue-500/40 transition-all duration-300 transform hover:scale-105 hover:-translate-y-1">
                <svg class="w-6 h-6 mr-3 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Mulai Sekarang
                <svg class="w-5 h-5 ml-3 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- Load Swiper CSS & JS --}}
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css" />
<style>
    /* Grid Pattern Light */
    .bg-grid-pattern-light {
        background-image: linear-gradient(rgba(59, 130, 246, 0.08) 1px, transparent 1px),
                          linear-gradient(90deg, rgba(59, 130, 246, 0.08) 1px, transparent 1px);
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

    /* Pulse Slow Animation */
    @keyframes pulse-slow {
        0%, 100% { opacity: 0.2; }
        50% { opacity: 0.3; }
    }

    .animate-pulse-slow {
        animation: pulse-slow 8s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    /* Smooth Floating Animation - Modern & Subtle */
    @keyframes smooth-float {
        0%, 100% { 
            transform: translateY(0px) rotate(0deg) scale(1);
        }
        25% {
            transform: translateY(-5px) rotate(2deg) scale(1.03);
        }
        50% { 
            transform: translateY(-8px) rotate(0deg) scale(1.05);
        }
        75% {
            transform: translateY(-5px) rotate(-2deg) scale(1.03);
        }
    }
    
    .floating-icon {
        animation: smooth-float 5s ease-in-out infinite;
    }
    
    .floating-icon:hover {
        animation: smooth-float 2.5s ease-in-out infinite;
    }

    /* Glass Card Light Theme */
    .glass-card-light {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        position: relative;
        overflow: hidden;
    }

    .progress-line {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        transition: width 0.3s ease;
    }

    .step-number {
        position: relative;
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .step-number-wrapper {
        position: relative;
    }

    .step-number::before {
        content: '';
        position: absolute;
        top: -10px;
        left: -10px;
        right: -10px;
        bottom: -10px;
        background: linear-gradient(45deg, #3B82F6, #6366F1);
        border-radius: 16px;
        opacity: 0.15;
        animation: pulse-ring 2s infinite;
    }

    @keyframes pulse-ring {
        0% {
            transform: scale(0.8);
            opacity: 0.3;
        }
        50% {
            transform: scale(1.1);
            opacity: 0;
        }
        100% {
            transform: scale(0.8);
            opacity: 0;
        }
    }

    /* Swiper Customization - Professional Theme */
    .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: #3B82F6;
        opacity: 0.3;
        transition: all 0.3s;
    }

    .swiper-pagination-bullet-active {
        width: 32px;
        border-radius: 6px;
        opacity: 1;
        background: linear-gradient(135deg, #3B82F6 0%, #6366F1 100%);
    }

    .swiper-button-next, .swiper-button-prev {
        width: 50px;
        height: 50px;
        background: white;
        border: 2px solid #3B82F6;
        border-radius: 50%;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
        transition: all 0.3s;
    }

    .swiper-button-next:hover, .swiper-button-prev:hover {
        background: linear-gradient(135deg, #3B82F6 0%, #6366F1 100%);
        transform: scale(1.1);
        border-color: transparent;
    }

    .swiper-button-next:after, .swiper-button-prev:after {
        font-size: 20px;
        font-weight: bold;
        color: #3B82F6;
    }

    .swiper-button-next:hover:after, .swiper-button-prev:hover:after {
        color: white;
    }

    .swiper-slide {
        height: auto;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.stepsSwiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
            effect: 'slide',
            speed: 800,
        });

        // Pause/play saat user klik pada card
        const swiperContainer = document.querySelector('.stepsSwiper');
        let isPaused = false;
        
        swiperContainer.addEventListener('click', function(e) {
            if (!e.target.closest('.swiper-button-next') && 
                !e.target.closest('.swiper-button-prev') && 
                !e.target.closest('.swiper-pagination')) {
                if (isPaused) {
                    swiper.autoplay.start();
                    isPaused = false;
                } else {
                    swiper.autoplay.stop();
                    isPaused = true;
                }
            }
        });
    });
</script>
@endpush