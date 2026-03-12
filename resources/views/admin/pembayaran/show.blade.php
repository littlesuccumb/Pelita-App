@extends('layouts.app')

@section('title', 'Detail Pembayaran - Admin')

@push('styles')
<style>
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from { transform: translateY(8px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
}

@keyframes slideInRight {
    from { transform: translateX(20px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes slideOutRight {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(20px); opacity: 0; }
}

.animate-fade-in { animation: fadeIn 0.4s ease-out !important; }
.animate-slide-up { animation: slideUp 0.3s ease-out !important; }
.animate-pulse-slow { animation: pulse 3s infinite !important; }

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

.action-btn {
    transition: all 0.3s ease;
}

.action-btn:hover {
    transform: scale(1.05);
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

.success { border-left-color: #10b981; }
.error { border-left-color: #ef4444; }

.image-preview {
    max-height: 400px;
    object-fit: contain;
}

@media print {
    .no-print, nav, footer, .print\:hidden {
        display: none !important;
    }
}
</style>
@endpush

@section('content')
<div class="w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 lg:py-4">      
        {{-- Modern Breadcrumb Navigation --}}
        <nav class="mb-8 animate-fade-in" aria-label="Breadcrumb">
            <div class="breadcrumb-modern">
                <a href="{{ route('dashboard') }}" class="breadcrumb-link">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                
                <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs"></i>
                
                <a href="{{ route('admin.pembayaran.index') }}" class="breadcrumb-link">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Kelola Pembayaran</span>
                </a>
                
                <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs"></i>
                
                <span class="breadcrumb-current">
                    <i class="fas fa-receipt"></i>
                    <span title="Detail Pembayaran - {{ $pembayaran->peminjaman->user->name }}">
                        {{ Str::limit($pembayaran->peminjaman->user->name, 35) }}
                    </span>
                </span>
            </div>
        </nav>

        {{-- Modern Header Section with Enhanced Design --}}
        <div class="mb-8 animate-fade-in">
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
                        
                        {{-- Left Section: Title & Info --}}
                        <div class="flex-1">
                            {{-- Icon Badge --}}
                            <div class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-blue-500/10 to-indigo-500/10 dark:from-blue-600/20 dark:to-indigo-600/20 border border-blue-200/50 dark:border-blue-700/50 rounded-full mb-4">
                                <div class="w-2 h-2 bg-blue-500 dark:bg-blue-400 rounded-full animate-pulse"></div>
                                <span class="text-sm font-semibold text-blue-700 dark:text-blue-300">Detail Pembayaran</span>
                            </div>
                            
                            {{-- Main Title --}}
                            <h1 class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-blue-800 to-indigo-800 dark:from-slate-100 dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent leading-tight">
                                Detail Pembayaran
                            </h1>
                            
                            {{-- Description --}}
                            <p class="text-slate-600 dark:text-slate-400 text-lg flex items-center space-x-2 mb-4">
                                <i class="fas fa-info-circle text-blue-500 dark:text-blue-400"></i>
                                <span>ID: #{{ $pembayaran->id }} • Dibuat {{ $pembayaran->created_at->format('d M Y, H:i') }}</span>
                            </p>
                        </div>
                        
                        {{-- Right Section: Status Badge & Actions --}}
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                            <span class="inline-flex items-center px-6 py-3 rounded-xl text-sm font-semibold border shadow-md
                                @if($pembayaran->status === 'pending') bg-gradient-to-r from-amber-50 to-yellow-50 dark:from-amber-900/30 dark:to-yellow-900/30 text-amber-800 dark:text-amber-300 border-amber-200 dark:border-amber-700
                                @elseif($pembayaran->status === 'lunas') bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/30 dark:to-green-900/30 text-emerald-800 dark:text-emerald-300 border-emerald-200 dark:border-emerald-700
                                @elseif($pembayaran->status === 'batal') bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900/30 dark:to-pink-900/30 text-red-800 dark:text-red-300 border-red-200 dark:border-red-700
                                @else bg-gradient-to-r from-gray-50 to-slate-50 dark:from-gray-700 dark:to-slate-700 text-gray-800 dark:text-gray-300 border-gray-200 dark:border-gray-600 @endif">
                                @if($pembayaran->status === 'pending')
                                    <div class="w-2 h-2 bg-amber-400 dark:bg-amber-500 rounded-full mr-2 animate-pulse-slow"></div>
                                    Menunggu Konfirmasi
                                @elseif($pembayaran->status === 'lunas')
                                    <div class="w-2 h-2 bg-emerald-400 dark:bg-emerald-500 rounded-full mr-2"></div>
                                    Pembayaran Lunas
                                @elseif($pembayaran->status === 'batal')
                                    <div class="w-2 h-2 bg-red-400 dark:bg-red-500 rounded-full mr-2"></div>
                                    Pembayaran Batal
                                @endif
                            </span>
                            
                            {{-- Action Buttons --}}
                            @if($pembayaran->status === 'pending')
                            <div class="flex flex-wrap gap-2">
                                @if($pembayaran->metode === 'transfer' && $pembayaran->bukti_transfer)
                                <button type="button" onclick="konfirmasiModal('{{ $pembayaran->id }}', '{{ $pembayaran->peminjaman->user->name }}')"
                                        class="action-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-medium text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                                    <i class="fas fa-check mr-2"></i>
                                    Konfirmasi
                                </button>
                                @elseif($pembayaran->metode === 'cash')
                                <button type="button" onclick="konfirmasiModal('{{ $pembayaran->id }}', '{{ $pembayaran->peminjaman->user->name }}')"
                                        class="action-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-medium text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                                    <i class="fas fa-check mr-2"></i>
                                    Konfirmasi Cash
                                </button>
                                @endif
                                
                                <button type="button" onclick="tolakModal('{{ $pembayaran->id }}', '{{ $pembayaran->peminjaman->user->name }}')"
                                        class="action-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-medium text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                                    <i class="fas fa-times mr-2"></i>
                                    Tolak
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                {{-- Bottom Accent Line --}}
                <div class="h-1.5 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column - Main Info -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Informasi Pembayaran -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.1s">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg mr-3">
                                <i class="fas fa-credit-card text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Pembayaran</h3>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 rounded-xl border border-blue-200 dark:border-blue-700">
                            <div class="text-sm text-blue-600 dark:text-blue-400 mb-1">
                                <i class="fas fa-hashtag mr-1"></i>ID Pembayaran
                            </div>
                            <div class="font-mono font-bold text-blue-800 dark:text-blue-300">#{{ $pembayaran->id }}</div>
                        </div>
                        
                        <div class="p-4 bg-gradient-to-r from-emerald-50 to-emerald-100 dark:from-emerald-900/30 dark:to-emerald-800/30 rounded-xl border border-emerald-200 dark:border-emerald-700">
                            <div class="text-sm text-emerald-600 dark:text-emerald-400 mb-1">
                                <i class="fas fa-money-bill-wave mr-1"></i>Jumlah Pembayaran
                            </div>
                            <div class="font-bold text-emerald-800 dark:text-emerald-300 text-xl">Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</div>
                        </div>
                        
                        <div class="p-4 bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 rounded-xl border border-purple-200 dark:border-purple-700">
                            <div class="text-sm text-purple-600 dark:text-purple-400 mb-1">
                                <i class="fas fa-university mr-1"></i>Metode Pembayaran
                            </div>
                            <div class="font-bold text-purple-800 dark:text-purple-300">
                                {{ $pembayaran->metode == 'cash' ? 'Tunai (Cash)' : 'Transfer Bank' }}
                            </div>
                        </div>
                        
                        <div class="p-4 bg-gradient-to-r from-indigo-50 to-indigo-100 dark:from-indigo-900/30 dark:to-indigo-800/30 rounded-xl border border-indigo-200 dark:border-indigo-700">
                            <div class="text-sm text-indigo-600 dark:text-indigo-400 mb-1">
                                <i class="fas fa-calendar-alt mr-1"></i>Tanggal Pembayaran
                            </div>
                            <div class="font-bold text-indigo-800 dark:text-indigo-300">
                                {{ $pembayaran->tanggal_bayar ? $pembayaran->tanggal_bayar->format('d M Y, H:i') : 'Belum dibayar' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Barang yang Dipinjam -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.2s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg mr-3">
                            <i class="fas fa-cubes text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Barang yang Dipinjam</h3>
                    </div>
                    
                    @php
                        // Ambil barang dari permohonan jika ada
                        $permohonan = $pembayaran->peminjaman->permohonan ?? null;
                        $items = $permohonan ? $permohonan->items : collect();
                    @endphp

                    @if($items->count() > 0)
                        <div class="space-y-4">
                            @foreach($items as $index => $item)
                                <div class="p-4 bg-gradient-to-r from-slate-50 to-white dark:from-slate-700/50 dark:to-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-500 transition-all card-hover">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 flex items-center justify-center text-sm font-bold mr-4">
                                            {{ $index + 1 }}
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-start justify-between mb-2">
                                                <div>
                                                    <h4 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-1">
                                                        {{ $item->barang->nama_barang }}
                                                    </h4>
                                                    @if($item->barang->kategoriBarang)
                                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                                            <i class="fas fa-tag mr-1"></i>
                                                            {{ $item->barang->kategoriBarang->nama_kategori }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
                                                    <i class="fas fa-cubes mr-1.5"></i>
                                                    {{ $item->jumlah }}x
                                                </span>
                                            </div>
                                            
                                            <div class="grid grid-cols-2 gap-3 mt-3">
                                                @if($item->barang->merk)
                                                    <div class="text-xs text-gray-600 dark:text-gray-400">
                                                        <i class="fas fa-trademark text-gray-400 dark:text-gray-500 mr-1"></i>
                                                        <span class="font-medium">Merk:</span> {{ $item->barang->merk }}
                                                    </div>
                                                @endif
                                                
                                                @if($item->barang->type)
                                                    <div class="text-xs text-gray-600 dark:text-gray-400">
                                                        <i class="fas fa-code-branch text-gray-400 dark:text-gray-500 mr-1"></i>
                                                        <span class="font-medium">Tipe:</span> {{ $item->barang->type }}
                                                    </div>
                                                @endif
                                                
                                                <div class="text-xs text-gray-600 dark:text-gray-400">
                                                    <i class="fas fa-box text-gray-400 dark:text-gray-500 mr-1"></i>
                                                    <span class="font-medium">Tersedia:</span> {{ $item->barang->jumlah_tersedia }} unit
                                                </div>
                                                
                                                <div class="text-xs text-gray-600 dark:text-gray-400">
                                                    <i class="fas fa-info-circle text-gray-400 dark:text-gray-500 mr-1"></i>
                                                    <span class="font-medium">Status:</span> {{ ucfirst($item->barang->status) }}
                                                </div>
                                                
                                                @if($item->barang->harga_sewa > 0)
                                                    <div class="text-xs text-gray-600 dark:text-gray-400">
                                                        <i class="fas fa-money-bill-wave text-gray-400 dark:text-gray-500 mr-1"></i>
                                                        <span class="font-medium">Harga/Hari:</span> Rp {{ number_format($item->barang->harga_sewa, 0, ',', '.') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Fallback jika tidak ada items dari permohonan -->
                        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                            <i class="fas fa-box-open text-4xl mb-2"></i>
                            <p>Tidak ada data barang</p>
                        </div>
                    @endif
                </div>

                <!-- Detail Peminjaman -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.3s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg mr-3">
                            <i class="fas fa-calendar-alt text-green-600 dark:text-green-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Detail Peminjaman</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 rounded-xl border border-blue-200 dark:border-blue-700">
                            <div class="text-sm text-blue-600 dark:text-blue-400 mb-1">
                                <i class="fas fa-hashtag mr-1"></i>ID Peminjaman
                            </div>
                            <div class="font-mono font-bold text-blue-800 dark:text-blue-300">#{{ $pembayaran->peminjaman->id }}</div>
                        </div>

                        <div class="p-4 bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 rounded-xl border border-purple-200 dark:border-purple-700">
                            <div class="text-sm text-purple-600 dark:text-purple-400 mb-1">
                                <i class="fas fa-clock mr-1"></i>Durasi
                            </div>
                            <div class="font-bold text-purple-800 dark:text-purple-300">
                                @php
                                    $days = \Carbon\Carbon::parse($pembayaran->peminjaman->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($pembayaran->peminjaman->tanggal_selesai)) + 1;
                                @endphp
                                {{ $days }} hari
                            </div>
                        </div>
                        
                        <div class="p-4 bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 rounded-xl border border-green-200 dark:border-green-700">
                            <div class="text-sm text-green-600 dark:text-green-400 mb-1">
                                <i class="fas fa-calendar-plus mr-1"></i>Tanggal Mulai
                            </div>
                            <div class="font-bold text-green-800 dark:text-green-300">
                                {{ $pembayaran->peminjaman->tanggal_mulai ? \Carbon\Carbon::parse($pembayaran->peminjaman->tanggal_mulai)->format('d M Y') : '-' }}
                            </div>
                        </div>
                        
                        <div class="p-4 bg-gradient-to-r from-red-50 to-red-100 dark:from-red-900/30 dark:to-red-800/30 rounded-xl border border-red-200 dark:border-red-700">
                            <div class="text-sm text-red-600 dark:text-red-400 mb-1">
                                <i class="fas fa-calendar-minus mr-1"></i>Tanggal Selesai
                            </div>
                            <div class="font-bold text-red-800 dark:text-red-300">
                                {{ $pembayaran->peminjaman->tanggal_selesai ? \Carbon\Carbon::parse($pembayaran->peminjaman->tanggal_selesai)->format('d M Y') : '-' }}
                            </div>
                        </div>
                        
                        <div class="p-4 bg-gradient-to-r from-amber-50 to-amber-100 dark:from-amber-900/30 dark:to-amber-800/30 rounded-xl border border-amber-200 dark:border-amber-700 md:col-span-2">
                            <div class="text-sm text-amber-600 dark:text-amber-400 mb-1">
                                <i class="fas fa-info-circle mr-1"></i>Status Peminjaman
                            </div>
                            <div class="font-bold text-amber-800 dark:text-amber-300">
                                @if($pembayaran->peminjaman->status == 'menunggu')
                                    <span class="inline-flex items-center text-amber-700 dark:text-amber-400">
                                        <i class="fas fa-clock mr-1"></i>Menunggu
                                    </span>
                                @elseif($pembayaran->peminjaman->status == 'disetujui')
                                    <span class="inline-flex items-center text-emerald-700 dark:text-emerald-400">
                                        <i class="fas fa-check mr-1"></i>Disetujui
                                    </span>
                                @elseif($pembayaran->peminjaman->status == 'ditolak')
                                    <span class="inline-flex items-center text-red-700 dark:text-red-400">
                                        <i class="fas fa-times mr-1"></i>Ditolak
                                    </span>
                                @elseif($pembayaran->peminjaman->status == 'selesai')
                                    <span class="inline-flex items-center text-slate-700 dark:text-slate-400">
                                        <i class="fas fa-check-circle mr-1"></i>Selesai
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($pembayaran->peminjaman->keperluan)
                        <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                            <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                <i class="fas fa-info-circle mr-1"></i>Keperluan
                            </div>
                            <div class="text-gray-800 dark:text-gray-200 whitespace-pre-line">{{ $pembayaran->peminjaman->keperluan }}</div>
                        </div>
                    @endif
                </div>

                <!-- Bukti Transfer -->
                @if($pembayaran->metode === 'transfer')
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.3s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg mr-3">
                            <i class="fas fa-receipt text-green-600 dark:text-green-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Bukti Transfer</h3>
                    </div>

                    @if($pembayaran->bukti_transfer)
                    <div class="space-y-4">
                        <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                            <div class="flex items-center mb-3">
                                <i class="fas fa-check-circle text-green-600 dark:text-green-400 mr-2"></i>
                                <span class="font-medium text-green-800 dark:text-green-300">Bukti transfer telah diupload</span>
                            </div>
                            
                            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                                @php
                                    $extension = pathinfo($pembayaran->bukti_transfer, PATHINFO_EXTENSION);
                                    $isPdf = strtolower($extension) === 'pdf';
                                @endphp
                                
                                @if($isPdf)
                                <div class="text-center py-8">
                                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-xl mb-4">
                                        <i class="fas fa-file-pdf text-red-600 dark:text-red-400 text-2xl"></i>
                                    </div>
                                    <div class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Dokumen PDF</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ basename($pembayaran->bukti_transfer) }}</div>
                                    <a href="{{ asset('storage/' . $pembayaran->bukti_transfer) }}" 
                                       target="_blank" 
                                       class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all">
                                        <i class="fas fa-eye mr-2"></i>
                                        Lihat PDF
                                    </a>
                                </div>
                                @else
                                <div class="text-center">
                                    <img src="{{ asset('storage/' . $pembayaran->bukti_transfer) }}" 
                                         alt="Bukti Transfer" 
                                         class="image-preview mx-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-4">
                                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-3">{{ basename($pembayaran->bukti_transfer) }}</div>
                                    <a href="{{ asset('storage/' . $pembayaran->bukti_transfer) }}" 
                                       target="_blank" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all">
                                        <i class="fas fa-external-link-alt mr-2"></i>
                                        Lihat Full Size
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 border-l-4 border-yellow-400 dark:border-yellow-600 rounded-lg">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-400 mt-0.5 mr-3"></i>
                            <div class="text-sm text-yellow-800 dark:text-yellow-300">
                                <span class="font-medium">Bukti transfer belum diupload</span> - Menunggu customer mengupload bukti pembayaran transfer
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </div>

            <!-- Right Column - Status & Actions -->
            <div class="space-y-6">
                
                <!-- Informasi Peminjam -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.4s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                            <i class="fas fa-user text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Peminjam</h3>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center">
                            @if($pembayaran->peminjaman->user->avatar)
                                <div class="h-16 w-16 rounded-full overflow-hidden shadow-lg mr-4 ring-2 ring-blue-500 dark:ring-blue-400">
                                    <img src="{{ asset('storage/' . $pembayaran->peminjaman->user->avatar) }}" 
                                        alt="{{ $pembayaran->peminjaman->user->name }}"
                                        class="w-full h-full object-cover"
                                        onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'h-16 w-16 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg\'><span class=\'text-white font-bold text-xl\'>{{ strtoupper(substr($pembayaran->peminjaman->user->name, 0, 2)) }}</span></div>';">
                                </div>
                            @else
                                <div class="h-16 w-16 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg mr-4">
                                    <span class="text-white font-bold text-xl">{{ strtoupper(substr($pembayaran->peminjaman->user->name, 0, 2)) }}</span>
                                </div>
                            @endif
                            <div>
                                <div class="font-semibold text-gray-900 dark:text-gray-100">{{ $pembayaran->peminjaman->user->name }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $pembayaran->peminjaman->user->email }}</div>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Role:</span>
                                    <span class="text-sm text-gray-900 dark:text-gray-100 capitalize">{{ $pembayaran->peminjaman->user->role }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Terdaftar:</span>
                                    <span class="text-sm text-gray-900 dark:text-gray-100">{{ $pembayaran->peminjaman->user->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Timeline -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.5s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                            <i class="fas fa-history text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Timeline Status</h3>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- Created -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center shadow-md mr-3">
                                <i class="fas fa-plus text-white text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Pembayaran Dibuat</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $pembayaran->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                        
                        @if($pembayaran->status === 'lunas')
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center shadow-md mr-3">
                                <i class="fas fa-check text-white text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Pembayaran Lunas</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $pembayaran->updated_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                        @endif
                        
                        @if($pembayaran->status === 'batal')
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center shadow-md mr-3">
                                <i class="fas fa-times text-white text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Pembayaran Dibatalkan</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $pembayaran->updated_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                        @endif
                        
                        @if($pembayaran->status === 'pending')
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center shadow-md mr-3 animate-pulse">
                                <i class="fas fa-clock text-white text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Menunggu Konfirmasi</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Status saat ini</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                @if($pembayaran->status === 'pending')
                <div class="bg-gradient-to-br from-slate-50 to-gray-100 dark:from-slate-800 dark:to-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600 card-hover animate-slide-up" style="animation-delay: 0.6s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                            <i class="fas fa-bolt text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Aksi Cepat</h3>
                    </div>
                    
                    <div class="space-y-3">
                        @if($pembayaran->metode === 'transfer' && $pembayaran->bukti_transfer)
                        <button type="button" onclick="konfirmasiModal('{{ $pembayaran->id }}', '{{ $pembayaran->peminjaman->user->name }}')"
                                class="action-btn w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-medium text-sm rounded-xl hover:from-emerald-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl group">
                            <i class="fas fa-check mr-2 group-hover:scale-110 transition-transform"></i>
                            Konfirmasi Pembayaran
                        </button>
                        @elseif($pembayaran->metode === 'cash')
                        <button type="button" onclick="konfirmasiModal('{{ $pembayaran->id }}', '{{ $pembayaran->peminjaman->user->name }}')"
                                class="action-btn w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-medium text-sm rounded-xl hover:from-emerald-600 hover:to-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl group">
                            <i class="fas fa-check mr-2 group-hover:scale-110 transition-transform"></i>
                            Konfirmasi Pembayaran Cash
                        </button>
                        @else
                        <div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-700">
                            <div class="flex items-center text-yellow-800 dark:text-yellow-300">
                                <i class="fas fa-info-circle mr-2"></i>
                                <span class="text-sm">Menunggu upload bukti transfer</span>
                            </div>
                        </div>
                        @endif

                        <button type="button" onclick="tolakModal('{{ $pembayaran->id }}', '{{ $pembayaran->peminjaman->user->name }}')"
                                class="action-btn w-full flex items-center justify-center px-4 py-3 bg-white dark:bg-gray-800 text-red-600 dark:text-red-400 font-medium text-sm border-2 border-red-200 dark:border-red-700 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/30 hover:border-red-300 dark:hover:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 group">
                            <i class="fas fa-times mr-2 group-hover:scale-110 transition-transform"></i>
                            Tolak Pembayaran
                        </button>
                    </div>
                </div>
                @endif

                <!-- Ringkasan -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.7s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg mr-3">
                            <i class="fas fa-info-circle text-gray-600 dark:text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Ringkasan</h3>
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-green-50 dark:bg-green-900/30 rounded-lg">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Total Pembayaran</span>
                            <span class="text-lg font-bold text-green-600 dark:text-green-400">Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Metode</span>
                            <span class="text-sm font-semibold text-blue-800 dark:text-blue-300">{{ $pembayaran->metode == 'cash' ? 'Tunai' : 'Transfer' }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center p-3 bg-purple-50 dark:bg-purple-900/30 rounded-lg">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Status</span>
                            <span class="text-sm font-semibold {{ $pembayaran->status == 'pending' ? 'text-amber-600 dark:text-amber-400' : ($pembayaran->status == 'lunas' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400') }}">
                                {{ ucfirst($pembayaran->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- System Info -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.8s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg mr-3">
                            <i class="fas fa-database text-gray-600 dark:text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Sistem</h3>
                    </div>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">ID Pembayaran:</span>
                            <span class="font-mono text-slate-600 dark:text-slate-300 font-semibold">#{{ $pembayaran->id }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">ID Peminjaman:</span>
                            <span class="font-mono text-slate-600 dark:text-slate-300 font-semibold">#{{ $pembayaran->peminjaman->id }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">Status:</span>
                            <span class="font-mono text-slate-600 dark:text-slate-300 font-semibold">{{ $pembayaran->status }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">Dibuat:</span>
                            <span class="text-slate-600 dark:text-slate-300">{{ $pembayaran->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-500 dark:text-gray-400">Terakhir Update:</span>
                            <span class="text-slate-600 dark:text-slate-300">{{ $pembayaran->updated_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Konfirmasi Modal -->
    <div id="konfirmasi-modal" class="fixed inset-0 modal-backdrop overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border-0 w-11/12 max-w-md shadow-2xl rounded-xl bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-lg mr-3">
                            <i class="fas fa-check-circle text-green-600 dark:text-green-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Konfirmasi Pembayaran</h3>
                    </div>
                    <button onclick="closeModal('konfirmasi-modal')" class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="konfirmasi-form" method="POST" action="">
                    @csrf
                    @method('POST')
                    <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                        <p class="text-sm text-green-800 dark:text-green-300 mb-1 font-medium">Pembayaran yang akan dikonfirmasi:</p>
                        <p id="konfirmasi-user-name" class="font-semibold text-green-900 dark:text-green-200"></p>
                        <p class="text-sm text-green-700 dark:text-green-400 mt-1">Jumlah: Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</p>
                        <p class="text-xs text-green-600 dark:text-green-400 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Status pembayaran akan diubah menjadi lunas
                        </p>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeModal('konfirmasi-modal')" 
                                class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-medium transition-all">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-white bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 rounded-lg font-medium transition-all shadow-md hover:shadow-lg">
                            Konfirmasi Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tolak Modal -->
    <div id="tolak-modal" class="fixed inset-0 modal-backdrop overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border-0 w-11/12 max-w-md shadow-2xl rounded-xl bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-lg mr-3">
                            <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Tolak Pembayaran</h3>
                    </div>
                    <button onclick="closeModal('tolak-modal')" class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="tolak-form" method="POST" action="">
                    @csrf
                    @method('POST')
                    <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800">
                        <p class="text-sm text-red-800 dark:text-red-300 mb-1 font-medium">Pembayaran yang akan ditolak:</p>
                        <p id="tolak-user-name" class="font-semibold text-red-900 dark:text-red-200"></p>
                        <p class="text-sm text-red-700 dark:text-red-400 mt-1">Jumlah: Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</p>
                    </div>
                    
                    <div class="mb-6">
                        <label for="alasan_penolakan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Alasan Penolakan <span class="text-red-500">*</span>
                        </label>
                            <textarea name="alasan_penolakan" 
                                  id="alasan_penolakan" 
                                  rows="4" 
                                  required
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all"
                                  placeholder="Jelaskan alasan penolakan permohonan..."></textarea>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Alasan akan dikirimkan ke pemohon
                        </p>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeModal('tolak-modal')" 
                                class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-medium transition-all">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 rounded-lg font-medium transition-all shadow-md hover:shadow-lg">
                            Tolak Permohonan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Notifications -->
    @if(session('success'))
    <div id="notification" class="fixed top-4 right-4 z-50">
        <div class="notification success bg-white/90 dark:bg-gray-800/90 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 p-4 max-w-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 dark:text-green-400"></i>
                    </div>
                </div>
                <div class="ml-3">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Berhasil!</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ session('success') }}</p>
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
        <div class="notification error bg-white/90 dark:bg-gray-800/90 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 p-4 max-w-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-lg">
                        <i class="fas fa-exclamation-circle text-red-600 dark:text-red-400"></i>
                    </div>
                </div>
                <div class="ml-3">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Error!</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ session('error') }}</p>
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
function konfirmasiModal(id, userName) {
    document.getElementById('konfirmasi-user-name').textContent = userName;
    document.getElementById('konfirmasi-form').action = `/admin/pembayaran/${id}/konfirmasi`;
    document.getElementById('konfirmasi-modal').classList.remove('hidden');
}

function tolakModal(id, userName) {
    document.getElementById('tolak-user-name').textContent = userName;
    document.getElementById('tolak-form').action = `/admin/pembayaran/${id}/tolak`;
    document.getElementById('tolak-modal').classList.remove('hidden');
    
    setTimeout(() => {
        document.getElementById('alasan_penolakan').focus();
    }, 100);
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    if (modalId === 'tolak-modal') {
        document.getElementById('alasan_penolakan').value = '';
    }
}

function hideNotification() {
    const notification = document.getElementById('notification');
    if (notification) {
        notification.style.animation = 'slideOutRight 0.5s ease-in forwards';
        setTimeout(() => notification.remove(), 500);
    }
}

document.addEventListener('click', function(event) {
    const konfirmasiModal = document.getElementById('konfirmasi-modal');
    const tolakModal = document.getElementById('tolak-modal');
    
    if (event.target === konfirmasiModal) closeModal('konfirmasi-modal');
    if (event.target === tolakModal) closeModal('tolak-modal');
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal('konfirmasi-modal');
        closeModal('tolak-modal');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const tolakForm = document.querySelector('#tolak-modal form');
    if (tolakForm) {
        tolakForm.addEventListener('submit', function(e) {
            const alasan = document.getElementById('alasan_penolakan').value.trim();
            
            if (alasan.length < 10) {
                e.preventDefault();
                alert('Alasan penolakan minimal 10 karakter');
                return false;
            }
            
            const confirmed = confirm('Apakah Anda yakin ingin menolak pembayaran ini?');
            if (!confirmed) {
                e.preventDefault();
                return false;
            }
        });
    }
});

let isSubmitting = false;
document.addEventListener('submit', function(e) {
    if (isSubmitting) {
        e.preventDefault();
        alert('⚠️ Form sedang diproses. Mohon tunggu...');
        return false;
    }
    isSubmitting = true;
    
    const submitBtn = e.target.querySelector('button[type="submit"]');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
    }
    
    setTimeout(() => {
        isSubmitting = false;
    }, 10000);
});

@if(session('success') || session('error'))
setTimeout(() => hideNotification(), 5000);
@endif

console.log('Admin Pembayaran Show - JavaScript loaded successfully');
</script>
@endpush
