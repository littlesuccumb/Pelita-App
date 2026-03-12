@extends('layouts.app')

@section('title', 'Kelola Barang - Admin')

@push('styles')
<style>
    
/* Dark mode transitions */
* {
    transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
}

/* Smooth Fade In with Scale */
@keyframes smoothFadeIn {
    0% { 
        opacity: 0; 
        transform: scale(0.95) translateY(20px);
        filter: blur(10px);
    }
    100% { 
        opacity: 1; 
        transform: scale(1) translateY(0);
        filter: blur(0);
    }
}

/* Elegant Slide from Bottom */
@keyframes elegantSlideUp {
    0% { 
        opacity: 0; 
        transform: translateY(40px);
    }
    60% {
        opacity: 0.8;
        transform: translateY(-5px);
    }
    100% { 
        opacity: 1; 
        transform: translateY(0);
    }
}

/* Professional Reveal Animation */
@keyframes professionalReveal {
    0% { 
        opacity: 0; 
        transform: translateY(30px);
        clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
    }
    100% { 
        opacity: 1; 
        transform: translateY(0);
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
    }
}

/* Gentle Scale with Fade */
@keyframes gentleScale {
    0% { 
        opacity: 0; 
        transform: scale(0.9);
    }
    50% {
        opacity: 0.5;
    }
    100% { 
        opacity: 1; 
        transform: scale(1);
    }
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
}

/* Stagger Animation Classes */
.animate-smooth-fade {
    animation: smoothFadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    opacity: 0;
}

.animate-elegant-slide {
    animation: elegantSlideUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    opacity: 0;
}

.animate-professional-reveal {
    animation: professionalReveal 0.9s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    opacity: 0;
}

.animate-gentle-scale {
    animation: gentleScale 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    opacity: 0;
}

/* Staggered Delay System */
.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }
.delay-300 { animation-delay: 0.3s; }
.delay-400 { animation-delay: 0.4s; }
.delay-500 { animation-delay: 0.5s; }
.delay-600 { animation-delay: 0.6s; }

.animate-pulse-slow { animation: pulse 2s infinite; }

.card-hover {
    transition: all 0.3s ease-in-out;
}

.card-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -8px rgba(0, 0, 0, 0.15);
}

.dark .card-hover:hover {
    box-shadow: 0 10px 25px -8px rgba(0, 0, 0, 0.3);
}

.btn-primary {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    border: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.search-box {
    position: relative;
    transition: all 0.3s ease;
}

.search-box:focus-within {
    transform: scale(1.02);
}

.table-row {
    transition: all 0.2s ease;
    contain: layout style;
}

.table-row:hover {
    background: linear-gradient(90deg, rgba(59, 130, 246, 0.05), rgba(59, 130, 246, 0.02));
    transform: translateX(2px);
}

.dark .table-row:hover {
    background: linear-gradient(90deg, rgba(59, 130, 246, 0.1), rgba(59, 130, 246, 0.05));
}

.action-btn {
    position: relative;
    overflow: hidden;
    transition: opacity 0.3s ease;
}

.action-btn:hover {
    opacity: 0.9;
}

.modal-backdrop {
    backdrop-filter: blur(4px);
    background: rgba(0, 0, 0, 0.5);
}

.notification {
    backdrop-filter: blur(10px);
    border-left: 4px solid;
    animation: slideInRight 0.5s ease-out;
}

@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOutRight {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(100%); opacity: 0; }
}

.success { border-left-color: #10b981; }
.error { border-left-color: #ef4444; }

.badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 500;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

.badge-baik { background-color: #dcfce7; color: #166534; }
.badge-rusak-ringan { background-color: #fef3c7; color: #92400e; }
.badge-rusak-berat { background-color: #fee2e2; color: #991b1b; }

.badge-tersedia { background-color: #dcfce7; color: #166534; }
.badge-dipinjam { background-color: #fef3c7; color: #92400e; }
.badge-maintenance { background-color: #fee2e2; color: #991b1b; }

/* SCROLL OPTIMIZATION */
.overflow-x-auto {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scroll-behavior: auto;
    will-change: scroll-position;
    transform: translateZ(0);
    backface-visibility: hidden;
}

/* Custom Scrollbar untuk Error List */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.05);
    border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(239, 68, 68, 0.3);
    border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(239, 68, 68, 0.5);
}

.dark .custom-scrollbar::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
}

.dark .custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(239, 68, 68, 0.4);
}

@media (max-width: 1024px) {
    .table-row:hover {
        background: transparent;
    }
    
    .action-btn:hover {
        opacity: 1;
    }
}

/* Reduce Motion for Accessibility */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>
@endpush

@section('content')
<div class="w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 lg:py-4">  

        {{-- Modern Breadcrumb Navigation --}}
        <nav class="breadcrumb-modern mb-8 animate-smooth-fade" aria-label="Breadcrumb">
            <a href="{{ route('dashboard') }}" class="breadcrumb-link flex items-center gap-2">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>               
            <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs"></i>              
            <span class="breadcrumb-current">
                <i class="fas fa-boxes"></i>
                <span>Kelola Barang</span>
            </span>
        </nav>

        {{-- Modern Header Section --}}
        <div class="mb-8 animate-gentle-scale delay-100">
            <div class="relative overflow-hidden bg-gradient-to-br from-white via-blue-50/30 to-indigo-50/50 dark:from-gray-800 dark:via-gray-800/95 dark:to-gray-800/90 rounded-2xl shadow-xl border border-white/60 dark:border-gray-700 backdrop-blur-sm">
                
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-400/20 via-indigo-400/20 to-purple-400/20 dark:from-blue-600/10 dark:via-indigo-600/10 dark:to-purple-600/10 rounded-full blur-3xl transform translate-x-32 -translate-y-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-cyan-400/15 to-blue-400/15 dark:from-cyan-600/10 dark:to-blue-600/10 rounded-full blur-2xl transform -translate-x-24 translate-y-24"></div>
                
                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                    <div class="absolute top-10 left-10 w-2 h-2 bg-blue-400 dark:bg-blue-500 rounded-full animate-pulse opacity-60"></div>
                    <div class="absolute top-20 right-20 w-1.5 h-1.5 bg-indigo-400 dark:bg-indigo-500 rounded-full animate-pulse opacity-40" style="animation-delay: 0.5s;"></div>
                    <div class="absolute bottom-16 left-1/3 w-1 h-1 bg-purple-400 dark:bg-purple-500 rounded-full animate-pulse opacity-50" style="animation-delay: 1s;"></div>
                </div>
                
                <div class="relative p-6 lg:p-8">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        
                        <div class="flex-1">
                            <div class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-blue-500/10 to-indigo-500/10 dark:from-blue-600/20 dark:to-indigo-600/20 border border-blue-200/50 dark:border-blue-700/50 rounded-full mb-4">
                                <div class="w-2 h-2 bg-blue-500 dark:bg-blue-400 rounded-full animate-pulse"></div>
                                <span class="text-sm font-semibold text-blue-700 dark:text-blue-300">Inventory Management</span>
                            </div>
                            
                            <h1 class="text-2xl sm:text-3xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-blue-800 to-indigo-800 dark:from-slate-100 dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent leading-tight">
                                Kelola Barang
                            </h1>
                            
                            <p class="text-slate-600 dark:text-slate-400 text-lg flex items-center space-x-2">
                                <i class="fas fa-info-circle text-blue-500 dark:text-blue-400"></i>
                                <span>Kelola inventaris barang dan aset perusahaan dengan mudah</span>
                            </p>
                            
                            <div class="flex flex-wrap items-center gap-4 mt-6">
                                <div class="flex items-center space-x-2 px-4 py-2 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm rounded-lg border border-slate-200/50 dark:border-gray-600/50 shadow-sm">
                                    <div class="p-1.5 bg-blue-100 dark:bg-blue-900/50 rounded-md">
                                        <i class="fas fa-boxes text-blue-600 dark:text-blue-400 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Total Barang</p>
                                        <p class="text-lg font-bold text-slate-800 dark:text-slate-200">{{ $stats['total_barang'] ?? 0 }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-2 px-4 py-2 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm rounded-lg border border-emerald-200/50 dark:border-emerald-800/50 shadow-sm">
                                    <div class="p-1.5 bg-emerald-100 dark:bg-emerald-900/50 rounded-md">
                                        <i class="fas fa-check-circle text-emerald-600 dark:text-emerald-400 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Stok Tersedia</p>
                                        <p class="text-lg font-bold text-slate-800 dark:text-slate-200">{{ $stats['stok_tersedia'] ?? 0 }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col gap-3">
                            <a href="{{ route('admin.barang.create') }}" 
                               class="group relative inline-flex items-center justify-center px-6 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
                                <i class="fas fa-plus mr-2.5"></i>
                                <span class="relative">Tambah Barang</span>
                            </a>
                            
                            <div class="flex gap-3">
                                <a href="{{ route('admin.barang.export') }}" 
                                   class="flex-1 group relative inline-flex items-center justify-center px-4 py-2.5 bg-white dark:bg-gray-700 hover:bg-slate-50 dark:hover:bg-gray-600 border-2 border-slate-200 dark:border-gray-600 hover:border-slate-300 dark:hover:border-gray-500 text-slate-700 dark:text-slate-200 font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                                    <i class="fas fa-download mr-2 text-sm"></i>
                                    <span class="text-sm">Export</span>
                                </a>
                                
                                <button onclick="showImportModal()" 
                                        class="flex-1 group relative inline-flex items-center justify-center px-4 py-2.5 bg-white dark:bg-gray-700 hover:bg-slate-50 dark:hover:bg-gray-600 border-2 border-slate-200 dark:border-gray-600 hover:border-slate-300 dark:hover:border-gray-500 text-slate-700 dark:text-slate-200 font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                                    <i class="fas fa-upload mr-2 text-sm"></i>
                                    <span class="text-sm">Import</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="h-1.5 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>
            </div>
        </div>

        {{-- Modern Stats Cards Section --}}
        <div class="mb-8 animate-professional-reveal delay-200">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                        <i class="fas fa-chart-pie text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Status Barang</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Overview inventaris real-time</p>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-lg border border-gray-200 dark:border-gray-600">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-xs text-gray-600 dark:text-gray-300 font-medium">Live Update</span>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-3 lg:grid-cols-4 lg:gap-5">
                
                {{-- Total Barang Card --}}
                <div class="group relative overflow-hidden bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
                    
                    <div class="relative p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-boxes text-white text-2xl"></i>
                            </div>
                            <div class="flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full">
                                <i class="fas fa-arrow-up text-white text-xs"></i>
                                <span class="text-white text-xs font-bold">100%</span>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-blue-100 text-sm font-medium">Total Barang</p>
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white">{{ $stats['total_barang'] ?? 0 }}</h3>
                                <span class="text-blue-100 text-sm">jenis</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                            <span class="text-blue-100 text-xs font-medium">Jenis barang</span>
                            <i class="fas fa-cube text-blue-100 text-sm"></i>
                        </div>
                    </div>
                </div>

                {{-- Stok Tersedia Card --}}
                <div class="group relative overflow-hidden bg-gradient-to-br from-emerald-500 via-emerald-600 to-green-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
                    
                    <div class="relative p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-check-circle text-white text-2xl"></i>
                            </div>
                            <div class="flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full">
                                <i class="fas fa-check text-white text-xs"></i>
                                <span class="text-white text-xs font-bold">Ready</span>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-emerald-100 text-sm font-medium">Stok Tersedia</p>
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-4xl font-black text-white">{{ $stats['stok_tersedia'] ?? 0 }}</h3>
                                <span class="text-emerald-100 text-sm">unit</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                            <span class="text-emerald-100 text-xs font-medium">Unit siap pakai</span>
                            <div class="w-2 h-2 bg-green-200 rounded-full animate-pulse"></div>
                        </div>
                    </div>
                </div>

                {{-- Dipinjam Card --}}
                <div class="group relative overflow-hidden bg-gradient-to-br from-amber-500 via-amber-600 to-orange-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
                    
                    <div class="relative p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl group-hover:scale-110 transition-transform duration-300 relative">
                                <i class="fas fa-clock text-white text-2xl"></i>
                                <div class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-300 rounded-full animate-ping"></div>
                                <div class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-300 rounded-full"></div>
                            </div>
                            <div class="flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full">
                                <div class="w-2 h-2 bg-yellow-200 rounded-full animate-pulse"></div>
                                <span class="text-white text-xs font-bold">Active</span>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-amber-100 text-sm font-medium">Sedang Dipinjam</p>
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-4xl font-black text-white">{{ $stats['barang_dipinjam'] ?? 0 }}</h3>
                                <span class="text-amber-100 text-sm">item</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                            <span class="text-amber-100 text-xs font-medium">Item dipinjam</span>
                            <div class="flex items-center gap-1">
                                <div class="w-1.5 h-1.5 bg-yellow-200 rounded-full animate-pulse"></div>
                                <div class="w-1.5 h-1.5 bg-yellow-200 rounded-full animate-pulse" style="animation-delay: 0.2s;"></div>
                                <div class="w-1.5 h-1.5 bg-yellow-200 rounded-full animate-pulse" style="animation-delay: 0.4s;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Maintenance Card --}}
                <div class="group relative overflow-hidden bg-gradient-to-br from-red-500 via-red-600 to-rose-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
                    
                    <div class="relative p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-tools text-white text-2xl"></i>
                            </div>
                            <div class="flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full">
                                <i class="fas fa-wrench text-white text-xs"></i>
                                <span class="text-white text-xs font-bold">Repair</span>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-red-100 text-sm font-medium">Maintenance</p>
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-4xl font-black text-white">{{ $stats['barang_maintenance'] ?? 0 }}</h3>
                                <span class="text-red-100 text-sm">item</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                            <span class="text-red-100 text-xs font-medium">Butuh perbaikan</span>
                            <i class="fas fa-exclamation-triangle text-red-100 text-sm"></i>
                        </div>
                    </div>
                </div>

            </div>
            
            {{-- Quick Info Bar --}}
            <div class="mt-6 p-4 bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 dark:from-blue-900/20 dark:via-indigo-900/20 dark:to-purple-900/20 rounded-xl border border-blue-100 dark:border-blue-800">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-500 rounded-lg">
                            <i class="fas fa-info-circle text-white"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">Statistik Update Otomatis</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Data diperbarui setiap kali ada perubahan status barang</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300">
                                {{ $stats['barang_dipinjam'] ?? 0 }} Sedang Dipinjam
                            </span>
                        </div>
                        <div class="h-4 w-px bg-gray-300 dark:bg-gray-600"></div>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300">
                                {{ $stats['barang_maintenance'] ?? 0 }} Maintenance
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Enhanced Filter Section - COMPACT VERSION --}}
        <div class="mb-8 animate-elegant-slide delay-300">
            <div class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700">
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-400/5 to-indigo-400/5 dark:from-blue-600/10 dark:to-indigo-600/10 rounded-full -mr-32 -mt-32"></div>
                
                <div class="relative p-4 sm:p-6 lg:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                            <i class="fas fa-filter text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Filter & Pencarian</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Filter data barang sesuai kebutuhan</p>
                        </div>
                    </div>
                    
                    <form method="GET" action="{{ route('admin.barang.index') }}">
                        {{-- Filter Inputs Grid - COMPACT VERSION --}}
                        <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 mb-6">
                            {{-- Search Input --}}
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-search text-blue-500 dark:text-blue-400"></i>
                                    Pencarian
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 lg:pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400 dark:text-gray-500 text-sm lg:text-base group-focus-within:text-blue-500 dark:group-focus-within:text-blue-400 transition-colors"></i>
                                    </div>
                                    <input type="text" 
                                        name="search"
                                        value="{{ request('search') }}"
                                        placeholder="Cari nama, kode, merk..." 
                                        class="block w-full pl-10 lg:pl-11 pr-3 lg:pr-4 py-2.5 lg:py-3 text-sm lg:text-base bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 focus:border-blue-500 dark:focus:border-blue-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500">                                    
                                </div>
                            </div>

                            {{-- Kategori Filter --}}
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-tags text-purple-500 dark:text-purple-400"></i>
                                    Kategori
                                </label>
                                <div class="relative">
                                    <select name="kategori_id" class="block w-full px-3 lg:px-4 py-2.5 lg:py-3 pr-10 text-sm lg:text-base bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 focus:border-blue-500 dark:focus:border-blue-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-gray-900 dark:text-gray-100 appearance-none cursor-pointer">
                                        <option value="">Semua Kategori</option>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                                {{ $kategori->nama_kategori }}
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

                            {{-- Status Filter --}}
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-info-circle text-emerald-500 dark:text-emerald-400"></i>
                                    Status
                                </label>
                                <div class="relative">
                                    <select name="status" class="block w-full px-3 lg:px-4 py-2.5 lg:py-3 pr-10 text-sm lg:text-base bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 focus:border-blue-500 dark:focus:border-blue-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-gray-900 dark:text-gray-100 appearance-none cursor-pointer">
                                        <option value="">Semua Status</option>
                                        <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>✅ Tersedia</option>
                                        <option value="dipinjam" {{ request('status') == 'dipinjam' ? 'selected' : '' }}>⏰ Dipinjam</option>
                                        <option value="maintenance" {{ request('status') == 'maintenance' ? 'selected' : '' }}>🔧 Maintenance</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Kondisi Filter --}}
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-wrench text-amber-500 dark:text-amber-400"></i>
                                    Kondisi
                                </label>
                                <div class="relative">
                                    <select name="kondisi" class="block w-full px-3 lg:px-4 py-2.5 lg:py-3 pr-10 text-sm lg:text-base bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 focus:border-blue-500 dark:focus:border-blue-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-gray-900 dark:text-gray-100 appearance-none cursor-pointer">
                                        <option value="">Semua Kondisi</option>
                                        <option value="baik" {{ request('kondisi') == 'baik' ? 'selected' : '' }}>✅ Baik</option>
                                        <option value="rusak ringan" {{ request('kondisi') == 'rusak ringan' ? 'selected' : '' }}>⚠️ Rusak Ringan</option>
                                        <option value="rusak berat" {{ request('kondisi') == 'rusak berat' ? 'selected' : '' }}>❌ Rusak Berat</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Dapat Dipinjam Filter --}}
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-hand-holding text-indigo-500 dark:text-indigo-400"></i>
                                    Dapat Dipinjam
                                </label>
                                <div class="relative">
                                    <select name="dapat_dipinjam" class="block w-full px-3 lg:px-4 py-2.5 lg:py-3 pr-10 text-sm lg:text-base bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 focus:border-blue-500 dark:focus:border-blue-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-gray-900 dark:text-gray-100 appearance-none cursor-pointer">
                                        <option value="">Semua</option>
                                        <option value="1" {{ request('dapat_dipinjam') == '1' ? 'selected' : '' }}>✅ Ya</option>
                                        <option value="0" {{ request('dapat_dipinjam') == '0' ? 'selected' : '' }}>❌ Tidak</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex gap-3">
                                <button type="submit" class="group relative inline-flex items-center px-4 lg:px-6 py-2.5 lg:py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm lg:text-base font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                    <i class="fas fa-search mr-2 group-hover:scale-110 transition-transform"></i>
                                    Filter Data
                                </button>
                                <a href="{{ route('admin.barang.index') }}" 
                                class="group inline-flex items-center px-4 lg:px-6 py-2.5 lg:py-3 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm lg:text-base font-semibold rounded-xl transition-all duration-300">
                                    <i class="fas fa-redo mr-2 group-hover:rotate-180 transition-transform duration-500"></i>
                                    Reset
                                </a>
                            </div>
                            
                            <div class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                                <i class="fas fa-database text-blue-600 dark:text-blue-400"></i>
                                <span class="text-sm text-gray-700 dark:text-gray-300">Total:</span>
                                <span class="font-bold text-gray-900 dark:text-gray-100">{{ $barangs->total() }}</span>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Barang</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Enhanced Data Table --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden animate-professional-reveal delay-400">
            {{-- Table Header --}}
            <div class="relative px-6 lg:px-8 py-6 bg-gradient-to-r from-gray-50 via-blue-50/30 to-indigo-50/30 dark:from-gray-700/50 dark:via-gray-800/50 dark:to-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-400/10 to-indigo-400/10 dark:from-blue-600/10 dark:to-indigo-600/10 rounded-full -mr-16 -mt-16"></div>
                
                <div class="relative flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                            <i class="fas fa-list text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Daftar Barang</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Kelola dan monitor semua data inventaris</p>
                        </div>
                    </div>
                    <div class="hidden sm:flex items-center gap-2 px-4 py-2 bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm rounded-lg border border-gray-200 dark:border-gray-600 shadow-sm">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Menampilkan</span>
                        <span class="font-bold text-gray-900 dark:text-gray-100">{{ $barangs->count() }}</span>
                        <span class="text-sm text-gray-600 dark:text-gray-400">dari</span>
                        <span class="font-bold text-gray-900 dark:text-gray-100">{{ $barangs->total() }}</span>
                    </div>
                </div>
            </div>

            @if($barangs->count() > 0)
            {{-- Desktop Table --}}
            <div class="hidden lg:block overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-slate-200 via-blue-100 to-indigo-100 dark:from-gray-700 dark:via-gray-700/80 dark:to-gray-700">
                        <tr>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-barcode text-blue-500 dark:text-blue-400"></i>
                                    Kode & Nama Barang
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-tags text-purple-500 dark:text-purple-400"></i>
                                    Kategori & Spesifikasi
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-cubes text-green-500 dark:text-green-400"></i>
                                    Jumlah
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-info-circle text-amber-500 dark:text-amber-400"></i>
                                    Status & Kondisi
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-hand-holding text-indigo-500 dark:text-indigo-400"></i>
                                    Dapat Dipinjam
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-cogs text-red-500 dark:text-red-400"></i>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/30 dark:from-gray-800 dark:via-gray-800/95 dark:to-gray-800/90 divide-y divide-slate-100 dark:divide-gray-700">
                        @foreach($barangs as $barang)
                        <tr class="table-row">
                            {{-- Kolom 1: Kode & Nama Barang --}}
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-3">
                                    <div class="relative h-12 w-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg overflow-hidden flex-shrink-0">
                                        @php
                                            $primaryFoto = $barang->fotos->where('is_primary', true)->first() 
                                                        ?? $barang->fotos->first();
                                        @endphp
                                        
                                        @if($primaryFoto)
                                            <img src="{{ $primaryFoto->foto_url }}" 
                                                alt="{{ $barang->nama_barang }}" 
                                                class="h-12 w-12 rounded-xl object-cover">
                                                
                                            @if($barang->fotos->count() > 1)
                                                <div class="absolute -bottom-1 -right-1 bg-purple-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border-2 border-white dark:border-gray-700 shadow-lg">
                                                    {{ $barang->fotos->count() }}
                                                </div>
                                            @endif
                                        @elseif($barang->foto && Storage::disk('public')->exists($barang->foto))
                                            <img src="{{ Storage::url($barang->foto) }}" 
                                                alt="{{ $barang->nama_barang }}" 
                                                class="h-12 w-12 rounded-xl object-cover">
                                        @else
                                            <i class="fas fa-cube text-white text-lg"></i>
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">{{ $barang->nama_barang }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            <span class="font-mono bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">{{ $barang->kode_barang }}</span>
                                        </div>
                                        @if($barang->fotos->count() > 0)
                                            <div class="text-xs text-purple-600 dark:text-purple-400 mt-1">
                                                <i class="fas fa-images mr-1"></i>{{ $barang->fotos->count() }} foto
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            
                            {{-- Kolom 2: Kategori & Spesifikasi --}}
                            <td class="px-6 py-5">
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $barang->kategori->nama_kategori ?? 'Tidak Ada Kategori' }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        @if($barang->merk || $barang->type)
                                            {{ $barang->merk }} {{ $barang->type }}
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            
                            {{-- Kolom 3: Jumlah --}}
                            <td class="px-6 py-5">
                                <div class="text-sm space-y-1">
                                    <div class="flex items-center gap-2">
                                        <span class="text-gray-600 dark:text-gray-400 text-xs w-16">Tersedia:</span>
                                        <span class="font-semibold text-emerald-600 dark:text-emerald-400">{{ $barang->jumlah_tersedia }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-gray-600 dark:text-gray-400 text-xs w-16">Total:</span>
                                        <span class="font-medium text-gray-700 dark:text-gray-300">{{ $barang->jumlah_total }}</span>
                                    </div>
                                </div>
                            </td>
                            
                            {{-- Kolom 4: Status & Kondisi (SIMPLE - TANPA DETAIL PEMINJAM) --}}
                            <td class="px-6 py-5">
                                <div class="space-y-2">
                                    {{-- Status Badge --}}
                                    @if($barang->status == 'tersedia')
                                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 font-bold text-xs shadow-sm">
                                            <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                                            Tersedia
                                        </span>
                                    @elseif($barang->status == 'dipinjam')
                                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 font-bold text-xs shadow-sm">
                                            <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
                                            Dipinjam
                                        </span>
                                    @elseif($barang->status == 'maintenance')
                                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 font-bold text-xs shadow-sm">
                                            <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                            Maintenance
                                        </span>
                                    @endif
                                    
                                    {{-- Kondisi Badge --}}
                                    <div>
                                        @if($barang->kondisi == 'baik')
                                            <span class="badge badge-baik">
                                                <i class="fas fa-check-circle"></i>
                                                Baik
                                            </span>
                                        @elseif($barang->kondisi == 'rusak ringan')
                                            <span class="badge badge-rusak-ringan">
                                                <i class="fas fa-exclamation-triangle"></i>
                                                Rusak Ringan
                                            </span>
                                        @elseif($barang->kondisi == 'rusak berat')
                                            <span class="badge badge-rusak-berat">
                                                <i class="fas fa-times-circle"></i>
                                                Rusak Berat
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            
                            {{-- Kolom 5: Dapat Dipinjam --}}
                            <td class="px-6 py-5">
                                @if($barang->dapat_dipinjam)
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 font-bold text-xs shadow-sm">
                                        <i class="fas fa-check-circle"></i>
                                        Ya
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 font-bold text-xs shadow-sm">
                                        <i class="fas fa-times-circle"></i>
                                        Tidak
                                    </span>
                                @endif
                            </td>
                            
                            {{-- Kolom 6: Aksi --}}
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.barang.show', $barang->id) }}" 
                                    class="p-2.5 text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 hover:bg-blue-100 dark:hover:bg-blue-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md" 
                                    title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.barang.edit', $barang->id) }}" 
                                    class="p-2.5 text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/30 hover:bg-green-100 dark:hover:bg-green-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md" 
                                    title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="showMaintenanceModal('{{ $barang->id }}')" 
                                            class="p-2.5 text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-900/30 hover:bg-orange-100 dark:hover:bg-orange-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md" 
                                            title="Jadwalkan Maintenance">
                                        <i class="fas fa-tools"></i>
                                    </a>
                                    <button onclick="deleteModal('{{ $barang->id }}', '{{ $barang->nama_barang }}')"
                                            class="p-2.5 text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 dark:hover:bg-red-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md" 
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    
                                    <div class="relative">
                                        <button onclick="toggleStatusDropdown('{{ $barang->id }}')" 
                                                class="p-2.5 text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 hover:bg-indigo-100 dark:hover:bg-indigo-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md" 
                                                title="Ubah Status">
                                            <i class="fas fa-exchange-alt"></i>
                                        </button>
                                        <div id="status-dropdown-{{ $barang->id }}" class="hidden fixed bg-white dark:bg-gray-800 rounded-lg shadow-2xl border border-gray-200 dark:border-gray-700 z-[9999] w-48" style="margin-top: -150px; margin-left: -180px;">
                                            <div class="py-1">
                                                <button onclick="updateStatus('{{ $barang->id }}', 'Tersedia')" 
                                                        class="flex items-center w-full text-left px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors rounded-t-lg">
                                                    <i class="fas fa-check-circle text-green-500 mr-2 w-4"></i>
                                                    <span>Tersedia</span>
                                                </button>
                                                <button onclick="updateStatus('{{ $barang->id }}', 'Dipinjam')" 
                                                        class="flex items-center w-full text-left px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                                    <i class="fas fa-clock text-yellow-500 mr-2 w-4"></i>
                                                    <span>Dipinjam</span>
                                                </button>
                                                <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>
                                                <button onclick="toggleDapatDipinjam('{{ $barang->id }}', {{ $barang->dapat_dipinjam ? 'true' : 'false' }})" 
                                                        class="flex items-center w-full text-left px-3 py-2 text-sm {{ $barang->dapat_dipinjam ? 'text-red-700 dark:text-red-400 bg-red-50 dark:bg-red-900/30' : 'text-green-700 dark:text-green-400 bg-green-50 dark:bg-green-900/30' }} hover:bg-opacity-80 transition-colors rounded-b-lg">
                                                    <i class="fas {{ $barang->dapat_dipinjam ? 'fa-ban' : 'fa-check' }} mr-2 w-4"></i>
                                                    <span class="text-xs">{{ $barang->dapat_dipinjam ? 'Ubah Tidak Dapat Dipinjam' : 'Ubah Dapat Dipinjam' }}</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Mobile Cards --}}
            <div class="lg:hidden divide-y divide-slate-100 dark:divide-gray-700">
                @foreach($barangs as $barang)
                <div class="p-5 hover:bg-gradient-to-r hover:from-slate-50 hover:to-blue-50/50 dark:hover:from-gray-700/50 dark:hover:to-blue-900/20 transition-all duration-200">
                    <div class="bg-gradient-to-br from-white via-slate-50/50 to-blue-50/30 dark:from-gray-800 dark:via-gray-800/95 dark:to-gray-700/90 rounded-2xl p-5 border border-slate-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-all">
                        
                        {{-- Header: Foto & Status --}}
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center">
                                <div class="h-12 w-12 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg mr-3 overflow-hidden">
                                    @php
                                        $primaryFoto = $barang->fotos->where('is_primary', true)->first() 
                                                    ?? $barang->fotos->first();
                                    @endphp
                                    
                                    @if($primaryFoto)
                                        <img src="{{ $primaryFoto->foto_url }}" 
                                            alt="{{ $barang->nama_barang }}" 
                                            class="h-12 w-12 rounded-lg object-cover">
                                    @elseif($barang->foto && Storage::disk('public')->exists($barang->foto))
                                        <img src="{{ Storage::url($barang->foto) }}" 
                                            alt="{{ $barang->nama_barang }}" 
                                            class="h-12 w-12 rounded-lg object-cover">
                                    @else
                                        <i class="fas fa-cube text-white text-lg"></i>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $barang->nama_barang }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        <span class="font-mono bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">{{ $barang->kode_barang }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col items-end space-y-1">
                                @if($barang->status == 'tersedia')
                                    <span class="badge badge-tersedia">
                                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                        Tersedia
                                    </span>
                                @elseif($barang->status == 'dipinjam')
                                    <span class="badge badge-dipinjam">
                                        <div class="w-2 h-2 bg-yellow-500 rounded-full animate-pulse-slow"></div>
                                        Dipinjam
                                    </span>
                                @elseif($barang->status == 'maintenance')
                                    <span class="badge badge-maintenance">
                                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                        Maintenance
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Info Dasar (SIMPLE - TANPA DETAIL PEMINJAM) --}}
                        <div class="space-y-2 mb-4">
                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                <span class="font-medium">Kategori:</span> {{ $barang->kategori->nama_kategori ?? 'Tidak Ada' }}
                            </div>

                            @if($barang->merk || $barang->type)
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $barang->merk }} {{ $barang->type }}
                                </div>
                            @endif
                            
                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                <span class="font-medium">Jumlah:</span> {{ $barang->jumlah_tersedia }}/{{ $barang->jumlah_total }}
                            </div>
                            
                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                <span class="font-medium">Dapat Dipinjam:</span> 
                                @if($barang->dapat_dipinjam)
                                    <span class="inline-flex items-center text-green-600 dark:text-green-400">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Ya
                                    </span>
                                @else
                                    <span class="inline-flex items-center text-red-600 dark:text-red-400">
                                        <i class="fas fa-times-circle mr-1"></i>
                                        Tidak
                                    </span>
                                @endif
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <div>
                                    @if($barang->kondisi == 'baik')
                                        <span class="badge badge-baik">
                                            <i class="fas fa-check-circle"></i>
                                            Baik
                                        </span>
                                    @elseif($barang->kondisi == 'rusak ringan')
                                        <span class="badge badge-rusak-ringan">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            Rusak Ringan
                                        </span>
                                    @elseif($barang->kondisi == 'rusak berat')
                                        <span class="badge badge-rusak-berat">
                                            <i class="fas fa-times-circle"></i>
                                            Rusak Berat
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('admin.barang.show', $barang->id) }}" 
                            class="inline-flex items-center px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs font-medium rounded-lg hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-all">
                                <i class="fas fa-eye mr-1"></i>
                                Detail
                            </a>
                            <a href="{{ route('admin.barang.edit', $barang->id) }}" 
                            class="inline-flex items-center px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-medium rounded-lg hover:bg-green-200 dark:hover:bg-green-900/50 transition-all">
                                <i class="fas fa-edit mr-1"></i>
                                Edit
                            </a>
                            <button onclick="deleteModal('{{ $barang->id }}', '{{ $barang->nama_barang }}')"
                                    class="inline-flex items-center px-3 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-xs font-medium rounded-lg hover:bg-red-200 dark:hover:bg-red-900/50 transition-all">
                                <i class="fas fa-trash mr-1"></i>
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Enhanced Modern Pagination --}}
            <div class="bg-gradient-to-r from-slate-100 via-blue-50 to-indigo-50 dark:from-gray-700 dark:via-gray-800 dark:to-gray-700 px-6 py-6 border-t border-slate-200 dark:border-gray-600">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-3 px-4 py-2.5 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-slate-200 dark:border-gray-600">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900/50 rounded-lg">
                                <i class="fas fa-info-circle text-blue-600 dark:text-blue-400 text-sm"></i>
                            </div>
                            <div class="text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Menampilkan</span>
                                <span class="font-bold text-gray-900 dark:text-gray-100 mx-1">{{ $barangs->firstItem() ?? 0 }}-{{ $barangs->lastItem() ?? 0 }}</span>
                                <span class="text-gray-600 dark:text-gray-400">dari</span>
                                <span class="font-bold text-blue-600 dark:text-blue-400 mx-1">{{ $barangs->total() }}</span>
                                <span class="text-gray-600 dark:text-gray-400">data</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        @if ($barangs->onFirstPage())
                            <button disabled class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 rounded-xl cursor-not-allowed border border-gray-200 dark:border-gray-600">
                                <i class="fas fa-chevron-left text-sm"></i>
                            </button>
                        @else
                            <a href="{{ $barangs->previousPageUrl() }}" 
                               class="px-4 py-2.5 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 rounded-xl transition-all border border-slate-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-600 shadow-sm hover:shadow-md">
                                <i class="fas fa-chevron-left text-sm"></i>
                            </a>
                        @endif
                        
                        <div class="hidden sm:flex items-center gap-2">
                            @foreach ($barangs->getUrlRange(1, $barangs->lastPage()) as $page => $url)
                                @if ($page == $barangs->currentPage())
                                    <span class="px-4 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-xl shadow-lg border-2 border-blue-700 dark:border-blue-500">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" 
                                       class="px-4 py-2.5 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium rounded-xl transition-all border border-slate-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-600 shadow-sm hover:shadow-md">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                        
                        <div class="sm:hidden px-4 py-2.5 bg-white dark:bg-gray-800 rounded-xl border border-slate-200 dark:border-gray-600 shadow-sm">
                            <span class="text-sm font-bold text-gray-900 dark:text-gray-100">{{ $barangs->currentPage() }}</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400 mx-1">/</span>
                            <span class="text-sm text-gray-600 dark:text-gray-300">{{ $barangs->lastPage() }}</span>
                        </div>
                        
                        @if ($barangs->hasMorePages())
                            <a href="{{ $barangs->nextPageUrl() }}" 
                               class="px-4 py-2.5 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 rounded-xl transition-all border border-slate-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-600 shadow-sm hover:shadow-md">
                                <i class="fas fa-chevron-right text-sm"></i>
                            </a>
                        @else
                            <button disabled class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 rounded-xl cursor-not-allowed border border-gray-200 dark:border-gray-600">
                                <i class="fas fa-chevron-right text-sm"></i>
                            </button>
                        @endif
                    </div>
                    
                    <div class="hidden lg:flex items-center gap-3">
                        <span class="text-sm text-gray-600 dark:text-gray-400 font-medium">Halaman:</span>
                        <div class="relative">
                            <select id="page-select" onchange="window.location.href=this.value" 
                                    class="appearance-none pl-4 pr-10 py-2.5 bg-white dark:bg-gray-800 border-2 border-slate-200 dark:border-gray-600 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-300 hover:border-blue-300 dark:hover:border-blue-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all cursor-pointer">
                                @for ($i = 1; $i <= $barangs->lastPage(); $i++)
                                    <option value="{{ $barangs->url($i) }}" {{ $i == $barangs->currentPage() ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center justify-center pr-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 h-full rounded-full transition-all duration-500 shadow-lg" 
                         style="width: {{ ($barangs->currentPage() / $barangs->lastPage()) * 100 }}%">
                    </div>
                </div>
                
                <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500 dark:text-gray-400">
                    <div class="flex items-center gap-4">
                        <span class="flex items-center gap-1.5">
                            <i class="fas fa-file-alt text-blue-500 dark:text-blue-400"></i>
                            Per halaman: <strong class="text-gray-700 dark:text-gray-300">10 items</strong>
                        </span>
                        <span class="hidden sm:inline">•</span>
                        <span class="flex items-center gap-1.5">
                            <i class="fas fa-layer-group text-indigo-500 dark:text-indigo-400"></i>
                            Total halaman: <strong class="text-gray-700 dark:text-gray-300">{{ $barangs->lastPage() }}</strong>
                        </span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        @if ($barangs->currentPage() > 1)
                            <a href="{{ $barangs->url(1) }}" 
                               class="px-3 py-1.5 bg-white dark:bg-gray-800 hover:bg-slate-50 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all text-xs font-medium border border-slate-200 dark:border-gray-600">
                                <i class="fas fa-fast-backward mr-1"></i>
                                Awal
                            </a>
                        @endif
                        
                        @if ($barangs->currentPage() < $barangs->lastPage())
                            <a href="{{ $barangs->url($barangs->lastPage()) }}" 
                               class="px-3 py-1.5 bg-white dark:bg-gray-800 hover:bg-slate-50 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all text-xs font-medium border border-slate-200 dark:border-gray-600">
                                Akhir
                                <i class="fas fa-fast-forward ml-1"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @else
            {{-- Empty State --}}
            <div class="px-6 py-16 text-center">
                <div class="max-w-sm mx-auto">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <i class="fas fa-inbox text-4xl text-blue-500 dark:text-blue-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Tidak ada data barang</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">
                        @if(request()->hasAny(['search', 'kategori_id', 'status', 'kondisi']))
                            Tidak ditemukan barang yang sesuai dengan filter yang diterapkan.
                        @else
                            Belum ada barang yang terdaftar dalam sistem inventaris.
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'kategori_id', 'status', 'kondisi']))
                        <a href="{{ route('admin.barang.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                            <i class="fas fa-redo mr-2"></i>
                            Reset Filter
                        </a>
                    @else
                        <a href="{{ route('admin.barang.create') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Barang Pertama
                        </a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Modals --}}

    {{-- Delete Modal --}}
    <div id="delete-modal" class="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-[9999] transition-all duration-300" style="display: none;">
        <div class="relative top-20 mx-auto p-5 border-0 w-11/12 max-w-md shadow-2xl rounded-xl bg-white dark:bg-gray-800 animate-slide-up">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-lg mr-3">
                            <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Hapus Barang</h3>
                    </div>
                    <button type="button" onclick="closeModal('delete-modal')" class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="delete-form" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800">
                        <p class="text-sm text-red-800 dark:text-red-300 mb-1 font-medium">Barang yang akan dihapus:</p>
                        <p id="delete-barang-name" class="font-semibold text-red-900 dark:text-red-200"></p>
                        <p class="text-xs text-red-600 dark:text-red-400 mt-2">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            Tindakan ini tidak dapat dibatalkan!
                        </p>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeModal('delete-modal')" 
                                class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-medium transition-all">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 rounded-lg font-medium transition-all shadow-md hover:shadow-lg">
                            Hapus Barang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Import Modal --}}
    <div id="import-modal" class="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-[9999] transition-all duration-300" style="display: none;">
        <div class="relative top-20 mx-auto p-5 border-0 w-11/12 max-w-md shadow-2xl rounded-xl bg-white dark:bg-gray-800 animate-slide-up">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg mr-3">
                            <i class="fas fa-upload text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Import Data Barang</h3>
                    </div>
                    <button type="button" onclick="closeModal('import-modal')" class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div class="mb-5 p-4 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-xl border border-indigo-200 dark:border-indigo-800">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h5 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-1">
                                <i class="fas fa-file-download text-indigo-600 dark:text-indigo-400 mr-2"></i>
                                Template Excel
                            </h5>
                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                Download template untuk format import yang benar
                            </p>
                        </div>
                        <a href="{{ route('admin.barang.template') }}" 
                        class="ml-3 inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                            <i class="fas fa-download mr-2"></i>
                            Download
                        </a>
                    </div>
                </div>
                <form action="{{ route('admin.barang.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            File Excel (.xlsx/.xls) <span class="text-red-500">*</span>
                        </label>
                        <input type="file" 
                               name="file" 
                               id="file" 
                               accept=".xlsx,.xls" 
                               required 
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            File maksimal 2MB. Format: Excel (.xlsx atau .xls)
                        </p>
                    </div>

                    <div class="mb-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                        <h4 class="text-sm font-medium text-blue-800 dark:text-blue-300 mb-2">Format File Excel:</h4>
                        <ul class="text-xs text-blue-700 dark:text-blue-400 space-y-1">
                            <li>• nama_barang, kategori, merk, type</li>
                            <li>• jumlah_total, harga_sewa, kondisi</li>
                            <li>• Pastikan nama kategori sesuai dengan yang ada</li>
                        </ul>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeModal('import-modal')" 
                                class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-medium transition-all">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-lg font-medium transition-all shadow-md hover:shadow-lg">
                            <i class="fas fa-upload mr-2"></i>
                            Import Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Maintenance Modal - Update bagian ini di admin.barang.index --}}
    <div id="maintenance-modal" class="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-[9999] transition-all duration-300" style="display: none;">
        <div class="relative top-20 mx-auto p-5 border-0 w-11/12 max-w-md shadow-2xl rounded-xl bg-white dark:bg-gray-800 animate-slide-up">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-orange-100 dark:bg-orange-900/30 rounded-lg mr-3">
                            <i class="fas fa-tools text-orange-600 dark:text-orange-400"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Jadwalkan Maintenance</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1" id="maintenance-barang-name"></p>
                        </div>
                    </div>
                    <button type="button" onclick="closeModal('maintenance-modal')" class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            
            <form id="maintenance-form" method="POST" action="">
                @csrf
                
                <!-- Info Stok -->
                <div class="mb-4 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-lg border border-blue-200 dark:border-blue-700">
                    <div class="flex items-center justify-between text-sm mb-2">
                        <span class="text-blue-700 dark:text-blue-400 font-medium">Stok Tersedia:</span>
                        <span class="font-bold text-blue-900 dark:text-blue-300 text-lg" id="stok-tersedia">0 unit</span>
                    </div>
                    <div id="stok-maintenance-section" class="hidden flex items-center justify-between text-sm pt-2 border-t border-blue-200 dark:border-blue-700">
                        <span class="text-orange-700 dark:text-orange-400">Sedang Maintenance:</span>
                        <span class="font-semibold text-orange-900 dark:text-orange-300" id="stok-maintenance">0 unit</span>
                    </div>
                    <div class="flex items-center justify-between text-sm pt-2 border-t border-blue-200 dark:border-blue-700">
                        <span class="text-gray-700 dark:text-gray-300">Total Stok:</span>
                        <span class="font-semibold text-gray-900 dark:text-gray-100" id="stok-total">0 unit</span>
                    </div>
                </div>

                <!-- ✅ TAMBAHAN: Tanggal Maintenance -->
                <div class="mb-4">
                    <label for="maintenance-tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Tanggal Maintenance <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="date" 
                            name="tanggal" 
                            id="maintenance-tanggal"
                            required
                            min="{{ date('Y-m-d') }}"
                            value="{{ date('Y-m-d') }}"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-orange-500 dark:focus:ring-orange-400 focus:border-orange-500 dark:focus:border-orange-400 transition-all">
                        <div class="absolute left-3 top-2.5 text-gray-400 dark:text-gray-500">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Tanggal mulai maintenance (tidak bisa mundur dari hari ini)
                    </p>
                </div>

                <!-- Jumlah Unit -->
                <div class="mb-4">
                    <label for="maintenance-jumlah" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Jumlah Unit <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" 
                            name="jumlah" 
                            id="maintenance-jumlah"
                            min="1" 
                            value="1"
                            required
                            class="w-full px-3 py-2 pr-10 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-orange-500 dark:focus:ring-orange-400 focus:border-orange-500 dark:focus:border-orange-400 transition-all"
                            oninput="updateMaintenancePreviewModal()">
                        <div class="absolute right-3 top-2.5 text-gray-400 dark:text-gray-500">
                            <i class="fas fa-calculator"></i>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            <span id="max-unit-text">Maksimal: 0 unit</span>
                        </p>
                        <div class="flex space-x-1" id="quick-buttons"></div>
                    </div>
                </div>

                <!-- Preview Stok -->
                <div id="maintenance-preview" class="mb-4 p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-800 hidden">
                    <div class="flex items-center text-sm text-yellow-800 dark:text-yellow-300">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <span>Stok tersedia setelah maintenance: <strong id="maintenance-preview-value">0</strong> unit</span>
                    </div>
                </div>

                <!-- Jenis Maintenance -->
                <div class="mb-4">
                    <label for="maintenance-jenis" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Jenis Maintenance <span class="text-red-500">*</span>
                    </label>
                    <select name="jenis_maintenance" 
                            id="maintenance-jenis"
                            required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-orange-500 dark:focus:ring-orange-400 focus:border-orange-500 dark:focus:border-orange-400 transition-all">
                        <option value="">Pilih Jenis</option>
                        <option value="preventif">🛡️ Preventif (Pencegahan Rutin)</option>
                        <option value="korektif">🔧 Korektif (Perbaikan)</option>
                        <option value="emergency">⚠️ Emergency (Darurat/Rusak Berat)</option>
                    </select>
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label for="maintenance-deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Deskripsi Maintenance <span class="text-red-500">*</span>
                    </label>
                    <textarea name="deskripsi" 
                            id="maintenance-deskripsi"
                            rows="3" 
                            required
                            maxlength="500"
                            placeholder="Contoh: Penggantian komponen rusak, pembersihan menyeluruh..."
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500 rounded-lg focus:ring-2 focus:ring-orange-500 dark:focus:ring-orange-400 focus:border-orange-500 dark:focus:border-orange-400 resize-none transition-all"></textarea>
                    <div class="flex items-center justify-between mt-1">
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            <span id="maintenance-char-count" class="font-semibold">0</span>/500 karakter
                        </p>
                        <p class="text-xs text-red-600 dark:text-red-400 font-medium">Minimal 10 karakter</p>
                    </div>
                </div>

                <!-- Teknisi -->
                <div class="mb-4">
                    <label for="maintenance-teknisi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nama Teknisi <span class="text-gray-400 dark:text-gray-500">(Opsional)</span>
                    </label>
                    <div class="relative">
                        <input type="text" 
                            name="teknisi" 
                            id="maintenance-teknisi"
                            placeholder="Contoh: Ahmad Maintenance Team"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500 rounded-lg focus:ring-2 focus:ring-orange-500 dark:focus:ring-orange-400 focus:border-orange-500 dark:focus:border-orange-400 transition-all">
                        <div class="absolute left-3 top-2.5 text-gray-400 dark:text-gray-500">
                            <i class="fas fa-user-cog"></i>
                        </div>
                    </div>
                </div>

                <!-- Biaya -->
                <div class="mb-4">
                    <label for="maintenance-biaya" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Estimasi Biaya <span class="text-gray-400 dark:text-gray-500">(Opsional)</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-gray-500 dark:text-gray-400 font-medium">Rp</span>
                        <input type="number" 
                            name="biaya" 
                            id="maintenance-biaya"
                            min="0"
                            placeholder="0"
                            class="w-full pl-10 pr-10 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500 rounded-lg focus:ring-2 focus:ring-orange-500 dark:focus:ring-orange-400 focus:border-orange-500 dark:focus:border-orange-400 transition-all">
                        <div class="absolute right-3 top-2.5 text-gray-400 dark:text-gray-500">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>

                <!-- Warning -->
                <div class="mb-4 p-3 bg-amber-50 dark:bg-amber-900/20 rounded-lg border border-amber-200 dark:border-amber-800">
                    <div class="flex items-start">
                        <i class="fas fa-exclamation-triangle text-amber-600 dark:text-amber-400 mt-0.5 mr-2"></i>
                        <div>
                            <p class="text-xs text-amber-800 dark:text-amber-300 font-medium">Perhatian!</p>
                            <p class="text-xs text-amber-700 dark:text-amber-400 mt-1">
                                Unit yang dijadwalkan maintenance akan dikurangi dari stok tersedia dan tidak dapat dipinjam hingga selesai.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeModal('maintenance-modal')" 
                            class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-medium transition-all">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 text-white bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 rounded-lg font-medium transition-all shadow-md hover:shadow-lg">
                        <i class="fas fa-tools mr-2"></i>
                        Jadwalkan Maintenance
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>

    {{-- Enhanced Notifications --}}
    <div class="fixed top-4 right-4 z-50 space-y-3" id="notification-container">
        {{-- Success Alert --}}
        @if(session('success'))
        <div id="notification-success" class="notification success bg-white/95 dark:bg-gray-800/95 rounded-xl shadow-2xl border-l-4 border-green-500 p-4 max-w-md backdrop-blur-sm animate-fade-in">
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0">
                    <div class="p-2.5 bg-green-100 dark:bg-green-900/50 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-lg"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-bold text-gray-900 dark:text-gray-100 mb-1">Berhasil!</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ session('success') }}</p>
                </div>
                <button onclick="hideNotification('notification-success')" 
                        class="flex-shrink-0 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-all">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        @endif

        {{-- Warning Alert --}}
        @if(session('warning'))
        <div id="notification-warning" class="notification bg-white/95 dark:bg-gray-800/95 rounded-xl shadow-2xl border-l-4 border-amber-500 p-4 max-w-md backdrop-blur-sm animate-fade-in">
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0">
                    <div class="p-2.5 bg-amber-100 dark:bg-amber-900/50 rounded-lg">
                        <i class="fas fa-exclamation-circle text-amber-600 dark:text-amber-400 text-lg"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-bold text-gray-900 dark:text-gray-100 mb-1">Peringatan!</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ session('warning') }}</p>
                </div>
                <button onclick="hideNotification('notification-warning')" 
                        class="flex-shrink-0 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-all">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        @endif

        {{-- Error Alert --}}
        @if(session('error'))
        <div id="notification-error" class="notification error bg-white/95 dark:bg-gray-800/95 rounded-xl shadow-2xl border-l-4 border-red-500 p-4 max-w-md backdrop-blur-sm animate-fade-in">
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0">
                    <div class="p-2.5 bg-red-100 dark:bg-red-900/50 rounded-lg">
                        <i class="fas fa-exclamation-circle text-red-600 dark:text-red-400 text-lg"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-bold text-gray-900 dark:text-gray-100 mb-1">Error!</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ session('error') }}</p>
                </div>
                <button onclick="hideNotification('notification-error')" 
                        class="flex-shrink-0 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-all">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        @endif

        {{-- Error Detail Section --}}
        @if(session('import_errors'))
        <div id="notification-import-errors" class="notification bg-white/95 dark:bg-gray-800/95 rounded-xl shadow-2xl border-l-4 border-red-500 p-4 max-w-md backdrop-blur-sm animate-fade-in">
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0">
                    <div class="p-2.5 bg-red-100 dark:bg-red-900/50 rounded-lg">
                        <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400 text-lg"></i>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="text-sm font-bold text-gray-900 dark:text-gray-100 mb-2">Detail Error Import</h4>
                    <div class="max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                        <ul class="space-y-1.5 text-xs text-gray-600 dark:text-gray-300">
                            @foreach(session('import_errors') as $error)
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-times-circle text-red-500 mt-0.5 flex-shrink-0"></i>
                                    <span>{{ $error }}</span>
                                </li>
                            @endforeach
                        </ul>
                        
                        @if(session('more_errors') > 0)
                            <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-700">
                                <p class="text-xs text-red-600 dark:text-red-400 font-medium">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Dan {{ session('more_errors') }} error lainnya tidak ditampilkan
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
                <button onclick="hideNotification('notification-import-errors')" 
                        class="flex-shrink-0 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-all">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
// ===== MODAL FUNCTIONS =====
function deleteModal(id, barangName) {
    const modal = document.getElementById('delete-modal');
    document.getElementById('delete-barang-name').textContent = barangName;
    document.getElementById('delete-form').action = "{{ url('admin/barang') }}/" + id;
    modal.classList.remove('hidden');
    modal.style.display = 'block';
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        modal.style.display = 'none';
    }
}

function showImportModal() {
    const modal = document.getElementById('import-modal');
    modal.classList.remove('hidden');
    modal.style.display = 'block';
}

function hideNotification(notificationId) {
    const notification = document.getElementById(notificationId || 'notification');
    if (notification) {
        notification.style.animation = 'slideOutRight 0.5s ease-in forwards';
        setTimeout(() => notification.remove(), 500);
    }
}

// Auto-hide notifications setelah 8 detik
document.addEventListener('DOMContentLoaded', function() {
    @if(session('success'))
        setTimeout(() => hideNotification('notification-success'), 8000);
    @endif
    
    @if(session('warning'))
        setTimeout(() => hideNotification('notification-warning'), 10000);
    @endif
    
    @if(session('error'))
        setTimeout(() => hideNotification('notification-error'), 10000);
    @endif
    
    @if(session('import_errors'))
        setTimeout(() => hideNotification('notification-import-errors'), 15000);
    @endif
});

function toggleStatusDropdown(barangId) {
    const dropdown = document.getElementById(`status-dropdown-${barangId}`);
    document.querySelectorAll('[id^="status-dropdown-"]').forEach(el => {
        if (el.id !== `status-dropdown-${barangId}`) {
            el.classList.add('hidden');
        }
    });
    dropdown.classList.toggle('hidden');
}

function updateStatus(barangId, status) {
    fetch("{{ url('admin/barang') }}/" + barangId + "/update-status", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
        body: JSON.stringify({ status: status.toLowerCase() })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Status berhasil diubah!');
            location.reload();
        } else {
            alert('Gagal mengupdate status: ' + (data.message || ''));
        }
    })
    .catch(error => {
        alert('Terjadi kesalahan: ' + error.message);
    });
    
    document.getElementById(`status-dropdown-${barangId}`).classList.add('hidden');
}

function toggleDapatDipinjam(barangId, currentStatus) {
    const newStatus = !currentStatus;
    const statusText = newStatus ? 'dapat dipinjam' : 'tidak dapat dipinjam';
    
    if (!confirm(`Ubah status menjadi "${statusText}"?`)) {
        return;
    }
    
    fetch(`/admin/barang/${barangId}/toggle-dapat-dipinjam`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
        body: JSON.stringify({ dapat_dipinjam: newStatus })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Status berhasil diubah!');
            location.reload();
        } else {
            alert('Gagal mengupdate status: ' + (data.message || ''));
        }
    })
    .catch(error => {
        alert('Terjadi kesalahan: ' + error.message);
    });
}

function showMaintenanceModal(barangId) {
    console.log('Opening maintenance modal for barang:', barangId);
    
    // Set form action dengan route yang benar
    document.getElementById('maintenance-form').action = `/admin/barang/${barangId}/maintenance`;
    
    // Fetch data barang via endpoint yang SUDAH ADA di routes
    fetch(`/api/barang/${barangId}`)
        .then(response => {
            if (!response.ok) throw new Error('Gagal memuat data barang');
            return response.json();
        })
        .then(data => {
            console.log('Raw API Response:', data);
            
            // ✅ HANDLE BERBAGAI STRUKTUR DATA
            let barang;
            
            // Jika data dibungkus dalam property 'data'
            if (data.data) {
                barang = data.data;
            } 
            // Jika data dibungkus dalam property 'barang'
            else if (data.barang) {
                barang = data.barang;
            }
            // Jika data langsung berupa object barang
            else {
                barang = data;
            }
            
            console.log('Processed Barang data:', barang);
            
            // ✅ AMBIL NILAI dengan fallback
            const jumlahTersedia = barang.jumlah_tersedia ?? barang.stok_tersedia ?? barang.tersedia ?? 0;
            const jumlahTotal = barang.jumlah_total ?? barang.stok_total ?? barang.total ?? 0;
            const jumlahMaintenance = barang.jumlah_maintenance ?? barang.stok_maintenance ?? barang.maintenance ?? 0;
            const namaBarang = barang.nama_barang ?? barang.nama ?? 'Unknown';
            
            console.log('Extracted values:', {
                jumlahTersedia,
                jumlahTotal,
                jumlahMaintenance,
                namaBarang
            });
            
            // ✅ VALIDASI: Cek apakah stok tersedia
            if (jumlahTersedia <= 0) {
                alert(`❌ Tidak dapat menjadwalkan maintenance!\n\nBarang: ${namaBarang}\nStok tersedia: ${jumlahTersedia} unit\n\nBarang harus memiliki stok tersedia minimal 1 unit untuk dijadwalkan maintenance.`);
                return; // Stop execution
            }
            
            // Set info barang
            document.getElementById('maintenance-barang-name').textContent = namaBarang;
            document.getElementById('stok-tersedia').textContent = `${jumlahTersedia} unit`;
            document.getElementById('stok-total').textContent = `${jumlahTotal} unit`;
            
            // Show/hide maintenance section
            if (jumlahMaintenance > 0) {
                document.getElementById('stok-maintenance-section').classList.remove('hidden');
                document.getElementById('stok-maintenance').textContent = `${jumlahMaintenance} unit`;
            } else {
                document.getElementById('stok-maintenance-section').classList.add('hidden');
            }
            
            // Set max jumlah
            const jumlahInput = document.getElementById('maintenance-jumlah');
            jumlahInput.setAttribute('max', jumlahTersedia);
            jumlahInput.value = 1;
            document.getElementById('max-unit-text').textContent = `Maksimal: ${jumlahTersedia} unit`;
            
            // Generate quick buttons
            const quickButtons = document.getElementById('quick-buttons');
            quickButtons.innerHTML = '';
            
            if (jumlahTersedia > 0) {
                const amounts = [1];
                if (jumlahTersedia >= 5) amounts.push(5);
                if (jumlahTersedia >= 10) amounts.push(10);
                if (jumlahTersedia > 1) amounts.push(jumlahTersedia);

                amounts.forEach(amount => {
                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.textContent = amount === jumlahTersedia ? 'Semua' : amount;
                    btn.className = amount === jumlahTersedia 
                        ? 'px-2 py-1 text-xs bg-blue-100 dark:bg-blue-900/50 hover:bg-blue-200 dark:hover:bg-blue-800/50 text-blue-700 dark:text-blue-300 rounded transition-all'
                        : 'px-2 py-1 text-xs bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded transition-all';
                    btn.onclick = () => {
                        jumlahInput.value = amount;
                        updateMaintenancePreviewModal();
                    };
                    quickButtons.appendChild(btn);
                });
            }
            
            // Reset form
            document.getElementById('maintenance-form').reset();
            jumlahInput.value = 1;
            
            // Reset tanggal ke hari ini
            const tanggalInput = document.getElementById('maintenance-tanggal');
            if (tanggalInput) {
                tanggalInput.value = new Date().toISOString().split('T')[0];
            }
            
            document.getElementById('maintenance-char-count').textContent = '0';
            updateMaintenancePreviewModal();
            
            // Show modal
            const modal = document.getElementById('maintenance-modal');
            modal.classList.remove('hidden');
            modal.style.display = 'block';
            console.log('Modal displayed successfully');
        })
        .catch(error => {
            console.error('Error fetching barang data:', error);
            alert('❌ Gagal memuat data barang!\n\nError: ' + error.message + '\n\nSilakan coba lagi atau hubungi administrator.');
        });
}

function updateMaintenancePreviewModal() {
    const input = document.getElementById('maintenance-jumlah');
    const preview = document.getElementById('maintenance-preview');
    const previewValue = document.getElementById('maintenance-preview-value');
    
    const max = parseInt(input.getAttribute('max')) || 0;
    const value = parseInt(input.value) || 0;
    const remaining = max - value;
    
    previewValue.textContent = remaining;
    
    if (value > 0 && value <= max) {
        preview.classList.remove('hidden');
        
        if (remaining === 0) {
            preview.className = 'mb-4 p-3 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800';
        } else if (remaining < 5) {
            preview.className = 'mb-4 p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-800';
        } else {
            preview.className = 'mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800';
        }
    } else {
        preview.classList.add('hidden');
    }
    
    // Validasi real-time
    if (value > max) {
        input.value = max;
        alert(`⚠️ Maksimal ${max} unit yang tersedia`);
    }
}

// Character counter untuk deskripsi
document.getElementById('maintenance-deskripsi')?.addEventListener('input', function() {
    const counter = document.getElementById('maintenance-char-count');
    counter.textContent = this.value.length;
    
    if (this.value.length < 10) {
        counter.className = 'text-red-600 dark:text-red-400 font-semibold';
    } else {
        counter.className = 'text-green-600 dark:text-green-400 font-semibold';
    }
});

// ✅ Form validation sebelum submit dengan VALIDASI TANGGAL
document.getElementById('maintenance-form')?.addEventListener('submit', function(e) {
    const deskripsi = document.getElementById('maintenance-deskripsi').value;
    const jumlah = parseInt(document.getElementById('maintenance-jumlah').value);
    const max = parseInt(document.getElementById('maintenance-jumlah').getAttribute('max'));
    const jenisInput = document.getElementById('maintenance-jenis');
    const tanggalInput = document.getElementById('maintenance-tanggal');
    
    // ✅ VALIDASI TANGGAL
    if (!tanggalInput || !tanggalInput.value) {
        e.preventDefault();
        alert('❌ Pilih tanggal maintenance terlebih dahulu');
        tanggalInput?.focus();
        return false;
    }
    
    // ✅ VALIDASI TANGGAL TIDAK BOLEH MUNDUR
    const selectedDate = new Date(tanggalInput.value);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    
    if (selectedDate < today) {
        e.preventDefault();
        alert('❌ Tanggal maintenance tidak boleh mundur dari hari ini!');
        tanggalInput.focus();
        return false;
    }
    
    // Validasi jenis maintenance
    if (!jenisInput || !jenisInput.value) {
        e.preventDefault();
        alert('❌ Pilih jenis maintenance terlebih dahulu');
        jenisInput?.focus();
        return false;
    }
    
    // Validasi deskripsi
    if (deskripsi.length < 10) {
        e.preventDefault();
        alert('❌ Deskripsi harus minimal 10 karakter');
        document.getElementById('maintenance-deskripsi').focus();
        return false;
    }
    
    // Validasi jumlah
    if (jumlah < 1 || jumlah > max) {
        e.preventDefault();
        alert(`❌ Jumlah tidak valid!\n\nJumlah harus antara 1 dan ${max} unit\nStok tersedia: ${max} unit`);
        document.getElementById('maintenance-jumlah').focus();
        return false;
    }
    
    // Validasi stok tersedia
    if (max <= 0) {
        e.preventDefault();
        alert('❌ Tidak dapat menjadwalkan maintenance!\n\nTidak ada stok tersedia.');
        return false;
    }
    
    // Disable submit button
    const submitBtn = this.querySelector('button[type="submit"]');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
    }
});

// ✅ VALIDASI TANGGAL SAAT BERUBAH
document.getElementById('maintenance-tanggal')?.addEventListener('change', function() {
    const selectedDate = new Date(this.value);
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    
    if (selectedDate < today) {
        alert('⚠️ Tanggal maintenance tidak boleh mundur!');
        this.value = today.toISOString().split('T')[0];
    }
});

function closeMaintenanceModal(barangId) {
    const modal = document.getElementById(`maintenance-modal-${barangId}`);
    if (modal) {
        modal.classList.add('hidden');
    }
}

function updateMaintenancePreview(barangId) {
    const input = document.getElementById(`jumlah-${barangId}`);
    const preview = document.getElementById(`preview-${barangId}`);
    const previewValue = document.getElementById(`preview-value-${barangId}`);
    
    if (input && preview && previewValue) {
        const max = parseInt(input.getAttribute('max'));
        const value = parseInt(input.value) || 0;
        const remaining = max - value;
        
        previewValue.textContent = remaining;
        
        if (value > 0) {
            preview.classList.remove('hidden');
            
            if (remaining === 0) {
                preview.className = 'mb-4 p-3 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800';
            } else if (remaining < 5) {
                preview.className = 'mb-4 p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-800';
            } else {
                preview.className = 'mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800';
            }
        } else {
            preview.classList.add('hidden');
        }
    }
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Loaded - Setting up event listeners');
    
    // Close modal on backdrop click
    document.addEventListener('click', function(event) {
        // Delete modal
        const deleteModal = document.getElementById('delete-modal');
        if (event.target === deleteModal) {
            closeModal('delete-modal');
        }
        
        // Import modal
        const importModal = document.getElementById('import-modal');
        if (event.target === importModal) {
            closeModal('import-modal');
        }
        
        // Maintenance modal
        const maintenanceModal = document.getElementById('maintenance-modal');
        if (event.target === maintenanceModal) {
            closeModal('maintenance-modal');
        }
        
        // Close status dropdowns
        if (!event.target.closest('[onclick*="toggleStatusDropdown"]') && 
            !event.target.closest('[id^="status-dropdown-"]')) {
            document.querySelectorAll('[id^="status-dropdown-"]').forEach(el => {
                el.classList.add('hidden');
            });
        }
    });
    
    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal('delete-modal');
            closeModal('import-modal');
            closeModal('maintenance-modal');
            document.querySelectorAll('[id^="status-dropdown-"]').forEach(el => {
                el.classList.add('hidden');
            });
        }
    });
});

@if(session('success') || session('error'))
setTimeout(() => hideNotification(), 5000);
@endif

// File upload validation
const fileInput = document.getElementById('file');
if (fileInput) {
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const fileSize = file.size / 1024 / 1024; // Convert to MB
            const fileName = file.name.toLowerCase();
            const allowedExtensions = ['.xlsx', '.xls'];
            const allowedTypes = [
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.ms-excel'
            ];
            
            if (fileSize > 2) {
                alert('❌ Ukuran file terlalu besar.\nMaksimal: 2MB\nUkuran file Anda: ' + fileSize.toFixed(2) + 'MB');
                this.value = '';
                return false;
            }
            
            const hasValidExtension = allowedExtensions.some(ext => fileName.endsWith(ext));
            if (!hasValidExtension) {
                alert('❌ Format file tidak valid.\nHanya file Excel yang diizinkan (.xlsx atau .xls)\nFile Anda: ' + fileName);
                this.value = '';
                return false;
            }
            
            if (!allowedTypes.includes(file.type)) {
                alert('❌ Tipe file tidak valid.\nHanya file Excel yang diizinkan\nTipe file Anda: ' + file.type);
                this.value = '';
                return false;
            }
            
            const dangerousChars = /[<>:"/\\|?*]/;
            if (dangerousChars.test(fileName)) {
                alert('❌ Nama file mengandung karakter tidak valid.\nHindari karakter: < > : " / \\ | ? *');
                this.value = '';
                return false;
            }
        }
    });
}

// ===== DELETE FORM VALIDATION =====
document.addEventListener('DOMContentLoaded', function() {
    const deleteForm = document.getElementById('delete-form');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            const barangName = document.getElementById('delete-barang-name').textContent;
            
            if (!barangName || barangName.trim() === '') {
                e.preventDefault();
                alert('❌ Error: Data barang tidak valid');
                return false;
            }
            
            const confirmed = confirm(`⚠️ KONFIRMASI PENGHAPUSAN\n\nApakah Anda yakin ingin menghapus:\n"${barangName}"\n\nTindakan ini tidak dapat dibatalkan!`);
            
            if (!confirmed) {
                e.preventDefault();
                return false;
            }
            
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menghapus...';
            }
        });
    }
});

// ===== IMPORT FORM VALIDATION =====
const importForm = document.querySelector('form[action*="import"]');
if (importForm) {
    importForm.addEventListener('submit', function(e) {
        const fileInput = this.querySelector('input[type="file"]');
        
        if (!fileInput || !fileInput.files.length) {
            e.preventDefault();
            alert('❌ Pilih file Excel terlebih dahulu');
            return false;
        }
        
        const file = fileInput.files[0];
        const fileSize = file.size / 1024 / 1024;
        
        if (fileSize > 2) {
            e.preventDefault();
            alert('❌ Ukuran file terlalu besar: ' + fileSize.toFixed(2) + 'MB\nMaksimal: 2MB');
            return false;
        }
        
        const confirmed = confirm(`📋 KONFIRMASI IMPORT DATA\n\nFile: ${file.name}\nUkuran: ${fileSize.toFixed(2)}MB\n\nData yang ada mungkin akan tertimpa.\nLanjutkan import?`);
        
        if (!confirmed) {
            e.preventDefault();
            return false;
        }
        
        const submitBtn = this.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengimpor...';
        }
    });
}

// Validasi input pencarian
const searchInput = document.querySelector('input[name="search"]');
if (searchInput) {
    searchInput.addEventListener('input', function() {
        const value = this.value;
        const dangerousPatterns = [
            /<script/i,
            /javascript:/i,
            /on\w+\s*=/i,
            /<iframe/i,
            /<object/i,
            /<embed/i
        ];
        
        if (dangerousPatterns.some(pattern => pattern.test(value))) {
            this.value = value.replace(/[<>'"]/g, '');
            alert('⚠️ Karakter berbahaya dihapus dari pencarian');
        }
        
        if (value.length > 100) {
            this.value = value.substring(0, 100);
            alert('⚠️ Pencarian dibatasi maksimal 100 karakter');
        }
    });
    
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            if (this.value.trim().length < 2 && this.value.trim().length > 0) {
                alert('⚠️ Pencarian minimal 2 karakter');
                return;
            }
            this.closest('form').submit();
        }
    });
}

// Session timeout
let sessionTimeout;
function resetSessionTimeout() {
    clearTimeout(sessionTimeout);
    sessionTimeout = setTimeout(function() {
        alert('⏰ Sesi akan berakhir dalam 5 menit.\nSimpan pekerjaan Anda!');
        setTimeout(function() {
            alert('🔒 Sesi telah berakhir. Halaman akan dimuat ulang.');
            window.location.reload();
        }, 5 * 60 * 1000);
    }, 25 * 60 * 1000);
}

document.addEventListener('click', resetSessionTimeout);
document.addEventListener('keypress', resetSessionTimeout);
document.addEventListener('scroll', resetSessionTimeout);
resetSessionTimeout();

// Prevent multiple form submissions
let isSubmitting = false;
document.addEventListener('submit', function(e) {
    if (isSubmitting) {
        e.preventDefault();
        alert('⚠️ Form sedang diproses. Mohon tunggu...');
        return false;
    }
    isSubmitting = true;
    
    setTimeout(() => {
        isSubmitting = false;
    }, 10000);
});

// Add slideOutRight animation
const style = document.createElement('style');
style.textContent = `
    @keyframes slideOutRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
`;
document.head.appendChild(style);

// Character counter untuk maintenance deskripsi
document.querySelectorAll('[id^="deskripsi-"]').forEach(textarea => {
    const barangId = textarea.id.replace('deskripsi-', '');
    const counter = document.getElementById(`char-count-${barangId}`);
    
    if (counter) {
        textarea.addEventListener('input', function() {
            counter.textContent = this.value.length;
            
            if (this.value.length < 10) {
                counter.className = 'text-red-600 dark:text-red-400 font-semibold';
            } else {
                counter.className = 'text-green-600 dark:text-green-400 font-semibold';
            }
        });
    }
});

// Validasi input jumlah real-time
document.querySelectorAll('[id^="jumlah-"]').forEach(input => {
    input.addEventListener('input', function() {
        const max = parseInt(this.getAttribute('max'));
        const value = parseInt(this.value);
        
        if (value > max) {
            this.value = max;
            alert(`⚠️ Maksimal ${max} unit yang tersedia`);
        }
        
        if (value < 1 && this.value !== '') {
            this.value = 1;
        }
    });
    
    input.addEventListener('change', function() {
        const barangId = this.id.replace('jumlah-', '');
        updateMaintenancePreview(barangId);
    });
});
</script>
@endpush