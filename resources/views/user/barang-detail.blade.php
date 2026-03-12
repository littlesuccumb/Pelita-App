@extends('layouts.user')

@section('title', $barang->nama_barang . ' - Detail Barang')

@section('content')
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="min-h-screen bg-gradient-to-b from-gray-50 via-white to-gray-100 relative overflow-x-hidden">
    {{-- Animated Grid Background --}}
    <div class="absolute inset-0 bg-grid-pattern opacity-30 pointer-events-none"></div>
    
    {{-- Large Gradient Orbs - Cimahi Technopark Colors --}}
    <div class="absolute top-0 left-0 w-[360px] h-[360px] bg-[#0EA5E9] rounded-full mix-blend-multiply filter blur-3xl opacity-14 animate-pulse-slow pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[360px] h-[360px] bg-[#8B5CF6] rounded-full mix-blend-multiply filter blur-3xl opacity-14 animate-pulse-slow pointer-events-none" style="animation-delay: 3s"></div>
    <div class="absolute top-1/2 left-1/2 w-[300px] h-[300px] bg-[#14B8A6] rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-pulse-slow pointer-events-none" style="animation-delay: 6s"></div>
    <div class="absolute top-1/3 right-1/4 w-[240px] h-[240px] bg-[#F97316] rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-pulse-slow pointer-events-none" style="animation-delay: 9s"></div>
    
    <!-- Breadcrumb -->
    <div class="bg-white/80 backdrop-blur-xl border-b border-gray-200 relative z-10 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
            <nav class="flex items-center space-x-2 text-sm text-gray-600">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors font-medium">
                    <i class="fa-solid fa-home mr-1"></i>Beranda
                </a>
                <i class="fa-solid fa-chevron-right text-gray-400"></i>
                <a href="{{ route('user.barang') }}" class="hover:text-blue-600 transition-colors font-medium">
                    Barang
                </a>
                <i class="fa-solid fa-chevron-right text-gray-400"></i>
                <span class="text-gray-900 font-semibold truncate">{{ $barang->nama_barang }}</span>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 relative z-10">
        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 mb-8">
            <!-- Image Gallery Section -->
            <div class="lg:col-span-2">
                <div class="lg:sticky lg:top-24 space-y-4">
                    <!-- Main Image -->
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-200 backdrop-blur-xl">
                        @php
                            // Prioritas: foto primary > foto pertama > placeholder
                            $mainFoto = $barang->fotoPrimary ?? $barang->fotos->first();
                        @endphp
                        
                        @if($mainFoto)
                            <img id="mainImage" 
                                 src="{{ $mainFoto->foto_url }}" 
                                 alt="{{ $barang->nama_barang }}" 
                                 class="w-full h-72 md:h-80 object-cover cursor-pointer hover:opacity-90 transition-opacity"
                                 onclick="openLightbox(0)">
                        @else
                            <div class="w-full h-98 bg-gradient-to-br from-blue-50 via-purple-50 to-cyan-50 flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fa-solid fa-box text-blue-300 text-6xl mb-4"></i>
                                    <p class="text-gray-500 text-lg">Foto tidak tersedia</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Thumbnail Gallery -->
                    @if($barang->fotos->count() > 1)
                    <div class="bg-white rounded-2xl shadow-lg p-3 border border-gray-200 backdrop-blur-xl">
                        <div class="grid grid-cols-4 gap-1">
                            @foreach($barang->fotos as $index => $foto)
                                <div class="relative aspect-square rounded-lg overflow-hidden border cursor-pointer hover:border-[#0EA5E9] transition-all group thumbnail-item {{ $loop->first ? 'border-[#0EA5E9]' : 'border-gray-200' }}"
                                     data-index="{{ $index }}"
                                     onclick="changeMainImage('{{ $foto->foto_url }}', {{ $index }})">
                                    <img src="{{ $foto->foto_url }}" 
                                         alt="{{ $foto->keterangan ?? $barang->nama_barang }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    @if($foto->is_primary)
                                        <div class="absolute top-1 right-1 bg-[#0EA5E9] text-white text-xs px-2 py-0.5 rounded-full font-bold shadow-lg">
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-2">
                            <button onclick="openLightbox(0)" class="text-sm text-[#0EA5E9] hover:text-[#0284C7] font-semibold flex items-center justify-center gap-2 w-full transition-colors">
                                <i class="fa-solid fa-expand"></i>
                                Lihat Semua Foto ({{ $barang->fotos->count() }})
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Product Info Sidebar - 2 columns -->
            <div class="lg:col-span-3">
                <div class="space-y-5">
                    <!-- Product Info Card -->
                    <div class="bg-white/70 backdrop-blur-2xl rounded-3xl shadow-2xl p-6 border border-white/60 relative overflow-hidden">
                        <!-- Decorative Elements -->
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/10 to-cyan-500/10 rounded-full -translate-y-16 translate-x-16"></div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-violet-500/10 to-pink-500/10 rounded-full translate-y-12 -translate-x-12"></div>
                        
                        <div class="relative z-10">
                            <!-- Product Name -->
                            <h1 class="text-2xl lg:text-3xl font-black mb-3 bg-gradient-to-r from-slate-900 via-blue-900 to-cyan-900 bg-clip-text text-transparent leading-tight">
                                {{ $barang->nama_barang }}
                            </h1>

                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 mb-6">
                                @if($barang->kategori)
                                    <span class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-3 py-1.5 rounded-xl text-xs font-bold shadow-lg shadow-blue-500/30">
                                        <i class="fa-solid fa-tag"></i>
                                        {{ $barang->kategori->nama_kategori }}
                                    </span>
                                @endif
                                @if($barang->garansi)
                                    <span class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-3 py-1.5 rounded-xl text-xs font-bold shadow-lg shadow-emerald-500/30">
                                        <i class="fa-solid fa-certificate"></i>
                                        {{ $barang->garansi }}
                                    </span>
                                @endif
                                @php
                                    $statusConfig = [
                                        'tersedia' => ['bg' => 'from-emerald-500 to-teal-500', 'text' => 'Tersedia', 'icon' => 'fa-check-circle', 'shadow' => 'shadow-emerald-500/30'],
                                        'dipinjam' => ['bg' => 'from-amber-500 to-orange-500', 'text' => 'Dipinjam', 'icon' => 'fa-clock', 'shadow' => 'shadow-amber-500/30'],
                                        'maintenance' => ['bg' => 'from-red-500 to-rose-500', 'text' => 'Maintenance', 'icon' => 'fa-wrench', 'shadow' => 'shadow-red-500/30']
                                    ];
                                    $config = $statusConfig[$barang->status] ?? ['bg' => 'from-gray-500 to-gray-600', 'text' => ucfirst($barang->status), 'icon' => 'fa-circle-info', 'shadow' => 'shadow-gray-500/30'];
                                @endphp
                                <span class="inline-flex items-center gap-2 bg-gradient-to-r {{ $config['bg'] }} text-white px-4 py-2 rounded-xl text-sm font-bold shadow-lg {{ $config['shadow'] }}">
                                    <i class="fa-solid {{ $config['icon'] }}"></i>
                                    {{ $config['text'] }}
                                </span>
                            </div>

                            <!-- Price Section dengan Animasi -->
                            <div class="mb-6 p-4 bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl border-2 border-emerald-200">
                                @if($barang->harga_sewa > 0)
                                    <div class="flex items-baseline justify-center gap-2">
                                        <span class="text-3xl md:text-4xl font-black bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                                            Rp{{ number_format($barang->harga_sewa, 0, ',', '.') }}
                                        </span>
                                        <span class="text-sm md:text-lg font-bold text-emerald-700">/hari</span>
                                    </div>
                                    <p class="text-center text-xs md:text-sm text-emerald-600 font-medium mt-2">
                                        <i class="fa-solid fa-info-circle mr-1"></i>Harga sewa harian
                                    </p>
                                @else
                                    <div class="text-center">
                                        <div class="text-5xl font-black text-emerald-600 mb-2">
                                            <i class="fa-solid fa-gift mr-2"></i>GRATIS
                                        </div>
                                        <p class="text-emerald-600 font-semibold">Tidak ada biaya sewa</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Stock Availability dengan Progress Bar -->
                            <div class="mb-6 p-4 bg-gradient-to-br from-slate-50 to-blue-50 rounded-2xl border border-slate-200">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-sm font-bold text-slate-700 flex items-center gap-2">
                                        <i class="fa-solid fa-boxes-stacked text-blue-600"></i>
                                        Ketersediaan Stok
                                    </span>
                                    @if($barang->jumlah_tersedia > 0)
                                        <span class="flex items-center gap-2 text-emerald-600 font-bold">
                                            <span class="relative flex h-3 w-3">
                                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                                <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                                            </span>
                                            {{ $barang->jumlah_tersedia }} Unit
                                        </span>
                                    @else
                                        <span class="flex items-center gap-2 text-red-600 font-bold">
                                            <span class="h-3 w-3 bg-red-500 rounded-full"></span>
                                            Habis
                                        </span>
                                    @endif
                                </div>
                                <!-- Progress Bar -->
                                <div class="w-full bg-slate-200 rounded-full h-3 overflow-hidden">
                                    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-3 rounded-full transition-all duration-1000 shadow-lg"
                                         style="width: {{ $barang->jumlah_total > 0 ? ($barang->jumlah_tersedia / $barang->jumlah_total * 100) : 0 }}%">
                                    </div>
                                </div>
                                <p class="text-xs text-slate-600 mt-2 text-center font-medium">
                                    {{ $barang->jumlah_tersedia }} dari {{ $barang->jumlah_total }} unit tersedia
                                </p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-3">
                                @if($barang->status === 'tersedia' && $barang->dapat_dipinjam && $barang->jumlah_tersedia > 0)
                                    <a href="{{ route('permohonan.create', ['barang_id' => $barang->id]) }}" class="block group">
                                        <button class="w-full bg-gradient-to-r from-blue-600 via-blue-500 to-cyan-500 hover:from-blue-700 hover:via-blue-600 hover:to-cyan-600 text-white py-3 px-4 rounded-2xl font-bold shadow-md hover:shadow-lg transition-all duration-300 flex items-center justify-center gap-2 transform relative overflow-hidden">
                                            <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 transform -skew-x-12 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                                            <i class="fa-solid fa-paper-plane text-lg relative z-10"></i>
                                            <span class="text-base relative z-10">Ajukan Peminjaman</span>
                                            <i class="fa-solid fa-arrow-right relative z-10 group-hover:translate-x-1 transition-transform"></i>
                                        </button>
                                    </a>
                                @else
                                    <button disabled class="w-full bg-slate-200 text-slate-500 py-3 px-4 rounded-2xl font-bold text-center cursor-not-allowed border-2 border-slate-300 relative overflow-hidden">
                                        <i class="fa-solid fa-lock mr-2"></i>
                                        @if(!$barang->dapat_dipinjam)
                                            Barang Tidak Dapat Dipinjam
                                        @elseif($barang->jumlah_tersedia == 0)
                                            Stok Tidak Tersedia
                                        @else
                                            Tidak Tersedia ({{ ucfirst($barang->status) }})
                                        @endif
                                    </button>
                                @endif

                                <!-- Secondary Actions -->
                                <div class="grid grid-cols-2 gap-2">
                                    <button onclick="addToCart({{ $barang->id }})" 
                                            class="group bg-white hover:bg-blue-50 text-slate-700 hover:text-blue-600 py-3 px-3 rounded-xl font-bold border-2 border-slate-200 hover:border-blue-400 transition-all duration-300 flex items-center justify-center gap-2 hover:shadow hover:-translate-y-0.5 transform">
                                        <i class="fa-solid fa-shopping-cart group-hover:scale-110 transition-transform"></i>
                                        <span class="hidden sm:inline">Keranjang</span>
                                    </button>
                                    
                                    <button onclick="shareItem('{{ $barang->nama_barang }}', '{{ url()->current() }}')" 
                                            class="group bg-white hover:bg-violet-50 text-slate-700 hover:text-violet-600 py-3 px-3 rounded-xl font-bold border-2 border-slate-200 hover:border-violet-400 transition-all duration-300 flex items-center justify-center gap-2 hover:shadow hover:-translate-y-0.5 transform">
                                        <i class="fa-solid fa-share-nodes group-hover:scale-110 transition-transform"></i>
                                        <span class="hidden sm:inline">Bagikan</span>
                                    </button>
                                </div>

                                <a href="{{ route('user.barang') }}" 
                                   class="block w-full border-2 border-slate-300 hover:border-slate-400 text-slate-700 hover:text-slate-900 py-4 px-6 rounded-xl font-bold hover:bg-slate-50 transition-all duration-300 text-center flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-arrow-left"></i>
                                    <span>Kembali ke Katalog</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Info Card -->
                    <div class="bg-gradient-to-br from-violet-50 to-purple-50 backdrop-blur-xl rounded-2xl shadow-lg p-6 border border-violet-200">
                        <h4 class="font-black text-slate-900 mb-5 flex items-center text-lg">
                            <div class="w-8 h-8 bg-gradient-to-br from-violet-600 to-purple-600 rounded-lg flex items-center justify-center mr-2">
                                <i class="fa-solid fa-shield-halved text-white text-sm"></i>
                            </div>
                            Ketentuan Peminjaman
                        </h4>
                        <ul class="space-y-4 text-sm">
                            <li class="flex items-start gap-3 group">
                                <div class="w-6 h-6 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:scale-110 transition-transform shadow-lg">
                                    <i class="fa-solid fa-calendar-days text-white text-xs"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-slate-900 font-bold mb-1">Durasi Peminjaman</p>
                                    <p class="text-slate-700 leading-relaxed">Maksimal 1 hingga 3 hari kerja sesuai kebutuhan dan persetujuan admin</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3 group">
                                <div class="w-6 h-6 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:scale-110 transition-transform shadow-lg">
                                    <i class="fa-solid fa-clipboard-check text-white text-xs"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-slate-900 font-bold mb-1">Kondisi Barang</p>
                                    <p class="text-slate-700 leading-relaxed">Barang harus dikembalikan dalam kondisi yang sama seperti saat diterima, bersih dan berfungsi dengan baik</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3 group">
                                <div class="w-6 h-6 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:scale-110 transition-transform shadow-lg">
                                    <i class="fa-solid fa-user-check text-white text-xs"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-slate-900 font-bold mb-1">Persetujuan Admin</p>
                                    <p class="text-slate-700 leading-relaxed">Setiap permohonan peminjaman harus mendapat persetujuan dari admin terlebih dahulu</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3 group">
                                <div class="w-6 h-6 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:scale-110 transition-transform shadow-lg">
                                    <i class="fa-solid fa-clock text-white text-xs"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-slate-900 font-bold mb-1">Pengembalian Tepat Waktu</p>
                                    <p class="text-slate-700 leading-relaxed">Barang harus dikembalikan sesuai jadwal yang telah ditentukan untuk menghindari sanksi keterlambatan</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3 group">
                                <div class="w-6 h-6 bg-gradient-to-br from-amber-500 to-orange-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:scale-110 transition-transform shadow-lg">
                                    <i class="fa-solid fa-exclamation-triangle text-white text-xs"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-slate-900 font-bold mb-1">Tanggung Jawab Peminjam</p>
                                    <p class="text-slate-700 leading-relaxed">Peminjam bertanggung jawab penuh atas kerusakan atau kehilangan barang selama masa peminjaman</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Info Stats -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-8">
            <div class="group bg-white/70 backdrop-blur-xl p-4 rounded-2xl border border-white/60 shadow hover:shadow-md transition-all duration-200 hover:-translate-y-0.5 cursor-pointer">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center shadow group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-barcode text-white text-lg"></i>
                    </div>
                </div>
                <p class="text-xl font-black text-slate-900 mb-1">{{ $barang->kode_barang ?: '-' }}</p>
                <p class="text-xs text-slate-600 font-bold uppercase tracking-wide">Kode Barang</p>
            </div>

            <div class="group bg-white/70 backdrop-blur-xl p-4 rounded-2xl border border-white/60 shadow hover:shadow-md transition-all duration-200 hover:-translate-y-0.5 cursor-pointer">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center shadow group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-boxes-stacked text-white text-lg"></i>
                    </div>
                </div>
                <p class="text-xl font-black text-slate-900 mb-1">
                    {{ $barang->jumlah_tersedia }}<span class="text-sm text-slate-500">/{{ $barang->jumlah_total }}</span>
                </p>
                <p class="text-xs text-slate-600 font-bold uppercase tracking-wide">Unit Tersedia</p>
            </div>

            <div class="group bg-white/70 backdrop-blur-xl p-4 rounded-2xl border border-white/60 shadow hover:shadow-md transition-all duration-200 hover:-translate-y-0.5 cursor-pointer">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-violet-500 to-purple-500 rounded-xl flex items-center justify-center shadow group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-shield text-white text-lg"></i>
                    </div>
                </div>
                <p class="text-xl font-black text-slate-900 mb-1">{{ ucfirst(str_replace('_', ' ', $barang->kondisi)) }}</p>
                <p class="text-xs text-slate-600 font-bold uppercase tracking-wide">Kondisi</p>
            </div>

            <div class="group bg-white/70 backdrop-blur-xl p-4 rounded-2xl border border-white/60 shadow hover:shadow-md transition-all duration-200 hover:-translate-y-0.5 cursor-pointer">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-amber-500 rounded-xl flex items-center justify-center shadow group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-location-dot text-white text-lg"></i>
                    </div>
                </div>
                <p class="text-xl font-black text-slate-900 mb-1">{{ $barang->lokasi ?: '-' }}</p>
                <p class="text-xs text-slate-600 font-bold uppercase tracking-wide">Lokasi</p>
            </div>
        </div>

        <!-- Product Details Tabs -->
        <div class="bg-white/70 backdrop-blur-2xl rounded-3xl shadow-2xl border border-white/60 overflow-hidden">
            <div class="border-b border-slate-200">
                <div class="flex overflow-x-auto scrollbar-hide">
                    <button onclick="switchTab('description')" id="tab-description" class="tab-button active px-8 py-5 font-bold text-sm transition-all duration-300 border-b-3 border-blue-600 text-blue-600 whitespace-nowrap">
                        <i class="fa-solid fa-align-left mr-2"></i>Deskripsi
                    </button>
                    @if($barang->spesifikasi)
                    <button onclick="switchTab('specs')" id="tab-specs" class="tab-button px-8 py-5 font-bold text-sm transition-all duration-300 border-b-3 border-transparent text-slate-600 hover:text-blue-600 whitespace-nowrap">
                        <i class="fa-solid fa-microchip mr-2"></i>Spesifikasi
                    </button>
                    @endif
                    <button onclick="switchTab('details')" id="tab-details" class="tab-button px-8 py-5 font-bold text-sm transition-all duration-300 border-b-3 border-transparent text-slate-600 hover:text-blue-600 whitespace-nowrap">
                        <i class="fa-solid fa-list mr-2"></i>Detail Lengkap
                    </button>
                    @if($barang->lainnya)
                    <button onclick="switchTab('other')" id="tab-other" class="tab-button px-8 py-5 font-bold text-sm transition-all duration-300 border-b-3 border-transparent text-slate-600 hover:text-blue-600 whitespace-nowrap">
                        <i class="fa-solid fa-circle-info mr-2"></i>Info Tambahan
                    </button>
                    @endif
                </div>
            </div>

            <div class="p-8">
                <!-- Description Tab -->
                <div id="content-description" class="tab-content">
                    @if($barang->deskripsi)
                        <p class="text-slate-700 leading-relaxed text-lg">{{ $barang->deskripsi }}</p>
                    @else
                        <p class="text-slate-500 italic">Tidak ada deskripsi</p>
                    @endif
                </div>

                <!-- Specifications Tab -->
                @if($barang->spesifikasi)
                <div id="content-specs" class="tab-content hidden">
                    <pre class="text-slate-700 leading-relaxed text-lg font-sans whitespace-pre-wrap">{{ $barang->spesifikasi }}</pre>
                </div>
                @endif

                <!-- Details Tab -->
                <div id="content-details" class="tab-content hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 hover:border-blue-300 transition-all">
                            <p class="text-xs text-slate-600 font-bold uppercase tracking-wide mb-2">Kode Barang</p>
                            <p class="text-lg font-black text-slate-900">{{ $barang->kode_barang ?: '-' }}</p>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 hover:border-blue-300 transition-all">
                            <p class="text-xs text-slate-600 font-bold uppercase tracking-wide mb-2">Kategori</p>
                            <p class="text-lg font-black text-slate-900">{{ $barang->kategori->nama_kategori ?? '-' }}</p>
                        </div>
                        @if($barang->merk)
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 hover:border-blue-300 transition-all">
                            <p class="text-xs text-slate-600 font-bold uppercase tracking-wide mb-2">Merk</p>
                            <p class="text-lg font-black text-slate-900">{{ $barang->merk }}</p>
                        </div>
                        @endif
                        @if($barang->type)
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 hover:border-blue-300 transition-all">
                            <p class="text-xs text-slate-600 font-bold uppercase tracking-wide mb-2">Type</p>
                            <p class="text-lg font-black text-slate-900">{{ $barang->type }}</p>
                        </div>
                        @endif
                        @if($barang->seri)
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 hover:border-blue-300 transition-all">
                            <p class="text-xs text-slate-600 font-bold uppercase tracking-wide mb-2">Seri</p>
                            <p class="text-lg font-black text-slate-900">{{ $barang->seri }}</p>
                        </div>
                        @endif
                        @if($barang->tahun_produksi)
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 hover:border-blue-300 transition-all">
                            <p class="text-xs text-slate-600 font-bold uppercase tracking-wide mb-2">Tahun Produksi</p>
                            <p class="text-lg font-black text-slate-900">{{ $barang->tahun_produksi }}</p>
                        </div>
                        @endif
                        @if($barang->warna)
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 hover:border-blue-300 transition-all">
                            <p class="text-xs text-slate-600 font-bold uppercase tracking-wide mb-2">Warna</p>
                            <p class="text-lg font-black text-slate-900">{{ $barang->warna }}</p>
                        </div>
                        @endif
                        @if($barang->dimensi)
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 hover:border-blue-300 transition-all">
                            <p class="text-xs text-slate-600 font-bold uppercase tracking-wide mb-2">Dimensi (P×L×T)</p>
                            <p class="text-lg font-black text-slate-900">{{ $barang->dimensi }} cm</p>
                        </div>
                        @endif
                        @if($barang->berat)
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 hover:border-blue-300 transition-all">
                            <p class="text-xs text-slate-600 font-bold uppercase tracking-wide mb-2">Berat</p>
                            <p class="text-lg font-black text-slate-900">{{ $barang->berat }} kg</p>
                        </div>
                        @endif
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 hover:border-blue-300 transition-all">
                            <p class="text-xs text-slate-600 font-bold uppercase tracking-wide mb-2">Total Unit</p>
                            <p class="text-lg font-black text-slate-900">{{ $barang->jumlah_total }}</p>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 hover:border-blue-300 transition-all">
                            <p class="text-xs text-slate-600 font-bold uppercase tracking-wide mb-2">Unit Tersedia</p>
                            <p class="text-lg font-black text-emerald-600">{{ $barang->jumlah_tersedia }}</p>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 hover:border-blue-300 transition-all">
                            <p class="text-xs text-slate-600 font-bold uppercase tracking-wide mb-2">Kondisi</p>
                            <p class="text-lg font-black text-slate-900">{{ ucfirst(str_replace('_', ' ', $barang->kondisi)) }}</p>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 hover:border-blue-300 transition-all">
                            <p class="text-xs text-slate-600 font-bold uppercase tracking-wide mb-2">Lokasi</p>
                            <p class="text-lg font-black text-slate-900">{{ $barang->lokasi ?: '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Other Info Tab -->
                @if($barang->lainnya)
                <div id="content-other" class="tab-content hidden">
                    <p class="text-slate-700 leading-relaxed text-lg">{{ $barang->lainnya }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Related Items -->
        @if($relatedBarang->count() > 0)
        <div class="mt-16">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-black text-slate-900 flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-cyan-500 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                        <i class="fa-solid fa-layer-group text-white"></i>
                    </div>
                    Barang Serupa
                </h2>
                <a href="{{ route('user.barang') }}" class="text-blue-600 hover:text-blue-700 font-bold flex items-center gap-2 group">
                    <span>Lihat Semua</span>
                    <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedBarang as $item)
                <a href="{{ route('user.barang.detail', $item->id) }}" class="group">
                    <div class="bg-white/70 backdrop-blur-xl rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-white/60">
                        <div class="relative aspect-square overflow-hidden bg-slate-100">
                            @if($item->fotoPrimary)
                                <img src="{{ $item->fotoPrimary->foto_url }}" alt="{{ $item->nama_barang }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-50 to-slate-50 flex items-center justify-center">
                                    <i class="fa-solid fa-box text-blue-300 text-4xl"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <span class="absolute top-3 right-3 inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-emerald-500 to-teal-500 text-white text-xs font-bold rounded-full shadow-lg">
                                <i class="fa-solid fa-check-circle mr-1"></i>
                                Tersedia
                            </span>
                        </div>
                        <div class="p-5">
                            <h3 class="font-bold text-slate-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors">{{ $item->nama_barang }}</h3>
                            <div class="flex items-center justify-between">
                                <div class="font-bold text-blue-600">
                                    @if($item->harga_sewa > 0)
                                        <div>
                                            <span class="text-lg">Rp{{ number_format($item->harga_sewa, 0, ',', '.') }}</span>
                                            <span class="text-xs text-slate-500 font-normal block">/hari</span>
                                        </div>
                                    @else
                                        <span class="text-lg">Gratis</span>
                                    @endif
                                </div>
                                <span class="text-xs bg-slate-100 text-slate-700 px-3 py-2 rounded-lg font-bold border-2 border-slate-200">
                                    {{ $item->jumlah_tersedia }}/{{ $item->jumlah_total }}
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Lightbox Modal - Mobile Optimized -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-95 z-50 hidden items-center justify-center p-2 sm:p-4">
    <!-- Close Button -->
    <button onclick="closeLightbox()" 
            class="absolute top-2 right-2 sm:top-6 sm:right-6 w-10 h-10 sm:w-12 sm:h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white hover:text-white transition-all z-20 group backdrop-blur-sm">
        <i class="fa-solid fa-times text-xl sm:text-2xl group-hover:rotate-90 transition-transform duration-300"></i>
    </button>
    
    @if($barang->fotos->count() > 1)
    <!-- Previous Button - Mobile Optimized -->
    <button onclick="previousImage()" 
            class="absolute left-2 sm:left-6 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white hover:text-white transition-all z-20 group backdrop-blur-sm">
        <i class="fa-solid fa-chevron-left text-lg sm:text-2xl group-hover:-translate-x-1 transition-transform"></i>
    </button>
    
    <!-- Next Button - Mobile Optimized -->
    <button onclick="nextImage()" 
            class="absolute right-2 sm:right-6 top-1/2 -translate-y-1/2 w-10 h-10 sm:w-12 sm:h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white hover:text-white transition-all z-20 group backdrop-blur-sm">
        <i class="fa-solid fa-chevron-right text-lg sm:text-2xl group-hover:translate-x-1 transition-transform"></i>
    </button>
    @endif

    <!-- Image Container - Mobile Optimized -->
    <div class="w-full max-w-6xl mx-auto px-12 sm:px-16 flex flex-col items-center justify-center h-full">
        <div class="relative w-full">
            <img id="lightboxImage" 
                 src="" 
                 alt="" 
                 class="w-full h-auto max-h-[70vh] sm:max-h-[80vh] object-contain rounded-lg sm:rounded-2xl shadow-2xl">
        </div>
        
        <!-- Caption & Counter - Mobile Optimized -->
        <div class="text-center mt-4 sm:mt-6 space-y-2">
            <div id="lightboxCaption" class="text-white text-sm sm:text-xl font-semibold px-4"></div>
            @if($barang->fotos->count() > 1)
            <div id="lightboxCounter" class="text-white/70 text-xs sm:text-sm font-medium"></div>
            @endif
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Grid Pattern */
    .bg-grid-pattern {
        background-image: linear-gradient(rgba(100, 100, 100, 0.1) 1px, transparent 1px),
                          linear-gradient(90deg, rgba(100, 100, 100, 0.1) 1px, transparent 1px);
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

    /* Scrollbar Hide */
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    /* Tab Styles */
    .tab-button.active {
        border-color: #2563eb;
        color: #2563eb;
    }

    .tab-content {
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Lightbox Animation */
    #lightbox {
        animation: lightboxFadeIn 0.3s ease-in-out;
    }

    @keyframes lightboxFadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    #lightboxImage {
        animation: zoomIn 0.4s ease-out;
    }

    @keyframes zoomIn {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    /* Smooth thumbnail transitions */
    .thumbnail-item {
        transition: all 0.3s ease;
    }

    /* Border Width */
    .border-3 {
        border-width: 3px;
    }

    /* Mobile Lightbox Optimization */
    @media (max-width: 640px) {
        #lightbox {
            padding: 0.5rem;
        }
        
        #lightboxImage {
            max-height: 60vh !important;
            border-radius: 0.5rem;
        }
        
        /* Ensure buttons don't overlap image */
        #lightbox button {
            touch-action: manipulation;
            -webkit-tap-highlight-color: transparent;
        }
        
        /* Improve button visibility on mobile */
        #lightbox button {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3), 0 2px 4px -1px rgba(0, 0, 0, 0.2);
        }
        
        /* Prevent image from being too large */
        #lightbox .max-w-6xl {
            max-width: 100%;
        }
    }

    /* Prevent body scroll when lightbox is open */
    body.lightbox-open {
        overflow: hidden;
        position: fixed;
        width: 100%;
    }

    /* Touch-friendly button sizing */
    @media (max-width: 640px) {
        #lightbox button {
            min-width: 44px;
            min-height: 44px;
        }
    }

    /* Improve image fit on portrait mobile */
    @media (max-width: 640px) and (orientation: portrait) {
        #lightboxImage {
            max-height: 55vh !important;
        }
    }

    /* Improve image fit on landscape mobile */
    @media (max-width: 900px) and (orientation: landscape) {
        #lightboxImage {
            max-height: 75vh !important;
        }
        
        #lightboxCaption {
            font-size: 0.875rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Gallery Data dari PHP - sudah otomatis terurut dari database via scope ordered()
    const galleryImages = @json($barang->fotos->map(function($foto) use ($barang) {
        return [
            'url' => $foto->foto_url,
            'keterangan' => $foto->keterangan ?? $barang->nama_barang
        ];
    })->values());

    let currentImageIndex = 0;

    // Tab Switching
    function switchTab(tabName) {
        // Hide all contents
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        
        // Remove active from all buttons
        document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('active', 'border-blue-600', 'text-blue-600');
            button.classList.add('border-transparent', 'text-slate-600');
        });
        
        // Show selected content
        const content = document.getElementById(`content-${tabName}`);
        if (content) {
            content.classList.remove('hidden');
        }
        
        // Activate selected button
        const button = document.getElementById(`tab-${tabName}`);
        if (button) {
            button.classList.add('active', 'border-blue-600', 'text-blue-600');
            button.classList.remove('border-transparent', 'text-slate-600');
        }
    }

    // Change Main Image
    function changeMainImage(imageUrl, index) {
        const mainImage = document.getElementById('mainImage');
        if (!mainImage) return;
        
        mainImage.src = imageUrl;
        currentImageIndex = index;
        
        // Update thumbnail borders
        const thumbnails = document.querySelectorAll('.thumbnail-item');
        thumbnails.forEach((thumb, i) => {
            if (i === index) {
                thumb.classList.remove('border-gray-200');
                thumb.classList.add('border-[#0EA5E9]');
            } else {
                thumb.classList.remove('border-[#0EA5E9]');
                thumb.classList.add('border-gray-200');
            }
        });
    }

    // Open Lightbox
    function openLightbox(index) {
        if (galleryImages.length === 0) return;
        
        currentImageIndex = index;
        updateLightboxImage();
        
        const lightbox = document.getElementById('lightbox');
        if (lightbox) {
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            // Lock body scroll
            document.body.classList.add('lightbox-open');
            document.body.style.overflow = 'hidden';
        }
    }

    // Close Lightbox
    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        if (lightbox) {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            // Restore body scroll
            document.body.classList.remove('lightbox-open');
            document.body.style.overflow = '';
        }
    }

    // Previous Image
    function previousImage() {
        currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
        updateLightboxImage();
    }

    // Next Image
    function nextImage() {
        currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
        updateLightboxImage();
    }

    // Update Lightbox Image
    function updateLightboxImage() {
        if (galleryImages.length === 0) return;
        
        const image = galleryImages[currentImageIndex];
        const lightboxImage = document.getElementById('lightboxImage');
        const lightboxCaption = document.getElementById('lightboxCaption');
        const lightboxCounter = document.getElementById('lightboxCounter');
        
        if (lightboxImage) lightboxImage.src = image.url;
        if (lightboxCaption) lightboxCaption.textContent = image.keterangan;
        if (lightboxCounter && galleryImages.length > 1) {
            lightboxCounter.textContent = `${currentImageIndex + 1} / ${galleryImages.length}`;
        }
    }

    // Keyboard Navigation
    document.addEventListener('keydown', function(e) {
        const lightbox = document.getElementById('lightbox');
        if (!lightbox || lightbox.classList.contains('hidden')) return;
        
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft' && galleryImages.length > 1) previousImage();
        if (e.key === 'ArrowRight' && galleryImages.length > 1) nextImage();
    });

    // Close on outside click
    document.getElementById('lightbox')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeLightbox();
        }
    });

    // Add to Cart
    function addToCart(barangId) {
        const button = event.currentTarget;
        const originalContent = button.innerHTML;
        
        button.innerHTML = `
            <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            <span class="hidden sm:inline">Menambahkan...</span>
        `;
        button.disabled = true;
        
        setTimeout(() => {
            button.innerHTML = `
                <i class="fa-solid fa-check-circle text-emerald-600"></i>
                <span class="hidden sm:inline">Ditambahkan!</span>
            `;
            button.classList.add('bg-emerald-50', 'border-emerald-300');
            
            showNotification('Barang berhasil ditambahkan ke keranjang', 'success');
            
            setTimeout(() => {
                button.innerHTML = originalContent;
                button.classList.remove('bg-emerald-50', 'border-emerald-300');
                button.disabled = false;
            }, 2000);
        }, 1000);
    }

    // Share Item
    function shareItem(itemName, itemUrl) {
        if (navigator.share) {
            navigator.share({
                title: itemName,
                text: `Lihat barang ini: ${itemName}`,
                url: itemUrl
            }).then(() => {
                showNotification('Berhasil dibagikan!', 'success');
            }).catch(() => {
                copyToClipboard(itemUrl);
            });
        } else {
            copyToClipboard(itemUrl);
        }
    }

    // Copy to Clipboard
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            showNotification('Link berhasil disalin ke clipboard', 'success');
        }).catch(() => {
            showNotification('Gagal menyalin link', 'error');
        });
    }

    // Show Notification
    function showNotification(message, type = 'info') {
        const colors = {
            info: 'from-blue-600 to-cyan-500',
            success: 'from-emerald-600 to-teal-500',
            warning: 'from-amber-600 to-orange-500',
            error: 'from-red-600 to-rose-500'
        };
        
        const icons = {
            info: 'info-circle',
            success: 'check-circle',
            warning: 'exclamation-triangle',
            error: 'exclamation-circle'
        };
        
        const notification = document.createElement('div');
        notification.className = `fixed top-6 right-6 bg-gradient-to-r ${colors[type]} text-white px-6 py-4 rounded-2xl shadow-2xl z-50 transform translate-x-full transition-transform duration-300 font-semibold flex items-center gap-3 max-w-md`;
        notification.innerHTML = `
            <i class="fa-solid fa-${icons[type]} text-xl"></i>
            <span>${message}</span>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
            notification.classList.add('translate-x-0');
        }, 100);
        
        setTimeout(() => {
            notification.classList.remove('translate-x-0');
            notification.classList.add('translate-x-full');
            
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // Preload images for better performance
    window.addEventListener('DOMContentLoaded', function() {
        galleryImages.forEach(function(image) {
            const img = new Image();
            img.src = image.url;
        });
    });
</script>
@endpush