@extends('layouts.app')

@section('title', 'Edit Kategori Barang - Admin')

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
    
    @keyframes slideOutRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    
    .animate-fade-in { animation: fadeIn 0.6s ease-out; }
    .animate-slide-up { animation: slideUp 0.5s ease-out; }
    .animate-pulse-slow { animation: pulse 3s infinite; }
    
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
    .floating-label textarea {
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
    .dark .floating-label textarea {
        background: #374151;
        border-color: #4b5563;
        color: #f3f4f6;
    }
    
    .floating-label input.input-with-icon,
    .floating-label textarea.input-with-icon {
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
    .floating-label input.has-value + label,
    .floating-label textarea:focus + label,
    .floating-label textarea:not(:placeholder-shown) + label,
    .floating-label textarea.has-value + label {
        top: -0.5rem;
        left: 0.5rem;
        font-size: 0.75rem;
        color: #3b82f6;
        font-weight: 600;
        box-shadow: 0 0 0 4px white;
    }

    .dark .floating-label input:focus + label,
    .dark .floating-label input:not(:placeholder-shown) + label,
    .dark .floating-label input.has-value + label,
    .dark .floating-label textarea:focus + label,
    .dark .floating-label textarea:not(:placeholder-shown) + label,
    .dark .floating-label textarea.has-value + label {
        color: #60a5fa;
        box-shadow: 0 0 0 4px #374151;
    }
    
    .floating-label input:focus,
    .floating-label textarea:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1), 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transform: translateY(-1px);
    }

    .dark .floating-label input:focus,
    .dark .floating-label textarea:focus {
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
    
    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.6s;
    }
    
    .btn-primary:hover::before {
        left: 100%;
    }

    .existing-data-indicator {
        position: absolute;
        top: -0.25rem;
        right: -0.25rem;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        font-size: 0.6rem;
        font-weight: bold;
        padding: 0.125rem 0.375rem;
        border-radius: 0.375rem;
        box-shadow: 0 2px 4px rgba(16, 185, 129, 0.3);
        z-index: 10;
    }

    .dark .existing-data-indicator {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
    }
    
    .field-modified {
        border-color: #f59e0b !important;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1) !important;
    }

    .dark .field-modified {
        border-color: #fbbf24 !important;
        box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.2) !important;
    }
    
    .changes-summary {
        background: linear-gradient(135deg, #fff7ed 0%, #fed7aa 100%);
        border: 1px solid #f97316;
        border-left: 4px solid #f97316;
        border-radius: 0.75rem;
        padding: 1.25rem;
        margin: 1rem 0;
        box-shadow: 0 2px 8px rgba(249, 115, 22, 0.1);
    }

    .dark .changes-summary {
        background: linear-gradient(135deg, #7c2d12 0%, #9a3412 100%);
        border-color: #fb923c;
        box-shadow: 0 2px 8px rgba(251, 146, 60, 0.2);
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
    
    .form-input {
        transition: all 0.3s ease;
        border: 2px solid #e5e7eb;
    }
    
    .form-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        transform: scale(1.01);
    }

    .dark .form-input:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.2);
    }
    
    .form-input.error {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    .dark .form-input.error {
        border-color: #f87171;
        box-shadow: 0 0 0 3px rgba(248, 113, 113, 0.2);
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
    
    .progress-bar {
        width: 100%;
        height: 6px;
        background: #e5e7eb;
        border-radius: 3px;
        overflow: hidden;
        margin: 1rem 0;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .dark .progress-bar {
        background: #374151;
    }
    
    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #3b82f6, #10b981, #3b82f6);
        background-size: 200% 200%;
        border-radius: 3px;
        transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        animation: gradient 2s ease infinite;
    }
    
    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    @media (max-width: 768px) {
        .floating-label input,
        .floating-label textarea {
            padding: 0.875rem 0.75rem;
            font-size: 16px;
        }
    }
</style>
@endpush

@section('content')
<div class="w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 lg:py-4">     
    <!-- Breadcrumb Edit -->
    <nav class="mb-8 animate-fade-in" aria-label="Breadcrumb">
        <div class="breadcrumb-modern breadcrumb-edit">
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
                <i class="fas fa-edit"></i>
                <span>Edit {{ Str::limit($kategoriBarang->nama_kategori, 20) }}</span>
            </span>
        </div>
    </nav>

        <!-- Header Section -->
        <div class="mb-8 animate-fade-in">
            <div class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700">
                <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-orange-500/10 via-red-500/10 to-pink-500/10 dark:from-orange-600/20 dark:via-red-600/20 dark:to-pink-600/20 rounded-full transform translate-x-20 -translate-y-20"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-tr from-yellow-500/10 via-orange-500/10 to-red-500/10 dark:from-yellow-600/20 dark:via-orange-600/20 dark:to-red-600/20 rounded-full transform -translate-x-16 translate-y-16"></div>
                
                <div class="relative p-6 lg:p-8">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                        <div class="mb-6 lg:mb-0">
                            <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-2">
                                Edit Kategori Barang
                            </h1>
                            <p class="text-gray-600 dark:text-gray-400 text-lg">Perbarui informasi kategori barang dalam sistem</p>
                            <div class="mt-4 flex flex-wrap items-center gap-4">
                                <div class="flex items-center text-sm">
                                    <div class="px-3 py-1.5 bg-blue-100 dark:bg-blue-900/30 rounded-lg">
                                        <i class="fas fa-layer-group mr-2 text-blue-600 dark:text-blue-400"></i>
                                        <span class="font-semibold text-blue-800 dark:text-blue-300">Kategori:</span>
                                        <span class="ml-1 font-mono text-blue-900 dark:text-blue-200">{{ $kategoriBarang->nama_kategori }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center text-sm">
                                    <div class="px-3 py-1.5 bg-green-100 dark:bg-green-900/30 rounded-lg">
                                        <i class="fas fa-calendar mr-2 text-green-600 dark:text-green-400"></i>
                                        <span class="font-semibold text-green-800 dark:text-green-300">Update:</span>
                                        <span class="ml-1 text-green-900 dark:text-green-200">{{ $kategoriBarang->updated_at->format('d M Y H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                            <div class="p-4 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl shadow-lg animate-pulse-slow">
                                <i class="fas fa-edit text-white text-3xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Indicator -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 mb-8 animate-slide-up">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center">
                    <i class="fas fa-chart-line text-orange-600 dark:text-orange-400 mr-2"></i>
                    Status Perubahan Form
                </h3>
                <div class="flex items-center space-x-2">
                    <span id="progress-text" class="text-sm font-medium text-gray-600 dark:text-gray-400">Belum Ada Perubahan</span>
                    <div class="bg-gray-100 dark:bg-gray-700 rounded-full px-3 py-1">
                        <span id="field-counter" class="text-xs font-semibold text-gray-700 dark:text-gray-300">0/2 Field Diubah</span>
                    </div>
                </div>
            </div>
            <div class="progress-bar">
                <div id="progress-fill" class="progress-fill" style="width: 0%"></div>
            </div>
        </div>

        <!-- Changes Summary -->
        <div id="changes-summary" class="changes-summary hidden">
            <div class="flex items-center justify-between mb-3">
                <h4 class="text-sm font-bold text-orange-800 dark:text-orange-300 flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Perubahan Terdeteksi
                </h4>
                <div class="bg-orange-200 dark:bg-orange-900/50 text-orange-800 dark:text-orange-200 text-xs font-bold px-2 py-1 rounded-full">
                    <span id="changes-count">0</span> Field
                </div>
            </div>
            <div id="changes-list" class="text-sm text-orange-700 dark:text-orange-300 space-y-1"></div>
        </div>

        <!-- Info Card -->
        <div class="info-card animate-slide-up">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-xl">
                        <i class="fas fa-info-circle text-blue-600 dark:text-blue-400 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <h4 class="text-sm font-bold text-blue-800 dark:text-blue-300 mb-2">Informasi Penting</h4>
                    <ul class="text-sm text-blue-700 dark:text-blue-400 space-y-1">
                        <li class="flex items-start">
                            <i class="fas fa-check-circle mr-2 mt-0.5 flex-shrink-0"></i>
                            <span>Kategori ini digunakan oleh <strong>{{ $kategoriBarang->barang_count ?? 0 }} barang</strong></span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-exclamation-circle mr-2 mt-0.5 flex-shrink-0"></i>
                            <span>Perubahan nama kategori akan mempengaruhi semua barang yang terkait</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-shield-alt mr-2 mt-0.5 flex-shrink-0"></i>
                            <span>Nama kategori harus unik dalam sistem</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Form -->
        <form action="{{ route('admin.kategori-barang.update', $kategoriBarang->id) }}" method="POST" id="kategori-form" class="animate-slide-up">
            @csrf
            @method('PUT')
            
            <!-- Form Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 card-hover">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 dark:from-blue-900/20 dark:via-indigo-900/20 dark:to-purple-900/20 rounded-t-2xl">
                    <div class="flex items-center">
                        <div class="p-3 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl mr-4 shadow-lg">
                            <i class="fas fa-info-circle text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Informasi Kategori</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Data kategori untuk pengelompokan barang inventaris</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-8">
                    <!-- Nama Kategori -->
                    <div class="floating-label mb-8">
                        <div class="input-group relative">
                            <i class="input-icon fas fa-tag"></i>
                            <input type="text" 
                                   name="nama_kategori" 
                                   id="nama_kategori" 
                                   value="{{ old('nama_kategori', $kategoriBarang->nama_kategori) }}"
                                   required
                                   class="form-input input-with-icon @error('nama_kategori') error @enderror has-value"
                                   placeholder=" "
                                   maxlength="255"
                                   data-original="{{ $kategoriBarang->nama_kategori }}"
                                   autofocus>
                            <label for="nama_kategori">Nama Kategori <span class="required-asterisk">*</span></label>
                            <div class="existing-data-indicator">EXISTING</div>
                        </div>
                        @error('nama_kategori')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="info-card mt-3">
                            <p class="text-sm text-blue-700 dark:text-blue-300 flex items-start">
                                <i class="fas fa-lightbulb mt-0.5 mr-2 flex-shrink-0"></i>
                                <span>
                                    Gunakan nama yang jelas dan deskriptif. Nama kategori harus unik dalam sistem.
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="floating-label">
                        <div class="input-group relative">
                            <i class="input-icon fas fa-align-left"></i>
                            <textarea name="deskripsi" 
                                      id="deskripsi" 
                                      rows="5"
                                      class="form-input input-with-icon @error('deskripsi') error @enderror {{ old('deskripsi', $kategoriBarang->deskripsi) ? 'has-value' : '' }}"
                                      placeholder=" "
                                      maxlength="1000"
                                      data-original="{{ $kategoriBarang->deskripsi }}">{{ old('deskripsi', $kategoriBarang->deskripsi) }}</textarea>
                            <label for="deskripsi">Deskripsi Kategori</label>
                            @if($kategoriBarang->deskripsi)
                                <div class="existing-data-indicator">EXISTING</div>
                            @endif
                        </div>
                        @error('deskripsi')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="flex items-center justify-between mt-2 text-xs text-gray-500 dark:text-gray-400">
                            <span>
                                <i class="fas fa-info-circle mr-1"></i>
                                Jelaskan kategori ini untuk memudahkan pengelolaan barang
                            </span>
                            <span id="char-count">{{ strlen(old('deskripsi', $kategoriBarang->deskripsi ?? '')) }} / 1000</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview Section -->
            <div id="preview-section" class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-2xl shadow-lg border border-green-200 dark:border-green-800 p-6 mb-8 hidden">
                <h4 class="text-lg font-bold text-green-800 dark:text-green-300 mb-4 flex items-center">
                    <i class="fas fa-eye mr-2"></i>
                    Preview Kategori
                </h4>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-green-200 dark:border-green-700">
                    <div class="flex items-start">
                        <div class="h-12 w-12 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg mr-4 flex-shrink-0">
                            <i class="fas fa-layer-group text-white text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h5 id="preview-nama" class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">-</h5>
                            <p id="preview-deskripsi" class="text-sm text-gray-600 dark:text-gray-400">-</p>
                        </div>
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
                                <span id="submit-text">Update Kategori Barang</span>
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
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Menyimpan Perubahan</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Mohon tunggu, sedang memproses perubahan data...</p>
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
// Change tracking variables
const totalFields = 2;
let changedFields = new Set();
let originalValues = {};
let filledFields = 0;

// Initialize form
document.addEventListener('DOMContentLoaded', function() {
    const namaInput = document.getElementById('nama_kategori');
    const deskripsiInput = document.getElementById('deskripsi');
    
    // Store original values
    const formElements = document.querySelectorAll('#kategori-form input, #kategori-form textarea');
    formElements.forEach(element => {
        if (element.dataset.original !== undefined) {
            originalValues[element.name] = element.dataset.original;
        }
        
        // Handle floating labels for pre-filled fields
        if (element.value && element.value.trim() !== '') {
            element.classList.add('has-value');
        }
    });
    
    // Add event listeners
    if (namaInput) {
        namaInput.addEventListener('input', trackChanges);
        namaInput.addEventListener('input', updatePreview);
        namaInput.addEventListener('input', validateNamaKategori);
    }
    
    if (deskripsiInput) {
        deskripsiInput.addEventListener('input', trackChanges);
        deskripsiInput.addEventListener('input', updatePreview);
        deskripsiInput.addEventListener('input', updateCharCount);
    }
    
    updateCharCount();
    updatePreview();
    
    console.log('✅ Kategori Barang edit form initialized with dark mode support');
});

// Track field changes
function trackChanges(e) {
    const element = e.target;
    const fieldName = element.name;
    const currentValue = element.value;
    const originalValue = originalValues[fieldName] || '';
    
    const isChanged = String(currentValue) !== String(originalValue);
    
    if (isChanged) {
        changedFields.add(fieldName);
        element.classList.add('field-modified');
    } else {
        changedFields.delete(fieldName);
        element.classList.remove('field-modified');
    }
    
    updateChangesUI();
}

// Update changes UI
function updateChangesUI() {
    const changesCount = changedFields.size;
    const changesSummary = document.getElementById('changes-summary');
    const changesCountElement = document.getElementById('changes-count');
    const changesListElement = document.getElementById('changes-list');
    const submitBtn = document.getElementById('submit-btn');
    const resetBtn = document.getElementById('reset-btn');
    const progressFill = document.getElementById('progress-fill');
    const progressText = document.getElementById('progress-text');
    const fieldCounter = document.getElementById('field-counter');
    
    if (changesCount > 0) {
        if (changesSummary) changesSummary.classList.remove('hidden');
        if (changesCountElement) changesCountElement.textContent = changesCount;
        
        const changesList = Array.from(changedFields).map(fieldName => {
            const label = getFieldLabel(fieldName);
            return `• ${label}`;
        }).join('<br>');
        
        if (changesListElement) changesListElement.innerHTML = changesList;
        
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        }
        if (resetBtn) {
            resetBtn.disabled = false;
            resetBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        }
        
        // Update progress bar
        const progress = Math.round((changesCount / totalFields) * 100);
        if (progressFill) progressFill.style.width = progress + '%';
        if (progressText) progressText.textContent = `${changesCount} Field Diubah`;
        if (fieldCounter) fieldCounter.textContent = `${changesCount}/${totalFields} Field Diubah`;
    } else {
        if (changesSummary) changesSummary.classList.add('hidden');
        
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
        if (resetBtn) {
            resetBtn.disabled = true;
            resetBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
        
        // Reset progress bar
        if (progressFill) progressFill.style.width = '0%';
        if (progressText) progressText.textContent = 'Belum Ada Perubahan';
        if (fieldCounter) fieldCounter.textContent = '0/2 Field Diubah';
    }
}

// Get field label
function getFieldLabel(fieldName) {
    const labelMap = {
        'nama_kategori': 'Nama Kategori',
        'deskripsi': 'Deskripsi'
    };
    
    return labelMap[fieldName] || fieldName;
}

// Update preview
function updatePreview() {
    const namaInput = document.getElementById('nama_kategori');
    const deskripsiInput = document.getElementById('deskripsi');
    const previewSection = document.getElementById('preview-section');
    const previewNama = document.getElementById('preview-nama');
    const previewDeskripsi = document.getElementById('preview-deskripsi');
    
    if (!namaInput || !deskripsiInput || !previewSection) return;
    
    const nama = namaInput.value.trim();
    const deskripsi = deskripsiInput.value.trim();
    
    if (changedFields.size > 0) {
        if (previewSection) previewSection.classList.remove('hidden');
        if (previewNama) previewNama.textContent = nama || '-';
        if (previewDeskripsi) previewDeskripsi.textContent = deskripsi || 'Tidak ada deskripsi';
    } else {
        if (previewSection) previewSection.classList.add('hidden');
    }
}

// Update character count
function updateCharCount() {
    const deskripsiInput = document.getElementById('deskripsi');
    const charCount = document.getElementById('char-count');
    
    if (deskripsiInput && charCount) {
        const length = deskripsiInput.value.length;
        charCount.textContent = `${length} / 1000`;
        
        if (length > 900) {
            charCount.classList.add('text-red-500', 'dark:text-red-400');
            charCount.classList.remove('text-gray-500', 'dark:text-gray-400');
        } else {
            charCount.classList.remove('text-red-500', 'dark:text-red-400');
            charCount.classList.add('text-gray-500', 'dark:text-gray-400');
        }
    }
}

// Validate nama kategori
function validateNamaKategori(e) {
    const input = e.target;
    const value = input.value;
    
    const dangerousPatterns = [/<script/i, /javascript:/i, /on\w+\s*=/i];
    if (dangerousPatterns.some(pattern => pattern.test(value))) {
        input.value = value.replace(/[<>'"]/g, '');
        showNotification('Karakter berbahaya dihapus dari input', 'warning');
    }
}

// Reset changes
function resetChanges() {
    if (!confirm('Reset semua perubahan? Semua perubahan yang belum disimpan akan hilang.')) {
        return;
    }
    
    changedFields.forEach(fieldName => {
        const element = document.querySelector(`[name="${fieldName}"]`);
        if (element && originalValues[fieldName] !== undefined) {
            element.value = originalValues[fieldName];
            element.classList.remove('field-modified');
        }
    });
    
    changedFields.clear();
    updateChangesUI();
    updatePreview();
    updateCharCount();
    
    showNotification('Perubahan berhasil direset', 'success');
}

// Form submission
document.getElementById('kategori-form').addEventListener('submit', function(e) {
    if (changedFields.size === 0) {
        e.preventDefault();
        showNotification('Tidak ada perubahan yang perlu disimpan', 'warning');
        return false;
    }
    
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
        submitText.textContent = 'Menyimpan...';
    }
});

// Validate form
function validateForm() {
    let isValid = true;
    const errors = [];
    
    const namaKategori = document.getElementById('nama_kategori');
    if (namaKategori && !namaKategori.value.trim()) {
        errors.push('Nama Kategori harus diisi');
        namaKategori.classList.add('error');
        isValid = false;
    } else if (namaKategori) {
        const nama = namaKategori.value.trim();
        if (nama.length < 3) {
            errors.push('Nama kategori minimal 3 karakter');
            namaKategori.classList.add('error');
            isValid = false;
        } else if (nama.length > 255) {
            errors.push('Nama kategori maksimal 255 karakter');
            namaKategori.classList.add('error');
            isValid = false;
        } else {
            namaKategori.classList.remove('error');
        }
    }
    
    if (!isValid) {
        showNotification(`Terdapat ${errors.length} kesalahan pada form. Silakan periksa kembali.`, 'error');
        
        const firstError = document.querySelector('.error');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            setTimeout(() => firstError.focus(), 500);
        }
    }
    
    return isValid;
}

// Notification system
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

// Input security
document.addEventListener('input', function(e) {
    const target = e.target;
    
    if ((target.type === 'text' || target.tagName === 'TEXTAREA') && target.name !== '_token') {
        const dangerousPatterns = [/<script/i, /javascript:/i, /on\w+\s*=/i];
        if (dangerousPatterns.some(pattern => pattern.test(target.value))) {
            target.value = target.value.replace(/[<>'"]/g, '');
            showNotification('Karakter berbahaya dihapus dari input', 'warning');
        }
    }
});

// Remove error state on input
document.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('input', function() {
        this.classList.remove('error');
    });
});

// Prevent multiple submissions
let isSubmitting = false;
document.addEventListener('submit', function(e) {
    if (isSubmitting) {
        e.preventDefault();
        showNotification('Form sedang diproses. Mohon tunggu...', 'warning');
        return false;
    }
    isSubmitting = true;
    setTimeout(() => { isSubmitting = false; }, 10000);
});

// Auto hide existing notifications
@if(session('success') || session('error'))
setTimeout(() => {
    const notification = document.getElementById('notification');
    if (notification) hideNotification(notification);
}, 5000);
@endif

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    if (e.ctrlKey && e.key === 's') {
        e.preventDefault();
        const submitBtn = document.getElementById('submit-btn');
        if (submitBtn && !submitBtn.disabled) submitBtn.click();
    }
    
    if (e.ctrlKey && e.key === 'r') {
        e.preventDefault();
        resetChanges();
    }
});

// Log activity
function logActivity(action, details = '') {
    const timestamp = new Date().toISOString();
    const logData = {
        timestamp: timestamp,
        action: action,
        details: details,
        url: window.location.href
    };
    
    const logs = JSON.parse(localStorage.getItem('activityLogs') || '[]');
    logs.push(logData);
    if (logs.length > 100) logs.shift();
    localStorage.setItem('activityLogs', JSON.stringify(logs));
}

logActivity('page_load', 'Kategori Barang edit page loaded');

// Console log with dark mode
console.log('%c✅ Kategori Barang Edit Page Loaded', 'color: #F97316; font-size: 14px; font-weight: bold;');
console.log('%c🌓 Dark Mode Support Active!', 'color: #10B981; font-size: 12px;');
</script>
@endpush