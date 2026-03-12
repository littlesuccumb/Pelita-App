{{-- Recent Items Section - Cimahi Hybrid Theme --}}
<section class="py-24 bg-gradient-to-b from-slate-50 via-blue-50 to-cyan-50 relative overflow-hidden">
    {{-- Subtle Pattern Background --}}
    <div class="absolute inset-0 bg-grid-pattern-light opacity-30"></div>
    
    {{-- Animated Background Orbs - Cimahi Colors --}}
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-[#0EA5E9] rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-slow"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-[#8B5CF6] rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-slow" style="animation-delay: 3s"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-[#06B6D4] rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-pulse-slow" style="animation-delay: 6s"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center mb-16" data-aos="fade-up">
            <div class="inline-flex items-center px-6 py-3 bg-white/80 backdrop-blur-sm rounded-full mb-6 shadow-lg border border-[#0EA5E9]/20">
                <span class="relative flex h-3 w-3 mr-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#0EA5E9] opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-[#0EA5E9]"></span>
                </span>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#0EA5E9] to-[#8B5CF6] font-bold text-sm uppercase tracking-wider">Koleksi Terbaru</span>
            </div>
            
            <h2 class="text-5xl lg:text-6xl font-bold mb-6">
                <span class="text-gray-900">Aset</span>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#0EA5E9] via-[#8B5CF6] to-[#06B6D4] animate-gradient"> Premium</span>
            </h2>
            
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Temukan aset berkualitas tinggi yang siap memenuhi kebutuhan Anda
            </p>
        </div>

        @if($recentBarang->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
            @foreach($recentBarang as $index => $barang)
            <div class="product-card-cimahi" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                {{-- Image Section --}}
                <div class="product-imgBx">
                    @if($barang->foto)
                        <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama_barang }}">
                    @else
                        <div class="flex items-center justify-center h-full">
                            <svg class="w-32 h-32 text-gray-600 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    @endif
                    
                    {{-- Brand Watermark --}}
                    <div class="product-brand-cimahi">PELITA</div>
                </div>

                {{-- Content Section --}}
                <div class="product-contentBx">
                    <h2>{{ $barang->nama_barang }}</h2>
                    
                    {{-- Stock Info --}}
                    <div class="product-stock">
                        <h3>Stok:</h3>
                        <span class="stock-badge {{ $barang->jumlah_tersedia > 5 ? 'stock-available-cimahi' : 'stock-low-cimahi' }}">
                            {{ $barang->jumlah_tersedia }}/{{ $barang->jumlah_total }}
                        </span>
                    </div>
                    
                    {{-- Category --}}
                    <div class="product-category">
                        <h3>Kategori:</h3>
                        @if($barang->kategori)
                            <span class="category-badge-cimahi">{{ $barang->kategori->nama_kategori }}</span>
                        @else
                            <span class="category-badge-cimahi">Umum</span>
                        @endif
                    </div>

                    {{-- Location --}}
                    <div class="product-location">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>{{ $barang->lokasi ?: 'Tidak tersedia' }}</span>
                    </div>

                    {{-- Price --}}
                    @if($barang->harga_sewa > 0)
                        <div class="product-price-cimahi">
                            Rp {{ number_format($barang->harga_sewa, 0, ',', '.') }}<span>/hari</span>
                        </div>
                    @else
                        <div class="product-price-cimahi free">GRATIS</div>
                    @endif
                    
                    {{-- CTA Button --}}
                    <a href="{{ route('aset.barang.detail', $barang->id) }}" class="product-cta-cimahi">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        
        {{-- View All Button --}}
        <div class="text-center mt-16" data-aos="fade-up">
            <a href="{{ route('aset.barang') }}" class="group inline-flex items-center px-10 py-5 bg-gradient-to-r from-[#0EA5E9] via-[#8B5CF6] to-[#06B6D4] text-white rounded-2xl font-bold text-lg shadow-xl shadow-[#0EA5E9]/30 hover:shadow-2xl hover:shadow-[#0EA5E9]/40 transition-all duration-300 transform hover:scale-105 hover:-translate-y-1">
                <span>Lihat Semua Barang</span>
                <svg class="w-5 h-5 ml-3 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
        @else
            {{-- Empty State --}}
            <div class="text-center py-20" data-aos="fade-up">
                <div class="w-32 h-32 bg-gradient-to-br from-[#0EA5E9]/10 to-[#8B5CF6]/10 rounded-full flex items-center justify-center mx-auto mb-8 animate-pulse-slow border border-[#0EA5E9]/20">
                    <svg class="w-16 h-16 text-[#0EA5E9]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 009.586 13H7"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Belum Ada Aset Tersedia</h3>
                <p class="text-gray-600 text-lg">Saat ini belum ada aset yang tersedia untuk dipinjam.</p>
            </div>
        @endif
    </div>
</section>

@push('styles')
<style>
/* Grid Pattern Light */
.bg-grid-pattern-light {
    background-image: linear-gradient(rgba(14, 165, 233, 0.08) 1px, transparent 1px),
                      linear-gradient(90deg, rgba(14, 165, 233, 0.08) 1px, transparent 1px);
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

/* ============================================
   Product Card Styles - Cimahi Theme
   ============================================ */
.product-card-cimahi {
    position: relative;
    width: 100%;
    max-width: 380px;
    margin: 0 auto;
    height: 500px;
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 24px;
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    border: 1px solid rgba(14, 165, 233, 0.1);
}

.product-card-cimahi:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px -12px rgba(14, 165, 233, 0.4);
    border-color: rgba(14, 165, 233, 0.3);
}

.product-card-cimahi::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #0EA5E9 0%, #8B5CF6 100%);
    clip-path: circle(150px at 80% 20%);
    transition: 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.product-card-cimahi:hover::before {
    clip-path: circle(400px at 80% -20%);
}

.product-brand-cimahi {
    position: absolute;
    top: 30%;
    left: -20%;
    font-size: 10em;
    font-weight: 800;
    font-style: italic;
    color: rgba(14, 165, 233, 0.04);
    pointer-events: none;
    letter-spacing: -0.05em;
}

.product-imgBx {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 100;
    width: 100%;
    height: 280px;
    transition: 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-card-cimahi:hover .product-imgBx {
    top: 0%;
    transform: translateY(0%);
}

.product-imgBx img {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-15deg);
    width: 85%;
    max-width: 300px;
    height: auto;
    object-fit: contain;
    filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.4));
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.product-card-cimahi:hover .product-imgBx img {
    transform: translate(-50%, -50%) rotate(-5deg) scale(1.05);
}

.product-contentBx {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 120px;
    text-align: center;
    transition: 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 110;
    padding: 0 20px;
    background: linear-gradient(to top, #ffffff 85%, transparent);
}

.product-card-cimahi:hover .product-contentBx {
    height: 320px;
    background: linear-gradient(to top, #ffffff 75%, transparent);
}

.product-contentBx h2 {
    position: relative;
    font-weight: 700;
    letter-spacing: 0.5px;
    color: #111827;
    margin: 0 0 10px 0;
    font-size: 1.5rem;
    line-height: 1.3;
    text-shadow: 0 1px 2px rgba(255, 255, 255, 0.8);
}

.product-stock {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 6px 0;
    transition: 0.5s;
    opacity: 0;
    visibility: hidden;
}

.product-card-cimahi:hover .product-stock {
    opacity: 1;
    visibility: visible;
    transition-delay: 0.3s;
}

.product-stock h3 {
    color: #4b5563;
    font-weight: 500;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-right: 8px;
}

.stock-badge {
    padding: 4px 12px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    background: rgba(229, 231, 235, 0.8);
    color: #374151;
    backdrop-filter: blur(10px);
}

.stock-available-cimahi {
    padding: 4px 12px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
    background: rgba(6, 182, 212, 0.15);
    color: #0891B2;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(6, 182, 212, 0.3);
}

.stock-low-cimahi {
    padding: 4px 12px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
    background: rgba(249, 115, 22, 0.15);
    color: #EA580C;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(249, 115, 22, 0.3);
}

.product-category {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 6px 0;
    transition: 0.5s;
    opacity: 0;
    visibility: hidden;
}

.product-card-cimahi:hover .product-category {
    opacity: 1;
    visibility: visible;
    transition-delay: 0.4s;
}

.product-category h3 {
    color: #4b5563;
    font-weight: 500;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-right: 8px;
}

.category-badge-cimahi {
    padding: 4px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    background: rgba(139, 92, 246, 0.15);
    color: #7C3AED;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(139, 92, 246, 0.3);
}

.product-location {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
    padding: 6px 0;
    transition: 0.5s;
    opacity: 0;
    visibility: hidden;
    color: #4b5563;
    font-size: 13px;
    font-weight: 500;
}

.product-card-cimahi:hover .product-location {
    opacity: 1;
    visibility: visible;
    transition-delay: 0.5s;
}

.product-price-cimahi {
    font-size: 2rem;
    font-weight: 700;
    background: linear-gradient(135deg, #0EA5E9, #8B5CF6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 12px 0 8px 0;
    transition: 0.5s;
    opacity: 0;
    visibility: hidden;
}

.product-price-cimahi span {
    font-size: 0.9rem;
    font-weight: 400;
    background: linear-gradient(135deg, #06B6D4, #A78BFA);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.product-price-cimahi.free {
    background: linear-gradient(135deg, #06B6D4, #0EA5E9);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.product-card-cimahi:hover .product-price-cimahi {
    opacity: 1;
    visibility: visible;
    transition-delay: 0.6s;
}

.product-cta-cimahi {
    display: inline-block;
    padding: 12px 32px;
    background: linear-gradient(135deg, #0EA5E9, #8B5CF6);
    border-radius: 12px;
    margin-top: 8px;
    text-decoration: none;
    font-weight: 700;
    color: #ffffff;
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 15px;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 14px 0 rgba(14, 165, 233, 0.4);
}

.product-card-cimahi:hover .product-cta-cimahi {
    opacity: 1;
    transform: translateY(0px);
    transition-delay: 0.7s;
}

.product-cta-cimahi:hover {
    background: linear-gradient(135deg, #0284C7, #7C3AED);
    color: #fff;
    box-shadow: 0 10px 25px -5px rgba(14, 165, 233, 0.6);
    transform: translateY(-2px);
}

/* ============================================
   Responsive Design
   ============================================ */
@media (max-width: 768px) {
    .product-card-cimahi {
        max-width: 320px;
        height: 480px;
    }
    
    .product-imgBx {
        height: 240px;
    }
    
    .product-contentBx h2 {
        font-size: 1.3rem;
    }
    
    .product-price-cimahi {
        font-size: 1.7rem;
    }
    
    .product-brand-cimahi {
        font-size: 7em;
    }
}

@media (max-width: 640px) {
    .product-card-cimahi {
        max-width: 100%;
        height: 460px;
    }
    
    .product-imgBx img {
        width: 80%;
    }
    
    .product-card-cimahi:hover .product-contentBx {
        height: 280px;
    }
}
</style>
@endpush