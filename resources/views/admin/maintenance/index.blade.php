@extends('layouts.app')

@section('title', 'Kelola Maintenance - Admin')

@push('styles')
<style>

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

.table-row {
    transition: all 0.2s ease;
}

.table-row:hover {
    background: linear-gradient(90deg, rgba(59, 130, 246, 0.05), rgba(59, 130, 246, 0.02));
    transform: translateX(2px);
}

.dark .table-row:hover {
    background: linear-gradient(90deg, rgba(59, 130, 246, 0.1), rgba(59, 130, 246, 0.05));
}

.badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 8px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 500;
}

.badge i {
    font-size: 11px;
}

/* Custom Select Styling */
select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-image: none;
}

select::-ms-expand {
    display: none;
}

.badge-dijadwalkan { background-color: #dbeafe; color: #1e40af; }
.badge-dalam_proses { background-color: #fef3c7; color: #92400e; }
.badge-selesai { background-color: #dcfce7; color: #166534; }
.badge-dibatalkan { background-color: #fee2e2; color: #991b1b; }

.dark .badge-dijadwalkan { background-color: #1e3a8a; color: #bfdbfe; }
.dark .badge-dalam_proses { background-color: #78350f; color: #fef3c7; }
.dark .badge-selesai { background-color: #14532d; color: #bbf7d0; }
.dark .badge-dibatalkan { background-color: #7f1d1d; color: #fecaca; }

.badge-preventif { background-color: #e0e7ff; color: #3730a3; }
.badge-korektif { background-color: #fef3c7; color: #92400e; }
.badge-emergency { background-color: #fee2e2; color: #991b1b; }

.dark .badge-preventif { background-color: #312e81; color: #c7d2fe; }
.dark .badge-korektif { background-color: #78350f; color: #fef3c7; }
.dark .badge-emergency { background-color: #7f1d1d; color: #fecaca; }

/* Status Dot Animation */
.status-dot {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    animation: pulse 2s infinite;
}

@keyframes slideOutRight {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(100%); opacity: 0; }
}

@media (prefers-reduced-motion: reduce) {
    * {
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
        
        {{-- Breadcrumb --}}
        <nav class="breadcrumb-modern mb-8 animate-smooth-fade" aria-label="Breadcrumb">
            <a href="{{ route('dashboard') }}" class="breadcrumb-link">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>              
            <i class="fas fa-chevron-right text-dark dark:text-white text-xs"></i>               
            <span class="breadcrumb-current">
                <i class="fas fa-tools"></i>
                    <span>Kelola Maintenance</span>
            </span>      
        </nav>

        {{-- Header Section --}}
        <div class="mb-8 animate-gentle-scale delay-100">
            <div class="relative overflow-hidden bg-gradient-to-br from-white via-orange-50/30 to-red-50/50 dark:from-gray-800 dark:via-gray-800/95 dark:to-gray-800/90 rounded-2xl shadow-xl border border-white/60 dark:border-gray-700 backdrop-blur-sm">
                
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-orange-400/20 via-red-400/20 to-pink-400/20 dark:from-orange-600/10 dark:via-red-600/10 dark:to-pink-600/10 rounded-full blur-3xl transform translate-x-32 -translate-y-32"></div>
                
                <div class="relative p-4 sm:p-6 lg:p-10">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        
                        <div class="flex-1">
                            <div class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-orange-500/10 to-red-500/10 dark:from-orange-600/20 dark:to-red-600/20 border border-orange-200/50 dark:border-orange-700/50 rounded-full mb-4">
                                <div class="w-2 h-2 bg-orange-500 dark:bg-orange-400 rounded-full animate-pulse"></div>
                                <span class="text-sm font-semibold text-orange-700 dark:text-orange-300">Maintenance Management</span>
                            </div>
                            
                            <h1 class="text-2xl sm:text-3xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-orange-800 to-red-800 dark:from-slate-100 dark:via-orange-200 dark:to-red-200 bg-clip-text text-transparent leading-tight">
                                Kelola Maintenance
                            </h1>
                            
                            <p class="text-slate-600 dark:text-slate-300 text-lg flex items-center space-x-2">
                                <i class="fas fa-info-circle text-orange-500 dark:text-orange-400"></i>
                                <span>Monitor dan kelola jadwal maintenance barang dan aset</span>
                            </p>
                            
                            <div class="flex flex-wrap items-center gap-4 mt-6">
                                <div class="flex items-center space-x-2 px-4 py-2 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm rounded-lg border border-slate-200/50 dark:border-gray-600/50 shadow-sm">
                                    <div class="p-1.5 bg-orange-100 dark:bg-orange-900/50 rounded-md">
                                        <i class="fas fa-tools text-orange-600 dark:text-orange-400 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Total Maintenance</p>
                                        <p class="text-lg font-bold text-slate-800 dark:text-slate-100">{{ $stats['total'] ?? 0 }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-2 px-4 py-2 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm rounded-lg border border-yellow-200/50 dark:border-yellow-800/50 shadow-sm">
                                    <div class="p-1.5 bg-yellow-100 dark:bg-yellow-900/50 rounded-md">
                                        <i class="fas fa-clock text-yellow-600 dark:text-yellow-400 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Aktif</p>
                                        <p class="text-lg font-bold text-slate-800 dark:text-slate-100">{{ $stats['aktif'] ?? 0 }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Bagian Tombol -->
                        <div class="flex flex-col gap-3">
                            <!-- Tombol Tambah Maintenance -->
                            <a href="{{ route('admin.maintenance.create') }}" 
                            class="group relative inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 w-full">
                                <i class="fas fa-plus mr-2.5"></i>
                                <span class="relative">Tambah Maintenance</span>
                            </a>

                            <!-- Export Buttons Container -->
                            <div class="grid grid-cols-2 gap-3">
                                <!-- Export Excel -->
                                <form method="GET" action="{{ route('admin.maintenance.export') }}" class="w-full">
                                    <input type="hidden" name="status" value="{{ request('status', 'all') }}">
                                    <input type="hidden" name="jenis_maintenance" value="{{ request('jenis_maintenance') }}">
                                    <input type="hidden" name="tanggal_dari" value="{{ request('tanggal_dari') }}">
                                    <input type="hidden" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}">
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                    
                                    <button type="submit" name="format" value="excel"
                                            class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                        <i class="fas fa-file-excel"></i>
                                        <span>Excel</span>
                                    </button>
                                </form>

                                <!-- Export PDF -->
                                <form method="GET" action="{{ route('admin.maintenance.export') }}" class="w-full">
                                    <input type="hidden" name="status" value="{{ request('status', 'all') }}">
                                    <input type="hidden" name="jenis_maintenance" value="{{ request('jenis_maintenance') }}">
                                    <input type="hidden" name="tanggal_dari" value="{{ request('tanggal_dari') }}">
                                    <input type="hidden" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}">
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                    <input type="hidden" name="format" value="pdf">
                                    
                                    <button type="submit"
                                            class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                        <i class="fas fa-file-pdf"></i>
                                        <span>PDF</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h-1.5 bg-gradient-to-r from-orange-500 via-red-500 to-pink-500"></div>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="mb-8 animate-professional-reveal delay-200">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl shadow-lg">
                        <i class="fas fa-chart-pie text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Status Maintenance</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Overview maintenance real-time</p>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-lg border border-gray-200 dark:border-gray-600">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-xs text-gray-600 dark:text-gray-300 font-medium">Live Update</span>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-3 lg:grid-cols-4 lg:gap-5">
                
                {{-- Total Maintenance --}}
                <div class="group relative overflow-hidden bg-gradient-to-br from-orange-500 via-orange-600 to-red-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    
                    <div class="relative p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                                <i class="fas fa-tools text-white text-2xl"></i>
                            </div>
                            <div class="flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full">
                                <span class="text-white text-xs font-bold">Total</span>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-orange-100 text-sm font-medium">Total Maintenance</p>
                            <h3 class="text-2xl sm:text-3xl font-black text-white">{{ $stats['total'] ?? 0 }}</h3>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20">
                            <span class="text-orange-100 text-xs font-medium">Semua jadwal</span>
                        </div>
                    </div>
                </div>

                {{-- Aktif --}}
                <div class="group relative overflow-hidden bg-gradient-to-br from-yellow-500 via-yellow-600 to-amber-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    
                    <div class="relative p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                                <i class="fas fa-clock text-white text-2xl"></i>
                            </div>
                            <div class="flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full">
                                <div class="w-2 h-2 bg-yellow-200 rounded-full animate-pulse"></div>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-yellow-100 text-sm font-medium">Sedang Aktif</p>
                            <h3 class="text-2xl sm:text-3xl font-black text-white">{{ $stats['aktif'] ?? 0 }}</h3>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20">
                            <span class="text-yellow-100 text-xs font-medium">Dijadwalkan & Proses</span>
                        </div>
                    </div>
                </div>

                {{-- Selesai --}}
                <div class="group relative overflow-hidden bg-gradient-to-br from-emerald-500 via-emerald-600 to-green-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    
                    <div class="relative p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                                <i class="fas fa-check-circle text-white text-2xl"></i>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-emerald-100 text-sm font-medium">Selesai</p>
                            <h3 class="text-2xl sm:text-3xl font-black text-white">{{ $stats['selesai'] ?? 0 }}</h3>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20">
                            <span class="text-emerald-100 text-xs font-medium">Total Biaya: Rp {{ number_format($stats['total_biaya'] ?? 0, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Unit Maintenance --}}
                <div class="group relative overflow-hidden bg-gradient-to-br from-red-500 via-red-600 to-rose-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    
                    <div class="relative p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                                <i class="fas fa-cubes text-white text-2xl"></i>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-red-100 text-sm font-medium">Unit dalam Maintenance</p>
                            <h3 class="text-2xl sm:text-3xl font-black text-white">{{ $stats['total_unit_maintenance'] ?? 0 }}</h3>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20">
                            <span class="text-red-100 text-xs font-medium">Total unit aktif</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Quick Info Bar -->
        <div class="mt-6 p-4 mb-8 bg-gradient-to-r from-orange-50 via-red-50 to-pink-50 dark:from-orange-900/20 dark:via-red-900/20 dark:to-pink-900/20 rounded-xl border border-orange-100 dark:border-orange-800">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-orange-500 rounded-lg">
                        <i class="fas fa-info-circle text-white"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">Informasi Maintenance Real-time</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Data diperbarui setiap kali ada perubahan status maintenance</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4 flex-wrap">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                        <span class="text-xs font-medium text-gray-700 dark:text-gray-300">
                            {{ $stats['dijadwalkan'] ?? 0 }} Dijadwalkan
                        </span>
                    </div>
                    <div class="h-4 w-px bg-gray-300 dark:bg-gray-600"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full animate-pulse"></div>
                        <span class="text-xs font-medium text-gray-700 dark:text-gray-300">
                            {{ $stats['dalam_proses'] ?? 0 }} Proses
                        </span>
                    </div>
                    <div class="h-4 w-px bg-gray-300 dark:bg-gray-600"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <span class="text-xs font-medium text-gray-700 dark:text-gray-300">
                            {{ $stats['selesai'] ?? 0 }} Selesai
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter Section - COMPACT VERSION --}}
        <div class="mb-8 animate-elegant-slide delay-300">
            <div class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700">
                
                <div class="relative p-4 sm:p-6 lg:p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-3 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl shadow-lg">
                            <i class="fas fa-filter text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Filter & Pencarian</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Filter data maintenance sesuai kebutuhan</p>
                        </div>
                    </div>
                    
                    <form method="GET" action="{{ route('admin.maintenance.index') }}">
                        {{-- Filter Inputs Grid - COMPACT VERSION --}}
                        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-6">
                            
                            {{-- Search Input --}}
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-search text-orange-500 dark:text-orange-400"></i>
                                    Pencarian
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 lg:pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400 dark:text-gray-500 text-sm lg:text-base group-focus-within:text-orange-500 dark:group-focus-within:text-orange-400 transition-colors"></i>
                                    </div>
                                    <input type="text" 
                                        name="search"
                                        value="{{ request('search') }}"
                                        placeholder="Cari barang, teknisi..." 
                                        class="block w-full pl-10 lg:pl-11 pr-3 lg:pr-4 py-2.5 lg:py-3 text-sm lg:text-base bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-orange-500/20 dark:focus:ring-orange-400/20 focus:border-orange-500 dark:focus:border-orange-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500">
                                </div>
                            </div>

                            {{-- Status Filter --}}
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-info-circle text-emerald-500 dark:text-emerald-400"></i>
                                    Status
                                </label>
                                <div class="relative">
                                    <select name="status" class="block w-full px-3 lg:px-4 py-2.5 lg:py-3 pr-10 text-sm lg:text-base bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-orange-500/20 dark:focus:ring-orange-400/20 focus:border-orange-500 dark:focus:border-orange-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-gray-900 dark:text-gray-100 appearance-none cursor-pointer">
                                        <option value="all" {{ request('status', 'all') == 'all' ? 'selected' : '' }}>
                                            Semua Status
                                        </option>
                                        <option value="dijadwalkan" {{ request('status') == 'dijadwalkan' ? 'selected' : '' }}>
                                            🕐 Dijadwalkan
                                        </option>
                                        <option value="dalam_proses" {{ request('status') == 'dalam_proses' ? 'selected' : '' }}>
                                            ⚙️ Dalam Proses
                                        </option>
                                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>
                                            ✅ Selesai
                                        </option>
                                        <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>
                                            ❌ Dibatalkan
                                        </option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Jenis Maintenance --}}
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-wrench text-purple-500 dark:text-purple-400"></i>
                                    Jenis
                                </label>
                                <div class="relative">
                                    <select name="jenis_maintenance" class="block w-full px-3 lg:px-4 py-2.5 lg:py-3 pr-10 text-sm lg:text-base bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-orange-500/20 dark:focus:ring-orange-400/20 focus:border-orange-500 dark:focus:border-orange-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-gray-900 dark:text-gray-100 appearance-none cursor-pointer">
                                        <option value="">
                                            Semua Jenis
                                        </option>
                                        <option value="preventif" {{ request('jenis_maintenance') == 'preventif' ? 'selected' : '' }}>
                                            📅 Preventif
                                        </option>
                                        <option value="korektif" {{ request('jenis_maintenance') == 'korektif' ? 'selected' : '' }}>
                                            🔨 Korektif
                                        </option>
                                        <option value="emergency" {{ request('jenis_maintenance') == 'emergency' ? 'selected' : '' }}>
                                            🚨 Emergency
                                        </option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Date Input --}}
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-calendar text-blue-500 dark:text-blue-400"></i>
                                    Tanggal
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 lg:pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-calendar-alt text-gray-400 dark:text-gray-500 text-sm lg:text-base"></i>
                                    </div>
                                    <input type="date" 
                                        name="tanggal_dari"
                                        value="{{ request('tanggal_dari') }}"
                                        class="block w-full pl-10 lg:pl-11 pr-3 lg:pr-4 py-2.5 lg:py-3 text-sm lg:text-base bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-orange-500/20 dark:focus:ring-orange-400/20 focus:border-orange-500 dark:focus:border-orange-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-gray-900 dark:text-gray-100">
                                </div>
                            </div>

                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex gap-3">
                                <button type="submit" class="group relative inline-flex items-center px-4 lg:px-6 py-2.5 lg:py-3 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white text-sm lg:text-base font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                    <i class="fas fa-search mr-2 group-hover:scale-110 transition-transform"></i>
                                    Filter Data
                                </button>
                                <a href="{{ route('admin.maintenance.index') }}" 
                                class="group inline-flex items-center px-4 lg:px-6 py-2.5 lg:py-3 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm lg:text-base font-semibold rounded-xl transition-all duration-300">
                                    <i class="fas fa-redo mr-2 group-hover:rotate-180 transition-transform duration-500"></i>
                                    Reset
                                </a>
                            </div>
                            
                            <div class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-orange-50 to-red-50 dark:from-orange-900/20 dark:to-red-900/20 rounded-lg border border-orange-200 dark:border-orange-800">
                                <i class="fas fa-tools text-orange-600 dark:text-orange-400"></i>
                                <span class="text-sm text-gray-700 dark:text-gray-300">Total:</span>
                                <span class="font-bold text-gray-900 dark:text-gray-100">{{ $maintenance->total() }}</span>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Maintenance</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Data Table --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden animate-professional-reveal delay-400">
            
            <div class="relative px-6 lg:px-8 py-6 bg-gradient-to-r from-gray-50 via-orange-50/30 to-red-50/30 dark:from-gray-700/50 dark:via-gray-800/50 dark:to-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl shadow-lg">
                            <i class="fas fa-list text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Daftar Maintenance</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Kelola jadwal maintenance barang</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($maintenance->count() > 0)
            {{-- Desktop Table --}}
            <div class="hidden lg:block overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-slate-200 via-orange-100 to-red-100 dark:from-gray-700 dark:via-gray-700/80 dark:to-gray-700">
                        <tr>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-200 uppercase">
                                    <i class="fas fa-box text-orange-500"></i>
                                    Barang
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-200 uppercase">
                                    <i class="fas fa-wrench text-purple-500"></i>
                                    Jenis & Status
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-200 uppercase">
                                    <i class="fas fa-calendar text-blue-500"></i>
                                    Tanggal
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-200 uppercase">
                                    <i class="fas fa-user-cog text-green-500"></i>
                                    Teknisi & Biaya
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-200 uppercase">
                                    <i class="fas fa-cogs text-red-500"></i>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gradient-to-br from-slate-50 via-orange-50/30 to-red-50/30 dark:from-gray-800 dark:via-gray-800/95 dark:to-gray-800/90 divide-y divide-slate-100 dark:divide-gray-700">
                        @foreach($maintenance as $item)
                        <tr class="table-row">
                            <td class="px-6 py-5">
                                <div>
                                    <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                        @if($item->barang)
                                            {{ $item->barang->nama_barang }}
                                        @else
                                            <span class="text-red-500 dark:text-red-400">⚠️ Barang Terhapus (ID: {{ $item->aset_id }})</span>
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        <span class="font-mono bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded text-gray-700 dark:text-gray-300">
                                            {{ $item->barang?->kode_barang ?? 'N/A' }}
                                        </span>
                                        <span class="ml-2">• {{ $item->jumlah }} unit</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="space-y-2">
                                    {{-- Jenis Badge dengan Icon --}}
                                    @php
                                        $jenisConfig = [
                                            'preventif' => [
                                                'class' => 'badge-preventif',
                                                'icon' => 'fa-calendar-check',
                                                'label' => 'Preventif'
                                            ],
                                            'korektif' => [
                                                'class' => 'badge-korektif',
                                                'icon' => 'fa-wrench',
                                                'label' => 'Korektif'
                                            ],
                                            'emergency' => [
                                                'class' => 'badge-emergency',
                                                'icon' => 'fa-exclamation-triangle',
                                                'label' => 'Emergency'
                                            ]
                                        ];
                                        $jenis = $jenisConfig[$item->jenis_maintenance] ?? ['class' => '', 'icon' => 'fa-tools', 'label' => 'Unknown'];
                                    @endphp
                                    <span class="badge {{ $jenis['class'] }}">
                                        <i class="fas {{ $jenis['icon'] }}"></i>
                                        {{ $jenis['label'] }}
                                    </span>
                                    
                                    {{-- Status Badge dengan Icon dan Dot --}}
                                    @php
                                        $statusConfig = [
                                            'dijadwalkan' => [
                                                'class' => 'badge-dijadwalkan',
                                                'icon' => 'fa-clock',
                                                'label' => 'Dijadwalkan',
                                                'dot' => 'bg-blue-500'
                                            ],
                                            'dalam_proses' => [
                                                'class' => 'badge-dalam_proses',
                                                'icon' => 'fa-spinner fa-spin',
                                                'label' => 'Dalam Proses',
                                                'dot' => 'bg-yellow-500'
                                            ],
                                            'selesai' => [
                                                'class' => 'badge-selesai',
                                                'icon' => 'fa-check-circle',
                                                'label' => 'Selesai',
                                                'dot' => 'bg-green-500'
                                            ],
                                            'dibatalkan' => [
                                                'class' => 'badge-dibatalkan',
                                                'icon' => 'fa-times-circle',
                                                'label' => 'Dibatalkan',
                                                'dot' => 'bg-red-500'
                                            ]
                                        ];
                                        $status = $statusConfig[$item->status] ?? ['class' => '', 'icon' => 'fa-question', 'label' => 'Unknown', 'dot' => 'bg-gray-500'];
                                    @endphp
                                    <span class="badge {{ $status['class'] }}">
                                        @if(in_array($item->status, ['dijadwalkan', 'dalam_proses']))
                                            <span class="status-dot {{ $status['dot'] }}"></span>
                                        @endif
                                        <i class="fas {{ $status['icon'] }}"></i>
                                        {{ $status['label'] }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-sm space-y-1">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-calendar-alt text-blue-500 text-xs"></i>
                                        <span class="text-gray-900 dark:text-gray-100">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                                        </span>
                                    </div>
                                    @if($item->tanggal_selesai)
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-check-circle text-green-500 text-xs"></i>
                                        <span class="text-gray-600 dark:text-gray-400 text-xs">
                                            Selesai: {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y') }}
                                        </span>
                                    </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-sm space-y-1">
                                    <div class="text-gray-900 dark:text-gray-100">
                                        <i class="fas fa-user-tie text-indigo-500 mr-1"></i>
                                        {{ $item->teknisi ?? '-' }}
                                    </div>
                                    <div class="text-gray-600 dark:text-gray-400">
                                        <i class="fas fa-money-bill-wave text-green-500 mr-1"></i>
                                        Rp {{ number_format($item->biaya, 0, ',', '.') }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.maintenance.show', $item->id) }}" 
                                       class="p-2.5 text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 hover:bg-blue-100 dark:hover:bg-blue-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md" 
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    @if(in_array($item->status, ['dijadwalkan', 'dalam_proses']))
                                    <a href="{{ route('admin.maintenance.edit', $item->id) }}" 
                                       class="p-2.5 text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/30 hover:bg-green-100 dark:hover:bg-green-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.maintenance.complete', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="button" 
                                                onclick="showCompleteModal({{ $item->id }})"
                                                class="p-2.5 text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/30 hover:bg-emerald-100 dark:hover:bg-emerald-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md" 
                                                title="Selesaikan">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    
                                    <button type="button" 
                                            onclick="showCancelModal({{ $item->id }})"
                                            class="p-2.5 text-orange-600 dark:text-orange-400 bg-orange-50 dark:bg-orange-900/30 hover:bg-orange-100 dark:hover:bg-orange-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md" 
                                            title="Batalkan">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                    @endif
                                    
                                    <button onclick="deleteModal('{{ $item->id }}', '{{ $item->barang->nama_barang ?? 'N/A' }}')"
                                            class="p-2.5 text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 dark:hover:bg-red-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md" 
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

            {{-- Mobile Cards --}}
            <div class="lg:hidden divide-y divide-slate-100 dark:divide-gray-700">
            @foreach($maintenance as $item)
                <div class="p-5">
                    <div class="bg-gradient-to-br from-white to-orange-50/50 dark:from-gray-700 dark:to-orange-900/20 rounded-2xl p-5 border border-slate-200 dark:border-gray-600 shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">
                                    @if($item->barang)
                                        {{ $item->barang->nama_barang }}
                                    @else
                                        <span class="text-red-500 dark:text-red-400">⚠️ Barang Terhapus</span>
                                    @endif
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $item->barang?->kode_barang ?? 'N/A' }} • {{ $item->jumlah }} unit
                                </div>
                            </div>
                            
                            {{-- Status Badge dengan Icon --}}
                            @php
                                $statusConfig = [
                                    'dijadwalkan' => ['class' => 'badge-dijadwalkan', 'icon' => 'fa-clock', 'label' => 'Dijadwalkan', 'dot' => 'bg-blue-500'],
                                    'dalam_proses' => ['class' => 'badge-dalam_proses', 'icon' => 'fa-spinner fa-spin', 'label' => 'Dalam Proses', 'dot' => 'bg-yellow-500'],
                                    'selesai' => ['class' => 'badge-selesai', 'icon' => 'fa-check-circle', 'label' => 'Selesai', 'dot' => 'bg-green-500'],
                                    'dibatalkan' => ['class' => 'badge-dibatalkan', 'icon' => 'fa-times-circle', 'label' => 'Dibatalkan', 'dot' => 'bg-red-500']
                                ];
                                $status = $statusConfig[$item->status] ?? ['class' => '', 'icon' => 'fa-question', 'label' => 'Unknown', 'dot' => 'bg-gray-500'];
                            @endphp
                            <span class="badge {{ $status['class'] }}">
                                @if(in_array($item->status, ['dijadwalkan', 'dalam_proses']))
                                    <span class="status-dot {{ $status['dot'] }}"></span>
                                @endif
                                <i class="fas {{ $status['icon'] }}"></i>
                                {{ $status['label'] }}
                            </span>
                        </div>

                        <div class="space-y-2 mb-4">
                            {{-- Jenis Badge dengan Icon --}}
                            @php
                                $jenisConfig = [
                                    'preventif' => ['class' => 'badge-preventif', 'icon' => 'fa-calendar-check', 'label' => 'Preventif'],
                                    'korektif' => ['class' => 'badge-korektif', 'icon' => 'fa-wrench', 'label' => 'Korektif'],
                                    'emergency' => ['class' => 'badge-emergency', 'icon' => 'fa-exclamation-triangle', 'label' => 'Emergency']
                                ];
                                $jenis = $jenisConfig[$item->jenis_maintenance] ?? ['class' => '', 'icon' => 'fa-tools', 'label' => 'Unknown'];
                            @endphp
                            <div class="flex items-center gap-2 text-sm">
                                <span class="badge {{ $jenis['class'] }}">
                                    <i class="fas {{ $jenis['icon'] }}"></i>
                                    {{ $jenis['label'] }}
                                </span>
                            </div>
                            
                            @if(!$item->barang)
                            <div class="flex items-center gap-2 text-xs text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 p-2 rounded-lg">
                                <i class="fas fa-exclamation-triangle"></i>
                                <span>Data barang tidak ditemukan (ID: {{ $item->aset_id }})</span>
                            </div>
                            @endif
                            
                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                <i class="fas fa-calendar mr-1"></i>
                                {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                <i class="fas fa-user-tie mr-1"></i>
                                {{ $item->teknisi ?? '-' }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                <i class="fas fa-money-bill-wave mr-1"></i>
                                Rp {{ number_format($item->biaya, 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="flex justify-end space-x-2 flex-wrap gap-2">
                            <a href="{{ route('admin.maintenance.show', $item->id) }}" 
                            class="inline-flex items-center px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs font-medium rounded-lg hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-all">
                                <i class="fas fa-eye mr-1"></i>
                                Detail
                            </a>
                            
                            @if(in_array($item->status, ['dijadwalkan', 'dalam_proses']))
                            <a href="{{ route('admin.maintenance.edit', $item->id) }}" 
                            class="inline-flex items-center px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-medium rounded-lg hover:bg-green-200 dark:hover:bg-green-900/50 transition-all">
                                <i class="fas fa-edit mr-1"></i>
                                Edit
                            </a>
                            
                            <button type="button" 
                                    onclick="showCompleteModal({{ $item->id }})"
                                    class="inline-flex items-center px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 text-xs font-medium rounded-lg hover:bg-emerald-200 dark:hover:bg-emerald-900/50 transition-all">
                                <i class="fas fa-check mr-1"></i>
                                Selesai
                            </button>
                            @endif
                            
                            <button onclick="deleteModal('{{ $item->id }}', '{{ $item->barang?->nama_barang ?? 'Barang Terhapus' }}')"
                                    class="inline-flex items-center px-3 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-xs font-medium rounded-lg hover:bg-red-200 dark:hover:bg-red-900/50 transition-all">
                                <i class="fas fa-trash mr-1"></i>
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="bg-gradient-to-r from-slate-100 via-orange-50 to-red-50 dark:from-gray-700 dark:via-gray-800 dark:to-gray-700 px-6 py-6 border-t border-slate-200 dark:border-gray-600">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-3 px-4 py-2.5 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-slate-200 dark:border-gray-600">
                        <div class="text-sm">
                            <span class="text-gray-600 dark:text-gray-300">Menampilkan</span>
                            <span class="font-bold text-gray-900 dark:text-white mx-1">{{ $maintenance->firstItem() ?? 0 }}-{{ $maintenance->lastItem() ?? 0 }}</span>
                            <span class="text-gray-600 dark:text-gray-300">dari</span>
                            <span class="font-bold text-orange-600 dark:text-orange-400 mx-1">{{ $maintenance->total() }}</span>
                            <span class="text-gray-600 dark:text-gray-300">data</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        @if ($maintenance->onFirstPage())
                            <button disabled class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 rounded-xl cursor-not-allowed">
                                <i class="fas fa-chevron-left text-sm"></i>
                            </button>
                        @else
                            <a href="{{ $maintenance->previousPageUrl() }}" 
                               class="px-4 py-2.5 bg-white dark:bg-gray-800 hover:bg-orange-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl transition-all shadow-sm hover:shadow-md border border-gray-200 dark:border-gray-600">
                                <i class="fas fa-chevron-left text-sm"></i>
                            </a>
                        @endif
                        
                        <div class="hidden sm:flex items-center gap-2">
                            @foreach ($maintenance->getUrlRange(1, $maintenance->lastPage()) as $page => $url)
                                @if ($page == $maintenance->currentPage())
                                    <span class="px-4 py-2.5 bg-gradient-to-r from-orange-600 to-red-600 text-white font-bold rounded-xl shadow-lg">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" 
                                       class="px-4 py-2.5 bg-white dark:bg-gray-800 hover:bg-orange-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 font-medium rounded-xl transition-all shadow-sm hover:shadow-md border border-gray-200 dark:border-gray-600">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                        
                        @if ($maintenance->hasMorePages())
                            <a href="{{ $maintenance->nextPageUrl() }}" 
                               class="px-4 py-2.5 bg-white dark:bg-gray-800 hover:bg-orange-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl transition-all shadow-sm hover:shadow-md border border-gray-200 dark:border-gray-600">
                                <i class="fas fa-chevron-right text-sm"></i>
                            </a>
                        @else
                            <button disabled class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 rounded-xl cursor-not-allowed">
                                <i class="fas fa-chevron-right text-sm"></i>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @else
            {{-- Empty State --}}
            <div class="px-6 py-16 text-center">
                <div class="max-w-sm mx-auto">
                    <div class="w-20 h-20 bg-gradient-to-br from-orange-100 to-red-100 dark:from-orange-900/30 dark:to-red-900/30 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <i class="fas fa-tools text-4xl text-orange-500 dark:text-orange-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Tidak ada data maintenance</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">
                        @if(request()->hasAny(['search', 'status', 'jenis_maintenance']))
                            Tidak ditemukan maintenance yang sesuai dengan filter.
                        @else
                            Belum ada jadwal maintenance yang terdaftar.
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'status', 'jenis_maintenance']))
                        <a href="{{ route('admin.maintenance.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all">
                            <i class="fas fa-redo mr-2"></i>
                            Reset Filter
                        </a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Delete Modal --}}
    <div id="delete-modal" class="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50 transition-all duration-300">
        <div class="relative top-20 mx-auto p-5 border-0 w-11/12 max-w-md shadow-2xl rounded-xl bg-white dark:bg-gray-800 animate-slide-up">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-lg mr-3">
                            <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Hapus Maintenance</h3>
                    </div>
                    <button onclick="closeModal('delete-modal')" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 rounded-lg">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="delete-form" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800">
                        <p class="text-sm text-red-800 dark:text-red-300 mb-1 font-medium">Maintenance untuk:</p>
                        <p id="delete-barang-name" class="font-semibold text-red-900 dark:text-red-200"></p>
                        <p class="text-xs text-red-600 dark:text-red-400 mt-2">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            Tindakan ini tidak dapat dibatalkan!
                        </p>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeModal('delete-modal')" 
                                class="px-4 py-2 text-gray-700 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-medium transition-all">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 rounded-lg font-medium transition-all shadow-md hover:shadow-lg">
                            Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Complete Modal --}}
    <div id="complete-modal" class="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50 transition-all duration-300">
        <div class="relative top-20 mx-auto p-5 border-0 w-11/12 max-w-md shadow-2xl rounded-xl bg-white dark:bg-gray-800 animate-slide-up">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-lg mr-3">
                            <i class="fas fa-check-circle text-green-600 dark:text-green-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Selesaikan Maintenance</h3>
                    </div>
                    <button onclick="closeModal('complete-modal')" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 rounded-lg">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="complete-form" method="POST" action="">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                            Kondisi Akhir <span class="text-red-500">*</span>
                        </label>
                        <select name="kondisi_akhir" required 
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-green-500">
                            <option value="baik">Baik</option>
                            <option value="rusak ringan">Rusak Ringan</option>
                            <option value="rusak berat">Rusak Berat</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                            Catatan Penyelesaian
                        </label>
                        <textarea name="catatan_penyelesaian" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-green-500"
                                  placeholder="Tambahkan catatan..."></textarea>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeModal('complete-modal')" 
                                class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg font-medium transition-all">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white rounded-lg font-medium transition-all shadow-md">
                            Selesaikan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Cancel Modal --}}
    <div id="cancel-modal" class="fixed inset-0 bg-black/50 dark:bg-black/70 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50 transition-all duration-300">
        <div class="relative top-20 mx-auto p-5 border-0 w-11/12 max-w-md shadow-2xl rounded-xl bg-white dark:bg-gray-800 animate-slide-up">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-orange-100 dark:bg-orange-900/30 rounded-lg mr-3">
                            <i class="fas fa-ban text-orange-600 dark:text-orange-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Batalkan Maintenance</h3>
                    </div>
                    <button onclick="closeModal('cancel-modal')" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 rounded-lg">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="cancel-form" method="POST" action="">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                            Alasan Pembatalan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="alasan" rows="3" required
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-orange-500"
                                  placeholder="Jelaskan alasan pembatalan..."></textarea>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeModal('cancel-modal')" 
                                class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg font-medium transition-all">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white rounded-lg font-medium transition-all shadow-md">
                            Batalkan Maintenance
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Notifications --}}
    @if(session('success'))
    <div id="notification" class="fixed top-4 right-4 z-50">
        <div class="notification success bg-white/90 dark:bg-gray-800/90 rounded-lg shadow-xl p-4 max-w-sm backdrop-blur-sm border-l-4 border-green-500">
            <div class="flex items-start">
                <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                    <i class="fas fa-check-circle text-green-600 dark:text-green-400"></i>
                </div>
                <div class="ml-3">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Berhasil!</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ session('success') }}</p>
                </div>
                <button onclick="hideNotification()" class="ml-auto text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 p-1 rounded">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div id="notification" class="fixed top-4 right-4 z-50">
        <div class="notification error bg-white/90 dark:bg-gray-800/90 rounded-lg shadow-xl p-4 max-w-sm backdrop-blur-sm border-l-4 border-red-500">
            <div class="flex items-start">
                <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-lg">
                    <i class="fas fa-exclamation-circle text-red-600 dark:text-red-400"></i>
                </div>
                <div class="ml-3">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Error!</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ session('error') }}</p>
                </div>
                <button onclick="hideNotification()" class="ml-auto text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 p-1 rounded">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.badge').forEach(badge => {
    badge.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.05)';
    });
    badge.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
    });
});

// Animasi select dropdown
document.querySelectorAll('.enhanced-select select').forEach(select => {
    select.addEventListener('change', function() {
        this.style.transform = 'scale(0.98)';
        setTimeout(() => {
            this.style.transform = 'scale(1)';
        }, 100);
    });
});

// Existing functions...
function deleteModal(id, barangName) {
    document.getElementById('delete-barang-name').textContent = barangName;
    document.getElementById('delete-form').action = "{{ url('admin/maintenance') }}/" + id;
    document.getElementById('delete-modal').classList.remove('hidden');
}

function showCompleteModal(id) {
    document.getElementById('complete-form').action = "{{ url('admin/maintenance') }}/" + id + "/complete";
    document.getElementById('complete-modal').classList.remove('hidden');
}

function showCancelModal(id) {
    document.getElementById('cancel-form').action = "{{ url('admin/maintenance') }}/" + id + "/cancel";
    document.getElementById('cancel-modal').classList.remove('hidden');
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

document.addEventListener('click', function(event) {
    const deleteModal = document.getElementById('delete-modal');
    const completeModal = document.getElementById('complete-modal');
    const cancelModal = document.getElementById('cancel-modal');
    
    if (event.target === deleteModal) closeModal('delete-modal');
    if (event.target === completeModal) closeModal('complete-modal');
    if (event.target === cancelModal) closeModal('cancel-modal');
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal('delete-modal');
        closeModal('complete-modal');
        closeModal('cancel-modal');
    }
});

@if(session('success') || session('error'))
setTimeout(() => hideNotification(), 5000);
@endif
</script>
@endpush