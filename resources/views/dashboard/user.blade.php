@extends('layouts.user')

@section('title', 'Dashboard - Pelita App')

@section('content')
<!-- Hero Section with Gradient -->
<div class="relative bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-0 left-1/3 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 lg:py-20">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-8 lg:gap-12">
            <!-- Welcome Content - Left Side with Avatar -->
            <div class="text-white space-y-4 lg:space-y-6 relative z-10 flex-1 w-full" data-aos="fade-up">
                <div class="flex items-center gap-3 mb-4">
                    <!-- User Avatar -->
                    <div class="relative">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                alt="{{ Auth::user()->name }}" 
                                class="w-14 h-14 md:w-20 md:h-20 rounded-full border-4 border-white/30 shadow-2xl object-cover">
                        @else
                            <div class="w-14 h-14 md:w-20 md:h-20 rounded-full border-4 border-white/30 shadow-2xl bg-gradient-to-br from-blue-400 to-purple-400 flex items-center justify-center">
                                <span class="text-2xl md:text-3xl font-bold text-white">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                            </div>
                        @endif
                        
                        <!-- Online Status Badge -->
                        <div class="absolute -bottom-1 -right-1 w-5 h-5 md:w-6 md:h-6 bg-green-500 rounded-full border-4 border-white/20 flex items-center justify-center">
                            <div class="w-2 h-2 md:w-3 md:h-3 bg-green-400 rounded-full animate-pulse"></div>
                        </div>
                    </div>
                    
                    <!-- Online Badge -->
                    <div class="inline-flex items-center px-3 py-1.5 bg-white/10 backdrop-blur-sm rounded-full text-xs md:text-sm">
                        <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                        Online
                    </div>
                </div>
                
                <div>
                    <h1 class="text-2xl sm:text-3xl lg:text-5xl xl:text-6xl font-bold mb-2 md:mb-4 leading-tight">
                        Selamat Datang, <br class="hidden sm:block"/>
                        <span class="bg-gradient-to-r from-yellow-400 via-orange-500 to-yellow-400 bg-clip-text text-transparent animate-gradient-text">
                            {{ Auth::user()->name }}!
                        </span>
                    </h1>

                    <p class="text-sm md:text-lg lg:text-xl text-blue-100 max-w-2xl">
                        Kelola peminjaman aset dengan mudah dan cepat di Cimahi Technopark
                    </p>
                </div>
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-2">
                    <a href="{{ route('permohonan.create') }}" 
                    class="group relative inline-flex items-center justify-center px-6 py-3 md:px-8 md:py-4 bg-white text-blue-700 font-bold rounded-xl shadow-2xl hover:shadow-white/20 transform hover:scale-105 transition-all duration-300 overflow-hidden text-sm md:text-base">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-purple-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <svg class="relative w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="relative">Buat Permohonan</span>
                    </a>
                    
                    <a href="{{ route('user.barang') }}" 
                    class="group inline-flex items-center justify-center px-6 py-3 md:px-8 md:py-4 bg-white/10 backdrop-blur-sm text-white font-bold rounded-xl border-2 border-white/30 hover:bg-white/20 hover:border-white/50 shadow-lg transform hover:scale-105 transition-all duration-300 text-sm md:text-base">
                        <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        Jelajahi Aset
                    </a>
                </div>
            </div>
            
            <!-- Logo with Floating Animation - Right Side -->
            <div class="relative lg:flex-shrink-0 hidden lg:block" data-aos="fade-left">
                <div class="relative w-80 h-80">
                    <!-- Decorative circles -->
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-white/5 rounded-full backdrop-blur-sm"></div>
                    
                    <!-- Logo with floating animation -->
                    <div class="absolute inset-0 flex items-center justify-center p-16 animate-float">
                        <img src="{{ asset('images/logo ctp.png') }}" 
                            alt="Cimahi Technopark Logo" 
                            class="w-full h-full object-contain drop-shadow-2xl">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<!-- Modern Wave Divider - Enhanced with More Dynamic Waves for Dashboard -->
<div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
    <svg class="relative block w-full h-[60px] md:h-[100px] lg:h-[150px]" viewBox="0 0 1200 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
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

<div class="bg-slate-50 pt-0 pb-8 md:pb-16 mt-4 md:mt-8">
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
                        {{ $stats['permohonan_pending'] }}
                    </div>
                    <div class="text-[11px] md:text-sm text-gray-600 leading-tight">Menunggu Persetujuan</div>
                </div>
                <div class="mt-2 md:mt-3 flex items-center justify-center md:justify-start text-[10px] md:text-xs text-orange-600 opacity-0 group-hover:opacity-100 transition-opacity">
                    <span class="hidden md:inline">Lihat Detail</span>
                    <svg class="w-3 h-3 md:w-4 md:h-4 md:ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </a>

            <!-- Card 2: Payment Status -->
            <a href="{{ route('pembayaran.index') }}" 
            class="group bg-white rounded-xl md:rounded-2xl p-3 md:p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-amber-100 hover:border-amber-300 transform hover:-translate-y-2 cursor-pointer">
                <div class="flex flex-col md:flex-row items-center md:justify-between mb-2 md:mb-4">
                    <div class="p-2 md:p-3 bg-gradient-to-br from-amber-500 to-yellow-500 rounded-lg md:rounded-xl shadow-lg group-hover:scale-110 transition-transform mb-2 md:mb-0">
                        <svg class="w-4 h-4 md:w-6 md:h-6 text-white" viewBox="0 -3 38 38" fill="currentColor">
                            <path d="M36.002 23.010l0.057-17.089-31.050 0.019-0.001-1.96h32.992v19.031l-1.998-0.001zM34.995 26.017l-1.997-0.002 0.057-17.089-31.050 0.020-0.001-1.96h32.992v19.031zM32.053 28.020h-32.053v-18.030h32.053v18.030zM30.049 11.931h-28.046v14.086h28.045v-14.086zM27.045 24.515c0 0.177 0.044 0.342 0.101 0.5h-11.12c2.766 0 5.009-2.69 5.009-6.010s-2.243-6.010-5.009-6.010h11.119c-0.057 0.158-0.101 0.323-0.101 0.501 0 0.83 0.672 1.502 1.502 1.502 0.178 0 0.343-0.044 0.501-0.101v8.215c-0.158-0.056-0.323-0.101-0.501-0.101-0.829 0.001-1.501 0.674-1.501 1.504zM25.041 16.919c-0.83 0-1.502 0.896-1.502 2.003s0.672 2.003 1.502 2.003 1.502-0.896 1.502-2.003-0.672-2.003-1.502-2.003zM18.123 15.394c0.015 0.029 0.027 0.068 0.037 0.116 0.011 0.048 0.018 0.109 0.021 0.182 0.005 0.073 0.007 0.164 0.007 0.273 0 0.121-0.003 0.224-0.009 0.307-0.007 0.084-0.018 0.153-0.031 0.207-0.016 0.055-0.036 0.095-0.062 0.119-0.027 0.025-0.064 0.038-0.11 0.038s-0.118-0.029-0.219-0.087c-0.101-0.059-0.224-0.121-0.369-0.189s-0.315-0.131-0.507-0.187-0.402-0.084-0.632-0.084c-0.18 0-0.336 0.021-0.469 0.065-0.134 0.044-0.246 0.104-0.335 0.181s-0.157 0.17-0.2 0.277c-0.044 0.108-0.066 0.223-0.066 0.343 0 0.18 0.049 0.335 0.147 0.467s0.229 0.248 0.395 0.35c0.165 0.103 0.352 0.198 0.56 0.288s0.421 0.185 0.638 0.284c0.217 0.101 0.43 0.214 0.639 0.342 0.209 0.127 0.395 0.279 0.557 0.456 0.163 0.178 0.295 0.386 0.395 0.626s0.15 0.522 0.15 0.848c0 0.425-0.080 0.799-0.238 1.119-0.158 0.321-0.373 0.59-0.645 0.805s-0.588 0.376-0.951 0.484c-0.046 0.014-0.096 0.020-0.143 0.031v1.094h-0.985v-0.965c-0.013 0-0.024 0.003-0.037 0.003-0.279 0-0.539-0.023-0.779-0.068s-0.452-0.101-0.635-0.164c-0.184-0.064-0.337-0.132-0.46-0.202s-0.212-0.132-0.266-0.186-0.093-0.132-0.116-0.234-0.035-0.25-0.035-0.442c0-0.129 0.004-0.238 0.013-0.325 0.008-0.088 0.022-0.159 0.041-0.214 0.019-0.054 0.044-0.093 0.075-0.116 0.031-0.022 0.068-0.034 0.109-0.034 0.059 0 0.141 0.034 0.248 0.104 0.106 0.068 0.243 0.145 0.41 0.228s0.366 0.159 0.598 0.228c0.231 0.069 0.5 0.104 0.804 0.104 0.2 0 0.38-0.024 0.538-0.072s0.293-0.116 0.404-0.203c0.11-0.088 0.194-0.197 0.253-0.326s0.088-0.274 0.088-0.433c0-0.184-0.051-0.342-0.15-0.473-0.1-0.132-0.23-0.248-0.391-0.351s-0.343-0.198-0.547-0.287c-0.205-0.090-0.415-0.185-0.632-0.285s-0.428-0.214-0.632-0.341c-0.204-0.127-0.387-0.279-0.547-0.457-0.16-0.177-0.291-0.387-0.391-0.628-0.1-0.242-0.15-0.532-0.15-0.87 0-0.388 0.072-0.729 0.216-1.022 0.144-0.294 0.338-0.538 0.582-0.732s0.532-0.339 0.863-0.435c0.17-0.049 0.346-0.085 0.527-0.109v-1.035h0.985v1.035c0.039 0.005 0.078 0.003 0.117 0.009 0.192 0.029 0.372 0.068 0.539 0.118 0.166 0.050 0.314 0.105 0.443 0.168s0.215 0.113 0.258 0.155c0.039 0.037 0.067 0.072 0.082 0.102zM11.018 19.005c0 3.319 2.242 6.010 5.008 6.010h-11.119c0.056-0.158 0.101-0.323 0.101-0.5 0-0.83-0.673-1.503-1.502-1.503-0.178 0-0.343 0.045-0.501 0.101v-8.215c0.158 0.057 0.323 0.101 0.501 0.101 0.83 0 1.502-0.672 1.502-1.502 0-0.178-0.045-0.343-0.101-0.501h11.119c-2.766-0.001-5.008 2.69-5.008 6.009zM7.011 16.919c-0.83 0-1.502 0.896-1.502 2.003s0.673 2.003 1.502 2.003c0.83 0 1.502-0.896 1.502-2.003s-0.672-2.003-1.502-2.003z"/>
                        </svg>
                    </div>
                    <span class="text-[10px] md:text-xs font-medium text-amber-600 bg-amber-50 px-2 md:px-3 py-0.5 md:py-1 rounded-full">Payment</span>
                </div>
                <div class="text-center md:text-left">
                    <div class="text-xl md:text-3xl font-bold text-gray-900 mb-0.5 md:mb-1 group-hover:text-amber-600 transition-colors">
                        {{ $stats['pembayaran_pending'] }}
                    </div>
                    <div class="text-[11px] md:text-sm text-gray-600">Menunggu Pembayaran</div>
                </div>
                <div class="mt-2 md:mt-3 flex items-center justify-center md:justify-start text-[10px] md:text-xs text-amber-600 opacity-0 group-hover:opacity-100 transition-opacity">
                    <span class="hidden md:inline">Lihat Detail</span>
                    <svg class="w-3 h-3 md:w-4 md:h-4 md:ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </a>

            <!-- Card 3: Active -->
            <a href="{{ route('peminjaman.index', ['status' => 'disetujui']) }}" 
            class="group bg-white rounded-xl md:rounded-2xl p-3 md:p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-blue-100 hover:border-blue-300 transform hover:-translate-y-2 cursor-pointer">
                <div class="flex flex-col md:flex-row items-center md:justify-between mb-2 md:mb-4">
                    <div class="p-2 md:p-3 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-lg md:rounded-xl shadow-lg group-hover:scale-110 transition-transform mb-2 md:mb-0">
                        <svg class="w-4 h-4 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] md:text-xs font-medium text-blue-600 bg-blue-50 px-2 md:px-3 py-0.5 md:py-1 rounded-full">Active</span>
                </div>
                <div class="text-center md:text-left">
                    <div class="text-xl md:text-3xl font-bold text-gray-900 mb-0.5 md:mb-1 group-hover:text-blue-600 transition-colors">
                        {{ $stats['peminjaman_aktif'] }}
                    </div>
                    <div class="text-[11px] md:text-sm text-gray-600">Sedang Dipinjam</div>
                </div>
                <div class="mt-2 md:mt-3 flex items-center justify-center md:justify-start text-[10px] md:text-xs text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity">
                    <span class="hidden md:inline">Lihat Detail</span>
                    <svg class="w-3 h-3 md:w-4 md:h-4 md:ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
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
                        {{ $stats['total_permohonan'] }}
                    </div>
                    <div class="text-[11px] md:text-sm text-gray-600">Total Permohonan</div>
                </div>
                <div class="mt-2 md:mt-3 flex items-center justify-center md:justify-start text-[10px] md:text-xs text-purple-600 opacity-0 group-hover:opacity-100 transition-opacity">
                    <span class="hidden md:inline">Lihat Detail</span>
                    <svg class="w-3 h-3 md:w-4 md:h-4 md:ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </a>
        </div>

        <!-- Upcoming Returns Alert -->
        @if(isset($upcomingReturns) && $upcomingReturns->count() > 0)
        <div class="mb-6 md:mb-8 mt-6 md:mt-10 relative z-10" data-aos="fade-up">
            <div class="bg-gradient-to-r from-blue-500 via-cyan-500 to-teal-500 rounded-2xl shadow-2xl overflow-hidden">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative p-4 md:p-6 lg:p-8">
                    <div class="flex items-start gap-4 mb-6">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 md:w-16 md:h-16 bg-white/20 backdrop-blur-sm rounded-xl md:rounded-2xl flex items-center justify-center animate-pulse">
                                <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 text-white">
                            <div class="flex items-center gap-3 mb-2">
                                <h3 class="text-lg md:text-2xl font-bold">⏰ Pengingat Pengembalian</h3>
                                <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-xs font-semibold animate-pulse">
                                    {{ $upcomingReturns->count() }} Item
                                </span>
                            </div>
                            <p class="text-blue-50 text-sm md:text-base">
                                Anda memiliki {{ $upcomingReturns->count() }} peminjaman yang akan berakhir dalam 7 hari ke depan. Jangan lupa untuk mengembalikan tepat waktu!
                            </p>
                        </div>
                    </div>

                    <!-- Upcoming Returns List -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($upcomingReturns as $return)
                            @php
                                $daysLeft = \Carbon\Carbon::now()->startOfDay()->diffInDays(\Carbon\Carbon::parse($return->tanggal_selesai)->startOfDay(), false);
                                $daysLeft = max(0, $daysLeft);
                                $isUrgent = $daysLeft <= 2;
                                $isToday = $daysLeft == 0;
                                $totalItems = $return->peminjamanDetail->sum('jumlah');
                            @endphp
                            
                            <div class="group bg-white/95 backdrop-blur-sm rounded-xl p-5 hover:bg-white transition-all duration-300 hover:shadow-xl transform hover:-translate-y-1">
                                <div class="flex items-start gap-3 mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br {{ $isUrgent ? 'from-red-500 to-pink-600' : 'from-blue-500 to-cyan-600' }} rounded-lg flex items-center justify-center text-white flex-shrink-0 shadow-lg">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-bold text-gray-900 text-sm mb-1">
                                            @if($return->peminjamanDetail->count() > 0)
                                                {{ $return->peminjamanDetail->first()->barang->nama_barang ?? 'Item' }}
                                                @if($return->peminjamanDetail->count() > 1)
                                                    <span class="text-xs font-normal text-gray-500">+{{ $return->peminjamanDetail->count() - 1 }} item lainnya</span>
                                                @endif
                                            @endif
                                        </h4>
                                        
                                        <p class="text-xs text-gray-600 mb-2">
                                            <span class="inline-flex items-center px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full font-medium">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                                {{ $totalItems }} Unit Total
                                            </span>
                                        </p>
                                        
                                        @if($return->peminjamanDetail->count() > 1)
                                        <details class="mb-3">
                                            <summary class="text-xs text-blue-600 hover:text-blue-800 cursor-pointer font-medium">
                                                Lihat semua barang yang dipinjam
                                            </summary>
                                            <div class="mt-2 space-y-1 pl-2 border-l-2 border-blue-200">
                                                @foreach($return->peminjamanDetail as $detail)
                                                <div class="flex items-center justify-between text-xs text-gray-700 py-1">
                                                    <span class="flex items-center">
                                                        <svg class="w-3 h-3 mr-1.5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"/>
                                                        </svg>
                                                        {{ $detail->barang->nama_barang ?? 'Item' }}
                                                    </span>
                                                    <span class="font-semibold text-blue-700">{{ $detail->jumlah }}x</span>
                                                </div>
                                                @endforeach
                                            </div>
                                        </details>
                                        @endif
                                    </div>
                                </div>

                                <!-- Countdown -->
                                <div class="mb-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs font-medium text-gray-600">Waktu Tersisa</span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold
                                            {{ $isToday ? 'bg-red-100 text-red-700 animate-pulse' : ($isUrgent ? 'bg-orange-100 text-orange-700' : 'bg-blue-100 text-blue-700') }}">
                                            @if($isToday)
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                                HARI INI!
                                            @elseif($daysLeft == 1)
                                                BESOK
                                            @else
                                                {{ $daysLeft }} HARI
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <!-- Progress Bar -->
                                    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                        @php
                                            $startDate = \Carbon\Carbon::parse($return->tanggal_mulai)->startOfDay();
                                            $endDate = \Carbon\Carbon::parse($return->tanggal_selesai)->startOfDay();
                                            $now = \Carbon\Carbon::now()->startOfDay();
                                            
                                            $totalDuration = $startDate->diffInDays($endDate);
                                            $elapsed = $startDate->diffInDays($now);
                                            $progress = $totalDuration > 0 ? min(($elapsed / $totalDuration) * 100, 100) : 100;
                                        @endphp
                                        <div class="h-2 rounded-full transition-all duration-500 {{ $isUrgent ? 'bg-gradient-to-r from-red-500 to-pink-600' : 'bg-gradient-to-r from-blue-500 to-cyan-600' }}" 
                                            style="width: {{ $progress }}%"></div>
                                    </div>
                                </div>

                                <!-- Return Date -->
                                <div class="flex items-center justify-between text-xs">
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($return->tanggal_selesai)->format('d M Y') }}
                                    </div>
                                    <a href="{{ route('peminjaman.show', $return->id) }}" 
                                    class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                        Detail
                                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>

                                @if($isUrgent)
                                <div class="mt-3 pt-3 border-t border-gray-200">
                                    <div class="flex items-center text-xs {{ $isToday ? 'text-red-600' : 'text-orange-600' }} font-medium">
                                        <svg class="w-4 h-4 mr-1 {{ $isToday ? 'animate-bounce' : '' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $isToday ? 'Segera kembalikan hari ini!' : 'Prioritas tinggi - kembalikan besok!' }}
                                    </div>
                                </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Quick Action Button -->
                    <div class="mt-6 flex items-center justify-between">
                        <a href="{{ route('peminjaman.index') }}" 
                        class="inline-flex items-center px-6 py-3 bg-white text-blue-600 font-bold rounded-xl hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Lihat Semua Peminjaman
                        </a>
                        <div class="flex items-center gap-2 text-white/90 text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Kembalikan tepat waktu untuk menjaga reputasi Anda
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Sidebar: Available Assets & Quick Actions -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Assets Card -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden" data-aos="fade-up">
                    <!-- Header with Gradient -->
                    <div class="relative bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 p-4 md:p-6 text-white overflow-hidden">
                        <!-- Decorative background -->
                        <div class="absolute inset-0 opacity-10">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-white rounded-full -mr-16 -mt-16"></div>
                            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white rounded-full -ml-12 -mb-12"></div>
                        </div>
                        
                        <div class="relative">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 md:w-12 md:h-12 bg-white/20 backdrop-blur-sm rounded-lg md:rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg md:text-xl font-bold">Aset Tersedia</h3>
                                        <p class="text-blue-100 text-xs">Real-time inventory</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 bg-white/20 backdrop-blur-sm px-3 py-1.5 rounded-full">
                                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                    <span class="text-xs font-medium">Live</span>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <div class="text-3xl md:text-5xl font-bold mb-2">{{ $availableAssets['barang_tersedia'] }}</div>
                                <div class="flex items-center gap-2 text-blue-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm font-medium">Item siap dipinjam</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Categories List -->
                    <div class="p-4 md:p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-bold text-gray-900 text-sm uppercase tracking-wide">Kategori Aset</h4>
                            <a href="{{ route('user.barang') }}" class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                                Lihat Semua →
                            </a>
                        </div>
                        
                        <div class="space-y-2.5 max-h-80 overflow-y-auto pr-2 custom-scrollbar">
                            @forelse($availableAssets['barang_by_kategori'] as $index => $kategori)
                                <div class="group relative">
                                    <div class="relative flex items-center justify-between p-3 md:p-4 bg-white hover:bg-gradient-to-br hover:from-blue-50 hover:to-indigo-50 rounded-xl border border-gray-200 hover:border-blue-300 transition-all duration-200 cursor-pointer hover:shadow-md">
                                        <div class="flex items-center gap-4 flex-1 min-w-0">
                                            <!-- Icon with dynamic gradient -->
                                            <div class="flex-shrink-0 w-9 h-9 md:w-11 md:h-11 bg-gradient-to-br from-blue-500 via-indigo-500 to-purple-500 rounded-lg flex items-center justify-center text-white shadow-sm transition-transform duration-200 group-hover:scale-105">
                                                @php
                                                    $icons = [
                                                        'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z',
                                                        'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z',
                                                        'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
                                                        'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4'
                                                    ];
                                                    $iconPath = $icons[$index % count($icons)];
                                                @endphp
                                                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}"></path>
                                                </svg>
                                            </div>
                                            
                                            <div class="flex-1 min-w-0">
                                                <h5 class="font-semibold text-gray-900 group-hover:text-blue-700 transition-colors duration-200 truncate">
                                                    {{ $kategori->nama_kategori }}
                                                </h5>
                                                <p class="text-xs text-gray-500 mt-0.5">
                                                    <span class="group-hover:text-blue-600 transition-colors duration-200">
                                                        {{ $kategori->barang_count }} item tersedia
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <!-- Count Badge -->
                                        <div class="flex-shrink-0 ml-3">
                                            <div class="bg-blue-100 group-hover:bg-blue-500 text-blue-700 group-hover:text-white px-3 py-1.5 rounded-full font-bold text-sm transition-all duration-200">
                                                {{ $kategori->barang_count }}
                                            </div>
                                        </div>
                                        
                                        <!-- Arrow indicator -->
                                        <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 transition-colors duration-200 ml-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                        </svg>
                                    </div>
                                    <h5 class="font-semibold text-gray-900 mb-1">Belum Ada Kategori</h5>
                                    <p class="text-sm text-gray-500">Kategori aset akan muncul di sini</p>
                                </div>
                            @endforelse
                        </div>
                        
                        <!-- Bottom CTA -->
                        <div class="mt-6 pt-6 border-t border-gray-100">
                            <a href="{{ route('user.barang') }}" 
                            class="group flex items-center justify-center w-full px-4 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                                <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Jelajahi Semua Aset
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up" data-aos-delay="100">
                    <h4 class="font-bold text-gray-900 mb-4">Quick Actions</h4>
                    <div class="space-y-3">
                        <a href="{{ route('permohonan.create') }}" class="flex items-center p-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:shadow-lg transform hover:scale-105 transition-all group">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold">Ajukan Permohonan</div>
                                <div class="text-xs opacity-90">Buat permohonan baru</div>
                            </div>
                        </a>

                        <a href="{{ route('permohonan.index') }}" class="flex items-center p-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-xl hover:shadow-lg transform hover:scale-105 transition-all group">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold">Lihat Permohonan</div>
                                <div class="text-xs opacity-90">Cek status permohonan</div>
                            </div>
                        </a>

                        <a href="{{ route('user.barang') }}" class="flex items-center p-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl hover:shadow-lg transform hover:scale-105 transition-all group">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold">Browse Aset</div>
                                <div class="text-xs opacity-90">Jelajahi katalog</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Content: Recent Activity & Pembayaran Pending -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Recent Activity Card -->
                <div class="bg-white rounded-2xl shadow-lg p-4 md:p-6 lg:p-8" data-aos="fade-up">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-xl md:text-2xl font-bold text-gray-900">Aktivitas Terbaru</h3>
                            <p class="text-sm text-gray-600 mt-1">Permohonan dan peminjaman Anda</p>
                        </div>
                        <a href="{{ route('permohonan.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-600 font-medium rounded-xl hover:bg-blue-100 transition-colors">
                            Lihat Semua
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    
                    <div class="space-y-4 max-h-[600px] overflow-y-auto custom-scrollbar">
                        @forelse($myPermohonan as $permohonan)
                            <div class="group p-4 md:p-5 border-2 border-gray-100 rounded-2xl hover:border-blue-200 hover:shadow-lg transition-all duration-300">
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0 w-12 h-12 md:w-14 md:h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                                        <svg class="w-6 h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                    
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-3 mb-3">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                                @if($permohonan->status === 'Dalam Proses') bg-orange-100 text-orange-700
                                                @elseif($permohonan->status === 'Disetujui') bg-green-100 text-green-700
                                                @elseif($permohonan->status === 'Ditolak') bg-red-100 text-red-700
                                                @else bg-gray-100 text-gray-700 @endif">
                                                @if($permohonan->status === 'Dalam Proses')
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Dalam Proses
                                                @elseif($permohonan->status === 'Disetujui')
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Disetujui
                                                @else
                                                    {{ ucfirst($permohonan->status) }}
                                                @endif
                                            </span>
                                            <span class="text-xs text-gray-500">{{ $permohonan->created_at->diffForHumans() }}</span>
                                        </div>
                                        
                                        @if($permohonan->permohonanItems && $permohonan->permohonanItems->count() > 0)
                                            <h4 class="font-bold text-gray-900 mb-2 text-base">
                                                Permohonan #{{ $permohonan->no_permohonan }}
                                            </h4>
                                            
                                            <div class="mb-3 space-y-1.5">
                                                @foreach($permohonan->permohonanItems as $item)
                                                    <div class="flex items-center gap-2 text-sm">
                                                        <svg class="w-4 h-4 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"/>
                                                        </svg>
                                                        <span class="text-gray-700">
                                                            {{ $item->barang->nama_barang ?? 'Item' }}
                                                        </span>
                                                        <span class="font-semibold text-blue-600">{{ $item->jumlah }}x</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                            
                                            <div class="inline-flex items-center px-2.5 py-1 bg-blue-50 text-blue-700 rounded-lg text-xs font-medium">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                                </svg>
                                                Total: {{ $permohonan->permohonanItems->sum('jumlah') }} item
                                            </div>
                                        @endif
                                        
                                        <div class="flex items-center gap-4 text-sm text-gray-600 my-3">
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                {{ \Carbon\Carbon::parse($permohonan->tanggal_mulai)->format('d M') }} - {{ \Carbon\Carbon::parse($permohonan->tanggal_selesai)->format('d M Y') }}
                                            </div>
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ \Carbon\Carbon::parse($permohonan->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($permohonan->tanggal_selesai)) + 1 }} hari
                                            </div>
                                        </div>
                                        
                                        @if($permohonan->keperluan)
                                            <p class="text-sm text-gray-600 mb-3">{{ Str::limit($permohonan->keperluan, 100) }}</p>
                                        @endif
                                        
                                        <div class="flex justify-end">
                                            <a href="{{ route('permohonan.show', $permohonan->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-600 font-medium rounded-lg hover:bg-blue-100 transition-colors text-sm">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16">
                                <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-12 h-12 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold text-gray-900 mb-2">Belum ada aktivitas</h4>
                                <p class="text-gray-600 mb-6 max-w-md mx-auto">Mulai dengan membuat permohonan peminjaman aset pertama Anda untuk melihat aktivitas di sini</p>
                                <a href="{{ route('permohonan.create') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:shadow-xl transform hover:-translate-y-1 transition-all">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Buat Permohonan Pertama
                                </a>
                            </div>
                        @endforelse
                    </div>

                    <!-- Active Loans Section -->
                    @if($myPeminjaman->count() > 0)
                    <div class="mt-8 pt-8 border-t-2 border-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <h4 class="text-xl font-bold text-gray-900">Peminjaman Aktif</h4>
                                {{-- ✅ TAMBAHKAN: Badge count --}}
                                <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $myPeminjaman->count() }} Aktif
                                </span>
                            </div>
                            <a href="{{ route('peminjaman.index', ['status' => 'disetujui']) }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                                Lihat Semua
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($myPeminjaman as $peminjaman)
                                {{-- ✅ VALIDASI TAMBAHAN: Pastikan status disetujui --}}
                                @if($peminjaman->status === 'disetujui')
                                <div class="group p-4 border-2 border-gray-100 rounded-xl hover:border-blue-200 hover:shadow-md transition-all">
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center text-white shadow">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h5 class="font-semibold text-gray-900 text-sm">
                                                @if($peminjaman->peminjamanDetail && $peminjaman->peminjamanDetail->count() > 0)
                                                    {{ Str::limit($peminjaman->peminjamanDetail->first()->barang->nama_barang ?? 'Item', 30) }}
                                                    @if($peminjaman->peminjamanDetail->count() > 1)
                                                        <span class="text-gray-500 font-normal text-xs">+{{ $peminjaman->peminjamanDetail->count() - 1 }} item lainnya</span>
                                                    @endif
                                                @endif
                                            </h5>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->format('d M') }} - {{ \Carbon\Carbon::parse($peminjaman->tanggal_selesai)->format('d M Y') }}
                                            </p>
                                        </div>
                                        {{-- ✅ UBAH: Badge status selalu "Aktif" untuk disetujui --}}
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Aktif
                                        </span>
                                    </div>
                                    
                                    {{-- ✅ TAMBAHKAN: Progress bar waktu peminjaman --}}
                                    @php
                                        $startDate = \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->startOfDay();
                                        $endDate = \Carbon\Carbon::parse($peminjaman->tanggal_selesai)->startOfDay();
                                        $now = \Carbon\Carbon::now()->startOfDay();
                                        
                                        $totalDuration = $startDate->diffInDays($endDate);
                                        $elapsed = $startDate->diffInDays($now);
                                        $progress = $totalDuration > 0 ? min(($elapsed / $totalDuration) * 100, 100) : 100;
                                        $daysLeft = max(0, $now->diffInDays($endDate, false));
                                    @endphp
                                    
                                    <div class="mb-3">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-xs text-gray-600">Progress Peminjaman</span>
                                            <span class="text-xs font-medium {{ $daysLeft <= 2 ? 'text-red-600' : 'text-blue-600' }}">
                                                {{ $daysLeft }} hari lagi
                                            </span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-1.5 overflow-hidden">
                                            <div class="h-1.5 rounded-full transition-all duration-500 {{ $daysLeft <= 2 ? 'bg-gradient-to-r from-red-500 to-pink-600' : 'bg-gradient-to-r from-blue-500 to-cyan-600' }}" 
                                                style="width: {{ $progress }}%"></div>
                                        </div>
                                    </div>
                                    
                                    @if($peminjaman->peminjamanDetail && $peminjaman->peminjamanDetail->count() > 1)
                                    <details class="mt-3">
                                        <summary class="text-xs text-blue-600 hover:text-blue-800 cursor-pointer font-medium">
                                            Lihat detail barang ({{ $peminjaman->peminjamanDetail->count() }} item)
                                        </summary>
                                        <div class="mt-2 space-y-1 pl-2 border-l-2 border-blue-200">
                                            @foreach($peminjaman->peminjamanDetail as $detail)
                                            <div class="flex items-center justify-between text-xs text-gray-700 py-1">
                                                <span class="flex items-center">
                                                    <svg class="w-3 h-3 mr-1.5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"/>
                                                    </svg>
                                                    {{ $detail->barang->nama_barang ?? 'Item' }}
                                                </span>
                                                <span class="font-semibold text-blue-700">{{ $detail->jumlah }}x</span>
                                            </div>
                                            @endforeach
                                        </div>
                                    </details>
                                    @endif
                                    
                                    {{-- ✅ TAMBAHKAN: Info pembayaran jika ada --}}
                                    @if($peminjaman->pembayaran)
                                    <div class="mt-3 pt-3 border-t border-gray-200">
                                        <div class="flex items-center justify-between text-xs">
                                            <span class="flex items-center text-gray-600">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                </svg>
                                                Pembayaran
                                            </span>
                                            <span class="font-semibold {{ $peminjaman->pembayaran->status === 'lunas' ? 'text-green-600' : 'text-orange-600' }}">
                                                {{ ucfirst($peminjaman->pembayaran->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    {{-- ✅ TAMBAHKAN: Button detail dengan icon --}}
                                    <div class="mt-3 pt-3 border-t border-gray-200">
                                        <a href="{{ route('peminjaman.show', $peminjaman->id) }}" 
                                        class="inline-flex items-center justify-center w-full px-4 py-2 bg-blue-50 text-blue-600 font-medium rounded-lg hover:bg-blue-100 transition-colors text-sm group">
                                            <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Lihat Detail Peminjaman
                                        </a>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                
                <!-- Pembayaran Pending Section -->
                @if(isset($pendingPembayaran) && $pendingPembayaran->count() > 0)
                <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Pembayaran Pending</h3>
                            <p class="text-sm text-gray-600 mt-1">Menunggu pembayaran</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse mr-2"></div>
                                <span class="text-xs text-red-600 font-medium">Action Required</span>
                            </div>
                            <a href="{{ route('pembayaran.index') }}" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 text-xs font-medium rounded-lg hover:bg-red-100 transition-colors">
                                Lihat Semua
                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        @foreach($pendingPembayaran as $pembayaran)
                            {{-- ✅ VALIDASI: Pastikan peminjaman disetujui --}}
                            @if($pembayaran->peminjaman && $pembayaran->peminjaman->status === 'disetujui')
                            <div class="p-4 bg-gradient-to-r from-red-50 to-pink-50 rounded-xl border border-red-200">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-red-900">
                                            @if($pembayaran->peminjaman && $pembayaran->peminjaman->peminjamanDetail && $pembayaran->peminjaman->peminjamanDetail->count() > 0)
                                                {{ $pembayaran->peminjaman->peminjamanDetail->first()->barang->nama_barang ?? 'Nama barang tidak tersedia' }}
                                                @if($pembayaran->peminjaman->peminjamanDetail->count() > 1)
                                                    <span class="text-red-700 text-sm">+{{ $pembayaran->peminjaman->peminjamanDetail->count() - 1 }} lainnya</span>
                                                @endif
                                            @else
                                                <span class="text-red-700">Data pembayaran tidak lengkap</span>
                                            @endif
                                        </h4>
                                        <div class="text-sm text-red-700 mt-1">
                                            Metode: {{ ucfirst($pembayaran->metode ?? 'Belum dipilih') }}
                                        </div>
                                        {{-- ✅ TAMBAHKAN: Info status peminjaman --}}
                                        <div class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium mt-2">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Peminjaman Disetujui
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-xs text-red-700 mb-1">Total</div>
                                        <div class="text-lg font-bold text-red-900">
                                            Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between mt-3">
                                    <div class="flex items-center text-xs text-red-700">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                        <span>Menunggu pembayaran</span>
                                    </div>
                                    @if(isset($pembayaran->id))
                                    <a href="{{ route('pembayaran.show', $pembayaran->id) }}" class="inline-flex items-center text-xs text-white bg-red-600 hover:bg-red-700 px-3 py-1.5 rounded-lg font-medium transition-colors">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                        Bayar Sekarang
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Tips Section - Full Width -->
        <div class="mt-12">
            <div class="bg-white rounded-2xl shadow-lg p-4 md:p-6 lg:p-8" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center gap-3 mb-4 md:mb-6">
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Tips & Panduan Peminjaman</h3>
                </div>
                
                <div class="space-y-4">
                    <div class="flex gap-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Lengkapi Data Permohonan dengan Benar</h4>
                            <p class="text-sm text-gray-600">Pastikan mengisi nomor KTP, alamat lengkap, dan informasi instansi dengan akurat. Upload kop surat dan draft surat permohonan sebelum mengirim.</p>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Lakukan Pembayaran Segera Setelah Disetujui</h4>
                            <p class="text-sm text-gray-600">Setelah permohonan disetujui, segera lakukan pembayaran melalui metode transfer atau cash. Upload bukti transfer untuk verifikasi cepat.</p>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Perhatikan Jadwal Peminjaman</h4>
                            <p class="text-sm text-gray-600">Pastikan tanggal mulai dan selesai peminjaman sesuai kebutuhan. Kembalikan barang tepat waktu untuk menjaga kredibilitas dan menghindari denda.</p>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-1">Cek Kondisi Barang Saat Pengambilan</h4>
                            <p class="text-sm text-gray-600">Periksa kondisi barang dengan teliti saat pengambilan dan pastikan sesuai dengan berita acara. Laporkan segera jika ada kerusakan atau ketidaksesuaian.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Overview -->
        <div class="bg-white rounded-2xl shadow-lg p-4 md:p-6 lg:p-8 mt-6 md:mt-8" data-aos="fade-up">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">Statistik Permohonan</h3>
                    <p class="text-sm text-gray-600 mt-1">Ringkasan aktivitas peminjaman Anda</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="text-4xl font-bold text-orange-600 mb-2">{{ $stats['permohonan_pending'] }}</div>
                    <div class="text-sm text-gray-600">Menunggu Persetujuan</div>
                    <div class="mt-3 w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-orange-500 to-red-500 h-2 rounded-full" style="width: {{ $stats['total_permohonan'] > 0 ? ($stats['permohonan_pending'] / $stats['total_permohonan']) * 100 : 0 }}%"></div>
                    </div>
                </div>

                <div class="text-center">
                    <div class="text-4xl font-bold text-green-600 mb-2">{{ $stats['permohonan_disetujui'] }}</div>
                    <div class="text-sm text-gray-600">Disetujui</div>
                    <div class="mt-3 w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-2 rounded-full" style="width: {{ $stats['total_permohonan'] > 0 ? ($stats['permohonan_disetujui'] / $stats['total_permohonan']) * 100 : 0 }}%"></div>
                    </div>
                </div>

                <div class="text-center">
                    <div class="text-4xl font-bold text-blue-600 mb-2">{{ $stats['peminjaman_aktif'] }}</div>
                    <div class="text-sm text-gray-600">Sedang Dipinjam</div>
                    <div class="mt-3 w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-2 rounded-full" style="width: {{ $stats['total_permohonan'] > 0 ? ($stats['peminjaman_aktif'] / $stats['total_permohonan']) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t-2 border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="text-sm text-gray-600">Tingkat Persetujuan</div>
                        <div class="text-2xl font-bold text-gray-900">
                            {{ $stats['total_permohonan'] > 0 ? number_format(($stats['permohonan_disetujui'] / $stats['total_permohonan']) * 100, 1) : 0 }}%
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm text-gray-600">Reputasi Baik</span>
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
    /* Custom Scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #3b82f6, #6366f1);
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #2563eb, #4f46e5);
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
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
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
        mirror: false,
    });

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
</script>
@endpush
@endsection