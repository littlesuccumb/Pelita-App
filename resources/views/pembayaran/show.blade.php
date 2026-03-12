@extends('layouts.user')

@section('title', 'Detail Pembayaran - Pelita App')

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
 /* GANTI DENGAN INI */
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

    .loading-spinner {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.75);
        z-index: 9999;
        justify-content: center;
        align-items: center;
        backdrop-filter: blur(4px);
    }

    .loading-spinner.active {
        display: flex;
    }

    .spinner-circle {
        width: 80px;
        height: 80px;
        border: 4px solid rgba(255, 255, 255, 0.2);
        border-top-color: #3b82f6;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    #dropZone.drag-active {
        border-color: #3b82f6;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(6, 182, 212, 0.05) 100%);
        transform: scale(1.02);
    }

    #dropZone.has-file {
        border-color: #10b981;
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, rgba(5, 150, 105, 0.05) 100%);
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

    /* Tech Pattern Background */
    .tech-pattern {
        background-image: 
            linear-gradient(to right, rgba(59, 130, 246, 0.03) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(59, 130, 246, 0.03) 1px, transparent 1px);
        background-size: 40px 40px;
    }

    /* Prevent horizontal overflow */
    body {
        overflow-x: hidden;
    }
</style>
@endpush

@section('content')
<!-- Loading Spinner -->
<div class="loading-spinner" id="loadingSpinner">
    <div class="bg-white rounded-3xl p-6 sm:p-10 text-center shadow-2xl">
        <div class="spinner-circle mx-auto mb-6"></div>
        <div class="text-xl font-bold text-slate-800 mb-2">Memproses Upload</div>
        <div class="text-sm text-slate-600">Mohon tunggu sebentar...</div>
    </div>
</div>

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
            <a href="{{ route('pembayaran.index') }}" class="text-slate-500 hover:text-blue-600 transition-colors">Pembayaran</a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-blue-600 font-semibold">#{{ $pembayaran->id }}</span>
        </nav>

        <!-- Header Card -->
        <div class="glass-morphism rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-8 mb-6 md:mb-8 hover-lift" data-aos="fade-up">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 md:gap-6">
                <div class="flex items-start gap-3 md:gap-6">
                    <div class="relative flex-shrink-0 floating-animation">
                        <div class="w-16 h-16 md:w-24 md:h-24 rounded-xl md:rounded-2xl 
                            @if($pembayaran->status === 'pending') gradient-primary
                            @elseif($pembayaran->status === 'lunas') bg-gradient-to-br from-emerald-500 to-green-600
                            @else bg-gradient-to-br from-red-500 to-pink-600 @endif 
                            flex items-center justify-center shadow-xl md:shadow-2xl">
                            <!-- Icon Uang -->
                            <svg class="w-8 h-8 md:w-14 md:h-14 text-white" viewBox="0 -3 38 38" fill="currentColor">
                                <path d="M36.002 23.010l0.057-17.089-31.050 0.019-0.001-1.96h32.992v19.031l-1.998-0.001zM34.995 26.017l-1.997-0.002 0.057-17.089-31.050 0.020-0.001-1.96h32.992v19.031zM32.053 28.020h-32.053v-18.030h32.053v18.030zM30.049 11.931h-28.046v14.086h28.045v-14.086zM27.045 24.515c0 0.177 0.044 0.342 0.101 0.5h-11.12c2.766 0 5.009-2.69 5.009-6.010s-2.243-6.010-5.009-6.010h11.119c-0.057 0.158-0.101 0.323-0.101 0.501 0 0.83 0.672 1.502 1.502 1.502 0.178 0 0.343-0.044 0.501-0.101v8.215c-0.158-0.056-0.323-0.101-0.501-0.101-0.829 0.001-1.501 0.674-1.501 1.504zM25.041 16.919c-0.83 0-1.502 0.896-1.502 2.003s0.672 2.003 1.502 2.003 1.502-0.896 1.502-2.003-0.672-2.003-1.502-2.003zM18.123 15.394c0.015 0.029 0.027 0.068 0.037 0.116 0.011 0.048 0.018 0.109 0.021 0.182 0.005 0.073 0.007 0.164 0.007 0.273 0 0.121-0.003 0.224-0.009 0.307-0.007 0.084-0.018 0.153-0.031 0.207-0.016 0.055-0.036 0.095-0.062 0.119-0.027 0.025-0.064 0.038-0.11 0.038s-0.118-0.029-0.219-0.087c-0.101-0.059-0.224-0.121-0.369-0.189s-0.315-0.131-0.507-0.187-0.402-0.084-0.632-0.084c-0.18 0-0.336 0.021-0.469 0.065-0.134 0.044-0.246 0.104-0.335 0.181s-0.157 0.17-0.2 0.277c-0.044 0.108-0.066 0.223-0.066 0.343 0 0.18 0.049 0.335 0.147 0.467s0.229 0.248 0.395 0.35c0.165 0.103 0.352 0.198 0.56 0.288s0.421 0.185 0.638 0.284c0.217 0.101 0.43 0.214 0.639 0.342 0.209 0.127 0.395 0.279 0.557 0.456 0.163 0.178 0.295 0.386 0.395 0.626s0.15 0.522 0.15 0.848c0 0.425-0.080 0.799-0.238 1.119-0.158 0.321-0.373 0.59-0.645 0.805s-0.588 0.376-0.951 0.484c-0.046 0.014-0.096 0.020-0.143 0.031v1.094h-0.985v-0.965c-0.013 0-0.024 0.003-0.037 0.003-0.279 0-0.539-0.023-0.779-0.068s-0.452-0.101-0.635-0.164c-0.184-0.064-0.337-0.132-0.46-0.202s-0.212-0.132-0.266-0.186-0.093-0.132-0.116-0.234-0.035-0.25-0.035-0.442c0-0.129 0.004-0.238 0.013-0.325 0.008-0.088 0.022-0.159 0.041-0.214 0.019-0.054 0.044-0.093 0.075-0.116 0.031-0.022 0.068-0.034 0.109-0.034 0.059 0 0.141 0.034 0.248 0.104 0.106 0.068 0.243 0.145 0.41 0.228s0.366 0.159 0.598 0.228c0.231 0.069 0.5 0.104 0.804 0.104 0.2 0 0.38-0.024 0.538-0.072s0.293-0.116 0.404-0.203c0.11-0.088 0.194-0.197 0.253-0.326s0.088-0.274 0.088-0.433c0-0.184-0.051-0.342-0.15-0.473-0.1-0.132-0.23-0.248-0.391-0.351s-0.343-0.198-0.547-0.287c-0.205-0.090-0.415-0.185-0.632-0.285s-0.428-0.214-0.632-0.341c-0.204-0.127-0.387-0.279-0.547-0.457-0.16-0.177-0.291-0.387-0.391-0.628-0.1-0.242-0.15-0.532-0.15-0.87 0-0.388 0.072-0.729 0.216-1.022 0.144-0.294 0.338-0.538 0.582-0.732s0.532-0.339 0.863-0.435c0.17-0.049 0.346-0.085 0.527-0.109v-1.035h0.985v1.035c0.039 0.005 0.078 0.003 0.117 0.009 0.192 0.029 0.372 0.068 0.539 0.118 0.166 0.050 0.314 0.105 0.443 0.168s0.215 0.113 0.258 0.155c0.039 0.037 0.067 0.072 0.082 0.102zM11.018 19.005c0 3.319 2.242 6.010 5.008 6.010h-11.119c0.056-0.158 0.101-0.323 0.101-0.5 0-0.83-0.673-1.503-1.502-1.503-0.178 0-0.343 0.045-0.501 0.101v-8.215c0.158 0.057 0.323 0.101 0.501 0.101 0.83 0 1.502-0.672 1.502-1.502 0-0.178-0.045-0.343-0.101-0.501h11.119c-2.766-0.001-5.008 2.69-5.008 6.009zM7.011 16.919c-0.83 0-1.502 0.896-1.502 2.003s0.673 2.003 1.502 2.003c0.83 0 1.502-0.896 1.502-2.003s-0.672-2.003-1.502-2.003z"/>
                            </svg>
                        </div>
                        <div class="absolute -bottom-1 -right-1 md:-bottom-2 md:-right-2 w-7 h-7 md:w-10 md:h-10 rounded-full border-2 md:border-4 border-white shadow-lg md:shadow-xl flex items-center justify-center
                            @if($pembayaran->status === 'pending') bg-blue-500
                            @elseif($pembayaran->status === 'lunas') bg-emerald-500
                            @else bg-red-500 @endif">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($pembayaran->status === 'pending')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/>
                                @elseif($pembayaran->status === 'lunas')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                @endif
                            </svg>
                        </div>
                    </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-2 mb-2 md:mb-3">
                                <h1 class="text-xl md:text-3xl lg:text-4xl font-bold gradient-text-tech truncate">
                                    Detail Pembayaran #{{ $pembayaran->id }}
                                </h1>
                                <span class="status-shimmer px-3 py-1 md:px-5 md:py-2 rounded-full text-xs md:text-sm font-bold inline-flex items-center w-fit
                                    @if($pembayaran->status === 'pending') bg-blue-100 text-blue-800
                                    @elseif($pembayaran->status === 'lunas') bg-emerald-100 text-emerald-800
                                    @else bg-red-100 text-red-800 @endif">
                                    @if($pembayaran->status === 'pending') Menunggu Konfirmasi
                                    @elseif($pembayaran->status === 'lunas') Lunas
                                    @else Dibatalkan @endif
                                </span>
                            </div>
                            <p class="text-base md:text-xl font-semibold text-slate-700 mb-2 md:mb-3 truncate">Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</p>
                            <div class="flex flex-wrap items-center gap-2 md:gap-4 text-xs md:text-sm text-slate-600">
                                <div class="flex items-center gap-1.5 md:gap-2">
                                    <svg class="w-3 h-3 md:w-4 md:h-4 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="hidden sm:inline">{{ $pembayaran->created_at->format('d M Y, H:i') }}</span>
                                    <span class="sm:hidden">{{ $pembayaran->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex items-center gap-1.5 md:gap-2">
                                    <svg class="w-3 h-3 md:w-4 md:h-4 text-cyan-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="truncate">{{ $pembayaran->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div> 

                <div class="flex flex-col sm:flex-row flex-wrap gap-2 md:gap-3">
                    @if($pembayaran->status === 'pending')
                        @if(!$pembayaran->metode)
                            <a href="#" onclick="event.preventDefault(); showPaymentModal({{ $pembayaran->peminjaman_id }}, '{{ $pembayaran->peminjaman->barang->nama_barang ?? 'N/A' }}', {{ $pembayaran->jumlah }})" 
                                class="group relative w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white text-sm font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
                                <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></div>
                                <i class="relative fas fa-dollar-sign text-sm mr-2 group-hover:scale-110 group-hover:-rotate-12 transition-transform duration-300"></i>
                                <span class="relative">Bayar Sekarang</span>
                            </a>
                        @elseif($pembayaran->metode === 'transfer' && !$pembayaran->bukti_transfer)
                            <a href="#" onclick="event.preventDefault(); showUploadModal({{ $pembayaran->id }})" 
                                class="group relative w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
                                <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></div>
                                <i class="relative fas fa-cloud-upload-alt text-sm mr-2 group-hover:scale-110 group-hover:translateY(-3px) transition-transform duration-300"></i>
                                <span class="relative">Upload Bukti</span>
                            </a>
                        @endif
                    @endif

                    @if($pembayaran->bukti_transfer)
                        <a href="{{ Storage::url($pembayaran->bukti_transfer) }}" target="_blank"
                            class="group relative w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 text-white text-sm font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
                            <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></div>
                            <i class="relative fas fa-eye text-sm mr-2 group-hover:scale-110 transition-transform duration-300"></i>
                            <span class="relative">Lihat Bukti</span>
                        </a>
                    @endif

                    <button type="button" onclick="goBack()" 
                        class="group relative w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 border-2 border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500 text-gray-700 dark:text-gray-300 text-sm font-bold rounded-lg transition-all duration-300 overflow-hidden">
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
                
                <!-- Upload Bukti Transfer Section -->
                @if($pembayaran->status === 'pending' && $pembayaran->metode === 'transfer' && !$pembayaran->bukti_transfer)
                <div class="glass-morphism rounded-2xl md:rounded-3xl shadow-xl overflow-hidden hover-lift" data-aos="fade-up">
                        <div class="gradient-primary p-6 sm:p-8 relative overflow-hidden">
                        <div class="absolute inset-0 opacity-20">
                            <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255,255,255,.1) 35px, rgba(255,255,255,.1) 70px);"></div>
                        </div>
                        
                        <div class="relative flex items-center gap-5">
                            <div class="w-16 h-16 bg-white/30 backdrop-blur-xl rounded-2xl flex items-center justify-center flex-shrink-0 shadow-xl">
                                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-white mb-2 flex items-center gap-3">
                                    Upload Bukti Transfer
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-white/25 backdrop-blur-sm text-white border border-white/30">
                                        Wajib
                                    </span>
                                </h3>
                                <p class="text-white/95 text-sm">
                                    Upload bukti pembayaran untuk menyelesaikan transaksi Anda
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 md:p-8">
                        <div class="bg-gradient-to-br from-blue-50 via-cyan-50 to-blue-50 rounded-2xl p-6 mb-8 border-2 border-blue-200/50">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 gradient-primary rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-bold text-blue-900 mb-4 text-lg">Informasi Transfer:</h4>
                                    <div class="space-y-3 text-sm">
                                        <div class="flex justify-between items-center p-4 bg-white rounded-xl shadow-sm">
                                            <span class="text-slate-600 font-medium">Bank</span>
                                            <span class="font-bold text-slate-800">BCA</span>
                                        </div>
                                        <div class="flex justify-between items-center p-4 bg-white rounded-xl shadow-sm">
                                            <span class="text-slate-600 font-medium">No. Rekening</span>
                                            <span class="font-bold text-slate-800">1234567890</span>
                                        </div>
                                        <div class="flex justify-between items-center p-4 bg-white rounded-xl shadow-sm">
                                            <span class="text-slate-600 font-medium">Atas Nama</span>
                                            <span class="font-bold text-slate-800">PT Pelita Teknologi</span>
                                        </div>
                                        <div class="flex justify-between items-center p-4 gradient-primary rounded-xl shadow-sm">
                                            <span class="text-white font-semibold">Jumlah Transfer</span>
                                            <span class="font-bold text-white text-lg">Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('pembayaran.upload-bukti', $pembayaran) }}" 
                              method="POST" 
                              enctype="multipart/form-data"
                              id="uploadBuktiForm">
                            @csrf
                            
                            <div class="relative">
                                <input type="file" 
                                       name="bukti_transfer" 
                                       id="bukti_transfer"
                                       accept=".jpg,.jpeg,.png,.pdf"
                                       required
                                       class="hidden">
                                
                                  <div id="dropZone" 
                                      class="border-3 border-dashed border-slate-300 rounded-2xl p-6 sm:p-10 text-center cursor-pointer transition-all duration-300 hover:border-blue-500 hover:bg-blue-50/30 group">
                                    <div class="w-20 h-20 sm:w-24 sm:h-24 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:scale-110 transition-transform shadow-lg">
                                        <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                    </div>
                                    
                                        <div id="uploadText">
                                        <h4 class="text-lg sm:text-xl font-bold text-slate-800 mb-3">
                                            Klik atau Drag & Drop File
                                        </h4>
                                        <p class="text-sm text-slate-600 mb-5">
                                            Upload bukti transfer Anda di sini
                                        </p>
                                        <div class="inline-flex items-center gap-3 px-4 py-2 sm:px-8 sm:py-4 gradient-primary text-white font-bold rounded-xl shadow-lg hover:shadow-2xl smooth-scale">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                            </svg>
                                            Pilih File
                                        </div>
                                    </div>

                                    <div id="filePreview" class="hidden">
                                        <div class="inline-flex items-center gap-5 bg-white rounded-xl p-5 shadow-xl">
                                            <div class="w-14 h-14 bg-gradient-to-br from-emerald-100 to-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                                <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div class="text-left flex-1">
                                                <p class="font-bold text-slate-800" id="fileName">File Name</p>
                                                <p class="text-sm text-slate-500" id="fileSize">File Size</p>
                                            </div>
                                            <button type="button" 
                                                    id="removeFile"
                                                    class="w-10 h-10 bg-red-100 hover:bg-red-200 rounded-xl flex items-center justify-center transition-colors">
                                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5 flex items-center justify-center gap-8 text-xs text-slate-600">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="font-medium">PDF, JPG, PNG</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                        <span class="font-medium">Maksimal 5 MB</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        <span class="font-medium">Aman & Terenkripsi</span>
                                    </div>
                                </div>
                            </div>

                                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                                <button type="submit" 
                                        id="submitBtn"
                                        disabled
                                        class="flex-1 inline-flex items-center justify-center px-4 py-2 sm:px-8 sm:py-4 gradient-primary text-white font-bold rounded-xl shadow-lg hover:shadow-2xl smooth-scale disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none group">
                                    <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <span>Upload Bukti Sekarang</span>
                                </button>

                                <button type="button" 
                                    onclick="document.getElementById('bukti_transfer').click()"
                                    class="sm:w-auto inline-flex items-center justify-center px-4 py-2 sm:px-6 sm:py-4 bg-white hover:bg-slate-50 text-slate-700 font-bold rounded-xl transition-all border-2 border-slate-200 hover:border-slate-300">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                    </svg>
                                    Pilih File Lain
                                </button>
                            </div>
                        </form>

                        <div class="mt-6 flex items-start gap-3 p-5 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl border-2 border-blue-200/50">
                            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <div class="text-sm text-blue-900">
                                <p class="font-bold mb-1">Keamanan Data Terjamin</p>
                                <p class="text-blue-800">Bukti transfer Anda akan dienkripsi dan disimpan dengan aman. Hanya admin yang dapat mengakses file Anda.</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Payment Information -->
                <div class="glass-morphism rounded-2xl md:rounded-3xl shadow-xl overflow-hidden hover-lift" data-aos="fade-up">
                    <div class="gradient-primary p-4 md:p-6">
                        <div class="flex items-center justify-between text-white">
                            <div class="flex items-center gap-2 md:gap-3">
                                <svg class="w-5 h-5 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <h2 class="text-base md:text-xl font-bold">Informasi Pembayaran</h2>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 md:p-8 space-y-4 md:space-y-6">
                        <!-- Amount Display -->
                        <div class="bg-gradient-to-br from-slate-50 via-blue-50 to-cyan-50 rounded-xl md:rounded-2xl p-4 md:p-6 border-2 border-blue-100">
                            <div class="flex items-center gap-3 md:gap-5">
                                <div class="w-12 h-12 md:w-16 md:h-16 gradient-primary rounded-xl md:rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg md:shadow-xl">
                                    <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-xs md:text-sm text-slate-600 mb-1 font-medium">Jumlah Pembayaran</div>
                                    <div class="text-xl md:text-2xl lg:text-3xl font-bold gradient-text-tech">Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Details -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <div class="space-y-3 md:space-y-5">
                                <div>
                                    <label class="block text-xs md:text-sm font-bold text-slate-700 mb-2 md:mb-3">Status</label>
                                        <div class="inline-flex items-center px-4 py-2.5 md:px-5 md:py-4 rounded-lg md:rounded-xl text-sm md:text-base font-bold
                                            @if($pembayaran->status === 'pending') bg-blue-100 text-blue-700 border-2 border-blue-200
                                            @elseif($pembayaran->status === 'lunas') bg-emerald-100 text-emerald-700 border-2 border-emerald-200
                                            @else bg-red-100 text-red-700 border-2 border-red-200 @endif">
                                            @if($pembayaran->status === 'pending')
                                                <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Menunggu Konfirmasi
                                            @elseif($pembayaran->status === 'lunas')
                                                <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Lunas
                                            @else
                                                <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Dibatalkan
                                            @endif
                                        </div>
                                        
                                        <!-- ALERT PEMBAYARAN DITOLAK - COMPACT LAYOUT -->
                                        @if($pembayaran->status === 'batal' && $pembayaran->metode === 'transfer' && $pembayaran->bukti_transfer)
                                        <div class="mt-4 bg-gradient-to-br from-red-50 to-orange-50 rounded-xl border-2 border-red-300 shadow-lg overflow-hidden">
                                            <!-- Header -->
                                            <div class="bg-red-600 px-4 py-2.5 flex items-center gap-2">
                                                <i class="fas fa-exclamation-triangle text-white text-base animate-pulse"></i>
                                                <h3 class="text-white font-bold text-sm md:text-base">PERHATIAN: Pembayaran Transfer Anda Ditolak!</h3>
                                            </div>
                                            
                                            <!-- Content -->
                                            <div class="p-4 space-y-3">
                                                <!-- Status Info -->
                                                <div class="bg-white rounded-lg p-3 border-2 border-red-200">
                                                    <p class="text-xs md:text-sm text-gray-800 leading-relaxed">
                                                        <strong class="text-red-700">Status:</strong> Pembayaran transfer Anda dengan nominal 
                                                        <strong class="text-red-700">Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</strong> 
                                                        telah ditolak oleh admin. Bukti transfer yang Anda upload tidak dapat diverifikasi atau terdapat kesalahan dalam proses pembayaran.
                                                    </p>
                                                </div>
                                                
                                                <!-- Langkah-Langkah -->
                                                <div class="bg-yellow-50 rounded-lg p-3 border-2 border-yellow-400">
                                                    <div class="flex items-center gap-2 mb-2">
                                                        <i class="fas fa-list-ol text-yellow-700"></i>
                                                        <h4 class="font-bold text-yellow-900 text-xs md:text-sm">LANGKAH YANG HARUS ANDA LAKUKAN:</h4>
                                                    </div>
                                                    
                                                    <ol class="space-y-2 ml-1 text-xs">
                                                        <li class="flex items-start gap-2">
                                                            <span class="flex-shrink-0 w-5 h-5 bg-yellow-500 text-white rounded-full flex items-center justify-center font-bold text-xs">1</span>
                                                            <div>
                                                                <p class="font-bold text-yellow-900">Hubungi Admin SEGERA</p>
                                                                <p class="text-yellow-800 text-[10px]">Tanyakan alasan detail mengapa pembayaran Anda ditolak</p>
                                                            </div>
                                                        </li>
                                                        <li class="flex items-start gap-2">
                                                            <span class="flex-shrink-0 w-5 h-5 bg-yellow-500 text-white rounded-full flex items-center justify-center font-bold text-xs">2</span>
                                                            <div>
                                                                <p class="font-bold text-yellow-900">Konfirmasi Metode Pembayaran</p>
                                                                <p class="text-yellow-800 text-[10px]">Tanyakan apakah perlu upload ulang bukti transfer atau menggunakan metode pembayaran lain</p>
                                                            </div>
                                                        </li>
                                                        <li class="flex items-start gap-2">
                                                            <span class="flex-shrink-0 w-5 h-5 bg-yellow-500 text-white rounded-full flex items-center justify-center font-bold text-xs">3</span>
                                                            <div>
                                                                <p class="font-bold text-yellow-900">Dapatkan Instruksi yang Benar</p>
                                                                <p class="text-yellow-800 text-[10px]">Minta admin memberikan instruksi pembayaran yang tepat dan valid</p>
                                                            </div>
                                                        </li>
                                                        <li class="flex items-start gap-2">
                                                            <span class="flex-shrink-0 w-5 h-5 bg-yellow-500 text-white rounded-full flex items-center justify-center font-bold text-xs">4</span>
                                                            <div>
                                                                <p class="font-bold text-yellow-900">JANGAN Bayar Ulang Dulu</p>
                                                                <p class="text-yellow-800 text-[10px]">Tunggu konfirmasi dan instruksi dari admin sebelum melakukan pembayaran ulang untuk menghindari pembayaran ganda</p>
                                                            </div>
                                                        </li>
                                                    </ol>
                                                </div>
                                                
                                                <!-- Tombol Kontak -->
                                                <div>
                                                    <div class="flex items-center gap-2 mb-2">
                                                        <i class="fas fa-phone-volume text-red-600 text-sm"></i>
                                                        <p class="text-xs md:text-sm font-bold text-red-900">HUBUNGI ADMIN SEKARANG JUGA:</p>
                                                    </div>
                                                    
                                                    <div class="flex flex-col sm:flex-row gap-2 mb-2">
                                                        <a href="https://wa.me/6285163587878?text=Halo%20Admin%20Pelita%2C%0A%0ASaya%20ingin%20menanyakan%20tentang%20pembayaran%20transfer%20yang%20ditolak%3A%0A%0A%F0%9F%93%8B%20INFORMASI%20PEMBAYARAN%3A%0A%E2%9C%85%20ID%20Pembayaran%3A%20{{ $pembayaran->id }}%0A%E2%9C%85%20ID%20Peminjaman%3A%20{{ $pembayaran->peminjaman_id }}%0A%E2%9C%85%20Jumlah%20Pembayaran%3A%20Rp%20{{ number_format($pembayaran->jumlah, 0, ',', '.') }}%0A%E2%9C%85%20Tanggal%20Upload%20Bukti%3A%20{{ $pembayaran->tanggal_bayar ? \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d M Y, H:i') : '-' }}%0A%E2%9C%85%20Metode%3A%20Transfer%20Bank%0A%0A%E2%9D%93%20PERTANYAAN%3A%0A1.%20Apa%20alasan%20pembayaran%20saya%20ditolak%3F%0A2.%20Apakah%20saya%20perlu%20upload%20ulang%20bukti%20transfer%3F%0A3.%20Atau%20ada%20cara%20pembayaran%20lain%20yang%20bisa%20saya%20gunakan%3F%0A%0AMohon%20penjelasan%20dan%20instruksi%20selanjutnya.%0A%0ATerima%20kasih%20%F0%9F%99%8F" 
                                                        target="_blank"
                                                        class="group relative flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 md:px-4 md:py-2.5 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white text-xs md:text-sm font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
                                                            <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></div>
                                                            <i class="relative fab fa-whatsapp text-sm md:text-base group-hover:scale-110 transition-transform duration-300"></i>
                                                            <span class="relative">WhatsApp</span>
                                                        </a>
                                                        
                                                        <a href="mailto:Cimahi.technopark@gmail.com?subject=URGENT%20-%20Pembayaran%20Ditolak%20(ID%3A%20{{ $pembayaran->id }})&body=Yth.%20Admin%20Pelita%2C%0A%0ASaya%20ingin%20menanyakan%20tentang%20pembayaran%20transfer%20yang%20ditolak%3A%0A%0AINFORMASI%20PEMBAYARAN%3A%0AID%20Pembayaran%3A%20{{ $pembayaran->id }}%0AID%20Peminjaman%3A%20{{ $pembayaran->peminjaman_id }}%0AJumlah%20Pembayaran%3A%20Rp%20{{ number_format($pembayaran->jumlah, 0, ',', '.') }}%0ATanggal%20Upload%20Bukti%3A%20{{ $pembayaran->tanggal_bayar ? \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d M Y, H:i') : '-' }}%0AMetode%3A%20Transfer%20Bank%0A%0APERTANYAAN%3A%0A1.%20Apa%20alasan%20pembayaran%20saya%20ditolak%3F%0A2.%20Apakah%20saya%20perlu%20upload%20ulang%20bukti%20transfer%3F%0A3.%20Atau%20ada%20cara%20pembayaran%20lain%20yang%20bisa%20saya%20gunakan%3F%0A%0AMohon%20penjelasan%20dan%20instruksi%20selanjutnya.%0A%0ATerima%20kasih." 
                                                        class="group relative flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 md:px-4 md:py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-xs md:text-sm font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
                                                            <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></div>
                                                            <i class="relative fas fa-envelope text-sm md:text-base group-hover:scale-110 transition-transform duration-300"></i>
                                                            <span class="relative">Email</span>
                                                        </a>
                                                    </div>
                                                    
                                                    <!-- Info Kontak -->
                                                    <div class="bg-white rounded-lg p-2.5 border border-gray-200">
                                                        <p class="text-[10px] md:text-xs font-bold text-gray-700 mb-1.5">📞 Kontak Admin:</p>
                                                        <div class="space-y-1">
                                                            <div class="flex items-center justify-between text-[10px] md:text-xs">
                                                                <span class="text-gray-600">Telp/WA:</span>
                                                                <a href="tel:+6285163587878" class="font-bold text-green-600 hover:underline">+62 851-6358-7878</a>
                                                            </div>
                                                            <div class="flex items-center justify-between text-[10px] md:text-xs">
                                                                <span class="text-gray-600">Email:</span>
                                                                <span class="font-bold text-gray-800 truncate ml-2 max-w-[180px]">Cimahi.technopark@gmail.com</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Warning Footer -->
                                                <div class="flex items-start gap-2 p-2.5 bg-red-100 rounded-lg border border-red-300">
                                                    <i class="fas fa-shield-alt text-red-600 text-sm mt-0.5 flex-shrink-0"></i>
                                                    <p class="text-xs text-red-800">
                                                        <strong>⚠️ PERINGATAN:</strong> JANGAN melakukan pembayaran ulang sebelum mendapat konfirmasi dan instruksi yang jelas dari admin untuk menghindari pembayaran ganda.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                </div>
                                
                                <div>
                                    <label class="block text-xs md:text-sm font-bold text-slate-700 mb-2 md:mb-3">Dibuat</label>
                                    <div class="flex items-center p-3 md:p-4 bg-slate-50 rounded-lg md:rounded-xl border-2 border-slate-200">
                                        <svg class="w-5 h-5 md:w-6 md:h-6 mr-2 md:mr-3 text-slate-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="font-bold text-slate-800 text-sm md:text-base">{{ $pembayaran->created_at->format('d M Y, H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
                                {{ $pembayaran->peminjaman->permohonan->items->count() }} items
                            </span>
                        </div>
                    </div>

                    <div class="p-4 md:p-8 space-y-3 md:space-y-4">
                        @foreach($pembayaran->peminjaman->permohonan->items as $detail)
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
                                                {{ $detail->barang->kategoriBarang->nama_kategori ?? 'N/A' }}
                                            </span>
                                            <span class="inline-flex items-center px-2 py-0.5 md:px-3 md:py-1 rounded-full text-[10px] md:text-xs font-bold bg-emerald-100 text-emerald-800">
                                                {{ $detail->barang->kondisi ?? 'N/A' }}
                                            </span>
                                        </div>
                                        <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-4 text-xs md:text-sm text-slate-600">
                                            @if($detail->barang->harga_sewa > 0)
                                                <span class="font-bold text-blue-600">
                                                    Rp {{ number_format($detail->barang->harga_sewa, 0, ',', '.') }}/hari
                                                </span>
                                            @else
                                                <span class="font-bold text-emerald-600">GRATIS</span>
                                            @endif
                                            <span class="text-slate-400 hidden sm:inline">•</span>
                                            <span class="font-medium">Quantity: <strong class="text-slate-800">{{ $detail->jumlah }}</strong></span>
                                        </div>
                                    </div>

                                    <div class="text-right flex-shrink-0 hidden sm:block">
                                        @php
                                            // Hitung subtotal per item
                                            $durasi = \Carbon\Carbon::parse($pembayaran->peminjaman->tanggal_mulai)
                                                ->diffInDays(\Carbon\Carbon::parse($pembayaran->peminjaman->tanggal_selesai)) + 1;
                                            $subtotal = $detail->barang->harga_sewa * $detail->jumlah * $durasi;
                                        @endphp
                                        
                                        @if($subtotal > 0)
                                            <div class="text-[10px] md:text-xs text-slate-500 mb-0.5 md:mb-1 font-medium">Subtotal</div>
                                            <div class="text-base md:text-xl font-bold text-slate-800">
                                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                                            </div>
                                            <div class="text-[9px] md:text-xs text-slate-500">{{ $durasi }} hari</div>
                                        @else
                                            <div class="text-sm md:text-lg font-bold text-emerald-600">GRATIS</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- TAMBAHKAN INI - Quick Rental Period Info -->
                        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-4 border-2 border-indigo-100 mb-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-sm font-bold text-indigo-900">Periode Sewa</span>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-indigo-600 font-medium">
                                        {{ \Carbon\Carbon::parse($pembayaran->peminjaman->tanggal_mulai)->format('d M') }} - 
                                        {{ \Carbon\Carbon::parse($pembayaran->peminjaman->tanggal_selesai)->format('d M Y') }}
                                    </p>
                                    <a href="{{ route('peminjaman.show', $pembayaran->peminjaman) }}" 
                                    class="text-xs text-indigo-600 hover:text-indigo-800 font-bold underline">
                                        Lihat Detail →
                                    </a>
                                </div>
                            </div>
                        </div>    

                        <!-- Total Section -->
                        <div class="border-t-2 border-slate-200 pt-6 md:pt-8 mt-6 md:mt-8">
                            <div class="bg-gradient-to-br from-blue-50 via-cyan-50 to-blue-50 rounded-xl md:rounded-2xl p-4 md:p-6 border-2 border-blue-100">
                                <div class="flex items-center justify-between mb-3 md:mb-4">
                                    <span class="text-slate-700 font-bold text-sm md:text-lg">Durasi Peminjaman</span>
                                    <span class="text-xl md:text-2xl font-bold text-blue-600">
                                        {{ \Carbon\Carbon::parse($pembayaran->peminjaman->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($pembayaran->peminjaman->tanggal_selesai)) + 1 }} hari
                                    </span>
                                </div>
                                <div class="flex items-center justify-between pt-3 md:pt-4 border-t-2 border-blue-200">
                                    <span class="text-slate-700 font-bold text-sm md:text-lg">Total Biaya</span>
                                    @if($pembayaran->jumlah > 0)
                                        <span class="text-2xl md:text-3xl font-bold gradient-text-tech">
                                            Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="text-2xl md:text-3xl font-bold text-emerald-600">GRATIS</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="space-y-6">
                
                <!-- Timeline -->
                <div class="glass-morphism rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 hover-lift" data-aos="fade-left">
                    <h3 class="text-base md:text-lg font-bold text-slate-800 mb-4 md:mb-6 flex items-center gap-2">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Timeline
                    </h3>
                    
                    <div class="space-y-4 md:space-y-6">
                        <div class="timeline-connector flex items-start gap-3 md:gap-4">
                            <div class="w-8 h-8 md:w-10 md:h-10 gradient-primary rounded-full flex items-center justify-center flex-shrink-0 shadow-md md:shadow-lg">
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm md:text-base">Pembayaran Dibuat</h4>
                                <p class="text-[10px] md:text-xs text-slate-500 mt-0.5 md:mt-1">{{ $pembayaran->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        
                        @if($pembayaran->tanggal_bayar)
                        <div class="timeline-connector flex items-start gap-3 md:gap-4">
                            <div class="w-8 h-8 md:w-10 md:h-10 bg-gradient-to-br from-amber-500 to-orange-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-md md:shadow-lg">
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm md:text-base">
                                    @if($pembayaran->metode === 'cash')
                                        Pembayaran Cash
                                    @else
                                        Bukti Transfer Diupload
                                    @endif
                                </h4>
                                <p class="text-[10px] md:text-xs text-slate-500 mt-0.5 md:mt-1">{{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        @endif
                        
                        @if($pembayaran->status === 'lunas')
                        <div class="timeline-connector flex items-start gap-3 md:gap-4">
                            <div class="w-8 h-8 md:w-10 md:h-10 bg-gradient-to-br from-emerald-500 to-green-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-md md:shadow-lg">
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm md:text-base">Pembayaran Lunas</h4>
                                <p class="text-[10px] md:text-xs text-slate-500 mt-0.5 md:mt-1">{{ $pembayaran->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        @elseif($pembayaran->status === 'batal')
                        <div class="timeline-connector flex items-start gap-3 md:gap-4">
                            <div class="w-8 h-8 md:w-10 md:h-10 bg-gradient-to-br from-red-500 to-pink-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-md md:shadow-lg">
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-red-800 text-sm md:text-base">Pembayaran Ditolak</h4>
                                <p class="text-[10px] md:text-xs text-slate-500 mt-0.5 md:mt-1">{{ $pembayaran->updated_at->format('d M Y, H:i') }}</p>
                                <p class="text-[10px] md:text-xs text-red-600 mt-1 font-medium">Silakan hubungi admin</p>
                            </div>
                        </div>
                        @elseif($pembayaran->status === 'pending')
                        <div class="timeline-connector flex items-start gap-3 md:gap-4">
                            <div class="w-8 h-8 md:w-10 md:h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-md md:shadow-lg pulse-ring">
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-blue-800 text-sm md:text-base">Menunggu Konfirmasi</h4>
                                <p class="text-[10px] md:text-xs text-slate-500 mt-0.5 md:mt-1">Sedang diproses oleh admin</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Bukti Transfer Preview -->
                @if($pembayaran->bukti_transfer)
                <div class="glass-morphism rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 hover-lift" data-aos="fade-left">
                    <h3 class="text-base md:text-lg font-bold text-slate-800 mb-3 md:mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Bukti Transfer
                    </h3>
                    
                    <div class="text-center">
                        @php
                            $fileExtension = pathinfo($pembayaran->bukti_transfer, PATHINFO_EXTENSION);
                            $isImage = in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png']);
                        @endphp
                        
                        @if($isImage)
                            <div class="relative group">
                                <img src="{{ Storage::url($pembayaran->bukti_transfer) }}" 
                                    alt="Bukti Transfer" 
                                    class="w-full rounded-lg md:rounded-xl shadow-lg cursor-pointer hover:shadow-2xl transition-all"
                                    onclick="showImageModal('{{ Storage::url($pembayaran->bukti_transfer) }}')">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 rounded-lg md:rounded-xl transition-all duration-300 flex items-center justify-center">
                                    <svg class="w-10 h-10 md:w-12 md:h-12 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        @else
                            <div class="flex flex-col items-center p-4 md:p-6 lg:p-8 bg-gradient-to-br from-red-50 to-pink-50 rounded-lg md:rounded-xl border-2 border-red-200">
                                <svg class="w-16 h-16 md:w-20 md:h-20 text-red-600 mb-3 md:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-slate-700 font-bold text-sm md:text-base mb-3 md:mb-4">File PDF</p>
                                <a href="{{ Storage::url($pembayaran->bukti_transfer) }}" 
                                target="_blank" 
                                class="inline-flex items-center px-4 py-2 md:px-6 md:py-3 gradient-primary text-white text-sm md:text-base font-bold rounded-lg md:rounded-xl shadow-lg hover:shadow-2xl smooth-scale">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Download
                                </a>
                            </div>
                        @endif
                        
                        <div class="mt-3 md:mt-4 text-[10px] md:text-xs text-slate-500 font-medium">
                            Diupload: {{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d M Y, H:i') }}
                        </div>
                    </div>
                </div>
                @endif

                <!-- Quick Actions -->
                @if($pembayaran->status === 'pending')
                <div class="glass-morphism rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 hover-lift" data-aos="fade-left">
                    <h3 class="text-base md:text-lg font-bold text-slate-800 mb-3 md:mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Aksi Cepat
                    </h3>
                    
                    <div class="space-y-3">
                        @if(!$pembayaran->metode)
                            <button onclick="showPaymentModal({{ $pembayaran->peminjaman_id }}, '{{ $pembayaran->peminjaman->barang->nama_barang ?? 'N/A' }}', {{ $pembayaran->jumlah }})" 
                                class="group relative w-full inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white text-sm font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
                                <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></div>
                                <i class="relative fas fa-dollar-sign text-sm mr-2 group-hover:scale-110 group-hover:-rotate-12 transition-transform duration-300"></i>
                                <span class="relative">Bayar Sekarang</span>
                            </button>
                        @elseif($pembayaran->metode === 'transfer' && !$pembayaran->bukti_transfer)
                            <button onclick="showUploadModal({{ $pembayaran->id }})" 
                                class="group relative w-full inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
                                <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></div>
                                <i class="relative fas fa-cloud-upload-alt text-sm mr-2 group-hover:scale-110 group-hover:translateY(-3px) transition-transform duration-300"></i>
                                <span class="relative">Upload Bukti Transfer</span>
                            </button>
                        @endif
                        
                        @if($pembayaran->metode === 'transfer' && $pembayaran->bukti_transfer)
                            <div class="p-3 md:p-4 bg-blue-50 border-2 border-blue-200 rounded-lg md:rounded-xl">
                                <div class="flex items-center">
                                    <i class="fas fa-clock mr-2 text-blue-600 flex-shrink-0"></i>
                                    <span class="text-xs md:text-sm text-blue-700 font-bold">Menunggu konfirmasi admin</span>
                                </div>
                            </div>
                        @endif
                        
                        <a href="{{ route('peminjaman.show', $pembayaran->peminjaman) }}" 
                            class="group relative w-full inline-flex items-center justify-center px-5 py-3 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 border-2 border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500 text-gray-700 dark:text-gray-300 text-sm font-bold rounded-lg transition-all duration-300 overflow-hidden">
                            <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-blue-500/5 to-indigo-500/5 dark:from-blue-600/10 dark:to-indigo-600/10 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                            <i class="relative fas fa-file-alt text-sm mr-2 text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 group-hover:rotate-12 transition-all duration-300"></i>
                            <span class="relative">Lihat Detail Peminjaman</span>
                        </a>
                    </div>
                </div>
                @endif

                <!-- Payment Methods Info -->
                <div class="glass-morphism rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 hover-lift" data-aos="fade-left">
                    <h3 class="text-base md:text-lg font-bold text-slate-800 mb-3 md:mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        Informasi Rekening
                    </h3>
                    
                    <div class="space-y-3">
                        <div class="p-4 md:p-5 bg-gradient-to-br from-blue-50 via-cyan-50 to-blue-50 rounded-lg md:rounded-xl border-2 border-blue-200/70">
                            <div class="flex items-center gap-3 md:gap-4 mb-2 md:mb-3">
                                <div class="w-10 h-10 md:w-12 md:h-12 gradient-primary rounded-lg md:rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-blue-900 text-base md:text-lg">Bank BCA</div>
                                    <div class="text-[10px] md:text-xs text-blue-600 font-medium">Transfer Bank</div>
                                </div>
                            </div>
                            <div class="space-y-2 text-xs md:text-sm">
                                <div class="flex justify-between items-center p-2.5 md:p-3 bg-white rounded-lg shadow-sm">
                                    <span class="text-slate-600 font-medium">No. Rekening:</span>
                                    <span class="font-bold text-slate-800">1234567890</span>
                                </div>
                                <div class="flex justify-between items-center p-2.5 md:p-3 bg-white rounded-lg shadow-sm">
                                    <span class="text-slate-600 font-medium">Atas Nama:</span>
                                    <span class="font-bold text-slate-800">PT Pelita Teknologi</span>
                                </div>
                            </div>
                        </div>
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
                        <p class="text-sm text-slate-600 mb-5 font-medium">Hubungi admin jika ada pertanyaan tentang pembayaran</p>
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

<!-- Payment Modal -->
<div id="paymentModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-slate-900 bg-opacity-75 backdrop-blur-sm" onclick="closePaymentModal()"></div>

        <div class="inline-block w-full max-w-md p-6 sm:p-8 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-3xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-slate-800">Proses Pembayaran</h3>
                <button onclick="closePaymentModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="mb-6 p-5 bg-gradient-to-br from-slate-50 to-blue-50 rounded-xl border-2 border-blue-100">
                <div class="text-sm text-slate-600 mb-2 font-medium">Pembayaran untuk:</div>
                <div class="font-bold text-slate-800 text-lg" id="modalAssetName"></div>
                <div class="text-2xl font-bold gradient-text-tech mt-3" id="modalAmount"></div>
            </div>

            <form id="paymentForm" method="POST" action="{{ route('pembayaran.bayar', $pembayaran->peminjaman) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label class="block text-sm font-bold text-slate-700 mb-3">Metode Pembayaran</label>
                    <div class="space-y-3">
                        <label class="flex items-center cursor-pointer p-4 border-2 border-slate-200 rounded-xl hover:bg-slate-50 hover:border-emerald-300 transition-all">
                            <input type="radio" name="metode" value="cash" class="mr-3 w-5 h-5 text-emerald-600">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 mr-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span class="font-bold">Cash (Tunai)</span>
                            </div>
                        </label>
                        <label class="flex items-center cursor-pointer p-4 border-2 border-slate-200 rounded-xl hover:bg-slate-50 hover:border-blue-300 transition-all">
                            <input type="radio" name="metode" value="transfer" class="mr-3 w-5 h-5 text-blue-600">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                <span class="font-bold">Transfer Bank</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div id="uploadField" class="mb-6 hidden">
                    <label class="block text-sm font-bold text-slate-700 mb-3">Bukti Transfer</label>
                    <input type="file" name="bukti_transfer" accept=".jpg,.jpeg,.png,.pdf" 
                           class="w-full px-4 py-3 border-2 border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <p class="text-xs text-slate-500 mt-2 font-medium">Format: JPG, PNG, PDF (Max: 2MB)</p>
                    
                    <div class="mt-4 p-4 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl border-2 border-blue-200">
                        <div class="text-sm font-bold text-blue-800 mb-2">Informasi Transfer:</div>
                        <div class="space-y-1 text-xs text-blue-700 font-medium">
                            <div>Bank BCA: 1234567890</div>
                            <div>a/n PT Pelita Teknologi</div>
                        </div>
                    </div>
                </div>

                <div class="flex space-x-4">
                    <button type="button" onclick="closePaymentModal()" 
                            class="flex-1 px-5 py-3 text-slate-600 bg-slate-100 hover:bg-slate-200 font-bold rounded-xl transition-all">
                        Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 px-5 py-3 bg-gradient-to-r from-emerald-600 to-green-600 text-white font-bold rounded-xl hover:shadow-lg smooth-scale">
                        Proses Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div id="uploadModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-slate-900 bg-opacity-75 backdrop-blur-sm" onclick="closeUploadModal()"></div>

        <div class="inline-block w-full max-w-md p-6 sm:p-8 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-3xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-slate-800">Upload Bukti Transfer</h3>
                <button onclick="closeUploadModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="uploadForm" method="POST" action="{{ route('pembayaran.upload-bukti', $pembayaran) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-bold text-slate-700 mb-3">Pilih File Bukti Transfer</label>
                    <input type="file" name="bukti_transfer" accept=".jpg,.jpeg,.png,.pdf" required
                           class="w-full px-4 py-3 border-2 border-slate-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    <p class="text-xs text-slate-500 mt-2 font-medium">Format: JPG, PNG, PDF (Max: 2MB)</p>
                    
                    <div class="mt-4 p-4 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl border-2 border-blue-200">
                        <div class="text-sm font-bold text-blue-800 mb-2">Informasi Transfer:</div>
                        <div class="space-y-1 text-xs text-blue-700 font-medium">
                            <div>Bank BCA: 1234567890</div>
                            <div>a/n PT Pelita Teknologi</div>
                            <div class="font-bold text-blue-800">Jumlah: Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <div class="flex space-x-4">
                    <button type="button" onclick="closeUploadModal()" 
                            class="flex-1 px-5 py-3 text-slate-600 bg-slate-100 hover:bg-slate-200 font-bold rounded-xl transition-all">
                        Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 px-5 py-3 gradient-primary text-white font-bold rounded-xl hover:shadow-lg smooth-scale">
                        Upload
                    </button>
                </div>
            </form>
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
    offset: 50,
    
});

document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('bukti_transfer');
    const dropZone = document.getElementById('dropZone');
    const uploadText = document.getElementById('uploadText');
    const filePreview = document.getElementById('filePreview');
    const submitBtn = document.getElementById('submitBtn');
    const uploadForm = document.getElementById('uploadBuktiForm');
    const removeFileBtn = document.getElementById('removeFile');

    if (!fileInput || !dropZone) return;

    // Click to upload
    dropZone.addEventListener('click', function(e) {
        if (e.target.id !== 'removeFile' && !e.target.closest('#removeFile')) {
            fileInput.click();
        }
    });

    // Drag and drop handlers
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, function() {
            dropZone.classList.add('drag-active');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, function() {
            dropZone.classList.remove('drag-active');
        });
    });

    dropZone.addEventListener('drop', function(e) {
        const files = e.dataTransfer.files;
        if (files.length) {
            fileInput.files = files;
            handleFile(files[0]);
        }
    });

    fileInput.addEventListener('change', function(e) {
        if (this.files.length) {
            handleFile(this.files[0]);
        }
    });

    function handleFile(file) {
        const allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
        if (!allowedTypes.includes(file.type)) {
            showNotification('Tipe file tidak valid. Gunakan PDF, JPG, JPEG, atau PNG', 'error');
            return;
        }

        const maxSize = 5 * 1024 * 1024;
        if (file.size > maxSize) {
            showNotification('Ukuran file terlalu besar. Maksimal 5MB', 'error');
            return;
        }

        document.getElementById('fileName').textContent = file.name;
        document.getElementById('fileSize').textContent = formatFileSize(file.size);
        
        uploadText.classList.add('hidden');
        filePreview.classList.remove('hidden');
        dropZone.classList.add('has-file');
        submitBtn.disabled = false;

        showNotification('File berhasil dipilih!', 'success');
    }

    if (removeFileBtn) {
        removeFileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            fileInput.value = '';
            uploadText.classList.remove('hidden');
            filePreview.classList.add('hidden');
            dropZone.classList.remove('has-file');
            submitBtn.disabled = true;
        });
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
    }

    if (uploadForm) {
        uploadForm.addEventListener('submit', function(e) {
            if (!fileInput.files || fileInput.files.length === 0) {
                e.preventDefault();
                showNotification('Silakan pilih file terlebih dahulu', 'error');
                return false;
            }

            const loadingSpinner = document.getElementById('loadingSpinner');
            loadingSpinner.classList.add('active');
            submitBtn.disabled = true;
        });
    }

    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 px-4 py-3 sm:px-6 sm:py-4 rounded-xl shadow-2xl transform transition-all duration-300 translate-x-0 ${
            type === 'success' ? 'bg-emerald-500' : 
            type === 'error' ? 'bg-red-500' : 
            'bg-blue-500'
        } text-white font-bold flex items-center gap-3`;
        
        notification.innerHTML = `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${type === 'success' ? 
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>' :
                    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>'
                }
            </svg>
            <span>${message}</span>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 10);
        
        setTimeout(() => {
            notification.style.transform = 'translateX(400px)';
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }

    // Fade slide up animation on scroll
    const fadeElements = document.querySelectorAll('.fade-slide-up');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    fadeElements.forEach(el => observer.observe(el));
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

// Payment Modal Functions
function showPaymentModal(peminjamanId, assetName, amount) {
    const modal = document.getElementById('paymentModal');
    document.getElementById('modalAssetName').textContent = assetName;
    document.getElementById('modalAmount').textContent = 'Rp ' + amount.toLocaleString('id-ID');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closePaymentModal() {
    const modal = document.getElementById('paymentModal');
    modal.classList.add('hidden');
    document.body.style.overflow = '';
}

function showUploadModal(pembayaranId) {
    const modal = document.getElementById('uploadModal');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeUploadModal() {
    const modal = document.getElementById('uploadModal');
    modal.classList.add('hidden');
    document.body.style.overflow = '';
}

// Radio button handler for payment method
document.addEventListener('DOMContentLoaded', function() {
    const paymentForm = document.getElementById('paymentForm');
    if (paymentForm) {
        const radioButtons = paymentForm.querySelectorAll('input[name="metode"]');
        const uploadField = document.getElementById('uploadField');
        
        radioButtons.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'transfer') {
                    uploadField.classList.remove('hidden');
                } else {
                    uploadField.classList.add('hidden');
                }
            });
        });
    }
});

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