@extends(auth()->user()->role === 'user' ? 'layouts.user' : 'layouts.app')

@section('title', 'Notifikasi')

@push('styles')
<style>
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from { transform: translateY(20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

@keyframes pulse-badge {
    0%, 100% {
        opacity: 1;
        transform: scale(1);
    }
    50% {
        opacity: 0.6;
        transform: scale(1.1);
    }
}

@keyframes slideInRight {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes slideOutRight {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(100%); opacity: 0; }
}

.animate-fade-in { animation: fadeIn 0.6s ease-out; }
.animate-slide-up { animation: slideUp 0.5s ease-out; }
.animate-pulse-slow { animation: pulse 2s infinite; }
.animate-slide-in-right { animation: slideInRight 0.5s ease-out; }

/* Dark mode transitions */
* {
    transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
}

.notification-item {
    transition: all 0.2s ease;
}

.notification-item:hover {
    background: linear-gradient(90deg, rgba(59, 130, 246, 0.05), rgba(59, 130, 246, 0.02));
    transform: translateX(2px);
}

.dark .notification-item:hover {
    background: linear-gradient(90deg, rgba(59, 130, 246, 0.1), rgba(59, 130, 246, 0.05));
}

.notification-unread {
    background: linear-gradient(90deg, #eff6ff 0%, #ffffff 100%);
    border-left: 3px solid #3b82f6;
}

.dark .notification-unread {
    background: linear-gradient(90deg, rgba(59, 130, 246, 0.15) 0%, rgba(59, 130, 246, 0.05) 100%);
    border-left: 3px solid #60a5fa;
}

.unread-badge {
    width: 8px;
    height: 8px;
    background: #3b82f6;
    border-radius: 50%;
    flex-shrink: 0;
    animation: pulse-badge 2s infinite;
}

/* Loading Spinner */
.spinner {
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top: 2px solid white;
    width: 16px;
    height: 16px;
    animation: spin 0.6s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
@endpush

@section('content')
<div class="w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 lg:py-4">
        
        {{-- Modern Breadcrumb Navigation --}}
        <nav class="mb-8 animate-fade-in" aria-label="Breadcrumb">
            <div class="breadcrumb-modern">
                <a href="{{ route('dashboard') }}" class="breadcrumb-link">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                
                <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs"></i>
                
                <span class="breadcrumb-current">
                    <i class="fas fa-bell"></i>
                    <span>Notifikasi</span>
                </span>
            </div>
        </nav>

        {{-- Modern Header Section with Enhanced Design --}}
        <div class="mb-8 animate-fade-in">
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
                                <span class="text-sm font-semibold text-blue-700 dark:text-blue-300">Notification Center</span>
                            </div>
                            
                            {{-- Main Title --}}
                            <h1 class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-blue-800 to-indigo-800 dark:from-slate-100 dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent leading-tight">
                                Notifikasi
                            </h1>
                            
                            {{-- Description --}}
                            <p class="text-slate-600 dark:text-slate-400 text-lg flex items-center space-x-2">
                                <i class="fas fa-info-circle text-blue-500 dark:text-blue-400"></i>
                                <span>Kelola dan pantau semua notifikasi Anda</span>
                            </p>
                            
                            {{-- Quick Stats --}}
                            <div class="flex flex-wrap items-center gap-4 mt-6">
                                <div class="flex items-center space-x-2 px-4 py-2 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm rounded-lg border border-slate-200/50 dark:border-gray-600/50 shadow-sm">
                                    <div class="p-1.5 bg-blue-100 dark:bg-blue-900/50 rounded-md">
                                        <i class="fas fa-bell text-blue-600 dark:text-blue-400 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Total Notifikasi</p>
                                        <p class="text-lg font-bold text-slate-800 dark:text-slate-200" id="total-count">{{ $notifications->total() }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-2 px-4 py-2 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm rounded-lg border border-red-200/50 dark:border-red-800/50 shadow-sm">
                                    <div class="p-1.5 bg-red-100 dark:bg-red-900/50 rounded-md">
                                        <i class="fas fa-exclamation-circle text-red-600 dark:text-red-400 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Belum Dibaca</p>
                                        <p class="text-lg font-bold text-slate-800 dark:text-slate-200" id="unread-count">{{ $notifications->where('is_read', false)->count() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Right Section: Action Button --}}
                        @if($notifications->total() > 0)
                        <div class="flex flex-col sm:flex-row lg:flex-col gap-3">
                            <button 
                                onclick="markAllAsRead()"
                                id="mark-all-btn"
                                type="button" 
                                class="group relative inline-flex items-center justify-center px-6 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 w-full lg:w-auto disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                                <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
                                <i class="fas fa-check-double mr-2.5 group-hover:scale-110 transition-transform duration-300 relative" id="btn-icon"></i>
                                <span class="relative" id="btn-text">Tandai Semua Dibaca</span>
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
                
                {{-- Bottom Accent Line --}}
                <div class="h-1.5 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>
            </div>
        </div>

        {{-- Modern Stats Cards Section --}}
        <div class="mb-8 animate-slide-up">
            {{-- Header Stats Section --}}
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                        <i class="fas fa-chart-pie text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Status Notifikasi</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Overview statistik notifikasi real-time</p>
                    </div>
                </div>
                
                {{-- Last Update Badge --}}
                <div class="hidden md:flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-lg border border-gray-200 dark:border-gray-600">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-xs text-gray-600 dark:text-gray-300 font-medium">Live Update</span>
                </div>
            </div>
            
            {{-- Stats Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-5">
                
                {{-- Total Notifikasi --}}
                <div class="group relative overflow-hidden bg-gradient-to-br from-blue-500 via-blue-600 to-indigo-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
                    
                    <div class="relative p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-bell text-white text-2xl"></i>
                            </div>
                            <div class="flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full">
                                <i class="fas fa-arrow-up text-white text-xs"></i>
                                <span class="text-white text-xs font-bold">100%</span>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-blue-100 text-sm font-medium">Total Notifikasi</p>
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-4xl font-black text-white" id="stat-total">{{ $notifications->total() }}</h3>
                                <span class="text-blue-100 text-sm">notifikasi</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                            <span class="text-blue-100 text-xs font-medium">Semua notifikasi</span>
                            <i class="fas fa-inbox text-blue-100 text-sm"></i>
                        </div>
                    </div>
                </div>

                {{-- Belum Dibaca --}}
                <div class="group relative overflow-hidden bg-gradient-to-br from-red-500 via-red-600 to-rose-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
                    
                    <div class="relative p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl group-hover:scale-110 transition-transform duration-300 relative">
                                <i class="fas fa-exclamation-circle text-white text-2xl"></i>
                                <div class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-300 rounded-full animate-ping"></div>
                                <div class="absolute -top-1 -right-1 w-3 h-3 bg-yellow-300 rounded-full"></div>
                            </div>
                            <div class="flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full">
                                <div class="w-2 h-2 bg-yellow-200 rounded-full animate-pulse"></div>
                                <span class="text-white text-xs font-bold">Unread</span>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-red-100 text-sm font-medium">Belum Dibaca</p>
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-4xl font-black text-white" id="stat-unread">{{ $notifications->where('is_read', false)->count() }}</h3>
                                <span class="text-red-100 text-sm">pending</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                            <span class="text-red-100 text-xs font-medium">Perlu perhatian</span>
                            <div class="flex items-center gap-1">
                                <div class="w-1.5 h-1.5 bg-yellow-200 rounded-full animate-pulse"></div>
                                <div class="w-1.5 h-1.5 bg-yellow-200 rounded-full animate-pulse" style="animation-delay: 0.2s;"></div>
                                <div class="w-1.5 h-1.5 bg-yellow-200 rounded-full animate-pulse" style="animation-delay: 0.4s;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sudah Dibaca --}}
                <div class="group relative overflow-hidden bg-gradient-to-br from-emerald-500 via-emerald-600 to-green-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
                    
                    <div class="relative p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-check-double text-white text-2xl"></i>
                            </div>
                            <div class="flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full">
                                <i class="fas fa-check text-white text-xs"></i>
                                <span class="text-white text-xs font-bold">Read</span>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-emerald-100 text-sm font-medium">Sudah Dibaca</p>
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-4xl font-black text-white" id="stat-read">{{ $notifications->where('is_read', true)->count() }}</h3>
                                <span class="text-emerald-100 text-sm">read</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                            <span class="text-emerald-100 text-xs font-medium">Telah ditinjau</span>
                            <div class="w-2 h-2 bg-green-200 rounded-full animate-pulse"></div>
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
                            <p class="text-xs text-gray-600 dark:text-gray-400">Notifikasi diperbarui secara real-time saat ada aktivitas baru</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300" id="info-unread">
                                {{ $notifications->where('is_read', false)->count() }} Perlu Dibaca
                            </span>
                        </div>
                        <div class="h-4 w-px bg-gray-300 dark:bg-gray-600"></div>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300" id="info-read">
                                {{ $notifications->where('is_read', true)->count() }} Dibaca
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Enhanced Notifications List --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
            {{-- Table Header --}}
            <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700/50 dark:to-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg mr-3">
                            <i class="fas fa-list text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Daftar Notifikasi</h3>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <span id="list-count">{{ $notifications->count() }}</span> dari <span id="list-total">{{ $notifications->total() }}</span> notifikasi
                    </div>
                </div>
            </div>

            <div id="notifications-container">
                @forelse($notifications as $notification)
                <div class="notification-item {{ !$notification->is_read ? 'notification-unread' : '' }} group p-5 border-b border-slate-100 dark:border-gray-700 last:border-b-0" data-notification-id="{{ $notification->id }}">
                    <div class="flex items-start gap-3 md:gap-4">
                        
                        {{-- Icon --}}
                        <div class="notification-icon-wrapper flex-shrink-0 w-12 h-12 rounded-xl flex items-center justify-center transition-all duration-300
                            @if($notification->icon === 'success') bg-green-100 dark:bg-green-900/30 group-hover:bg-green-500
                            @elseif($notification->icon === 'error') bg-red-100 dark:bg-red-900/30 group-hover:bg-red-500
                            @elseif($notification->icon === 'warning') bg-yellow-100 dark:bg-yellow-900/30 group-hover:bg-yellow-500
                            @else bg-blue-100 dark:bg-blue-900/30 group-hover:bg-blue-500
                            @endif">
                            @if($notification->icon === 'success')
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            @elseif($notification->icon === 'error')
                                <svg class="w-6 h-6 text-red-600 dark:text-red-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            @elseif($notification->icon === 'warning')
                                <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-1">
                                        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $notification->aksi }}</h3>
                                        @if(!$notification->is_read)
                                        <span class="unread-badge"></span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $notification->detail }}</p>
                                    
                                    <div class="flex flex-wrap items-center gap-3 md:gap-4 mt-3">
                                        <span class="inline-flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $notification->created_at->diffForHumans() }}
                                        </span>
                                        
                                        @if($notification->is_read)
                                        <span class="inline-flex items-center gap-1.5 text-xs text-green-600 dark:text-green-400 font-medium">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Dibaca {{ $notification->read_at->diffForHumans() }}
                                        </span>
                                        @endif
                                    </div>
                                </div>

{{-- Actions --}}
                                <div class="flex items-center gap-1.5 flex-shrink-0">
                                    @if($notification->url)
                                    <a href="{{ $notification->url }}" 
                                       onclick="event.preventDefault(); markAsReadAndRedirect({{ $notification->id }}, '{{ $notification->url }}')"
                                       class="p-2.5 text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 hover:bg-blue-100 dark:hover:bg-blue-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md" 
                                       title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @endif

                                    @if(!$notification->is_read)
                                    <button 
                                        onclick="markAsRead({{ $notification->id }})"
                                        class="p-2.5 text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/30 hover:bg-green-100 dark:hover:bg-green-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md" 
                                        title="Tandai Dibaca">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    @endif

                                    <button 
                                        onclick="deleteNotification({{ $notification->id }})"
                                        class="p-2.5 text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 dark:hover:bg-red-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md"
                                        title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                {{-- Empty State --}}
                <div class="px-6 py-16 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-2xl mb-6">
                        <svg class="w-10 h-10 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Tidak ada notifikasi</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm max-w-sm mx-auto">
                        Anda belum memiliki notifikasi apapun saat ini. Notifikasi akan muncul di sini ketika ada aktivitas baru.
                    </p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Enhanced Modern Pagination --}}
        @if($notifications->hasPages())
        <div class="mt-6 md:mt-8">
            <div class="bg-gradient-to-r from-slate-100 via-blue-50 to-indigo-50 dark:from-gray-700 dark:via-gray-800 dark:to-gray-700 px-6 py-6 border border-slate-200 dark:border-gray-600 rounded-2xl shadow-lg">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                    {{-- Left Info --}}
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-3 px-4 py-2.5 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-slate-200 dark:border-gray-600">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900/50 rounded-lg">
                                <i class="fas fa-info-circle text-blue-600 dark:text-blue-400 text-sm"></i>
                            </div>
                            <div class="text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Menampilkan</span>
                                <span class="font-bold text-gray-900 dark:text-gray-100 mx-1">{{ $notifications->count() }}</span>
                                <span class="text-gray-600 dark:text-gray-400">dari</span>
                                <span class="font-bold text-blue-600 dark:text-blue-400 mx-1">{{ $notifications->total() }}</span>
                                <span class="text-gray-600 dark:text-gray-400">notifikasi</span>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Pagination Controls --}}
                    <div class="flex items-center gap-2">
                        @if ($notifications->onFirstPage())
                            <button disabled class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 rounded-xl cursor-not-allowed border border-gray-200 dark:border-gray-600">
                                <i class="fas fa-chevron-left text-sm"></i>
                            </button>
                        @else
                            <a href="{{ $notifications->previousPageUrl() }}" 
                               class="px-4 py-2.5 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 rounded-xl transition-all border border-slate-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-600 shadow-sm hover:shadow-md">
                                <i class="fas fa-chevron-left text-sm"></i>
                            </a>
                        @endif
                        
                        <div class="hidden sm:flex items-center gap-2">
                            @foreach ($notifications->getUrlRange(1, $notifications->lastPage()) as $page => $url)
                                @if ($page == $notifications->currentPage())
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
                        
                        {{-- Mobile Page Info --}}
                        <div class="sm:hidden px-4 py-2.5 bg-white dark:bg-gray-800 rounded-xl border border-slate-200 dark:border-gray-600 shadow-sm">
                            <span class="text-sm font-bold text-gray-900 dark:text-gray-100">{{ $notifications->currentPage() }}</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400 mx-1">/</span>
                            <span class="text-sm text-gray-600 dark:text-gray-300">{{ $notifications->lastPage() }}</span>
                        </div>
                        
                        @if ($notifications->hasMorePages())
                            <a href="{{ $notifications->nextPageUrl() }}" 
                               class="px-4 py-2.5 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 rounded-xl transition-all border border-slate-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-600 shadow-sm hover:shadow-md">
                                <i class="fas fa-chevron-right text-sm"></i>
                            </a>
                        @else
                            <button disabled class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 rounded-xl cursor-not-allowed border border-gray-200 dark:border-gray-600">
                                <i class="fas fa-chevron-right text-sm"></i>
                            </button>
                        @endif
                    </div>
                    
                    {{-- Right Quick Jump --}}
                    <div class="hidden lg:flex items-center gap-3">
                        <span class="text-sm text-gray-600 dark:text-gray-400 font-medium">Halaman:</span>
                        <div class="relative">
                            <select id="page-select" onchange="window.location.href=this.value" 
                                    class="appearance-none pl-4 pr-10 py-2.5 bg-white dark:bg-gray-800 border-2 border-slate-200 dark:border-gray-600 rounded-xl text-sm font-medium text-gray-700 dark:text-gray-300 hover:border-blue-300 dark:hover:border-blue-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all cursor-pointer">
                                @for ($i = 1; $i <= $notifications->lastPage(); $i++)
                                    <option value="{{ $notifications->url($i) }}" {{ $i == $notifications->currentPage() ? 'selected' : '' }}>
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
                
                {{-- Progress Bar --}}
                <div class="mt-4 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 h-full rounded-full transition-all duration-500 shadow-lg" 
                         style="width: {{ ($notifications->currentPage() / $notifications->lastPage()) * 100 }}%">
                    </div>
                </div>
                
                {{-- Additional Info Footer --}}
                <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500 dark:text-gray-400">
                    <div class="flex items-center gap-4">
                        <span class="flex items-center gap-1.5">
                            <i class="fas fa-file-alt text-blue-500 dark:text-blue-400"></i>
                            Per halaman: <strong class="text-gray-700 dark:text-gray-300">{{ $notifications->count() }}</strong>
                        </span>
                        <span class="hidden sm:inline">•</span>
                        <span class="flex items-center gap-1.5">
                            <i class="fas fa-layer-group text-indigo-500 dark:text-indigo-400"></i>
                            Total halaman: <strong class="text-gray-700 dark:text-gray-300">{{ $notifications->lastPage() }}</strong>
                        </span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        @if ($notifications->currentPage() > 1)
                            <a href="{{ $notifications->url(1) }}" 
                               class="px-3 py-1.5 bg-white dark:bg-gray-800 hover:bg-slate-50 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all text-xs font-medium border border-slate-200 dark:border-gray-600">
                                <i class="fas fa-fast-backward mr-1"></i>
                                Awal
                            </a>
                        @endif
                        
                        @if ($notifications->currentPage() < $notifications->lastPage())
                            <a href="{{ $notifications->url($notifications->lastPage()) }}" 
                               class="px-3 py-1.5 bg-white dark:bg-gray-800 hover:bg-slate-50 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all text-xs font-medium border border-slate-200 dark:border-gray-600">
                                Akhir
                                <i class="fas fa-fast-forward ml-1"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

{{-- Toast Container --}}
<div id="toast-container" class="fixed top-4 right-4 z-50 space-y-3"></div>
@endsection

@push('scripts')
<script>
// ============================================
// Toast Notification System
// ============================================
function showToast(message, type = 'success') {
    const toastContainer = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = 'animate-slide-in-right';
    
    const icons = {
        success: { icon: 'fa-check-circle', color: 'green', title: 'Berhasil!' },
        error: { icon: 'fa-exclamation-circle', color: 'red', title: 'Error!' },
        warning: { icon: 'fa-exclamation-triangle', color: 'yellow', title: 'Peringatan!' },
        info: { icon: 'fa-info-circle', color: 'blue', title: 'Info' }
    };
    
    const config = icons[type] || icons.info;
    
    toast.innerHTML = `
        <div class="bg-white/90 dark:bg-gray-800/90 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 p-4 max-w-sm backdrop-blur-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="p-2 bg-${config.color}-100 dark:bg-${config.color}-900/30 rounded-lg">
                        <i class="fas ${config.icon} text-${config.color}-600 dark:text-${config.color}-400 text-lg"></i>
                    </div>
                </div>
                <div class="ml-3 flex-1">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">${config.title}</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">${message}</p>
                </div>
                <button onclick="this.closest('.animate-slide-in-right').style.animation='slideOutRight 0.5s ease-in forwards'; setTimeout(() => this.closest('.animate-slide-in-right').remove(), 500)" 
                        class="ml-4 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    `;
    
    toastContainer.appendChild(toast);
    
    // Auto hide after 5 seconds
    setTimeout(() => {
        toast.style.animation = 'slideOutRight 0.5s ease-in forwards';
        setTimeout(() => toast.remove(), 500);
    }, 5000);
}

// ============================================
// Mark All Notifications as Read
// ============================================
async function markAllAsRead() {
    const button = document.getElementById('mark-all-btn');
    const btnIcon = document.getElementById('btn-icon');
    const btnText = document.getElementById('btn-text');
    
    // Konfirmasi
    if (!confirm('Tandai semua notifikasi sebagai dibaca?')) {
        return;
    }
    
    // Disable button dan tampilkan loading
    button.disabled = true;
    btnIcon.className = 'spinner mr-2.5 relative';
    btnText.textContent = 'Memproses...';
    
    try {
        const response = await fetch('{{ route('notifications.mark-all-read') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            showToast('Semua notifikasi telah ditandai sebagai dibaca', 'success');
            
            // Reload halaman setelah 1 detik
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            throw new Error('Gagal menandai notifikasi');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('Terjadi kesalahan. Silakan coba lagi.', 'error');
        
        // Reset button
        button.disabled = false;
        btnIcon.className = 'fas fa-check-double mr-2.5 group-hover:scale-110 transition-transform duration-300 relative';
        btnText.textContent = 'Tandai Semua Dibaca';
    }
}

// ============================================
// Mark Single Notification as Read
// ============================================
async function markAsRead(notificationId) {
    const notificationItem = document.querySelector(`[data-notification-id="${notificationId}"]`);
    
    try {
        const response = await fetch(`/notifications/${notificationId}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            showToast('Notifikasi ditandai sebagai dibaca', 'success');
            
            // Update UI
            if (notificationItem) {
                notificationItem.classList.remove('notification-unread');
                const badge = notificationItem.querySelector('.unread-badge');
                if (badge) badge.remove();
                
                const button = notificationItem.querySelector('button[onclick*="markAsRead"]');
                if (button) button.remove();
            }
            
            // Update counters
            updateCounters();
        } else {
            throw new Error('Gagal menandai notifikasi');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('Terjadi kesalahan. Silakan coba lagi.', 'error');
    }
}

// ============================================
// Mark as Read and Redirect
// ============================================
function markAsReadAndRedirect(notificationId, url) {
    fetch(`/notifications/${notificationId}/read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    }).then(() => {
        window.location.href = url;
    }).catch(error => {
        console.error('Error:', error);
        window.location.href = url;
    });
}

// ============================================
// Delete Notification
// ============================================
async function deleteNotification(notificationId) {
    if (!confirm('Hapus notifikasi ini?')) {
        return;
    }
    
    const notificationItem = document.querySelector(`[data-notification-id="${notificationId}"]`);
    
    try {
        const response = await fetch(`/notifications/${notificationId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            showToast('Notifikasi berhasil dihapus', 'success');
            
            // Animasi fade out dan hapus element
            if (notificationItem) {
                notificationItem.style.transition = 'opacity 0.3s, transform 0.3s';
                notificationItem.style.opacity = '0';
                notificationItem.style.transform = 'translateX(100%)';
                
                setTimeout(() => {
                    notificationItem.remove();
                    
                    // Cek jika tidak ada notifikasi
                    const container = document.getElementById('notifications-container');
                    if (container && container.children.length === 0) {
                        container.innerHTML = `
                            <div class="px-6 py-16 text-center">
                                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-2xl mb-6">
                                    <svg class="w-10 h-10 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Tidak ada notifikasi</h3>
                                <p class="text-gray-500 dark:text-gray-400 text-sm max-w-sm mx-auto">
                                    Anda belum memiliki notifikasi apapun saat ini. Notifikasi akan muncul di sini ketika ada aktivitas baru.
                                </p>
                            </div>
                        `;
                    }
                    
                    // Update counters
                    updateCounters();
                }, 300);
            }
        } else {
            throw new Error('Gagal menghapus notifikasi');
        }
    } catch (error) {
        console.error('Error:', error);
        showToast('Terjadi kesalahan. Silakan coba lagi.', 'error');
    }
}

// ============================================
// Update Counters (Stats)
// ============================================
function updateCounters() {
    const unreadItems = document.querySelectorAll('.notification-unread').length;
    const totalItems = document.querySelectorAll('.notification-item').length;
    const readItems = totalItems - unreadItems;
    
    // Update header stats
    const unreadCount = document.getElementById('unread-count');
    if (unreadCount) unreadCount.textContent = unreadItems;
    
    // Update stats cards
    const statUnread = document.getElementById('stat-unread');
    const statRead = document.getElementById('stat-read');
    
    if (statUnread) statUnread.textContent = unreadItems;
    if (statRead) statRead.textContent = readItems;
    
    // Update info bar
    const infoUnread = document.getElementById('info-unread');
    const infoRead = document.getElementById('info-read');
    
    if (infoUnread) infoUnread.textContent = `${unreadItems} Perlu Dibaca`;
    if (infoRead) infoRead.textContent = `${readItems} Dibaca`;
    
    // Update list count
    const listCount = document.getElementById('list-count');
    if (listCount) listCount.textContent = totalItems;
}

// ============================================
// Show Session Messages
// ============================================
@if(session('success'))
    showToast('{{ session('success') }}', 'success');
@endif

@if(session('error'))
    showToast('{{ session('error') }}', 'error');
@endif

// ============================================
// Initialize on Page Load
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    console.log('Notification page loaded successfully');
});
</script>
@endpush