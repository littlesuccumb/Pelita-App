@extends('layouts.user')

@section('title', 'Detail Permohonan - Pelita App')

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

    .tech-pattern {
        background-image: 
            linear-gradient(to right, rgba(59, 130, 246, 0.03) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(59, 130, 246, 0.03) 1px, transparent 1px);
        background-size: 40px 40px;
    }

    body {
        overflow-x: hidden;
    }

    .loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .loading-overlay.active {
        display: flex;
    }

    .loading-content {
        background: white;
        padding: 2rem 3rem;
        border-radius: 1.5rem;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .loading-text {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .loading-subtext {
        font-size: 0.875rem;
        color: #64748b;
    }

    .upload-progress {
        width: 100%;
        height: 4px;
        background: #e5e7eb;
        border-radius: 2px;
        overflow: hidden;
        margin-top: 1rem;
    }

    .upload-progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #6366f1, #8b5cf6);
        width: 0%;
        animation: progress 2s ease-in-out infinite;
    }

    @keyframes progress {
        0% { width: 0%; }
        50% { width: 70%; }
        100% { width: 100%; }
    }

    .upload-step {
        opacity: 0.4;
        transition: all 0.3s ease;
    }

    .upload-step.active {
        opacity: 1;
    }

    .upload-step.active .w-6 {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    }

    .upload-step.active svg {
        color: white;
    }

    .upload-step.completed .w-6 {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .upload-step.completed svg {
        color: white;
    }

    #dropZone.drag-over {
        border-color: #3b82f6;
        background-color: rgba(59, 130, 246, 0.05);
        transform: scale(1.02);
    }

    #dropZone.has-file {
        border-color: #10b981;
        background-color: rgba(16, 185, 129, 0.05);
    }
    /* Toast Notification Animation */
.toast-notification {
    transform: translateX(400px);
    opacity: 0;
}

@keyframes slideInRight {
    from {
        transform: translateX(400px);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOutRight {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(400px);
        opacity: 0;
    }
}

</style>
@endpush

@section('content')
<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-content">
        <div class="relative w-24 h-24 mx-auto mb-6">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full animate-ping opacity-75"></div>
            <div class="relative w-24 h-24 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center shadow-2xl">
                <svg class="w-12 h-12 text-white animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
            </div>
        </div>

        <div class="loading-text mb-2">Memproses Upload</div>
        <div class="loading-subtext mb-6">Mohon tunggu, jangan tutup halaman ini...</div>
        
        <div class="upload-progress mb-4">
            <div class="upload-progress-bar"></div>
        </div>

        <div class="text-left max-w-md mx-auto space-y-2 text-sm text-slate-600">
            <div class="flex items-center gap-3 upload-step" id="step1">
                <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <span>Validasi file...</span>
            </div>
            <div class="flex items-center gap-3 upload-step" id="step2">
                <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <span>Mengupload dokumen...</span>
            </div>
            <div class="flex items-center gap-3 upload-step" id="step3">
                <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <span>Menyimpan data...</span>
            </div>
        </div>
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
            <a href="{{ route('permohonan.index') }}" class="text-slate-500 hover:text-blue-600 transition-colors">Permohonan</a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-blue-600 font-semibold">{{ $permohonan->no_permohonan }}</span>
        </nav>

        <!-- Header Card -->
        <div class="glass-morphism rounded-2xl md:rounded-3xl shadow-xl p-4 md:p-8 mb-6 md:mb-8 hover-lift" data-aos="fade-up">
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 md:gap-6">
                <div class="flex items-start gap-3 md:gap-6">
                    <div class="relative flex-shrink-0 floating-animation">
                        <div class="w-16 h-16 md:w-24 md:h-24 rounded-xl md:rounded-2xl 
                            @if($permohonan->status === 'Dalam Proses') bg-gradient-to-br from-orange-500 to-amber-600
                            @elseif($permohonan->status === 'Disetujui') bg-gradient-to-br from-emerald-500 to-green-600
                            @else bg-gradient-to-br from-red-500 to-pink-600 @endif 
                            flex items-center justify-center shadow-xl md:shadow-2xl">
                            <svg class="w-8 h-8 md:w-12 md:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="absolute -bottom-1 -right-1 md:-bottom-2 md:-right-2 w-7 h-7 md:w-10 md:h-10 rounded-full border-2 md:border-4 border-white shadow-lg md:shadow-xl flex items-center justify-center
                            @if($permohonan->status === 'Dalam Proses') bg-orange-500
                            @elseif($permohonan->status === 'Disetujui') bg-emerald-500
                            @else bg-red-500 @endif">
                            <svg class="w-3 h-3 md:w-5 md:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($permohonan->status === 'Dalam Proses')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/>
                                @elseif($permohonan->status === 'Disetujui')
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
                                {{ $permohonan->no_permohonan }}
                            </h1>
                            <span class="status-shimmer px-3 py-1 md:px-5 md:py-2 rounded-full text-xs md:text-sm font-bold inline-flex items-center w-fit
                                @if($permohonan->status === 'Dalam Proses') bg-orange-100 text-orange-800
                                @elseif($permohonan->status === 'Disetujui') bg-emerald-100 text-emerald-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $permohonan->status }}
                            </span>
                        </div>
                        <p class="text-base md:text-xl font-semibold text-slate-700 mb-2 md:mb-3 truncate">{{ $permohonan->nama_pemohon }}</p>
                        <div class="flex flex-wrap items-center gap-2 md:gap-4 text-xs md:text-sm text-slate-600">
                            <div class="flex items-center gap-1.5 md:gap-2">
                                <svg class="w-3 h-3 md:w-4 md:h-4 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="hidden sm:inline">{{ $permohonan->created_at->format('d M Y, H:i') }}</span>
                                <span class="sm:hidden">{{ $permohonan->created_at->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex items-center gap-1.5 md:gap-2">
                                <svg class="w-3 h-3 md:w-4 md:h-4 text-cyan-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="truncate">{{ $permohonan->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center gap-1.5 md:gap-2">
                                <svg class="w-3 h-3 md:w-4 md:h-4 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                <span>{{ $permohonan->items->count() }} items</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                    @if($permohonan->status === 'Dalam Proses')
                        @if(!$permohonan->surat_permohonan)
                            <a href="{{ route('permohonan.edit', $permohonan) }}" 
                            class="group relative inline-flex items-center justify-center px-5 py-3 gradient-primary text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
                                <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
                                    <i class="relative fas fa-edit text-sm mr-2 group-hover:scale-110 group-hover:rotate-12 transition-transform duration-300"></i>
                                <span class="relative">Edit Permohonan</span>
                            </a>
                            
                            @if($permohonan->draft_surat)
                                <a href="{{ route('permohonan.downloadDraft', $permohonan) }}" 
                                class="group relative inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-emerald-500 to-green-600 text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
                                    <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
                                        <i class="relative fas fa-download text-sm mr-2 group-hover:scale-110 group-hover:translate-y-1 transition-transform duration-300"></i>
                                    <span class="relative">Unduh Draft Surat</span>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('permohonan.viewSuratTtd', $permohonan) }}" 
                            target="_blank"
                            rel="noopener noreferrer"
                            class="group relative inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-purple-500 to-pink-600 text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
                                <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
                                    <i class="relative fas fa-file-alt text-sm mr-2 group-hover:scale-110 transition-transform duration-300"></i>
                                <span class="relative">Lihat Surat Permohonan</span>
                            </a>
                        @endif
                    @elseif($permohonan->status === 'Disetujui')
                        @if($permohonan->peminjaman)
                            <a href="{{ route('peminjaman.show', $permohonan->peminjaman) }}" 
                            class="group relative inline-flex items-center justify-center px-5 py-3 gradient-primary text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
                                <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
                                    <i class="relative fas fa-clipboard-list text-sm mr-2 group-hover:scale-110 transition-transform duration-300"></i>
                                <span class="relative">Lihat Peminjaman</span>
                            </a>
                        @endif
                        
                        @if($permohonan->surat_permohonan)
                            <a href="{{ route('permohonan.viewSuratTtd', $permohonan) }}" 
                            target="_blank"
                            rel="noopener noreferrer"
                            class="group relative inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-purple-500 to-pink-600 text-white text-sm font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
                                <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
                                    <i class="relative fas fa-file-alt text-sm mr-2 group-hover:scale-110 transition-transform duration-300"></i>
                                <span class="relative">Lihat Surat Permohonan</span>
                            </a>
                        @endif
                    @endif
                    
                    <button type="button" onclick="goBack()" 
                    class="group relative inline-flex items-center justify-center px-5 py-3 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 border-2 border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500 text-gray-700 dark:text-gray-300 text-sm font-bold rounded-xl transition-all duration-300 overflow-hidden">
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
                
                <!-- Upload Surat TTD Section - MOBILE OPTIMIZED -->
                @if($permohonan->status === 'Dalam Proses' && $permohonan->draft_surat && !$permohonan->surat_permohonan)
                <div class="glass-morphism rounded-2xl md:rounded-3xl shadow-xl overflow-hidden hover-lift" data-aos="fade-up">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-orange-500 to-red-500 p-4 md:p-8 relative overflow-hidden">
                        <div class="absolute inset-0 opacity-20">
                            <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255,255,255,.1) 35px, rgba(255,255,255,.1) 70px);"></div>
                        </div>
                        
                        <div class="relative flex items-center gap-3 md:gap-5">
                            <div class="w-12 h-12 md:w-16 md:h-16 bg-white/30 backdrop-blur-xl rounded-xl md:rounded-2xl flex items-center justify-center flex-shrink-0 shadow-xl">
                                <svg class="w-6 h-6 md:w-9 md:h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base md:text-2xl font-bold text-white mb-1 md:mb-2">Upload Surat Bertanda Tangan</h3>
                                <p class="text-white/95 text-xs md:text-sm">Langkah terakhir untuk memproses permohonan</p>
                            </div>
                            <span class="hidden sm:inline-flex items-center px-3 py-1.5 md:px-5 md:py-2.5 rounded-full text-xs md:text-sm font-bold bg-white/25 backdrop-blur-sm text-white border border-white/30">
                                Wajib
                            </span>
                        </div>
                    </div>

                    <div class="p-4 md:p-8">
                        <!-- Instructions Box - Compact on Mobile -->
                        <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-xl md:rounded-2xl p-4 md:p-6 mb-4 md:mb-6 border-2 border-orange-200">
                            <div class="flex items-start gap-3 md:gap-4">
                                <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg md:rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-orange-900 mb-2 md:mb-3 text-sm md:text-lg">Petunjuk Upload:</h4>
                                    <ol class="space-y-1.5 md:space-y-2 text-xs md:text-sm text-slate-700">
                                        <li class="flex items-start gap-2">
                                            <span class="flex items-center justify-center w-5 h-5 md:w-6 md:h-6 bg-orange-500 text-white rounded-full text-[10px] md:text-xs font-bold flex-shrink-0 mt-0.5">1</span>
                                            <span class="leading-relaxed">Download draft surat</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <span class="flex items-center justify-center w-5 h-5 md:w-6 md:h-6 bg-orange-500 text-white rounded-full text-[10px] md:text-xs font-bold flex-shrink-0 mt-0.5">2</span>
                                            <span class="leading-relaxed">Cetak dan tanda tangani</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <span class="flex items-center justify-center w-5 h-5 md:w-6 md:h-6 bg-orange-500 text-white rounded-full text-[10px] md:text-xs font-bold flex-shrink-0 mt-0.5">3</span>
                                            <span class="leading-relaxed">Scan surat yang sudah ditandatangani</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <span class="flex items-center justify-center w-5 h-5 md:w-6 md:h-6 bg-orange-500 text-white rounded-full text-[10px] md:text-xs font-bold flex-shrink-0 mt-0.5">4</span>
                                            <span class="leading-relaxed">Upload file scan di bawah</span>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('permohonan.uploadSuratTtd', $permohonan) }}" 
                            method="POST" 
                            enctype="multipart/form-data"
                            id="uploadSuratForm">
                            @csrf
                            
                            <div class="relative">
                                <input type="file" 
                                    name="surat_ttd" 
                                    id="surat_ttd"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    required
                                    class="hidden">
                                
                                <!-- Drop Zone - Compact on Mobile -->
                                <div id="dropZone" 
                                    class="border-2 md:border-3 border-dashed border-slate-300 rounded-xl md:rounded-2xl p-6 md:p-8 text-center cursor-pointer transition-all duration-300 hover:border-blue-500 hover:bg-blue-50/50 group">
                                    <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl md:rounded-2xl flex items-center justify-center mx-auto mb-3 md:mb-4 group-hover:scale-110 transition-transform">
                                        <svg class="w-8 h-8 md:w-10 md:h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                    </div>
                                    
                                    <div id="uploadText">
                                        <h4 class="text-base md:text-lg font-bold text-slate-800 mb-1.5 md:mb-2">
                                            Klik atau Drag & Drop
                                        </h4>
                                        <p class="text-xs md:text-sm text-slate-500 mb-3 md:mb-4 px-4">
                                            Pilih file surat yang sudah ditandatangani
                                        </p>
                                        <div class="inline-flex items-center gap-2 px-5 py-2.5 md:px-6 md:py-3 gradient-primary text-white font-bold rounded-xl shadow-lg hover:shadow-2xl smooth-scale text-sm md:text-base">
                                            <i class="fas fa-file-upload"></i>
                                            Pilih File
                                        </div>
                                    </div>

                                    <!-- File Preview - Compact on Mobile -->
                                    <div id="filePreview" class="hidden">
                                        <div class="inline-flex items-center gap-3 md:gap-4 bg-white rounded-lg md:rounded-xl p-3 md:p-4 shadow-lg max-w-full">
                                            <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-emerald-100 to-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 md:w-6 md:h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div class="text-left flex-1 min-w-0">
                                                <p class="font-semibold text-slate-800 text-sm md:text-base truncate" id="fileName">File Name</p>
                                                <p class="text-xs md:text-sm text-slate-500" id="fileSize">File Size</p>
                                            </div>
                                            <button type="button" 
                                                    id="removeFile"
                                                    class="w-8 h-8 bg-red-100 hover:bg-red-200 rounded-lg flex items-center justify-center transition-colors flex-shrink-0">
                                                <i class="fas fa-times text-sm text-red-600"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- File Info - Compact on Mobile -->
                                <div class="mt-3 md:mt-4 flex flex-wrap items-center justify-center gap-3 md:gap-6 text-[10px] md:text-xs text-slate-500">
                                    <div class="flex items-center gap-1.5 md:gap-2">
                                        <svg class="w-3.5 h-3.5 md:w-4 md:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                        <span>PDF, JPG, PNG</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 md:gap-2">
                                        <svg class="w-3.5 h-3.5 md:w-4 md:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                        <span>Max 5 MB</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 md:gap-2">
                                        <svg class="w-3.5 h-3.5 md:w-4 md:h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        <span>Aman & Terenkripsi</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons - Stack on Mobile -->
                            <div class="mt-6 md:mt-8 flex flex-col gap-3 md:gap-4">
                                <button type="submit" 
                                        id="submitBtn"
                                        disabled
                                        class="w-full inline-flex items-center justify-center px-6 py-3 md:px-8 md:py-4 bg-gradient-to-r from-orange-500 to-red-600 text-white text-sm md:text-base font-bold rounded-xl shadow-lg hover:shadow-2xl smooth-scale disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none group">
                                    <i class="fas fa-cloud-upload-alt text-base md:text-lg mr-2 md:mr-3 group-hover:scale-110 transition-transform"></i>
                                    <span>Upload Surat Sekarang</span>
                                </button>

                                <button type="button" 
                                        onclick="document.getElementById('surat_ttd').click()"
                                        class="w-full inline-flex items-center justify-center px-6 py-3 md:px-6 md:py-4 bg-white hover:bg-slate-50 text-slate-700 text-sm md:text-base font-bold rounded-xl transition-all border-2 border-slate-200 hover:border-slate-300">
                                    <i class="fas fa-file-upload text-base md:text-lg mr-2"></i>
                                    Pilih File Lain
                                </button>
                            </div>
                        </form>

                        <!-- Security Notice - Compact on Mobile -->
                        <div class="mt-4 md:mt-6 flex items-start gap-2.5 md:gap-3 p-3 md:p-4 bg-blue-50 rounded-lg md:rounded-xl border border-blue-200">
                            <svg class="w-4 h-4 md:w-5 md:h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <div class="text-xs md:text-sm text-blue-800 leading-relaxed">
                                <p class="font-semibold mb-1">Keamanan Data Terjamin</p>
                                <p class="text-blue-700">Dokumen dienkripsi dan disimpan dengan aman.</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

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
                                <h3 class="text-lg md:text-2xl font-bold text-white mb-1 md:mb-2">Items dalam Permohonan</h3>
                                <p class="text-white/95 text-xs md:text-sm">Daftar barang yang dimohon</p>
                            </div>
                            <span class="inline-flex items-center px-3 py-1.5 md:px-5 md:py-2.5 rounded-full text-xs md:text-sm font-bold bg-white/25 backdrop-blur-sm text-white border border-white/30">
                                {{ $permohonan->items->count() }} items
                            </span>
                        </div>
                    </div>

                    <div class="p-4 md:p-8 space-y-3 md:space-y-4">
                        @foreach($permohonan->items as $detail)
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
                                </div>
                            </div>
                        @endforeach
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
                                    {{ $permohonan->tanggal_mulai ? \Carbon\Carbon::parse($permohonan->tanggal_mulai)->format('d M Y') : '-' }}
                                </p>
                            </div>
                            <div class="p-2.5 md:p-3 bg-slate-50 rounded-lg">
                                <label class="text-slate-600 block mb-1 font-medium">Tanggal Selesai</label>
                                <p class="font-bold text-slate-800 text-sm md:text-base">
                                    {{ $permohonan->tanggal_selesai ? \Carbon\Carbon::parse($permohonan->tanggal_selesai)->format('d M Y') : '-' }}
                                </p>
                            </div>
                            <div class="p-2.5 md:p-3 gradient-primary rounded-lg">
                                <label class="text-white/90 block mb-1 font-medium">Durasi</label>
                                <p class="font-bold text-white text-base md:text-lg">
                                    {{ \Carbon\Carbon::parse($permohonan->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($permohonan->tanggal_selesai)) + 1 }} hari
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
                                {{ $permohonan->keperluan ?: 'Tidak ada keterangan keperluan' }}
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
                                <h4 class="font-bold text-slate-800">Permohonan Dibuat</h4>
                                <p class="text-xs text-slate-500 mt-1">{{ $permohonan->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>

                        @if($permohonan->status === 'Dalam Proses')
                        <div class="timeline-connector flex items-start gap-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-amber-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg pulse-ring">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-orange-800">Menunggu Review Admin</h4>
                                <p class="text-xs text-slate-500 mt-1">Sedang dalam proses review</p>
                            </div>
                        </div>
                        @elseif($permohonan->status === 'Disetujui')
                        <div class="timeline-connector flex items-start gap-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-green-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-emerald-800">Permohonan Disetujui</h4>
                                <p class="text-xs text-slate-500 mt-1">{{ $permohonan->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        @elseif($permohonan->status === 'Ditolak')
                        <div class="timeline-connector flex items-start gap-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-pink-600 rounded-full flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-red-800">Permohonan Ditolak</h4>
                                <p class="text-xs text-slate-500 mt-1">{{ $permohonan->updated_at->format('d M Y, H:i') }}</p>
                                @if($permohonan->alasan_penolakan)
                                    <p class="text-xs text-red-600 mt-2 italic">{{ $permohonan->alasan_penolakan }}</p>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Document Status -->
                <div class="glass-morphism rounded-2xl shadow-lg p-6 hover-lift" data-aos="fade-left">
                    <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Status Dokumen
                    </h3>
                    
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-sm text-slate-700 font-medium">Kop Surat</span>
                            </div>
                            @if($permohonan->kop_surat)
                                <span class="text-xs px-3 py-1.5 bg-emerald-100 text-emerald-700 rounded-full font-bold">✓ Terupload</span>
                            @else
                                <span class="text-xs px-3 py-1.5 bg-red-100 text-red-700 rounded-full font-bold">✗ Belum</span>
                            @endif
                        </div>

                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span class="text-sm text-slate-700 font-medium">Draft Surat</span>
                            </div>
                            @if($permohonan->draft_surat)
                                <span class="text-xs px-3 py-1.5 bg-emerald-100 text-emerald-700 rounded-full font-bold">✓ Tersedia</span>
                            @else
                                <span class="text-xs px-3 py-1.5 bg-orange-100 text-orange-700 rounded-full font-bold">⧗ Proses</span>
                            @endif
                        </div>

                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm text-slate-700 font-medium">Surat Bertanda Tangan</span>
                            </div>
                            @if($permohonan->surat_permohonan)
                                <span class="text-xs px-3 py-1.5 bg-emerald-100 text-emerald-700 rounded-full font-bold">✓ Terupload</span>
                            @else
                                <span class="text-xs px-3 py-1.5 bg-red-100 text-red-700 rounded-full font-bold">✗ Belum</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- User Info -->
                <div class="glass-morphism rounded-xl md:rounded-2xl shadow-lg p-4 md:p-6 hover-lift" data-aos="fade-left">
                    <div class="flex items-center gap-2 md:gap-3 mb-4 md:mb-5">
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg md:rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-base md:text-lg font-bold text-slate-800">Data Pemohon</h3>
                    </div>
                    <div class="space-y-2.5 md:space-y-3 text-xs md:text-sm">
                        <div class="p-2.5 md:p-3 bg-slate-50 rounded-lg">
                            <label class="text-slate-500 block mb-1 font-medium">Nama</label>
                            <p class="font-bold text-slate-800">{{ $permohonan->nama_pemohon }}</p>
                        </div>
                        @if($permohonan->no_telp)
                        <div class="p-2.5 md:p-3 bg-slate-50 rounded-lg">
                            <label class="text-slate-500 block mb-1 font-medium">No. Telepon</label>
                            <p class="font-bold text-slate-800">{{ $permohonan->no_telp }}</p>
                        </div>
                        @endif
                        @if($permohonan->nama_instansi)
                        <div class="p-2.5 md:p-3 bg-slate-50 rounded-lg">
                            <label class="text-slate-500 block mb-1 font-medium">Instansi</label>
                            <p class="font-bold text-slate-800">{{ $permohonan->nama_instansi }}</p>
                        </div>
                        @endif
                        @if($permohonan->jabatan)
                        <div class="p-2.5 md:p-3 bg-slate-50 rounded-lg">
                            <label class="text-slate-500 block mb-1 font-medium">Jabatan</label>
                            <p class="font-bold text-slate-800">{{ $permohonan->jabatan }}</p>
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
                        <a href="{{ route('permohonan.create') }}" 
                        class="group relative w-full inline-flex items-center justify-center px-5 py-3 gradient-primary text-white text-sm font-bold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
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

                        <a href="{{ route('permohonan.index') }}" 
                        class="group relative w-full inline-flex items-center justify-center px-5 py-3 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 border-2 border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500 text-gray-700 dark:text-gray-300 text-sm font-bold rounded-lg transition-all duration-300 overflow-hidden">
                            <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-blue-500/5 to-indigo-500/5 dark:from-blue-600/10 dark:to-indigo-600/10 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                                <i class="relative fas fa-clipboard-list text-sm mr-2 text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 group-hover:-translate-x-1 transition-all duration-300"></i>
                            <span class="relative">Semua Permohonan</span>
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
                        <p class="text-sm text-slate-600 mb-5 font-medium">Hubungi admin jika ada pertanyaan tentang permohonan</p>
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

// GLOBAL NOTIFICATION FUNCTION (dipindah keluar dari DOMContentLoaded)
function showNotification(message, type = 'info') {
    // Remove existing notification if any
    const existingNotif = document.querySelector('.toast-notification');
    if (existingNotif) {
        existingNotif.remove();
    }

    const notification = document.createElement('div');
    notification.className = 'toast-notification fixed top-24 right-6 z-[9999] transform transition-all duration-500 ease-out';
    
    const bgColor = type === 'success' ? 'from-emerald-500 to-green-600' : 
                   type === 'error' ? 'from-red-500 to-rose-600' : 
                   type === 'warning' ? 'from-amber-500 to-orange-600' :
                   'from-blue-500 to-indigo-600';
    
    const icon = type === 'success' ? 
        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>' :
        type === 'error' ?
        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>' :
        type === 'warning' ?
        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>' :
        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
    
    notification.innerHTML = `
        <div class="flex items-start gap-4 px-6 py-4 bg-gradient-to-r ${bgColor} text-white rounded-2xl shadow-2xl backdrop-blur-lg border-2 border-white/20 min-w-[320px] max-w-md">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        ${icon}
                    </svg>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-bold text-white leading-relaxed">${message}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 text-white/80 hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Slide in animation
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
        notification.style.opacity = '1';
    }, 10);
    
    // Auto dismiss after 5 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(400px)';
        notification.style.opacity = '0';
        setTimeout(() => {
            notification.remove();
        }, 500);
    }, 5000);
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

// File upload functionality
document.addEventListener('DOMContentLoaded', function() {
    // CHECK FOR SUCCESS MESSAGE FROM SESSION (dipindah ke paling atas)
    @if(session('success'))
        showNotification("{{ session('success') }}", 'success');
    @endif

    @if(session('error'))
        showNotification("{{ session('error') }}", 'error');
    @endif

    @if(session('info'))
        showNotification("{{ session('info') }}", 'info');
    @endif

    @if(session('warning'))
        showNotification("{{ session('warning') }}", 'warning');
    @endif

    const fileInput = document.getElementById('surat_ttd');
    const dropZone = document.getElementById('dropZone');
    const uploadText = document.getElementById('uploadText');
    const filePreview = document.getElementById('filePreview');
    const submitBtn = document.getElementById('submitBtn');
    const uploadForm = document.getElementById('uploadSuratForm');
    const removeFileBtn = document.getElementById('removeFile');

    if (!fileInput || !dropZone) return;

    dropZone.addEventListener('click', function(e) {
        if (e.target.id !== 'removeFile' && !e.target.closest('#removeFile')) {
            fileInput.click();
        }
    });

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, function() {
            dropZone.classList.add('drag-over');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, function() {
            dropZone.classList.remove('drag-over');
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

            const loadingOverlay = document.getElementById('loadingOverlay');
            loadingOverlay.classList.add('active');

            setTimeout(() => {
                document.getElementById('step1').classList.add('active');
            }, 300);
            
            setTimeout(() => {
                document.getElementById('step1').classList.add('completed');
                document.getElementById('step2').classList.add('active');
            }, 1000);
            
            setTimeout(() => {
                document.getElementById('step2').classList.add('completed');
                document.getElementById('step3').classList.add('active');
            }, 2000);

            submitBtn.disabled = true;
        });
    }
});

// Keyboard shortcut to close modal (ESC key)
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});

// Add smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add ripple effect to buttons
document.querySelectorAll('button, .btn').forEach(button => {
    button.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.classList.add('ripple-effect');
        
        this.style.position = 'relative';
        this.style.overflow = 'hidden';
        this.appendChild(ripple);
        
        setTimeout(() => ripple.remove(), 600);
    });
});

// Add CSS for ripple effect
const rippleStyle = document.createElement('style');
rippleStyle.textContent = `
    .ripple-effect {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s ease-out;
        pointer-events: none;
    }
    
    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    .toast-notification {
        transform: translateX(400px);
        opacity: 0;
    }
`;
document.head.appendChild(rippleStyle);

// Performance optimization: Debounce scroll events
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

// Optimized scroll handler
const handleScroll = debounce(() => {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    // Add shadow to sticky elements when scrolled
    if (scrollTop > 100) {
        document.querySelectorAll('.glass-morphism').forEach(el => {
            el.style.boxShadow = '0 20px 60px rgba(0, 0, 0, 0.15)';
        });
    } else {
        document.querySelectorAll('.glass-morphism').forEach(el => {
            el.style.boxShadow = '0 8px 32px rgba(31, 38, 135, 0.1)';
        });
    }
}, 100);

window.addEventListener('scroll', handleScroll);

console.log('✨ Pelita App - Permohonan Detail Page Loaded Successfully');
</script>
@endpush