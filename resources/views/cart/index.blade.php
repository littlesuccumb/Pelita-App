@extends('layouts.user')

@section('title', 'Keranjang Belanja - Pelita App')

@push('styles')
<style>
html {
    overflow-x: hidden !important;
}

body {
    overflow-x: hidden !important;
}

nav {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    z-index: 9999 !important;
}
</style>
@endpush

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Hero Section with Gradient (New Design) -->
<div class="relative bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 overflow-hidden mt-20">
    <!-- Decorative Elements -->
    <div class="absolute inset-0">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-0 left-1/3 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 pb-24 md:pb-32">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
            <!-- Welcome Content - Left Side -->
            <div class="text-white space-y-4 relative z-10 flex-1 w-full" data-aos="fade-up">

                <div class="flex items-start gap-4 mb-4">                   
                    <!-- Cart Icon Badge -->
                    <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm border border-white/20">
                        <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                        <span id="cart-status-badge">Siap Checkout</span>
                    </div>
                </div>
                
                <div>
                    <h1 class="text-3xl lg:text-4xl xl:text-5xl font-bold mb-3 leading-tight">
                        Keranjang Belanja
                    </h1>
                    <p class="text-base md:text-lg text-blue-100 flex items-center gap-2">
                        <i class="fa-solid fa-shopping-bag"></i>
                        <span id="cart-count-hero" class="font-bold">0</span> item siap diajukan
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-2">
                    <button onclick="clearCart()" class="group inline-flex items-center justify-center px-6 py-3 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-xl border-2 border-white/30 hover:bg-white/20 hover:border-white/50 shadow-lg transform hover:scale-105 transition-all duration-300">
                        <i class="fa-solid fa-trash mr-2"></i>
                        Kosongkan Keranjang
                    </button>
                    
                    <a href="{{ route('user.barang') }}" class="group inline-flex items-center justify-center px-6 py-3 bg-white text-blue-700 font-bold rounded-xl shadow-2xl hover:shadow-white/20 transform hover:scale-105 transition-all duration-300 overflow-hidden relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-purple-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <i class="fa-solid fa-shopping-bag relative mr-2"></i>
                        <span class="relative">Lanjut Belanja</span>
                    </a>
                </div>
            </div>
            
            <!-- Cart Icon Illustration - Right Side -->
            <div class="relative lg:flex-shrink-0 hidden lg:block" data-aos="fade-left">
                <div class="relative w-64 h-64">
                    <!-- Decorative circles -->
                    <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-white/5 rounded-full backdrop-blur-sm"></div>
                    
                    <!-- Cart Icon with floating animation -->
                    <div class="absolute inset-0 flex items-center justify-center animate-float">
                        <div class="relative">
                            <div class="w-40 h-40 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border-4 border-white/30 shadow-2xl">
                                <i class="fa-solid fa-shopping-cart text-7xl text-white"></i>
                            </div>
                            <!-- Badge Count -->
                            <div class="absolute -top-2 -right-2 w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center text-white font-black text-2xl shadow-lg animate-pulse border-4 border-white/30" id="cart-count-badge-hero">
                                0
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modern Wave Divider -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] translate-y-10 md:translate-y-16">
        <svg class="relative block w-full h-[160px] md:h-[200px]" viewBox="0 0 1200 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <linearGradient id="cartWaveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#F8FAFC;stop-opacity:1" />
                    <stop offset="50%" style="stop-color:#F1F5F9;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#F8FAFC;stop-opacity:1" />
                </linearGradient>
            </defs>
            
            <!-- Wave Layer 1 -->
            <path d="M0,25 Q100,70 200,50 Q300,30 400,55 Q500,80 600,45 Q700,20 800,50 Q900,75 1000,40 Q1100,25 1200,55 L1200,120 L0,120 Z" 
                  fill="url(#cartWaveGradient)" 
                  opacity="1">
                <animate attributeName="d" 
                         dur="8s" 
                         repeatCount="indefinite"
                         values="
                            M0,25 Q100,70 200,50 Q300,30 400,55 Q500,80 600,45 Q700,20 800,50 Q900,75 1000,40 Q1100,25 1200,55 L1200,120 L0,120 Z;
                            M0,35 Q100,50 200,70 Q300,85 400,50 Q500,30 600,60 Q700,80 800,45 Q900,30 1000,65 Q1100,75 1200,45 L1200,120 L0,120 Z;
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
                            M0,45 Q150,80 300,55 Q450,35 600,70 Q750,90 900,55 Q1050,40 1200,75 L1200,120 L0,120 Z" />
            </path>
        </svg>
    </div>
</div>

<!-- Main Content Section -->
<div class="bg-slate-50 pt-0 pb-16 mt-8">
    <div class="relative max-w-7xl mx-auto px-3 sm:px-4 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-4 md:gap-8">
            <!-- Cart Items Section -->
            <div class="lg:col-span-8 space-y-3 md:space-y-4" data-aos="fade-right">
                <!-- Selection Header -->
                <div class="bg-white/80 backdrop-blur-sm rounded-xl md:rounded-2xl border-2 border-blue-200 p-3 md:p-4 shadow-md">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 md:gap-3">
                            <input type="checkbox" id="select-all" onchange="toggleSelectAll(this.checked)"
                                   class="w-4 h-4 md:w-5 md:h-5 text-blue-600 bg-white border-slate-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer flex-shrink-0">
                            <label for="select-all" class="font-bold text-slate-900 cursor-pointer text-sm md:text-base">
                                Pilih Semua (<span id="total-items-count">0</span>)
                            </label>
                        </div>
                        <button onclick="deleteSelected()" class="text-red-600 hover:text-red-700 font-semibold text-xs md:text-sm flex items-center gap-1.5 md:gap-2 px-2 py-1.5 md:px-3 md:py-2 hover:bg-red-50 rounded-lg transition-all">
                            <i class="fa-solid fa-trash"></i>
                            <span class="hidden sm:inline">Hapus</span>
                        </button>
                    </div>
                </div>

                <!-- Cart Items Container -->
                <div id="cart-items-container" class="space-y-3 md:space-y-4">
                    <!-- Items will be loaded here -->
                </div>

                <!-- Empty Cart State -->
                <div id="empty-cart-state" class="hidden bg-white/80 backdrop-blur-sm rounded-2xl md:rounded-3xl border-2 border-slate-200 p-8 md:p-16 text-center shadow-lg">
                    <div class="relative w-24 h-24 md:w-40 md:h-40 mx-auto mb-4 md:mb-6">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-400/20 to-cyan-400/20 rounded-full blur-2xl animate-pulse"></div>
                        <div class="relative w-full h-full rounded-full bg-gradient-to-br from-white to-slate-50 flex items-center justify-center border-4 border-slate-200 shadow-xl">
                            <i class="fa-solid fa-shopping-cart text-4xl md:text-6xl text-slate-300"></i>
                        </div>
                    </div>
                    <h3 class="text-xl md:text-3xl font-black text-slate-900 mb-2 md:mb-3">Keranjang Masih Kosong</h3>
                    <p class="text-sm md:text-base text-slate-600 mb-6 md:mb-8 max-w-md mx-auto px-4">Yuk, mulai tambahkan barang yang ingin Anda pinjam dari katalog kami!</p>
                    <a href="{{ route('user.barang') }}" class="inline-flex items-center gap-2 md:gap-3 px-6 md:px-8 py-3 md:py-4 bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 text-white rounded-xl font-bold text-sm md:text-lg hover:shadow-2xl hover:shadow-blue-500/40 transition-all transform hover:scale-105 active:scale-95">
                        <i class="fa-solid fa-shopping-bag text-lg md:text-xl"></i>
                        Mulai Belanja
                    </a>
                </div>

                <!-- Continue Shopping Banner -->
                <div class="bg-gradient-to-r from-blue-100 via-cyan-100 to-purple-100 rounded-xl md:rounded-2xl border-2 border-blue-200 p-4 md:p-6 shadow-md" data-aos="fade-up">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 md:gap-4">
                        <div class="flex items-center gap-3 md:gap-4 w-full sm:w-auto">
                            <div class="w-12 h-12 md:w-14 md:h-14 bg-white rounded-xl md:rounded-2xl flex items-center justify-center shadow-lg flex-shrink-0">
                                <i class="fa-solid fa-tags text-blue-600 text-xl md:text-2xl"></i>
                            </div>
                            <div class="text-left flex-1 min-w-0">
                                <h3 class="font-black text-slate-900 text-base md:text-lg truncate">Butuh item lainnya?</h3>
                                <p class="text-xs md:text-sm text-slate-600 truncate">Jelajahi katalog lengkap kami</p>
                            </div>
                        </div>
                        <a href="{{ route('user.barang') }}" class="w-full sm:w-auto px-5 md:px-6 py-2.5 md:py-3 bg-white hover:bg-slate-50 text-slate-900 rounded-xl font-bold text-sm md:text-base border-2 border-blue-200 hover:border-blue-400 transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                            <i class="fa-solid fa-arrow-right"></i>
                            Lanjut Belanja
                        </a>
                    </div>
                </div>
            </div>

            <!-- Summary Sidebar -->
            <div class="lg:col-span-4" data-aos="fade-left">
                <div class="lg:sticky lg:top-24 space-y-3 md:space-y-4">
                    <!-- Order Summary Card -->
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl md:rounded-3xl border-2 border-blue-200 shadow-xl overflow-hidden">
                        <!-- Header -->
                        <div class="bg-gradient-to-r from-blue-600 via-cyan-500 to-blue-600 p-4 md:p-6 text-white">
                            <h3 class="text-lg md:text-xl font-black flex items-center gap-2 md:gap-3">
                                <div class="w-8 h-8 md:w-10 md:h-10 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-receipt text-sm md:text-base"></i>
                                </div>
                                <span class="truncate">Ringkasan Pesanan</span>
                            </h3>
                        </div>

                        <div class="p-4 md:p-6 space-y-4 md:space-y-6">
                            <!-- Summary Details -->
                            <div class="space-y-3 md:space-y-4">
                                <!-- Total Items -->
                                <div class="flex justify-between items-center">
                                    <span class="text-slate-600 font-medium flex items-center gap-2 text-sm md:text-base">
                                        <i class="fa-solid fa-box text-blue-600"></i>
                                        <span class="truncate">Total Item</span>
                                    </span>
                                    <span class="font-black text-slate-900 text-base md:text-lg flex-shrink-0"><span id="summary-total-items">0</span> item</span>
                                </div>

                                <!-- Total Quantity -->
                                <div class="flex justify-between items-center">
                                    <span class="text-slate-600 font-medium flex items-center gap-2 text-sm md:text-base">
                                        <i class="fa-solid fa-cubes text-cyan-600"></i>
                                        <span class="truncate">Total Unit</span>
                                    </span>
                                    <span class="font-black text-slate-900 text-base md:text-lg flex-shrink-0"><span id="summary-total-qty">0</span> unit</span>
                                </div>

                                <div class="border-t-2 border-dashed border-slate-200 my-3 md:my-4"></div>

                                <!-- Rental Duration -->
                                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl md:rounded-2xl p-3 md:p-4 border-2 border-blue-200">
                                    <label class="text-xs md:text-sm font-bold text-slate-900 mb-2 md:mb-3 flex items-center gap-2">
                                        <i class="fa-solid fa-calendar-days text-blue-600"></i>
                                        <span class="truncate">Durasi Peminjaman</span>
                                    </label>
                                    <div class="flex items-center gap-2 md:gap-3 mt-2 md:mt-3">
                                        <button onclick="changeDuration(-1)" class="w-9 h-9 md:w-10 md:h-10 bg-white rounded-lg md:rounded-xl border-2 border-blue-200 hover:border-blue-400 hover:bg-blue-50 transition-all flex items-center justify-center font-bold text-slate-700 flex-shrink-0">
                                            <i class="fa-solid fa-minus text-xs md:text-sm"></i>
                                        </button>
                                        <input type="number" id="duration-days" value="1" min="1" max="3" 
                                               class="flex-1 text-center text-lg md:text-xl font-black px-3 md:px-4 py-2 md:py-3 border-2 border-blue-200 rounded-lg md:rounded-xl focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/20 transition-all"
                                               onchange="calculateTotal()">
                                        <button onclick="changeDuration(1)" class="w-9 h-9 md:w-10 md:h-10 bg-white rounded-lg md:rounded-xl border-2 border-blue-200 hover:border-blue-400 hover:bg-blue-50 transition-all flex items-center justify-center font-bold text-slate-700 flex-shrink-0">
                                            <i class="fa-solid fa-plus text-xs md:text-sm"></i>
                                        </button>
                                    </div>
                                    <p class="text-xs text-center text-slate-600 mt-2 font-medium">Maksimal 3 hari</p>
                                </div>

                                <div class="border-t-2 border-dashed border-slate-200 my-3 md:my-4"></div>

                                <!-- Price Breakdown -->
                                <div class="space-y-2 md:space-y-3">
                                    <div class="flex justify-between items-center text-sm md:text-base">
                                        <span class="text-slate-600 truncate pr-2">Subtotal</span>
                                        <span class="font-bold text-slate-900 flex-shrink-0" id="summary-subtotal">Rp 0</span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm md:text-base">
                                        <span class="text-slate-600 truncate pr-2">Durasi</span>
                                        <span class="font-bold text-slate-900 flex-shrink-0"><span id="duration-display">1</span> hari</span>
                                    </div>
                                </div>

                                <div class="border-t-2 border-slate-200 my-3 md:my-4"></div>

                                <!-- Total -->
                                <div class="flex justify-between items-center bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl md:rounded-2xl p-3 md:p-4 border-2 border-blue-200">
                                    <span class="text-base md:text-lg font-black text-slate-900 truncate pr-2">Total Bayar</span>
                                    <div class="text-right flex-shrink-0">
                                        <div class="text-xl md:text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-cyan-600 to-blue-600 whitespace-nowrap" id="summary-total">
                                            Rp 0
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Alert -->
                            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-2 border-emerald-200 rounded-xl md:rounded-2xl p-3 md:p-4">
                                <div class="flex gap-2 md:gap-3">
                                    <i class="fa-solid fa-circle-info text-emerald-600 text-lg md:text-xl mt-0.5 flex-shrink-0"></i>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs md:text-sm text-emerald-900 font-bold mb-1">Informasi Penting</p>
                                        <p class="text-xs text-emerald-800 leading-relaxed">Item GRATIS tetap perlu diajukan dalam permohonan peminjaman</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Checkout Button -->
                            <button onclick="proceedToCheckout()" id="checkout-btn" disabled
                                    class="w-full relative overflow-hidden group px-4 md:px-6 py-4 md:py-5 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-xl md:rounded-2xl font-black text-base md:text-lg transition-all duration-300 hover:shadow-2xl hover:shadow-cyan-500/40 hover:scale-[1.02] active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 disabled:hover:shadow-none">
                                
                                <!-- Shine Effect -->
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-out"></div>
                                
                                <!-- Button Content -->
                                <span class="relative flex items-center justify-center gap-2 md:gap-3" id="checkout-btn-content">
                                    <i class="fa-solid fa-paper-plane text-lg md:text-xl transform group-hover:rotate-12 transition-transform duration-300"></i>
                                    <span class="truncate">Ajukan Permohonan</span>
                                    <i class="fa-solid fa-arrow-right text-lg md:text-xl transform group-hover:translate-x-2 transition-transform duration-300"></i>
                                </span>
                                
                                <!-- Loading Spinner (Hidden by default) -->
                                <span class="hidden absolute inset-0 items-center justify-center gap-3" id="checkout-btn-loading">
                                    <svg class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span class="font-bold">Memproses...</span>
                                </span>
                            </button>

                            <div class="flex items-center justify-center gap-2 text-xs text-slate-500">
                                <i class="fa-solid fa-shield-halved text-green-600"></i>
                                <span>Data Anda aman dan terenkripsi</span>
                            </div>
                        </div>
                    </div>

                    <!-- Benefits Card -->
                    <div class="hidden lg:block bg-gradient-to-br from-purple-50 via-blue-50 to-cyan-50 rounded-2xl border-2 border-blue-200 p-4 md:p-6 shadow-md">
                        <h4 class="font-black text-slate-900 mb-4 flex items-center gap-2 text-base md:text-lg">
                            <div class="w-7 h-7 md:w-8 md:h-8 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-star text-white text-xs md:text-sm"></i>
                            </div>
                            <span class="truncate">Keuntungan Peminjaman</span>
                        </h4>
                        <ul class="space-y-2 md:space-y-3">
                            <li class="flex items-start gap-2 md:gap-3 group">
                                <div class="w-5 h-5 md:w-6 md:h-6 bg-gradient-to-r from-green-500 to-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:scale-110 transition-transform shadow-md">
                                    <i class="fa-solid fa-check text-white text-xs"></i>
                                </div>
                                <span class="text-xs md:text-sm text-slate-700 leading-relaxed"><strong>Proses Cepat</strong> - Persetujuan 1-2 hari</span>
                            </li>
                            <li class="flex items-start gap-2 md:gap-3 group">
                                <div class="w-5 h-5 md:w-6 md:h-6 bg-gradient-to-r from-green-500 to-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:scale-110 transition-transform shadow-md">
                                    <i class="fa-solid fa-check text-white text-xs"></i>
                                </div>
                                <span class="text-xs md:text-sm text-slate-700 leading-relaxed"><strong>Fleksibel</strong> - Durasi sesuai kebutuhan</span>
                            </li>
                            <li class="flex items-start gap-2 md:gap-3 group">
                                <div class="w-5 h-5 md:w-6 md:h-6 bg-gradient-to-r from-green-500 to-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:scale-110 transition-transform shadow-md">
                                    <i class="fa-solid fa-check text-white text-xs"></i>
                                </div>
                                <span class="text-xs md:text-sm text-slate-700 leading-relaxed"><strong>Terpercaya</strong> - Barang berkualitas</span>
                            </li>
                            <li class="flex items-start gap-2 md:gap-3 group">
                                <div class="w-5 h-5 md:w-6 md:h-6 bg-gradient-to-r from-green-500 to-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:scale-110 transition-transform shadow-md">
                                    <i class="fa-solid fa-check text-white text-xs"></i>
                                </div>
                                <span class="text-xs md:text-sm text-slate-700 leading-relaxed"><strong>Support 24/7</strong> - Bantuan kapan saja</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirm Delete Modal -->
<div id="confirmDeleteModal" class="fixed inset-0 z-[60] hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeDeleteModal()"></div>
        
        <!-- Modal -->
        <div class="relative bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 transform transition-all scale-100">
            <div class="text-center">
                <!-- Icon -->
                <div class="w-20 h-20 bg-gradient-to-br from-red-100 to-rose-100 rounded-full flex items-center justify-center mx-auto mb-6 relative">
                    <div class="absolute inset-0 bg-red-500/20 rounded-full blur-xl animate-pulse"></div>
                    <i class="fa-solid fa-trash text-red-600 text-3xl relative"></i>
                </div>
                
                <h3 class="text-2xl font-black text-slate-900 mb-2">Hapus Item?</h3>
                <p class="text-slate-600 mb-8">Item yang dipilih akan dihapus dari keranjang Anda</p>
                
                <!-- Actions -->
                <div class="grid grid-cols-2 gap-3">
                    <button onclick="closeDeleteModal()" class="px-6 py-3.5 bg-slate-100 hover:bg-slate-200 text-slate-900 rounded-xl font-bold transition-all border-2 border-slate-200">
                        Batal
                    </button>
                    <button onclick="confirmDelete()" class="px-6 py-3.5 bg-gradient-to-r from-red-600 to-rose-600 text-white rounded-xl font-bold hover:shadow-xl hover:shadow-red-500/40 transition-all">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

/* Blob animations */
@keyframes blob {
    0%, 100% { transform: translate(0, 0) scale(1); }
    25% { transform: translate(20px, -50px) scale(1.1); }
    50% { transform: translate(-20px, 20px) scale(0.9); }
    75% { transform: translate(50px, 50px) scale(1.05); }
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

/* Float animation for cart icon */
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

/* Quantity Input Styling */
.qty-input::-webkit-inner-spin-button,
.qty-input::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.qty-input {
    -moz-appearance: textfield;
}

/* Cart Item Hover Effect */
.cart-item {
    transition: border-color 0.3s, box-shadow 0.3s;
}

/* Checkbox styling */
input[type="checkbox"]:checked {
    background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e");
}

/* Glass effect */
.backdrop-blur-sm {
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Modal animation */
#confirmDeleteModal.show {
    animation: modalFadeIn 0.3s ease-out;
}

@keyframes modalFadeIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Loading spinner animation */
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

/* Button hover effect improvements */
#checkout-btn:not(:disabled):hover {
    background: linear-gradient(to right, #2563eb, #0891b2);
}

#checkout-btn:not(:disabled):active {
    background: linear-gradient(to right, #1d4ed8, #0e7490);
}

/* Smooth transitions */
#checkout-btn * {
    transition-duration: 300ms;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

/* Mobile optimizations */
@media (max-width: 640px) {
    .cart-item:hover {
        transform: none;
    }
    
    /* Prevent text overflow on mobile */
    .truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<script>
// Initialize AOS
AOS.init({
    duration: 600,
    once: true,
    easing: 'ease-out-cubic'
});

// Cart Management
let cart = [];
let itemToDelete = null;

// Load cart on page load
document.addEventListener('DOMContentLoaded', function() {
    loadCart();
    renderCart();
    updateHeroCartCount();
});

// Load cart from localStorage
function loadCart() {
    const savedCart = localStorage.getItem('pelita_cart');
    if (savedCart) {
        cart = JSON.parse(savedCart);
    }
}

// Save cart to localStorage
function saveCart() {
    localStorage.setItem('pelita_cart', JSON.stringify(cart));
    window.dispatchEvent(new Event('cartUpdated'));
    updateHeroCartCount();
}

// Update hero cart count
function updateHeroCartCount() {
    const count = cart.length;
    document.getElementById('cart-count-hero').textContent = count;
    document.getElementById('cart-count-badge-hero').textContent = count;
    
    // Update status badge
    const statusBadge = document.getElementById('cart-status-badge');
    if (count === 0) {
        statusBadge.textContent = 'Keranjang Kosong';
    } else {
        statusBadge.textContent = 'Siap Checkout';
    }
}

// Render cart items
function renderCart() {
    const container = document.getElementById('cart-items-container');
    const emptyState = document.getElementById('empty-cart-state');
    const checkoutBtn = document.getElementById('checkout-btn');

    if (cart.length === 0) {
        container.innerHTML = '';
        emptyState.classList.remove('hidden');
        checkoutBtn.disabled = true;
        document.getElementById('select-all').checked = false;
        updateSummary();
        return;
    }

    emptyState.classList.add('hidden');
    checkoutBtn.disabled = false;

    container.innerHTML = cart.map((item, index) => `
        <div class="cart-item bg-white/80 backdrop-blur-sm rounded-xl md:rounded-2xl border-2 border-slate-200 hover:border-blue-300 hover:shadow-xl p-3 md:p-6 transition-all">
            <div class="flex gap-2 md:gap-6">
                <!-- Checkbox -->
                <div class="flex items-start pt-1 flex-shrink-0">
                    <input type="checkbox" class="item-checkbox w-4 h-4 md:w-5 md:h-5 text-blue-600 bg-white border-slate-300 rounded focus:ring-blue-500 focus:ring-2 cursor-pointer" 
                           data-index="${index}" onchange="updateSelection()" checked>
                </div>

                <!-- Image -->
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 md:w-28 md:h-28 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl md:rounded-2xl overflow-hidden border-2 border-blue-100 shadow-md group-hover:shadow-lg transition-shadow">
                        ${item.foto ? `
                            <img src="${item.foto}" 
                                 alt="${item.nama_barang}" 
                                 class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                        ` : `
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fa-solid fa-box text-2xl md:text-4xl text-slate-300"></i>
                            </div>
                        `}
                    </div>
                </div>

                <!-- Details -->
                <div class="flex-1 min-w-0">
                    <div class="flex justify-between items-start gap-2 mb-2 md:mb-3">
                        <div class="flex-1 min-w-0">
                            <h3 class="text-sm md:text-lg font-black text-slate-900 mb-1 line-clamp-2">${item.nama_barang}</h3>
                            <p class="text-xs text-slate-500 mb-1 md:mb-2 truncate">
                                <i class="fa-solid fa-barcode mr-1"></i>${item.kode_barang}
                            </p>
                            ${item.kategori ? `
                            <span class="inline-flex items-center gap-1 px-2 md:px-3 py-0.5 md:py-1 text-xs font-bold rounded-full bg-gradient-to-r from-blue-50 to-cyan-50 text-blue-700 border border-blue-200">
                                <i class="fa-solid fa-tag text-xs"></i>
                                <span class="hidden sm:inline">${item.kategori}</span>
                            </span>` : ''}
                        </div>
                        <button onclick="removeItemModal(${index})" class="flex-shrink-0 w-8 h-8 md:w-10 md:h-10 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg md:rounded-xl flex items-center justify-center transition-all hover:scale-110 border-2 border-red-200 hover:border-red-400">
                            <i class="fa-solid fa-trash text-xs md:text-sm"></i>
                        </button>
                    </div>

                    <!-- Bottom Row: Quantity & Price -->
                    <div class="flex flex-col gap-2 md:gap-0 md:flex-row md:items-center md:justify-between mt-3 md:mt-4">
                        <!-- Quantity Controls -->
                        <div class="flex items-center gap-2">
                            <span class="text-xs md:text-sm text-slate-600 font-semibold hidden sm:block">Jumlah:</span>
                            <div class="flex items-center gap-1.5 md:gap-2 bg-slate-50 rounded-lg md:rounded-xl px-2 md:px-3 py-1.5 md:py-2 border-2 border-slate-200">
                                <button onclick="updateQuantity(${index}, -1)" class="w-7 h-7 md:w-8 md:h-8 bg-white rounded-md md:rounded-lg border-2 border-slate-300 flex items-center justify-center hover:bg-blue-50 hover:border-blue-400 transition-colors flex-shrink-0">
                                    <i class="fa-solid fa-minus text-xs text-slate-700"></i>
                                </button>
                                <input type="number" value="${item.quantity}" min="1" max="${item.jumlah_tersedia}"
                                    onchange="updateQuantityDirect(${index}, this.value)"
                                    class="w-10 md:w-14 text-center font-black text-sm md:text-base text-slate-900 bg-transparent border-none focus:outline-none focus:ring-0 qty-input">
                                <button onclick="updateQuantity(${index}, 1)" class="w-7 h-7 md:w-8 md:h-8 bg-white rounded-md md:rounded-lg border-2 border-slate-300 flex items-center justify-center hover:bg-blue-50 hover:border-blue-400 transition-colors flex-shrink-0">
                                    <i class="fa-solid fa-plus text-xs text-slate-700"></i>
                                </button>
                            </div>
                            <span class="text-xs text-slate-500 font-medium bg-slate-100 px-2 md:px-3 py-1 rounded-md md:rounded-lg border border-slate-200 whitespace-nowrap">
                                <i class="fa-solid fa-boxes-stacked mr-1"></i><span class="hidden sm:inline">Stok:</span> ${item.jumlah_tersedia}
                            </span>
                        </div>

                        <!-- Price -->
                        <div class="text-left md:text-right">
                            ${item.harga_sewa > 0 ? `
                            <div class="text-lg md:text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-cyan-600 to-blue-600">
                                Rp${formatNumber(item.harga_sewa * item.quantity)}
                            </div>
                            <div class="text-xs text-slate-500 font-medium mt-0.5 md:mt-1">
                                Rp${formatNumber(item.harga_sewa)} × ${item.quantity} / hari
                            </div>
                            ` : `
                            <div class="inline-flex items-center gap-1.5 md:gap-2 px-3 md:px-4 py-1.5 md:py-2.5 rounded-lg md:rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 shadow-lg">
                                <i class="fa-solid fa-gift text-white text-sm md:text-lg"></i>
                                <span class="text-sm md:text-lg font-black text-white">GRATIS</span>
                            </div>
                            `}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `).join('');

    // Update select all checkbox
    updateSelectAllState();
    updateSummary();
}

// Toggle select all
function toggleSelectAll(checked) {
    document.querySelectorAll('.item-checkbox').forEach(cb => {
        cb.checked = checked;
    });
    updateSummary();
}

// Update select all state based on individual checkboxes
function updateSelectAllState() {
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const selectAll = document.getElementById('select-all');
    const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
    
    selectAll.checked = checkboxes.length > 0 && checkedCount === checkboxes.length;
    selectAll.indeterminate = checkedCount > 0 && checkedCount < checkboxes.length;
}

// Update selection
function updateSelection() {
    updateSelectAllState();
    updateSummary();
}

// Update quantity
function updateQuantity(index, change) {
    const item = cart[index];
    const newQty = item.quantity + change;
    
    if (newQty < 1) {
        showToast('Jumlah minimal 1 unit', 'warning');
        return;
    }
    
    if (newQty > item.jumlah_tersedia) {
        showToast(`Stok tersedia hanya ${item.jumlah_tersedia} unit`, 'warning');
        return;
    }
    
    cart[index].quantity = newQty;
    saveCart();
    renderCart();
}

// Update quantity direct input
function updateQuantityDirect(index, value) {
    const item = cart[index];
    const newQty = parseInt(value);
    
    if (isNaN(newQty) || newQty < 1) {
        cart[index].quantity = 1;
        showToast('Jumlah minimal 1 unit', 'warning');
    } else if (newQty > item.jumlah_tersedia) {
        cart[index].quantity = item.jumlah_tersedia;
        showToast(`Stok tersedia hanya ${item.jumlah_tersedia} unit`, 'warning');
    } else {
        cart[index].quantity = newQty;
    }
    
    saveCart();
    renderCart();
}

// Remove item with modal
function removeItemModal(index) {
    itemToDelete = index;
    const modal = document.getElementById('confirmDeleteModal');
    modal.classList.remove('hidden');
    modal.classList.add('show');
}

function closeDeleteModal() {
    const modal = document.getElementById('confirmDeleteModal');
    modal.classList.add('hidden');
    modal.classList.remove('show');
    itemToDelete = null;
}

function confirmDelete() {
    if (itemToDelete !== null) {
        const itemName = cart[itemToDelete].nama_barang;
        cart.splice(itemToDelete, 1);
        saveCart();
        renderCart();
        showToast(`${itemName} dihapus dari keranjang`, 'success');
        closeDeleteModal();
    }
}

// Delete selected items
function deleteSelected() {
    const checkboxes = document.querySelectorAll('.item-checkbox:checked');
    
    if (checkboxes.length === 0) {
        showToast('Pilih item yang ingin dihapus', 'warning');
        return;
    }
    
    if (confirm(`Hapus ${checkboxes.length} item dari keranjang?`)) {
        const indicesToDelete = Array.from(checkboxes).map(cb => parseInt(cb.dataset.index)).sort((a, b) => b - a);
        indicesToDelete.forEach(index => cart.splice(index, 1));
        
        saveCart();
        renderCart();
        showToast(`${indicesToDelete.length} item berhasil dihapus`, 'success');
    }
}

// Clear entire cart
function clearCart() {
    if (cart.length === 0) {
        showToast('Keranjang sudah kosong', 'info');
        return;
    }
    
    if (confirm('Hapus semua item dari keranjang?')) {
        cart = [];
        saveCart();
        renderCart();
        showToast('Keranjang berhasil dikosongkan', 'success');
    }
}

// Change duration with buttons
function changeDuration(change) {
    const input = document.getElementById('duration-days');
    let newValue = parseInt(input.value) + change;
    
    if (newValue < 1) newValue = 1;
    if (newValue > 3) newValue = 3;
    
    input.value = newValue;
    calculateTotal();
}

// BARU: Setup duration input validation
document.addEventListener('DOMContentLoaded', function() {
    const durationInput = document.getElementById('duration-days');
    
    // Validate saat user ketik manual
    durationInput.addEventListener('input', function(e) {
        let value = parseInt(e.target.value);
        
        // Jika bukan angka atau kosong
        if (isNaN(value) || e.target.value === '') {
            // Jangan reset langsung, biarkan user selesai ketik
            return;
        }
        
        // Jika kurang dari 1
        if (value < 1) {
            e.target.value = 1;
            showToast('Durasi minimal 1 hari', 'warning');
            calculateTotal();
            return;
        }
        
        // Jika lebih dari 3
        if (value > 3) {
            e.target.value = 3;
            showToast('Durasi maksimal 3 hari', 'warning');
            calculateTotal();
            return;
        }
        
        calculateTotal();
    });
    
    // Validate saat user blur (keluar dari input)
    durationInput.addEventListener('blur', function(e) {
        let value = parseInt(e.target.value);
        
        if (isNaN(value) || e.target.value === '' || value < 1) {
            e.target.value = 1;
            showToast('Durasi diset ke 1 hari', 'info');
            calculateTotal();
        } else if (value > 3) {
            e.target.value = 3;
            showToast('Durasi maksimal 3 hari', 'warning');
            calculateTotal();
        }
    });
    
    // Prevent input selain angka
    durationInput.addEventListener('keypress', function(e) {
        // Hanya izinkan angka (0-9)
        if (e.which < 48 || e.which > 57) {
            e.preventDefault();
        }
    });
    
    // Prevent paste non-numeric atau angka diluar range
    durationInput.addEventListener('paste', function(e) {
        e.preventDefault();
        const pastedText = (e.clipboardData || window.clipboardData).getData('text');
        const numericValue = parseInt(pastedText);
        
        if (!isNaN(numericValue)) {
            if (numericValue < 1) {
                this.value = 1;
                showToast('Durasi minimal 1 hari', 'warning');
            } else if (numericValue > 3) {
                this.value = 3;
                showToast('Durasi maksimal 3 hari', 'warning');
            } else {
                this.value = numericValue;
            }
            calculateTotal();
        } else {
            showToast('Hanya bisa input angka', 'warning');
        }
    });
    
    // Prevent menggunakan scroll mouse untuk mengubah nilai
    durationInput.addEventListener('wheel', function(e) {
        e.preventDefault();
    });
});

// Calculate total when duration changes
function calculateTotal() {
    updateSummary();
}

// Update summary
function updateSummary() {
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const selectedItems = Array.from(checkboxes).filter(cb => cb.checked);
    
    const totalItems = cart.length;
    const selectedCount = selectedItems.length;
    
    let totalQty = 0;
    let subtotal = 0;
    
    selectedItems.forEach(cb => {
        const index = parseInt(cb.dataset.index);
        const item = cart[index];
        totalQty += item.quantity;
        subtotal += (item.harga_sewa * item.quantity);
    });
    
    const duration = parseInt(document.getElementById('duration-days').value) || 1;
    const total = subtotal * duration;

    document.getElementById('total-items-count').textContent = totalItems;
    document.getElementById('summary-total-items').textContent = selectedCount;
    document.getElementById('summary-total-qty').textContent = totalQty;
    document.getElementById('summary-subtotal').textContent = `Rp${formatNumber(subtotal)}`;
    document.getElementById('summary-total').textContent = `Rp${formatNumber(total)}`;
    document.getElementById('duration-display').textContent = duration;
    
    // Enable/disable checkout button
    const checkoutBtn = document.getElementById('checkout-btn');
    checkoutBtn.disabled = selectedCount === 0;
}

// Calculate total when duration changes
function calculateTotal() {
    updateSummary();
}

// Proceed to checkout
function proceedToCheckout() {
    const checkboxes = document.querySelectorAll('.item-checkbox:checked');
    
    if (checkboxes.length === 0) {
        showToast('Pilih minimal 1 item untuk melanjutkan', 'warning');
        return;
    }

    // Show loading state
    const btn = document.getElementById('checkout-btn');
    const btnContent = document.getElementById('checkout-btn-content');
    const btnLoading = document.getElementById('checkout-btn-loading');
    
    btn.disabled = true;
    btnContent.classList.add('hidden');
    btnLoading.classList.remove('hidden');
    btnLoading.classList.add('flex');
    
    // Add processing animation to button
    btn.classList.add('cursor-wait');
    btn.classList.remove('hover:scale-[1.02]');

    // Get selected items
    const selectedItems = Array.from(checkboxes).map(cb => {
        const index = parseInt(cb.dataset.index);
        return cart[index];
    });

    // Create query string with selected items
    const itemsParam = selectedItems.map(item => `${item.id}:${item.quantity}`).join(',');
    const duration = document.getElementById('duration-days').value;
    
    // Simulate processing delay for better UX (optional, remove if not needed)
    setTimeout(() => {
        // Redirect to permohonan create with cart data
        window.location.href = `/permohonan/create?cart=${encodeURIComponent(itemsParam)}&duration=${duration}`;
    }, 500);
}

// Format number to IDR
function formatNumber(num) {
    return new Intl.NumberFormat('id-ID').format(num);
}

// Toast notification
function showToast(message, type = 'info') {
    const existingToast = document.querySelector('.toast-notification');
    if (existingToast) existingToast.remove();

    const colors = {
        success: 'from-emerald-500 to-teal-500',
        error: 'from-red-500 to-rose-500',
        info: 'from-blue-500 to-cyan-500',
        warning: 'from-amber-500 to-orange-500'
    };

    const icons = {
        success: 'fa-check-circle',
        error: 'fa-exclamation-circle',
        info: 'fa-info-circle',
        warning: 'fa-exclamation-triangle'
    };

    const toast = document.createElement('div');
    toast.className = 'toast-notification fixed top-20 right-6 z-[10000] animate-slide-in';
    toast.innerHTML = `
        <div class="flex items-center gap-3 px-6 py-4 bg-gradient-to-r ${colors[type]} text-white rounded-2xl shadow-2xl backdrop-blur-lg border-2 border-white/20 min-w-[280px]">
            <i class="fa-solid ${icons[type]} text-xl"></i>
            <span class="font-bold">${message}</span>
        </div>
    `;

    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.animation = 'slide-out 0.3s ease-out forwards';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Keyboard shortcuts
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeDeleteModal();
    }
});

// Add slide in/out animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slide-in {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slide-out {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
    
    .animate-slide-in {
        animation: slide-in 0.3s ease-out;
    }
`;
document.head.appendChild(style);
</script>
@endpush

@endsection