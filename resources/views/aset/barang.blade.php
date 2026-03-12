@extends('layouts.guest')

@section('title', 'Katalog Barang Premium - Pelita App')

@section('meta')
<meta name="description" content="Jelajahi koleksi barang premium dengan sistem peminjaman terpercaya. {{ $barang->total() }}+ barang berkualitas tinggi tersedia untuk Anda.">
<meta name="keywords" content="katalog barang, peminjaman barang, peralatan premium, gadget">
@endsection

@section('content')
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-cyan-50 relative overflow-hidden">
    <!-- Subtle Grid Pattern -->
    <div class="absolute inset-0 bg-grid-pattern-light opacity-30"></div>
    
    <!-- Animated Background Orbs - Cimahi Colors -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-[#0EA5E9] rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-slow"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-[#8B5CF6] rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-slow" style="animation-delay: 3s"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-[#06B6D4] rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-pulse-slow" style="animation-delay: 6s"></div>
    </div>

    
    {{-- Hero Section - Professional with Animated Elements --}}
    <section class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 overflow-hidden">
        {{-- Animated Background Elements --}}
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-black/30"></div>
            <div class="absolute inset-0 bg-cover bg-center opacity-20" 
                style="background-image: url('{{ asset('images/building.jpg') }}');"></div>
            
            {{-- Animated Gradient Mesh Background --}}
            <div class="absolute inset-0 opacity-25">
                <div class="absolute top-0 -left-4 w-[500px] h-[500px] bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
                <div class="absolute top-0 -right-4 w-[500px] h-[500px] bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
                <div class="absolute -bottom-8 left-20 w-[500px] h-[500px] bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
            </div>
            
            {{-- Particle Background --}}
            <div class="absolute inset-0 overflow-hidden">
                <div class="stars"></div>
            </div>
            
            {{-- Grid Pattern --}}
            <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.03)_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_80%_50%_at_50%_50%,#000,transparent)]"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center space-y-8">
                {{-- Premium Badge --}}
                <div class="inline-flex items-center bg-white/10 backdrop-blur-xl border border-white/20 rounded-full px-6 py-3 mb-8 shadow-2xl" data-aos="fade-down">
                    <span class="relative flex h-3 w-3 mr-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                    </span>
                    <span class="text-blue-100 text-sm font-semibold tracking-wide">{{ $stats['barang_tersedia'] ?? 0 }}+ Barang Premium Tersedia</span>
                </div>
                
                {{-- Main Heading --}}
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-white leading-tight animate-fade-in-up" data-aos="fade-up" data-aos-delay="200">
                    Jelajahi
                    <br/>
                    <span class="relative inline-block mt-2">
                        <span class="relative z-10 bg-gradient-to-r from-yellow-400 via-orange-500 to-yellow-400 bg-clip-text text-transparent animate-gradient-hero">
                            Koleksi Premium
                        </span>
                    </span>
                </h1>
                
                {{-- Subtitle --}}
                <p class="text-xl sm:text-2xl text-blue-100 max-w-3xl mx-auto leading-relaxed animate-fade-in" data-aos="fade-up" data-aos-delay="300" style="animation-delay: 0.2s">
                    Koleksi lengkap peralatan premium terkini. 
                    Nikmati kemudahan peminjaman dengan platform terpercaya kami.
                </p>
                
                {{-- CTA Buttons - Single Button --}}
                <div class="flex justify-center items-center pt-4 animate-fade-in" data-aos="fade-up" data-aos-delay="400" style="animation-delay: 0.4s">
                    <a href="#catalog" class="group relative px-8 py-4 bg-white text-blue-900 rounded-xl font-semibold text-lg overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-blue-500/50">
                        <span class="relative z-10 flex items-center group-hover:opacity-0 transition-opacity duration-300">
                            Jelajahi Katalog
                            <svg class="ml-2 w-5 h-5 transform group-hover:translate-y-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                        <span class="absolute inset-0 z-10 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-white font-semibold">
                            Jelajahi Katalog
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </span>
                    </a>
                </div>

                {{-- Stats Section - Medium Size --}}
                <div class="stats-variant-medium max-w-5xl mx-auto pt-16" data-aos="fade-up" data-aos-delay="500">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-10 lg:gap-16">
                        {{-- Stat 1: Barang Tersedia --}}
                        <div class="group stats-card text-center relative">
                            <div class="text-5xl lg:text-6xl font-bold text-white mb-3 stat-container transform group-hover:scale-105 transition-transform duration-500 flex items-center justify-center">
                                <span class="counter-number drop-shadow-xl" data-value="{{ $stats['barang_tersedia'] ?? 0 }}" style="text-shadow: 0 0 20px rgba(16, 185, 129, 0.4)">0</span><span class="text-emerald-300 drop-shadow-lg text-5xl lg:text-6xl ml-2">+</span>
                            </div>
                            
                            <div class="text-white/90 text-base font-semibold mb-3 tracking-wide">Barang Tersedia</div>
                            <div class="h-1 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 shadow-lg shadow-emerald-500/50"></div>
                        </div>

                        {{-- Stat 2: Total Kategori --}}
                        <div class="group stats-card text-center relative">
                            <div class="text-5xl lg:text-6xl font-bold text-white mb-3 stat-container transform group-hover:scale-105 transition-transform duration-500 flex items-center justify-center">
                                <span class="counter-number drop-shadow-xl" data-value="{{ $stats['total_kategori'] ?? 0 }}" style="text-shadow: 0 0 20px rgba(168, 85, 247, 0.4)">0</span><span class="text-purple-300 drop-shadow-lg text-5xl lg:text-6xl ml-2">+</span>
                            </div>
                            
                            <div class="text-white/90 text-base font-semibold mb-3 tracking-wide">Kategori</div>
                            <div class="h-1 bg-gradient-to-r from-purple-400 to-pink-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 shadow-lg shadow-purple-500/50"></div>
                        </div>

                        {{-- Stat 3: Total Stok --}}
                        <div class="group stats-card text-center relative col-span-2 md:col-span-1">
                            <div class="text-5xl lg:text-6xl font-bold text-white mb-3 stat-container transform group-hover:scale-105 transition-transform duration-500 flex items-center justify-center">
                                <span class="counter-number drop-shadow-xl" data-value="{{ $stats['total_stok_tersedia'] ?? 0 }}" style="text-shadow: 0 0 20px rgba(245, 158, 11, 0.4)">0</span><span class="text-amber-300 drop-shadow-lg text-5xl lg:text-6xl ml-2">+</span>
                            </div>
                            
                            <div class="text-white/90 text-base font-semibold mb-3 tracking-wide">Stok Tersedia</div>
                            <div class="h-1 bg-gradient-to-r from-amber-400 to-orange-500 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 shadow-lg shadow-amber-500/50"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Scroll Indicator - Animated --}}
        <div class="absolute bottom-2 left-1/6 transform -translate-x-1/2 animate-bounce-slow">
            <div class="flex flex-col items-center space-y-2">
                <span class="text-white text-sm font-medium animate-pulse">Scroll untuk lebih lanjut</span>
                <svg class="w-6 h-6 text-white animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </section>
    
    <!-- Modern Filter Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div id="catalog" class="mb-8" data-aos="fade-up">
            <div class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700">
                <!-- Decorative Background -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-400/5 to-indigo-400/5 dark:from-blue-600/10 dark:to-indigo-600/10 rounded-full -mr-32 -mt-32"></div>
                
                <div class="relative p-6 lg:p-8">
                    <!-- Header -->
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                            <i class="fas fa-filter text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Filter & Pencarian</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Temukan barang sesuai kebutuhan Anda</p>
                        </div>
                    </div>
                    
                    <form method="GET" action="{{ route('aset.barang') }}#itemsContainer">
                        <!-- Filter Inputs Grid -->
                        <div class="grid grid-cols-1 lg:grid-cols-4 gap-5 mb-6">
                            <!-- Search Input -->
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-search text-blue-500 dark:text-blue-400"></i>
                                    Pencarian
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400 dark:text-gray-500 group-focus-within:text-blue-500 dark:group-focus-within:text-blue-400 transition-colors"></i>
                                    </div>
                                    <input type="text" 
                                        name="search"
                                        value="{{ request('search') }}"
                                        placeholder="Cari nama barang, kode..." 
                                        class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 focus:border-blue-500 dark:focus:border-blue-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-sm text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500">
                                </div>
                            </div>

                            <!-- Kategori Filter -->
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-tag text-purple-500 dark:text-purple-400"></i>
                                    Kategori
                                </label>
                                <div class="relative">
                                    <select name="kategori" class="block w-full px-4 py-3.5 pr-10 bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 focus:border-blue-500 dark:focus:border-blue-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-sm text-gray-900 dark:text-gray-100 appearance-none cursor-pointer">
                                        <option value="">Semua Kategori</option>
                                        @foreach($kategori as $kat)
                                            <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                                                {{ $kat->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Sort Select -->
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-sort text-indigo-500 dark:text-indigo-400"></i>
                                    Urutkan
                                </label>
                                <div class="relative">
                                    <select name="sort" class="block w-full px-4 py-3.5 pr-10 bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 focus:border-blue-500 dark:focus:border-blue-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-sm text-gray-900 dark:text-gray-100 appearance-none cursor-pointer">
                                        <option value="nama_barang" {{ request('sort') == 'nama_barang' ? 'selected' : '' }}>Nama A-Z</option>
                                        <option value="harga_sewa" {{ request('sort') == 'harga_sewa' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Terbaru</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons - Spanning -->
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 opacity-0 pointer-events-none">
                                    <i class="fas fa-cog"></i>
                                    Aksi
                                </label>
                                <div class="flex gap-3">
                                    <button type="submit" class="flex-1 group relative inline-flex items-center justify-center px-6 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                        <i class="fas fa-search mr-2 group-hover:scale-110 transition-transform"></i>
                                        <span class="text-sm">Cari</span>
                                    </button>
                                    <a href="{{ route('aset.barang') }}" 
                                    class="flex-1 group inline-flex items-center justify-center px-6 py-3.5 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-xl transition-all duration-300">
                                        <i class="fas fa-redo mr-2 group-hover:rotate-180 transition-transform duration-500"></i>
                                        <span class="text-sm">Reset</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modern Results Header -->
        <div id="itemsContainer" class="flex flex-col md:flex-row md:items-center justify-between mb-10 gap-6" data-aos="fade-up">
            <div>
                <div class="text-2xl font-bold text-slate-900">
                    Menampilkan 
                    <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">{{ $barang->count() }}</span>
                    <span class="text-slate-600 font-normal">dari</span>
                    <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">{{ $barang->total() }}</span>
                    <span class="text-slate-600 font-normal">produk</span>
                </div>
                @if(request('search'))
                    <div class="text-sm text-slate-500 mt-2 font-light">
                        Hasil pencarian untuk "<span class="font-semibold text-blue-600">{{ request('search') }}</span>"
                    </div>
                @endif
                @if(request('kategori'))
                    @php
                        $selectedKategori = $kategori->firstWhere('id', request('kategori'));
                    @endphp
                    @if($selectedKategori)
                        <div class="text-sm text-slate-500 mt-1 font-light">
                            Kategori: <span class="font-semibold text-purple-600">{{ $selectedKategori->nama_kategori }}</span>
                        </div>
                    @endif
                @endif
            </div>
        </div>

        <!-- Premium Product Grid - 4 COLUMNS -->
        @if($barang->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
            @foreach($barang as $index => $item)
                <div class="product-card group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100/80" 
                    data-aos="fade-up" 
                    data-aos-delay="{{ $index * 30 }}"
                    data-index="{{ $index }}">
                    
                    {{-- Modern Blur Overlay untuk item 9-12 jika belum login --}}
                    @if(!auth()->check() && $index >= 8)
                    <div class="absolute inset-0 z-50 backdrop-blur-md bg-white/40 flex items-center justify-center rounded-2xl">
                        <div class="text-center p-6">
                            <div class="relative inline-block mb-4">
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full blur-xl opacity-30 animate-pulse"></div>
                                <div class="relative bg-white rounded-full p-5 shadow-2xl">
                                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                            </div>
                            <h4 class="text-base font-bold text-slate-900 mb-2">Premium Content</h4>
                            <p class="text-xs text-slate-600 mb-4 max-w-[180px] mx-auto leading-relaxed">Login to unlock full catalog</p>
                            <a href="{{ route('login') }}" 
                            class="inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-sm font-semibold rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                                Login
                            </a>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Modern Image Container with Overlay Info -->
                    <div class="relative aspect-square overflow-hidden bg-gradient-to-br from-slate-50 to-slate-100">
                        @if($item->foto)
                            @if(filter_var($item->foto, FILTER_VALIDATE_URL))
                                <img src="{{ $item->foto }}" alt="{{ $item->nama_barang }}" 
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" loading="lazy">
                            @else
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_barang }}" 
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" loading="lazy">
                            @endif
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-100 via-purple-100 to-cyan-100 flex items-center justify-center">
                                <svg class="w-20 h-20 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <!-- Enhanced Gradient Overlay on Hover -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                        
                        <!-- Top Badges Row -->
                        <div class="absolute top-3 left-3 right-3 flex items-start justify-between gap-2">
                            <!-- Status Badge -->
                            @php
                                $statusConfig = [
                                    'tersedia' => ['bg' => 'from-emerald-500 to-teal-600', 'text' => 'Tersedia', 'ring' => 'ring-emerald-400/50', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                    'dipinjam' => ['bg' => 'from-amber-500 to-orange-600', 'text' => 'Dipinjam', 'ring' => 'ring-amber-400/50', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                    'maintenance' => ['bg' => 'from-red-500 to-rose-600', 'text' => 'Maintenance', 'ring' => 'ring-red-400/50', 'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z']
                                ];
                                $config = $statusConfig[$item->status] ?? ['bg' => 'from-gray-500 to-gray-600', 'text' => ucfirst($item->status), 'ring' => 'ring-gray-400/50', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gradient-to-r {{ $config['bg'] }} text-white text-[11px] font-bold rounded-full shadow-lg backdrop-blur-sm ring-2 {{ $config['ring'] }} uppercase tracking-wider">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $config['icon'] }}"></path>
                                </svg>
                                {{ $config['text'] }}
                            </span>
                            
                            <!-- Category Badge -->
                            @if($item->kategori)
                            <span class="inline-flex items-center px-3 py-1.5 bg-white/95 backdrop-blur-sm text-blue-700 text-[11px] font-bold rounded-full shadow-md border border-blue-100 uppercase tracking-wider">
                                {{ $item->kategori->nama_kategori }}
                            </span>
                            @endif
                        </div>

                        <!-- Bottom Info - Stock & Quick View -->
                        <div class="absolute bottom-3 left-3 right-3 flex items-end justify-between gap-2 opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-2 group-hover:translate-y-0">
                            <!-- Stock Badge -->
                            <div class="flex items-center gap-2">
                                <span class="inline-flex items-center gap-1.5 px-3 py-2 bg-black/80 backdrop-blur-xl text-white text-xs font-bold rounded-lg border border-white/20 shadow-xl">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                    <span>{{ $item->jumlah_tersedia }}/{{ $item->jumlah_total }}</span>
                                </span>
                            </div>
                            
                            <!-- Quick View Button -->
                            <a href="{{ route('aset.barang.detail', $item->id) }}" 
                            class="inline-flex items-center gap-1.5 px-4 py-2 bg-white/95 backdrop-blur-xl text-blue-600 text-xs font-bold rounded-lg shadow-xl hover:bg-blue-600 hover:text-white transition-all duration-300 border border-white/20">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <span>Detail</span>
                            </a>
                        </div>
                    </div>

                    <!-- Enhanced Content Section -->
                    <div class="p-5">
                        <!-- Product Name -->
                        <h3 class="text-base font-bold text-slate-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300 leading-snug min-h-[2.5rem]">
                            {{ $item->nama_barang }}
                        </h3>

                        <!-- Description with Icon -->
                        @if($item->deskripsi)
                        <div class="flex items-start gap-2 mb-4">
                            <svg class="w-4 h-4 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-slate-600 text-xs leading-relaxed line-clamp-2">
                                {{ $item->deskripsi }}
                            </p>
                        </div>
                        @else
                        <p class="text-slate-500 text-xs italic mb-4 line-clamp-2">Tidak ada deskripsi</p>
                        @endif

                        <!-- Info Grid -->
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            @if($item->lokasi)
                            <div class="flex items-center gap-2 text-xs text-slate-600 bg-slate-50 px-2.5 py-2 rounded-lg">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="font-medium truncate">{{ $item->lokasi }}</span>
                            </div>
                            @endif
                            
                            @if($item->kondisi)
                            <div class="flex items-center gap-2 text-xs text-slate-600 bg-slate-50 px-2.5 py-2 rounded-lg">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-medium capitalize">{{ ucfirst($item->kondisi) }}</span>
                            </div>
                            @endif
                        </div>

                        <!-- Price Section -->
                        <div class="flex items-center justify-between mb-4 pt-3 border-t border-slate-100">
                            @if($item->harga_sewa > 0)
                            <div>
                                <div class="text-sm text-slate-500 font-medium mb-0.5">Harga Sewa</div>
                                <div class="text-xl font-black bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                    Rp{{ number_format($item->harga_sewa, 0, ',', '.') }}
                                </div>
                                <div class="text-[10px] text-slate-500 font-medium">/hari</div>
                            </div>
                            @else
                            <div>
                                <div class="text-sm text-slate-500 font-medium mb-0.5">Harga Sewa</div>
                                <div class="text-xl font-black bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                                    GRATIS
                                </div>
                            </div>
                            @endif
                            
                            <!-- Availability Indicator -->
                            <div class="text-right">
                                <div class="text-[10px] text-slate-500 font-medium mb-1">Ketersediaan</div>
                                @if($item->jumlah_tersedia > 0)
                                <div class="inline-flex items-center gap-1 text-xs font-bold text-emerald-600">
                                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                                    Tersedia
                                </div>
                                @else
                                <div class="inline-flex items-center gap-1 text-xs font-bold text-red-600">
                                    <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                                    Habis
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Enhanced CTA Button -->
                        <a href="{{ route('aset.barang.detail', $item->id) }}" 
                        class="block w-full text-center py-3 px-4 rounded-xl font-bold text-sm transition-all duration-300 relative overflow-hidden group/btn bg-gradient-to-r from-slate-50 to-slate-100 text-slate-700 hover:text-white border-2 border-slate-200 hover:border-blue-500">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <span class="group-hover/btn:scale-110 transition-transform duration-300">Lihat Detail</span>
                                <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 transform scale-x-0 group-hover/btn:scale-x-100 transition-transform duration-500 origin-left rounded-xl"></div>
                        </a>
                    </div>
                </div>
                @endforeach
        </div>

        {{-- VARIANT 1: Minimalist Inline Badge - RECOMMENDED --}}
        @if(!auth()->check() && $barang->total() > 12)
        <div class="flex items-center justify-center mb-12" data-aos="fade-up">
            <div class="inline-flex items-center gap-3 bg-white border-2 border-slate-200 rounded-2xl px-6 py-4 shadow-sm hover:shadow-md hover:border-blue-300 transition-all duration-300">
                <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <div class="text-left">
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-black bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            {{ $barang->total() - 12 }}+
                        </span>
                        <span class="text-sm font-semibold text-slate-700">Premium Items Available</span>
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5">Login to unlock full access</p>
                </div>
            </div>
        </div>
        @endif

        @else

        <!-- Ultra Modern Empty State -->
        <div class="text-center py-24" data-aos="fade-up">
            <div class="max-w-lg mx-auto">
                <!-- Animated Empty Illustration -->
                <div class="relative mb-10">
                    <div class="w-40 h-40 bg-gradient-to-br from-blue-100 via-purple-100 to-cyan-100 rounded-full flex items-center justify-center mx-auto relative overflow-hidden shadow-2xl">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-purple-500/10 animate-pulse"></div>
                        <svg class="w-20 h-20 text-blue-400 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 009.586 13H7"></path>
                        </svg>
                    </div>

                    <h3 class="text-3xl font-bold text-slate-900 mb-4">Tidak Ada Produk Ditemukan</h3>
                    <p class="text-slate-600 mb-10 leading-relaxed text-lg font-light">
                        @if(request('search'))
                            Maaf, kami tidak dapat menemukan produk yang sesuai dengan kriteria Anda. Coba sesuaikan filter untuk hasil yang lebih luas.
                        @else
                            Saat ini belum ada produk yang tersedia. Tim kami sedang menambahkan koleksi baru untuk Anda.
                        @endif
                    </p>
                    
                    <div class="space-y-4">
                        <a href="{{ route('aset.barang') }}" 
                           class="inline-flex items-center bg-gradient-to-r from-blue-600 to-purple-600 text-white px-10 py-5 rounded-2xl font-bold hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-3xl">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset Pencarian
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Premium CTA Section - Cimahi Theme -->
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
        </div>
    </section>
</div>

<!-- Ultra Modern Styles -->
<style>
/* ================================================
   MODERN BLUR LOCKED CARDS STYLES
   ================================================ */

/* Enhanced Blur Effect - Professional Look */
.product-card.blur-item {
  position: relative;
  overflow: hidden;
}

.product-card.blur-item::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(
    135deg,
    rgba(255, 255, 255, 0.4) 0%,
    rgba(255, 255, 255, 0.2) 50%,
    rgba(255, 255, 255, 0.4) 100%
  );
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  z-index: 1;
  opacity: 0;
  animation: blurFadeIn 0.6s ease-out forwards;
  animation-delay: 0.2s;
}

/* Blur content inside card */
.product-card.blur-item > *:not(.absolute) {
  filter: blur(4px) grayscale(0.3);
  -webkit-filter: blur(4px) grayscale(0.3);
  transition: filter 0.3s ease;
}

/* Fade in animation for blur */
@keyframes blurFadeIn {
  from {
    opacity: 0;
    backdrop-filter: blur(0px);
    -webkit-backdrop-filter: blur(0px);
  }
  to {
    opacity: 1;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
  }
}

/* Lock overlay - glassmorphism effect */
.product-card .backdrop-blur-md {
  backdrop-filter: blur(16px) saturate(180%);
  -webkit-backdrop-filter: blur(16px) saturate(180%);
  background: rgba(255, 255, 255, 0.75);
  border: 1px solid rgba(255, 255, 255, 0.3);
  box-shadow: 
    0 8px 32px rgba(59, 130, 246, 0.1),
    inset 0 1px 0 rgba(255, 255, 255, 0.8);
}

/* Lock icon pulse effect */
.product-card .backdrop-blur-md .relative.inline-block {
  animation: lockPulse 2s ease-in-out infinite;
}

@keyframes lockPulse {
  0%, 100% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.05);
  }
}

/* Hover effect on locked cards */
.product-card.blur-item:hover::before {
  backdrop-filter: blur(6px);
  -webkit-backdrop-filter: blur(6px);
}

.product-card.blur-item:hover .backdrop-blur-md {
  backdrop-filter: blur(20px) saturate(200%);
  -webkit-backdrop-filter: blur(20px) saturate(200%);
  background: rgba(255, 255, 255, 0.85);
}

/* Smooth transition for login button */
.product-card .backdrop-blur-md a {
  position: relative;
  overflow: hidden;
}

.product-card .backdrop-blur-md a::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.3);
  transform: translate(-50%, -50%);
  transition: width 0.6s ease, height 0.6s ease;
}

.product-card .backdrop-blur-md a:hover::before {
  width: 300px;
  height: 300px;
}

/* Premium badge animation */
.product-card .backdrop-blur-md h4 {
  background: linear-gradient(135deg, #1e40af 0%, #7c3aed 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

/* ================================================
   EXISTING ANIMATIONS
   ================================================ */

/* Advanced Animations */
@keyframes blob {
  0%, 100% { transform: translate(0px, 0px) scale(1); }
  33% { transform: translate(50px, -80px) scale(1.2); }
  66% { transform: translate(-30px, 40px) scale(0.8); }
}

@keyframes float {
  0%, 100% { transform: translate(0, 0) rotate(0deg); }
  33% { transform: translate(20px, -30px) rotate(120deg); }
  66% { transform: translate(-15px, 15px) rotate(240deg); }
}

.animate-blob { animation: blob 10s ease-in-out infinite; }
.animate-float { animation: float 6s ease-in-out infinite; }
.animation-delay-1000 { animation-delay: 1s; }
.animation-delay-2000 { animation-delay: 2s; }
.animation-delay-3000 { animation-delay: 3s; }
.animation-delay-4000 { animation-delay: 4s; }

/* Grid Pattern Light */
.bg-grid-pattern-light {
    background-image: linear-gradient(rgba(14, 165, 233, 0.08) 1px, transparent 1px),
                      linear-gradient(90deg, rgba(14, 165, 233, 0.08) 1px, transparent 1px);
    background-size: 50px 50px;
}

/* Pulse Slow Animation */
@keyframes pulse-slow {
    0%, 100% { opacity: 0.2; }
    50% { opacity: 0.3; }
}

.animate-pulse-slow {
    animation: pulse-slow 8s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

/* Particle Stars Background */
.stars { position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; }
.stars::after {
  content: "";
  position: absolute;
  width: 2px;
  height: 2px;
  background: white;
  box-shadow: 100px 200px white, 300px 100px white, 500px 300px white, 700px 150px white, 900px 250px white, 200px 400px white, 400px 500px white, 600px 450px white, 800px 350px white, 150px 600px white, 350px 650px white, 550px 550px white;
  animation: sparkle 3s ease-in-out infinite;
  border-radius: 50%;
}

@keyframes sparkle {
  0%, 100% { opacity: 0.3; }
  50% { opacity: 1; }
}

/* Premium Product Card */
.product-card {
  backdrop-filter: blur(10px);
  background: rgba(255, 255, 255, 0.98);
  transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.product-card:hover {
  background: rgba(255, 255, 255, 1);
  box-shadow: 0 30px 60px -12px rgba(59, 130, 246, 0.3), 0 0 0 1px rgba(59, 130, 246, 0.1);
}

/* Professional Detail Button */
.detail-btn {
  background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
  border: 2px solid #e2e8f0;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
  position: relative;
  overflow: hidden;
}

.detail-btn::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
  opacity: 0;
  transition: opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  z-index: 0;
  border-radius: 1rem;
}

.detail-btn:hover::before {
  opacity: 1;
}

.detail-btn:hover {
  border-color: #3b82f6;
  box-shadow: 0 12px 32px rgba(59, 130, 246, 0.3), 0 0 0 1px rgba(59, 130, 246, 0.1);
  transform: translateY(-3px);
}

.detail-btn:active {
  transform: translateY(-1px);
  box-shadow: 0 6px 16px rgba(59, 130, 246, 0.2);
}

@keyframes bounce-slow {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

.animate-bounce-slow {
    animation: bounce-slow 2s ease-in-out infinite;
}

/* Enhanced Counter Animation */
.counter-value, .counter-number {
  display: inline-block;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  font-variant-numeric: tabular-nums;
}

/* Modern Pagination Styles */
.modern-pagination nav {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 0.5rem;
}

.modern-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0.5rem;
}

.modern-pagination nav {
    display: flex;
    gap: 0.5rem;
    background: rgba(255,255,255,0.6);
    padding: 6px 10px;
    border-radius: 9999px;
    box-shadow: 0 6px 18px rgba(15, 23, 42, 0.06);
    align-items: center;
}

.modern-pagination nav span,
.modern-pagination nav a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 44px;
    height: 44px;
    padding: 0 10px;
    border-radius: 9999px;
    font-weight: 700;
    font-size: 0.95rem;
    transition: transform 0.28s cubic-bezier(0.22,1,0.36,1), box-shadow 0.28s, background 0.28s, color 0.28s;
    text-decoration: none;
    color: #475569;
    background: rgba(255,255,255,0.9);
    border: 0;
}

.modern-pagination nav a:hover {
    transform: translateY(-3px) scale(1.03);
    box-shadow: 0 8px 20px rgba(59,130,246,0.12);
}

.modern-pagination nav a:hover {
  background: linear-gradient(135deg, #3b82f6, #2563eb);
  color: white;
  border-color: #3b82f6;
  transform: translateY(-2px) scale(1.05);
  box-shadow: 0 8px 16px rgba(59, 130, 246, 0.3);
}

.modern-pagination nav span[aria-current="page"] {
  background: linear-gradient(135deg, #3b82f6, #2563eb);
  color: white;
  border: 2px solid #3b82f6;
  box-shadow: 0 8px 16px rgba(59, 130, 246, 0.4);
}

/* Small tweaks for arrow and disabled states to look consistent */
.modern-pagination nav a[aria-disabled="true"],
.modern-pagination nav span[aria-disabled="true"] {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.modern-pagination nav .page-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
}

.modern-pagination nav span[aria-disabled="true"] {
  background: #f1f5f9;
  color: #cbd5e1;
  border: 2px solid #e2e8f0;
  cursor: not-allowed;
}

/* Line Clamp */
.line-clamp-1 { display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 1; overflow: hidden; }
.line-clamp-2 { display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 2; overflow: hidden; }

/* Smooth Scrolling */
html { scroll-behavior: smooth; }

/* Enhanced Focus States */
*:focus-visible {
  outline: 2px solid #3b82f6;
  outline-offset: 4px;
  border-radius: 0.5rem;
}

/* Smooth Transitions */
* { transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); }

/* ============================================
   HERO & STATS ANIMATIONS
   ============================================ */

/* Fade In Animations */
@keyframes fade-in-down {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fade-in {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.animate-fade-in-down {
    animation: fade-in-down 0.8s ease-out forwards;
}

.animate-fade-in-up {
    animation: fade-in-up 0.8s ease-out forwards;
    opacity: 0;
}

.animate-fade-in {
    animation: fade-in 0.8s ease-out forwards;
    opacity: 0;
}

/* Gradient Animation untuk Hero */
@keyframes gradient-hero {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.animate-gradient-hero {
    background-size: 200% 200%;
    animation: gradient-hero 3s ease infinite;
}

/* ============================================
   STATS VARIANT MEDIUM - BALANCED SIZE
   ============================================ */
.stats-variant-medium .stats-card .counter-number {
    font-size: 3rem !important;
    font-weight: 700 !important;
    line-height: 1 !important;
    display: inline-block;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.stats-variant-medium .stats-card .counter-number + span {
    font-size: 3rem !important;
    font-weight: 700 !important;
    line-height: 1 !important;
}

.stats-variant-medium .stats-card .text-lg {
    font-size: 0.9375rem !important;
    font-weight: 600 !important;
}

/* Stats Underline - MEDIUM SIZE */
.stats-variant-medium .h-1 {
    height: 2.5px !important;
    width: 80px !important;
    margin: 0 auto;
    border-radius: 9999px;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    transform-origin: center;
}

.stats-variant-medium .stats-card .h-1 {
    transform: scaleX(0);
}

.stats-variant-medium .stats-card:hover .h-1 {
    transform: scaleX(1) !important;
}

.stats-variant-medium .grid.gap-10 {
    gap: 2rem !important;
}

.stats-variant-medium .stats-card .mb-3 {
    margin-bottom: 0.75rem !important;
}

.stats-variant-medium .stats-card:hover .counter-number {
    transform: scale(1.05);
}

/* Desktop Large - Slightly Bigger */
@media (min-width: 1024px) {
    .stats-variant-medium .stats-card .counter-number {
        font-size: 3.5rem !important;
    }
    
    .stats-variant-medium .stats-card .counter-number + span {
        font-size: 3.5rem !important;
    }
    
    .stats-variant-medium .stats-card .text-lg {
        font-size: 1rem !important;
    }
    
    .stats-variant-medium .grid.gap-10 {
        gap: 2.5rem !important;
    }
    
    .stats-variant-medium .h-1 {
        height: 3px !important;
        width: 90px !important;
    }
}

/* Tablet */
@media (max-width: 1023px) and (min-width: 769px) {
    .stats-variant-medium .stats-card .counter-number {
        font-size: 2.75rem !important;
    }
    
    .stats-variant-medium .stats-card .counter-number + span {
        font-size: 2.75rem !important;
    }
    
    .stats-variant-medium .h-1 {
        height: 2.5px !important;
        width: 70px !important;
    }
    
    .stats-variant-medium .grid.gap-10 {
        gap: 1.75rem !important;
    }
}

/* ================================================
   SMOOTH CARD REVEAL ANIMATIONS - ENHANCED
   ================================================ */

.product-card {
    will-change: transform, opacity;
    backface-visibility: hidden;
    -webkit-font-smoothing: antialiased;
}

/* Initial hidden state */
.product-card.pre-reveal {
    opacity: 0;
    transform: translateY(20px) scale(0.95);
    transition: 
        opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1) var(--stagger, 0s),
        transform 0.6s cubic-bezier(0.16, 1, 0.3, 1) var(--stagger, 0s);
}

/* Revealed state - smooth entrance */
.product-card.in-view {
    opacity: 1 !important;
    transform: translateY(0) scale(1) !important;
}

/* Hover state - subtle lift */
.product-card:hover {
    transform: translateY(-8px) scale(1.02);
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

/* ================================================
   ULTRA MODERN PROFESSIONAL PAGINATION STYLES
   ================================================ */

/* Base Button Styles */
.pagination-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 44px;
    height: 44px;
    padding: 0 14px;
    font-size: 0.9375rem;
    font-weight: 700;
    color: #475569;
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border: 2px solid #e2e8f0;
    border-radius: 14px;
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    text-decoration: none;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    z-index: 1; /* ✅ TAMBAHAN: Ensure content is above pseudo-element */
}

/* Hover Effect with Gradient - FIXED Z-INDEX */
.pagination-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
    opacity: 0;
    transition: opacity 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    z-index: -1; /* ✅ PERBAIKAN: Changed from z-index: 0 to z-index: -1 */
    border-radius: 12px;
}

.pagination-btn:hover:not(.pagination-disabled):not(.pagination-active)::before {
    opacity: 1;
}

.pagination-btn:hover:not(.pagination-disabled):not(.pagination-active) {
    color: white;
    border-color: transparent;
    transform: translateY(-3px) scale(1.08);
    box-shadow: 0 12px 24px rgba(59, 130, 246, 0.35), 0 0 0 1px rgba(59, 130, 246, 0.1);
}


/* Active Page Style */
.pagination-active {
    background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
    color: white;
    border-color: transparent;
    box-shadow: 0 6px 16px rgba(59, 130, 246, 0.45), 0 0 0 3px rgba(59, 130, 246, 0.15);
    transform: scale(1.1);
}

.pagination-active::after {
    content: '';
    position: absolute;
    inset: -3px;
    border: 2px solid rgba(59, 130, 246, 0.3);
    border-radius: 16px;
    animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse-ring {
    0%, 100% {
        opacity: 1;
        transform: scale(1);
    }
    50% {
        opacity: 0.5;
        transform: scale(1.05);
    }
}

/* Arrow Buttons */
.pagination-arrow {
    min-width: 44px;
    padding: 0;
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
}

.pagination-arrow:hover:not(.pagination-disabled) {
    background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
}

.pagination-arrow svg {
    transition: transform 0.3s ease;
}

.pagination-arrow:hover:not(.pagination-disabled) svg {
    transform: translateX(-2px);
}

.pagination-arrow:last-of-type:hover:not(.pagination-disabled) svg {
    transform: translateX(2px);
}

/* First/Last Page Buttons */
.pagination-first,
.pagination-last {
    background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
    border-color: #bfdbfe;
    color: #3b82f6;
}

.pagination-first:hover,
.pagination-last:hover {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    border-color: transparent;
    color: white;
}

/* Disabled State */
.pagination-disabled {
    color: #cbd5e1;
    background: #f8fafc;
    cursor: not-allowed;
    border-color: #e2e8f0;
    opacity: 0.5;
}

.pagination-disabled:hover {
    transform: none;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

/* Dots Separator */
.pagination-dots {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 32px;
    height: 44px;
    color: #94a3b8;
}

.pagination-dots svg {
    animation: pulse-dots 2s ease-in-out infinite;
}

@keyframes pulse-dots {
    0%, 100% {
        opacity: 0.5;
    }
    50% {
        opacity: 1;
    }
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .pagination-btn {
        min-width: 40px;
        height: 40px;
        font-size: 0.875rem;
        padding: 0 12px;
    }
    
    .pagination-arrow,
    .pagination-first,
    .pagination-last {
        min-width: 40px;
    }
    
    .pagination-dots {
        min-width: 28px;
        height: 40px;
    }
    
    /* Hide first/last buttons on mobile */
    .pagination-first,
    .pagination-last {
        display: none;
    }
}

@media (max-width: 640px) {
    .pagination-btn {
        min-width: 36px;
        height: 36px;
        font-size: 0.8125rem;
        padding: 0 10px;
    }
    
    .pagination-dots {
        min-width: 24px;
        height: 36px;
    }
}

/* Smooth Scroll Indicator */
.pagination-scroll-indicator {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
    color: white;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 24px rgba(59, 130, 246, 0.4);
    cursor: pointer;
    opacity: 0;
    transform: scale(0.8);
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    z-index: 50;
}

.pagination-scroll-indicator.show {
    opacity: 1;
    transform: scale(1);
}

.pagination-scroll-indicator:hover {
    transform: scale(1.1) translateY(-4px);
    box-shadow: 0 12px 32px rgba(59, 130, 246, 0.5);
}

@media (max-width: 768px) {
    .pagination-scroll-indicator {
        bottom: 1rem;
        right: 1rem;
        width: 40px;
        height: 40px;
    }
}

/* ============================================
   MOBILE RESPONSIVE
   ============================================ */
@media (max-width: 768px) {
    /* Compact blur overlay on mobile */
    .product-card.blur-item::before {
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
    }
    
    .product-card.blur-item > *:not(.absolute) {
        filter: blur(3px) grayscale(0.2);
        -webkit-filter: blur(3px) grayscale(0.2);
    }
    
    .product-card .backdrop-blur-md {
        backdrop-filter: blur(12px) saturate(160%);
        -webkit-backdrop-filter: blur(12px) saturate(160%);
    }
    
    .product-card .backdrop-blur-md .relative.inline-block svg {
        width: 2rem;
        height: 2rem;
    }
    
    .product-card .backdrop-blur-md h4 {
        font-size: 0.875rem;
    }
    
    .product-card .backdrop-blur-md p {
        font-size: 0.75rem;
    }
    
    /* Mobile optimization - faster, simpler animations */
    .product-card.pre-reveal {
        transform: translateY(12px) scale(0.98);
        transition-duration: 0.4s;
    }
    
    .product-card:hover {
        transform: translateY(-4px) scale(1.01);
    }
    
    /* Reduce hero height drastically */
    section.min-h-screen {
        min-height: auto !important;
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
    }
    
    /* Compact hero padding */
    .relative.max-w-7xl.mx-auto.px-4.py-20,
    .relative.max-w-7xl.mx-auto.px-4.sm\:px-6.lg\:px-8.py-20 {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
    }
    
    /* Reduce badge size */
    .inline-flex.items-center.bg-white\/10.backdrop-blur-xl {
        padding: 0.5rem 1rem !important;
        margin-bottom: 1rem !important;
        font-size: 0.75rem !important;
    }
    
    /* Compact hero heading */
    h1.text-5xl,
    h1.sm\:text-6xl,
    h1.lg\:text-7xl {
        font-size: 2rem !important;
        line-height: 1.2 !important;
        margin-bottom: 1rem !important;
    }
    
    /* Compact subtitle */
    p.text-xl.sm\:text-2xl {
        font-size: 0.95rem !important;
        line-height: 1.4 !important;
        margin-bottom: 1rem !important;
        padding: 0 0.5rem !important;
    }
    
    /* Compact CTA buttons */
    .flex.flex-col.sm\:flex-row.gap-4 {
        gap: 0.75rem !important;
        padding-top: 1rem !important;
    }
    
    .flex.flex-col.sm\:flex-row.gap-4 a {
        padding: 0.75rem 1.5rem !important;
        font-size: 0.95rem !important;
    }
    
    .flex.flex-col.sm\:flex-row.gap-4 svg {
        width: 1rem !important;
        height: 1rem !important;
    }
    
    /* Stats section mobile */
    .stats-variant-medium {
        padding-top: 2rem !important;
    }
    
    .stats-variant-medium .grid.gap-10 {
        gap: 1.5rem !important;
    }
    
    .stats-variant-medium .stats-card .counter-number {
        font-size: 2rem !important;
    }
    
    .stats-variant-medium .stats-card .counter-number + span {
        font-size: 2rem !important;
    }
    
    .stats-variant-medium .stats-card .text-lg {
        font-size: 0.8rem !important;
    }
    
    .stats-variant-medium .h-1 {
        height: 2px !important;
        width: 60px !important;
    }
    
    .stats-variant-medium .stats-card .mb-3 {
        margin-bottom: 0.5rem !important;
    }
    
    /* Reduce all section paddings */
    .py-24 {
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
    }
    
    .py-20 {
        padding-top: 2.5rem !important;
        padding-bottom: 2.5rem !important;
    }
    
    /* Compact max-width containers */
    .max-w-7xl {
        padding-left: 1rem !important;
        padding-right: 1rem !important;
    }
    
    /* Reduce animated elements intensity on mobile */
    .animate-float-slow,
    .animate-float-slower,
    .animate-pulse-slow {
        animation-duration: 15s !important;
    }
    
    /* Reduce blur effects for better performance */
    .blur-3xl {
        filter: blur(40px) !important;
        opacity: 0.15 !important;
    }
    
    .backdrop-blur-xl {
        backdrop-filter: blur(8px) !important;
    }
    
    /* Simplify shadows on mobile */
    .shadow-2xl {
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2) !important;
    }
    
    /* Stars reduction on mobile */
    .stars::after {
        box-shadow: 50px 100px white, 150px 50px white, 250px 150px white, 350px 75px white, 450px 125px white;
    }
    
    .product-card { 
        margin-bottom: 1rem; 
    }
    
    /* Pagination mobile */
    .pagination-btn {
        min-width: 36px;
        height: 36px;
        font-size: 0.8125rem;
    }
    
    .pagination-dots {
        min-width: 30px;
    }
}

@media (max-width: 640px) {
    .stats-variant-medium .stats-card .counter-number {
        font-size: 1.75rem !important;
    }
    
    .stats-variant-medium .stats-card .counter-number + span {
        font-size: 1.75rem !important;
    }
    
    .stats-variant-medium .stats-card .text-lg {
        font-size: 0.75rem !important;
    }
    
    .stats-variant-medium .h-1 {
        width: 50px !important;
    }
}
</style>

@push('scripts')
<!-- AOS Animation Library -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS with optimized settings
    AOS.init({
        duration: 800,
        once: true,
        offset: 50,
        easing: 'ease-out-cubic',
        mirror: false,
        anchorPlacement: 'top-bottom'
    });

    // ================================================
    // ENHANCED COUNTER ANIMATION
    // ================================================
    class ModernCounter {
        constructor(element) {
            this.element = element;
            this.target = parseInt(element.getAttribute('data-value') || element.getAttribute('data-target'));
            this.hasAnimated = false;
        }

        animate() {
            if (this.hasAnimated) return;
            this.hasAnimated = true;

            const duration = 2000;
            const startTime = Date.now();
            
            const updateCount = () => {
                const elapsed = Date.now() - startTime;
                const progress = Math.min(elapsed / duration, 1);
                
                // Smooth easing function
                const easeOutQuart = 1 - Math.pow(1 - progress, 4);
                const current = Math.floor(easeOutQuart * this.target);
                
                this.element.textContent = current;
                
                if (progress < 1) {
                    requestAnimationFrame(updateCount);
                } else {
                    this.element.textContent = this.target;
                }
            };
            
            requestAnimationFrame(updateCount);
        }
    }

    // Initialize counters
    const counters = Array.from(document.querySelectorAll('.counter-value, .counter-number')).map(el => new ModernCounter(el));

    // Intersection Observer for counter trigger
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = counters.find(c => entry.target.contains(c.element));
                if (counter) {
                    setTimeout(() => counter.animate(), 300);
                }
            }
        });
    }, { threshold: 0.3 });

    document.querySelectorAll('.counter-value, .counter-number').forEach(el => {
        counterObserver.observe(el.closest('div'));
    });

    // ================================================
    // SMOOTH CARD REVEAL WITH PERFORMANCE OPTIMIZATION
    // ================================================
    const observerOptions = { 
        threshold: 0.1, 
        rootMargin: '0px 0px -50px 0px' 
    };

    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Use requestAnimationFrame for smooth animation
                requestAnimationFrame(() => {
                    entry.target.classList.add('in-view');
                });
                // Unobserve after animation to improve performance
                scrollObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Initialize product cards with stagger effect
    document.querySelectorAll('.product-card').forEach((card, index) => {
        card.classList.add('pre-reveal');
        card.classList.remove('in-view');
        
        // Stagger delay: max 0.4s for better UX
        const stagger = Math.min(index * 0.05, 0.4);
        card.style.setProperty('--stagger', `${stagger}s`);
        
        scrollObserver.observe(card);
    });

    // ================================================
    // SMOOTH FORM SUBMISSION WITH LOADING & AUTO SCROLL
    // ================================================
    const searchForm = document.querySelector('form[action*="barang"]');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            // Add #itemsContainer to form action for auto scroll
            const currentAction = this.action;
            if (!currentAction.includes('#itemsContainer')) {
                this.action = currentAction + '#itemsContainer';
            }
            
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                // Disable button to prevent double submission
                submitBtn.disabled = true;
                
                // Show loading state with "Mencari..." text
                submitBtn.innerHTML = `
                    <svg class="animate-spin h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Mencari...
                `;
            }
        });
    }

    // ================================================
    // ADVANCED PAGINATION WITH SMOOTH SCROLL & LOADING STATE
    // ================================================
    
    // Smooth scroll to items container on pagination click
    function scrollToItems(offset = -100) {
        const itemsContainer = document.getElementById('itemsContainer');
        if (itemsContainer) {
            const targetPosition = itemsContainer.getBoundingClientRect().top + window.pageYOffset + offset;
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    }

    // Add simple transition for pagination buttons (NO OVERLAY)
    document.querySelectorAll('.pagination-btn[data-page]').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (!this.classList.contains('pagination-disabled') && !this.classList.contains('pagination-active')) {
                // Simple fade effect
                this.style.opacity = '0.6';
            }
        });
    });

    // Auto-scroll when page loads with hash
    window.addEventListener('load', function() {
        if (window.location.hash === '#itemsContainer') {
            setTimeout(() => scrollToItems(), 300);
        }
    });

    // Jump to page function
    window.jumpToPage = function() {
        const input = document.getElementById('pageJump');
        const pageNumber = parseInt(input.value);
        const maxPage = parseInt(input.max);
        
        if (pageNumber >= 1 && pageNumber <= maxPage) {
            // Get current URL and update page parameter
            const url = new URL(window.location.href);
            url.searchParams.set('page', pageNumber);
            url.hash = 'itemsContainer';
            
            // Show loading state
            input.disabled = true;
            input.classList.add('opacity-50');
            
            // Navigate
            window.location.href = url.toString();
        } else {
            // Invalid page number - shake animation
            input.classList.add('animate-shake');
            setTimeout(() => input.classList.remove('animate-shake'), 500);
        }
    };

    // ================================================
    // SCROLL TO TOP BUTTON (SHOW ON SCROLL DOWN)
    // ================================================
    const scrollTopBtn = document.createElement('button');
    scrollTopBtn.className = 'pagination-scroll-indicator';
    scrollTopBtn.innerHTML = `
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    `;
    scrollTopBtn.title = 'Kembali ke atas';
    scrollTopBtn.addEventListener('click', () => scrollToItems());
    document.body.appendChild(scrollTopBtn);

    // Show/hide scroll button based on scroll position
    let scrollTimeout;
    window.addEventListener('scroll', debounce(function() {
        const itemsContainer = document.getElementById('itemsContainer');
        if (itemsContainer) {
            const rect = itemsContainer.getBoundingClientRect();
            // Show button when scrolled past items container
            if (rect.top < -200) {
                scrollTopBtn.classList.add('show');
            } else {
                scrollTopBtn.classList.remove('show');
            }
        }
    }, 100));

    // ================================================
    // KEYBOARD NAVIGATION FOR PAGINATION
    // ================================================
    document.addEventListener('keydown', function(e) {
        // Only if not in an input field
        if (document.activeElement.tagName !== 'INPUT' && 
            document.activeElement.tagName !== 'TEXTAREA') {
            
            const prevBtn = document.querySelector('.pagination-arrow[title="Halaman Sebelumnya"]');
            const nextBtn = document.querySelector('.pagination-arrow[title="Halaman Berikutnya"]');
            
            // Left arrow - previous page
            if (e.key === 'ArrowLeft' && prevBtn && !prevBtn.classList.contains('pagination-disabled')) {
                prevBtn.click();
            }
            
            // Right arrow - next page
            if (e.key === 'ArrowRight' && nextBtn && !nextBtn.classList.contains('pagination-disabled')) {
                nextBtn.click();
            }
        }
    });

    // ================================================
    // PERFORMANCE: LAZY LOAD IMAGES
    // ================================================
    if ('loading' in HTMLImageElement.prototype) {
        // Browser supports native lazy loading
        const images = document.querySelectorAll('img[loading="lazy"]');
        images.forEach(img => {
            if (img.dataset.src) {
                img.src = img.dataset.src;
            }
        });
    } else {
        // Fallback for browsers that don't support lazy loading
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    observer.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // ================================================
    // DEBOUNCE UTILITY FOR PERFORMANCE
    // ================================================
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // ================================================
    // SMOOTH SCROLL FOR ALL ANCHOR LINKS
    // ================================================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== '#' && href.length > 1) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });

    // ================================================
    // CONSOLE LOG FOR DEBUG (Remove in production)
    // ================================================
    console.log('✅ Modern catalog initialized');
    console.log(`📦 ${document.querySelectorAll('.product-card').length} products loaded`);
    console.log(`🎯 ${counters.length} counters initialized`);
});
</script>
@endpush
@endsection

<!-- Small inline style to control the reveal class added by JS -->
<style>
/* Reveal state applied by JS */
.product-card.in-view {
    opacity: 1 !important;
    transform: translateY(0) !important;
}
</style>