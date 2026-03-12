@extends('layouts.app')

@section('title', 'Kelola User - Super Admin')

@push('styles')
<style>
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

/* Dark mode transitions */
* {
    transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
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
}

.table-row:hover {
    background: linear-gradient(90deg, rgba(59, 130, 246, 0.05), rgba(59, 130, 246, 0.02));
    transform: translateX(2px);
}

.dark .table-row:hover {
    background: linear-gradient(90deg, rgba(59, 130, 246, 0.1), rgba(59, 130, 246, 0.05));
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

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
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

.badge-user { background-color: #dbeafe; color: #1e40af; }
.badge-admin { background-color: #fef3c7; color: #92400e; }
.badge-super-admin { background-color: #fce7f3; color: #9f1239; }
.badge-pengurus-aset { background-color: #dcfce7; color: #166534; }

.avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e5e7eb;
}

.dark .avatar-circle {
    border-color: #374151;
}

.avatar-placeholder {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    font-weight: 600;
    font-size: 14px;
    border: 2px solid #e5e7eb;
}

.dark .avatar-placeholder {
    border-color: #374151;
}

/* TABLE NO SCROLL - FIXED WIDTH */
.table-container {
    overflow: hidden;
}

.responsive-table {
    table-layout: fixed;
    width: 100%;
}

/* Atur lebar kolom */
.responsive-table th:nth-child(1),
.responsive-table td:nth-child(1) {
    width: 28%;
}

.responsive-table th:nth-child(2),
.responsive-table td:nth-child(2) {
    width: 24%;
}

.responsive-table th:nth-child(3),
.responsive-table td:nth-child(3) {
    width: 18%;
}

.responsive-table th:nth-child(4),
.responsive-table td:nth-child(4) {
    width: 15%;
}

.responsive-table th:nth-child(5),
.responsive-table td:nth-child(5) {
    width: 15%;
}

/* Prevent overflow */
.responsive-table td {
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Allow wrapping for nama/email dan jabatan/instansi */
.responsive-table td:nth-child(1),
.responsive-table td:nth-child(2) {
    white-space: normal;
    word-wrap: break-word;
    hyphens: auto;
}

/* Single line untuk kontak dan role */
.responsive-table td:nth-child(3),
.responsive-table td:nth-child(4) {
    white-space: nowrap;
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
            <a href="{{ route('dashboard') }}" class="breadcrumb-link">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <i class="fas fa-chevron-right text-black dark:text-white text-xs"></i>               
            <span class="breadcrumb-current">
                <i class="fas fa-users"></i>
                <span>Kelola User</span>
            </span>
        </nav>

        {{-- Modern Header Section with Enhanced Design --}}
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
                                <span class="text-sm font-semibold text-blue-700 dark:text-blue-300">User Management</span>
                            </div>
                            
                            {{-- Main Title --}}
                            <h1 class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-blue-800 to-indigo-800 dark:from-slate-100 dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent leading-tight">
                                Kelola User
                            </h1>
                            
                            {{-- Description --}}
                            <p class="text-slate-600 dark:text-slate-400 text-lg flex items-center space-x-2">
                                <i class="fas fa-info-circle text-blue-500 dark:text-blue-400"></i>
                                <span>Manajemen pengguna sistem dan hak akses</span>
                            </p>
                            
                            {{-- Quick Stats --}}
                            <div class="flex flex-wrap items-center gap-4 mt-6">
                                <div class="flex items-center space-x-2 px-4 py-2 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm rounded-lg border border-slate-200/50 dark:border-gray-600/50 shadow-sm">
                                    <div class="p-1.5 bg-blue-100 dark:bg-blue-900/50 rounded-md">
                                        <i class="fas fa-users text-blue-600 dark:text-blue-400 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Total User</p>
                                        <p class="text-lg font-bold text-slate-800 dark:text-slate-200">{{ $users->total() }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-2 px-4 py-2 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm rounded-lg border border-purple-200/50 dark:border-purple-800/50 shadow-sm">
                                    <div class="p-1.5 bg-purple-100 dark:bg-purple-900/50 rounded-md">
                                        <i class="fas fa-user-shield text-purple-600 dark:text-purple-400 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Admin Active</p>
                                        <p class="text-lg font-bold text-slate-800 dark:text-slate-200">{{ $stats['admin'] + $stats['super_admin'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Right Section: Action Button --}}
                        <div class="flex flex-col sm:flex-row lg:flex-col gap-3">
                            <a href="{{ route('admin.users.create') }}" 
                               class="group relative inline-flex items-center justify-center px-6 py-3.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
                                <i class="fas fa-user-plus mr-2.5 group-hover:scale-110 transition-transform duration-300"></i>
                                <span class="relative">Tambah User</span>
                            </a>
                        </div>
                    </div>
                </div>
                
                {{-- Bottom Accent Line --}}
                <div class="h-1.5 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>
            </div>
        </div>

        {{-- Modern Stats Cards Section --}}
        <div class="mb-8 animate-professional-reveal delay-200">
            {{-- Header Stats Section --}}
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                        <i class="fas fa-chart-pie text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Statistik User</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Overview distribusi role pengguna</p>
                    </div>
                </div>
                
                {{-- Last Update Badge --}}
                <div class="hidden md:flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-lg border border-gray-200 dark:border-gray-600">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span class="text-xs text-gray-600 dark:text-gray-300 font-medium">Live Update</span>
                </div>
            </div>
            
            {{-- Stats Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 lg:gap-5">
                
                {{-- Total User --}}
                <div class="group relative overflow-hidden bg-gradient-to-br from-purple-500 via-purple-600 to-indigo-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
                    
                    <div class="relative p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-users text-white text-2xl"></i>
                            </div>
                            <div class="flex items-center gap-1 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full">
                                <i class="fas fa-check text-white text-xs"></i>
                                <span class="text-white text-xs font-bold">All</span>
                            </div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-purple-100 text-sm font-medium">Total User</p>
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-4xl font-black text-white">{{ $stats['total'] ?? 0 }}</h3>
                                <span class="text-purple-100 text-sm">users</span>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                            <span class="text-purple-100 text-xs font-medium">Semua pengguna</span>
                            <i class="fas fa-users text-purple-100 text-sm"></i>
                        </div>
                    </div>
                </div>

                {{-- User Biasa --}}
                <div class="group relative overflow-hidden bg-gradient-to-br from-blue-500 via-blue-600 to-cyan-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
                    
                    <div class="relative p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-user text-white text-2xl"></i>
                            </div>
                            <div class="w-2 h-2 bg-blue-200 rounded-full"></div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-blue-100 text-sm font-medium">User</p>
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-4xl font-black text-white">{{ $stats['user'] ?? 0 }}</h3>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                            <span class="text-blue-100 text-xs font-medium">Pengguna biasa</span>
                            <div class="w-2 h-2 bg-blue-200 rounded-full"></div>
                        </div>
                    </div>
                </div>

                {{-- Admin --}}
                <div class="group relative overflow-hidden bg-gradient-to-br from-amber-500 via-amber-600 to-orange-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
                    
                    <div class="relative p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-user-shield text-white text-2xl"></i>
                            </div>
                            <div class="w-2 h-2 bg-yellow-200 rounded-full"></div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-amber-100 text-sm font-medium">Admin</p>
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-4xl font-black text-white">{{ $stats['admin'] ?? 0 }}</h3>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                            <span class="text-amber-100 text-xs font-medium">Administrator</span>
                            <div class="w-2 h-2 bg-yellow-200 rounded-full"></div>
                        </div>
                    </div>
                </div>

                {{-- Super Admin --}}
                <div class="group relative overflow-hidden bg-gradient-to-br from-pink-500 via-pink-600 to-rose-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
                    
                    <div class="relative p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-crown text-white text-2xl"></i>
                            </div>
                            <div class="w-2 h-2 bg-pink-200 rounded-full animate-pulse"></div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-pink-100 text-sm font-medium">Super Admin</p>
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-4xl font-black text-white">{{ $stats['super_admin'] ?? 0 }}</h3>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                            <span class="text-pink-100 text-xs font-medium">Full access</span>
                            <div class="w-2 h-2 bg-pink-200 rounded-full animate-pulse"></div>
                        </div>
                    </div>
                </div>

                {{-- Pengurus Aset --}}
                <div class="group relative overflow-hidden bg-gradient-to-br from-emerald-500 via-emerald-600 to-green-600 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full -ml-12 -mb-12"></div>
                    
                    <div class="relative p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <i class="fas fa-boxes text-white text-2xl"></i>
                            </div>
                            <div class="w-2 h-2 bg-green-200 rounded-full"></div>
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-emerald-100 text-sm font-medium">Pengurus Aset</p>
                            <div class="flex items-baseline gap-2">
                                <h3 class="text-4xl font-black text-white">{{ $stats['pengurus_aset'] ?? 0 }}</h3>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                            <span class="text-emerald-100 text-xs font-medium">Asset manager</span>
                            <div class="w-2 h-2 bg-green-200 rounded-full"></div>
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
                            <p class="text-xs text-gray-600 dark:text-gray-400">Data diperbarui setiap kali ada perubahan pada user</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300">
                                {{ $stats['user'] ?? 0 }} User Biasa
                            </span>
                        </div>
                        <div class="h-4 w-px bg-gray-300 dark:bg-gray-600"></div>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 bg-pink-500 rounded-full"></div>
                            <span class="text-xs font-medium text-gray-700 dark:text-gray-300">
                                {{ $stats['super_admin'] ?? 0 }} Super Admin
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modern Filter Section --}}
        <div class="mb-8 animate-elegant-slide delay-300">
            <div class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700">
                {{-- Decorative Background --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-400/5 to-indigo-400/5 dark:from-blue-600/10 dark:to-indigo-600/10 rounded-full -mr-32 -mt-32"></div>
                
                <div class="relative p-6 lg:p-8">
                    {{-- Header --}}
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                            <i class="fas fa-filter text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Filter & Pencarian</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Filter data user sesuai kebutuhan</p>
                        </div>
                    </div>
                    
                    <form method="GET" action="{{ route('admin.users.index') }}">
                        {{-- Filter Inputs Grid --}}
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-6">
                            {{-- Search Input --}}
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-search text-blue-500 dark:text-blue-400"></i>
                                    Pencarian
                                </label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400 dark:text-gray-500 group-focus-within:text-blue-500 dark:group-focus-within:text-blue-400 transition-colors"></i>
                                    </div>
                                    <input type="text" 
                                        name="search"
                                        value="{{ request('search') }}"
                                        placeholder="Cari nama, email, jabatan..." 
                                        class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 focus:border-blue-500 dark:focus:border-blue-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-sm text-gray-900 dark:text-gray-100 placeholder:text-gray-400 dark:placeholder:text-gray-500">
                                </div>
                            </div>

                            {{-- Role Filter --}}
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-user-tag text-purple-500 dark:text-purple-400"></i>
                                    Role
                                </label>
                                <div class="relative">
                                    <select name="role" class="block w-full px-4 py-3.5 pr-10 bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 focus:border-blue-500 dark:focus:border-blue-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-sm text-gray-900 dark:text-gray-100 appearance-none cursor-pointer">
                                        <option value="">Semua Role</option>
                                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>👤 User</option>
                                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>🛡️ Admin</option>
                                        <option value="super_admin" {{ request('role') == 'super_admin' ? 'selected' : '' }}>👑 Super Admin</option>
                                        <option value="pengurus_aset" {{ request('role') == 'pengurus_aset' ? 'selected' : '' }}>📦 Pengurus Aset</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Sort Filter --}}
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-sort text-indigo-500 dark:text-indigo-400"></i>
                                    Urutkan
                                </label>
                                <div class="relative">
                                    <select name="sort" class="block w-full px-4 py-3.5 pr-10 bg-gray-50 dark:bg-gray-700 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 focus:border-blue-500 dark:focus:border-blue-400 focus:bg-white dark:focus:bg-gray-600 transition-all text-sm text-gray-900 dark:text-gray-100 appearance-none cursor-pointer">
                                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>📝 Nama</option>
                                        <option value="email" {{ request('sort') == 'email' ? 'selected' : '' }}>📧 Email</option>
                                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>📅 Tanggal Dibuat</option>
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
                                <button type="submit" class="group relative inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                                    <i class="fas fa-search mr-2 group-hover:scale-110 transition-transform"></i>
                                    Filter Data
                                </button>
                                <a href="{{ route('admin.users.index') }}" 
                                class="group inline-flex items-center px-6 py-3 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-xl transition-all duration-300">
                                    <i class="fas fa-redo mr-2 group-hover:rotate-180 transition-transform duration-500"></i>
                                    Reset
                                </a>
                            </div>
                            
                            <div class="flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                                <i class="fas fa-database text-blue-600 dark:text-blue-400"></i>
                                <span class="text-sm text-gray-700 dark:text-gray-300">Total:</span>
                                <span class="font-bold text-gray-900 dark:text-gray-100">{{ $users->total() }}</span>
                                <span class="text-sm text-gray-600 dark:text-gray-400">User</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modern Data Table --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden animate-professional-reveal delay-400">
            {{-- Table Header --}}
            <div class="relative px-6 lg:px-8 py-6 bg-gradient-to-r from-gray-50 via-blue-50/30 to-indigo-50/30 dark:from-gray-700/50 dark:via-gray-800/50 dark:to-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                {{-- Decorative Elements --}}
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-400/10 to-indigo-400/10 dark:from-blue-600/10 dark:to-indigo-600/10 rounded-full -mr-16 -mt-16"></div>
                
                <div class="relative flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg">
                            <i class="fas fa-list text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Daftar User</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Kelola semua pengguna sistem</p>
                        </div>
                    </div>
                    <div class="hidden sm:flex items-center gap-2 px-4 py-2 bg-white/80 dark:bg-gray-700/80 backdrop-blur-sm rounded-lg border border-gray-200 dark:border-gray-600 shadow-sm">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Menampilkan</span>
                        <span class="font-bold text-gray-900 dark:text-gray-100">{{ $users->count() }}</span>
                        <span class="text-sm text-gray-600 dark:text-gray-400">dari</span>
                        <span class="font-bold text-gray-900 dark:text-gray-100">{{ $users->total() }}</span>
                    </div>
                </div>
            </div>

            @if($users->count() > 0)
            {{-- Desktop Table --}}
            <div class="hidden lg:block table-container">
                <table class="responsive-table divide-y divide-slate-200 dark:divide-gray-700">
                    <thead class="bg-gradient-to-r from-slate-200 via-blue-100 to-indigo-100 dark:from-gray-700 dark:via-gray-700/80 dark:to-gray-700">
                        <tr>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-user text-blue-500 dark:text-blue-400"></i>
                                    Nama & Email
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-briefcase text-purple-500 dark:text-purple-400"></i>
                                    Jabatan & Instansi
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-phone text-green-500 dark:text-green-400"></i>
                                    Kontak
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <div class="flex items-center gap-2 text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                    <i class="fas fa-user-tag text-amber-500 dark:text-amber-400"></i>
                                    Role
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
                        @foreach($users as $user)
                        <tr class="table-row">
                            <td class="px-6 py-5">
                                <div class="flex items-center">
                                    @if($user->avatar && Storage::disk('public')->exists($user->avatar))
                                        <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="avatar-circle mr-4">
                                    @else
                                        <div class="avatar-placeholder mr-4">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user->jabatan ?? '-' }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $user->instansi ?? '-' }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-sm text-gray-900 dark:text-gray-100">{{ $user->no_telp ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-5">
                                @if($user->role == 'user')
                                    <span class="badge badge-user">
                                        <i class="fas fa-user"></i>
                                        User
                                    </span>
                                @elseif($user->role == 'admin')
                                    <span class="badge badge-admin">
                                        <i class="fas fa-user-shield"></i>
                                        Admin
                                    </span>
                                @elseif($user->role == 'super_admin')
                                    <span class="badge badge-super-admin">
                                        <i class="fas fa-crown"></i>
                                        Super Admin
                                    </span>
                                @elseif($user->role == 'pengurus_aset')
                                    <span class="badge badge-pengurus-aset">
                                        <i class="fas fa-box"></i>
                                        Pengurus Aset
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.users.show', $user->id) }}" 
                                    class="p-2.5 text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/30 hover:bg-blue-100 dark:hover:bg-blue-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md" 
                                    title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" 
                                    class="p-2.5 text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/30 hover:bg-green-100 dark:hover:bg-green-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md" 
                                    title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($user->id != Auth::id())
                                    <button onclick="deleteModal('{{ $user->id }}', '{{ $user->name }}')"
                                            class="p-2.5 text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 dark:hover:bg-red-900/50 rounded-xl transition-all transform hover:scale-110 shadow-sm hover:shadow-md" 
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Mobile Cards --}}
            <div class="lg:hidden divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($users as $user)
                <div class="p-4 card-hover">
                    <div class="bg-gradient-to-r from-gray-50 to-white dark:from-gray-700/50 dark:to-gray-800/50 rounded-lg p-4 border border-gray-100 dark:border-gray-600">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center">
                                @if($user->avatar && Storage::disk('public')->exists($user->avatar))
                                    <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="avatar-circle mr-3">
                                @else
                                    <div class="avatar-placeholder mr-3">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $user->email }}</div>
                                </div>
                            </div>
                            <div>
                                @if($user->role == 'user')
                                    <span class="badge badge-user">
                                        <i class="fas fa-user"></i>
                                        User
                                    </span>
                                @elseif($user->role == 'admin')
                                    <span class="badge badge-admin">
                                        <i class="fas fa-user-shield"></i>
                                        Admin
                                    </span>
                                @elseif($user->role == 'super_admin')
                                    <span class="badge badge-super-admin">
                                        <i class="fas fa-crown"></i>
                                        Super Admin
                                    </span>
                                @elseif($user->role == 'pengurus_aset')
                                    <span class="badge badge-pengurus-aset">
                                        <i class="fas fa-box"></i>
                                        Pengurus Aset
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-2 mb-4">
                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                <span class="font-medium">Jabatan:</span> {{ $user->jabatan ?? '-' }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                <span class="font-medium">Instansi:</span> {{ $user->instansi ?? '-' }}
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                <span class="font-medium">No. Telp:</span> {{ $user->no_telp ?? '-' }}
                            </div>
                        </div>

                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('admin.users.show', $user->id) }}" 
                            class="inline-flex items-center px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs font-medium rounded-lg hover:bg-blue-200 dark:hover:bg-blue-900/50 transition-all">
                                <i class="fas fa-eye mr-1"></i>
                                Detail
                            </a>
                            <a href="{{ route('admin.users.edit', $user->id) }}" 
                            class="inline-flex items-center px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-medium rounded-lg hover:bg-green-200 dark:hover:bg-green-900/50 transition-all">
                                <i class="fas fa-edit mr-1"></i>
                                Edit
                            </a>
                            @if($user->id != Auth::id())
                            <button onclick="deleteModal('{{ $user->id }}', '{{ $user->name }}')"
                                    class="inline-flex items-center px-3 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-xs font-medium rounded-lg hover:bg-red-200 dark:hover:bg-red-900/50 transition-all">
                                <i class="fas fa-trash mr-1"></i>
                                Hapus
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Enhanced Modern Pagination --}}
            <div class="bg-gradient-to-r from-slate-100 via-blue-50 to-indigo-50 dark:from-gray-700 dark:via-gray-800 dark:to-gray-700 px-6 py-6 border-t border-slate-200 dark:border-gray-600">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                    {{-- Left Info --}}
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-3 px-4 py-2.5 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-slate-200 dark:border-gray-600">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900/50 rounded-lg">
                                <i class="fas fa-info-circle text-blue-600 dark:text-blue-400 text-sm"></i>
                            </div>
                            <div class="text-sm">
                                <span class="text-gray-600 dark:text-gray-400">Menampilkan</span>
                                <span class="font-bold text-gray-900 dark:text-gray-100 mx-1">{{ $users->firstItem() ?? 0 }}-{{ $users->lastItem() ?? 0 }}</span>
                                <span class="text-gray-600 dark:text-gray-400">dari</span>
                                <span class="font-bold text-blue-600 dark:text-blue-400 mx-1">{{ $users->total() }}</span>
                                <span class="text-gray-600 dark:text-gray-400">data</span>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Pagination Controls --}}
                    <div class="flex items-center gap-2">
                        @if ($users->onFirstPage())
                            <button disabled class="px-4 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500 rounded-xl cursor-not-allowed border border-gray-200 dark:border-gray-600">
                                <i class="fas fa-chevron-left text-sm"></i>
                            </button>
                        @else
                            <a href="{{ $users->previousPageUrl() }}" 
                               class="px-4 py-2.5 bg-white dark:bg-gray-800 hover:bg-blue-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 rounded-xl transition-all border border-slate-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-600 shadow-sm hover:shadow-md">
                                <i class="fas fa-chevron-left text-sm"></i>
                            </a>
                        @endif
                        
                        <div class="hidden sm:flex items-center gap-2">
                            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                @if ($page == $users->currentPage())
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
                            <span class="text-sm font-bold text-gray-900 dark:text-gray-100">{{ $users->currentPage() }}</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400 mx-1">/</span>
                            <span class="text-sm text-gray-600 dark:text-gray-300">{{ $users->lastPage() }}</span>
                        </div>
                        
                        @if ($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}" 
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
                                @for ($i = 1; $i <= $users->lastPage(); $i++)
                                    <option value="{{ $users->url($i) }}" {{ $i == $users->currentPage() ? 'selected' : '' }}>
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
                
                {{-- Progress Bar --}}
                <div class="mt-4 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 h-full rounded-full transition-all duration-500 shadow-lg" 
                         style="width: {{ ($users->currentPage() / $users->lastPage()) * 100 }}%">
                    </div>
                </div>
                
                {{-- Additional Info Footer --}}
                <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500 dark:text-gray-400">
                    <div class="flex items-center gap-4">
                        <span class="flex items-center gap-1.5">
                            <i class="fas fa-file-alt text-blue-500 dark:text-blue-400"></i>
                            Per halaman: <strong class="text-gray-700 dark:text-gray-300">{{ $users->count() }}</strong>
                        </span>
                        <span class="hidden sm:inline">•</span>
                        <span class="flex items-center gap-1.5">
                            <i class="fas fa-layer-group text-indigo-500 dark:text-indigo-400"></i>
                            Total halaman: <strong class="text-gray-700 dark:text-gray-300">{{ $users->lastPage() }}</strong>
                        </span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        @if ($users->currentPage() > 1)
                            <a href="{{ $users->url(1) }}" 
                               class="px-3 py-1.5 bg-white dark:bg-gray-800 hover:bg-slate-50 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all text-xs font-medium border border-slate-200 dark:border-gray-600">
                                <i class="fas fa-fast-backward mr-1"></i>
                                Awal
                            </a>
                        @endif
                        
                        @if ($users->currentPage() < $users->lastPage())
                            <a href="{{ $users->url($users->lastPage()) }}" 
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
                        <i class="fas fa-user-slash text-4xl text-blue-500 dark:text-blue-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Tidak ada data user</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">
                        @if(request()->hasAny(['search', 'role']))
                            Tidak ditemukan user yang sesuai dengan filter yang diterapkan.
                        @else
                            Belum ada user yang terdaftar dalam sistem.
                        @endif
                    </p>
                    @if(request()->hasAny(['search', 'role']))
                        <a href="{{ route('admin.users.index') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                            <i class="fas fa-redo mr-2"></i>
                            Reset Filter
                        </a>
                    @else
                        <a href="{{ route('admin.users.create') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                            <i class="fas fa-user-plus mr-2"></i>
                            Tambah User Pertama
                        </a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Delete Modal --}}
    <div id="delete-modal" class="fixed inset-0 modal-backdrop overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border-0 w-11/12 max-w-md shadow-2xl rounded-xl bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-lg mr-3">
                            <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Hapus User</h3>
                    </div>
                    <button onclick="closeModal('delete-modal')" class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="delete-form" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800">
                        <p class="text-sm text-red-800 dark:text-red-300 mb-1 font-medium">User yang akan dihapus:</p>
                        <p id="delete-user-name" class="font-semibold text-red-900 dark:text-red-200"></p>
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
                            Hapus User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Enhanced Notifications --}}
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

function deleteModal(id, userName) {
    document.getElementById('delete-user-name').textContent = userName;
    document.getElementById('delete-form').action = "{{ url('admin/users') }}/" + id;
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

// ============================================
// EVENT LISTENERS
// ============================================

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

// ============================================
// FORM VALIDATIONS
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    const deleteForm = document.getElementById('delete-form');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            const userName = document.getElementById('delete-user-name').textContent;
            
            if (!userName || userName.trim() === '') {
                e.preventDefault();
                alert('❌ Error: Data user tidak valid');
                return false;
            }
            
            const confirmed = confirm(`⚠️ KONFIRMASI PENGHAPUSAN\n\nApakah Anda yakin ingin menghapus user:\n"${userName}"\n\nTindakan ini tidak dapat dibatalkan!`);
            
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
    logActivity('page_load', 'User management page loaded');
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