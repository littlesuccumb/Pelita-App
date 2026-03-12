@extends('layouts.app')

@section('title', 'Tambah User - Super Admin')

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
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.5);
    }
    
    .dark .btn-primary:hover {
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
    
    .file-upload-area {
        border: 3px dashed #d1d5db;
        border-radius: 1rem;
        padding: 3rem 2rem;
        text-align: center;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }
    
    .dark .file-upload-area {
        background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
        border-color: #4b5563;
    }
    
    .file-upload-area:hover {
        border-color: #3b82f6;
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        transform: scale(1.02);
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.15);
    }
    
    .dark .file-upload-area:hover {
        border-color: #60a5fa;
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
        box-shadow: 0 10px 25px rgba(96, 165, 250, 0.2);
    }
    
    .file-upload-area.dragover {
        border-color: #10b981;
        background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
        box-shadow: 0 0 30px rgba(16, 185, 129, 0.3);
    }
    
    .dark .file-upload-area.dragover {
        background: linear-gradient(135deg, #064e3b 0%, #065f46 100%);
        box-shadow: 0 0 30px rgba(16, 185, 129, 0.4);
    }
    
    .preview-image {
        max-width: 250px;
        max-height: 250px;
        border-radius: 50%;
        border: 4px solid #3b82f6;
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px rgba(59, 130, 246, 0.3);
    }
    
    .dark .preview-image {
        border-color: #60a5fa;
        box-shadow: 0 4px 14px rgba(96, 165, 250, 0.5);
    }
    
    .preview-image:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 35px rgba(59, 130, 246, 0.4);
    }
    
    .dark .preview-image:hover {
        box-shadow: 0 12px 35px rgba(96, 165, 250, 0.6);
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
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
    }
    
    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #3b82f6, #10b981, #3b82f6);
        background-size: 200% 200%;
        border-radius: 3px;
        transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        animation: gradient 2s ease infinite;
    }
    
    .dark .progress-fill {
        background: linear-gradient(90deg, #60a5fa, #34d399, #60a5fa);
    }
    
    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
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
        opacity: 0.6;
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
    
    @keyframes slideOutRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    
    .step-indicator {
        position: sticky;
        top: 1rem;
        z-index: 40;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 1rem;
        padding: 1rem;
        margin-bottom: 2rem;
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .dark .step-indicator {
        background: rgba(31, 41, 55, 0.95);
        border-color: rgba(75, 85, 99, 0.3);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }
    
    .smart-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
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
<div class="w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 lg:py-4">        {{-- Modern Breadcrumb Navigation --}}
        <nav class="mb-8 animate-fade-in" aria-label="Breadcrumb">
            <div class="breadcrumb-modern">
                <a href="{{ route('dashboard') }}" class="breadcrumb-link">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                
                <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs"></i>
                
                <a href="{{ route('admin.users.index') }}" class="breadcrumb-link">
                    <i class="fas fa-users"></i>
                    <span>Kelola User</span>
                </a>
                
                <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs"></i>
                
                <span class="breadcrumb-current">
                    <i class="fas fa-user-plus"></i>
                    <span>Tambah User</span>
                </span>
            </div>
        </nav>

        {{-- Modern Header Section --}}
        <div class="mb-8 animate-fade-in">
            <div class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700">
                
                {{-- Background Decorations --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-400/20 via-indigo-400/20 to-cyan-400/20 dark:from-blue-600/5 dark:via-indigo-600/5 dark:to-cyan-600/5 rounded-full blur-3xl transform translate-x-32 -translate-y-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-blue-400/15 to-indigo-400/15 dark:from-blue-600/5 dark:to-indigo-600/5 rounded-full blur-2xl transform -translate-x-24 translate-y-24"></div>
                
                {{-- Floating Dots --}}
                <div class="absolute inset-0 overflow-hidden pointer-events-none">
                    <div class="absolute top-10 left-10 w-2 h-2 bg-blue-400 dark:bg-blue-500 rounded-full animate-pulse opacity-60"></div>
                    <div class="absolute top-20 right-20 w-1.5 h-1.5 bg-indigo-400 dark:bg-indigo-500 rounded-full animate-pulse opacity-40" style="animation-delay: 0.5s;"></div>
                    <div class="absolute bottom-16 left-1/3 w-1 h-1 bg-cyan-400 dark:bg-cyan-500 rounded-full animate-pulse opacity-50" style="animation-delay: 1s;"></div>
                </div>
                
                <div class="relative p-8 lg:p-10">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                        
                        <div class="flex-1">
                            {{-- Status Badge --}}
                            <div class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-blue-500/10 to-indigo-500/10 dark:from-blue-600/20 dark:to-indigo-600/20 border border-blue-200/50 dark:border-blue-700/50 rounded-full mb-4">
                                <div class="w-2 h-2 bg-blue-500 dark:bg-blue-400 rounded-full animate-pulse"></div>
                                <span class="text-sm font-semibold text-blue-700 dark:text-blue-300">Form Input User</span>
                            </div>
                            
                            {{-- Title --}}
                            <h1 class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-blue-800 to-indigo-800 dark:from-slate-100 dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent leading-tight">
                                Tambah User Baru
                            </h1>
                            
                            {{-- Description --}}
                            <p class="text-slate-600 dark:text-slate-400 text-lg flex items-center space-x-2">
                                <i class="fas fa-info-circle text-blue-500 dark:text-blue-400"></i>
                                <span>Lengkapi informasi user untuk menambahkan ke sistem</span>
                            </p>
                        </div>
                        
                        {{-- Icon --}}
                        <div class="flex items-center space-x-3">
                            <div class="p-4 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl shadow-lg animate-pulse-slow">
                                <i class="fas fa-user-plus text-white text-3xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Bottom Gradient Line --}}
                <div class="h-1.5 bg-gradient-to-r from-blue-500 via-indigo-500 to-cyan-500"></div>
            </div>
        </div>

        <!-- Step Indicator -->
        <div class="step-indicator animate-slide-up">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-chart-line text-blue-600 dark:text-blue-400 mr-2"></i>
                    Progress Pengisian Form
                </h3>
                <div class="flex items-center space-x-2">
                    <span id="progress-text" class="text-sm font-medium text-gray-600 dark:text-gray-400">0% Selesai</span>
                    <div class="bg-gray-100 dark:bg-gray-700 rounded-full px-3 py-1">
                        <span id="field-counter" class="text-xs font-semibold text-gray-700 dark:text-gray-300">0/0 Field</span>
                    </div>
                </div>
            </div>
            <div class="progress-bar">
                <div id="progress-fill" class="progress-fill" style="width: 0%"></div>
            </div>
            <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400 mt-2">
                <span>Akun</span>
                <span>Profil</span>
                <span>Kontak</span>
                <span>Lokasi</span>
            </div>
        </div>

        <!-- Main Form -->
        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" id="user-form" class="animate-slide-up">
            @csrf
            
            <!-- 1. Informasi Akun -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 form-step active card-hover">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 via-blue-50/30 to-indigo-50/30 dark:from-gray-700/50 dark:via-gray-800/50 dark:to-gray-700/50 rounded-t-2xl">
                    <div class="flex items-center">
                        <div class="p-3 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl mr-4 shadow-lg">
                            <i class="fas fa-user-lock text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">1. Informasi Akun</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Data akun dan kredensial login user</p>
                        </div>
                        <div class="ml-auto">
                            <div class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-bold px-3 py-1 rounded-full">
                                Step 1/4
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="smart-grid">
                        <!-- Nama Lengkap -->
                        <div class="floating-label lg:col-span-2">
                            <div class="input-group">
                                <i class="input-icon fas fa-user"></i>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name') }}"
                                       required
                                       class="form-input input-with-icon @error('name') error @enderror"
                                       placeholder=" "
                                       maxlength="255">
                                <label for="name">Nama Lengkap <span class="required-asterisk">*</span></label>
                            </div>
                            @error('name')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="floating-label lg:col-span-2">
                            <div class="input-group">
                                <i class="input-icon fas fa-envelope"></i>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       value="{{ old('email') }}"
                                       required
                                       class="form-input input-with-icon @error('email') error @enderror"
                                       placeholder=" "
                                       maxlength="255">
                                <label for="email">Email <span class="required-asterisk">*</span></label>
                            </div>
                            @error('email')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="floating-label">
                            <div class="input-group">
                                <i class="input-icon fas fa-lock"></i>
                                <input type="password" 
                                       name="password" 
                                       id="password" 
                                       required
                                       class="form-input input-with-icon @error('password') error @enderror"
                                       placeholder=" "
                                       minlength="8">
                                <label for="password">Password <span class="required-asterisk">*</span></label>
                            </div>
                            @error('password')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="floating-label">
                            <div class="input-group">
                                <i class="input-icon fas fa-lock"></i>
                                <input type="password" 
                                       name="password_confirmation" 
                                       id="password_confirmation" 
                                       required
                                       class="form-input input-with-icon @error('password_confirmation') error @enderror"
                                       placeholder=" "
                                       minlength="8">
                                <label for="password_confirmation">Konfirmasi Password <span class="required-asterisk">*</span></label>
                            </div>
                            @error('password_confirmation')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div class="floating-label lg:col-span-2">
                            <div class="input-group">
                                <i class="input-icon fas fa-user-tag"></i>
                                <select name="role" 
                                        id="role" 
                                        required
                                        class="form-input input-with-icon @error('role') error @enderror">
                                    <option value="">Pilih role...</option>
                                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>👤 User - Pengguna Biasa</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>🛡️ Admin - Administrator</option>
                                    <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>👑 Super Admin - Full Access</option>
                                    <option value="pengurus_aset" {{ old('role') == 'pengurus_aset' ? 'selected' : '' }}>📦 Pengurus Aset - Asset Manager</option>
                                </select>
                                <label for="role">Role <span class="required-asterisk">*</span></label>
                            </div>
                            @error('role')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="warning-card mt-6">
                        <div class="flex items-start">
                            <i class="fas fa-shield-alt text-yellow-600 dark:text-yellow-400 text-2xl mr-3"></i>
                            <div>
                                <h4 class="text-sm font-bold text-yellow-800 dark:text-yellow-300 mb-2">Keamanan Password</h4>
                                <ul class="text-xs text-yellow-700 dark:text-yellow-400 space-y-1">
                                    <li>• Password minimal 8 karakter</li>
                                    <li>• Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol</li>
                                    <li>• Jangan gunakan password yang mudah ditebak</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Profil User -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 form-step card-hover">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 via-blue-50/30 to-indigo-50/30 dark:from-gray-700/50 dark:via-gray-800/50 dark:to-gray-700/50 rounded-t-2xl">
                    <div class="flex items-center">
                        <div class="p-3 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl mr-4 shadow-lg">
                            <i class="fas fa-id-card text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">2. Profil User</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Informasi profil dan pekerjaan user</p>
                        </div>
                        <div class="ml-auto">
                            <div class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-bold px-3 py-1 rounded-full">
                                Step 2/4
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="smart-grid">
                        <!-- Jabatan -->
                        <div class="floating-label">
                            <div class="input-group">
                                <i class="input-icon fas fa-briefcase"></i>
                                <input type="text" 
                                       name="jabatan" 
                                       id="jabatan" 
                                       value="{{ old('jabatan') }}"
                                       class="form-input input-with-icon @error('jabatan') error @enderror"
                                       placeholder=" "
                                       maxlength="255">
                                <label for="jabatan">Jabatan</label>
                            </div>
                            @error('jabatan')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Instansi -->
                        <div class="floating-label">
                            <div class="input-group">
                                <i class="input-icon fas fa-building"></i>
                                <input type="text" 
                                       name="instansi" 
                                       id="instansi" 
                                       value="{{ old('instansi') }}"
                                       class="form-input input-with-icon @error('instansi') error @enderror"
                                       placeholder=" "
                                       maxlength="255">
                                <label for="instansi">Instansi/Perusahaan</label>
                            </div>
                            @error('instansi')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Nama Organisasi -->
                        <div class="floating-label lg:col-span-2">
                            <div class="input-group">
                                <i class="input-icon fas fa-users"></i>
                                <input type="text" 
                                       name="nama_organisasi" 
                                       id="nama_organisasi" 
                                       value="{{ old('nama_organisasi') }}"
                                       class="form-input input-with-icon @error('nama_organisasi') error @enderror"
                                       placeholder=" "
                                       maxlength="255">
                                <label for="nama_organisasi">Nama Organisasi</label>
                            </div>
                            @error('nama_organisasi')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- No KTP -->
                        <div class="floating-label">
                            <div class="input-group">
                                <i class="input-icon fas fa-id-card"></i>
                                <input type="text" 
                                       name="no_ktp" 
                                       id="no_ktp" 
                                       value="{{ old('no_ktp') }}"
                                       class="form-input input-with-icon @error('no_ktp') error @enderror"
                                       placeholder=" "
                                       maxlength="16"
                                       pattern="[0-9]{16}"
                                       title="Nomor KTP harus 16 digit">
                                <label for="no_ktp">Nomor KTP</label>
                            </div>
                            @error('no_ktp')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- No Telp -->
                        <div class="floating-label">
                            <div class="input-group">
                                <i class="input-icon fas fa-phone"></i>
                                <input type="tel" 
                                       name="no_telp" 
                                       id="no_telp" 
                                       value="{{ old('no_telp') }}"
                                       class="form-input input-with-icon @error('no_telp') error @enderror"
                                       placeholder=" "
                                       maxlength="15">
                                <label for="no_telp">Nomor Telepon</label>
                            </div>
                            @error('no_telp')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Alamat Lengkap -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 form-step card-hover">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 via-green-50/30 to-emerald-50/30 dark:from-gray-700/50 dark:via-gray-800/50 dark:to-gray-700/50 rounded-t-2xl">
                    <div class="flex items-center">
                        <div class="p-3 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl mr-4 shadow-lg">
                            <i class="fas fa-map-marker-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">3. Alamat Lengkap</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Informasi alamat dan domisili user</p>
                        </div>
                        <div class="ml-auto">
                            <div class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs font-bold px-3 py-1 rounded-full">
                                Step 3/4
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="smart-grid">
                        <!-- Alamat -->
                        <div class="floating-label lg:col-span-2">
                            <textarea name="alamat" 
                                      id="alamat" 
                                      rows="3"
                                      class="form-input @error('alamat') error @enderror"
                                      placeholder=" ">{{ old('alamat') }}</textarea>
                            <label for="alamat">Alamat Lengkap</label>
                            @error('alamat')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Kelurahan -->
                        <div class="floating-label">
                            <div class="input-group">
                                <i class="input-icon fas fa-map-pin"></i>
                                <input type="text" 
                                       name="kelurahan" 
                                       id="kelurahan" 
                                       value="{{ old('kelurahan') }}"
                                       class="form-input input-with-icon @error('kelurahan') error @enderror"
                                       placeholder=" "
                                       maxlength="255">
                                <label for="kelurahan">Kelurahan/Desa</label>
                            </div>
                            @error('kelurahan')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Kecamatan -->
                        <div class="floating-label">
                            <div class="input-group">
                                <i class="input-icon fas fa-map"></i>
                                <input type="text" 
                                       name="kecamatan" 
                                       id="kecamatan" 
                                       value="{{ old('kecamatan') }}"
                                       class="form-input input-with-icon @error('kecamatan') error @enderror"
                                       placeholder=" "
                                       maxlength="255">
                                <label for="kecamatan">Kecamatan</label>
                            </div>
                            @error('kecamatan')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Kabupaten -->
                        <div class="floating-label">
                            <div class="input-group">
                                <i class="input-icon fas fa-city"></i>
                                <input type="text" 
                                       name="kabupaten" 
                                       id="kabupaten" 
                                       value="{{ old('kabupaten') }}"
                                       class="form-input input-with-icon @error('kabupaten') error @enderror"
                                       placeholder=" "
                                       maxlength="255">
                                <label for="kabupaten">Kabupaten/Kota</label>
                            </div>
                            @error('kabupaten')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Kode Pos -->
                        <div class="floating-label">
                            <div class="input-group">
                                <i class="input-icon fas fa-mailbox"></i>
                                <input type="text" 
                                       name="kode_pos" 
                                       id="kode_pos" 
                                       value="{{ old('kode_pos') }}"
                                       class="form-input input-with-icon @error('kode_pos') error @enderror"
                                       placeholder=" "
                                       maxlength="5"
                                       pattern="[0-9]{5}">
                                <label for="kode_pos">Kode Pos</label>
                            </div>
                            @error('kode_pos')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Upload Avatar -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 form-step card-hover">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 via-orange-50/30 to-amber-50/30 dark:from-gray-700/50 dark:via-gray-800/50 dark:to-gray-700/50 rounded-t-2xl">
                    <div class="flex items-center">
                        <div class="p-3 bg-gradient-to-r from-orange-500 to-amber-600 rounded-xl mr-4 shadow-lg">
                            <i class="fas fa-camera text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">4. Upload Avatar (Opsional)</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Foto profil untuk identitas user</p>
                        </div>
                        <div class="ml-auto">
                            <div class="bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-200 text-xs font-bold px-3 py-1 rounded-full">
                                Step 4/4
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-8">
                    <!-- Upload Avatar Section -->
                    <div class="mb-8">
                        <div class="file-upload-area" id="file-upload-area" onclick="document.getElementById('avatar').click()">
                            <div class="relative z-10">
                                <div class="mb-4">
                                    <i class="fas fa-cloud-upload-alt text-5xl text-gray-400 dark:text-gray-500 animate-bounce-slow"></i>
                                </div>
                                <h4 class="text-xl font-bold text-gray-700 dark:text-gray-300 mb-2">Upload Foto Avatar</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                                    Klik untuk memilih file atau drag & drop foto ke area ini
                                </p>
                                <div class="flex justify-center space-x-4 text-xs text-gray-400 dark:text-gray-500 mb-4">
                                    <div class="flex items-center">
                                        <i class="fas fa-file-image mr-1"></i>
                                        JPEG, PNG, JPG, GIF
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-weight-hanging mr-1"></i>
                                        Maksimal 2MB
                                    </div>
                                </div>
                                <div class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg text-sm font-medium hover:bg-blue-600 transition-colors">
                                    <i class="fas fa-plus mr-2"></i>
                                    Pilih Foto
                                </div>
                            </div>
                        </div>
                        
                        <input type="file" 
                               name="avatar" 
                               id="avatar" 
                               accept="image/jpeg,image/png,image/jpg,image/gif"
                               class="hidden"
                               onchange="previewImage(this)">
                        
                        @error('avatar')
                            <div class="error-message mt-3">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                        
                        <!-- Preview Area -->
                        <div id="image-preview-container" class="hidden mt-6">
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-700 rounded-xl p-6">
                                <h5 class="text-lg font-bold text-blue-800 dark:text-blue-300 mb-4 flex items-center">
                                    <i class="fas fa-eye mr-2"></i>
                                    Preview Avatar
                                </h5>
                                <div class="flex flex-col lg:flex-row lg:items-center lg:space-x-6">
                                    <img id="image-preview" src="" alt="Preview" class="preview-image mb-4 lg:mb-0">
                                    <div class="flex-1">
                                        <div id="file-info" class="text-sm text-blue-700 dark:text-blue-400 mb-4 space-y-1"></div>
                                        <button type="button" 
                                                onclick="removeImage()" 
                                                class="inline-flex items-center px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition-all transform hover:scale-105">
                                            <i class="fas fa-trash mr-2"></i>
                                            Hapus Foto
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="info-card mt-4">
                            <h5 class="text-sm font-bold text-blue-800 dark:text-blue-300 mb-3 flex items-center">
                                <i class="fas fa-lightbulb mr-2"></i>
                                Tips Upload Foto Avatar:
                            </h5>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs text-blue-700 dark:text-blue-400">
                                <div class="flex items-center">
                                    <i class="fas fa-user-circle text-blue-500 mr-2"></i>
                                    Gunakan foto wajah yang jelas
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-sun text-yellow-500 mr-2"></i>
                                    Pastikan pencahayaan yang baik
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-crop-alt text-green-500 mr-2"></i>
                                    Foto akan di-crop berbentuk lingkaran
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-shield-check text-indigo-500 mr-2"></i>
                                    Avatar bersifat opsional
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 mb-8">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                            <i class="fas fa-info-circle text-blue-500 mr-2"></i>
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
                                <span id="submit-text">Simpan User</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Loading Overlay -->
    <div id="loading-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 dark:bg-opacity-70 z-50 flex items-center justify-center backdrop-blur-sm">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 max-w-sm w-full mx-4 shadow-2xl">
            <div class="text-center">
                <div class="relative mb-6">
                    <div class="animate-spin rounded-full h-16 w-16 border-4 border-blue-200 dark:border-blue-700 border-t-blue-600 dark:border-t-blue-400 mx-auto"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fas fa-save text-blue-600 dark:text-blue-400 text-xl"></i>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Menyimpan Data User</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Mohon tunggu, sedang memproses data...</p>
                <div class="mt-4 h-1 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full animate-pulse"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications -->
    @if(session('success'))
    <div id="notification" class="notification">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <div class="p-3 bg-green-100 dark:bg-green-900 rounded-xl">
                    <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-xl"></i>
                </div>
            </div>
            <div class="ml-4 flex-1">
                <h4 class="text-lg font-bold text-gray-900 dark:text-white">Berhasil!</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ session('success') }}</p>
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
                <div class="p-3 bg-red-100 dark:bg-red-900 rounded-xl">
                    <i class="fas fa-exclamation-circle text-red-600 dark:text-red-400 text-xl"></i>
                </div>
            </div>
            <div class="ml-4 flex-1">
                <h4 class="text-lg font-bold text-gray-900 dark:text-white">Error!</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ session('error') }}</p>
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
// Form Progress Tracking
let formFields = [];
let filledFields = 0;
let totalFields = 0;

// Initialize form tracking
document.addEventListener('DOMContentLoaded', function() {
    const requiredFields = document.querySelectorAll('input[required], select[required], textarea[required]');
    const optionalFields = document.querySelectorAll('input:not([required]), select:not([required]), textarea:not([required])');
    
    formFields = Array.from(requiredFields).concat(Array.from(optionalFields));
    totalFields = formFields.length;
    
    formFields.forEach(field => {
        field.addEventListener('input', debounce(updateProgress, 300));
        field.addEventListener('change', debounce(updateProgress, 300));
        field.addEventListener('blur', validateField);
    });
    
    updateProgress();
    animateFormSections();
    setupDragAndDrop();
    
    console.log('✅ User form initialized successfully');
});

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function updateProgress() {
    filledFields = 0;
    
    formFields.forEach(field => {
        if (field.type === 'file') {
            if (field.files && field.files.length > 0) filledFields++;
        } else if (field.type === 'checkbox' || field.type === 'radio') {
            if (field.checked) filledFields++;
        } else if (field.tagName === 'SELECT') {
            if (field.value !== '') filledFields++;
        } else {
            if (field.value && field.value.trim() !== '') filledFields++;
        }
    });
    
    const progress = Math.round((filledFields / totalFields) * 100);
    
    const progressFill = document.getElementById('progress-fill');
    const progressText = document.getElementById('progress-text');
    const fieldCounter = document.getElementById('field-counter');
    
    if (progressFill && progressText && fieldCounter) {
        progressFill.style.width = progress + '%';
        progressText.textContent = progress + '% Selesai';
        fieldCounter.textContent = `${filledFields}/${totalFields} Field`;
    }
    
    updateFormSections(progress);
}

function updateFormSections(progress) {
    const sections = document.querySelectorAll('.form-step');
    
    sections.forEach((section, index) => {
        if (index === 0 || progress >= (index * 20)) {
            section.classList.add('active');
        }
    });
}

function animateFormSections() {
    const sections = document.querySelectorAll('.form-step');
    
    sections.forEach((section, index) => {
        setTimeout(() => {
            section.style.opacity = '1';
            section.style.transform = 'translateY(0)';
        }, index * 300);
    });
}

function validateField(e) {
    const field = e.target;
    const value = field.value.trim();
    
    field.classList.remove('error');
    
    if (field.hasAttribute('required') && !value) {
        field.classList.add('error');
        return false;
    }
    
    switch(field.type) {
        case 'email':
            if (value && !isValidEmail(value)) {
                field.classList.add('error');
                showFieldError(field, 'Format email tidak valid');
                return false;
            }
            break;
        case 'password':
            if (value && value.length < 8) {
                field.classList.add('error');
                showFieldError(field, 'Password minimal 8 karakter');
                return false;
            }
            break;
    }
    
    if (field.id === 'no_ktp' && value) {
        if (!/^\d{16}$/.test(value)) {
            field.classList.add('error');
            showFieldError(field, 'Nomor KTP harus 16 digit angka');
            return false;
        }
    }
    
    if (field.id === 'kode_pos' && value) {
        if (!/^\d{5}$/.test(value)) {
            field.classList.add('error');
            showFieldError(field, 'Kode pos harus 5 digit angka');
            return false;
        }
    }
    
    if (field.id === 'password_confirmation') {
        const password = document.getElementById('password').value;
        if (value && value !== password) {
            field.classList.add('error');
            showFieldError(field, 'Konfirmasi password tidak cocok');
            return false;
        }
    }
    
    return true;
}

function showFieldError(field, message) {
    const existingError = field.parentNode.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.innerHTML = `<i class="fas fa-exclamation-triangle"></i> ${message}`;
    field.parentNode.appendChild(errorDiv);
    
    setTimeout(() => {
        if (errorDiv.parentNode) {
            errorDiv.remove();
        }
    }, 5000);
}

function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

// File Upload Functions
function setupDragAndDrop() {
    const uploadArea = document.getElementById('file-upload-area');
    
    if (!uploadArea) return;
    
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });
    
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, unhighlight, false);
    });
    
    uploadArea.addEventListener('drop', handleDrop, false);
}

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

function highlight() {
    const uploadArea = document.getElementById('file-upload-area');
    if (uploadArea) {
        uploadArea.classList.add('dragover');
    }
}

function unhighlight() {
    const uploadArea = document.getElementById('file-upload-area');
    if (uploadArea) {
        uploadArea.classList.remove('dragover');
    }
}

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    
    if (files.length > 0) {
        const fileInput = document.getElementById('avatar');
        if (fileInput) {
            fileInput.files = files;
            previewImage(fileInput);
        }
    }
}

function previewImage(input) {
    const file = input.files[0];
    const previewContainer = document.getElementById('image-preview-container');
    const previewImage = document.getElementById('image-preview');
    const fileInfo = document.getElementById('file-info');
    
    if (!file) return;
    
    if (!validateImageFile(file)) {
        input.value = '';
        return;
    }
    
    const reader = new FileReader();
    reader.onload = function(e) {
        if (previewImage && fileInfo && previewContainer) {
            previewImage.src = e.target.result;
            fileInfo.innerHTML = `
                <div><strong>File:</strong> ${file.name}</div>
                <div><strong>Ukuran:</strong> ${(file.size / 1024 / 1024).toFixed(2)} MB</div>
                <div><strong>Tipe:</strong> ${file.type}</div>
            `;
            
            previewContainer.classList.remove('hidden');
            previewContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    };
    reader.readAsDataURL(file);
}

function validateImageFile(file) {
    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    const maxSize = 2 * 1024 * 1024;
    
    if (!allowedTypes.includes(file.type)) {
        showNotification('Format file tidak didukung! Gunakan format: JPEG, PNG, JPG, atau GIF', 'error');
        return false;
    }
    
    if (file.size > maxSize) {
        showNotification(`Ukuran file terlalu besar! Maksimal: 2MB, Ukuran file: ${(file.size / 1024 / 1024).toFixed(2)} MB`, 'error');
        return false;
    }
    
    return true;
}

function removeImage() {
    const fileInput = document.getElementById('avatar');
    const previewContainer = document.getElementById('image-preview-container');
    
    if (fileInput) fileInput.value = '';
    if (previewContainer) previewContainer.classList.add('hidden');
    
    updateProgress();
    showNotification('Foto berhasil dihapus', 'success');
}

// Form Validation & Submission
document.getElementById('user-form').addEventListener('submit', function(e) {
    if (!validateFormComplete()) {
        e.preventDefault();
        return false;
    }
    
    const loadingOverlay = document.getElementById('loading-overlay');
    if (loadingOverlay) {
        loadingOverlay.classList.remove('hidden');
    }
    
    const submitBtn = document.getElementById('submit-btn');
    const submitText = document.getElementById('submit-text');
    
    if (submitBtn && submitText) {
        submitBtn.disabled = true;
        submitText.textContent = 'Menyimpan...';
    }
});

function validateFormComplete() {
    let isValid = true;
    const errors = [];
    
    const requiredFields = [
        { id: 'name', name: 'Nama Lengkap' },
        { id: 'email', name: 'Email' },
        { id: 'password', name: 'Password' },
        { id: 'password_confirmation', name: 'Konfirmasi Password' },
        { id: 'role', name: 'Role' }
    ];
    
    requiredFields.forEach(field => {
        const input = document.getElementById(field.id);
        if (input && !input.value.trim()) {
            errors.push(`${field.name} harus diisi`);
            input.classList.add('error');
            isValid = false;
        } else if (input) {
            input.classList.remove('error');
        }
    });
    
    // Validate email format
    const emailInput = document.getElementById('email');
    if (emailInput && emailInput.value && !isValidEmail(emailInput.value)) {
        errors.push('Format email tidak valid');
        emailInput.classList.add('error');
        isValid = false;
    }
    
    // Validate password length
    const passwordInput = document.getElementById('password');
    if (passwordInput && passwordInput.value && passwordInput.value.length < 8) {
        errors.push('Password minimal 8 karakter');
        passwordInput.classList.add('error');
        isValid = false;
    }
    
    // Validate password confirmation
    const passwordConfirmInput = document.getElementById('password_confirmation');
    if (passwordInput && passwordConfirmInput && passwordInput.value !== passwordConfirmInput.value) {
        errors.push('Konfirmasi password tidak cocok');
        passwordConfirmInput.classList.add('error');
        isValid = false;
    }
    
    // Validate KTP if provided
    const ktpInput = document.getElementById('no_ktp');
    if (ktpInput && ktpInput.value && !/^\d{16}$/.test(ktpInput.value)) {
        errors.push('Nomor KTP harus 16 digit angka');
        ktpInput.classList.add('error');
        isValid = false;
    }
    
    // Validate kode pos if provided
    const kodePosInput = document.getElementById('kode_pos');
    if (kodePosInput && kodePosInput.value && !/^\d{5}$/.test(kodePosInput.value)) {
        errors.push('Kode pos harus 5 digit angka');
        kodePosInput.classList.add('error');
        isValid = false;
    }
    
    // Show errors if any
    if (!isValid) {
        showNotification(`Terdapat ${errors.length} kesalahan pada form. Silakan periksa kembali.`, 'error');
        
        // Scroll to first error
        const firstError = document.querySelector('.error');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            setTimeout(() => firstError.focus(), 500);
        }
    }
    
    return isValid;
}

function resetForm() {
    if (!confirm('Reset semua data form? Semua data yang sudah diisi akan dihapus dan tidak dapat dikembalikan.')) {
        return;
    }
    
    const form = document.getElementById('user-form');
    if (form) {
        form.reset();
    }
    
    removeImage();
    updateProgress();
    
    // Remove error classes
    document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
    document.querySelectorAll('.error-message').forEach(el => el.remove());
    
    // Reset form sections
    document.querySelectorAll('.form-step').forEach((section, index) => {
        if (index === 0) {
            section.classList.add('active');
        } else {
            section.classList.remove('active');
        }
    });
    
    // Clear draft
    localStorage.removeItem('user_draft');
    
    showNotification('Form berhasil direset', 'success');
}

// Auto-save functionality
let autoSaveTimer;

function setupAutoSave() {
    const formInputs = document.querySelectorAll('#user-form input, #user-form select, #user-form textarea');
    
    formInputs.forEach(input => {
        // Skip password fields for security
        if (input.type !== 'password') {
            input.addEventListener('input', function() {
                clearTimeout(autoSaveTimer);
                autoSaveTimer = setTimeout(saveDraft, 30000);
            });
        }
    });
    
    // Load existing draft
    loadDraft();
}

function saveDraft() {
    const formData = new FormData(document.getElementById('user-form'));
    const draftData = {};
    
    for (let [key, value] of formData.entries()) {
        // Don't save sensitive data
        if (key !== 'avatar' && key !== '_token' && key !== 'password' && key !== 'password_confirmation') {
            draftData[key] = value;
        }
    }
    
    localStorage.setItem('user_draft', JSON.stringify(draftData));
    console.log('Draft tersimpan otomatis');
}

function loadDraft() {
    const draft = localStorage.getItem('user_draft');
    if (!draft) return;
    
    try {
        const draftData = JSON.parse(draft);
        const hasData = Object.keys(draftData).some(key => draftData[key] && draftData[key].trim() !== '');
        
        if (!hasData) return;
        
        if (confirm('Ditemukan draft yang tersimpan. Apakah Anda ingin memuat data draft tersebut?')) {
            Object.keys(draftData).forEach(key => {
                const input = document.querySelector(`[name="${key}"]`);
                if (input && draftData[key]) {
                    input.value = draftData[key];
                    if (input.tagName === 'SELECT') {
                        input.dispatchEvent(new Event('change'));
                    }
                }
            });
            
            updateProgress();
            localStorage.removeItem('user_draft');
            
            showNotification('Draft berhasil dimuat', 'success');
        }
    } catch (e) {
        console.error('Error loading draft:', e);
        localStorage.removeItem('user_draft');
    }
}

// Enhanced notification system
function showNotification(message, type = 'info') {
    // Remove existing notifications
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
        success: 'bg-green-100 dark:bg-green-900',
        error: 'bg-red-100 dark:bg-red-900',
        warning: 'bg-yellow-100 dark:bg-yellow-900',
        info: 'bg-blue-100 dark:bg-blue-900'
    };
    
    notification.innerHTML = `
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <div class="p-3 ${colors[type]} rounded-xl">
                    <i class="${icons[type]} text-xl"></i>
                </div>
            </div>
            <div class="ml-4 flex-1">
                <h4 class="text-lg font-bold text-gray-900 dark:text-white">${type.charAt(0).toUpperCase() + type.slice(1)}</h4>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">${message}</p>
            </div>
            <button onclick="hideNotification(this)" class="ml-4 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-2 rounded-lg transition-colors">
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

// Input enhancements
document.addEventListener('input', function(e) {
    const target = e.target;
    
    // Security: Prevent XSS in text inputs
    if (target.type === 'text' || target.tagName === 'TEXTAREA') {
        const dangerousPatterns = [/<script/i, /javascript:/i, /on\w+\s*=/i];
        if (dangerousPatterns.some(pattern => pattern.test(target.value))) {
            target.value = target.value.replace(/[<>'"]/g, '');
            showNotification('Karakter berbahaya dihapus dari input', 'warning');
        }
    }
    
    // Format phone number
    if (target.id === 'no_telp') {
        target.value = target.value.replace(/[^\d+]/g, '');
    }
    
    // Format KTP number
    if (target.id === 'no_ktp') {
        target.value = target.value.replace(/\D/g, '');
        if (target.value.length > 16) {
            target.value = target.value.substring(0, 16);
        }
    }
    
    // Format kode pos
    if (target.id === 'kode_pos') {
        target.value = target.value.replace(/\D/g, '');
        if (target.value.length > 5) {
            target.value = target.value.substring(0, 5);
        }
    }
});

// Session management
let sessionTimeoutWarning;
let sessionTimeout;
let activityDetected = false;

function startSessionTimer() {
    clearTimeout(sessionTimeoutWarning);
    clearTimeout(sessionTimeout);
    activityDetected = true;
    
    // Warning at 25 minutes
    sessionTimeoutWarning = setTimeout(() => {
        if (confirm('Sesi akan berakhir dalam 5 menit. Klik OK untuk memperpanjang sesi atau Cancel untuk menyimpan draft.')) {
            startSessionTimer();
        } else {
            saveDraft();
        }
    }, 25 * 60 * 1000);
    
    // Force action at 30 minutes
    sessionTimeout = setTimeout(() => {
        saveDraft();
        showNotification('Sesi telah berakhir. Draft telah disimpan.', 'warning');
        setTimeout(() => window.location.reload(), 3000);
    }, 30 * 60 * 1000);
}

// Activity listeners
['click', 'keypress', 'scroll', 'mousemove'].forEach(event => {
    document.addEventListener(event, debounce(startSessionTimer, 10000));
});

startSessionTimer();

// Initialize auto-save
document.addEventListener('DOMContentLoaded', function() {
    setupAutoSave();
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    if (e.ctrlKey && e.key === 's') {
        e.preventDefault();
        const submitBtn = document.getElementById('submit-btn');
        if (submitBtn) submitBtn.click();
    }
    
    if (e.ctrlKey && e.key === 'r') {
        e.preventDefault();
        resetForm();
    }
    
    if (e.key === 'Escape' && e.target.matches('input, textarea, select')) {
        e.target.value = '';
        e.target.blur();
        updateProgress();
    }
});

// Password strength indicator
const passwordInput = document.getElementById('password');
if (passwordInput) {
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        let strength = 0;
        
        if (password.length >= 8) strength++;
        if (password.length >= 12) strength++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
        if (/\d/.test(password)) strength++;
        if (/[^a-zA-Z\d]/.test(password)) strength++;
        
        // Remove existing strength indicator
        let strengthDiv = this.parentNode.querySelector('.password-strength');
        if (strengthDiv) strengthDiv.remove();
        
        if (password.length > 0) {
            strengthDiv = document.createElement('div');
            strengthDiv.className = 'password-strength text-xs mt-2 flex items-center gap-2';
            
            const strengthLabels = ['Sangat Lemah', 'Lemah', 'Sedang', 'Kuat', 'Sangat Kuat'];
            const strengthColors = ['text-red-600 dark:text-red-400', 'text-orange-600 dark:text-orange-400', 'text-yellow-600 dark:text-yellow-400', 'text-blue-600 dark:text-blue-400', 'text-green-600 dark:text-green-400'];
            
            strengthDiv.innerHTML = `
                <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                    <div class="h-full ${strengthColors[strength]} bg-current transition-all duration-300" 
                         style="width: ${(strength / 5) * 100}%"></div>
                </div>
                <span class="${strengthColors[strength]} font-medium">${strengthLabels[strength]}</span>
            `;
            
            this.parentNode.appendChild(strengthDiv);
        }
    });
}

// Auto hide existing notifications
setTimeout(() => {
    const notification = document.getElementById('notification');
    if (notification) hideNotification(notification);
}, 5000);

console.log('✅ User form fully initialized with all features');
</script>
@endpush