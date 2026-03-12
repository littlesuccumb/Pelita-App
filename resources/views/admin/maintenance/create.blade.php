@extends('layouts.app')

@section('title', 'Tambah Data Maintenance - Admin')

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
    .filter-section {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .dark .filter-section {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-color: #334155;
    }

    .filter-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }

    .dark .filter-badge {
        background: #334155;
        border-color: #475569;
    }

    .filter-badge:hover {
        border-color: #3b82f6;
        transform: translateY(-1px);
    }

    .filter-badge.active {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        border-color: #3b82f6;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 2px solid #e5e7eb;
    }

    .dark .pagination-wrapper {
        border-color: #374151;
    }

    .pagination-info {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .dark .pagination-info {
        color: #9ca3af;
    }

    .pagination-links {
        display: flex;
        gap: 0.5rem;
    }

    .pagination-links a,
    .pagination-links span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2.5rem;
        height: 2.5rem;
        padding: 0 0.75rem;
        border: 2px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .dark .pagination-links a,
    .dark .pagination-links span {
        border-color: #4b5563;
        color: #9ca3af;
    }

    .pagination-links a {
        background: white;
        color: #374151;
    }

    .dark .pagination-links a {
        background: #374151;
    }

    .pagination-links a:hover {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
        transform: translateY(-2px);
    }

    .pagination-links .active {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        border-color: #3b82f6;
    }

    .pagination-links .disabled {
        opacity: 0.5;
        cursor: not-allowed;
        pointer-events: none;
    }

    .filter-toggle-btn {
        background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(139, 92, 246, 0.3);
    }

    .filter-toggle-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(139, 92, 246, 0.4);
    }

    .filter-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .filter-content.show {
        max-height: 500px;
    }

    @media (max-width: 768px) {
        .pagination-wrapper {
            flex-direction: column;
            gap: 1rem;
        }

        .filter-section {
            padding: 1rem;
        }
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

    /* Barang Card Styles */
    .barang-card {
        border: 2px solid #e5e7eb;
        border-radius: 1rem;
        padding: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
    }

    .dark .barang-card {
        background: #374151;
        border-color: #4b5563;
    }

    .barang-card:hover {
        border-color: #3b82f6;
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(59, 130, 246, 0.2);
    }

    .dark .barang-card:hover {
        border-color: #60a5fa;
        box-shadow: 0 8px 16px rgba(96, 165, 250, 0.3);
    }

    .barang-card.selected {
        border-color: #10b981;
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        box-shadow: 0 8px 16px rgba(16, 185, 129, 0.3);
    }

    .dark .barang-card.selected {
        background: linear-gradient(135deg, #064e3b 0%, #065f46 100%);
        border-color: #34d399;
    }

    .barang-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 0.75rem;
        border: 2px solid #e5e7eb;
    }

    .dark .barang-image {
        border-color: #4b5563;
    }

    .barang-image-placeholder {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #e5e7eb;
    }

    .dark .barang-image-placeholder {
        background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
        border-color: #4b5563;
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

    .search-box {
        position: relative;
    }

    .search-box input {
        padding-right: 3rem;
    }

    .search-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6b7280;
    }

    .dark .search-icon {
        color: #9ca3af;
    }

    @media (max-width: 768px) {
        .floating-label input,
        .floating-label textarea,
        .floating-label select {
            padding: 0.875rem 0.75rem;
            font-size: 16px;
        }

        .barang-card {
            padding: 0.75rem;
        }

        .barang-image,
        .barang-image-placeholder {
            width: 60px;
            height: 60px;
        }
    }
    /* Status Info Styles */
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

    /* Date Input Styles */
    input[type="date"] {
        position: relative;
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

    .dark input[type="date"]::-webkit-calendar-picker-indicator:hover {
        background: rgba(96, 165, 250, 0.2);
    }

    /* Notification Animation untuk Status */
    @keyframes slideInFromRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOutToRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
</style>
@endpush

@section('content')
<div class="w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 lg:py-4">     
        <!-- Breadcrumb (sama seperti sebelumnya) -->
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
                    <i class="fas fa-plus-circle"></i>
                    <span>Tambah Data Maintenance</span>
                </span>
            </div>
        </nav>

        <!-- Header Section (sama seperti sebelumnya) -->
        <div class="mb-8 animate-fade-in">
            <div class="relative overflow-hidden bg-gradient-to-br from-white via-orange-50/30 to-red-50/50 dark:from-gray-800 dark:via-gray-800/95 dark:to-gray-800/90 rounded-2xl shadow-xl border border-white/60 dark:border-gray-700 backdrop-blur-sm">
                
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-orange-400/20 via-red-400/20 to-pink-400/20 dark:from-orange-600/10 dark:via-red-600/10 dark:to-pink-600/10 rounded-full blur-3xl transform translate-x-32 -translate-y-32"></div>
                
                <div class="relative p-8 lg:p-10">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        
                        <div class="flex-1">
                            <div class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-orange-500/10 to-red-500/10 dark:from-orange-600/20 dark:to-red-600/20 border border-orange-200/50 dark:border-orange-700/50 rounded-full mb-4">
                                <div class="w-2 h-2 bg-orange-500 dark:bg-orange-400 rounded-full animate-pulse"></div>
                                <span class="text-sm font-semibold text-orange-700 dark:text-orange-300">Tambah Maintenance Baru</span>
                            </div>
                            
                            <h1 class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-orange-800 to-red-800 dark:from-slate-100 dark:via-orange-200 dark:to-red-200 bg-clip-text text-transparent leading-tight">
                                Tambah Data Maintenance
                            </h1>
                            
                            <p class="text-slate-600 dark:text-slate-300 text-lg flex items-center space-x-2">
                                <i class="fas fa-info-circle text-orange-500 dark:text-orange-400"></i>
                                <span>Catat pemeliharaan dan perbaikan barang inventaris</span>
                            </p>
                            
                            <div class="flex flex-wrap items-center gap-4 mt-6">
                                <div class="flex items-center space-x-2 px-4 py-2 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm rounded-lg border border-slate-200/50 dark:border-gray-600/50 shadow-sm">
                                    <div class="p-1.5 bg-orange-100 dark:bg-orange-900/50 rounded-md">
                                        <i class="fas fa-tools text-orange-600 dark:text-orange-400 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Barang Tersedia</p>
                                        <p class="text-lg font-bold text-slate-800 dark:text-slate-100">{{ $stats['total_barang'] ?? 0 }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center space-x-2 px-4 py-2 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm rounded-lg border border-blue-200/50 dark:border-blue-800/50 shadow-sm">
                                    <div class="p-1.5 bg-blue-100 dark:bg-blue-900/50 rounded-md">
                                        <i class="fas fa-cubes text-blue-600 dark:text-blue-400 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Total Unit</p>
                                        <p class="text-lg font-bold text-slate-800 dark:text-slate-100">{{ number_format($stats['total_unit'] ?? 0) }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-2 px-4 py-2 bg-white/70 dark:bg-gray-700/70 backdrop-blur-sm rounded-lg border border-purple-200/50 dark:border-purple-800/50 shadow-sm">
                                    <div class="p-1.5 bg-purple-100 dark:bg-purple-900/50 rounded-md">
                                        <i class="fas fa-tags text-purple-600 dark:text-purple-400 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Kategori</p>
                                        <p class="text-lg font-bold text-slate-800 dark:text-slate-100">{{ $stats['kategori_count'] ?? 0 }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Kembali Button -->
                        <div class="flex flex-col gap-3">
                            <a href="{{ route('admin.maintenance.index') }}" 
                            class="group relative inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 w-full">
                                <i class="fas fa-arrow-left mr-2.5"></i>
                                <span class="relative">Kembali ke Daftar</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="h-1.5 bg-gradient-to-r from-orange-500 via-red-500 to-pink-500"></div>
            </div>
        </div>

        <!-- Progress Indicator (sama seperti sebelumnya) -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 mb-8 animate-slide-up">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 flex items-center">
                    <i class="fas fa-chart-line text-blue-600 dark:text-blue-400 mr-2"></i>
                    Progress Pengisian Form
                </h3>
                <div class="flex items-center space-x-2">
                    <span id="progress-text" class="text-sm font-medium text-gray-600 dark:text-gray-400">0% Selesai</span>
                    <div class="bg-gray-100 dark:bg-gray-700 rounded-full px-3 py-1">
                        <span id="field-counter" class="text-xs font-semibold text-gray-700 dark:text-gray-300">0/7 Field</span>
                    </div>
                </div>
            </div>
            <div class="progress-bar">
                <div id="progress-fill" class="progress-fill" style="width: 0%"></div>
            </div>
        </div>

        <!-- Main Form -->
        <form action="{{ route('admin.maintenance.store') }}" method="POST" id="maintenance-form" class="animate-slide-up">
            @csrf
            
            <!-- ✅ BARU: Pilih Barang Section dengan Filter dan Pagination -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 card-hover">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-orange-50 via-red-50 to-pink-50 dark:from-orange-900/20 dark:via-red-900/20 dark:to-pink-900/20 rounded-t-2xl">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="p-3 bg-gradient-to-r from-orange-500 to-red-600 rounded-xl mr-4 shadow-lg">
                                <i class="fas fa-box text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Pilih Barang</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Pilih barang yang akan di-maintenance</p>
                            </div>
                        </div>
                        <button type="button" 
                                onclick="toggleFilters()"
                                class="filter-toggle-btn">
                            <i class="fas fa-filter mr-2"></i>
                            Filter & Urutkan
                        </button>
                    </div>
                </div>
                
                <div class="p-8">
                    <!-- ✅ BARU: Filter Section (Collapsible) -->
                    <div id="filter-content" class="filter-content">
                        <div class="filter-section">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <!-- Filter Kategori -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        <i class="fas fa-tag mr-1"></i>Kategori
                                    </label>
                                    <select name="kategori_id" 
                                            id="filter-kategori"
                                            onchange="applyFilters()"
                                            class="w-full px-3 py-2 border-2 border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-orange-500">
                                        <option value="">Semua Kategori</option>
                                        @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Filter Kondisi -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        <i class="fas fa-circle mr-1"></i>Kondisi
                                    </label>
                                    <select name="kondisi" 
                                            id="filter-kondisi"
                                            onchange="applyFilters()"
                                            class="w-full px-3 py-2 border-2 border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-orange-500">
                                        <option value="">Semua Kondisi</option>
                                        <option value="baik" {{ request('kondisi') == 'baik' ? 'selected' : '' }}>Baik</option>
                                        <option value="rusak ringan" {{ request('kondisi') == 'rusak ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                        <option value="rusak berat" {{ request('kondisi') == 'rusak berat' ? 'selected' : '' }}>Rusak Berat</option>
                                    </select>
                                </div>

                                <!-- Urutkan -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        <i class="fas fa-sort mr-1"></i>Urutkan
                                    </label>
                                    <select name="sort" 
                                            id="filter-sort"
                                            onchange="applyFilters()"
                                            class="w-full px-3 py-2 border-2 border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-orange-500">
                                        <option value="nama_barang-asc" {{ request('sort') == 'nama_barang' && request('order') == 'asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                                        <option value="nama_barang-desc" {{ request('sort') == 'nama_barang' && request('order') == 'desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                                        <option value="kode_barang-asc" {{ request('sort') == 'kode_barang' && request('order') == 'asc' ? 'selected' : '' }}>Kode (A-Z)</option>
                                        <option value="jumlah_tersedia-desc" {{ request('sort') == 'jumlah_tersedia' && request('order') == 'desc' ? 'selected' : '' }}>Stok Terbanyak</option>
                                        <option value="jumlah_tersedia-asc" {{ request('sort') == 'jumlah_tersedia' && request('order') == 'asc' ? 'selected' : '' }}>Stok Tersedikit</option>
                                    </select>
                                </div>

                                <!-- Per Page -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        <i class="fas fa-list mr-1"></i>Tampilkan
                                    </label>
                                    <select name="per_page" 
                                            id="filter-per-page"
                                            onchange="applyFilters()"
                                            class="w-full px-3 py-2 border-2 border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-orange-500">
                                        <option value="12" {{ request('per_page', 12) == 12 ? 'selected' : '' }}>12 per halaman</option>
                                        <option value="24" {{ request('per_page') == 24 ? 'selected' : '' }}>24 per halaman</option>
                                        <option value="48" {{ request('per_page') == 48 ? 'selected' : '' }}>48 per halaman</option>
                                        <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>Semua</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Active Filters & Reset -->
                            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex flex-wrap gap-2">
                                    @if(request()->hasAny(['kategori_id', 'kondisi', 'sort', 'per_page']))
                                    <span class="text-xs font-medium text-gray-600 dark:text-gray-400 mr-2">Filter Aktif:</span>
                                    
                                    @if(request('kategori_id'))
                                    <span class="filter-badge active">
                                        <i class="fas fa-tag text-xs"></i>
                                        {{ $kategoris->find(request('kategori_id'))->nama_kategori ?? '' }}
                                    </span>
                                    @endif

                                    @if(request('kondisi'))
                                    <span class="filter-badge active">
                                        <i class="fas fa-circle text-xs"></i>
                                        {{ ucfirst(request('kondisi')) }}
                                    </span>
                                    @endif
                                    @else
                                    <span class="text-sm text-gray-500 dark:text-gray-400">
                                        <i class="fas fa-info-circle mr-1"></i>Belum ada filter aktif
                                    </span>
                                    @endif
                                </div>

                                @if(request()->hasAny(['kategori_id', 'kondisi', 'sort', 'search']))
                                <a href="{{ route('admin.maintenance.create') }}" 
                                   class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-lg transition-all">
                                    <i class="fas fa-times mr-1"></i>Reset Filter
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Search Box -->
                    <div class="mb-6 search-box">
                        <input type="text" 
                               id="search-barang" 
                               value="{{ request('search') }}"
                               placeholder="Cari barang berdasarkan nama, kode, atau merk..."
                               class="w-full px-4 py-3 border-2 border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-orange-500 dark:focus:border-orange-400 focus:ring-4 focus:ring-orange-500/20">
                        <button type="button" 
                                onclick="searchBarang()" 
                                class="search-icon cursor-pointer hover:text-orange-600 dark:hover:text-orange-400">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>

                    <!-- Barang Grid -->
                    @if($barangs->count() > 0)
                    <div id="barang-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($barangs as $barang)
                        <div class="barang-card" 
                             data-barang-id="{{ $barang->id }}"
                             data-nama="{{ strtolower($barang->nama_barang) }}"
                             data-kode="{{ strtolower($barang->kode_barang) }}"
                             onclick="selectBarang({{ $barang->id }})">
                            <div class="flex gap-3">
                                <!-- Image -->
                                <div class="flex-shrink-0">
                                    @php
                                        $fotoUrl = $barang->foto_url;
                                        $hasImage = $fotoUrl && !str_contains($fotoUrl, 'no-image.png');
                                    @endphp
                                    
                                    @if($hasImage)
                                        <img src="{{ $fotoUrl }}" 
                                             alt="{{ $barang->nama_barang }}"
                                             class="barang-image"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="barang-image-placeholder" style="display: none;">
                                            <i class="fas fa-image text-gray-400 dark:text-gray-500 text-2xl"></i>
                                        </div>
                                    @else
                                        <div class="barang-image-placeholder">
                                            <i class="fas fa-image text-gray-400 dark:text-gray-500 text-2xl"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Info -->
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-gray-900 dark:text-gray-100 mb-1 truncate">
                                        {{ $barang->nama_barang }}
                                    </h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                                        <i class="fas fa-barcode mr-1"></i>{{ $barang->kode_barang }}
                                    </p>
                                    
                                    <div class="flex flex-wrap gap-2 mb-2">
                                        <span class="badge badge-{{ $barang->kondisi === 'baik' ? 'success' : ($barang->kondisi === 'rusak ringan' ? 'warning' : 'danger') }}">
                                            <i class="fas fa-circle text-xs mr-1"></i>
                                            {{ ucfirst($barang->kondisi) }}
                                        </span>
                                        @if($barang->kategori)
                                        <span class="badge bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                            <i class="fas fa-tag text-xs mr-1"></i>
                                            {{ $barang->kategori->nama_kategori }}
                                        </span>
                                        @endif
                                    </div>

                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-gray-600 dark:text-gray-400">
                                            <i class="fas fa-cubes mr-1"></i>
                                            Tersedia: <strong class="text-green-600 dark:text-green-400">{{ $barang->jumlah_tersedia }}</strong>
                                        </span>
                                        @if($barang->merk)
                                        <span class="text-gray-500 dark:text-gray-400">
                                            <i class="fas fa-copyright mr-1"></i>{{ $barang->merk }}
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Checkmark -->
                                <div class="flex-shrink-0">
                                    <div class="checkmark hidden w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- ✅ BARU: Pagination -->
                    @if($barangs->hasPages() && request('per_page') != 'all')
                    <div class="pagination-wrapper">
                        <div class="pagination-info">
                            Menampilkan <strong>{{ $barangs->firstItem() }}</strong> 
                            sampai <strong>{{ $barangs->lastItem() }}</strong> 
                            dari <strong>{{ $barangs->total() }}</strong> barang
                        </div>
                        
                        <div class="pagination-links">
                            {{-- Previous --}}
                            @if ($barangs->onFirstPage())
                                <span class="disabled">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            @else
                                <a href="{{ $barangs->previousPageUrl() }}">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            @endif

                            {{-- Page Numbers --}}
                            @foreach ($barangs->getUrlRange(1, $barangs->lastPage()) as $page => $url)
                                @if ($page == $barangs->currentPage())
                                    <span class="active">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}">{{ $page }}</a>
                                @endif
                            @endforeach

                            {{-- Next --}}
                            @if ($barangs->hasMorePages())
                                <a href="{{ $barangs->nextPageUrl() }}">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            @else
                                <span class="disabled">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                    @endif

                    @else
                    <div class="text-center py-12">
                        <i class="fas fa-box-open text-gray-300 dark:text-gray-600 text-6xl mb-4"></i>
                        <p class="text-gray-500 dark:text-gray-400 mb-4">Tidak ada barang ditemukan</p>
                        @if(request()->hasAny(['kategori_id', 'kondisi', 'search']))
                        <a href="{{ route('admin.maintenance.create') }}" 
                           class="inline-block px-6 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg transition-all">
                            <i class="fas fa-times mr-2"></i>Reset Pencarian
                        </a>
                        @endif
                    </div>
                    @endif

                    <!-- Hidden Input -->
                    <input type="hidden" name="barang_id" id="barang_id" value="{{ old('barang_id') }}">
                    
                    @error('barang_id')
                    <div class="error-message mt-4">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>

            <!-- Barang Info Preview (sama seperti sebelumnya) -->
            <div id="barang-info" class="hidden bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-2xl shadow-lg border border-green-200 dark:border-green-800 p-6 mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-lg font-bold text-green-800 dark:text-green-300 flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        Barang Dipilih
                    </h4>
                    <button type="button" onclick="clearSelection()" class="text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium">
                        <i class="fas fa-times mr-1"></i>Batal Pilih
                    </button>
                </div>
                <div id="selected-barang-detail" class="bg-white dark:bg-gray-800 rounded-xl p-4 border border-green-200 dark:border-green-700">
                    <!-- Will be filled by JavaScript -->
                </div>
            </div>

            <!-- Form Details (sama seperti sebelumnya - tidak ada perubahan) -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 card-hover">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 dark:from-blue-900/20 dark:via-indigo-900/20 dark:to-purple-900/20 rounded-t-2xl">
                    <div class="flex items-center">
                        <div class="p-3 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl mr-4 shadow-lg">
                            <i class="fas fa-info-circle text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Detail Maintenance</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Informasi lengkap mengenai maintenance yang akan dilakukan</p>
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
                                        class="form-input input-with-icon @error('jenis_maintenance') error @enderror">
                                    <option value="">Pilih Jenis Maintenance</option>
                                    <option value="preventif" {{ old('jenis_maintenance') == 'preventif' ? 'selected' : '' }}>Preventif (Pencegahan)</option>
                                    <option value="korektif" {{ old('jenis_maintenance') == 'korektif' ? 'selected' : '' }}>Korektif (Perbaikan)</option>
                                    <option value="emergency" {{ old('jenis_maintenance') == 'emergency' ? 'selected' : '' }}>Emergency (Darurat)</option>
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
                                    name="tanggal_maintenance" 
                                    id="tanggal_maintenance" 
                                    value="{{ old('tanggal_maintenance', date('Y-m-d')) }}"
                                    min="{{ date('Y-m-d') }}"
                                    required
                                    class="form-input input-with-icon @error('tanggal_maintenance') error @enderror"
                                    placeholder=" ">
                                <label for="tanggal_maintenance">Tanggal Maintenance <span class="required-asterisk">*</span></label>
                            </div>
                            <div class="mt-2 text-xs text-blue-600 dark:text-blue-400">
                                <i class="fas fa-info-circle mr-1"></i>
                                Minimal hari ini, tidak bisa memilih tanggal yang sudah lewat
                            </div>
                            @error('tanggal_maintenance')
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
                                       value="{{ old('jumlah', 1) }}"
                                       min="1"
                                       required
                                       class="form-input input-with-icon @error('jumlah') error @enderror"
                                       placeholder=" ">
                                <label for="jumlah">Jumlah Unit <span class="required-asterisk">*</span></label>
                            </div>
                            <div id="stok-info" class="hidden mt-2 text-sm text-gray-600 dark:text-gray-400">
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
                                       value="{{ old('teknisi') }}"
                                       maxlength="255"
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
                                       value="{{ old('biaya', 0) }}"
                                       min="0"
                                       step="0.01"
                                       class="form-input input-with-icon @error('biaya') error @enderror"
                                       placeholder=" ">
                                <label for="biaya">Estimasi Biaya (Rp)</label>
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
                                        class="form-input input-with-icon @error('status') error @enderror">
                                    <option value="">Pilih Status</option>
                                    <option value="dijadwalkan" {{ old('status') == 'dijadwalkan' ? 'selected' : '' }}>Dijadwalkan</option>
                                    <option value="dalam_proses" {{ old('status', 'dalam_proses') == 'dalam_proses' ? 'selected' : '' }}>Dalam Proses</option>
                                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="dibatalkan" {{ old('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                                <label for="status">Status <span class="required-asterisk">*</span></label>
                            </div>
                            <!-- ✅ TAMBAHKAN INI: Status Info Dynamic -->
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

                    <!-- Deskripsi Masalah -->
                    <div class="floating-label mt-6">
                        <div class="input-group">
                            <i class="input-icon fas fa-exclamation-circle"></i>
                            <textarea name="deskripsi_masalah" 
                                      id="deskripsi_masalah" 
                                      rows="4"
                                      required
                                      class="form-input input-with-icon @error('deskripsi_masalah') error @enderror"
                                      placeholder=" "
                                      maxlength="1000">{{ old('deskripsi_masalah') }}</textarea>
                            <label for="deskripsi_masalah">Deskripsi Masalah <span class="required-asterisk">*</span></label>
                        </div>
                        <div class="flex items-center justify-between mt-2 text-xs text-gray-500 dark:text-gray-400">
                            <span>
                                <i class="fas fa-info-circle mr-1"></i>
                                Jelaskan masalah atau kerusakan yang terjadi
                            </span>
                            <span id="char-count-masalah">0 / 1000</span>
                        </div>
                        @error('deskripsi_masalah')
                        <div class="error-message">
                            <i class="fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Tindakan -->
                    <div class="floating-label mt-6">
                        <div class="input-group">
                            <i class="input-icon fas fa-tasks"></i>
                            <textarea name="tindakan" 
                                      id="tindakan" 
                                      rows="4"
                                      required
                                      class="form-input input-with-icon @error('tindakan') error @enderror"
                                      placeholder=" "
                                      maxlength="1000">{{ old('tindakan') }}</textarea>
                            <label for="tindakan">Tindakan yang Dilakukan <span class="required-asterisk">*</span></label>
                        </div>
                        <div class="flex items-center justify-between mt-2 text-xs text-gray-500 dark:text-gray-400">
                            <span>
                                <i class="fas fa-info-circle mr-1"></i>
                                Jelaskan tindakan perbaikan atau maintenance yang akan/telah dilakukan
                            </span>
                            <span id="char-count-tindakan">0 / 1000</span>
                        </div>
                        @error('tindakan')
                        <div class="error-message">
                            <i class="fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Catatan -->
                    <div class="floating-label mt-6">
                        <div class="input-group">
                            <i class="input-icon fas fa-sticky-note"></i>
                            <textarea name="catatan" 
                                      id="catatan" 
                                      rows="3"
                                      class="form-input input-with-icon @error('catatan') error @enderror"
                                      placeholder=" "
                                      maxlength="500">{{ old('catatan') }}</textarea>
                            <label for="catatan">Catatan Tambahan</label>
                        </div>
                        <div class="flex items-center justify-between mt-2 text-xs text-gray-500 dark:text-gray-400">
                            <span>
                                <i class="fas fa-info-circle mr-1"></i>
                                Catatan atau informasi tambahan (opsional)
                            </span>
                            <span id="char-count-catatan">0 / 500</span>
                        </div>
                        @error('catatan')
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
                                <strong>Tips:</strong> Pastikan deskripsi masalah dan tindakan dijelaskan dengan detail untuk memudahkan tracking maintenance di masa depan.
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
                            <span>Pastikan semua informasi sudah benar sebelum menyimpan</span>
                        </div>
                        
                        <div class="flex gap-3">
                            <button type="button" 
                                    class="btn-back group inline-flex items-center px-5 py-2.5 text-sm font-medium rounded-xl bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-500 shadow-md hover:shadow-lg hover:from-gray-200 hover:to-gray-300 dark:hover:from-gray-600 dark:hover:to-gray-500 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300"
                                    data-confirm="Perubahan belum disimpan. Yakin ingin kembali?">
                                <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-300"></i>
                                Kembali
                            </button>
                            
                            <button type="button" 
                                    onclick="resetForm()"
                                    class="group inline-flex items-center px-5 py-2.5 text-sm font-medium rounded-xl bg-gradient-to-r from-yellow-500 to-amber-500 text-white shadow-md hover:shadow-lg hover:shadow-yellow-500/30 hover:from-yellow-400 hover:to-amber-400 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
                                <i class="fas fa-undo-alt mr-2 group-hover:-rotate-180 transition-transform duration-500"></i>
                                Reset
                            </button>
                            
                            <button type="submit" 
                                    id="submit-btn"
                                    class="group inline-flex items-center px-6 py-2.5 text-sm font-medium rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md hover:shadow-lg hover:shadow-blue-500/30 hover:from-blue-500 hover:to-indigo-500 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
                                <i class="fas fa-save mr-2 group-hover:scale-110 transition-transform duration-300"></i>
                                <span id="submit-text">Simpan Maintenance</span>
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
                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Menyimpan Data</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Mohon tunggu, sedang memproses data maintenance...</p>
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
const barangData = @json($barangData);
const totalFields = 7;
let filledFields = 0;
let selectedBarangId = null;

document.addEventListener('DOMContentLoaded', function() {
    initializeEventListeners();
    updateProgress();
    loadDraft();
    setupAutoSave();
    setupMaintenanceStatusHandlers(); // ✅ ADDED: Initialize status management
    
    // Restore selected barang if from old input
    @if(old('barang_id'))
    selectBarang({{ old('barang_id') }});
    @endif
});

// ==========================================
// AUTO STATUS MANAGEMENT BERDASARKAN TANGGAL
// ==========================================

/**
 * Update status maintenance otomatis berdasarkan tanggal yang dipilih
 */
function updateStatusByDate() {
    const tanggalInput = document.getElementById('tanggal_maintenance');
    const statusSelect = document.getElementById('status');
    
    if (!tanggalInput || !statusSelect) return;
    
    const selectedDate = new Date(tanggalInput.value);
    const today = new Date();
    
    // Reset waktu ke 00:00:00 untuk perbandingan tanggal saja
    selectedDate.setHours(0, 0, 0, 0);
    today.setHours(0, 0, 0, 0);
    
    // Jika tanggal dipilih adalah hari ini
    if (selectedDate.getTime() === today.getTime()) {
        statusSelect.value = 'dalam_proses';
        showStatusNotification('Status otomatis: Dalam Proses (hari ini)', 'info');
    } 
    // Jika tanggal di masa depan
    else if (selectedDate > today) {
        statusSelect.value = 'dijadwalkan';
        showStatusNotification('Status otomatis: Dijadwalkan (hari yang akan datang)', 'info');
    }
    
    // Update UI select
    updateStatusSelectUI();
}

/**
 * Set minimum date untuk input tanggal (minimal hari ini)
 */
function setMinimumDate() {
    const tanggalInput = document.getElementById('tanggal_maintenance');
    if (!tanggalInput) return;
    
    const today = new Date();
    const formattedDate = today.toISOString().split('T')[0];
    
    tanggalInput.setAttribute('min', formattedDate);
    
    // Set default value ke hari ini jika belum ada value
    if (!tanggalInput.value) {
        tanggalInput.value = formattedDate;
        updateStatusByDate();
    }
}

/**
 * Update UI status select (readonly jika auto)
 */
function updateStatusSelectUI() {
    const statusSelect = document.getElementById('status');
    const statusInfo = document.getElementById('status-info');
    
    if (!statusSelect) return;
    
    const currentStatus = statusSelect.value;
    
    // Update info text
    if (statusInfo) {
        let infoText = '';
        let infoClass = '';
        
        switch(currentStatus) {
            case 'dijadwalkan':
                infoText = '<i class="fas fa-calendar-alt"></i> Maintenance dijadwalkan untuk hari yang akan datang';
                infoClass = 'text-blue-600 dark:text-blue-400';
                break;
            case 'dalam_proses':
                infoText = '<i class="fas fa-tools"></i> Maintenance sedang berlangsung hari ini';
                infoClass = 'text-orange-600 dark:text-orange-400';
                break;
            case 'selesai':
                infoText = '<i class="fas fa-check-circle"></i> Maintenance telah selesai';
                infoClass = 'text-green-600 dark:text-green-400';
                break;
            case 'dibatalkan':
                infoText = '<i class="fas fa-times-circle"></i> Maintenance dibatalkan';
                infoClass = 'text-red-600 dark:text-red-400';
                break;
        }
        
        statusInfo.innerHTML = `<span class="${infoClass} text-sm font-medium">${infoText}</span>`;
    }
}

/**
 * Show status notification
 */
function showStatusNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `fixed top-20 right-4 z-50 max-w-sm bg-white dark:bg-gray-800 rounded-lg shadow-lg border-l-4 ${
        type === 'info' ? 'border-blue-500' : 
        type === 'warning' ? 'border-yellow-500' : 
        type === 'success' ? 'border-green-500' : 'border-red-500'
    } p-4 animate-slide-in-right`;
    
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
                    class="ml-3 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 4 seconds
    setTimeout(() => {
        if (notification.parentElement) {
            notification.style.animation = 'slide-out-right 0.3s ease-out';
            setTimeout(() => notification.remove(), 300);
        }
    }, 4000);
}

/**
 * Validasi tanggal tidak boleh masa lalu
 */
function validateDate() {
    const tanggalInput = document.getElementById('tanggal_maintenance');
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

/**
 * Setup event listeners untuk tanggal dan status
 */
function setupMaintenanceStatusHandlers() {
    const tanggalInput = document.getElementById('tanggal_maintenance');
    const statusSelect = document.getElementById('status');
    
    if (tanggalInput) {
        // Set minimum date
        setMinimumDate();
        
        // Event listener untuk perubahan tanggal
        tanggalInput.addEventListener('change', function() {
            if (validateDate()) {
                updateStatusByDate();
            }
        });
        
        // Prevent manual input (force date picker)
        tanggalInput.addEventListener('keydown', function(e) {
            e.preventDefault();
            return false;
        });
    }
    
    if (statusSelect) {
        // Event listener untuk perubahan status manual
        statusSelect.addEventListener('change', function() {
            const tanggal = tanggalInput ? new Date(tanggalInput.value) : null;
            const today = new Date();
            
            if (tanggal) {
                tanggal.setHours(0, 0, 0, 0);
                today.setHours(0, 0, 0, 0);
                
                // Jika user manual ganti status, cek konsistensi
                if (this.value === 'dijadwalkan' && tanggal.getTime() === today.getTime()) {
                    showStatusNotification('Status "Dijadwalkan" hanya untuk tanggal yang akan datang', 'warning');
                    this.value = 'dalam_proses';
                } else if (this.value === 'dalam_proses' && tanggal > today) {
                    showStatusNotification('Status "Dalam Proses" hanya untuk hari ini', 'warning');
                    this.value = 'dijadwalkan';
                }
            }
            
            updateStatusSelectUI();
        });
        
        // Initial UI update
        updateStatusSelectUI();
    }
}

// ==========================================
// FILTER & SEARCH FUNCTIONS
// ==========================================

// Toggle filter section
function toggleFilters() {
    const filterContent = document.getElementById('filter-content');
    filterContent.classList.toggle('show');
}

// Apply filters
function applyFilters() {
    const kategoriId = document.getElementById('filter-kategori').value;
    const kondisi = document.getElementById('filter-kondisi').value;
    const sortValue = document.getElementById('filter-sort').value;
    const perPage = document.getElementById('filter-per-page').value;
    const search = document.getElementById('search-barang').value;
    
    // Parse sort value
    const [sortBy, order] = sortValue.split('-');
    
    // Build URL with parameters
    const params = new URLSearchParams();
    if (kategoriId) params.append('kategori_id', kategoriId);
    if (kondisi) params.append('kondisi', kondisi);
    if (sortBy) params.append('sort', sortBy);
    if (order) params.append('order', order);
    if (perPage && perPage !== '12') params.append('per_page', perPage);
    if (search) params.append('search', search);
    
    // Redirect with filters
    window.location.href = '{{ route('admin.maintenance.create') }}' + (params.toString() ? '?' + params.toString() : '');
}

// Search barang (apply search filter)
function searchBarang() {
    const searchValue = document.getElementById('search-barang').value;
    
    const params = new URLSearchParams(window.location.search);
    if (searchValue) {
        params.set('search', searchValue);
    } else {
        params.delete('search');
    }
    
    window.location.href = '{{ route('admin.maintenance.create') }}' + (params.toString() ? '?' + params.toString() : '');
}

// Enter key for search
document.getElementById('search-barang')?.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        searchBarang();
    }
});

// ==========================================
// FORM INITIALIZATION & EVENT LISTENERS
// ==========================================

function initializeEventListeners() {
    // Progress tracking
    const formInputs = ['barang_id', 'jenis_maintenance', 'tanggal_maintenance', 'jumlah', 'deskripsi_masalah', 'tindakan', 'status'];
    formInputs.forEach(inputId => {
        const element = document.getElementById(inputId);
        if (element) {
            element.addEventListener('change', updateProgress);
            element.addEventListener('input', updateProgress);
        }
    });

    // Character counters
    setupCharCounter('deskripsi_masalah', 'char-count-masalah', 1000);
    setupCharCounter('tindakan', 'char-count-tindakan', 1000);
    setupCharCounter('catatan', 'char-count-catatan', 500);

    // Jumlah validation
    const jumlahInput = document.getElementById('jumlah');
    if (jumlahInput) {
        jumlahInput.addEventListener('input', validateJumlah);
    }
}

function setupCharCounter(textareaId, counterId, maxLength) {
    const textarea = document.getElementById(textareaId);
    const counter = document.getElementById(counterId);
    
    if (textarea && counter) {
        textarea.addEventListener('input', function() {
            const length = this.value.length;
            counter.textContent = `${length} / ${maxLength}`;
            
            if (length > maxLength * 0.9) {
                counter.classList.add('text-red-500', 'dark:text-red-400');
                counter.classList.remove('text-gray-500', 'dark:text-gray-400');
            } else {
                counter.classList.remove('text-red-500', 'dark:text-red-400');
                counter.classList.add('text-gray-500', 'dark:text-gray-400');
            }
        });
        
        textarea.dispatchEvent(new Event('input'));
    }
}

// ==========================================
// BARANG SELECTION FUNCTIONS
// ==========================================

function selectBarang(barangId) {
    document.querySelectorAll('.barang-card').forEach(card => {
        card.classList.remove('selected');
        card.querySelector('.checkmark').classList.add('hidden');
    });

    const selectedCard = document.querySelector(`[data-barang-id="${barangId}"]`);
    if (selectedCard) {
        selectedCard.classList.add('selected');
        selectedCard.querySelector('.checkmark').classList.remove('hidden');
    }

    document.getElementById('barang_id').value = barangId;
    selectedBarangId = barangId;

    showBarangInfo(barangId);
    updateProgress();

    setTimeout(() => {
        document.getElementById('barang-info').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }, 300);
}

function showBarangInfo(barangId) {
    const barang = barangData[barangId];
    if (!barang) return;

    const infoSection = document.getElementById('barang-info');
    const detailContainer = document.getElementById('selected-barang-detail');

    const kondisiBadge = barang.kondisi === 'baik' ? 'badge-success' : 
                         (barang.kondisi === 'rusak ringan' ? 'badge-warning' : 'badge-danger');

    detailContainer.innerHTML = `
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0">
                <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-box text-white text-2xl"></i>
                </div>
            </div>
            <div class="flex-1">
                <h5 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">${barang.nama}</h5>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm">
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 mb-1">Kode Barang</p>
                        <p class="font-semibold text-gray-900 dark:text-gray-100">${barang.kode}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 mb-1">Kategori</p>
                        <p class="font-semibold text-gray-900 dark:text-gray-100">${barang.kategori}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 mb-1">Kondisi</p>
                        <span class="badge ${kondisiBadge}">${barang.kondisi.charAt(0).toUpperCase() + barang.kondisi.slice(1)}</span>
                    </div>
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 mb-1">Stok Tersedia</p>
                        <p class="font-bold text-green-600 dark:text-green-400">${barang.jumlah_tersedia} Unit</p>
                    </div>
                </div>
            </div>
        </div>
    `;

    infoSection.classList.remove('hidden');

    const stokInfo = document.getElementById('stok-info');
    const stokTersedia = document.getElementById('stok-tersedia');
    if (stokInfo && stokTersedia) {
        stokTersedia.textContent = barang.jumlah_tersedia;
        stokInfo.classList.remove('hidden');
    }

    const jumlahInput = document.getElementById('jumlah');
    if (jumlahInput) {
        jumlahInput.max = barang.jumlah_tersedia;
    }
}

function clearSelection() {
    document.querySelectorAll('.barang-card').forEach(card => {
        card.classList.remove('selected');
        card.querySelector('.checkmark').classList.add('hidden');
    });

    document.getElementById('barang_id').value = '';
    selectedBarangId = null;
    document.getElementById('barang-info').classList.add('hidden');
    document.getElementById('stok-info').classList.add('hidden');

    updateProgress();
}

// ==========================================
// VALIDATION FUNCTIONS
// ==========================================

function validateJumlah() {
    const jumlahInput = document.getElementById('jumlah');
    if (!jumlahInput || !selectedBarangId) return;

    const jumlah = parseInt(jumlahInput.value) || 0;
    const barang = barangData[selectedBarangId];
    
    if (barang && jumlah > barang.jumlah_tersedia) {
        jumlahInput.value = barang.jumlah_tersedia;
        showNotification(`Jumlah maksimal ${barang.jumlah_tersedia} unit`, 'warning');
    }

    if (jumlah < 1) {
        jumlahInput.value = 1;
    }
}

function updateProgress() {
    filledFields = 0;

    const fieldsToCheck = [
        'barang_id',
        'jenis_maintenance',
        'tanggal_maintenance',
        'jumlah',
        'deskripsi_masalah',
        'tindakan',
        'status'
    ];

    fieldsToCheck.forEach(fieldId => {
        const element = document.getElementById(fieldId);
        if (element && element.value && element.value.trim() !== '') {
            filledFields++;
        }
    });

    const progress = Math.round((filledFields / totalFields) * 100);

    const progressFill = document.getElementById('progress-fill');
    const progressText = document.getElementById('progress-text');
    const fieldCounter = document.getElementById('field-counter');

    if (progressFill) progressFill.style.width = progress + '%';
    if (progressText) progressText.textContent = progress + '% Selesai';
    if (fieldCounter) fieldCounter.textContent = `${filledFields}/${totalFields} Field`;
}

// ==========================================
// FORM SUBMISSION & VALIDATION
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
        submitText.textContent = 'Menyimpan...';
    }

    localStorage.removeItem('maintenance_draft');
});

function validateForm() {
    if (!selectedBarangId) {
        showNotification('Silakan pilih barang terlebih dahulu', 'error');
        document.querySelector('.barang-card')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return false;
    }

    const jenisMaintenance = document.getElementById('jenis_maintenance');
    if (!jenisMaintenance || !jenisMaintenance.value) {
        showNotification('Jenis maintenance harus dipilih', 'error');
        jenisMaintenance.focus();
        return false;
    }

    const tanggal = document.getElementById('tanggal_maintenance');
    if (!tanggal || !tanggal.value) {
        showNotification('Tanggal maintenance harus diisi', 'error');
        tanggal.focus();
        return false;
    }

    const jumlah = document.getElementById('jumlah');
    const barang = barangData[selectedBarangId];
    
    if (!jumlah || !jumlah.value || parseInt(jumlah.value) < 1) {
        showNotification('Jumlah unit minimal 1', 'error');
        jumlah.focus();
        return false;
    }

    if (barang && parseInt(jumlah.value) > barang.jumlah_tersedia) {
        showNotification(`Stok tidak mencukupi! Maksimal ${barang.jumlah_tersedia} unit`, 'error');
        jumlah.focus();
        return false;
    }

    const deskripsiMasalah = document.getElementById('deskripsi_masalah');
    if (!deskripsiMasalah || !deskripsiMasalah.value.trim()) {
        showNotification('Deskripsi masalah harus diisi', 'error');
        deskripsiMasalah.focus();
        return false;
    }

    const tindakan = document.getElementById('tindakan');
    if (!tindakan || !tindakan.value.trim()) {
        showNotification('Tindakan harus diisi', 'error');
        tindakan.focus();
        return false;
    }

    const status = document.getElementById('status');
    if (!status || !status.value) {
        showNotification('Status harus dipilih', 'error');
        status.focus();
        return false;
    }

    return true;
}

function resetForm() {
    if (!confirm('Reset semua data form? Data yang sudah diisi akan dihapus.')) {
        return;
    }

    const form = document.getElementById('maintenance-form');
    if (form) form.reset();

    clearSelection();

    document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
    document.querySelectorAll('.error-message').forEach(el => el.remove());

    updateProgress();
    
    ['char-count-masalah', 'char-count-tindakan', 'char-count-catatan'].forEach(id => {
        const counter = document.getElementById(id);
        if (counter) {
            counter.textContent = '0 / ' + (id.includes('catatan') ? '500' : '1000');
            counter.classList.remove('text-red-500', 'dark:text-red-400');
            counter.classList.add('text-gray-500', 'dark:text-gray-400');
        }
    });

    localStorage.removeItem('maintenance_draft');
    showNotification('Form berhasil direset', 'success');
}

// ==========================================
// AUTO-SAVE & DRAFT MANAGEMENT
// ==========================================

let autoSaveTimer;
function setupAutoSave() {
    const formInputs = document.querySelectorAll('#maintenance-form input, #maintenance-form textarea, #maintenance-form select');

    formInputs.forEach(input => {
        input.addEventListener('input', function() {
            clearTimeout(autoSaveTimer);
            autoSaveTimer = setTimeout(saveDraft, 30000);
        });
    });
}

function saveDraft() {
    const formData = {
        barang_id: selectedBarangId,
        jenis_maintenance: document.getElementById('jenis_maintenance')?.value,
        tanggal_maintenance: document.getElementById('tanggal_maintenance')?.value,
        jumlah: document.getElementById('jumlah')?.value,
        teknisi: document.getElementById('teknisi')?.value,
        biaya: document.getElementById('biaya')?.value,
        status: document.getElementById('status')?.value,
        deskripsi_masalah: document.getElementById('deskripsi_masalah')?.value,
        tindakan: document.getElementById('tindakan')?.value,
        catatan: document.getElementById('catatan')?.value
    };

    if (formData.barang_id) {
        localStorage.setItem('maintenance_draft', JSON.stringify(formData));
    }
}

function loadDraft() {
    const draft = localStorage.getItem('maintenance_draft');
    if (!draft) return;

    try {
        const draftData = JSON.parse(draft);

        if (!draftData.barang_id) return;

        if (confirm('Ditemukan draft yang tersimpan. Apakah Anda ingin memuat data draft tersebut?')) {
            if (draftData.barang_id) {
                selectBarang(draftData.barang_id);
            }

            Object.keys(draftData).forEach(key => {
                if (key !== 'barang_id') {
                    const element = document.getElementById(key);
                    if (element && draftData[key]) {
                        element.value = draftData[key];
                    }
                }
            });

            updateProgress();

            ['deskripsi_masalah', 'tindakan', 'catatan'].forEach(id => {
                const textarea = document.getElementById(id);
                if (textarea) {
                    textarea.dispatchEvent(new Event('input'));
                }
            });

            localStorage.removeItem('maintenance_draft');
            showNotification('Draft berhasil dimuat', 'success');
        } else {
            localStorage.removeItem('maintenance_draft');
        }
    } catch (e) {
        console.error('Error loading draft:', e);
        localStorage.removeItem('maintenance_draft');
    }
}

// ==========================================
// NOTIFICATION SYSTEM
// ==========================================

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
// SECURITY & SESSION MANAGEMENT
// ==========================================

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

// Session management
let sessionTimeout;
function startSessionTimer() {
    clearTimeout(sessionTimeout);

    sessionTimeout = setTimeout(() => {
        if (confirm('Sesi akan berakhir dalam 5 menit. Klik OK untuk memperpanjang sesi.')) {
            startSessionTimer();
        } else {
            saveDraft();
            showNotification('Draft telah disimpan', 'success');
        }
    }, 25 * 60 * 1000);
}

['click', 'keypress', 'scroll', 'mousemove'].forEach(event => {
    document.addEventListener(event, function() {
        clearTimeout(sessionTimeout);
        setTimeout(startSessionTimer, 1000);
    });
});

startSessionTimer();

// ==========================================
// KEYBOARD SHORTCUTS
// ==========================================

document.addEventListener('keydown', function(e) {
    // Ctrl+S to submit
    if (e.ctrlKey && e.key === 's') {
        e.preventDefault();
        const submitBtn = document.getElementById('submit-btn');
        if (submitBtn) submitBtn.click();
    }

    // Ctrl+R to reset
    if (e.ctrlKey && e.key === 'r') {
        e.preventDefault();
        resetForm();
    }

    // Escape to clear selection or close filter
    if (e.key === 'Escape') {
        if (selectedBarangId) {
            clearSelection();
        } else {
            const filterContent = document.getElementById('filter-content');
            if (filterContent && filterContent.classList.contains('show')) {
                toggleFilters();
            }
        }
    }

    // Ctrl+F to toggle filters
    if (e.ctrlKey && e.key === 'f') {
        e.preventDefault();
        toggleFilters();
    }
});

// ==========================================
// AUTO HIDE NOTIFICATIONS
// ==========================================

@if(session('success') || session('error'))
setTimeout(() => {
    const notification = document.getElementById('notification');
    if (notification) hideNotification(notification);
}, 5000);
@endif

// ==========================================
// ERROR STATE HANDLING
// ==========================================

// Remove error state on input
document.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('input', function() {
        this.classList.remove('error');
    });
});

// ==========================================
// PREVENT MULTIPLE SUBMISSIONS
// ==========================================

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

// ==========================================
// ACTIVITY LOGGING
// ==========================================

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

logActivity('page_load', 'Maintenance create page loaded with filters and auto status management');

// ==========================================
// CSS ANIMATIONS FOR NOTIFICATIONS
// ==========================================

const style = document.createElement('style');
style.textContent = `
    @keyframes slide-in-right {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slide-out-right {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    .animate-slide-in-right {
        animation: slide-in-right 0.3s ease-out;
    }
`;
document.head.appendChild(style);

// ==========================================
// CONSOLE LOGGING
// ==========================================

console.log('%c✅ Maintenance Create Page Loaded', 'color: #F97316; font-size: 14px; font-weight: bold;');
console.log('%c🌓 Dark Mode Support Active!', 'color: #10B981; font-size: 12px;');
console.log('%c📦 Total Barang Tersedia: ' + Object.keys(barangData).length, 'color: #3B82F6; font-size: 12px;');
console.log('%c🔍 Filter & Pagination Active!', 'color: #8B5CF6; font-size: 12px;');
console.log('%c🤖 Auto Status Management Active!', 'color: #EC4899; font-size: 12px;');
</script>
@endpush