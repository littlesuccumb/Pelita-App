<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Pelita App - Sistem Peminjaman Aset')</title>
    
    <!-- Favicon - Logo untuk tab browser -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo ctp.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo ctp.png') }}">
    
    <!-- Favicon untuk berbagai device dan resolusi -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo ctp.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo ctp.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/logo ctp.png') }}">
    
    <!-- Apple Touch Icon untuk iOS -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo ctp.png') }}">
    
    <!-- Android Chrome Icons -->
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/logo ctp.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('images/logo ctp.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- AOS Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    
    <!-- CountUp.js -->
    <script src="https://cdn.jsdelivr.net/npm/countup.js@2.0.7/dist/countUp.min.js"></script>

    <!-- Professional Animation CSS -->
    <style>
/* Professional animation variables */
:root {
    --transition-professional: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    --transition-subtle: all 0.2s ease-out;
    --transition-smooth: all 0.3s ease-in-out;
}

/* Smooth scroll behavior */
html {
    scroll-behavior: smooth;
}

/* Professional backdrop blur */
.backdrop-blur-enhanced {
    backdrop-filter: blur(12px) saturate(180%);
    -webkit-backdrop-filter: blur(12px) saturate(180%);
    background: rgba(255, 255, 255, 0.95);
}

/* Clean navigation links - NO BACKGROUND BOXES */
.nav-link-clean {
    position: relative;
    transition: var(--transition-professional);
    color: #374151;
    font-weight: 500;
    padding: 8px 12px;
    display: flex;
    align-items: center;
    text-decoration: none;
}

/* Underline effect for nav links */
.nav-link-clean::before {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #3B82F6, #6366F1);
    transform: translateX(-50%);
    transition: width 0.3s ease-out;
}

.nav-link-clean:hover::before {
    width: 80%;
}

.nav-link-clean:hover {
    color: #3B82F6;
    transform: translateY(-1px);
}

.nav-link-clean svg {
    transition: var(--transition-professional);
}

.nav-link-clean:hover svg {
    transform: scale(1.1);
}

/* Professional logo hover */
.logo-professional {
    transition: var(--transition-professional);
    transform-origin: center;
}

.logo-professional:hover {
    transform: scale(1.02);
}

.logo-professional:hover .logo-container {
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
}

/* Professional mobile menu */
.mobile-nav-item {
    transition: var(--transition-professional);
    transform: translateX(-10px);
    opacity: 0;
    display: flex;
    align-items: center;
    padding: 12px 16px;
    color: #374151;
    text-decoration: none;
    border-radius: 8px;
    position: relative;
}

.mobile-nav-item.animate-in {
    transform: translateX(0);
    opacity: 1;
}

.mobile-nav-item:hover {
    transform: translateX(4px);
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(99, 102, 241, 0.05));
    color: #3B82F6;
}

/* Professional footer links */
.footer-link:hover {
    color: white;
    text-shadow: 0 0 8px rgba(96, 165, 250, 0.6);
    transform: translateY(-1px);
}

/* Refined social media icons */
.social-icon {
    transition: var(--transition-professional);
    position: relative;
    overflow: hidden;
}

.social-icon:hover {
    transform: translateY(-2px);
    background: rgba(255, 255, 255, 0.25);
}

.social-icon::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.3s ease, height 0.3s ease;
}

.social-icon:hover::before {
    width: 100%;
    height: 100%;
}

/* Professional pulse effect for logo accent */
.logo-accent {
    animation: pulse-subtle 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse-subtle {
    0%, 100% {
        opacity: 0;
        transform: scale(1);
    }
    50% {
        opacity: 1;
        transform: scale(1.05);
    }
}

/* Subtle glow effects */
.glow-subtle {
    box-shadow: 0 0 20px rgba(59, 130, 246, 0.1);
    transition: box-shadow 0.3s ease;
}

.glow-subtle:hover {
    box-shadow: 0 0 30px rgba(59, 130, 246, 0.2);
}

/* Performance optimizations */
.will-change-transform {
    will-change: transform;
}

.gpu-accelerated {
    transform: translateZ(0);
    backface-visibility: hidden;
}

/* Active Navigation Link */
.nav-link-clean.active {
    color: #3B82F6;
}

.nav-link-clean.active::before {
    width: 80%;
    background: linear-gradient(90deg, #3B82F6, #6366F1);
}

/* Active Mobile Navigation */
.mobile-nav-item.active {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(99, 102, 241, 0.15));
    color: #3B82F6;
    font-weight: 600;
}

.mobile-nav-item.active::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    background: linear-gradient(180deg, #3B82F6, #6366F1);
    border-radius: 0 4px 4px 0;
}

/* ========================================
   MOBILE OPTIMIZATIONS - NAVBAR
   ======================================== */

/* Mobile Menu Button */
.mobile-menu-button {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem;
    border-radius: 0.5rem;
    color: #374151;
    transition: var(--transition-professional);
    background: transparent;
}

.mobile-menu-button:hover {
    background: rgba(59, 130, 246, 0.1);
    color: #3B82F6;
}

.mobile-menu-button:active {
    transform: scale(0.95);
}

/* Mobile Menu Positioning - CRITICAL FIX */
@media (max-width: 768px) {
    /* Navbar height adjustment */
    nav .h-20 {
        height: 64px;
    }
    
    /* Mobile menu positioning */
    nav > div > div > div[x-data] > div[x-show] {
        position: absolute !important;
        left: 0;
        right: 0;
        top: 100%;
        margin-top: 0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    /* Mobile Navigation Items - Touch Friendly */
    .mobile-nav-item {
        min-height: 56px;
        font-size: 0.9375rem;
        margin-bottom: 0.5rem;
        border-radius: 12px;
        padding: 16px;
        display: flex;
        align-items: center;
        position: relative;
    }
    
    .mobile-nav-item svg {
        width: 22px;
        height: 22px;
        flex-shrink: 0;
    }
    
    /* Enhanced active state for mobile */
    .mobile-nav-item.active {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.15), rgba(99, 102, 241, 0.15));
        color: #3B82F6;
        font-weight: 600;
    }
    
    .mobile-nav-item.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(180deg, #3B82F6, #6366F1);
        border-radius: 0 4px 4px 0;
    }
    
    /* Smooth scrolling for mobile menu */
    .mobile-nav-item {
        scroll-margin-top: 100px;
    }
}

/* Mobile Logo Size - More Compact */
@media (max-width: 640px) {
    .logo-professional .logo-container {
        width: 40px;
        height: 40px;
        padding: 0.5rem;
    }
    
    .logo-professional .text-xl,
    .logo-professional .text-lg {
        font-size: 1rem;
        line-height: 1.25;
    }
    
    .logo-professional .text-xs,
    .logo-professional .text-\[0\.65rem\] {
        font-size: 0.625rem;
        line-height: 1;
    }
    
    .logo-accent {
        width: 12px;
        height: 12px;
        top: -3px;
        right: -3px;
    }
    
    .logo-professional {
        gap: 0.5rem;
    }
}

/* Prevent body scroll when menu is open */
@media (max-width: 768px) {
    body.menu-open {
        overflow: hidden;
    }
}

/* ========================================
   MOBILE OPTIMIZATIONS - FOOTER
   ======================================== */

/* Mobile Footer Optimization */
@media (max-width: 768px) {
    footer .grid-cols-1 {
        gap: 2.5rem;
    }
    
    footer .py-16 {
        padding-top: 2.5rem;
        padding-bottom: 2.5rem;
    }
    
    footer .social-icon {
        width: 44px;
        height: 44px;
    }
    
    footer h3 {
        font-size: 1rem;
        margin-bottom: 1rem;
    }
}

/* ========================================
   GENERAL MOBILE IMPROVEMENTS
   ======================================== */

/* Improve mobile text readability */
@media (max-width: 640px) {
    body {
        font-size: 15px;
    }
    
    .nav-link-clean {
        font-size: 0.875rem;
    }
}

/* Mobile spacing improvements */
@media (max-width: 640px) {
    .max-w-7xl {
        padding-left: 1rem;
        padding-right: 1rem;
    }
}

/* ========================================
   ACCESSIBILITY - REDUCED MOTION
   ======================================== */

@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
    
    html {
        scroll-behavior: auto;
    }
}
    </style>

    @stack('styles')
</head>
<body class="font-inter antialiased bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <!-- Navigation -->
<nav class="backdrop-blur-enhanced shadow-sm sticky top-0 z-50 border-b border-blue-100 gpu-accelerated">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 md:h-20">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('aset.public') }}" class="flex items-center space-x-2 sm:space-x-3 logo-professional">
                    <div class="relative">
                        <div class="logo-container w-10 h-10 sm:w-12 sm:h-12 bg-white rounded-xl flex items-center justify-center shadow-lg p-2 glow-subtle gpu-accelerated">
                            <img src="{{ asset('images/logo ctp.png') }}" alt="Pelita App Logo" class="w-full h-full object-contain">
                        </div>
                        <div class="logo-accent absolute -top-1 -right-1 w-3 h-3 sm:w-4 sm:h-4 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full"></div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-lg sm:text-xl font-bold bg-gradient-to-r from-gray-900 to-blue-900 bg-clip-text text-transparent leading-tight">Pelita App</span>
                        <span class="text-[0.65rem] sm:text-xs text-gray-500 -mt-0.5 leading-none">Cimahi Technopark</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('aset.public') }}" 
                   class="nav-link-clean {{ Request::routeIs('aset.public') ? 'active' : '' }}">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Beranda
                </a>
                <a href="{{ route('profil') }}" 
                   class="nav-link-clean {{ Request::routeIs('profil') ? 'active' : '' }}">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Profil
                </a>
                <a href="{{ route('aset.barang') }}" 
                   class="nav-link-clean {{ Request::routeIs('aset.barang') ? 'active' : '' }}">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Assets
                </a>
                <div class="w-px h-6 bg-gray-300"></div>
                <a href="{{ route('login') }}" 
                   class="nav-link-clean {{ Request::routeIs('login') ? 'active' : '' }}">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Login
                </a>
                <a href="{{ route('register') }}" 
                   class="nav-link-clean {{ Request::routeIs('register') ? 'active' : '' }}">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Daftar
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden" x-data="{ mobileMenuOpen: false }">
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="mobile-menu-button p-2">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <!-- Mobile Navigation Menu -->
                <div x-show="mobileMenuOpen" 
                     x-data="{ animateItems: false }"
                     @click.away="mobileMenuOpen = false"
                     x-init="$watch('mobileMenuOpen', value => { 
                         if(value) setTimeout(() => animateItems = true, 100); 
                         else animateItems = false; 
                     })"
                     x-transition:enter="transition ease-out duration-300" 
                     x-transition:enter-start="opacity-0 transform -translate-y-4" 
                     x-transition:enter-end="opacity-100 transform translate-y-0" 
                     x-transition:leave="transition ease-in duration-200" 
                     x-transition:leave-start="opacity-100 transform translate-y-0" 
                     x-transition:leave-end="opacity-0 transform -translate-y-4" 
                     class="absolute left-0 right-0 top-full backdrop-blur-enhanced border-t border-gray-200 shadow-lg"
                     style="display: none;">
                    <div class="px-4 pt-4 pb-6 space-y-1 max-h-[calc(100vh-4rem)] overflow-y-auto">
                        <a href="{{ route('aset.public') }}" 
                           :class="animateItems ? 'mobile-nav-item animate-in {{ Request::routeIs('aset.public') ? 'active' : '' }}' : 'mobile-nav-item {{ Request::routeIs('aset.public') ? 'active' : '' }}'"
                           style="transition-delay: 0.05s">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Beranda
                        </a>
                        <a href="{{ route('profil') }}" 
                           :class="animateItems ? 'mobile-nav-item animate-in {{ Request::routeIs('profil') ? 'active' : '' }}' : 'mobile-nav-item {{ Request::routeIs('profil') ? 'active' : '' }}'"
                           style="transition-delay: 0.1s">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Profil
                        </a>
                        <a href="{{ route('aset.barang') }}" 
                           :class="animateItems ? 'mobile-nav-item animate-in {{ Request::routeIs('aset.barang') ? 'active' : '' }}' : 'mobile-nav-item {{ Request::routeIs('aset.barang') ? 'active' : '' }}'"
                           style="transition-delay: 0.15s">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Assets
                        </a>
                        
                        <div class="border-t border-gray-200 my-3"></div>
                        
                        <a href="{{ route('login') }}" 
                           :class="animateItems ? 'mobile-nav-item animate-in {{ Request::routeIs('login') ? 'active' : '' }}' : 'mobile-nav-item {{ Request::routeIs('login') ? 'active' : '' }}'"
                           style="transition-delay: 0.2s">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Login
                        </a>
                        <a href="{{ route('register') }}" 
                           :class="animateItems ? 'mobile-nav-item animate-in {{ Request::routeIs('register') ? 'active' : '' }}' : 'mobile-nav-item {{ Request::routeIs('register') ? 'active' : '' }}'"
                           style="transition-delay: 0.25s">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="relative bg-gradient-to-br from-gray-900 via-blue-900 to-indigo-900 text-white overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%239C92AC" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="4"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-20"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 lg:gap-12">
                <!-- About -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/10 rounded-xl flex items-center justify-center shadow-lg p-2 gpu-accelerated">
                            <img src="{{ asset('images/logo ctp.png') }}" alt="Pelita App Logo" class="w-full h-full object-contain">
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xl sm:text-2xl font-bold">Pelita App</span>
                            <span class="text-blue-200 text-xs sm:text-sm">Cimahi Technopark</span>
                        </div>
                    </div>
                    <p class="text-gray-300 text-sm sm:text-base mb-6 leading-relaxed max-w-md">
                        Sistem manajemen peminjaman aset yang mudah, cepat, dan terpercaya untuk mendukung kegiatan inovasi dan kolaborasi di Cimahi Technopark.
                    </p>
                    <div class="flex space-x-3 sm:space-x-4">
                        <a href="https://twitter.com/CimahiTPark" target="_blank" class="social-icon w-10 h-10 sm:w-10 sm:h-10 bg-white/10 rounded-lg flex items-center justify-center text-gray-300 hover:text-white gpu-accelerated">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 relative z-10" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="https://www.facebook.com/cimahitechnopark.id/" target="_blank" class="social-icon w-10 h-10 sm:w-10 sm:h-10 bg-white/10 rounded-lg flex items-center justify-center text-gray-300 hover:text-white gpu-accelerated">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 relative z-10" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="https://www.instagram.com/cimahitechnopark.id/" target="_blank" class="social-icon w-10 h-10 sm:w-10 sm:h-10 bg-white/10 rounded-lg flex items-center justify-center text-gray-300 hover:text-white gpu-accelerated">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 relative z-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="https://id.linkedin.com/company/cimahitechnopark" target="_blank" class="social-icon w-10 h-10 sm:w-10 sm:h-10 bg-white/10 rounded-lg flex items-center justify-center text-gray-300 hover:text-white gpu-accelerated">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 relative z-10" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-base sm:text-lg font-semibold mb-4 sm:mb-6 text-blue-100">Quick Links</h3>
                    <ul class="space-y-2 sm:space-y-3">
                        <li><a href="{{ route('aset.barang') }}" class="footer-link text-sm sm:text-base text-gray-300 hover:text-white flex items-center group"><span class="w-2 h-2 bg-blue-400 rounded-full mr-3 transition-all duration-300 group-hover:bg-white group-hover:scale-110"></span>Lihat Barang</a></li>
                        <li><a href="{{ route('login') }}" class="footer-link text-sm sm:text-base text-gray-300 hover:text-white flex items-center group"><span class="w-2 h-2 bg-blue-400 rounded-full mr-3 transition-all duration-300 group-hover:bg-white group-hover:scale-110"></span>Login</a></li>
                        <li><a href="{{ route('register') }}" class="footer-link text-sm sm:text-base text-gray-300 hover:text-white flex items-center group"><span class="w-2 h-2 bg-blue-400 rounded-full mr-3 transition-all duration-300 group-hover:bg-white group-hover:scale-110"></span>Daftar</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-base sm:text-lg font-semibold mb-4 sm:mb-6 text-blue-100">Kontak</h3>
                    <ul class="space-y-3 sm:space-y-4 text-gray-300 text-sm sm:text-base">
                        <li class="flex items-start">
                            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3 flex-shrink-0 social-icon">
                                <svg class="w-4 h-4 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium">Cimahi Technopark</p>
                                <p class="text-xs sm:text-sm text-gray-400">Jl. Baros No. 78, Baros Kota Cimahi, Jawa Barat 40533 Indonesia</p>
                            </div>
                        </li>
                        <li class="flex items-center">
                            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3 social-icon flex-shrink-0">
                                <svg class="w-4 h-4 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="break-all">Cimahi.technopark@gmail.com</span>
                        </li>
                        <li class="flex items-center">
                            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3 social-icon flex-shrink-0">
                                <svg class="w-4 h-4 text-white relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <span>0851-6358-7878</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Bottom Section -->
            <div class="border-t border-gray-700 mt-8 sm:mt-12 pt-6 sm:pt-8">
                <div class="flex flex-col items-center justify-center text-center">
                    <p class="transition-colors duration-300 hover:text-gray-300 mb-2 text-gray-400 text-xs sm:text-base">
                        &copy; {{ date('Y') }} Pelita App - Cimahi Technopark. All rights reserved.
                    </p>
                    <p class="text-xs sm:text-sm text-gray-300 flex flex-col sm:flex-row items-center gap-1">
                        <span>Developed by</span>
                        <a href="https://github.com/littlesuccumb" target="_blank" 
                        class="flex items-center font-medium text-blue-300 hover:text-blue-200 transition-colors duration-200">
                            <i class="fab fa-github text-lg sm:text-xl ml-1"></i>
                            <span class="ml-1">Muhamad Aliph Fauzansyah</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Professional Decorative Elements -->
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-blue-400 to-transparent opacity-50"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-gradient-to-l from-blue-600/10 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute top-20 right-20 w-32 h-32 bg-gradient-to-l from-purple-600/10 to-transparent rounded-full blur-2xl"></div>
    </footer>

    @stack('scripts')

    <script>
        // Professional animation initialization
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize subtle performance optimizations
            const optimizeElements = () => {
                // Add will-change property to animated elements on demand
                const interactiveElements = document.querySelectorAll('.nav-link-clean, .social-icon, .logo-professional, .mobile-nav-item');
                interactiveElements.forEach(el => {
                    el.addEventListener('mouseenter', () => {
                        el.style.willChange = 'transform';
                    });
                    el.addEventListener('mouseleave', () => {
                        el.style.willChange = 'auto';
                    });
                });
            };

            // Initialize AOS with optimized settings
            const initializeAOS = () => {
                AOS.init({
                    duration: 800,
                    once: true,
                    offset: 100,
                    easing: 'ease-out-cubic',
                    // Disable animations on mobile for better performance
                    disable: window.innerWidth < 768 ? 'mobile' : false
                });
            };

            // Enhanced CountUp with intersection observer
            const initializeCounters = () => {
                const startCounter = (element, endValue) => {
                    if (!element) return;

                    const countUp = new CountUp(element, 0, endValue, 0, 2.0, {
                        useEasing: true,
                        useGrouping: true,
                        separator: ',',
                        decimal: '.',
                    });

                    if (!countUp.error) {
                        const observer = new IntersectionObserver((entries) => {
                            entries.forEach(entry => {
                                if (entry.isIntersecting) {
                                    // Use requestAnimationFrame for smooth start
                                    requestAnimationFrame(() => {
                                        countUp.start();
                                    });
                                    observer.unobserve(entry.target);
                                }
                            });
                        }, {
                            threshold: 0.3,
                            rootMargin: '0px 0px -50px 0px'
                        });

                        observer.observe(element);
                    } else {
                        console.warn('CountUp initialization failed:', countUp.error);
                    }
                };

                // Initialize all counters
                const countElements = document.querySelectorAll('[id$="Count"]');
                countElements.forEach(element => {
                    const value = parseInt(element.getAttribute('data-value') || 0);
                    startCounter(element, value);
                });
            };

            // Enhanced smooth scrolling for anchor links
            const enhanceSmoothScroll = () => {
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
            };

            // Enhanced mobile menu animations
            const initializeMobileMenu = () => {
                // Add staggered animation to mobile menu items
                const mobileItems = document.querySelectorAll('.mobile-nav-item');
                mobileItems.forEach((item, index) => {
                    item.style.transitionDelay = `${(index + 1) * 0.05}s`;
                });
            };

            // Initialize in order of priority
            optimizeElements();
            enhanceSmoothScroll();
            initializeMobileMenu();
            
            // Delay non-critical animations slightly
            setTimeout(() => {
                initializeAOS();
                initializeCounters();
            }, 100);
        });

        document.addEventListener('alpine:init', () => {
    // Detect mobile menu state and toggle body scroll
    document.addEventListener('click', (e) => {
        if (e.target.closest('.mobile-menu-button')) {
            setTimeout(() => {
                const menu = document.querySelector('[x-show="mobileMenuOpen"]');
                if (menu && menu.style.display !== 'none') {
                    document.body.classList.add('menu-open');
                } else {
                    document.body.classList.remove('menu-open');
                }
            }, 50);
        }
    });
});

        // Handle reduced motion preferences
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            document.documentElement.style.setProperty('--transition-professional', 'none');
            document.documentElement.style.setProperty('--transition-subtle', 'none');
            document.documentElement.style.setProperty('--transition-smooth', 'none');
        }
    </script>
</body>
</html>