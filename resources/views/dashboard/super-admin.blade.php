@extends('layouts.app')

@section('title', 'Dashboard Super Administrator - Pelita App')

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
            <div class="relative p-4 sm:p-6 lg:p-10">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    
                    {{-- Left Section: Title & Description --}}
                    <div class="flex-1">
                        {{-- Icon Badge --}}
                        <div class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-blue-500/10 to-indigo-500/10 dark:from-blue-600/20 dark:to-indigo-600/20 border border-blue-200/50 dark:border-blue-700/50 rounded-full mb-4">
                            <div class="w-2 h-2 bg-blue-500 dark:bg-blue-400 rounded-full animate-pulse"></div>
                            <span class="text-sm font-semibold text-blue-700 dark:text-blue-300">Management System</span>
                        </div>
                        
                        {{-- Main Title --}}
                        <h1 class="text-2xl sm:text-3xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-blue-800 to-indigo-800 dark:from-slate-100 dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent leading-tight">
                            Dashboard Super Administrator
                        </h1>
                        
                        {{-- Description --}}
                        <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-lg flex items-center space-x-2">
                            <i class="fas fa-info-circle text-blue-500 dark:text-blue-400"></i>
                            <span>Pantau seluruh sistem manajemen aset secara real-time</span>
                        </p>
                        
                        {{-- Quick Stats --}}
                        <div class="flex flex-wrap items-center gap-2 mt-3">
                            <div class="flex items-center space-x-2 px-4 py-2 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm rounded-lg border border-slate-200/50 dark:border-gray-600/50 shadow-sm">
                                <div class="p-1.5 bg-green-100 dark:bg-green-900/50 rounded-md">
                                    <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Status Sistem</p>
                                    <p class="text-sm font-bold text-slate-800 dark:text-slate-200">Sistem Normal</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-2 px-4 py-2 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm rounded-lg border border-slate-200/50 dark:border-gray-600/50 shadow-sm">
                                <div class="p-1.5 bg-blue-100 dark:bg-blue-900/50 rounded-md">
                                    <i class="fas fa-server text-blue-600 dark:text-blue-400 text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Uptime</p>
                                    <p class="text-sm font-bold text-slate-800 dark:text-slate-200">99.9%</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Right Section: Action Buttons & Clock --}}
                    <div class="flex flex-col gap-3">
                        {{-- Live Clock --}}
                        <div class="px-3 py-2 sm:px-6 sm:py-3 bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm rounded-xl border border-slate-200 dark:border-gray-600 shadow-sm text-center">
                            <p id="live-clock" class="text-base sm:text-lg font-bold text-gray-900 dark:text-white">{{ now()->format('H:i:s') }} WIB</p>
                            <p class="text-xs text-green-600 dark:text-green-400 flex items-center justify-center mt-1">
                                <span class="inline-flex h-2 w-2 rounded-full bg-green-400 dark:bg-green-500 animate-pulse mr-1"></span>
                                Live Update
                            </p>
                        </div>
                        
                        {{-- Refresh Button --}}
                        <button id="refresh-dashboard-btn" 
                            class="group relative inline-flex items-center justify-center px-3 py-2 sm:px-6 sm:py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                            <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
                            <svg class="w-4 h-4 mr-2 relative group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Alert Section -->
        @if($stats['permohonan_pending'] > 10 || $stats['barang_maintenance'] > 5)
        <div class="mb-8 bg-yellow-50 dark:bg-yellow-900/20 border-l-4 border-yellow-400 dark:border-yellow-500 p-2 sm:p-4 rounded-r-lg" data-aos="fade-down">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400 dark:text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        Perhatian Diperlukan
                    </h3>
                    <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                        @if($stats['permohonan_pending'] > 10)
                            <p>• {{ $stats['permohonan_pending'] }} permohonan menunggu persetujuan</p>
                        @endif
                        @if($stats['barang_maintenance'] > 5)
                            <p>• {{ $stats['barang_maintenance'] }} aset memerlukan maintenance</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <!-- Primary KPIs Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Ringkasan Utama Sistem
                </h2>
                <p class="text-sm text-green-700 dark:text-green-400 flex items-center justify-center mt-1">
                    <span class="inline-flex h-2 w-2 rounded-full bg-green-400 dark:bg-green-500 animate-pulse mr-1"></span>
                        Live Update
                </p>
            </div>
            
            <div class="grid grid-cols-2 gap-3 mb-8">
                
                <!-- Total Assets -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 sm:p-6 card-hover transition-all duration-300" data-aos="fade-up" data-aos-delay="0">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-8 h-8 sm:w-12 sm:h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                            </svg>
                            +12%
                        </span>
                    </div>
                    <div class="space-y-3">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-0">Total Aset Tersedia</p>
                        <p id="total-barang" class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-0">{{ number_format($stats['total_barang']) }}</p>
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between text-xs gap-2 mb-0">
                            <span class="inline-flex items-center px-2 py-1 rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400 font-medium">
                                {{ $stats['barang_dipinjam'] }} Dipinjam
                            </span>
                            <span class="inline-flex items-center px-2 py-1 rounded-full bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400 font-medium">
                                {{ $stats['barang_maintenance'] }} Maintenance
                            </span>
                        </div>
                        <div class="text-xs mt-2">
                            <a href="{{ route('admin.barang.index') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium">Lihat Detail →</a>
                        </div>
                    </div>
                </div>

                <!-- Users -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 sm:p-6 card-hover transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-8 h-8 sm:w-12 sm:h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                            </svg>
                            +8%
                        </span>
                    </div>
                    <div class="space-y-3">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-0">Total Pengguna</p>
                        <p id="total-users" class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-0">{{ number_format($stats['total_users']) }}</p>
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between text-xs gap-2 mb-0">
                            <span class="text-gray-500 dark:text-gray-400">{{ $stats['total_admin'] }} Admin</span>
                            <span class="text-gray-500 dark:text-gray-400">{{ $stats['total_users'] - $stats['total_admin'] }} User</span>
                        </div>
                        <div class="text-xs mt-2">
                            <a href="{{ route('admin.users.index') }}" class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-800 dark:hover:text-emerald-300 font-medium">Lihat Detail →</a>
                        </div>
                    </div>
                </div>

                <!-- Requests -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 sm:p-6 card-hover transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-8 h-8 sm:w-12 sm:h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-400">
                            Bulan ini
                        </span>
                    </div>
                    <div class="space-y-3">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-0">Permohonan</p>
                        <p id="total-permohonan" class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-0">{{ number_format($stats['total_permohonan']) }}</p>
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between text-xs gap-2 mb-0">
                            <span class="text-yellow-600 dark:text-yellow-400 font-medium">{{ $stats['permohonan_pending'] }} Pending</span>
                            <span class="text-gray-500 dark:text-gray-400">Total</span>
                        </div>
                        <div class="text-xs mt-2">
                            <a href="{{ route('admin.permohonan.index') }}" class="text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-300 font-medium">Lihat Detail →</a>
                        </div>
                    </div>
                </div>

                <!-- Actions Required -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 sm:p-6 card-hover transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-8 h-8 sm:w-12 sm:h-12 bg-gradient-to-br from-orange-500 to-red-500 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        @if($stats['permohonan_pending'] > 0)
                            <span class="flex h-3 w-3">
                                <span class="animate-ping absolute inline-flex h-3 w-3 rounded-full bg-red-400 dark:bg-red-500 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 dark:bg-red-600"></span>
                            </span>
                        @else
                            <span class="inline-flex h-3 w-3 rounded-full bg-green-400 dark:bg-green-500"></span>
                        @endif
                    </div>
                    <div class="space-y-3">
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400 mb-0">Perlu Tindakan</p>
                        <p id="permohonan-pending" class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-0">{{ $stats['permohonan_pending'] }}</p>
                        <div class="text-xs mb-0">
                            @if($stats['permohonan_pending'] > 0)
                                <span class="text-red-600 dark:text-red-400 font-medium">Segera ditangani</span>
                            @else
                                <span class="text-green-600 dark:text-green-400 font-medium">Semua tertangani</span>
                            @endif
                        </div>
                        <div class="text-xs mt-2">
                            @if($stats['permohonan_pending'] > 0)
                                <a href="{{ route('admin.permohonan.index') }}" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 font-medium">Tinjau Sekarang →</a>
                            @else
                                <span class="text-gray-500 dark:text-gray-400">Tidak ada tindakan</span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Secondary Metrics Section -->
        <div class="mb-8">
            <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                </svg>
                Metrik Tambahan
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-3">
                
                <!-- Peminjaman -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-3 sm:p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Peminjaman</p>
                            <p class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['total_peminjaman']) }}</p>
                            <p class="text-xs text-green-600 dark:text-green-400 font-medium">{{ $stats['peminjaman_aktif'] }} Aktif</p>
                        </div>
                        <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Kategori -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-3 sm:p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Kategori Aset</p>
                            <p class="text-lg sm:text-xl font-semibold text-gray-900 dark:text-white">{{ $stats['total_kategori'] }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Tipe berbeda</p>
                        </div>
                        <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Maintenance -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-3 sm:p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Maintenance</p>
                            <p class="text-lg sm:text-xl font-semibold text-amber-600 dark:text-amber-400">{{ $stats['barang_maintenance'] }}</p>
                            <p class="text-xs text-amber-600 dark:text-amber-400">Dalam proses</p> {{-- ✅ UBAH LABEL --}}
                        </div>
                        <div class="w-8 h-8 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- System Health -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-3 sm:p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">System Health</p>
                            <p class="text-lg sm:text-xl font-semibold text-green-600 dark:text-green-400">99.9%</p>
                            <p class="text-xs text-green-600 dark:text-green-400">Optimal</p>
                        </div>
                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Active Sessions -->
                <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Sesi Aktif</p>
                            <p class="text-lg sm:text-xl font-semibold text-blue-600 dark:text-blue-400">{{ rand(12, 48) }}</p>
                            <p class="text-xs text-blue-600 dark:text-blue-400">Online now</p>
                        </div>
                        <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.636 18.364a9 9 0 010-12.728m12.728 0a9 9 0 010 12.728m-9.9-2.829a5 5 0 010-7.07m7.072 0a5 5 0 010 7.07M13 12a1 1 0 11-2 0 1 1 0 012 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- Analytics and Quick Actions Section -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-8">
            
            <!-- Asset Status Distribution -->
                <div class="lg:col-span-3 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-3 sm:p-6 shadow-sm" data-aos="fade-up">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-2">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Status Aset
                    </h3>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full pulse-dot"></div>
                        <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">Live</span>
                    </div>
                </div>
                
                <!-- Donut Chart -->
                <div class="relative mb-6">
                    <div class="w-32 h-32 mx-auto">
                        <canvas id="statusDonutChart"></canvas>
                    </div>
                </div>

                <div class="space-y-4">
                    <!-- Available -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Tersedia</span>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $stats['barang_tersedia'] }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 block">
                                {{ $stats['total_barang'] > 0 ? round(($stats['barang_tersedia'] / $stats['total_barang']) * 100) : 0 }}%
                            </span>
                        </div>
                    </div>

                    <!-- Borrowed -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Dipinjam</span>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $stats['barang_dipinjam'] }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 block">
                                {{ $stats['total_barang'] > 0 ? round(($stats['barang_dipinjam'] / $stats['total_barang']) * 100) : 0 }}%
                            </span>
                        </div>
                    </div>

                    <!-- Maintenance -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-red-500 rounded-full mr-3"></div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Maintenance</span>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $stats['barang_maintenance'] }}</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400 block">
                                {{ $stats['total_barang'] > 0 ? round(($stats['barang_maintenance'] / $stats['total_barang']) * 100) : 0 }}%
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Trend Chart -->
            <div class="lg:col-span-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-3 sm:p-6 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                        </svg>
                        Tren Aktivitas {{ date('Y') }}
                    </h3>
                    <div class="flex space-x-2">
                        <button data-chart-type="permohonan" class="chart-filter-btn px-3 py-1 text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-full">Permohonan</button>
                        <button data-chart-type="peminjaman" class="chart-filter-btn px-3 py-1 text-xs font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full">Peminjaman</button>
                    </div>
                </div>
                
                <div class="relative h-64 mb-4">
                    <canvas id="monthlyChart" class="w-full h-full"></canvas>
                </div>

                <!-- Chart Legend -->
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

            <!-- Quick Actions Panel -->
            <div class="lg:col-span-3 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-3 sm:p-6 shadow-sm" data-aos="fade-up" data-aos-delay="200">
                <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Aksi Cepat
                </h3>
                
                <div class="space-y-3">
                    <a href="{{ route('admin.barang.create') }}" 
                       class="flex items-center p-3 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:border-blue-200 dark:hover:border-blue-700 transition-all group">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-3 group-hover:bg-blue-200 dark:group-hover:bg-blue-800/40 transition-colors">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900 dark:text-white">Tambah Aset</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Daftarkan aset baru</div>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.users.create') }}" 
                       class="flex items-center p-3 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 hover:border-emerald-200 dark:hover:border-emerald-700 transition-all group">
                        <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mr-3 group-hover:bg-emerald-200 dark:group-hover:bg-emerald-800/40 transition-colors">
                            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900 dark:text-white">Tambah User</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Daftarkan pengguna</div>
                        </div>
                    </a>
                    
                    <a href="{{ route('admin.kategori-barang.index') }}" 
                       class="flex items-center p-3 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-purple-50 dark:hover:bg-purple-900/20 hover:border-purple-200 dark:hover:border-purple-700 transition-all group">
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-3 group-hover:bg-purple-200 dark:group-hover:bg-purple-800/40 transition-colors">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900 dark:text-white">Kelola Kategori</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Atur kategori aset</div>
                        </div>
                    </a>

                    <a href="{{ route('admin.maintenance.index') }}" 
                       class="flex items-center p-3 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-amber-50 dark:hover:bg-amber-900/20 hover:border-amber-200 dark:hover:border-amber-700 transition-all group">
                        <div class="w-10 h-10 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center mr-3 group-hover:bg-amber-200 dark:group-hover:bg-amber-800/40 transition-colors">
                            <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900 dark:text-white">Maintenance</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Kelola pemeliharaan</div>
                        </div>
                    </a>
                </div>

                <!-- System Status Indicator -->
                <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-3 flex items-center">
                        <svg class="w-4 h-4 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        Status Sistem
                    </h4>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-600 dark:text-gray-400">Database</span>
                            <span class="flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-green-400 dark:bg-green-500 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500 dark:bg-green-600"></span>
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-600 dark:text-gray-400">Cache</span>
                            <span class="inline-flex h-2 w-2 rounded-full bg-green-500 dark:bg-green-600"></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-600 dark:text-gray-400">Storage</span>
                            <span class="inline-flex h-2 w-2 rounded-full bg-yellow-500 dark:bg-yellow-600"></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Recent Activities and Data Tables Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            
            <!-- Recent System Activities -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm" data-aos="fade-up">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-5 h-5 mr-2 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Aktivitas Terbaru
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        <button data-activity-filter="all" class="activity-filter-btn px-2 sm:px-3 py-0.5 sm:py-1 text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-full">Semua</button>
                        <button data-activity-filter="permohonan" class="activity-filter-btn px-2 sm:px-3 py-0.5 sm:py-1 text-xs font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full">Permohonan</button>
                        <button data-activity-filter="peminjaman" class="activity-filter-btn px-2 sm:px-3 py-0.5 sm:py-1 text-xs font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full">Peminjaman</button>
                    </div>
                </div>
                
                <div class="space-y-4 max-h-96 overflow-y-auto" id="activities-container">
                    @forelse($systemActivities ?? [] as $activity)
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
                            <div class="w-8 h-8 sm:w-12 sm:h-12 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <svg class="w-6 h-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada aktivitas sistem</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Top Asset Categories -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Kategori Populer
                        </h3>
                        <a href="{{ route('admin.kategori-barang.index') }}"
                           class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium flex items-center">
                            Kelola
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div class="p-0">
                    <div class="max-h-80 overflow-y-auto">
                        @forelse($topKategori as $index => $kategori)
                            <div class="flex items-center justify-between p-3 sm:p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors border-b border-gray-100 dark:border-gray-700">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                        {{ $index + 1 }}
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $kategori->nama_kategori }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $kategori->barang_count }} aset terdaftar</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-24 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-indigo-400 to-purple-600 h-2 rounded-full transition-all duration-500" 
                                             style="width: {{ $topKategori->max('barang_count') > 0 ? ($kategori->barang_count / $topKategori->max('barang_count')) * 100 : 0 }}%"></div>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $kategori->barang_count }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <div class="w-8 h-8 sm:w-12 sm:h-12 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada kategori</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>

        <!-- Recent Requests and Loans Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Recent Requests -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm" data-aos="fade-up">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Permohonan Terbaru
                        </h3>
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
                        @forelse($recentPermohonan as $permohonan)
                            <div class="flex items-center justify-between p-3 sm:p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors border-b border-gray-100 dark:border-gray-700">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
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
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($permohonan->status === 'Dalam Proses') bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-400
                                        @elseif($permohonan->status === 'Disetujui') bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400
                                        @elseif($permohonan->status === 'Ditolak') bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400
                                        @else bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-400 @endif">
                                        {{ $permohonan->status }}
                                    </span>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        {{ $permohonan->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <div class="w-8 h-8 sm:w-12 sm:h-12 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada permohonan</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Active Loans -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm" data-aos="fade-up" data-aos-delay="100">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                            <svg class="w-5 h-5 mr-2 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            Peminjaman Aktif
                        </h3>
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
                        @forelse($activePeminjaman ?? [] as $peminjaman)
                            <div class="flex items-center justify-between p-3 sm:p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors border-b border-gray-100 dark:border-gray-700">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-white">
                                            {{ strtoupper(substr($peminjaman->user->name ?? 'U', 0, 2)) }}
                                        </span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                            {{ $peminjaman->user->name ?? 'Unknown User' }}
                                        </p>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            @if($peminjaman->barang)
                                                {{ $peminjaman->barang->nama_barang }}
                                            @else
                                                <span class="italic">Aset tidak tersedia</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    @php
                                        $isOverdue = $peminjaman->tanggal_selesai && \Carbon\Carbon::parse($peminjaman->tanggal_selesai)->isPast();
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($isOverdue) bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-400
                                        @else bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-400 @endif">
                                        @if($isOverdue) Terlambat @else Aktif @endif
                                    </span>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        Kembali: {{ \Carbon\Carbon::parse($peminjaman->tanggal_selesai ?? now())->format('d/m/Y') }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <div class="w-8 h-8 sm:w-12 sm:h-12 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Tidak ada peminjaman aktif</p>
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
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 p-2 sm:p-4 min-w-[220px] sm:min-w-[320px] max-w-sm sm:max-w-md">
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
   SUPER ADMIN DASHBOARD - CUSTOM STYLES
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

/* Count-up animation effect */
@keyframes countUpPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.count-up-animating {
    animation: countUpPulse 0.5s ease-in-out;
}
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    
// Enhanced Dashboard Statistics Data
window.dashboardStats = {
    total_barang: {{ $stats['total_barang'] ?? 0 }},
    total_users: {{ $stats['total_users'] ?? 0 }},
    total_admin: {{ $stats['total_admin'] ?? 0 }},
    total_permohonan: {{ $stats['total_permohonan'] ?? 0 }},
    permohonan_pending: {{ $stats['permohonan_pending'] ?? 0 }},
    barang_tersedia: {{ $stats['barang_tersedia'] ?? 0 }},
    barang_dipinjam: {{ $stats['barang_dipinjam'] ?? 0 }},
    barang_maintenance: {{ $stats['barang_maintenance'] ?? 0 }},
    total_peminjaman: {{ $stats['total_peminjaman'] ?? 0 }},
    peminjaman_aktif: {{ $stats['peminjaman_aktif'] ?? 0 }},
    total_kategori: {{ $stats['total_kategori'] ?? 0 }},
    total_maintenance: {{ $stats['total_maintenance'] ?? 0 }}
};

// Data Real untuk Chart dari Backend
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
    
    console.log('✅ Super Admin Dashboard Loaded');
    
    // Initialize Live Clock
    initializeLiveClock();

    // Initialize Count Up Animation
    initializeCountUpAnimations();
    
    // Initialize Charts
    initializeStatusChart();
    initializeMonthlyChart();
    
    // Initialize Auto Refresh
    setupAutoRefresh();
    
    // Initialize Notification System
    setupNotifications();
    
    // Initialize Interactive Elements
    setupInteractiveElements();
    
    // Initialize Activity Filters
    setupActivityFilters();
    
});

// VANILLA JS Count Up Animation
function initializeCountUpAnimations() {
    const counters = [
        { id: 'total-barang', target: window.dashboardStats.total_barang },
        { id: 'total-users', target: window.dashboardStats.total_users },
        { id: 'total-permohonan', target: window.dashboardStats.total_permohonan },
        { id: 'permohonan-pending', target: window.dashboardStats.permohonan_pending }
    ];

    counters.forEach(counter => {
        const element = document.getElementById(counter.id);
        if (!element) return;

        const target = counter.target;
        const duration = 2000;
        const steps = 60;
        const stepDuration = duration / steps;
        const increment = target / steps;
        let current = 0;
        let step = 0;

        element.classList.add('count-up-animating');

        const timer = setInterval(() => {
            step++;
            current += increment;
            
            if (step >= steps) {
                current = target;
                clearInterval(timer);
                element.classList.remove('count-up-animating');
            }
            
            element.textContent = Math.floor(current).toLocaleString('id-ID');
        }, stepDuration);
    });

    console.log('✅ Count-up animations initialized!');
}

// Status Distribution Donut Chart
function initializeStatusChart() {
    const ctx = document.getElementById('statusDonutChart');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Tersedia', 'Dipinjam', 'Maintenance'],
            datasets: [{
                data: [
                    window.dashboardStats.barang_tersedia,
                    window.dashboardStats.barang_dipinjam,
                    window.dashboardStats.barang_maintenance
                ],
                backgroundColor: [
                    '#10B981',
                    '#F59E0B',
                    '#EF4444'
                ],
                borderWidth: 0,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            cutout: '70%',
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
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) : 0;
                            return `${context.label}: ${context.parsed} (${percentage}%)`;
                        }
                    }
                }
            },
            animation: {
                animateRotate: true,
                duration: 1000
            }
        }
    });
}

// Monthly Activity Trend Chart
function initializeMonthlyChart() {
    const ctx = document.getElementById('monthlyChart');
    if (!ctx) return;

    const chartData = window.monthlyTrendData || [];
    const labels = chartData.map(item => item.month);
    const permohonanData = chartData.map(item => item.permohonan);
    const peminjamanData = chartData.map(item => item.peminjaman);

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

    setupChartFilters();
}

function setupChartFilters() {
    const filterButtons = document.querySelectorAll('.chart-filter-btn');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const type = this.getAttribute('data-chart-type');
            
            filterButtons.forEach(btn => {
                btn.classList.remove('bg-blue-100', 'dark:bg-blue-900/30', 'text-blue-600', 'dark:text-blue-400');
                btn.classList.add('text-gray-500', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-gray-700');
            });
            
            this.classList.remove('text-gray-500', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-gray-700');
            this.classList.add('bg-blue-100', 'dark:bg-blue-900/30', 'text-blue-600', 'dark:text-blue-400');
            
            if (monthlyChartInstance) {
                if (type === 'permohonan') {
                    monthlyChartInstance.data.datasets[0].hidden = false;
                    monthlyChartInstance.data.datasets[1].hidden = true;
                } else if (type === 'peminjaman') {
                    monthlyChartInstance.data.datasets[0].hidden = true;
                    monthlyChartInstance.data.datasets[1].hidden = false;
                }
                monthlyChartInstance.update('none');
            }
        });
    });
}

function setupActivityFilters() {
    const filterButtons = document.querySelectorAll('.activity-filter-btn');
    const activityItems = document.querySelectorAll('.activity-item');
    const emptyState = document.getElementById('empty-state');
    
    if (filterButtons.length === 0) return;
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-activity-filter');
            
            filterButtons.forEach(btn => {
                btn.classList.remove('bg-blue-100', 'dark:bg-blue-900/30', 'text-blue-600', 'dark:text-blue-400');
                btn.classList.add('text-gray-500', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-gray-700');
            });
            
            this.classList.remove('text-gray-500', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-gray-700');
            this.classList.add('bg-blue-100', 'dark:bg-blue-900/30', 'text-blue-600', 'dark:text-blue-400');
            
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
            
            if (emptyState) {
                emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        });
    });
}

function setupAutoRefresh() {
    const refreshBtn = document.getElementById('refresh-dashboard-btn');
    if (!refreshBtn) return;

    refreshBtn.addEventListener('click', function() {
        const icon = this.querySelector('svg');
        icon.classList.add('animate-spin');
        
        console.log('🔄 Refreshing dashboard...');
        
        setTimeout(() => {
            location.reload();
        }, 1000);
    });
}

function setupNotifications() {
    if (window.dashboardStats.permohonan_pending > 10) {
        showNotification('Perhatian: ' + window.dashboardStats.permohonan_pending + ' permohonan menunggu persetujuan', 'warning');
    }
    
    if (window.dashboardStats.barang_maintenance > 5) {
        showNotification('Peringatan: ' + window.dashboardStats.barang_maintenance + ' aset memerlukan maintenance', 'error');
    }
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-2 sm:p-4 rounded-lg shadow-lg border-l-4 transform translate-x-full transition-transform duration-300 ${getNotificationClass(type)}`;
    notification.innerHTML = `
        <div class="flex items-center">
            <div class="flex-shrink-0">
                ${getNotificationIcon(type)}
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">${message}</p>
            </div>
            <button class="ml-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" onclick="this.parentElement.parentElement.remove()">
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

function getNotificationClass(type) {
    const classes = {
        'info': 'bg-blue-50 dark:bg-blue-900/20 border-blue-400 dark:border-blue-500 text-blue-800 dark:text-blue-200',
        'success': 'bg-green-50 dark:bg-green-900/20 border-green-400 dark:border-green-500 text-green-800 dark:text-green-200',
        'warning': 'bg-yellow-50 dark:bg-yellow-900/20 border-yellow-400 dark:border-yellow-500 text-yellow-800 dark:text-yellow-200',
        'error': 'bg-red-50 dark:bg-red-900/20 border-red-400 dark:border-red-500 text-red-800 dark:text-red-200'
    };
    return classes[type] || classes.info;
}

function getNotificationIcon(type) {
    const icons = {
        'info': '<svg class="w-5 h-5 text-blue-400 dark:text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        'success': '<svg class="w-5 h-5 text-green-400 dark:text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        'warning': '<svg class="w-5 h-5 text-yellow-400 dark:text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>',
        'error': '<svg class="w-5 h-5 text-red-400 dark:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
    };
    return icons[type] || icons.info;
}

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

    updateClock();
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

console.log('%c🚀 Pelita App Dashboard Super Administrator', 'color: #3B82F6; font-size: 16px; font-weight: bold;');
console.log('%c✨ Dark Mode Support Active!', 'color: #10B981; font-size: 12px;');
console.log('%cStats:', 'color: #6B7280; font-size: 12px;', window.dashboardStats);

window.addEventListener('error', function(e) {
    console.error('Dashboard Error:', e.error);
});
</script>
@endpush
@endsection