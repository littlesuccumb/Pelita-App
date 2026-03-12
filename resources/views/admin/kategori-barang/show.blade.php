@extends('layouts.app')

@section('title', 'Detail Kategori Barang - Admin')

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

.barang-item {
    transition: all 0.3s ease;
}

.barang-item:hover {
    transform: translateX(2px);
}

.dark .barang-item:hover {
    background-color: #374151;
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
            
            <a href="{{ route('admin.kategori-barang.index') }}" class="breadcrumb-link">
                <i class="fas fa-tags"></i>
                <span>Kelola Kategori Barang</span>
            </a>
            
            <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs"></i>
            
            <span class="breadcrumb-current">
                <i class="fas fa-tag"></i>
                <span title="Detail Kategori: {{ $kategoriBarang->nama_kategori }}">
                    {{ Str::limit($kategoriBarang->nama_kategori, 35) }}
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
                            <span class="text-sm font-semibold text-blue-700 dark:text-blue-300">Detail Kategori Barang</span>
                        </div>
                        
                        {{-- Main Title --}}
                        <h1 class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-blue-800 to-indigo-800 dark:from-slate-100 dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent leading-tight">
                            {{ $kategoriBarang->nama_kategori }}
                        </h1>
                        
                        {{-- Description --}}
                        <p class="text-slate-600 dark:text-slate-400 text-lg flex items-center space-x-2 mb-4">
                            <i class="fas fa-info-circle text-blue-500 dark:text-blue-400"></i>
                            <span>Dibuat {{ $kategoriBarang->created_at->format('d M Y, H:i') }} • {{ $kategoriBarang->barang_count }} Barang</span>
                        </p>
                    </div>
                    
                    {{-- Right Section: Status Badge & Actions --}}
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <span class="inline-flex items-center px-6 py-3 rounded-xl text-sm font-semibold border shadow-md bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/30 dark:to-green-900/30 text-emerald-800 dark:text-emerald-300 border-emerald-200 dark:border-emerald-700">
                            <div class="w-2 h-2 bg-emerald-400 dark:bg-emerald-500 rounded-full mr-2"></div>
                            Aktif
                        </span>
                        
                        {{-- Action Buttons --}}
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('admin.kategori-barang.edit', $kategoriBarang->id) }}"
                               class="action-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <i class="fas fa-edit mr-2"></i>
                                Edit
                            </a>
                            
                            @if($kategoriBarang->barang_count == 0)
                            <button type="button" onclick="openDeleteModal('{{ $kategoriBarang->id }}', '{{ $kategoriBarang->nama_kategori }}')"
                                    class="action-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-medium text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <i class="fas fa-trash mr-2"></i>
                                Hapus
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
            
            <!-- Basic Info -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.1s">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg mr-3">
                            <i class="fas fa-layer-group text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Kategori</h3>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-emerald-500 dark:bg-emerald-400 rounded-full"></div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Verified Category</span>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $kategoriBarang->nama_kategori }}</h2>
                        <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                            <span class="flex items-center">
                                <i class="fas fa-cubes mr-1 text-blue-500 dark:text-blue-400"></i>
                                {{ $kategoriBarang->barang_count }} Barang
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-tag mr-1 text-purple-500 dark:text-purple-400"></i>
                                ID: #{{ $kategoriBarang->id }}
                            </span>
                        </div>
                    </div>
                    
                    @if($kategoriBarang->deskripsi)
                        <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                            <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                <i class="fas fa-info-circle mr-1"></i>Deskripsi
                            </div>
                            <div class="text-gray-800 dark:text-gray-200 whitespace-pre-line">{{ $kategoriBarang->deskripsi }}</div>
                        </div>
                    @else
                        <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                            <div class="text-sm text-gray-500 dark:text-gray-400 italic text-center">
                                <i class="fas fa-info-circle mr-1"></i>Belum ada deskripsi untuk kategori ini
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Statistics -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.2s">
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg mr-3">
                        <i class="fas fa-chart-bar text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Statistik Kategori</h3>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="p-4 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 rounded-xl border border-blue-200 dark:border-blue-700 text-center">
                        <div class="text-sm text-blue-600 dark:text-blue-400 mb-1">Total Barang</div>
                        <div class="text-2xl font-bold text-blue-800 dark:text-blue-300">{{ $kategoriBarang->barang_count }}</div>
                    </div>
                    
                    @php
                        $tersedia = $barang->where('status', 'tersedia')->count();
                        $dipinjam = $barang->where('status', 'dipinjam')->count();
                        $maintenance = $barang->where('status', 'maintenance')->count();
                    @endphp
                    
                    <div class="p-4 bg-gradient-to-r from-emerald-50 to-emerald-100 dark:from-emerald-900/30 dark:to-emerald-800/30 rounded-xl border border-emerald-200 dark:border-emerald-700 text-center">
                        <div class="text-sm text-emerald-600 dark:text-emerald-400 mb-1">Tersedia</div>
                        <div class="text-2xl font-bold text-emerald-800 dark:text-emerald-300">{{ $tersedia }}</div>
                    </div>
                    
                    <div class="p-4 bg-gradient-to-r from-amber-50 to-amber-100 dark:from-amber-900/30 dark:to-amber-800/30 rounded-xl border border-amber-200 dark:border-amber-700 text-center">
                        <div class="text-sm text-amber-600 dark:text-amber-400 mb-1">Dipinjam</div>
                        <div class="text-2xl font-bold text-amber-800 dark:text-amber-300">{{ $dipinjam }}</div>
                    </div>
                    
                    <div class="p-4 bg-gradient-to-r from-red-50 to-red-100 dark:from-red-900/30 dark:to-red-800/30 rounded-xl border border-red-200 dark:border-red-700 text-center">
                        <div class="text-sm text-red-600 dark:text-red-400 mb-1">Maintenance</div>
                        <div class="text-2xl font-bold text-red-800 dark:text-red-300">{{ $maintenance }}</div>
                    </div>
                </div>
            </div>

            <!-- Daftar Barang -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.3s">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg mr-3">
                            <i class="fas fa-box text-green-600 dark:text-green-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Daftar Barang</h3>
                    </div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $barang->total() }} total barang</span>
                </div>
                
                @if($barang->count() > 0)
                    <div class="space-y-3">
                        @foreach($barang as $item)
                            <div class="barang-item flex items-center justify-between p-4 bg-gradient-to-r from-slate-50 to-white dark:from-slate-700/50 dark:to-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-500 transition-all">
                                <div class="flex items-center space-x-4 flex-1">
                                    @if($item->foto)
                                        <img src="{{ Storage::url($item->foto) }}" 
                                             alt="{{ $item->nama_barang }}"
                                             class="w-16 h-16 object-cover rounded-lg border-2 border-gray-200 dark:border-gray-600">
                                    @else
                                        <div class="w-16 h-16 bg-gradient-to-br from-gray-200 to-gray-300 dark:from-gray-600 dark:to-gray-700 rounded-lg border-2 border-gray-200 dark:border-gray-600 flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400 dark:text-gray-500 text-xl"></i>
                                        </div>
                                    @endif
                                    
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-gray-900 dark:text-gray-100 truncate">{{ $item->nama_barang }}</h4>
                                        <div class="flex items-center space-x-3 text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            <span class="flex items-center">
                                                <i class="fas fa-barcode mr-1"></i>
                                                {{ $item->kode_barang }}
                                            </span>
                                            @if($item->merk)
                                            <span class="flex items-center">
                                                <i class="fas fa-tag mr-1"></i>
                                                {{ $item->merk }}
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        @if($item->status === 'tersedia') bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300
                                        @elseif($item->status === 'dipinjam') bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300
                                        @elseif($item->status === 'maintenance') bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300
                                        @else bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 @endif">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                    
                                    <a href="{{ route('admin.barang.show', $item->id) }}"
                                       class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-800/50 transition-colors">
                                        <i class="fas fa-eye text-sm"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    @if($barang->hasPages())
                        <div class="mt-6">
                            {{ $barang->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full mb-4">
                            <i class="fas fa-box-open text-gray-400 dark:text-gray-500 text-2xl"></i>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Belum Ada Barang</h4>
                        <p class="text-gray-500 dark:text-gray-400 mb-6">Kategori ini belum memiliki barang yang terdaftar</p>
                        <a href="{{ route('admin.barang.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Barang
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column - Additional Info -->
        <div class="space-y-6">
            
            <!-- Quick Stats -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.4s">
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                        <i class="fas fa-chart-line text-indigo-600 dark:text-indigo-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Ringkasan</h3>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-slate-50 to-gray-50 dark:from-slate-700/50 dark:to-gray-700/50 rounded-xl border border-slate-200 dark:border-slate-600">
                        <div>
                            <div class="text-sm text-slate-600 dark:text-slate-400">Status Kategori</div>
                            <div class="text-lg font-bold text-slate-800 dark:text-slate-200">Aktif</div>
                        </div>
                        <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-emerald-600 dark:text-emerald-400 text-xl"></i>
                        </div>
                    </div>
                    
                    <div class="p-4 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-xl border border-blue-200 dark:border-blue-700">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-blue-600 dark:text-blue-400">Total Barang</span>
                            <span class="text-2xl font-bold text-blue-800 dark:text-blue-300">{{ $kategoriBarang->barang_count }}</span>
                        </div>
                        <div class="w-full bg-blue-200 dark:bg-blue-800 rounded-full h-2">
                            <div class="bg-blue-600 dark:bg-blue-400 h-2 rounded-full" style="width: {{ $kategoriBarang->barang_count > 0 ? '100' : '0' }}%"></div>
                        </div>
                    </div>
                    
                    @if($kategoriBarang->barang_count > 0)
                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-400">Tingkat Ketersediaan</span>
                            <span class="font-semibold text-emerald-600 dark:text-emerald-400">
                                {{ $kategoriBarang->barang_count > 0 ? round(($tersedia / $kategoriBarang->barang_count) * 100) : 0 }}%
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-emerald-500 dark:bg-emerald-400 h-2 rounded-full transition-all" 
                                 style="width: {{ $kategoriBarang->barang_count > 0 ? round(($tersedia / $kategoriBarang->barang_count) * 100) : 0 }}%"></div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Usage Info -->
            @if($kategoriBarang->barang_count > 0)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.5s">
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg mr-3">
                        <i class="fas fa-info-circle text-yellow-600 dark:text-yellow-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Penggunaan</h3>
                </div>
                
                <div class="space-y-3">
                    <div class="p-3 bg-emerald-50 dark:bg-emerald-900/20 rounded-lg border border-emerald-200 dark:border-emerald-800">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-emerald-700 dark:text-emerald-300">Siap Dipinjam</span>
                            <span class="font-bold text-emerald-800 dark:text-emerald-300">{{ $tersedia }} unit</span>
                        </div>
                    </div>
                    
                    <div class="p-3 bg-amber-50 dark:bg-amber-900/20 rounded-lg border border-amber-200 dark:border-amber-800">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-amber-700 dark:text-amber-300">Sedang Dipinjam</span>
                            <span class="font-bold text-amber-800 dark:text-amber-300">{{ $dipinjam }} unit</span>
                        </div>
                    </div>
                    
                    <div class="p-3 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-red-700 dark:text-red-300">Dalam Maintenance</span>
                            <span class="font-bold text-red-800 dark:text-red-300">{{ $maintenance }} unit</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="bg-gradient-to-br from-slate-50 to-gray-100 dark:from-slate-800 dark:to-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600 card-hover animate-slide-up" style="animation-delay: 0.6s">
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                        <i class="fas fa-bolt text-indigo-600 dark:text-indigo-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Aksi Cepat</h3>
                </div>
                
                <div class="space-y-3">
                    <a href="{{ route('admin.kategori-barang.edit', $kategoriBarang->id) }}"
                       class="action-btn w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-medium text-sm rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl group">
                        <i class="fas fa-edit mr-2 group-hover:scale-110 transition-transform"></i>
                        Edit Kategori
                    </a>
                    
                    <a href="{{ route('admin.barang.create') }}"
                       class="action-btn w-full flex items-center justify-center px-4 py-3 bg-white dark:bg-gray-800 text-emerald-600 dark:text-emerald-400 font-medium text-sm border-2 border-emerald-200 dark:border-emerald-700 rounded-xl hover:bg-emerald-50 dark:hover:bg-emerald-900/30 hover:border-emerald-300 dark:hover:border-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-200 group">
                        <i class="fas fa-plus mr-2 group-hover:scale-110 transition-transform"></i>
                        Tambah Barang Baru
                    </a>
                    
                    @if($kategoriBarang->barang_count == 0)
                    <button type="button" onclick="openDeleteModal('{{ $kategoriBarang->id }}', '{{ $kategoriBarang->nama_kategori }}')"
                            class="action-btn w-full flex items-center justify-center px-4 py-3 bg-white dark:bg-gray-800 text-red-600 dark:text-red-400 font-medium text-sm border-2 border-red-200 dark:border-red-700 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/30 hover:border-red-300 dark:hover:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 group">
                        <i class="fas fa-trash mr-2 group-hover:scale-110 transition-transform"></i>
                        Hapus Kategori
                    </button>
                    @else
                    <div class="p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-red-500 dark:text-red-400 mr-2 mt-0.5"></i>
                            <p class="text-xs text-red-700 dark:text-red-300">
                                Kategori tidak dapat dihapus karena masih memiliki {{ $kategoriBarang->barang_count }} barang terdaftar
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- System Info -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.7s">
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg mr-3">
                        <i class="fas fa-database text-gray-600 dark:text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Sistem</h3>
                </div>
                
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">ID Kategori:</span>
                        <span class="font-mono text-slate-600 dark:text-slate-300 font-semibold">#{{ $kategoriBarang->id }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">Dibuat:</span>
                        <span class="text-slate-600 dark:text-slate-300">{{ $kategoriBarang->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">Terakhir Update:</span>
                        <span class="text-slate-600 dark:text-slate-300">{{ $kategoriBarang->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-gray-500 dark:text-gray-400">Total Barang:</span>
                        <span class="text-slate-600 dark:text-slate-300 font-semibold">{{ $kategoriBarang->barang_count }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 modal-backdrop overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border-0 w-11/12 max-w-md shadow-2xl rounded-xl bg-white dark:bg-gray-800">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-lg mr-3">
                        <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Konfirmasi Hapus Kategori</h3>
                </div>
                <button onclick="closeModal('deleteModal')" class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="deleteForm" method="POST" action="">
                @csrf
                @method('DELETE')
                
                <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800">
                    <p class="text-sm text-red-800 dark:text-red-300 mb-2 font-medium">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        Peringatan: Tindakan ini tidak dapat dibatalkan!
                    </p>
                    <p class="text-sm text-red-700 dark:text-red-400 mb-1">Kategori yang akan dihapus:</p>
                    <p id="deleteItemName" class="font-semibold text-red-900 dark:text-red-200"></p>
                </div>

                <div class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-800">
                    <p class="text-sm text-yellow-800 dark:text-yellow-300">
                        <i class="fas fa-info-circle mr-1"></i>
                        Pastikan kategori ini tidak memiliki barang terdaftar sebelum menghapus.
                    </p>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeModal('deleteModal')" 
                            class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-medium transition-all">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-6 py-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white rounded-lg font-semibold transition-all shadow-lg hover:shadow-xl">
                        <i class="fas fa-trash mr-2"></i>
                        Hapus Kategori
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
@endsection

@push('scripts')
<script>
// Modal Functions
function openDeleteModal(id, itemName) {
    console.log('Opening delete modal for:', itemName);
    document.getElementById('deleteItemName').textContent = itemName;
    document.getElementById('deleteForm').action = `/admin/kategori-barang/${id}`;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeModal(modalId) {
    console.log('Closing modal:', modalId);
    document.getElementById(modalId).classList.add('hidden');
    
    // Reset form
    if (modalId === 'deleteModal') {
        document.getElementById('deleteForm').reset();
    }
}

function hideNotification() {
    const notification = document.getElementById('notification');
    if (notification) {
        notification.style.animation = 'slideOutRight 0.5s ease-in forwards';
        setTimeout(() => {
            notification.remove();
        }, 500);
    }
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    const deleteModal = document.getElementById('deleteModal');
    if (event.target === deleteModal && !deleteModal.classList.contains('hidden')) {
        closeModal('deleteModal');
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const deleteModal = document.getElementById('deleteModal');
        if (!deleteModal.classList.contains('hidden')) {
            closeModal('deleteModal');
        }
    }
});

// Auto hide notifications
@if(session('success') || session('error'))
setTimeout(() => {
    hideNotification();
}, 5000);
@endif

// Prevent form resubmission on page refresh
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

// Debug log
console.log('Admin Kategori Barang Show - JavaScript loaded successfully');
</script>
@endpush