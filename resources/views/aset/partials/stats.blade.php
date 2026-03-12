{{-- Stats Section - Clean Floating Style with Medium Size (No Icons) --}}
<div class="stats-variant-medium max-w-5xl mx-auto pt-16" data-aos="fade-up" data-aos-delay="200">
    <div class="grid grid-cols-2 md:grid-cols-3 gap-10">
        {{-- Stat 1: Barang Tersedia --}}
        <div class="group stats-card text-center relative">
            <div class="text-5xl lg:text-6xl font-bold text-white mb-2 stat-container transform group-hover:scale-105 transition-transform duration-500 flex items-center justify-center">
                <span id="barangCount" class="counter-number drop-shadow-xl" data-value="{{ $stats['barang_tersedia'] }}" style="text-shadow: 0 0 20px rgba(16, 185, 129, 0.4)">0</span><span class="text-emerald-300 drop-shadow-lg text-5xl lg:text-6xl ml-2">+</span>
            </div>
            
            <div class="text-white/90 text-base font-semibold mb-2 tracking-wide">Jenis Barang</div>
            <div class="h-1 w-20 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-full mx-auto transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 shadow-lg shadow-emerald-500/50"></div>
        </div>

        {{-- Stat 2: Total Kategori --}}
        <div class="group stats-card text-center relative">
            <div class="text-5xl lg:text-6xl font-bold text-white mb-2 stat-container transform group-hover:scale-105 transition-transform duration-500 flex items-center justify-center">
                <span id="kategoriCount" class="counter-number drop-shadow-xl" data-value="{{ $stats['total_kategori'] }}" style="text-shadow: 0 0 20px rgba(168, 85, 247, 0.4)">0</span><span class="text-purple-300 drop-shadow-lg text-5xl lg:text-6xl ml-2">+</span>
            </div>
            
            <div class="text-white/90 text-base font-semibold mb-2 tracking-wide">Kategori</div>
            <div class="h-1 w-20 bg-gradient-to-r from-purple-400 to-pink-500 rounded-full mx-auto transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 shadow-lg shadow-purple-500/50"></div>
        </div>

        {{-- Stat 3: Total Stok --}}
        <div class="group stats-card text-center relative col-span-2 md:col-span-1">
            <div class="text-5xl lg:text-6xl font-bold text-white mb-2 stat-container transform group-hover:scale-105 transition-transform duration-500 flex items-center justify-center">
                <span id="stokCount" class="counter-number drop-shadow-xl" data-value="{{ $stats['total_stok_tersedia'] }}" style="text-shadow: 0 0 20px rgba(245, 158, 11, 0.4)">0</span><span class="text-amber-300 drop-shadow-lg text-5xl lg:text-6xl ml-2">+</span>
            </div>
            
            <div class="text-white/90 text-base font-semibold mb-2 tracking-wide">Total Stok</div>
            <div class="h-1 w-20 bg-gradient-to-r from-amber-400 to-orange-500 rounded-full mx-auto transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 shadow-lg shadow-amber-500/50"></div>
        </div>
    </div>
</div>