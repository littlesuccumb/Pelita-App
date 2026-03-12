@extends('layouts.app')

@section('title', 'Kelola Kategori Barang - Admin')

@push('styles')
<style>
/* Dark mode transitions */
* {
    transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
}

/* ===== IMPROVED ENTRANCE ANIMATIONS ===== */
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
    transition: all 0.3s ease;
}

.action-btn:hover {
    transform: scale(1.1);
}

@media (max-width: 1024px) {
    .table-row:hover {
        background: transparent;
        transform: none;
    }
    
    .action-btn:hover {
        transform: none;
    }
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

.card-hover {
    transition: all 0.3s ease-in-out;
}

.card-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -8px rgba(0, 0, 0, 0.15);
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

.badge-count { background-color: #dbeafe; color: #1e40af; }
.dark .badge-count { background-color: #1e3a8a; color: #93c5fd; }
</style>
@endpush

@section('content')
<div class="w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 lg:py-4">
        {{-- Modern Breadcrumb Navigation --}}
        <nav class="breadcrumb-modern mb-8 animate-smooth-fade" aria-label="Breadcrumb">
            <a href="{{ route('dashboard') }}" class="breadcrumb-link">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs"></i>              
            <span class="breadcrumb-current">
                <i class="fas fa-tags"></i>
                <span>Kelola Kategori Barang</span>
            </span>
        </nav>

        {{-- Modern Header Section - COMPACT VERSION --}}
        <div class="mb-8 animate-gentle-scale delay-100">
            <div class="relative overflow-hidden bg-gradient-to-br from-white via-blue-50/30 to-indigo-50/50 dark:from-gray-800 dark:via-gray-800/95 dark:to-gray-800/90 rounded-2xl shadow-xl border border-white/60 dark:border-gray-700 backdrop-blur-sm">
                
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-400/20 via-indigo-400/20 to-purple-400/20 dark:from-blue-600/10 dark:via-indigo-600/10 dark:to-purple-600/10 rounded-full blur-3xl transform translate-x-32 -translate-y-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-cyan-400/15 to-blue-400/15 dark:from-cyan-600/10 dark:to-blue-600/10 rounded-full blur-2xl transform -translate-x-24 translate-y-24"></div>
                
                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                    <div class="absolute top-10 left-10 w-2 h-2 bg-blue-400 dark:bg-blue-500 rounded-full animate-pulse opacity-60"></div>
                    <div class="absolute top-20 right-20 w-1.5 h-1.5 bg-indigo-400 dark:bg-indigo-500 rounded-full animate-pulse opacity-40" style="animation-delay: 0.5s;"></div>
                    <div class="absolute bottom-16 left-1/3 w-1 h-1 bg-purple-400 dark:bg-purple-500 rounded-full animate-pulse opacity-50" style="animation-delay: 1s;"></div>
                </div>
                
                {{-- COMPACT CONTENT --}}
                <div class="relative p-4 sm:p-6 lg:p-10">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        
                        <div class="flex-1">
                            <div class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-blue-500/10 to-indigo-500/10 dark:from-blue-600/20 dark:to-indigo-600/20 border border-blue-200/50 dark:border-blue-700/50 rounded-full mb-4">
                                <div class="w-2 h-2 bg-blue-500 dark:bg-blue-400 rounded-full animate-pulse"></div>
                                <span class="text-sm font-semibold text-blue-700 dark:text-blue-300">Management System</span>
                            </div>
                            
                            <h1 class="text-2xl sm:text-3xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-blue-800 to-indigo-800 dark:from-slate-100 dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent leading-tight">
                                Kelola Kategori Barang
                            </h1>
                            
                            <p class="text-slate-600 dark:text-slate-400 text-base sm:text-lg flex items-center space-x-2">
                                <i class="fas fa-info-circle text-blue-500 dark:text-blue-400"></i>
                                <span>Kelola kategori untuk mengorganisir barang inventaris</span>
                            </p>
                            
                            {{-- COMPACT STATS --}}
                            <div class="flex flex-wrap items-center gap-3 mt-4">
                                <div class="flex items-center space-x-2 px-3 py-2 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm rounded-lg border border-slate-200/50 dark:border-gray-600/50 shadow-sm">
                                    <div class="p-1.5 bg-blue-100 dark:bg-blue-900/50 rounded-md">
                                        <i class="fas fa-layer-group text-blue-600 dark:text-blue-400 text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Total Kategori</p>
                                        <p class="text-base font-bold text-slate-800 dark:text-slate-200">{{ $kategoriBarang->total() }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-2 px-3 py-2 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm rounded-lg border border-emerald-200/50 dark:border-emerald-800/50 shadow-sm">
                                    <div class="p-1.5 bg-emerald-100 dark:bg-emerald-900/50 rounded-md">
                                        <i class="fas fa-boxes text-emerald-600 dark:text-emerald-400 text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Total Barang</p>
                                        <p class="text-base font-bold text-slate-800 dark:text-slate-200">{{ $kategoriBarang->sum('barang_count') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- COMPACT BUTTONS --}}
                        <div class="flex flex-col gap-3">
                            <a href="{{ route('admin.kategori-barang.create') }}" 
                               class="group relative inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
                                <i class="fas fa-plus mr-2"></i>
                                <span class="relative text-sm sm:text-base">Tambah Kategori</span>
                            </a>
                            
                            <a href="{{ route('admin.kategori-barang.index') }}" 
                               class="group relative inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3.5 bg-white dark:bg-gray-700 hover:bg-slate-50 dark:hover:bg-gray-600 border-2 border-slate-200 dark:border-gray-600 hover:border-slate-300 dark:hover:border-gray-500 text-slate-700 dark:text-slate-200 font-semibold rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
                                <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-blue-500/5 to-indigo-500/5 dark:from-blue-600/10 dark:to-indigo-600/10 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                                <i class="fas fa-sync-alt mr-2 text-slate-600 dark:text-slate-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 group-hover:rotate-180 transition-all duration-500"></i>
                                <span class="relative text-sm sm:text-base">Refresh Data</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="h-1.5 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>
            </div>
        </div>

        {{-- Stats Cards - COMPACT VERSION --}}
        <div class="mb-8 animate-professional-reveal delay-200">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                        <i class="fas fa-chart-pie text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Statistik Kategori</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Overview statistik kategori real-time</p>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-lg border border-gray-200 dark:border-gray-600">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-xs text-gray-600 dark:text-gray-300 font-medium">Live Update</span>
                </div>
            </div>
            
            {{-- COMPACT CARDS --}}
            <div class="grid grid-cols-2 gap-3 lg:grid-cols-3 lg:gap-5">
                
                <div class="group relative overflow-hidden bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
                    
                    <div class="relative p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-layer-group text-white text-2xl"></i>
                            </div>
                            <div class="flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full">
                                <i class="fas fa-arrow-up text-white text-xs"></i>
                                <span class="text-white text-xs font-bold">100%</span>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-blue-100 text-sm font-medium">Total Kategori</p>
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white">{{ $kategoriBarang->total() }}</h3>
                                <span class="text-blue-100 text-sm">kategori</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                            <span class="text-blue-100 text-xs font-medium">Kategori terdaftar</span>
                            <i class="fas fa-list text-blue-100 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="group relative overflow-hidden bg-gradient-to-br from-emerald-500 via-emerald-600 to-green-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
                    
                    <div class="relative p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-boxes text-white text-2xl"></i>
                            </div>
                            <div class="flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full">
                                <i class="fas fa-cube text-white text-xs"></i>
                                <span class="text-white text-xs font-bold">Items</span>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-emerald-100 text-sm font-medium">Total Barang</p>
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white">{{ $kategoriBarang->sum('barang_count') }}</h3>
                                <span class="text-emerald-100 text-sm">items</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                            <span class="text-emerald-100 text-xs font-medium">Item terkategorisasi</span>
                            <i class="fas fa-check-circle text-emerald-100 text-sm"></i>
                        </div>
                    </div>
                </div>

                <div class="group relative overflow-hidden bg-gradient-to-br from-purple-500 via-purple-600 to-indigo-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 col-span-2 lg:col-span-1">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
                    
                    <div class="relative p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-chart-bar text-white text-2xl"></i>
                            </div>
                            <div class="flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full">
                                <i class="fas fa-percentage text-white text-xs"></i>
                                <span class="text-white text-xs font-bold">AVG</span>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-purple-100 text-sm font-medium">Rata-rata per Kategori</p>
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white">
                                    {{ $kategoriBarang->total() > 0 ? number_format($kategoriBarang->sum('barang_count') / $kategoriBarang->total(), 1) : 0 }}
                                </h3>
                                <span class="text-purple-100 text-sm">items</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                            <span class="text-purple-100 text-xs font-medium">Barang per kategori</span>
                            <i class="fas fa-calculator text-purple-100 text-sm"></i>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="mt-6 p-4 bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 dark:from-blue-900/20 dark:via-indigo-900/20 dark:to-purple-900/20 rounded-xl border border-blue-100 dark:border-blue-800">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-500 rounded-lg">
                            <i class="fas fa-info-circle text-white"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">Statistik Update Otomatis</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Data diperbarui setiap kali ada perubahan kategori</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300">
                                {{ $kategoriBarang->total() }} Kategori
                            </span>
                        </div>
                        <div class="h-4 w-px bg-gray-300 dark:bg-gray-600"></div>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300">
                                {{ $kategoriBarang->sum('barang_count') }} Barang
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter Section - COMPACT VERSION --}}
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
                            <p class="text-sm text-gray-500 dark:text-gray-400">Filter data kategori sesuai kebutuhan</p>
                        </div>
                    </div>
                    
                    <form method="GET" action="{{ route('admin.kategori-barang.index') }}">
                        {{-- COMPACT SEARCH --}}
                        <div class="mb-6">
                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
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
                                    placeholder="Cari nama kategori atau deskripsi..." 
                                    class="block w-full pl-10 lg:pl-11 pr-3 lg:pr-4 py-2.5 lg:py-3.5 text-sm lg:text-base bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 focus:border-blue-500 dark:focus:border-blue-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500">
                            </div>
                        </div>

                        {{-- COMPACT BUTTONS --}}
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex gap-3">
                                <button type="submit" class="group relative inline-flex items-center px-4 lg:px-6 py-2.5 lg:py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm lg:text-base font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                    <i class="fas fa-search mr-2 group-hover:scale-110 transition-transform"></i>
                                    Filter Data
                                </button>
                                <a href="{{ route('admin.kategori-barang.index') }}" 
                                class="group inline-flex items-center px-4 lg:px-6 py-2.5 lg:py-3 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm lg:text-base font-semibold rounded-xl transition-all duration-300">
                                    <i class="fas fa-redo mr-2 group-hover:rotate-180 transition-transform duration-500"></i>
                                    Reset
                                </a>
                            </div>
                            
                            <div class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                                <i class="fas fa-database text-blue-600 dark:text-blue-400"></i>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Total:</span>
                                    <span class="font-bold text-gray-900 dark:text-gray-100">{{ $kategoriBarang->total() }}</span>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">Kategori</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Enhanced Data Table -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden animate-professional-reveal delay-400">
            <!-- Table Header -->
            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700/50 dark:to-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg mr-3">
                            <i class="fas fa-list text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Daftar Kategori Barang</h3>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $kategoriBarang->count() }} dari {{ $kategoriBarang->total() }} data
                    </div>
                </div>
            </div>

            @if($kategoriBarang->count() > 0)
            <!-- Desktop Table -->
            <div class="hidden lg:block">
                <table class="min-w-full divide-y divide-slate-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-slate-200 via-blue-100 to-indigo-100 dark:from-gray-700 dark:via-gray-700/80 dark:to-gray-700">
                        <tr>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-hashtag text-blue-500 dark:text-blue-400"></i>
                                    No
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-tag text-purple-500 dark:text-purple-400"></i>
                                    Nama Kategori
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-align-left text-indigo-500 dark:text-indigo-400"></i>
                                    Deskripsi
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-cubes text-green-500 dark:text-green-400"></i>
                                    Jumlah Barang
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-cogs text-red-500 dark:text-red-400"></i>
                                    Aksi
                                </div>
                            </th>
                    </thead>
                    <tbody class="bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/30 dark:from-gray-800 dark:via-gray-800/95 dark:to-gray-800/90 divide-y divide-slate-100 dark:divide-gray-700">
                        @foreach($kategoriBarang as $index => $kategori)
                        <tr class="table-row hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="px-6 py-5">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $kategoriBarang->firstItem() + $index }}
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg mr-4">
                                        <i class="fas fa-layer-group text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $kategori->nama_kategori }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            Dibuat: {{ $kategori->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-sm text-gray-700 dark:text-gray-300">
                                    {{ $kategori->deskripsi ?: '-' }}
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center">
                                    <span class="badge badge-count">
                                        <i class="fas fa-cube"></i>
                                        {{ $kategori->barang_count }} Item
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.kategori-barang.show', $kategori->id) }}" 
                                    class="p-2.5 text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 hover:bg-blue-100 dark:hover:bg-blue-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md action-btn" 
                                    title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.kategori-barang.edit', $kategori->id) }}" 
                                    class="p-2.5 text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/30 hover:bg-green-100 dark:hover:bg-green-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md action-btn" 
                                    title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="deleteModal('{{ $kategori->id }}', '{{ $kategori->nama_kategori }}', {{ $kategori->barang_count }})"
                                            class="p-2.5 text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 dark:hover:bg-red-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md action-btn" 
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Enhanced Mobile Cards -->
            <div class="lg:hidden divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($kategoriBarang as $index => $kategori)
                <div class="p-4 card-hover">
                    <div class="bg-gradient-to-r from-gray-50 to-white dark:from-gray-700/50 dark:to-gray-800/50 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg mr-3">
                                    <i class="fas fa-layer-group text-white"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $kategori->nama_kategori }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        {{ $kategori->created_at->format('d M Y') }}
                                    </div>
                                </div>
                            </div>
                            <span class="badge badge-count">
                                <i class="fas fa-cube"></i>
                                {{ $kategori->barang_count }}
                            </span>
                        </div>

                        <div class="space-y-2 mb-4">
                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                <span class="font-medium">Deskripsi:</span>
                                <div class="text-gray-700 dark:text-gray-400 mt-1">{{ $kategori->deskripsi ?: 'Tidak ada deskripsi' }}</div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('admin.kategori-barang.show', $kategori->id) }}" 
                               class="inline-flex items-center px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs font-medium rounded-lg hover:bg-blue-200 dark:hover:bg-blue-800/40 transition-all">
                                <i class="fas fa-eye mr-1"></i>
                                Detail
                            </a>
                            <a href="{{ route('admin.kategori-barang.edit', $kategori->id) }}" 
                               class="inline-flex items-center px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-medium rounded-lg hover:bg-green-200 dark:hover:bg-green-800/40 transition-all">
                                <i class="fas fa-edit mr-1"></i>
                                Edit
                            </a>
                            <button onclick="deleteModal('{{ $kategori->id }}', '{{ $kategori->nama_kategori }}', {{ $kategori->barang_count }})"
                                    class="inline-flex items-center px-3 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-xs font-medium rounded-lg hover:bg-red-200 dark:hover:bg-red-800/40 transition-all">
                                <i class="fas fa-trash mr-1"></i>
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Enhanced Modern Pagination -->
            <div class="bg-gradient-to-r from-slate-100 via-blue-50 to-indigo-50 dark:from-gray-700 dark:via-gray-800 dark:to-gray-700 px-6 py-6 border-t border-slate-200 dark:border-gray-600">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                    <!-- Left Info -->
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-3 px-4 py-2.5 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-slate-200 dark:border-gray-600">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900/50 rounded-lg">
                                <i class="fas fa-info-circle text-blue-600 dark:text-blue-400 text-sm"></i>
                            </div>
                            <div class="text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Menampilkan</span>
                                <span class="font-bold text-gray-900 dark:text-gray-100 mx-1">{{ $kategoriBarang->firstItem() ?? 0 }}-{{ $kategoriBarang->lastItem() ?? 0 }}</span>
                                <span class="text-gray-600 dark:text-gray-400">dari</span>
                                <span class="font-bold text-blue-600 dark:text-blue-400 mx-1">{{ $kategoriBarang->total() }}</span>
                                <span class="text-gray-600 dark:text-gray-400">data</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pagination Controls -->
                    <div class="flex items-center gap-2">
                        @if ($kategoriBarang->onFirstPage())
                            <button disabled class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 rounded-xl cursor-not-allowed border border-gray-200 dark:border-gray-600">
                                <i class="fas fa-chevron-left text-sm"></i>
                            </button>
                        @else
                            <a href="{{ $kategoriBarang->previousPageUrl() }}" 
                               class="px-4 py-2.5 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 rounded-xl transition-all border border-slate-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-600 shadow-sm hover:shadow-md">
                                <i class="fas fa-chevron-left text-sm"></i>
                            </a>
                        @endif
                        
                        <div class="hidden sm:flex items-center gap-2">
                            @foreach ($kategoriBarang->getUrlRange(1, $kategoriBarang->lastPage()) as $page => $url)
                                @if ($page == $kategoriBarang->currentPage())
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
                        
                        <!-- Mobile Page Info -->
                        <div class="sm:hidden px-4 py-2.5 bg-white dark:bg-gray-800 rounded-xl border border-slate-200 dark:border-gray-600 shadow-sm">
                            <span class="text-sm font-bold text-gray-900 dark:text-gray-100">{{ $kategoriBarang->currentPage() }}</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400 mx-1">/</span>
                            <span class="text-sm text-gray-600 dark:text-gray-300">{{ $kategoriBarang->lastPage() }}</span>
                        </div>
                        
                        @if ($kategoriBarang->hasMorePages())
                            <a href="{{ $kategoriBarang->nextPageUrl() }}" 
                               class="px-4 py-2.5 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 rounded-xl transition-all border border-slate-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-600 shadow-sm hover:shadow-md">
                                <i class="fas fa-chevron-right text-sm"></i>
                            </a>
                        @else
                            <button disabled class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 rounded-xl cursor-not-allowed border border-gray-200 dark:border-gray-600">
                                <i class="fas fa-chevron-right text-sm"></i>
                            </button>
                        @endif
                    </div>
                    
                    <!-- Right Quick Jump (Optional) -->
                    <div class="hidden lg:flex items-center gap-3">
                        <span class="text-sm text-gray-600 dark:text-gray-400 font-medium">Halaman:</span>
                        <div class="relative">
                            <select id="page-select" onchange="window.location.href=this.value" 
                                    class="appearance-none pl-4 pr-10 py-2.5 bg-white dark:bg-gray-800 border-2 border-slate-200 dark:border-gray-600 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-300 hover:border-blue-300 dark:hover:border-blue-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all cursor-pointer">
                                @for ($i = 1; $i <= $kategoriBarang->lastPage(); $i++)
                                    <option value="{{ $kategoriBarang->url($i) }}" {{ $i == $kategoriBarang->currentPage() ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center justify-center pr-3 pointer-events-none transition-transform duration-200">
                                <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Progress Bar -->
                <div class="mt-4 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 h-full rounded-full transition-all duration-500 shadow-lg" 
                         style="width: {{ ($kategoriBarang->currentPage() / $kategoriBarang->lastPage()) * 100 }}%">
                    </div>
                </div>
                
                <!-- Additional Info Footer -->
                <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500 dark:text-gray-400">
                    <div class="flex items-center gap-4">
                        <span class="flex items-center gap-1.5">
                            <i class="fas fa-file-alt text-blue-500 dark:text-blue-400"></i>
                            Per halaman: <strong class="text-gray-700 dark:text-gray-300">{{ $kategoriBarang->count() }}</strong>
                        </span>
                        <span class="hidden sm:inline">•</span>
                        <span class="flex items-center gap-1.5">
                            <i class="fas fa-layer-group text-indigo-500 dark:text-indigo-400"></i>
                            Total halaman: <strong class="text-gray-700 dark:text-gray-300">{{ $kategoriBarang->lastPage() }}</strong>
                        </span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        @if ($kategoriBarang->currentPage() > 1)
                            <a href="{{ $kategoriBarang->url(1) }}" 
                               class="px-3 py-1.5 bg-white dark:bg-gray-800 hover:bg-slate-50 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all text-xs font-medium border border-slate-200 dark:border-gray-600">
                                <i class="fas fa-fast-backward mr-1"></i>
                                Awal
                            </a>
                        @endif
                        
                        @if ($kategoriBarang->currentPage() < $kategoriBarang->lastPage())
                            <a href="{{ $kategoriBarang->url($kategoriBarang->lastPage()) }}" 
                               class="px-3 py-1.5 bg-white dark:bg-gray-800 hover:bg-slate-50 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all text-xs font-medium border border-slate-200 dark:border-gray-600">
                                Akhir
                                <i class="fas fa-fast-forward ml-1"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @else
            <!-- Empty State -->
            <div class="px-6 py-12 text-center">
                <svg class="w-16 h-16 text-gray-400 dark:text-gray-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">Tidak ada kategori</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">
                    @if(request()->filled('search'))
                        Tidak ditemukan kategori yang sesuai dengan pencarian.
                    @else
                        Belum ada kategori yang terdaftar dalam sistem.
                    @endif
                </p>
                @if(request()->filled('search'))
                    <a href="{{ route('admin.kategori-barang.index') }}" 
                       class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl text-white bg-slate-600 hover:bg-slate-700 dark:bg-slate-700 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all duration-200">
                        Reset Filter
                    </a>
                @else
                    <a href="{{ route('admin.kategori-barang.create') }}" 
                       class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl text-white bg-blue-600 hover:bg-blue-700 transition-all">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Kategori Pertama
                    </a>
                @endif
            </div>
            @endif
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="delete-modal" class="fixed inset-0 modal-backdrop overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border-0 w-11/12 max-w-md shadow-2xl rounded-xl bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-lg mr-3">
                            <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Hapus Kategori</h3>
                    </div>
                    <button onclick="closeModal('delete-modal')" class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="delete-form" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800">
                        <p class="text-sm text-red-800 dark:text-red-300 mb-1 font-medium">Kategori yang akan dihapus:</p>
                        <p id="delete-kategori-name" class="font-semibold text-red-900 dark:text-red-200"></p>
                        <div id="delete-warning" class="hidden mt-3 p-3 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg">
                            <p class="text-xs text-yellow-800 dark:text-yellow-300">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                <span id="barang-count"></span>
                            </p>
                        </div>
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
                                id="delete-submit-btn"
                                class="px-4 py-2 text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 rounded-lg font-medium transition-all shadow-md hover:shadow-lg">
                            Hapus Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Enhanced Notifications -->
    @if(session('success'))
    <div id="notification" class="fixed top-4 right-4 z-50">
        <div class="notification success bg-white/90 dark:bg-gray-800/90 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 p-4 max-w-sm backdrop-blur-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 dark:text-green-400"></i>
                    </div>
                </div>
                <div class="ml-3">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Berhasil!</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ session('success') }}</p>
                </div>
                <button onclick="hideNotification()" class="ml-auto text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-1 rounded transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div id="notification" class="fixed top-4 right-4 z-50">
        <div class="notification error bg-white/90 dark:bg-gray-800/90 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 p-4 max-w-sm backdrop-blur-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-lg">
                        <i class="fas fa-exclamation-circle text-red-600 dark:text-red-400"></i>
                    </div>
                </div>
                <div class="ml-3">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Error!</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ session('error') }}</p>
                </div>
                <button onclick="hideNotification()" class="ml-auto text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-1 rounded transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>

    @endif
@endsection

@push('scripts')
<script>
function deleteModal(id, kategoriName, barangCount) {
    document.getElementById('delete-kategori-name').textContent = kategoriName;
    document.getElementById('delete-form').action = "{{ url('admin/kategori-barang') }}/" + id;
    
    const deleteWarning = document.getElementById('delete-warning');
    const deleteBtn = document.getElementById('delete-submit-btn');
    const barangCountEl = document.getElementById('barang-count');
    
    if (barangCount > 0) {
        deleteWarning.classList.remove('hidden');
        barangCountEl.textContent = `Kategori ini memiliki ${barangCount} barang. Kategori tidak dapat dihapus!`;
        deleteBtn.disabled = true;
        deleteBtn.classList.add('opacity-50', 'cursor-not-allowed');
        deleteBtn.innerHTML = '<i class="fas fa-ban mr-2"></i>Tidak Dapat Dihapus';
    } else {
        deleteWarning.classList.add('hidden');
        deleteBtn.disabled = false;
        deleteBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        deleteBtn.innerHTML = '<i class="fas fa-trash mr-2"></i>Hapus Kategori';
    }
    
    document.getElementById('delete-modal').classList.remove('hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

function hideNotification() {
    const notification = document.getElementById('notification');
    if (notification) {
        notification.style.animation = 'slideOutRight 0.5s ease-in forwards';
        setTimeout(() => notification.remove(), 500);
    }
}

// Event listeners
document.addEventListener('click', function(event) {
    const deleteModal = document.getElementById('delete-modal');
    
    if (event.target === deleteModal) {
        closeModal('delete-modal');
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal('delete-modal');
    }
});

// Auto hide notifications
@if(session('success') || session('error'))
setTimeout(() => hideNotification(), 5000);
@endif

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
            alert('Karakter berbahaya dihapus dari pencarian');
        }
        
        if (value.length > 100) {
            this.value = value.substring(0, 100);
            alert('Pencarian dibatasi maksimal 100 karakter');
        }
    });
    
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            if (this.value.trim().length < 2 && this.value.trim().length > 0) {
                alert('Pencarian minimal 2 karakter');
                return;
            }
            this.closest('form').submit();
        }
    });
}

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    const deleteForm = document.getElementById('delete-form');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            const kategoriName = document.getElementById('delete-kategori-name').textContent;
            const deleteBtn = document.getElementById('delete-submit-btn');
            
            if (!kategoriName || kategoriName.trim() === '') {
                e.preventDefault();
                alert('Error: Data kategori tidak valid');
                return false;
            }
            
            if (deleteBtn.disabled) {
                e.preventDefault();
                alert('Kategori tidak dapat dihapus karena masih memiliki barang');
                return false;
            }
            
            const confirmed = confirm(`KONFIRMASI PENGHAPUSAN\n\nApakah Anda yakin ingin menghapus kategori:\n"${kategoriName}"\n\nTindakan ini tidak dapat dibatalkan!`);
            
            if (!confirmed) {
                e.preventDefault();
                return false;
            }
            
            // Disable tombol
            deleteBtn.disabled = true;
            deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menghapus...';
        });
    }
});

// Prevent multiple form submissions
let isSubmitting = false;
document.addEventListener('submit', function(e) {
    if (isSubmitting) {
        e.preventDefault();
        alert('Form sedang diproses. Mohon tunggu...');
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

// Console log
console.log('%c✅ Kategori Barang Dashboard Loaded', 'color: #3B82F6; font-size: 14px; font-weight: bold;');
console.log('%c🌓 Dark Mode Support Active!', 'color: #10B981; font-size: 12px;');
</script>
@endpush