@extends('layouts.app')

@section('title', 'Detail Barang - Admin')

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

/* Maintenance Button Styles */
.btn-maintenance {
    background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%) !important;
    color: white !important;
    border: none !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 6px -1px rgba(234, 88, 12, 0.3) !important;
}

.btn-maintenance:hover {
    background: linear-gradient(135deg, #c2410c 0%, #9a3412 100%) !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 8px 15px -3px rgba(234, 88, 12, 0.4) !important;
}

.btn-maintenance:focus {
    outline: none !important;
    ring: 2px solid #ea580c !important;
    ring-offset: 2px !important;
}

.btn-activate {
    background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
    color: white !important;
    border: none !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 6px -1px rgba(5, 150, 105, 0.3) !important;
}

.btn-activate:hover {
    background: linear-gradient(135deg, #047857 0%, #065f46 100%) !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 8px 15px -3px rgba(5, 150, 105, 0.4) !important;
}

/* Simple Modal CSS */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal.show {
    display: block !important;
}

.modal-content {
    background-color: white;
    margin: 5% auto;
    padding: 20px;
    border-radius: 8px;
    width: 90%;
    max-width: 500px;
    max-height: 80vh;
    overflow-y: auto;
}

.dark .modal-content {
    background-color: #1f2937;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: black;
}

.dark .close:hover,
.dark .close:focus {
    color: white;
}

.notification {
    backdrop-filter: blur(10px);
    border-left: 4px solid;
    animation: slideInRight 0.5s ease-out;
}

.success { border-left-color: #10b981; }
.error { border-left-color: #ef4444; }
.info { border-left-color: #3b82f6; }

.image-gallery {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1rem;
}

.main-image {
    aspect-ratio: 16/9;
    object-fit: cover;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.main-image:hover {
    transform: scale(1.02);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

.spec-card {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.spec-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.maintenance-item {
    transition: all 0.3s ease;
}

.maintenance-item:hover {
    transform: translateX(2px);
}

.action-btn {
    transition: all 0.3s ease;
}

.action-btn:hover {
    transform: scale(1.05);
}

@media print {
    .no-print, nav, footer, .print\:hidden {
        display: none !important;
    }
    
    .print\:block {
        display: block !important;
    }
    
    .bg-gradient-to-br, .bg-gradient-to-r {
        background: #f8fafc !important;
        color: #1e293b !important;
    }
    
    .shadow-lg, .shadow-xl {
        box-shadow: none !important;
        border: 1px solid #e2e8f0 !important;
    }
}

.modal-backdrop {
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
}

#complete-maintenance-modal:not(.hidden) {
    animation: fadeIn 0.3s ease-out;
}

/* Custom Scrollbar */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 10px;
}

.dark .custom-scrollbar::-webkit-scrollbar-track {
    background: #374151;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Lightbox Animations */
#lightboxModal {
    animation: fadeIn 0.3s ease-out;
}

#lightboxModal img {
    animation: zoomIn 0.3s ease-out;
}

@keyframes zoomIn {
    from {
        transform: scale(0.9);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

/* Upload Drop Zone Hover */
#dropZone.border-purple-500 {
    border-width: 3px;
}

/* Thumbnail Hover Effect */
.thumbnail-wrapper {
    position: relative;
    cursor: pointer;
}

.thumbnail-wrapper img {
    transition: transform 0.3s ease;
}

.thumbnail-wrapper:hover img {
    transform: scale(1.05);
}

/* Modal Show Animation */
.modal.show {
    animation: fadeIn 0.3s ease-out;
}

.modal.show .modal-content {
    animation: slideUp 0.3s ease-out;
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
                
                <a href="{{ route('admin.barang.index') }}" class="breadcrumb-link">
                    <i class="fas fa-boxes"></i>
                    <span>Kelola Barang</span>
                </a>
                
                <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs"></i>
                
                <span class="breadcrumb-current">
                    <i class="fas fa-cube"></i>
                    <span title="{{ $barang->nama_barang }}">
                        {{ Str::limit($barang->nama_barang, 35) }}
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
                                <span class="text-sm font-semibold text-blue-700 dark:text-blue-300">Item Details</span>
                            </div>
                            
                            {{-- Main Title --}}
                            <h1 class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-blue-800 to-indigo-800 dark:from-slate-100 dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent leading-tight">
                                Detail Barang
                            </h1>
                            
                            {{-- Description --}}
                            <p class="text-slate-600 dark:text-slate-400 text-lg flex items-center space-x-2 mb-4">
                                <i class="fas fa-info-circle text-blue-500 dark:text-blue-400"></i>
                                <span>Kode: {{ $barang->kode_barang }} • Dibuat {{ $barang->created_at->format('d M Y, H:i') }}</span>
                            </p>
                        </div>
                        
                        {{-- Right Section: Status Badge & Actions --}}
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                            <span class="inline-flex items-center px-6 py-3 rounded-xl text-sm font-semibold border shadow-md
                                @if($barang->status === 'tersedia') bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/30 dark:to-green-900/30 text-emerald-800 dark:text-emerald-300 border-emerald-200 dark:border-emerald-700
                                @elseif($barang->status === 'dipinjam') bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/30 dark:to-orange-900/30 text-amber-800 dark:text-amber-300 border-amber-200 dark:border-amber-700
                                @elseif($barang->status === 'maintenance') bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900/30 dark:to-pink-900/30 text-red-800 dark:text-red-300 border-red-200 dark:border-red-700
                                @else bg-gradient-to-r from-gray-50 to-slate-50 dark:from-gray-700 dark:to-slate-700 text-gray-800 dark:text-gray-300 border-gray-200 dark:border-gray-600 @endif">
                                @if($barang->status === 'tersedia')
                                    <div class="w-2 h-2 bg-emerald-400 dark:bg-emerald-500 rounded-full mr-2"></div>
                                @elseif($barang->status === 'dipinjam')
                                    <div class="w-2 h-2 bg-amber-400 dark:bg-amber-500 rounded-full mr-2 animate-pulse-slow"></div>
                                @elseif($barang->status === 'maintenance')
                                    <div class="w-2 h-2 bg-red-400 dark:bg-red-500 rounded-full mr-2"></div>
                                @else
                                    <div class="w-2 h-2 bg-slate-400 dark:bg-slate-500 rounded-full mr-2"></div>
                                @endif
                                {{ ucfirst($barang->status) }}
                            </span>
                            
                            <!-- Action Buttons -->
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.barang.edit', $barang->id) }}"
                                   class="action-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium text-sm rounded-xl hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                                    <i class="fas fa-edit mr-2"></i>
                                    Edit Barang
                                </a>
                                
                                @if($barang->status === 'tersedia' && $barang->jumlah_tersedia > 0)
                                    <button type="button" 
                                            onclick="showMaintenanceModal('{{ $barang->id }}')"
                                            class="action-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-medium text-sm rounded-xl hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                                        <i class="fas fa-tools mr-2"></i>
                                        Maintenance
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
                                <i class="fas fa-cube text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Dasar</h3>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Verified Item</span>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $barang->nama_barang }}</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ $barang->kategori->nama_kategori ?? 'Kategori tidak tersedia' }}</p>
                        </div>
                        
                        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                            @if($barang->merk)
                                <div class="p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Merk</div>
                                    <div class="font-semibold text-slate-800 dark:text-slate-200">{{ $barang->merk }}</div>
                                </div>
                            @endif
                            
                            @if($barang->type)
                                <div class="p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Tipe</div>
                                    <div class="font-semibold text-gray-800 dark:text-gray-200">{{ $barang->type }}</div>
                                </div>
                            @endif
                            
                            @if($barang->tahun_produksi)
                                <div class="p-3 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Tahun</div>
                                    <div class="font-semibold text-indigo-800 dark:text-indigo-300">{{ $barang->tahun_produksi }}</div>
                                </div>
                            @endif
                            
                            <div class="p-3 bg-purple-50 dark:bg-purple-900/30 rounded-lg">
                                <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Kondisi</div>
                                <div class="font-semibold text-purple-800 dark:text-purple-300">{{ ucfirst($barang->kondisi) }}</div>
                            </div>
                        </div>

                        <!-- Status Dapat Dipinjam -->
                        <div class="p-4 {{ $barang->dapat_dipinjam ? 'bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/30 dark:to-green-900/30' : 'bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900/30 dark:to-pink-900/30' }} rounded-xl border {{ $barang->dapat_dipinjam ? 'border-emerald-200 dark:border-emerald-700' : 'border-red-200 dark:border-red-700' }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="p-2 {{ $barang->dapat_dipinjam ? 'bg-emerald-100 dark:bg-emerald-800/50' : 'bg-red-100 dark:bg-red-800/50' }} rounded-lg mr-3">
                                        <i class="fas {{ $barang->dapat_dipinjam ? 'fa-check-circle' : 'fa-ban' }} {{ $barang->dapat_dipinjam ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400' }}"></i>
                                    </div>
                                    <div>
                                        <div class="text-xs {{ $barang->dapat_dipinjam ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400' }} mb-1">
                                            Status Peminjaman
                                        </div>
                                        <div class="font-semibold {{ $barang->dapat_dipinjam ? 'text-emerald-800 dark:text-emerald-300' : 'text-red-800 dark:text-red-300' }}">
                                            {{ $barang->dapat_dipinjam ? 'Dapat Dipinjam' : 'Tidak Dapat Dipinjam' }}
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-semibold border
                                        {{ $barang->dapat_dipinjam 
                                            ? 'bg-emerald-100 dark:bg-emerald-800/50 text-emerald-800 dark:text-emerald-300 border-emerald-300 dark:border-emerald-700' 
                                            : 'bg-red-100 dark:bg-red-800/50 text-red-800 dark:text-red-300 border-red-300 dark:border-red-700' }}">
                                        @if($barang->dapat_dipinjam)
                                            <i class="fas fa-check mr-1"></i> Aktif
                                        @else
                                            <i class="fas fa-times mr-1"></i> Non-aktif
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                            @if(!$barang->dapat_dipinjam)
                                <div class="mt-3 pt-3 border-t border-red-200 dark:border-red-700">
                                    <p class="text-xs text-red-700 dark:text-red-400">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Barang ini tidak tersedia untuk peminjaman. Hubungi admin untuk informasi lebih lanjut.
                                    </p>
                                </div>
                            @endif
                        </div>
                        
                        @if($barang->deskripsi)
                            <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                                <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                    <i class="fas fa-info-circle mr-1"></i>Deskripsi
                                </div>
                                <div class="text-gray-800 dark:text-gray-200">{{ $barang->deskripsi }}</div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Photo Gallery (Multiple Photos) -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.2s">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg mr-3">
                                <i class="fas fa-images text-purple-600 dark:text-purple-400"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Galeri Foto</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                    {{ $barang->fotos->count() }} foto tersedia
                                </p>
                            </div>
                        </div>
                        
                        <!-- Upload Button -->
                        <button onclick="openUploadModal()" 
                                class="flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-purple-600 text-white text-sm font-medium rounded-lg hover:from-purple-600 hover:to-purple-700 shadow-md hover:shadow-lg transition-all">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Foto
                        </button>
                    </div>
                    
                    @if($barang->fotos->count() > 0)
                        <!-- Main Photo -->
                        @php
                            $primaryFoto = $barang->fotos->where('is_primary', true)->first() ?? $barang->fotos->first();
                        @endphp
                        
                        <div class="mb-6">
                            <div class="relative group thumbnail-wrapper" onclick="openLightbox([{{ $barang->fotos->pluck('id')->implode(',') }}], {{ $primaryFoto->id }})">
                                <img src="{{ $primaryFoto->foto_url }}" 
                                    alt="{{ $barang->nama_barang }}"
                                    class="w-full h-[500px] object-contain bg-gray-50 dark:bg-gray-900 rounded-xl shadow-lg cursor-pointer transition-transform hover:scale-[1.02]">
                                
                                <!-- Primary Badge -->
                                <div class="absolute top-4 left-4 flex items-center gap-2 flex-wrap pointer-events-none">
                                    <span class="inline-flex items-center px-3 py-1.5 bg-purple-600 text-white text-xs font-bold rounded-full shadow-lg">
                                        <i class="fas fa-star mr-1"></i>
                                        Foto Utama
                                    </span>
                                    @if($primaryFoto->keterangan)
                                        <span class="inline-flex items-center px-3 py-1.5 bg-black/50 backdrop-blur-sm text-white text-xs rounded-full">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            {{ Str::limit($primaryFoto->keterangan, 30) }}
                                        </span>
                                    @endif
                                </div>
                                
                                <!-- Zoom Icon -->
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-black/20 rounded-xl pointer-events-none">
                                    <div class="p-4 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-full">
                                        <i class="fas fa-search-plus text-2xl text-purple-600 dark:text-purple-400"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Thumbnail Grid -->
                        @if($barang->fotos->count() > 1)
                            <div class="grid grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-3">
                                @foreach($barang->fotos->sortBy('urutan') as $foto)
                                    <div class="relative group">
                                        <div class="thumbnail-wrapper relative aspect-square rounded-lg overflow-hidden border-2 
                                            {{ $foto->is_primary ? 'border-purple-500 ring-2 ring-purple-200 dark:ring-purple-800' : 'border-gray-200 dark:border-gray-600' }} 
                                            cursor-pointer transition-all hover:border-purple-400 dark:hover:border-purple-500 hover:shadow-md"
                                            onclick="openLightbox([{{ $barang->fotos->pluck('id')->implode(',') }}], {{ $foto->id }})">
                                            
                                            <img src="{{ $foto->foto_url }}" 
                                                alt="Foto {{ $loop->iteration }}"
                                                class="w-full h-full object-cover">
                                            
                                            <!-- Primary Star -->
                                            @if($foto->is_primary)
                                                <div class="absolute top-1 right-1 z-10 pointer-events-none">
                                                    <div class="p-1.5 bg-purple-600 rounded-full shadow-lg">
                                                        <i class="fas fa-star text-white text-xs"></i>
                                                    </div>
                                                </div>
                                            @endif
                                            
                                            <!-- Hover Actions -->
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/70 to-black/30 opacity-0 group-hover:opacity-100 transition-all duration-300 z-20">
                                                <div class="absolute bottom-1 left-1 right-1 flex flex-col gap-1">
                                                    @if(!$foto->is_primary)
                                                        <button onclick="event.stopPropagation(); setPrimaryFoto({{ $foto->id }})" 
                                                                title="Set sebagai foto utama"
                                                                class="w-full px-1.5 py-1 bg-purple-600 text-white text-[10px] font-bold rounded hover:bg-purple-700 transition-all shadow-lg flex items-center justify-center gap-1">
                                                            <i class="fas fa-star text-[9px]"></i>
                                                            <span class="hidden sm:inline">Utama</span>
                                                        </button>
                                                    @endif
                                                    
                                                    <div class="grid grid-cols-2 gap-1">
                                                        <button onclick="event.stopPropagation(); editKeteranganFoto({{ $foto->id }}, '{{ addslashes($foto->keterangan ?? '') }}')" 
                                                                title="Edit keterangan"
                                                                class="px-1.5 py-1 bg-blue-600 text-white text-[10px] font-bold rounded hover:bg-blue-700 transition-all shadow-lg flex items-center justify-center gap-0.5">
                                                            <i class="fas fa-edit text-[9px]"></i>
                                                            <span class="hidden sm:inline text-[9px]">Edit</span>
                                                        </button>
                                                        
                                                        @if($barang->fotos->count() > 1)
                                                            <button onclick="event.stopPropagation(); deleteFoto({{ $foto->id }})" 
                                                                    title="Hapus foto"
                                                                    class="px-1.5 py-1 bg-red-600 text-white text-[10px] font-bold rounded hover:bg-red-700 transition-all shadow-lg flex items-center justify-center gap-0.5">
                                                                <i class="fas fa-trash text-[9px]"></i>
                                                                <span class="hidden sm:inline text-[9px]">Hapus</span>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Keterangan -->
                                        @if($foto->keterangan)
                                            <p class="text-[10px] text-gray-600 dark:text-gray-400 mt-1 truncate text-center" title="{{ $foto->keterangan }}">
                                                {{ $foto->keterangan }}
                                            </p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full mb-4">
                                <i class="fas fa-image text-gray-400 dark:text-gray-500 text-2xl"></i>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Belum Ada Foto</h4>
                            <p class="text-gray-500 dark:text-gray-400 mb-4">Upload foto pertama untuk barang ini</p>
                            <button onclick="openUploadModal()" 
                                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white font-medium rounded-lg hover:from-purple-600 hover:to-purple-700 shadow-lg hover:shadow-xl transition-all">
                                <i class="fas fa-upload mr-2"></i>
                                Upload Foto
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Specifications -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up spec-card" style="animation-delay: 0.3s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg mr-3">
                            <i class="fas fa-cogs text-green-600 dark:text-green-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Spesifikasi Teknis</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if($barang->seri)
                            <div class="p-4 bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-700/50 dark:to-slate-600/50 rounded-xl border border-slate-200 dark:border-slate-600">
                                <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                    <i class="fas fa-barcode mr-1"></i>Nomor Seri
                                </div>
                                <div class="font-mono text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $barang->seri }}
                                </div>
                            </div>
                        @endif
                        
                        @if($barang->warna)
                            <div class="p-4 bg-gradient-to-r from-indigo-50 to-indigo-100 dark:from-indigo-900/30 dark:to-indigo-800/30 rounded-xl border border-indigo-200 dark:border-indigo-700">
                                <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                    <i class="fas fa-palette mr-1"></i>Warna
                                </div>
                                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $barang->warna }}
                                </div>
                            </div>
                        @endif
                        
                        @if($barang->berat)
                            <div class="p-4 bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 rounded-xl border border-green-200 dark:border-green-700">
                                <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                    <i class="fas fa-weight mr-1"></i>Berat
                                </div>
                                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $barang->berat }} kg
                                </div>
                            </div>
                        @endif
                        
                        @if($barang->dimensi)
                            <div class="p-4 bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 rounded-xl border border-purple-200 dark:border-purple-700">
                                <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                    <i class="fas fa-ruler-combined mr-1"></i>Dimensi
                                </div>
                                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $barang->dimensi }}
                                </div>
                            </div>
                        @endif
                        
                        @if($barang->garansi)
                            <div class="p-4 bg-gradient-to-r from-amber-50 to-amber-100 dark:from-amber-900/30 dark:to-amber-800/30 rounded-xl border border-amber-200 dark:border-amber-700">
                                <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                    <i class="fas fa-shield-alt mr-1"></i>Garansi
                                </div>
                                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $barang->garansi }}
                                </div>
                            </div>
                        @endif
                        
                        @if($barang->lokasi)
                            <div class="p-4 bg-gradient-to-r from-cyan-50 to-cyan-100 dark:from-cyan-900/30 dark:to-cyan-800/30 rounded-xl border border-cyan-200 dark:border-cyan-700">
                                <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                    <i class="fas fa-map-marker-alt mr-1"></i>Lokasi
                                </div>
                                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $barang->lokasi }}
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    @if($barang->spesifikasi)
                        <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                            <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                <i class="fas fa-list mr-1"></i>Spesifikasi Detail
                            </div>
                            <div class="text-gray-800 dark:text-gray-200 whitespace-pre-line">{{ $barang->spesifikasi }}</div>
                        </div>
                    @endif
                </div>

                <!-- Purchase & Rental Info -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.4s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg mr-3">
                            <i class="fas fa-shopping-cart text-yellow-600 dark:text-yellow-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Pembelian & Sewa</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        @if($barang->tanggal_pembelian)
                            <div class="p-4 bg-blue-50 dark:bg-blue-900/30 rounded-xl border border-blue-200 dark:border-blue-700">
                                <div class="text-sm text-blue-600 dark:text-blue-400 mb-1">Tanggal Pembelian</div>
                                <div class="font-semibold text-blue-800 dark:text-blue-300">
                                    {{ $barang->tanggal_pembelian->format('d M Y') }}
                                </div>
                            </div>
                        @endif
                        
                        @if($barang->harga_beli)
                            <div class="p-4 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl border border-emerald-200 dark:border-emerald-700">
                                <div class="text-sm text-emerald-600 dark:text-emerald-400 mb-1">Harga Beli</div>
                                <div class="font-bold text-emerald-800 dark:text-emerald-300">
                                    Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}
                                </div>
                            </div>
                        @endif
                        
                        <div class="p-4 bg-purple-50 dark:bg-purple-900/30 rounded-xl border border-purple-200 dark:border-purple-700">
                            <div class="text-sm text-purple-600 dark:text-purple-400 mb-1">Harga Sewa/Hari</div>
                            <div class="font-bold text-purple-800 dark:text-purple-300">
                                Rp {{ number_format($barang->harga_sewa, 0, ',', '.') }}
                            </div>
                        </div>
                        
                        <div class="p-4 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl border border-indigo-200 dark:border-indigo-700">
                            <div class="text-sm text-indigo-600 dark:text-indigo-400 mb-1">Total Unit</div>
                            <div class="font-bold text-indigo-800 dark:text-indigo-300">
                                {{ $barang->jumlah_total }} unit
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Info -->
                @if($barang->lainnya)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.5s">
                        <div class="flex items-center mb-6">
                            <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg mr-3">
                                <i class="fas fa-clipboard text-gray-600 dark:text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Lainnya</h3>
                        </div>
                        
                        <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                            <div class="text-gray-800 dark:text-gray-200 whitespace-pre-line">{{ $barang->lainnya }}</div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Column - Status & History -->
            <div class="space-y-6">
                
                <!-- Availability Status -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.6s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                            <i class="fas fa-chart-line text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Status Ketersediaan</h3>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gradient-to-r from-slate-50 to-gray-50 dark:from-slate-700/50 dark:to-gray-700/50 rounded-xl border border-slate-200 dark:border-slate-600">
                            <div>
                                <div class="text-sm text-slate-600 dark:text-slate-400">Status Saat Ini</div>
                                <div class="text-lg font-bold text-slate-800 dark:text-slate-200">{{ ucfirst($barang->status) }}</div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex items-center px-3 py-2 rounded-full text-xs font-medium border
                                    @if($barang->status === 'tersedia') bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300 border-emerald-200 dark:border-emerald-700
                                    @elseif($barang->status === 'dipinjam') bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300 border-amber-200 dark:border-amber-700
                                    @elseif($barang->status === 'maintenance') bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 border-red-200 dark:border-red-700
                                    @else bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 border-gray-200 dark:border-gray-600 @endif">
                                    @if($barang->status === 'dipinjam')
                                        <div class="w-2 h-2 bg-amber-400 dark:bg-amber-500 rounded-full mr-2 animate-pulse-slow"></div>
                                    @endif
                                    {{ ucfirst($barang->status) }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Stock Breakdown -->
                        <div class="grid grid-cols-3 gap-3">
                            <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-center border border-blue-200 dark:border-blue-700">
                                <div class="text-xs text-blue-600 dark:text-blue-400 mb-1">Total</div>
                                <div class="text-xl font-bold text-blue-800 dark:text-blue-300">{{ $barang->jumlah_total }}</div>
                            </div>
                            <div class="p-3 bg-emerald-50 dark:bg-emerald-900/30 rounded-lg text-center border border-emerald-200 dark:border-emerald-700">
                                <div class="text-xs text-emerald-600 dark:text-emerald-400 mb-1">Tersedia</div>
                                <div class="text-xl font-bold text-emerald-800 dark:text-emerald-300">{{ $barang->jumlah_tersedia }}</div>
                            </div>
                            <div class="p-3 bg-orange-50 dark:bg-orange-900/30 rounded-lg text-center border border-orange-200 dark:border-orange-700">
                                <div class="text-xs text-orange-600 dark:text-orange-400 mb-1 -ml-2">Maintenance</div>
                                <div class="text-xl font-bold text-orange-800 dark:text-orange-300">{{ $barang->jumlah_maintenance }}</div>
                            </div>
                        </div>
                        
                        <!-- Borrowed Items -->
                        @php
                            $jumlahDipinjam = $barang->jumlah_total - $barang->jumlah_tersedia - $barang->jumlah_maintenance;
                        @endphp
                        @if($jumlahDipinjam > 0)
                        <div class="p-3 bg-amber-50 dark:bg-amber-900/30 rounded-lg border border-amber-200 dark:border-amber-700">
                            <div class="flex items-center justify-between">
                                <div class="text-xs text-amber-700 dark:text-amber-400 font-medium">Sedang Dipinjam</div>
                                <div class="text-lg font-bold text-amber-800 dark:text-amber-300">{{ $jumlahDipinjam }} unit</div>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Borrowing Permission Status -->
                        <div class="p-4 {{ $barang->dapat_dipinjam ? 'bg-emerald-50 dark:bg-emerald-900/30' : 'bg-red-50 dark:bg-red-900/30' }} rounded-xl border {{ $barang->dapat_dipinjam ? 'border-emerald-200 dark:border-emerald-700' : 'border-red-200 dark:border-red-700' }}">
                            <div class="flex items-center justify-between mb-2">
                                <div class="text-sm {{ $barang->dapat_dipinjam ? 'text-emerald-700 dark:text-emerald-400' : 'text-red-700 dark:text-red-400' }} font-medium">
                                    Izin Peminjaman
                                </div>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $barang->dapat_dipinjam 
                                        ? 'bg-emerald-100 dark:bg-emerald-800/50 text-emerald-800 dark:text-emerald-300 border-emerald-300 dark:border-emerald-700' 
                                        : 'bg-red-100 dark:bg-red-800/50 text-red-800 dark:text-red-300 border-red-300 dark:border-red-700' }}">
                                    @if($barang->dapat_dipinjam)
                                        <i class="fas fa-check-circle mr-1"></i> Ya
                                    @else
                                        <i class="fas fa-times-circle mr-1"></i> Tidak
                                    @endif
                                </span>
                            </div>
                            <div class="text-xs {{ $barang->dapat_dipinjam ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400' }}">
                                @if($barang->dapat_dipinjam)
                                    Barang ini dapat dipinjam oleh user
                                @else
                                    Barang ini tidak tersedia untuk dipinjam
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Maintenance History -->
                @if($barang->maintenances && $barang->maintenances->count() > 0)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.7s">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center">
                                <div class="p-3 bg-orange-100 dark:bg-orange-900/30 rounded-lg mr-3">
                                    <i class="fas fa-tools text-orange-600 dark:text-orange-400 text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Riwayat Maintenance</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">History perbaikan & perawatan barang</p>
                                </div>
                            </div>
                            <span class="text-xs bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-300 px-3 py-1.5 rounded-full font-bold border border-orange-200 dark:border-orange-700">
                                {{ $barang->maintenances->count() }} Record
                            </span>
                        </div>
                        
                        <div class="space-y-3 max-h-[600px] overflow-y-auto pr-2 custom-scrollbar">
                            @foreach($barang->maintenances->sortByDesc('created_at') as $maintenance)
                                <div class="maintenance-item bg-white dark:bg-gray-900/50 rounded-xl border-2 transition-all hover:shadow-md
                                    @if($maintenance->status === 'selesai') border-emerald-200 dark:border-emerald-700 hover:border-emerald-300 dark:hover:border-emerald-600
                                    @elseif($maintenance->status === 'dalam_proses') border-amber-200 dark:border-amber-700 hover:border-amber-300 dark:hover:border-amber-600
                                    @elseif($maintenance->status === 'dibatalkan') border-red-200 dark:border-red-700 hover:border-red-300 dark:hover:border-red-600
                                    @else border-slate-200 dark:border-slate-600 hover:border-slate-300 dark:hover:border-slate-500 @endif">
                                    
                                    <!-- Header -->
                                    <div class="p-3.5 
                                        @if($maintenance->status === 'selesai') bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/30 dark:to-green-900/30
                                        @elseif($maintenance->status === 'dalam_proses') bg-gradient-to-r from-amber-50 to-yellow-50 dark:from-amber-900/30 dark:to-yellow-900/30
                                        @elseif($maintenance->status === 'dibatalkan') bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900/30 dark:to-pink-900/30
                                        @else bg-gradient-to-r from-slate-50 to-gray-50 dark:from-slate-800/50 dark:to-gray-800/50 @endif 
                                        rounded-t-xl">
                                        
                                        <div class="flex items-start justify-between gap-3">
                                            <!-- Left: Icon + Info -->
                                            <div class="flex items-start space-x-3 flex-1">
                                                <!-- Status Icon -->
                                                <div class="w-11 h-11 rounded-lg flex items-center justify-center flex-shrink-0
                                                    @if($maintenance->status === 'selesai') bg-emerald-500
                                                    @elseif($maintenance->status === 'dalam_proses') bg-amber-500
                                                    @elseif($maintenance->status === 'dibatalkan') bg-red-500
                                                    @else bg-slate-500 @endif">
                                                    @if($maintenance->status === 'selesai')
                                                        <i class="fas fa-check-circle text-white text-lg"></i>
                                                    @elseif($maintenance->status === 'dalam_proses')
                                                        <i class="fas fa-cog fa-spin text-white text-lg"></i>
                                                    @elseif($maintenance->status === 'dibatalkan')
                                                        <i class="fas fa-times-circle text-white text-lg"></i>
                                                    @else
                                                        <i class="fas fa-clock text-white text-lg"></i>
                                                    @endif
                                                </div>
                                                
                                                <!-- Title & Date -->
                                                <div class="flex-1 min-w-0">
                                                    <h4 class="font-bold text-gray-900 dark:text-gray-100 text-base mb-1.5">
                                                        {{ ucfirst(str_replace('_', ' ', $maintenance->jenis_maintenance ?? 'Maintenance')) }}
                                                    </h4>
                                                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-gray-600 dark:text-gray-400">
                                                        <span class="flex items-center">
                                                            <i class="fas fa-calendar-alt mr-1.5"></i>
                                                            {{ $maintenance->tanggal ? $maintenance->tanggal->format('d M Y') : $maintenance->created_at->format('d M Y') }}
                                                        </span>
                                                        <span class="flex items-center">
                                                            <i class="fas fa-clock mr-1.5"></i>
                                                            {{ $maintenance->tanggal ? $maintenance->tanggal->format('H:i') : $maintenance->created_at->format('H:i') }}
                                                        </span>
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md font-bold
                                                            @if($maintenance->status === 'selesai') bg-white dark:bg-gray-800 text-emerald-700 dark:text-emerald-400 border border-emerald-300 dark:border-emerald-700
                                                            @elseif($maintenance->status === 'dalam_proses') bg-white dark:bg-gray-800 text-amber-700 dark:text-amber-400 border border-amber-300 dark:border-amber-700
                                                            @elseif($maintenance->status === 'dibatalkan') bg-white dark:bg-gray-800 text-red-700 dark:text-red-400 border border-red-300 dark:border-red-700
                                                            @else bg-white dark:bg-gray-800 text-slate-700 dark:text-slate-400 border border-slate-300 dark:border-slate-600 @endif">
                                                            @if($maintenance->status === 'selesai')
                                                                <i class="fas fa-check mr-1"></i>
                                                            @elseif($maintenance->status === 'dalam_proses')
                                                                <i class="fas fa-spinner fa-spin mr-1"></i>
                                                            @elseif($maintenance->status === 'dibatalkan')
                                                                <i class="fas fa-ban mr-1"></i>
                                                            @endif
                                                            {{ ucfirst(str_replace('_', ' ', $maintenance->status)) }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Right: Unit Badge -->
                                            <div class="flex flex-col items-end gap-2 flex-shrink-0">
                                                <span class="inline-block px-3 py-1.5 rounded-lg text-xs font-bold
                                                    @if($maintenance->status === 'selesai') bg-emerald-500 text-white
                                                    @elseif($maintenance->status === 'dalam_proses') bg-amber-500 text-white
                                                    @elseif($maintenance->status === 'dibatalkan') bg-red-500 text-white
                                                    @else bg-slate-500 text-white @endif">
                                                    {{ $maintenance->jumlah ?? 1 }} Unit
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Details Section -->
                                    <div class="p-4 space-y-2.5">
                                        @if($maintenance->deskripsi)
                                            <div class="bg-gray-50 dark:bg-gray-800/50 rounded-lg p-3 border border-gray-200 dark:border-gray-700">
                                                <div class="flex items-start">
                                                    <i class="fas fa-file-alt text-gray-500 dark:text-gray-400 mt-1 mr-2 text-sm"></i>
                                                    <div class="flex-1">
                                                        <div class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Deskripsi</div>
                                                        <div class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">{{ $maintenance->deskripsi }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <div class="grid grid-cols-2 gap-2">
                                            @if($maintenance->teknisi)
                                                <div class="bg-blue-50 dark:bg-blue-900/30 rounded-lg p-2.5 border border-blue-200 dark:border-blue-700">
                                                    <div class="flex items-center">
                                                        <i class="fas fa-user-cog text-blue-600 dark:text-blue-400 text-sm mr-2"></i>
                                                        <div>
                                                            <div class="text-xs text-blue-600 dark:text-blue-400">Teknisi</div>
                                                            <div class="text-sm font-semibold text-blue-900 dark:text-blue-300">{{ $maintenance->teknisi }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            
                                            @if($maintenance->biaya && $maintenance->biaya > 0)
                                                <div class="bg-green-50 dark:bg-green-900/30 rounded-lg p-2.5 border border-green-200 dark:border-green-700">
                                                    <div class="flex items-center">
                                                        <i class="fas fa-money-bill-wave text-green-600 dark:text-green-400 text-sm mr-2"></i>
                                                        <div>
                                                            <div class="text-xs text-green-600 dark:text-green-400">Biaya</div>
                                                            <div class="text-sm font-bold text-green-700 dark:text-green-300">Rp {{ number_format($maintenance->biaya, 0, ',', '.') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        @if($maintenance->catatan_penyelesaian)
                                            <div class="bg-emerald-50 dark:bg-emerald-900/30 rounded-lg p-3 border border-emerald-200 dark:border-emerald-700">
                                                <div class="flex items-start">
                                                    <i class="fas fa-check-double text-emerald-600 dark:text-emerald-400 text-sm mt-1 mr-2"></i>
                                                    <div class="flex-1">
                                                        <div class="text-xs font-bold text-emerald-700 dark:text-emerald-400 mb-1">Catatan Penyelesaian</div>
                                                        <div class="text-sm text-emerald-800 dark:text-emerald-300 leading-relaxed">{{ $maintenance->catatan_penyelesaian }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Button Selesaikan Maintenance --}}
                                        @if($maintenance->status === 'dalam_proses')
                                            <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-700">
                                                <button onclick="completeMaintenanceModal(
                                                    {{ $maintenance->id }}, 
                                                    {{ $maintenance->jumlah }},
                                                    '{{ $maintenance->jenis_maintenance }}'
                                                )" 
                                                class="w-full px-4 py-2.5 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white text-sm font-bold rounded-lg hover:from-emerald-700 hover:to-emerald-800 transition-all shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                                                    <i class="fas fa-check-circle"></i>
                                                    <span>Selesaikan Maintenance</span>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Current Loans -->
                @if($barang->peminjamanDetails->where('peminjaman.status', 'disetujui')->count() > 0)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.8s">
                        <div class="flex items-center mb-6">
                            <div class="p-2 bg-amber-100 dark:bg-amber-900/30 rounded-lg mr-3">
                                <i class="fas fa-clock text-amber-600 dark:text-amber-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Sedang Dipinjam</h3>
                        </div>
                        
                        <div class="space-y-3">
                            @foreach($barang->peminjamanDetails->where('peminjaman.status', 'disetujui')->take(3) as $detail)
                                <div class="p-3 bg-amber-50 dark:bg-amber-900/30 rounded-lg border border-amber-200 dark:border-amber-700">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="font-medium text-amber-900 dark:text-amber-300">
                                            {{ $detail->peminjaman->user->name }}
                                        </div>
                                        <span class="text-xs bg-amber-200 dark:bg-amber-800 text-amber-800 dark:text-amber-300 px-2 py-1 rounded-full font-medium">
                                            {{ $detail->jumlah }} unit
                                        </span>
                                    </div>
                                    <div class="text-xs text-amber-700 dark:text-amber-400">
                                        {{ $detail->peminjaman->tanggal_mulai->format('d M Y') }} - 
                                        {{ $detail->peminjaman->tanggal_selesai->format('d M Y') }}
                                    </div>
                                    <div class="text-xs text-amber-600 dark:text-amber-400 mt-1">
                                        {{ $detail->peminjaman->keperluan }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Quick Actions -->
                <div class="bg-gradient-to-br from-slate-50 to-gray-100 dark:from-slate-800 dark:to-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600 card-hover animate-slide-up" style="animation-delay: 0.9s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                            <i class="fas fa-bolt text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Aksi Cepat</h3>
                    </div>
                    
                    <div class="space-y-3">
                        <a href="{{ route('admin.barang.edit', $barang->id) }}"
                           class="action-btn w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium text-sm rounded-xl hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl group">
                            <i class="fas fa-edit mr-2 group-hover:scale-110 transition-transform"></i>
                            Edit Informasi Barang
                        </a>
                        
                        <button type="button" 
                                onclick="openQRModal('{{ $barang->kode_barang }}', '{{ $barang->nama_barang }}')"
                                class="action-btn w-full flex items-center justify-center px-4 py-3 bg-white dark:bg-gray-800 text-slate-600 dark:text-slate-300 font-medium text-sm border border-slate-300 dark:border-slate-600 rounded-xl hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-slate-800 dark:hover:text-slate-200 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition-all duration-200 group">
                            <i class="fas fa-qrcode mr-2 group-hover:scale-110 transition-transform"></i>
                            Generate QR Code
                        </button>
                    </div>
                </div>

                <!-- System Info -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 1.0s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg mr-3">
                            <i class="fas fa-info-circle text-gray-600 dark:text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Sistem</h3>
                    </div>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">ID Barang:</span>
                            <span class="font-mono text-slate-600 dark:text-slate-300 font-semibold">#{{ $barang->id }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">Kode Barang:</span>
                            <span class="font-mono text-slate-600 dark:text-slate-300 font-semibold">{{ $barang->kode_barang }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">Dapat Dipinjam:</span>
                            <span class="font-semibold {{ $barang->dapat_dipinjam ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-600 dark:text-red-400' }}">
                                @if($barang->dapat_dipinjam)
                                    <i class="fas fa-check-circle mr-1"></i>Ya
                                @else
                                    <i class="fas fa-times-circle mr-1"></i>Tidak
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">Dibuat:</span>
                            <span class="text-slate-600 dark:text-slate-300">{{ $barang->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">Terakhir Update:</span>
                            <span class="text-slate-600 dark:text-slate-300">{{ $barang->updated_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">Kategori ID:</span>
                            <span class="font-mono text-slate-600 dark:text-slate-300 font-semibold">#{{ $barang->kategori_id }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-500 dark:text-gray-400">Total Peminjaman:</span>
                            <span class="text-slate-600 dark:text-slate-300 font-semibold">{{ $barang->peminjamanDetails->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Maintenance Modal -->
    @include('admin.barang.partials.maintenance-modal', ['barang' => $barang])

    <!-- QR Code Modal -->
    <div id="qrModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('qrModal')">&times;</span>
            <div class="flex items-center mb-6">
                <div class="p-3 bg-slate-100 dark:bg-slate-700 rounded-lg mr-3">
                    <i class="fas fa-qrcode text-slate-600 dark:text-slate-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">QR Code Barang</h3>
            </div>
            
            <div class="text-center">
                <div class="mb-4 p-4 bg-slate-50 dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-600">
                    <p class="text-sm text-slate-800 dark:text-slate-300 mb-2 font-medium">QR Code untuk:</p>
                    <p id="qrItemName" class="font-semibold text-slate-900 dark:text-slate-100"></p>
                    <p id="qrItemCode" class="text-xs text-slate-600 dark:text-slate-400 font-mono mt-1"></p>
                </div>
                
                <div id="qrCodeContainer" class="mb-6 flex justify-center"></div>
                
                <div class="flex space-x-3 justify-center">
                    <button onclick="downloadQR()" 
                            class="px-4 py-2 text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-lg font-medium transition-all shadow-md hover:shadow-lg">
                        <i class="fas fa-download mr-2"></i>Download
                    </button>
                    <button onclick="printQR()" 
                            class="px-4 py-2 text-slate-600 dark:text-slate-300 bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 rounded-lg font-medium transition-all">
                        <i class="fas fa-print mr-2"></i>Print
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Foto Modal -->
    <div id="uploadFotoModal" class="modal hidden">
        <div class="modal-content" style="max-width: 600px;">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="p-3 bg-purple-100 dark:bg-purple-900/30 rounded-lg mr-3">
                        <i class="fas fa-upload text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Upload Foto Barang</h3>
                </div>
                <button onclick="closeUploadModal()" 
                        class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="uploadFotoForm" enctype="multipart/form-data">
                @csrf
                
                <!-- Drag & Drop Area -->
                <div id="dropZone" 
                     class="border-3 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 text-center mb-4 transition-all hover:border-purple-400 dark:hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 cursor-pointer">
                    <input type="file" 
                           id="fotoInput" 
                           name="foto" 
                           accept="image/jpeg,image/png,image/jpg,image/gif"
                           class="hidden"
                           onchange="previewFoto(this)">
                    
                    <div id="dropZoneContent">
                        <i class="fas fa-cloud-upload-alt text-5xl text-gray-400 dark:text-gray-500 mb-4"></i>
                        <p class="text-gray-700 dark:text-gray-300 font-medium mb-2">Klik atau drag & drop foto di sini</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Format: JPG, PNG, GIF (Maks: 2MB)</p>
                    </div>
                    
                    <!-- Preview -->
                    <div id="previewContainer" class="hidden">
                        <img id="previewImage" src="" alt="Preview" class="max-h-64 mx-auto rounded-lg shadow-md mb-3">
                        <button type="button" 
                                onclick="resetUpload()" 
                                class="text-sm text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 font-medium">
                            <i class="fas fa-times-circle mr-1"></i>
                            Ganti Foto
                        </button>
                    </div>
                </div>
                
                <!-- Keterangan -->
                <div class="mb-6">
                    <label for="keteranganFoto" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Keterangan Foto (Opsional)
                    </label>
                    <input type="text" 
                           id="keteranganFoto" 
                           name="keterangan" 
                           placeholder="Misal: Tampak depan, detail produk, dll..."
                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
                
                <!-- Progress Bar -->
                <div id="uploadProgress" class="hidden mb-4">
                    <div class="flex items-center justify-between text-sm text-gray-700 dark:text-gray-300 mb-2">
                        <span>Uploading...</span>
                        <span id="progressText">0%</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div id="progressBar" class="bg-purple-600 h-2 rounded-full transition-all" style="width: 0%"></div>
                    </div>
                </div>
                
                <!-- Buttons -->
                <div class="flex justify-end gap-3">
                    <button type="button" 
                            onclick="closeUploadModal()" 
                            class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-medium transition-all">
                        Batal
                    </button>
                    <button type="submit" 
                            id="uploadBtn"
                            class="px-6 py-3 text-white bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all">
                        <i class="fas fa-upload mr-2"></i>
                        Upload Foto
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Keterangan Modal -->
    <div id="editKeteranganModal" class="modal hidden">
        <div class="modal-content" style="max-width: 500px;">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-lg mr-3">
                        <i class="fas fa-edit text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Edit Keterangan Foto</h3>
                </div>
                <button onclick="closeEditKeteranganModal()" 
                        class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="editKeteranganForm">
                @csrf
                <input type="hidden" id="editFotoId" name="foto_id">
                
                <div class="mb-6">
                    <label for="editKeterangan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Keterangan Baru
                    </label>
                    <input type="text" 
                           id="editKeterangan" 
                           name="keterangan" 
                           placeholder="Masukkan keterangan foto..."
                           class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div class="flex justify-end gap-3">
                    <button type="button" 
                            onclick="closeEditKeteranganModal()" 
                            class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-medium transition-all">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-6 py-3 text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all">
                        <i class="fas fa-save mr-2"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightboxModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/95" onclick="closeLightbox()"></div>
        
        <div class="relative h-full flex items-center justify-center p-4">
            <!-- Close Button -->
            <button onclick="closeLightbox()" 
                    class="absolute top-4 right-4 p-3 bg-white/10 backdrop-blur-sm text-white rounded-full hover:bg-white/20 transition-all z-10">
                <i class="fas fa-times text-xl"></i>
            </button>
            
            <!-- Navigation -->
            <button id="prevBtn" 
                    onclick="lightboxPrev()" 
                    class="absolute left-4 p-4 bg-white/10 backdrop-blur-sm text-white rounded-full hover:bg-white/20 transition-all z-10">
                <i class="fas fa-chevron-left text-2xl"></i>
            </button>
            
            <button id="nextBtn" 
                    onclick="lightboxNext()" 
                    class="absolute right-4 p-4 bg-white/10 backdrop-blur-sm text-white rounded-full hover:bg-white/20 transition-all z-10">
                <i class="fas fa-chevron-right text-2xl"></i>
            </button>
            
            <!-- Image Container -->
            <div class="max-w-6xl max-h-full">
                <img id="lightboxImage" 
                     src="" 
                     alt="" 
                     class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl">
                
                <!-- Caption -->
                <div id="lightboxCaption" class="mt-4 text-center text-white text-lg"></div>
                
                <!-- Counter -->
                <div id="lightboxCounter" class="mt-2 text-center text-gray-400 text-sm"></div>
            </div>
        </div>
    </div>

    <!-- ✅ COMPLETE MAINTENANCE MODAL -->
    <div id="complete-maintenance-modal" class="fixed inset-0 modal-backdrop overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border-0 w-11/12 max-w-md shadow-2xl rounded-xl bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg mr-3">
                            <i class="fas fa-check-circle text-emerald-600 dark:text-emerald-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Selesaikan Maintenance</h3>
                    </div>
                    <button onclick="closeCompleteMaintenanceModal()" 
                            class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <form id="complete-maintenance-form" method="POST" action="">
                    @csrf
                    <input type="hidden" name="maintenance_id" id="maintenance-id-input">
                    
                    <div class="mb-4 p-4 bg-emerald-50 dark:bg-emerald-900/30 rounded-lg border border-emerald-200 dark:border-emerald-700">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-emerald-700 dark:text-emerald-400">Unit yang di-maintenance:</span>
                            <span id="maintenance-unit-count" class="font-bold text-emerald-900 dark:text-emerald-300"></span>
                        </div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-emerald-700 dark:text-emerald-400">Jenis Maintenance:</span>
                            <span id="maintenance-jenis" class="font-semibold text-emerald-800 dark:text-emerald-300"></span>
                        </div>
                        <p class="text-xs text-emerald-600 dark:text-emerald-400 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Unit akan dikembalikan ke stok tersedia
                        </p>
                    </div>

                    <div class="mb-6">
                        <label for="catatan-selesai" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Catatan Penyelesaian <span class="text-gray-400 dark:text-gray-500">(Opsional)</span>
                        </label>
                        <textarea name="catatan" 
                                  id="catatan-selesai" 
                                  rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 resize-none transition-all"
                                  placeholder="Hasil maintenance, kondisi barang setelah perbaikan, suku cadang yang diganti, dll..."></textarea>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            <i class="fas fa-lightbulb mr-1"></i>
                            Contoh: "Sudah diganti bearing dan dibersihkan motor. Kondisi baik dan siap digunakan."
                        </p>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeCompleteMaintenanceModal()" 
                                class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-medium transition-all">
                            Batal
                        </button>
                        <button type="submit" 
                                id="complete-submit-btn"
                                class="px-6 py-3 text-white bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all">
                            <i class="fas fa-check-circle mr-2"></i>
                            Selesaikan Maintenance
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
<script>
// ==========================================
// GLOBAL VARIABLES
// ==========================================
let lightboxFotos = [];
let currentLightboxIndex = 0;

// ==========================================
// MAINTENANCE MODAL FUNCTIONS
// ==========================================

function showMaintenanceModal(barangId) {
    const modal = document.getElementById(`maintenance-modal-${barangId}`);
    if (modal) {
        modal.classList.remove('hidden');
        const form = document.getElementById(`form-maintenance-${barangId}`);
        if (form) form.reset();
        
        const jumlahInput = document.getElementById(`jumlah-${barangId}`);
        if (jumlahInput) jumlahInput.value = 1;
        
        updateMaintenancePreview(barangId);
    }
}

function closeMaintenanceModal(barangId) {
    const modal = document.getElementById(`maintenance-modal-${barangId}`);
    if (modal) {
        modal.classList.add('hidden');
    }
}

function setQuickAmount(barangId, amount) {
    const input = document.getElementById(`jumlah-${barangId}`);
    if (input) {
        input.value = amount;
        updateMaintenancePreview(barangId);
    }
}

function updateMaintenancePreview(barangId) {
    const input = document.getElementById(`jumlah-${barangId}`);
    const preview = document.getElementById(`preview-${barangId}`);
    const previewValue = document.getElementById(`preview-value-${barangId}`);
    
    if (input && preview && previewValue) {
        const max = parseInt(input.getAttribute('max'));
        const value = parseInt(input.value) || 0;
        const remaining = max - value;
        
        previewValue.textContent = remaining;
        
        if (value > 0) {
            preview.classList.remove('hidden');
            
            if (remaining === 0) {
                preview.className = 'mb-4 p-3 bg-red-50 dark:bg-red-900/30 rounded-lg border border-red-200 dark:border-red-700';
                preview.querySelector('span').className = 'text-red-800 dark:text-red-300';
            } else if (remaining < 5) {
                preview.className = 'mb-4 p-3 bg-yellow-50 dark:bg-yellow-900/30 rounded-lg border border-yellow-200 dark:border-yellow-700';
                preview.querySelector('span').className = 'text-yellow-800 dark:text-yellow-300';
            } else {
                preview.className = 'mb-4 p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg border border-blue-200 dark:border-blue-700';
                preview.querySelector('span').className = 'text-blue-800 dark:text-blue-300';
            }
        } else {
            preview.classList.add('hidden');
        }
    }
}

function validateMaintenanceForm(barangId) {
    const jumlah = parseInt(document.getElementById(`jumlah-${barangId}`).value);
    const deskripsi = document.getElementById(`deskripsi-${barangId}`).value.trim();
    const jenisMaintenance = document.getElementById(`jenis_maintenance-${barangId}`).value;
    
    if (!jumlah || jumlah < 1) {
        alert('❌ Jumlah unit harus minimal 1');
        return false;
    }
    
    if (!jenisMaintenance) {
        alert('❌ Pilih jenis maintenance terlebih dahulu');
        return false;
    }
    
    if (!deskripsi || deskripsi.length < 10) {
        alert('❌ Deskripsi maintenance minimal 10 karakter');
        return false;
    }
    
    const confirmed = confirm(
        `⚠️ KONFIRMASI MAINTENANCE\n\n` +
        `Jumlah: ${jumlah} unit\n` +
        `Jenis: ${jenisMaintenance}\n\n` +
        `Lanjutkan?`
    );
    
    if (confirmed) {
        const submitBtn = event.target.querySelector('button[type="submit"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
        }
    }
    
    return confirmed;
}

// ==========================================
// COMPLETE MAINTENANCE MODAL FUNCTIONS
// ==========================================

function completeMaintenanceModal(maintenanceId, jumlahUnit, jenisMaintenance = '') {
    console.log('🔧 Opening complete maintenance modal:', {
        maintenanceId,
        jumlahUnit,
        jenisMaintenance
    });
    
    // Set values ke form
    document.getElementById('maintenance-id-input').value = maintenanceId;
    document.getElementById('maintenance-unit-count').textContent = jumlahUnit + ' unit';
    document.getElementById('maintenance-jenis').textContent = jenisMaintenance ? 
        jenisMaintenance.charAt(0).toUpperCase() + jenisMaintenance.slice(1) : '-';
    
    // Set action URL ke route activate
    const barangId = '{{ $barang->id }}';
    document.getElementById('complete-maintenance-form').action = 
        `/admin/barang/${barangId}/activate`;
    
    // Reset form
    document.getElementById('catatan-selesai').value = '';
    
    // Show modal
    document.getElementById('complete-maintenance-modal').classList.remove('hidden');
}

function closeCompleteMaintenanceModal() {
    document.getElementById('complete-maintenance-modal').classList.add('hidden');
    document.getElementById('complete-maintenance-form').reset();
}

// ==========================================
// MODAL FUNCTIONS (QR)
// ==========================================

function openQRModal(code, itemName) {
    document.getElementById('qrItemName').textContent = itemName;
    document.getElementById('qrItemCode').textContent = code;
    
    try {
        const qr = new QRious({
            element: document.createElement('canvas'),
            value: code,
            size: 200,
            background: 'white',
            foreground: '#1e293b'
        });
        
        const container = document.getElementById('qrCodeContainer');
        container.innerHTML = '';
        container.appendChild(qr.canvas);
    } catch (error) {
        console.error('QR Code generation failed:', error);
        document.getElementById('qrCodeContainer').innerHTML = '<p class="text-red-500 dark:text-red-400">Gagal membuat QR Code</p>';
    }
    
    document.getElementById('qrModal').classList.add('show');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.remove('show');
}

// ==========================================
// QR CODE FUNCTIONS
// ==========================================

function downloadQR() {
    try {
        const canvas = document.querySelector('#qrCodeContainer canvas');
        if (canvas) {
            const link = document.createElement('a');
            link.download = `qr-${document.getElementById('qrItemCode').textContent}.png`;
            link.href = canvas.toDataURL();
            link.click();
        }
    } catch (error) {
        console.error('Download failed:', error);
        alert('Gagal mendownload QR Code');
    }
}

function printQR() {
    try {
        const canvas = document.querySelector('#qrCodeContainer canvas');
        if (canvas) {
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>QR Code - ${document.getElementById('qrItemName').textContent}</title>
                        <style>
                            body { text-align: center; font-family: Arial, sans-serif; padding: 20px; }
                            h1 { color: #1e293b; margin-bottom: 10px; }
                            .code { font-family: monospace; color: #64748b; margin-bottom: 20px; }
                        </style>
                    </head>
                    <body>
                        <h1>${document.getElementById('qrItemName').textContent}</h1>
                        <div class="code">${document.getElementById('qrItemCode').textContent}</div>
                        <img src="${canvas.toDataURL()}" alt="QR Code">
                    </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        }
    } catch (error) {
        console.error('Print failed:', error);
        alert('Gagal mencetak QR Code');
    }
}

// ==========================================
// FOTO GALLERY FUNCTIONS
// ==========================================

function openUploadModal() {
    document.getElementById('uploadFotoModal').classList.remove('hidden');
    document.getElementById('uploadFotoModal').classList.add('show');
    resetUpload();
}

function closeUploadModal() {
    document.getElementById('uploadFotoModal').classList.remove('show');
    document.getElementById('uploadFotoModal').classList.add('hidden');
    document.getElementById('uploadFotoForm').reset();
    resetUpload();
}

function previewFoto(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        if (!file.type.match('image.*')) {
            alert('❌ File harus berupa gambar!');
            return;
        }
        
        if (file.size > 2048000) {
            alert('❌ Ukuran file maksimal 2MB!');
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImage').src = e.target.result;
            document.getElementById('dropZoneContent').classList.add('hidden');
            document.getElementById('previewContainer').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
}

function resetUpload() {
    document.getElementById('fotoInput').value = '';
    document.getElementById('dropZoneContent').classList.remove('hidden');
    document.getElementById('previewContainer').classList.add('hidden');
    document.getElementById('uploadProgress').classList.add('hidden');
    document.getElementById('progressBar').style.width = '0%';
    document.getElementById('progressText').textContent = '0%';
}

// Drag & Drop functionality
const dropZone = document.getElementById('dropZone');

if (dropZone) {
    dropZone.addEventListener('click', function() {
        document.getElementById('fotoInput').click();
    });

    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.classList.add('border-purple-500', 'bg-purple-50');
    });

    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.classList.remove('border-purple-500', 'bg-purple-50');
    });

    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
        this.classList.remove('border-purple-500', 'bg-purple-50');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            document.getElementById('fotoInput').files = files;
            previewFoto(document.getElementById('fotoInput'));
        }
    });
}

// Upload Form Submit
const uploadForm = document.getElementById('uploadFotoForm');
if (uploadForm) {
    uploadForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const uploadBtn = document.getElementById('uploadBtn');
        const progressDiv = document.getElementById('uploadProgress');
        const progressBar = document.getElementById('progressBar');
        const progressText = document.getElementById('progressText');
        
        if (!document.getElementById('fotoInput').files[0]) {
            alert('❌ Pilih foto terlebih dahulu!');
            return;
        }
        
        uploadBtn.disabled = true;
        uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Uploading...';
        progressDiv.classList.remove('hidden');
        
        let progress = 0;
        const interval = setInterval(() => {
            progress += 10;
            progressBar.style.width = progress + '%';
            progressText.textContent = progress + '%';
            if (progress >= 90) clearInterval(interval);
        }, 100);
        
        fetch(`/admin/barang/{{ $barang->id }}/foto`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            clearInterval(interval);
            progressBar.style.width = '100%';
            progressText.textContent = '100%';
            
            if (data.success) {
                showNotification('success', 'Foto berhasil diupload!');
                setTimeout(() => location.reload(), 1000);
            } else {
                throw new Error(data.message || 'Upload gagal');
            }
        })
        .catch(error => {
            console.error('Upload error:', error);
            showNotification('error', '❌ ' + error.message);
            uploadBtn.disabled = false;
            uploadBtn.innerHTML = '<i class="fas fa-upload mr-2"></i>Upload Foto';
            progressDiv.classList.add('hidden');
        });
    });
}

// Set Primary Foto
function setPrimaryFoto(fotoId) {
    if (!confirm('⭐ Set foto ini sebagai foto utama?')) return;
    
    fetch(`/admin/barang/{{ $barang->id }}/foto/${fotoId}/set-primary`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('success', 'Foto utama berhasil diubah!');
            setTimeout(() => location.reload(), 1000);
        } else {
            throw new Error(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('error', '❌ ' + error.message);
    });
}

// Edit Keterangan
function editKeteranganFoto(fotoId, currentKeterangan) {
    document.getElementById('editFotoId').value = fotoId;
    document.getElementById('editKeterangan').value = currentKeterangan || '';
    document.getElementById('editKeteranganModal').classList.remove('hidden');
    document.getElementById('editKeteranganModal').classList.add('show');
}

function closeEditKeteranganModal() {
    document.getElementById('editKeteranganModal').classList.remove('show');
    document.getElementById('editKeteranganModal').classList.add('hidden');
}

// Update Keterangan
const editKeteranganForm = document.getElementById('editKeteranganForm');
if (editKeteranganForm) {
    editKeteranganForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const fotoId = document.getElementById('editFotoId').value;
        const keterangan = document.getElementById('editKeterangan').value;
        
        fetch(`/admin/barang/{{ $barang->id }}/foto/${fotoId}/keterangan`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ keterangan })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('success', 'Keterangan berhasil diupdate!');
                closeEditKeteranganModal();
                setTimeout(() => location.reload(), 1000);
            } else {
                throw new Error(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('error', '❌ ' + error.message);
        });
    });
}

// Delete Foto
function deleteFoto(fotoId) {
    if (!confirm('⚠️ Yakin ingin menghapus foto ini?\nTindakan ini tidak dapat dibatalkan!')) return;
    
    fetch(`/admin/barang/{{ $barang->id }}/foto/${fotoId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('success', 'Foto berhasil dihapus!');
            setTimeout(() => location.reload(), 1000);
        } else {
            throw new Error(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('error', '❌ ' + error.message);
    });
}

// Lightbox Functions
function openLightbox(fotoIds, currentId) {
    console.log('🔍 Opening lightbox for foto ID:', currentId);
    console.log('📸 All foto IDs:', fotoIds);
    
    fetch(`/admin/barang/{{ $barang->id }}/foto`, {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => {
        console.log('📡 Response status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('📦 Response data:', data);
        
        if (data.success) {
            lightboxFotos = data.fotos;
            currentLightboxIndex = lightboxFotos.findIndex(f => f.id === currentId);
            
            console.log('✅ Lightbox opened successfully');
            console.log('📸 Total fotos:', lightboxFotos.length);
            console.log('🎯 Current index:', currentLightboxIndex);
            
            updateLightbox();
            document.getElementById('lightboxModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        } else {
            console.error('❌ Response not successful:', data);
            alert('❌ Gagal memuat foto: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('❌ Fetch error:', error);
        alert('❌ Error loading photos: ' + error.message);
    });
}

function closeLightbox() {
    document.getElementById('lightboxModal').classList.add('hidden');
    document.body.style.overflow = '';
}

function lightboxPrev() {
    currentLightboxIndex = (currentLightboxIndex - 1 + lightboxFotos.length) % lightboxFotos.length;
    updateLightbox();
}

function lightboxNext() {
    currentLightboxIndex = (currentLightboxIndex + 1) % lightboxFotos.length;
    updateLightbox();
}

function updateLightbox() {
    const foto = lightboxFotos[currentLightboxIndex];
    document.getElementById('lightboxImage').src = foto.url;
    document.getElementById('lightboxCaption').textContent = foto.keterangan || '{{ $barang->nama_barang }}';
    document.getElementById('lightboxCounter').textContent = `${currentLightboxIndex + 1} / ${lightboxFotos.length}`;
    
    document.getElementById('prevBtn').style.display = lightboxFotos.length > 1 ? 'block' : 'none';
    document.getElementById('nextBtn').style.display = lightboxFotos.length > 1 ? 'block' : 'none';
}

// ==========================================
// NOTIFICATION FUNCTIONS
// ==========================================

function hideNotification() {
    const notification = document.getElementById('notification');
    if (notification) {
        notification.style.animation = 'slideOutRight 0.5s ease-in forwards';
        setTimeout(() => {
            notification.remove();
        }, 500);
    }
}

// Notification Helper
function showNotification(type, message) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 notification ${type} bg-white/90 dark:bg-gray-800/90 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 p-4 max-w-sm`;
    
    const iconClass = type === 'success' ? 'fa-check-circle text-green-600 dark:text-green-400' : 'fa-exclamation-circle text-red-600 dark:text-red-400';
    const bgClass = type === 'success' ? 'bg-green-100 dark:bg-green-900/30' : 'bg-red-100 dark:bg-red-900/30';
    
    notification.innerHTML = `
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <div class="p-2 ${bgClass} rounded-lg">
                    <i class="fas ${iconClass}"></i>
                </div>
            </div>
            <div class="ml-3">
                <p class="text-sm text-gray-800 dark:text-gray-200 font-medium">${message}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" 
                    class="ml-auto text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-1 rounded transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.5s ease-in forwards';
        setTimeout(() => notification.remove(), 500);
    }, 5000);
}

// ==========================================
// EVENT LISTENERS
// ==========================================

document.addEventListener('DOMContentLoaded', function() {
    // Character counter untuk deskripsi maintenance
    document.querySelectorAll('[id^="deskripsi-"]').forEach(textarea => {
        const barangId = textarea.id.replace('deskripsi-', '');
        const counter = document.getElementById(`char-count-${barangId}`);
        
        if (counter) {
            textarea.addEventListener('input', function() {
                counter.textContent = this.value.length;
                
                if (this.value.length < 10) {
                    counter.className = 'text-red-600 dark:text-red-400 font-semibold';
                } else {
                    counter.className = 'text-green-600 dark:text-green-400 font-semibold';
                }
            });
        }
    });
    
    // Validasi input jumlah maintenance
    document.querySelectorAll('[id^="jumlah-"]').forEach(input => {
        input.addEventListener('input', function() {
            const max = parseInt(this.getAttribute('max'));
            const value = parseInt(this.value);
            
            if (value > max) {
                this.value = max;
                alert(`⚠️ Maksimal ${max} unit yang tersedia`);
            }
            
            if (value < 1 && this.value !== '') {
                this.value = 1;
            }
        });
        
        input.addEventListener('change', function() {
            const barangId = this.id.replace('jumlah-', '');
            updateMaintenancePreview(barangId);
        });
    });
    
    // Complete Maintenance Form Submit Handler
    const completeForm = document.getElementById('complete-maintenance-form');
    
    if (completeForm) {
        completeForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const maintenanceId = document.getElementById('maintenance-id-input').value;
            const catatan = document.getElementById('catatan-selesai').value.trim();
            const jumlah = document.getElementById('maintenance-unit-count').textContent;
            
            // Konfirmasi
            if (!confirm(
                `✅ SELESAIKAN MAINTENANCE?\n\n` +
                `${jumlah} akan dikembalikan ke stok tersedia.\n` +
                `${catatan ? '\nCatatan: ' + catatan.substring(0, 50) + '...' : ''}\n\n` +
                `Lanjutkan?`
            )) {
                return;
            }
            
            const submitBtn = document.getElementById('complete-submit-btn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
            
            // Gunakan FormData untuk POST request standard
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        throw new Error(err.message || 'Terjadi kesalahan server');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showNotification('success', 'Maintenance berhasil diselesaikan!');
                    closeCompleteMaintenanceModal();
                    setTimeout(() => location.reload(), 1500);
                } else {
                    throw new Error(data.message || 'Gagal menyelesaikan maintenance');
                }
            })
            .catch(error => {
                console.error('Complete maintenance error:', error);
                showNotification('error', '❌ ' + error.message);
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-check-circle mr-2"></i>Selesaikan Maintenance';
            });
        });
    }
    
    // Auto hide notifications
    @if(session('success') || session('error'))
    setTimeout(() => {
        hideNotification();
    }, 5000);
    @endif
});

// Keyboard navigation for lightbox
document.addEventListener('keydown', function(e) {
    const lightboxModal = document.getElementById('lightboxModal');
    if (!lightboxModal || lightboxModal.classList.contains('hidden')) {
        // Close complete maintenance modal on ESC
        if (e.key === 'Escape') {
            closeCompleteMaintenanceModal();
            
            // Close maintenance modals
            document.querySelectorAll('[id^="maintenance-modal-"]').forEach(modal => {
                modal.classList.add('hidden');
            });
            
            // Close other modals
            const modals = document.querySelectorAll('.modal.show');
            modals.forEach(modal => {
                modal.classList.remove('show');
            });
        }
        return;
    }
    
    if (e.key === 'ArrowLeft') {
        lightboxPrev();
    } else if (e.key === 'ArrowRight') {
        lightboxNext();
    } else if (e.key === 'Escape') {
        closeLightbox();
    }
});

// Close modal on backdrop click
document.addEventListener('click', function(event) {
    // Close maintenance modal
    if (event.target.id && event.target.id.startsWith('maintenance-modal-')) {
        event.target.classList.add('hidden');
    }
    
    // Close complete maintenance modal
    const completeModal = document.getElementById('complete-maintenance-modal');
    if (event.target === completeModal) {
        closeCompleteMaintenanceModal();
    }
    
    // Close other modals
    const modals = document.querySelectorAll('.modal.show');
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.classList.remove('show');
        }
    });
});

// Dark mode support for modals
if (document.querySelector('.dark')) {
    document.querySelectorAll('.modal-content').forEach(modal => {
        modal.classList.add('dark:bg-gray-800', 'dark:text-gray-100');
    });
}

// Debug log
console.log('✅ Admin Barang Show - JavaScript loaded successfully');
console.log('📸 Foto Gallery system initialized');
console.log('🔧 Complete Maintenance Modal initialized (Using BarangController@activate)');
console.log('🌙 Dark mode support enabled');
</script>
@endpush