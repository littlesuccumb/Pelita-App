@extends('layouts.app')

@section('title', 'Edit Peminjaman - Admin')

@push('styles')
<style>
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes slideUp {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    /* Dark mode transitions */
    * {
        transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
    }
    
    .animate-fade-in { animation: fadeIn 0.6s ease-out; }
    .animate-slide-up { animation: slideUp 0.5s ease-out; }
    .animate-bounce-slow { animation: bounce 2s infinite; }
    .animate-pulse-slow { animation: pulse 3s infinite; }
    
    .card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .dark .card-hover:hover {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5), 0 10px 10px -5px rgba(0, 0, 0, 0.3);
    }
    
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }
    
    .dark .glass-card {
        background: rgba(31, 41, 55, 0.95);
        border: 1px solid rgba(75, 85, 99, 0.3);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
    }
    
    .section-divider {
        position: relative;
        margin: 2rem 0;
        text-align: center;
    }
    
    .section-divider::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        height: 1px;
        background: linear-gradient(to right, transparent, #e5e7eb, transparent);
    }
    
    .dark .section-divider::before {
        background: linear-gradient(to right, transparent, #4b5563, transparent);
    }
    
    .section-divider-text {
        background: white;
        padding: 0 1rem;
        color: #6b7280;
        font-size: 0.875rem;
        font-weight: 600;
        position: relative;
    }
    
    .dark .section-divider-text {
        background: #1f2937;
        color: #9ca3af;
    }
    
    .floating-label {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .floating-label input,
    .floating-label select,
    .floating-label textarea {
        width: 100%;
        padding: 1rem 1rem 1rem 0.75rem;
        border: 2px solid #e5e7eb;
        border-radius: 0.75rem;
        background: white;
        outline: none;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        color: #111827;
    }
    
    .dark .floating-label input,
    .dark .floating-label select,
    .dark .floating-label textarea {
        background: #374151;
        border-color: #4b5563;
        color: #f3f4f6;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }
    
    .floating-label input.input-with-icon,
    .floating-label select.input-with-icon,
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
    .floating-label select:focus + label,
    .floating-label select:not([value=""]) + label,
    .floating-label textarea:focus + label,
    .floating-label textarea:not(:placeholder-shown) + label {
        top: -0.5rem;
        left: 0.5rem;
        font-size: 0.75rem;
        color: #3b82f6;
        font-weight: 600;
        box-shadow: 0 0 0 4px white;
    }
    
    .dark .floating-label input:focus + label,
    .dark .floating-label input:not(:placeholder-shown) + label,
    .dark .floating-label select:focus + label,
    .dark .floating-label select:not([value=""]) + label,
    .dark .floating-label textarea:focus + label,
    .dark .floating-label textarea:not(:placeholder-shown) + label {
        color: #60a5fa;
        box-shadow: 0 0 0 4px #374151;
    }
    
    .floating-label input:focus,
    .floating-label select:focus,
    .floating-label textarea:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1), 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transform: translateY(-1px);
    }
    
    .dark .floating-label input:focus,
    .dark .floating-label select:focus,
    .dark .floating-label textarea:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 4px rgba(96, 165, 250, 0.2), 0 4px 6px -1px rgba(0, 0, 0, 0.3);
    }
    
    .input-with-icon {
        padding-left: 3rem;
    }
    
    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6b7280;
        z-index: 10;
        transition: color 0.3s ease;
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
    
    .dark .btn-primary {
        background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
        box-shadow: 0 4px 14px 0 rgba(96, 165, 250, 0.4);
    }
    
    .btn-primary:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.5);
    }
    
    .dark .btn-primary:hover:not(:disabled) {
        box-shadow: 0 8px 25px rgba(96, 165, 250, 0.5);
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

    .btn-primary:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    
    .btn-secondary {
        background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px 0 rgba(107, 114, 128, 0.3);
    }
    
    .dark .btn-secondary {
        background: linear-gradient(135deg, #9ca3af 0%, #6b7280 100%);
    }
    
    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(107, 114, 128, 0.4);
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
    }
    
    .field-modified {
        border-color: #f59e0b !important;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1) !important;
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
        background: linear-gradient(135deg, #0c4a6e 0%, #075985 100%);
        border-color: #0ea5e9;
        box-shadow: 0 2px 8px rgba(14, 165, 233, 0.3);
    }
    
    .warning-card {
        background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
        border: 1px solid #f59e0b;
        border-left: 4px solid #f59e0b;
        border-radius: 0.75rem;
        padding: 1.25rem;
        margin: 1rem 0;
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.1);
    }
    
    .dark .warning-card {
        background: linear-gradient(135deg, #78350f 0%, #92400e 100%);
        border-color: #fbbf24;
        box-shadow: 0 2px 8px rgba(251, 191, 36, 0.3);
    }
    
    .success-card {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        border: 1px solid #22c55e;
        border-left: 4px solid #22c55e;
        border-radius: 0.75rem;
        padding: 1.25rem;
        margin: 1rem 0;
        box-shadow: 0 2px 8px rgba(34, 197, 94, 0.1);
    }
    
    .dark .success-card {
        background: linear-gradient(135deg, #14532d 0%, #166534 100%);
        border-color: #22c55e;
        box-shadow: 0 2px 8px rgba(34, 197, 94, 0.3);
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
        border-color: #f87171;
    }
    
    .form-step {
        opacity: 1;
        transform: scale(0.98);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .form-step.active {
        opacity: 1;
        transform: scale(1);
    }
    
    .required-asterisk {
        color: #ef4444;
        font-weight: bold;
        margin-left: 3px;
        animation: pulse 2s infinite;
    }
    
    .dark .required-asterisk {
        color: #fca5a5;
    }
    
    .form-input {
        transition: all 0.3s ease;
        border: 2px solid #e5e7eb;
    }
    
    .dark .form-input {
        border-color: #4b5563;
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
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5);
    }

    .notification-success {
        border-left: 4px solid #10b981;
    }

    .dark .notification-success {
        border-left-color: #34d399;
    }

    .notification-error {
        border-left: 4px solid #ef4444;
    }

    .dark .notification-error {
        border-left-color: #f87171;
    }

    .notification-warning {
        border-left: 4px solid #f59e0b;
    }

    .dark .notification-warning {
        border-left-color: #fbbf24;
    }

    .notification-info {
        border-left: 4px solid #3b82f6;
    }

    .dark .notification-info {
        border-left-color: #60a5fa;
    }
    
    @keyframes slideOutRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    
    .smart-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }
    
    .barang-item-editable {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        border: 2px solid #22c55e;
        border-radius: 0.75rem;
        padding: 1rem;
        padding-top: 3rem;
        margin-bottom: 0.75rem;
        position: relative;
        transition: all 0.3s ease;
    }

    .dark .barang-item-editable {
        background: linear-gradient(135deg, #14532d 0%, #166534 100%);
        border-color: #22c55e;
    }

    .barang-item-editable:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(34, 197, 94, 0.2);
    }

    .remove-barang-btn {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        width: 32px;
        height: 32px;
        background: #ef4444;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
        box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);
        z-index: 20;
    }

    .remove-barang-btn:hover {
        background: #dc2626;
        transform: scale(1.05);
    }

    .remove-barang-btn:active {
        transform: scale(0.95);
    }
    
    .user-avatar {
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .dark .user-avatar {
        border-color: #374151;
    }
    
    .user-avatar-initials {
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1.5rem;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        border: 3px solid white;
    }
    
    .dark .user-avatar-initials {
        background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
        border-color: #374151;
    }

    .cost-summary {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        border: 2px solid #fbbf24;
        border-radius: 0.75rem;
        padding: 1.5rem;
    }

    .dark .cost-summary {
        background: linear-gradient(135deg, #78350f 0%, #92400e 100%);
        border-color: #fbbf24;
    }

    @media (max-width: 768px) {
        .smart-grid {
            grid-template-columns: 1fr;
        }
        
        .floating-label input,
        .floating-label select,
        .floating-label textarea {
            padding: 0.875rem 0.75rem;
            font-size: 16px;
        }
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 lg:py-4">
    
    {{-- Modern Breadcrumb Navigation --}}
    <nav class="mb-8 animate-fade-in" aria-label="Breadcrumb">
        <div class="breadcrumb-modern breadcrumb-edit">
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
            
            <a href="{{ route('admin.peminjaman.show', $peminjaman->id) }}" class="breadcrumb-link">
                <i class="fas fa-eye"></i>
                <span>Detail Peminjaman</span>
            </a>
            
            <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs"></i>
            
            <span class="breadcrumb-current">
                <i class="fas fa-edit"></i>
                <span>Edit Peminjaman</span>
            </span>
        </div>
    </nav>

    {{-- Modern Header Section --}}
    <div class="mb-8 animate-fade-in">
        <div class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700">
            
            {{-- Background Decorations --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-orange-400/20 via-red-400/20 to-pink-400/20 dark:from-orange-600/5 dark:via-red-600/5 dark:to-pink-600/5 rounded-full blur-3xl transform translate-x-32 -translate-y-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-yellow-400/15 to-orange-400/15 dark:from-yellow-600/5 dark:to-orange-600/5 rounded-full blur-2xl transform -translate-x-24 translate-y-24"></div>
            
            {{-- Floating Dots --}}
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute top-10 left-10 w-2 h-2 bg-orange-400 dark:bg-orange-500 rounded-full animate-pulse opacity-60"></div>
                <div class="absolute top-20 right-20 w-1.5 h-1.5 bg-red-400 dark:bg-red-500 rounded-full animate-pulse opacity-40" style="animation-delay: 0.5s;"></div>
                <div class="absolute bottom-16 left-1/3 w-1 h-1 bg-pink-400 dark:bg-pink-500 rounded-full animate-pulse opacity-50" style="animation-delay: 1s;"></div>
            </div>
            
            <div class="relative p-8 lg:p-10">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    
                    <div class="flex-1">
                        {{-- Status Badge --}}
                        <div class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-orange-500/10 to-red-500/10 dark:from-orange-600/20 dark:to-red-600/20 border border-orange-200/50 dark:border-orange-700/50 rounded-full mb-4">
                            <div class="w-2 h-2 bg-orange-500 dark:bg-orange-400 rounded-full animate-pulse"></div>
                            <span class="text-sm font-semibold text-orange-700 dark:text-orange-300">Form Edit Peminjaman</span>
                        </div>
                        
                        {{-- Title --}}
                        <h1 class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-orange-800 to-red-800 dark:from-slate-100 dark:via-orange-200 dark:to-red-200 bg-clip-text text-transparent leading-tight">
                            Edit Peminjaman
                        </h1>
                        
                        {{-- Description --}}
                        <p class="text-slate-600 dark:text-slate-400 text-lg flex items-center space-x-2 mb-4">
                            <i class="fas fa-info-circle text-orange-500 dark:text-orange-400"></i>
                            <span>Ubah barang, jumlah, tanggal, dan keperluan peminjaman</span>
                        </p>
                        
                        {{-- Metadata --}}
                        <div class="flex flex-wrap items-center gap-4 text-sm">
                            <div class="flex items-center px-3 py-1.5 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                                <i class="fas fa-user mr-2 text-blue-600 dark:text-blue-400"></i>
                                <span class="font-semibold text-slate-700 dark:text-slate-300">Peminjam:</span>
                                <span class="ml-1 text-blue-700 dark:text-blue-300">{{ $peminjaman->user->name }}</span>
                            </div>
                            <div class="flex items-center px-3 py-1.5 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                                <i class="fas fa-calendar mr-2 text-green-600 dark:text-green-400"></i>
                                <span class="font-semibold text-slate-700 dark:text-slate-300">Status:</span>
                                <span class="ml-1 text-green-700 dark:text-green-300">{{ ucfirst($peminjaman->status) }}</span>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Icon --}}
                    <div class="flex items-center space-x-3">
                        <div class="p-4 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl shadow-lg">
                            <i class="fas fa-edit text-white text-3xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Bottom Gradient Line --}}
            <div class="h-1.5 bg-gradient-to-r from-orange-500 via-red-500 to-pink-500"></div>
        </div>
    </div>

    {{-- Status Info Box --}}
    <div class="success-card mb-6 animate-slide-up">
        <div class="flex items-start">
            <i class="fas fa-check-circle text-green-600 dark:text-green-400 mr-3 mt-0.5 text-xl"></i>
            <div class="text-sm text-green-800 dark:text-green-300">
                <strong>Mode Edit Penuh:</strong> Anda dapat mengubah semua data peminjaman (barang, jumlah, tanggal, keperluan) karena status masih <strong>"Menunggu"</strong>.
            </div>
        </div>
    </div>

    {{-- Main Form --}}
    <form action="{{ route('admin.peminjaman.update', $peminjaman->id) }}" method="POST" id="editForm">
        @csrf
        @method('PATCH')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            {{-- Left Column --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- 1. Informasi Peminjam --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 form-step active card-hover animate-slide-up">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 rounded-t-2xl">
                        <div class="flex items-center">
                            <div class="p-3 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl mr-4 shadow-lg">
                                <i class="fas fa-user text-white text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">1. Informasi Peminjam</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Data peminjam tidak dapat diubah</p>
                            </div>
                            <div class="ml-auto">
                                <div class="bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300 text-xs font-bold px-3 py-1 rounded-full">
                                    Step 1/4
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl border border-blue-200 dark:border-blue-800">
                            @if($peminjaman->user->avatar)
                                <img src="{{ asset('storage/' . $peminjaman->user->avatar) }}" 
                                     alt="{{ $peminjaman->user->name }}" 
                                     class="user-avatar flex-shrink-0"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="user-avatar-initials flex-shrink-0" style="display: none;">
                                    {{ strtoupper(substr($peminjaman->user->name, 0, 2)) }}
                                </div>
                            @else
                                <div class="user-avatar-initials flex-shrink-0">
                                    {{ strtoupper(substr($peminjaman->user->name, 0, 2)) }}
                                </div>
                            @endif
                            <div class="flex-1">
                                <div class="text-lg font-semibold text-gray-900 dark:text-white">{{ $peminjaman->user->name }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400 flex items-center mt-1">
                                    <i class="fas fa-envelope mr-2"></i>{{ $peminjaman->user->email }}
                                </div>
                                @if($peminjaman->user->nama_instansi)
                                    <div class="text-sm text-gray-500 dark:text-gray-400 flex items-center mt-1">
                                        <i class="fas fa-building mr-2"></i>{{ $peminjaman->user->nama_instansi }}
                                    </div>
                                @endif
                            </div>
                            <div class="existing-data-indicator">LOCKED</div>
                        </div>
                    </div>
                </div>

                {{-- 2. Barang yang Dipinjam --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 form-step active card-hover animate-slide-up">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-green-50 via-emerald-50 to-teal-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 rounded-t-2xl">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="p-3 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl mr-4 shadow-lg">
                                    <i class="fas fa-box-open text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">2. Barang yang Dipinjam</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Pilih barang dan tentukan jumlahnya</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300 text-xs font-bold px-3 py-1 rounded-full">
                                    Step 2/4
                                </div>
                                <span class="text-xs px-3 py-1 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-800 dark:text-emerald-300 rounded-full font-semibold">
                                    <i class="fas fa-edit mr-1"></i>Dapat Diubah
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <div class="info-card mb-4">
                            <div class="flex items-start">
                                <i class="fas fa-lightbulb text-blue-600 dark:text-blue-400 mr-2 mt-0.5"></i>
                                <div class="text-sm text-blue-800 dark:text-blue-300">
                                    <strong>Tips:</strong> Pilih barang dari dropdown dan atur jumlahnya. Klik "Tambah Barang Lain" untuk menambah item baru.
                                </div>
                            </div>
                        </div>

                        <div id="barang-container" class="space-y-3">
                            @foreach($peminjaman->peminjamanDetail as $index => $detail)
                            <div class="barang-item-editable" data-index="{{ $index }}">
                                @if($loop->count > 1)
                                <button type="button" class="remove-barang-btn" onclick="removeBarangFunc(this)">
                                    <i class="fas fa-times"></i>
                                </button>
                                @endif
                                
                                <div class="smart-grid">
                                    <div class="lg:col-span-2">
                                        <div class="floating-label">
                                            <div class="input-group relative">
                                                <i class="input-icon fas fa-box"></i>
                                                    <select name="barang[{{ $index }}][id]" 
                                                            class="form-input input-with-icon barang-select" 
                                                            required 
                                                            onchange="updateBarangInfo(this); trackChanges(this)">
                                                        <option value="">Pilih barang...</option>
                                                        @foreach($barang as $b)
                                                            <option value="{{ $b->id }}" 
                                                                    data-harga="{{ $b->harga_sewa }}"
                                                                    data-stok="{{ $b->jumlah_tersedia }}"
                                                                    data-nama="{{ $b->nama_barang }}"
                                                                    data-merk="{{ $b->merk ?? '' }}"
                                                                    data-type="{{ $b->type ?? '' }}"
                                                                    {{ $detail->barang_id == $b->id ? 'selected' : '' }}>
                                                                {{ $b->nama_barang }} @if($b->merk)- {{ $b->merk }}@endif (Stok: {{ $b->jumlah_tersedia }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                <label>Pilih Barang <span class="required-asterisk">*</span></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="floating-label">
                                            <div class="input-group relative">
                                                <i class="input-icon fas fa-hashtag"></i>
                                                <input type="number" 
                                                    name="barang[{{ $index }}][jumlah]" 
                                                    class="form-input input-with-icon jumlah-input"
                                                    min="1"
                                                    max="{{ $detail->barang->jumlah_tersedia }}"
                                                    value="{{ $detail->jumlah }}"
                                                    required
                                                    placeholder=" "
                                                    onchange="calculateCost(); trackChanges(this)"
                                                    oninput="trackChanges(this)">
                                                <label>Jumlah <span class="required-asterisk">*</span></label>
                                            </div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                Max: <span class="max-stok">{{ $detail->barang->jumlah_tersedia }}</span> unit
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3 p-3 bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-600 dark:text-gray-300">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            <span class="barang-info">{{ $detail->barang->nama_barang }} @if($detail->barang->merk)- {{ $detail->barang->merk }}@endif</span>
                                        </span>
                                        <span class="font-semibold text-green-600 dark:text-green-400 barang-harga" data-harga="{{ $detail->barang->harga_sewa }}">
                                            Rp {{ number_format($detail->barang->harga_sewa, 0, ',', '.') }}/hari
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button type="button" 
                                onclick="addBarangFunc()" 
                                class="mt-4 w-full px-4 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-lg font-semibold transition-all transform hover:scale-[1.02] shadow-lg">
                            <i class="fas fa-plus-circle mr-2"></i>Tambah Barang Lain
                        </button>
                    </div>
                </div>

                {{-- 3. Periode Peminjaman --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 form-step active card-hover animate-slide-up">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-purple-50 via-pink-50 to-rose-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 rounded-t-2xl">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="p-3 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl mr-4 shadow-lg">
                                    <i class="fas fa-calendar text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">3. Periode Peminjaman</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Tentukan tanggal mulai dan selesai peminjaman</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-300 text-xs font-bold px-3 py-1 rounded-full">
                                    Step 3/4
                                </div>
                                <span class="text-xs px-3 py-1 bg-pink-100 dark:bg-pink-900/50 text-pink-800 dark:text-pink-300 rounded-full font-semibold">
                                    <i class="fas fa-edit mr-1"></i>Dapat Diubah
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <div class="warning-card mb-4">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-triangle text-amber-600 dark:text-amber-400 mr-2 mt-0.5"></i>
                                <div class="text-sm text-amber-800 dark:text-amber-300">
                                    <strong>Perhatian:</strong> Durasi peminjaman maksimal 3 hari.
                                </div>
                            </div>
                        </div>

                        <div class="smart-grid">
                            <div class="floating-label">
                                <div class="input-group relative">
                                    <i class="input-icon fas fa-calendar-day"></i>
                                    <input type="date" 
                                           name="tanggal_mulai" 
                                           id="tanggal_mulai"
                                           class="form-input input-with-icon @error('tanggal_mulai') error @enderror"
                                           value="{{ old('tanggal_mulai', $peminjaman->tanggal_mulai) }}"
                                           min="{{ date('Y-m-d') }}"
                                           placeholder=" "
                                           onchange="trackChanges(this)"
                                           required>
                                    <label>Tanggal Mulai <span class="required-asterisk">*</span></label>
                                </div>
                                @error('tanggal_mulai')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="floating-label">
                                <div class="input-group relative">
                                    <i class="input-icon fas fa-calendar-check"></i>
                                    <input type="date" 
                                           name="tanggal_selesai" 
                                           id="tanggal_selesai"
                                           class="form-input input-with-icon @error('tanggal_selesai') error @enderror"
                                           value="{{ old('tanggal_selesai', $peminjaman->tanggal_selesai) }}"
                                           min="{{ date('Y-m-d') }}"
                                           placeholder=" "
                                           onchange="trackChanges(this)"
                                           required>
                                    <label>Tanggal Selesai <span class="required-asterisk">*</span></label>
                                </div>
                                @error('tanggal_selesai')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Maksimal 3 hari dari tanggal mulai</p>
                            </div>
                        </div>

                        <div class="mt-4 p-4 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-700 rounded-xl" id="duration-info">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">
                                    <i class="fas fa-clock mr-2 text-green-600 dark:text-green-400"></i>Durasi Peminjaman:
                                </span>
                                <span class="text-lg font-bold text-green-700 dark:text-green-400" id="duration-days">
                                    {{ \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($peminjaman->tanggal_selesai)) + 1 }} hari
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 4. Keperluan --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 form-step active card-hover animate-slide-up">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-orange-50 via-amber-50 to-yellow-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 rounded-t-2xl">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="p-3 bg-gradient-to-r from-orange-500 to-amber-600 rounded-xl mr-4 shadow-lg">
                                    <i class="fas fa-sticky-note text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">4. Keperluan Peminjaman</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Jelaskan tujuan peminjaman barang</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="bg-orange-100 dark:bg-orange-900/50 text-orange-800 dark:text-orange-300 text-xs font-bold px-3 py-1 rounded-full">
                                    Step 4/4
                                </div>
                                <span class="text-xs px-3 py-1 bg-amber-100 dark:bg-amber-900/50 text-amber-800 dark:text-amber-300 rounded-full font-semibold">
                                    <i class="fas fa-edit mr-1"></i>Dapat Diubah
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-8">
                        <div class="floating-label">
                            <div class="relative">
                                <textarea name="keperluan" 
                                          id="keperluan"
                                          rows="4"
                                          class="form-input @error('keperluan') error @enderror"
                                          placeholder=" "
                                          onchange="trackChanges(this)"
                                          oninput="trackChanges(this)">{{ old('keperluan', $peminjaman->keperluan) }}</textarea>
                                <label>Keperluan Peminjaman</label>
                            </div>
                            @error('keperluan')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Opsional - Maksimal 1000 karakter</p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Right Column - Summary & Actions --}}
            <div class="lg:col-span-1">
                <div class="sticky top-6 space-y-6">
                    
                    {{-- Ringkasan Biaya --}}
                    <div class="cost-summary animate-slide-up">
                        <h4 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center text-lg">
                            <i class="fas fa-calculator mr-2 text-amber-600"></i>Ringkasan Biaya
                        </h4>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between items-center pb-2 border-b border-amber-300 dark:border-amber-700">
                                <span class="text-sm text-gray-700 dark:text-gray-300">Harga Sewa/hari:</span>
                                <span class="font-semibold text-gray-900 dark:text-white" id="subtotal-display">Rp 0</span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b border-amber-300 dark:border-amber-700">
                                <span class="text-sm text-gray-700 dark:text-gray-300">Total Unit:</span>
                                <span class="font-semibold text-gray-900 dark:text-white" id="total-unit">0 unit</span>
                            </div>
                            <div class="flex justify-between items-center pb-2 border-b border-amber-300 dark:border-amber-700">
                                <span class="text-sm text-gray-700 dark:text-gray-300">Durasi:</span>
                                <span class="font-semibold text-gray-900 dark:text-white" id="duration-summary">1 hari</span>
                            </div>
                            <div class="pt-3 mt-3 border-t-2 border-amber-500">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-900 dark:text-white">Total Biaya:</span>
                                    <span class="text-2xl font-bold text-amber-700 dark:text-amber-400" id="total-cost">Rp 0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 p-6 animate-slide-up">
                        <div class="flex flex-col gap-3">
                            {{-- Kembali Button --}}
                            <button type="button" 
                                    class="btn-back w-full group inline-flex items-center justify-center px-5 py-3 text-sm font-medium rounded-xl bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-500 shadow-md hover:shadow-lg hover:from-gray-200 hover:to-gray-300 dark:hover:from-gray-600 dark:hover:to-gray-500 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300"
                                    data-confirm="Perubahan belum disimpan. Yakin ingin kembali?">
                                <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-300"></i>
                                Kembali
                            </button>
                            
                            {{-- Reset Button --}}
                            <button type="button" 
                                    onclick="resetChanges()"
                                    class="w-full group inline-flex items-center justify-center px-5 py-3 text-sm font-medium rounded-xl bg-gradient-to-r from-yellow-500 to-amber-500 text-white shadow-md hover:shadow-lg hover:shadow-yellow-500/30 hover:from-yellow-400 hover:to-amber-400 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
                                <i class="fas fa-undo-alt mr-2 group-hover:-rotate-180 transition-transform duration-500"></i>
                                Reset Perubahan
                            </button>
                            
                            {{-- Update Button --}}
                            <button type="submit" 
                                    id="submit-btn"
                                    class="w-full group inline-flex items-center justify-center px-6 py-3 text-sm font-medium rounded-xl bg-gradient-to-r from-emerald-500 to-green-600 text-white shadow-md hover:shadow-lg hover:shadow-emerald-500/30 hover:from-emerald-400 hover:to-green-500 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
                                <i class="fas fa-check-circle mr-2 group-hover:scale-110 transition-transform duration-300"></i>
                                <span id="submit-text">Update Peminjaman</span>
                            </button>
                        </div>
                    </div>
                </div>

        </div>
    </form>

</div>

{{-- Loading Overlay --}}
<div id="loading-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center backdrop-blur-sm">
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 max-w-sm w-full mx-4 shadow-2xl">
        <div class="text-center">
            <div class="relative mb-6">
                <div class="animate-spin rounded-full h-16 w-16 border-4 border-blue-200 dark:border-blue-800 border-t-blue-600 dark:border-t-blue-400 mx-auto"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <i class="fas fa-save text-blue-600 dark:text-blue-400 text-xl"></i>
                </div>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Menyimpan Perubahan</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">Mohon tunggu, sedang memproses perubahan data...</p>
            <div class="mt-4 h-1 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-blue-500 to-purple-500 rounded-full animate-pulse"></div>
            </div>
        </div>
    </div>
</div>

{{-- Success/Error Notifications --}}
@if(session('success'))
<div id="notification" class="notification notification-success">
    <div class="flex items-start">
        <div class="flex-shrink-0">
            <div class="p-3 bg-green-100 dark:bg-green-900/50 rounded-xl">
                <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-xl"></i>
            </div>
        </div>
        <div class="ml-4 flex-1">
            <h4 class="text-lg font-bold text-gray-900 dark:text-white">Berhasil!</h4>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ session('success') }}</p>
        </div>
        <button onclick="hideNotification(this)" class="ml-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 p-2 rounded-lg transition-colors">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif

@if(session('error'))
<div id="notification" class="notification notification-error">
    <div class="flex items-start">
        <div class="flex-shrink-0">
            <div class="p-3 bg-red-100 dark:bg-red-900/50 rounded-xl">
                <i class="fas fa-exclamation-circle text-red-600 dark:text-red-400 text-xl"></i>
            </div>
        </div>
        <div class="ml-4 flex-1">
            <h4 class="text-lg font-bold text-gray-900 dark:text-white">Error!</h4>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ session('error') }}</p>
        </div>
        <button onclick="hideNotification(this)" class="ml-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 p-2 rounded-lg transition-colors">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
// ==========================================
// CHANGE TRACKING VARIABLES
// ==========================================
let changedFields = new Set();
let originalValues = {};
let formChanged = false;
let isSubmitting = false;

document.addEventListener('DOMContentLoaded', function() {
    let barangIndex = {{ count($peminjaman->peminjamanDetail) }};
    
    // ✅ Store original values untuk tracking
    storeOriginalValues();
    
    // Setup event listeners
    document.getElementById('tanggal_mulai').addEventListener('change', handleDateChange);
    document.getElementById('tanggal_selesai').addEventListener('change', handleDateChange);
    
    // Initial calculation
    calculateCost();
    
    // Form submission
    document.getElementById('editForm').addEventListener('submit', handleSubmit);
    
    console.log('✅ Original values stored for reset:', originalValues);
    
    // Add new barang item
    window.addBarangFunc = function() {
        const container = document.getElementById('barang-container');
        const newItem = document.createElement('div');
        newItem.className = 'barang-item-editable';
        newItem.setAttribute('data-index', barangIndex);
        
        newItem.innerHTML = `
            <button type="button" class="remove-barang-btn" onclick="removeBarangFunc(this)">
                <i class="fas fa-times"></i>
            </button>
            
            <div class="smart-grid">
                <div class="lg:col-span-2">
                    <div class="floating-label">
                        <div class="input-group relative">
                            <i class="input-icon fas fa-box"></i>
                            <select name="barang[${barangIndex}][id]" 
                                    class="form-input input-with-icon barang-select" 
                                    required 
                                    onchange="updateBarangInfo(this); trackChanges(this)">
                                <option value="">Pilih barang...</option>
                                @foreach($barang as $b)
                                    <option value="{{ $b->id }}" 
                                            data-harga="{{ $b->harga_sewa }}"
                                            data-stok="{{ $b->jumlah_tersedia }}"
                                            data-nama="{{ $b->nama_barang }}"
                                            data-merk="{{ $b->merk ?? '' }}"
                                            data-type="{{ $b->type ?? '' }}">
                                        {{ $b->nama_barang }} @if($b->merk)- {{ $b->merk }}@endif (Stok: {{ $b->jumlah_tersedia }})
                                    </option>
                                @endforeach
                            </select>
                            <label>Pilih Barang <span class="required-asterisk">*</span></label>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="floating-label">
                        <div class="input-group relative">
                            <i class="input-icon fas fa-hashtag"></i>
                            <input type="number" 
                                   name="barang[${barangIndex}][jumlah]" 
                                   class="form-input input-with-icon jumlah-input"
                                   min="1"
                                   value="1"
                                   required
                                   placeholder=" "
                                   onchange="calculateCost(); trackChanges(this)"
                                   oninput="trackChanges(this)">
                            <label>Jumlah <span class="required-asterisk">*</span></label>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Max: <span class="max-stok">-</span> unit
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-3 p-3 bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600 dark:text-gray-300">
                        <i class="fas fa-info-circle mr-1"></i>
                        <span class="barang-info">Pilih barang terlebih dahulu</span>
                    </span>
                    <span class="font-semibold text-green-600 dark:text-green-400 barang-harga" data-harga="0">
                        Rp 0/hari
                    </span>
                </div>
            </div>
        `;
        
        container.appendChild(newItem);
        barangIndex++;
        formChanged = true;
        trackChanges({ name: 'new_barang_added' });
    };
    
    // Remove barang item
    window.removeBarangFunc = function(btn) {
        const items = document.querySelectorAll('.barang-item-editable');
        if (items.length > 1) {
            btn.closest('.barang-item-editable').remove();
            calculateCost();
            formChanged = true;
            trackChanges({ name: 'barang_removed' });
        } else {
            showNotification('⚠️ Minimal harus ada 1 barang!', 'warning');
        }
    };
    
    // Update barang info when selected
    window.updateBarangInfo = function(select) {
        const item = select.closest('.barang-item-editable');
        const selectedOption = select.options[select.selectedIndex];
        
        if (selectedOption.value) {
            const harga = selectedOption.getAttribute('data-harga');
            const stok = selectedOption.getAttribute('data-stok');
            const nama = selectedOption.getAttribute('data-nama');
            const merk = selectedOption.getAttribute('data-merk');
            const type = selectedOption.getAttribute('data-type');
            
            // Update info display
            let barangInfo = nama;
            if (merk) barangInfo += ' - ' + merk;
            if (type) barangInfo += ' ' + type;
            
            item.querySelector('.barang-info').textContent = barangInfo;
            item.querySelector('.barang-harga').textContent = 'Rp ' + formatNumber(harga) + '/hari';
            item.querySelector('.barang-harga').setAttribute('data-harga', harga);
            
            // Update max jumlah
            const jumlahInput = item.querySelector('.jumlah-input');
            jumlahInput.max = stok;
            item.querySelector('.max-stok').textContent = stok;
            
            // Reset jumlah if exceeds new max
            if (parseInt(jumlahInput.value) > parseInt(stok)) {
                jumlahInput.value = stok;
            }
        } else {
            item.querySelector('.barang-info').textContent = 'Pilih barang terlebih dahulu';
            item.querySelector('.barang-harga').textContent = 'Rp 0/hari';
            item.querySelector('.barang-harga').setAttribute('data-harga', '0');
            item.querySelector('.max-stok').textContent = '-';
        }
        
        calculateCost();
    };
    
    function handleDateChange() {
        const startDate = document.getElementById('tanggal_mulai').value;
        const endDate = document.getElementById('tanggal_selesai').value;
        
        if (!startDate) return;
        
        // Set min date for end date
        document.getElementById('tanggal_selesai').min = startDate;
        
        // Calculate max date (3 days from start)
        const start = new Date(startDate);
        const maxDate = new Date(start);
        maxDate.setDate(maxDate.getDate() + 2); // +2 karena +1 = hari ke-2, +2 = hari ke-3
        document.getElementById('tanggal_selesai').max = maxDate.toISOString().split('T')[0];
        
        // Calculate duration and update display
        if (startDate && endDate) {
            const startDateObj = new Date(startDate);
            const endDateObj = new Date(endDate);
            
            if (endDateObj < startDateObj) {
                showNotification('⚠️ Tanggal selesai tidak boleh lebih awal dari tanggal mulai!', 'warning');
                document.getElementById('tanggal_selesai').value = startDate;
                updateDurationDisplay(1);
                return;
            }
            
            const diffTime = Math.abs(endDateObj - startDateObj);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            
            if (diffDays > 3) {
                showNotification('⚠️ Durasi peminjaman maksimal 3 hari!', 'warning');
                document.getElementById('tanggal_selesai').value = maxDate.toISOString().split('T')[0];
                updateDurationDisplay(3);
                return;
            }
            
            updateDurationDisplay(diffDays);
        }
        
        formChanged = true;
        trackChanges({ name: 'date_changed' });
    }
    
    function updateDurationDisplay(days) {
        document.getElementById('duration-days').textContent = days + ' hari';
        document.getElementById('duration-summary').textContent = days + ' hari';
        calculateCost();
    }
    
    function handleSubmit(e) {
        const startDate = document.getElementById('tanggal_mulai').value;
        const endDate = document.getElementById('tanggal_selesai').value;
        
        // Validasi tanggal
        if (!startDate || !endDate) {
            e.preventDefault();
            showNotification('⚠️ Harap lengkapi tanggal peminjaman!', 'warning');
            return false;
        }
        
        const startDateObj = new Date(startDate);
        const endDateObj = new Date(endDate);
        const diffTime = Math.abs(endDateObj - startDateObj);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
        
        if (diffDays > 3) {
            e.preventDefault();
            showNotification('⚠️ Durasi peminjaman maksimal 3 hari!', 'error');
            return false;
        }
        
        // Validasi barang
        const items = document.querySelectorAll('.barang-item-editable');
        if (items.length === 0) {
            e.preventDefault();
            showNotification('⚠️ Minimal harus ada 1 barang!', 'error');
            return false;
        }
        
        // Validasi setiap barang
        let valid = true;
        items.forEach(item => {
            const select = item.querySelector('.barang-select');
            const jumlahInput = item.querySelector('.jumlah-input');
            
            if (!select.value) {
                valid = false;
                showNotification('⚠️ Harap pilih barang untuk semua item!', 'error');
            }
            
            if (!jumlahInput.value || parseInt(jumlahInput.value) < 1) {
                valid = false;
                showNotification('⚠️ Jumlah harus minimal 1!', 'error');
            }
            
            const maxStok = parseInt(jumlahInput.max);
            if (parseInt(jumlahInput.value) > maxStok) {
                valid = false;
                showNotification(`⚠️ Jumlah melebihi stok tersedia (${maxStok})!`, 'error');
            }
        });
        
        if (!valid) {
            e.preventDefault();
            return false;
        }
        
        // Konfirmasi
        if (!confirm('Apakah Anda yakin ingin menyimpan perubahan peminjaman ini?')) {
            e.preventDefault();
            return false;
        }
        
        // Show loading overlay
        const loadingOverlay = document.getElementById('loading-overlay');
        if (loadingOverlay) {
            loadingOverlay.classList.remove('hidden');
        }
        
        // Disable submit button to prevent double submission
        const submitBtn = document.getElementById('submit-btn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
        
        isSubmitting = true;
        return true;
    }
    
    // Unsaved changes warning
    document.getElementById('editForm').addEventListener('change', function() {
        formChanged = true;
    });
    
    window.addEventListener('beforeunload', function(e) {
        if (formChanged && !isSubmitting) {
            e.preventDefault();
            e.returnValue = '';
            return '';
        }
    });
});

// ==========================================
// STORE ORIGINAL VALUES
// ==========================================
function storeOriginalValues() {
    // Store tanggal
    originalValues['tanggal_mulai'] = document.getElementById('tanggal_mulai').value;
    originalValues['tanggal_selesai'] = document.getElementById('tanggal_selesai').value;
    
    // Store keperluan
    const keperluanField = document.getElementById('keperluan');
    if (keperluanField) {
        originalValues['keperluan'] = keperluanField.value;
    }
    
    // Store barang items
    const barangItems = document.querySelectorAll('.barang-item-editable');
    originalValues['barang_items'] = [];
    
    barangItems.forEach((item, index) => {
        const select = item.querySelector('.barang-select');
        const jumlahInput = item.querySelector('.jumlah-input');
        
        originalValues['barang_items'].push({
            index: index,
            barang_id: select.value,
            jumlah: jumlahInput.value,
            element: item.cloneNode(true)
        });
    });
    
    originalValues['barang_count'] = barangItems.length;
}

// ==========================================
// TRACK FIELD CHANGES
// ==========================================
function trackChanges(element) {
    if (!element || !element.name) return;
    
    changedFields.add(element.name);
    formChanged = true;
    
    if (element.classList) {
        element.classList.add('field-modified');
    }
    
    updateSubmitButton();
    
    console.log(`Field ${element.name} changed. Total changes:`, changedFields.size);
}

function updateSubmitButton() {
    const submitBtn = document.getElementById('submit-btn');
    if (submitBtn) {
        if (changedFields.size > 0 || formChanged) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    }
}

// ==========================================
// RESET CHANGES
// ==========================================
window.resetChanges = function() {
    if (!confirm('Reset semua perubahan? Semua perubahan yang belum disimpan akan hilang.')) {
        return;
    }
    
    // Reset tanggal
    if (originalValues['tanggal_mulai']) {
        document.getElementById('tanggal_mulai').value = originalValues['tanggal_mulai'];
    }
    if (originalValues['tanggal_selesai']) {
        document.getElementById('tanggal_selesai').value = originalValues['tanggal_selesai'];
    }
    
    // Reset keperluan
    const keperluanField = document.getElementById('keperluan');
    if (keperluanField && originalValues['keperluan'] !== undefined) {
        keperluanField.value = originalValues['keperluan'];
        keperluanField.classList.remove('field-modified');
    }
    
    // Reset barang items
    const container = document.getElementById('barang-container');
    if (container && originalValues['barang_items']) {
        // Clear current items
        container.innerHTML = '';
        
        // Restore original items
        originalValues['barang_items'].forEach(itemData => {
            const clonedElement = itemData.element.cloneNode(true);
            
            // Re-attach event listeners
            const select = clonedElement.querySelector('.barang-select');
            const jumlahInput = clonedElement.querySelector('.jumlah-input');
            const removeBtn = clonedElement.querySelector('.remove-barang-btn');
            
            if (select) {
                select.addEventListener('change', function() {
                    updateBarangInfo(this);
                    trackChanges(this);
                });
            }
            
            if (jumlahInput) {
                jumlahInput.addEventListener('change', function() {
                    calculateCost();
                    trackChanges(this);
                });
                jumlahInput.addEventListener('input', function() {
                    trackChanges(this);
                });
            }
            
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    removeBarangFunc(this);
                });
            }
            
            container.appendChild(clonedElement);
        });
    }
    
    // Clear changed fields tracking
    changedFields.clear();
    formChanged = false;
    
    // Remove all field-modified classes
    document.querySelectorAll('.field-modified').forEach(el => {
        el.classList.remove('field-modified');
    });
    
    // Recalculate cost and duration
    calculateCost();
    const startDate = document.getElementById('tanggal_mulai').value;
    const endDate = document.getElementById('tanggal_selesai').value;
    if (startDate && endDate) {
        const start = new Date(startDate);
        const end = new Date(endDate);
        const diffTime = Math.abs(end - start);
        const duration = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
        document.getElementById('duration-days').textContent = duration + ' hari';
        document.getElementById('duration-summary').textContent = duration + ' hari';
    }
    
    // Update submit button
    updateSubmitButton();
    
    // Show success notification
    showNotification('✅ Perubahan berhasil direset ke nilai semula', 'success');
    
    console.log('✅ All changes have been reset');
};

// ==========================================
// CALCULATE TOTAL COST
// ==========================================
window.calculateCost = function() {
    let subtotal = 0;
    let totalUnit = 0;
    
    // Get all barang items
    const items = document.querySelectorAll('.barang-item-editable');
    
    items.forEach(item => {
        const hargaElement = item.querySelector('.barang-harga');
        const jumlahInput = item.querySelector('.jumlah-input');
        
        if (hargaElement && jumlahInput) {
            const harga = parseInt(hargaElement.getAttribute('data-harga')) || 0;
            const jumlah = parseInt(jumlahInput.value) || 0;
            
            subtotal += (harga * jumlah);
            totalUnit += jumlah;
        }
    });
    
    // Get duration
    const startDate = document.getElementById('tanggal_mulai').value;
    const endDate = document.getElementById('tanggal_selesai').value;
    
    let duration = 1;
    if (startDate && endDate) {
        const start = new Date(startDate);
        const end = new Date(endDate);
        const diffTime = Math.abs(end - start);
        duration = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
    }
    
    const totalCost = subtotal * duration;
    
    // Update display
    const subtotalEl = document.getElementById('subtotal-display');
    const totalUnitEl = document.getElementById('total-unit');
    const durationEl = document.getElementById('duration-summary');
    const totalCostEl = document.getElementById('total-cost');
    
    if (subtotalEl) subtotalEl.textContent = 'Rp ' + formatNumber(subtotal);
    if (totalUnitEl) totalUnitEl.textContent = totalUnit + ' unit';
    if (durationEl) durationEl.textContent = duration + ' hari';
    if (totalCostEl) totalCostEl.textContent = 'Rp ' + formatNumber(totalCost);
};

function formatNumber(num) {
    return new Intl.NumberFormat('id-ID').format(num);
}

// ==========================================
// NOTIFICATION SYSTEM
// ==========================================
function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notif => notif.remove());
    
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    
    const icons = {
        success: 'fas fa-check-circle text-green-600 dark:text-green-400',
        error: 'fas fa-exclamation-circle text-red-600 dark:text-red-400',
        warning: 'fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-400',
        info: 'fas fa-info-circle text-blue-600 dark:text-blue-400'
    };
    
    const colors = {
        success: 'bg-green-100 dark:bg-green-900/50',
        error: 'bg-red-100 dark:bg-red-900/50',
        warning: 'bg-yellow-100 dark:bg-yellow-900/50',
        info: 'bg-blue-100 dark:bg-blue-900/50'
    };
    
    const titles = {
        success: 'Berhasil!',
        error: 'Error!',
        warning: 'Peringatan!',
        info: 'Info'
    };
    
    notification.innerHTML = `
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <div class="p-3 ${colors[type]} rounded-xl">
                    <i class="${icons[type]} text-xl"></i>
                </div>
            </div>
            <div class="ml-4 flex-1">
                <h4 class="text-lg font-bold text-gray-900 dark:text-white">${titles[type]}</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">${message}</p>
            </div>
            <button onclick="hideNotification(this)" class="ml-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 p-2 rounded-lg transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Auto hide after 5 seconds
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
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
`;
document.head.appendChild(style);

// ==========================================
// CONSOLE LOGGING
// ==========================================
console.log('%c✅ Peminjaman Edit Page Loaded', 'color: #3B82F6; font-size: 14px; font-weight: bold;');
console.log('%c🔒 User Field Locked (Cannot Change)', 'color: #F59E0B; font-size: 12px; font-weight: bold;');
console.log('%c🌓 Dark Mode Support Active!', 'color: #10B981; font-size: 12px;');
console.log('%c📝 Dynamic Barang Items Active!', 'color: #8B5CF6; font-size: 12px;');
console.log('%c🔄 Change Tracking & Reset Active!', 'color: #EC4899; font-size: 12px;');
</script>
@endpush