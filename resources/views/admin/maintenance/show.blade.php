@extends('layouts.app')

@section('title', 'Detail Maintenance - Admin')

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

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.animate-fade-in { animation: fadeIn 0.4s ease-out !important; }
.animate-slide-up { animation: slideUp 0.3s ease-out !important; }
.animate-pulse-slow { animation: pulse 3s infinite !important; }
.animate-spin { animation: spin 1s linear infinite !important; }

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

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
    backdrop-filter: blur(4px);
}

.modal.show {
    display: block !important;
    animation: fadeIn 0.3s ease-out;
}

.modal-content {
    background-color: white;
    margin: 5% auto;
    padding: 20px;
    border-radius: 12px;
    width: 90%;
    max-width: 500px;
    max-height: 85vh;
    overflow-y: auto;
    animation: slideUp 0.3s ease-out;
}

.dark .modal-content {
    background-color: #1f2937;
}

.modal-backdrop {
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
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

/* Status Badge Animation */
.status-badge {
    animation: fadeIn 0.5s ease-out;
}

/* Timeline Item */
.timeline-item {
    position: relative;
    padding-left: 2rem;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: 0.5rem;
    top: 2rem;
    bottom: -1rem;
    width: 2px;
    background: linear-gradient(to bottom, #e5e7eb, transparent);
}

.dark .timeline-item::before {
    background: linear-gradient(to bottom, #374151, transparent);
}

.timeline-item:last-child::before {
    display: none;
}

/* Notification */
.notification {
    backdrop-filter: blur(10px);
    border-left: 4px solid;
    animation: slideInRight 0.5s ease-out;
}

@keyframes slideInRight {
    from { transform: translateX(20px); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes slideOutRight {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(20px); opacity: 0; }
}

.notification.success { border-left-color: #10b981; }
.notification.error { border-left-color: #ef4444; }
.notification.info { border-left-color: #3b82f6; }
.notification.warning { border-left-color: #f59e0b; }

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
.bg-size-200 {
    background-size: 200% auto;
}

.bg-pos-0 {
    background-position: 0% center;
}

.bg-pos-100 {
    background-position: 100% center;
}

/* Shine Effect */
@keyframes shine {
    0% { left: -100%; }
    100% { left: 100%; }
}

.btn-shine {
    position: relative;
    overflow: hidden;
}

.btn-shine::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.5s;
}

.btn-shine:hover::before {
    left: 100%;
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
                
                <a href="{{ route('admin.maintenance.index') }}" class="breadcrumb-link">
                    <i class="fas fa-tools"></i>
                    <span>Kelola Maintenance</span>
                </a>
                
                <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs"></i>
                
                <span class="breadcrumb-current">
                    <i class="fas fa-wrench"></i>
                    <span>Detail Maintenance #{{ $maintenance->id }}</span>
                </span>
            </div>
        </nav>

        {{-- Modern Header Section --}}
        <div class="mb-8 animate-fade-in">
            <div class="relative overflow-hidden bg-gradient-to-br from-white via-orange-50/30 to-red-50/50 dark:from-gray-800 dark:via-gray-800/95 dark:to-gray-800/90 rounded-2xl shadow-xl border border-white/60 dark:border-gray-700 backdrop-blur-sm">
                
                {{-- Decorative Background Elements --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-orange-400/20 via-red-400/20 to-pink-400/20 dark:from-orange-600/10 dark:via-red-600/10 dark:to-pink-600/10 rounded-full blur-3xl transform translate-x-32 -translate-y-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-amber-400/15 to-orange-400/15 dark:from-amber-600/10 dark:to-orange-600/10 rounded-full blur-2xl transform -translate-x-24 translate-y-24"></div>
                
                {{-- Animated Particles --}}
                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                    <div class="absolute top-10 left-10 w-2 h-2 bg-orange-400 dark:bg-orange-500 rounded-full animate-pulse opacity-60"></div>
                    <div class="absolute top-20 right-20 w-1.5 h-1.5 bg-red-400 dark:bg-red-500 rounded-full animate-pulse opacity-40" style="animation-delay: 0.5s;"></div>
                    <div class="absolute bottom-16 left-1/3 w-1 h-1 bg-amber-400 dark:bg-amber-500 rounded-full animate-pulse opacity-50" style="animation-delay: 1s;"></div>
                </div>
                
                {{-- Content Container --}}
                <div class="relative p-8 lg:p-10">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        
                        {{-- Left Section: Title & Info --}}
                        <div class="flex-1">
                            {{-- Icon Badge --}}
                            <div class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-orange-500/10 to-red-500/10 dark:from-orange-600/20 dark:to-red-600/20 border border-orange-200/50 dark:border-orange-700/50 rounded-full mb-4">
                                <div class="w-2 h-2 bg-orange-500 dark:bg-orange-400 rounded-full animate-pulse"></div>
                                <span class="text-sm font-semibold text-orange-700 dark:text-orange-300">Maintenance Record</span>
                            </div>
                            
                            {{-- Main Title --}}
                            <h1 class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-orange-800 to-red-800 dark:from-slate-100 dark:via-orange-200 dark:to-red-200 bg-clip-text text-transparent leading-tight">
                                Detail Maintenance
                            </h1>
                            
                            {{-- Description --}}
                            <p class="text-slate-600 dark:text-slate-400 text-lg flex items-center space-x-2 mb-4">
                                <i class="fas fa-info-circle text-orange-500 dark:text-orange-400"></i>
                                <span>
                                    ID: #{{ $maintenance->id }} • 
                                    {{ ucfirst(str_replace('_', ' ', $maintenance->jenis_maintenance)) }} • 
                                    Dibuat {{ $maintenance->created_at->format('d M Y, H:i') }}
                                </span>
                            </p>
                        </div>
                        
                        {{-- Right Section: Status Badge & Actions --}}
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                            <span class="status-badge inline-flex items-center px-6 py-3 rounded-xl text-sm font-semibold border shadow-md
                                @if($maintenance->status === 'selesai') bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/30 dark:to-green-900/30 text-emerald-800 dark:text-emerald-300 border-emerald-200 dark:border-emerald-700
                                @elseif($maintenance->status === 'dalam_proses') bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/30 dark:to-orange-900/30 text-amber-800 dark:text-amber-300 border-amber-200 dark:border-amber-700
                                @elseif($maintenance->status === 'dibatalkan') bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900/30 dark:to-pink-900/30 text-red-800 dark:text-red-300 border-red-200 dark:border-red-700
                                @else bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/30 dark:to-indigo-900/30 text-blue-800 dark:text-blue-300 border-blue-200 dark:border-blue-700
                                @endif">
                                @if($maintenance->status === 'selesai')
                                    <i class="fas fa-check-circle mr-2"></i>
                                @elseif($maintenance->status === 'dalam_proses')
                                    <i class="fas fa-cog fa-spin mr-2"></i>
                                @elseif($maintenance->status === 'dibatalkan')
                                    <i class="fas fa-ban mr-2"></i>
                                @else
                                    <i class="fas fa-clock mr-2"></i>
                                @endif
                                {{ ucfirst(str_replace('_', ' ', $maintenance->status)) }}
                            </span>
                            
                            {{-- Action Buttons - More Lively --}}
                            <div class="flex space-x-2">
                                @if($maintenance->status === 'dalam_proses')
                                    <button onclick="completeMaintenanceModal({{ $maintenance->id }}, {{ $maintenance->jumlah }}, '{{ $maintenance->jenis_maintenance }}')"
                                            class="action-btn inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-emerald-500 via-emerald-600 to-emerald-500 text-white font-semibold text-sm rounded-xl hover:from-emerald-600 hover:via-emerald-700 hover:to-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 hover:scale-105 bg-size-200 bg-pos-0 hover:bg-pos-100 group relative overflow-hidden">
                                        <div class="absolute inset-0 bg-white/20 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                                        <i class="fas fa-check-circle mr-2 group-hover:rotate-12 transition-transform duration-300"></i>
                                        <span class="relative">Selesaikan</span>
                                    </button>
                                @endif
                                
                                @if(in_array($maintenance->status, ['dijadwalkan', 'dalam_proses']))
                                    <button onclick="cancelMaintenanceModal({{ $maintenance->id }})"
                                            class="action-btn inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-red-500 via-red-600 to-red-500 text-white font-semibold text-sm rounded-xl hover:from-red-600 hover:via-red-700 hover:to-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 hover:scale-105 bg-size-200 bg-pos-0 hover:bg-pos-100 group relative overflow-hidden">
                                        <div class="absolute inset-0 bg-white/20 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                                        <i class="fas fa-times-circle mr-2 group-hover:rotate-12 transition-transform duration-300"></i>
                                        <span class="relative">Batalkan</span>
                                    </button>
                                @endif
                                
                                <a href="{{ route('admin.maintenance.edit', $maintenance->id) }}"
                                class="action-btn inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-500 text-white font-semibold text-sm rounded-xl hover:from-blue-600 hover:via-blue-700 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 hover:scale-105 bg-size-200 bg-pos-0 hover:bg-pos-100 group relative overflow-hidden">
                                    <div class="absolute inset-0 bg-white/20 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                                    <i class="fas fa-edit mr-2 group-hover:rotate-12 transition-transform duration-300"></i>
                                    <span class="relative">Edit</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Bottom Accent Line --}}
                <div class="h-1.5 bg-gradient-to-r from-orange-500 via-red-500 to-pink-500"></div>
            </div>
        </div>

        {{-- Main Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Left Column - Main Info --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Barang Information --}}
                @if($maintenance->barang)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.1s">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg mr-3">
                                <i class="fas fa-cube text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Barang</h3>
                        </div>
                        <a href="{{ route('admin.barang.show', $maintenance->barang->id) }}" 
                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 text-white text-sm font-medium rounded-lg hover:from-blue-600 hover:to-blue-700 dark:hover:from-blue-700 dark:hover:to-blue-800 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 group">
                            <i class="fas fa-external-link-alt mr-2 group-hover:scale-110 transition-transform"></i>
                            <span>Lihat Detail</span>
                        </a>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        {{-- Foto Barang --}}
                        @if($maintenance->barang->fotoPrimary)
                            <div class="flex-shrink-0">
                                <img src="{{ $maintenance->barang->fotoPrimary->foto_url }}" 
                                     alt="{{ $maintenance->barang->nama_barang }}"
                                     class="w-24 h-24 object-cover rounded-lg border-2 border-gray-200 dark:border-gray-600">
                            </div>
                        @else
                            <div class="flex-shrink-0 w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center border-2 border-gray-200 dark:border-gray-600">
                                <i class="fas fa-image text-gray-400 dark:text-gray-500 text-2xl"></i>
                            </div>
                        @endif
                        
                        {{-- Info --}}
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                                {{ $maintenance->barang->nama_barang }}
                            </h4>
                            <div class="space-y-2">
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                    <i class="fas fa-barcode w-5 mr-2 text-gray-500 dark:text-gray-500"></i>
                                    <span class="font-mono font-semibold">{{ $maintenance->barang->kode_barang }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                    <i class="fas fa-tag w-5 mr-2 text-gray-500 dark:text-gray-500"></i>
                                    <span>{{ $maintenance->barang->kategori->nama_kategori ?? '-' }}</span>
                                </div>
                                @if($maintenance->barang->merk)
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                    <i class="fas fa-copyright w-5 mr-2 text-gray-500 dark:text-gray-500"></i>
                                    <span>{{ $maintenance->barang->merk }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    {{-- Unit Information --}}
                    <div class="mt-4 p-4 bg-gradient-to-r from-orange-50 to-red-50 dark:from-orange-900/30 dark:to-red-900/30 rounded-xl border border-orange-200 dark:border-orange-700">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="p-2 bg-orange-100 dark:bg-orange-800/50 rounded-lg mr-3">
                                    <i class="fas fa-boxes text-orange-600 dark:text-orange-400"></i>
                                </div>
                                <div>
                                    <div class="text-xs text-orange-600 dark:text-orange-400 mb-1">Unit di Maintenance</div>
                                    <div class="text-2xl font-bold text-orange-800 dark:text-orange-300">
                                        {{ $maintenance->jumlah ?? 1 }} unit
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-xs text-gray-500 dark:text-gray-400">Dari Total</div>
                                <div class="text-lg font-semibold text-gray-700 dark:text-gray-300">
                                    {{ $maintenance->barang->jumlah_total }} unit
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="bg-red-50 dark:bg-red-900/30 rounded-xl shadow-lg p-6 border border-red-200 dark:border-red-700">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 dark:bg-red-800/50 rounded-lg mr-3">
                            <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-red-800 dark:text-red-300">Barang Tidak Ditemukan</h4>
                            <p class="text-sm text-red-600 dark:text-red-400 mt-1">Barang yang di-maintenance sudah tidak tersedia dalam sistem.</p>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Maintenance Details --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.2s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-orange-100 dark:bg-orange-900/30 rounded-lg mr-3">
                            <i class="fas fa-tools text-orange-600 dark:text-orange-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Detail Maintenance</h3>
                    </div>
                    
                    <div class="space-y-4">
                        {{-- Jenis Maintenance --}}
                        <div class="p-4 bg-gradient-to-r from-purple-50 to-indigo-50 dark:from-purple-900/30 dark:to-indigo-900/30 rounded-xl border border-purple-200 dark:border-purple-700">
                            <div class="text-sm text-purple-600 dark:text-purple-400 mb-1">Jenis Maintenance</div>
                            <div class="text-lg font-semibold text-purple-800 dark:text-purple-300">
                                <i class="fas 
                                    @if($maintenance->jenis_maintenance === 'preventif') fa-calendar-check
                                    @elseif($maintenance->jenis_maintenance === 'korektif') fa-wrench
                                    @else fa-exclamation-circle
                                    @endif mr-2"></i>
                                {{ ucfirst(str_replace('_', ' ', $maintenance->jenis_maintenance)) }}
                            </div>
                        </div>
                        
                        {{-- Deskripsi --}}
                        @if($maintenance->deskripsi)
                        <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                            <div class="text-sm text-gray-500 dark:text-gray-400 mb-2 flex items-center">
                                <i class="fas fa-file-alt mr-2"></i>Deskripsi Masalah & Tindakan
                            </div>
                            <div class="text-gray-800 dark:text-gray-200 whitespace-pre-line leading-relaxed">{{ $maintenance->deskripsi }}</div>
                        </div>
                        @endif
                        
                        {{-- Grid Info --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Teknisi --}}
                            @if($maintenance->teknisi)
                            <div class="p-4 bg-blue-50 dark:bg-blue-900/30 rounded-xl border border-blue-200 dark:border-blue-700">
                                <div class="text-sm text-blue-600 dark:text-blue-400 mb-1">Teknisi</div>
                                <div class="text-lg font-semibold text-blue-800 dark:text-blue-300 flex items-center">
                                    <i class="fas fa-user-cog mr-2"></i>
                                    {{ $maintenance->teknisi }}
                                </div>
                            </div>
                            @endif
                            
                            {{-- Biaya --}}
                            @if($maintenance->biaya && $maintenance->biaya > 0)
                            <div class="p-4 bg-green-50 dark:bg-green-900/30 rounded-xl border border-green-200 dark:border-green-700">
                                <div class="text-sm text-green-600 dark:text-green-400 mb-1">Biaya Maintenance</div>
                                <div class="text-lg font-bold text-green-800 dark:text-green-300 flex items-center">
                                    <i class="fas fa-money-bill-wave mr-2"></i>
                                    Rp {{ number_format($maintenance->biaya, 0, ',', '.') }}
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        {{-- Catatan Penyelesaian --}}
                        @if($maintenance->catatan_penyelesaian)
                        <div class="p-4 bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/30 dark:to-green-900/30 rounded-xl border border-emerald-200 dark:border-emerald-700">
                            <div class="text-sm text-emerald-600 dark:text-emerald-400 mb-2 flex items-center font-semibold">
                                <i class="fas fa-check-double mr-2"></i>Catatan Penyelesaian
                            </div>
                            <div class="text-emerald-800 dark:text-emerald-300 whitespace-pre-line leading-relaxed">{{ $maintenance->catatan_penyelesaian }}</div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Timeline --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.3s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                            <i class="fas fa-history text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Timeline</h3>
                    </div>
                    
                    <div class="space-y-4">
                        {{-- Dibuat --}}
                        <div class="timeline-item">
                            <div class="flex items-start">
                                <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-full mr-3 flex-shrink-0">
                                    <i class="fas fa-plus text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 dark:text-gray-100">Maintenance Dibuat</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $maintenance->created_at->format('d M Y, H:i') }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                        {{ $maintenance->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Dijadwalkan --}}
                        @if($maintenance->tanggal)
                        <div class="timeline-item">
                            <div class="flex items-start">
                                <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-full mr-3 flex-shrink-0">
                                    <i class="fas fa-calendar-alt text-purple-600 dark:text-purple-400"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 dark:text-gray-100">Tanggal Maintenance</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $maintenance->tanggal->format('d M Y, H:i') }}
                                    </div>
                                    @if($maintenance->tanggal->isFuture())
                                        <div class="text-xs text-purple-600 dark:text-purple-400 mt-1">
                                            {{ $maintenance->tanggal->diffForHumans() }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        {{-- Selesai --}}
                        @if($maintenance->tanggal_selesai)
                        <div class="timeline-item">
                            <div class="flex items-start">
                                <div class="p-2 
                                    @if($maintenance->status === 'selesai') bg-emerald-100 dark:bg-emerald-900/30
                                    @else bg-red-100 dark:bg-red-900/30
                                    @endif rounded-full mr-3 flex-shrink-0">
                                    <i class="fas 
                                        @if($maintenance->status === 'selesai') fa-check-circle text-emerald-600 dark:text-emerald-400
                                        @else fa-ban text-red-600 dark:text-red-400
                                        @endif"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 dark:text-gray-100">
                                        {{ $maintenance->status === 'selesai' ? 'Maintenance Selesai' : 'Maintenance Dibatalkan' }}
                                    </div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $maintenance->tanggal_selesai->format('d M Y, H:i') }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                        {{ $maintenance->tanggal_selesai->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        {{-- Last Updated --}}
                        @if($maintenance->updated_at != $maintenance->created_at)
                        <div class="timeline-item">
                            <div class="flex items-start">
                                <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-full mr-3 flex-shrink-0">
                                    <i class="fas fa-edit text-gray-600 dark:text-gray-400"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900 dark:text-gray-100">Terakhir Diupdate</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $maintenance->updated_at->format('d M Y, H:i') }}
                                    </div>
                                    <div class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                        {{ $maintenance->updated_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Right Column - Status & Additional Info --}}
            <div class="space-y-6">
                
                {{-- Status Summary --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.4s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-orange-100 dark:bg-orange-900/30 rounded-lg mr-3">
                            <i class="fas fa-info-circle text-orange-600 dark:text-orange-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Status Summary</h3>
                    </div>
                    
                    <div class="space-y-4">
                        {{-- Current Status --}}
                        <div class="p-4 rounded-xl border-2
                            @if($maintenance->status === 'selesai') bg-gradient-to-r from-emerald-50 to-green-50 dark:from-emerald-900/30 dark:to-green-900/30 border-emerald-300 dark:border-emerald-700
                            @elseif($maintenance->status === 'dalam_proses') bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/30 dark:to-orange-900/30 border-amber-300 dark:border-amber-700
                            @elseif($maintenance->status === 'dibatalkan') bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900/30 dark:to-pink-900/30 border-red-300 dark:border-red-700
                            @else bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/30 dark:to-indigo-900/30 border-blue-300 dark:border-blue-700
                            @endif">
                            <div class="text-sm 
                                @if($maintenance->status === 'selesai') text-emerald-600 dark:text-emerald-400
                                @elseif($maintenance->status === 'dalam_proses') text-amber-600 dark:text-amber-400
                                @elseif($maintenance->status === 'dibatalkan') text-red-600 dark:text-red-400
                                @else text-blue-600 dark:text-blue-400
                                @endif mb-2 font-semibold">Status Saat Ini</div>
                            <div class="text-2xl font-bold 
                                @if($maintenance->status === 'selesai') text-emerald-800 dark:text-emerald-300
                                @elseif($maintenance->status === 'dalam_proses') text-amber-800 dark:text-amber-300
                                @elseif($maintenance->status === 'dibatalkan') text-red-800 dark:text-red-300
                                @else text-blue-800 dark:text-blue-300
                                @endif flex items-center">
                                @if($maintenance->status === 'selesai')
                                    <i class="fas fa-check-circle mr-2"></i>
                                @elseif($maintenance->status === 'dalam_proses')
                                    <i class="fas fa-cog fa-spin mr-2"></i>
                                @elseif($maintenance->status === 'dibatalkan')
                                    <i class="fas fa-ban mr-2"></i>
                                @else
                                    <i class="fas fa-clock mr-2"></i>
                                @endif
                                {{ ucfirst(str_replace('_', ' ', $maintenance->status)) }}
                            </div>
                        </div>
                                                
                        {{-- Duration --}}
                        @if($maintenance->tanggal_selesai && $maintenance->tanggal)
                        @php
                            $tanggalMulai = \Carbon\Carbon::parse($maintenance->tanggal);
                            $tanggalSelesai = \Carbon\Carbon::parse($maintenance->tanggal_selesai);
                            
                            $totalMinutes = $tanggalMulai->diffInMinutes($tanggalSelesai);
                            $totalHours = floor($tanggalMulai->diffInHours($tanggalSelesai));
                            $totalDays = floor($tanggalMulai->diffInDays($tanggalSelesai));
                            
                            if ($totalMinutes < 60) {
                                $durasiText = $totalMinutes . ' Menit';
                            } elseif ($totalHours < 24) {
                                $durasiText = $totalHours . ' Jam';
                            } elseif ($totalDays == 1) {
                                $durasiText = '1 Hari';
                            } else {
                                $durasiText = $totalDays . ' Hari';
                            }
                        @endphp
                        <div class="p-3 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg border border-indigo-200 dark:border-indigo-700">
                            <div class="text-sm text-indigo-600 dark:text-indigo-400 mb-1">Durasi Maintenance</div>
                            <div class="text-lg font-bold text-indigo-800 dark:text-indigo-300">
                                {{ $durasiText }}
                            </div>
                        </div>
                        @elseif($maintenance->status === 'dalam_proses' && $maintenance->tanggal)
                        @php
                            $tanggalMulai = \Carbon\Carbon::parse($maintenance->tanggal);
                            $sekarang = \Carbon\Carbon::now();
                            
                            $totalMinutes = abs($tanggalMulai->diffInMinutes($sekarang));
                            $totalHours = floor(abs($tanggalMulai->diffInHours($sekarang)));
                            $totalDays = floor(abs($tanggalMulai->diffInDays($sekarang)));
                            
                            if ($totalMinutes < 1) {
                                $durasiText = 'Baru saja';
                            } elseif ($totalMinutes < 60) {
                                $durasiText = $totalMinutes . ' Menit';
                            } elseif ($totalHours < 24) {
                                $durasiText = $totalHours . ' Jam';
                            } elseif ($totalDays == 1) {
                                $durasiText = '1 Hari';
                            } else {
                                $durasiText = $totalDays . ' Hari';
                            }
                        @endphp
                        <div class="p-3 bg-amber-50 dark:bg-amber-900/30 rounded-lg border border-amber-200 dark:border-amber-700">
                            <div class="text-sm text-amber-600 dark:text-amber-400 mb-1">Sudah Berjalan</div>
                            <div class="text-lg font-bold text-amber-800 dark:text-amber-300">
                                {{ $durasiText }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- History Maintenance (Same Item) --}}
                @if($historyMaintenance && $historyMaintenance->count() > 0)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.5s">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg mr-3">
                                <i class="fas fa-history text-purple-600 dark:text-purple-400"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Riwayat Maintenance</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Barang yang sama</p>
                            </div>
                        </div>
                        <span class="text-xs bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300 px-3 py-1 rounded-full font-bold">
                            {{ $historyMaintenance->count() }}
                        </span>
                    </div>
                    
                    <div class="space-y-3 max-h-[400px] overflow-y-auto custom-scrollbar">
                        @foreach($historyMaintenance as $history)
                        <div class="p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-200 dark:border-gray-600 hover:border-purple-300 dark:hover:border-purple-700 transition-all">
                            <div class="flex items-start justify-between mb-2">
                                <div class="flex items-center space-x-2">
                                    <div class="w-8 h-8 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-check text-emerald-600 dark:text-emerald-400 text-xs"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900 dark:text-gray-100 text-sm">
                                            {{ ucfirst(str_replace('_', ' ', $history->jenis_maintenance)) }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $history->tanggal ? $history->tanggal->format('d M Y') : $history->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>
                                <span class="text-xs bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 px-2 py-1 rounded-full font-medium">
                                    {{ $history->jumlah }} unit
                                </span>
                            </div>
                            
                            @if($history->deskripsi)
                            <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-2">
                                {{ Str::limit($history->deskripsi, 100) }}
                            </p>
                            @endif
                            
                            @if($history->biaya && $history->biaya > 0)
                            <div class="mt-2 pt-2 border-t border-gray-200 dark:border-gray-600">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-gray-500 dark:text-gray-400">Biaya:</span>
                                    <span class="font-semibold text-green-600 dark:text-green-400">
                                        Rp {{ number_format($history->biaya, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Quick Actions --}}
                <div class="bg-gradient-to-br from-slate-50 to-gray-100 dark:from-slate-800 dark:to-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600 card-hover animate-slide-up" style="animation-delay: 0.6s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                            <i class="fas fa-bolt text-indigo-600 dark:text-indigo-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Aksi Cepat</h3>
                    </div>
                    
                    <div class="space-y-3">
                        @if($maintenance->status === 'dalam_proses')
                        <button onclick="completeMaintenanceModal({{ $maintenance->id }}, {{ $maintenance->jumlah }}, '{{ $maintenance->jenis_maintenance }}')"
                                class="action-btn w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-emerald-500 via-emerald-600 to-emerald-500 text-white font-semibold text-sm rounded-xl hover:from-emerald-600 hover:via-emerald-700 hover:to-emerald-600 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 bg-size-200 bg-pos-0 hover:bg-pos-100 group relative overflow-hidden">
                            <div class="absolute inset-0 bg-white/20 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                            <i class="fas fa-check-circle mr-2 group-hover:rotate-12 transition-transform duration-300 relative"></i>
                            <span class="relative">Selesaikan Maintenance</span>
                        </button>
                        @endif
                        
                        @if(in_array($maintenance->status, ['dijadwalkan', 'dalam_proses']))
                        <button onclick="cancelMaintenanceModal({{ $maintenance->id }})"
                                class="action-btn w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-500 via-red-600 to-red-500 text-white font-semibold text-sm rounded-xl hover:from-red-600 hover:via-red-700 hover:to-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-1 bg-size-200 bg-pos-0 hover:bg-pos-100 group relative overflow-hidden">
                            <div class="absolute inset-0 bg-white/20 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                            <i class="fas fa-times-circle mr-2 group-hover:rotate-12 transition-transform duration-300 relative"></i>
                            <span class="relative">Batalkan Maintenance</span>
                        </button>
                        @endif
                        
                        <a href="{{ route('admin.maintenance.edit', $maintenance->id) }}"
                        class="action-btn w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-700 text-blue-700 dark:text-blue-300 font-semibold text-sm border-2 border-blue-200 dark:border-blue-700 rounded-xl hover:bg-gradient-to-r hover:from-blue-100 hover:to-indigo-100 dark:hover:from-gray-700 dark:hover:to-gray-600 hover:border-blue-300 dark:hover:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1 group">
                            <i class="fas fa-edit mr-2 group-hover:rotate-12 transition-transform duration-300"></i>
                            <span>Edit Maintenance</span>
                        </a>
                        
                        @if($maintenance->barang)
                        <a href="{{ route('admin.barang.show', $maintenance->barang->id) }}"
                        class="action-btn w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-purple-50 to-pink-50 dark:from-gray-800 dark:to-gray-700 text-purple-700 dark:text-purple-300 font-semibold text-sm border-2 border-purple-200 dark:border-purple-700 rounded-xl hover:bg-gradient-to-r hover:from-purple-100 hover:to-pink-100 dark:hover:from-gray-700 dark:hover:to-gray-600 hover:border-purple-300 dark:hover:border-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1 group">
                            <i class="fas fa-cube mr-2 group-hover:rotate-12 transition-transform duration-300"></i>
                            <span>Lihat Detail Barang</span>
                        </a>
                        @endif
                        
                        <a href="{{ route('admin.maintenance.index') }}"
                        class="action-btn w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-slate-50 to-gray-50 dark:from-gray-800 dark:to-gray-700 text-slate-700 dark:text-slate-300 font-semibold text-sm border-2 border-slate-200 dark:border-slate-600 rounded-xl hover:bg-gradient-to-r hover:from-slate-100 hover:to-gray-100 dark:hover:from-gray-700 dark:hover:to-gray-600 hover:border-slate-300 dark:hover:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1 group">
                            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-300"></i>
                            <span>Kembali ke Daftar</span>
                        </a>
                    </div>
                </div>

                {{-- System Info --}}
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.7s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg mr-3">
                            <i class="fas fa-info-circle text-gray-600 dark:text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Sistem</h3>
                    </div>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">ID Maintenance:</span>
                            <span class="font-mono text-slate-600 dark:text-slate-300 font-semibold">#{{ $maintenance->id }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">Jenis Aset:</span>
                            <span class="font-semibold text-slate-600 dark:text-slate-300">{{ ucfirst($maintenance->jenis_aset) }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">Aset ID:</span>
                            <span class="font-mono text-slate-600 dark:text-slate-300 font-semibold">#{{ $maintenance->aset_id }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">Dibuat:</span>
                            <span class="text-slate-600 dark:text-slate-300">{{ $maintenance->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-500 dark:text-gray-400">Terakhir Update:</span>
                            <span class="text-slate-600 dark:text-slate-300">{{ $maintenance->updated_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Complete Maintenance Modal --}}
    <div id="complete-maintenance-modal" class="modal modal-backdrop">
        <div class="modal-content">
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

                <div class="mb-4">
                    <label for="kondisi_akhir" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Kondisi Barang Setelah Maintenance <span class="text-red-500">*</span>
                    </label>
                    <select name="kondisi_akhir" 
                            id="kondisi_akhir" 
                            required
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                        <option value="">Pilih Kondisi...</option>
                        <option value="baik">Baik</option>
                        <option value="rusak ringan">Rusak Ringan</option>
                        <option value="rusak berat">Rusak Berat</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="catatan-selesai" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Catatan Penyelesaian <span class="text-gray-400 dark:text-gray-500">(Opsional)</span>
                    </label>
                    <textarea name="catatan_penyelesaian" 
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

    {{-- Cancel Maintenance Modal --}}
    <div id="cancel-maintenance-modal" class="modal modal-backdrop">
        <div class="modal-content">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-lg mr-3">
                        <i class="fas fa-ban text-red-600 dark:text-red-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Batalkan Maintenance</h3>
                </div>
                <button onclick="closeCancelMaintenanceModal()" 
                        class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form id="cancel-maintenance-form" method="POST" action="">
                @csrf
                
                <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/30 rounded-lg border border-red-200 dark:border-red-700">
                    <p class="text-sm text-red-700 dark:text-red-400">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <strong>Peringatan:</strong> Unit yang di-maintenance akan dikembalikan ke stok tersedia.
                    </p>
                </div>

                <div class="mb-6">
                    <label for="alasan-batal" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Alasan Pembatalan <span class="text-red-500">*</span>
                    </label>
                    <textarea name="alasan" 
                              id="alasan-batal" 
                              rows="4" 
                              required
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 resize-none transition-all"
                              placeholder="Jelaskan alasan pembatalan maintenance..."></textarea>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeCancelMaintenanceModal()" 
                            class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-medium transition-all">
                        Batal
                    </button>
                    <button type="submit" 
                            id="cancel-submit-btn"
                            class="px-6 py-3 text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 rounded-lg font-semibold shadow-md hover:shadow-lg transition-all">
                        <i class="fas fa-ban mr-2"></i>
                        Ya, Batalkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Notifications --}}
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

    @if(session('info'))
    <div id="notification" class="fixed top-4 right-4 z-50">
        <div class="notification info bg-white/90 dark:bg-gray-800/90 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 p-4 max-w-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                        <i class="fas fa-info-circle text-blue-600 dark:text-blue-400"></i>
                    </div>
                </div>
                <div class="ml-3">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Info</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ session('info') }}</p>
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
// ==========================================
// GLOBAL VARIABLES
// ==========================================
let currentMaintenanceId = null;

// ==========================================
// COMPLETE MAINTENANCE MODAL FUNCTIONS
// ==========================================

function completeMaintenanceModal(maintenanceId, jumlahUnit, jenisMaintenance = '') {
    console.log('🔧 Opening complete maintenance modal:', {
        maintenanceId,
        jumlahUnit,
        jenisMaintenance
    });
    
    currentMaintenanceId = maintenanceId;
    
    // Set values ke form
    document.getElementById('maintenance-id-input').value = maintenanceId;
    document.getElementById('maintenance-unit-count').textContent = jumlahUnit + ' unit';
    document.getElementById('maintenance-jenis').textContent = jenisMaintenance ? 
        jenisMaintenance.charAt(0).toUpperCase() + jenisMaintenance.slice(1).replace('_', ' ') : '-';
    
    // Set action URL
    document.getElementById('complete-maintenance-form').action = 
        `/admin/maintenance/${maintenanceId}/complete`;
    
    // Reset form fields
    document.getElementById('catatan-selesai').value = '';
    document.getElementById('kondisi_akhir').value = '';
    
    // Show modal
    document.getElementById('complete-maintenance-modal').classList.add('show');
}

function closeCompleteMaintenanceModal() {
    document.getElementById('complete-maintenance-modal').classList.remove('show');
    document.getElementById('complete-maintenance-form').reset();
    currentMaintenanceId = null;
}

// ==========================================
// CANCEL MAINTENANCE MODAL FUNCTIONS
// ==========================================

function cancelMaintenanceModal(maintenanceId) {
    console.log('❌ Opening cancel maintenance modal:', maintenanceId);
    
    currentMaintenanceId = maintenanceId;
    
    // Set action URL
    document.getElementById('cancel-maintenance-form').action = 
        `/admin/maintenance/${maintenanceId}/cancel`;
    
    // Reset form
    document.getElementById('alasan-batal').value = '';
    
    // Show modal
    document.getElementById('cancel-maintenance-modal').classList.add('show');
}

function closeCancelMaintenanceModal() {
    document.getElementById('cancel-maintenance-modal').classList.remove('show');
    document.getElementById('cancel-maintenance-form').reset();
    currentMaintenanceId = null;
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

function showNotification(type, message) {
    // Remove existing notification
    const existingNotification = document.getElementById('notification');
    if (existingNotification) {
        existingNotification.remove();
    }
    
    const notification = document.createElement('div');
    notification.id = 'notification';
    notification.className = 'fixed top-4 right-4 z-50';
    
    const iconClass = type === 'success' ? 'fa-check-circle text-green-600 dark:text-green-400' : 
                      type === 'error' ? 'fa-exclamation-circle text-red-600 dark:text-red-400' :
                      'fa-info-circle text-blue-600 dark:text-blue-400';
    const bgClass = type === 'success' ? 'bg-green-100 dark:bg-green-900/30' : 
                    type === 'error' ? 'bg-red-100 dark:bg-red-900/30' :
                    'bg-blue-100 dark:bg-blue-900/30';
    
    notification.innerHTML = `
        <div class="notification ${type} bg-white/90 dark:bg-gray-800/90 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 p-4 max-w-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="p-2 ${bgClass} rounded-lg">
                        <i class="fas ${iconClass}"></i>
                    </div>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-gray-800 dark:text-gray-200 font-medium">${message}</p>
                </div>
                <button onclick="hideNotification()" class="ml-auto text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-1 rounded transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Auto hide after 5 seconds
    setTimeout(() => {
        hideNotification();
    }, 5000);
}

// ==========================================
// FORM SUBMISSION HANDLERS
// ==========================================

document.addEventListener('DOMContentLoaded', function() {
    
    // Complete Maintenance Form
    const completeForm = document.getElementById('complete-maintenance-form');
    if (completeForm) {
        completeForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const kondisiAkhir = document.getElementById('kondisi_akhir').value;
            const catatan = document.getElementById('catatan-selesai').value.trim();
            const jumlah = document.getElementById('maintenance-unit-count').textContent;
            
            // Validasi kondisi akhir
            if (!kondisiAkhir) {
                showNotification('error', 'Pilih kondisi barang setelah maintenance!');
                return;
            }
            
            // Konfirmasi
            if (!confirm(
                `✅ SELESAIKAN MAINTENANCE?\n\n` +
                `${jumlah} akan dikembalikan ke stok tersedia.\n` +
                `Kondisi Akhir: ${kondisiAkhir}\n` +
                `${catatan ? '\nCatatan: ' + catatan.substring(0, 50) + '...' : ''}\n\n` +
                `Lanjutkan?`
            )) {
                return;
            }
            
            const submitBtn = document.getElementById('complete-submit-btn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
            
            // Submit form
            this.submit();
        });
    }
    
    // Cancel Maintenance Form
    const cancelForm = document.getElementById('cancel-maintenance-form');
    if (cancelForm) {
        cancelForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const alasan = document.getElementById('alasan-batal').value.trim();
            
            // Validasi alasan
            if (!alasan || alasan.length < 10) {
                showNotification('error', 'Alasan pembatalan minimal 10 karakter!');
                return;
            }
            
            // Konfirmasi
            if (!confirm(
                `⚠️ BATALKAN MAINTENANCE?\n\n` +
                `Unit yang di-maintenance akan dikembalikan ke stok tersedia.\n\n` +
                `Alasan: ${alasan.substring(0, 100)}${alasan.length > 100 ? '...' : ''}\n\n` +
                `Lanjutkan?`
            )) {
                return;
            }
            
            const submitBtn = document.getElementById('cancel-submit-btn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
            
            // Submit form
            this.submit();
        });
    }
    
    // Auto hide notifications
    @if(session('success') || session('error') || session('info'))
    setTimeout(() => {
        hideNotification();
    }, 5000);
    @endif
});

// ==========================================
// KEYBOARD & CLICK EVENT HANDLERS
// ==========================================

// Close modals on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeCompleteMaintenanceModal();
        closeCancelMaintenanceModal();
    }
});

// Close modals on backdrop click
document.addEventListener('click', function(event) {
    const completeModal = document.getElementById('complete-maintenance-modal');
    const cancelModal = document.getElementById('cancel-maintenance-modal');
    
    if (event.target === completeModal) {
        closeCompleteMaintenanceModal();
    }
    
    if (event.target === cancelModal) {
        closeCancelMaintenanceModal();
    }
});

// ==========================================
// PRINT FUNCTION
// ==========================================

function printMaintenanceDetail() {
    window.print();
}

// Debug log
console.log('✅ Maintenance Show - JavaScript loaded successfully');
console.log('🔧 Complete Maintenance Modal initialized');
console.log('❌ Cancel Maintenance Modal initialized');
</script>
@endpush