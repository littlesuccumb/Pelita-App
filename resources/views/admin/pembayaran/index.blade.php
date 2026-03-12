@extends('layouts.app')

@section('title', 'Kelola Pembayaran - Admin')

@push('styles')
<style>

/* Dark mode transitions */
* {
    transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
}

/* ===== IMPROVED ENTRANCE ANIMATIONS ===== */

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

/* Pulse Animation */
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

/* OPTIMIZED TABLE ROW */
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

/* OPTIMIZED ACTION BUTTON */
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

/* OPTIMIZED SCROLLBAR */
.custom-scrollbar {
    scrollbar-width: thin;
    scrollbar-color: #3b82f6 #f3f4f6;
    transform: translateZ(0);
}

.custom-scrollbar::-webkit-scrollbar {
    width: 5px;
    height: 5px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #f3f4f6;
    border-radius: 10px;
}

.dark .custom-scrollbar::-webkit-scrollbar-track {
    background: #374151;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);
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

.badge-pending { background-color: #fef3c7; color: #92400e; }
.badge-lunas { background-color: #dcfce7; color: #166534; }
.badge-batal { background-color: #fee2e2; color: #991b1b; }

.badge-cash { background-color: #dbeafe; color: #1e40af; }
.badge-transfer { background-color: #e0e7ff; color: #3730a3; }

/* SCROLL OPTIMIZATION */
.overflow-x-auto {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scroll-behavior: auto;
    will-change: scroll-position;
    transform: translateZ(0);
    backface-visibility: hidden;
}

.overflow-x-auto::-webkit-scrollbar {
    height: 10px;
}

.overflow-x-auto::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}

.dark .overflow-x-auto::-webkit-scrollbar-track {
    background: #1f2937;
}

.overflow-x-auto::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #cbd5e1 0%, #94a3b8 100%);
    border-radius: 10px;
}

.overflow-x-auto::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #94a3b8 0%, #64748b 100%);
}

table {
    transform: translateZ(0);
    backface-visibility: hidden;
}

.min-w-full {
    min-width: max-content;
}

.bg-gradient-to-br,
.bg-gradient-to-r {
    transform: translateZ(0);
    will-change: auto;
}

* {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

@media (max-width: 1024px) {
    .overflow-x-auto {
        -webkit-overflow-scrolling: touch;
        scroll-snap-type: none;
    }
    
    .table-row:hover {
        background: transparent;
    }
    
    .action-btn:hover {
        opacity: 1;
    }
}

@supports (overflow: overlay) {
    .overflow-x-auto {
        overflow-x: overlay;
    }
}

@media (hover: none) and (pointer: coarse) {
    .table-row:hover {
        background: transparent;
    }
    
    .action-btn:hover {
        opacity: 1;
    }
    
    .card-hover:hover {
        transform: none;
    }
}

@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

tbody tr {
    contain: layout;
}

.bg-gradient-to-br,
.bg-gradient-to-r,
.rounded-2xl {
    -webkit-transform: translate3d(0, 0, 0);
    transform: translate3d(0, 0, 0);
}
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
                <i class="fas fa-money-bill-wave"></i>
                <span>Kelola Pembayaran</span>
            </span>
        </nav>

        
        {{-- Modern Header Section with Enhanced Design - COMPACT VERSION --}}
        <div class="mb-8 animate-gentle-scale delay-100">
            <div class="relative overflow-hidden bg-gradient-to-br from-white via-blue-50/30 to-indigo-50/50 dark:from-gray-800 dark:via-gray-800/95 dark:to-gray-800/90 rounded-2xl shadow-xl border border-white/60 dark:border-gray-700 backdrop-blur-sm">
                
                {{-- Decorative Background Elements --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-400/20 via-indigo-400/20 to-purple-400/20 dark:from-blue-600/10 dark:via-indigo-600/10 dark:to-purple-600/10 rounded-full blur-3xl transform translate-x-32 -translate-y-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-cyan-400/15 to-blue-400/15 dark:from-cyan-600/10 dark:to-blue-600/10 rounded-full blur-2xl transform -translate-x-24 translate-y-24"></div>
                
                {{-- Animated Particles --}}
                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                    <div class="absolute top-10 left-10 w-2 h-2 bg-blue-400 dark:bg-blue-500 rounded-full animate-pulse opacity-60"></div>
                    <div class="absolute top-20 right-20 w-1.5 h-1.5 bg-indigo-400 dark:bg-indigo-500 rounded-full animate-pulse opacity-40" style="animation-delay: 0.5s;"></div>
                    <div class="absolute bottom-16 left-1/3 w-1 h-1 bg-purple-400 dark:bg-purple-500 rounded-full animate-pulse opacity-50" style="animation-delay: 1s;"></div>
                </div>
                
                {{-- Content Container --}}
                <div class="relative p-4 sm:p-6 lg:p-10">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        
                        {{-- Left Section: Title & Description --}}
                        <div class="flex-1">
                            {{-- Icon Badge --}}
                            <div class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-blue-500/10 to-indigo-500/10 dark:from-blue-600/20 dark:to-indigo-600/20 border border-blue-200/50 dark:border-blue-700/50 rounded-full mb-4">
                                <div class="w-2 h-2 bg-blue-500 dark:bg-blue-400 rounded-full animate-pulse"></div>
                                <span class="text-sm font-semibold text-blue-700 dark:text-blue-300">Payment Management</span>
                            </div>
                            
                            {{-- Main Title --}}
                            <h1 class="text-2xl sm:text-3xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-blue-800 to-indigo-800 dark:from-slate-100 dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent leading-tight">
                                Kelola Pembayaran
                            </h1>
                            
                            {{-- Description --}}
                            <p class="text-slate-600 dark:text-slate-400 text-base sm:text-lg flex items-center space-x-2">
                                <i class="fas fa-info-circle text-blue-500 dark:text-blue-400"></i>
                                <span>Kelola dan verifikasi pembayaran peminjaman barang inventaris</span>
                            </p>
                            
                            {{-- Quick Stats - COMPACT IN ONE ROW --}}
                            <div class="flex flex-wrap items-center gap-3 mt-4">
                                <div class="flex items-center space-x-2 px-3 py-2 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm rounded-lg border border-slate-200/50 dark:border-gray-600/50 shadow-sm">
                                    <div class="p-1.5 bg-blue-100 dark:bg-blue-900/50 rounded-md">
                                        <i class="fas fa-credit-card text-blue-600 dark:text-blue-400 text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Total Pembayaran</p>
                                        <p class="text-base font-bold text-slate-800 dark:text-slate-200">{{ $pembayaran->total() }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-2 px-3 py-2 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm rounded-lg border border-amber-200/50 dark:border-amber-800/50 shadow-sm">
                                    <div class="p-1.5 bg-amber-100 dark:bg-amber-900/50 rounded-md">
                                        <i class="fas fa-clock text-amber-600 dark:text-amber-400 text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Dalam Proses</p>
                                        <p class="text-base font-bold text-slate-800 dark:text-slate-200">{{ $pembayaran->where('status', 'pending')->count() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Right Section: Action Buttons --}}
                        <div class="flex flex-col sm:flex-row lg:flex-col gap-3">
                            {{-- Export Button --}}
                            <a href="{{ route('admin.pembayaran.export') }}" 
                            class="group relative inline-flex items-center justify-center px-6 py-3.5 bg-white dark:bg-gray-700 hover:bg-slate-50 dark:hover:bg-gray-600 border-2 border-slate-200 dark:border-gray-600 hover:border-slate-300 dark:hover:border-gray-500 text-slate-700 dark:text-slate-200 font-semibold rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
                                <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-blue-500/5 to-indigo-500/5 dark:from-blue-600/10 dark:to-indigo-600/10 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                                <i class="fas fa-download mr-2.5 text-slate-600 dark:text-slate-300 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300"></i>
                                <span class="relative">Export Data</span>
                            </a>
                            
                            {{-- Refresh Button --}}
                            <a href="{{ route('admin.pembayaran.index') }}" 
                            class="group relative inline-flex items-center justify-center px-6 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
                                <i class="fas fa-sync-alt mr-2.5 group-hover:rotate-180 transition-transform duration-500"></i>
                                <span class="relative">Refresh Data</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                {{-- Bottom Accent Line --}}
                <div class="h-1.5 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>
            </div>
        </div>

        <!-- Modern Stats Cards Section -->
        <div class="mb-8 animate-professional-reveal delay-200">
            <!-- Header Stats Section -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                        <i class="fas fa-chart-pie text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Status Pembayaran</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Overview statistik pembayaran real-time</p>
                    </div>
                </div>
                
                <!-- Last Update Badge -->
                <div class="hidden md:flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-lg border border-gray-200 dark:border-gray-600">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-xs text-gray-600 dark:text-gray-300 font-medium">Live Update</span>
                </div>
            </div>
            
            <!-- Stats Cards Grid -->
            <div class="grid grid-cols-2 gap-3 lg:grid-cols-4 lg:gap-5">
                
                <!-- Total Pembayaran Card -->
                <div class="group relative overflow-hidden bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <!-- Decorative Elements -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 transition-transform duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12 transition-transform duration-500"></div>
                    
                    <!-- Card Content -->
                    <div class="relative p-4 sm:p-6">
                        <!-- Icon Badge -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-credit-card text-white text-2xl"></i>
                            </div>
                            <div class="flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full">
                                <i class="fas fa-arrow-up text-white text-xs"></i>
                                <span class="text-white text-xs font-bold">100%</span>
                            </div>
                        </div>
                        
                        <!-- Stats -->
                        <div class="space-y-1">
                            <p class="text-blue-100 text-sm font-medium">Total Pembayaran</p>
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-2xl sm:text-3xl font-black text-white">{{ $pembayaran->total() }}</h3>
                                <span class="text-blue-100 text-sm">transaksi</span>
                            </div>
                        </div>
                        
                        <!-- Footer -->
                        <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                            <span class="text-blue-100 text-xs font-medium">Semua transaksi</span>
                            <i class="fas fa-receipt text-blue-100 text-sm"></i>
                        </div>
                    </div>
                </div>

                <!-- Lunas Card -->
                <div class="group relative overflow-hidden bg-gradient-to-br from-emerald-500 via-emerald-600 to-green-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 transition-transform duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12 transition-transform duration-500"></div>
                    
                    <div class="relative p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-check-circle text-white text-2xl"></i>
                            </div>
                            <div class="flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full">
                                <i class="fas fa-check text-white text-xs"></i>
                                <span class="text-white text-xs font-bold">Verified</span>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-emerald-100 text-sm font-medium">Lunas</p>
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-2xl sm:text-3xl font-black text-white">{{ $pembayaran->where('status', 'lunas')->count() }}</h3>
                                <span class="text-emerald-100 text-sm">paid</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                            <span class="text-emerald-100 text-xs font-medium">Terkonfirmasi</span>
                            <div class="w-2 h-2 bg-green-200 rounded-full animate-pulse"></div>
                        </div>
                    </div>
                </div>

                <!-- Pending Card -->
                <div class="group relative overflow-hidden bg-gradient-to-br from-amber-500 via-amber-600 to-orange-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 transition-transform duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12 transition-transform duration-500"></div>
                    
                    <div class="relative p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl group-hover:scale-110 transition-transform duration-300 relative">
                                <i class="fas fa-clock text-white text-2xl"></i>
                                <div class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-300 rounded-full animate-ping"></div>
                                <div class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-300 rounded-full"></div>
                            </div>
                            <div class="flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full">
                                <div class="w-2 h-2 bg-yellow-200 rounded-full animate-pulse"></div>
                                <span class="text-white text-xs font-bold">Pending</span>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-amber-100 text-sm font-medium">Menunggu Konfirmasi</p>
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-2xl sm:text-3xl font-black text-white">{{ $pembayaran->where('status', 'pending')->count() }}</h3>
                                <span class="text-amber-100 text-sm">wait</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                            <span class="text-amber-100 text-xs font-medium">Perlu verifikasi</span>
                            <div class="flex items-center gap-1">
                                <div class="w-1.5 h-1.5 bg-yellow-200 rounded-full animate-pulse"></div>
                                <div class="w-1.5 h-1.5 bg-yellow-200 rounded-full animate-pulse" style="animation-delay: 0.2s;"></div>
                                <div class="w-1.5 h-1.5 bg-yellow-200 rounded-full animate-pulse" style="animation-delay: 0.4s;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Pendapatan Card -->
                <div class="group relative overflow-hidden bg-gradient-to-br from-purple-500 via-purple-600 to-indigo-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 transition-transform duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12 transition-transform duration-500"></div>
                    
                    <div class="relative p-4 sm:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-dollar-sign text-white text-2xl"></i>
                            </div>
                            <div class="flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full">
                                <i class="fas fa-chart-line text-white text-xs"></i>
                                <span class="text-white text-xs font-bold">Revenue</span>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-purple-100 text-sm font-medium">Total Pendapatan</p>
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-2xl font-black text-white">Rp {{ number_format($pembayaran->where('status', 'lunas')->sum('jumlah'), 0, ',', '.') }}</h3>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                            <span class="text-purple-100 text-xs font-medium">Dari transaksi lunas</span>
                            <i class="fas fa-money-bill-wave text-purple-100 text-sm"></i>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- Quick Info Bar -->
            <div class="mt-6 p-4 bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 dark:from-blue-900/20 dark:via-indigo-900/20 dark:to-purple-900/20 rounded-xl border border-blue-100 dark:border-blue-800">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-500 rounded-lg">
                            <i class="fas fa-info-circle text-white"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">Statistik Update Otomatis</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Data diperbarui setiap kali ada perubahan status pembayaran</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300">
                                {{ $pembayaran->where('status', 'pending')->count() }} Perlu Verifikasi
                            </span>
                        </div>
                        <div class="h-4 w-px bg-gray-300 dark:bg-gray-600"></div>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300">
                                {{ $pembayaran->where('status', 'lunas')->count() }} Lunas
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modern Filter Section - COMPACT VERSION --}}
        <div class="mb-8 animate-elegant-slide delay-300">
            <div class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700">
                {{-- Decorative Background --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-400/5 to-indigo-400/5 dark:from-blue-600/10 dark:to-indigo-600/10 rounded-full -mr-32 -mt-32"></div>
                
                <div class="relative p-4 sm:p-6 lg:p-8">
                    {{-- Header --}}
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                            <i class="fas fa-filter text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Filter & Pencarian</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Filter data pembayaran sesuai kebutuhan</p>
                        </div>
                    </div>
                    
                    <form method="GET" action="{{ route('admin.pembayaran.index') }}">
                        {{-- Filter Inputs Grid - COMPACT VERSION --}}
                        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-6">
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
                                        placeholder="Cari nama user, barang..." 
                                        class="block w-full pl-10 lg:pl-11 pr-3 lg:pr-4 py-2.5 lg:py-3 text-sm lg:text-base bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 focus:border-blue-500 dark:focus:border-blue-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500">
                                </div>
                            </div>

                            {{-- Status Filter - COMPACT --}}
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-circle-check text-emerald-500 dark:text-emerald-400"></i>
                                    Status
                                </label>
                                <div class="relative">
                                    <select name="status" class="block w-full px-3 lg:px-4 py-2.5 lg:py-3 pr-10 text-sm lg:text-base bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 focus:border-blue-500 dark:focus:border-blue-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-gray-900 dark:text-gray-100 appearance-none cursor-pointer">
                                        <option value="">Semua Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏰ Pending</option>
                                        <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>✅ Lunas</option>
                                        <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>❌ Batal</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Metode Filter - COMPACT --}}
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-wallet text-purple-500 dark:text-purple-400"></i>
                                    Metode Pembayaran
                                </label>
                                <div class="relative">
                                    <select name="metode" class="block w-full px-3 lg:px-4 py-2.5 lg:py-3 pr-10 text-sm lg:text-base bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 focus:border-blue-500 dark:focus:border-blue-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-gray-900 dark:text-gray-100 appearance-none cursor-pointer">
                                        <option value="">Semua Metode</option>
                                        <option value="cash" {{ request('metode') == 'cash' ? 'selected' : '' }}>💵 Cash</option>
                                        <option value="transfer" {{ request('metode') == 'transfer' ? 'selected' : '' }}>🏦 Transfer</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Date Filter - COMPACT --}}
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-calendar text-red-500 dark:text-red-400"></i>
                                    Tanggal Bayar
                                </label>
                                <input type="date" 
                                    name="tanggal_dari" 
                                    value="{{ request('tanggal_dari') }}"
                                    class="block w-full px-3 lg:px-4 py-2.5 lg:py-3 text-sm lg:text-base bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 focus:border-blue-500 dark:focus:border-blue-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-gray-900 dark:text-gray-100">
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex gap-3">
                                <button type="submit" class="group relative inline-flex items-center px-4 lg:px-6 py-2.5 lg:py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm lg:text-base font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                    <i class="fas fa-search mr-2 group-hover:scale-110 transition-transform"></i>
                                    Filter Data
                                </button>
                                <a href="{{ route('admin.pembayaran.index') }}" 
                                class="group inline-flex items-center px-4 lg:px-6 py-2.5 lg:py-3 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm lg:text-base font-semibold rounded-xl transition-all duration-300">
                                    <i class="fas fa-redo mr-2 group-hover:rotate-180 transition-transform duration-500"></i>
                                    Reset
                                </a>
                            </div>
                            
                            <div class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                                <i class="fas fa-database text-blue-600 dark:text-blue-400"></i>
                                <span class="text-sm text-gray-700 dark:text-gray-300">Total:</span>
                                <span class="font-bold text-gray-900 dark:text-gray-100">{{ $pembayaran->total() }}</span>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Transaksi</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modern Data Table -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden animate-professional-reveal delay-400">
            <!-- Table Header -->
            <div class="relative px-6 lg:px-8 py-6 bg-gradient-to-r from-gray-50 via-blue-50/30 to-indigo-50/30 dark:from-gray-700/50 dark:via-gray-800/50 dark:to-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-400/10 to-indigo-400/10 dark:from-blue-600/10 dark:to-indigo-600/10 rounded-full -mr-16 -mt-16"></div>
                
                <div class="relative flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                            <i class="fas fa-list text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Daftar Pembayaran</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Kelola dan verifikasi semua transaksi</p>
                        </div>
                    </div>
                    <div class="hidden sm:flex items-center gap-2 px-4 py-2 bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm rounded-lg border border-gray-200 dark:border-gray-600 shadow-sm">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Menampilkan</span>
                        <span class="font-bold text-gray-900 dark:text-gray-100">{{ $pembayaran->count() }}</span>
                        <span class="text-sm text-gray-600 dark:text-gray-400">dari</span>
                        <span class="font-bold text-gray-900 dark:text-gray-100">{{ $pembayaran->total() }}</span>
                    </div>
                </div>
            </div>

            @if($pembayaran->count() > 0)
            <!-- Desktop Table -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-slate-200 via-blue-100 to-indigo-100 dark:from-gray-700 dark:via-gray-700/80 dark:to-gray-700">
                        <tr>
                            <th class="px-4 py-4 text-left w-48">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-user text-blue-500 dark:text-blue-400"></i>
                                    Peminjam
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-cube text-purple-500 dark:text-purple-400"></i>
                                    Barang
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-money-bill text-green-500 dark:text-green-400"></i>
                                    Jumlah & Metode
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-calendar text-red-500 dark:text-red-400"></i>
                                    Tanggal Bayar
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-info-circle text-amber-500 dark:text-amber-400"></i>
                                    Status
                                </div>
                            </th>
                            <th class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-cogs text-indigo-500 dark:text-indigo-400"></i>
                                    Aksi
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/30 dark:from-gray-800 dark:via-gray-800/95 dark:to-gray-800/90 divide-y divide-slate-100 dark:divide-gray-700">
                        @foreach($pembayaran as $payment)
                        <tr class="table-row">
                            <td class="px-4 py-5 w-48">
                                <div class="flex items-center gap-2">
                                    <div class="relative flex-shrink-0">
                                        @if($payment->peminjaman->user->avatar)
                                            <img src="{{ asset('storage/' . $payment->peminjaman->user->avatar) }}" 
                                                alt="{{ $payment->peminjaman->user->name }}"
                                                class="h-10 w-10 rounded-xl object-cover shadow-lg group-hover:scale-110 transition-transform border-2 border-white dark:border-gray-700">
                                        @else
                                            <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                                <span class="text-white font-bold text-sm">{{ strtoupper(substr($payment->peminjaman->user->name, 0, 2)) }}</span>
                                            </div>
                                        @endif
                                        <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></div>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate" title="{{ $payment->peminjaman->user->name }}">
                                            {{ $payment->peminjaman->user->name }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 truncate" title="{{ $payment->peminjaman->user->email }}">
                                            {{ $payment->peminjaman->user->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div>
                                    @php
                                        $detailCount = $payment->peminjaman->peminjamanDetail->count();
                                    @endphp
                                    
                                    @if($detailCount > 1)
                                        <div class="mb-2">
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-md">
                                                <i class="fas fa-layer-group mr-1.5"></i>
                                                {{ $detailCount }} Barang
                                            </span>
                                        </div>
                                        
                                        <div class="space-y-2 max-h-36 overflow-y-auto pr-2 custom-scrollbar">
                                            @foreach($payment->peminjaman->peminjamanDetail as $index => $detail)
                                                <div class="flex items-start text-xs bg-gradient-to-r from-gray-50 to-white dark:from-gray-700/50 dark:to-gray-800/50 rounded-xl p-3 border border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-500 hover:shadow-md transition-all">
                                                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center mr-2.5 font-bold shadow-sm">
                                                        {{ $index + 1 }}
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <div class="font-semibold text-gray-900 dark:text-gray-100 truncate mb-1">
                                                            {{ $detail->barang->nama_barang }}
                                                        </div>
                                                        <div class="flex items-center gap-2 flex-wrap">
                                                            @if($detail->barang->kategori)
                                                                <span class="inline-flex items-center px-2 py-1 rounded-lg bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 font-medium">
                                                                    <i class="fas fa-tag mr-1 text-[10px]"></i>
                                                                    {{ $detail->barang->kategori->nama_kategori }}
                                                                </span>
                                                            @endif
                                                            <span class="inline-flex items-center px-2 py-1 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 font-bold">
                                                                <i class="fas fa-cubes mr-1 text-[10px]"></i>
                                                                {{ $detail->jumlah }}x
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        @php
                                            $detail = $payment->peminjaman->peminjamanDetail->first();
                                        @endphp
                                        @if($detail)
                                            <div class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                                {{ $detail->barang->nama_barang }}
                                            </div>
                                            <div class="flex items-center gap-2 flex-wrap">
                                                @if($detail->barang->kategori)
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 text-xs font-medium">
                                                        <i class="fas fa-tag mr-1"></i>
                                                        {{ $detail->barang->kategori->nama_kategori }}
                                                    </span>
                                                @endif
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs font-bold">
                                                    <i class="fas fa-cubes mr-1"></i>
                                                    {{ $detail->jumlah }}x
                                                </span>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div>
                                    <div class="text-base font-bold text-gray-900 dark:text-gray-100">
                                        Rp {{ number_format($payment->jumlah, 0, ',', '.') }}
                                    </div>
                                    <div class="mt-1">
                                        @if($payment->metode == 'cash')
                                            <span class="badge badge-cash">
                                                <i class="fas fa-money-bill-wave"></i>
                                                Cash
                                            </span>
                                        @else
                                            <span class="badge badge-transfer">
                                                <i class="fas fa-exchange-alt"></i>
                                                Transfer
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="space-y-2">
                                    <div class="flex items-center gap-2 text-sm">
                                        <div class="p-1.5 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                                            <i class="fas fa-calendar-day text-blue-600 dark:text-blue-400 text-xs"></i>
                                        </div>
                                        <span class="font-medium text-gray-900 dark:text-gray-100">
                                            {{ $payment->tanggal_bayar ? \Carbon\Carbon::parse($payment->tanggal_bayar)->format('d M Y') : '-' }}
                                        </span>
                                    </div>
                                    @if($payment->tanggal_bayar)
                                    <div class="inline-flex items-center gap-1 px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded-lg">
                                        <i class="fas fa-clock text-gray-500 dark:text-gray-400 text-xs"></i>
                                        <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">
                                            {{ \Carbon\Carbon::parse($payment->tanggal_bayar)->format('H:i') }}
                                        </span>
                                    </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                @if($payment->status == 'lunas')
                                    <span class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 font-bold text-xs shadow-sm">
                                        <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                                        Lunas
                                    </span>
                                @elseif($payment->status == 'pending')
                                    <span class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 font-bold text-xs shadow-sm">
                                        <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 font-bold text-xs shadow-sm">
                                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                        Batal
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.pembayaran.show', $payment->id) }}" 
                                       class="p-2.5 text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 hover:bg-blue-100 dark:hover:bg-blue-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md" 
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    @if($payment->status == 'pending')
                                        @if($payment->bukti_transfer)
                                        <button onclick="konfirmasiModal('{{ $payment->id }}', '{{ $payment->peminjaman->user->name }}')"
                                                class="p-2.5 text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/30 hover:bg-green-100 dark:hover:bg-green-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md" 
                                                title="Konfirmasi">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        @endif
                                        <button onclick="tolakModal('{{ $payment->id }}', '{{ $payment->peminjaman->user->name }}')"
                                                class="p-2.5 text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 dark:hover:bg-red-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md" 
                                                title="Tolak">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="lg:hidden divide-y divide-slate-100 dark:divide-gray-700">
                @foreach($pembayaran as $payment)
                <div class="p-5 hover:bg-gradient-to-r hover:from-slate-50 hover:to-blue-50/50 dark:hover:from-gray-700/50 dark:hover:to-blue-900/20 transition-all duration-200">
                    <div class="bg-gradient-to-br from-white via-slate-50/50 to-blue-50/30 dark:from-gray-800 dark:via-gray-800/95 dark:to-gray-700/90 rounded-2xl p-5 border border-slate-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-all">
                        <!-- Header Card -->
                        <div class="flex justify-between items-start mb-4 pb-4 border-b border-slate-200 dark:border-gray-700">
                            <div class="flex items-center gap-3">
                                <div class="relative flex-shrink-0">
                                    @if($payment->peminjaman->user->avatar)
                                        <img src="{{ asset('storage/' . $payment->peminjaman->user->avatar) }}" 
                                            alt="{{ $payment->peminjaman->user->name }}"
                                            class="h-12 w-12 rounded-xl object-cover shadow-lg border-2 border-white dark:border-gray-700">
                                    @else
                                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg">
                                            <span class="text-white font-bold">{{ strtoupper(substr($payment->peminjaman->user->name, 0, 2)) }}</span>
                                        </div>
                                    @endif
                                    <div class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></div>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="text-sm font-bold text-gray-900 dark:text-gray-100 truncate">{{ $payment->peminjaman->user->name }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $payment->peminjaman->user->email }}</div>
                                </div>
                            </div>
                            <div>
                                @if($payment->status == 'lunas')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 font-bold text-xs shadow-sm">
                                        <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                                        Lunas
                                    </span>
                                @elseif($payment->status == 'pending')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 font-bold text-xs shadow-sm">
                                        <div class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></div>
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 font-bold text-xs shadow-sm">
                                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                        Batal
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="space-y-3 mb-4">
                            @php
                                $detailCount = $payment->peminjaman->peminjamanDetail->count();
                            @endphp
                            
                            <!-- Barang Section -->
                            <div class="bg-gradient-to-br from-slate-50 to-blue-50/50 dark:from-gray-700/50 dark:to-blue-900/20 rounded-xl p-3 border border-slate-200 dark:border-gray-600">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold text-slate-700 dark:text-slate-300 flex items-center gap-1.5">
                                        <i class="fas fa-cube text-blue-500 dark:text-blue-400"></i>
                                        Barang
                                    </span>
                                    @if($detailCount > 1)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-blue-500 to-indigo-600 text-white shadow-md">
                                            <i class="fas fa-layer-group mr-1"></i>
                                            {{ $detailCount }} Items
                                        </span>
                                    @endif
                                </div>
                                
                                @if($detailCount > 1)
                                    <div class="space-y-2 max-h-40 overflow-y-auto custom-scrollbar pr-1">
                                        @foreach($payment->peminjaman->peminjamanDetail as $index => $detail)
                                            <div class="flex items-start bg-white dark:bg-gray-800 rounded-lg p-2.5 shadow-sm border border-slate-200 dark:border-gray-600">
                                                <div class="flex-shrink-0 w-6 h-6 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center text-xs font-bold mr-2.5">
                                                    {{ $index + 1 }}
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <div class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-1">
                                                        {{ $detail->barang->nama_barang }}
                                                    </div>
                                                    <div class="flex items-center gap-2 flex-wrap text-xs">
                                                        @if($detail->barang->kategori)
                                                            <span class="inline-flex items-center px-2 py-0.5 rounded-lg bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 font-medium">
                                                                <i class="fas fa-tag mr-1"></i>
                                                                {{ $detail->barang->kategori->nama_kategori }}
                                                            </span>
                                                        @endif
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 font-bold">
                                                            <i class="fas fa-cubes mr-1"></i>
                                                            {{ $detail->jumlah }}x
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    @php
                                        $detail = $payment->peminjaman->peminjamanDetail->first();
                                    @endphp
                                    @if($detail)
                                        <div class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                            {{ $detail->barang->nama_barang }}
                                        </div>
                                        <div class="flex items-center gap-2 flex-wrap">
                                            @if($detail->barang->kategori)
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 text-xs font-medium">
                                                    <i class="fas fa-tag mr-1"></i>
                                                    {{ $detail->barang->kategori->nama_kategori }}
                                                </span>
                                            @endif
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs font-bold">
                                                <i class="fas fa-cubes mr-1"></i>
                                                {{ $detail->jumlah }}x
                                            </span>
                                        </div>
                                    @else
                                        <div class="text-xs text-gray-400 dark:text-gray-500 italic">Data barang tidak tersedia</div>
                                    @endif
                                @endif
                            </div>
                            
                            <!-- Info Grid -->
                            <div class="grid grid-cols-2 gap-3">
                                <!-- Jumlah & Metode -->
                                <div class="bg-gradient-to-br from-green-50 to-emerald-50/50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl p-3 border border-green-200 dark:border-green-800">
                                    <div class="flex items-center gap-1.5 mb-1">
                                        <i class="fas fa-money-bill-wave text-green-600 dark:text-green-400 text-xs"></i>
                                        <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Jumlah</span>
                                    </div>
                                    <div class="text-sm font-bold text-gray-900 dark:text-gray-100 mb-1.5">
                                        Rp {{ number_format($payment->jumlah, 0, ',', '.') }}
                                    </div>
                                    <div>
                                        @if($payment->metode == 'cash')
                                            <span class="badge badge-cash">
                                                <i class="fas fa-money-bill-wave"></i>
                                                Cash
                                            </span>
                                        @else
                                            <span class="badge badge-transfer">
                                                <i class="fas fa-exchange-alt"></i>
                                                Transfer
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Tanggal -->
                                <div class="bg-gradient-to-br from-blue-50 to-indigo-50/50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl p-3 border border-blue-200 dark:border-blue-800">
                                    <div class="flex items-center gap-1.5 mb-1">
                                        <i class="fas fa-calendar text-blue-600 dark:text-blue-400 text-xs"></i>
                                        <span class="text-xs font-bold text-slate-700 dark:text-slate-300">Tanggal Bayar</span>
                                    </div>
                                    <div class="text-xs text-gray-700 dark:text-gray-300 font-medium mb-1">
                                        {{ $payment->tanggal_bayar ? \Carbon\Carbon::parse($payment->tanggal_bayar)->format('d M Y') : '-' }}
                                    </div>
                                    @if($payment->tanggal_bayar)
                                    <div class="inline-flex items-center gap-1 px-2 py-0.5 bg-white dark:bg-gray-800 rounded-lg border border-blue-200 dark:border-blue-800">
                                        <i class="fas fa-clock text-gray-500 dark:text-gray-400 text-xs"></i>
                                        <span class="text-xs font-semibold text-gray-700 dark:text-gray-300">
                                            {{ \Carbon\Carbon::parse($payment->tanggal_bayar)->format('H:i') }}
                                        </span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-wrap gap-2 pt-3 border-t border-slate-200 dark:border-gray-700">
                            <a href="{{ route('admin.pembayaran.show', $payment->id) }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold rounded-xl transition-all shadow-sm hover:shadow-md">
                                <i class="fas fa-eye mr-1.5"></i>
                                Detail
                            </a>
                            
                            @if($payment->status == 'pending')
                                @if($payment->bukti_transfer)
                                <button onclick="konfirmasiModal('{{ $payment->id }}', '{{ $payment->peminjaman->user->name }}')"
                                        class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-xs font-bold rounded-xl transition-all shadow-sm hover:shadow-md">
                                    <i class="fas fa-check mr-1.5"></i>
                                    Konfirmasi
                                </button>
                                @endif
                                <button onclick="tolakModal('{{ $payment->id }}', '{{ $payment->peminjaman->user->name }}')"
                                        class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-xs font-bold rounded-xl transition-all shadow-sm hover:shadow-md">
                                    <i class="fas fa-times mr-1.5"></i>
                                    Tolak
                                </button>
                            @endif
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
                                <span class="font-bold text-gray-900 dark:text-gray-100 mx-1">{{ $pembayaran->firstItem() ?? 0 }}-{{ $pembayaran->lastItem() ?? 0 }}</span>
                                <span class="text-gray-600 dark:text-gray-400">dari</span>
                                <span class="font-bold text-blue-600 dark:text-blue-400 mx-1">{{ $pembayaran->total() }}</span>
                                <span class="text-gray-600 dark:text-gray-400">data</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pagination Controls -->
                    <div class="flex items-center gap-2">
                        @if ($pembayaran->onFirstPage())
                            <button disabled class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 rounded-xl cursor-not-allowed border border-gray-200 dark:border-gray-600">
                                <i class="fas fa-chevron-left text-sm"></i>
                            </button>
                        @else
                            <a href="{{ $pembayaran->previousPageUrl() }}" 
                               class="px-4 py-2.5 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 rounded-xl transition-all border border-slate-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-600 shadow-sm hover:shadow-md">
                                <i class="fas fa-chevron-left text-sm"></i>
                            </a>
                        @endif
                        
                        <div class="hidden sm:flex items-center gap-2">
                            @foreach ($pembayaran->getUrlRange(1, $pembayaran->lastPage()) as $page => $url)
                                @if ($page == $pembayaran->currentPage())
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
                            <span class="text-sm font-bold text-gray-900 dark:text-gray-100">{{ $pembayaran->currentPage() }}</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400 mx-1">/</span>
                            <span class="text-sm text-gray-600 dark:text-gray-300">{{ $pembayaran->lastPage() }}</span>
                        </div>
                        
                        @if ($pembayaran->hasMorePages())
                            <a href="{{ $pembayaran->nextPageUrl() }}" 
                               class="px-4 py-2.5 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 rounded-xl transition-all border border-slate-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-600 shadow-sm hover:shadow-md">
                                <i class="fas fa-chevron-right text-sm"></i>
                            </a>
                        @else
                            <button disabled class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 rounded-xl cursor-not-allowed border border-gray-200 dark:border-gray-600">
                                <i class="fas fa-chevron-right text-sm"></i>
                            </button>
                        @endif
                    </div>
                    
                    <!-- Right Quick Jump -->
                    <div class="hidden lg:flex items-center gap-3">
                        <span class="text-sm text-gray-600 dark:text-gray-400 font-medium">Halaman:</span>
                        <div class="relative">
                            <select id="page-select" onchange="window.location.href=this.value" 
                                    class="appearance-none pl-4 pr-10 py-2.5 bg-white dark:bg-gray-800 border-2 border-slate-200 dark:border-gray-600 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-300 hover:border-blue-300 dark:hover:border-blue-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all cursor-pointer">
                                @for ($i = 1; $i <= $pembayaran->lastPage(); $i++)
                                    <option value="{{ $pembayaran->url($i) }}" {{ $i == $pembayaran->currentPage() ? 'selected' : '' }}>
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
                         style="width: {{ ($pembayaran->currentPage() / $pembayaran->lastPage()) * 100 }}%">
                    </div>
                </div>
                
                <!-- Additional Info Footer -->
                <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500 dark:text-gray-400">
                    <div class="flex items-center gap-4">
                        <span class="flex items-center gap-1.5">
                            <i class="fas fa-file-alt text-blue-500 dark:text-blue-400"></i>
                            Per halaman: <strong class="text-gray-700 dark:text-gray-300">{{ $pembayaran->count() }}</strong>
                        </span>
                        <span class="hidden sm:inline">•</span>
                        <span class="flex items-center gap-1.5">
                            <i class="fas fa-layer-group text-indigo-500 dark:text-indigo-400"></i>
                            Total halaman: <strong class="text-gray-700 dark:text-gray-300">{{ $pembayaran->lastPage() }}</strong>
                        </span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        @if ($pembayaran->currentPage() > 1)
                            <a href="{{ $pembayaran->url(1) }}" 
                               class="px-3 py-1.5 bg-white dark:bg-gray-800 hover:bg-slate-50 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all text-xs font-medium border border-slate-200 dark:border-gray-600">
                                <i class="fas fa-fast-backward mr-1"></i>
                                Awal
                            </a>
                        @endif
                        
                        @if ($pembayaran->currentPage() < $pembayaran->lastPage())
                            <a href="{{ $pembayaran->url($pembayaran->lastPage()) }}" 
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
            <div class="px-6 py-16 text-center">
                <div class="max-w-sm mx-auto">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <i class="fas fa-inbox text-2xl sm:text-4xl text-blue-500 dark:text-blue-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Tidak ada data pembayaran</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">
                        @if(request()->hasAny(['search', 'status', 'metode', 'tanggal_dari']))
                            Tidak ditemukan pembayaran yang sesuai dengan filter yang diterapkan.
                        @else
                            Belum ada pembayaran yang terdaftar dalam sistem.
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'status', 'metode', 'tanggal_dari']))
                        <a href="{{ route('admin.pembayaran.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                            <i class="fas fa-redo mr-2"></i>
                            Reset Filter
                        </a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Modals -->
    <!-- Konfirmasi Modal -->
    <div id="konfirmasi-modal" class="fixed inset-0 modal-backdrop overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border-0 w-11/12 max-w-md shadow-2xl rounded-xl bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-lg mr-3">
                            <i class="fas fa-check-circle text-green-600 dark:text-green-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Konfirmasi Pembayaran</h3>
                    </div>
                    <button onclick="closeModal('konfirmasi-modal')" class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="konfirmasi-form" method="POST" action="">
                    @csrf
                    <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                        <p class="text-sm text-green-800 dark:text-green-300 mb-1 font-medium">Konfirmasi pembayaran dari:</p>
                        <p id="konfirmasi-user-name" class="font-semibold text-green-900 dark:text-green-200"></p>
                        <p class="text-xs text-green-600 dark:text-green-400 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Pembayaran akan diubah menjadi status LUNAS
                        </p>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeModal('konfirmasi-modal')" 
                                class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-medium transition-all">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-white bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 rounded-lg font-medium transition-all shadow-md hover:shadow-lg">
                            Konfirmasi Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tolak Modal -->
    <div id="tolak-modal" class="fixed inset-0 modal-backdrop overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border-0 w-11/12 max-w-md shadow-2xl rounded-xl bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-lg mr-3">
                            <i class="fas fa-times-circle text-red-600 dark:text-red-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Tolak Pembayaran</h3>
                    </div>
                    <button onclick="closeModal('tolak-modal')" class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="tolak-form" method="POST" action="">
                    @csrf
                    <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800">
                        <p class="text-sm text-red-800 dark:text-red-300 mb-1 font-medium">Tolak pembayaran dari:</p>
                        <p id="tolak-user-name" class="font-semibold text-red-900 dark:text-red-200"></p>
                    </div>

                    <div class="mb-4">
                        <label for="alasan_penolakan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Alasan Penolakan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="alasan_penolakan" 
                                  id="alasan_penolakan" 
                                  rows="4"
                                  required
                                  placeholder="Masukkan alasan penolakan pembayaran..."
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-red-500 dark:focus:ring-red-400 focus:border-red-500 dark:focus:border-red-400 transition-all placeholder-gray-400 dark:placeholder-gray-500"></textarea>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Alasan akan dikirimkan ke user
                        </p>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeModal('tolak-modal')" 
                                class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-medium transition-all">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 rounded-lg font-medium transition-all shadow-md hover:shadow-lg">
                            Tolak Pembayaran
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
</div>
@endsection

@push('scripts')
<script>
// ============================================
// MODAL FUNCTIONS
// ============================================

function konfirmasiModal(id, userName) {
    document.getElementById('konfirmasi-user-name').textContent = userName;
    document.getElementById('konfirmasi-form').action = "{{ url('admin/pembayaran') }}/" + id + "/konfirmasi";
    document.getElementById('konfirmasi-modal').classList.remove('hidden');
}

function tolakModal(id, userName) {
    document.getElementById('tolak-user-name').textContent = userName;
    document.getElementById('tolak-form').action = "{{ url('admin/pembayaran') }}/" + id + "/tolak";
    document.getElementById('tolak-modal').classList.remove('hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    const form = document.getElementById(modalId).querySelector('form');
    if (form) {
        form.reset();
    }
}

function hideNotification() {
    const notification = document.getElementById('notification');
    if (notification) {
        notification.style.animation = 'slideOutRight 0.5s ease-in forwards';
        setTimeout(() => notification.remove(), 500);
    }
}

// ============================================
// EVENT LISTENERS
// ============================================

document.addEventListener('click', function(event) {
    const konfirmasiModal = document.getElementById('konfirmasi-modal');
    const tolakModal = document.getElementById('tolak-modal');
    
    if (event.target === konfirmasiModal) {
        closeModal('konfirmasi-modal');
    }
    if (event.target === tolakModal) {
        closeModal('tolak-modal');
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal('konfirmasi-modal');
        closeModal('tolak-modal');
    }
});

// ============================================
// FORM VALIDATIONS
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    const konfirmasiForm = document.getElementById('konfirmasi-form');
    if (konfirmasiForm) {
        konfirmasiForm.addEventListener('submit', function(e) {
            const userName = document.getElementById('konfirmasi-user-name').textContent;
            
            if (!userName || userName.trim() === '') {
                e.preventDefault();
                alert('Error: Data user tidak valid');
                return false;
            }
            
            const confirmed = confirm(`Konfirmasi pembayaran dari "${userName}"?\n\nPembayaran akan diubah menjadi LUNAS.`);
            
            if (!confirmed) {
                e.preventDefault();
                return false;
            }
            
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
            }
        });
    }
    
    const tolakForm = document.getElementById('tolak-form');
    if (tolakForm) {
        tolakForm.addEventListener('submit', function(e) {
            const userName = document.getElementById('tolak-user-name').textContent;
            const alasan = document.getElementById('alasan_penolakan').value.trim();
            
            if (!userName || userName.trim() === '') {
                e.preventDefault();
                alert('Error: Data user tidak valid');
                return false;
            }
            
            if (!alasan || alasan.length < 10) {
                e.preventDefault();
                alert('Alasan penolakan minimal 10 karakter');
                return false;
            }
            
            const confirmed = confirm(`Tolak pembayaran dari "${userName}"?\n\nAlasan: ${alasan}\n\nTindakan ini tidak dapat dibatalkan!`);
            
            if (!confirmed) {
                e.preventDefault();
                return false;
            }
            
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
            }
        });
    }
});

// ============================================
// INPUT VALIDATION (XSS Prevention)
// ============================================

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
}

// ============================================
// PREVENT MULTIPLE FORM SUBMISSIONS
// ============================================

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

// ============================================
// ACTIVITY LOGGING
// ============================================

function logActivity(action, details = '') {
    const timestamp = new Date().toISOString();
    const logData = {
        timestamp: timestamp,
        action: action,
        details: details,
        url: window.location.href,
        userAgent: navigator.userAgent
    };
    
    const logs = JSON.parse(localStorage.getItem('activityLogs') || '[]');
    logs.push(logData);
    if (logs.length > 100) logs.shift();
    localStorage.setItem('activityLogs', JSON.stringify(logs));
}

document.addEventListener('DOMContentLoaded', function() {
    logActivity('page_load', 'Pembayaran management page loaded');
});

// ============================================
// ANIMATIONS
// ============================================

const style = document.createElement('style');
style.textContent = `
    @keyframes slideOutRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
`;
document.head.appendChild(style);

// ============================================
// SESSION TIMEOUT WARNING
// ============================================

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

// Auto hide notifications
@if(session('success') || session('error'))
setTimeout(() => hideNotification(), 5000);
@endif
</script>
@endpush