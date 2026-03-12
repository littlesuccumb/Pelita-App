@extends('layouts.user')

@section('title', 'Pembayaran Saya - Pelita App')

@section('content')
<!-- Hero Section with Gradient - Blue/Indigo Theme -->
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
                    <!-- Icon -->
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-white/20 to-white/5 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-2xl">
                            <svg class="w-10 h-10 text-white" viewBox="0 0 512 512" fill="currentColor">
                                <path d="M360,343.266c-6.5,0-11.75,5.25-11.75,11.734s5.25,11.75,11.75,11.75c6.469,0,11.734-5.266,11.734-11.75 S366.469,343.266,360,343.266z"/>
                                <path d="M475.531,306.203h-3.781v-55.297c0-14.063-4.75-27-12.672-37.375L512,179.438l-4.172-6.813L402.656,1.172 L180.938,137.141H94c-50.531,0-91.594,39.875-93.797,89.828l-0.016,0.109L0,243.516v35.719v137.594c0,51.922,42.078,93.984,94,94 h318.25c34.109-0.016,61.75-27.656,61.75-61.766v-45.266h1.531c9.672-0.016,17.5-7.828,17.516-17.5v-62.594 C493.031,314.031,485.219,306.203,475.531,306.203z M457.969,449.063c-0.016,12.641-5.125,24.031-13.406,32.328 c-8.281,8.281-19.656,13.375-32.313,13.391H94c-21.547-0.016-40.984-8.719-55.125-22.828 c-14.125-14.141-22.813-33.578-22.828-55.125V279.234v-35.563l0.203-16.047c1.828-41.406,35.906-74.453,77.75-74.438h60.781 l-58.563,35.953l-23.422,0.016v16.047l337.359-0.016c12.578,0.063,23.906,5.141,32.156,13.391 c8.281,8.297,13.375,19.688,13.391,32.328v55.297H354.344c-13.469-0.016-25.688,5.469-34.5,14.297l-0.016,0.016 c-8.813,8.813-14.281,21.016-14.281,34.484s5.469,25.672,14.266,34.5l0.063,0.031l-0.031-0.016 c8.813,8.813,21.031,14.297,34.5,14.281h103.625V449.063z M477,386.297c0,0.781-0.656,1.453-1.469,1.453H354.344 c-9.125-0.016-17.109-3.609-23.141-9.578h-0.016c-5.969-6.031-9.578-14.047-9.594-23.172c0.016-9.109,3.625-17.141,9.594-23.156 c6.031-5.969,14.031-9.578,23.172-9.594h121.172c0.813,0,1.469,0.672,1.469,1.453V386.297z"/>
                            </svg>
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-blue-500 border-4 border-blue-700/50 rounded-full flex items-center justify-center">
                            <div class="w-3 h-3 bg-blue-400 rounded-full animate-pulse"></div>
                        </div>
                    </div>
                    
                    <!-- Status Badge -->
                    <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm">
                        <div class="w-2 h-2 bg-blue-300 rounded-full mr-2 animate-pulse"></div>
                        <span><span id="total-counter-hero" data-target="{{ $pembayaran->total() }}">0</span> Pembayaran</span>
                    </div>
                </div>
                
                <div>
                    <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 leading-tight">
                        Pembayaran Saya
                    </h1>
                    <p class="text-lg md:text-xl text-blue-100 max-w-2xl">
                        Kelola dan pantau status pembayaran peminjaman aset Anda
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
                    <a href="{{ route('peminjaman.index') }}" 
                       class="group relative inline-flex items-center justify-center px-8 py-4 bg-white text-blue-700 font-bold rounded-xl shadow-2xl hover:shadow-white/20 transform hover:scale-105 transition-all duration-300 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-purple-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <i class="relative fas fa-boxes mr-2"></i>
                        <span class="relative">Lihat Peminjaman</span>
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
                                <!-- Modern Payment/Wallet Icon -->
                                <svg class="w-44 h-44" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <!-- Background Card -->
                                    <g opacity="0.6">
                                        <rect x="20" y="50" width="130" height="90" rx="12" fill="url(#cardGradient1)" transform="rotate(-8 85 95)">
                                            <animateTransform attributeName="transform" type="rotate" values="-8 85 95; -5 85 95; -8 85 95" dur="3s" repeatCount="indefinite"/>
                                        </rect>
                                    </g>
                                    
                                    <!-- Middle Card -->
                                    <g opacity="0.8">
                                        <rect x="25" y="55" width="130" height="90" rx="12" fill="url(#cardGradient2)" transform="rotate(3 90 100)">
                                            <animateTransform attributeName="transform" type="rotate" values="3 90 100; 6 90 100; 3 90 100" dur="3s" repeatCount="indefinite" begin="0.5s"/>
                                        </rect>
                                    </g>
                                    
                                    <!-- Main Payment Card -->
                                    <g>
                                        <rect x="35" y="60" width="130" height="90" rx="12" fill="url(#cardGradient3)">
                                            <animate attributeName="y" values="60;57;60" dur="2s" repeatCount="indefinite"/>
                                        </rect>
                                        
                                        <!-- Card Chip -->
                                        <rect x="50" y="80" width="20" height="16" rx="3" fill="url(#chipGradient)">
                                            <animate attributeName="opacity" values="1;0.8;1" dur="2s" repeatCount="indefinite"/>
                                        </rect>
                                        
                                        <!-- Card Numbers (represented as lines) -->
                                        <rect x="50" y="110" width="25" height="3" rx="1.5" fill="white" opacity="0.9"/>
                                        <rect x="80" y="110" width="25" height="3" rx="1.5" fill="white" opacity="0.9"/>
                                        <rect x="110" y="110" width="25" height="3" rx="1.5" fill="white" opacity="0.9"/>
                                        <rect x="140" y="110" width="15" height="3" rx="1.5" fill="white" opacity="0.7"/>
                                        
                                        <!-- Card Holder Info -->
                                        <rect x="50" y="125" width="40" height="2" rx="1" fill="white" opacity="0.6"/>
                                        <rect x="50" y="130" width="30" height="2" rx="1" fill="white" opacity="0.5"/>
                                        
                                        <!-- Money Symbol -->
                                        <g transform="translate(125, 75)">
                                            <circle cx="15" cy="15" r="18" fill="url(#moneyGradient)">
                                                <animate attributeName="r" values="18;19;18" dur="2s" repeatCount="indefinite"/>
                                            </circle>
                                            <text x="15" y="23" text-anchor="middle" font-size="20" font-weight="bold" fill="white">$</text>
                                        </g>
                                        
                                        <!-- Payment Wave Animation -->
                                        <g opacity="0.7">
                                            <path d="M 50 140 Q 85 135, 120 140 T 165 140" stroke="url(#waveGradient)" stroke-width="2" fill="none" stroke-linecap="round">
                                                <animate attributeName="d" 
                                                    values="M 50 140 Q 85 135, 120 140 T 165 140;
                                                            M 50 140 Q 85 145, 120 140 T 165 140;
                                                            M 50 140 Q 85 135, 120 140 T 165 140" 
                                                    dur="2s" 
                                                    repeatCount="indefinite"/>
                                            </path>
                                        </g>
                                        
                                        <!-- Shine effect -->
                                        <rect x="40" y="65" width="30" height="80" rx="8" fill="url(#shineGradient)" opacity="0.15">
                                            <animate attributeName="opacity" values="0.15;0.3;0.15" dur="3s" repeatCount="indefinite"/>
                                        </rect>
                                    </g>
                                    
                                    <!-- Floating Coins -->
                                    <g>
                                        <!-- Coin 1 -->
                                        <circle cx="170" cy="80" r="8" fill="url(#coinGradient)">
                                            <animate attributeName="cy" values="80;70;80" dur="3s" repeatCount="indefinite"/>
                                            <animate attributeName="opacity" values="1;0.7;1" dur="3s" repeatCount="indefinite"/>
                                        </circle>
                                        
                                        <!-- Coin 2 -->
                                        <circle cx="25" cy="110" r="6" fill="url(#coinGradient)">
                                            <animate attributeName="cy" values="110;100;110" dur="2.5s" repeatCount="indefinite" begin="0.5s"/>
                                            <animate attributeName="opacity" values="0.8;0.5;0.8" dur="2.5s" repeatCount="indefinite"/>
                                        </circle>
                                        
                                        <!-- Coin 3 -->
                                        <circle cx="170" cy="135" r="7" fill="url(#coinGradient)">
                                            <animate attributeName="cy" values="135;125;135" dur="2.8s" repeatCount="indefinite" begin="0.3s"/>
                                            <animate attributeName="opacity" values="0.9;0.6;0.9" dur="2.8s" repeatCount="indefinite"/>
                                        </circle>
                                    </g>
                                    
                                    <!-- Gradients -->
                                    <defs>
                                        <linearGradient id="cardGradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#6366F1;stop-opacity:1" />
                                            <stop offset="100%" style="stop-color:#818CF8;stop-opacity:1" />
                                        </linearGradient>
                                        <linearGradient id="cardGradient2" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:1" />
                                            <stop offset="100%" style="stop-color:#60A5FA;stop-opacity:1" />
                                        </linearGradient>
                                        <linearGradient id="cardGradient3" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#DBEAFE;stop-opacity:1" />
                                            <stop offset="50%" style="stop-color:#BFDBFE;stop-opacity:1" />
                                            <stop offset="100%" style="stop-color:#93C5FD;stop-opacity:1" />
                                        </linearGradient>
                                        <linearGradient id="chipGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#FCD34D;stop-opacity:1" />
                                            <stop offset="100%" style="stop-color:#F59E0B;stop-opacity:1" />
                                        </linearGradient>
                                        <linearGradient id="moneyGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#10B981;stop-opacity:1" />
                                            <stop offset="100%" style="stop-color:#059669;stop-opacity:1" />
                                        </linearGradient>
                                        <linearGradient id="waveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                                            <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:0.5" />
                                            <stop offset="50%" style="stop-color:#6366F1;stop-opacity:0.8" />
                                            <stop offset="100%" style="stop-color:#8B5CF6;stop-opacity:0.5" />
                                        </linearGradient>
                                        <linearGradient id="coinGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#FCD34D;stop-opacity:1" />
                                            <stop offset="100%" style="stop-color:#F59E0B;stop-opacity:1" />
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        <span id="total-counter-hero" data-target="{{ $pembayaran->total() }}">{{ $pembayaran->total() }}</span> Pembayaran
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
    
    <!-- Modern Wave Divider -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
        <svg class="relative block w-full h-[100px] md:h-[150px]" viewBox="0 0 1200 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="pembayaranWaveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#F8FAFC;stop-opacity:1" />
                    <stop offset="50%" style="stop-color:#F1F5F9;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#F8FAFC;stop-opacity:1" />
                </linearGradient>
                
                <linearGradient id="pembayaranWaveGradientAnimated" x1="0%" y1="0%" x2="100%" y2="0%">
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
                  fill="url(#pembayaranWaveGradient)" 
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
                  fill="url(#pembayaranWaveGradientAnimated)" 
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

<!-- small negative top margin on mobile to hide 1px seam from SVG wave -->
<div class="bg-slate-50 pt-0 pb-16 mt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Quick Stats Overview - Enhanced Version (sama dengan permohonan) -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6 -mt-8 md:-mt-16 mb-6 md:mb-12 relative z-10" data-aos="fade-up">
            
            <!-- Card 1: Pending -->
            <a href="{{ route('pembayaran.index', ['status' => 'pending']) }}" 
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
                        <span class="counter" data-target="{{ $pembayaran->where('status', 'pending')->count() }}">0</span>
                    </div>
                    <div class="text-[11px] md:text-sm text-gray-600 leading-tight">Menunggu Pembayaran</div>
                </div>
                <div class="mt-2 md:mt-3 flex items-center justify-center md:justify-start text-[10px] md:text-xs text-orange-600 opacity-0 group-hover:opacity-100 transition-opacity">
                    <span class="hidden md:inline">Lihat Detail</span>
                    <i class="fas fa-arrow-right text-xs md:text-sm md:ml-1"></i>
                </div>
            </a>

            <!-- Card 2: Lunas -->
            <a href="{{ route('pembayaran.index', ['status' => 'lunas']) }}" 
            class="group bg-white rounded-xl md:rounded-2xl p-3 md:p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-green-100 hover:border-green-300 transform hover:-translate-y-2 cursor-pointer">
                <div class="flex flex-col md:flex-row items-center md:justify-between mb-2 md:mb-4">
                    <div class="p-2 md:p-3 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg md:rounded-xl shadow-lg group-hover:scale-110 transition-transform mb-2 md:mb-0">
                        <svg class="w-4 h-4 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] md:text-xs font-medium text-green-600 bg-green-50 px-2 md:px-3 py-0.5 md:py-1 rounded-full">Lunas</span>
                </div>
                <div class="text-center md:text-left">
                    <div class="text-xl md:text-3xl font-bold text-gray-900 mb-0.5 md:mb-1 group-hover:text-green-600 transition-colors">
                        <span class="counter" data-target="{{ $pembayaran->where('status', 'lunas')->count() }}">0</span>
                    </div>
                    <div class="text-[11px] md:text-sm text-gray-600">Pembayaran Lunas</div>
                </div>
                <div class="mt-2 md:mt-3 flex items-center justify-center md:justify-start text-[10px] md:text-xs text-green-600 opacity-0 group-hover:opacity-100 transition-opacity">
                    <span class="hidden md:inline">Lihat Detail</span>
                    <i class="fas fa-arrow-right text-xs md:text-sm md:ml-1"></i>
                </div>
            </a>

            <!-- Card 3: Total Dibayar -->
            <a href="{{ route('pembayaran.index', ['status' => 'lunas']) }}" 
            class="group bg-white rounded-xl md:rounded-2xl p-3 md:p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-blue-100 hover:border-blue-300 transform hover:-translate-y-2 cursor-pointer">
                <div class="flex flex-col md:flex-row items-center md:justify-between mb-2 md:mb-4">
                    <div class="p-2 md:p-3 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-lg md:rounded-xl shadow-lg group-hover:scale-110 transition-transform mb-2 md:mb-0">
                        <svg class="w-4 h-4 md:w-6 md:h-6 text-white" viewBox="0 -3 38 38" fill="currentColor">
                            <path d="M36.002 23.010l0.057-17.089-31.050 0.019-0.001-1.96h32.992v19.031l-1.998-0.001zM34.995 26.017l-1.997-0.002 0.057-17.089-31.050 0.020-0.001-1.96h32.992v19.031zM32.053 28.020h-32.053v-18.030h32.053v18.030zM30.049 11.931h-28.046v14.086h28.045v-14.086zM27.045 24.515c0 0.177 0.044 0.342 0.101 0.5h-11.12c2.766 0 5.009-2.69 5.009-6.010s-2.243-6.010-5.009-6.010h11.119c-0.057 0.158-0.101 0.323-0.101 0.501 0 0.83 0.672 1.502 1.502 1.502 0.178 0 0.343-0.044 0.501-0.101v8.215c-0.158-0.056-0.323-0.101-0.501-0.101-0.829 0.001-1.501 0.674-1.501 1.504zM25.041 16.919c-0.83 0-1.502 0.896-1.502 2.003s0.672 2.003 1.502 2.003 1.502-0.896 1.502-2.003-0.672-2.003-1.502-2.003zM18.123 15.394c0.015 0.029 0.027 0.068 0.037 0.116 0.011 0.048 0.018 0.109 0.021 0.182 0.005 0.073 0.007 0.164 0.007 0.273 0 0.121-0.003 0.224-0.009 0.307-0.007 0.084-0.018 0.153-0.031 0.207-0.016 0.055-0.036 0.095-0.062 0.119-0.027 0.025-0.064 0.038-0.11 0.038s-0.118-0.029-0.219-0.087c-0.101-0.059-0.224-0.121-0.369-0.189s-0.315-0.131-0.507-0.187-0.402-0.084-0.632-0.084c-0.18 0-0.336 0.021-0.469 0.065-0.134 0.044-0.246 0.104-0.335 0.181s-0.157 0.17-0.2 0.277c-0.044 0.108-0.066 0.223-0.066 0.343 0 0.18 0.049 0.335 0.147 0.467s0.229 0.248 0.395 0.35c0.165 0.103 0.352 0.198 0.56 0.288s0.421 0.185 0.638 0.284c0.217 0.101 0.43 0.214 0.639 0.342 0.209 0.127 0.395 0.279 0.557 0.456 0.163 0.178 0.295 0.386 0.395 0.626s0.15 0.522 0.15 0.848c0 0.425-0.080 0.799-0.238 1.119-0.158 0.321-0.373 0.59-0.645 0.805s-0.588 0.376-0.951 0.484c-0.046 0.014-0.096 0.020-0.143 0.031v1.094h-0.985v-0.965c-0.013 0-0.024 0.003-0.037 0.003-0.279 0-0.539-0.023-0.779-0.068s-0.452-0.101-0.635-0.164c-0.184-0.064-0.337-0.132-0.46-0.202s-0.212-0.132-0.266-0.186-0.093-0.132-0.116-0.234-0.035-0.25-0.035-0.442c0-0.129 0.004-0.238 0.013-0.325 0.008-0.088 0.022-0.159 0.041-0.214 0.019-0.054 0.044-0.093 0.075-0.116 0.031-0.022 0.068-0.034 0.109-0.034 0.059 0 0.141 0.034 0.248 0.104 0.106 0.068 0.243 0.145 0.41 0.228s0.366 0.159 0.598 0.228c0.231 0.069 0.5 0.104 0.804 0.104 0.2 0 0.38-0.024 0.538-0.072s0.293-0.116 0.404-0.203c0.11-0.088 0.194-0.197 0.253-0.326s0.088-0.274 0.088-0.433c0-0.184-0.051-0.342-0.15-0.473-0.1-0.132-0.23-0.248-0.391-0.351s-0.343-0.198-0.547-0.287c-0.205-0.090-0.415-0.185-0.632-0.285s-0.428-0.214-0.632-0.341c-0.204-0.127-0.387-0.279-0.547-0.457-0.16-0.177-0.291-0.387-0.391-0.628-0.1-0.242-0.15-0.532-0.15-0.87 0-0.388 0.072-0.729 0.216-1.022 0.144-0.294 0.338-0.538 0.582-0.732s0.532-0.339 0.863-0.435c0.17-0.049 0.346-0.085 0.527-0.109v-1.035h0.985v1.035c0.039 0.005 0.078 0.003 0.117 0.009 0.192 0.029 0.372 0.068 0.539 0.118 0.166 0.050 0.314 0.105 0.443 0.168s0.215 0.113 0.258 0.155c0.039 0.037 0.067 0.072 0.082 0.102zM11.018 19.005c0 3.319 2.242 6.010 5.008 6.010h-11.119c0.056-0.158 0.101-0.323 0.101-0.5 0-0.83-0.673-1.503-1.502-1.503-0.178 0-0.343 0.045-0.501 0.101v-8.215c0.158 0.057 0.323 0.101 0.501 0.101 0.83 0 1.502-0.672 1.502-1.502 0-0.178-0.045-0.343-0.101-0.501h11.119c-2.766-0.001-5.008 2.69-5.008 6.009zM7.011 16.919c-0.83 0-1.502 0.896-1.502 2.003s0.673 2.003 1.502 2.003c0.83 0 1.502-0.896 1.502-2.003s-0.672-2.003-1.502-2.003z"/>
                        </svg>
                    </div>
                    <span class="text-[10px] md:text-xs font-medium text-blue-600 bg-blue-50 px-2 md:px-3 py-0.5 md:py-1 rounded-full">Amount</span>
                </div>
                <div class="text-center md:text-left">
                    <div class="text-lg md:text-3xl font-bold text-gray-900 mb-0.5 md:mb-1 group-hover:text-blue-600 transition-colors">
                        <span id="total-amount-display">Rp 0</span>
                    </div>
                    <div class="text-[11px] md:text-sm text-gray-600">Total Dibayar</div>
                    <input type="hidden" id="total-amount-value" value="{{ $totalLunas ?? 0 }}">
                </div>
                <div class="mt-2 md:mt-3 flex items-center justify-center md:justify-start text-[10px] md:text-xs text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity">
                    <span class="hidden md:inline">Lihat Detail</span>
                    <i class="fas fa-arrow-right text-xs md:text-sm md:ml-1"></i>
                </div>
            </a>

            <!-- Card 4: Total -->
            <a href="{{ route('pembayaran.index') }}" 
            class="group bg-white rounded-xl md:rounded-2xl p-3 md:p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-purple-100 hover:border-purple-300 transform hover:-translate-y-2 cursor-pointer">
                <div class="flex flex-col md:flex-row items-center md:justify-between mb-2 md:mb-4">
                    <div class="p-2 md:p-3 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg md:rounded-xl shadow-lg group-hover:scale-110 transition-transform mb-2 md:mb-0">
                        <svg class="w-4 h-4 md:w-6 md:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] md:text-xs font-medium text-purple-600 bg-purple-50 px-2 md:px-3 py-0.5 md:py-1 rounded-full">Total</span>
                </div>
                <div class="text-center md:text-left">
                    <div class="text-xl md:text-3xl font-bold text-gray-900 mb-0.5 md:mb-1 group-hover:text-purple-600 transition-colors">
                        <span class="counter" data-target="{{ $pembayaran->total() }}">0</span>
                    </div>
                    <div class="text-[11px] md:text-sm text-gray-600">Total Transaksi</div>
                </div>
                <div class="mt-2 md:mt-3 flex items-center justify-center md:justify-start text-[10px] md:text-xs text-purple-600 opacity-0 group-hover:opacity-100 transition-opacity">
                    <span class="hidden md:inline">Lihat Detail</span>
                    <i class="fas fa-arrow-right text-xs md:text-sm md:ml-1"></i>
                </div>
            </a>
        </div>

        <!-- Filter Section - Tambahkan setelah Quick Stats Overview -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mt-8 mb-8 relative z-10" data-aos="fade-up">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                    <i class="fas fa-filter text-blue-600 mr-2"></i>
                    Filter & Pencarian
                </h3>
            </div>
            
            <form method="GET" action="{{ route('pembayaran.index') }}">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 mb-3">
                    <!-- Status Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Pembayaran</label>
                        <select name="status" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                            <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </div>

                    <!-- Metode Pembayaran -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                        <select name="metode" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            <option value="">Semua Metode</option>
                            <option value="cash" {{ request('metode') == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="transfer" {{ request('metode') == 'transfer' ? 'selected' : '' }}>Transfer</option>
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
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Pembayaran</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ID pembayaran, ID peminjaman, atau nama barang..." 
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
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
                    
                    <a href="{{ route('pembayaran.index') }}" 
                    class="group relative w-full md:w-auto inline-flex justify-center items-center px-6 py-3 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm font-semibold rounded-xl transition-all duration-300 overflow-hidden">
                        <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-blue-500/5 to-indigo-500/5 dark:from-blue-600/10 dark:to-indigo-600/10 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                        <i class="relative fas fa-redo mr-2 text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 group-hover:rotate-180 transition-all duration-500"></i>
                        <span class="relative">Reset Filter</span>
                    </a>
                </div>

                <!-- Filter Aktif Section - Separated with border -->
                @if(request()->anyFilled(['status', 'metode', 'tanggal_mulai', 'tanggal_selesai', 'search']))
                    <div class="mt-5 pt-5 border-t-2 border-gray-200">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-sm font-semibold text-gray-700 mr-1">Filter aktif:</span>
                            
                            @if(request('status'))
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-100 text-blue-700 text-xs font-medium rounded-lg border border-blue-200">
                                    <span class="font-semibold">Status:</span>
                                    <span>{{ ucfirst(request('status')) }}</span>
                                </span>
                            @endif
                            
                            @if(request('metode'))
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-100 text-green-700 text-xs font-medium rounded-lg border border-green-200">
                                    <span class="font-semibold">Metode:</span>
                                    <span>{{ ucfirst(request('metode')) }}</span>
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
                            
                            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-indigo-100 text-indigo-700 text-sm font-semibold rounded-lg border border-indigo-200">
                                {{ $pembayaran->total() }} hasil ditemukan
                            </span>
                        </div>
                    </div>
                @endif
            </form>
        </div>

        <!-- Pembayaran List -->
        <div class="space-y-6">
            @forelse($pembayaran as $item)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300" data-aos="fade-up">
                    <div id="hasil-filter" class="p-4 md:p-6">
                        <!-- Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                                    <svg class="w-8 h-8 text-white" viewBox="0 -3 38 38" fill="currentColor">
                                        <path d="M36.002 23.010l0.057-17.089-31.050 0.019-0.001-1.96h32.992v19.031l-1.998-0.001zM34.995 26.017l-1.997-0.002 0.057-17.089-31.050 0.020-0.001-1.96h32.992v19.031zM32.053 28.020h-32.053v-18.030h32.053v18.030zM30.049 11.931h-28.046v14.086h28.045v-14.086zM27.045 24.515c0 0.177 0.044 0.342 0.101 0.5h-11.12c2.766 0 5.009-2.69 5.009-6.010s-2.243-6.010-5.009-6.010h11.119c-0.057 0.158-0.101 0.323-0.101 0.501 0 0.83 0.672 1.502 1.502 1.502 0.178 0 0.343-0.044 0.501-0.101v8.215c-0.158-0.056-0.323-0.101-0.501-0.101-0.829 0.001-1.501 0.674-1.501 1.504zM25.041 16.919c-0.83 0-1.502 0.896-1.502 2.003s0.672 2.003 1.502 2.003 1.502-0.896 1.502-2.003-0.672-2.003-1.502-2.003zM18.123 15.394c0.015 0.029 0.027 0.068 0.037 0.116 0.011 0.048 0.018 0.109 0.021 0.182 0.005 0.073 0.007 0.164 0.007 0.273 0 0.121-0.003 0.224-0.009 0.307-0.007 0.084-0.018 0.153-0.031 0.207-0.016 0.055-0.036 0.095-0.062 0.119-0.027 0.025-0.064 0.038-0.11 0.038s-0.118-0.029-0.219-0.087c-0.101-0.059-0.224-0.121-0.369-0.189s-0.315-0.131-0.507-0.187-0.402-0.084-0.632-0.084c-0.18 0-0.336 0.021-0.469 0.065-0.134 0.044-0.246 0.104-0.335 0.181s-0.157 0.17-0.2 0.277c-0.044 0.108-0.066 0.223-0.066 0.343 0 0.18 0.049 0.335 0.147 0.467s0.229 0.248 0.395 0.35c0.165 0.103 0.352 0.198 0.56 0.288s0.421 0.185 0.638 0.284c0.217 0.101 0.43 0.214 0.639 0.342 0.209 0.127 0.395 0.279 0.557 0.456 0.163 0.178 0.295 0.386 0.395 0.626s0.15 0.522 0.15 0.848c0 0.425-0.080 0.799-0.238 1.119-0.158 0.321-0.373 0.59-0.645 0.805s-0.588 0.376-0.951 0.484c-0.046 0.014-0.096 0.020-0.143 0.031v1.094h-0.985v-0.965c-0.013 0-0.024 0.003-0.037 0.003-0.279 0-0.539-0.023-0.779-0.068s-0.452-0.101-0.635-0.164c-0.184-0.064-0.337-0.132-0.46-0.202s-0.212-0.132-0.266-0.186-0.093-0.132-0.116-0.234-0.035-0.25-0.035-0.442c0-0.129 0.004-0.238 0.013-0.325 0.008-0.088 0.022-0.159 0.041-0.214 0.019-0.054 0.044-0.093 0.075-0.116 0.031-0.022 0.068-0.034 0.109-0.034 0.059 0 0.141 0.034 0.248 0.104 0.106 0.068 0.243 0.145 0.41 0.228s0.366 0.159 0.598 0.228c0.231 0.069 0.5 0.104 0.804 0.104 0.2 0 0.38-0.024 0.538-0.072s0.293-0.116 0.404-0.203c0.11-0.088 0.194-0.197 0.253-0.326s0.088-0.274 0.088-0.433c0-0.184-0.051-0.342-0.15-0.473-0.1-0.132-0.23-0.248-0.391-0.351s-0.343-0.198-0.547-0.287c-0.205-0.090-0.415-0.185-0.632-0.285s-0.428-0.214-0.632-0.341c-0.204-0.127-0.387-0.279-0.547-0.457-0.16-0.177-0.291-0.387-0.391-0.628-0.1-0.242-0.15-0.532-0.15-0.87 0-0.388 0.072-0.729 0.216-1.022 0.144-0.294 0.338-0.538 0.582-0.732s0.532-0.339 0.863-0.435c0.17-0.049 0.346-0.085 0.527-0.109v-1.035h0.985v1.035c0.039 0.005 0.078 0.003 0.117 0.009 0.192 0.029 0.372 0.068 0.539 0.118 0.166 0.050 0.314 0.105 0.443 0.168s0.215 0.113 0.258 0.155c0.039 0.037 0.067 0.072 0.082 0.102zM11.018 19.005c0 3.319 2.242 6.010 5.008 6.010h-11.119c0.056-0.158 0.101-0.323 0.101-0.5 0-0.83-0.673-1.503-1.502-1.503-0.178 0-0.343 0.045-0.501 0.101v-8.215c0.158 0.057 0.323 0.101 0.501 0.101 0.83 0 1.502-0.672 1.502-1.502 0-0.178-0.045-0.343-0.101-0.501h11.119c-2.766-0.001-5.008 2.69-5.008 6.009zM7.011 16.919c-0.83 0-1.502 0.896-1.502 2.003s0.673 2.003 1.502 2.003c0.83 0 1.502-0.896 1.502-2.003s-0.672-2.003-1.502-2.003z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">Pembayaran #{{ $item->id }}</h3>
                                    <p class="text-sm text-gray-500">Peminjaman #{{ $item->peminjaman_id }}</p>
                                </div>
                            </div>
                            
                            <!-- Status Badge -->
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold
                                @if($item->status === 'pending') bg-orange-100 text-orange-700
                                @elseif($item->status === 'lunas') bg-green-100 text-green-700
                                @elseif($item->status === 'batal') bg-red-100 text-red-700
                                @else bg-gray-100 text-gray-700 @endif">
                                @if($item->status === 'pending')
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Pending
                                @elseif($item->status === 'lunas')
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Lunas
                                @elseif($item->status === 'batal')
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Batal
                                @else
                                    {{ ucfirst($item->status) }}
                                @endif
                            </span>
                        </div>

                        <!-- Barang List from Peminjaman -->
                        @if($item->peminjaman)
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-5 mb-4">
                            <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                                <i class="fas fa-boxes mr-2 text-blue-600"></i>
                                Barang yang Dipinjam
                            </h4>
                            
                            <div class="space-y-3">
                                @foreach($item->peminjaman->peminjamanDetail as $detail)
                                    <div class="flex items-center justify-between bg-white rounded-lg p-4 hover:shadow-md transition-all">
                                        <div class="flex items-center gap-3 flex-1">
                                            @if($detail->barang->fotoPrimary)
                                                <img src="{{ $detail->barang->fotoPrimary->foto_url }}"
                                                     alt="{{ $detail->barang->nama_barang }}"
                                                     class="w-20 h-20 object-cover rounded-lg shadow-md">
                                            @else
                                                <div class="w-14 h-14 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-lg flex items-center justify-center text-white">
                                                    <i class="fas fa-box text-2xl"></i>
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
                        </div>
                        @endif

                        <!-- Payment Info Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-4">
                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-wallet text-blue-600"></i>
                                <div>
                                    <p class="text-xs text-gray-500">Metode Pembayaran</p>
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $item->metode ? ucfirst($item->metode) : 'Belum dipilih' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                <i class="far fa-calendar-alt text-blue-600"></i>
                                <div>
                                    <p class="text-xs text-gray-500">Tanggal Bayar</p>
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $item->tanggal_bayar ? \Carbon\Carbon::parse($item->tanggal_bayar)->format('d M Y') : 'Belum dibayar' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-dollar-sign text-blue-600"></i>
                                <div>
                                    <p class="text-xs text-gray-500">Jumlah Tagihan</p>
                                    <p class="text-sm font-semibold text-gray-900">
                                        Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Total Amount - Highlight -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-4 md:p-5 mb-4 border-2 border-blue-200">
                            <!-- Mobile: Stack Layout -->
                            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                                <!-- Amount Section -->
                                <div class="flex items-center gap-3">
                                    <div class="p-2.5 md:p-3 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl shadow-lg flex-shrink-0">
                                        <svg class="w-5 h-5 md:w-6 md:h-6 text-white" viewBox="0 0 512 512" fill="currentColor">
                                            <path d="M360,343.266c-6.5,0-11.75,5.25-11.75,11.734s5.25,11.75,11.75,11.75c6.469,0,11.734-5.266,11.734-11.75 S366.469,343.266,360,343.266z"/>
                                            <path d="M475.531,306.203h-3.781v-55.297c0-14.063-4.75-27-12.672-37.375L512,179.438l-4.172-6.813L402.656,1.172 L180.938,137.141H94c-50.531,0-91.594,39.875-93.797,89.828l-0.016,0.109L0,243.516v35.719v137.594c0,51.922,42.078,93.984,94,94 h318.25c34.109-0.016,61.75-27.656,61.75-61.766v-45.266h1.531c9.672-0.016,17.5-7.828,17.516-17.5v-62.594 C493.031,314.031,485.219,306.203,475.531,306.203z M457.969,449.063c-0.016,12.641-5.125,24.031-13.406,32.328 c-8.281,8.281-19.656,13.375-32.313,13.391H94c-21.547-0.016-40.984-8.719-55.125-22.828 c-14.125-14.141-22.813-33.578-22.828-55.125V279.234v-35.563l0.203-16.047c1.828-41.406,35.906-74.453,77.75-74.438h60.781 l-58.563,35.953l-23.422,0.016v16.047l337.359-0.016c12.578,0.063,23.906,5.141,32.156,13.391 c8.281,8.297,13.375,19.688,13.391,32.328v55.297H354.344c-13.469-0.016-25.688,5.469-34.5,14.297l-0.016,0.016 c-8.813,8.813-14.281,21.016-14.281,34.484s5.469,25.672,14.266,34.5l0.063,0.031l-0.031-0.016 c8.813,8.813,21.031,14.297,34.5,14.281h103.625V449.063z M477,386.297c0,0.781-0.656,1.453-1.469,1.453H354.344 c-9.125-0.016-17.109-3.609-23.141-9.578h-0.016c-5.969-6.031-9.578-14.047-9.594-23.172c0.016-9.109,3.625-17.141,9.594-23.156 c6.031-5.969,14.031-9.578,23.172-9.594h121.172c0.813,0,1.469,0.672,1.469,1.453V386.297z"/>
                                        </svg>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-xs md:text-sm font-medium text-gray-600 mb-0.5">Total yang Harus Dibayar</p>
                                        <p class="text-xl md:text-2xl lg:text-3xl font-bold text-blue-600 break-words">
                                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                                
                                <!-- Status Badge Section -->
                                @if($item->status === 'lunas')
                                    <div class="flex flex-col items-start md:items-end gap-2 pt-3 md:pt-0 border-t md:border-t-0 border-blue-200">
                                        <div class="inline-flex items-center px-3 md:px-4 py-1.5 md:py-2 bg-green-100 text-green-700 rounded-full font-semibold text-sm">
                                            <i class="fas fa-check-circle mr-1.5 flex-shrink-0"></i>
                                            <span>LUNAS</span>
                                        </div>
                                        @if($item->tanggal_bayar)
                                            <p class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($item->tanggal_bayar)->format('d M Y, H:i') }}
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Bukti Transfer Preview -->
                        @if($item->bukti_transfer)
                            <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                                <p class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                                    <i class="fas fa-file-alt mr-2 text-blue-600"></i>
                                    Bukti Transfer:
                                </p>
                                <a href="{{ Storage::url($item->bukti_transfer) }}" 
                                   target="_blank"
                                   class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-all text-sm">
                                    <i class="fas fa-eye mr-2"></i>
                                    Lihat Bukti Transfer
                                </a>
                            </div>
                        @endif

                        <!-- Actions - Clean Design without Overlay Effect (Mobile Optimized) -->
                        <div class="flex flex-col sm:flex-row sm:flex-wrap gap-2 sm:gap-3">
                            <!-- Tombol Lihat Detail -->
                            <a href="{{ route('pembayaran.show', $item->id) }}" 
                            class="btn-action w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5">
                                <i class="icon-action fas fa-eye mr-2 transition-transform duration-300"></i>
                                <span>Lihat Detail</span>
                            </a>

                            <!-- Tombol Bayar - HANYA tampil jika status PENDING -->
                            @if($item->status === 'pending')
                                <a href="{{ route('pembayaran.show', $item->id) }}" 
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
                            @if($item->status === 'lunas')
                                <div class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-green-50 text-green-700 text-sm font-semibold rounded-lg border border-green-200">
                                    <i class="fas fa-check-circle mr-1.5"></i>
                                    Pembayaran Lunas
                                </div>
                            @endif

                            <!-- Status Badge - Batal - Compact -->
                            @if($item->status === 'batal')
                                <div class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-red-50 text-red-700 text-sm font-semibold rounded-lg border border-red-200">
                                    <i class="fas fa-times-circle mr-1.5"></i>
                                    Pembayaran Dibatalkan
                                </div>
                                
                                <!-- ALERT PEMBAYARAN DITOLAK - REDESIGNED COMPACT -->
                                @if($item->status === 'batal' && $item->metode === 'transfer' && $item->bukti_transfer)
                                <div class="w-full mt-3 bg-gradient-to-br from-red-50 to-orange-50 border-2 border-red-300 rounded-xl shadow-md overflow-hidden">
                                    <!-- Header Alert -->
                                    <div class="bg-red-600 px-4 py-2 flex items-center gap-2">
                                        <i class="fas fa-exclamation-triangle text-white text-lg animate-pulse"></i>
                                        <h4 class="text-white font-bold text-sm">PEMBAYARAN TRANSFER DITOLAK!</h4>
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="p-4 space-y-3">
                                        <!-- Pesan Utama -->
                                        <div class="bg-white rounded-lg p-3 border border-red-200">
                                            <p class="text-xs text-gray-800 leading-relaxed">
                                                <strong class="text-red-700">Pembayaran Anda telah ditolak oleh admin.</strong><br>
                                                Bukti transfer yang Anda upload tidak dapat diverifikasi atau terdapat kesalahan.
                                            </p>
                                        </div>
                                        
                                        <!-- Instruksi Singkat -->
                                        <div class="bg-yellow-50 rounded-lg p-3 border border-yellow-300">
                                            <p class="text-xs font-bold text-yellow-900 mb-2">📋 LANGKAH SELANJUTNYA:</p>
                                            <ol class="text-xs text-yellow-900 space-y-1 ml-4 list-decimal">
                                                <li>Hubungi admin <strong>SEGERA</strong> untuk mengetahui alasan penolakan</li>
                                                <li>Tanyakan apakah perlu upload ulang bukti transfer atau cara pembayaran lain</li>
                                                <li>Dapatkan instruksi pembayaran yang benar dari admin</li>
                                                <li>Jangan lakukan pembayaran ulang sebelum konfirmasi dari admin</li>
                                            </ol>
                                        </div>
                                        
                                        <!-- Tombol Kontak -->
                                        <div>
                                            <p class="text-xs font-bold text-red-900 mb-2 flex items-center gap-1">
                                                <i class="fas fa-phone-alt"></i> HUBUNGI ADMIN:
                                            </p>
                                            
                                            <div class="flex flex-col sm:flex-row gap-2 mb-2">
                                                <a href="https://wa.me/6285163587878?text=Halo%20Admin%20Pelita%2C%0A%0ASaya%20ingin%20menanyakan%20tentang%20pembayaran%20yang%20ditolak%3A%0A%0A%E2%9C%85%20ID%20Pembayaran%3A%20{{ $item->id }}%0A%E2%9C%85%20Jumlah%3A%20Rp%20{{ number_format($item->jumlah, 0, ',', '.') }}%0A%E2%9C%85%20Tanggal%20Upload%3A%20{{ $item->tanggal_bayar ? \Carbon\Carbon::parse($item->tanggal_bayar)->format('d M Y, H:i') : '-' }}%0A%0AMohon%20penjelasan%20mengenai%20alasan%20penolakan%20dan%20langkah%20selanjutnya.%0A%0ATerima%20kasih." 
                                                target="_blank"
                                                class="group relative flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white text-xs font-bold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
                                                    <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></div>
                                                    <i class="relative fab fa-whatsapp text-sm group-hover:scale-110 transition-transform duration-300"></i>
                                                    <span class="relative">WhatsApp</span>
                                                </a>
                                                
                                                <a href="mailto:Cimahi.technopark@gmail.com?subject=Pembayaran%20Ditolak%20-%20ID%20{{ $item->id }}&body=Yth.%20Admin%20Pelita%2C%0A%0ASaya%20ingin%20menanyakan%20tentang%20pembayaran%20yang%20ditolak%3A%0A%0AID%20Pembayaran%3A%20{{ $item->id }}%0AJumlah%3A%20Rp%20{{ number_format($item->jumlah, 0, ',', '.') }}%0ATanggal%20Upload%3A%20{{ $item->tanggal_bayar ? \Carbon\Carbon::parse($item->tanggal_bayar)->format('d M Y, H:i') : '-' }}%0A%0AMohon%20penjelasan%20mengenai%20alasan%20penolakan%20dan%20langkah%20selanjutnya.%0A%0ATerima%20kasih." 
                                                class="group relative flex-1 inline-flex items-center justify-center gap-2 px-3 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-xs font-bold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 overflow-hidden">
                                                    <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-lg"></div>
                                                    <i class="relative fas fa-envelope text-sm group-hover:scale-110 transition-transform duration-300"></i>
                                                    <span class="relative">Email</span>
                                                </a>
                                            </div>
                                            
                                            <!-- Info Kontak Compact -->
                                            <div class="bg-white rounded-lg p-2 border border-gray-200 text-xs">
                                                <div class="flex items-center justify-between mb-1">
                                                    <span class="text-gray-600">📞 Telp:</span>
                                                    <a href="tel:+6285163587878" class="font-bold text-blue-600 hover:underline">+62 851-6358-7878</a>
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <span class="text-gray-600">✉️ Email:</span>
                                                    <span class="font-bold text-gray-800 text-[10px] truncate ml-2">Cimahi.technopark@gmail.com</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Warning Footer -->
                                        <div class="flex items-start gap-2 p-2 bg-red-100 rounded-lg border border-red-300">
                                            <i class="fas fa-info-circle text-red-600 text-sm mt-0.5 flex-shrink-0"></i>
                                            <p class="text-xs text-red-800">
                                                <strong>Penting:</strong> Jangan melakukan pembayaran ulang sebelum mendapat konfirmasi dari admin untuk menghindari pembayaran ganda.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="bg-white rounded-2xl shadow-lg p-16 text-center" data-aos="fade-up">
                    <div class="w-32 h-32 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-wallet text-blue-600 text-6xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">Belum Ada Pembayaran</h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        Anda belum memiliki riwayat pembayaran. Pembayaran akan muncul setelah permohonan peminjaman Anda disetujui.
                    </p>
                    <a href="{{ route('peminjaman.index') }}" 
                       class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-xl hover:shadow-2xl transform hover:-translate-y-1 transition-all">
                        <i class="fas fa-boxes mr-2"></i>
                        Lihat Peminjaman Saya
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($pembayaran->hasPages())
            <div class="mt-8" data-aos="fade-up">
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    {{ $pembayaran->links() }}
                </div>
            </div>
        @endif

        <!-- Info Card (hidden on mobile) -->
        <div class="hidden md:block mt-12 bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 rounded-2xl shadow-2xl overflow-hidden" data-aos="fade-up">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative p-8">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                            <i class="fas fa-info-circle text-white text-3xl"></i>
                        </div>
                    </div>
                    <div class="flex-1 text-white">
                        <h3 class="text-2xl font-bold mb-3">Informasi Pembayaran</h3>
                        <div class="space-y-2 text-blue-50">
                            <p class="flex items-start">
                                <i class="fas fa-check-circle mr-2 mt-0.5 flex-shrink-0"></i>
                                <span>Pembayaran dapat dilakukan melalui metode <strong>Cash</strong> atau <strong>Transfer Bank</strong>.</span>
                            </p>
                            <p class="flex items-start">
                                <i class="fas fa-check-circle mr-2 mt-0.5 flex-shrink-0"></i>
                                <span>Jika memilih <strong>Cash</strong>, pembayaran akan langsung lunas setelah dikonfirmasi admin.</span>
                            </p>
                            <p class="flex items-start">
                                <i class="fas fa-check-circle mr-2 mt-0.5 flex-shrink-0"></i>
                                <span>Jika memilih <strong>Transfer</strong>, upload bukti transfer dan tunggu konfirmasi dari admin.</span>
                            </p>
                            <p class="flex items-start">
                                <i class="fas fa-check-circle mr-2 mt-0.5 flex-shrink-0"></i>
                                <span>Peminjaman dapat diproses setelah pembayaran dikonfirmasi <strong>LUNAS</strong>.</span>
                            </p>
                            <p class="flex items-start">
                                <i class="fas fa-check-circle mr-2 mt-0.5 flex-shrink-0"></i>
                                <span>Simpan bukti pembayaran Anda sebagai referensi transaksi.</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Action -->
        <div class="mt-8 text-center" data-aos="fade-up">
            <a href="{{ route('peminjaman.index') }}" 
               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all">
                <i class="fas fa-boxes mr-2"></i>
                Lihat Peminjaman Saya
            </a>
        </div>
    </div>
</div>

@push('styles')
<style>
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
    /* Button Action Hover Effects - Icon Animation Only */
.btn-action:hover .icon-action {
    transform: scale(1.1) rotate(12deg);
}

.btn-action:hover .icon-action.icon-rotate-left {
    transform: scale(1.1) rotate(-12deg);
}

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

    // Amount Counter with Rupiah Format
    function initAmountCounter() {
        const amountDisplay = document.getElementById('total-amount-display');
        const amountValue = document.getElementById('total-amount-value');
        
        if (!amountDisplay || !amountValue) return;
        
        const target = parseInt(amountValue.value);
        const duration = 800;
        const increment = target / (duration / 16);
        let current = 0;
        
        const formatRupiah = (amount) => {
            return 'Rp ' + Math.floor(amount).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        };
        
        const updateAmount = () => {
            if (current < target) {
                current += increment;
                if (current > target) current = target;
                amountDisplay.textContent = formatRupiah(current);
                requestAnimationFrame(updateAmount);
            } else {
                amountDisplay.textContent = formatRupiah(target);
            }
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !amountDisplay.classList.contains('animated')) {
                    amountDisplay.classList.add('animated');
                    setTimeout(() => {
                        updateAmount();
                    }, 100);
                }
            });
        }, { threshold: 0.5 });
        
        observer.observe(amountDisplay);
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
        @if(request()->anyFilled(['status', 'metode', 'tanggal_mulai', 'tanggal_selesai', 'search']))
            setTimeout(() => {
                const firstCard = document.querySelector('#hasil-filter');
                
                if (firstCard) {
                    const elementPosition = firstCard.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - 180;
                    
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                    
                    console.log('✓ Auto scroll ke hasil filter pembayaran berhasil');
                    console.log('Posisi scroll:', offsetPosition);
                } else {
                    console.log('✗ Hasil filter tidak ditemukan');
                }
            }, 1000);
        @endif
    }

    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        initCounters();
        initAmountCounter();
        initFilterLoading();
        autoScrollToResults();
    });
</script>
@endpush

@endsection