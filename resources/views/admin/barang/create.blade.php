@extends('layouts.app')

@section('title', 'Tambah Barang - Admin')

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
    
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
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
    
    .code-preview {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        color: #1e40af;
        padding: 1rem 1.25rem;
        border-radius: 0.75rem;
        font-family: 'Courier New', monospace;
        font-size: 0.875rem;
        font-weight: 600;
        border: 1px solid #3b82f6;
        margin: 0.5rem 0;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.15);
        letter-spacing: 0.5px;
    }
    
    .dark .code-preview {
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
        color: #93c5fd;
        border-color: #60a5fa;
        box-shadow: 0 2px 8px rgba(96, 165, 250, 0.3);
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

/* Tambahkan class untuk notification types di dark mode */
.dark .notification .bg-green-100 {
    background: #065f46 !important;
}

.dark .notification .bg-red-100 {
    background: #7f1d1d !important;
}

.dark .notification .bg-yellow-100 {
    background: #78350f !important;
}

.dark .notification .bg-blue-100 {
    background: #1e3a8a !important;
}

.dark .notification .text-green-600 {
    color: #34d399 !important;
}

.dark .notification .text-red-600 {
    color: #f87171 !important;
}

.dark .notification .text-yellow-600 {
    color: #fbbf24 !important;
}

.dark .notification .text-blue-600 {
    color: #60a5fa !important;
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
        
        /* Progress Indicator - Lebih besar di mobile */
        .step-indicator {
            padding: 1.25rem;
            margin-bottom: 1.5rem;
        }
        
        .step-indicator h3 {
            font-size: 1rem;
            margin-bottom: 0.75rem;
        }
        
        #progress-text {
            font-size: 0.875rem;
        }
        
        #field-counter {
            font-size: 0.75rem;
            padding: 0.375rem 0.75rem;
        }
        
        .progress-bar {
            height: 8px;
            margin: 0.75rem 0;
        }
        
        .step-indicator .flex.justify-between.text-xs {
            font-size: 0.7rem;
            gap: 0.25rem;
        }
        
        /* Status Peminjaman Card - Fix Toggle yang lebih rapih */
        .bg-gradient-to-r.from-blue-50.to-indigo-50.dark\:from-blue-900\/20.dark\:to-indigo-900\/20.border-2 {
            padding: 1.125rem !important;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50.dark\:from-blue-900\/20 .flex.items-start.space-x-4 {
            gap: 0.875rem;
            align-items: flex-start;
        }
        
        /* Icon container */
        .bg-gradient-to-r.from-blue-50.to-indigo-50.dark\:from-blue-900\/20 .flex-shrink-0 .w-12.h-12 {
            width: 3rem;
            height: 3rem;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50.dark\:from-blue-900\/20 .flex-shrink-0 .w-12.h-12 i {
            font-size: 1.25rem;
        }
        
        /* Content area */
        .bg-gradient-to-r.from-blue-50.to-indigo-50.dark\:from-blue-900\/20 .flex-1 {
            min-width: 0;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50.dark\:from-blue-900\/20 .flex-1 h4 {
            font-size: 1rem;
            margin-bottom: 0.5rem;
            line-height: 1.3;
            font-weight: 700;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50.dark\:from-blue-900\/20 .flex-1 > p {
            font-size: 0.875rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }
        
        /* Toggle Switch Container */
        .bg-gradient-to-r.from-blue-50.to-indigo-50.dark\:from-blue-909\/20 .flex.items-center {
            display: flex;
            align-items: center;
            width: 100%;
            margin-top: 0;
        }
        
        /* Toggle Label Container */
        label.relative.inline-flex.items-center.cursor-pointer.group {
            display: flex !important;
            align-items: center !important;
            width: 100%;
            gap: 0.75rem;
        }
        
        /* Toggle Switch - Lebih besar dan proporsional */
        label.relative.inline-flex.items-center.cursor-pointer.group .w-14.h-7 {
            width: 3.5rem !important;
            height: 1.875rem !important;
            flex-shrink: 0;
            position: relative;
        }
        
        /* Toggle Circle */
        label.relative.inline-flex.items-center.cursor-pointer.group .w-14.h-7::after {
            content: '';
            position: absolute;
            height: 1.5rem !important;
            width: 1.5rem !important;
            top: 0.1875rem !important;
            left: 0.1875rem !important;
            background-color: white;
            border-radius: 50%;
            transition: transform 0.3s;
        }
        
        label.relative.inline-flex.items-center.cursor-pointer.group input:checked + .w-14.h-7::after {
            transform: translateX(1.625rem);
        }
        
        /* Text Label */
        label.relative.inline-flex.items-center.cursor-pointer.group .ml-3 {
            margin-left: 0 !important;
            font-size: 0.875rem;
            line-height: 1.4;
            flex: 1;
            font-weight: 600;
        }
        
        label.relative.inline-flex.items-center.cursor-pointer.group #status-text {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        label.relative.inline-flex.items-center.cursor-pointer.group #status-icon {
            flex-shrink: 0;
            font-size: 1rem;
        }
        
        label.relative.inline-flex.items-center.cursor-pointer.group #status-label {
            flex: 1;
        }
        
        /* Info box di dalam card */
        .bg-gradient-to-r.from-blue-50.to-indigo-50.dark\:from-blue-900\/20 .mt-4.p-4 {
            padding: 0.875rem !important;
            margin-top: 1rem !important;
            border-radius: 0.5rem;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50.dark\:from-blue-900\/20 .grid.grid-cols-1.md\:grid-cols-2 {
            grid-template-columns: 1fr;
            gap: 0.75rem;
            font-size: 0.8125rem;
            line-height: 1.5;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50.dark\:from-blue-900\/20 .grid.grid-cols-1.md\:grid-cols-2 > div {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50.dark\:from-blue-900\/20 .grid.grid-cols-1.md\:grid-cols-2 i {
            margin-top: 0.125rem;
            flex-shrink: 0;
            font-size: 0.875rem;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50.dark\:from-blue-900\/20 .grid.grid-cols-1.md\:grid-cols-2 strong {
            font-weight: 600;
        }
        
        /* Upload Foto Section */
        .file-upload-area {
            padding: 2rem 1.25rem !important;
        }
        
        .file-upload-area i.fa-cloud-upload-alt {
            font-size: 3rem !important;
        }
        
        .file-upload-area h4 {
            font-size: 1.125rem !important;
            margin-bottom: 0.75rem !important;
        }
        
        .file-upload-area p {
            font-size: 0.875rem !important;
            margin-bottom: 1rem !important;
        }
        
        .file-upload-area .flex.justify-center.space-x-4 {
            flex-direction: column;
            gap: 0.75rem;
            align-items: stretch;
        }
        
        .file-upload-area .text-xs {
            font-size: 0.75rem;
            flex-direction: column;
            gap: 0.375rem;
        }
        
        /* Buttons - Lebih besar dan touch-friendly */
        .file-upload-area button,
        .bg-gradient-to-r.from-blue-50.to-indigo-50 button {
            padding: 0.875rem 1.25rem !important;
            font-size: 0.9375rem !important;
            min-height: 44px; /* Apple's recommended touch target */
        }
        
        /* Upload Foto Detail Card - Lebih rapih dan proporsional */
        .bg-gradient-to-r.from-blue-50.to-indigo-50.dark\:from-blue-900\/20.dark\:to-indigo-900\/20.border-2.border-blue-200 {
            padding: 1rem !important;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50 .flex.items-start.space-x-4 {
            gap: 0.75rem;
            flex-direction: row;
            align-items: flex-start;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50 .flex-shrink-0.mt-1 {
            margin-top: 0;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50 .w-12.h-12.bg-gradient-to-r {
            width: 3rem;
            height: 3rem;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50 .w-12.h-12 i {
            font-size: 1.25rem;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50 .flex-1 {
            min-width: 0;
            flex: 1;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50 .flex-1 h4 {
            font-size: 1rem;
            margin-bottom: 0.5rem;
            line-height: 1.3;
            font-weight: 700;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50 .flex-1 > p {
            font-size: 0.875rem;
            line-height: 1.5;
            margin-bottom: 1rem;
        }
        
        /* Buttons Container - Side by side dengan spacing baik */
        .bg-gradient-to-r.from-blue-50.to-indigo-50 .flex.gap-3 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
            width: 100%;
            margin-bottom: 0.75rem;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50 .flex.gap-3 button {
            width: 100%;
            padding: 0.875rem 0.75rem !important;
            font-size: 0.875rem !important;
            min-height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-weight: 500;
            border-radius: 0.5rem;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50 .flex.gap-3 button i {
            font-size: 1.125rem;
            flex-shrink: 0;
        }
        
        /* Ambil Foto button (Green) */
        .bg-gradient-to-r.from-blue-50.to-indigo-50 .flex.gap-3 button.bg-green-500 {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        
        /* Pilih dari Galeri button (Blue) */
        .bg-gradient-to-r.from-blue-50.to-indigo-50 .flex.gap-3 button.bg-blue-500 {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }
        
        /* Info text below buttons */
        .bg-gradient-to-r.from-blue-50.to-indigo-50 .mt-3.text-xs {
            margin-top: 0;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50 .text-xs.space-y-1 {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            font-size: 0.8125rem;
            line-height: 1.5;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50 .text-xs.space-y-1 > div {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .bg-gradient-to-r.from-blue-50.to-indigo-50 .text-xs.space-y-1 i {
            margin-top: 0.125rem;
            flex-shrink: 0;
            font-size: 0.875rem;
        }
        
        /* Tips Card - Font lebih besar */
        .info-card,
        .warning-card,
        .success-card {
            padding: 1rem !important;
        }
        
        .info-card h5,
        .warning-card h5,
        .success-card h5 {
            font-size: 0.875rem !important;
            margin-bottom: 0.75rem !important;
        }
        
        .info-card .grid,
        .warning-card .grid,
        .success-card .grid {
            gap: 0.75rem;
        }
        
        .info-card .text-xs,
        .warning-card .text-xs,
        .success-card .text-xs {
            font-size: 0.8125rem !important;
            line-height: 1.5;
        }
        
        /* Preview Multiple Photos Grid */
        #multiple-preview-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 0.875rem;
        }
        
        #multiple-preview-grid .relative.group {
            min-height: 140px;
        }
        
        /* Form Section Headers */
        .form-step .p-6.border-b h3 {
            font-size: 1.125rem;
        }
        
        .form-step .p-6.border-b p {
            font-size: 0.8125rem;
        }
        
        .form-step .p-6.border-b .text-xs {
            font-size: 0.6875rem;
            padding: 0.375rem 0.75rem;
        }
        
        /* Icon di section header */
        .form-step .p-3.bg-gradient-to-r {
            padding: 0.625rem;
            width: 2.5rem;
            height: 2.5rem;
        }
        
        .form-step .p-3.bg-gradient-to-r i {
            font-size: 1.125rem;
        }
        
        /* Action Buttons Area - 2 baris layout */
        .bg-white.dark\:bg-gray-800.rounded-xl.shadow-sm .p-6 {
            padding: 1rem !important;
        }
        
        .bg-white.dark\:bg-gray-800.rounded-xl.shadow-sm .flex.flex-col.sm\:flex-row {
            flex-direction: column;
            gap: 1rem;
        }
        
        .bg-white.dark\:bg-gray-800.rounded-xl.shadow-sm .flex.items-center.text-sm {
            order: -1;
            text-align: center;
            justify-content: center;
        }
        
        /* Button Container - 2 rows */
        .bg-white.dark\:bg-gray-800.rounded-xl.shadow-sm .flex.gap-3 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: auto auto;
            gap: 0.625rem;
            width: 100%;
        }
        
        /* Row 1: Reset & Simpan */
        .bg-white.dark\:bg-gray-800.rounded-xl.shadow-sm .flex.gap-3 button:nth-child(2) {
            grid-column: 1;
            grid-row: 1;
        }
        
        .bg-white.dark\:bg-gray-800.rounded-xl.shadow-sm .flex.gap-3 button:nth-child(3) {
            grid-column: 2;
            grid-row: 1;
        }
        
        /* Row 2: Kembali (full width) */
        .bg-white.dark\:bg-gray-800.rounded-xl.shadow-sm .flex.gap-3 button:nth-child(1) {
            grid-column: 1 / -1;
            grid-row: 2;
            order: 3;
        }
        
        /* Button Styling */
        .bg-white.dark\:bg-gray-800.rounded-xl.shadow-sm button {
            width: 100%;
            justify-content: center;
            padding: 0.8125rem 1rem;
            font-size: 0.875rem;
            min-height: 44px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .bg-white.dark\:bg-gray-800.rounded-xl.shadow-sm button i {
            font-size: 1rem;
        }
        
        /* Breadcrumb - Kompak di mobile */
        .breadcrumb-modern {
            padding: 0.75rem 1rem;
            font-size: 0.8125rem;
            gap: 0.5rem;
        }
        
        .breadcrumb-modern i {
            font-size: 0.875rem;
        }
        
        /* Header Section */
        .relative.overflow-hidden.bg-white .p-8 {
            padding: 1.5rem !important;
        }
        
        .relative.overflow-hidden.bg-white h1 {
            font-size: 1.75rem !important;
            line-height: 1.2;
        }
        
        .relative.overflow-hidden.bg-white p {
            font-size: 0.875rem !important;
        }
        
        .relative.overflow-hidden.bg-white .inline-flex.items-center.space-x-2 {
            padding: 0.5rem 0.875rem;
            font-size: 0.75rem;
        }
        
        /* Icon decoration di header - hide di mobile untuk save space */
        .relative.overflow-hidden.bg-white .p-4.bg-gradient-to-r {
            padding: 0.75rem;
            width: 3rem;
            height: 3rem;
        }
        
        .relative.overflow-hidden.bg-white .p-4.bg-gradient-to-r i {
            font-size: 1.5rem;
        }
        
        /* Section Divider */
        .section-divider {
            margin: 1.5rem 0;
        }
        
        .section-divider-text {
            font-size: 0.8125rem;
            padding: 0 0.75rem;
        }
        
        /* Code Preview */
        .code-preview {
            padding: 0.875rem 1rem;
            font-size: 0.8125rem;
        }
        
        /* Notification */
        .notification {
            right: 0.5rem;
            top: 0.5rem;
            left: 0.5rem;
            max-width: calc(100vw - 1rem);
        }
        
        .notification h4 {
            font-size: 1rem;
        }
        
        .notification p {
            font-size: 0.8125rem;
        }
        
        /* Loading Overlay */
        #loading-overlay .bg-white {
            padding: 2rem 1.5rem;
        }
        
        #loading-overlay h3 {
            font-size: 1.125rem;
        }
        
        #loading-overlay p {
            font-size: 0.8125rem;
        }
        
        /* Ensure touch targets are at least 44x44px */
        button,
        select,
        input[type="checkbox"],
        input[type="radio"] {
            min-height: 44px;
            min-width: 44px;
        }
        
        /* Better spacing for form sections */
        .form-step {
            margin-bottom: 1.5rem;
        }
        
        .form-step .p-8 {
            padding: 1.25rem !important;
        }
    }
    
    /* Extra small devices (portrait phones) */
    @media (max-width: 375px) {
        .relative.overflow-hidden.bg-white h1 {
            font-size: 1.5rem !important;
        }
        
        .step-indicator h3 {
            font-size: 0.9375rem;
        }
        
        .file-upload-area {
            padding: 1.5rem 1rem !important;
        }
        
        .file-upload-area h4 {
            font-size: 1rem !important;
        }
        
        #multiple-preview-grid {
            grid-template-columns: 1fr;
        }
    }
    

</style>
@endpush

@section('content')
<div class="w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 lg:py-4">
    {{-- Modern Breadcrumb Navigation - SAMA DENGAN INDEX --}}
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
                <i class="fas fa-plus-circle"></i>
                <span>Tambah Barang</span>
            </span>
        </div>
    </nav>

    {{-- Modern Header Section - SAMA DENGAN INDEX --}}
    <div class="mb-8 animate-fade-in">
        <div class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700">
            
            {{-- Background Decorations --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-400/20 via-indigo-400/20 to-purple-400/20 dark:from-blue-600/5 dark:via-indigo-600/5 dark:to-purple-600/5 rounded-full blur-3xl transform translate-x-32 -translate-y-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-cyan-400/15 to-blue-400/15 dark:from-cyan-600/5 dark:to-blue-600/5 rounded-full blur-2xl transform -translate-x-24 translate-y-24"></div>
            
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
                            <span class="text-sm font-semibold text-blue-700 dark :text-blue-300">Form Input Barang</span>
                        </div>
                        
                        {{-- Title --}}
                        <h1 class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-blue-800 to-indigo-800 dark:from-slate-100 dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent leading-tight">
                            Tambah Barang Baru
                        </h1>
                        
                        {{-- Description --}}
                        <p class="text-slate-600 dark:text-slate-400 text-lg flex items-center space-x-2">
                            <i class="fas fa-info-circle text-blue-500 dark:text-blue-400"></i>
                            <span>Lengkapi informasi barang untuk menambahkan ke inventaris sistem</span>
                        </p>
                    </div>
                    
                    {{-- Icon --}}
                    <div class="flex items-center space-x-3">
                        <div class="p-4 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl shadow-lg">
                            <i class="fas fa-plus-circle text-white text-3xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Bottom Gradient Line --}}
            <div class="h-1.5 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>
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
            <span>Informasi Dasar</span>
            <span>Spesifikasi</span>
            <span>Pembelian</span>
            <span>Media & Lainnya</span>
        </div>
    </div>

    <!-- Main Form -->
    <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data" id="barang-form" class="animate-slide-up">
        @csrf
        
        <!-- 1. Informasi Dasar -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 form-step active card-hover">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 via-blue-50/30 to-indigo-50/30 dark:from-gray-700/50 dark:via-gray-800/50 dark:to-gray-700/50 rounded-t-2xl">
                <div class="flex items-center">
                    <div class="p-3 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl mr-4 shadow-lg">
                        <i class="fas fa-info-circle text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">1. Informasi Dasar Barang</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Data utama dan identitas barang yang akan diinventaris</p>
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
                    <!-- Kategori Barang -->
                    <div class="floating-label">
                        <div class="input-group">
                            <i class="input-icon fas fa-layer-group"></i>
                            <select name="kategori_id" 
                                    id="kategori_id" 
                                    required
                                    class="form-input input-with-icon @error('kategori_id') error @enderror"
                                    onchange="updateKodePreview()">
                                <option value="">Pilih kategori...</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            <label for="kategori_id">Kategori Barang <span class="required-asterisk">*</span></label>
                        </div>
                        @error('kategori_id')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Kode Manual (Optional) -->
                    <div class="floating-label">
                        <div class="input-group">
                            <i class="input-icon fas fa-hashtag"></i>
                            <input type="text" 
                                   name="kode_manual" 
                                   id="kode_manual" 
                                   value="{{ old('kode_manual') }}"
                                   class="form-input input-with-icon @error('kode_manual') error @enderror"
                                   placeholder=""
                                   maxlength="5"
                                   pattern="[0-9]{1,5}"
                                   title="Hanya angka, maksimal 5 digit"
                                   onchange="updateKodePreview()">
                            <label for="kode_manual">Kode Manual (Opsional)</label>
                        </div>
                        
                        @error('kode_manual')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Preview Kode -->
                <div class="success-card mt-6">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-sm font-bold text-green-800 dark:text-green-300 flex items-center">
                            <i class="fas fa-eye mr-2"></i>
                            Preview Kode Barang
                        </h4>
                        <div class="bg-green-200 dark:bg-green-800 text-green-800 dark:text-green-200 text-xs font-bold px-2 py-1 rounded-full">
                            Auto-Generated
                        </div>
                    </div>
                    <div class="code-preview" id="kode-preview">
                        Pilih kategori untuk melihat preview kode...
                    </div>
                    <p class="text-xs text-green-600 dark:text-green-400 mt-2 flex items-center">
                        <i class="fas fa-info-circle mr-1"></i>
                        Format: CTP-[KATEGORI]-[NOMOR]-[TAHUN]
                    </p>
                </div>

                <div class="section-divider">
                    <span class="section-divider-text">Detail Barang</span>
                </div>

                <div class="smart-grid">
                    <!-- Nama Barang -->
                    <div class="floating-label lg:col-span-2">
                        <div class="input-group">
                            <i class="input-icon fas fa-cube"></i>
                            <input type="text" 
                                   name="nama_barang" 
                                   id="nama_barang" 
                                   value="{{ old('nama_barang') }}"
                                   required
                                   class="form-input input-with-icon @error('nama_barang') error @enderror"
                                   placeholder=" "
                                   maxlength="255">
                            <label for="nama_barang">Nama Barang <span class="required-asterisk">*</span></label>
                        </div>
                        @error('nama_barang')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Merk -->
                    <div class="floating-label">
                        <div class="input-group">
                            <i class="input-icon fas fa-tag"></i>
                            <input type="text" 
                                   name="merk" 
                                   id="merk" 
                                   value="{{ old('merk') }}"
                                   class="form-input input-with-icon @error('merk') error @enderror"
                                   placeholder=" "
                                   maxlength="255">
                            <label for="merk">Merk/Brand</label>
                        </div>
                        @error('merk')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Type -->
                    <div class="floating-label">
                        <div class="input-group">
                            <i class="input-icon fas fa-tags"></i>
                            <input type="text" 
                                   name="type" 
                                   id="type" 
                                   value="{{ old('type') }}"
                                   class="form-input input-with-icon @error('type') error @enderror"
                                   placeholder=" "
                                   maxlength="255">
                            <label for="type">Tipe/Model</label>
                        </div>
                        @error('type')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Spesifikasi Teknis -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 form-step card-hover">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 via-blue-50/30 to-indigo-50/30 dark:from-gray-700/50 dark:via-gray-800/50 dark:to-gray-700/50 rounded-t-2xl">
                <div class="flex items-center">
                    <div class="p-3 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl mr-4 shadow-lg">
                        <i class="fas fa-cogs text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">2. Spesifikasi Teknis</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Detail teknis dan karakteristik barang</p>
                    </div>
                    <div class="ml-auto">
                        <div class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs font-bold px-3 py-1 rounded-full">
                            Step 2/4
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p-8">
                <div class="smart-grid">
                    <!-- Nomor Seri -->
                    <div class="floating-label">
                        <div class="input-group">
                            <i class="input-icon fas fa-barcode"></i>
                            <input type="text" 
                                   name="seri" 
                                   id="seri" 
                                   value="{{ old('seri') }}"
                                   class="form-input input-with-icon @error('seri') error @enderror"
                                   placeholder=" "
                                   maxlength="255">
                            <label for="seri">Nomor Seri</label>
                        </div>
                        @error('seri')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tahun Produksi -->
                    <div class="floating-label">
                        <div class="input-group">
                            <i class="input-icon fas fa-calendar"></i>
                            <input type="number" 
                                   name="tahun_produksi" 
                                   id="tahun_produksi" 
                                   value="{{ old('tahun_produksi') }}"
                                   class="form-input input-with-icon @error('tahun_produksi') error @enderror"
                                   placeholder=" "
                                   min="1900"
                                   max="{{ date('Y') }}">
                            <label for="tahun_produksi">Tahun Produksi</label>
                        </div>
                        @error('tahun_produksi')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Warna -->
                    <div class="floating-label">
                        <div class="input-group">
                            <i class="input-icon fas fa-palette"></i>
                            <input type="text" 
                                   name="warna" 
                                   id="warna" 
                                   value="{{ old('warna') }}"
                                   class="form-input input-with-icon @error('warna') error @enderror"
                                   placeholder=" "
                                   maxlength="255">
                            <label for="warna">Warna</label>
                        </div>
                        @error('warna')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Berat -->
                    <div class="floating-label">
                        <div class="input-group">
                            <i class="input-icon fas fa-weight"></i>
                            <input type="number" 
                                   name="berat" 
                                   id="berat" 
                                   value="{{ old('berat') }}"
                                   step="0.01"
                                   min="0"
                                   class="form-input input-with-icon @error('berat') error @enderror"
                                   placeholder=" ">
                            <label for="berat">Berat (kg)</label>
                        </div>
                        @error('berat')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Dimensi -->
                    <div class="floating-label">
                        <div class="input-group">
                            <i class="input-icon fas fa-ruler-combined"></i>
                            <input type="text" 
                                   name="dimensi" 
                                   id="dimensi" 
                                   value="{{ old('dimensi') }}"
                                   class="form-input input-with-icon @error('dimensi') error @enderror"
                                   placeholder=""
                                   maxlength="255">
                            <label for="dimensi">Dimensi (PxLxT)</label>
                        </div>
                        @error('dimensi')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Garansi -->
                    <div class="floating-label">
                        <div class="input-group">
                            <i class="input-icon fas fa-shield-alt"></i>
                            <input type="text" 
                                   name="garansi" 
                                   id="garansi" 
                                   value="{{ old('garansi') }}"
                                   class="form-input input-with-icon @error('garansi') error @enderror"
                                   placeholder=""
                                   maxlength="255">
                            <label for="garansi">Masa Garansi</label>
                        </div>
                        @error('garansi')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Spesifikasi -->
                    <div class="floating-label lg:col-span-2">
                        <textarea name="spesifikasi" 
                                  id="spesifikasi" 
                                  rows="4"
                                  class="form-input @error('spesifikasi') error @enderror"
                                  placeholder=" ">{{ old('spesifikasi') }}</textarea>
                        <label for="spesifikasi">Spesifikasi Detail</label>
                        @error('spesifikasi')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Informasi Pembelian & Inventaris -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 form-step card-hover">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 via-blue-50/30 to-indigo-50/30 dark:from-gray-700/50 dark:via-gray-800/50 dark:to-gray-700/50 rounded-t-2xl">
                <div class="flex items-center">
                    <div class="p-3 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl mr-4 shadow-lg">
                        <i class="fas fa-shopping-cart text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">3. Informasi Pembelian & Inventaris</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Data pembelian dan pengelolaan inventaris barang</p>
                    </div>
                    <div class="ml-auto">
                        <div class="bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 text-xs font-bold px-3 py-1 rounded-full">
                            Step 3/4
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p-8">
                <div class="smart-grid">
                    <!-- Tanggal Pembelian -->
                    <div class="floating-label">
                        <div class="input-group">
                            <i class="input-icon fas fa-calendar-day"></i>
                            <input type="date" 
                                   name="tanggal_pembelian" 
                                   id="tanggal_pembelian" 
                                   value="{{ old('tanggal_pembelian') }}"
                                   class="form-input input-with-icon @error('tanggal_pembelian') error @enderror"
                                   max="{{ date('Y-m-d') }}">
                            <label for="tanggal_pembelian">Tanggal Pembelian</label>
                        </div>
                        @error('tanggal_pembelian')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Harga Beli -->
                    <div class="floating-label">
                        <div class="input-group">
                            <i class="input-icon fas fa-money-bill"></i>
                            <input type="number" 
                                   name="harga_beli" 
                                   id="harga_beli" 
                                   value="{{ old('harga_beli') }}"
                                   step="0.01"
                                   min="0"
                                   class="form-input input-with-icon @error('harga_beli') error @enderror"
                                   placeholder=" "
                                   onchange="formatRupiah(this)">
                            <label for="harga_beli">Harga Beli (Rp)</label>
                        </div>
                        @error('harga_beli')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Harga Sewa -->
                    <div class="floating-label">
                        <div class="input-group">
                            <i class="input-icon fas fa-hand-holding-usd"></i>
                            <input type="number" 
                                   name="harga_sewa" 
                                   id="harga_sewa" 
                                   value="{{ old('harga_sewa') }}"
                                   step="0.01"
                                   min="0"
                                   required
                                   class="form-input input-with-icon @error('harga_sewa') error @enderror"
                                   placeholder=" "
                                   onchange="formatRupiah(this)">
                            <label for="harga_sewa">Harga Sewa per Hari (Rp) <span class="required-asterisk">*</span></label>
                        </div>
                        @error('harga_sewa')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Jumlah Total -->
                    <div class="floating-label">
                        <div class="input-group">
                            <i class="input-icon fas fa-cubes"></i>
                            <input type="number" 
                                   name="jumlah_total" 
                                   id="jumlah_total" 
                                   value="{{ old('jumlah_total', 1) }}"
                                   min="1"
                                   required
                                   class="form-input input-with-icon @error('jumlah_total') error @enderror"
                                   placeholder=" ">
                            <label for="jumlah_total">Jumlah Total <span class="required-asterisk">*</span></label>
                        </div>
                        @error('jumlah_total')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Kondisi -->
                    <div class="floating-label">
                        <div class="input-group">
                            <i class="input-icon fas fa-clipboard-check"></i>
                            <select name="kondisi" 
                                    id="kondisi" 
                                    required
                                    class="form-input input-with-icon @error('kondisi') error @enderror">
                                <option value="">Pilih kondisi...</option>
                                <option value="baik" {{ old('kondisi') == 'baik' ? 'selected' : '' }}>
                                    🟢 Baik
                                </option>
                                <option value="rusak ringan" {{ old('kondisi') == 'rusak ringan' ? 'selected' : '' }}>
                                    🟡 Rusak Ringan
                                </option>
                                <option value="rusak berat" {{ old('kondisi') == 'rusak berat' ? 'selected' : '' }}>
                                    🔴 Rusak Berat
                                </option>
                            </select>
                            <label for="kondisi">Kondisi Barang <span class="required-asterisk">*</span></label>
                        </div>
                        @error('kondisi')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Lokasi Penyimpanan -->
                    <div class="floating-label">
                        <div class="input-group">
                            <i class="input-icon fas fa-map-marker-alt"></i>
                            <input type="text" 
                                   name="lokasi" 
                                   id="lokasi" 
                                   value="{{ old('lokasi') }}"
                                   class="form-input input-with-icon @error('lokasi') error @enderror"
                                   placeholder=""
                                   maxlength="255">
                            <label for="lokasi">Lokasi Penyimpanan</label>
                        </div>
                        @error('lokasi')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <!-- Status Peminjaman -->
                    <div class="lg:col-span-2">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border-2 border-blue-200 dark:border-blue-700 rounded-xl p-6">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-lg">
                                        <i class="fas fa-handshake text-white text-xl"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                                        Status Peminjaman Barang
                                    </h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                        Tentukan apakah barang ini dapat dipinjam oleh user atau hanya untuk keperluan internal
                                    </p>
                                    
                                    <div class="flex items-center">
                                        <label class="relative inline-flex items-center cursor-pointer group">
                                            <input type="checkbox" 
                                                   name="dapat_dipinjam" 
                                                   id="dapat_dipinjam" 
                                                   value="1"
                                                   {{ old('dapat_dipinjam', true) ? 'checked' : '' }}
                                                   class="sr-only peer">
                                            <div class="w-14 h-7 bg-gray-300 dark:bg-gray-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-gradient-to-r peer-checked:from-green-500 peer-checked:to-emerald-600"></div>
                                            <span class="ml-3 text-sm font-bold text-gray-900 dark:text-white peer-checked:text-green-700 dark:peer-checked:text-green-400">
                                                <span id="status-text" class="flex items-center">
                                                    <i id="status-icon" class="fas fa-check-circle text-green-500 mr-2"></i>
                                                    <span id="status-label">Barang dapat dipinjam</span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                    
                                    <div class="mt-4 p-4 bg-white dark:bg-gray-800/50 rounded-lg border border-blue-200 dark:border-blue-700">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-xs">
                                            <div class="flex items-start text-green-700 dark:text-green-400">
                                                <i class="fas fa-check-circle mt-0.5 mr-2 flex-shrink-0"></i>
                                                <span><strong>Dapat Dipinjam:</strong> User bisa mengajukan permohonan untuk barang ini</span>
                                            </div>
                                            <div class="flex items-start text-gray-600 dark:text-gray-400">
                                                <i class="fas fa-times-circle mt-0.5 mr-2 flex-shrink-0"></i>
                                                <span><strong>Tidak Dapat Dipinjam:</strong> Barang hanya untuk internal/koleksi</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @error('dapat_dipinjam')
                                <div class="error-message mt-3">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <!-- Deskripsi -->
                    <div class="floating-label lg:col-span-2">
                        <textarea name="deskripsi" 
                                  id="deskripsi" 
                                  rows="3"
                                  class="form-input @error('deskripsi') error @enderror"
                                  placeholder=" ">{{ old('deskripsi') }}</textarea>
                        <label for="deskripsi">Deskripsi Tambahan</label>
                        @error('deskripsi')
                            <div class="error-message">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Upload Foto & Informasi Lainnya -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 form-step card-hover">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-gray-50 via-blue-50/30 to-indigo-50/30 dark:from-gray-700/50 dark:via-gray-800/50 dark:to-gray-700/50 rounded-t-2xl">
                <div class="flex items-center">
                    <div class="p-3 bg-gradient-to-r from-orange-500 to-amber-600 rounded-xl mr-4 shadow-lg">
                        <i class="fas fa-camera text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">4. Upload Foto Barang</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Upload foto utama dan foto detail barang (maksimal 5 foto)</p>
                    </div>
                    <div class="ml-auto">
                        <div class="bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-200 text-xs font-bold px-3 py-1 rounded-full">
                            Step 4/4
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="p-8">
                <!-- Upload Foto Section -->
                <div class="mb-8">
                    {{-- Foto Utama --}}
                    <div class="mb-6">
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                            <i class="fas fa-star text-yellow-500 mr-2"></i>
                            Foto Utama <span class="text-red-500 ml-1">*</span>
                        </h4>
                        
                        <div class="file-upload-area" id="file-upload-area">
                            <div class="relative z-10">
                                <div class="mb-4">
                                    <i class="fas fa-cloud-upload-alt text-5xl text-gray-400 dark:text-gray-500 animate-bounce-slow"></i>
                                </div>
                                <h4 class="text-xl font-bold text-gray-700 dark:text-gray-300 mb-2">Upload Foto Utama Barang</h4>
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
                               <div class="flex gap-3 justify-center">
                                    <button type="button" 
                                            onclick="event.preventDefault(); event.stopPropagation(); openCamera('foto');"
                                            class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg text-sm font-medium hover:bg-green-600 transition-colors">
                                        <i class="fas fa-camera mr-2"></i>
                                        Kamera
                                    </button>
                                    <button type="button" 
                                            onclick="event.preventDefault(); event.stopPropagation(); openGallery('foto');"
                                            class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg text-sm font-medium hover:bg-blue-600 transition-colors">
                                        <i class="fas fa-images mr-2"></i>
                                        Galeri
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <input type="file" 
                                name="foto" 
                                id="foto" 
                                accept="image/jpeg,image/png,image/jpg,image/gif"
                                class="hidden"
                                onchange="previewImage(this)">
                        
                        @error('foto')
                            <div class="error-message mt-3">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                        
                        <!-- Preview Foto Utama -->
                        <div id="image-preview-container" class="hidden mt-6">
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-700 rounded-xl p-6">
                                <h5 class="text-lg font-bold text-green-800 dark:text-green-300 mb-4 flex items-center">
                                    <i class="fas fa-eye mr-2"></i>
                                    Preview Foto Utama
                                </h5>
                                <div class="flex flex-col lg:flex-row lg:items-center lg:space-x-6">
                                    <img id="image-preview" src="" alt="Preview" class="preview-image mb-4 lg:mb-0">
                                    <div class="flex-1">
                                        <div id="file-info" class="text-sm text-green-700 dark:text-green-400 mb-4 space-y-1"></div>
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
                    </div>

                    {{-- Foto Detail (Multiple) --}}
                    <div class="section-divider">
                        <span class="section-divider-text">Foto Detail Tambahan</span>
                    </div>

                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border-2 border-blue-200 dark:border-blue-700 rounded-xl p-6 mb-6">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-lg">
                                    <i class="fas fa-images text-white text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                                    Upload Foto Detail (Opsional)
                                </h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                    Upload hingga 4 foto tambahan untuk menampilkan detail barang dari berbagai sudut pandang
                                </p>
                                
                                <div class="flex gap-3 justify-center">
                                    <button type="button" 
                                            onclick="event.preventDefault(); event.stopPropagation(); openCamera('foto_detail');"
                                            class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors shadow-md hover:shadow-lg transform hover:scale-105 active:scale-95 transition-all">
                                        <i class="fas fa-camera mr-2"></i>
                                        Kamera
                                    </button>
                                    <button type="button" 
                                            onclick="event.preventDefault(); event.stopPropagation(); openGallery('foto_detail');" 
                                            class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors shadow-md hover:shadow-lg transform hover:scale-105 active:scale-95 transition-all">
                                        <i class="fas fa-images mr-2"></i>
                                        Galeri
                                    </button>
                                </div>
                                
                                <input type="file" 
                                        id="foto_detail" 
                                        name="foto_detail[]" 
                                        accept="image/jpeg,image/png,image/jpg,image/gif"
                                        multiple
                                        class="hidden"
                                        onchange="handleMultipleImages(this)">
                                
                                <div class="mt-3 text-xs text-blue-700 dark:text-blue-400 space-y-1">
                                    <div class="flex items-center">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        <span>Maksimal 4 foto detail (Total dengan foto utama: 5 foto)</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-file-image mr-2"></i>
                                        <span>Format: JPEG, PNG, JPG, GIF - Maksimal 2MB per file</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Preview Multiple Photos --}}
                    <div id="multiple-preview-container" class="hidden">
                        <h5 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                            <i class="fas fa-images text-blue-600 dark:text-blue-400 mr-2"></i>
                            Preview Foto Detail
                            <span id="photo-counter" class="ml-2 text-sm bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full">0/4</span>
                        </h5>
                        
                        <div id="multiple-preview-grid" class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- Preview items will be inserted here -->
                        </div>
                        
                        <div class="mt-4 flex items-center justify-between">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <i class="fas fa-lightbulb text-yellow-500 mr-1"></i>
                                Klik ikon <i class="fas fa-trash text-red-500 mx-1"></i> untuk menghapus foto
                            </p>
                            <button type="button" 
                                    onclick="clearAllDetailPhotos()" 
                                    class="text-sm text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 font-medium">
                                <i class="fas fa-trash-alt mr-1"></i>
                                Hapus Semua Foto Detail
                            </button>
                        </div>
                    </div>

                    {{-- Tips Upload Foto --}}
                    <div class="info-card mt-6">
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
                                <i class="fas fa-eye text-blue-500 mr-2"></i>
                                Pastikan barang terlihat jelas dan fokus
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-cube text-purple-500 mr-2"></i>
                                Foto dari berbagai sudut lebih informatif
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-times-circle text-red-500 mr-2"></i>
                                Hindari foto yang blur atau gelap
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-camera text-green-500 mr-2"></i>
                                Foto detail: close-up bagian penting
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-compress text-indigo-500 mr-2"></i>
                                Komposisi yang baik: objek di tengah frame
                            </div>
                        </div>
                    </div>
                </div>

                <div class="section-divider">
                    <span class="section-divider-text">Informasi Lainnya</span>
                </div>

                <!-- Field Lainnya -->
                <div class="floating-label">
                    <div class="input-group">
                        <textarea name="lainnya" 
                                id="lainnya" 
                                rows="4"
                                class="form-input @error('lainnya') error @enderror"
                                placeholder=" ">{{ old('lainnya') }}</textarea>
                        <label for="lainnya">Informasi Lainnya</label>
                    </div>
                    @error('lainnya')
                        <div class="error-message">
                            <i class="fas fa-exclamation-triangle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="info-card mt-3">
                        <p class="text-sm text-blue-700 dark:text-blue-400 flex items-start">
                            <i class="fas fa-info-circle mt-0.5 mr-2 flex-shrink-0"></i>
                            <span>
                                Kolom ini dapat digunakan untuk menambahkan informasi tambahan yang tidak tercakup 
                                di field lain, seperti catatan khusus, instruksi penggunaan, atau detail penting lainnya.
                            </span>
                        </p>
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
                            <span id="submit-text">Simpan</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Menyimpan Data Barang</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Mohon tunggu, sedang memproses data...</p>
                <div class="mt-4 h-1 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-purple-500 rounded-full animate-pulse"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Notifications -->
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
                <div class="p-3 bg-red-100 dark:bg-red-900/50 rounded-xl">
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
// ==========================================
// GLOBAL VARIABLES
// ==========================================
let formFields = [];
let filledFields = 0;
let totalFields = 0;
let autoSaveTimer;
let sessionTimeoutWarning;
let sessionTimeout;
let activityDetected = false;
let selectedDetailFiles = [];
const MAX_DETAIL_PHOTOS = 4;

// ==========================================
// UTILITY FUNCTIONS (HARUS DI ATAS)
// ==========================================

// Debounce function
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

// Prevent defaults for drag & drop
function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

// Email validation
function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
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
        success: 'bg-green-100 dark:bg-green-900/50',
        error: 'bg-red-100 dark:bg-red-900/50',
        warning: 'bg-yellow-100 dark:bg-yellow-900/50',
        info: 'bg-blue-100 dark:bg-blue-900/50'
    };
    
    const titles = {
        success: 'Berhasil!',
        error: 'Error!',
        warning: 'Peringatan!',
        info: 'Informasi'
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
                <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">${message}</div>
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

// ==========================================
// KODE BARANG PREVIEW
// ==========================================
function updateKodePreview() {
    const kategoriId = document.getElementById('kategori_id').value;
    const kodeManual = document.getElementById('kode_manual').value;
    const previewElement = document.getElementById('kode-preview');
    
    if (!previewElement) return;
    
    if (!kategoriId) {
        previewElement.textContent = 'Pilih kategori untuk melihat preview kode...';
        return;
    }
    
    // Get category names from blade data
    const categories = @json($kategoris->mapWithKeys(function($item) {
        return [$item->id => strtoupper(substr($item->nama_kategori, 0, 3))];
    }));
    
    const kategoriCode = categories[kategoriId];
    const year = new Date().getFullYear();
    
    if (kodeManual && kodeManual.trim() !== '') {
        const kode = `CTP-${kategoriCode}-${String(kodeManual).padStart(5, '0')}-${year}`;
        previewElement.innerHTML = `<span style="color: #10b981;">${kode}</span>`;
    } else {
        previewElement.innerHTML = `<span style="color: #6b7280;">CTP-${kategoriCode}-00001-${year}</span> <small style="color: #9ca3af;">(Auto-generated)</small>`;
    }
}

// ==========================================
// FILE VALIDATION
// ==========================================
function validateImageFile(file) {
    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    const maxSize = 2 * 1024 * 1024; // 2MB
    const minSize = 1024; // 1KB
    
    // Cek apakah file ada
    if (!file) {
        console.error('No file provided');
        return false;
    }
    
    // Cek ukuran minimum
    if (file.size < minSize) {
        console.error('File too small:', file.size);
        return false;
    }
    
    // Cek ukuran maksimum
    if (file.size > maxSize) {
        console.error('File too large:', file.size);
        return false;
    }
    
    // Validasi ekstensi file
    const fileExtension = file.name.split('.').pop().toLowerCase();
    if (!allowedExtensions.includes(fileExtension)) {
        console.error('Invalid extension:', fileExtension);
        return false;
    }
    
    // Validasi MIME type
    if (!allowedTypes.includes(file.type)) {
        console.error('Invalid MIME type:', file.type);
        return false;
    }
    
    return true;
}

// ==========================================
// FOTO UTAMA HANDLER
// ==========================================
async function previewImage(input) {
    const file = input.files[0];
    const previewContainer = document.getElementById('image-preview-container');
    const previewImage = document.getElementById('image-preview');
    const fileInfo = document.getElementById('file-info');
    
    if (!file) {
        showNotification('ℹ️ Tidak ada file yang dipilih', 'info');
        return;
    }
    
    console.log('📸 File selected:', file.name, file.size, file.type);
    
    // Show loading immediately
    if (previewContainer) {
        previewContainer.classList.remove('hidden');
        previewContainer.innerHTML = `
            <div class="flex items-center justify-center p-8">
                <div class="text-center">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500 mx-auto mb-4"></div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Memproses foto...</p>
                </div>
            </div>
        `;
    }
    
    // Basic validation first (synchronous)
    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    const maxSize = 2 * 1024 * 1024; // 2MB
    const minSize = 1024; // 1KB
    
    if (file.size < minSize) {
        showNotification('❌ File terlalu kecil! Minimal 1KB', 'error');
        input.value = '';
        if (previewContainer) previewContainer.classList.add('hidden');
        return;
    }
    
    if (file.size > maxSize) {
        const fileSizeMB = (file.size / 1024 / 1024).toFixed(2);
        showNotification(
            `❌ Ukuran file terlalu besar!<br>` +
            `📊 Ukuran: ${fileSizeMB} MB<br>` +
            `⚠️ Maksimal: 2 MB`, 
            'error'
        );
        input.value = '';
        if (previewContainer) previewContainer.classList.add('hidden');
        return;
    }
    
    if (!allowedTypes.includes(file.type)) {
        showNotification(
            `❌ Format file tidak didukung!<br>` +
            `📋 Tipe: ${file.type}<br>` +
            `✅ Gunakan: JPEG, PNG, GIF`, 
            'error'
        );
        input.value = '';
        if (previewContainer) previewContainer.classList.add('hidden');
        return;
    }
    
    // Create FileReader immediately
    const reader = new FileReader();
    
    reader.onload = function(e) {
        console.log('✅ File loaded successfully');
        
        // Validate image by loading it
        const img = new Image();
        
        img.onload = function() {
            console.log('✅ Image validated:', this.width, 'x', this.height);
            
            // Check minimum dimensions
            if (this.width < 100 || this.height < 100) {
                showNotification(
                    `⚠️ Resolusi terlalu kecil!<br>` +
                    `📐 Dimensi: ${this.width}x${this.height}px<br>` +
                    `✅ Minimal: 100x100px`, 
                    'warning'
                );
            }
            
            // Display preview immediately
            if (previewContainer) {
                previewContainer.innerHTML = `
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-700 rounded-xl p-6 animate-fade-in">
                        <h5 class="text-lg font-bold text-green-800 dark:text-green-300 mb-4 flex items-center">
                            <i class="fas fa-eye mr-2"></i>
                            Preview Foto Utama
                        </h5>
                        <div class="flex flex-col lg:flex-row lg:items-center lg:space-x-6">
                            <img src="${e.target.result}" alt="Preview" class="preview-image mb-4 lg:mb-0">
                            <div class="flex-1">
                                <div class="text-sm text-green-700 dark:text-green-400 mb-4 space-y-2">
                                    <div class="flex items-center">
                                        <i class="fas fa-file-image text-green-600 mr-2"></i>
                                        <strong>File:</strong> <span class="ml-2">${file.name}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-weight text-blue-600 mr-2"></i>
                                        <strong>Ukuran:</strong> <span class="ml-2">${(file.size / 1024 / 1024).toFixed(2)} MB</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-tag text-purple-600 mr-2"></i>
                                        <strong>Tipe:</strong> <span class="ml-2">${file.type}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-expand text-orange-600 mr-2"></i>
                                        <strong>Resolusi:</strong> <span class="ml-2 font-semibold text-green-600">${this.width} x ${this.height} px</span>
                                    </div>
                                </div>
                                <button type="button" 
                                        onclick="removeImage()" 
                                        class="inline-flex items-center px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition-all transform hover:scale-105 shadow-md hover:shadow-lg">
                                    <i class="fas fa-trash mr-2"></i>
                                    Hapus Foto
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                
                previewContainer.classList.remove('hidden');
                previewContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
            
            showNotification('🎉 Foto berhasil dimuat!', 'success');
            updateProgress();
        };
        
        img.onerror = function() {
            console.error('❌ Image validation failed');
            showNotification(
                `❌ File bukan gambar yang valid!<br>` +
                `💡 Pastikan file adalah gambar asli`, 
                'error'
            );
            input.value = '';
            if (previewContainer) previewContainer.classList.add('hidden');
        };
        
        img.src = e.target.result;
    };
    
    reader.onerror = function(error) {
        console.error('❌ FileReader error:', error);
        showNotification('❌ Gagal membaca file. Coba lagi!', 'error');
        input.value = '';
        if (previewContainer) previewContainer.classList.add('hidden');
    };
    
    // Start reading file
    console.log('📖 Reading file...');
    reader.readAsDataURL(file);
}

function removeImage() {
    const fileInput = document.getElementById('foto');
    const previewContainer = document.getElementById('image-preview-container');
    
    if (fileInput) fileInput.value = '';
    if (previewContainer) previewContainer.classList.add('hidden');
    
    updateProgress();
    showNotification('Foto berhasil dihapus', 'success');
}

// ==========================================
// MULTIPLE IMAGES HANDLER
// ==========================================
async function handleMultipleImages(input) {
    const files = Array.from(input.files);
    
    if (files.length === 0) {
        showNotification('ℹ️ Tidak ada file yang dipilih', 'info');
        return;
    }
    
    console.log('📸 Multiple files selected:', files.length);
    
    const totalPhotos = selectedDetailFiles.length + files.length;
    
    if (totalPhotos > MAX_DETAIL_PHOTOS) {
        const remainingSlots = MAX_DETAIL_PHOTOS - selectedDetailFiles.length;
        showNotification(
            `⚠️ Maksimal ${MAX_DETAIL_PHOTOS} foto detail!<br>` +
            `📊 Sisa slot: ${remainingSlots}`, 
            'warning'
        );
        files.splice(remainingSlots);
    }
    
    if (files.length === 0) {
        return;
    }
    
    // Show processing notification
    showNotification(`🔍 Memproses ${files.length} foto...`, 'info');
    
    const validFiles = [];
    const invalidFiles = [];
    
    // Basic validation (synchronous)
    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    const maxSize = 2 * 1024 * 1024; // 2MB
    const minSize = 1024; // 1KB
    
    for (let file of files) {
        let isValid = true;
        let reason = '';
        
        // Check duplicates
        const isDuplicate = selectedDetailFiles.some(f => 
            f.name === file.name && f.size === file.size
        );
        
        if (isDuplicate) {
            isValid = false;
            reason = 'Duplikat';
        } else if (file.size < minSize) {
            isValid = false;
            reason = 'Terlalu kecil';
        } else if (file.size > maxSize) {
            isValid = false;
            reason = 'Terlalu besar (max 2MB)';
        } else if (!allowedTypes.includes(file.type)) {
            isValid = false;
            reason = 'Format tidak didukung';
        }
        
        if (isValid) {
            validFiles.push(file);
        } else {
            invalidFiles.push({ name: file.name, reason: reason });
            console.log(`❌ ${file.name} - ${reason}`);
        }
    }
    
    // Reset input
    input.value = '';
    
    if (validFiles.length > 0) {
        // Add to selected files immediately
        selectedDetailFiles = selectedDetailFiles.concat(validFiles);
        
        // Update preview immediately
        updateMultiplePreview();
        
        let message = `✅ ${validFiles.length} foto berhasil ditambahkan!`;
        if (invalidFiles.length > 0) {
            message += `<br>⚠️ ${invalidFiles.length} foto gagal`;
        }
        showNotification(message, 'success');
    } else if (invalidFiles.length > 0) {
        let errorMsg = `❌ ${invalidFiles.length} foto gagal ditambahkan:<br>`;
        invalidFiles.slice(0, 3).forEach(f => {
            errorMsg += `• ${f.name} (${f.reason})<br>`;
        });
        if (invalidFiles.length > 3) {
            errorMsg += `... dan ${invalidFiles.length - 3} lainnya`;
        }
        showNotification(errorMsg, 'error');
    }
}

function updateMultiplePreview() {
    const container = document.getElementById('multiple-preview-container');
    const grid = document.getElementById('multiple-preview-grid');
    const counter = document.getElementById('photo-counter');
    
    if (!container || !grid) return;
    
    if (selectedDetailFiles.length === 0) {
        container.classList.add('hidden');
        return;
    }
    
    container.classList.remove('hidden');
    grid.innerHTML = '';
    
    if (counter) {
        counter.textContent = `${selectedDetailFiles.length}/${MAX_DETAIL_PHOTOS}`;
        counter.className = selectedDetailFiles.length >= MAX_DETAIL_PHOTOS 
            ? 'ml-2 text-sm bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 px-3 py-1 rounded-full font-bold'
            : 'ml-2 text-sm bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full font-bold';
    }
    
    // Process all files
    selectedDetailFiles.forEach((file, index) => {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            console.log(`✅ Preview ${index + 1} loaded`);
            
            const previewItem = document.createElement('div');
            previewItem.className = 'relative group animate-fade-in';
            previewItem.style.animationDelay = `${index * 0.1}s`;
            previewItem.innerHTML = `
                <div class="aspect-square rounded-xl overflow-hidden border-2 border-gray-200 dark:border-gray-700 group-hover:border-blue-500 dark:group-hover:border-blue-400 transition-all shadow-md hover:shadow-xl">
                    <img src="${e.target.result}" 
                         alt="Preview ${index + 1}" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-300">
                </div>
                
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all rounded-xl flex items-center justify-center">
                    <button type="button" 
                            onclick="removeDetailPhoto(${index})"
                            class="opacity-0 group-hover:opacity-100 bg-red-500 text-white p-3 rounded-full hover:bg-red-600 transition-all transform hover:scale-110 shadow-lg">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                
                <div class="absolute top-2 left-2 bg-white dark:bg-gray-800 bg-opacity-90 backdrop-blur-sm rounded-lg px-2 py-1 text-xs font-bold text-gray-700 dark:text-gray-300 shadow">
                    Foto ${index + 1}
                </div>
                
                <div class="absolute bottom-2 left-2 right-2 bg-white dark:bg-gray-800 bg-opacity-90 backdrop-blur-sm rounded-lg px-2 py-1 text-xs text-gray-700 dark:text-gray-300 shadow truncate">
                    <i class="fas fa-file-image mr-1"></i>
                    ${file.name}
                </div>
                
                <div class="absolute top-2 right-2 bg-blue-500 text-white rounded-lg px-2 py-1 text-xs font-bold shadow">
                    ${(file.size / 1024 / 1024).toFixed(2)} MB
                </div>
            `;
            grid.appendChild(previewItem);
        };
        
        reader.onerror = function() {
            console.error(`❌ Failed to load preview ${index + 1}`);
        };
        
        reader.readAsDataURL(file);
    });
    
    updateProgress();
}

function removeDetailPhoto(index) {
    if (confirm('Hapus foto ini?')) {
        selectedDetailFiles.splice(index, 1);
        updateMultiplePreview();
        showNotification('Foto berhasil dihapus', 'success');
    }
}

function clearAllDetailPhotos() {
    if (selectedDetailFiles.length === 0) return;
    
    if (confirm(`Hapus semua ${selectedDetailFiles.length} foto detail?`)) {
        selectedDetailFiles = [];
        updateMultiplePreview();
        showNotification('Semua foto detail berhasil dihapus', 'success');
    }
}

function setupDragAndDrop() {
    const uploadArea = document.getElementById('file-upload-area');
    
    if (!uploadArea) return;
    
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });
    
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.classList.add('dragover');
        }, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, () => {
            uploadArea.classList.remove('dragover');
        }, false);
    });
    
    uploadArea.addEventListener('drop', function(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length > 0) {
            const fileInput = document.getElementById('foto');
            if (fileInput) {
                fileInput.files = files;
                previewImage(fileInput);
            }
        }
    }, false);
    
    // TAMBAHAN: Click pada area kosong = buka galeri
    uploadArea.addEventListener('click', function(e) {
        // Cegah jika klik berasal dari tombol
        if (e.target.closest('button')) {
            return;
        }
        console.log('🖱️ Upload area clicked - opening gallery');
        openGallery('foto');
    });
}

// ==========================================
// FORM PROGRESS TRACKING
// ==========================================
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

// ==========================================
// FIELD VALIDATION
// ==========================================
function validateField(e) {
    const field = e.target;
    const value = field.value.trim();
    
    field.classList.remove('error');
    
    if (field.hasAttribute('required') && !value) {
        field.classList.add('error');
        return false;
    }
    
    switch(field.type) {
        case 'number':
            if (value && isNaN(value)) {
                field.classList.add('error');
                showFieldError(field, 'Harus berupa angka valid');
                return false;
            }
            break;
        case 'email':
            if (value && !isValidEmail(value)) {
                field.classList.add('error');
                showFieldError(field, 'Format email tidak valid');
                return false;
            }
            break;
    }
    
    if (field.id === 'tahun_produksi' && value) {
        const year = parseInt(value);
        const currentYear = new Date().getFullYear();
        if (year < 1900 || year > currentYear) {
            field.classList.add('error');
            showFieldError(field, `Tahun harus antara 1900-${currentYear}`);
            return false;
        }
    }
    
    if (field.id === 'kode_manual' && value) {
        if (!/^\d{1,5}$/.test(value)) {
            field.classList.add('error');
            showFieldError(field, 'Kode manual harus 1-5 digit angka');
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

// ==========================================
// FORM VALIDATION & SUBMISSION
// ==========================================
function validateFormComplete() {
    let isValid = true;
    const errors = [];
    
    const requiredFields = [
        { id: 'kategori_id', name: 'Kategori Barang' },
        { id: 'nama_barang', name: 'Nama Barang' },
        { id: 'jumlah_total', name: 'Jumlah Total' },
        { id: 'kondisi', name: 'Kondisi Barang' },
        { id: 'harga_sewa', name: 'Harga Sewa' }
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
    
    const numericFields = [
        { id: 'jumlah_total', name: 'Jumlah Total', min: 1 },
        { id: 'harga_sewa', name: 'Harga Sewa', min: 0 },
        { id: 'harga_beli', name: 'Harga Beli', min: 0, required: false },
        { id: 'berat', name: 'Berat', min: 0, required: false },
        { id: 'tahun_produksi', name: 'Tahun Produksi', min: 1900, max: new Date().getFullYear(), required: false }
    ];
    
    numericFields.forEach(field => {
        const input = document.getElementById(field.id);
        if (input && input.value) {
            const value = parseFloat(input.value);
            if (isNaN(value)) {
                errors.push(`${field.name} harus berupa angka`);
                input.classList.add('error');
                isValid = false;
            } else if (field.min !== undefined && value < field.min) {
                errors.push(`${field.name} minimal ${field.min}`);
                input.classList.add('error');
                isValid = false;
            } else if (field.max !== undefined && value > field.max) {
                errors.push(`${field.name} maksimal ${field.max}`);
                input.classList.add('error');
                isValid = false;
            } else {
                input.classList.remove('error');
            }
        }
    });
    
    const fileInput = document.getElementById('foto');
    if (fileInput && fileInput.files.length > 0) {
        if (!validateImageFile(fileInput.files[0])) {
            isValid = false;
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

function formatRupiah(input) {
    let value = input.value.replace(/[^\d]/g, '');
    
    if (value) {
        const numValue = parseInt(value);
        if (numValue > 999999999999) {
            showNotification('Nilai terlalu besar', 'warning');
            input.value = '999999999999';
            return;
        }
        input.value = value;
    }
}

function resetForm() {
    if (!confirm('Reset semua data form? Semua data yang sudah diisi akan dihapus dan tidak dapat dikembalikan.')) {
        return;
    }
    
    const form = document.getElementById('barang-form');
    if (form) form.reset();
    
    removeImage();
    selectedDetailFiles = [];
    updateMultiplePreview();
    updateProgress();
    updateKodePreview();
    
    document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
    document.querySelectorAll('.error-message').forEach(el => el.remove());
    
    document.querySelectorAll('.form-step').forEach((section, index) => {
        if (index === 0) {
            section.classList.add('active');
        } else {
            section.classList.remove('active');
        }
    });
    
    localStorage.removeItem('barang_draft');
    showNotification('Form berhasil direset', 'success');
}

// ==========================================
// AUTO-SAVE & DRAFT
// ==========================================
function setupAutoSave() {
    const formInputs = document.querySelectorAll('#barang-form input, #barang-form select, #barang-form textarea');
    
    formInputs.forEach(input => {
        input.addEventListener('input', function() {
            clearTimeout(autoSaveTimer);
            autoSaveTimer = setTimeout(saveDraft, 30000);
        });
    });
    
    loadDraft();
}

function saveDraft() {
    const formData = new FormData(document.getElementById('barang-form'));
    const draftData = {};
    
    for (let [key, value] of formData.entries()) {
        if (key !== 'foto' && key !== '_token') {
            draftData[key] = value;
        }
    }
    
    localStorage.setItem('barang_draft', JSON.stringify(draftData));
}

function loadDraft() {
    const draft = localStorage.getItem('barang_draft');
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
            updateKodePreview();
            localStorage.removeItem('barang_draft');
            showNotification('Draft berhasil dimuat', 'success');
        }
    } catch (e) {
        localStorage.removeItem('barang_draft');
    }
}

// ==========================================
// SESSION MANAGEMENT
// ==========================================
function startSessionTimer() {
    clearTimeout(sessionTimeoutWarning);
    clearTimeout(sessionTimeout);
    activityDetected = true;
    
    sessionTimeoutWarning = setTimeout(() => {
        if (confirm('Sesi akan berakhir dalam 5 menit. Klik OK untuk memperpanjang sesi atau Cancel untuk menyimpan draft.')) {
            startSessionTimer();
        } else {
            saveDraft();
        }
    }, 25 * 60 * 1000);
    
    sessionTimeout = setTimeout(() => {
        saveDraft();
        showNotification('Sesi telah berakhir. Draft telah disimpan.', 'warning');
        setTimeout(() => window.location.reload(), 3000);
    }, 30 * 60 * 1000);
}

// ==========================================
// DOM CONTENT LOADED - INITIALIZATION
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Initializing Barang Create Form...');
    
    // 1. Initialize form fields tracking
    const requiredFields = document.querySelectorAll('input[required], select[required], textarea[required]');
    const optionalFields = document.querySelectorAll('input:not([required]), select:not([required]), textarea:not([required])');
    
    formFields = Array.from(requiredFields).concat(Array.from(optionalFields));
    totalFields = formFields.length;
    
    // 2. Add event listeners to track progress
    formFields.forEach(field => {
        field.addEventListener('input', debounce(updateProgress, 300));
        field.addEventListener('change', debounce(updateProgress, 300));
        field.addEventListener('blur', validateField);
    });
    
    // 3. Initial progress check
    updateProgress();
    
    // 4. Initialize form sections animation
    animateFormSections();
    
    // 5. Setup drag and drop
    setupDragAndDrop();
    
    // 6. Setup auto-save
    setupAutoSave();
    
    // 7. Setup kategori and kode manual listeners
    const kategoriSelect = document.getElementById('kategori_id');
    const kodeManualInput = document.getElementById('kode_manual');
    
    if (kategoriSelect) {
        kategoriSelect.addEventListener('change', updateKodePreview);
    }
    
    if (kodeManualInput) {
        kodeManualInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^\d]/g, '');
            if (this.value.length > 5) {
                this.value = this.value.substring(0, 5);
            }
            updateKodePreview();
        });
    }
    
    // 8. Initialize kode preview
    updateKodePreview();
    
    // 9. Setup "Dapat Dipinjam" checkbox
    const dapatDipinjamCheckbox = document.getElementById('dapat_dipinjam');
    const statusIcon = document.getElementById('status-icon');
    const statusLabel = document.getElementById('status-label');
    
    if (dapatDipinjamCheckbox && statusIcon && statusLabel) {
        function updateDapatDipinjamUI() {
            if (dapatDipinjamCheckbox.checked) {
                statusIcon.className = 'fas fa-check-circle text-green-500 mr-2';
                statusLabel.textContent = 'Barang dapat dipinjam';
            } else {
                statusIcon.className = 'fas fa-times-circle text-red-500 mr-2';
                statusLabel.textContent = 'Barang tidak dapat dipinjam';
            }
        }
        
        updateDapatDipinjamUI();
        
        dapatDipinjamCheckbox.addEventListener('change', function() {
            updateDapatDipinjamUI();
            updateProgress();
            
            const message = this.checked 
                ? 'Barang akan dapat dipinjam oleh user' 
                : 'Barang tidak akan muncul di katalog peminjaman';
            
            showNotification(message, 'info');
        });
    }
    
    // 10. Setup drag & drop for foto detail
    const detailUploadArea = document.querySelector('.bg-gradient-to-r.from-blue-50.to-indigo-50');
    
    if (detailUploadArea) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            detailUploadArea.addEventListener(eventName, preventDefaults, false);
        });
        
        ['dragenter', 'dragover'].forEach(eventName => {
            detailUploadArea.addEventListener(eventName, function() {
                this.classList.add('border-blue-500', 'bg-blue-100');
            }, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            detailUploadArea.addEventListener(eventName, function() {
                this.classList.remove('border-blue-500', 'bg-blue-100');
            }, false);
        });
        
        detailUploadArea.addEventListener('drop', function(e) {
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                const input = document.getElementById('foto_detail');
                if (input) {
                    const dt = new DataTransfer();
                    Array.from(files).forEach(file => dt.items.add(file));
                    input.files = dt.files;
                    handleMultipleImages(input);
                }
            }
        }, false);
    }
    
    // 11. Session timer
    startSessionTimer();
    ['click', 'keypress', 'scroll', 'mousemove'].forEach(event => {
        document.addEventListener(event, debounce(startSessionTimer, 10000));
    });
    
    // 12. Security: Prevent XSS in text inputs
    document.addEventListener('input', function(e) {
        const target = e.target;
        
        if ((target.type === 'text' || target.tagName === 'TEXTAREA') && target.id !== 'kode_manual') {
            const dangerousPatterns = [/<script/i, /javascript:/i, /on\w+\s*=/i];
            if (dangerousPatterns.some(pattern => pattern.test(target.value))) {
                target.value = target.value.replace(/[<>'"]/g, '');
                showNotification('Karakter berbahaya dihapus dari input', 'warning');
            }
        }
        
        if (target.type === 'number' && target.value < 0) {
            target.value = 0;
        }
    });
    
    // 13. Keyboard shortcuts
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
    
    // 14. Auto hide session notifications
    @if(session('success') || session('error'))
    setTimeout(() => {
        const notification = document.getElementById('notification');
        if (notification) hideNotification(notification);
    }, 5000);
    @endif
    
    console.log('✅ Barang Create Form initialized successfully');
});


// ==========================================
// CAMERA CAPTURE HANDLER
// ==========================================
function openCamera(inputId) {
    const input = document.getElementById(inputId);
    if (!input) return;
    
    console.log('📸 Opening camera for:', inputId);
    
    // Set capture untuk kamera
    input.setAttribute('capture', 'environment');
    input.setAttribute('accept', 'image/*');
    
    // Trigger click
    input.click();
    
    // Cleanup setelah file dipilih atau dibatalkan
    const cleanup = () => {
        console.log('🧹 Cleaning up camera attributes');
        input.removeAttribute('capture');
        input.removeEventListener('change', cleanup);
        input.removeEventListener('cancel', cleanup);
    };
    
    input.addEventListener('change', cleanup, { once: true });
    input.addEventListener('cancel', cleanup, { once: true });
}

function openGallery(inputId) {
    const input = document.getElementById(inputId);
    if (!input) return;
    
    console.log('🖼️ Opening gallery for:', inputId);
    
    // Hapus capture agar membuka file manager
    input.removeAttribute('capture');
    input.setAttribute('accept', 'image/jpeg,image/png,image/jpg,image/gif');
    
    // Trigger click
    input.click();
}

// Make functions global
window.openCamera = openCamera;
window.openGallery = openGallery;


// ==========================================
// FORM SUBMISSION HANDLER
// ==========================================
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('barang-form');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            console.log('📝 Form submitting...');
            console.log('📸 Foto utama:', document.getElementById('foto').files.length);
            console.log('📸 Foto detail selected:', selectedDetailFiles.length);
            
            if (!validateFormComplete()) {
                e.preventDefault();
                return false;
            }
            
            // Attach foto detail files BEFORE submit
            const fotoDetailInput = document.getElementById('foto_detail');
            if (fotoDetailInput && selectedDetailFiles.length > 0) {
                try {
                    const dt = new DataTransfer();
                    selectedDetailFiles.forEach(file => {
                        dt.items.add(file);
                    });
                    fotoDetailInput.files = dt.files;
                    
                    console.log('✅ Foto detail attached:', fotoDetailInput.files.length);
                    console.log('📦 Files:', Array.from(fotoDetailInput.files).map(f => f.name));
                    
                } catch (error) {
                    console.error('❌ Error attaching files:', error);
                    e.preventDefault();
                    showNotification('Gagal melampirkan foto detail. Coba lagi.', 'error');
                    return false;
                }
            }
            
            // Show loading
            const loadingOverlay = document.getElementById('loading-overlay');
            if (loadingOverlay) loadingOverlay.classList.remove('hidden');
            
            const submitBtn = document.getElementById('submit-btn');
            const submitText = document.getElementById('submit-text');
            
            if (submitBtn && submitText) {
                submitBtn.disabled = true;
                submitText.textContent = 'Menyimpan...';
            }
            
            localStorage.removeItem('barang_draft');
            
            // Timeout handler
            const timeoutHandler = setTimeout(() => {
                if (loadingOverlay) loadingOverlay.classList.add('hidden');
                if (submitBtn && submitText) {
                    submitBtn.disabled = false;
                    submitText.textContent = 'Simpan Barang';
                }
                showNotification('Terjadi timeout. Silakan coba lagi.', 'error');
            }, 60000);
            
            console.log('🚀 Form submitted successfully');
            return true;
        });
    }
});

// Handle file input errors
document.addEventListener('DOMContentLoaded', function() {
    const fotoInput = document.getElementById('foto');
    const fotoDetailInput = document.getElementById('foto_detail');
    
    if (fotoInput) {
        fotoInput.addEventListener('error', function(e) {
            console.error('Foto input error:', e);
            showNotification('❌ Terjadi kesalahan saat memuat file', 'error');
        });
    }
    
    if (fotoDetailInput) {
        fotoDetailInput.addEventListener('error', function(e) {
            console.error('Foto detail input error:', e);
            showNotification('❌ Terjadi kesalahan saat memuat file detail', 'error');
        });
    }
});

// ==========================================
// MAKE FUNCTIONS GLOBAL (SINGLE SOURCE)
// ==========================================
window.openCamera = openCamera;
window.openGallery = openGallery;
window.updateKodePreview = updateKodePreview;
window.previewImage = previewImage;
window.removeImage = removeImage;
window.handleMultipleImages = handleMultipleImages;
window.removeDetailPhoto = removeDetailPhoto;
window.clearAllDetailPhotos = clearAllDetailPhotos;
window.formatRupiah = formatRupiah;
window.resetForm = resetForm;
window.hideNotification = hideNotification;
window.showNotification = showNotification;

</script>
@endpush