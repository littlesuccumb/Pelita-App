@extends('layouts.app')

@section('title', 'Edit User - Admin')

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
        border-radius: 1rem;
        border: 3px solid #e5e7eb;
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
    }
    
    .dark .preview-image {
        border-color: #4b5563;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.5);
    }
    
    .preview-image:hover {
        transform: scale(1.05) rotate(1deg);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
    }
    
    .dark .preview-image:hover {
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.7);
    }
    
    .current-image-preview {
        border-color: #10b981;
        position: relative;
    }
    
    .current-image-preview::after {
        content: 'CURRENT';
        position: absolute;
        top: -0.5rem;
        right: -0.5rem;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        font-size: 0.6rem;
        font-weight: bold;
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        box-shadow: 0 2px 4px rgba(16, 185, 129, 0.3);
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
    
    .error-card {
        background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        border: 1px solid #ef4444;
        border-left: 4px solid #ef4444;
        border-radius: 0.75rem;
        padding: 1.25rem;
        margin: 1rem 0;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.1);
    }
    
    .dark .error-card {
        background: linear-gradient(135deg, #7f1d1d 0%, #991b1b 100%);
        border-color: #ef4444;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
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
        background: linear-gradient(135deg, #7c2d12 0%, #92400e 100%);
        border-color: #fb923c;
        box-shadow: 0 2px 8px rgba(251, 146, 60, 0.3);
    }
    
    .role-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .role-badge-user {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #1e40af;
        border: 1px solid #3b82f6;
    }
    
    .dark .role-badge-user {
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
        color: #93c5fd;
        border-color: #60a5fa;
    }
    
    .role-badge-admin {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #92400e;
        border: 1px solid #f59e0b;
    }
    
    .dark .role-badge-admin {
        background: linear-gradient(135deg, #78350f 0%, #92400e 100%);
        color: #fbbf24;
        border-color: #fbbf24;
    }
    
    .role-badge-super-admin {
        background: linear-gradient(135deg, #fecaca 0%, #fca5a5 100%);
        color: #991b1b;
        border: 1px solid #ef4444;
    }
    
    .dark .role-badge-super-admin {
        background: linear-gradient(135deg, #7f1d1d 0%, #991b1b 100%);
        color: #fca5a5;
        border-color: #f87171;
    }
    
    .role-badge-pengurus-aset {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        border: 1px solid #10b981;
    }
    
    .dark .role-badge-pengurus-aset {
        background: linear-gradient(135deg, #14532d 0%, #166534 100%);
        color: #6ee7b7;
        border-color: #34d399;
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 lg:py-4">        
        {{-- Modern Breadcrumb Navigation --}}
        <nav class="mb-8 animate-fade-in" aria-label="Breadcrumb">
            <div class="breadcrumb-modern breadcrumb-edit">
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
                
                <a href="{{ route('admin.users.show', $user->id) }}" 
                class="breadcrumb-link"
                title="{{ $user->name }}">
                    <i class="fas fa-eye"></i>
                    <span>{{ Str::limit($user->name, 30) }}</span>
                </a>
                
                <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs"></i>
                
                <span class="breadcrumb-current">
                    <i class="fas fa-edit"></i>
                    <span>Edit User</span>
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
                                <span class="text-sm font-semibold text-orange-700 dark:text-orange-300">Form Edit User</span>
                            </div>
                            
                            {{-- Title --}}
                            <h1 class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-orange-800 to-red-800 dark:from-slate-100 dark:via-orange-200 dark:to-red-200 bg-clip-text text-transparent leading-tight">
                                Edit User
                            </h1>
                            
                            {{-- Description --}}
                            <p class="text-slate-600 dark:text-slate-400 text-lg flex items-center space-x-2 mb-4">
                                <i class="fas fa-info-circle text-orange-500 dark:text-orange-400"></i>
                                <span>Perbarui informasi user dalam sistem</span>
                            </p>
                            
                            {{-- Metadata --}}
                            <div class="flex flex-wrap items-center gap-4 text-sm">
                                <div class="flex items-center px-3 py-1.5 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                                    <i class="fas fa-envelope mr-2 text-blue-600 dark:text-blue-400"></i>
                                    <span class="font-semibold text-slate-700 dark:text-slate-300">Email:</span>
                                    <span class="ml-1 font-mono text-blue-700 dark:text-blue-300">{{ $user->email }}</span>
                                </div>
                                <div class="flex items-center px-3 py-1.5 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                                    <i class="fas fa-calendar mr-2 text-green-600 dark:text-green-400"></i>
                                    <span class="font-semibold text-slate-700 dark:text-slate-300">Update:</span>
                                    <span class="ml-1 text-green-700 dark:text-green-300">{{ $user->updated_at->format('d M Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Icon --}}
                        <div class="flex items-center space-x-3">
                            <div class="p-4 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl shadow-lg">
                                <i class="fas fa-user-edit text-white text-3xl"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Bottom Gradient Line --}}
                <div class="h-1.5 bg-gradient-to-r from-orange-500 via-red-500 to-pink-500"></div>
            </div>
        </div>

        {{-- Changes Summary --}}
        <div id="changes-summary" class="changes-summary hidden">
            <div class="flex items-center justify-between mb-3">
                <h4 class="text-sm font-bold text-orange-800 dark:text-orange-300 flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Perubahan Terdeteksi
                </h4>
                <div class="bg-orange-200 dark:bg-orange-800 text-orange-800 dark:text-orange-200 text-xs font-bold px-2 py-1 rounded-full">
                    <span id="changes-count">0</span> Field
                </div>
            </div>
            <div id="changes-list" class="text-sm text-orange-700 dark:text-orange-400 space-y-1"></div>
        </div>

        {{-- Step Indicator --}}
        <div class="step-indicator animate-slide-up">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <i class="fas fa-chart-line text-blue-600 dark:text-blue-400 mr-2"></i>
                    Progress Edit Form
                </h3>
                <div class="flex items-center space-x-2">
                    <span id="progress-text" class="text-sm font-medium text-gray-600 dark:text-gray-400">100% Lengkap</span>
                    <div class="bg-green-100 dark:bg-green-900/50 rounded-full px-3 py-1">
                        <span id="field-counter" class="text-xs font-semibold text-green-700 dark:text-green-300">Data Tersimpan</span>
                    </div>
                </div>
            </div>
            <div class="progress-bar">
                <div id="progress-fill" class="progress-fill" style="width: 100%"></div>
            </div>
            <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400 mt-2">
                <span>Informasi Akun</span>
                <span>Data Pribadi</span>
                <span>Kontak & Alamat</span>
                <span>Foto & Lainnya</span>
            </div>
        </div>

        {{-- Main Form --}}
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" id="user-form" class="animate-slide-up">
            @csrf
            @method('PATCH')
            
            {{-- 1. Informasi Akun --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 form-step active card-hover">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 rounded-t-2xl">
                    <div class="flex items-center">
                        <div class="p-3 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl mr-4 shadow-lg">
                            <i class="fas fa-user-circle text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">1. Informasi Akun</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Data akun dan kredensial user</p>
                        </div>
                        <div class="ml-auto">
                            <div class="bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300 text-xs font-bold px-3 py-1 rounded-full">
                                Step 1/4
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-8">
                    {{-- Current Role Display --}}
                    <div class="success-card mb-6">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-sm font-bold text-green-800 dark:text-green-300 flex items-center">
                                <i class="fas fa-shield-alt mr-2"></i>
                                Role Saat Ini
                            </h4>
                            <div class="role-badge role-badge-{{ str_replace('_', '-', $user->role) }}">
                                {{ ucwords(str_replace('_', ' ', $user->role)) }}
                            </div>
                        </div>
                        @if($user->role === 'super_admin' && \App\Models\User::where('role', 'super_admin')->count() <= 1)
                        <div class="warning-card mt-3">
                            <p class="text-sm text-yellow-700 dark:text-yellow-400 flex items-start">
                                <i class="fas fa-exclamation-triangle mt-0.5 mr-2 flex-shrink-0"></i>
                                <span>
                                    <strong>Perhatian:</strong> Ini adalah satu-satunya Super Admin. Role tidak dapat diubah.
                                </span>
                            </p>
                        </div>
                        @endif
                    </div>

                    <div class="smart-grid">
                        {{-- Nama Lengkap --}}
                        <div class="floating-label lg:col-span-2">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-user"></i>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name', $user->name) }}"
                                       required
                                       class="form-input input-with-icon @error('name') error @enderror"
                                       placeholder=" "
                                       maxlength="255"
                                       data-original="{{ $user->name }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="name">Nama Lengkap <span class="required-asterisk">*</span></label>
                                @if($user->name)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('name')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="floating-label lg:col-span-2">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-envelope"></i>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       value="{{ old('email', $user->email) }}"
                                       required
                                       class="form-input input-with-icon @error('email') error @enderror"
                                       placeholder=" "
                                       maxlength="255"
                                       data-original="{{ $user->email }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="email">Email <span class="required-asterisk">*</span></label>
                                @if($user->email)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('email')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Role --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-user-tag"></i>
                                <select name="role" 
                                        id="role" 
                                        required
                                        class="form-input input-with-icon @error('role') error @enderror"
                                        data-original="{{ $user->role }}"
                                        onchange="trackChanges(this); updateRoleDisplay()"
                                        {{ ($user->role === 'super_admin' && \App\Models\User::where('role', 'super_admin')->count() <= 1) ? 'disabled' : '' }}>
                                    <option value="">Pilih role...</option>
                                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>
                                        👤 User
                                    </option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                        ⚙️ Admin
                                    </option>
                                    <option value="pengurus_aset" {{ old('role', $user->role) == 'pengurus_aset' ? 'selected' : '' }}>
                                        📦 Pengurus Aset
                                    </option>
                                    <option value="super_admin" {{ old('role', $user->role) == 'super_admin' ? 'selected' : '' }}>
                                        🔐 Super Admin
                                    </option>
                                </select>
                                <label for="role">Role User <span class="required-asterisk">*</span></label>
                                @if($user->role)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('role')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            
                            {{-- Hidden input if role is disabled --}}
                            @if($user->role === 'super_admin' && \App\Models\User::where('role', 'super_admin')->count() <= 1)
                                <input type="hidden" name="role" value="super_admin">
                            @endif
                        </div>

                        {{-- Jabatan --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-briefcase"></i>
                                <input type="text" 
                                       name="jabatan" 
                                       id="jabatan" 
                                       value="{{ old('jabatan', $user->jabatan) }}"
                                       class="form-input input-with-icon @error('jabatan') error @enderror"
                                       placeholder=" "
                                       maxlength="255"
                                       data-original="{{ $user->jabatan }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="jabatan">Jabatan</label>
                                @if($user->jabatan)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('jabatan')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="section-divider">
                        <span class="section-divider-text">Ubah Password (Opsional)</span>
                    </div>

                    <div class="info-card mb-6">
                        <p class="text-sm text-blue-700 dark:text-blue-400 flex items-start">
                            <i class="fas fa-info-circle mt-0.5 mr-2 flex-shrink-0"></i>
                            <span>
                                Kosongkan field password jika tidak ingin mengubah password. 
                                Password harus minimal 8 karakter dan harus dikonfirmasi.
                            </span>
                        </p>
                    </div>

                    <div class="smart-grid">
                        {{-- Password Baru --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-lock"></i>
                                <input type="password" 
                                       name="password" 
                                       id="password" 
                                       class="form-input input-with-icon @error('password') error @enderror"
                                       placeholder=" "
                                       minlength="8"
                                       onchange="trackPasswordChange(this)">
                                <label for="password">Password Baru</label>
                            </div>
                            @error('password')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-lock"></i>
                                <input type="password" 
                                       name="password_confirmation" 
                                       id="password_confirmation" 
                                       class="form-input input-with-icon @error('password_confirmation') error @enderror"
                                       placeholder=" "
                                       minlength="8">
                                <label for="password_confirmation">Konfirmasi Password Baru</label>
                            </div>
                            @error('password_confirmation')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>


            {{-- 2. Data Pribadi --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 form-step active card-hover">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-green-50 via-emerald-50 to-teal-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 rounded-t-2xl">
                    <div class="flex items-center">
                        <div class="p-3 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl mr-4 shadow-lg">
                            <i class="fas fa-id-card text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">2. Data Pribadi</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Informasi pribadi dan identitas user</p>
                        </div>
                        <div class="ml-auto">
                            <div class="bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-300 text-xs font-bold px-3 py-1 rounded-full">
                                Step 2/4
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="smart-grid">
                        {{-- Instansi --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-building"></i>
                                <input type="text" 
                                       name="instansi" 
                                       id="instansi" 
                                       value="{{ old('instansi', $user->instansi) }}"
                                       class="form-input input-with-icon @error('instansi') error @enderror"
                                       placeholder=" "
                                       maxlength="255"
                                       data-original="{{ $user->instansi }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="instansi">Instansi/Perusahaan</label>
                                @if($user->instansi)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('instansi')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Nama Organisasi --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-users"></i>
                                <input type="text" 
                                       name="nama_organisasi" 
                                       id="nama_organisasi" 
                                       value="{{ old('nama_organisasi', $user->nama_organisasi) }}"
                                       class="form-input input-with-icon @error('nama_organisasi') error @enderror"
                                       placeholder=" "
                                       maxlength="255"
                                       data-original="{{ $user->nama_organisasi }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="nama_organisasi">Nama Organisasi</label>
                                @if($user->nama_organisasi)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('nama_organisasi')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Nomor KTP --}}
                        <div class="floating-label lg:col-span-2">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-id-card-alt"></i>
                                <input type="text" 
                                       name="no_ktp" 
                                       id="no_ktp" 
                                       value="{{ old('no_ktp', $user->no_ktp) }}"
                                       class="form-input input-with-icon @error('no_ktp') error @enderror"
                                       placeholder=" "
                                       maxlength="16"
                                       pattern="[0-9]{16}"
                                       data-original="{{ $user->no_ktp }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="no_ktp">Nomor KTP (16 digit)</label>
                                @if($user->no_ktp)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('no_ktp')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. Kontak & Alamat --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 form-step active card-hover">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-purple-50 via-pink-50 to-rose-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 rounded-t-2xl">
                    <div class="flex items-center">
                        <div class="p-3 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl mr-4 shadow-lg">
                            <i class="fas fa-map-marked-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">3. Kontak & Alamat</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Informasi kontak dan alamat lengkap user</p>
                        </div>
                        <div class="ml-auto">
                            <div class="bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-300 text-xs font-bold px-3 py-1 rounded-full">
                                Step 3/4
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="smart-grid">
                        {{-- Nomor Telepon --}}
                        <div class="floating-label lg:col-span-2">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-phone"></i>
                                <input type="tel" 
                                       name="no_telp" 
                                       id="no_telp" 
                                       value="{{ old('no_telp', $user->no_telp) }}"
                                       class="form-input input-with-icon @error('no_telp') error @enderror"
                                       placeholder=" "
                                       maxlength="15"
                                       data-original="{{ $user->no_telp }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="no_telp">Nomor Telepon/HP</label>
                                @if($user->no_telp)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('no_telp')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Alamat Lengkap --}}
                        <div class="floating-label lg:col-span-2">
                            <div class="relative">
                                <textarea name="alamat" 
                                          id="alamat" 
                                          rows="3"
                                          class="form-input @error('alamat') error @enderror"
                                          placeholder=" "
                                          data-original="{{ $user->alamat }}"
                                          onchange="trackChanges(this)"
                                          oninput="trackChanges(this)">{{ old('alamat', $user->alamat) }}</textarea>
                                <label for="alamat">Alamat Lengkap</label>
                                @if($user->alamat)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('alamat')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Kelurahan --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-map-marker-alt"></i>
                                <input type="text" 
                                       name="kelurahan" 
                                       id="kelurahan" 
                                       value="{{ old('kelurahan', $user->kelurahan) }}"
                                       class="form-input input-with-icon @error('kelurahan') error @enderror"
                                       placeholder=" "
                                       maxlength="255"
                                       data-original="{{ $user->kelurahan }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="kelurahan">Kelurahan/Desa</label>
                                @if($user->kelurahan)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('kelurahan')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Kecamatan --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-map-marker-alt"></i>
                                <input type="text" 
                                       name="kecamatan" 
                                       id="kecamatan" 
                                       value="{{ old('kecamatan', $user->kecamatan) }}"
                                       class="form-input input-with-icon @error('kecamatan') error @enderror"
                                       placeholder=" "
                                       maxlength="255"
                                       data-original="{{ $user->kecamatan }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="kecamatan">Kecamatan</label>
                                @if($user->kecamatan)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('kecamatan')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Kabupaten --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-city"></i>
                                <input type="text" 
                                       name="kabupaten" 
                                       id="kabupaten" 
                                       value="{{ old('kabupaten', $user->kabupaten) }}"
                                       class="form-input input-with-icon @error('kabupaten') error @enderror"
                                       placeholder=" "
                                       maxlength="255"
                                       data-original="{{ $user->kabupaten }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="kabupaten">Kabupaten/Kota</label>
                                @if($user->kabupaten)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('kabupaten')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Kode Pos --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-mailbox"></i>
                                <input type="text" 
                                       name="kode_pos" 
                                       id="kode_pos" 
                                       value="{{ old('kode_pos', $user->kode_pos) }}"
                                       class="form-input input-with-icon @error('kode_pos') error @enderror"
                                       placeholder=" "
                                       maxlength="5"
                                       pattern="[0-9]{5}"
                                       data-original="{{ $user->kode_pos }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="kode_pos">Kode Pos</label>
                                @if($user->kode_pos)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
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

            {{-- 4. Upload Foto & Lainnya --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 form-step active card-hover">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-orange-50 via-amber-50 to-yellow-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 rounded-t-2xl">
                    <div class="flex items-center">
                        <div class="p-3 bg-gradient-to-r from-orange-500 to-amber-600 rounded-xl mr-4 shadow-lg">
                            <i class="fas fa-camera text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">4. Upload Foto Profil</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Foto profil user (opsional)</p>
                        </div>
                        <div class="ml-auto">
                            <div class="bg-orange-100 dark:bg-orange-900/50 text-orange-800 dark:text-orange-300 text-xs font-bold px-3 py-1 rounded-full">
                                Step 4/4
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-8">
                    {{-- Current Avatar Display --}}
                    @if($user->avatar)
                    <div class="mb-8">
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800 rounded-xl p-6">
                            <h5 class="text-lg font-bold text-green-800 dark:text-green-300 mb-4 flex items-center">
                                <i class="fas fa-image mr-2"></i>
                                Foto Profil Saat Ini
                            </h5>
                            <div class="flex flex-col lg:flex-row lg:items-start lg:space-x-6">
                                <img src="{{ asset('storage/' . $user->avatar) }}" 
                                     alt="Avatar {{ $user->name }}" 
                                     class="preview-image current-image-preview mb-4 lg:mb-0 rounded-full" 
                                     style="width: 200px; height: 200px; object-fit: cover;">
                                <div class="flex-1">
                                    <div class="text-sm text-green-700 dark:text-green-400 mb-4 space-y-2">
                                        <div><strong>Status:</strong> Foto tersimpan</div>
                                        <div><strong>File:</strong> {{ basename($user->avatar) }}</div>
                                        <div><strong>Upload:</strong> {{ $user->created_at->format('d M Y H:i') }}</div>
                                    </div>
                                    <div class="warning-card">
                                        <p class="text-sm text-yellow-700 dark:text-yellow-400 flex items-start">
                                            <i class="fas fa-exclamation-triangle mt-0.5 mr-2 flex-shrink-0"></i>
                                            <span>
                                                Jika Anda upload foto baru, foto saat ini akan diganti dan tidak dapat dikembalikan.
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Upload New Avatar Section --}}
                    <div class="mb-8">
                        <div class="file-upload-area" id="file-upload-area" onclick="document.getElementById('avatar').click()">
                            <div class="relative z-10">
                                <div class="mb-4">
                                    <i class="fas fa-cloud-upload-alt text-5xl text-gray-400 dark:text-gray-600 animate-bounce-slow"></i>
                                </div>
                                <h4 class="text-xl font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    @if($user->avatar)
                                        Ganti Foto Profil
                                    @else
                                        Upload Foto Profil
                                    @endif
                                </h4>
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
                                    @if($user->avatar)
                                        Pilih Foto Baru
                                    @else
                                        Pilih Foto
                                    @endif
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
                        
                        {{-- New Image Preview Area --}}
                        <div id="image-preview-container" class="hidden mt-6">
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-6">
                                <h5 class="text-lg font-bold text-blue-800 dark:text-blue-300 mb-4 flex items-center">
                                    <i class="fas fa-eye mr-2"></i>
                                    Preview Foto Baru
                                </h5>
                                <div class="flex flex-col lg:flex-row lg:items-center lg:space-x-6">
                                    <div class="relative mb-4 lg:mb-0">
                                        <img id="image-preview" src="" alt="Preview" class="preview-image rounded-full" style="width: 200px; height: 200px; object-fit: cover;">
                                        <div class="absolute top-0 right-0 bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-bl-lg rounded-tr-lg">
                                            NEW
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div id="file-info" class="text-sm text-blue-700 dark:text-blue-400 mb-4 space-y-1"></div>
                                        <button type="button" 
                                                onclick="removeNewImage()" 
                                                class="inline-flex items-center px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition-all transform hover:scale-105">
                                            <i class="fas fa-trash mr-2"></i>
                                            Hapus Foto Baru
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="info-card mt-4">
                            <h5 class="text-sm font-bold text-blue-800 dark:text-blue-300 mb-3 flex items-center">
                                <i class="fas fa-lightbulb mr-2"></i>
                                Tips Upload Foto Terbaik:
                            </h5>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs text-blue-700 dark:text-blue-400">
                                <div class="flex items-center">
                                    <i class="fas fa-sun text-yellow-500 mr-2"></i>
                                    Gunakan pencahayaan yang baik dan natural
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-smile text-green-500 mr-2"></i>
                                    Pastikan wajah terlihat jelas
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-crop text-purple-500 mr-2"></i>
                                    Foto akan otomatis dipotong menjadi bulat
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-times-circle text-red-500 mr-2"></i>
                                    Hindari foto yang blur atau gelap
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
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
                                <span id="submit-text">Update Perubahan</span>
                            </button>
                        </div>
                    </div>
                    
                    {{-- Save confirmation --}}
                    <div id="save-confirmation" class="hidden mt-4 p-4 bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-800 rounded-lg">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-orange-600 dark:text-orange-400 text-xl"></i>
                            </div>
                            <div class="ml-3 flex-1">
                                <h4 class="text-sm font-bold text-orange-800 dark:text-orange-300">Konfirmasi Perubahan</h4>
                                <div id="changes-preview" class="text-sm text-orange-700 dark:text-orange-400 mt-2"></div>
                                <div class="mt-4 flex gap-3">
                                    <button type="button" onclick="confirmSave()" class="px-4 py-2 bg-orange-600 text-white text-sm font-medium rounded-lg hover:bg-orange-700 transition-colors">
                                        Ya, Simpan
                                    </button>
                                    <button type="button" onclick="cancelSave()" class="px-4 py-2 bg-gray-500 text-white text-sm font-medium rounded-lg hover:bg-gray-600 transition-colors">
                                        Kembali
                                    </button>
                                </div>
                            </div>
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
    <div id="notification" class="notification">
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
            <button onclick="hideNotification()" class="ml-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 p-2 rounded-lg transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div id="notification" class="notification">
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
            <button onclick="hideNotification()" class="ml-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 p-2 rounded-lg transition-colors">
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
let changedFields = new Set();
let originalValues = {};
let confirmationPending = false;

// Initialize edit form
document.addEventListener('DOMContentLoaded', function() {
    // Store original values
    const formElements = document.querySelectorAll('#user-form input, #user-form select, #user-form textarea');
    formElements.forEach(element => {
        if (element.dataset.original !== undefined && element.name !== 'password' && element.name !== 'password_confirmation') {
            originalValues[element.name] = element.dataset.original;
        }
    });
    
    // Setup drag and drop for file upload
    setupDragAndDrop();
    
    // Initialize progress as complete since we're editing existing data
    updateProgress();
    
    console.log('✅ Enhanced User edit form initialized successfully');
});

// Track field changes
function trackChanges(element) {
    const fieldName = element.name;
    const currentValue = element.type === 'checkbox' ? element.checked : element.value;
    const originalValue = originalValues[fieldName] || '';
    
    // Compare values
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

// Track password changes
function trackPasswordChange(element) {
    if (element.value.trim() !== '') {
        changedFields.add('password');
        element.classList.add('field-modified');
    } else {
        changedFields.delete('password');
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
    
    if (changesCount > 0) {
        // Show changes summary
        if (changesSummary) {
            changesSummary.classList.remove('hidden');
            changesCountElement.textContent = changesCount;
            
            // Build changes list
            const changesList = Array.from(changedFields).map(fieldName => {
                const label = getFieldLabel(fieldName);
                return `• ${label}`;
            }).join('\n');
            
            changesListElement.innerHTML = changesList.split('\n').join('<br>');
        }
        
        // Enable buttons
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        }
        if (resetBtn) {
            resetBtn.disabled = false;
            resetBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        }
    } else {
        // Hide changes summary
        if (changesSummary) {
            changesSummary.classList.add('hidden');
        }
        
        // Disable buttons
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
        if (resetBtn) {
            resetBtn.disabled = true;
            resetBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }
}

// Get field label helper
function getFieldLabel(fieldName) {
    const labelMap = {
        'name': 'Nama Lengkap',
        'email': 'Email',
        'role': 'Role User',
        'jabatan': 'Jabatan',
        'password': 'Password',
        'instansi': 'Instansi/Perusahaan',
        'nama_organisasi': 'Nama Organisasi',
        'no_ktp': 'Nomor KTP',
        'no_telp': 'Nomor Telepon/HP',
        'alamat': 'Alamat Lengkap',
        'kelurahan': 'Kelurahan/Desa',
        'kecamatan': 'Kecamatan',
        'kabupaten': 'Kabupaten/Kota',
        'kode_pos': 'Kode Pos',
        'avatar': 'Foto Profil'
    };
    
    return labelMap[fieldName] || fieldName;
}

// Reset changes
function resetChanges() {
    if (!confirm('Reset semua perubahan? Semua perubahan yang belum disimpan akan hilang.')) {
        return;
    }
    
    changedFields.forEach(fieldName => {
        const element = document.querySelector(`[name="${fieldName}"]`);
        if (element && originalValues[fieldName] !== undefined) {
            if (element.type === 'checkbox') {
                element.checked = originalValues[fieldName] === 'true';
            } else {
                element.value = originalValues[fieldName];
            }
            element.classList.remove('field-modified');
        }
    });
    
    // Reset password fields
    const passwordField = document.getElementById('password');
    const passwordConfirmField = document.getElementById('password_confirmation');
    if (passwordField) {
        passwordField.value = '';
        passwordField.classList.remove('field-modified');
    }
    if (passwordConfirmField) {
        passwordConfirmField.value = '';
    }
    
    // Reset file input if changed
    if (changedFields.has('avatar')) {
        removeNewImage();
    }
    
    changedFields.clear();
    updateChangesUI();
    
    showNotification('Perubahan berhasil direset', 'success');
}

// Update progress for edit form
function updateProgress() {
    const progressFill = document.getElementById('progress-fill');
    const progressText = document.getElementById('progress-text');
    const fieldCounter = document.getElementById('field-counter');
    
    if (progressFill && progressText && fieldCounter) {
        // For edit, progress is always 100% since data exists
        progressFill.style.width = '100%';
        progressText.textContent = '100% Lengkap';
        fieldCounter.textContent = 'Data Tersimpan';
        fieldCounter.classList.remove('text-gray-700', 'dark:text-gray-700');
        fieldCounter.classList.add('text-green-700', 'dark:text-green-300');
    }
}

// Update role display
function updateRoleDisplay() {
    const roleSelect = document.getElementById('role');
    if (roleSelect) {
        const selectedRole = roleSelect.value;
        const roleLabel = roleSelect.options[roleSelect.selectedIndex].text;
        showNotification(`Role diubah menjadi: ${roleLabel}`, 'info');
    }
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
    
    // Validate file
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
                <div><strong>Resolusi:</strong> <span id="image-resolution">Memuat...</span></div>
            `;
            
            // Get image dimensions
            previewImage.onload = function() {
                const resolutionSpan = document.getElementById('image-resolution');
                if (resolutionSpan) {
                    resolutionSpan.textContent = `${this.naturalWidth} x ${this.naturalHeight} px`;
                }
            };
            
            previewContainer.classList.remove('hidden');
            
            // Track avatar change
            changedFields.add('avatar');
            updateChangesUI();
            
            // Smooth scroll to preview
            previewContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    };
    reader.readAsDataURL(file);
}

function removeNewImage() {
    const fileInput = document.getElementById('avatar');
    const previewContainer = document.getElementById('image-preview-container');
    
    if (fileInput) {
        fileInput.value = '';
        changedFields.delete('avatar');
        updateChangesUI();
    }
    if (previewContainer) previewContainer.classList.add('hidden');
    
    showNotification('Foto baru berhasil dihapus', 'success');
}

function validateImageFile(file) {
    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    const maxSize = 2 * 1024 * 1024; // 2MB
    
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

// Form Submission with confirmation
document.getElementById('user-form').addEventListener('submit', function(e) {
    if (changedFields.size === 0) {
        e.preventDefault();
        showNotification('Tidak ada perubahan yang perlu disimpan', 'warning');
        return false;
    }
    
    if (!confirmationPending) {
        e.preventDefault();
        showSaveConfirmation();
        return false;
    }
    
    if (!validateFormComplete()) {
        e.preventDefault();
        confirmationPending = false;
        return false;
    }
    
    // Show loading overlay
    const loadingOverlay = document.getElementById('loading-overlay');
    if (loadingOverlay) {
        loadingOverlay.classList.remove('hidden');
    }
    
    // Update submit button
    const submitBtn = document.getElementById('submit-btn');
    const submitText = document.getElementById('submit-text');
    
    if (submitBtn && submitText) {
        submitBtn.disabled = true;
        submitText.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
    }
    
    // Timeout handler
    const timeoutHandler = setTimeout(() => {
        if (!this.submitted) {
            if (loadingOverlay) {
                loadingOverlay.classList.add('hidden');
            }
            if (submitBtn && submitText) {
                submitBtn.disabled = false;
                submitText.innerHTML = '<i class="fas fa-save mr-2"></i>Simpan Perubahan';
            }
            showNotification('Terjadi timeout. Silakan coba lagi.', 'error');
        }
    }, 60000); // 60 second timeout
    
    this.submitted = true;
    this.timeoutHandler = timeoutHandler;
});

function showSaveConfirmation() {
    const confirmationDiv = document.getElementById('save-confirmation');
    const changesPreview = document.getElementById('changes-preview');
    
    if (confirmationDiv && changesPreview) {
        const changesList = Array.from(changedFields).map(fieldName => {
            const label = getFieldLabel(fieldName);
            return `• ${label}`;
        }).join('<br>');
        
        changesPreview.innerHTML = `
            <p class="mb-2">Anda akan menyimpan perubahan pada ${changedFields.size} field berikut:</p>
            <div class="bg-orange-100 dark:bg-orange-900/30 p-2 rounded text-xs">${changesList}</div>
        `;
        
        confirmationDiv.classList.remove('hidden');
        confirmationDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

function confirmSave() {
    const confirmationDiv = document.getElementById('save-confirmation');
    if (confirmationDiv) {
        confirmationDiv.classList.add('hidden');
    }
    
    confirmationPending = true;
    document.getElementById('user-form').submit();
}

function cancelSave() {
    const confirmationDiv = document.getElementById('save-confirmation');
    if (confirmationDiv) {
        confirmationDiv.classList.add('hidden');
    }
    confirmationPending = false;
}

function validateFormComplete() {
    let isValid = true;
    const errors = [];
    
    // Validate required fields
    const requiredFields = [
        { id: 'name', name: 'Nama Lengkap' },
        { id: 'email', name: 'Email' },
        { id: 'role', name: 'Role User' }
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
    
    // Validate password match if password is being changed
    const passwordField = document.getElementById('password');
    const passwordConfirmField = document.getElementById('password_confirmation');
    
    if (passwordField && passwordField.value.trim() !== '') {
        if (passwordField.value.length < 8) {
            errors.push('Password minimal 8 karakter');
            passwordField.classList.add('error');
            isValid = false;
        }
        
        if (passwordField.value !== passwordConfirmField.value) {
            errors.push('Konfirmasi password tidak cocok');
            passwordConfirmField.classList.add('error');
            isValid = false;
        }
    }
    
    // Validate file if uploaded
    const fileInput = document.getElementById('avatar');
    if (fileInput && fileInput.files.length > 0) {
        if (!validateImageFile(fileInput.files[0])) {
            isValid = false;
        }
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
        success: 'bg-green-100 dark:bg-green-900/50',
        error: 'bg-red-100 dark:bg-red-900/50',
        warning: 'bg-yellow-100 dark:bg-yellow-900/50',
        info: 'bg-blue-100 dark:bg-blue-900/50'
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

// Auto hide existing notifications
@if(session('success') || session('error'))
setTimeout(() => {
    const notification = document.getElementById('notification');
    if (notification) hideNotification(notification);
}, 5000);
@endif

</script>
@endpush