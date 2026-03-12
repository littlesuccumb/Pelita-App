@extends('layouts.app')

@section('title', 'Edit Data Maintenance - Admin')

@push('styles')
<style>
    /* Dark mode transitions */
    * {
        transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes slideUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    .animate-fade-in { animation: fadeIn 0.6s ease-out; }
    .animate-slide-up { animation: slideUp 0.5s ease-out; }
    
    .card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .dark .card-hover:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
    }
    
    .floating-label {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .floating-label input,
    .floating-label textarea,
    .floating-label select {
        width: 100%;
        padding: 1rem 0.75rem;
        border: 2px solid #e5e7eb;
        border-radius: 0.75rem;
        background: white;
        outline: none;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .dark .floating-label input,
    .dark .floating-label textarea,
    .dark .floating-label select {
        background: #374151;
        border-color: #4b5563;
        color: #f3f4f6;
    }
    
    .floating-label input.input-with-icon,
    .floating-label textarea.input-with-icon,
    .floating-label select.input-with-icon {
        padding-left: 3.5rem;
    }
    
    .floating-label label {
        position: absolute;
        left: 0.75rem;
        top: 1rem;
        color: #6b7280;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        pointer-events: none;
        background: white;
        padding: 0 0.5rem;
        border-radius: 0.25rem;
    }

    .dark .floating-label label {
        background: #374151;
        color: #9ca3af;
    }
    
    .floating-label .input-group:has(.input-with-icon) label {
        left: 3rem;
    }
    
    .floating-label input:focus + label,
    .floating-label input:not(:placeholder-shown) + label,
    .floating-label textarea:focus + label,
    .floating-label textarea:not(:placeholder-shown) + label,
    .floating-label select:focus + label,
    .floating-label select:not([value=""]) + label {
        top: -0.5rem;
        left: 0.5rem;
        font-size: 0.75rem;
        color: #3b82f6;
        font-weight: 600;
        box-shadow: 0 0 0 4px white;
    }

    .dark .floating-label input:focus + label,
    .dark .floating-label input:not(:placeholder-shown) + label,
    .dark .floating-label textarea:focus + label,
    .dark .floating-label textarea:not(:placeholder-shown) + label,
    .dark .floating-label select:focus + label,
    .dark .floating-label select:not([value=""]) + label {
        color: #60a5fa;
        box-shadow: 0 0 0 4px #374151;
    }
    
    .floating-label input:focus,
    .floating-label textarea:focus,
    .floating-label select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1), 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transform: translateY(-1px);
    }

    .dark .floating-label input:focus,
    .dark .floating-label textarea:focus,
    .dark .floating-label select:focus {
        border-color: #60a5fa;
        background: #4b5563;
        box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.2), 0 4px 6px -1px rgba(0, 0, 0, 0.3);
    }
    
    .input-icon {
        position: absolute;
        left: 1rem;
        top: 1rem;
        color: #6b7280;
        z-index: 10;
        transition: color 0.3s ease;
        pointer-events: none;
    }

    .dark .input-icon {
        color: #9ca3af;
    }
    
    .floating-label:focus-within .input-icon {
        color: #3b82f6;
    }

    .dark .floating-label:focus-within .input-icon {
        color: #60a5fa;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        border: none;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 14px 0 rgba(59, 130, 246, 0.4);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.5);
    }
    
    .info-card {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        border: 1px solid #0ea5e9;
        border-left: 4px solid #0ea5e9;
        border-radius: 0.75rem;
        padding: 1.25rem;
        margin: 1rem 0;
        box-shadow: 0 2px 8px rgba(14, 165, 233, 0.1);
    }

    .dark .info-card {
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
        border-color: #3b82f6;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2);
    }
    
    .error-message {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        background: rgba(239, 68, 68, 0.1);
        border-radius: 0.5rem;
        border-left: 3px solid #ef4444;
    }

    .dark .error-message {
        color: #fca5a5;
        background: rgba(239, 68, 68, 0.2);
    }
    
    .required-asterisk {
        color: #ef4444;
        font-weight: bold;
        margin-left: 3px;
        animation: pulse 2s infinite;
    }
    
    .notification {
        position: fixed;
        top: 1rem;
        right: 1rem;
        z-index: 50;
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
        padding: 1.25rem;
        max-width: 28rem;
        animation: slideInRight 0.5s ease-out;
    }

    .dark .notification {
        background: #1f2937;
        border-color: #374151;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
    }

    .badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .badge-success {
        background: #dcfce7;
        color: #166534;
    }

    .dark .badge-success {
        background: #065f46;
        color: #86efac;
    }

    .badge-warning {
        background: #fef3c7;
        color: #92400e;
    }

    .dark .badge-warning {
        background: #78350f;
        color: #fde047;
    }

    .badge-danger {
        background: #fee2e2;
        color: #991b1b;
    }

    .dark .badge-danger {
        background: #7f1d1d;
        color: #fca5a5;
    }

    #status-info {
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        border-left: 3px solid;
        background: rgba(59, 130, 246, 0.1);
        border-color: #3b82f6;
    }

    .dark #status-info {
        background: rgba(59, 130, 246, 0.2);
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        cursor: pointer;
        border-radius: 0.25rem;
        padding: 0.25rem;
        transition: all 0.2s ease;
    }

    input[type="date"]::-webkit-calendar-picker-indicator:hover {
        background: rgba(59, 130, 246, 0.1);
    }

    .dark input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
    }


.badge {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    gap: 0.375rem;
}

.badge-dijadwalkan {
    background: #dbeafe;
    color: #1e40af;
    border: 1px solid #3b82f6;
}

.dark .badge-dijadwalkan {
    background: #1e3a8a;
    color: #93c5fd;
    border-color: #3b82f6;
}

.badge-dalam_proses {
    background: #fef3c7;
    color: #92400e;
    border: 1px solid #f59e0b;
}

.dark .badge-dalam_proses {
    background: #78350f;
    color: #fde047;
    border-color: #f59e0b;
}

.badge-selesai {
    background: #dcfce7;
    color: #166534;
    border: 1px solid #22c55e;
}

.dark .badge-selesai {
    background: #065f46;
    color: #86efac;
    border-color: #22c55e;
}

.badge-dibatalkan {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #ef4444;
}

.dark .badge-dibatalkan {
    background: #7f1d1d;
    color: #fca5a5;
    border-color: #ef4444;
}

.status-dot {
    width: 0.5rem;
    height: 0.5rem;
    border-radius: 50%;
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

.field-modified {
    border-color: #f59e0b !important;
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1) !important;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}
</style>
@endpush

@section('content')
<div class="w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 lg:py-4">     
        <!-- Breadcrumb -->
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
                    <i class="fas fa-edit"></i>
                    <span>Edit Data Maintenance</span>
                </span>
            </div>
        </nav>

        {{-- Modern Header Section - SAMA DENGAN BARANG --}}
        <div class="mb-8 animate-fade-in">
            <div class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700">
                
                {{-- Background Decorations --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-400/20 via-indigo-400/20 to-purple-400/20 dark:from-blue-600/5 dark:via-indigo-600/5 dark:to-purple-600/5 rounded-full blur-3xl transform translate-x-32 -translate-y-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-indigo-400/15 to-purple-400/15 dark:from-indigo-600/5 dark:to-purple-600/5 rounded-full blur-2xl transform -translate-x-24 translate-y-24"></div>
                
                {{-- Floating Dots --}}
                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                    <div class="absolute top-10 left-10 w-2 h-2 bg-blue-400 dark:bg-blue-500 rounded-full animate-pulse opacity-60"></div>
                    <div class="absolute top-20 right-20 w-1.5 h-1.5 bg-indigo-400 dark:bg-indigo-500 rounded-full animate-pulse opacity-40" style="animation-delay: 0.5s;"></div>
                    <div class="absolute bottom-16 left-1/3 w-1 h-1 bg-purple-400 dark:bg-purple-500 rounded-full animate-pulse opacity-50" style="animation-delay: 1s;"></div>
                </div>
                
                <div class="relative p-8 lg:p-10">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        
                        <div class="flex-1">
                            {{-- Status Badge --}}
                            <div class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-blue-500/10 to-indigo-500/10 dark:from-blue-600/20 dark:to-indigo-600/20 border border-blue-200/50 dark:border-blue-700/50 rounded-full mb-4">
                                <div class="w-2 h-2 bg-blue-500 dark:bg-blue-400 rounded-full animate-pulse"></div>
                                <span class="text-sm font-semibold text-blue-700 dark:text-blue-300">Form Edit Maintenance</span>
                            </div>
                            
                            {{-- Title --}}
                            <h1 class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-blue-800 to-indigo-800 dark:from-slate-100 dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent leading-tight">
                                Edit Data Maintenance
                            </h1>
                            
                            {{-- Description --}}
                            <p class="text-slate-600 dark:text-slate-400 text-lg flex items-center space-x-2 mb-4">
                                <i class="fas fa-info-circle text-blue-500 dark:text-blue-400"></i>
                                <span>Perbarui informasi maintenance barang inventaris</span>
                            </p>
                            
                            {{-- Current Maintenance Info --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                                <div class="flex items-center px-3 py-1.5 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                                    <i class="fas fa-barcode mr-2 text-blue-600 dark:text-blue-400"></i>
                                    <div>
                                        <span class="font-semibold text-slate-700 dark:text-slate-300 block text-xs">Kode:</span>
                                        <span class="font-mono text-blue-700 dark:text-blue-300">{{ $maintenance->barang->kode_barang ?? 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center px-3 py-1.5 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                                    <i class="fas fa-box mr-2 text-green-600 dark:text-green-400"></i>
                                    <div>
                                        <span class="font-semibold text-slate-700 dark:text-slate-300 block text-xs">Barang:</span>
                                        <span class="text-green-700 dark:text-green-300">{{ Str::limit($maintenance->barang->nama_barang ?? 'N/A', 20) }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center px-3 py-1.5 bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-lg">
                                    <i class="fas fa-flag mr-2 text-purple-600 dark:text-purple-400"></i>
                                    <div>
                                    <span class="font-semibold text-slate-700 dark:text-slate-300 block text-xs">Status:</span>
                                        @php
                                            $statusConfig = [
                                                'dijadwalkan' => [
                                                    'class' => 'badge-dijadwalkan',
                                                    'icon' => 'fa-clock',
                                                    'label' => 'Dijadwalkan',
                                                    'dot' => 'bg-blue-500'
                                                ],
                                                'dalam_proses' => [
                                                    'class' => 'badge-dalam_proses',
                                                    'icon' => 'fa-spinner fa-spin',
                                                    'label' => 'Dalam Proses',
                                                    'dot' => 'bg-yellow-500'
                                                ],
                                                'selesai' => [
                                                    'class' => 'badge-selesai',
                                                    'icon' => 'fa-check-circle',
                                                    'label' => 'Selesai',
                                                    'dot' => 'bg-green-500'
                                                ],
                                                'dibatalkan' => [
                                                    'class' => 'badge-dibatalkan',
                                                    'icon' => 'fa-times-circle',
                                                    'label' => 'Dibatalkan',
                                                    'dot' => 'bg-red-500'
                                                ]
                                            ];
                                            $status = $statusConfig[$maintenance->status] ?? ['class' => '', 'icon' => 'fa-question', 'label' => 'Unknown', 'dot' => 'bg-gray-500'];
                                        @endphp
                                        <span class="badge {{ $status['class'] }}">
                                            @if(in_array($maintenance->status, ['dijadwalkan', 'dalam_proses']))
                                                <span class="status-dot {{ $status['dot'] }}"></span>
                                            @endif
                                            <i class="fas {{ $status['icon'] }}"></i>
                                            {{ $status['label'] }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Icon --}}
                        <div class="flex items-center space-x-3">
                            <div class="p-4 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl shadow-lg">
                                <i class="fas fa-edit text-white text-3xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Bottom Gradient Line --}}
                <div class="h-1.5 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>
            </div>
        </div>

        <!-- Main Form -->
        <form action="{{ route('admin.maintenance.update', $maintenance) }}" method="POST" id="maintenance-form" class="animate-slide-up">
            @csrf
            @method('PATCH')
            
            <!-- Barang Selection Section (READ-ONLY) -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 card-hover">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-orange-50 via-red-50 to-pink-50 dark:from-orange-900/20 dark:via-red-900/20 dark:to-pink-900/20 rounded-t-2xl">
                    <div class="flex items-center">
                        <div class="p-3 bg-gradient-to-r from-orange-500 to-red-600 rounded-xl mr-4 shadow-lg">
                            <i class="fas fa-box text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Barang yang Di-maintenance</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Data barang tidak dapat diubah setelah maintenance dibuat</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-8">
                    <!-- Hidden Input untuk Backend -->
                    <input type="hidden" name="aset_id" value="{{ $maintenance->aset_id }}">
                    
                    <!-- Display Only - Tidak bisa diedit -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl p-6 border-2 border-green-200 dark:border-green-800">
                        @if($maintenance->barang)
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg">
                                        <i class="fas fa-box text-white text-2xl"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-start justify-between mb-3">
                                        <div>
                                            <h5 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $maintenance->barang->nama_barang }}</h5>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $maintenance->barang->kode_barang }}</p>
                                        </div>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                                            <i class="fas fa-lock mr-1.5"></i>
                                            Terkunci
                                        </span>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                        <div>
                                            <p class="text-gray-500 dark:text-gray-400 mb-1 text-xs">Kategori</p>
                                            <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $maintenance->barang->kategori->nama_kategori ?? 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-500 dark:text-gray-400 mb-1 text-xs">Kondisi</p>
                                            @php
                                                $kondisiBadge = $maintenance->barang->kondisi === 'baik' ? 'badge-success' : 
                                                            ($maintenance->barang->kondisi === 'rusak ringan' ? 'badge-warning' : 'badge-danger');
                                            @endphp
                                            <span class="badge {{ $kondisiBadge }}">{{ ucfirst($maintenance->barang->kondisi) }}</span>
                                        </div>
                                        <div>
                                            <p class="text-gray-500 dark:text-gray-400 mb-1 text-xs">Unit Maintenance</p>
                                            <p class="font-bold text-orange-600 dark:text-orange-400">{{ $maintenance->jumlah }} Unit</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-500 dark:text-gray-400 mb-1 text-xs">Stok Tersedia Saat Ini</p>
                                            <p class="font-bold text-green-600 dark:text-green-400">{{ $maintenance->barang->jumlah_tersedia }} Unit</p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-800">
                                        <p class="text-xs text-yellow-800 dark:text-yellow-300 flex items-start">
                                            <i class="fas fa-info-circle mt-0.5 mr-2 flex-shrink-0"></i>
                                            <span>
                                                <strong>Catatan:</strong> Barang tidak dapat diganti setelah maintenance dibuat. Jika ingin mengubah barang, silakan batalkan maintenance ini dan buat yang baru.
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-red-100 dark:bg-red-900/30 rounded-xl flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400 text-2xl"></i>
                                </div>
                                <h4 class="text-lg font-bold text-red-900 dark:text-red-100 mb-2">Barang Tidak Ditemukan</h4>
                                <p class="text-sm text-red-700 dark:text-red-300">Barang dengan ID {{ $maintenance->aset_id }} sudah dihapus dari sistem</p>
                                <p class="text-xs text-red-600 dark:text-red-400 mt-2">Silakan batalkan atau hapus maintenance ini</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Form Details -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 card-hover">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 dark:from-blue-900/20 dark:via-indigo-900/20 dark:to-purple-900/20 rounded-t-2xl">
                    <div class="flex items-center">
                        <div class="p-3 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl mr-4 shadow-lg">
                            <i class="fas fa-info-circle text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Detail Maintenance</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Informasi lengkap mengenai maintenance</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Jenis Maintenance -->
                        <div class="floating-label">
                            <div class="input-group">
                                <i class="input-icon fas fa-wrench"></i>
                                <select name="jenis_maintenance" 
                                        id="jenis_maintenance" 
                                        required
                                        onchange="trackChanges(this)"
                                        class="form-input input-with-icon @error('jenis_maintenance') error @enderror">
                                    <option value="">Pilih Jenis Maintenance</option>
                                    <option value="preventif" {{ old('jenis_maintenance', $maintenance->jenis_maintenance) == 'preventif' ? 'selected' : '' }}>Preventif (Pencegahan)</option>
                                    <option value="korektif" {{ old('jenis_maintenance', $maintenance->jenis_maintenance) == 'korektif' ? 'selected' : '' }}>Korektif (Perbaikan)</option>
                                    <option value="emergency" {{ old('jenis_maintenance', $maintenance->jenis_maintenance) == 'emergency' ? 'selected' : '' }}>Emergency (Darurat)</option>
                                </select>
                                <label for="jenis_maintenance">Jenis Maintenance <span class="required-asterisk">*</span></label>
                            </div>
                            @error('jenis_maintenance')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Tanggal Maintenance -->
                        <div class="floating-label">
                            <div class="input-group">
                                <i class="input-icon fas fa-calendar"></i>
                                <input type="date" 
                                    name="tanggal" 
                                    id="tanggal" 
                                    value="{{ old('tanggal', $maintenance->tanggal ? \Carbon\Carbon::parse($maintenance->tanggal)->format('Y-m-d') : date('Y-m-d')) }}"
                                    min="{{ date('Y-m-d') }}"
                                    required
                                    onchange="trackChanges(this)"
                                    class="form-input input-with-icon @error('tanggal') error @enderror"
                                    placeholder=" ">
                                <label for="tanggal">Tanggal Maintenance <span class="required-asterisk">*</span></label>
                            </div>
                            <div class="mt-2 text-xs text-blue-600 dark:text-blue-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Minimal hari ini
                            </div>
                            @error('tanggal')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Jumlah Unit -->
                        <div class="floating-label">
                            <div class="input-group">
                                <i class="input-icon fas fa-sort-numeric-up"></i>
                                <input type="number" 
                                       name="jumlah" 
                                       id="jumlah" 
                                       value="{{ old('jumlah', $maintenance->jumlah ?? 1) }}"
                                       min="1"
                                       required
                                       oninput="trackChanges(this)"
                                       class="form-input input-with-icon @error('jumlah') error @enderror"
                                       placeholder=" ">
                                <label for="jumlah">Jumlah Unit <span class="required-asterisk">*</span></label>
                            </div>
                            <div id="stok-info" class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Stok tersedia: <span id="stok-tersedia" class="font-bold text-green-600 dark:text-green-400">0</span> unit
                            </div>
                            @error('jumlah')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Teknisi -->
                        <div class="floating-label">
                            <div class="input-group">
                                <i class="input-icon fas fa-user-cog"></i>
                                <input type="text" 
                                       name="teknisi" 
                                       id="teknisi" 
                                       value="{{ old('teknisi', $maintenance->teknisi) }}"
                                       maxlength="255"
                                       oninput="trackChanges(this)"
                                       class="form-input input-with-icon @error('teknisi') error @enderror"
                                       placeholder=" ">
                                <label for="teknisi">Nama Teknisi</label>
                            </div>
                            @error('teknisi')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Biaya -->
                        <div class="floating-label">
                            <div class="input-group">
                                <i class="input-icon fas fa-dollar-sign"></i>
                                <input type="number" 
                                       name="biaya" 
                                       id="biaya" 
                                       value="{{ old('biaya', $maintenance->biaya ?? 0) }}"
                                       min="0"
                                       step="0.01"
                                       required
                                       oninput="trackChanges(this)"
                                       class="form-input input-with-icon @error('biaya') error @enderror"
                                       placeholder=" ">
                                <label for="biaya">Biaya (Rp) <span class="required-asterisk">*</span></label>
                            </div>
                            @error('biaya')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="floating-label">
                            <div class="input-group">
                                <i class="input-icon fas fa-flag"></i>
                                <select name="status" 
                                        id="status" 
                                        required
                                        onchange="trackChanges(this)"
                                        class="form-input input-with-icon @error('status') error @enderror">
                                    <option value="">Pilih Status</option>
                                    <option value="dijadwalkan" {{ old('status', $maintenance->status) == 'dijadwalkan' ? 'selected' : '' }}>Dijadwalkan</option>
                                    <option value="dalam_proses" {{ old('status', $maintenance->status) == 'dalam_proses' ? 'selected' : '' }}>Dalam Proses</option>
                                    <option value="selesai" {{ old('status', $maintenance->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="dibatalkan" {{ old('status', $maintenance->status) == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                                <label for="status">Status <span class="required-asterisk">*</span></label>
                            </div>
                            <div id="status-info" class="mt-2 text-xs">
                                <!-- Will be filled by JavaScript -->
                            </div>
                            @error('status')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="floating-label mt-6">
                        <div class="input-group">
                            <i class="input-icon fas fa-file-alt"></i>
                            <textarea name="deskripsi" 
                                      id="deskripsi" 
                                      rows="6"
                                      required
                                      oninput="trackChanges(this)"
                                      class="form-input input-with-icon @error('deskripsi') error @enderror"
                                      placeholder=" "
                                      maxlength="3000">{{ old('deskripsi', $maintenance->deskripsi) }}</textarea>
                            <label for="deskripsi">Deskripsi Lengkap <span class="required-asterisk">*</span></label>
                        </div>
                        <div class="flex items-center justify-between mt-2 text-xs text-gray-500 dark:text-gray-400">
                            <span>
                                <i class="fas fa-info-circle mr-1"></i>
                                Jelaskan masalah, tindakan, dan catatan lengkap
                            </span>
                            <span id="char-count-deskripsi">0 / 3000</span>
                        </div>
                        @error('deskripsi')
                        <div class="error-message">
                            <i class="fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Catatan Penyelesaian -->
                    <div class="floating-label mt-6">
                        <div class="input-group">
                            <i class="input-icon fas fa-sticky-note"></i>
                            <textarea name="catatan_penyelesaian" 
                                      id="catatan_penyelesaian" 
                                      rows="3"
                                      oninput="trackChanges(this)"
                                      class="form-input input-with-icon @error('catatan_penyelesaian') error @enderror"
                                      placeholder=" "
                                      maxlength="1000">{{ old('catatan_penyelesaian', $maintenance->catatan_penyelesaian) }}</textarea>
                            <label for="catatan_penyelesaian">Catatan Penyelesaian</label>
                        </div>
                        <div class="flex items-center justify-between mt-2 text-xs text-gray-500 dark:text-gray-400">
                            <span>
                                <i class="fas fa-info-circle mr-1"></i>
                                Catatan tambahan untuk penyelesaian (opsional)
                            </span>
                            <span id="char-count-catatan">0 / 1000</span>
                        </div>
                        @error('catatan_penyelesaian')
                        <div class="error-message">
                            <i class="fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="info-card mt-6">
                        <p class="text-sm text-blue-700 dark:text-blue-300 flex items-start">
                            <i class="fas fa-lightbulb mt-0.5 mr-2 flex-shrink-0"></i>
                            <span>
                                <strong>Tips:</strong> Pastikan informasi yang diperbarui sudah sesuai. Perubahan status akan mempengaruhi stok barang secara otomatis.
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 mb-8">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                            <i class="fas fa-info-circle text-blue-500 dark:text-blue-400 mr-2"></i>
                            <span>Pastikan semua perubahan sudah benar sebelum menyimpan</span>
                        </div>
                        
                        <div class="flex gap-3">
                            <button type="button" 
                                    class="btn-back group inline-flex items-center px-5 py-2.5 text-sm font-medium rounded-xl bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-500 shadow-md hover:shadow-lg hover:from-gray-200 hover:to-gray-300 dark:hover:from-gray-600 dark:hover:to-gray-500 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300"
                                    data-confirm="Perubahan belum disimpan. Yakin ingin kembali?">
                                <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-300"></i>
                                Kembali
                            </button>
                            
                            <!-- Reset -->
                            <button type="button" 
                                    onclick="resetChanges()"
                                    class="group inline-flex items-center px-5 py-2.5 text-sm font-medium rounded-xl bg-gradient-to-r from-yellow-500 to-amber-500 text-white shadow-md hover:shadow-lg hover:shadow-yellow-500/30 hover:from-yellow-400 hover:to-amber-400 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
                                <i class="fas fa-undo-alt mr-2 group-hover:-rotate-180 transition-transform duration-500"></i>
                                Reset Perubahan
                            </button>
                            
                            <!-- Update -->
                            <button type="submit" 
                                    id="submit-btn"
                                    class="group inline-flex items-center px-6 py-2.5 text-sm font-medium rounded-xl bg-gradient-to-r from-emerald-500 to-green-600 text-white shadow-md hover:shadow-lg hover:shadow-emerald-500/30 hover:from-emerald-400 hover:to-green-500 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
                                <i class="fas fa-check-circle mr-2 group-hover:scale-110 transition-transform duration-300"></i>
                                <span id="submit-text">Update Maintenance</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center backdrop-blur-sm">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 max-w-sm w-full mx-4 shadow-2xl">
            <div class="text-center">
                <div class="relative mb-6">
                    <div class="animate-spin rounded-full h-16 w-16 border-4 border-blue-200 dark:border-blue-800 border-t-blue-600 dark:border-t-blue-400 mx-auto"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fas fa-save text-blue-600 dark:text-blue-400 text-xl"></i>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Memperbarui Data</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Mohon tunggu, sedang memproses perubahan...</p>
            </div>
        </div>
    </div>

    <!-- Notifications -->
    @if(session('success'))
    <div id="notification" class="notification">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-xl">
                    <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-xl"></i>
                </div>
            </div>
            <div class="ml-4 flex-1">
                <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">Berhasil!</h4>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ session('success') }}</p>
            </div>
            <button onclick="hideNotification()" class="ml-4 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-2 rounded-lg transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div id="notification" class="notification">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-xl">
                    <i class="fas fa-exclamation-circle text-red-600 dark:text-red-400 text-xl"></i>
                </div>
            </div>
            <div class="ml-4 flex-1">
                <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">Error!</h4>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ session('error') }}</p>
            </div>
            <button onclick="hideNotification()" class="ml-4 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-2 rounded-lg transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
// ==========================================
// CHANGE TRACKING VARIABLES
// ==========================================
let changedFields = new Set();
let originalValues = {};

document.addEventListener('DOMContentLoaded', function() {
    setupMaintenanceStatusHandlers();
    updateStokInfo();
    initializeCharacterCounters();
    
    // Store original values untuk tracking
    const formElements = document.querySelectorAll('#maintenance-form input, #maintenance-form select, #maintenance-form textarea');
    formElements.forEach(element => {
        if (element.name && element.name !== '_token' && element.name !== '_method' && element.name !== 'aset_id') {
            originalValues[element.name] = element.value || '';
        }
    });
    
    console.log('✅ Original values stored for reset:', originalValues);
});

// ==========================================
// TRACK FIELD CHANGES
// ==========================================
function trackChanges(element) {
    const fieldName = element.name;
    const currentValue = element.value || '';
    const originalValue = originalValues[fieldName] || '';
    
    const isChanged = String(currentValue) !== String(originalValue);
    
    if (isChanged) {
        changedFields.add(fieldName);
        element.classList.add('field-modified');
    } else {
        changedFields.delete(fieldName);
        element.classList.remove('field-modified');
    }
    
    console.log(`Field ${fieldName} changed:`, isChanged, 'Total changes:', changedFields.size);
}

// ==========================================
// STOK INFO DISPLAY
// ==========================================
function updateStokInfo() {
    const stokTersedia = {{ $maintenance->barang->jumlah_tersedia ?? 0 }};
    const jumlahMaintenance = {{ $maintenance->jumlah ?? 1 }};
    const jumlahTotal = {{ $maintenance->barang->jumlah_total ?? 0 }};
    
    const stokInfoDiv = document.getElementById('stok-info');
    if (stokInfoDiv) {
        stokInfoDiv.innerHTML = `
            <div class="flex items-center gap-2 text-sm">
                <i class="fas fa-info-circle text-blue-500"></i>
                <span class="text-gray-600 dark:text-gray-400">
                    Stok tersedia: <span class="font-bold text-green-600 dark:text-green-400">${stokTersedia}</span> unit
                    <span class="text-gray-400">•</span>
                    Maintenance: <span class="font-bold text-orange-600 dark:text-orange-400">${jumlahMaintenance}</span> unit
                    <span class="text-gray-400">•</span>
                    Total: <span class="font-bold text-blue-600 dark:text-blue-400">${jumlahTotal}</span> unit
                </span>
            </div>
        `;
    }
    
    // Set max value for jumlah input (stok tersedia + unit yang sedang maintenance ini)
    const jumlahInput = document.getElementById('jumlah');
    if (jumlahInput) {
        const maxJumlah = stokTersedia + jumlahMaintenance;
        jumlahInput.max = maxJumlah;
        
        // Add validation on input
        jumlahInput.addEventListener('input', function() {
            validateJumlahInput(maxJumlah);
        });
    }
}

function validateJumlahInput(maxJumlah) {
    const jumlahInput = document.getElementById('jumlah');
    if (!jumlahInput) return;
    
    const jumlah = parseInt(jumlahInput.value) || 0;
    
    if (jumlah > maxJumlah) {
        jumlahInput.value = maxJumlah;
        showStatusNotification(`Jumlah maksimal ${maxJumlah} unit (${{{ $maintenance->barang->jumlah_tersedia ?? 0 }}} tersedia + ${{{ $maintenance->jumlah ?? 1 }}} maintenance ini)`, 'warning');
    }
    
    if (jumlah < 1) {
        jumlahInput.value = 1;
        showStatusNotification('Jumlah minimal 1 unit', 'warning');
    }
}

// ==========================================
// CHARACTER COUNTERS
// ==========================================
function initializeCharacterCounters() {
    const deskripsi = document.getElementById('deskripsi');
    if (deskripsi) {
        deskripsi.addEventListener('input', function() {
            updateCharCounter('deskripsi', 'char-count-deskripsi', 3000);
        });
        updateCharCounter('deskripsi', 'char-count-deskripsi', 3000);
    }
    
    const catatan = document.getElementById('catatan_penyelesaian');
    if (catatan) {
        catatan.addEventListener('input', function() {
            updateCharCounter('catatan_penyelesaian', 'char-count-catatan', 1000);
        });
        updateCharCounter('catatan_penyelesaian', 'char-count-catatan', 1000);
    }
}

function updateCharCounter(textareaId, counterId, maxLength) {
    const textarea = document.getElementById(textareaId);
    const counter = document.getElementById(counterId);
    
    if (textarea && counter) {
        const length = textarea.value.length;
        counter.textContent = `${length} / ${maxLength}`;
        
        if (length > maxLength * 0.9) {
            counter.classList.add('text-red-500', 'dark:text-red-400');
            counter.classList.remove('text-gray-500', 'dark:text-gray-400');
        } else {
            counter.classList.remove('text-red-500', 'dark:text-red-400');
            counter.classList.add('text-gray-500', 'dark:text-gray-400');
        }
    }
}

// ==========================================
// STATUS MANAGEMENT
// ==========================================
function updateStatusByDate() {
    const tanggalInput = document.getElementById('tanggal');
    const statusSelect = document.getElementById('status');
    
    if (!tanggalInput || !statusSelect) return;
    
    const selectedDate = new Date(tanggalInput.value);
    const today = new Date();
    
    selectedDate.setHours(0, 0, 0, 0);
    today.setHours(0, 0, 0, 0);
    
    // Skip auto-adjustment jika status sudah selesai atau dibatalkan
    if (['selesai', 'dibatalkan'].includes(statusSelect.value)) {
        updateStatusSelectUI();
        return;
    }
    
    if (selectedDate.getTime() === today.getTime()) {
        // Hari ini: set ke dalam_proses
        if (statusSelect.value !== 'dalam_proses') {
            statusSelect.value = 'dalam_proses';
            showStatusNotification('Status otomatis: Dalam Proses (maintenance hari ini)', 'info');
        }
    } else if (selectedDate > today) {
        // Masa depan: set ke dijadwalkan
        if (statusSelect.value !== 'dijadwalkan') {
            statusSelect.value = 'dijadwalkan';
            showStatusNotification('Status otomatis: Dijadwalkan (tanggal yang akan datang)', 'info');
        }
    }
    
    updateStatusSelectUI();
}

function updateStatusSelectUI() {
    const statusSelect = document.getElementById('status');
    const statusInfo = document.getElementById('status-info');
    
    if (!statusSelect || !statusInfo) return;
    
    const currentStatus = statusSelect.value;
    
    const statusMessages = {
        'dijadwalkan': {
            icon: 'fa-calendar-alt',
            text: 'Maintenance dijadwalkan untuk hari yang akan datang',
            color: 'text-blue-600 dark:text-blue-400'
        },
        'dalam_proses': {
            icon: 'fa-tools',
            text: 'Maintenance sedang berlangsung',
            color: 'text-orange-600 dark:text-orange-400'
        },
        'selesai': {
            icon: 'fa-check-circle',
            text: 'Maintenance telah selesai',
            color: 'text-green-600 dark:text-green-400'
        },
        'dibatalkan': {
            icon: 'fa-times-circle',
            text: 'Maintenance dibatalkan',
            color: 'text-red-600 dark:text-red-400'
        }
    };
    
    const config = statusMessages[currentStatus];
    
    if (config) {
        statusInfo.innerHTML = `
            <span class="${config.color} text-sm font-medium flex items-center gap-2">
                <i class="fas ${config.icon}"></i>
                ${config.text}
            </span>
        `;
    }
}

function validateDate() {
    const tanggalInput = document.getElementById('tanggal');
    if (!tanggalInput) return true;
    
    const selectedDate = new Date(tanggalInput.value);
    const today = new Date();
    
    selectedDate.setHours(0, 0, 0, 0);
    today.setHours(0, 0, 0, 0);
    
    if (selectedDate < today) {
        showStatusNotification('Tanggal tidak boleh di masa lalu! Minimal hari ini.', 'warning');
        tanggalInput.value = today.toISOString().split('T')[0];
        updateStatusByDate();
        return false;
    }
    
    return true;
}

function setupMaintenanceStatusHandlers() {
    const tanggalInput = document.getElementById('tanggal');
    const statusSelect = document.getElementById('status');
    
    if (tanggalInput) {
        const today = new Date().toISOString().split('T')[0];
        tanggalInput.setAttribute('min', today);
        
        tanggalInput.addEventListener('change', function() {
            if (validateDate()) {
                updateStatusByDate();
            }
        });
        
        // Prevent manual typing
        tanggalInput.addEventListener('keydown', function(e) {
            e.preventDefault();
            return false;
        });
    }
    
    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            const tanggal = tanggalInput ? new Date(tanggalInput.value) : null;
            const today = new Date();
            
            if (tanggal) {
                tanggal.setHours(0, 0, 0, 0);
                today.setHours(0, 0, 0, 0);
                
                // Validasi: dijadwalkan hanya untuk masa depan
                if (this.value === 'dijadwalkan' && tanggal.getTime() === today.getTime()) {
                    showStatusNotification('Status "Dijadwalkan" hanya untuk tanggal yang akan datang', 'warning');
                    this.value = 'dalam_proses';
                } 
                // Validasi: dalam_proses hanya untuk hari ini
                else if (this.value === 'dalam_proses' && tanggal > today) {
                    showStatusNotification('Status "Dalam Proses" hanya untuk hari ini', 'warning');
                    this.value = 'dijadwalkan';
                }
            }
            
            updateStatusSelectUI();
        });
        
        // Initialize UI
        updateStatusSelectUI();
    }
}

// ==========================================
// RESET CHANGES
// ==========================================
function resetChanges() {
    if (!confirm('Reset semua perubahan? Semua perubahan yang belum disimpan akan hilang.')) {
        return;
    }
    
    // Reset all changed fields to original values
    changedFields.forEach(fieldName => {
        const element = document.querySelector(`[name="${fieldName}"]`);
        if (element && originalValues[fieldName] !== undefined) {
            element.value = originalValues[fieldName];
            element.classList.remove('field-modified');
        }
    });
    
    // Clear changed fields tracking
    changedFields.clear();
    
    // Reset character counters
    updateCharCounter('deskripsi', 'char-count-deskripsi', 3000);
    updateCharCounter('catatan_penyelesaian', 'char-count-catatan', 1000);
    
    // Re-validate and update status based on date
    updateStatusByDate();
    updateStatusSelectUI();
    
    // Show success notification
    showNotification('✅ Perubahan berhasil direset ke nilai semula', 'success');
    
    console.log('✅ All changes have been reset');
}

// ==========================================
// NOTIFICATION SYSTEM
// ==========================================
function showStatusNotification(message, type = 'info') {
    // Remove existing status notifications
    const existingNotifs = document.querySelectorAll('.status-notification');
    existingNotifs.forEach(notif => notif.remove());
    
    const notification = document.createElement('div');
    notification.className = `status-notification fixed top-20 right-4 z-50 max-w-sm bg-white dark:bg-gray-800 rounded-lg shadow-lg border-l-4 ${
        type === 'info' ? 'border-blue-500' : 
        type === 'warning' ? 'border-yellow-500' : 
        type === 'success' ? 'border-green-500' : 'border-red-500'
    } p-4`;
    
    notification.style.animation = 'slideInRight 0.5s ease-out';
    
    const icon = type === 'info' ? 'info-circle' : 
                 type === 'warning' ? 'exclamation-triangle' : 
                 type === 'success' ? 'check-circle' : 'times-circle';
    
    const iconColor = type === 'info' ? 'text-blue-500' : 
                      type === 'warning' ? 'text-yellow-500' : 
                      type === 'success' ? 'text-green-500' : 'text-red-500';
    
    notification.innerHTML = `
        <div class="flex items-start">
            <i class="fas fa-${icon} ${iconColor} text-xl mr-3 mt-0.5"></i>
            <div class="flex-1">
                <p class="text-sm text-gray-700 dark:text-gray-300">${message}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" 
                    class="ml-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        if (notification.parentElement) {
            notification.style.animation = 'slideOutRight 0.5s ease-in forwards';
            setTimeout(() => notification.remove(), 500);
        }
    }, 4000);
}

function showNotification(message, type = 'info') {
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notif => notif.remove());
    
    const notification = document.createElement('div');
    notification.className = 'notification';
    
    const icons = {
        success: 'fas fa-check-circle text-green-600 dark:text-green-400',
        error: 'fas fa-exclamation-circle text-red-600 dark:text-red-400',
        warning: 'fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-400',
        info: 'fas fa-info-circle text-blue-600 dark:text-blue-400'
    };
    
    const colors = {
        success: 'bg-green-100 dark:bg-green-900/30',
        error: 'bg-red-100 dark:bg-red-900/30',
        warning: 'bg-yellow-100 dark:bg-yellow-900/30',
        info: 'bg-blue-100 dark:bg-blue-900/30'
    };
    
    notification.innerHTML = `
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <div class="p-3 ${colors[type]} rounded-xl">
                    <i class="${icons[type]} text-xl"></i>
                </div>
            </div>
            <div class="ml-4 flex-1">
                <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">${type.charAt(0).toUpperCase() + type.slice(1)}</h4>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">${message}</p>
            </div>
            <button onclick="hideNotification(this)" class="ml-4 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-2 rounded-lg transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    setTimeout(() => hideNotification(notification), 5000);
}

function hideNotification(element) {
    const notification = element.closest ? element.closest('.notification') : element;
    if (notification) {
        notification.style.animation = 'slideOutRight 0.5s ease-in forwards';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 500);
    }
}

// ==========================================
// FORM VALIDATION
// ==========================================
function validateForm() {
    const jenisMaintenance = document.getElementById('jenis_maintenance');
    if (!jenisMaintenance || !jenisMaintenance.value) {
        showNotification('Jenis maintenance harus dipilih', 'error');
        jenisMaintenance.focus();
        return false;
    }
    
    const tanggal = document.getElementById('tanggal');
    if (!tanggal || !tanggal.value) {
        showNotification('Tanggal maintenance harus diisi', 'error');
        tanggal.focus();
        return false;
    }
    
    const jumlah = document.getElementById('jumlah');
    if (!jumlah || !jumlah.value || parseInt(jumlah.value) < 1) {
        showNotification('Jumlah unit minimal 1', 'error');
        jumlah.focus();
        return false;
    }
    
    const maxJumlah = parseInt(jumlah.max) || 0;
    if (parseInt(jumlah.value) > maxJumlah) {
        showNotification(`Jumlah maksimal ${maxJumlah} unit`, 'error');
        jumlah.focus();
        return false;
    }
    
    const deskripsi = document.getElementById('deskripsi');
    if (!deskripsi || !deskripsi.value.trim()) {
        showNotification('Deskripsi harus diisi', 'error');
        deskripsi.focus();
        return false;
    }
    
    const status = document.getElementById('status');
    if (!status || !status.value) {
        showNotification('Status harus dipilih', 'error');
        status.focus();
        return false;
    }
    
    const biaya = document.getElementById('biaya');
    if (!biaya || !biaya.value || parseFloat(biaya.value) < 0) {
        showNotification('Biaya harus diisi dengan nilai valid', 'error');
        biaya.focus();
        return false;
    }
    
    return true;
}

// ==========================================
// FORM SUBMISSION
// ==========================================
document.getElementById('maintenance-form').addEventListener('submit', function(e) {
    if (!validateForm()) {
        e.preventDefault();
        return false;
    }
    
    const loadingOverlay = document.getElementById('loading-overlay');
    if (loadingOverlay) loadingOverlay.classList.remove('hidden');
    
    const submitBtn = document.getElementById('submit-btn');
    const submitText = document.getElementById('submit-text');
    
    if (submitBtn && submitText) {
        submitBtn.disabled = true;
        submitText.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memperbarui...';
    }
});

// ==========================================
// PREVENT MULTIPLE SUBMISSIONS
// ==========================================
let isSubmitting = false;
document.addEventListener('submit', function(e) {
    if (e.target.id === 'maintenance-form') {
        if (isSubmitting) {
            e.preventDefault();
            showNotification('Form sedang diproses. Mohon tunggu...', 'warning');
            return false;
        }
        isSubmitting = true;
        setTimeout(() => { isSubmitting = false; }, 10000);
    }
});

// ==========================================
// AUTO HIDE NOTIFICATIONS ON PAGE LOAD
// ==========================================
@if(session('success') || session('error'))
setTimeout(() => {
    const notification = document.getElementById('notification');
    if (notification) hideNotification(notification);
}, 5000);
@endif

// ==========================================
// ADD SLIDE OUT ANIMATION
// ==========================================
const style = document.createElement('style');
style.textContent = `
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
`;
document.head.appendChild(style);

// ==========================================
// CONSOLE LOGGING
// ==========================================
console.log('%c✅ Maintenance Edit Page Loaded', 'color: #3B82F6; font-size: 14px; font-weight: bold;');
console.log('%c🔒 Barang Field Locked (Cannot Change)', 'color: #F59E0B; font-size: 12px; font-weight: bold;');
console.log('%c🌓 Dark Mode Support Active!', 'color: #10B981; font-size: 12px;');
console.log('%c📝 Auto Status Management Active!', 'color: #8B5CF6; font-size: 12px;');
console.log('%c🔄 Change Tracking & Reset Active!', 'color: #EC4899; font-size: 12px;');
</script>

@endpush