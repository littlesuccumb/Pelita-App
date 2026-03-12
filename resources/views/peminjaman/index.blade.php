@extends('layouts.user')

@section('title', 'Peminjaman Saya - Pelita App')

@section('content')
<!-- Hero Section with Gradient - Blue/Indigo Theme (SAMA DENGAN DASHBOARD) -->
<div class="relative bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-0 left-1/3 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
            <!-- Welcome Content - Left Side with Icon -->
            <div class="text-white space-y-6 relative z-10 flex-1" data-aos="fade-up">
                <div class="flex items-center gap-4 mb-6">
                    <!-- Icon Welcome (kiri atas) -->
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-white/20 to-white/5 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-2xl">
                            <i class="fas fa-clipboard-list text-white text-5xl"></i>
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-blue-500 border-4 border-blue-700/50 rounded-full flex items-center justify-center">
                            <div class="w-3 h-3 bg-blue-400 rounded-full animate-pulse"></div>
                        </div>
                    </div>
                    
                    <!-- Status Badge -->
                    <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm">
                        <div class="w-2 h-2 bg-blue-300 rounded-full mr-2 animate-pulse"></div>
                        <span><span id="total-counter-hero" data-target="{{ $peminjaman->total() }}">0</span> Peminjaman</span>
                    </div>
                </div>
                
                <div>
                    <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 leading-tight">
                        Peminjaman Saya
                    </h1>
                    <p class="text-lg md:text-xl text-blue-100 max-w-2xl">
                        Kelola dan pantau status peminjaman aset Anda di Cimahi Technopark
                    </p>
                </div>

                <!-- Quick Info -->
                <div class="flex items-center flex-wrap gap-4 text-sm text-blue-100">
                    <div class="flex items-center bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full">
                        <i class="far fa-clock mr-2"></i>
                        <span>{{ now()->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex items-center bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full">
                        <i class="far fa-user mr-2"></i>
                        <span>{{ Auth::user()->name }}</span>
                    </div>
                </div>
                
                <!-- CTA Button -->
                <div class="pt-4">
                    <a href="{{ route('permohonan.create') }}" 
                       class="group relative inline-flex items-center justify-center px-8 py-4 bg-white text-blue-700 font-bold rounded-xl shadow-2xl hover:shadow-white/20 transform hover:scale-105 transition-all duration-300 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-purple-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <i class="relative fas fa-plus mr-2"></i>
                        <span class="relative">Buat Permohonan Baru</span>
                    </a>
                </div>
            </div>
            
            <!-- Illustration - Right Side -->
            <div class="relative lg:flex-shrink-0 hidden lg:block" data-aos="fade-left">
                <div class="relative w-80 h-80">
                    <!-- Dynamic Background Shapes -->
                    <div class="absolute inset-0">
                        <!-- Outer rotating ring -->
                        <div class="absolute inset-0 rounded-full border-4 border-white/10 animate-spin-slow"></div>
                        
                        <!-- Multiple orbiting dots -->
                        <div class="absolute inset-0 animate-spin-reverse" style="animation-duration: 15s;">
                            <div class="absolute top-0 left-1/2 w-3 h-3 bg-blue-400 rounded-full -translate-x-1/2 shadow-lg shadow-blue-400/50"></div>
                        </div>
                        <div class="absolute inset-4 animate-spin-slow" style="animation-duration: 20s;">
                            <div class="absolute top-0 left-1/2 w-2.5 h-2.5 bg-indigo-400 rounded-full -translate-x-1/2 shadow-lg shadow-indigo-400/50"></div>
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
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-400 via-indigo-500 to-purple-500 rounded-3xl blur-3xl opacity-40 animate-gradient-rotate"></div>
                            
                            <!-- Glass morphism container -->
                            <div class="relative bg-white/10 backdrop-blur-2xl rounded-3xl p-10 shadow-2xl border border-white/30 hover:scale-105 transition-transform duration-500">
                                <!-- Modern Borrowing/Clock Icon with Box -->
                                <svg class="w-44 h-44" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <!-- Background Box -->
                                    <g opacity="0.6">
                                        <rect x="30" y="50" width="110" height="110" rx="12" fill="url(#boxGradient1)" transform="rotate(-5 85 105)">
                                            <animateTransform attributeName="transform" type="rotate" values="-5 85 105; -3 85 105; -5 85 105" dur="3s" repeatCount="indefinite"/>
                                        </rect>
                                    </g>
                                    
                                    <!-- Middle Box -->
                                    <g opacity="0.8">
                                        <rect x="35" y="55" width="110" height="110" rx="12" fill="url(#boxGradient2)" transform="rotate(2 90 110)">
                                            <animateTransform attributeName="transform" type="rotate" values="2 90 110; 4 90 110; 2 90 110" dur="3s" repeatCount="indefinite" begin="0.5s"/>
                                        </rect>
                                    </g>
                                    
                                    <!-- Main Box with Clock -->
                                    <g>
                                        <rect x="45" y="60" width="110" height="110" rx="12" fill="url(#boxGradient3)">
                                            <animate attributeName="y" values="60;57;60" dur="2s" repeatCount="indefinite"/>
                                        </rect>
                                        
                                        <!-- Clock Face -->
                                        <circle cx="100" cy="115" r="35" fill="white" opacity="0.9"/>
                                        <circle cx="100" cy="115" r="32" fill="url(#clockGradient)"/>
                                        
                                        <!-- Clock Marks -->
                                        <line x1="100" y1="86" x2="100" y2="90" stroke="white" stroke-width="2.5" stroke-linecap="round" opacity="0.8"/>
                                        <line x1="100" y1="140" x2="100" y2="144" stroke="white" stroke-width="2.5" stroke-linecap="round" opacity="0.8"/>
                                        <line x1="71" y1="115" x2="75" y2="115" stroke="white" stroke-width="2.5" stroke-linecap="round" opacity="0.8"/>
                                        <line x1="125" y1="115" x2="129" y2="115" stroke="white" stroke-width="2.5" stroke-linecap="round" opacity="0.8"/>
                                        
                                        <!-- Hour Hand (10 o'clock) -->
                                        <line x1="100" y1="115" x2="90" y2="105" stroke="white" stroke-width="3.5" stroke-linecap="round">
                                            <animateTransform attributeName="transform" type="rotate" values="0 100 115; 30 100 115; 0 100 115" dur="4s" repeatCount="indefinite"/>
                                        </line>
                                        
                                        <!-- Minute Hand -->
                                        <line x1="100" y1="115" x2="100" y2="95" stroke="white" stroke-width="2.5" stroke-linecap="round">
                                            <animateTransform attributeName="transform" type="rotate" values="0 100 115; 360 100 115" dur="3s" repeatCount="indefinite"/>
                                        </line>
                                        
                                        <!-- Center Dot -->
                                        <circle cx="100" cy="115" r="4" fill="white"/>
                                        
                                        <!-- Return Arrow (bottom right) -->
                                        <g transform="translate(130, 145)">
                                            <path d="M 0 0 Q 10 -5, 15 0" stroke="url(#arrowGradient)" stroke-width="3" fill="none" stroke-linecap="round">
                                                <animate attributeName="stroke-dasharray" values="0,50;50,0" dur="2s" repeatCount="indefinite"/>
                                                <animate attributeName="stroke-dashoffset" values="50;0" dur="2s" repeatCount="indefinite"/>
                                            </path>
                                            <path d="M 12 -3 L 15 0 L 12 3" stroke="url(#arrowGradient)" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                            <animate attributeName="opacity" values="1;0.5;1" dur="2s" repeatCount="indefinite"/>
                                        </g>
                                        
                                        <!-- Shine effect -->
                                        <rect x="50" y="65" width="30" height="100" rx="8" fill="url(#shineGradient)" opacity="0.15">
                                            <animate attributeName="opacity" values="0.15;0.3;0.15" dur="3s" repeatCount="indefinite"/>
                                        </rect>
                                    </g>
                                    
                                    
                                    <!-- Gradients -->
                                    <defs>
                                        <linearGradient id="boxGradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#6366F1;stop-opacity:1" />
                                            <stop offset="100%" style="stop-color:#818CF8;stop-opacity:1" />
                                        </linearGradient>
                                        <linearGradient id="boxGradient2" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:1" />
                                            <stop offset="100%" style="stop-color:#60A5FA;stop-opacity:1" />
                                        </linearGradient>
                                        <linearGradient id="boxGradient3" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#DBEAFE;stop-opacity:1" />
                                            <stop offset="50%" style="stop-color:#BFDBFE;stop-opacity:1" />
                                            <stop offset="100%" style="stop-color:#93C5FD;stop-opacity:1" />
                                        </linearGradient>
                                        <linearGradient id="clockGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:1" />
                                            <stop offset="100%" style="stop-color:#6366F1;stop-opacity:1" />
                                        </linearGradient>
                                        <linearGradient id="arrowGradient" x1="0%" y1="0%" x2="100%" y2="0%">
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
                                <div class="absolute bottom-2 left-2 w-4 h-4 border-b-2 border-l-2 border-indigo-300 rounded-bl-lg"></div>
                            </div>
                            
                            <!-- Animated Badge -->
                            <div class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap">
                                <div class="relative bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white px-6 py-2.5 rounded-full font-bold text-sm shadow-2xl border-2 border-white/30 animate-gradient-x">
                                    <span class="inline-flex items-center gap-2">
                                        <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span id="total-counter-hero" data-target="{{ $peminjaman->total() }}">{{ $peminjaman->total() }}</span> Peminjaman
                                    </span>
                                    <!-- Badge glow -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-full blur-lg opacity-50 -z-10 animate-pulse"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modern Wave Divider - Blue/Indigo Theme (SAMA DENGAN DASHBOARD) -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
        <svg class="relative block w-full h-[100px] md:h-[150px]" viewBox="0 0 1200 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="peminjamanWaveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#F8FAFC;stop-opacity:1" />
                    <stop offset="50%" style="stop-color:#F1F5F9;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#F8FAFC;stop-opacity:1" />
                </linearGradient>
                
                <linearGradient id="peminjamanWaveGradientAnimated" x1="0%" y1="0%" x2="100%" y2="0%">
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
            
            <!-- Wave Layer 1 -->
            <path d="M0,25 Q100,70 200,50 Q300,30 400,55 Q500,80 600,45 Q700,20 800,50 Q900,75 1000,40 Q1100,25 1200,55 L1200,120 L0,120 Z" 
                  fill="url(#peminjamanWaveGradient)" 
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
            
            <!-- Wave Layer 2 -->
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
            
            <!-- Wave Layer 3 -->
            <path d="M0,65 Q80,90 160,75 Q240,60 320,85 Q400,95 480,70 Q560,55 640,80 Q720,90 800,65 Q880,50 960,75 Q1040,85 1120,60 Q1160,50 1200,70 L1200,120 L0,120 Z" 
                  fill="url(#peminjamanWaveGradientAnimated)" 
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
            
            <!-- Wave Layer 4 -->
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
            
            <!-- Wave Layer 5 -->
            <path d="M0,92 L1200,92 L1200,120 L0,120 Z" 
                  fill="#F8FAFC" 
                  opacity="1" />
        </svg>
    </div>

    <!-- Shine effect overlay -->
    <div class="absolute bottom-0 left-0 w-full h-[100px] md:h-[150px] pointer-events-none">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-50/50 to-transparent"></div>
    </div>
</div>

<div class="bg-slate-50 pt-0 pb-16 mt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Quick Stats Overview - TETAP SAMA (sudah sesuai) -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6 -mt-8 md:-mt-16 mb-6 md:mb-12 relative z-10" data-aos="fade-up">
            
            <!-- Card 1: Menunggu -->
            <a href="{{ route('peminjaman.index', ['status' => 'menunggu']) }}" 
            class="group bg-white rounded-xl md:rounded-2xl p-3 md:p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-orange-100 hover:border-orange-300 transform hover:-translate-y-2 cursor-pointer">
                <div class="flex flex-col md:flex-row items-center md:justify-between mb-2 md:mb-4">
                    <div class="p-2 md:p-3 bg-gradient-to-br from-orange-500 to-red-500 rounded-lg md:rounded-xl shadow-lg group-hover:scale-110 transition-transform mb-2 md:mb-0">
                        <svg class="w-4 h-4 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex items-center gap-1.5 md:gap-2">
                        <div class="w-1.5 h-1.5 md:w-2 md:h-2 bg-orange-500 rounded-full animate-pulse"></div>
                        <span class="text-[10px] md:text-xs font-medium text-orange-600">Pending</span>
                    </div>
                </div>
                <div class="text-center md:text-left">
                    <div class="text-xl md:text-3xl font-bold text-gray-900 mb-0.5 md:mb-1 group-hover:text-orange-600 transition-colors">
                        <span class="counter" data-target="{{ $peminjaman->where('status', 'menunggu')->count() }}">0</span>
                    </div>
                    <div class="text-[11px] md:text-sm text-gray-600 leading-tight">Menunggu Persetujuan</div>
                </div>
                <div class="mt-2 md:mt-3 flex items-center justify-center md:justify-start text-[10px] md:text-xs text-orange-600 opacity-0 group-hover:opacity-100 transition-opacity">
                    <span class="hidden md:inline">Lihat Detail</span>
                    <i class="fas fa-arrow-right text-xs md:text-sm md:ml-1"></i>
                </div>
            </a>

            <!-- Card 2: Disetujui/Aktif -->
            <a href="{{ route('peminjaman.index', ['status' => 'disetujui']) }}" 
            class="group bg-white rounded-xl md:rounded-2xl p-3 md:p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-green-100 hover:border-green-300 transform hover:-translate-y-2 cursor-pointer">
                <div class="flex flex-col md:flex-row items-center md:justify-between mb-2 md:mb-4">
                    <div class="p-2 md:p-3 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg md:rounded-xl shadow-lg group-hover:scale-110 transition-transform mb-2 md:mb-0">
                        <svg class="w-4 h-4 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] md:text-xs font-medium text-green-600 bg-green-50 px-2 md:px-3 py-0.5 md:py-1 rounded-full">Active</span>
                </div>
                <div class="text-center md:text-left">
                    <div class="text-xl md:text-3xl font-bold text-gray-900 mb-0.5 md:mb-1 group-hover:text-green-600 transition-colors">
                        <span class="counter" data-target="{{ $peminjaman->where('status', 'disetujui')->count() }}">0</span>
                    </div>
                    <div class="text-[11px] md:text-sm text-gray-600">Sedang Dipinjam</div>
                </div>
                <div class="mt-2 md:mt-3 flex items-center justify-center md:justify-start text-[10px] md:text-xs text-green-600 opacity-0 group-hover:opacity-100 transition-opacity">
                    <span class="hidden md:inline">Lihat Detail</span>
                    <i class="fas fa-arrow-right text-xs md:text-sm md:ml-1"></i>
                </div>
            </a>

            <!-- Card 3: Selesai -->
            <a href="{{ route('peminjaman.index', ['status' => 'selesai']) }}" 
            class="group bg-white rounded-xl md:rounded-2xl p-3 md:p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-blue-100 hover:border-blue-300 transform hover:-translate-y-2 cursor-pointer">
                <div class="flex flex-col md:flex-row items-center md:justify-between mb-2 md:mb-4">
                    <div class="p-2 md:p-3 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-lg md:rounded-xl shadow-lg group-hover:scale-110 transition-transform mb-2 md:mb-0">
                        <svg class="w-4 h-4 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] md:text-xs font-medium text-blue-600 bg-blue-50 px-2 md:px-3 py-0.5 md:py-1 rounded-full">Done</span>
                </div>
                <div class="text-center md:text-left">
                    <div class="text-xl md:text-3xl font-bold text-gray-900 mb-0.5 md:mb-1 group-hover:text-blue-600 transition-colors">
                        <span class="counter" data-target="{{ $peminjaman->where('status', 'selesai')->count() }}">0</span>
                    </div>
                    <div class="text-[11px] md:text-sm text-gray-600">Selesai</div>
                </div>
                <div class="mt-2 md:mt-3 flex items-center justify-center md:justify-start text-[10px] md:text-xs text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity">
                    <span class="hidden md:inline">Lihat Detail</span>
                    <i class="fas fa-arrow-right text-xs md:text-sm md:ml-1"></i>
                </div>
            </a>

            <!-- Card 4: Total -->
            <a href="{{ route('peminjaman.index') }}" 
            class="group bg-white rounded-xl md:rounded-2xl p-3 md:p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-purple-100 hover:border-purple-300 transform hover:-translate-y-2 cursor-pointer">
                <div class="flex flex-col md:flex-row items-center md:justify-between mb-2 md:mb-4">
                    <div class="p-2 md:p-3 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg md:rounded-xl shadow-lg group-hover:scale-110 transition-transform mb-2 md:mb-0">
                        <svg class="w-4 h-4 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] md:text-xs font-medium text-purple-600 bg-purple-50 px-2 md:px-3 py-0.5 md:py-1 rounded-full">Total</span>
                </div>
                <div class="text-center md:text-left">
                    <div class="text-xl md:text-3xl font-bold text-gray-900 mb-0.5 md:mb-1 group-hover:text-purple-600 transition-colors">
                        <span class="counter" data-target="{{ $peminjaman->total() }}">0</span>
                    </div>
                    <div class="text-[11px] md:text-sm text-gray-600">Total Peminjaman</div>
                </div>
                <div class="mt-2 md:mt-3 flex items-center justify-center md:justify-start text-[10px] md:text-xs text-purple-600 opacity-0 group-hover:opacity-100 transition-opacity">
                    <span class="hidden md:inline">Lihat Detail</span>
                    <i class="fas fa-arrow-right text-xs md:text-sm md:ml-1"></i>
                </div>
            </a>
        </div>
        
        <!-- Filter Section - UBAH WARNA FILTER KE BLUE -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mt-8 mb-8 relative z-10" data-aos="fade-up">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                    <i class="fas fa-filter text-blue-600 mr-2"></i>
                    Filter & Pencarian
                </h3>
            </div>
            
            <form method="GET" action="{{ route('peminjaman.index') }}">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 mb-3">
                    <!-- Status Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Peminjaman</label>
                        <select name="status" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            <option value="">Semua Status</option>
                            <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <!-- Status Pembayaran -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Pembayaran</label>
                        <select name="pembayaran_status" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('pembayaran_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="lunas" {{ request('pembayaran_status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                            <option value="batal" {{ request('pembayaran_status') == 'batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </div>

                    <!-- Tanggal Mulai -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}" 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    </div>

                    <!-- Tanggal Selesai -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}" 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Barang / Keperluan</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang, kode barang, atau keperluan..." 
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                </div>

                <!-- Action Buttons - mobile stacked, desktop inline -->
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
                    
                    <a href="{{ route('peminjaman.index') }}" 
                    class="group relative w-full md:w-auto inline-flex justify-center items-center px-6 py-3 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm font-semibold rounded-xl transition-all duration-300 overflow-hidden">
                        <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-blue-500/5 to-indigo-500/5 dark:from-blue-600/10 dark:to-indigo-600/10 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                        <i class="relative fas fa-redo mr-2 text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 group-hover:rotate-180 transition-all duration-500"></i>
                        <span class="relative">Reset Filter</span>
                    </a>
                </div>

                <!-- Filter Aktif Section - Separated with border -->
                @if(request()->anyFilled(['status', 'pembayaran_status', 'tanggal_mulai', 'tanggal_selesai', 'search']))
                    <div class="mt-5 pt-5 border-t-2 border-gray-200">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-sm font-semibold text-gray-700 mr-1">Filter aktif:</span>
                            
                            @if(request('status'))
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-100 text-blue-700 text-xs font-medium rounded-lg border border-blue-200">
                                    <span class="font-semibold">Status:</span>
                                    <span>{{ ucfirst(request('status')) }}</span>
                                </span>
                            @endif
                            
                            @if(request('pembayaran_status'))
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-100 text-green-700 text-xs font-medium rounded-lg border border-green-200">
                                    <span class="font-semibold">Pembayaran:</span>
                                    <span>{{ ucfirst(request('pembayaran_status')) }}</span>
                                </span>
                            @endif
                            
                            @if(request('tanggal_mulai'))
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-purple-100 text-purple-700 text-xs font-medium rounded-lg border border-purple-200">
                                    <span class="font-semibold">Dari:</span>
                                    <span>{{ \Carbon\Carbon::parse(request('tanggal_mulai'))->format('d M Y') }}</span>
                                </span>
                            @endif
                            
                            @if(request('tanggal_selesai'))
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-purple-100 text-purple-700 text-xs font-medium rounded-lg border border-purple-200">
                                    <span class="font-semibold">Sampai:</span>
                                    <span>{{ \Carbon\Carbon::parse(request('tanggal_selesai'))->format('d M Y') }}</span>
                                </span>
                            @endif
                            
                            @if(request('search'))
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-orange-100 text-orange-700 text-xs font-medium rounded-lg border border-orange-200">
                                    <span class="font-semibold">Pencarian:</span>
                                    <span class="max-w-[150px] truncate">{{ request('search') }}</span>
                                </span>
                            @endif
                            
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-lg border border-indigo-200">
                                {{ $peminjaman->total() }} hasil ditemukan
                            </span>
                        </div>
                    </div>
                @endif
            </form>
        </div>

        <!-- Peminjaman List - UBAH WARNA CARD KE BLUE -->
        <div class="space-y-6">
            @forelse($peminjaman as $item)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300" data-aos="fade-up">
                    <div id="hasil-filter" class="p-4 md:p-6">
                        <!-- Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                                    <i class="fas fa-box text-white text-4xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Peminjaman #{{ $item->id }}</h3>
                                    <p class="text-sm text-gray-500">{{ $item->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                            
                            <!-- Status Badge - TETAP SAMA -->
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold
                                @if($item->status === 'menunggu') bg-orange-100 text-orange-700
                                @elseif($item->status === 'disetujui') bg-green-100 text-green-700
                                @elseif($item->status === 'ditolak') bg-red-100 text-red-700
                                @elseif($item->status === 'selesai') bg-blue-100 text-blue-700
                                @else bg-gray-100 text-gray-700 @endif">
                                @if($item->status === 'menunggu')
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Menunggu
                                @elseif($item->status === 'disetujui')
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Disetujui
                                @elseif($item->status === 'ditolak')
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Ditolak
                                @elseif($item->status === 'selesai')
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Selesai
                                @else
                                    {{ ucfirst($item->status) }}
                                @endif
                            </span>
                        </div>

                        <!-- Barang List - UBAH WARNA BACKGROUND KE BLUE -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-5 mb-4">
                            <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                Barang yang Dipinjam
                            </h4>
                            
                            <div class="space-y-3">
                                @foreach($item->peminjamanDetail as $detail)
                                    <div class="flex items-center justify-between bg-white rounded-lg p-4 hover:shadow-md transition-all">
                                        <div class="flex items-center gap-3 flex-1">
                                            @if($detail->barang->fotoPrimary)
                                                <img src="{{ $detail->barang->fotoPrimary->foto_url }}"
                                                     alt="{{ $detail->barang->nama_barang }}"
                                                     class="w-20 h-20 object-cover rounded-lg shadow-md">
                                            @else
                                                <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-lg flex items-center justify-center text-white">
                                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                            
                                            <div class="flex-1 min-w-0">
                                                <h5 class="font-semibold text-gray-900">{{ $detail->barang->nama_barang }}</h5>
                                                <p class="text-sm text-gray-600">
                                                    {{ $detail->barang->kategori->nama_kategori ?? 'Kategori' }}
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <div class="text-right ml-4">
                                            <div class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 rounded-full font-semibold text-sm">
                                                {{ $detail->jumlah }} Unit
                                            </div>
                                            <p class="text-sm text-gray-600 mt-1">
                                                Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Total - UBAH WARNA KE BLUE -->
                            <div class="mt-4 pt-4 border-t-2 border-blue-200 flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">Total Biaya</span>
                                <span class="text-2xl font-bold text-blue-600">
                                    Rp {{ number_format($item->biaya, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <!-- Info Grid - UBAH ICON COLOR KE BLUE -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                <i class="far fa-calendar-alt text-blue-500"></i>
                                <div>
                                    <p class="text-xs text-gray-500">Periode</p>
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M') }} - 
                                        {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                <i class="far fa-clock text-blue-500"></i>
                                <div>
                                    <p class="text-xs text-gray-500">Durasi</p>
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ \Carbon\Carbon::parse($item->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($item->tanggal_selesai)) + 1 }} Hari
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-dollar-sign text-blue-500"></i>
                                <div>
                                    <p class="text-xs text-gray-500">Status Pembayaran</p>
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $item->pembayaran ? ucfirst($item->pembayaran->status) : 'Belum Ada' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Keperluan -->
                        @if($item->keperluan)
                            @php
                                // Pisahkan keperluan dan alasan penolakan
                                $keperluanParts = explode('Alasan Penolakan:', $item->keperluan);
                                $keperluanAsli = trim($keperluanParts[0]);
                                $alasanPenolakan = isset($keperluanParts[1]) ? trim($keperluanParts[1]) : null;
                            @endphp
                            
                            <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-600 font-medium mb-1">Keperluan:</p>
                                <p class="text-sm text-gray-700">{{ $keperluanAsli }}</p>
                            </div>
                        @endif

                        <!-- Alasan Penolakan - Tampilkan jika ditolak -->
                        @if($item->status === 'ditolak' && isset($alasanPenolakan) && $alasanPenolakan)
                            <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-red-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                    <div class="flex-1">
                                        <p class="text-sm font-bold text-red-800 mb-2">Alasan Penolakan:</p>
                                        <p class="text-sm text-red-700 leading-relaxed">{{ $alasanPenolakan }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Actions - Clean Design without Overlay Effect -->
                        <div class="flex flex-col sm:flex-row sm:flex-wrap gap-2 sm:gap-3">
                            <!-- Tombol Lihat Detail -->
                            <a href="{{ route('peminjaman.show', $item->id) }}" 
                            class="btn-action w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                <i class="icon-action fas fa-eye mr-2 transition-transform duration-300"></i>
                                <span>Lihat Detail</span>
                            </a>

                            <!-- Tombol Bayar - HANYA tampil jika status DISETUJUI dan pembayaran PENDING -->
                            @if($item->status === 'disetujui' && $item->pembayaran && $item->pembayaran->status === 'pending')
                                <a href="{{ route('pembayaran.show', $item->pembayaran->id) }}" 
                                class="btn-action relative w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white text-sm font-bold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                    <i class="icon-action icon-rotate-left fas fa-dollar-sign mr-2 transition-transform duration-300"></i>
                                    <span class="relative">
                                        Bayar Sekarang
                                        <span class="absolute -top-1 -right-1 flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                                        </span>
                                    </span>
                                </a>
                            @endif

                            <!-- Badge Pembayaran Lunas - Compact -->
                            @if($item->pembayaran && $item->pembayaran->status === 'lunas')
                                <div class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-green-50 text-green-700 text-sm font-semibold rounded-lg border border-green-200">
                                    <i class="fas fa-check-circle mr-1.5"></i>
                                    Lunas
                                </div>
                            @endif

                            <!-- Status Badge - Menunggu - Compact -->
                            @if($item->status === 'menunggu')
                                <div class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-orange-50 text-orange-700 text-sm font-semibold rounded-lg border border-orange-200">
                                    <div class="w-1.5 h-1.5 bg-orange-500 rounded-full mr-2 animate-pulse"></div>
                                    Menunggu Persetujuan
                                </div>
                            @endif

                            <!-- Status Badge - Selesai - Compact -->
                            @if($item->status === 'selesai')
                                <div class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-blue-50 text-blue-700 text-sm font-semibold rounded-lg border border-blue-200">
                                    <i class="fas fa-check-circle mr-1.5"></i>
                                    Selesai
                                </div>
                            @endif

                            <!-- Status Badge - Ditolak - Compact -->
                            @if($item->status === 'ditolak')
                                <div class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-red-50 text-red-700 text-sm font-semibold rounded-lg border border-red-200">
                                    <i class="fas fa-times-circle mr-1.5"></i>
                                    Ditolak
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            @empty
                <!-- Empty State - UBAH WARNA KE BLUE -->
                <div class="bg-white rounded-2xl shadow-lg p-16 text-center" data-aos="fade-up">
                    <div class="w-32 h-32 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-inbox text-blue-600 text-8xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Belum Ada Peminjaman</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        Anda belum memiliki riwayat peminjaman. Mulai dengan membuat permohonan peminjaman aset.
                    </p>
                    <a href="{{ route('permohonan.create') }}" 
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all">
                        <i class="fas fa-plus mr-2"></i>
                        Buat Permohonan Baru
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($peminjaman->hasPages())
            <div class="mt-8" data-aos="fade-up">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    {{ $peminjaman->links() }}
                </div>
            </div>
        @endif

        <!-- Info Card - desktop/tablet only (hidden on mobile) -->
        <div class="hidden md:block mt-8 md:mt-12 bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 rounded-2xl shadow-md md:shadow-2xl overflow-hidden" data-aos="fade-up">
            <div class="absolute inset-0 bg-black/6"></div>
            <div class="relative p-4 md:p-8">
                <div class="flex items-start gap-4 md:gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 md:w-16 md:h-16 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <i class="fas fa-info-circle text-white text-3xl"></i>
                        </div>
                    </div>

                    <div class="flex-1 text-white">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg md:text-2xl font-semibold mb-2 md:mb-3">Informasi Penting</h3>
                        </div>

                        <!-- Full content: visible on md+; collapsible on mobile via details above -->
                        <div class="hidden md:grid md:grid-cols-2 gap-3 md:gap-4 text-blue-50 text-sm">
                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Pastikan melakukan pembayaran setelah permohonan disetujui untuk memproses peminjaman.</span>
                            </div>

                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Hubungi admin untuk pengambilan barang setelah pembayaran dikonfirmasi.</span>
                            </div>

                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Kembalikan barang tepat waktu sesuai tanggal yang tercantum untuk menghindari denda keterlambatan.</span>
                            </div>

                            <div class="flex items-start gap-3">
                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Periksa kondisi barang saat pengambilan dan pengembalian untuk menghindari biaya kerusakan.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Action - UBAH BUTTON KE BLUE -->
        <div class="mt-8 text-center" data-aos="fade-up">
            <a href="{{ route('permohonan.create') }}" 
               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all">
                <i class="fas fa-plus mr-2"></i>
                Buat Permohonan Baru
            </a>
        </div>
    </div>
</div>

@push('styles')
<style>
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
    /* Loading spinner animation */
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .animate-spin {
        animation: spin 1s linear infinite;
    }

    /* Pulse animation for button */
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: .8;
        }
    }

    /* Smooth transitions */
    .filter-normal,
    .filter-loading {
        transition: all 0.3s ease-in-out;
    }
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

@keyframes ping-slow {
    0%, 100% { transform: scale(1); opacity: 0.5; }
    50% { transform: scale(1.1); opacity: 0.2; }
}

@keyframes ping-slower {
    0%, 100% { transform: scale(1); opacity: 0.3; }
    50% { transform: scale(1.15); opacity: 0.1; }
}

.animate-ping-slow {
    animation: ping-slow 3s cubic-bezier(0, 0, 0.2, 1) infinite;
}

.animate-ping-slower {
    animation: ping-slower 4s cubic-bezier(0, 0, 0.2, 1) infinite;
}
/* Button Action Hover Effects - Icon Animation Only */
.btn-action:hover .icon-action {
    transform: scale(1.1) rotate(12deg);
}

.btn-action:hover .icon-action.icon-rotate-left {
    transform: scale(1.1) rotate(-12deg);
}

</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script>
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        mirror: false
    });

// Counter Animation Function
function initCounters() {
    const counters = document.querySelectorAll('.counter, #total-counter-hero');
    
    const animateCounter = (counter) => {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 800;
        const increment = target / (duration / 16);
        let current = 0;
        
        const updateCounter = () => {
            if (current < target) {
                current += increment;
                if (current > target) current = target;
                counter.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };
        
        updateCounter();
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('animated')) {
                entry.target.classList.add('animated');
                const delay = Array.from(counters).indexOf(entry.target) * 50;
                setTimeout(() => {
                    animateCounter(entry.target);
                }, delay);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => {
        counter.textContent = '0';
        observer.observe(counter);
    });
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

// Auto Scroll to Results when Filter is Active
function autoScrollToResults() {
    @if(request()->anyFilled(['status', 'pembayaran_status', 'tanggal_mulai', 'tanggal_selesai', 'search']))
        setTimeout(() => {
            // Cari card peminjaman pertama langsung
            const firstCard = document.querySelector('.space-y-6 > div.bg-white.rounded-2xl');
            
            if (firstCard) {
                // Hitung posisi card dengan offset untuk navbar
                const elementPosition = firstCard.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - 180;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
                
                console.log('✓ Auto scroll ke card peminjaman berhasil');
                console.log('Posisi scroll:', offsetPosition);
            } else {
                console.log('✗ Card peminjaman tidak ditemukan');
            }
        }, 1000); // Tambah delay jadi 1000ms
    @endif
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    initCounters();
    initFilterLoading();
    autoScrollToResults();
});

</script>
@endpush
@endsection