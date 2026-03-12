<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Pelita App - Sistem Peminjaman Aset')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo ctp.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        :root { --transition-professional: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); }
        html { scroll-behavior: smooth; }
        .backdrop-blur-enhanced {
            backdrop-filter: blur(8px) saturate(150%);
            -webkit-backdrop-filter: blur(8px) saturate(150%);
            background: rgba(255, 255, 255, 0.90);
        }
        .nav-link { position: relative; transition: var(--transition-professional); }
        .nav-link::before {
            content: ''; position: absolute; bottom: -2px; left: 50%; width: 0; height: 2px;
            background: linear-gradient(90deg, #3B82F6, #6366F1);
            transform: translateX(-50%); transition: width 0.3s ease-out;
        }
        .nav-link:hover::before { width: 80%; }
        .nav-link:hover { color: #3B82F6; transform: translateY(-1px); }
        .nav-link.active { color: #3B82F6; font-weight: 600; }
        .nav-link.active::before { width: 80%; }
        .logo-professional { transition: var(--transition-professional); }
        .logo-professional:hover { transform: scale(1.02); }
        .user-avatar { transition: var(--transition-professional); }
        .user-avatar:hover { transform: scale(1.05); box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2); }
        @keyframes pulse-badge { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.1); } }
        .notification-badge { animation: pulse-badge 2s ease-in-out infinite; }
        .icon-button { transition: var(--transition-professional); }
        .icon-button:hover { transform: scale(1.1); background-color: rgba(59, 130, 246, 0.1); }
        .alert { animation: slideInGently 0.4s ease-out forwards; }
        @keyframes slideInGently { from { transform: translateY(-10px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .gpu-accelerated { transform: translateZ(0); backface-visibility: hidden; }

        /* Logout Button Loading */
        .logout-button-loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .logout-spinner {
            display: none;
            width: 16px;
            height: 16px;
            border: 2px solid #fee2e2;
            border-top-color: #dc2626;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .logout-icon {
            transition: opacity 0.2s ease;
        }

        .breadcrumb-modern {
        display: flex;
        align-items: center;
        gap: 12px;
        background: white;
        padding: 16px 24px;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(14, 165, 233, 0.1);
    }

    .breadcrumb-link {
        color: #64748B;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .breadcrumb-link:hover {
        color: #0EA5E9;
    }

    .breadcrumb-current {
        color: #0F172A;
        font-weight: 700;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Separator Icon Styling */
    .breadcrumb-modern .fa-chevron-right {
        font-size: 10px;
        opacity: 0.5;
    }

    /* Animation untuk breadcrumb */
    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
        from { 
            opacity: 0;
            transform: translateY(-10px);
        }
        to { 
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive breadcrumb */
    @media (max-width: 640px) {
        .breadcrumb-modern {
            padding: 12px 16px;
            gap: 8px;
        }
        
        .breadcrumb-link,
        .breadcrumb-current {
            font-size: 13px;
        }
        
        .breadcrumb-link span,
        .breadcrumb-current span {
            display: none;
        }
        
        .breadcrumb-link i,
        .breadcrumb-current i {
            font-size: 16px;
        }
    }

    /* Hover effect untuk breadcrumb container */
    .breadcrumb-modern:hover {
        border-color: rgba(14, 165, 233, 0.2);
    }


    /* Custom style untuk breadcrumb edit */
    .breadcrumb-edit .breadcrumb-current {
        color: #EA580C;
    }

    .breadcrumb-edit {
        border-color: rgba(234, 88, 12, 0.15);
    }

        /* ============ NOTIFICATION DROPDOWN CSS ============ */
        .nav-button {
            position: relative;
            padding: 0.5rem;
            border-radius: 0.75rem;
            color: var(--gray-700, #374151);
            transition: all 0.2s ease;
            background: transparent;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-button:hover {
            background: rgba(59, 130, 246, 0.1);
            color: #3B82F6;
        }

        .notification-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 6px;
            border-radius: 10px;
            min-width: 18px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);
            animation: pulse-badge 2s ease-in-out infinite;
            border: 1px solid white;
        }

        .dropdown {
            position: absolute;
            top: calc(100% + 0.5rem);
            right: 0;
            width: 380px;
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid #e5e7eb;
            z-index: 50;
            overflow: hidden;
        }

        .dropdown > div:first-child {
            border-bottom: 1px solid #e5e7eb;
            background: rgba(249, 250, 251, 0.5);
        }

        .custom-scrollbar {
            max-height: 384px;
            overflow-y: auto;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            margin-right: 0.5rem;
            animation: pulse-badge 2s infinite;
        }

        .bg-green-100 { background-color: #dcfce7; }
        .bg-red-100 { background-color: #fee2e2; }
        .bg-yellow-100 { background-color: #fef3c7; }
        .bg-blue-100 { background-color: #dbeafe; }
        .text-green-600 { color: #16a34a; }
        .text-red-600 { color: #dc2626; }
        .text-yellow-600 { color: #ca8a04; }
        .text-blue-600 { color: #2563eb; }
        .text-primary-600 { color: #2563eb; }
        .text-primary-700 { color: #1d4ed8; }
        .hover\:text-primary-700:hover { color: #1d4ed8; }
        .hover\:text-primary-600:hover { color: #2563eb; }

        [x-cloak] { display: none !important; }
    </style>

    @stack('styles')
</head>
<body class="font-inter antialiased bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <!-- Navigation -->
    <nav class="backdrop-blur-enhanced shadow-sm sticky top-0 z-50 border-b border-blue-100 gpu-accelerated">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 logo-professional">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm p-1 transition-all duration-300">
                            <img src="{{ asset('images/logo ctp.png') }}" alt="Pelita App Logo" class="w-full h-full object-contain">
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xl font-bold bg-gradient-to-r from-gray-900 to-blue-900 bg-clip-text text-transparent">Pelita App</span>
                            <span class="text-xs text-gray-500 -mt-1">Cimahi Technopark</span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-2">
                    <!-- Dashboard Link -->
                    <a href="{{ route('dashboard') }}" class="nav-link flex items-center px-5 py-3 text-sm font-medium text-gray-700 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 5h4"></path>
                        </svg>
                        Dashboard
                    </a>

                    <!-- Main Menu -->
                    <a href="{{ route('user.barang') }}" class="nav-link flex items-center px-5 py-3 text-sm font-medium text-gray-700 {{ request()->routeIs('user.barang*') ? 'active' : '' }}">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        Katalog Barang
                    </a>

                    <!-- Aktivitas Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" class="nav-link flex items-center px-5 py-3 text-sm font-medium text-gray-700 {{ request()->routeIs(['permohonan.*', 'peminjaman.*', 'pembayaran.*']) ? 'active' : '' }}">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            Aktivitas
                            <svg class="w-4 h-4 ml-1 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div x-show="open" 
                            x-transition:enter="transition ease-out duration-200" 
                            x-transition:enter-start="opacity-0 scale-95 translate-y-1" 
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 z-50 border border-gray-100"
                            style="display: none;">
                            <div class="py-2">
                                <a href="{{ route('permohonan.index') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition {{ request()->routeIs('permohonan.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Permohonan Saya
                                </a>
                                <a href="{{ route('peminjaman.index') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition {{ request()->routeIs('peminjaman.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Peminjaman Saya
                                </a>
                                <a href="{{ route('pembayaran.index') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition {{ request()->routeIs('pembayaran.*') ? 'bg-blue-50 text-blue-600' : '' }}">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    Pembayaran
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Icon Buttons -->
                    <div class="flex items-center space-x-2 ml-4 pl-4 border-l border-gray-200">
                        <!-- Cart Button with Badge -->
                        <a href="{{ route('cart.index') }}" 
                           class="nav-button icon-button relative p-2 rounded-xl text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            
                            <span id="cart-badge" 
                                  class="hidden absolute -top-1 -right-1 min-w-[18px] h-[18px] px-1 bg-gradient-to-r from-red-600 to-rose-600 text-white text-[10px] font-bold rounded-full flex items-center justify-center shadow-lg border-2 border-white">
                                0
                            </span>
                        </a>

                        @include('layouts.partials.topnav.notifications')

                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open" class="flex items-center space-x-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition">
                                @if(Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                         alt="{{ Auth::user()->name }}"
                                         class="w-8 h-8 rounded-full object-cover ring-2 ring-blue-500">
                                @else
                                    <div class="user-avatar w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                    </div>
                                @endif
                                <span class="hidden lg:block">{{ Str::limit(Auth::user()->name, 15) }}</span>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            
                            <div x-show="open" 
                                x-transition:enter="transition ease-out duration-200" 
                                x-transition:enter-start="opacity-0 scale-95 translate-y-1" 
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 z-50 border border-gray-100"
                                style="display: none;">
                                <div class="py-2">
                                    <div class="px-4 py-3 border-b border-gray-100">
                                        <div class="flex items-center space-x-3">
                                            @if(Auth::user()->avatar)
                                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                                     alt="{{ Auth::user()->name }}"
                                                     class="w-10 h-10 rounded-full object-cover ring-2 ring-blue-500">
                                            @else
                                                <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                                </div>
                                            @endif
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ route('profile.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Profil Saya
                                    </a>
                                    
                                    <hr class="my-2">
                                    
                                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                        @csrf
                                        <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                            <svg class="w-4 h-4 mr-3 logout-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                            <div class="logout-spinner hidden mr-3"></div>
                                            <span class="logout-text">Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center space-x-2">
                    <!-- Cart Button Mobile -->
                    <a href="{{ route('cart.index') }}" 
                       class="nav-button icon-button relative p-2 rounded-xl text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        
                        <span id="cart-badge-mobile" 
                              class="hidden absolute -top-1 -right-1 min-w-[18px] h-[18px] px-1 bg-gradient-to-r from-red-600 to-rose-600 text-white text-[10px] font-bold rounded-full flex items-center justify-center shadow-lg border-2 border-white">
                            0
                        </span>
                    </a>

                    @include('layouts.partials.topnav.notifications')

                    <button x-data @click="$dispatch('toggle-mobile-menu')" class="p-2 rounded-lg text-gray-700 hover:text-blue-600 hover:bg-blue-50">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div x-data="{ open: false }" 
             @toggle-mobile-menu.window="open = !open" 
             x-show="open" 
             x-transition
             class="md:hidden backdrop-blur-enhanced border-t border-gray-200"
             style="display: none;">
            <div class="px-4 pt-4 pb-6 space-y-2">
                <a href="{{ route('user.barang') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition {{ request()->routeIs('user.barang*') ? 'text-blue-600 bg-blue-50' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Katalog Barang
                </a>

                <hr class="my-3">
                
                <div class="px-4 py-2">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Aktivitas</p>
                </div>
                <a href="{{ route('permohonan.index') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition {{ request()->routeIs('permohonan.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Permohonan Saya
                </a>
                <a href="{{ route('peminjaman.index') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition {{ request()->routeIs('peminjaman.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Peminjaman Saya
                </a>
                <a href="{{ route('pembayaran.index') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition {{ request()->routeIs('pembayaran.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                    Pembayaran
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition {{ request()->routeIs('profile.*') ? 'text-blue-600 bg-blue-50' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Profil Saya
                </a>
                
                <hr class="my-3">
                
                <div class="px-4 py-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                 alt="{{ Auth::user()->name }}"
                                 class="w-10 h-10 rounded-full object-cover ring-2 ring-blue-500">
                        @else
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                        @endif
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" id="logout-form-mobile">
                    @csrf
                    <button type="submit" class="flex items-center w-full text-left px-4 py-3 text-base font-medium text-red-600 hover:bg-red-50 rounded-lg transition">
                        <svg class="w-5 h-5 mr-3 logout-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <div class="logout-spinner hidden mr-3"></div>
                        <span class="logout-text">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="relative bg-gradient-to-br from-gray-900 via-blue-900 to-indigo-900 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-[url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%239C92AC\" fill-opacity=\"0.03\"%3E%3Ccircle cx=\"30\" cy=\"30\" r=\"4\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 lg:gap-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center shadow-lg p-2">
                            <img src="{{ asset('images/logo ctp.png') }}" alt="Logo" class="w-full h-full object-contain">
                        </div>              
                        <div class="flex flex-col">
                            <span class="text-2xl font-bold">Pelita App</span>
                            <span class="text-blue-200 text-sm">Cimahi Technopark</span>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-6 leading-relaxed max-w-md">
                        Sistem manajemen peminjaman aset yang mudah, cepat, dan terpercaya untuk mendukung kegiatan inovasi dan kolaborasi di Cimahi Technopark.
                    </p>
                    <div class="flex space-x-4">
                        <a href="https://www.instagram.com/cimahitechnopark.id/" target="_blank" class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center text-gray-300 hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="https://id.linkedin.com/company/cimahitechnopark" target="_blank" class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center text-gray-300 hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <a href="https://www.youtube.com/@CimahiTechnopark" target="_blank" class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center text-gray-300 hover:text-white transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-6 text-blue-100">Menu Utama</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('user.barang') }}" class="text-gray-300 hover:text-white flex items-center transition"><span class="w-2 h-2 bg-blue-400 rounded-full mr-3"></span>Lihat Barang</a></li>
                        <li><a href="{{ route('permohonan.index') }}" class="text-gray-300 hover:text-white flex items-center transition"><span class="w-2 h-2 bg-purple-400 rounded-full mr-3"></span>Permohonan Saya</a></li>
                        <li><a href="{{ route('peminjaman.index') }}" class="text-gray-300 hover:text-white flex items-center transition"><span class="w-2 h-2 bg-blue-400 rounded-full mr-3"></span>Peminjaman Saya</a></li>
                        <li><a href="{{ route('pembayaran.index') }}" class="text-gray-300 hover:text-white flex items-center transition"><span class="w-2 h-2 bg-blue-400 rounded-full mr-3"></span>Pembayaran</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-6 text-blue-100">Layanan</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('notifications.index') }}" class="text-gray-300 hover:text-white flex items-center transition"><span class="w-2 h-2 bg-purple-400 rounded-full mr-3"></span>Notifikasi</a></li>
                        <li><a href="{{ route('profile.edit') }}" class="text-gray-300 hover:text-white flex items-center transition"><span class="w-2 h-2 bg-purple-400 rounded-full mr-3"></span>Pengaturan Profil</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white flex items-center transition"><span class="w-2 h-2 bg-purple-400 rounded-full mr-3"></span>Bantuan</a></li>
                    </ul>
                </div>
            </div>
            
           <div class="border-t border-gray-700 mt-12 pt-8">
                <div class="flex flex-col items-center justify-center text-center">
                    <p class="transition-colors duration-300 hover:text-gray-300 mb-2 text-gray-400">
                        &copy; {{ date('Y') }} <b>Pelita App</b> - Cimahi Technopark. All rights reserved.
                    </p>
                    <p class="text-sm text-gray-300 flex items-center gap-1">
                        Developed by
                        <a href="https://github.com/littlesuccumb" target="_blank" 
                        class="flex items-center font-medium text-blue-300 hover:text-blue-200 transition-colors duration-200">
                            <i class="fab fa-github text-xl ml-1"></i>
                            <span class="ml-1">Muhamad Aliph Fauzansyah</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-blue-400 to-transparent opacity-50"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-gradient-to-l from-blue-600/10 to-transparent rounded-full blur-3xl"></div>
    </footer>
    
    @stack('scripts')

    <!-- Cart Badge Management Script -->
    <script>
        // Cart Badge Management
        function updateCartBadge() {
            const cart = JSON.parse(localStorage.getItem('pelita_cart') || '[]');
            const badge = document.getElementById('cart-badge');
            const badgeMobile = document.getElementById('cart-badge-mobile');
            const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
            
            [badge, badgeMobile].forEach(element => {
                if (element) {
                    if (totalItems > 0) {
                        element.textContent = totalItems > 99 ? '99+' : totalItems;
                        element.classList.remove('hidden');
                    } else {
                        element.classList.add('hidden');
                    }
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateCartBadge();
            
            // Alert auto-dismiss
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    setTimeout(() => alert.remove(), 300);
                }, 5000);
            });

            // Logout Animation Handler
            const logoutForms = ['logout-form', 'logout-form-mobile'];
            logoutForms.forEach(formId => {
                const form = document.getElementById(formId);
                if (form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault(); // Prevent default submission first
                        
                        const button = this.querySelector('button[type="submit"]');
                        const icon = button.querySelector('.logout-icon');
                        const spinner = button.querySelector('.logout-spinner');
                        const text = button.querySelector('.logout-text');
                        
                        // Prevent double submission
                        if (button.classList.contains('logout-button-loading')) {
                            return;
                        }
                        
                        // Add loading state
                        button.classList.add('logout-button-loading');
                        icon.classList.add('hidden');
                        spinner.classList.remove('hidden');
                        text.textContent = 'Memproses...';
                        
                        // Submit form after animation starts
                        setTimeout(() => {
                            this.submit();
                        }, 300);
                    });
                }
            });
        });

        window.addEventListener('storage', function(e) {
            if (e.key === 'pelita_cart') {
                updateCartBadge();
            }
        });

        window.addEventListener('cartUpdated', updateCartBadge);

        function notifyCartUpdate() {
            window.dispatchEvent(new Event('cartUpdated'));
        }

        function goBack() {
            // Cek apakah ada history sebelumnya dan bukan dari external site
            if (window.history.length > 1 && document.referrer && 
                document.referrer.indexOf(window.location.host) !== -1) {
                window.history.back();
            } else {
                // Fallback ke halaman default berdasarkan role
                const userRole = '{{ auth()->user()->role ?? "user" }}';
                
                // Tentukan fallback URL berdasarkan role
                if (userRole === 'super_admin' || userRole === 'admin') {
                    window.location.href = '{{ route('dashboard') }}';
                } else if (userRole === 'mahasiswa') {
                    window.location.href = '{{ route('dashboard') }}';
                } else {
                    window.location.href = '{{ route('dashboard') }}';
                }
            }
        }

        /**
         * Helper function untuk navigasi dengan konfirmasi (jika ada perubahan form)
         */
        function goBackWithConfirm(message = 'Ada perubahan yang belum disimpan. Yakin ingin kembali?') {
            // Cek apakah form sudah dimodifikasi
            const forms = document.querySelectorAll('form');
            let isModified = false;

            forms.forEach(form => {
                const inputs = form.querySelectorAll('input:not([type="hidden"]), textarea, select');
                inputs.forEach(input => {
                    if (input.defaultValue !== input.value) {
                        isModified = true;
                    }
                });
            });

            // Jika ada perubahan, tampilkan konfirmasi
            if (isModified) {
                if (confirm(message)) {
                    goBack();
                }
            } else {
                goBack();
            }
        }

        /**
         * Auto-setup untuk semua link/button dengan class 'btn-back' atau 'back-button'
         */
        document.addEventListener('DOMContentLoaded', function() {
            // Setup untuk button/link dengan class khusus
            const backButtons = document.querySelectorAll('.btn-back, .back-button, [data-back]');
            
            backButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Cek apakah perlu konfirmasi
                    if (this.hasAttribute('data-confirm')) {
                        goBackWithConfirm(this.getAttribute('data-confirm'));
                    } else {
                        goBack();
                    }
                });
            });

            // Keyboard shortcut: Alt + Left Arrow untuk back
            document.addEventListener('keydown', function(e) {
                if (e.altKey && e.key === 'ArrowLeft') {
                    e.preventDefault();
                    goBack();
                }
            });
        });
    </script>
</body>
</html>