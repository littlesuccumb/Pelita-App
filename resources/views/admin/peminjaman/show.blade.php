@extends('layouts.app')

@section('title', 'Detail Peminjaman - Admin')

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
    from {
        transform: translateX(20px);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOutRight {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(20px);
        opacity: 0;
    }
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

.custom-scrollbar::-webkit-scrollbar {
    width: 5px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #f3f4f6;
    border-radius: 10px;
}

.dark .custom-scrollbar::-webkit-scrollbar-track {
    background: #374151;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
    border-radius: 10px;
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
                
                <a href="{{ route('admin.peminjaman.index') }}" class="breadcrumb-link">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Kelola Peminjaman</span>
                </a>
                
                <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs"></i>
                
                <span class="breadcrumb-current">
                    <i class="fas fa-file-invoice"></i>
                    <span title="Detail Peminjaman {{ $peminjaman->user->name }}">
                        {{ Str::limit($peminjaman->user->name, 35) }}
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
                                <span class="text-sm font-semibold text-blue-700 dark:text-blue-300">Detail Transaction</span>
                            </div>
                            
                            {{-- Main Title --}}
                            <h1 class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-blue-800 to-indigo-800 dark:from-slate-100 dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent leading-tight">
                                Detail Peminjaman
                            </h1>
                            
                            {{-- Description --}}
                            <p class="text-slate-600 dark:text-slate-400 text-lg flex items-center space-x-2 mb-4">
                                <i class="fas fa-info-circle text-blue-500 dark:text-blue-400"></i>
                                <span>ID: #{{ $peminjaman->id }} • Dibuat {{ $peminjaman->created_at->format('d M Y, H:i') }}</span>
                            </p>
                        </div>
                        
                        {{-- Right Section: Status Badge & Actions --}}
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                            <span class="inline-flex items-center px-6 py-3 rounded-xl text-sm font-semibold border shadow-md
                                @if($peminjaman->status === 'menunggu') bg-gradient-to-r from-amber-50 to-yellow-50 dark:from-amber-900/30 dark:to-yellow-900/30 text-amber-800 dark:text-amber-300 border-amber-200 dark:border-amber-700
                                @elseif($peminjaman->status === 'disetujui') bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/30 dark:to-green-900/30 text-emerald-800 dark:text-emerald-300 border-emerald-200 dark:border-emerald-700
                                @elseif($peminjaman->status === 'ditolak') bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900/30 dark:to-pink-900/30 text-red-800 dark:text-red-300 border-red-200 dark:border-red-700
                                @elseif($peminjaman->status === 'selesai') bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/30 dark:to-indigo-900/30 text-blue-800 dark:text-blue-300 border-blue-200 dark:border-blue-700
                                @else bg-gradient-to-r from-gray-50 to-slate-50 dark:from-gray-700 dark:to-slate-700 text-gray-800 dark:text-gray-300 border-gray-200 dark:border-gray-600 @endif">
                                @if($peminjaman->status === 'menunggu')
                                    <div class="w-2 h-2 bg-amber-400 dark:bg-amber-500 rounded-full mr-2 animate-pulse-slow"></div>
                                @elseif($peminjaman->status === 'disetujui')
                                    <div class="w-2 h-2 bg-emerald-400 dark:bg-emerald-500 rounded-full mr-2"></div>
                                @elseif($peminjaman->status === 'ditolak')
                                    <div class="w-2 h-2 bg-red-400 dark:bg-red-500 rounded-full mr-2"></div>
                                @elseif($peminjaman->status === 'selesai')
                                    <div class="w-2 h-2 bg-blue-400 dark:bg-blue-500 rounded-full mr-2"></div>
                                @endif
                                {{ ucfirst($peminjaman->status) }}
                            </span>
                            
                            {{-- Action Buttons --}}
                            <div class="flex flex-wrap gap-2">
                                @if($peminjaman->status === 'menunggu')
                                    <a href="{{ route('admin.peminjaman.edit', $peminjaman->id) }}"
                                       class="action-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                                        <i class="fas fa-edit mr-2"></i>
                                        Edit
                                    </a>
                                    
                                    <button type="button" onclick="approveModal()"
                                            class="action-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-medium text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                                        <i class="fas fa-check mr-2"></i>
                                        Setujui
                                    </button>
                                    
                                    <button type="button" onclick="rejectModal()"
                                            class="action-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-medium text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                                        <i class="fas fa-times mr-2"></i>
                                        Tolak
                                    </button>
                                @elseif($peminjaman->status === 'disetujui')
                                    @if($peminjaman->berita_acara)
                                        <a href="{{ route('admin.peminjaman.berita-acara.download', $peminjaman->id) }}"
                                           class="action-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl"
                                           target="_blank">
                                            <i class="fas fa-file-download mr-2"></i>
                                            Download BA
                                        </a>
                                    @endif
                                    
                                    <button type="button" onclick="selesaiModal()"
                                            class="action-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white font-medium text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                                        <i class="fas fa-check-double mr-2"></i>
                                        Selesaikan
                                    </button>
                                @endif
                            </div>
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
                
                <!-- Borrower Info -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.1s">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg mr-3">
                                <i class="fas fa-user text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Peminjam</h3>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center">
                            @if($peminjaman->user->avatar)
                                <div class="h-16 w-16 rounded-full overflow-hidden shadow-lg mr-4 ring-2 ring-blue-500 dark:ring-blue-400">
                                    <img src="{{ asset('storage/' . $peminjaman->user->avatar) }}" 
                                        alt="{{ $peminjaman->user->name }}"
                                        class="w-full h-full object-cover"
                                        onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'h-16 w-16 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg\'><span class=\'text-white font-bold text-xl\'>{{ strtoupper(substr($peminjaman->user->name, 0, 2)) }}</span></div>';">
                                </div>
                            @else
                                <div class="h-16 w-16 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg mr-4">
                                    <span class="text-white font-bold text-xl">{{ strtoupper(substr($peminjaman->user->name, 0, 2)) }}</span>
                                </div>
                            @endif
                            <div>
                                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $peminjaman->user->name }}</h2>
                                <p class="text-gray-600 dark:text-gray-400">{{ $peminjaman->user->email }}</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            @if($peminjaman->user->nama_instansi)
                                <div class="p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Instansi</div>
                                    <div class="font-semibold text-slate-800 dark:text-slate-200">{{ $peminjaman->user->nama_instansi }}</div>
                                </div>
                            @endif
                            
                            @if($peminjaman->user->jabatan)
                                <div class="p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Jabatan</div>
                                    <div class="font-semibold text-gray-800 dark:text-gray-200">{{ $peminjaman->user->jabatan }}</div>
                                </div>
                            @endif
                            
                            @if($peminjaman->user->no_telepon)
                                <div class="p-3 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Telepon</div>
                                    <div class="font-semibold text-indigo-800 dark:text-indigo-300">{{ $peminjaman->user->no_telepon }}</div>
                                </div>
                            @endif
                            
                            @if($peminjaman->user->alamat)
                                <div class="p-3 bg-purple-50 dark:bg-purple-900/30 rounded-lg col-span-2">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Alamat</div>
                                    <div class="font-semibold text-purple-800 dark:text-purple-300">{{ $peminjaman->user->alamat }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Barang List -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.2s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg mr-3">
                            <i class="fas fa-cubes text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Barang yang Dipinjam</h3>
                    </div>
                    
                    @if($peminjaman->peminjamanDetail->count() > 0)
                        <div class="space-y-4">
                            @foreach($peminjaman->peminjamanDetail as $index => $detail)
                                <div class="p-4 bg-gradient-to-r from-slate-50 to-white dark:from-slate-700/50 dark:to-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-500 transition-all card-hover">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 flex items-center justify-center text-sm font-bold mr-4">
                                            {{ $index + 1 }}
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-start justify-between mb-2">
                                                <div>
                                                    <h4 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-1">
                                                        {{ $detail->barang->nama_barang }}
                                                    </h4>
                                                    @if($detail->barang->kategori)
                                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                                            <i class="fas fa-tag mr-1"></i>
                                                            {{ $detail->barang->kategori->nama_kategori }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
                                                    <i class="fas fa-cubes mr-1.5"></i>
                                                    {{ $detail->jumlah }}x
                                                </span>
                                            </div>
                                            
                                            <div class="grid grid-cols-2 gap-3 mt-3">
                                                @if($detail->barang->merk)
                                                    <div class="text-xs text-gray-600 dark:text-gray-400">
                                                        <i class="fas fa-trademark text-gray-400 dark:text-gray-500 mr-1"></i>
                                                        <span class="font-medium">Merk:</span> {{ $detail->barang->merk }}
                                                    </div>
                                                @endif
                                                
                                                @if($detail->barang->type)
                                                    <div class="text-xs text-gray-600 dark:text-gray-400">
                                                        <i class="fas fa-code-branch text-gray-400 dark:text-gray-500 mr-1"></i>
                                                        <span class="font-medium">Tipe:</span> {{ $detail->barang->type }}
                                                    </div>
                                                @endif
                                                
                                                <div class="text-xs text-gray-600 dark:text-gray-400">
                                                    <i class="fas fa-info-circle text-gray-400 dark:text-gray-500 mr-1"></i>
                                                    <span class="font-medium">Kondisi:</span> {{ ucfirst($detail->barang->kondisi) }}
                                                </div>
                                                
                                                <div class="text-xs text-gray-600 dark:text-gray-400">
                                                    <i class="fas fa-barcode text-gray-400 dark:text-gray-500 mr-1"></i>
                                                    <span class="font-medium">Kode:</span> {{ $detail->barang->kode_barang }}
                                                </div>
                                            </div>
                                            
                                            @if($detail->harga_satuan > 0)
                                                <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-700">
                                                    <div class="flex justify-between text-sm">
                                                        <span class="text-gray-600 dark:text-gray-400">Harga Sewa/Hari:</span>
                                                        <span class="font-semibold text-gray-900 dark:text-gray-100">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</span>
                                                    </div>
                                                    <div class="flex justify-between text-sm mt-1">
                                                        <span class="text-gray-600 dark:text-gray-400">Subtotal:</span>
                                                        <span class="font-bold text-blue-600 dark:text-blue-400">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                            <i class="fas fa-box-open text-4xl mb-2"></i>
                            <p>Tidak ada barang yang dipinjam</p>
                        </div>
                    @endif
                </div>

                <!-- Loan Details -->
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
                                <i class="fas fa-calendar-day mr-1"></i>Tanggal Mulai
                            </div>
                            <div class="font-bold text-blue-800 dark:text-blue-300">
                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->format('d M Y') }}
                            </div>
                        </div>
                        
                        <div class="p-4 bg-gradient-to-r from-red-50 to-red-100 dark:from-red-900/30 dark:to-red-800/30 rounded-xl border border-red-200 dark:border-red-700">
                            <div class="text-sm text-red-600 dark:text-red-400 mb-1">
                                <i class="fas fa-calendar-check mr-1"></i>Tanggal Selesai
                            </div>
                            <div class="font-bold text-red-800 dark:text-red-300">
                                {{ \Carbon\Carbon::parse($peminjaman->tanggal_selesai)->format('d M Y') }}
                            </div>
                        </div>
                        
                        <div class="p-4 bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 rounded-xl border border-purple-200 dark:border-purple-700">
                            <div class="text-sm text-purple-600 dark:text-purple-400 mb-1">Durasi</div>
                            <div class="font-bold text-purple-800 dark:text-purple-300">
                                @php
                                    $days = \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($peminjaman->tanggal_selesai)) + 1;
                                @endphp
                                {{ $days }} hari
                            </div>
                        </div>
                        
                        <div class="p-4 bg-gradient-to-r from-emerald-50 to-emerald-100 dark:from-emerald-900/30 dark:to-emerald-800/30 rounded-xl border border-emerald-200 dark:border-emerald-700">
                            <div class="text-sm text-emerald-600 dark:text-emerald-400 mb-1">Total Biaya</div>
                            <div class="font-bold text-emerald-800 dark:text-emerald-300">
                                Rp {{ number_format($peminjaman->biaya, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                    
                    @if($peminjaman->keperluan)
                        <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                            <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                <i class="fas fa-info-circle mr-1"></i>Keperluan
                            </div>
                            <div class="text-gray-800 dark:text-gray-200 whitespace-pre-line">{{ $peminjaman->keperluan }}</div>
                        </div>
                    @endif
                </div>

                <!-- Payment Info -->
                @if($peminjaman->pembayaran)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.4s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg mr-3">
                            <i class="fas fa-money-bill-wave text-yellow-600 dark:text-yellow-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Pembayaran</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="p-4 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl border border-emerald-200 dark:border-emerald-700">
                            <div class="text-sm text-emerald-600 dark:text-emerald-400 mb-1">Jumlah</div>
                            <div class="font-bold text-emerald-800 dark:text-emerald-300">
                                Rp {{ number_format($peminjaman->pembayaran->jumlah, 0, ',', '.') }}
                            </div>
                        </div>
                        
                        <div class="p-4 bg-blue-50 dark:bg-blue-900/30 rounded-xl border border-blue-200 dark:border-blue-700">
                            <div class="text-sm text-blue-600 dark:text-blue-400 mb-1">Metode</div>
                            <div class="font-bold text-blue-800 dark:text-blue-300">
                                {{ $peminjaman->pembayaran->metode ? ucfirst($peminjaman->pembayaran->metode) : 'Belum dipilih' }}
                            </div>
                        </div>
                        
                        <div class="p-4 rounded-xl border
                            @if($peminjaman->pembayaran->status === 'lunas') bg-green-50 dark:bg-green-900/30 border-green-200 dark:border-green-700
                            @elseif($peminjaman->pembayaran->status === 'pending') bg-yellow-50 dark:bg-yellow-900/30 border-yellow-200 dark:border-yellow-700
                            @else bg-gray-50 dark:bg-gray-700 border-gray-200 dark:border-gray-600 @endif">
                            <div class="text-sm mb-1
                                @if($peminjaman->pembayaran->status === 'lunas') text-green-600 dark:text-green-400
                                @elseif($peminjaman->pembayaran->status === 'pending') text-yellow-600 dark:text-yellow-400
                                @else text-gray-600 dark:text-gray-400 @endif">
                                Status
                            </div>
                            <div class="font-bold
                                @if($peminjaman->pembayaran->status === 'lunas') text-green-800 dark:text-green-300
                                @elseif($peminjaman->pembayaran->status === 'pending') text-yellow-800 dark:text-yellow-300
                                @else text-gray-800 dark:text-gray-300 @endif">
                                {{ ucfirst($peminjaman->pembayaran->status) }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Berita Acara Section (For Approved) -->
                @if($peminjaman->status === 'disetujui' && $peminjaman->berita_acara)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.5s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                            <i class="fas fa-file-contract text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Berita Acara Peminjaman</h3>
                    </div>
                    
                    <div class="p-6 bg-gradient-to-br from-indigo-50 to-blue-50 dark:from-indigo-900/30 dark:to-blue-900/30 rounded-xl border-2 border-indigo-200 dark:border-indigo-700">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                <div class="p-3 bg-white dark:bg-gray-800 rounded-lg shadow-md mr-4">
                                    <i class="fas fa-file-alt text-indigo-600 dark:text-indigo-400 text-2xl"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 dark:text-gray-100">Berita Acara Tersedia</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">Dokumen resmi peminjaman barang</div>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                <i class="fas fa-check-circle mr-1"></i>
                                Tersedia
                            </span>
                        </div>
                        
                        <div class="flex flex-wrap gap-3">                         
                            <a href="{{ route('admin.peminjaman.berita-acara.download', $peminjaman->id) }}"
                               download
                               class="action-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-medium text-sm rounded-lg transition-all shadow-md hover:shadow-lg">
                                <i class="fas fa-print mr-2"></i>
                                Download BA
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column - Status & History -->
            <div class="space-y-6">
                
                <!-- Status Timeline -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.6s">
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
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Peminjaman Dibuat</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $peminjaman->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                        
                        @if($peminjaman->status === 'disetujui' || $peminjaman->status === 'selesai')
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center shadow-md mr-3">
                                <i class="fas fa-check text-white text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Disetujui</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $peminjaman->updated_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                        @endif
                        
                        @if($peminjaman->status === 'ditolak')
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center shadow-md mr-3">
                                <i class="fas fa-times text-white text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Ditolak</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $peminjaman->updated_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                        @endif
                        
                        @if($peminjaman->status === 'selesai')
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-indigo-500 rounded-full flex items-center justify-center shadow-md mr-3">
                                <i class="fas fa-flag-checkered text-white text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Selesai</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $peminjaman->updated_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                        @endif
                        
                        @if($peminjaman->status === 'menunggu')
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center shadow-md mr-3 animate-pulse">
                                <i class="fas fa-clock text-white text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Menunggu Persetujuan</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Status saat ini</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-gradient-to-br from-slate-50 to-gray-100 dark:from-slate-800 dark:to-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600 card-hover animate-slide-up" style="animation-delay: 0.7s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                            <i class="fas fa-bolt text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Aksi Cepat</h3>
                    </div>
                    
                    <div class="space-y-3">
                        @if($peminjaman->status === 'menunggu')
                            <button type="button" onclick="approveModal()"
                                    class="action-btn w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-medium text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl group">
                                <i class="fas fa-check mr-2 group-hover:scale-110 transition-transform"></i>
                                Setujui Peminjaman
                            </button>
                            
                            <button type="button" onclick="rejectModal()"
                                    class="action-btn w-full flex items-center justify-center px-4 py-3 bg-white dark:bg-gray-800 text-red-600 dark:text-red-400 font-medium text-sm border-2 border-red-200 dark:border-red-700 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/30 hover:border-red-300 dark:hover:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 group">
                                <i class="fas fa-times mr-2 group-hover:scale-110 transition-transform"></i>
                                Tolak Peminjaman
                            </button>
                            
                            <a href="{{ route('admin.peminjaman.edit', $peminjaman->id) }}"
                               class="action-btn w-full flex items-center justify-center px-4 py-3 bg-white dark:bg-gray-800 text-blue-600 dark:text-blue-400 font-medium text-sm border border-blue-300 dark:border-blue-700 rounded-xl hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-all duration-200 group">
                                <i class="fas fa-edit mr-2 group-hover:scale-110 transition-transform"></i>
                                Edit Peminjaman
                            </a>
                        @elseif($peminjaman->status === 'disetujui')
                            @if($peminjaman->berita_acara)                              
                                <a href="{{ route('admin.peminjaman.berita-acara.download', $peminjaman->id) }}"
                                   download
                                   class="action-btn w-full flex items-center justify-center px-4 py-3 bg-white dark:bg-gray-800 text-blue-600 dark:text-blue-400 font-medium text-sm border-2 border-blue-200 dark:border-blue-700 rounded-xl hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:border-blue-300 dark:hover:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 group">
                                    <i class="fas fa-download mr-2 group-hover:scale-110 transition-transform"></i>
                                    Download BA
                                </a>
                            @endif
                            
                            <button type="button" onclick="selesaiModal()"
                                    class="action-btn w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 text-white font-medium text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl group">
                                <i class="fas fa-check-double mr-2 group-hover:scale-110 transition-transform"></i>
                                Selesaikan Peminjaman
                            </button>
                        @endif
                    </div>
                </div>

                <!-- System Info -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.8s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg mr-3">
                            <i class="fas fa-info-circle text-gray-600 dark:text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Sistem</h3>
                    </div>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">ID Peminjaman:</span>
                            <span class="font-mono text-slate-600 dark:text-slate-300 font-semibold">#{{ $peminjaman->id }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">Jenis Aset:</span>
                            <span class="font-mono text-slate-600 dark:text-slate-300 font-semibold">{{ ucfirst($peminjaman->jenis_aset) }}</span>
                        </div>
                        @if($peminjaman->permohonan_id)
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">ID Permohonan:</span>
                            <span class="font-mono text-slate-600 dark:text-slate-300 font-semibold">#{{ $peminjaman->permohonan_id }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">Dibuat:</span>
                            <span class="text-slate-600 dark:text-slate-300">{{ $peminjaman->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">Terakhir Update:</span>
                            <span class="text-slate-600 dark:text-slate-300">{{ $peminjaman->updated_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-500 dark:text-gray-400">Total Barang:</span>
                            <span class="text-slate-600 dark:text-slate-300 font-semibold">{{ $peminjaman->peminjamanDetail->count() }} item</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Approve Modal -->
    <div id="approve-modal" class="fixed inset-0 modal-backdrop overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border-0 w-11/12 max-w-md shadow-2xl rounded-xl bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-lg mr-3">
                            <i class="fas fa-check-circle text-green-600 dark:text-green-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Setujui Peminjaman</h3>
                    </div>
                    <button onclick="closeModal('approve-modal')" class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="approve-form" method="POST" action="{{ route('admin.peminjaman.approve', $peminjaman->id) }}">
                    @csrf
                    <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                        <p class="text-sm text-green-800 dark:text-green-300 mb-3">
                            <span class="font-medium">Peminjam:</span> {{ $peminjaman->user->name }}
                        </p>
                        
                        @if($peminjaman->peminjamanDetail->count() > 1)
                            <div class="text-sm font-medium text-green-900 dark:text-green-200 mb-2">
                                <i class="fas fa-layer-group mr-1"></i>
                                {{ $peminjaman->peminjamanDetail->count() }} Barang
                            </div>
                            <div class="space-y-2 max-h-60 overflow-y-auto custom-scrollbar pr-2">
                                @foreach($peminjaman->peminjamanDetail as $index => $detail)
                                    <div class="flex items-start bg-white dark:bg-gray-800 rounded-lg p-2.5 border border-green-200 dark:border-green-700 hover:border-green-300 dark:hover:border-green-600 transition-all">
                                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 flex items-center justify-center text-xs font-bold mr-2.5">
                                            {{ $index + 1 }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-1">
                                                {{ $detail->barang->nama_barang }}
                                            </div>
                                            <div class="flex items-center gap-2 flex-wrap text-xs">
                                                @if($detail->barang->kategori)
                                                    <span class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                                        <i class="fas fa-tag mr-1"></i>
                                                        {{ $detail->barang->kategori->nama_kategori }}
                                                    </span>
                                                @endif
                                                <span class="inline-flex items-center text-green-600 dark:text-green-400 font-semibold">
                                                    <i class="fas fa-cubes mr-1"></i>
                                                    {{ $detail->jumlah }}x
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <p class="text-xs text-green-600 dark:text-green-400 mt-3">
                                <i class="fas fa-layer-group mr-1"></i>
                                Total {{ $peminjaman->peminjamanDetail->count() }} barang akan dikurangi dari stok
                            </p>
                        @else
                            @php
                                $detail = $peminjaman->peminjamanDetail->first();
                            @endphp
                            @if($detail)
                                <div class="text-sm text-green-800 dark:text-green-300">
                                    <span class="font-medium">Barang:</span> {{ $detail->barang->nama_barang }}
                                </div>
                                @if($detail->barang->kategori)
                                    <div class="text-xs text-green-700 dark:text-green-400 mt-1">
                                        <i class="fas fa-tag mr-1"></i>
                                        Kategori: {{ $detail->barang->kategori->nama_kategori }}
                                    </div>
                                @endif
                                <div class="text-xs text-green-700 dark:text-green-400 mt-1">
                                    <i class="fas fa-cubes mr-1"></i>
                                    Jumlah: <span class="font-semibold">{{ $detail->jumlah }}x</span>
                                </div>
                                <p class="text-xs text-green-600 dark:text-green-400 mt-3">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Barang akan dikurangi dari stok tersedia
                                </p>
                            @endif
                        @endif
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeModal('approve-modal')" 
                                class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-medium transition-all">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-white bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 rounded-lg font-medium transition-all shadow-md hover:shadow-lg">
                            Setujui Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="reject-modal" class="fixed inset-0 modal-backdrop overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border-0 w-11/12 max-w-md shadow-2xl rounded-xl bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-lg mr-3">
                            <i class="fas fa-times-circle text-red-600 dark:text-red-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Tolak Peminjaman</h3>
                    </div>
                    <button onclick="closeModal('reject-modal')" class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="reject-form" method="POST" action="{{ route('admin.peminjaman.reject', $peminjaman->id) }}">
                    @csrf
                    <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800">
                        <p class="text-sm text-red-800 dark:text-red-300 mb-3">
                            <span class="font-medium">Peminjam:</span> {{ $peminjaman->user->name }}
                        </p>
                        
                        @if($peminjaman->peminjamanDetail->count() > 1)
                            <div class="text-sm font-medium text-red-900 dark:text-red-200 mb-2">
                                <i class="fas fa-layer-group mr-1"></i>
                                {{ $peminjaman->peminjamanDetail->count() }} Barang
                            </div>
                            <div class="space-y-1.5 max-h-48 overflow-y-auto custom-scrollbar pr-1">
                                @foreach($peminjaman->peminjamanDetail as $index => $detail)
                                    <div class="text-xs text-red-800 dark:text-red-300 bg-white dark:bg-gray-800 rounded p-2 border border-red-100 dark:border-red-700">
                                        <span class="font-medium">{{ $index + 1 }}.</span> {{ $detail->barang->nama_barang }}
                                        <span class="text-red-600 dark:text-red-400">({{ $detail->jumlah }}x)</span>
                                        @if($detail->barang->kategori)
                                            <span class="text-gray-500 dark:text-gray-400 ml-1">- {{ $detail->barang->kategori->nama_kategori }}</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            @php
                                $detail = $peminjaman->peminjamanDetail->first();
                            @endphp
                            @if($detail)
                                <div class="text-sm text-red-800 dark:text-red-300">
                                    <span class="font-medium">Barang:</span> {{ $detail->barang->nama_barang }}
                                    <span class="text-red-600 dark:text-red-400">({{ $detail->jumlah }}x)</span>
                                </div>
                                @if($detail->barang->kategori)
                                    <div class="text-xs text-red-700 dark:text-red-400 mt-1">
                                        <i class="fas fa-tag mr-1"></i>
                                        {{ $detail->barang->kategori->nama_kategori }}
                                    </div>
                                @endif
                            @endif
                        @endif
                    </div>

                    <div class="mb-4">
                        <label for="alasan_penolakan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Alasan Penolakan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="alasan_penolakan" 
                                  id="alasan_penolakan" 
                                  rows="4" 
                                  required
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all"
                                  placeholder="Jelaskan alasan penolakan peminjaman..."></textarea>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Alasan akan dikirimkan ke peminjam
                        </p>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeModal('reject-modal')" 
                                class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-medium transition-all">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 rounded-lg font-medium transition-all shadow-md hover:shadow-lg">
                            Tolak Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Selesai Modal -->
    <div id="selesai-modal" class="fixed inset-0 modal-backdrop overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border-0 w-11/12 max-w-md shadow-2xl rounded-xl bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                            <i class="fas fa-check-double text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Selesaikan Peminjaman</h3>
                    </div>
                    <button onclick="closeModal('selesai-modal')" class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="selesai-form" method="POST" action="{{ route('admin.peminjaman.selesai', $peminjaman->id) }}">
                    @csrf
                    <div class="mb-4 p-4 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg border border-indigo-200 dark:border-indigo-800">
                        <p class="text-sm text-indigo-800 dark:text-indigo-300 mb-3">
                            <span class="font-medium">Peminjam:</span> {{ $peminjaman->user->name }}
                        </p>
                        
                        @if($peminjaman->peminjamanDetail->count() > 1)
                            <div class="text-sm font-medium text-indigo-900 dark:text-indigo-200 mb-2">
                                <i class="fas fa-layer-group mr-1"></i>
                                {{ $peminjaman->peminjamanDetail->count() }} Barang
                            </div>
                            <div class="space-y-1.5 max-h-48 overflow-y-auto custom-scrollbar pr-1">
                                @foreach($peminjaman->peminjamanDetail as $index => $detail)
                                    <div class="text-xs text-indigo-800 dark:text-indigo-300 bg-white dark:bg-gray-800 rounded p-2 border border-indigo-100 dark:border-indigo-700">
                                        <span class="font-medium">{{ $index + 1 }}.</span> {{ $detail->barang->nama_barang }}
                                        <span class="text-indigo-600 dark:text-indigo-400">({{ $detail->jumlah }}x)</span>
                                        @if($detail->barang->kategori)
                                            <span class="text-gray-500 dark:text-gray-400 ml-1">- {{ $detail->barang->kategori->nama_kategori }}</span>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            <p class="text-xs text-indigo-600 dark:text-indigo-400 mt-3">
                                <i class="fas fa-info-circle mr-1"></i>
                                Barang akan dikembalikan ke stok tersedia
                            </p>
                        @else
                            @php
                                $detail = $peminjaman->peminjamanDetail->first();
                            @endphp
                            @if($detail)
                                <div class="text-sm text-indigo-800 dark:text-indigo-300">
                                    <span class="font-medium">Barang:</span> {{ $detail->barang->nama_barang }}
                                    <span class="text-indigo-600 dark:text-indigo-400">({{ $detail->jumlah }}x)</span>
                                </div>
                                @if($detail->barang->kategori)
                                    <div class="text-xs text-indigo-700 dark:text-indigo-400 mt-1">
                                        <i class="fas fa-tag mr-1"></i>
                                        {{ $detail->barang->kategori->nama_kategori }}
                                    </div>
                                @endif
                                <p class="text-xs text-indigo-600 dark:text-indigo-400 mt-3">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Barang akan dikembalikan ke stok tersedia
                                </p>
                            @endif
                        @endif
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeModal('selesai-modal')" 
                                class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-medium transition-all">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 rounded-lg font-medium transition-all shadow-md hover:shadow-lg">
                            Selesaikan Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Notifications -->
    <!-- Success Notification -->
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

    <!-- Error Notification -->
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

    <!-- Info Notification -->
    @if(session('info'))
    <div id="notification" class="fixed top-4 right-4 z-50">
        <div class="notification bg-white/90 dark:bg-gray-800/90 rounded-lg shadow-xl border border-blue-200 dark:border-blue-700 border-l-4 p-4 max-w-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                        <i class="fas fa-info-circle text-blue-600 dark:text-blue-400"></i>
                    </div>
                </div>
                <div class="ml-3">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Informasi</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ session('info') }}</p>
                </div>
                <button onclick="hideNotification()" class="ml-auto text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-1 rounded transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Warning Notification -->
    @if(session('warning'))
    <div id="notification" class="fixed top-4 right-4 z-50">
        <div class="notification bg-white/90 dark:bg-gray-800/90 rounded-lg shadow-xl border border-yellow-200 dark:border-yellow-700 border-l-4 p-4 max-w-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg">
                        <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                </div>
                <div class="ml-3">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Peringatan</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ session('warning') }}</p>
                </div>
                <button onclick="hideNotification()" class="ml-auto text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-1 rounded transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Updated Notification (Khusus untuk Edit) -->
    @if(session('updated'))
    <div id="notification" class="fixed top-4 right-4 z-50">
        <div class="notification bg-white/90 dark:bg-gray-800/90 rounded-lg shadow-xl border border-indigo-200 dark:border-indigo-700 border-l-4 p-4 max-w-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                        <i class="fas fa-edit text-indigo-600 dark:text-indigo-400"></i>
                    </div>
                </div>
                <div class="ml-3">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Data Diperbarui!</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ session('updated') }}</p>
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
// ============================================
// MODAL FUNCTIONS
// ============================================

function approveModal() {
    document.getElementById('approve-modal').classList.remove('hidden');
}

function rejectModal() {
    document.getElementById('reject-modal').classList.remove('hidden');
}

function selesaiModal() {
    document.getElementById('selesai-modal').classList.remove('hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    if (modalId === 'reject-modal') {
        document.getElementById('alasan_penolakan').value = '';
    }
}

// ============================================
// NOTIFICATION FUNCTIONS
// ============================================

function hideNotification() {
    const notification = document.getElementById('notification');
    if (notification) {
        notification.style.animation = 'slideOutRight 0.5s ease-in forwards';
        setTimeout(() => notification.remove(), 500);
    }
}

// ============================================
// EVENT LISTENERS
// ============================================

document.addEventListener('click', function(event) {
    const approveModal = document.getElementById('approve-modal');
    const rejectModal = document.getElementById('reject-modal');
    const selesaiModal = document.getElementById('selesai-modal');
    
    if (event.target === approveModal) closeModal('approve-modal');
    if (event.target === rejectModal) closeModal('reject-modal');
    if (event.target === selesaiModal) closeModal('selesai-modal');
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal('approve-modal');
        closeModal('reject-modal');
        closeModal('selesai-modal');
    }
});

// ============================================
// FORM VALIDATIONS
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    const approveForm = document.getElementById('approve-form');
    if (approveForm) {
        approveForm.addEventListener('submit', function(e) {
            const confirmed = confirm('Apakah Anda yakin ingin menyetujui peminjaman ini? Berita acara akan otomatis dibuat.');
            if (!confirmed) {
                e.preventDefault();
                return false;
            }
            
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
            }
        });
    }
    
    const rejectForm = document.getElementById('reject-form');
    if (rejectForm) {
        rejectForm.addEventListener('submit', function(e) {
            const alasan = document.getElementById('alasan_penolakan').value.trim();
            
            if (alasan.length < 10) {
                e.preventDefault();
                alert('Alasan penolakan minimal 10 karakter');
                return false;
            }
            
            const confirmed = confirm('Apakah Anda yakin ingin menolak peminjaman ini?');
            if (!confirmed) {
                e.preventDefault();
                return false;
            }
            
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
            }
        });
    }
    
    const selesaiForm = document.getElementById('selesai-form');
    if (selesaiForm) {
        selesaiForm.addEventListener('submit', function(e) {
            const confirmed = confirm('Apakah Anda yakin peminjaman ini sudah selesai dan barang sudah dikembalikan?');
            if (!confirmed) {
                e.preventDefault();
                return false;
            }
            
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
            }
        });
    }
});

// ============================================
// PREVENT MULTIPLE FORM SUBMISSIONS
// ============================================

let isSubmitting = false;
document.addEventListener('submit', function(e) {
    if (isSubmitting) {
        e.preventDefault();
        alert('⚠️ Form sedang diproses. Mohon tunggu...');
        return false;
    }
    isSubmitting = true;
    
    setTimeout(() => {
        isSubmitting = false;
    }, 10000);
});

// ============================================
// ANIMATIONS & AUTO HIDE
// ============================================

const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    .notification {
        animation: slideInRight 0.5s ease-out;
    }
`;
document.head.appendChild(style);

// Auto hide notifications after 5 seconds
@if(session('success') || session('error') || session('info') || session('warning') || session('updated'))
setTimeout(() => hideNotification(), 5000);
@endif

// Log page view
console.log('Admin Peminjaman Show - Notifications loaded successfully');
</script>
@endpush