@extends('layouts.guest')

@section('title', $barang->nama_barang . ' - Detail Barang')

@section('content')
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="min-h-screen bg-gradient-to-b from-gray-50 via-white to-gray-100 relative overflow-x-hidden">
    {{-- Animated Grid Background --}}
    <div class="absolute inset-0 bg-grid-pattern opacity-30 pointer-events-none"></div>
    
    {{-- Large Gradient Orbs - Cimahi Technopark Colors --}}
    <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-[#0EA5E9] rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-slow pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-[#8B5CF6] rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse-slow pointer-events-none" style="animation-delay: 3s"></div>
    <div class="absolute top-1/2 left-1/2 w-[500px] h-[500px] bg-[#14B8A6] rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-pulse-slow pointer-events-none" style="animation-delay: 6s"></div>
    <div class="absolute top-1/3 right-1/4 w-[400px] h-[400px] bg-[#F97316] rounded-full mix-blend-multiply filter blur-3xl opacity-15 animate-pulse-slow pointer-events-none" style="animation-delay: 9s"></div>
    
    <!-- Breadcrumb -->
    <div class="bg-white/80 backdrop-blur-xl border-b border-gray-200 relative z-10 shadow-sm">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-2.5 sm:py-4">
            <nav class="flex items-center space-x-1.5 sm:space-x-2 text-xs sm:text-sm text-gray-600">
                <a href="{{ route('aset.public') }}" class="hover:text-blue-600 transition-colors font-medium">
                    <i class="fa-solid fa-home mr-1"></i>Beranda
                </a>
                <i class="fa-solid fa-chevron-right text-gray-400 text-xs"></i>
                <a href="{{ route('aset.barang') }}" class="hover:text-blue-600 transition-colors font-medium">
                    Barang
                </a>
                <i class="fa-solid fa-chevron-right text-gray-400 text-xs"></i>
                <span class="text-gray-900 font-semibold truncate">{{ $barang->nama_barang }}</span>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-4 sm:py-8 lg:py-12 relative z-10">
        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8 mb-6 sm:mb-8 lg:mb-12">
            <!-- Image Gallery Section -->
            <div class="lg:col-span-1">
                <div class="lg:sticky lg:top-24 space-y-3 sm:space-y-4">
                    <!-- Main Image -->
                    <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl overflow-hidden border border-gray-200 backdrop-blur-xl">
                        @php
                            $mainFoto = $barang->fotoPrimary ?? $barang->fotos->first();
                        @endphp
                        
                        @if($mainFoto)
                            <img id="mainImage" 
                                 src="{{ $mainFoto->foto_url }}" 
                                 alt="{{ $barang->nama_barang }}" 
                                 class="w-full h-64 sm:h-80 lg:h-96 object-cover cursor-pointer hover:opacity-90 transition-opacity"
                                 onclick="openLightbox(0)">
                        @else
                            <div class="w-full h-64 sm:h-80 lg:h-96 bg-gradient-to-br from-blue-50 via-purple-50 to-cyan-50 flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fa-solid fa-box text-blue-300 text-4xl sm:text-6xl mb-2 sm:mb-4"></i>
                                    <p class="text-gray-500 text-sm sm:text-lg">Foto tidak tersedia</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Thumbnail Gallery -->
                    @if($barang->fotos->count() > 1)
                    <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg p-2.5 sm:p-4 border border-gray-200 backdrop-blur-xl">
                        <div class="grid grid-cols-4 gap-1.5 sm:gap-2">
                            @foreach($barang->fotos as $index => $foto)
                                <div class="relative aspect-square rounded-lg overflow-hidden border-2 cursor-pointer hover:border-[#0EA5E9] transition-all group thumbnail-item {{ $loop->first ? 'border-[#0EA5E9]' : 'border-gray-200' }}"
                                     data-index="{{ $index }}"
                                     onclick="changeMainImage('{{ $foto->foto_url }}', {{ $index }})">
                                    <img src="{{ $foto->foto_url }}" 
                                         alt="{{ $foto->keterangan ?? $barang->nama_barang }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    @if($foto->is_primary)
                                        <div class="absolute top-0.5 right-0.5 bg-[#0EA5E9] text-white text-[10px] px-1.5 py-0.5 rounded-full font-bold shadow-lg">
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-2 sm:mt-3">
                            <button onclick="openLightbox(0)" class="text-xs sm:text-sm text-[#0EA5E9] hover:text-[#0284C7] font-semibold flex items-center justify-center gap-1.5 sm:gap-2 w-full transition-colors">
                                <i class="fa-solid fa-expand text-xs"></i>
                                Lihat Semua Foto ({{ $barang->fotos->count() }})
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Details Section -->
            <div class="lg:col-span-2 space-y-3 sm:space-y-4 lg:space-y-6">
                <!-- Header Card -->
                <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl p-4 sm:p-6 lg:p-8 border border-gray-200 backdrop-blur-xl">
                    <div class="flex items-start justify-between mb-3 sm:mb-4 lg:mb-6">
                        <div class="flex-1 pr-2">
                            <h1 class="text-2xl sm:text-3xl lg:text-5xl font-black bg-gradient-to-r from-[#0EA5E9] via-[#14B8A6] to-[#8B5CF6] bg-clip-text text-transparent mb-2 sm:mb-3 lg:mb-4 leading-tight">
                                {{ $barang->nama_barang }}
                            </h1>
                            <div class="flex flex-wrap gap-1.5 sm:gap-2 items-center">
                                @if($barang->kategori)
                                    <span class="inline-block bg-gradient-to-r from-[#0EA5E9]/20 to-[#8B5CF6]/20 text-[#0EA5E9] px-2.5 sm:px-3 lg:px-4 py-1 sm:py-1.5 lg:py-2 rounded-full text-xs sm:text-sm font-bold border border-[#0EA5E9]/30 backdrop-blur-sm">
                                        <i class="fa-solid fa-tag mr-1 sm:mr-2"></i>{{ $barang->kategori->nama_kategori }}
                                    </span>
                                @endif
                                @if($barang->garansi)
                                    <span class="inline-block bg-gradient-to-r from-[#10B981]/20 to-[#14B8A6]/20 text-[#10B981] px-2.5 sm:px-3 lg:px-4 py-1 sm:py-1.5 lg:py-2 rounded-full text-xs sm:text-sm font-bold border border-[#10B981]/30 backdrop-blur-sm">
                                        <i class="fa-solid fa-certificate mr-1 sm:mr-2"></i>{{ $barang->garansi }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        @php
                            $statusConfig = [
                                'tersedia' => ['bg' => 'from-emerald-500 to-teal-500', 'text' => 'Tersedia', 'icon' => 'fa-check-circle', 'ring' => 'ring-emerald-400/30'],
                                'dipinjam' => ['bg' => 'from-amber-500 to-orange-500', 'text' => 'Dipinjam', 'icon' => 'fa-clock', 'ring' => 'ring-amber-400/30'],
                                'maintenance' => ['bg' => 'from-red-500 to-rose-500', 'text' => 'Maintenance', 'icon' => 'fa-wrench', 'ring' => 'ring-red-400/30']
                            ];
                            $config = $statusConfig[$barang->status] ?? ['bg' => 'from-gray-500 to-gray-600', 'text' => ucfirst($barang->status), 'icon' => 'fa-circle-info', 'ring' => 'ring-gray-400/30'];
                        @endphp
                        <span class="inline-flex items-center px-2 sm:px-3 lg:px-4 py-1 sm:py-1.5 lg:py-2 bg-gradient-to-r {{ $config['bg'] }} text-white text-[10px] sm:text-xs font-bold rounded-full shadow-lg ring-1 sm:ring-2 {{ $config['ring'] }} whitespace-nowrap">
                            <i class="fa-solid {{ $config['icon'] }} mr-1 sm:mr-2"></i>
                            {{ $config['text'] }}
                        </span>
                    </div>

                    <!-- Price Section -->
                    <div class="py-3 sm:py-4 lg:py-6 border-t border-gray-200">
                        @if($barang->harga_sewa > 0)
                            <div class="flex items-baseline gap-2 sm:gap-3">
                                <span class="text-3xl sm:text-4xl lg:text-5xl font-black bg-gradient-to-r from-[#10B981] to-[#14B8A6] bg-clip-text text-transparent">
                                    Rp{{ number_format($barang->harga_sewa, 0, ',', '.') }}
                                </span>
                                <span class="text-gray-600 font-bold text-sm sm:text-base lg:text-lg">/hari</span>
                            </div>
                        @else
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-[#10B981] flex items-center gap-2">
                                <i class="fa-solid fa-gift"></i>Gratis
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-2 gap-2 sm:gap-3 lg:gap-4">
                    <div class="bg-gradient-to-br from-[#0EA5E9]/10 to-[#06B6D4]/10 p-3 sm:p-4 lg:p-5 rounded-xl sm:rounded-2xl border border-[#0EA5E9]/20 backdrop-blur-sm">
                        <div class="flex items-center space-x-2 sm:space-x-3 mb-1 sm:mb-2">
                            <i class="fa-solid fa-barcode text-[#0EA5E9] text-base sm:text-lg lg:text-xl"></i>
                            <span class="text-[10px] sm:text-xs text-gray-600 font-bold uppercase tracking-wide">Kode</span>
                        </div>
                        <p class="text-sm sm:text-lg lg:text-xl font-bold text-[#0EA5E9] truncate">{{ $barang->kode_barang ?: '-' }}</p>
                    </div>

                    <div class="bg-gradient-to-br from-[#10B981]/10 to-[#14B8A6]/10 p-3 sm:p-4 lg:p-5 rounded-xl sm:rounded-2xl border border-[#10B981]/20 backdrop-blur-sm">
                        <div class="flex items-center space-x-2 sm:space-x-3 mb-1 sm:mb-2">
                            <i class="fa-solid fa-boxes-stacked text-[#10B981] text-base sm:text-lg lg:text-xl"></i>
                            <span class="text-[10px] sm:text-xs text-gray-600 font-bold uppercase tracking-wide">Tersedia</span>
                        </div>
                        <p class="text-sm sm:text-lg lg:text-xl font-bold text-[#10B981]">{{ $barang->jumlah_tersedia }}<span class="text-xs sm:text-sm text-gray-500 font-normal">/{{ $barang->jumlah_total }}</span></p>
                    </div>

                    <div class="bg-gradient-to-br from-[#8B5CF6]/10 to-[#A78BFA]/10 p-3 sm:p-4 lg:p-5 rounded-xl sm:rounded-2xl border border-[#8B5CF6]/20 backdrop-blur-sm">
                        <div class="flex items-center space-x-2 sm:space-x-3 mb-1 sm:mb-2">
                            <i class="fa-solid fa-shield text-[#8B5CF6] text-base sm:text-lg lg:text-xl"></i>
                            <span class="text-[10px] sm:text-xs text-gray-600 font-bold uppercase tracking-wide">Kondisi</span>
                        </div>
                        <p class="text-sm sm:text-lg lg:text-xl font-bold text-[#8B5CF6] truncate">{{ ucfirst(str_replace('_', ' ', $barang->kondisi)) }}</p>
                    </div>

                    <div class="bg-gradient-to-br from-[#F97316]/10 to-[#FB923C]/10 p-3 sm:p-4 lg:p-5 rounded-xl sm:rounded-2xl border border-[#F97316]/20 backdrop-blur-sm">
                        <div class="flex items-center space-x-2 sm:space-x-3 mb-1 sm:mb-2">
                            <i class="fa-solid fa-location-dot text-[#F97316] text-base sm:text-lg lg:text-xl"></i>
                            <span class="text-[10px] sm:text-xs text-gray-600 font-bold uppercase tracking-wide">Lokasi</span>
                        </div>
                        <p class="text-sm sm:text-lg lg:text-xl font-bold text-[#F97316] truncate">{{ $barang->lokasi ?: '-' }}</p>
                    </div>
                </div>

                <!-- Description -->
                @if($barang->deskripsi)
                <div class="bg-white p-3 sm:p-4 lg:p-6 rounded-xl sm:rounded-2xl border border-gray-200 backdrop-blur-xl shadow-md">
                    <h3 class="text-sm sm:text-base lg:text-lg font-bold text-gray-900 mb-2 sm:mb-3 flex items-center">
                        <i class="fa-solid fa-align-left mr-1.5 sm:mr-2 text-[#0EA5E9] text-sm sm:text-base"></i>
                        Deskripsi
                    </h3>
                    <p class="text-xs sm:text-sm lg:text-base text-gray-700 leading-relaxed">{{ $barang->deskripsi }}</p>
                </div>
                @endif

                <!-- Technical Specifications -->
                @if($barang->spesifikasi)
                <div class="bg-white p-3 sm:p-4 lg:p-6 rounded-xl sm:rounded-2xl border border-gray-200 backdrop-blur-xl shadow-md">
                    <h3 class="text-sm sm:text-base lg:text-lg font-bold text-gray-900 mb-2 sm:mb-3 flex items-center">
                        <i class="fa-solid fa-microchip mr-1.5 sm:mr-2 text-[#8B5CF6] text-sm sm:text-base"></i>
                        Spesifikasi Teknis
                    </h3>
                    <p class="text-xs sm:text-sm lg:text-base text-gray-700 leading-relaxed whitespace-pre-line">{{ $barang->spesifikasi }}</p>
                </div>
                @endif

                <!-- Additional Info -->
                @if($barang->lainnya)
                <div class="bg-white p-3 sm:p-4 lg:p-6 rounded-xl sm:rounded-2xl border border-gray-200 backdrop-blur-xl shadow-md">
                    <h3 class="text-sm sm:text-base lg:text-lg font-bold text-gray-900 mb-2 sm:mb-3 flex items-center">
                        <i class="fa-solid fa-circle-info mr-1.5 sm:mr-2 text-[#14B8A6] text-sm sm:text-base"></i>
                        Informasi Tambahan
                    </h3>
                    <p class="text-xs sm:text-sm lg:text-base text-gray-700 leading-relaxed">{{ $barang->lainnya }}</p>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="space-y-2 sm:space-y-3">
                    @auth
                        @if($barang->status === 'tersedia' && $barang->dapat_dipinjam && $barang->jumlah_tersedia > 0)
                            <a href="{{ route('permohonan.create') }}?barang_id={{ $barang->id }}" 
                               class="w-full bg-gradient-to-r from-[#0EA5E9] via-[#06B6D4] to-[#14B8A6] text-white py-3 sm:py-4 lg:py-5 px-4 sm:px-5 lg:px-6 rounded-xl sm:rounded-2xl font-bold hover:shadow-2xl transition-all duration-300 hover:from-[#0284C7] hover:via-[#0891B2] hover:to-[#0D9488] flex items-center justify-center gap-2 sm:gap-3 shadow-xl hover:-translate-y-1 text-sm sm:text-base lg:text-lg transform">
                                <i class="fa-solid fa-bolt text-sm sm:text-base"></i>
                                <span>Ajukan Peminjaman Sekarang</span>
                                <i class="fa-solid fa-arrow-right text-sm sm:text-base"></i>
                            </a>
                        @else
                            <div class="w-full bg-gray-200 text-gray-600 py-3 sm:py-4 lg:py-5 px-4 sm:px-5 lg:px-6 rounded-xl sm:rounded-2xl font-bold text-center cursor-not-allowed border border-gray-300 text-sm sm:text-base">
                                <i class="fa-solid fa-lock mr-2"></i>
                                @if(!$barang->dapat_dipinjam)
                                    Barang Tidak Dapat Dipinjam
                                @elseif($barang->jumlah_tersedia == 0)
                                    Stok Tidak Tersedia
                                @else
                                    Tidak Dapat Dipinjam ({{ ucfirst($barang->status) }})
                                @endif
                            </div>
                        @endif
                    @else
                        <a href="{{ route('login') }}" 
                           class="w-full bg-gradient-to-r from-[#0EA5E9] via-[#06B6D4] to-[#14B8A6] text-white py-3 sm:py-4 lg:py-5 px-4 sm:px-5 lg:px-6 rounded-xl sm:rounded-2xl font-bold hover:shadow-2xl transition-all duration-300 hover:from-[#0284C7] hover:via-[#0891B2] hover:to-[#0D9488] flex items-center justify-center gap-2 sm:gap-3 shadow-xl hover:-translate-y-1 text-sm sm:text-base lg:text-lg transform">
                            <i class="fa-solid fa-sign-in-alt text-sm sm:text-base"></i>
                            <span>Login untuk Meminjam</span>
                            <i class="fa-solid fa-arrow-right text-sm sm:text-base"></i>
                        </a>
                    @endauth

                    <a href="{{ route('aset.barang') }}" 
                       class="w-full border-2 border-gray-300 text-gray-700 py-2.5 sm:py-3 lg:py-4 px-4 sm:px-5 lg:px-6 rounded-xl sm:rounded-2xl font-bold hover:bg-gray-100 hover:border-gray-400 transition-all duration-300 text-center flex items-center justify-center gap-1.5 sm:gap-2 backdrop-blur-sm text-sm sm:text-base">
                        <i class="fa-solid fa-arrow-left text-sm sm:text-base"></i>
                        <span>Kembali ke Katalog</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Specifications & Rental Info -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 lg:gap-8 mb-8 sm:mb-12 lg:mb-16">
            <!-- Specifications -->
            <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-2xl sm:rounded-3xl shadow-xl border border-gray-200 backdrop-blur-xl">
                <h3 class="text-lg sm:text-xl lg:text-2xl font-black text-gray-900 mb-4 sm:mb-6 lg:mb-8 flex items-center">
                    <div class="w-8 h-8 sm:w-9 sm:h-9 lg:w-10 lg:h-10 bg-gradient-to-br from-[#0EA5E9] to-[#06B6D4] rounded-xl lg:rounded-2xl flex items-center justify-center mr-2 sm:mr-3">
                        <i class="fa-solid fa-list text-white text-sm sm:text-base"></i>
                    </div>
                    Detail Spesifikasi
                </h3>
                
                <div class="space-y-2 sm:space-y-3 lg:space-y-4">
                    <div class="flex justify-between items-center py-2.5 sm:py-3 lg:py-4 px-2.5 sm:px-3 lg:px-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-gray-300 transition-all">
                        <span class="text-xs sm:text-sm text-gray-600 font-medium">Kode Barang</span>
                        <span class="text-xs sm:text-sm text-gray-900 font-bold truncate ml-2">{{ $barang->kode_barang ?: '-' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2.5 sm:py-3 lg:py-4 px-2.5 sm:px-3 lg:px-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-gray-300 transition-all">
                        <span class="text-xs sm:text-sm text-gray-600 font-medium">Kategori</span>
                        <span class="text-xs sm:text-sm text-gray-900 font-bold truncate ml-2">{{ $barang->kategori->nama_kategori ?? '-' }}</span>
                    </div>
                    
                    @if($barang->merk)
                    <div class="flex justify-between items-center py-2.5 sm:py-3 lg:py-4 px-2.5 sm:px-3 lg:px-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-gray-300 transition-all">
                        <span class="text-xs sm:text-sm text-gray-600 font-medium">Merk</span>
                        <span class="text-xs sm:text-sm text-gray-900 font-bold truncate ml-2">{{ $barang->merk }}</span>
                    </div>
                    @endif

                    @if($barang->type)
                    <div class="flex justify-between items-center py-2.5 sm:py-3 lg:py-4 px-2.5 sm:px-3 lg:px-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-gray-300 transition-all">
                        <span class="text-xs sm:text-sm text-gray-600 font-medium">Type</span>
                        <span class="text-xs sm:text-sm text-gray-900 font-bold truncate ml-2">{{ $barang->type }}</span>
                    </div>
                    @endif

                    @if($barang->seri)
                    <div class="flex justify-between items-center py-2.5 sm:py-3 lg:py-4 px-2.5 sm:px-3 lg:px-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-gray-300 transition-all">
                        <span class="text-xs sm:text-sm text-gray-600 font-medium">Seri</span>
                        <span class="text-xs sm:text-sm text-gray-900 font-bold truncate ml-2">{{ $barang->seri }}</span>
                    </div>
                    @endif

                    @if($barang->tahun_produksi)
                    <div class="flex justify-between items-center py-2.5 sm:py-3 lg:py-4 px-2.5 sm:px-3 lg:px-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-gray-300 transition-all">
                        <span class="text-xs sm:text-sm text-gray-600 font-medium">Tahun Produksi</span>
                        <span class="text-xs sm:text-sm text-gray-900 font-bold">{{ $barang->tahun_produksi }}</span>
                    </div>
                    @endif

                    @if($barang->warna)
                    <div class="flex justify-between items-center py-2.5 sm:py-3 lg:py-4 px-2.5 sm:px-3 lg:px-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-gray-300 transition-all">
                        <span class="text-xs sm:text-sm text-gray-600 font-medium">Warna</span>
                        <span class="text-xs sm:text-sm text-gray-900 font-bold truncate ml-2">{{ $barang->warna }}</span>
                    </div>
                    @endif

                    @if($barang->dimensi)
                    <div class="flex justify-between items-center py-2.5 sm:py-3 lg:py-4 px-2.5 sm:px-3 lg:px-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-gray-300 transition-all">
                        <span class="text-xs sm:text-sm text-gray-600 font-medium">Dimensi (P×L×T)</span>
                        <span class="text-xs sm:text-sm text-gray-900 font-bold truncate ml-2">{{ $barang->dimensi }} cm</span>
                    </div>
                    @endif

                    @if($barang->berat)
                    <div class="flex justify-between items-center py-2.5 sm:py-3 lg:py-4 px-2.5 sm:px-3 lg:px-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-gray-300 transition-all">
                        <span class="text-xs sm:text-sm text-gray-600 font-medium">Berat</span>
                        <span class="text-xs sm:text-sm text-gray-900 font-bold truncate ml-2">{{ $barang->berat }} kg</span>
                    </div>
                    @endif
                    
                    <div class="flex justify-between items-center py-2.5 sm:py-3 lg:py-4 px-2.5 sm:px-3 lg:px-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-gray-300 transition-all">
                        <span class="text-xs sm:text-sm text-gray-600 font-medium">Total Unit</span>
                        <span class="text-xs sm:text-sm text-gray-900 font-bold">{{ $barang->jumlah_total }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2.5 sm:py-3 lg:py-4 px-2.5 sm:px-3 lg:px-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-gray-300 transition-all">
                        <span class="text-xs sm:text-sm text-gray-600 font-medium">Unit Tersedia</span>
                        <span class="text-xs sm:text-sm text-emerald-600 font-bold">{{ $barang->jumlah_tersedia }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2.5 sm:py-3 lg:py-4 px-2.5 sm:px-3 lg:px-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-gray-300 transition-all">
                        <span class="text-xs sm:text-sm text-gray-600 font-medium">Kondisi</span>
                        <span class="text-xs sm:text-sm text-gray-900 font-bold truncate ml-2">{{ ucfirst(str_replace('_', ' ', $barang->kondisi)) }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2.5 sm:py-3 lg:py-4 px-2.5 sm:px-3 lg:px-4 bg-gray-50 rounded-lg border border-gray-200 hover:border-gray-300 transition-all">
                        <span class="text-xs sm:text-sm text-gray-600 font-medium">Lokasi</span>
                        <span class="text-xs sm:text-sm text-gray-900 font-bold truncate ml-2">{{ $barang->lokasi ?: '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Rental Information -->
            <div class="bg-white p-4 sm:p-6 lg:p-8 rounded-2xl sm:rounded-3xl shadow-xl border border-gray-200 backdrop-blur-xl">
                <h3 class="text-lg sm:text-xl lg:text-2xl font-black text-gray-900 mb-4 sm:mb-6 lg:mb-8 flex items-center">
                    <div class="w-8 h-8 sm:w-9 sm:h-9 lg:w-10 lg:h-10 bg-gradient-to-br from-[#10B981] to-[#14B8A6] rounded-xl lg:rounded-2xl flex items-center justify-center mr-2 sm:mr-3">
                        <i class="fa-solid fa-credit-card text-white text-sm sm:text-base"></i>
                    </div>
                    Info Peminjaman
                </h3>

                <div class="space-y-3 sm:space-y-4">
                    @if($barang->harga_sewa > 0)
                        <div class="bg-gradient-to-br from-[#0EA5E9]/20 to-[#06B6D4]/20 p-4 sm:p-5 lg:p-6 rounded-xl sm:rounded-2xl border-2 border-[#0EA5E9]/30 backdrop-blur-sm">
                            <div class="text-center">
                                <div class="text-xs sm:text-sm text-[#0EA5E9] font-medium mb-1 sm:mb-2 uppercase tracking-wide">Tarif Harian</div>
                                <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#0EA5E9] mb-1 sm:mb-2">
                                    Rp {{ number_format($barang->harga_sewa, 0, ',', '.') }}
                                </div>
                                <div class="text-xs sm:text-sm text-[#0EA5E9] font-semibold">per hari</div>
                            </div>
                        </div>
                    @else
                        <div class="bg-gradient-to-br from-[#10B981]/20 to-[#14B8A6]/20 p-4 sm:p-5 lg:p-6 rounded-xl sm:rounded-2xl border-2 border-[#10B981]/30 backdrop-blur-sm">
                            <div class="text-center">
                                <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-[#10B981] mb-1 sm:mb-2">
                                    <i class="fa-solid fa-gift mr-2"></i>Gratis
                                </div>
                                <div class="text-xs sm:text-sm text-[#10B981] font-semibold">Tidak ada biaya sewa</div>
                            </div>
                        </div>
                    @endif

                    <div class="bg-gradient-to-br from-[#8B5CF6]/10 to-[#A78BFA]/10 p-4 sm:p-5 lg:p-6 rounded-xl sm:rounded-2xl border border-[#8B5CF6]/20 backdrop-blur-sm">
                        <h4 class="font-bold text-gray-900 mb-3 sm:mb-4 lg:mb-5 flex items-center text-sm sm:text-base lg:text-lg">
                            <i class="fa-solid fa-shield-halved mr-2 text-[#8B5CF6]"></i>
                            Ketentuan Penting
                        </h4>
                        <ul class="space-y-2.5 sm:space-y-3 lg:space-y-4 text-xs sm:text-sm">
                            <li class="flex items-start gap-2 sm:gap-3 group">
                                <div class="w-5 h-5 sm:w-6 sm:h-6 bg-gradient-to-br from-[#10B981] to-[#14B8A6] rounded-full flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-check text-white text-[10px] sm:text-xs"></i>
                                </div>
                                <span class="text-gray-700 leading-relaxed">Durasi peminjaman <strong class="text-gray-900">1 hingga 3 hari</strong></span>
                            </li>
                            <li class="flex items-start gap-2 sm:gap-3 group">
                                <div class="w-5 h-5 sm:w-6 sm:h-6 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-check text-white text-[10px] sm:text-xs"></i>
                                </div>
                                <span class="text-gray-700 leading-relaxed">Kembalikan dalam <strong class="text-gray-900">kondisi terbaik</strong> seperti saat diterima</span>
                            </li>
                            <li class="flex items-start gap-2 sm:gap-3 group">
                                <div class="w-5 h-5 sm:w-6 sm:h-6 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-check text-white text-[10px] sm:text-xs"></i>
                                </div>
                                <span class="text-gray-700 leading-relaxed">Harus mendapat <strong class="text-gray-900">persetujuan admin</strong> terlebih dahulu</span>
                            </li>
                            <li class="flex items-start gap-2 sm:gap-3 group">
                                <div class="w-5 h-5 sm:w-6 sm:h-6 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-check text-white text-[10px] sm:text-xs"></i>
                                </div>
                                <span class="text-gray-700 leading-relaxed">Pengembalian harus <strong class="text-gray-900">tepat waktu</strong> sesuai jadwal</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Items -->
        @if($relatedBarang->count() > 0)
        <div>
            <h2 class="text-xl sm:text-2xl lg:text-3xl font-black text-gray-900 mb-4 sm:mb-6 lg:mb-10 flex items-center">
                <div class="w-9 h-9 sm:w-10 sm:h-10 lg:w-12 lg:h-12 bg-gradient-to-br from-[#0EA5E9] to-[#06B6D4] rounded-xl sm:rounded-2xl flex items-center justify-center mr-2.5 sm:mr-3 lg:mr-4">
                    <i class="fa-solid fa-th text-white text-sm sm:text-base"></i>
                </div>
                Barang Serupa
            </h2>
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6">
                @foreach($relatedBarang as $item)
                <a href="{{ route('aset.barang.detail', $item->id) }}" class="group">
                    <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 sm:hover:-translate-y-3 overflow-hidden border border-gray-200 backdrop-blur-xl hover:border-[#0EA5E9]/50">
                        <div class="relative aspect-square overflow-hidden bg-gray-100">
                            @if($item->fotoPrimary)
                                <img src="{{ $item->fotoPrimary->foto_url }}" alt="{{ $item->nama_barang }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-50 to-purple-50 flex items-center justify-center">
                                    <i class="fa-solid fa-box text-blue-300 text-2xl sm:text-3xl lg:text-4xl"></i>
                                </div>
                            @endif
                            <span class="absolute top-2 right-2 sm:top-3 sm:right-3 inline-flex items-center px-2 sm:px-2.5 lg:px-3 py-1 sm:py-1.5 bg-gradient-to-r from-[#10B981] to-[#14B8A6] text-white text-[10px] sm:text-xs font-bold rounded-full shadow-lg">
                                <i class="fa-solid fa-check-circle mr-1"></i>
                                Tersedia
                            </span>
                        </div>
                        <div class="p-3 sm:p-4 lg:p-5">
                            <h3 class="font-bold text-gray-900 mb-2 sm:mb-3 line-clamp-2 group-hover:text-[#0EA5E9] transition-colors text-xs sm:text-sm">{{ $item->nama_barang }}</h3>
                            <div class="flex items-center justify-between">
                                <div class="font-bold text-[#0EA5E9]">
                                    @if($item->harga_sewa > 0)
                                        <span class="text-xs sm:text-sm">Rp{{ number_format($item->harga_sewa, 0, ',', '.') }}</span>
                                        <span class="text-[10px] sm:text-xs text-gray-500 font-normal block">/hari</span>
                                    @else
                                        <span class="text-sm sm:text-base">Gratis</span>
                                    @endif
                                </div>
                                <span class="text-[10px] sm:text-xs bg-gray-100 text-gray-700 px-2 sm:px-2.5 py-1 sm:py-1.5 rounded-lg font-bold border border-gray-200">
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

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-95 z-50 hidden items-center justify-center p-4">
    <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors z-10">
        <i class="fa-solid fa-times text-2xl sm:text-3xl"></i>
    </button>
    
    @if($barang->fotos->count() > 1)
    <button onclick="previousImage()" class="absolute left-4 text-white hover:text-gray-300 transition-colors z-10">
        <i class="fa-solid fa-chevron-left text-2xl sm:text-3xl"></i>
    </button>
    
    <button onclick="nextImage()" class="absolute right-4 text-white hover:text-gray-300 transition-colors z-10">
        <i class="fa-solid fa-chevron-right text-2xl sm:text-3xl"></i>
    </button>
    @endif

    <div class="max-w-5xl w-full">
        <img id="lightboxImage" src="" alt="" class="w-full h-auto max-h-[80vh] object-contain">
        <div id="lightboxCaption" class="text-white text-center mt-4 text-sm sm:text-base lg:text-lg"></div>
        @if($barang->fotos->count() > 1)
        <div id="lightboxCounter" class="text-white text-center mt-2 text-xs sm:text-sm opacity-75"></div>
        @endif
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

    /* Force sticky behavior on large screens */
    @media (min-width: 1024px) {
        .lg\:sticky {
            position: -webkit-sticky;
            position: sticky;
        }
        .lg\:top-24 {
            top: 6rem;
        }
    }

    /* Lightbox Animation */
    #lightbox {
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    #lightboxImage {
        animation: zoomIn 0.3s ease-in-out;
    }

    @keyframes zoomIn {
        from { transform: scale(0.8); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }

    /* Smooth thumbnail transitions */
    .thumbnail-item {
        transition: all 0.3s ease;
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
            document.body.style.overflow = 'hidden';
        }
    }

    // Close Lightbox
    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        if (lightbox) {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.style.overflow = 'auto';
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

    // Preload images for better performance
    window.addEventListener('DOMContentLoaded', function() {
        galleryImages.forEach(function(image) {
            const img = new Image();
            img.src = image.url;
        });
    });
</script>
@endpush