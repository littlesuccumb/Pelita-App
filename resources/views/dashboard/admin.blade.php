@extends('layouts.app')

@section('title', 'Dashboard Administrator - Pelita App')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 lg:py-4">
    <!-- Modern Header Section with Enhanced Design -->
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
            <div class="relative p-8 lg:p-10">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    
                    {{-- Left Section: Title & Description --}}
                    <div class="flex-1">
                        {{-- Icon Badge --}}
                        <div class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-blue-500/10 to-indigo-500/10 dark:from-blue-600/20 dark:to-indigo-600/20 border border-blue-200/50 dark:border-blue-700/50 rounded-full mb-4">
                            <div class="w-2 h-2 bg-blue-500 dark:bg-blue-400 rounded-full animate-pulse"></div>
                            <span class="text-sm font-semibold text-blue-700 dark:text-blue-300">Management System</span>
                        </div>
                        
                        {{-- Main Title --}}
                        <h1 class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-blue-800 to-indigo-800 dark:from-slate-100 dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent leading-tight">
                            Dashboard Administrator
                        </h1>
                        
                        {{-- Description --}}
                        <p class="text-slate-600 dark:text-slate-400 text-lg flex items-center space-x-2">
                            <i class="fas fa-info-circle text-blue-500 dark:text-blue-400"></i>
                            <span>Kelola permohonan dan peminjaman aset secara efisien</span>
                        </p>
                        
                        {{-- Quick Stats --}}
                        <div class="flex flex-wrap items-center gap-4 mt-6">
                            <div class="flex items-center space-x-2 px-4 py-2 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm rounded-lg border border-slate-200/50 dark:border-gray-600/50 shadow-sm">
                                <div class="p-1.5 bg-green-100 dark:bg-green-900/50 rounded-md">
                                    <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Status Sistem</p>
                                    <p class="text-sm font-bold text-slate-800 dark:text-slate-200">Sistem Aktif</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-2 px-4 py-2 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm rounded-lg border border-slate-200/50 dark:border-gray-600/50 shadow-sm">
                                <div class="p-1.5 bg-blue-100 dark:bg-blue-900/50 rounded-md">
                                    <i class="fas fa-calendar-alt text-blue-600 dark:text-blue-400 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Hari Ini</p>
                                    <p class="text-sm font-bold text-slate-800 dark:text-slate-200">{{ $stats['permohonan_hari_ini'] }} Permohonan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Right Section: Action Buttons & Clock --}}
                    <div class="flex flex-col gap-3">
                        {{-- Live Clock --}}
                        <div class="px-6 py-3 bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm rounded-xl border border-slate-200 dark:border-gray-600 shadow-sm text-center">
                            <p id="live-clock" class="text-lg font-bold text-gray-900 dark:text-white">{{ now()->format('H:i:s') }} WIB</p>
                            <p class="text-xs text-green-600 dark:text-green-400 flex items-center justify-center mt-1">
                                <span class="inline-flex h-2 w-2 rounded-full bg-green-400 dark:bg-green-500 animate-pulse mr-1"></span>
                                Live Update
                            </p>
                        </div>
                        
                        {{-- Refresh Button --}}
                        <button id="refresh-dashboard-btn" 
                                class="group relative inline-flex items-center justify-center px-6 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                            <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
                            <svg class="w-5 h-5 mr-2.5 relative group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <span class="relative">Refresh Data</span>
                        </button>
                    </div>
                </div>
            </div>
            
            {{-- Bottom Accent Line --}}
            <div class="h-1.5 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>
        </div>
    </div>
</div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Alert Section -->
        @if($stats['permohonan_pending'] > 5 || $stats['peminjaman_overdue'] > 0)
        <div class="mb-8 bg-yellow-50 dark:bg-yellow-900/20 border-l-4 border-yellow-400 dark:border-yellow-500 p-4 rounded-r-lg" data-aos="fade-down">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400 dark:text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Perhatian Diperlukan</h3>
                    <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                        @if($stats['permohonan_pending'] > 5)
                            <p>• {{ $stats['permohonan_pending'] }} permohonan menunggu persetujuan</p>
                        @endif
                        @if($stats['peminjaman_overdue'] > 0)
                            <p>• {{ $stats['peminjaman_overdue'] }} peminjaman terlambat dikembalikan</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <!-- Primary KPIs Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Ringkasan Utama
                </h2>
                <span class="text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-3 py-1 rounded-full">Hari Ini: {{ $stats['permohonan_hari_ini'] }} Permohonan</span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                <!-- Permohonan Pending -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 card-hover transition-all duration-300" data-aos="fade-up" data-aos-delay="0">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        @if($stats['permohonan_pending'] > 0)
                            <span class="flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-yellow-400 dark:bg-yellow-500 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-yellow-500 dark:bg-yellow-600"></span>
                            </span>
                        @else
                            <span class="inline-flex h-3 w-3 rounded-full bg-green-400 dark:bg-green-500"></span>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Permohonan Pending</p>
                        <p id="permohonan-pending" class="text-3xl font-bold text-gray-900 dark:text-white mb-3">{{ $stats['permohonan_pending'] }}</p>
                        <div class="text-xs">
                            @if($stats['permohonan_pending'] > 0)
                                <a href="{{ route('admin.permohonan.index') }}" class="text-yellow-600 dark:text-yellow-400 hover:text-yellow-800 dark:hover:text-yellow-300 font-medium">Tinjau Sekarang →</a>
                            @else
                                <span class="text-green-600 dark:text-green-400 font-medium">Semua Tertangani</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Peminjaman Aktif -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 card-hover transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400">
                            Aktif
                        </span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Peminjaman Aktif</p>
                        <p id="peminjaman-aktif" class="text-3xl font-bold text-gray-900 dark:text-white mb-3">{{ $stats['peminjaman_aktif'] }}</p>
                        <div class="text-xs">
                            <a href="{{ route('admin.peminjaman.index') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium">Lihat Detail →</a>
                        </div>
                    </div>
                </div>

                <!-- Pembayaran Pending -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 card-hover transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-400">
                            Pending
                        </span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Pembayaran Pending</p>
                        <p id="pembayaran-pending" class="text-3xl font-bold text-gray-900 dark:text-white mb-3">{{ $stats['pembayaran_pending'] }}</p>
                        <div class="text-xs">
                            <a href="{{ route('admin.pembayaran.index') }}" class="text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-300 font-medium">Verifikasi →</a>
                        </div>
                    </div>
                </div>

                <!-- Peminjaman Overdue -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 card-hover transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        @if($stats['peminjaman_overdue'] > 0)
                            <span class="flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-red-400 dark:bg-red-500 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 dark:bg-red-600"></span>
                            </span>
                        @else
                            <span class="inline-flex h-3 w-3 rounded-full bg-green-400 dark:bg-green-500"></span>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">Peminjaman Overdue</p>
                        <p id="peminjaman-overdue" class="text-3xl font-bold text-gray-900 dark:text-white mb-3">{{ $stats['peminjaman_overdue'] }}</p>
                        <div class="text-xs">
                            @if($stats['peminjaman_overdue'] > 0)
                                <span class="text-red-600 dark:text-red-400 font-medium">Perlu Tindakan Segera</span>
                            @else
                                <span class="text-green-600 dark:text-green-400 font-medium">Tidak Ada Keterlambatan</span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Secondary Metrics Section -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Metrik Tambahan</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                
                <!-- Permohonan Hari Ini -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Permohonan Hari Ini</p>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ $stats['permohonan_hari_ini'] }}</p>
                            <p class="text-xs text-blue-600 dark:text-blue-400 font-medium">{{ now()->format('d M Y') }}</p>
                        </div>
                        <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Barang Maintenance -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Barang Maintenance</p>
                            <p class="text-xl font-semibold text-amber-600 dark:text-amber-400">{{ $stats['barang_maintenance'] }}</p>
                            <p class="text-xs text-amber-600 dark:text-amber-400">Perlu perhatian</p>
                        </div>
                        <div class="w-8 h-8 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Stok Menipis -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Stok Menipis</p>
                            <p class="text-xl font-semibold text-orange-600 dark:text-orange-400">{{ $stats['barang_stok_menipis'] }}</p>
                            <p class="text-xs text-orange-600 dark:text-orange-400">≤ 2 unit</p>
                        </div>
                        <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Barang -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Barang</p>
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ $stats['total_barang'] }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Terdaftar</p>
                        </div>
                        <div class="w-8 h-8 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            
            <!-- Monthly Trend Chart -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm" data-aos="fade-up">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tren Bulanan {{ date('Y') }}</h3>
                    <div class="flex space-x-2">
                        <button data-chart-type="permohonan" class="chart-filter-btn px-3 py-1 text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-full">Permohonan</button>
                        <button data-chart-type="peminjaman" class="chart-filter-btn px-3 py-1 text-xs font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full">Peminjaman</button>
                    </div>
                </div>
                
                <div class="relative h-64 mb-4">
                    <canvas id="monthlyChart" class="w-full h-full"></canvas>
                </div>

                <div class="flex items-center justify-center space-x-6 text-sm">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-blue-500 rounded mr-2"></div>
                        <span class="text-gray-600 dark:text-gray-400">Permohonan</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded mr-2"></div>
                        <span class="text-gray-600 dark:text-gray-400">Peminjaman</span>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Aktivitas Terbaru</h3>
                    <div class="flex space-x-2">
                        <button data-activity-filter="all" class="activity-filter-btn px-3 py-1 text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-full">Semua</button>
                        <button data-activity-filter="permohonan" class="activity-filter-btn px-3 py-1 text-xs font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full">Permohonan</button>
                        <button data-activity-filter="peminjaman" class="activity-filter-btn px-3 py-1 text-xs font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full">Peminjaman</button>
                    </div>
                </div>
                
                <div class="space-y-4 max-h-80 overflow-y-auto" id="activities-container">
                    @forelse($recentActivities ?? [] as $activity)
                        <div class="activity-item flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors" 
                             data-activity-type="{{ $activity->aksi }}">
                            <div class="flex-shrink-0 w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                <span class="text-xs font-medium text-white">
                                    {{ strtoupper(substr($activity->user->name ?? 'S', 0, 1)) }}
                                </span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        {{ $activity->user->name ?? 'System' }}
                                    </p>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $activity->aksi }}</p>
                                @if($activity->keterangan)
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ Str::limit($activity->keterangan, 60) }}</p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8" id="empty-state">
                            <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada aktivitas</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- Tables Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Pending Permohonan -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm" data-aos="fade-up">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Permohonan Pending</h3>
                        <a href="{{ route('admin.permohonan.index') }}" 
                           class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium flex items-center">
                            Lihat Semua
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div class="p-0">
                    <div class="max-h-80 overflow-y-auto">
                        @forelse($pendingPermohonan as $permohonan)
                            <div class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors border-b border-gray-100 dark:border-gray-700">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-white">
                                            {{ strtoupper(substr($permohonan->user->name, 0, 2)) }}
                                        </span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                            {{ $permohonan->user->name }}
                                        </p>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            @if($permohonan->permohonanItems && $permohonan->permohonanItems->count() > 0)
                                                {{ $permohonan->permohonanItems->first()->barang->nama_barang ?? 'Aset tidak tersedia' }}
                                                @if($permohonan->permohonanItems->count() > 1)
                                                    <span class="text-gray-400 dark:text-gray-500">+{{ $permohonan->permohonanItems->count() - 1 }}</span>
                                                @endif
                                            @else
                                                <span class="italic">Tidak ada item</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400">
                                        Pending
                                    </span>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        {{ $permohonan->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada permohonan pending</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Pending Peminjaman -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Peminjaman Menunggu</h3>
                        <a href="{{ route('admin.peminjaman.index') }}" 
                           class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium flex items-center">
                            Lihat Semua
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div class="p-0">
                    <div class="max-h-80 overflow-y-auto">
                        @forelse($pendingPeminjaman ?? [] as $peminjaman)
                            <div class="flex items-center justify-between p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors border-b border-gray-100 dark:border-gray-700">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-white">
                                            {{ strtoupper(substr($peminjaman->user->name ?? 'U', 0, 2)) }}
                                        </span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                            {{ $peminjaman->user->name ?? 'Unknown User' }}
                                        </p>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            @if($peminjaman->permohonan && $peminjaman->permohonan->permohonanItems->count() > 0)
                                                {{ $peminjaman->permohonan->permohonanItems->first()->barang->nama_barang ?? 'Aset tidak tersedia' }}
                                                @if($peminjaman->permohonan->permohonanItems->count() > 1)
                                                    <span class="text-gray-400 dark:text-gray-500">+{{ $peminjaman->permohonan->permohonanItems->count() - 1 }}</span>
                                                @endif
                                            @else
                                                <span class="italic">Tidak ada item</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400">
                                        Menunggu
                                    </span>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        {{ $peminjaman->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada peminjaman menunggu</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

{{-- Login Success Toast Notification --}}
@if(session('login_success'))
<div id="login-toast" class="fixed top-4 right-4 z-[9999] transform translate-x-full transition-all duration-500 ease-out">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 p-4 min-w-[320px] max-w-md">
        <div class="flex items-start space-x-3">
            <!-- Icon -->
            <div class="flex-shrink-0">
                <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
            
            <!-- Content -->
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between mb-1">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-white" id="toast-greeting">
                        <!-- Dynamic greeting akan diisi oleh JavaScript -->
                    </h4>
                    <button onclick="closeLoginToast()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Selamat datang kembali, <span class="font-medium text-blue-600 dark:text-blue-400">{{ session('user_name') }}</span>!
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    Login sebagai 
                    <span class="font-medium capitalize">
                        @php
                            $roleNames = [
                                'super_admin' => 'Super Administrator',
                                'admin' => 'Administrator',
                                'pengurus_aset' => 'Pengurus Aset',
                                'user' => 'User'
                            ];
                            $roleName = $roleNames[session('user_role')] ?? 'User';
                        @endphp
                        {{ $roleName }}
                    </span>
                </p>
            </div>
        </div>
        
        <!-- Progress Bar -->
        <div class="mt-3 h-1 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
            <div id="toast-progress" class="h-full bg-gradient-to-r from-green-400 to-emerald-500 rounded-full transition-all duration-[5000ms] ease-linear" style="width: 100%"></div>
        </div>
    </div>
</div>
@endif

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
/* ============================================
   DASHBOARD ADMIN - CUSTOM STYLES
   ============================================ */

/* Pulse Animation */
.pulse-dot {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: .5;
    }
}

/* Card Hover Effect */
.card-hover {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.card-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

/* Dark mode shadow untuk card hover */
.dark .card-hover:hover {
    box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.4), 0 4px 6px -2px rgba(0, 0, 0, 0.3);
}

/* ============================================
   CUSTOM SCROLLBAR
   ============================================ */

/* Light Mode Scrollbar */
.overflow-y-auto::-webkit-scrollbar {
    width: 4px;
}

.overflow-y-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Dark Mode Scrollbar */
.dark .overflow-y-auto::-webkit-scrollbar-track {
    background: #1f2937;
}

.dark .overflow-y-auto::-webkit-scrollbar-thumb {
    background: #4b5563;
}

.dark .overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #6b7280;
}

/* Firefox Scrollbar */
.overflow-y-auto {
    scrollbar-width: thin;
    scrollbar-color: #c1c1c1 #f1f1f1;
}

.dark .overflow-y-auto {
    scrollbar-color: #4b5563 #1f2937;
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

.animate-gentle-scale {
    animation: gentleScale 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    opacity: 0;
}

.delay-100 { animation-delay: 0.1s; }

</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
/// Enhanced Dashboard Statistics Data
window.dashboardStats = {
    permohonan_pending: {{ $stats['permohonan_pending'] ?? 0 }},
    peminjaman_aktif: {{ $stats['peminjaman_aktif'] ?? 0 }},
    pembayaran_pending: {{ $stats['pembayaran_pending'] ?? 0 }},
    peminjaman_overdue: {{ $stats['peminjaman_overdue'] ?? 0 }},
    permohonan_hari_ini: {{ $stats['permohonan_hari_ini'] ?? 0 }},
    barang_maintenance: {{ $stats['barang_maintenance'] ?? 0 }},
    barang_stok_menipis: {{ $stats['barang_stok_menipis'] ?? 0 }},
    total_barang: {{ $stats['total_barang'] ?? 0 }}
};

// Data Real untuk Chart dari Backend (12 bulan)
window.monthlyTrendData = @json($monthlyTrendData ?? []);

// Global chart instance
let monthlyChartInstance = null;

// Initialize AOS (Animate On Scroll)
AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true,
    mirror: false
});

// Enhanced Dashboard Functions
document.addEventListener('DOMContentLoaded', function() {
    
    console.log('✅ Admin Dashboard Loaded');
    
    // Initialize Live Clock
    initializeLiveClock();

    // Initialize Charts
    initializeMonthlyChart();
    
    // Initialize Auto Refresh
    setupAutoRefresh();
    
    // Initialize Notification System
    setupNotifications();
    
    // Initialize Interactive Elements
    setupInteractiveElements();
    
    // Initialize Activity Filters
    setupActivityFilters();
    
    // Debug
    console.log('Chart data:', window.monthlyTrendData);
    console.log('Chart filter buttons:', document.querySelectorAll('.chart-filter-btn').length);
    console.log('Activity filter buttons:', document.querySelectorAll('.activity-filter-btn').length);
    
});

// Monthly Activity Trend Chart - FIXED: Menggunakan Data Real 12 Bulan
function initializeMonthlyChart() {
    const ctx = document.getElementById('monthlyChart');
    if (!ctx) {
        console.warn('⚠️ monthlyChart element not found');
        return;
    }

    // Ambil data real dari backend (12 bulan penuh)
    const chartData = window.monthlyTrendData || [];
    
    // Extract labels dan data dari backend
    const labels = chartData.map(item => item.month);
    const permohonanData = chartData.map(item => item.permohonan);
    const peminjamanData = chartData.map(item => item.peminjaman);

    console.log('Chart Labels:', labels);
    console.log('Permohonan Data:', permohonanData);
    console.log('Peminjaman Data:', peminjamanData);

    monthlyChartInstance = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Permohonan',
                data: permohonanData,
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#3B82F6',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
                hidden: false
            }, {
                label: 'Peminjaman',
                data: peminjamanData,
                borderColor: '#10B981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#10B981',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8,
                hidden: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    borderWidth: 1,
                    cornerRadius: 8,
                    displayColors: true,
                    usePointStyle: true,
                    callbacks: {
                        title: function(context) {
                            return `Bulan ${context[0].label} ${new Date().getFullYear()}`;
                        },
                        label: function(context) {
                            return `${context.dataset.label}: ${context.parsed.y} transaksi`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6B7280',
                        font: {
                            size: 12
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(107, 114, 128, 0.1)'
                    },
                    ticks: {
                        color: '#6B7280',
                        font: {
                            size: 12
                        },
                        callback: function(value) {
                            return Number.isInteger(value) ? value : '';
                        }
                    }
                }
            },
            elements: {
                point: {
                    hoverBorderWidth: 3
                }
            }
        }
    });

    console.log('✅ Chart initialized successfully');

    // Setup chart filter buttons
    setupChartFilters();
}

// Setup Chart Filter Buttons
function setupChartFilters() {
    const filterButtons = document.querySelectorAll('.chart-filter-btn');
    
    if (filterButtons.length === 0) {
        console.warn('⚠️ No chart filter buttons found');
        return;
    }

    console.log(`✅ Found ${filterButtons.length} chart filter buttons`);
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const type = this.getAttribute('data-chart-type');
            
            console.log('Chart filter clicked:', type);
            
            // Update button states
            filterButtons.forEach(btn => {
                btn.classList.remove('bg-blue-100', 'text-blue-600');
                btn.classList.add('text-gray-500', 'hover:bg-gray-100');
            });
            
            this.classList.remove('text-gray-500', 'hover:bg-gray-100');
            this.classList.add('bg-blue-100', 'text-blue-600');
            
            // Toggle chart datasets
            if (monthlyChartInstance) {
                if (type === 'permohonan') {
                    monthlyChartInstance.data.datasets[0].hidden = false; // Show Permohonan
                    monthlyChartInstance.data.datasets[1].hidden = true;  // Hide Peminjaman
                } else if (type === 'peminjaman') {
                    monthlyChartInstance.data.datasets[0].hidden = true;  // Hide Permohonan
                    monthlyChartInstance.data.datasets[1].hidden = false; // Show Peminjaman
                }
                monthlyChartInstance.update('none');
                console.log('✅ Chart updated');
            }
        });
    });
}

// Setup Activity Filter Buttons
function setupActivityFilters() {
    const filterButtons = document.querySelectorAll('.activity-filter-btn');
    const activityItems = document.querySelectorAll('.activity-item');
    const emptyState = document.getElementById('empty-state');
    
    if (filterButtons.length === 0) {
        console.warn('⚠️ No activity filter buttons found');
        return;
    }

    console.log(`✅ Found ${filterButtons.length} activity filter buttons`);
    console.log(`✅ Found ${activityItems.length} activity items`);
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-activity-filter');
            
            console.log('Activity filter clicked:', filter);
            
            // Update button states
            filterButtons.forEach(btn => {
                btn.classList.remove('bg-blue-100', 'text-blue-600');
                btn.classList.add('text-gray-500', 'hover:bg-gray-100');
            });
            
            this.classList.remove('text-gray-500', 'hover:bg-gray-100');
            this.classList.add('bg-blue-100', 'text-blue-600');
            
            // Filter activities
            let visibleCount = 0;
            
            activityItems.forEach(item => {
                const activityType = item.getAttribute('data-activity-type').toLowerCase();
                
                if (filter === 'all') {
                    item.style.display = 'flex';
                    visibleCount++;
                } else if (filter === 'permohonan' && activityType.includes('permohonan')) {
                    item.style.display = 'flex';
                    visibleCount++;
                } else if (filter === 'peminjaman' && activityType.includes('peminjaman')) {
                    item.style.display = 'flex';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });
            
            console.log(`✅ Filtered: ${visibleCount} items visible`);
            
            // Show/hide empty state
            if (emptyState) {
                emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        });
    });
}

// Auto Refresh Setup
function setupAutoRefresh() {
    const refreshBtn = document.getElementById('refresh-dashboard-btn');
    if (!refreshBtn) {
        console.warn('⚠️ Refresh button not found');
        return;
    }

    refreshBtn.addEventListener('click', function() {
        const icon = this.querySelector('svg');
        icon.classList.add('animate-spin');
        
        console.log('🔄 Refreshing dashboard...');
        
        setTimeout(() => {
            location.reload();
        }, 1000);
    });
}

// Notification System
function setupNotifications() {
    if (window.dashboardStats.permohonan_pending > 5) {
        showNotification('Perhatian: ' + window.dashboardStats.permohonan_pending + ' permohonan menunggu persetujuan', 'warning');
    }
    
    if (window.dashboardStats.peminjaman_overdue > 0) {
        showNotification('Peringatan: ' + window.dashboardStats.peminjaman_overdue + ' peminjaman terlambat dikembalikan', 'error');
    }
}

// Show Notification Function
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg border-l-4 transform translate-x-full transition-transform duration-300 ${getNotificationClass(type)}`;
    notification.innerHTML = `
        <div class="flex items-center">
            <div class="flex-shrink-0">
                ${getNotificationIcon(type)}
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">${message}</p>
            </div>
            <button class="ml-4 text-gray-400 hover:text-gray-600" onclick="this.parentElement.parentElement.remove()">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 5000);
}

// Notification Helper Functions
function getNotificationClass(type) {
    const classes = {
        'info': 'bg-blue-50 border-blue-400 text-blue-800',
        'success': 'bg-green-50 border-green-400 text-green-800',
        'warning': 'bg-yellow-50 border-yellow-400 text-yellow-800',
        'error': 'bg-red-50 border-red-400 text-red-800'
    };
    return classes[type] || classes.info;
}

function getNotificationIcon(type) {
    const icons = {
        'info': '<svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        'success': '<svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        'warning': '<svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>',
        'error': '<svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
    };
    return icons[type] || icons.info;
}

// Interactive Elements Setup
function setupInteractiveElements() {
    const cards = document.querySelectorAll('.card-hover');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
}

// Real-time Clock Function
function initializeLiveClock() {
    const clockElement = document.getElementById('live-clock');
    if (!clockElement) {
        console.warn('⚠️ Live clock element not found');
        return;
    }

    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        
        clockElement.textContent = `${hours}:${minutes}:${seconds} WIB`;
    }

    // Update immediately
    updateClock();
    
    // Update every second
    setInterval(updateClock, 1000);
    
    console.log('✅ Live clock initialized');
}

// ============================================
// LOGIN SUCCESS TOAST NOTIFICATION
// ============================================
@if(session('login_success'))
(function() {
    // Dynamic greeting based on time
    function getGreeting() {
        const hour = new Date().getHours();
        const name = "{{ session('user_name') }}";
        
        if (hour >= 5 && hour < 11) {
            return `☀️ Selamat Pagi, ${name}!`;
        } else if (hour >= 11 && hour < 15) {
            return `🌤️ Selamat Siang, ${name}!`;
        } else if (hour >= 15 && hour < 18) {
            return `🌅 Selamat Sore, ${name}!`;
        } else {
            return `🌙 Selamat Malam, ${name}!`;
        }
    }

    // Show toast dengan delay
    setTimeout(() => {
        const toast = document.getElementById('login-toast');
        const greetingEl = document.getElementById('toast-greeting');
        const progressBar = document.getElementById('toast-progress');
        
        if (toast && greetingEl) {
            // Set greeting text
            greetingEl.textContent = getGreeting();
            
            // Show toast with animation
            toast.style.transform = 'translateX(0)';
            
            // Start progress bar animation
            if (progressBar) {
                setTimeout(() => {
                    progressBar.style.width = '0%';
                }, 100);
            }
            
            // Auto hide after 5 seconds
            setTimeout(() => {
                closeLoginToast();
            }, 5000);
            
            console.log('✅ Login toast displayed successfully');
        }
    }, 500); // Delay 500ms untuk smooth appearance
})();

// Function to close toast
window.closeLoginToast = function() {
    const toast = document.getElementById('login-toast');
    if (toast) {
        toast.style.transform = 'translateX(150%)';
        toast.style.opacity = '0';
        setTimeout(() => {
            toast.remove();
        }, 500);
    }
};
@endif

// Dashboard initialization complete
console.log('%c🚀 Pelita App Dashboard Administrator', 'color: #3B82F6; font-size: 16px; font-weight: bold;');
console.log('%cDashboard loaded successfully!', 'color: #10B981; font-size: 12px;');
console.log('%cStats:', 'color: #6B7280; font-size: 12px;', window.dashboardStats);
console.log('%cMonthly Trend Data:', 'color: #6B7280; font-size: 12px;', window.monthlyTrendData);

// Error Handling
window.addEventListener('error', function(e) {
    console.error('Dashboard Error:', e.error);
});
</script>
@endpush
@endsection