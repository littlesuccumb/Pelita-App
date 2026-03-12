@extends('layouts.user')

@section('title', 'Katalog Barang - Pelita App')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/50">
    <!-- Header Section -->
    <div class="bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 relative overflow-hidden">
        <!-- Animated Decorative Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-0 left-1/3 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                <!-- Content - Left Side -->
                <div class="text-white space-y-6 relative z-10 flex-1" data-aos="fade-up">
                    <!-- Status Badge with Glow -->
                    <div class="hero-badge badge-glow inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full border border-white/20">
                        <div class="relative w-2 h-2">
                            <div class="absolute inset-0 bg-emerald-400 rounded-full animate-ping"></div>
                            <div class="relative bg-emerald-400 rounded-full w-2 h-2"></div>
                        </div>
                        <span class="text-sm font-semibold">{{ $barang->total() }} Produk Tersedia</span>
                    </div>
                    
                    <div>
                        <!-- Main Title with Animation -->
                        <h1 class="hero-title text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 leading-tight">
                            Katalog <span class="bg-gradient-to-r from-yellow-400 via-orange-500 to-yellow-400 bg-clip-text text-transparent animate-gradient-text">Aset Pelita</span>
                        </h1>
                        <p class="hero-description text-lg md:text-xl text-blue-100 max-w-2xl">
                            Temukan koleksi lengkap peralatan berkualitas untuk kebutuhan Anda di Cimahi Technopark
                        </p>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="{{ route('permohonan.create') }}" 
                           class="group relative inline-flex items-center justify-center px-8 py-4 bg-white text-blue-700 font-bold rounded-xl shadow-2xl hover:shadow-white/20 transform hover:scale-105 transition-all duration-300 overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-purple-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <svg class="relative w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="relative">Buat Permohonan</span>
                        </a>
                        
                        <a href="#products" 
                           onclick="event.preventDefault(); document.querySelector('#products').scrollIntoView({behavior: 'smooth'});"
                           class="group inline-flex items-center justify-center px-8 py-4 bg-white/10 backdrop-blur-sm text-white font-bold rounded-xl border-2 border-white/30 hover:bg-white/20 hover:border-white/50 shadow-lg transform hover:scale-105 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                            </svg>
                            Jelajahi Produk
                        </a>
                    </div>
                </div>
                
                <!-- Icon Illustration - Right Side -->
                <div class="relative lg:flex-shrink-0 hidden lg:block" data-aos="fade-left">
                    <div class="relative w-80 h-80">
                        <!-- Dynamic Background Shapes -->
                        <div class="absolute inset-0">
                            <!-- Outer rotating ring -->
                            <div class="absolute inset-0 rounded-full border-4 border-white/10 animate-spin-slow"></div>
                            
                            <!-- Multiple orbiting dots -->
                            <div class="absolute inset-0 animate-spin-reverse" style="animation-duration: 15s;">
                                <div class="absolute top-0 left-1/2 w-3 h-3 bg-yellow-400 rounded-full -translate-x-1/2 shadow-lg shadow-yellow-400/50"></div>
                            </div>
                            <div class="absolute inset-4 animate-spin-slow" style="animation-duration: 20s;">
                                <div class="absolute top-0 left-1/2 w-2.5 h-2.5 bg-blue-400 rounded-full -translate-x-1/2 shadow-lg shadow-blue-400/50"></div>
                            </div>
                            <div class="absolute inset-8 animate-spin-reverse" style="animation-duration: 12s;">
                                <div class="absolute top-0 left-1/2 w-2 h-2 bg-purple-400 rounded-full -translate-x-1/2 shadow-lg shadow-purple-400/50"></div>
                            </div>
                            
                            <!-- Pulsing rings -->
                            <div class="absolute inset-0 rounded-full border-2 border-white/20 animate-ping-slow"></div>
                            <div class="absolute inset-12 rounded-full border-2 border-white/15 animate-ping-slower"></div>
                        </div>
                        
                        <!-- Main Icon Container -->
                        <div class="absolute inset-0 flex items-center justify-center animate-float">
                            <div class="relative group">
                                <!-- Rotating glow effect -->
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-400 via-purple-500 to-pink-500 rounded-3xl blur-3xl opacity-40 animate-gradient-rotate"></div>
                                
                                <!-- Glass morphism container -->
                                <div class="relative bg-white/10 backdrop-blur-2xl rounded-3xl p-10 shadow-2xl border border-white/30 hover:scale-105 transition-transform duration-500">                                    <!-- 3D Stack of Items Icon -->
                                    <svg class="w-44 h-44" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <!-- Back box -->
                                        <g opacity="0.6">
                                            <rect x="45" y="35" width="90" height="90" rx="12" fill="url(#boxGradient1)" transform="rotate(-5 90 80)">
                                                <animateTransform attributeName="transform" type="rotate" values="-5 90 80; -3 90 80; -5 90 80" dur="3s" repeatCount="indefinite"/>
                                            </rect>
                                            <!-- Box details -->
                                            <line x1="55" y1="50" x2="125" y2="50" stroke="white" stroke-width="3" opacity="0.3" stroke-linecap="round"/>
                                            <line x1="90" y1="45" x2="90" y2="115" stroke="white" stroke-width="3" opacity="0.3" stroke-linecap="round"/>
                                        </g>
                                        
                                        <!-- Middle box -->
                                        <g opacity="0.8">
                                            <rect x="50" y="50" width="90" height="90" rx="12" fill="url(#boxGradient2)" transform="rotate(2 95 95)">
                                                <animateTransform attributeName="transform" type="rotate" values="2 95 95; 4 95 95; 2 95 95" dur="3s" repeatCount="indefinite" begin="0.5s"/>
                                            </rect>
                                            <circle cx="95" cy="95" r="15" fill="white" opacity="0.2">
                                                <animate attributeName="r" values="15;18;15" dur="2s" repeatCount="indefinite"/>
                                            </circle>
                                        </g>
                                        
                                        <!-- Front box (main) -->
                                        <g>
                                            <rect x="60" y="65" width="90" height="90" rx="12" fill="url(#boxGradient3)">
                                                <animate attributeName="y" values="65;62;65" dur="2s" repeatCount="indefinite"/>
                                            </rect>
                                            
                                            <!-- Shopping bag handle -->
                                            <path d="M 85 75 Q 85 65, 95 65 T 105 75" stroke="url(#handleGradient)" stroke-width="4" fill="none" stroke-linecap="round"/>
                                            
                                            <!-- Checkmark -->
                                            <g transform="translate(100, 110)">
                                                <circle r="20" fill="white" opacity="0.9"/>
                                                <path d="M -8 0 L -3 6 L 8 -8" stroke="url(#checkGradient)" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <animate attributeName="stroke-dasharray" values="0,100;100,0" dur="2s" repeatCount="indefinite"/>
                                                    <animate attributeName="stroke-dashoffset" values="100;0" dur="2s" repeatCount="indefinite"/>
                                                </path>
                                            </g>
                                            
                                            <!-- Shine effect -->
                                            <rect x="65" y="70" width="30" height="80" rx="8" fill="url(#shineGradient)" opacity="0.15">
                                                <animate attributeName="opacity" values="0.15;0.3;0.15" dur="3s" repeatCount="indefinite"/>
                                            </rect>
                                        </g>
                                        
                                        <!-- Floating sparkles -->
                                        <g class="sparkle">
                                            <circle cx="40" cy="60" r="3" fill="#FCD34D">
                                                <animate attributeName="opacity" values="0;1;0" dur="2s" repeatCount="indefinite"/>
                                                <animate attributeName="cy" values="60;50;60" dur="2s" repeatCount="indefinite"/>
                                            </circle>
                                            <circle cx="160" cy="80" r="2.5" fill="#60A5FA">
                                                <animate attributeName="opacity" values="0;1;0" dur="2s" repeatCount="indefinite" begin="0.5s"/>
                                                <animate attributeName="cy" values="80;70;80" dur="2s" repeatCount="indefinite" begin="0.5s"/>
                                            </circle>
                                            <circle cx="50" cy="140" r="2" fill="#C084FC">
                                                <animate attributeName="opacity" values="0;1;0" dur="2s" repeatCount="indefinite" begin="1s"/>
                                                <animate attributeName="cy" values="140;130;140" dur="2s" repeatCount="indefinite" begin="1s"/>
                                            </circle>
                                            <circle cx="150" cy="150" r="2.5" fill="#F472B6">
                                                <animate attributeName="opacity" values="0;1;0" dur="2s" repeatCount="indefinite" begin="1.5s"/>
                                                <animate attributeName="cy" values="150;140;150" dur="2s" repeatCount="indefinite" begin="1.5s"/>
                                            </circle>
                                        </g>
                                        
                                        <!-- Gradients -->
                                        <defs>
                                            <linearGradient id="boxGradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                                                <stop offset="0%" style="stop-color:#818CF8;stop-opacity:1" />
                                                <stop offset="100%" style="stop-color:#6366F1;stop-opacity:1" />
                                            </linearGradient>
                                            <linearGradient id="boxGradient2" x1="0%" y1="0%" x2="100%" y2="100%">
                                                <stop offset="0%" style="stop-color:#60A5FA;stop-opacity:1" />
                                                <stop offset="100%" style="stop-color:#3B82F6;stop-opacity:1" />
                                            </linearGradient>
                                            <linearGradient id="boxGradient3" x1="0%" y1="0%" x2="100%" y2="100%">
                                                <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:1" />
                                                <stop offset="50%" style="stop-color:#6366F1;stop-opacity:1" />
                                                <stop offset="100%" style="stop-color:#8B5CF6;stop-opacity:1" />
                                            </linearGradient>
                                            <linearGradient id="handleGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                                <stop offset="0%" style="stop-color:#DBEAFE;stop-opacity:1" />
                                                <stop offset="100%" style="stop-color:#BFDBFE;stop-opacity:1" />
                                            </linearGradient>
                                            <linearGradient id="checkGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                                <stop offset="0%" style="stop-color:#10B981;stop-opacity:1" />
                                                <stop offset="100%" style="stop-color:#059669;stop-opacity:1" />
                                            </linearGradient>
                                            <linearGradient id="shineGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                                <stop offset="0%" style="stop-color:#FFFFFF;stop-opacity:0" />
                                                <stop offset="50%" style="stop-color:#FFFFFF;stop-opacity:1" />
                                                <stop offset="100%" style="stop-color:#FFFFFF;stop-opacity:0" />
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                    
                                    <!-- Corner decorations -->
                                    <div class="absolute top-2 right-2 w-4 h-4 border-t-2 border-r-2 border-blue-300 rounded-tr-lg"></div>
                                    <div class="absolute bottom-2 left-2 w-4 h-4 border-b-2 border-l-2 border-purple-300 rounded-bl-lg"></div>
                                </div>
                                
                                <!-- Animated Badge -->
                                <div class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap">
                                    <div class="relative bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white px-6 py-2.5 rounded-full font-bold text-sm shadow-2xl border-2 border-white/30 animate-gradient-x">
                                        <span class="inline-flex items-center gap-2">
                                            <svg class="w-4 h-4 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                                            </svg>
                                            {{ $barang->total() }} Items
                                        </span>
                                        <!-- Badge glow -->
                                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full blur-lg opacity-50 -z-10 animate-pulse"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modern Wave Divider - Enhanced with More Dynamic Waves -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
            <svg class="relative block w-full h-[100px] md:h-[150px]" viewBox="0 0 1200 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="dashboardWaveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:#F8FAFC;stop-opacity:1" />
                        <stop offset="50%" style="stop-color:#F1F5F9;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#F8FAFC;stop-opacity:1" />
                    </linearGradient>
                    
                    <!-- Animated gradient for dynamic wave effect -->
                    <linearGradient id="dashboardWaveGradientAnimated" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:#EFF6FF;stop-opacity:1">
                            <animate attributeName="stop-color" values="#EFF6FF;#DBEAFE;#EFF6FF" dur="4s" repeatCount="indefinite" />
                        </stop>
                        <stop offset="50%" style="stop-color:#DBEAFE;stop-opacity:1">
                            <animate attributeName="stop-color" values="#DBEAFE;#BFDBFE;#DBEAFE" dur="4s" repeatCount="indefinite" />
                        </stop>
                        <stop offset="100%" style="stop-color:#EFF6FF;stop-opacity:1">
                            <animate attributeName="stop-color" values="#EFF6FF;#DBEAFE;#EFF6FF" dur="4s" repeatCount="indefinite" />
                        </stop>
                    </linearGradient>
                </defs>
                
                <!-- Wave Layer 1 - Main Dynamic Wave -->
                <path d="M0,25 Q100,70 200,50 Q300,30 400,55 Q500,80 600,45 Q700,20 800,50 Q900,75 1000,40 Q1100,25 1200,55 L1200,120 L0,120 Z" 
                    fill="url(#dashboardWaveGradient)" 
                    opacity="1">
                    <animate attributeName="d" 
                            dur="8s" 
                            repeatCount="indefinite"
                            values="
                                M0,25 Q100,70 200,50 Q300,30 400,55 Q500,80 600,45 Q700,20 800,50 Q900,75 1000,40 Q1100,25 1200,55 L1200,120 L0,120 Z;
                                M0,35 Q100,50 200,70 Q300,85 400,50 Q500,30 600,60 Q700,80 800,45 Q900,30 1000,65 Q1100,75 1200,45 L1200,120 L0,120 Z;
                                M0,30 Q100,60 200,55 Q300,40 400,70 Q500,85 600,50 Q700,35 800,65 Q900,80 1000,50 Q1100,35 1200,60 L1200,120 L0,120 Z;
                                M0,25 Q100,70 200,50 Q300,30 400,55 Q500,80 600,45 Q700,20 800,50 Q900,75 1000,40 Q1100,25 1200,55 L1200,120 L0,120 Z" />
                </path>
                
                <!-- Wave Layer 2 - Secondary Wave (Opposite Direction) -->
                <path d="M0,45 Q150,80 300,55 Q450,35 600,70 Q750,90 900,55 Q1050,40 1200,75 L1200,120 L0,120 Z" 
                    fill="#F8FAFC" 
                    opacity="0.7">
                    <animate attributeName="d" 
                            dur="10s" 
                            repeatCount="indefinite"
                            values="
                                M0,45 Q150,80 300,55 Q450,35 600,70 Q750,90 900,55 Q1050,40 1200,75 L1200,120 L0,120 Z;
                                M0,55 Q150,65 300,75 Q450,90 600,60 Q750,45 900,70 Q1050,85 1200,65 L1200,120 L0,120 Z;
                                M0,50 Q150,75 300,65 Q450,50 600,80 Q750,95 900,60 Q1050,50 1200,70 L1200,120 L0,120 Z;
                                M0,45 Q150,80 300,55 Q450,35 600,70 Q750,90 900,55 Q1050,40 1200,75 L1200,120 L0,120 Z" />
                </path>
                
                <!-- Wave Layer 3 - Tertiary Wave (Faster, More Curves) -->
                <path d="M0,65 Q80,90 160,75 Q240,60 320,85 Q400,95 480,70 Q560,55 640,80 Q720,90 800,65 Q880,50 960,75 Q1040,85 1120,60 Q1160,50 1200,70 L1200,120 L0,120 Z" 
                    fill="url(#dashboardWaveGradientAnimated)" 
                    opacity="0.5">
                    <animate attributeName="d" 
                            dur="6s" 
                            repeatCount="indefinite"
                            values="
                                M0,65 Q80,90 160,75 Q240,60 320,85 Q400,95 480,70 Q560,55 640,80 Q720,90 800,65 Q880,50 960,75 Q1040,85 1120,60 Q1160,50 1200,70 L1200,120 L0,120 Z;
                                M0,75 Q80,65 160,85 Q240,95 320,70 Q400,60 480,85 Q560,95 640,70 Q720,60 800,80 Q880,90 960,65 Q1040,55 1120,75 Q1160,85 1200,65 L1200,120 L0,120 Z;
                                M0,70 Q80,80 160,70 Q240,85 320,75 Q400,65 480,90 Q560,85 640,75 Q720,65 800,85 Q880,95 960,70 Q1040,60 1120,80 Q1160,90 1200,75 L1200,120 L0,120 Z;
                                M0,65 Q80,90 160,75 Q240,60 320,85 Q400,95 480,70 Q560,55 640,80 Q720,90 800,65 Q880,50 960,75 Q1040,85 1120,60 Q1160,50 1200,70 L1200,120 L0,120 Z" />
                </path>
                
                <!-- Wave Layer 4 - Ripple Wave -->
                <path d="M0,80 Q120,95 240,85 Q360,75 480,90 Q600,95 720,85 Q840,75 960,90 Q1080,95 1200,85 L1200,120 L0,120 Z" 
                    fill="#F1F5F9" 
                    opacity="0.6">
                    <animate attributeName="d" 
                            dur="7s" 
                            repeatCount="indefinite"
                            values="
                                M0,80 Q120,95 240,85 Q360,75 480,90 Q600,95 720,85 Q840,75 960,90 Q1080,95 1200,85 L1200,120 L0,120 Z;
                                M0,85 Q120,80 240,90 Q360,95 480,85 Q600,80 720,90 Q840,95 960,85 Q1080,80 1200,90 L1200,120 L0,120 Z;
                                M0,82 Q120,90 240,87 Q360,80 480,92 Q600,90 720,87 Q840,82 960,92 Q1080,90 1200,87 L1200,120 L0,120 Z;
                                M0,80 Q120,95 240,85 Q360,75 480,90 Q600,95 720,85 Q840,75 960,90 Q1080,95 1200,85 L1200,120 L0,120 Z" />
                </path>
                
                <!-- Wave Layer 5 - Base Solid Layer -->
                <path d="M0,92 L1200,92 L1200,120 L0,120 Z" 
                    fill="#F8FAFC" 
                    opacity="1" />
            </svg>
        </div>

        <!-- Optional: Add subtle shine effect overlay -->
        <div class="absolute bottom-0 left-0 w-full h-[100px] md:h-[150px] pointer-events-none">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-50/50 to-transparent"></div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" id="products">
        <!-- Filter Section - UPDATED TO MATCH PEMINJAMAN STYLE -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mt-8 mb-8 relative z-10" data-aos="fade-up">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                    <i class="fas fa-filter text-blue-600 mr-2"></i>
                    Filter & Pencarian
                </h3>
            </div>
            
            <form method="GET" action="{{ route('user.barang') }}" id="filterForm">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 mb-3">
                    <!-- Search Input -->
                    <div class="lg:col-span-2 relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Barang</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fa-solid fa-magnifying-glass text-blue-500"></i>
                            </div>
                            <input type="text" 
                                name="search" 
                                value="{{ request('search') }}" 
                                placeholder="Cari nama barang atau kode..."
                                class="w-full pl-12 pr-4 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="kategori" 
                                class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all appearance-none cursor-pointer bg-white">
                            <option value="">Semua Kategori</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Condition Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi</label>
                        <select name="kondisi" 
                                class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all appearance-none cursor-pointer bg-white">
                            <option value="">Semua Kondisi</option>
                            <option value="baik" {{ request('kondisi') == 'baik' ? 'selected' : '' }}>Baik</option>
                            <option value="cukup" {{ request('kondisi') == 'cukup' ? 'selected' : '' }}>Cukup</option>
                            <option value="rusak ringan" {{ request('kondisi') == 'rusak ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        </select>
                    </div>
                </div>

                <!-- Sort & Items Per Page -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4">
                    <!-- Sort -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                        <select name="sort" 
                                class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all appearance-none cursor-pointer bg-white">
                            <option value="nama_barang">Nama A-Z</option>
                            <option value="harga_sewa" {{ request('sort') == 'harga_sewa' ? 'selected' : '' }}>Harga Terendah</option>
                            <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Terbaru</option>
                        </select>
                    </div>

                    <!-- Items Per Page -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tampilkan</label>
                        <select name="per_page" 
                                class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all appearance-none cursor-pointer bg-white">
                            <option value="12" {{ request('per_page', 12) == 12 ? 'selected' : '' }}>12 Item</option>
                            <option value="24" {{ request('per_page') == 24 ? 'selected' : '' }}>24 Item</option>
                            <option value="36" {{ request('per_page') == 36 ? 'selected' : '' }}>36 Item</option>
                            <option value="48" {{ request('per_page') == 48 ? 'selected' : '' }}>48 Item</option>
                            <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Semua Item</option>
                        </select>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3">
                    <button type="submit" 
                            id="filterButton" 
                            class="group relative w-full md:w-auto inline-flex justify-center items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
                        <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-xl"></div>
                        
                        <!-- Normal State -->
                        <span class="filter-normal relative inline-flex items-center">
                            <i class="fas fa-search mr-2 group-hover:scale-110 transition-transform"></i>
                            Terapkan Filter
                        </span>
                        
                        <!-- Loading State -->
                        <span class="filter-loading hidden items-center">
                            <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Memproses...
                        </span>
                    </button>
                    
                    <a href="{{ route('user.barang') }}" 
                    class="group relative w-full md:w-auto inline-flex justify-center items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-xl transition-all duration-300 overflow-hidden">
                        <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-blue-500/5 to-indigo-500/5 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                        <i class="relative fas fa-redo mr-2 text-gray-600 group-hover:text-blue-600 group-hover:rotate-180 transition-all duration-500"></i>
                        <span class="relative">Reset Filter</span>
                    </a>
                </div>

                <!-- Active Filters Section -->
                @if(request()->hasAny(['search', 'kategori', 'kondisi', 'sort']))
                    <div class="mt-5 pt-5 border-t-2 border-gray-200">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-sm font-semibold text-gray-700 mr-1">Filter aktif:</span>
                            
                            @if(request('search'))
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-100 text-blue-700 text-xs font-medium rounded-lg border border-blue-200">
                                    <span class="font-semibold">Pencarian:</span>
                                    <span class="max-w-[150px] truncate">{{ request('search') }}</span>
                                </span>
                            @endif
                            
                            @if(request('kategori'))
                                @php
                                    $selectedKat = $kategori->firstWhere('id', request('kategori'));
                                @endphp
                                @if($selectedKat)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-100 text-indigo-700 text-xs font-medium rounded-lg border border-indigo-200">
                                        <span class="font-semibold">Kategori:</span>
                                        <span>{{ $selectedKat->nama_kategori }}</span>
                                    </span>
                                @endif
                            @endif
                            
                            @if(request('kondisi'))
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-100 text-green-700 text-xs font-medium rounded-lg border border-green-200">
                                    <span class="font-semibold">Kondisi:</span>
                                    <span>{{ ucfirst(request('kondisi')) }}</span>
                                </span>
                            @endif
                            
                            @if(request('sort') && request('sort') != 'nama_barang')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-purple-100 text-purple-700 text-xs font-medium rounded-lg border border-purple-200">
                                    <span class="font-semibold">Urutan:</span>
                                    <span>
                                        @if(request('sort') == 'harga_sewa')
                                            Harga Terendah
                                        @elseif(request('sort') == 'created_at')
                                            Terbaru
                                        @else
                                            {{ request('sort') }}
                                        @endif
                                    </span>
                                </span>
                            @endif
                            
                            @if(request('per_page') && request('per_page') != '12')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-100 text-amber-700 text-xs font-medium rounded-lg border border-amber-200">
                                    <span class="font-semibold">Tampilan:</span>
                                    <span>
                                        @if(request('per_page') == 'all')
                                            Semua Item
                                        @else
                                            {{ request('per_page') }} Item
                                        @endif
                                    </span>
                                </span>
                            @endif
                            
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-lg border border-indigo-200">
                                {{ $barang->total() }} hasil ditemukan
                            </span>
                        </div>
                    </div>
                @endif
            </form>
        </div>

        <!-- Results Info -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6" data-aos="fade-up">
            <div>
                <p class="text-slate-700 text-lg">
                    Menampilkan 
                    <span class="font-bold text-blue-600">
                        @if(request('per_page') == 'all')
                            {{ $barang->total() }}
                        @else
                            {{ ($barang->currentPage() - 1) * $barang->perPage() + 1 }} - 
                            {{ min($barang->currentPage() * $barang->perPage(), $barang->total()) }}
                        @endif
                    </span> 
                    dari <span class="font-bold">{{ $barang->total() }}</span> produk
                    @if(request('per_page') && request('per_page') != 'all' && request('per_page') != '12')
                        <span class="text-sm text-slate-500">({{ request('per_page') }} per halaman)</span>
                    @endif
                </p>
                @if(request('search'))
                    <p class="text-sm text-slate-500 mt-1">
                        Hasil pencarian "<span class="text-blue-600 font-semibold">{{ request('search') }}</span>"
                    </p>
                @endif
            </div>
            
            <!-- Quick Stats Badge -->
            @if(request('per_page') != 'all' && $barang->lastPage() > 1)
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl text-sm">
                    <i class="fa-solid fa-layer-group text-blue-600"></i>
                    <span class="font-semibold text-slate-700">
                        Hal. {{ $barang->currentPage() }} dari {{ $barang->lastPage() }}
                    </span>
                </span>
            </div>
            @endif
        </div>

        <!-- Products Grid -->
        @if($barang->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @foreach($barang as $item)
            <div class="product-card relative group bg-white rounded-2xl border border-slate-200 overflow-hidden hover:border-blue-300 hover:shadow-xl transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index * 30 }}">
                <!-- Image Section -->
                <div class="product-image-wrapper relative h-56 bg-gradient-to-br from-slate-50 to-slate-100">
                    <!-- Image Container -->
                    <div class="w-full h-full overflow-hidden rounded-t-2xl">
                        @if($item->fotoPrimary)
                            <img src="{{ asset('storage/' . $item->fotoPrimary->foto) }}" 
                                alt="{{ $item->nama_barang }}" 
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                loading="lazy">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fa-solid fa-box text-5xl text-slate-300 animate-float"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Hover Overlay dengan Gradient -->
                    <div class="hover-overlay absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none rounded-t-2xl"></div>

                    <!-- Quick View Button - FIXED POSITION -->
                    <div class="absolute top-3 right-3 z-30">
                        <button onclick="event.stopPropagation(); quickView({{ $item->id }})" 
                                type="button"
                                title="Quick View"
                                class="quick-view-btn w-10 h-10 bg-white backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 hover:bg-blue-50 hover:scale-110 shadow-lg cursor-pointer">
                            <i class="fa-solid fa-eye text-blue-600 text-lg"></i>
                        </button>
                    </div>

                    <!-- Stock Badge -->
                    <div class="absolute bottom-3 left-3 z-20 pointer-events-none">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-white/90 backdrop-blur-sm text-slate-700 border border-slate-200 shadow-md">
                            <i class="fa-solid fa-cube text-blue-600"></i>
                            <span>{{ $item->jumlah_tersedia }}</span>
                        </span>
                    </div>

                    <!-- Status Badge -->
                    <div class="absolute top-3 left-3 z-20 pointer-events-none">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg">
                            <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                            Tersedia
                        </span>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="p-5 space-y-3">
                    <!-- Category Tag -->
                    @if($item->kategori)
                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 transition-colors">
                            {{ $item->kategori->nama_kategori }}
                        </span>
                    @endif

                    <!-- Product Title -->
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-600 transition-colors line-clamp-2 min-h-[3.5rem]">
                        {{ $item->nama_barang }}
                    </h3>

                    <!-- Description -->
                    <p class="text-sm text-slate-600 line-clamp-2 min-h-[2.5rem]">
                        {{ $item->deskripsi ?: 'Barang berkualitas premium dengan standar profesional terbaik.' }}
                    </p>

                    <!-- Info Tags -->
                    <div class="flex flex-wrap gap-2">
                        @if($item->kondisi)
                        <span class="inline-flex items-center gap-1 text-xs px-2.5 py-1 rounded-lg bg-slate-50 text-slate-700 border border-slate-200 hover:bg-emerald-50 hover:border-emerald-200 transition-all">
                            <i class="fa-solid fa-check-circle text-emerald-500"></i>
                            {{ ucfirst($item->kondisi) }}
                        </span>
                        @endif
                        @if($item->lokasi)
                        <span class="inline-flex items-center gap-1 text-xs px-2.5 py-1 rounded-lg bg-slate-50 text-slate-700 border border-slate-200 hover:bg-blue-50 hover:border-blue-200 transition-all">
                            <i class="fa-solid fa-location-dot text-blue-500"></i>
                            <span class="truncate max-w-[100px]">{{ $item->lokasi }}</span>
                        </span>
                        @endif
                    </div>

                    <!-- Price Section -->
                    <div class="pt-3 border-t border-slate-200">
                        @if($item->harga_sewa > 0)
                            <div class="flex items-baseline gap-1">
                                <span class="text-2xl font-bold text-blue-600">
                                    Rp{{ number_format($item->harga_sewa, 0, ',', '.') }}
                                </span>
                                <span class="text-xs text-slate-500 font-medium">/hari</span>
                            </div>
                        @else
                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-gradient-to-r from-emerald-100 to-green-100 border border-emerald-200">
                                <i class="fa-solid fa-gift text-emerald-600"></i>
                                <span class="text-lg font-bold text-emerald-600">GRATIS</span>
                            </div>
                        @endif
                    </div>

                    <!-- Quantity Selector -->
                    <div class="flex items-center justify-center gap-3 bg-slate-50 rounded-xl p-2 border border-slate-200 hover:border-blue-300 transition-all">
                        <button type="button" 
                                onclick="decreaseQty({{ $item->id }})" 
                                class="qty-btn w-8 h-8 rounded-lg bg-white border border-slate-300 flex items-center justify-center hover:bg-blue-50 hover:border-blue-400 transition-all z-10">
                            <i class="fa-solid fa-minus text-slate-600 text-xs"></i>
                        </button>
                        <input type="number" 
                               id="qty-{{ $item->id }}" 
                               value="1" 
                               min="1" 
                               max="{{ $item->jumlah_tersedia }}"
                               class="w-16 text-center font-bold text-slate-900 bg-transparent border-none focus:outline-none"
                               readonly>
                        <button type="button" 
                                onclick="increaseQty({{ $item->id }}, {{ $item->jumlah_tersedia }})" 
                                class="qty-btn w-8 h-8 rounded-lg bg-white border border-slate-300 flex items-center justify-center hover:bg-blue-50 hover:border-blue-400 transition-all z-10">
                            <i class="fa-solid fa-plus text-slate-600 text-xs"></i>
                        </button>
                    </div>

                    <!-- Action Buttons -->
                    <div class="grid grid-cols-2 gap-2">
                        <button onclick="addToCart({{ $item->id }})" 
                                type="button"
                                class="action-btn px-4 py-2.5 rounded-xl font-semibold text-sm bg-slate-100 hover:bg-slate-200 text-slate-900 border border-slate-200 hover:border-blue-300 transition-all z-10 hover:shadow-md active:scale-95">
                            <i class="fa-solid fa-cart-plus text-blue-600 mr-1"></i>Keranjang
                        </button>

                        <button onclick="orderNow({{ $item->id }})" 
                                type="button"
                                class="action-btn px-4 py-2.5 rounded-xl font-semibold text-sm bg-gradient-to-r from-blue-600 to-indigo-600 text-white hover:from-blue-700 hover:to-indigo-700 hover:shadow-xl transition-all z-10 active:scale-95 hover:-translate-y-0.5">
                            <i class="fa-solid fa-shopping-cart mr-1"></i>Pesan
                        </button>
                    </div>

                    <!-- Detail Link -->
                    <a href="{{ route('user.barang.detail', $item->id) }}" 
                       class="block text-center text-sm text-blue-600 hover:text-blue-800 font-medium transition-colors z-10 relative">
                        Lihat Detail Lengkap <i class="fa-solid fa-arrow-right ml-1 inline-block group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($barang->hasPages() && request('per_page') != 'all')
            <div id="pagination-section" class="flex flex-col items-center py-8 space-y-4" data-aos="fade-up">
                <!-- Pagination Info -->
                <div class="text-center">
                    <p class="text-sm text-slate-600">
                        Menampilkan 
                        <span class="font-bold text-blue-600">{{ ($barang->currentPage() - 1) * $barang->perPage() + 1 }}</span>
                        - 
                        <span class="font-bold text-blue-600">{{ min($barang->currentPage() * $barang->perPage(), $barang->total()) }}</span>
                        dari 
                        <span class="font-bold text-slate-900">{{ $barang->total() }}</span>
                        produk
                    </p>
                </div>

                <!-- Custom Pagination -->
                <div class="flex items-center gap-2">
                    @if ($barang->onFirstPage())
                        <button disabled 
                                class="w-10 h-10 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center cursor-not-allowed">
                            <i class="fa-solid fa-chevron-left text-sm"></i>
                        </button>
                    @else
                        <a href="{{ $barang->previousPageUrl() }}" 
                        class="group w-10 h-10 rounded-xl bg-gradient-to-br from-blue-50 to-indigo-50 hover:from-blue-600 hover:to-indigo-600 text-blue-600 hover:text-white flex items-center justify-center transition-all duration-300 shadow-sm hover:shadow-lg hover:scale-105 border border-blue-200">
                            <i class="fa-solid fa-chevron-left text-sm group-hover:-translate-x-0.5 transition-transform"></i>
                        </a>
                    @endif

                    @foreach ($barang->getUrlRange(1, $barang->lastPage()) as $page => $url)
                        @if ($page == $barang->currentPage())
                            <button class="relative w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-indigo-600 text-white font-bold flex items-center justify-center shadow-lg scale-110 overflow-hidden">
                                <span class="relative z-10">{{ $page }}</span>
                                <div class="absolute inset-0 bg-white/20 animate-pulse"></div>
                            </button>
                        @else
                            <a href="{{ $url }}" 
                            class="w-10 h-10 rounded-xl bg-white hover:bg-gradient-to-br hover:from-blue-50 hover:to-indigo-50 text-slate-700 hover:text-blue-600 font-semibold flex items-center justify-center transition-all duration-300 border border-slate-200 hover:border-blue-300 hover:shadow-md hover:scale-105">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    @if ($barang->hasMorePages())
                        <a href="{{ $barang->nextPageUrl() }}" 
                        class="group w-10 h-10 rounded-xl bg-gradient-to-br from-blue-50 to-indigo-50 hover:from-blue-600 hover:to-indigo-600 text-blue-600 hover:text-white flex items-center justify-center transition-all duration-300 shadow-sm hover:shadow-lg hover:scale-105 border border-blue-200">
                            <i class="fa-solid fa-chevron-right text-sm group-hover:translate-x-0.5 transition-transform"></i>
                        </a>
                    @else
                        <button disabled 
                                class="w-10 h-10 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center cursor-not-allowed">
                            <i class="fa-solid fa-chevron-right text-sm"></i>
                        </button>
                    @endif
                </div>

                <!-- Jump to Page (Optional - untuk banyak halaman) -->
                @if($barang->lastPage() > 5)
                <div class="flex items-center gap-3">
                    <span class="text-sm text-slate-600">Lompat ke halaman:</span>
                    <form method="GET" action="{{ route('user.barang') }}" class="flex items-center gap-2">
                        @foreach(request()->except('page') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <input type="number" 
                            name="page" 
                            min="1" 
                            max="{{ $barang->lastPage() }}" 
                            placeholder="{{ $barang->currentPage() }}"
                            class="w-16 px-3 py-2 text-center text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-semibold bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:shadow-lg transition-all hover:-translate-y-0.5">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </form>
                </div>
                @endif

                <!-- Page Info Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-slate-50 to-blue-50 border border-blue-200 rounded-full">
                    <i class="fa-solid fa-file-lines text-blue-600 text-sm"></i>
                    <span class="text-sm font-semibold text-slate-700">
                        Halaman <span class="text-blue-600">{{ $barang->currentPage() }}</span> dari <span class="text-slate-900">{{ $barang->lastPage() }}</span>
                    </span>
                </div>
            </div>
        @endif

        <!-- Scroll to Top Button - Show when per_page = all OR many items -->
        @if(request('per_page') == 'all' || $barang->count() > 12)
            <div class="flex justify-center py-4" data-aos="fade-up">
                <button onclick="scrollToTop()" 
                    id="scrollTopBtn"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-semibold hover:shadow-lg transition-all hover:-translate-y-1 group opacity-0 invisible transition-opacity duration-300">
                    <i class="fa-solid fa-arrow-up group-hover:-translate-y-1 transition-transform"></i>
                    Kembali ke Atas
                </button>
            </div>
        @endif

        @else
        <!-- Empty State -->
        <div class="text-center py-20 bg-white rounded-2xl border border-slate-200" data-aos="fade-up">
            <div class="w-24 h-24 mx-auto mb-6 bg-slate-100 rounded-full flex items-center justify-center">
                <i class="fa-solid fa-box-open text-4xl text-slate-400"></i>
            </div>
            
            <h3 class="text-2xl font-bold text-slate-900 mb-3">Tidak Ada Produk Ditemukan</h3>
            <p class="text-slate-600 mb-8 max-w-md mx-auto">
                Maaf, kami tidak menemukan produk yang sesuai dengan kriteria pencarian Anda.
            </p>
            
            <a href="{{ route('user.barang') }}" 
               class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-semibold hover:shadow-lg transition-all">
                <i class="fa-solid fa-rotate-right"></i>
                Reset Semua Filter
            </a>
        </div>
        @endif
    </div>
</div>

<!-- Quick View Modal -->
<div id="quickViewModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 backdrop-blur-sm" onclick="closeQuickView()">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="relative bg-white rounded-3xl shadow-2xl max-w-4xl w-full p-8" onclick="event.stopPropagation()">
            <button onclick="closeQuickView()" 
                    type="button"
                    class="absolute top-6 right-6 w-10 h-10 bg-slate-100 hover:bg-slate-200 rounded-full flex items-center justify-center transition-all z-10">
                <i class="fa-solid fa-times text-slate-600"></i>
            </button>

            <div id="quickViewContent" class="grid md:grid-cols-2 gap-8">
                <!-- Dynamic content -->
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* ========================================
   HERO ANIMATIONS - Dashboard Style
   ======================================== */
@keyframes blob {
    0%, 100% { transform: translate(0, 0) scale(1); }
    25% { transform: translate(20px, -20px) scale(1.1); }
    50% { transform: translate(-20px, 20px) scale(0.9); }
    75% { transform: translate(20px, 20px) scale(1.05); }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

@keyframes gradient-text {
    0%, 100% { 
        background-position: 0% 50%; 
    }
    50% { 
        background-position: 100% 50%; 
    }
}

.animate-gradient-text {
    background-size: 200% 200%;
    animation: gradient-text 5s ease infinite;
}

/* Additional Hero Icon Animations */
@keyframes ping-slow {
    0%, 100% {
        transform: scale(1);
        opacity: 0.5;
    }
    50% {
        transform: scale(1.1);
        opacity: 0.2;
    }
}

@keyframes ping-slower {
    0%, 100% {
        transform: scale(1);
        opacity: 0.3;
    }
    50% {
        transform: scale(1.15);
        opacity: 0.1;
    }
}

@keyframes pulse-slow {
    0%, 100% {
        opacity: 0.8;
    }
    50% {
        opacity: 0.5;
    }
}

.animate-ping-slow {
    animation: ping-slow 3s cubic-bezier(0, 0, 0.2, 1) infinite;
}

.animate-ping-slower {
    animation: ping-slower 4s cubic-bezier(0, 0, 0.2, 1) infinite;
}

.animate-pulse-slow {
    animation: pulse-slow 3s ease-in-out infinite;
}

/* Flying Cart Animation - Optimized for Mobile */
@keyframes flyToCart {
    0% {
        transform: translate(0, 0) scale(1) rotate(0deg);
        opacity: 1;
    }
    30% {
        transform: translate(calc(var(--tx) * 0.3), calc(var(--ty) * 0.3)) scale(0.8) rotate(10deg);
        opacity: 0.9;
    }
    70% {
        transform: translate(calc(var(--tx) * 0.7), calc(var(--ty) * 0.7)) scale(0.4) rotate(20deg);
        opacity: 0.6;
    }
    100% {
        transform: translate(var(--tx), var(--ty)) scale(0) rotate(30deg);
        opacity: 0;
    }
}

.flying-item {
    position: fixed;
    z-index: 9999;
    pointer-events: none;
    animation: flyToCart 1s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    box-shadow: 0 10px 40px rgba(59, 130, 246, 0.4);
    border: 2px solid rgba(59, 130, 246, 0.5);
}

/* Mobile optimization for flying animation */
@media (max-width: 768px) {
    @keyframes flyToCart {
        0% {
            transform: translate(0, 0) scale(1);
            opacity: 1;
        }
        40% {
            transform: translate(calc(var(--tx) * 0.4), calc(var(--ty) * 0.4)) scale(0.7);
            opacity: 0.8;
        }
        100% {
            transform: translate(var(--tx), var(--ty)) scale(0.1);
            opacity: 0;
        }
    }
    
    .flying-item {
        animation-duration: 0.9s;
        border-width: 3px;
    }
}

/* Button Click Effect */
@keyframes buttonPulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(0.95);
    }
    100% {
        transform: scale(1);
    }
}

.btn-clicked,
.modal-action-btn:active {
    animation: buttonPulse 0.3s ease;
}

/* Cart Badge Bounce */
@keyframes badgeBounce {
    0%, 100% {
        transform: scale(1);
    }
    25% {
        transform: scale(1.3);
    }
    50% {
        transform: scale(0.9);
    }
    75% {
        transform: scale(1.15);
    }
}

.badge-bounce {
    animation: badgeBounce 0.5s ease;
}

/* Success Ripple Effect */
@keyframes successRipple {
    0% {
        transform: scale(0);
        opacity: 0.8;
    }
    100% {
        transform: scale(2.5);
        opacity: 0;
    }
}

.success-ripple {
    position: absolute;
    inset: 0;
    border-radius: inherit;
    background: rgba(34, 197, 94, 0.4);
    animation: successRipple 0.6s ease-out;
    pointer-events: none;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

@keyframes pulse-ring {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7); }
    50% { transform: scale(1); box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
}

/* Hero Animations - NEW CLEAN ANIMATIONS */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes scaleIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes bounce-subtle {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

@keyframes rotate-slow {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@keyframes gradient-shift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

/* Hero Icon Animations - Enhanced */
@keyframes spin-slow {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

@keyframes spin-reverse {
    from { transform: rotate(360deg); }
    to { transform: rotate(0deg); }
}

@keyframes gradient-rotate {
    0% { transform: rotate(0deg) scale(1); }
    50% { transform: rotate(180deg) scale(1.1); }
    100% { transform: rotate(360deg) scale(1); }
}

@keyframes gradient-x {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.animate-spin-slow {
    animation: spin-slow 20s linear infinite;
}

.animate-spin-reverse {
    animation: spin-reverse 15s linear infinite;
}

.animate-gradient-rotate {
    animation: gradient-rotate 8s ease-in-out infinite;
}

.animate-gradient-x {
    background-size: 200% 200%;
    animation: gradient-x 3s ease infinite;
}

/* Modern Hover Overlay - seperti Tokopedia/Shopee */
@keyframes gradient-move {
    0% {
        background-position: 0% 0%;
    }
    100% {
        background-position: 200% 0%;
    }
}

.hover-overlay {
    background: linear-gradient(
        135deg,
        transparent 0%,
        rgba(59, 130, 246, 0.08) 50%,
        transparent 100%
    );
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

.animate-pulse-ring {
    animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

.animate-bounce-subtle {
    animation: bounce-subtle 2s ease-in-out infinite;
}

.animate-rotate-slow {
    animation: rotate-slow 20s linear infinite;
}

.animate-gradient-shift {
    background-size: 200% 200%;
    animation: gradient-shift 3s ease infinite;
}

/* Hero Animation Classes - NEW */
.hero-badge {
    animation: fadeInUp 0.6s ease-out 0.2s both;
}

.hero-title {
    animation: fadeInUp 0.6s ease-out 0.4s both;
}

.hero-description {
    animation: fadeInUp 0.6s ease-out 0.6s both;
}

.hero-wave {
    animation: fadeIn 0.8s ease-out 0.3s both;
}

/* Card Hover Effects - Modern E-commerce Style */
.product-card {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
}

.product-card:hover {
    transform: translateY(-8px);
}

/* Animated Border Gradient */
.product-card::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 1rem;
    padding: 2px;
    background: linear-gradient(135deg, #3B82F6, #6366F1, #8B5CF6);
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    opacity: 0;
    transition: opacity 0.4s ease;
    pointer-events: none;
}

.product-card:hover::before {
    opacity: 1;
}

/* Image Zoom Effect */
.product-image-wrapper {
    position: relative;
}

.product-image-wrapper > div:first-child {
    overflow: hidden;
}

.product-image-wrapper::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
    opacity: 0;
    transition: opacity 0.4s ease;
    pointer-events: none;
}

.product-card:hover .product-image-wrapper::after {
    opacity: 1;
}

/* Button Styles - Fix untuk z-index dan pointer events */
.action-btn,
.qty-btn {
    position: relative;
    cursor: pointer;
    pointer-events: auto;
    transform: translateZ(0);
}

.quick-view-btn {
    position: relative;
    cursor: pointer !important;
    pointer-events: auto !important;
}

.action-btn:hover {
    transform: translateY(-2px);
}

.action-btn:active,
.qty-btn:active {
    transform: scale(0.95);
}

.quick-view-btn:hover {
    transform: scale(1.15) !important;
}

/* Enhanced Button Hover Effects */
.action-btn {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.action-btn:hover {
    box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.3);
}

/* Line Clamp */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    overflow: hidden;
}

/* Quantity Input */
.qty-input::-webkit-inner-spin-button,
.qty-input::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type=number] {
    -moz-appearance: textfield;
}

/* Toast Animations - Bottom Position */
@keyframes slide-in-up {
    from {
        transform: translateY(100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

@keyframes fade-out-down {
    to {
        opacity: 0;
        transform: translateY(20px);
    }
}

.animate-slide-in-up {
    animation: slide-in-up 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.animate-fade-out-down {
    animation: fade-out-down 0.3s ease-out forwards;
}

/* Toast positioning - Bottom center to not block flying animation */
.toast-notification {
    position: fixed;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    z-index: 9998;
    max-width: calc(100vw - 2rem);
}

@media (max-width: 768px) {
    .toast-notification {
        bottom: 6rem;
        left: 1rem;
        right: 1rem;
        transform: none;
        max-width: none;
    }
}

/* Search Input Focus Effect */
input:focus {
    animation: pulse-ring 1.5s ease-out;
}

/* Badge Animations */
.badge-glow {
    position: relative;
}

.badge-glow::before {
    content: '';
    position: absolute;
    inset: -2px;
    border-radius: inherit;
    background: linear-gradient(45deg, #3B82F6, #6366F1, #8B5CF6, #3B82F6);
    background-size: 300% 300%;
    animation: gradient-shift 3s ease infinite;
    opacity: 0.5;
    filter: blur(8px);
    z-index: -1;
}

/* Modal Animations */
@keyframes modal-fade-in {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.modal-content {
    animation: modal-fade-in 0.3s ease-out;
}

/* Decorative Elements Animation */
.decorative-blob {
    animation: float 6s ease-in-out infinite;
}

.decorative-blob:nth-child(2) {
    animation-delay: 2s;
}

.decorative-blob:nth-child(3) {
    animation-delay: 4s;
}

/* Modal Thumbnail Active State */
.modal-thumbnail.active {
    border-color: #3B82F6 !important;
}

/* Modal Image Transition */
#modalMainImage {
    transition: opacity 0.3s ease-in-out;
}

/* Modal Lightbox */
.modal-lightbox {
    backdrop-filter: blur(10px);
}

.modal-lightbox img {
    animation: modalZoomIn 0.4s ease-out;
}

.filter-normal,
.filter-loading {
    transition: all 0.3s ease-in-out;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: .8;
    }
}

.skeleton {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

.loading-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
}

@keyframes modalZoomIn {
    from {
        transform: scale(0.9);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    background: #F8FAFC;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, #3B82F6, #6366F1);
    border-radius: 5px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(180deg, #2563EB, #4F46E5);
}

/* Responsive */
@media (max-width: 768px) {
    .product-card:hover {
        transform: translateY(-4px);
    }
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<script>
// Initialize AOS
AOS.init({
    duration: 600,
    once: true,
    offset: 50,
    easing: 'ease-out-cubic'
});

// Initialize - Clean hero animation
document.addEventListener('DOMContentLoaded', function() {
    updateCartBadge();
    initParallaxEffect();
    initFilterLoading();      
    initPerPageAutoSubmit();
    
    autoScrollAfterFilter();
    autoScrollAfterPagination();
    
    // ESC to close modal
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeQuickView();
    });
});

// Parallax effect for decorative elements
function initParallaxEffect() {
    let ticking = false;
    
    window.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                const scrolled = window.pageYOffset;
                const decorativeElements = document.querySelectorAll('.decorative-blob');
                
                decorativeElements.forEach((element, index) => {
                    const speed = 0.05 + (index * 0.02);
                    element.style.transform = `translateY(${scrolled * speed}px)`;
                });
                
                ticking = false;
            });
            ticking = true;
        }
    });
}

// Add stagger animation for product cards
function staggerAnimation() {
    const cards = document.querySelectorAll('.product-card');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.05}s`;
    });
}

// Call stagger animation
setTimeout(staggerAnimation, 100);

// ========================================
// QUANTITY MANAGEMENT
// ========================================

function increaseQty(itemId, maxStock) {
    const input = document.getElementById(`qty-${itemId}`);
    if (!input) return;
    
    let currentVal = parseInt(input.value) || 1;
    if (currentVal < maxStock) {
        input.value = currentVal + 1;
    } else {
        showToast(`Stok maksimal ${maxStock} unit`, 'warning');
    }
}

function decreaseQty(itemId) {
    const input = document.getElementById(`qty-${itemId}`);
    if (!input) return;
    
    let currentVal = parseInt(input.value) || 1;
    if (currentVal > 1) {
        input.value = currentVal - 1;
    }
}

function increaseQtyModal(maxStock) {
    const input = document.getElementById('qtyModal');
    if (!input) return;
    
    let currentVal = parseInt(input.value) || 1;
    if (currentVal < maxStock) {
        input.value = currentVal + 1;
    } else {
        showToast(`Stok maksimal ${maxStock} unit`, 'warning');
    }
}

function decreaseQtyModal() {
    const input = document.getElementById('qtyModal');
    if (!input) return;
    
    let currentVal = parseInt(input.value) || 1;
    if (currentVal > 1) {
        input.value = currentVal - 1;
    }
}

// ========================================
// CART OPERATIONS
// ========================================

function addToCart(itemId) {
    const qtyInput = document.getElementById(`qty-${itemId}`);
    if (!qtyInput) return;
    
    const qty = parseInt(qtyInput.value);
    if (!qty || qty < 1) {
        showToast('Jumlah tidak valid', 'warning');
        return;
    }
    
    // Get button element for animation
    const button = event.currentTarget;
    const card = button.closest('.product-card');
    const productImage = card.querySelector('img');
    
    // Button click animation
    button.classList.add('btn-clicked');
    setTimeout(() => button.classList.remove('btn-clicked'), 300);
    
    // Success ripple effect
    const ripple = document.createElement('div');
    ripple.className = 'success-ripple';
    button.style.position = 'relative';
    button.appendChild(ripple);
    setTimeout(() => ripple.remove(), 600);
    
    fetch(`/api/barang/${itemId}`)
        .then(response => response.json())
        .then(result => {
            if (!result.success) throw new Error(result.message);
            
            const data = result.data;
            let cart = loadCart();
            const existingIndex = cart.findIndex(item => item.id === itemId);
            
            if (existingIndex > -1) {
                const newQty = cart[existingIndex].quantity + qty;
                if (newQty <= data.jumlah_tersedia) {
                    cart[existingIndex].quantity = newQty;
                    showToast(`Jumlah diperbarui menjadi ${newQty}`, 'success');
                } else {
                    showToast(`Stok tidak mencukupi! Maksimal ${data.jumlah_tersedia}`, 'warning');
                    return;
                }
            } else {
                cart.push({
                    id: data.id,
                    kode_barang: data.kode_barang,
                    nama_barang: data.nama_barang,
                    harga_sewa: data.harga_sewa,
                    jumlah_tersedia: data.jumlah_tersedia,
                    quantity: qty,
                    foto: data.foto,
                    kategori: data.kategori || '',
                    kondisi: data.kondisi || ''
                });
                
                // ✨ FLYING ANIMATION - Execute first
                createFlyingItem(productImage, itemId);
                
                // Show success toast after animation starts (delayed)
                setTimeout(() => {
                    showToast(`Berhasil menambahkan ${qty} item!`, 'success');
                }, 400);
            }
            
            saveCart(cart);
            qtyInput.value = 1;
            updateCartBadge();
            
            // Badge bounce animation
            const badges = [
                document.getElementById('cart-badge'),
                document.getElementById('cart-badge-mobile')
            ];
            badges.forEach(badge => {
                if (badge && !badge.classList.contains('hidden')) {
                    badge.classList.add('badge-bounce');
                    setTimeout(() => badge.classList.remove('badge-bounce'), 500);
                }
            });
        })
        .catch(error => {
            showToast(error.message || 'Gagal menambahkan ke keranjang', 'error');
        });
}

// ✨ CREATE FLYING ITEM ANIMATION - FIXED FOR MOBILE
function createFlyingItem(imageElement, itemId) {
    if (!imageElement) return;
    
    // Clone image
    const flyingImg = imageElement.cloneNode(true);
    flyingImg.className = 'flying-item';
    
    // Get positions
    const imgRect = imageElement.getBoundingClientRect();
    
    // Find cart icon - PRIORITIZE VISIBLE ELEMENTS
    let cartIcon = null;
    
    // Try multiple selectors in order of priority
    const selectors = [
        // Mobile bottom nav (common pattern)
        '.mobile-nav a[href*="cart"]',
        '.mobile-nav a[href*="keranjang"]',
        '.bottom-nav a[href*="cart"]',
        '.bottom-nav a[href*="keranjang"]',
        // Fixed bottom elements
        '.fixed.bottom-0 a[href*="cart"]',
        '.fixed.bottom-0 a[href*="keranjang"]',
        // Top navbar
        'nav a[href*="cart"]',
        'nav a[href*="keranjang"]',
        // General selectors
        'a[href*="cart"] i.fa-cart-shopping',
        'a[href*="keranjang"] i.fa-cart-shopping',
        'a[href*="cart"]',
        'a[href*="keranjang"]'
    ];
    
    // Find all cart elements and filter only visible ones
    const cartElements = [];
    for (const selector of selectors) {
        const elements = document.querySelectorAll(selector);
        elements.forEach(el => {
            const rect = el.getBoundingClientRect();
            // Check if element is visible in viewport
            if (rect.width > 0 && rect.height > 0 && 
                rect.top >= 0 && rect.left >= 0 &&
                rect.bottom <= window.innerHeight && 
                rect.right <= window.innerWidth) {
                cartElements.push({ element: el, selector, rect });
            }
        });
    }
    
    if (cartElements.length > 0) {
        // Use the first visible cart icon
        cartIcon = cartElements[0].element;
    } else {
        // Fallback: find any cart link even if hidden
        for (const selector of selectors) {
            cartIcon = document.querySelector(selector);
            if (cartIcon) break;
        }
        
        if (!cartIcon) return;
    }
    
    // Get cart icon's position - prefer child icon if exists
    const cartIconElement = cartIcon.querySelector('i') || cartIcon;
    const cartRect = cartIconElement.getBoundingClientRect();
    
    // Calculate translation with better accuracy
    const startX = imgRect.left + (imgRect.width / 2);
    const startY = imgRect.top + (imgRect.height / 2);
    const endX = cartRect.left + (cartRect.width / 2);
    const endY = cartRect.top + (cartRect.height / 2);
    
    const translateX = endX - startX;
    const translateY = endY - startY;
    
    // Set CSS variables for animation
    flyingImg.style.setProperty('--tx', `${translateX}px`);
    flyingImg.style.setProperty('--ty', `${translateY}px`);
    
    // Responsive sizing
    const size = window.innerWidth < 768 ? 80 : 100;
    
    // Style the flying item
    flyingImg.style.width = `${size}px`;
    flyingImg.style.height = `${size}px`;
    flyingImg.style.left = `${imgRect.left + (imgRect.width / 2) - (size / 2)}px`;
    flyingImg.style.top = `${imgRect.top + (imgRect.height / 2) - (size / 2)}px`;
    flyingImg.style.borderRadius = '16px';
    flyingImg.style.objectFit = 'cover';
    
    document.body.appendChild(flyingImg);
    
    // Add particle effect at end point
    setTimeout(() => {
        createCartBurst(cartRect);
    }, 700);
    
    // Remove after animation
    const duration = window.innerWidth < 768 ? 900 : 1000;
    setTimeout(() => flyingImg.remove(), duration);
}

// ✨ CREATE BURST EFFECT AT CART
function createCartBurst(cartRect) {
    const burst = document.createElement('div');
    burst.style.cssText = `
        position: fixed;
        left: ${cartRect.left + cartRect.width / 2}px;
        top: ${cartRect.top + cartRect.height / 2}px;
        width: 10px;
        height: 10px;
        background: radial-gradient(circle, #3B82F6, transparent);
        border-radius: 50%;
        pointer-events: none;
        z-index: 9999;
        animation: burstEffect 0.5s ease-out;
    `;
    
    // Add burst animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes burstEffect {
            0% { transform: scale(0); opacity: 1; }
            100% { transform: scale(8); opacity: 0; }
        }
    `;
    document.head.appendChild(style);
    
    document.body.appendChild(burst);
    setTimeout(() => {
        burst.remove();
        style.remove();
    }, 500);
}

function loadCart() {
    try {
        return JSON.parse(localStorage.getItem('pelita_cart') || '[]');
    } catch {
        return [];
    }
}

function saveCart(cart) {
    localStorage.setItem('pelita_cart', JSON.stringify(cart));
}

function updateCartBadge() {
    const cart = loadCart();
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    
    const badge = document.getElementById('cart-badge');
    if (badge) {
        badge.textContent = totalItems;
        badge.style.display = totalItems > 0 ? 'flex' : 'none';
    }
}

function orderNow(itemId) {
    const qtyInput = document.getElementById(`qty-${itemId}`);
    const qty = qtyInput ? parseInt(qtyInput.value) : 1;
    window.location.href = `/permohonan/create?barang_id=${itemId}&qty=${qty}`;
}

// ========================================
// QUICK VIEW MODAL
// ========================================

function quickView(itemId) {
    const modal = document.getElementById('quickViewModal');
    const content = document.getElementById('quickViewContent');
    
    if (!modal || !content) return;
    
    modal.classList.remove('hidden');
    content.innerHTML = `
        <div class="col-span-2 flex items-center justify-center py-20">
            <div class="text-center">
                <div class="animate-spin w-12 h-12 border-4 border-blue-500 border-t-transparent rounded-full mx-auto mb-4"></div>
                <p class="text-slate-600">Memuat...</p>
            </div>
        </div>
    `;
    
    fetch(`/api/barang/${itemId}`)
        .then(response => response.json())
        .then(result => {
            if (!result.success) throw new Error(result.message);
            
            // DEBUGGING: Lihat struktur data
            console.log('Data barang:', result.data);
            console.log('Fotos array:', result.data.fotos);
            
            content.innerHTML = generateQuickViewHTML(result.data);
        })
        .catch(error => {
            content.innerHTML = `
                <div class="col-span-2 text-center py-20">
                    <i class="fa-solid fa-exclamation-circle text-5xl text-red-400 mb-4"></i>
                    <p class="text-slate-600 mb-4">${error.message}</p>
                    <button onclick="closeQuickView()" type="button" class="px-6 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700">
                        Tutup
                    </button>
                </div>
            `;
        });
}

function closeQuickView() {
    const modal = document.getElementById('quickViewModal');
    if (modal) modal.classList.add('hidden');
}

function generateQuickViewHTML(data) {
    const formatPrice = (price) => new Intl.NumberFormat('id-ID').format(price);
    
    // Handle foto - bisa dari foto langsung atau foto_primary
    let fotoUrl = '/images/no-image.png';
    if (data.foto) {
        fotoUrl = data.foto;
    } else if (data.foto_primary) {
        fotoUrl = data.foto_primary;
    } else if (data.fotos && data.fotos.length > 0) {
        fotoUrl = data.fotos[0].foto_url || data.fotos[0].foto;
    }
    
    return `
        <!-- Image Gallery -->
        <div class="space-y-4">
            <!-- Main Image -->
            <div class="aspect-square bg-gradient-to-br from-slate-50 to-slate-100 rounded-2xl overflow-hidden relative group">
                <img id="modalMainImage" 
                     src="${fotoUrl}" 
                     alt="${data.nama_barang}" 
                     class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                     onerror="this.src='/images/no-image.png'">
                ${data.fotos && data.fotos.length > 0 ? `
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 flex items-center justify-center">
                    <button onclick="openModalLightbox(0)" 
                            type="button"
                            class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full font-semibold text-slate-900 hover:bg-white flex items-center gap-2 shadow-lg">
                        <i class="fa-solid fa-expand"></i>
                        <span class="text-sm">Perbesar</span>
                    </button>
                </div>` : ''}
            </div>

            <!-- Thumbnail Gallery -->
            ${data.fotos && data.fotos.length > 1 ? `
            <div class="space-y-3">
                <div class="grid grid-cols-4 gap-2">
                    ${data.fotos.map((foto, idx) => `
                        <div class="modal-thumbnail relative aspect-square rounded-lg overflow-hidden border-2 cursor-pointer hover:border-blue-500 transition-all group ${idx === 0 ? 'border-blue-500' : 'border-slate-200'}"
                             data-modal-index="${idx}"
                             onclick="changeModalImage('${foto.foto_url || foto.foto}', ${idx})">
                            <img src="${foto.foto_url || foto.foto}" 
                                 alt="Thumbnail ${idx + 1}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            ${foto.is_primary ? `
                            <div class="absolute top-1 right-1 bg-blue-500 text-white text-xs px-1.5 py-0.5 rounded-full font-bold shadow-lg">
                                <i class="fa-solid fa-star"></i>
                            </div>` : ''}
                        </div>
                    `).join('')}
                </div>
                ${data.fotos.length > 1 ? `
                <button onclick="openModalLightbox(0)" 
                        type="button"
                        class="w-full text-sm text-blue-600 hover:text-blue-800 font-semibold flex items-center justify-center gap-2 py-2 hover:bg-blue-50 rounded-lg transition-all">
                    <i class="fa-solid fa-images"></i>
                    Lihat Semua Foto (${data.fotos.length})
                </button>` : ''}
            </div>` : ''}
        </div>

        <!-- Product Info -->
        <div class="space-y-6">
            <!-- Category Badge -->
            ${data.kategori_nama || data.kategori ? `
            <div>
                <span class="inline-block px-4 py-1.5 text-sm font-semibold rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                    ${data.kategori_nama || data.kategori}
                </span>
            </div>` : ''}

            <!-- Product Title -->
            <div>
                <h2 class="text-3xl font-bold text-slate-900 mb-2">${data.nama_barang}</h2>
                <p class="text-sm text-slate-500">Kode: ${data.kode_barang}</p>
            </div>

            <!-- Price Section -->
            <div class="py-4 border-y border-slate-200">
                ${data.harga_sewa > 0 ? `
                <div class="flex items-baseline gap-2">
                    <span class="text-4xl font-bold text-blue-600">
                        Rp${formatPrice(data.harga_sewa)}
                    </span>
                    <span class="text-base text-slate-500">/hari</span>
                </div>` : `
                <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-emerald-100 to-green-100 border-2 border-emerald-200">
                    <i class="fa-solid fa-gift text-emerald-600 text-lg"></i>
                    <span class="text-3xl font-bold text-emerald-600">GRATIS</span>
                </div>`}
            </div>

            <!-- Description -->
            ${data.deskripsi ? `
            <div>
                <h3 class="font-bold text-slate-900 mb-2">Deskripsi</h3>
                <p class="text-sm text-slate-600 leading-relaxed">${data.deskripsi}</p>
            </div>` : ''}

            <!-- Specifications Grid -->
            <div class="grid grid-cols-2 gap-4">
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <p class="text-xs text-slate-500 mb-1">Kondisi</p>
                    <p class="font-bold text-slate-900 capitalize">${data.kondisi || '-'}</p>
                </div>
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <p class="text-xs text-slate-500 mb-1">Stok Tersedia</p>
                    <p class="font-bold text-slate-900">${data.jumlah_tersedia || 0} unit</p>
                </div>
                ${data.merk ? `
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <p class="text-xs text-slate-500 mb-1">Merk</p>
                    <p class="font-bold text-slate-900">${data.merk}</p>
                </div>` : ''}
                ${data.type ? `
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <p class="text-xs text-slate-500 mb-1">Type</p>
                    <p class="font-bold text-slate-900">${data.type}</p>
                </div>` : ''}
                ${data.lokasi ? `
                <div class="col-span-2 p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <p class="text-xs text-slate-500 mb-1">Lokasi</p>
                    <p class="font-bold text-slate-900">${data.lokasi}</p>
                </div>` : ''}
            </div>

            <!-- Quantity Selector -->
            <div>
                <label class="block text-sm font-bold text-slate-900 mb-2">Jumlah</label>
                <div class="flex items-center gap-4 bg-slate-50 rounded-xl p-3 border border-slate-200">
                    <button type="button" 
                            onclick="decreaseQtyModal()" 
                            class="w-10 h-10 rounded-lg bg-white border-2 border-slate-300 flex items-center justify-center hover:bg-blue-50 hover:border-blue-400 transition-all">
                        <i class="fa-solid fa-minus text-slate-600"></i>
                    </button>
                    <input type="number" 
                           id="qtyModal" 
                           value="1" 
                           min="1" 
                           max="${data.jumlah_tersedia}"
                           class="flex-1 text-center text-xl font-bold text-slate-900 bg-transparent border-none focus:outline-none"
                           readonly>
                    <button type="button" 
                            onclick="increaseQtyModal(${data.jumlah_tersedia})" 
                            class="w-10 h-10 rounded-lg bg-white border-2 border-slate-300 flex items-center justify-center hover:bg-blue-50 hover:border-blue-400 transition-all">
                        <i class="fa-solid fa-plus text-slate-600"></i>
                    </button>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="grid grid-cols-2 gap-3">
                <button onclick="addToCartFromModal(${data.id})" 
                        type="button"
                        class="modal-action-btn px-6 py-4 rounded-xl font-semibold bg-slate-100 hover:bg-slate-200 text-slate-900 border-2 border-slate-200 hover:border-blue-400 transition-all hover:shadow-lg active:scale-95 relative overflow-hidden">
                    <i class="fa-solid fa-cart-plus mr-2"></i>Tambah ke Keranjang
                </button>
                <button onclick="orderNowFromModal(${data.id})" 
                        type="button"
                        class="modal-action-btn px-6 py-4 rounded-xl font-semibold bg-gradient-to-r from-blue-600 to-indigo-600 text-white hover:shadow-xl transition-all active:scale-95 hover:-translate-y-1">
                    <i class="fa-solid fa-shopping-cart mr-2"></i>Pesan Sekarang
                </button>
            </div>

            <!-- View Full Details Link -->
            <a href="/user/barang/${data.id}" 
               class="block text-center text-sm text-blue-600 hover:text-blue-800 font-semibold transition-colors">
                Lihat Detail Lengkap →
            </a>
        </div>
    `;
}

function addToCartFromModal(itemId) {
    const qtyInput = document.getElementById('qtyModal');
    if (!qtyInput) return;
    
    const qty = parseInt(qtyInput.value);
    
    if (!qty || qty < 1) {
        showToast('Jumlah tidak valid', 'warning');
        return;
    }
    
    // Prevent double click
    const button = event.currentTarget;
    if (button.disabled) return;
    button.disabled = true;
    button.style.opacity = '0.6';
    button.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i>Menambahkan...';
    
    // Get modal image for animation
    const modalImage = document.querySelector('#quickViewModal img');
    
    fetch(`/api/barang/${itemId}`)
        .then(response => response.json())
        .then(result => {
            if (!result.success) throw new Error(result.message);
            
            const data = result.data;
            let cart = loadCart();
            const existingIndex = cart.findIndex(item => item.id === itemId);
            
            if (existingIndex > -1) {
                const newQty = cart[existingIndex].quantity + qty;
                if (newQty <= data.jumlah_tersedia) {
                    cart[existingIndex].quantity = newQty;
                    showToast(`Jumlah diperbarui menjadi ${newQty}`, 'success');
                } else {
                    showToast(`Stok tidak mencukupi! Maksimal ${data.jumlah_tersedia}`, 'warning');
                    // Reset button
                    button.disabled = false;
                    button.style.opacity = '1';
                    button.innerHTML = '<i class="fa-solid fa-cart-plus mr-2"></i>Tambah ke Keranjang';
                    return;
                }
            } else {
                cart.push({
                    id: data.id,
                    kode_barang: data.kode_barang,
                    nama_barang: data.nama_barang,
                    harga_sewa: data.harga_sewa,
                    jumlah_tersedia: data.jumlah_tersedia,
                    quantity: qty,
                    foto: data.foto,
                    kategori: data.kategori || '',
                    kondisi: data.kondisi || ''
                });
                
                // ✨ FLYING ANIMATION from modal
                if (modalImage) {
                    createFlyingItem(modalImage, itemId);
                }
                
                // Show success toast after animation starts
                setTimeout(() => {
                    showToast(`Berhasil menambahkan ${qty} item!`, 'success');
                }, 400);
            }
            
            saveCart(cart);
            
            // Update qty input di card jika ada
            const mainQtyInput = document.getElementById(`qty-${itemId}`);
            if (mainQtyInput) mainQtyInput.value = 1;
            
            // Reset modal qty
            qtyInput.value = 1;
            
            updateCartBadge();
            
            // Badge bounce animation
            const badges = [
                document.getElementById('cart-badge'),
                document.getElementById('cart-badge-mobile')
            ];
            badges.forEach(badge => {
                if (badge && !badge.classList.contains('hidden')) {
                    badge.classList.add('badge-bounce');
                    setTimeout(() => badge.classList.remove('badge-bounce'), 500);
                }
            });
            
            // Success feedback
            button.innerHTML = '<i class="fa-solid fa-check mr-2"></i>Berhasil!';
            button.classList.add('bg-emerald-500', 'text-white');
            
            // Close modal after successful add
            setTimeout(() => closeQuickView(), 800);
        })
        .catch(error => {
            showToast(error.message || 'Gagal menambahkan ke keranjang', 'error');
            // Reset button on error
            button.disabled = false;
            button.style.opacity = '1';
            button.innerHTML = '<i class="fa-solid fa-cart-plus mr-2"></i>Tambah ke Keranjang';
        });
}

function orderNowFromModal(itemId) {
    const qtyInput = document.getElementById('qtyModal');
    const qty = qtyInput ? parseInt(qtyInput.value) : 1;
    window.location.href = `/permohonan/create?barang_id=${itemId}&qty=${qty}`;
}

// ========================================
// MODAL GALLERY FUNCTIONS
// ========================================

// Modal Gallery Variables
let modalGalleryImages = [];
let currentModalImageIndex = 0;

// Change Modal Image
function changeModalImage(imageUrl, index) {
    const mainImage = document.getElementById('modalMainImage');
    if (!mainImage) return;
    
    // Fade effect
    mainImage.style.opacity = '0';
    
    setTimeout(() => {
        mainImage.src = imageUrl;
        mainImage.style.opacity = '1';
        currentModalImageIndex = index;
        
        // Update thumbnail borders
        const thumbnails = document.querySelectorAll('.modal-thumbnail');
        thumbnails.forEach((thumb, i) => {
            if (i === index) {
                thumb.classList.remove('border-slate-200');
                thumb.classList.add('border-blue-500', 'active');
            } else {
                thumb.classList.remove('border-blue-500', 'active');
                thumb.classList.add('border-slate-200');
            }
        });
    }, 150);
}

// Open Modal Lightbox
function openModalLightbox(index) {
    // Get all modal images
    const modalImages = document.querySelectorAll('.modal-thumbnail img');
    if (modalImages.length === 0) {
        // Fallback: use main image if no thumbnails
        const mainImage = document.getElementById('modalMainImage');
        if (mainImage) {
            modalGalleryImages = [{ url: mainImage.src, alt: mainImage.alt }];
        } else {
            return;
        }
    } else {
        modalGalleryImages = Array.from(modalImages).map(img => ({
            url: img.src,
            alt: img.alt
        }));
    }
    
    currentModalImageIndex = index;
    
    // Create lightbox
    const lightbox = document.createElement('div');
    lightbox.id = 'modalLightbox';
    lightbox.className = 'fixed inset-0 bg-black/95 z-[70] flex items-center justify-center p-4 modal-lightbox';
    lightbox.onclick = (e) => {
        if (e.target === lightbox) closeModalLightbox();
    };
    
    lightbox.innerHTML = `
        <!-- Close Button -->
        <button onclick="closeModalLightbox()" 
                type="button"
                class="absolute top-4 right-4 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-all z-20 group backdrop-blur-sm">
            <i class="fa-solid fa-times text-2xl group-hover:rotate-90 transition-transform duration-300"></i>
        </button>
        
        ${modalGalleryImages.length > 1 ? `
        <!-- Previous Button -->
        <button onclick="previousModalImage(event)" 
                type="button"
                class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-all z-20 group backdrop-blur-sm">
            <i class="fa-solid fa-chevron-left text-2xl group-hover:-translate-x-1 transition-transform"></i>
        </button>
        
        <!-- Next Button -->
        <button onclick="nextModalImage(event)" 
                type="button"
                class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-all z-20 group backdrop-blur-sm">
            <i class="fa-solid fa-chevron-right text-2xl group-hover:translate-x-1 transition-transform"></i>
        </button>` : ''}
        
        <!-- Image Container -->
        <div class="max-w-6xl mx-auto px-16 flex flex-col items-center justify-center">
            <img id="modalLightboxImage" 
                 src="${modalGalleryImages[index].url}" 
                 alt="${modalGalleryImages[index].alt}" 
                 class="max-h-[80vh] object-contain rounded-2xl shadow-2xl">
            
            ${modalGalleryImages.length > 1 ? `
            <div class="text-center mt-6 space-y-2">
                <div id="modalLightboxCounter" class="text-white/70 text-sm font-medium">
                    ${index + 1} / ${modalGalleryImages.length}
                </div>
            </div>` : ''}
        </div>
    `;
    
    document.body.appendChild(lightbox);
    document.body.style.overflow = 'hidden';
}

// Close Modal Lightbox
function closeModalLightbox() {
    const lightbox = document.getElementById('modalLightbox');
    if (lightbox) {
        lightbox.remove();
        document.body.style.overflow = '';
    }
}

// Previous Modal Image
function previousModalImage(e) {
    if (e) e.stopPropagation();
    currentModalImageIndex = (currentModalImageIndex - 1 + modalGalleryImages.length) % modalGalleryImages.length;
    updateModalLightboxImage();
}

// Next Modal Image
function nextModalImage(e) {
    if (e) e.stopPropagation();
    currentModalImageIndex = (currentModalImageIndex + 1) % modalGalleryImages.length;
    updateModalLightboxImage();
}

// Update Modal Lightbox Image
function updateModalLightboxImage() {
    const image = modalGalleryImages[currentModalImageIndex];
    const lightboxImage = document.getElementById('modalLightboxImage');
    const lightboxCounter = document.getElementById('modalLightboxCounter');
    
    if (lightboxImage) {
        lightboxImage.style.opacity = '0';
        setTimeout(() => {
            lightboxImage.src = image.url;
            lightboxImage.alt = image.alt;
            lightboxImage.style.opacity = '1';
        }, 150);
    }
    
    if (lightboxCounter) {
        lightboxCounter.textContent = `${currentModalImageIndex + 1} / ${modalGalleryImages.length}`;
    }
}

// Keyboard Navigation for Modal Lightbox
document.addEventListener('keydown', function(e) {
    const modalLightbox = document.getElementById('modalLightbox');
    if (!modalLightbox) return;
    
    if (e.key === 'Escape') closeModalLightbox();
    if (e.key === 'ArrowLeft' && modalGalleryImages.length > 1) previousModalImage();
    if (e.key === 'ArrowRight' && modalGalleryImages.length > 1) nextModalImage();
});

// ========================================
// TOAST NOTIFICATION
// ========================================

function showToast(message, type = 'info') {
    const existingToast = document.querySelector('.toast-notification');
    if (existingToast) existingToast.remove();

    const config = {
        success: { color: 'from-emerald-500 to-green-500', icon: 'fa-check-circle' },
        error: { color: 'from-red-500 to-rose-500', icon: 'fa-exclamation-circle' },
        info: { color: 'from-blue-500 to-indigo-500', icon: 'fa-info-circle' },
        warning: { color: 'from-orange-500 to-red-500', icon: 'fa-exclamation-triangle' }
    };

    const { color, icon } = config[type] || config.info;

    const toast = document.createElement('div');
    toast.className = 'toast-notification fixed bottom-8 left-1/2 -translate-x-1/2 z-[60]';
    toast.innerHTML = `
        <div class="flex items-center gap-3 px-6 py-4 bg-gradient-to-r ${color} text-white rounded-2xl shadow-2xl backdrop-blur-lg border border-white/20 animate-slide-in-up">
            <i class="fa-solid ${icon} text-xl"></i>
            <span class="font-semibold">${message}</span>
        </div>
    `;

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.classList.add('animate-fade-out-down');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Filter Button Loading Animation
function initFilterLoading() {
    const filterButton = document.getElementById('filterButton');
    
    if (filterButton) {
        const filterForm = filterButton.closest('form');
        
        if (filterForm) {
            filterForm.addEventListener('submit', function(e) {
                filterButton.disabled = true;
                filterButton.classList.add('opacity-75', 'cursor-not-allowed');
                filterButton.classList.remove('hover:scale-105');
                
                const normalState = filterButton.querySelector('.filter-normal');
                const loadingState = filterButton.querySelector('.filter-loading');
                
                if (normalState && loadingState) {
                    normalState.style.display = 'none';
                    loadingState.style.display = 'inline-flex';
                }
                
                filterButton.style.animation = 'pulse 1.5s cubic-bezier(0.4, 0, 0.6, 1) infinite';
            });
        }
    }
}

// Auto submit when change per_page with loading animation
function initPerPageAutoSubmit() {
    const perPageSelect = document.querySelector('select[name="per_page"]');
    
    if (perPageSelect) {
        perPageSelect.addEventListener('change', function() {
            const form = this.closest('form');
            const filterButton = document.getElementById('filterButton');
            
            if (filterButton) {
                // Trigger loading animation
                filterButton.disabled = true;
                const normalState = filterButton.querySelector('.filter-normal');
                const loadingState = filterButton.querySelector('.filter-loading');
                
                if (normalState) normalState.style.display = 'none';
                if (loadingState) loadingState.style.display = 'inline-flex';
            }
            
            // Submit form
            if (form) form.submit();
        });
    }
}

// Function untuk scroll ke bagian produk (digunakan untuk filter & pagination)
function scrollToProductsSection() {
    setTimeout(() => {
        // Cari grid produk sebagai target scroll
        const productsGrid = document.querySelector('.grid.grid-cols-1.sm\\:grid-cols-2.lg\\:grid-cols-3.xl\\:grid-cols-4');
        
        if (productsGrid) {
            const elementPosition = productsGrid.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - 150; // offset 150px untuk navbar
            
            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
            
            console.log('✓ Auto scroll ke produk berhasil');
        } else {
            // Fallback ke #products jika grid tidak ditemukan
            const productsSection = document.getElementById('products');
            if (productsSection) {
                const elementPosition = productsSection.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - 150;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        }
    }, 400);
}

// Auto Scroll setelah Filter
function autoScrollAfterFilter() {
    const urlParams = new URLSearchParams(window.location.search);
    
    const hasFilter = urlParams.has('search') || 
                     urlParams.has('kategori') || 
                     urlParams.has('kondisi') || 
                     urlParams.has('sort');
    
    if (hasFilter) {
        scrollToProductsSection();
    }
}

// Auto Scroll setelah Pagination
function autoScrollAfterPagination() {
    const urlParams = new URLSearchParams(window.location.search);
    
    if (urlParams.has('page')) {
        scrollToProductsSection();
    }
}

// Smooth Scroll to Top
function scrollToTop() {
    const duration = 800;
    const start = window.pageYOffset;
    const startTime = performance.now();
    
    function animation(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        
        // Easing function (ease-out-cubic)
        const easeOut = 1 - Math.pow(1 - progress, 3);
        
        window.scrollTo(0, start * (1 - easeOut));
        
        if (progress < 1) {
            requestAnimationFrame(animation);
        }
    }
    
    requestAnimationFrame(animation);
}

// Show/Hide Scroll to Top Button on Scroll (Optional Enhancement)
window.addEventListener('scroll', function() {
    const scrollTopBtn = document.getElementById('scrollTopBtn');
    if (scrollTopBtn) {
        if (window.pageYOffset > 500) {
            scrollTopBtn.classList.remove('opacity-0', 'invisible');
            scrollTopBtn.classList.add('opacity-100', 'visible');
        } else {
            scrollTopBtn.classList.remove('opacity-100', 'visible');
            scrollTopBtn.classList.add('opacity-0', 'invisible');
        }
    }
});

// ========================================
// UTILITY
// ========================================

window.pelitaCart = {
    loadCart,
    saveCart,
    updateCartBadge,
    clearCart: () => {
        localStorage.removeItem('pelita_cart');
        updateCartBadge();
        showToast('Keranjang dikosongkan', 'success');
    },
    viewCart: () => console.table(loadCart())
};
</script>
@endpush