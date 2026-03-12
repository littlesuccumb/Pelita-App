@extends('layouts.user')

@section('title', 'Permohonan Saya - Pelita App')

@section('content')
{{-- Hero Section --}}
<div class="relative bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 overflow-hidden">
    <!-- Decorative Elements - GANTI WARNA -->
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
                    <!-- Icon -->                  
                    <div class="relative">
                        <!-- Icon Box - Tetap Putih Transparan -->
                        <div class="w-20 h-20 bg-gradient-to-br from-white/20 to-white/5 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-2xl">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-1"></path>
                            </svg>
                        </div>
                        
                        <!-- Mini Badge - EMERALD (sama seperti dashboard) -->
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-emerald-500 border-4 border-white/20 rounded-full flex items-center justify-center">
                            <div class="w-3 h-3 bg-emerald-400 rounded-full animate-pulse"></div>
                        </div>
                    </div>

                    <!-- Status Badge - Dot EMERALD (sama seperti dashboard) -->
                    <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm">
                        <div class="w-2 h-2 bg-emerald-400 rounded-full mr-2 animate-pulse"></div>
                        <span><span id="total-counter-hero" data-target="{{ $permohonan->total() }}">0</span> Permohonan</span>
                    </div>
                    </div>             
                <div>
                    <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 leading-tight">
                        Permohonan Saya
                    </h1>
                    <p class="text-lg md:text-xl text-blue-100 max-w-2xl">
                        Kelola dan pantau status permohonan peminjaman barang Anda di Cimahi Technopark
                    </p>
                </div>

                <!-- Quick Info -->
                <div class="flex items-center flex-wrap gap-4 text-sm text-slate-200">
                    <div class="flex items-center bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ now()->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex items-center bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>{{ Auth::user()->name }}</span>
                    </div>
                </div>
                
                <!-- CTA Button -->
                <div class="pt-4">
                    <a href="{{ route('permohonan.create') }}" 
                    class="group relative inline-flex items-center justify-center px-8 py-4 bg-white text-blue-700 font-bold rounded-xl shadow-2xl hover:shadow-white/20 transform hover:scale-105 transition-all duration-300 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-purple-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <svg class="relative w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
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
                            <div class="absolute top-0 left-1/2 w-3 h-3 bg-emerald-400 rounded-full -translate-x-1/2 shadow-lg shadow-emerald-400/50"></div>
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
                            <div class="absolute inset-0 bg-gradient-to-br from-emerald-400 via-blue-500 to-indigo-500 rounded-3xl blur-3xl opacity-40 animate-gradient-rotate"></div>
                            
                            <!-- Glass morphism container -->
                            <div class="relative bg-white/10 backdrop-blur-2xl rounded-3xl p-10 shadow-2xl border border-white/30 hover:scale-105 transition-transform duration-500">
                                <!-- Modern Document Stack Icon -->
                                <svg class="w-44 h-44" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <!-- Background Papers Stack -->
                                    <g opacity="0.5">
                                        <rect x="35" y="30" width="100" height="130" rx="10" fill="url(#docGradient1)" transform="rotate(-8 85 95)">
                                            <animateTransform attributeName="transform" type="rotate" values="-8 85 95; -6 85 95; -8 85 95" dur="3s" repeatCount="indefinite"/>
                                        </rect>
                                    </g>
                                    
                                    <g opacity="0.7">
                                        <rect x="40" y="35" width="100" height="130" rx="10" fill="url(#docGradient2)" transform="rotate(-4 90 100)">
                                            <animateTransform attributeName="transform" type="rotate" values="-4 90 100; -2 90 100; -4 90 100" dur="3s" repeatCount="indefinite" begin="0.5s"/>
                                        </rect>
                                    </g>
                                    
                                    <!-- Main Document -->
                                    <g>
                                        <rect x="50" y="40" width="100" height="130" rx="10" fill="url(#docGradient3)">
                                            <animate attributeName="y" values="40;37;40" dur="2s" repeatCount="indefinite"/>
                                        </rect>
                                        
                                        <!-- Document Lines -->
                                        <line x1="65" y1="65" x2="120" y2="65" stroke="white" stroke-width="3" opacity="0.3" stroke-linecap="round">
                                            <animate attributeName="x2" values="120;125;120" dur="2s" repeatCount="indefinite"/>
                                        </line>
                                        <line x1="65" y1="80" x2="135" y2="80" stroke="white" stroke-width="3" opacity="0.3" stroke-linecap="round">
                                            <animate attributeName="x2" values="135;140;135" dur="2s" repeatCount="indefinite" begin="0.2s"/>
                                        </line>
                                        <line x1="65" y1="95" x2="125" y2="95" stroke="white" stroke-width="3" opacity="0.3" stroke-linecap="round">
                                            <animate attributeName="x2" values="125;130;125" dur="2s" repeatCount="indefinite" begin="0.4s"/>
                                        </line>
                                        
                                        <!-- Signature Line -->
                                        <path d="M 70 140 Q 85 135, 100 140 T 130 140" stroke="url(#signatureGradient)" stroke-width="3" fill="none" stroke-linecap="round">
                                            <animate attributeName="stroke-dasharray" values="0,200;200,0" dur="3s" repeatCount="indefinite"/>
                                            <animate attributeName="stroke-dashoffset" values="200;0" dur="3s" repeatCount="indefinite"/>
                                        </path>
                                        
                                        <!-- Approval Stamp Circle -->
                                        <g transform="translate(120, 130)">
                                            <circle r="18" fill="none" stroke="url(#stampGradient)" stroke-width="3" opacity="0.8">
                                                <animate attributeName="r" values="18;20;18" dur="2s" repeatCount="indefinite"/>
                                            </circle>
                                            <circle r="12" fill="white" opacity="0.9"/>
                                            <path d="M -6 0 L -2 4 L 6 -6" stroke="url(#checkGradient)" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <animate attributeName="stroke-dasharray" values="0,50;50,0" dur="2s" repeatCount="indefinite"/>
                                                <animate attributeName="stroke-dashoffset" values="50;0" dur="2s" repeatCount="indefinite"/>
                                            </path>
                                        </g>
                                        
                                        <!-- Shine effect -->
                                        <rect x="55" y="45" width="30" height="120" rx="8" fill="url(#shineGradient)" opacity="0.15">
                                            <animate attributeName="opacity" values="0.15;0.3;0.15" dur="3s" repeatCount="indefinite"/>
                                        </rect>
                                    </g>
                                    
                                    
                                    <!-- Gradients -->
                                    <defs>
                                        <linearGradient id="docGradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#6366F1;stop-opacity:1" />
                                            <stop offset="100%" style="stop-color:#818CF8;stop-opacity:1" />
                                        </linearGradient>
                                        <linearGradient id="docGradient2" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:1" />
                                            <stop offset="100%" style="stop-color:#60A5FA;stop-opacity:1" />
                                        </linearGradient>
                                        <linearGradient id="docGradient3" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#DBEAFE;stop-opacity:1" />
                                            <stop offset="50%" style="stop-color:#BFDBFE;stop-opacity:1" />
                                            <stop offset="100%" style="stop-color:#93C5FD;stop-opacity:1" />
                                        </linearGradient>
                                        <linearGradient id="signatureGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                            <stop offset="0%" style="stop-color:#6366F1;stop-opacity:1" />
                                            <stop offset="100%" style="stop-color:#3B82F6;stop-opacity:1" />
                                        </linearGradient>
                                        <linearGradient id="stampGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#10B981;stop-opacity:1" />
                                            <stop offset="100%" style="stop-color:#059669;stop-opacity:1" />
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
                                <div class="absolute top-2 right-2 w-4 h-4 border-t-2 border-r-2 border-emerald-300 rounded-tr-lg"></div>
                                <div class="absolute bottom-2 left-2 w-4 h-4 border-b-2 border-l-2 border-blue-300 rounded-bl-lg"></div>
                            </div>
                            
                            <!-- Animated Badge -->
                            <div class="absolute -bottom-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap">
                                <div class="relative bg-gradient-to-r from-emerald-600 via-blue-600 to-indigo-600 text-white px-6 py-2.5 rounded-full font-bold text-sm shadow-2xl border-2 border-white/30 animate-gradient-x">
                                    <span class="inline-flex items-center gap-2">
                                        <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <span id="total-counter-hero" data-target="{{ $permohonan->total() }}">{{ $permohonan->total() }}</span> Permohonan
                                    </span>
                                    <!-- Badge glow -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-400 to-blue-400 rounded-full blur-lg opacity-50 -z-10 animate-pulse"></div>
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
        
        <!-- Quick Stats Overview - Mobile Optimized -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6 -mt-8 md:-mt-16 mb-6 md:mb-12 relative z-10" data-aos="fade-up">
    
        <!-- Card 1: Pending -->
        <a href="{{ route('permohonan.index', ['status' => 'Dalam Proses']) }}" 
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
                    <span class="counter" data-target="{{ $permohonan->where('status', 'Dalam Proses')->count() }}">0</span>
                </div>
                <div class="text-[11px] md:text-sm text-gray-600 leading-tight">Menunggu Persetujuan</div>
            </div>
            <div class="mt-2 md:mt-3 flex items-center justify-center md:justify-start text-[10px] md:text-xs text-orange-600 opacity-0 group-hover:opacity-100 transition-opacity">
                <span class="hidden md:inline">Lihat Detail</span>
                <i class="fas fa-arrow-right text-xs md:text-sm md:ml-1"></i>
            </div>
        </a>

        <!-- Card 2: Approved -->
        <a href="{{ route('permohonan.index', ['status' => 'Disetujui']) }}" 
        class="group bg-white rounded-xl md:rounded-2xl p-3 md:p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-green-100 hover:border-green-300 transform hover:-translate-y-2 cursor-pointer">
            <div class="flex flex-col md:flex-row items-center md:justify-between mb-2 md:mb-4">
                <div class="p-2 md:p-3 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg md:rounded-xl shadow-lg group-hover:scale-110 transition-transform mb-2 md:mb-0">
                    <svg class="w-4 h-4 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-[10px] md:text-xs font-medium text-green-600 bg-green-50 px-2 md:px-3 py-0.5 md:py-1 rounded-full">Approved</span>
            </div>
            <div class="text-center md:text-left">
                <div class="text-xl md:text-3xl font-bold text-gray-900 mb-0.5 md:mb-1 group-hover:text-green-600 transition-colors">
                    <span class="counter" data-target="{{ $permohonan->where('status', 'Disetujui')->count() }}">0</span>
                </div>
                <div class="text-[11px] md:text-sm text-gray-600">Disetujui</div>
            </div>
            <div class="mt-2 md:mt-3 flex items-center justify-center md:justify-start text-[10px] md:text-xs text-green-600 opacity-0 group-hover:opacity-100 transition-opacity">
                <span class="hidden md:inline">Lihat Detail</span>
                <i class="fas fa-arrow-right text-xs md:text-sm md:ml-1"></i>
            </div>
        </a>

        <!-- Card 3: Rejected -->
        <a href="{{ route('permohonan.index', ['status' => 'Ditolak']) }}" 
        class="group bg-white rounded-xl md:rounded-2xl p-3 md:p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-red-100 hover:border-red-300 transform hover:-translate-y-2 cursor-pointer">
            <div class="flex flex-col md:flex-row items-center md:justify-between mb-2 md:mb-4">
                <div class="p-2 md:p-3 bg-gradient-to-br from-red-500 to-pink-600 rounded-lg md:rounded-xl shadow-lg group-hover:scale-110 transition-transform mb-2 md:mb-0">
                    <svg class="w-4 h-4 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <span class="text-[10px] md:text-xs font-medium text-red-600 bg-red-50 px-2 md:px-3 py-0.5 md:py-1 rounded-full">Rejected</span>
            </div>
            <div class="text-center md:text-left">
                <div class="text-xl md:text-3xl font-bold text-gray-900 mb-0.5 md:mb-1 group-hover:text-red-600 transition-colors">
                    <span class="counter" data-target="{{ $permohonan->where('status', 'Ditolak')->count() }}">0</span>
                </div>
                <div class="text-[11px] md:text-sm text-gray-600">Ditolak</div>
            </div>
            <div class="mt-2 md:mt-3 flex items-center justify-center md:justify-start text-[10px] md:text-xs text-red-600 opacity-0 group-hover:opacity-100 transition-opacity">
                <span class="hidden md:inline">Lihat Detail</span>
                <i class="fas fa-arrow-right text-xs md:text-sm md:ml-1"></i>
            </div>
        </a>

        <!-- Card 4: Total -->
        <a href="{{ route('permohonan.index') }}" 
        class="group bg-white rounded-xl md:rounded-2xl p-3 md:p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-purple-100 hover:border-purple-300 transform hover:-translate-y-2 cursor-pointer">
            <div class="flex flex-col md:flex-row items-center md:justify-between mb-2 md:mb-4">
                <div class="p-2 md:p-3 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg md:rounded-xl shadow-lg group-hover:scale-110 transition-transform mb-2 md:mb-0">
                    <svg class="w-4 h-4 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <span class="text-[10px] md:text-xs font-medium text-purple-600 bg-purple-50 px-2 md:px-3 py-0.5 md:py-1 rounded-full">Total</span>
            </div>
            <div class="text-center md:text-left">
                <div class="text-xl md:text-3xl font-bold text-gray-900 mb-0.5 md:mb-1 group-hover:text-purple-600 transition-colors">
                    <span class="counter" data-target="{{ $permohonan->total() }}">0</span>
                </div>
                <div class="text-[11px] md:text-sm text-gray-600">Total Permohonan</div>
            </div>
            <div class="mt-2 md:mt-3 flex items-center justify-center md:justify-start text-[10px] md:text-xs text-purple-600 opacity-0 group-hover:opacity-100 transition-opacity">
                <span class="hidden md:inline">Lihat Detail</span>
                <i class="fas fa-arrow-right text-xs md:text-sm md:ml-1"></i>
            </div>
        </a>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mt-8 mb-8 relative z-10" data-aos="fade-up">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-900 flex items-center">
                <i class="fas fa-filter text-indigo-600 mr-2"></i>
                Filter & Pencarian
            </h3>
        </div>
        
        <form method="GET" action="{{ route('permohonan.index') }}">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 mb-3">
                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status Permohonan</label>
                    <select name="status" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        <option value="">Semua Status</option>
                        @foreach($statusOptions as $key => $label)
                            <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Kategori Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori Barang</label>
                    <select name="kategori" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoriOptions as $id => $nama)
                            <option value="{{ $id }}" {{ request('kategori') == $id ? 'selected' : '' }}>
                                {{ $nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Mulai -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}" 
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                </div>

                <!-- Tanggal Selesai -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}" 
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                </div>
            </div>

            <!-- Search Bar -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari Permohonan</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor permohonan, nama barang, atau instansi..." 
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3">
                <button type="submit" 
                        id="filterButton" 
                        class="group relative w-full md:w-auto inline-flex justify-center items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white text-sm font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
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
                
                <a href="{{ route('permohonan.index') }}" 
                class="group relative w-full md:w-auto inline-flex justify-center items-center px-6 py-3 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm font-semibold rounded-xl transition-all duration-300 overflow-hidden">
                    <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-indigo-500/5 to-blue-500/5 dark:from-indigo-600/10 dark:to-blue-600/10 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                    <i class="relative fas fa-redo mr-2 text-gray-600 dark:text-gray-400 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 group-hover:rotate-180 transition-all duration-500"></i>
                    <span class="relative">Reset Filter</span>
                </a>
            </div>

            <!-- Filter Aktif Section - Separated with border -->
            @if(request()->hasAny(['search', 'status', 'kategori', 'tanggal_mulai', 'tanggal_selesai']))
                <div class="mt-5 pt-5 border-t-2 border-gray-200">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-sm font-semibold text-gray-700 mr-1">Filter aktif:</span>
                        
                        @if(request('status'))
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-100 text-indigo-700 text-xs font-medium rounded-lg border border-indigo-200">
                                <span class="font-semibold">Status:</span>
                                <span>{{ $statusOptions[request('status')] ?? ucfirst(request('status')) }}</span>
                            </span>
                        @endif
                        
                        @if(request('kategori'))
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-100 text-green-700 text-xs font-medium rounded-lg border border-green-200">
                                <span class="font-semibold">Kategori:</span>
                                <span>{{ $kategoriOptions[request('kategori')] ?? 'N/A' }}</span>
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
                        
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-blue-100 text-blue-700 text-sm font-semibold rounded-lg border border-blue-200">
                            {{ $permohonan->total() }} hasil ditemukan
                        </span>
                    </div>
                </div>
            @endif
        </form>
    </div>

    {{-- Enhanced Main Content - Modern & Mobile Optimized --}}
    <div class="bg-white rounded-2xl shadow-lg border border-slate-200 mt-6 overflow-hidden" data-aos="fade">
        {{-- Header Section --}}
        <div class="relative p-4 md:p-6 border-b border-slate-200 bg-gradient-to-r from-slate-50 via-white to-blue-50">
            {{-- Decorative top border --}}
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-indigo-500 via-blue-500 to-purple-500"></div>
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-history text-white text-xl"></i>
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-emerald-500 rounded-full border-2 border-white flex items-center justify-center">
                            <i class="fas fa-check text-white text-[8px]"></i>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-lg md:text-xl font-bold text-slate-800">Riwayat Permohonan</h2>
                        <p class="text-xs md:text-sm text-slate-500 mt-0.5">Kelola dan monitor status permohonan Anda</p>
                    </div>
                </div>
                
                <div id="hasil-filter" class="flex items-center justify-between sm:justify-end gap-2">
                    {{-- Live Updates Badge --}}
                    <div class="flex items-center space-x-2 px-3 py-1.5 bg-emerald-50 rounded-full border border-emerald-200">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                        <span class="text-xs font-medium text-emerald-700">Live Updates</span>
                    </div>
                    
                    {{-- Total Count Badge --}}
                    <div class="flex items-center space-x-2 px-3 py-1.5 bg-indigo-50 rounded-full border border-indigo-200">
                        <i class="fas fa-file-alt text-indigo-600 text-xs"></i>
                        <span class="text-xs font-bold text-indigo-700"><span class="counter" data-target="{{ $permohonan->total() }}">0</span> Total</span>
                    </div>
                </div>
            </div>
        </div>

        @if($permohonan->count() > 0)
            <div class="divide-y divide-slate-100">
                @foreach($permohonan as $item)
                    {{-- Permohonan Card - Enhanced Mobile Design --}}
                    <div class="group relative bg-white hover:bg-slate-50/50 transition-all duration-300">
                        {{-- Status Progress Indicator --}}
                        <div class="absolute top-0 left-0 right-0 h-1.5 rounded-t-2xl overflow-hidden">
                            @if($item->status === 'Dalam Proses')
                                <div class="h-full bg-gradient-to-r from-amber-400 via-orange-400 to-orange-500 animate-pulse" style="width: 33.33%"></div>
                            @elseif($item->status === 'Disetujui')
                                <div class="h-full bg-gradient-to-r from-emerald-400 via-green-400 to-green-500 w-full"></div>
                            @elseif($item->status === 'Ditolak')
                                <div class="h-full bg-gradient-to-r from-red-400 via-rose-400 to-red-500 w-full"></div>
                            @endif
                        </div>

                        <div class="p-4 md:p-6 mt-1.5">
                            {{-- Mobile Header: Icon + Status --}}
                            <div class="flex items-start gap-3 mb-4">
                                {{-- Icon Section --}}
                                <div class="flex-shrink-0 relative">
                                    <div class="w-14 h-14 md:w-16 md:h-16 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl flex items-center justify-center group-hover:scale-105 transition-transform duration-300 shadow-md group-hover:shadow-lg border border-slate-200">
                                        <i class="fas fa-file-invoice text-slate-600 text-2xl md:text-3xl"></i>
                                    </div>
                                    
                                    {{-- Status Mini Badge --}}
                                    <div class="absolute -bottom-1.5 -right-1.5 w-7 h-7 rounded-lg shadow-lg flex items-center justify-center border-2 border-white
                                        @if($item->status === 'Dalam Proses') bg-gradient-to-br from-amber-400 to-orange-500
                                        @elseif($item->status === 'Disetujui') bg-gradient-to-br from-emerald-400 to-green-500
                                        @elseif($item->status === 'Ditolak') bg-gradient-to-br from-red-400 to-rose-500
                                        @endif">
                                        @if($item->status === 'Dalam Proses')
                                            <i class="fas fa-clock text-white text-xs"></i>
                                        @elseif($item->status === 'Disetujui')
                                            <i class="fas fa-check text-white text-xs"></i>
                                        @elseif($item->status === 'Ditolak')
                                            <i class="fas fa-times text-white text-xs"></i>
                                        @endif
                                    </div>
                                </div>

                                {{-- Header Info --}}
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-2">
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 mb-1.5">
                                                <h3 class="text-base md:text-lg font-bold text-slate-800 truncate">
                                                    #{{ $item->no_permohonan }}
                                                </h3>
                                            </div>
                                            
                                            {{-- Status Badge --}}
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold shadow-sm
                                                @if($item->status === 'Dalam Proses') bg-amber-100 text-amber-800 border border-amber-200
                                                @elseif($item->status === 'Disetujui') bg-emerald-100 text-emerald-800 border border-emerald-200
                                                @else bg-red-100 text-red-800 border border-red-200
                                                @endif">
                                                <span class="w-1.5 h-1.5 rounded-full mr-1.5
                                                    @if($item->status === 'Dalam Proses') bg-amber-500 animate-pulse
                                                    @elseif($item->status === 'Disetujui') bg-emerald-500
                                                    @else bg-red-500
                                                    @endif">
                                                </span>
                                                {{ $item->status }}
                                            </span>
                                        </div>
                                        
                                        {{-- Document Indicators - Desktop --}}
                                        <div class="hidden sm:flex items-center gap-1.5">
                                            @if($item->kop_surat)
                                                <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center border border-blue-200 hover:bg-blue-100 transition-colors" title="Kop surat tersedia">
                                                    <i class="fas fa-image text-blue-600 text-sm"></i>
                                                </div>
                                            @endif
                                            @if($item->draft_surat)
                                                <div class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center border border-green-200 hover:bg-green-100 transition-colors" title="Draft surat siap">
                                                    <i class="fas fa-file-alt text-green-600 text-sm"></i>
                                                </div>
                                            @endif
                                            @if($item->surat_permohonan)
                                                <div class="w-8 h-8 bg-purple-50 rounded-lg flex items-center justify-center border border-purple-200 hover:bg-purple-100 transition-colors" title="Surat sudah diupload">
                                                    <i class="fas fa-check-circle text-purple-600 text-sm"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    {{-- Timestamp --}}
                                    <div class="flex items-center gap-3 text-xs text-slate-500">
                                        <div class="flex items-center">
                                            <i class="far fa-clock mr-1.5 text-xs"></i>
                                            {{ $item->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                    
                                    {{-- Rejection Reason Alert --}}
                                    @if($item->status === 'Ditolak' && $item->alasan_penolakan)
                                    <div class="mt-2 p-2 bg-red-50 border border-red-200 rounded-lg">
                                        <div class="flex items-start gap-2">
                                            <i class="fas fa-exclamation-circle text-red-600 text-xs mt-0.5"></i>
                                            <p class="text-xs text-red-700 leading-relaxed">
                                                <span class="font-semibold">Alasan penolakan:</span> {{ $item->alasan_penolakan }}
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Institution Info Grid --}}
                            <div class="grid grid-cols-2 gap-3 mb-4 p-3 bg-gradient-to-br from-slate-50 to-blue-50/30 rounded-xl border border-slate-200">
                                <div>
                                    <div class="flex items-center gap-1.5 mb-1">
                                        <i class="fas fa-building text-slate-400 text-xs"></i>
                                        <span class="text-[10px] md:text-xs font-medium text-slate-500 uppercase tracking-wide">Instansi</span>
                                    </div>
                                    <p class="text-xs md:text-sm font-semibold text-slate-800 line-clamp-1">{{ $item->nama_instansi ?? '-' }}</p>
                                </div>
                                <div>
                                    <div class="flex items-center gap-1.5 mb-1">
                                        <i class="fas fa-user-tie text-slate-400 text-xs"></i>
                                        <span class="text-[10px] md:text-xs font-medium text-slate-500 uppercase tracking-wide">Jabatan</span>
                                    </div>
                                    <p class="text-xs md:text-sm font-semibold text-slate-800 line-clamp-1">{{ $item->jabatan ?? '-' }}</p>
                                </div>
                            </div>

                            {{-- Items Section - Daftar Barang --}}
                            <div class="mb-4">
                                <div class="flex items-center justify-between mb-3 pb-2 border-b border-slate-200">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-boxes text-slate-600 text-sm"></i>
                                        <span class="text-sm font-semibold text-slate-700">Daftar Barang</span>
                                    </div>
                                    <span class="text-xs font-medium text-slate-500 bg-slate-100 px-2.5 py-1 rounded-full">
                                        <i class="fas fa-box text-xs mr-1"></i>{{ $item->items->count() }} item
                                    </span>
                                </div>
                                
                                <div class="space-y-2">
                                    @foreach($item->items as $permohonanItem)
                                        <div class="flex items-center justify-between bg-white rounded-xl p-3 border border-slate-200 hover:border-indigo-300 hover:shadow-md transition-all duration-200">
                                            <div class="flex items-center gap-3 flex-1 min-w-0">
                                                {{-- Foto/Icon Barang --}}
                                                @if($permohonanItem->barang->fotoPrimary)
                                                    <div class="w-12 h-12 md:w-14 md:h-14 flex-shrink-0 rounded-lg overflow-hidden shadow-sm ring-2 ring-slate-200">
                                                        <img src="{{ $permohonanItem->barang->fotoPrimary->foto_url }}" 
                                                            alt="{{ $permohonanItem->barang->nama_barang }}"
                                                            class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                                    </div>
                                                @else
                                                    <div class="w-12 h-12 md:w-14 md:h-14 bg-gradient-to-br from-indigo-50 to-blue-50 rounded-lg flex items-center justify-center flex-shrink-0 border-2 border-indigo-100">
                                                        <i class="fas fa-cube text-indigo-600 text-xl"></i>
                                                    </div>
                                                @endif
                                                
                                                <div class="flex-1 min-w-0 pr-2">
                                                    <p class="text-xs md:text-sm font-semibold text-slate-800 truncate leading-tight mb-1">
                                                        {{ $permohonanItem->barang->nama_barang ?? 'N/A' }}
                                                    </p>
                                                    <div class="flex items-center gap-1.5">
                                                        <i class="fas fa-tag text-slate-400 text-[10px]"></i>
                                                        <p class="text-[10px] md:text-xs text-slate-500 truncate">
                                                            {{ $permohonanItem->barang->kategori->nama_kategori ?? 'N/A' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="text-right flex-shrink-0 ml-2">
                                                <div class="bg-indigo-50 px-2.5 py-1.5 rounded-lg border border-indigo-200">
                                                    <p class="text-sm md:text-base font-bold text-indigo-700 whitespace-nowrap">
                                                        {{ $permohonanItem->jumlah }} <span class="text-[10px] md:text-xs font-normal">unit</span>
                                                    </p>
                                                </div>
                                                @if($permohonanItem->barang && $permohonanItem->barang->harga_sewa > 0)
                                                    <p class="text-[9px] md:text-xs text-slate-500 whitespace-nowrap mt-1">
                                                        <i class="fas fa-coins text-xs mr-1"></i>Rp {{ number_format($permohonanItem->barang->harga_sewa, 0, ',', '.') }}/hari
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Document Indicators - Mobile --}}
                            <div class="flex sm:hidden items-center gap-2 mb-4 pb-4 border-b border-slate-200">
                                @if($item->kop_surat)
                                    <div class="flex items-center gap-1.5 px-2.5 py-1.5 bg-blue-50 rounded-lg border border-blue-200 text-xs text-blue-700">
                                        <i class="fas fa-image"></i>
                                        <span>Kop Surat</span>
                                    </div>
                                @endif
                                @if($item->draft_surat)
                                    <div class="flex items-center gap-1.5 px-2.5 py-1.5 bg-green-50 rounded-lg border border-green-200 text-xs text-green-700">
                                        <i class="fas fa-file-alt"></i>
                                        <span>Draft</span>
                                    </div>
                                @endif
                                @if($item->surat_permohonan)
                                    <div class="flex items-center gap-1.5 px-2.5 py-1.5 bg-purple-50 rounded-lg border border-purple-200 text-xs text-purple-700">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Uploaded</span>
                                    </div>
                                @endif
                            </div>

                            {{-- Progress Alert for "Dalam Proses" --}}
                            @if($item->status === 'Dalam Proses')
                                <div class="mb-4 p-3 md:p-4 bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-xl">
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 bg-amber-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-info-circle text-white text-sm"></i>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="text-sm font-bold text-amber-900 mb-2 flex items-center gap-2">
                                                <i class="fas fa-tasks text-xs"></i>
                                                Langkah Selanjutnya
                                            </h4>
                                            <div class="space-y-2">
                                                @if(!$item->draft_surat)
                                                    <div class="flex items-start text-xs text-amber-800">
                                                        <div class="w-4 h-4 border-2 border-amber-500 rounded-full mr-2.5 animate-pulse flex-shrink-0 mt-0.5"></div>
                                                        <span>Sistem sedang memproses draft surat Anda...</span>
                                                    </div>
                                                @elseif(!$item->surat_permohonan)
                                                    <div class="flex items-start text-xs text-green-800">
                                                        <div class="w-4 h-4 bg-green-500 rounded-full mr-2.5 flex items-center justify-center flex-shrink-0 mt-0.5">
                                                            <i class="fas fa-check text-white text-[8px]"></i>
                                                        </div>
                                                        <span class="font-medium">Draft surat siap → Download, cetak & tanda tangan</span>
                                                    </div>
                                                    <div class="flex items-start text-xs text-amber-800">
                                                        <div class="w-4 h-4 border-2 border-amber-400 rounded-full mr-2.5 flex-shrink-0 mt-0.5"></div>
                                                        <span>Upload surat yang sudah ditandatangani</span>
                                                    </div>
                                                @else
                                                    <div class="flex items-start text-xs text-green-800">
                                                        <div class="w-4 h-4 bg-green-500 rounded-full mr-2.5 flex items-center justify-center flex-shrink-0 mt-0.5">
                                                            <i class="fas fa-check text-white text-[8px]"></i>
                                                        </div>
                                                        <span class="font-medium">Surat sudah diupload → Menunggu review admin</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Action Buttons - Mobile Optimized with Icon Animation (No Overlay Effect) --}}
                            <div class="flex flex-col sm:flex-row sm:flex-wrap gap-2 sm:gap-3">
                                {{-- Primary Action --}}
                                <a href="{{ route('permohonan.show', $item) }}" 
                                class="btn-action relative w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                    <i class="icon-action fas fa-eye mr-2 transition-transform duration-300"></i>
                                    <span>Lihat Detail</span>
                                </a>

                                {{-- Secondary Actions --}}
                                @if($item->status === 'Dalam Proses')
                                    <a href="{{ route('permohonan.edit', $item) }}" 
                                    class="btn-action relative w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                        <i class="icon-action icon-rotate-left fas fa-edit mr-2 transition-transform duration-300"></i>
                                        <span>Edit</span>
                                    </a>

                                    <form method="POST" action="{{ route('permohonan.destroy', $item) }}" class="w-full sm:w-auto" 
                                        onsubmit="return confirm('Apakah Anda yakin ingin membatalkan permohonan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn-action relative w-full inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-red-500 to-rose-500 hover:from-red-600 hover:to-rose-600 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                            <i class="icon-action fas fa-trash-alt mr-2 transition-transform duration-300"></i>
                                            <span>Batalkan</span>
                                        </button>
                                    </form>
                                @endif

                                {{-- Additional Actions --}}
                                @if($item->draft_surat && $item->status === 'Dalam Proses')
                                    <a href="{{ route('permohonan.downloadDraft', $item) }}" 
                                    class="btn-action relative w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                        <i class="icon-action icon-rotate-left fas fa-download mr-2 transition-transform duration-300"></i>
                                        <span>Download Draft</span>
                                    </a>
                                @endif

                                @if($item->status === 'Disetujui' && $item->peminjaman)
                                    <a href="{{ route('peminjaman.show', $item->peminjaman) }}" 
                                    class="btn-action relative w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-600 hover:to-green-600 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                        <i class="icon-action fas fa-clipboard-list mr-2 transition-transform duration-300"></i>
                                        <span>Lihat Peminjaman</span>
                                    </a>
                                @endif

                                @if($item->surat_permohonan)
                                    <a href="{{ Storage::url($item->surat_permohonan) }}" target="_blank"
                                    class="btn-action relative w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-purple-500 to-indigo-500 hover:from-purple-600 hover:to-indigo-600 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                        <i class="icon-action fas fa-file-pdf mr-2 transition-transform duration-300"></i>
                                        <span>Lihat Surat</span>
                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Enhanced Pagination --}}
            @if($permohonan->hasPages())
                <div class="px-4 md:px-6 py-5 border-t border-slate-200 bg-slate-50">
                    <div class="flex items-center justify-between">
                        {{-- Mobile Pagination --}}
                        <div class="flex-1 flex justify-between sm:hidden">
                            @if($permohonan->onFirstPage())
                                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-400 bg-white border border-slate-300 cursor-not-allowed rounded-lg">
                                    <i class="fas fa-chevron-left mr-2"></i>
                                    Previous
                                </span>
                            @else
                                <a href="{{ $permohonan->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">
                                    <i class="fas fa-chevron-left mr-2"></i>
                                    Previous
                                </a>
                            @endif

                            @if($permohonan->hasMorePages())
                                <a href="{{ $permohonan->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">
                                    Next
                                    <i class="fas fa-chevron-right ml-2"></i>
                                </a>
                            @else
                                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-slate-400 bg-white border border-slate-300 cursor-not-allowed rounded-lg">
                                    Next
                                    <i class="fas fa-chevron-right ml-2"></i>
                                </span>
                            @endif
                        </div>

                        {{-- Desktop Pagination --}}
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-slate-600 flex items-center gap-1">
                                    <i class="fas fa-info-circle text-indigo-500"></i>
                                    Menampilkan <span class="font-semibold text-slate-800">{{ $permohonan->firstItem() }}</span> 
                                    sampai <span class="font-semibold text-slate-800">{{ $permohonan->lastItem() }}</span> 
                                    dari <span class="font-semibold text-slate-800">{{ $permohonan->total() }}</span> hasil
                                </p>
                            </div>
                            <div>
                                {{ $permohonan->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @else
            {{-- Enhanced Empty State --}}
            <div class="text-center py-16 md:py-20 px-6">
                <div class="relative inline-block mb-6">
                    <div class="w-24 h-24 bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100 rounded-2xl flex items-center justify-center mx-auto shadow-lg">
                        <i class="fas fa-inbox text-slate-400 text-5xl"></i>
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-indigo-500 rounded-lg flex items-center justify-center shadow-lg animate-bounce">
                        <i class="fas fa-plus text-white text-lg"></i>
                    </div>
                </div>

                <h3 class="text-xl md:text-2xl font-bold text-slate-800 mb-3">Belum Ada Permohonan</h3>
                <p class="text-sm md:text-base text-slate-600 mb-8 max-w-md mx-auto leading-relaxed">
                    Anda belum pernah mengajukan permohonan peminjaman barang. Mulai dengan membuat permohonan pertama Anda sekarang.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a href="{{ route('permohonan.create') }}" 
                    class="w-full sm:w-auto inline-flex items-center justify-center px-6 md:px-8 py-3 md:py-4 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 group">
                        <i class="fas fa-plus-circle mr-2 md:mr-3 group-hover:scale-110 transition-transform"></i>
                        Buat Permohonan Pertama
                    </a>
                    
                    <a href="{{ route('user.barang') }}" 
                    class="w-full sm:w-auto inline-flex items-center justify-center px-4 md:px-6 py-3 md:py-4 text-slate-700 bg-slate-100 hover:bg-slate-200 font-semibold rounded-xl transition-all duration-300 group border border-slate-200">
                        <i class="fas fa-boxes mr-2 group-hover:scale-110 transition-transform"></i>
                        Lihat Daftar Barang
                    </a>
                </div>                
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
        /* Enhanced mobile-first animations */
    @keyframes slideInUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    .group:hover .group-hover\:scale-110 {
        animation: pulse 0.3s ease-in-out;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
    
    /* Line clamp utility */
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Smooth transitions for all interactive elements */
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }
    
    /* Custom scrollbar for mobile */
    @media (max-width: 640px) {
        ::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 2px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    }
    
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
</style>
@endpush

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script>
// Enhanced Permohonan Index JavaScript - Complete Version with Auto Scroll
class PermohonanIndex {
    constructor() {
        this.init();
    }

    init() {
        this.initCounters();
        this.initInteractiveElements();
        this.bindEvents();
        this.showLoadingComplete();
        this.initAOS();
    }

    // Counter Animation Function
    initCounters() {
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
                    counter.style.transform = 'scale(1.05)';
                    setTimeout(() => {
                        counter.style.transform = 'scale(1)';
                    }, 150);
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
            counter.style.transition = 'transform 0.15s ease';
            observer.observe(counter);
        });
    }

    initInteractiveElements() {
        this.addCardHoverEffects();
        this.addButtonRippleEffects();
        this.addStatusBadgeAnimations();
    }

    addCardHoverEffects() {
        const cards = document.querySelectorAll('.group');
        cards.forEach(card => {
            card.addEventListener('mouseenter', (e) => {
                e.currentTarget.style.transform = 'translateY(-2px) scale(1.005)';
                e.currentTarget.style.transition = 'all 0.2s cubic-bezier(0.4, 0, 0.2, 1)';
            });
            
            card.addEventListener('mouseleave', (e) => {
                e.currentTarget.style.transform = 'translateY(0) scale(1)';
            });
        });
    }

    addButtonRippleEffects() {
        const buttons = document.querySelectorAll('a[class*="bg-gradient"], button[class*="bg-gradient"]');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: rgba(255, 255, 255, 0.3);
                    border-radius: 50%;
                    transform: scale(0);
                    animation: ripple 0.4s ease-out;
                    pointer-events: none;
                `;
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 400);
            });
        });
    }

    addStatusBadgeAnimations() {
        const statusBadges = document.querySelectorAll('span[class*="bg-amber-100"], span[class*="bg-emerald-100"], span[class*="bg-red-100"], span[class*="bg-orange-100"], span[class*="bg-green-100"]');
        statusBadges.forEach(badge => {
            badge.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.03)';
                this.style.transition = 'transform 0.15s ease';
            });
            
            badge.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });
    }

    showLoadingComplete() {
        setTimeout(() => {
            document.body.classList.add('loaded');
            this.addLoadingCompleteStyles();
        }, 50);
    }

    addLoadingCompleteStyles() {
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                from { transform: scale(0); opacity: 1; }
                to { transform: scale(4); opacity: 0; }
            }
            
            .counter, #total-counter-hero {
                display: inline-block;
                font-variant-numeric: tabular-nums;
                transition: all 0.15s ease;
            }
        `;
        document.head.appendChild(style);
    }

    bindEvents() {
        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (e.ctrlKey || e.metaKey) {
                if (e.key === 'n') {
                    e.preventDefault();
                    const createBtn = document.querySelector('a[href*="permohonan.create"]');
                    if (createBtn) {
                        window.location.href = createBtn.href;
                    }
                }
            }
        });

        // Parallax scroll effect
        let ticking = false;
        document.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    this.handleScroll();
                    ticking = false;
                });
                ticking = true;
            }
        });
    }

    handleScroll() {
        const scrolled = window.pageYOffset;
        const bgElements = document.querySelectorAll('.absolute');
        bgElements.forEach((element, index) => {
            if (element.classList.contains('blur-3xl') || element.classList.contains('blur-2xl')) {
                const speed = 0.05 + (index * 0.02);
                element.style.transform = `translateY(${scrolled * speed}px)`;
            }
        });
    }

    initAOS() {
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                mirror: false,
            });
        }
    }
}

// Advanced Filters
function initAdvancedFilters() {
    const toggleBtn = document.getElementById('toggle-advanced');
    const toggleText = document.getElementById('toggle-text');
    const toggleIcon = document.getElementById('toggle-icon');
    const advancedFilters = document.getElementById('advanced-filters');
    const sortOrderBtn = document.getElementById('sort_order_btn');
    const sortOrderInput = document.getElementById('sort_order');

    // Check if any advanced filters are active on page load
    const urlParams = new URLSearchParams(window.location.search);
    const hasAdvancedFilters = urlParams.has('kategori') || 
                              urlParams.has('tanggal_mulai') ||
                              urlParams.has('tanggal_selesai');
    
    if (hasAdvancedFilters && advancedFilters) {
        advancedFilters.classList.remove('hidden');
        if (toggleText) toggleText.textContent = 'Sembunyikan Filter Lanjutan';
        if (toggleIcon) toggleIcon.classList.add('rotate-180');
    }

    if (toggleBtn && advancedFilters && toggleText && toggleIcon) {
        toggleBtn.addEventListener('click', function() {
            const isHidden = advancedFilters.classList.contains('hidden');
            
            if (isHidden) {
                advancedFilters.classList.remove('hidden');
                toggleText.textContent = 'Sembunyikan Filter Lanjutan';
                toggleIcon.classList.add('rotate-180');
                
                advancedFilters.style.maxHeight = '0px';
                advancedFilters.style.opacity = '0';
                advancedFilters.style.transition = 'all 0.3s ease-in-out';
                
                requestAnimationFrame(() => {
                    advancedFilters.style.maxHeight = '400px';
                    advancedFilters.style.opacity = '1';
                });
            } else {
                advancedFilters.style.maxHeight = '0px';
                advancedFilters.style.opacity = '0';
                
                setTimeout(() => {
                    advancedFilters.classList.add('hidden');
                    toggleText.textContent = 'Tampilkan Filter Lanjutan';
                    toggleIcon.classList.remove('rotate-180');
                    advancedFilters.style.maxHeight = '';
                    advancedFilters.style.opacity = '';
                    advancedFilters.style.transition = '';
                }, 300);
            }
        });
    }

    if (sortOrderBtn && sortOrderInput) {
        sortOrderBtn.addEventListener('click', function() {
            const currentOrder = this.dataset.order;
            const newOrder = currentOrder === 'desc' ? 'asc' : 'desc';
            
            this.dataset.order = newOrder;
            sortOrderInput.value = newOrder;
            
            const icon = this.querySelector('svg');
            if (icon) {
                icon.style.transition = 'transform 0.2s ease';
                if (newOrder === 'asc') {
                    icon.classList.add('rotate-180');
                    this.classList.remove('bg-slate-100');
                } else {
                    icon.classList.remove('rotate-180');
                    this.classList.add('bg-slate-100');
                }
            }
            
            this.style.opacity = '0.7';
            setTimeout(() => {
                this.closest('form').submit();
            }, 100);
        });
    }
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
    @if(request()->hasAny(['search', 'status', 'kategori', 'tanggal_mulai', 'tanggal_selesai']))
        setTimeout(() => {
            // Cari card permohonan pertama langsung
            const firstCard = document.querySelector('#hasil-filter');
            
            if (firstCard) {
                // Hitung posisi card dengan offset untuk navbar
                const elementPosition = firstCard.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - 180;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
                
                console.log('✓ Auto scroll ke card permohonan berhasil');
                console.log('Posisi scroll:', offsetPosition);
            } else {
                console.log('✗ Card permohonan tidak ditemukan');
            }
        }, 1000);
    @endif
}

// Form Enhancements
function initFormEnhancements() {
    const autoSubmitSelects = ['status', 'kategori', 'sort_by'];
    autoSubmitSelects.forEach(selectId => {
        const select = document.getElementById(selectId);
        if (select) {
            select.addEventListener('change', function() {
                this.style.opacity = '0.7';
                setTimeout(() => {
                    this.form.submit();
                }, 100);
            });
        }
    });

    const tanggalMulai = document.getElementById('tanggal_mulai');
    const tanggalSelesai = document.getElementById('tanggal_selesai');
    
    if (tanggalMulai && tanggalSelesai) {
        const addValidationFeedback = (input, isValid) => {
            if (isValid) {
                input.classList.remove('border-red-300');
                input.classList.add('border-green-300');
            } else {
                input.classList.remove('border-green-300');
                input.classList.add('border-red-300');
            }
            
            setTimeout(() => {
                input.classList.remove('border-red-300', 'border-green-300');
            }, 2000);
        };

        tanggalMulai.addEventListener('change', function() {
            if (this.value && tanggalSelesai.value && this.value > tanggalSelesai.value) {
                tanggalSelesai.value = this.value;
                addValidationFeedback(tanggalSelesai, true);
            }
        });
        
        tanggalSelesai.addEventListener('change', function() {
            if (this.value && tanggalMulai.value && this.value < tanggalMulai.value) {
                tanggalMulai.value = this.value;
                addValidationFeedback(tanggalMulai, true);
            }
        });
    }

    const searchInput = document.getElementById('search');
    if (searchInput) {
        let searchTimeout;
        
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            this.style.borderColor = '#6366f1';
            
            searchTimeout = setTimeout(() => {
                this.style.borderColor = '';
            }, 1000);
        });

        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && this.value) {
                this.value = '';
                this.style.borderColor = '#ef4444';
                setTimeout(() => {
                    this.style.borderColor = '';
                    this.form.submit();
                }, 300);
            }
        });
    }
}

// Refresh Counters Function
function refreshCounters() {
    const counters = document.querySelectorAll('.counter, #total-counter-hero');
    counters.forEach((counter, index) => {
        setTimeout(() => {
            counter.style.transform = 'scale(0.9)';
            setTimeout(() => {
                counter.style.transform = 'scale(1)';
            }, 100);
        }, index * 50);
    });
}

// Preload Assets
function preloadAssets() {
    const preloadLinks = ['/css/app.css', '/js/app.js'];
    preloadLinks.forEach(href => {
        const link = document.createElement('link');
        link.rel = 'preload';
        link.as = href.endsWith('.css') ? 'style' : 'script';
        link.href = href;
        document.head.appendChild(link);
    });
}

// Make refreshCounters available globally
window.refreshCounters = refreshCounters;

// Single DOMContentLoaded Event Listener
document.addEventListener('DOMContentLoaded', function() {
    // Initialize main class
    window.permohonanIndex = new PermohonanIndex();
    
    // Initialize other features
    initAdvancedFilters();
    initFilterLoading(); // Filter loading animation
    initFormEnhancements();
    autoScrollToResults(); // Auto scroll ke hasil filter
    preloadAssets();
});
</script>
@endpush
@endsection