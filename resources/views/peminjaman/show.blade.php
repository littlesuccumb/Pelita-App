@extends('layouts.user')

@section('title', 'Detail Peminjaman - Pelita App')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
<style>
    :root {
        --primary-start: #1e40af;
        --primary-end: #3b82f6;
        --accent-start: #06b6d4;
        --accent-end: #0891b2;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
    }

    .glass-morphism {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.1);
    }
    
    .gradient-primary {
        background: linear-gradient(135deg, var(--primary-start) 0%, var(--primary-end) 100%);
    }
    
    .gradient-accent {
        background: linear-gradient(135deg, var(--accent-start) 0%, var(--accent-end) 100%);
    }
    
    .status-shimmer {
        position: relative;
        overflow: hidden;
    }
    
    .status-shimmer::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        animation: shimmer 3s infinite;
    }
    
    @keyframes shimmer {
        100% { left: 100%; }
    }

    .hover-lift {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .hover-lift:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
    
    .smooth-scale {
        transition: transform 0.3s ease;
    }
    
    .smooth-scale:hover {
        transform: scale(1.05);
    }
    
    .timeline-connector {
        position: relative;
    }
    
    .timeline-connector::after {
        content: '';
        position: absolute;
        left: 15px;
        top: 40px;
        width: 2px;
        height: calc(100% - 40px);
        background: linear-gradient(to bottom, #e5e7eb 0%, transparent 100%);
    }
    
    .timeline-connector:last-child::after {
        display: none;
    }
    
    .pulse-ring {
        animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    @keyframes pulse-ring {
        0%, 100% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.1);
            opacity: 0.7;
        }
    }
    
    .gradient-text-tech {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #06b6d4 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .image-overlay {
        position: relative;
        overflow: hidden;
        border-radius: 1rem;
    }
    
    .image-overlay::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(30, 64, 175, 0.15) 0%, rgba(6, 182, 212, 0.15) 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 1;
    }
    
    .image-overlay:hover::before {
        opacity: 1;
    }

    .floating-animation {
        animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .fade-slide-up {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease-out;
    }

    .fade-slide-up.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .tech-pattern {
        background-image: 
            linear-gradient(to right, rgba(59, 130, 246, 0.03) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(59, 130, 246, 0.03) 1px, transparent 1px);
        background-size: 40px 40px;
    }

    body {
        overflow-x: hidden;
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/30 to-cyan-50/30 tech-pattern py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm mb-6" data-aos="fade-down">
            <a href="{{ route('dashboard') }}" class="flex items-center text-slate-500 hover:text-blue-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('peminjaman.index') }}" class="text-slate-500 hover:text-blue-600 transition-colors">Peminjaman</a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-blue-600 font-semibold">#{{ $peminjaman->id }}</span>
        </nav>

        <!-- Header Card -->
        <div class="glass-morphism rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-8 mb-6 md:mb-8 hover-lift" data-aos="fade-up">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 md:gap-6">
                <div class="flex items-start gap-3 md:gap-6">
                    <div class="relative flex-shrink-0 floating-animation">
                        <div class="w-16 h-16 md:w-24 md:h-24 rounded-xl md:rounded-2xl 
                            @if($peminjaman->status === 'menunggu') bg-gradient-to-br from-orange-500 to-amber-600
                            @elseif($peminjaman->status === 'disetujui') gradient-primary
                            @elseif($peminjaman->status === 'selesai') bg-gradient-to-br from-emerald-500 to-green-600
                            @else bg-gradient-to-br from-red-500 to-pink-600 @endif 
                            flex items-center justify-center shadow-xl md:shadow-2xl">
                            <svg class="w-8 h-8 md:w-12 md:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div class="absolute -bottom-1 -right-1 md:-bottom-2 md:-right-2 w-7 h-7 md:w-10 md:h-10 rounded-full border-2 md:border-4 border-white shadow-lg md:shadow-xl flex items-center justify-center
                            @if($peminjaman->status === 'menunggu') bg-orange-500
                            @elseif($peminjaman->status === 'disetujui') bg-blue-500
                            @elseif($peminjaman->status === 'selesai') bg-emerald-500
                            @else bg-red-500 @endif">
                            <svg class="w-3 h-3 md:w-5 md:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($peminjaman->status === 'menunggu')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/>
                                @elseif($peminjaman->status === 'disetujui')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                @elseif($peminjaman->status === 'selesai')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                @endif
                            </svg>
                        </div>
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-2 md:mb-3">
                            <h1 class="text-xl md:text-3xl lg:text-4xl font-bold gradient-text-tech truncate">
                                Detail Peminjaman #{{ $peminjaman->id }}
                            </h1>
                            <span class="status-shimmer px-3 py-1 md:px-5 md:py-2 rounded-full text-xs md:text-sm font-bold inline-flex items-center w-fit
                                @if($peminjaman->status === 'menunggu') bg-orange-100 text-orange-800
                                @elseif($peminjaman->status === 'disetujui') bg-blue-100 text-blue-800
                                @elseif($peminjaman->status === 'selesai') bg-emerald-100 text-emerald-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($peminjaman->status) }}
                            </span>
                        </div>
                        <p class="text-base md:text-xl font-semibold text-slate-700 mb-2 md:mb-3 truncate">{{ $peminjaman->user->name }}</p>
                        <div class="flex flex-wrap items-center gap-2 md:gap-4 text-xs md:text-sm text-slate-600">
                            <div class="flex items-center gap-1.5 md:gap-2">
                                <svg class="w-3 h-3 md:w-4 md:h-4 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="hidden sm:inline">{{ $peminjaman->created_at->format('d M Y, H:i') }}</span>
                                <span class="sm:hidden">{{ $peminjaman->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex items-center gap-1.5 md:gap-2">
                                <svg class="w-3 h-3 md:w-4 md:h-4 text-cyan-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="truncate">{{ $peminjaman->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center gap-1.5 md:gap-2">
                                <svg class="w-3 h-3 md:w-4 md:h-4 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <span>{{ $peminjaman->peminjamanDetail->count() }} items</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row flex-wrap gap-2 md:gap-3">
                    @if($peminjaman->status === 'disetujui' && $peminjaman->pembayaran && $peminjaman->biaya > 0 && $peminjaman->pembayaran->status === 'pending')
                        <a href="{{ route('pembayaran.show', $peminjaman->pembayaran) }}" 
                        class="group relative inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white text-sm font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
                            <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></div>
                            <i class="relative fas fa-dollar-sign text-sm mr-2 group-hover:scale-110 group-hover:-rotate-12 transition-transform duration-300"></i>
                            <span class="relative">Bayar Sekarang</span>
                        </a>
                    @endif
                    
                    <button type="button" onclick="goBack()" 
                        class="group relative inline-flex items-center justify-center px-5 py-2.5 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 border-2 border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500 text-gray-700 dark:text-gray-300 text-sm font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-blue-500/5 to-indigo-500/5 dark:from-blue-600/10 dark:to-indigo-600/10 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                        <i class="relative fas fa-arrow-left text-sm mr-2 text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 group-hover:-translate-x-1 transition-all duration-300"></i>
                        <span class="relative">Kembali</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column (2/3) -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Items List -->
                <div class="glass-morphism rounded-2xl md:rounded-3xl shadow-xl overflow-hidden hover-lift" data-aos="fade-up">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-4 md:p-8 relative overflow-hidden">
                        <div class="absolute inset-0 opacity-20">
                            <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255,255,255,.1) 35px, rgba(255,255,255,.1) 70px);"></div>
                        </div>
                        
                        <div class="relative flex items-center gap-3 md:gap-5">
                            <div class="w-12 h-12 md:w-16 md:h-16 bg-white/30 backdrop-blur-xl rounded-xl md:rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg md:shadow-xl">
                                <svg class="w-6 h-6 md:w-9 md:h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg md:text-2xl font-bold text-white mb-1 md:mb-2">Items dalam Peminjaman</h3>
                                <p class="text-white/95 text-xs md:text-sm">Daftar barang yang dipinjam</p>
                            </div>
                            <span class="inline-flex items-center px-3 py-1.5 md:px-5 md:py-2.5 rounded-full text-xs md:text-sm font-bold bg-white/25 backdrop-blur-sm text-white border border-white/30">
                                {{ $peminjaman->peminjamanDetail->count() }} items
                            </span>
                        </div>
                    </div>

                    <div class="p-4 md:p-8 space-y-3 md:space-y-4">
                        @foreach($peminjaman->peminjamanDetail as $detail)
                            <div class="hover-lift bg-white border-2 border-slate-200 rounded-xl md:rounded-2xl p-3 md:p-5 hover:border-blue-300 transition-all">
                                <div class="flex items-center gap-3 md:gap-5">
                                    <div class="image-overlay w-16 h-16 md:w-28 md:h-28 flex-shrink-0 bg-gradient-to-br from-slate-100 to-slate-200 rounded-lg md:rounded-xl flex items-center justify-center overflow-hidden shadow-md md:shadow-lg">
                                        @if($detail->barang && $detail->barang->fotoPrimary)
                                            <img src="{{ Storage::url($detail->barang->fotoPrimary->foto) }}" 
                                                alt="{{ $detail->barang->nama_barang }}" 
                                                class="w-full h-full object-cover cursor-pointer"
                                                onclick="showImageModal('{{ Storage::url($detail->barang->fotoPrimary->foto) }}')">
                                        @else
                                            <svg class="w-8 h-8 md:w-12 md:h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                        @endif
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-sm md:text-lg font-bold text-slate-800 mb-1.5 md:mb-2 truncate">
                                            {{ $detail->barang->nama_barang ?? 'N/A' }}
                                        </h3>
                                        <div class="flex flex-wrap items-center gap-1.5 md:gap-2 mb-2 md:mb-3">
                                            <span class="inline-flex items-center px-2 py-0.5 md:px-3 md:py-1 rounded-full text-[10px] md:text-xs font-bold bg-blue-100 text-blue-800">
                                                {{ $detail->barang->kategori->nama_kategori ?? 'N/A' }}
                                            </span>
                                            <span class="inline-flex items-center px-2 py-0.5 md:px-3 md:py-1 rounded-full text-[10px] md:text-xs font-bold bg-emerald-100 text-emerald-800">
                                                {{ $detail->barang->kondisi ?? 'N/A' }}
                                            </span>
                                        </div>
                                        <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-4 text-xs md:text-sm text-slate-600">
                                            @if($detail->harga_satuan > 0)
                                                <span class="font-bold text-blue-600">
                                                    Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}/hari
                                                </span>
                                            @else
                                                <span class="font-bold text-emerald-600">GRATIS</span>
                                            @endif
                                            <span class="text-slate-400 hidden sm:inline">•</span>
                                            <span class="font-medium">Quantity: <strong class="text-slate-800">{{ $detail->jumlah }}</strong></span>
                                        </div>
                                    </div>

                                    <div class="text-right flex-shrink-0">
                                        @if($detail->subtotal > 0)
                                            <div class="text-[10px] md:text-xs text-slate-500 mb-0.5 md:mb-1 font-medium">Subtotal</div>
                                            <div class="text-base md:text-xl font-bold text-slate-800">
                                                <span class="hidden md:inline">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                                                <span class="md:hidden">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="text-[9px] md:text-xs text-slate-500">per hari</div>
                                        @else
                                            <div class="text-sm md:text-lg font-bold text-emerald-600">GRATIS</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Total Section -->
                        <div class="border-t-2 border-slate-200 pt-6 md:pt-8 mt-6 md:mt-8">
                            <div class="bg-gradient-to-br from-blue-50 via-cyan-50 to-blue-50 rounded-xl md:rounded-2xl p-4 md:p-6 border-2 border-blue-100">
                                <div class="flex items-center justify-between mb-3 md:mb-4">
                                    <span class="text-slate-700 font-bold text-sm md:text-lg">Durasi Peminjaman</span>
                                    <span class="text-xl md:text-2xl font-bold text-blue-600">
                                        {{ \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($peminjaman->tanggal_selesai)) + 1 }} hari
                                    </span>
                                </div>
                                <div class="flex items-center justify-between pt-3 md:pt-4 border-t-2 border-blue-200">
                                    <span class="text-slate-700 font-bold text-sm md:text-lg">Total Biaya</span>
                                    @if($peminjaman->biaya > 0)
                                        <span class="text-2xl md:text-3xl font-bold gradient-text-tech">
                                            Rp {{ number_format($peminjaman->biaya, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-2xl md:text-3xl font-bold text-emerald-600">GRATIS</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rental Period & Purpose -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                    <div class="glass-morphism rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 hover-lift" data-aos="fade-up">
                        <div class="flex items-center gap-2 md:gap-3 mb-4 md:mb-5">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg md:rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-base md:text-lg font-bold text-slate-800">Periode Peminjaman</h3>
                        </div>
                        <div class="space-y-3 md:space-y-4 text-xs md:text-sm">
                            <div class="p-2.5 md:p-3 bg-slate-50 rounded-lg">
                                <label class="text-slate-600 block mb-1 font-medium">Tanggal Mulai</label>
                                <p class="font-bold text-slate-800 text-sm md:text-base">
                                    {{ $peminjaman->tanggal_mulai ? \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->format('d M Y') : '-' }}
                                </p>
                            </div>
                            <div class="p-2.5 md:p-3 bg-slate-50 rounded-lg">
                                <label class="text-slate-600 block mb-1 font-medium">Tanggal Selesai</label>
                                <p class="font-bold text-slate-800 text-sm md:text-base">
                                    {{ $peminjaman->tanggal_selesai ? \Carbon\Carbon::parse($peminjaman->tanggal_selesai)->format('d M Y') : '-' }}
                                </p>
                            </div>
                            <div class="p-2.5 md:p-3 gradient-primary rounded-lg">
                                <label class="text-white/90 block mb-1 font-medium">Durasi</label>
                                <p class="font-bold text-white text-base md:text-lg">
                                    {{ \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($peminjaman->tanggal_selesai)) + 1 }} hari
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="glass-morphism rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 hover-lift" data-aos="fade-up" data-aos-delay="100">
                        <div class="flex items-center gap-2 md:gap-3 mb-4 md:mb-5">
                            <div class="w-10 h-10 md:w-12 md:h-12 gradient-accent rounded-lg md:rounded-xl flex items-center justify-center shadow-lg">
                                <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-base md:text-lg font-bold text-slate-800">Keperluan</h3>
                        </div>
                        <div class="text-xs md:text-sm p-3 md:p-4 bg-slate-50 rounded-lg">
                            <p class="text-slate-700 leading-relaxed font-medium">
                                {{ $peminjaman->keperluan ?: 'Tidak ada keterangan keperluan' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="space-y-6">
                
                <!-- Timeline -->
                <div class="glass-morphism rounded-2xl shadow-lg p-6 hover-lift" data-aos="fade-left">
                    <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Timeline
                    </h3>
                    
                    <div class="space-y-6">
                        <div class="timeline-connector flex items-start gap-4">
                            <div class="w-10 h-10 gradient-primary rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800">Peminjaman Dibuat</h4>
                                <p class="text-xs text-slate-500 mt-1">{{ $peminjaman->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        
                        @if($peminjaman->status === 'menunggu')
                        <div class="timeline-connector flex items-start gap-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-amber-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg pulse-ring">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-orange-800">Menunggu Persetujuan</h4>
                                <p class="text-xs text-slate-500 mt-1">Sedang direview admin</p>
                            </div>
                        </div>
                        @elseif($peminjaman->status === 'disetujui')
                        <div class="timeline-connector flex items-start gap-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-green-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-blue-800">Disetujui</h4>
                                <p class="text-xs text-slate-500 mt-1">{{ $peminjaman->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>

                        <div class="timeline-connector flex items-start gap-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg pulse-ring">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-blue-800">Sedang Dipinjam</h4>
                                <p class="text-xs text-slate-500 mt-1">Barang dalam penggunaan</p>
                            </div>
                        </div>
                        @elseif($peminjaman->status === 'selesai')
                        <div class="timeline-connector flex items-start gap-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-green-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-emerald-800">Peminjaman Selesai</h4>
                                <p class="text-xs text-slate-500 mt-1">{{ $peminjaman->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        @elseif($peminjaman->status === 'ditolak')
                        <div class="timeline-connector flex items-start gap-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-pink-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-red-800">Peminjaman Ditolak</h4>
                                <p class="text-xs text-slate-500 mt-1">{{ $peminjaman->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Payment Info -->
                @if($peminjaman->pembayaran)
                <div class="glass-morphism rounded-2xl shadow-lg overflow-hidden hover-lift" data-aos="fade-left">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 p-5">
                        <h3 class="text-white font-bold flex items-center gap-2 text-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Info Pembayaran
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between items-center pb-4 border-b border-slate-200">
                            <span class="text-sm text-slate-600 font-medium">Status Pembayaran</span>
                            <span class="px-4 py-2 rounded-full text-xs font-bold
                                @if($peminjaman->pembayaran->status === 'lunas') bg-emerald-100 text-emerald-800
                                @elseif($peminjaman->pembayaran->status === 'pending') bg-orange-100 text-orange-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($peminjaman->pembayaran->status) }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center pb-4 border-b border-slate-200">
                            <span class="text-sm text-slate-600 font-medium">Metode Pembayaran</span>
                            <span class="font-bold text-slate-800 capitalize">
                                {{ $peminjaman->pembayaran->metode ?? '-' }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="text-sm text-slate-600 font-medium">Total Pembayaran</span>
                            @if($peminjaman->pembayaran->jumlah > 0)
                                <span class="text-2xl font-bold gradient-text-tech">
                                    Rp {{ number_format($peminjaman->pembayaran->jumlah, 0, ',', '.') }}
                                </span>
                            @else
                                <span class="text-2xl font-bold text-emerald-600">GRATIS</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- User Info -->
                <div class="glass-morphism rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 hover-lift" data-aos="fade-left">
                    <div class="flex items-center gap-2 md:gap-3 mb-4 md:mb-5">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg md:rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-base md:text-lg font-bold text-slate-800">Data Peminjam</h3>
                    </div>
                    <div class="space-y-2.5 md:space-y-3 text-xs md:text-sm">
                        <div class="p-2.5 md:p-3 bg-slate-50 rounded-lg">
                            <label class="text-slate-500 block mb-1 font-medium">Nama</label>
                            <p class="font-bold text-slate-800">{{ $peminjaman->user->name }}</p>
                        </div>
                        <div class="p-2.5 md:p-3 bg-slate-50 rounded-lg">
                            <label class="text-slate-500 block mb-1 font-medium">Email</label>
                            <p class="font-bold text-slate-800 break-all">{{ $peminjaman->user->email }}</p>
                        </div>
                        @if($peminjaman->user->no_telp)
                        <div class="p-2.5 md:p-3 bg-slate-50 rounded-lg">
                            <label class="text-slate-500 block mb-1 font-medium">No. Telepon</label>
                            <p class="font-bold text-slate-800">{{ $peminjaman->user->no_telp }}</p>
                        </div>
                        @endif
                        @if($peminjaman->user->nama_instansi)
                        <div class="p-2.5 md:p-3 bg-slate-50 rounded-lg">
                            <label class="text-slate-500 block mb-1 font-medium">Instansi</label>
                            <p class="font-bold text-slate-800">{{ $peminjaman->user->nama_instansi }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="glass-morphism rounded-2xl shadow-lg p-6 hover-lift" data-aos="fade-left">
                    <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Aksi Cepat
                    </h3>
                    <div class="space-y-3">
                        @if($peminjaman->status === 'disetujui' && $peminjaman->pembayaran && $peminjaman->pembayaran->status === 'pending')
                            <a href="{{ route('pembayaran.show', $peminjaman->pembayaran) }}" 
                            class="group relative w-full inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white text-sm font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
                                <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></div>
                                <i class="relative fas fa-dollar-sign text-sm mr-2 group-hover:scale-110 group-hover:-rotate-12 transition-transform duration-300"></i>
                                <span class="relative">Bayar Sekarang</span>
                            </a>
                        @endif

                        <a href="{{ route('permohonan.create') }}" 
                        class="group relative w-full inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
                            <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></div>
                            <i class="relative fas fa-plus text-sm mr-2 group-hover:scale-110 group-hover:rotate-90 transition-transform duration-300"></i>
                            <span class="relative">Buat Permohonan Baru</span>
                        </a>

                        <a href="{{ route('user.barang') }}" 
                        class="group relative w-full inline-flex items-center justify-center px-5 py-3 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 border-2 border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500 text-gray-700 dark:text-gray-300 text-sm font-bold rounded-lg transition-all duration-300 overflow-hidden">
                            <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-blue-500/5 to-indigo-500/5 dark:from-blue-600/10 dark:to-indigo-600/10 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                            <i class="relative fas fa-box text-sm mr-2 text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 group-hover:rotate-12 transition-all duration-300"></i>
                            <span class="relative">Lihat Katalog Barang</span>
                        </a>

                        <a href="{{ route('peminjaman.index') }}" 
                        class="group relative w-full inline-flex items-center justify-center px-5 py-3 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 border-2 border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500 text-gray-700 dark:text-gray-300 text-sm font-bold rounded-lg transition-all duration-300 overflow-hidden">
                            <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-blue-500/5 to-indigo-500/5 dark:from-blue-600/10 dark:to-indigo-600/10 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                            <i class="relative fas fa-clipboard-list text-sm mr-2 text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 group-hover:-translate-x-1 transition-all duration-300"></i>
                            <span class="relative">Semua Peminjaman</span>
                        </a>
                    </div>
                </div>
                <!-- Help Card -->
                <div class="glass-morphism rounded-2xl shadow-lg overflow-hidden hover-lift" data-aos="fade-left">
                    <div class="bg-gradient-to-r from-orange-500 to-red-500 p-5">
                        <h3 class="text-white font-bold flex items-center gap-2 text-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Butuh Bantuan?
                        </h3>
                    </div>
                    <div class="p-6">
                        <p class="text-sm text-slate-600 mb-5 font-medium">Hubungi admin jika ada pertanyaan tentang peminjaman</p>
                        <div class="space-y-3 text-sm">
                            <a href="mailto:Cimahi.technopark@gmail.com" class="flex items-center gap-3 p-3 text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Cimahi.technopark@gmail.com
                            </a>
                            <a href="tel:+6285163587878" class="flex items-center gap-3 p-3 text-slate-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                +62 851-6358-7878
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-black bg-opacity-90 backdrop-blur-sm" onclick="closeImageModal()"></div>

        <div class="inline-block w-full max-w-5xl my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-3xl">
            <div class="flex items-center justify-between p-5 border-b-2 border-slate-200 bg-gradient-to-r from-slate-50 to-blue-50">
                <h3 class="text-xl font-bold text-slate-800">Preview</h3>
                <button onclick="closeImageModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-6 bg-slate-50">
                <img id="modalImage" src="" alt="Preview" class="w-full h-auto rounded-xl shadow-lg">
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
// Initialize AOS with smooth settings
AOS.init({
    duration: 600,
    easing: 'ease-out-cubic',
    once: true,
    offset: 50
});

// Image modal functions
function showImageModal(imageSrc) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    
    modalImage.src = imageSrc;
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    document.body.style.overflow = '';
}

// Smooth scroll to top on page load
window.addEventListener('DOMContentLoaded', function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// Enhanced hover effects
document.querySelectorAll('.hover-lift').forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-8px)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
    });
});

// Smooth button interactions
document.querySelectorAll('.smooth-scale').forEach(btn => {
    btn.addEventListener('mousedown', function() {
        this.style.transform = 'scale(0.95)';
    });
    
    btn.addEventListener('mouseup', function() {
        this.style.transform = 'scale(1.05)';
    });
    
    btn.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
    });
});

// Parallax effect for floating elements
let scrollPosition = 0;
window.addEventListener('scroll', function() {
    scrollPosition = window.pageYOffset;
    
    document.querySelectorAll('.floating-animation').forEach(el => {
        const speed = 0.5;
        el.style.transform = `translateY(${scrollPosition * speed}px)`;
    });
});
</script>
@endpush