@extends('layouts.app')

@section('title', 'Detail Permohonan - Admin')

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
                
                <a href="{{ route('admin.permohonan.index') }}" class="breadcrumb-link">
                    <i class="fas fa-clipboard-check"></i>
                    <span>Review Permohonan</span>
                </a>
                
                <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs"></i>
                
                <span class="breadcrumb-current">
                    <i class="fas fa-file-invoice"></i>
                    <span title="Detail Permohonan {{ $permohonan->no_permohonan }}">
                        {{ Str::limit($permohonan->no_permohonan, 35) }}
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
                                <span class="text-sm font-semibold text-blue-700 dark:text-blue-300">Detail Permohonan</span>
                            </div>
                            
                            {{-- Main Title --}}
                            <h1 class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-blue-800 to-indigo-800 dark:from-slate-100 dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent leading-tight">
                                Detail Permohonan
                            </h1>
                            
                            {{-- Description --}}
                            <p class="text-slate-600 dark:text-slate-400 text-lg flex items-center space-x-2 mb-4">
                                <i class="fas fa-info-circle text-blue-500 dark:text-blue-400"></i>
                                <span>No: {{ $permohonan->no_permohonan }} • Dibuat {{ $permohonan->created_at->format('d M Y, H:i') }}</span>
                            </p>
                        </div>
                        
                        {{-- Right Section: Status Badge & Actions --}}
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                            <span class="inline-flex items-center px-6 py-3 rounded-xl text-sm font-semibold border shadow-md
                                @if($permohonan->status === 'Dalam Proses') bg-gradient-to-r from-amber-50 to-yellow-50 dark:from-amber-900/30 dark:to-yellow-900/30 text-amber-800 dark:text-amber-300 border-amber-200 dark:border-amber-700
                                @elseif($permohonan->status === 'Disetujui') bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/30 dark:to-green-900/30 text-emerald-800 dark:text-emerald-300 border-emerald-200 dark:border-emerald-700
                                @elseif($permohonan->status === 'Ditolak') bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900/30 dark:to-pink-900/30 text-red-800 dark:text-red-300 border-red-200 dark:border-red-700
                                @else bg-gradient-to-r from-gray-50 to-slate-50 dark:from-gray-700 dark:to-slate-700 text-gray-800 dark:text-gray-300 border-gray-200 dark:border-gray-600 @endif">
                                @if($permohonan->status === 'Dalam Proses')
                                    <div class="w-2 h-2 bg-amber-400 dark:bg-amber-500 rounded-full mr-2 animate-pulse-slow"></div>
                                @elseif($permohonan->status === 'Disetujui')
                                    <div class="w-2 h-2 bg-emerald-400 dark:bg-emerald-500 rounded-full mr-2"></div>
                                @elseif($permohonan->status === 'Ditolak')
                                    <div class="w-2 h-2 bg-red-400 dark:bg-red-500 rounded-full mr-2"></div>
                                @endif
                                {{ $permohonan->status }}
                            </span>
                            
                            {{-- Action Buttons --}}
                            @if($permohonan->status === 'Dalam Proses')
                            <div class="flex flex-wrap gap-2">
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
                
                <!-- Pemohon Info -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.1s">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg mr-3">
                                <i class="fas fa-user text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Pemohon</h3>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="h-16 w-16 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg mr-4">
                                <span class="text-white font-bold text-xl">{{ strtoupper(substr($permohonan->nama_pemohon, 0, 2)) }}</span>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $permohonan->nama_pemohon }}</h2>
                                <p class="text-gray-600 dark:text-gray-400">{{ $permohonan->user->email }}</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            @if($permohonan->no_ktp)
                                <div class="p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">No. KTP</div>
                                    <div class="font-semibold text-slate-800 dark:text-slate-200">{{ $permohonan->no_ktp }}</div>
                                </div>
                            @endif
                            
                            @if($permohonan->no_telp)
                                <div class="p-3 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Telepon</div>
                                    <div class="font-semibold text-indigo-800 dark:text-indigo-300">{{ $permohonan->no_telp }}</div>
                                </div>
                            @endif
                            
                            @if($permohonan->nama_instansi)
                                <div class="p-3 bg-purple-50 dark:bg-purple-900/30 rounded-lg">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Instansi</div>
                                    <div class="font-semibold text-purple-800 dark:text-purple-300">{{ $permohonan->nama_instansi }}</div>
                                </div>
                            @endif
                            
                            @if($permohonan->jabatan)
                                <div class="p-3 bg-pink-50 dark:bg-pink-900/30 rounded-lg">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Jabatan</div>
                                    <div class="font-semibold text-pink-800 dark:text-pink-300">{{ $permohonan->jabatan }}</div>
                                </div>
                            @endif
                            
                            @if($permohonan->bidang_instansi)
                                <div class="p-3 bg-green-50 dark:bg-green-900/30 rounded-lg">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Bidang Instansi</div>
                                    <div class="font-semibold text-green-800 dark:text-green-300">{{ $permohonan->bidang_instansi }}</div>
                                </div>
                            @endif
                            
                            @if($permohonan->alamat_instansi)
                                <div class="p-3 bg-teal-50 dark:bg-teal-900/30 rounded-lg">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Alamat Instansi</div>
                                    <div class="font-semibold text-teal-800 dark:text-teal-300">{{ $permohonan->alamat_instansi }}</div>
                                </div>
                            @endif
                            
                            @if($permohonan->alamat_pemohon)
                                <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg col-span-2">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Alamat Pemohon</div>
                                    <div class="font-semibold text-blue-800 dark:text-blue-300">
                                        {{ $permohonan->alamat_pemohon }}
                                        @if($permohonan->kelurahan), {{ $permohonan->kelurahan }}@endif
                                        @if($permohonan->kecamatan), {{ $permohonan->kecamatan }}@endif
                                        @if($permohonan->kabupaten), {{ $permohonan->kabupaten }}@endif
                                        @if($permohonan->kode_pos) {{ $permohonan->kode_pos }}@endif
                                    </div>
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
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Barang yang Dimohonkan</h3>
                    </div>
                    
                    @if($permohonan->items->count() > 0)
                        <div class="space-y-4">
                            @foreach($permohonan->items as $index => $item)
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
                        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                            <i class="fas fa-box-open text-4xl mb-2"></i>
                            <p>Tidak ada barang yang dimohonkan</p>
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
                                <i class="fas fa-calendar-day mr-1"></i>Tanggal Mulai
                            </div>
                            <div class="font-bold text-blue-800 dark:text-blue-300">
                                {{ \Carbon\Carbon::parse($permohonan->tanggal_mulai)->format('d M Y') }}
                            </div>
                        </div>
                        
                        <div class="p-4 bg-gradient-to-r from-red-50 to-red-100 dark:from-red-900/30 dark:to-red-800/30 rounded-xl border border-red-200 dark:border-red-700">
                            <div class="text-sm text-red-600 dark:text-red-400 mb-1">
                                <i class="fas fa-calendar-check mr-1"></i>Tanggal Selesai
                            </div>
                            <div class="font-bold text-red-800 dark:text-red-300">
                                {{ \Carbon\Carbon::parse($permohonan->tanggal_selesai)->format('d M Y') }}
                            </div>
                        </div>
                        
                        <div class="p-4 bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 rounded-xl border border-purple-200 dark:border-purple-700">
                            <div class="text-sm text-purple-600 dark:text-purple-400 mb-1">Durasi</div>
                            <div class="font-bold text-purple-800 dark:text-purple-300">
                                @php
                                    $days = \Carbon\Carbon::parse($permohonan->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($permohonan->tanggal_selesai)) + 1;
                                @endphp
                                {{ $days }} hari
                            </div>
                        </div>
                        
                        <div class="p-4 bg-gradient-to-r from-emerald-50 to-emerald-100 dark:from-emerald-900/30 dark:to-emerald-800/30 rounded-xl border border-emerald-200 dark:border-emerald-700">
                            <div class="text-sm text-emerald-600 dark:text-emerald-400 mb-1">Estimasi Biaya</div>
                            <div class="font-bold text-emerald-800 dark:text-emerald-300">
                                @if($biayaInfo['gratis'])
                                    <span class="text-emerald-600 dark:text-emerald-400">GRATIS</span>
                                @else
                                    Rp {{ number_format($biayaInfo['biaya'], 0, ',', '.') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    @if($permohonan->keperluan)
                        <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                            <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                <i class="fas fa-info-circle mr-1"></i>Keperluan
                            </div>
                            <div class="text-gray-800 dark:text-gray-200 whitespace-pre-line">{{ $permohonan->keperluan }}</div>
                        </div>
                    @endif
                </div>

                <!-- Dokumen Section -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.4s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                            <i class="fas fa-file-alt text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Dokumen Permohonan</h3>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- Draft Surat -->
                        @if($permohonan->draft_surat)
                            <div class="p-4 bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/30 dark:to-pink-900/30 rounded-xl border border-purple-200 dark:border-purple-700">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="p-3 bg-white dark:bg-gray-800 rounded-lg shadow-md mr-4">
                                            <i class="fas fa-file-word text-purple-600 dark:text-purple-400 text-xl"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 dark:text-gray-100">Draft Surat Permohonan</div>
                                            <div class="text-sm text-gray-600 dark:text-gray-400">Template surat yang sudah digenerate</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('permohonan.downloadDraft', $permohonan) }}"
                                       download
                                       class="action-btn flex-1 inline-flex items-center justify-center px-3 py-2 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-medium text-sm rounded-lg transition-all shadow-md">
                                        <i class="fas fa-download mr-2"></i>
                                        Download
                                    </a>
                                </div>
                            </div>
                        @endif

                        <!-- Surat yang sudah diupload -->
                        @if($permohonan->surat_permohonan)
                            <div class="p-4 bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/30 dark:to-green-900/30 rounded-xl border border-emerald-200 dark:border-emerald-700">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="p-3 bg-white dark:bg-gray-800 rounded-lg shadow-md mr-4">
                                            <i class="fas fa-file-pdf text-emerald-600 dark:text-emerald-400 text-xl"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 dark:text-gray-100">Surat Bertanda Tangan</div>
                                            <div class="text-sm text-gray-600 dark:text-gray-400">Dokumen resmi yang sudah ditandatangani</div>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 mt-1">
                                                <i class="fas fa-check-circle mr-1"></i>
                                                Sudah diupload
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ Storage::url($permohonan->surat_permohonan) }}" 
                                       target="_blank"
                                       class="action-btn flex-1 inline-flex items-center justify-center px-3 py-2 bg-white dark:bg-gray-800 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-700 font-medium text-sm rounded-lg hover:bg-emerald-50 dark:hover:bg-emerald-900/30 transition-all">
                                        <i class="fas fa-eye mr-2"></i>
                                        Lihat
                                    </a>
                                    <a href="{{ Storage::url($permohonan->surat_permohonan) }}" 
                                       download
                                       class="action-btn flex-1 inline-flex items-center justify-center px-3 py-2 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white font-medium text-sm rounded-lg transition-all shadow-md">
                                        <i class="fas fa-download mr-2"></i>
                                        Download
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 border-l-4 border-yellow-400 dark:border-yellow-600 rounded-lg">
                                <div class="flex items-start">
                                    <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-400 mt-0.5 mr-3"></i>
                                    <div class="text-sm text-yellow-800 dark:text-yellow-300">
                                        <span class="font-medium">Surat belum diupload</span> - Menunggu user mengupload surat yang sudah ditandatangani
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Alasan Penolakan (if rejected) -->
                @if($permohonan->status === 'Ditolak' && $permohonan->alasan_penolakan)
                    <div class="bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 dark:border-red-600 rounded-xl p-6 animate-slide-up" style="animation-delay: 0.5s">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-600 dark:text-red-400 text-2xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-red-900 dark:text-red-300 mb-2">Permohonan Ditolak</h3>
                                <p class="text-sm text-red-700 dark:text-red-400 mb-1 font-medium">Alasan:</p>
                                <p class="text-sm text-red-800 dark:text-red-300">{{ $permohonan->alasan_penolakan }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Column - Status & Actions -->
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
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Permohonan Dibuat</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $permohonan->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                        
                        @if($permohonan->status === 'Disetujui')
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center shadow-md mr-3">
                                <i class="fas fa-check text-white text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Disetujui</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $permohonan->updated_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                        @endif
                        
                        @if($permohonan->status === 'Ditolak')
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center shadow-md mr-3">
                                <i class="fas fa-times text-white text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Ditolak</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ $permohonan->updated_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                        @endif
                        
                        @if($permohonan->status === 'Dalam Proses')
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

                <!-- User Stats -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.7s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg mr-3">
                            <i class="fas fa-chart-bar text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Statistik User</h3>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Total Permohonan</span>
                            <span class="text-lg font-bold text-blue-600 dark:text-blue-400">{{ $userStats['total_permohonan'] }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center p-3 bg-green-50 dark:bg-green-900/30 rounded-lg">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Disetujui</span>
                            <span class="text-lg font-bold text-green-600 dark:text-green-400">{{ $userStats['disetujui'] }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center p-3 bg-red-50 dark:bg-red-900/30 rounded-lg">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Ditolak</span>
                            <span class="text-lg font-bold text-red-600 dark:text-red-400">{{ $userStats['ditolak'] }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center p-3 bg-yellow-50 dark:bg-yellow-900/30 rounded-lg">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Dalam Proses</span>
                            <span class="text-lg font-bold text-yellow-600 dark:text-yellow-400">{{ $userStats['dalam_proses'] }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                @if($permohonan->status === 'Dalam Proses')
                <div class="bg-gradient-to-br from-slate-50 to-gray-100 dark:from-slate-800 dark:to-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600 card-hover animate-slide-up" style="animation-delay: 0.8s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                            <i class="fas fa-bolt text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Aksi Cepat</h3>
                    </div>
                    
                    <div class="space-y-3">
                        <button type="button" onclick="approveModal()"
                                class="action-btn w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-medium text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl group">
                            <i class="fas fa-check mr-2 group-hover:scale-110 transition-transform"></i>
                            Setujui Permohonan
                        </button>
                        
                        <button type="button" onclick="rejectModal()"
                                class="action-btn w-full flex items-center justify-center px-4 py-3 bg-white dark:bg-gray-800 text-red-600 dark:text-red-400 font-medium text-sm border-2 border-red-200 dark:border-red-700 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/30 hover:border-red-300 dark:hover:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 group">
                            <i class="fas fa-times mr-2 group-hover:scale-110 transition-transform"></i>
                            Tolak Permohonan
                        </button>
                    </div>
                </div>
                @endif

                <!-- System Info -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.9s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg mr-3">
                            <i class="fas fa-info-circle text-gray-600 dark:text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Sistem</h3>
                    </div>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">No. Permohonan:</span>
                            <span class="font-mono text-slate-600 dark:text-slate-300 font-semibold">{{ $permohonan->no_permohonan }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">ID User:</span>
                            <span class="font-mono text-slate-600 dark:text-slate-300 font-semibold">#{{ $permohonan->user_id }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">Status:</span>
                            <span class="font-mono text-slate-600 dark:text-slate-300 font-semibold">{{ $permohonan->status }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">Dibuat:</span>
                            <span class="text-slate-600 dark:text-slate-300">{{ $permohonan->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">Terakhir Update:</span>
                            <span class="text-slate-600 dark:text-slate-300">{{ $permohonan->updated_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-500 dark:text-gray-400">Total Barang:</span>
                            <span class="text-slate-600 dark:text-slate-300 font-semibold">{{ $permohonan->items->count() }} item</span>
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
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Setujui Permohonan</h3>
                    </div>
                    <button onclick="closeModal('approve-modal')" class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form method="POST" action="{{ route('admin.permohonan.approve', $permohonan) }}">
                    @csrf
                    <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                        <p class="text-sm text-green-800 dark:text-green-300 mb-3">
                            <span class="font-medium">Pemohon:</span> {{ $permohonan->nama_pemohon }}
                        </p>
                        <p class="text-sm text-green-800 dark:text-green-300 mb-3">
                            <span class="font-medium">Instansi:</span> {{ $permohonan->nama_instansi ?? '-' }}
                        </p>
                        
                        @if($permohonan->items->count() > 1)
                            <div class="text-sm font-medium text-green-900 dark:text-green-200 mb-2">
                                <i class="fas fa-layer-group mr-1"></i>
                                {{ $permohonan->items->count() }} Barang
                            </div>
                            <div class="space-y-2 max-h-60 overflow-y-auto custom-scrollbar pr-2">
                                @foreach($permohonan->items as $index => $item)
                                    <div class="flex items-start bg-white dark:bg-gray-800 rounded-lg p-2.5 border border-green-200 dark:border-green-700 hover:border-green-300 dark:hover:border-green-600 transition-all">
                                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 flex items-center justify-center text-xs font-bold mr-2.5">
                                            {{ $index + 1 }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100 mb-1">
                                                {{ $item->barang->nama_barang }}
                                            </div>
                                            <div class="flex items-center gap-2 flex-wrap text-xs">
                                                <span class="inline-flex items-center text-green-600 dark:text-green-400 font-semibold">
                                                    <i class="fas fa-cubes mr-1"></i>
                                                    {{ $item->jumlah }}x
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            @php
                                $item = $permohonan->items->first();
                            @endphp
                            @if($item)
                                <div class="text-sm text-green-800 dark:text-green-300">
                                    <span class="font-medium">Barang:</span> {{ $item->barang->nama_barang }}
                                </div>
                                <div class="text-xs text-green-700 dark:text-green-400 mt-1">
                                    <i class="fas fa-cubes mr-1"></i>
                                    Jumlah: <span class="font-semibold">{{ $item->jumlah }}x</span>
                                </div>
                            @endif
                        @endif
                        
                        <p class="text-xs text-green-600 dark:text-green-400 mt-3">
                            <i class="fas fa-info-circle mr-1"></i>
                            Permohonan akan otomatis membuat data peminjaman baru
                        </p>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeModal('approve-modal')" 
                                class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-medium transition-all">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-white bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 rounded-lg font-medium transition-all shadow-md hover:shadow-lg">
                            Setujui Permohonan
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
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Tolak Permohonan</h3>
                    </div>
                    <button onclick="closeModal('reject-modal')" class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form method="POST" action="{{ route('admin.permohonan.reject', $permohonan) }}">
                    @csrf
                    <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800">
                        <p class="text-sm text-red-800 dark:text-red-300 mb-3">
                            <span class="font-medium">Pemohon:</span> {{ $permohonan->nama_pemohon }}
                        </p>
                        
                        @if($permohonan->items->count() > 1)
                            <div class="text-sm font-medium text-red-900 dark:text-red-200 mb-2">
                                <i class="fas fa-layer-group mr-1"></i>
                                {{ $permohonan->items->count() }} Barang
                            </div>
                        @else
                            @php
                                $item = $permohonan->items->first();
                            @endphp
                            @if($item)
                                <div class="text-sm text-red-800 dark:text-red-300">
                                    <span class="font-medium">Barang:</span> {{ $item->barang->nama_barang }}
                                </div>
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
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all"
                                  placeholder="Jelaskan alasan penolakan permohonan..."></textarea>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Alasan akan dikirimkan ke pemohon
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
function approveModal() {
    document.getElementById('approve-modal').classList.remove('hidden');
}

function rejectModal() {
    document.getElementById('reject-modal').classList.remove('hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    if (modalId === 'reject-modal') {
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
    const approveModal = document.getElementById('approve-modal');
    const rejectModal = document.getElementById('reject-modal');
    
    if (event.target === approveModal) closeModal('approve-modal');
    if (event.target === rejectModal) closeModal('reject-modal');
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal('approve-modal');
        closeModal('reject-modal');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const rejectForm = document.querySelector('#reject-modal form');
    if (rejectForm) {
        rejectForm.addEventListener('submit', function(e) {
            const alasan = document.getElementById('alasan_penolakan').value.trim();
            
            if (alasan.length < 10) {
                e.preventDefault();
                alert('Alasan penolakan minimal 10 karakter');
                return false;
            }
            
            const confirmed = confirm('Apakah Anda yakin ingin menolak permohonan ini?');
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

const style = document.createElement('style');
style.textContent = `
    @keyframes slideOutRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
`;
document.head.appendChild(style);

@if(session('success') || session('error'))
setTimeout(() => hideNotification(), 5000);
@endif

console.log('Admin Permohonan Show - JavaScript loaded successfully');
</script>
@endpush