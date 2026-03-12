@extends('layouts.guest')

@section('title', 'Profil - Pelita App')

@section('content')

{{-- Hero Section - Profil --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    {{-- Background Image with Overlay --}}
    <div class="absolute inset-0">
        <img src="{{ asset('images/ctp-building.jpg') }}" alt="Cimahi Technopark" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/70 via-indigo-900/60 to-purple-900/70"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%239C92AC" fill-opacity="0.1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-30"></div>
    </div>

    <div class="relative w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-12 sm:py-20 -mt-48 sm:-mt-52">
        <div data-aos="fade-down">
            {{-- Premium Badge --}}
            <div class="inline-flex items-center bg-white/10 backdrop-blur-xl border border-white/20 rounded-full mb-8 px-4 py-2 shadow-2xl">
                <span class="relative flex h-3 w-3 mr-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
                <span class="text-blue-100 text-sm font-semibold tracking-wide">Profil Lengkap</span>
            </div>
        </div>
        
        <h1 class="text-3xl md:text-5xl lg:text-7xl font-bold text-white mb-6 leading-tight" data-aos="fade-up">
            Tentang <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 via-orange-500 to-yellow-400 animate-gradient-about">Cimahi Technopark</span>
        </h1>
        
        <p class="text-base md:text-lg lg:text-2xl text-blue-100 max-w-4xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100">
            Pusat Inovasi dan Pengembangan Teknologi untuk Masa Depan yang Lebih Baik
        </p>
    </div>

    {{-- Scroll Indicator - FIXED POSITION --}}
    <div class="absolute bottom-2 left-1/6 transform -translate-x-1/2 animate-bounce-slow">
        <div class="flex flex-col items-center space-y-2">
            <span class="text-white text-sm font-medium animate-pulse">Scroll untuk lebih lanjut</span>
            <svg class="w-6 h-6 text-white animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>
</section>

{{-- About Cimahi Technopark Section --}}
<section id="about-ctp" class="py-24 bg-white relative overflow-hidden">
    {{-- Decorative Elements --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-blue-100 to-transparent rounded-full blur-3xl opacity-50"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-tr from-purple-100 to-transparent rounded-full blur-3xl opacity-50"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            {{-- Image Side --}}
            <div data-aos="fade-right" class="px-6 sm:px-0">
                <div class="relative group">
                    <div class="absolute -inset-4 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 rounded-3xl opacity-30 blur-2xl group-hover:opacity-40 transition-opacity duration-500"></div>
                    <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden">
                        <img src="{{ asset('images/building.jpg') }}" alt="Cimahi Technopark Logo" class="w-full h-auto p-6 sm:p-12">
                        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/20 to-transparent"></div>
                    </div>
                    {{-- Floating Stats - ADJUSTED FOR MOBILE --}}
                    <div class="absolute bottom-4 right-4 sm:-bottom-6 sm:-right-6 bg-white rounded-2xl shadow-xl p-3 border-4 border-blue-500">
                        <div class="text-center">
                            <div class="text-xl sm:text-3xl font-bold text-blue-600">2019</div>
                            <div class="text-sm text-gray-600">Tahun Berdiri</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Content Side --}}
            <div data-aos="fade-left">
                <div class="inline-flex items-center px-4 py-2 bg-blue-100 rounded-full text-blue-600 text-sm font-semibold mb-6">
                    <span class="w-2 h-2 bg-blue-600 rounded-full mr-2 animate-pulse"></span>
                    Cimahi Technopark
                </div>
                
                <h2 class="text-2xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                    Pusat Inovasi dan 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600">Teknologi Terdepan</span>
                </h2>
                
                <div class="space-y-6 text-gray-600 text-lg leading-relaxed">
                    <p class="flex items-start">
                        <svg class="w-6 h-6 text-blue-500 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>
                            <strong class="text-gray-900">Cimahi Technopark</strong> adalah kawasan Science and Technopark yang diresmikan pada tahun 2019 sebagai bagian dari program prioritas Nawacita Pemerintah Indonesia dalam mendorong ekonomi kreatif dan inovasi teknologi.
                        </span>
                    </p>
                    
                    <p class="flex items-start">
                        <svg class="w-6 h-6 text-purple-500 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <span>
                            Berlokasi strategis di <strong class="text-gray-900">Jl. Baros No.78, Kota Cimahi</strong>, kami menjadi pusat pengembangan industri kreatif dan teknologi yang mendukung visi Kota Cimahi sebagai kota yang <strong class="text-gray-900">"Kreatif"</strong> di segala bidang.
                        </span>
                    </p>
                    
                    <p class="flex items-start">
                        <svg class="w-6 h-6 text-pink-500 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span>
                            Kami menyediakan <strong class="text-gray-900">ekosistem kolaboratif</strong> yang menghubungkan pelaku industri, akademisi, pemerintah, dan masyarakat untuk menciptakan inovasi yang berdampak nyata.
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- About Pelita App Section --}}
<section class="py-24 relative overflow-hidden">
    {{-- Background with Pattern --}}
    <div class="absolute inset-0 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50"></div>
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"%3E%3Cpath d="M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z" fill="%233b82f6" fill-opacity="0.05" fill-rule="evenodd"/%3E%3C/svg%3E')] opacity-40"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            {{-- Content Side --}}
            <div data-aos="fade-right" class="order-2 lg:order-1">
                <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full text-white text-sm font-semibold mb-6 shadow-lg">
                    <span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></span>
                    Pelita App
                </div>
                
                <h2 class="text-2xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                    Sistem Manajemen Aset
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Digital Terpercaya</span>
                </h2>
                
                <div class="space-y-6 text-gray-600 text-lg leading-relaxed">
                    <p>
                        <strong class="text-gray-900">Pelita App</strong> adalah platform digital inovatif yang dikembangkan khusus untuk mendukung operasional Cimahi Technopark dalam mengelola peminjaman aset secara efisien, transparan, dan terstruktur.
                    </p>
                    
                    <p>
                        Dengan antarmuka yang <strong class="text-gray-900">user-friendly</strong> dan fitur-fitur canggih, Pelita App memudahkan pengguna untuk mengakses, meminjam, dan mengelola aset dengan sistem yang terintegrasi dan real-time.
                    </p>
                </div>

                {{-- Features List --}}
                <div class="mt-8 space-y-4">
                    <div class="flex items-center bg-white rounded-xl p-3 shadow-lg hover:shadow-xl transition-all duration-300 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Proses Cepat & Mudah</h4>
                            <p class="text-sm text-gray-600">Peminjaman aset dalam hitungan menit</p>
                        </div>
                    </div>

                    <div class="flex items-center bg-white rounded-xl p-3 shadow-lg hover:shadow-xl transition-all duration-300 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Transparan & Akuntabel</h4>
                            <p class="text-sm text-gray-600">Tracking real-time untuk setiap transaksi</p>
                        </div>
                    </div>

                    <div class="flex items-center bg-white rounded-xl p-3 shadow-lg hover:shadow-xl transition-all duration-300 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">Keamanan Terjamin</h4>
                            <p class="text-sm text-gray-600">Data terenkripsi dengan standar tinggi</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- App Preview Side --}}
            <div data-aos="fade-left" class="order-1 lg:order-2 px-6 sm:px-0">
                <div class="relative">
                    {{-- Main Device Mockup --}}
                    <div class="relative bg-gradient-to-br from-blue-600 to-purple-600 rounded-3xl shadow-2xl p-4 sm:p-8 transform hover:scale-105 transition-transform duration-500">
                        <div class="bg-white rounded-2xl overflow-hidden shadow-xl">
                            {{-- Browser Header --}}
                            <div class="bg-gray-100 px-3 py-2 flex items-center space-x-2 border-b">
                                <div class="flex space-x-2">
                                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                    <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                </div>
                                <div class="flex-1 bg-white rounded-lg px-3 py-1 text-xs text-gray-400 flex items-center">
                                    <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    pelitaapp.cimahitechnopark.id
                                </div>
                            </div>
                            {{-- App Content --}}
                            <div class="p-4 space-y-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900">Pelita App</h3>
                                        <p class="text-xs text-gray-500">Asset Management System</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-2">
                                        <div class="text-xl sm:text-2xl font-bold text-blue-600">250+</div>
                                        <div class="text-xs text-gray-600">Total Aset</div>
                                    </div>
                                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-2">
                                        <div class="text-xl sm:text-2xl font-bold text-purple-600">95%</div>
                                        <div class="text-xs text-gray-600">Tersedia</div>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full w-3/4 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full"></div>
                                    </div>
                                    <div class="h-3 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full w-1/2 bg-gradient-to-r from-emerald-500 to-teal-600 rounded-full"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Floating Elements - ADJUSTED FOR MOBILE --}}
                    <div class="absolute top-4 right-4 sm:-top-6 sm:-right-6 w-16 h-16 sm:w-24 sm:h-24 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl shadow-xl flex items-center justify-center animate-bounce" style="animation-duration: 3s;">
                        <svg class="w-8 h-8 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>

                    <div class="absolute bottom-4 left-4 sm:-bottom-6 sm:-left-6 w-24 h-24 sm:w-32 sm:h-32 bg-gradient-to-br from-pink-400 to-red-500 rounded-2xl shadow-xl p-3 sm:p-4 animate-pulse">
                        <div class="text-white">
                            <div class="text-2xl sm:text-3xl font-bold">24/7</div>
                            <div class="text-xs">Support</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Visi Misi Section with Image Background --}}
<section class="py-24 relative overflow-hidden">
    {{-- Background Image --}}
    <div class="absolute inset-0">
        <img src="{{ asset('images/facility.jpg') }}" alt="Facilities" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900/70 via-blue-900/60 to-purple-900/70"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl lg:text-5xl font-bold text-white mb-4">
                Visi & Misi
            </h2>
            <p class="text-xl text-blue-200">Fondasi kami dalam menciptakan masa depan yang lebih baik</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Visi --}}
            <div class="bg-white/10 backdrop-blur-md rounded-3xl p-10 border border-white/20 hover:bg-white/15 transition-all duration-500 shadow-2xl" data-aos="fade-right">
                <div class="flex items-center mb-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-white">Visi</h3>
                </div>
                <p class="text-blue-100 text-lg leading-relaxed">
                    Menjadi pusat inovasi dan teknologi terdepan yang menghasilkan solusi kreatif untuk mendorong pertumbuhan ekonomi berbasis pengetahuan, mewujudkan ekosistem kolaboratif yang berkelanjutan, dan meningkatkan daya saing industri kreatif serta teknologi di Indonesia.
                </p>
            </div>

            {{-- Misi --}}
            <div class="bg-white/10 backdrop-blur-md rounded-3xl p-10 border border-white/20 hover:bg-white/15 transition-all duration-500 shadow-2xl" data-aos="fade-left">
                <div class="flex items-center mb-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-white">Misi</h3>
                </div>
                <ul class="space-y-4 text-blue-100 text-lg">
                    <li class="flex items-start">
                        <div class="w-2 h-2 bg-purple-400 rounded-full mt-2.5 mr-3 flex-shrink-0"></div>
                        <span>Membangun infrastruktur digital yang mendukung inovasi dan kolaborasi</span>
                    </li>
                    <li class="flex items-start">
                        <div class="w-2 h-2 bg-purple-400 rounded-full mt-2.5 mr-3 flex-shrink-0"></div>
                        <span>Menyediakan platform yang transparan dan efisien dalam pengelolaan aset</span>
                    </li>
                    <li class="flex items-start">
                        <div class="w-2 h-2 bg-purple-400 rounded-full mt-2.5 mr-3 flex-shrink-0"></div>
                        <span>Meningkatkan produktivitas dan daya saing melalui teknologi</span>
                    </li>
                    <li class="flex items-start">
                        <div class="w-2 h-2 bg-purple-400 rounded-full mt-2.5 mr-3 flex-shrink-0"></div>
                        <span>Menciptakan ekosistem yang mendukung pertumbuhan startup dan UMKM</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Layanan & Program Section - Clean Slider Version --}}
<section class="py-24 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50 relative overflow-hidden">
    {{-- Animated Background Elements - SAMA SEPERTI LOKASI --}}
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-pink-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center mb-12 sm:mb-16" data-aos="fade-up">
            {{-- Badge dengan gradient dan icon --}}
            <div class="inline-flex items-center px-4 sm:px-5 py-2 bg-white/80 backdrop-blur-sm rounded-full shadow-lg mb-4 sm:mb-6">
                <div class="w-2 sm:w-3 h-2 sm:h-3 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full mr-2 sm:mr-3 animate-pulse"></div>
                <span class="text-xs sm:text-sm font-semibold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Layanan Kami</span>
            </div>
            
            <h2 class="text-3xl sm:text-4xl lg:text-6xl font-bold text-gray-900 mb-4 sm:mb-6">
                Layanan & <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600">Program</span>
            </h2>
        </div>

        {{-- Swiper Slider --}}
        <div class="relative" data-aos="fade-up" data-aos-delay="200">
            <div class="swiper layananSwiper pb-16">
                <div class="swiper-wrapper">
                    {{-- Card 1: Peminjaman Ruangan --}}
                    <div class="swiper-slide">
                        <div class="group relative bg-white rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 h-full border border-gray-100 hover:border-blue-200">
                            {{-- Gradient Accent --}}
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 via-blue-600 to-purple-600"></div>
                            
                            {{-- Image --}}
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ asset('images/ruangan.jpg') }}" alt="Peminjaman Ruangan" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            </div>

                            {{-- Content --}}
                            <div class="p-8">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mr-4 shadow-lg shadow-blue-500/30 group-hover:shadow-blue-500/50 transition-all duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">
                                        Peminjaman Ruangan
                                    </h3>
                                </div>
                                <p class="text-gray-600 leading-relaxed">
                                    Menyediakan ruangan yang nyaman untuk akademik, workshop, rapat, hingga acara komunitas, dilengkapi fasilitas modern sesuai kebutuhanmu.
                                </p>
                            </div>
                            
                            {{-- Hover Effect Line --}}
                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 via-blue-600 to-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                        </div>
                    </div>

                    {{-- Card 2: Peminjaman Barang --}}
                    <div class="swiper-slide">
                        <div class="group relative bg-white rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 h-full border border-gray-100 hover:border-cyan-200">
                            {{-- Gradient Accent --}}
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-cyan-500 via-cyan-600 to-blue-600"></div>
                            
                            {{-- Image --}}
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ asset('images/facility.jpg') }}" alt="Peminjaman Barang" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            </div>

                            {{-- Content --}}
                            <div class="p-8">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-xl flex items-center justify-center mr-4 shadow-lg shadow-cyan-500/30 group-hover:shadow-cyan-500/50 transition-all duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900 group-hover:text-cyan-600 transition-colors duration-300">
                                        Peminjaman Barang
                                    </h3>
                                </div>
                                <p class="text-gray-600 leading-relaxed">
                                    Menyediakan berbagai peralatan dan aset teknologi untuk mendukung kegiatan akademik, workshop, dan acara dengan sistem peminjaman yang mudah.
                                </p>
                            </div>
                            
                            {{-- Hover Effect Line --}}
                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-cyan-500 via-cyan-600 to-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                        </div>
                    </div>

                    {{-- Card 3: Kerja Praktik --}}
                    <div class="swiper-slide">
                        <div class="group relative bg-white rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 h-full border border-gray-100 hover:border-emerald-200">
                            {{-- Gradient Accent --}}
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-500 via-emerald-600 to-teal-600"></div>
                            
                            {{-- Image --}}
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ asset('images/kp.jpg') }}" alt="Kerja Praktik" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            </div>

                            {{-- Content --}}
                            <div class="p-8">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center mr-4 shadow-lg shadow-emerald-500/30 group-hover:shadow-emerald-500/50 transition-all duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900 group-hover:text-emerald-600 transition-colors duration-300">
                                        Kerja Praktik
                                    </h3>
                                </div>
                                <p class="text-gray-600 leading-relaxed">
                                    Asah keterampilan praktismu dengan pengalaman langsung di proyek industri kreatif dan teknologi.
                                </p>
                            </div>
                            
                            {{-- Hover Effect Line --}}
                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-500 via-emerald-600 to-teal-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                        </div>
                    </div>

                    {{-- Card 4: Penelitian & Riset Inovatif --}}
                    <div class="swiper-slide">
                        <div class="group relative bg-white rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 h-full border border-gray-100 hover:border-purple-200">
                            {{-- Gradient Accent --}}
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-purple-500 via-purple-600 to-pink-600"></div>
                            
                            {{-- Image --}}
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ asset('images/penelitian.jpg') }}" alt="Penelitian & Riset" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            </div>

                            {{-- Content --}}
                            <div class="p-8">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mr-4 shadow-lg shadow-purple-500/30 group-hover:shadow-purple-500/50 transition-all duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900 group-hover:text-purple-600 transition-colors duration-300">
                                        Penelitian & Riset Inovatif
                                    </h3>
                                </div>
                                <p class="text-gray-600 leading-relaxed">
                                    Kembangkan ide dan inovasi melalui fasilitas laboratorium dan dukungan riset profesional.
                                </p>
                            </div>
                            
                            {{-- Hover Effect Line --}}
                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-purple-500 via-purple-600 to-pink-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                        </div>
                    </div>

                    {{-- Card 5: Praktik Kerja Lapangan --}}
                    <div class="swiper-slide">
                        <div class="group relative bg-white rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 h-full border border-gray-100 hover:border-orange-200">
                            {{-- Gradient Accent --}}
                            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-orange-500 via-orange-600 to-red-600"></div>
                            
                            {{-- Image --}}
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ asset('images/pkl.jpg') }}" alt="Praktik Kerja Lapangan" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            </div>

                            {{-- Content --}}
                            <div class="p-8">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center mr-4 shadow-lg shadow-orange-500/30 group-hover:shadow-orange-500/50 transition-all duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900 group-hover:text-orange-600 transition-colors duration-300">
                                        Praktik Kerja Lapangan
                                    </h3>
                                </div>
                                <p class="text-gray-600 leading-relaxed">
                                    Dapatkan pengalaman nyata di lingkungan kerja, sekaligus mengasah kompetensi dan skill profesional.
                                </p>
                            </div>
                            
                            {{-- Hover Effect Line --}}
                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-orange-500 via-orange-600 to-red-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                        </div>
                    </div>
                </div>

                {{-- Navigation Buttons --}}
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                
                {{-- Pagination --}}
                <div class="swiper-pagination"></div>
            </div>
        </div>

        {{-- CTA Section --}}
        <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="300">
            <!-- Optional: Add CTA button here if needed -->
        </div>
    </div>
</section>


{{-- Location Section with Maps - Modern Design --}}
<section class="py-12 sm:py-16 lg:py-24 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50 relative overflow-hidden">
    {{-- Animated Background Elements --}}
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-pink-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center mb-8 sm:mb-12 lg:mb-16" data-aos="fade-up">
            <div class="inline-flex items-center px-4 sm:px-5 py-2 bg-white/80 backdrop-blur-sm rounded-full shadow-lg mb-4 sm:mb-6">
                <div class="w-2 sm:w-3 h-2 sm:h-3 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full mr-2 sm:mr-3 animate-pulse"></div>
                <span class="text-xs sm:text-sm font-semibold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Temukan Kami</span>
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-6xl font-bold text-gray-900 mb-4 sm:mb-6">
                Lokasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600">Strategis Kami</span>
            </h2>
            <p class="text-base sm:text-xl text-gray-600 max-w-3xl mx-auto px-4">Kunjungi Cimahi Technopark dan rasakan ekosistem inovasi yang inspiring</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 lg:gap-12 items-start">
            {{-- Interactive Map Section --}}
            <div data-aos="fade-right" class="order-2 lg:order-1">
                <div class="relative group">
                    {{-- Glow Effect --}}
                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 rounded-3xl blur-2xl opacity-30 group-hover:opacity-50 transition-opacity duration-500"></div>
                    
                    {{-- Map Container --}}
                    <div class="relative bg-white rounded-2xl sm:rounded-3xl shadow-2xl overflow-hidden map-container">
                        {{-- Map Header --}}
                        <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-4 sm:px-6 py-3 sm:py-4 flex items-center justify-between">
                            <div class="flex items-center space-x-2 sm:space-x-3">
                                <div class="w-8 sm:w-10 h-8 sm:h-10 bg-white/20 backdrop-blur-sm rounded-lg sm:rounded-xl flex items-center justify-center">
                                    <svg class="w-4 sm:w-5 h-4 sm:h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-white font-bold text-sm sm:text-lg">Cimahi Technopark</h3>
                                    <p class="text-blue-100 text-xs sm:text-sm hidden sm:block">Dekat Damkar Baros</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-1.5 sm:space-x-2">
                                <span class="flex h-2 w-2 sm:h-3 sm:w-3 relative">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 sm:h-3 sm:w-3 bg-green-500"></span>
                                </span>
                                <span class="text-white text-xs sm:text-sm font-medium">Live</span>
                            </div>
                        </div>

                        {{-- Google Maps --}}
                        <div class="relative h-[350px] sm:h-[450px] lg:h-[500px] bg-gray-100">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0849687359824!2d107.53501207499645!3d-6.873788793134595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e602a1a5e707%3A0x9d09d6b6e6eabc23!2sJl.%20Baros%20No.78%2C%20Baros%2C%20Kec.%20Cimahi%20Tengah%2C%20Kota%20Cimahi%2C%20Jawa%20Barat%2040521!5e0!3m2!1sid!2sid!4v1729876543210!5m2!1sid!2sid"
                                class="absolute inset-0 w-full h-full border-0" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                            
                            {{-- Floating Action Buttons --}}
                            <div class="absolute bottom-4 sm:bottom-6 right-4 sm:right-6 flex flex-col space-y-2 sm:space-y-3">
                                <a href="https://www.google.com/maps/dir//Jl.+Baros+No.78,+Baros,+Kec.+Cimahi+Tengah,+Kota+Cimahi,+Jawa+Barat+40521/@-6.873789,107.535012,17z" target="_blank" class="group/btn bg-white hover:bg-blue-600 rounded-lg sm:rounded-xl shadow-lg p-2 sm:p-3 transition-all duration-300 hover:shadow-2xl btn-map-action" title="Dapatkan Arah">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600 group-hover/btn:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                    </svg>
                                </a>
                                <button onclick="toggleMapView()" class="group/btn bg-white hover:bg-purple-600 rounded-lg sm:rounded-xl shadow-lg p-2 sm:p-3 transition-all duration-300 hover:shadow-2xl btn-map-action" title="Ganti Tampilan">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-purple-600 group-hover/btn:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Map Footer --}}
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-4 sm:px-6 py-3 sm:py-4">
                            <div class="flex items-center justify-between flex-wrap gap-2 sm:gap-4">
                                <div class="flex items-center space-x-1.5 sm:space-x-2">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    <span class="text-xs sm:text-sm text-gray-600 font-medium">±50m dari Damkar Baros</span>
                                </div>
                                <div class="flex items-center space-x-1.5 sm:space-x-2 text-xs sm:text-sm text-gray-500">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>5 menit dari pusat kota</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Contact Information Cards --}}
            <div data-aos="fade-left" class="order-1 lg:order-2 space-y-4 sm:space-y-6">
                {{-- Address Card --}}
                <div class="group bg-white rounded-xl sm:rounded-2xl p-3 sm:p-4 lg:p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 contact-card">
                    <div class="flex items-start space-x-3 sm:space-x-4">
                        <div class="relative flex-shrink-0">
                            <div class="absolute inset-0 bg-blue-600 rounded-xl blur-lg opacity-30 group-hover:opacity-50 transition-opacity"></div>
                            <div class="relative w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 sm:w-7 sm:h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2 flex items-center">
                                Alamat Lengkap
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 ml-2 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                            </h3>
                            <p class="text-sm sm:text-base text-gray-600 leading-relaxed mb-3">
                                Jl. Baros No. 78, Baros<br>
                                Kota Cimahi, Jawa Barat 40533<br>
                                Indonesia
                            </p>
                            <a href="https://www.google.com/maps/dir//Jl.+Baros+No.78,+Baros,+Kec.+Cimahi+Tengah,+Kota+Cimahi,+Jawa+Barat+40521/@-6.873789,107.535012,17z" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium text-sm group/link">
                                <span>Dapatkan Arah</span>
                                <svg class="w-4 h-4 ml-1 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Combined Contact Card (Phone & Email) --}}
                <div class="group bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-purple-200 contact-card">
                    <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Kontak Kami
                    </h3>
                    
                    <div class="space-y-4">
                        {{-- Phone --}}
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-purple-500 to-purple-700 rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs sm:text-sm text-gray-500 mb-1">Telepon</p>
                                <a href="tel:+6285163587878" class="text-sm sm:text-base text-gray-900 hover:text-purple-600 transition-colors font-medium break-all">0851-6358-7878</a>
                            </div>
                        </div>

                        {{-- Divider --}}
                        <div class="border-t border-gray-200"></div>

                        {{-- Email --}}
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-pink-500 to-pink-700 rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs sm:text-sm text-gray-500 mb-1">Email</p>
                                <a href="mailto:Cimahi.technopark@gmail.com" class="text-sm sm:text-base text-gray-900 hover:text-pink-600 transition-colors font-medium break-all leading-relaxed">Cimahi.technopark@gmail.com</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Operating Hours Card - NEW MODERN DESIGN --}}
                <div class="group bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 lg:p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-indigo-200 contact-card overflow-hidden relative">
                    {{-- Decorative gradient background --}}
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full blur-3xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                    
                    <div class="relative">
                        {{-- Header --}}
                        <div class="flex items-center mb-6">
                            <div class="relative">
                                <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl blur-lg opacity-30 group-hover:opacity-50 transition-opacity"></div>
                                <div class="relative w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-gray-900">Jam Operasional</h3>
                                <p class="text-sm text-gray-500">Waktu Pelayanan</p>
                            </div>
                        </div>

                        {{-- Schedule Grid --}}
                        <div class="space-y-2 sm:space-y-3">
                            {{-- Weekdays --}}
                            <div class="flex items-center justify-between p-3 sm:p-4 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl border border-indigo-100 hover:border-indigo-200 transition-colors group/item">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm">
                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">Senin - Jumat</p>
                                        <p class="text-xs text-gray-500">Hari Kerja</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-indigo-600">08:00 - 16:00</p>
                                    <p class="text-xs text-gray-500">WIB</p>
                                </div>
                            </div>

                            {{-- Weekend --}}
                            <div class="flex items-center justify-between p-4 bg-gradient-to-r from-gray-50 to-slate-50 rounded-xl border border-gray-200 hover:border-gray-300 transition-colors group/item">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">Sabtu - Minggu</p>
                                        <p class="text-xs text-gray-500">Akhir Pekan</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-gray-400">Tutup</p>
                                    <p class="text-xs text-gray-400">Libur</p>
                                </div>
                            </div>
                        </div>

                        {{-- Status Indicator --}}
                        <div class="mt-6 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border border-emerald-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <span class="flex h-3 w-3 relative">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                                    </span>
                                    <span class="text-sm font-semibold text-emerald-700" id="status-text">Buka Sekarang</span>
                                </div>
                                <div class="flex items-center space-x-2 text-xs text-emerald-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Siap melayani Anda</span>
                                </div>
                            </div>
                        </div>

                        {{-- Additional Info --}}
                        <div class="mt-4 p-3 bg-blue-50 rounded-lg border border-blue-100">
                            <div class="flex items-start space-x-2">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm text-blue-700">
                                    <span class="font-semibold">Info:</span> Untuk kebutuhan mendesak di luar jam operasional, silakan hubungi WhatsApp kami.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Access Buttons --}}
                <div class="flex gap-2 sm:gap-3">
                    <a href="https://wa.me/6285163587878" target="_blank" class="flex-1 group bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 rounded-lg sm:rounded-xl p-3 sm:p-4 shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center space-x-2 text-white font-semibold text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"></path>
                        </svg>
                        <span>WhatsApp</span>
                    </a>
                    <a href="tel:+6285163587878" class="flex-1 group bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 rounded-lg sm:rounded-xl p-3 sm:p-4 shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center space-x-2 text-white font-semibold text-sm sm:text-base">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span>Telepon</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Landmark References --}}
        <div class="mt-8 sm:mt-12 lg:mt-16" data-aos="fade-up">
            <div class="bg-white rounded-2xl sm:rounded-3xl shadow-xl p-4 sm:p-6 lg:p-8 border border-gray-100">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                    </svg>
                    Landmark Terdekat
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6">
                    {{-- Stasiun Kereta Api Cimahi --}}
                    <div class="flex items-start space-x-3 sm:space-x-4 p-3 sm:p-4 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 hover:shadow-lg transition-shadow landmark-card">
                        <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-1">Stasiun Kereta Api Cimahi</h4>
                            <p class="text-sm text-gray-600">±1.5 km - 5 menit berkendara</p>
                        </div>
                    </div>

                    {{-- Dinas Pemadam Kebakaran --}}
                    <div class="flex items-start space-x-4 p-4 rounded-xl bg-gradient-to-br from-red-50 to-red-100 hover:shadow-lg transition-shadow landmark-card">
                        <div class="w-12 h-12 bg-red-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-1">Dinas Pemadam Kebakaran</h4>
                            <p class="text-sm text-gray-600">Jl. Raya Baros - Bersebelahan</p>
                        </div>
                    </div>

                    {{-- Jalan Tol Baros --}}
                    <div class="flex items-start space-x-4 p-4 rounded-xl bg-gradient-to-br from-purple-50 to-purple-100 hover:shadow-lg transition-shadow landmark-card">
                        <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-1">Jalan Tol Baros</h4>
                            <p class="text-sm text-gray-600">±800 meter - Akses cepat</p>
                        </div>
                    </div>

                    {{-- Kecamatan Cimahi Selatan --}}
                    <div class="flex items-start space-x-4 p-4 rounded-xl bg-gradient-to-br from-emerald-50 to-emerald-100 hover:shadow-lg transition-shadow landmark-card">
                        <div class="w-12 h-12 bg-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 mb-1">Kecamatan Cimahi Selatan</h4>
                            <p class="text-sm text-gray-600">±80 m - Wilayah sekitar</p>
                        </div>
                    </div>
                </div>

                {{-- Transportation Guide --}}
                <div class="mt-8 p-6 bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl border border-blue-100">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Panduan Transportasi
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                        <div class="flex items-start space-x-2">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span><strong>Kendaraan Pribadi:</strong> Parkir basement & outdoor tersedia</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span><strong>Kereta Api:</strong> 1.5 km dari Stasiun Cimahi</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span><strong>Akses Tol:</strong> 800 meter ke Jalan Tol Baros</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span><strong>Ojek Online:</strong> Pin lokasi aktif Grab & Gojek</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span><strong>Angkutan Umum:</strong> Akses angkot jurusan Baros</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span><strong>Fasilitas:</strong> WiFi gratis & mushola tersedia</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css" />

<style>
    /* Blob Animation */
    @keyframes blob {
        0%, 100% {
            transform: translate(0, 0) scale(1);
        }
        25% {
            transform: translate(20px, -50px) scale(1.1);
        }
        50% {
            transform: translate(-20px, 20px) scale(0.9);
        }
        75% {
            transform: translate(50px, 50px) scale(1.05);
        }
    }

    .animate-blob {
        animation: blob 10s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }

    .animation-delay-4000 {
        animation-delay: 4s;
    }

    /* Map Container Hover Effects */
    .map-container {
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .map-container:hover {
        transform: translateY(-5px);
    }

    /* Contact Card Animations */
    .contact-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
        animation: fadeInUp 0.6s ease-out forwards;
    }

    .contact-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .contact-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .contact-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    .contact-card:nth-child(4) {
        animation-delay: 0.4s;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .contact-card:hover {
        transform: translateY(-8px) scale(1.02);
    }

    /* Landmark Card Animation */
    .landmark-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .landmark-card:hover {
        transform: translateY(-5px);
    }

    /* Button Map Action */
    .btn-map-action {
        transition: all 0.3s ease;
    }

    .btn-map-action:hover {
        transform: translateY(-2px) scale(1.05);
    }

    .btn-map-action:active {
        transform: translateY(0) scale(0.95);
    }

    /* Prevent overflow on mobile */
@media (max-width: 640px) {
    .relative.group,
    .order-1.lg\:order-2 > div {
        overflow: visible !important;
    }
    
    /* Ensure parent container has padding */
    section .grid {
        overflow: visible;
    }
}

/* Alternative: Hide floating elements on very small screens */
@media (max-width: 480px) {
    .absolute.animate-bounce,
    .absolute.animate-pulse {
        display: none;
    }
}
    /* Pulse Effect for Live Indicator */
    @keyframes ping {
        75%, 100% {
            transform: scale(2);
            opacity: 0;
        }
    }

    .animate-ping {
        animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
    }

    /* Gradient Text Animation */
    @keyframes gradient-shift {
        0%, 100% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
    }

    .animate-gradient {
        background-size: 200% auto;
        animation: gradient-shift 3s ease infinite;
    }

    /* Smooth Scrolling */
    html {
        scroll-behavior: smooth;
    }

    /* Custom Scrollbar for Map Container */
    .map-container::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .map-container::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }

    .map-container::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #3b82f6, #8b5cf6);
        border-radius: 10px;
    }

    .map-container::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #2563eb, #7c3aed);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .map-container iframe {
            height: 400px !important;
        }

        .btn-map-action {
            padding: 0.625rem;
        }

        .btn-map-action svg {
            width: 1.25rem;
            height: 1.25rem;
        }
    }

    /* Loading Animation for Map */
    @keyframes shimmer {
        0% {
            background-position: -1000px 0;
        }
        100% {
            background-position: 1000px 0;
        }
    }

    .map-loading {
        background: linear-gradient(to right, #f0f0f0 0%, #e0e0e0 20%, #f0f0f0 40%, #f0f0f0 100%);
        background-size: 1000px 100%;
        animation: shimmer 2s linear infinite;
    }

    /* Tooltip Styles */
    [title] {
        position: relative;
    }

    /* Icon Spin Animation */
    @keyframes spin {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    .animate-spin {
        animation: spin 1s linear infinite;
    }

    /* Fade In Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .fade-in {
        animation: fadeIn 0.5s ease-in;
    }

    /* Scale Animation */
    @keyframes scaleIn {
        from {
            transform: scale(0.9);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .scale-in {
        animation: scaleIn 0.3s ease-out;
    }

    /* Glow Effect */
    .glow-effect {
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        transition: box-shadow 0.3s ease;
    }

    .glow-effect:hover {
        box-shadow: 0 0 30px rgba(59, 130, 246, 0.8);
    }

        /* Gradient Animation untuk About */
    @keyframes gradient-about {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .animate-gradient-about {
        background-size: 200% 200%;
        animation: gradient-about 3s ease infinite;
    }

        @keyframes bounce-slow {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .animate-bounce-slow {
        animation: bounce-slow 2s ease-in-out infinite;
    }
    .animate-bounce {
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
        animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
    }
    50% {
        transform: translateY(-15px);
        animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
    }
}

/* Gradient Animation untuk About */
@keyframes gradient-about {
    0%, 100% { 
        background-position: 0% 50%; 
    }
    50% { 
        background-position: 100% 50%; 
    }
}

.animate-gradient-about {
    background-size: 200% 200%;
    animation: gradient-about 3s ease infinite;
}

/* Pulse Animation untuk Text */
.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .absolute.bottom-8 {
        bottom: 1.5rem;
    }
    
    .absolute.bottom-8 span {
        font-size: 0.75rem;
    }
    
    .absolute.bottom-8 svg {
        width: 1.25rem;
        height: 1.25rem;
    }
}

@media (max-width: 640px) {
    .absolute.bottom-8 {
        bottom: 1rem;
    }
}

/* Ensure proper stacking */
.relative.min-h-screen {
    position: relative;
}

/* Hide scroll indicator when scrolling */
@media (hover: hover) and (pointer: fine) {
    .scroll-hidden .absolute.bottom-8 {
        opacity: 0;
        transition: opacity 0.3s ease;
    }
}
  /* Swiper Customization */
    .layananSwiper {
        padding-bottom: 60px;
    }

    .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: #3B82F6;
        opacity: 0.3;
        transition: all 0.3s;
    }

    .swiper-pagination-bullet-active {
        width: 32px;
        border-radius: 6px;
        opacity: 1;
        background: linear-gradient(135deg, #3B82F6 0%, #8B5CF6 100%);
    }

    .swiper-button-next, .swiper-button-prev {
        width: 50px;
        height: 50px;
        background: white;
        border: 2px solid #3B82F6;
        border-radius: 50%;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
        transition: all 0.3s;
    }

    .swiper-button-next:hover, .swiper-button-prev:hover {
        background: linear-gradient(135deg, #3B82F6 0%, #8B5CF6 100%);
        transform: scale(1.1);
        border-color: transparent;
    }

    .swiper-button-next:after, .swiper-button-prev:after {
        font-size: 20px;
        font-weight: bold;
        color: #3B82F6;
    }

    .swiper-button-next:hover:after, .swiper-button-prev:hover:after {
        color: white;
    }

    .swiper-slide {
        height: auto;
    }
    
    /* Animation untuk status indicator */
    @keyframes ping {
        75%, 100% {
            transform: scale(2);
            opacity: 0;
        }
    }

    .animate-ping {
        animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
    }

    /* Hover effects */
    .group\/item:hover {
        transform: translateX(4px);
        transition: transform 0.2s ease;
    }

    /* Responsive adjustments */
    @media (max-width: 640px) {
        .contact-card {
            padding: 1rem;
        }
        
        .text-lg {
            font-size: 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>

<script>
// ============================================
// AOS INITIALIZATION - MOBILE OPTIMIZED
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    // CRITICAL: Initialize AOS with mobile support
    if (typeof AOS !== 'undefined') {
        AOS.init({
            // Core settings
            duration: 800,
            easing: 'ease-out-cubic',
            once: false, // Allow repeat animations
            mirror: true, // Animate on scroll up too
            
            // Mobile optimization - IMPORTANT!
            disable: false, // ENABLE on all devices including mobile
            
            // Trigger settings
            offset: 50, // Trigger earlier (50px before element enters viewport)
            delay: 0,
            
            // Placement
            anchorPlacement: 'top-bottom',
            
            // Performance
            throttleDelay: 99,
            debounceDelay: 50,
        });
        
        // Force refresh for mobile browsers (multiple attempts)
        const forceRefresh = () => {
            AOS.refresh();
            console.log('✅ AOS Refreshed');
        };
        
        // Aggressive refresh strategy for mobile
        setTimeout(forceRefresh, 100);
        setTimeout(forceRefresh, 300);
        setTimeout(forceRefresh, 500);
        setTimeout(forceRefresh, 1000);
        
        // Refresh on window resize (important for mobile orientation change)
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(forceRefresh, 250);
        });
        
        // Refresh on scroll (for mobile lazy loading)
        let scrollTimer;
        window.addEventListener('scroll', () => {
            clearTimeout(scrollTimer);
            scrollTimer = setTimeout(forceRefresh, 100);
        }, { passive: true });
        
        console.log('✅ AOS Initialized for Mobile');
    } else {
        console.error('❌ AOS library not loaded!');
    }
    
    // FALLBACK: Manual animation for elements if AOS fails
    const manualAnimate = () => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('aos-animate');
                    // Don't unobserve so it can animate again
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });
        
        document.querySelectorAll('[data-aos]').forEach(el => {
            observer.observe(el);
        });
        
        console.log('✅ Fallback animation observer active');
    };
    
    // Activate fallback after AOS initialization
    setTimeout(manualAnimate, 200);
});

// ============================================
// MAP FUNCTIONS
// ============================================

// Toggle Map View
let mapViewType = '0';
function toggleMapView() {
    const iframe = document.querySelector('.map-container iframe');
    if (!iframe) return;
    
    const baseUrl = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0849687359824!2d107.53501207499645!3d-6.873788793134595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e602a1a5e707%3A0x9d09d6b6e6eabc23!2sJl.%20Baros%20No.78%2C%20Baros%2C%20Kec.%20Cimahi%20Tengah%2C%20Kota%20Cimahi%2C%20Jawa%20Barat%2040521!5e';        
    
    if (mapViewType === '0') {
        mapViewType = '1';
        showNotification('Tampilan Satelit', 'success');
    } else if (mapViewType === '1') {
        mapViewType = '3';
        showNotification('Tampilan Hybrid', 'success');
    } else {
        mapViewType = '0';
        showNotification('Tampilan Peta', 'success');
    }
    
    iframe.src = baseUrl + mapViewType + '!3m2!1sid!2sid!4v1729876543210!5m2!1sid!2sid';
}

// Refresh Map
function refreshMap() {
    const iframe = document.querySelector('.map-container iframe');
    if (!iframe) return;
    
    const currentSrc = iframe.src;
    iframe.src = '';
    
    const mapContainer = iframe.parentElement;
    mapContainer.classList.add('map-loading');
    
    setTimeout(() => {
        iframe.src = currentSrc;
        mapContainer.classList.remove('map-loading');
        showNotification('Map telah direfresh', 'success');
    }, 500);
}

// ============================================
// OPERATING HOURS CHECK - NEW VERSION
// ============================================
function checkOperatingHours() {
    const now = new Date();
    const day = now.getDay(); // 0 = Sunday, 1 = Monday, ..., 6 = Saturday
    const hours = now.getHours();
    const minutes = now.getMinutes();
    const currentTime = hours * 60 + minutes;
    
    const statusText = document.getElementById('status-text');
    const statusContainer = statusText?.closest('.bg-gradient-to-r');
    
    if (!statusText || !statusContainer) return;
    
    const openTime = 8 * 60; // 08:00
    const closeTime = 16 * 60; // 16:00
    
    // Monday to Friday (1-5)
    if (day >= 1 && day <= 5) {
        if (currentTime >= openTime && currentTime < closeTime) {
            // Open now
            statusText.textContent = 'Buka Sekarang';
            statusContainer.className = 'mt-6 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border border-emerald-200';
            statusText.className = 'text-sm font-semibold text-emerald-700';
            
            // Update indicator color
            const indicator = statusText.previousElementSibling?.querySelector('.bg-emerald-500');
            if (indicator) {
                indicator.className = 'relative inline-flex rounded-full h-3 w-3 bg-emerald-500';
                indicator.previousElementSibling.className = 'animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75';
            }
        } else if (currentTime < openTime) {
            // Before opening
            const minutesUntilOpen = openTime - currentTime;
            const hoursUntilOpen = Math.floor(minutesUntilOpen / 60);
            const minsUntilOpen = minutesUntilOpen % 60;
            
            statusText.textContent = `Buka dalam ${hoursUntilOpen}j ${minsUntilOpen}m`;
            statusContainer.className = 'mt-6 p-4 bg-gradient-to-r from-yellow-50 to-amber-50 rounded-xl border border-yellow-200';
            statusText.className = 'text-sm font-semibold text-yellow-700';
            
            // Update indicator color
            const indicator = statusText.previousElementSibling?.querySelector('.bg-emerald-500');
            if (indicator) {
                indicator.className = 'relative inline-flex rounded-full h-3 w-3 bg-yellow-500';
                indicator.previousElementSibling.className = 'animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75';
            }
        } else {
            // After closing
            statusText.textContent = 'Tutup - Buka Besok 08:00';
            statusContainer.className = 'mt-6 p-4 bg-gradient-to-r from-gray-50 to-slate-50 rounded-xl border border-gray-200';
            statusText.className = 'text-sm font-semibold text-gray-600';
            
            // Update indicator color
            const indicator = statusText.previousElementSibling?.querySelector('.bg-emerald-500');
            if (indicator) {
                indicator.className = 'relative inline-flex rounded-full h-3 w-3 bg-gray-400';
                indicator.previousElementSibling.className = 'animate-ping absolute inline-flex h-full w-full rounded-full bg-gray-300 opacity-75';
            }
        }
    } else {
        // Weekend
        statusText.textContent = 'Tutup - Buka Senin 08:00';
        statusContainer.className = 'mt-6 p-4 bg-gradient-to-r from-gray-50 to-slate-50 rounded-xl border border-gray-200';
        statusText.className = 'text-sm font-semibold text-gray-600';
        
        // Update indicator color
        const indicator = statusText.previousElementSibling?.querySelector('.bg-emerald-500');
        if (indicator) {
            indicator.className = 'relative inline-flex rounded-full h-3 w-3 bg-gray-400';
            indicator.previousElementSibling.className = 'animate-ping absolute inline-flex h-full w-full rounded-full bg-gray-300 opacity-75';
        }
    }
}

// ============================================
// NOTIFICATION SYSTEM
// ============================================
function showNotification(message, type = 'info') {
    const existingNotification = document.querySelector('.map-notification');
    if (existingNotification) existingNotification.remove();

    const notification = document.createElement('div');
    notification.className = 'map-notification fixed top-24 right-6 z-50 px-6 py-3 rounded-xl shadow-2xl flex items-center space-x-3 scale-in';
    
    const colors = {
        success: 'bg-green-500 text-white',
        error: 'bg-red-500 text-white',
        info: 'bg-blue-500 text-white',
        warning: 'bg-yellow-500 text-white'
    };
    
    notification.className += ` ${colors[type] || colors.info}`;
    
    const icons = {
        success: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>',
        error: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>',
        info: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
        warning: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>'
    };
    
    notification.innerHTML = `${icons[type] || icons.info}<span class="font-medium">${message}</span>`;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transform = 'translateX(100%)';
        notification.style.transition = 'all 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// ============================================
// PAGE INITIALIZATION
// ============================================
window.addEventListener('load', function() {
    checkOperatingHours();
    setInterval(checkOperatingHours, 60000);
    
    // Map iframe error handling
    const mapIframe = document.querySelector('.map-container iframe');
    if (mapIframe) {
        mapIframe.addEventListener('error', function() {
            showNotification('Gagal memuat peta. Silakan refresh halaman.', 'error');
        });
    }
    
    console.log('✅ Page fully loaded - All scripts active');
});

// Handle page visibility for performance
document.addEventListener('visibilitychange', () => {
    if (!document.hidden && typeof AOS !== 'undefined') {
        AOS.refresh();
        checkOperatingHours();
    }
});

// ============================================
// SWIPER INITIALIZATION
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    const layananSwiper = new Swiper('.layananSwiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        },
        effect: 'slide',
        speed: 800,
    });

    // Pause/play on click
    const swiperContainer = document.querySelector('.layananSwiper');
    let isPaused = false;
    
    swiperContainer.addEventListener('click', function(e) {
        if (!e.target.closest('.swiper-button-next') && 
            !e.target.closest('.swiper-button-prev') && 
            !e.target.closest('.swiper-pagination')) {
            if (isPaused) {
                layananSwiper.autoplay.start();
                isPaused = false;
            } else {
                layananSwiper.autoplay.stop();
                isPaused = true;
            }
        }
    });
});

// ============================================
// COUNTER ANIMATION WITH EASING - STATISTICS
// ============================================
function animateCounter() {
    const counters = document.querySelectorAll('.counter');
    
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px'
    };
    
    const easeOutQuad = (t) => t * (2 - t);
    
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2000; // 2 detik
                const startTime = performance.now();
                
                const updateCounter = (currentTime) => {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    const easedProgress = easeOutQuad(progress);
                    const current = Math.floor(easedProgress * target);
                    
                    counter.textContent = current;
                    
                    if (progress < 1) {
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };
                
                requestAnimationFrame(updateCounter);
                counterObserver.unobserve(counter); // Hanya jalankan sekali
            }
        });
    }, observerOptions);
    
    counters.forEach(counter => {
        counterObserver.observe(counter);
    });
}

// Jalankan saat DOM ready
document.addEventListener('DOMContentLoaded', function() {
    animateCounter();
    console.log('✅ Counter Animation initialized');
});
</script>
@endpush
@endsection