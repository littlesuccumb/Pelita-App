@extends('layouts.app')

@section('title', 'Edit Barang - Admin')

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

/* ==========================================
   SESUDAH: Tambahkan styling mobile yang sama dengan create.blade
   ========================================== */

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
    
    /* Buttons - Lebih besar dan touch-friendly */
    .file-upload-area button,
    .bg-gradient-to-r.from-blue-50.to-indigo-50 button {
        padding: 0.875rem 1.25rem !important;
        font-size: 0.9375rem !important;
        min-height: 44px; /* Apple's recommended touch target */
    }
    
    /* Upload Foto Detail Card */
    .bg-gradient-to-r.from-blue-50.to-indigo-50.dark\:from-blue-900\/20.dark\:to-indigo-900\/20.border-2.border-blue-200 {
        padding: 1rem !important;
    }
    
    .bg-gradient-to-r.from-blue-50.to-indigo-50 .flex.items-start.space-x-4 {
        gap: 0.75rem;
        flex-direction: row;
        align-items: flex-start;
    }
    
    /* Buttons Container - Side by side */
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
    
    /* Preview Multiple Photos Grid */
    #multiple-preview-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 0.875rem;
    }
    
    #multiple-preview-grid .relative.group {
        min-height: 140px;
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
    
    /* Row 1: Reset & Update */
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
    
    /* Breadcrumb - Kompak di mobile */
    .breadcrumb-modern {
        padding: 0.75rem 1rem;
        font-size: 0.8125rem;
        gap: 0.5rem;
    }
    
    /* Notification */
    .notification {
        right: 0.5rem;
        top: 0.5rem;
        left: 0.5rem;
        max-width: calc(100vw - 1rem);
    }
    
    /* Ensure touch targets are at least 44x44px */
    button,
    select,
    input[type="checkbox"],
    input[type="radio"] {
        min-height: 44px;
        min-width: 44px;
    }
}

/* Extra small devices (portrait phones) */
@media (max-width: 375px) {
    .relative.overflow-hidden.bg-white h1 {
        font-size: 1.5rem !important;
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
    {{-- Modern Breadcrumb Navigation - SAMA DENGAN CREATE --}}
    <nav class="mb-8 animate-fade-in" aria-label="Breadcrumb">
        <div class="breadcrumb-modern breadcrumb-edit">
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
            
            <a href="{{ route('admin.barang.show', $barang->id) }}" 
            class="breadcrumb-link"
            title="{{ $barang->nama_barang }}">
                <i class="fas fa-eye"></i>
                <span>{{ Str::limit($barang->nama_barang, 30) }}</span>
            </a>
            
            <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs"></i>
            
            <span class="breadcrumb-current">
                <i class="fas fa-edit"></i>
                <span>Edit Barang</span>
            </span>
        </div>
    </nav>

    {{-- Modern Header Section - SAMA DENGAN CREATE --}}
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
                            <span class="text-sm font-semibold text-orange-700 dark:text-orange-300">Form Edit Barang</span>
                        </div>
                        
                        {{-- Title --}}
                        <h1 class="text-4xl lg:text-5xl font-bold mb-3 bg-gradient-to-r from-slate-800 via-orange-800 to-red-800 dark:from-slate-100 dark:via-orange-200 dark:to-red-200 bg-clip-text text-transparent leading-tight">
                            Edit Barang
                        </h1>
                        
                        {{-- Description --}}
                        <p class="text-slate-600 dark:text-slate-400 text-lg flex items-center space-x-2 mb-4">
                            <i class="fas fa-info-circle text-orange-500 dark:text-orange-400"></i>
                            <span>Perbarui informasi barang dalam sistem inventaris</span>
                        </p>
                        
                        {{-- Metadata --}}
                        <div class="flex flex-wrap items-center gap-4 text-sm">
                            <div class="flex items-center px-3 py-1.5 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                                <i class="fas fa-barcode mr-2 text-blue-600 dark:text-blue-400"></i>
                                <span class="font-semibold text-slate-700 dark:text-slate-300">Kode:</span>
                                <span class="ml-1 font-mono text-blue-700 dark:text-blue-300">{{ $barang->kode_barang }}</span>
                            </div>
                            <div class="flex items-center px-3 py-1.5 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                                <i class="fas fa-calendar mr-2 text-green-600 dark:text-green-400"></i>
                                <span class="font-semibold text-slate-700 dark:text-slate-300">Update:</span>
                                <span class="ml-1 text-green-700 dark:text-green-300">{{ $barang->updated_at->format('d M Y H:i') }}</span>
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

    {{-- Main Form --}}
        <form action="{{ route('admin.barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data" id="barang-form" class="animate-slide-up">
            @csrf
            @method('PUT')
            
            {{-- 1. Informasi Dasar --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 form-step active card-hover">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-50 via-indigo-50 to-purple-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 rounded-t-2xl">
                    <div class="flex items-center">
                        <div class="p-3 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl mr-4 shadow-lg">
                            <i class="fas fa-info-circle text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">1. Informasi Dasar Barang</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Data utama dan identitas barang</p>
                        </div>
                        <div class="ml-auto">
                            <div class="bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300 text-xs font-bold px-3 py-1 rounded-full">
                                Step 1/4
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="smart-grid">
                        {{-- Kategori Barang --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-layer-group"></i>
                                <select name="kategori_id" 
                                        id="kategori_id" 
                                        required
                                        class="form-input input-with-icon @error('kategori_id') error @enderror"
                                        data-original="{{ $barang->kategori_id }}"
                                        onchange="trackChanges(this)">
                                    <option value="">Pilih kategori...</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ (old('kategori_id', $barang->kategori_id) == $kategori->id) ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="kategori_id">Kategori Barang <span class="required-asterisk">*</span></label>
                                @if($barang->kategori_id)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('kategori_id')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Kode Manual (Read-only) --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-hashtag"></i>
                                <input type="text" 
                                       value="{{ $barang->kode_manual ?? 'Auto-generated' }}"
                                       readonly
                                       class="form-input input-with-icon bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-400 cursor-not-allowed"
                                       placeholder="">
                                <label>Kode Manual (Tidak dapat diubah)</label>
                                <div class="existing-data-indicator">LOCKED</div>
                            </div>
                        </div>
                    </div>

                    {{-- Current Kode Preview --}}
                    <div class="success-card mt-6">
                        <div class="flex items-center justify-between mb-3">
                            <h4 class="text-sm font-bold text-green-800 dark:text-green-300 flex items-center">
                                <i class="fas fa-barcode mr-2"></i>
                                Kode Barang Saat Ini
                            </h4>
                            <div class="bg-green-200 dark:bg-green-800 text-green-800 dark:text-green-200 text-xs font-bold px-2 py-1 rounded-full">
                                ASSIGNED
                            </div>
                        </div>
                        <div class="code-preview">
                            {{ $barang->kode_barang }}
                        </div>
                        <p class="text-xs text-green-600 dark:text-green-400 mt-2 flex items-center">
                            <i class="fas fa-info-circle mr-1"></i>
                            Kode barang tidak dapat diubah setelah dibuat
                        </p>
                    </div>

                    <div class="section-divider">
                        <span class="section-divider-text">Detail Barang</span>
                    </div>

                    <div class="smart-grid">
                        {{-- Nama Barang --}}
                        <div class="floating-label lg:col-span-2">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-cube"></i>
                                <input type="text" 
                                       name="nama_barang" 
                                       id="nama_barang" 
                                       value="{{ old('nama_barang', $barang->nama_barang) }}"
                                       required
                                       class="form-input input-with-icon @error('nama_barang') error @enderror"
                                       placeholder=" "
                                       maxlength="255"
                                       data-original="{{ $barang->nama_barang }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="nama_barang">Nama Barang <span class="required-asterisk">*</span></label>
                                @if($barang->nama_barang)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('nama_barang')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Merk --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-tag"></i>
                                <input type="text" 
                                       name="merk" 
                                       id="merk" 
                                       value="{{ old('merk', $barang->merk) }}"
                                       class="form-input input-with-icon @error('merk') error @enderror"
                                       placeholder=" "
                                       maxlength="255"
                                       data-original="{{ $barang->merk }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="merk">Merk/Brand</label>
                                @if($barang->merk)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('merk')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Type --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-tags"></i>
                                <input type="text" 
                                       name="type" 
                                       id="type" 
                                       value="{{ old('type', $barang->type) }}"
                                       class="form-input input-with-icon @error('type') error @enderror"
                                       placeholder=" "
                                       maxlength="255"
                                       data-original="{{ $barang->type }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="type">Tipe/Model</label>
                                @if($barang->type)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
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

            {{-- 2. Spesifikasi Teknis --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 form-step active card-hover">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-green-50 via-emerald-50 to-teal-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 rounded-t-2xl">
                    <div class="flex items-center">
                        <div class="p-3 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl mr-4 shadow-lg">
                            <i class="fas fa-cogs text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">2. Spesifikasi Teknis</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Detail teknis dan karakteristik barang</p>
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
                        {{-- Nomor Seri --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-barcode"></i>
                                <input type="text" 
                                       name="seri" 
                                       id="seri" 
                                       value="{{ old('seri', $barang->seri) }}"
                                       class="form-input input-with-icon @error('seri') error @enderror"
                                       placeholder=" "
                                       maxlength="255"
                                       data-original="{{ $barang->seri }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="seri">Nomor Seri</label>
                                @if($barang->seri)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('seri')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Tahun Produksi --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-calendar"></i>
                                <input type="number" 
                                       name="tahun_produksi" 
                                       id="tahun_produksi" 
                                       value="{{ old('tahun_produksi', $barang->tahun_produksi) }}"
                                       class="form-input input-with-icon @error('tahun_produksi') error @enderror"
                                       placeholder=" "
                                       min="1900"
                                       max="{{ date('Y') }}"
                                       data-original="{{ $barang->tahun_produksi }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="tahun_produksi">Tahun Produksi</label>
                                @if($barang->tahun_produksi)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('tahun_produksi')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Warna --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-palette"></i>
                                <input type="text" 
                                       name="warna" 
                                       id="warna" 
                                       value="{{ old('warna', $barang->warna) }}"
                                       class="form-input input-with-icon @error('warna') error @enderror"
                                       placeholder=" "
                                       maxlength="255"
                                       data-original="{{ $barang->warna }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="warna">Warna</label>
                                @if($barang->warna)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('warna')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Berat --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-weight"></i>
                                <input type="number" 
                                       name="berat" 
                                       id="berat" 
                                       value="{{ old('berat', $barang->berat) }}"
                                       step="0.01"
                                       min="0"
                                       class="form-input input-with-icon @error('berat') error @enderror"
                                       placeholder=" "
                                       data-original="{{ $barang->berat }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="berat">Berat (kg)</label>
                                @if($barang->berat)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('berat')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Dimensi --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-ruler-combined"></i>
                                <input type="text" 
                                       name="dimensi" 
                                       id="dimensi" 
                                       value="{{ old('dimensi', $barang->dimensi) }}"
                                       class="form-input input-with-icon @error('dimensi') error @enderror"
                                       placeholder=" "
                                       maxlength="255"
                                       data-original="{{ $barang->dimensi }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="dimensi">Dimensi (PxLxT)</label>
                                @if($barang->dimensi)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('dimensi')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Garansi --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-shield-alt"></i>
                                <input type="text" 
                                       name="garansi" 
                                       id="garansi" 
                                       value="{{ old('garansi', $barang->garansi) }}"
                                       class="form-input input-with-icon @error('garansi') error @enderror"
                                       placeholder=" "
                                       maxlength="255"
                                       data-original="{{ $barang->garansi }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="garansi">Masa Garansi</label>
                                @if($barang->garansi)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('garansi')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Spesifikasi --}}
                        <div class="floating-label lg:col-span-2">
                            <div class="relative">
                                <textarea name="spesifikasi" 
                                          id="spesifikasi" 
                                          rows="4"
                                          class="form-input @error('spesifikasi') error @enderror"
                                          placeholder=" "
                                          data-original="{{ $barang->spesifikasi }}"
                                          onchange="trackChanges(this)"
                                          oninput="trackChanges(this)">{{ old('spesifikasi', $barang->spesifikasi) }}</textarea>
                                <label for="spesifikasi">Spesifikasi Detail</label>
                                @if($barang->spesifikasi)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
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

            {{-- 3. Informasi Pembelian & Inventaris --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 form-step active card-hover">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-purple-50 via-pink-50 to-rose-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 rounded-t-2xl">
                    <div class="flex items-center">
                        <div class="p-3 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl mr-4 shadow-lg">
                            <i class="fas fa-shopping-cart text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">3. Informasi Pembelian & Inventaris</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Data pembelian dan pengelolaan inventaris barang</p>
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
                        {{-- Tanggal Pembelian --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-calendar-day"></i>
                                <input type="date" 
                                       name="tanggal_pembelian" 
                                       id="tanggal_pembelian" 
                                       value="{{ old('tanggal_pembelian', $barang->tanggal_pembelian ? $barang->tanggal_pembelian->format('Y-m-d') : '') }}"
                                       class="form-input input-with-icon @error('tanggal_pembelian') error @enderror"
                                       max="{{ date('Y-m-d') }}"
                                       data-original="{{ $barang->tanggal_pembelian ? $barang->tanggal_pembelian->format('Y-m-d') : '' }}"
                                       onchange="trackChanges(this)">
                                <label for="tanggal_pembelian">Tanggal Pembelian</label>
                                @if($barang->tanggal_pembelian)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('tanggal_pembelian')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Harga Beli --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-money-bill"></i>
                                <input type="number" 
                                       name="harga_beli" 
                                       id="harga_beli" 
                                       value="{{ old('harga_beli', $barang->harga_beli) }}"
                                       step="0.01"
                                       min="0"
                                       class="form-input input-with-icon @error('harga_beli') error @enderror"
                                       placeholder=" "
                                       data-original="{{ $barang->harga_beli }}"
                                       onchange="trackChanges(this); formatRupiah(this)"
                                       oninput="trackChanges(this)">
                                <label for="harga_beli">Harga Beli (Rp)</label>
                                @if($barang->harga_beli)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('harga_beli')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Harga Sewa --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-hand-holding-usd"></i>
                                <input type="number" 
                                       name="harga_sewa" 
                                       id="harga_sewa" 
                                       value="{{ old('harga_sewa', $barang->harga_sewa) }}"
                                       step="0.01"
                                       min="0"
                                       required
                                       class="form-input input-with-icon @error('harga_sewa') error @enderror"
                                       placeholder=" "
                                       data-original="{{ $barang->harga_sewa }}"
                                       onchange="trackChanges(this); formatRupiah(this)"
                                       oninput="trackChanges(this)">
                                <label for="harga_sewa">Harga Sewa per Hari (Rp) <span class="required-asterisk">*</span></label>
                                @if($barang->harga_sewa)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('harga_sewa')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Jumlah Total --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-cubes"></i>
                                <input type="number" 
                                       name="jumlah_total" 
                                       id="jumlah_total" 
                                       value="{{ old('jumlah_total', $barang->jumlah_total) }}"
                                       min="1"
                                       required
                                       class="form-input input-with-icon @error('jumlah_total') error @enderror"
                                       placeholder=" "
                                       data-original="{{ $barang->jumlah_total }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="jumlah_total">Jumlah Total <span class="required-asterisk">*</span></label>
                                @if($barang->jumlah_total)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('jumlah_total')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Kondisi --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-clipboard-check"></i>
                                <select name="kondisi" 
                                        id="kondisi" 
                                        required
                                        class="form-input input-with-icon @error('kondisi') error @enderror"
                                        data-original="{{ $barang->kondisi }}"
                                        onchange="trackChanges(this)">
                                    <option value="">Pilih kondisi...</option>
                                    <option value="baik" {{ old('kondisi', $barang->kondisi) == 'baik' ? 'selected' : '' }}>
                                        🟢 Baik
                                    </option>
                                    <option value="rusak ringan" {{ old('kondisi', $barang->kondisi) == 'rusak ringan' ? 'selected' : '' }}>
                                        🟡 Rusak Ringan
                                    </option>
                                    <option value="rusak berat" {{ old('kondisi', $barang->kondisi) == 'rusak berat' ? 'selected' : '' }}>
                                        🔴 Rusak Berat
                                    </option>
                                </select>
                                <label for="kondisi">Kondisi Barang <span class="required-asterisk">*</span></label>
                                @if($barang->kondisi)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('kondisi')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Lokasi Penyimpanan --}}
                        <div class="floating-label">
                            <div class="input-group relative">
                                <i class="input-icon fas fa-map-marker-alt"></i>
                                <input type="text" 
                                       name="lokasi" 
                                       id="lokasi" 
                                       value="{{ old('lokasi', $barang->lokasi) }}"
                                       class="form-input input-with-icon @error('lokasi') error @enderror"
                                       placeholder=" "
                                       maxlength="255"
                                       data-original="{{ $barang->lokasi }}"
                                       onchange="trackChanges(this)"
                                       oninput="trackChanges(this)">
                                <label for="lokasi">Lokasi Penyimpanan</label>
                                @if($barang->lokasi)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
                            @error('lokasi')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Status Dapat Disewa --}}
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
                                                       {{ old('dapat_dipinjam', $barang->dapat_dipinjam ?? true) ? 'checked' : '' }}
                                                       data-original="{{ $barang->dapat_dipinjam ?? 1 }}"
                                                       onchange="trackChanges(this)"
                                                       class="sr-only peer">
                                                <div class="w-14 h-7 bg-gray-300 dark:bg-gray-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-gradient-to-r peer-checked:from-green-500 peer-checked:to-emerald-600"></div>
                                                <span class="ml-3 text-sm font-bold text-gray-900 dark:text-white peer-checked:text-green-700 dark:peer-checked:text-green-400">
                                                    <span id="status-text" class="flex items-center">
                                                        <i id="status-icon" class="fas fa-check-circle text-green-500 dark:text-green-400 mr-2"></i>
                                                        <span id="status-label">Barang dapat dipinjam</span>
                                                    </span>
                                                </span>
                                            </label>
                                        </div>
                                        
                                        @if($barang->dapat_dipinjam !== null)
                                            <div class="existing-data-indicator mt-2">EXISTING</div>
                                        @endif
                                        
                                        <div class="mt-4 p-4 bg-white dark:bg-gray-800 rounded-lg border border-blue-200 dark:border-blue-700">
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
                                        
                                        @if($barang->status === 'dipinjam' || $barang->jumlah_tersedia < $barang->jumlah_total)
                                        <div class="warning-card mt-4">
                                            <p class="text-sm text-yellow-700 dark:text-yellow-400 flex items-start">
                                                <i class="fas fa-exclamation-triangle mt-0.5 mr-2 flex-shrink-0"></i>
                                                <span>
                                                    <strong>Perhatian:</strong> Barang ini sedang dipinjam. 
                                                    Mengubah status menjadi "Tidak Dapat Dipinjam" tidak akan mempengaruhi peminjaman yang sedang berlangsung.
                                                </span>
                                            </p>
                                        </div>
                                        @endif
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

                        {{-- Deskripsi --}}
                        <div class="floating-label lg:col-span-2">
                            <div class="relative">
                                <textarea name="deskripsi" 
                                          id="deskripsi" 
                                          rows="3"
                                          class="form-input @error('deskripsi') error @enderror"
                                          placeholder=" "
                                          data-original="{{ $barang->deskripsi }}"
                                          onchange="trackChanges(this)"
                                          oninput="trackChanges(this)">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                                <label for="deskripsi">Deskripsi Tambahan</label>
                                @if($barang->deskripsi)
                                    <div class="existing-data-indicator">EXISTING</div>
                                @endif
                            </div>
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

            {{-- 4. Upload Foto & Informasi Lainnya --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 mb-8 form-step active card-hover">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-orange-50 via-amber-50 to-yellow-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-700 rounded-t-2xl">
                    <div class="flex items-center">
                        <div class="p-3 bg-gradient-to-r from-orange-500 to-amber-600 rounded-xl mr-4 shadow-lg">
                            <i class="fas fa-camera text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">4. Upload Foto & Informasi Lainnya</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Perbarui foto dan informasi tambahan untuk barang</p>
                        </div>
                        <div class="ml-auto">
                            <div class="bg-orange-100 dark:bg-orange-900/50 text-orange-800 dark:text-orange-300 text-xs font-bold px-3 py-1 rounded-full">
                                Step 4/4
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-8">
                    {{-- Current Image Display --}}
                    @if($barang->foto)
                    <div class="mb-8">
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-700 rounded-xl p-6">
                            <h5 class="text-lg font-bold text-green-800 dark:text-green-300 mb-4 flex items-center">
                                <i class="fas fa-image mr-2"></i>
                                Foto Saat Ini
                            </h5>
                            <div class="flex flex-col lg:flex-row lg:items-start lg:space-x-6">
                                <img src="{{ asset('storage/' . $barang->foto) }}" 
                                     alt="Foto {{ $barang->nama_barang }}" 
                                     class="preview-image current-image-preview mb-4 lg:mb-0">
                                <div class="flex-1">
                                    <div class="text-sm text-green-700 dark:text-green-400 mb-4 space-y-2">
                                        <div><strong>Status:</strong> Foto tersimpan</div>
                                        <div><strong>File:</strong> {{ basename($barang->foto) }}</div>
                                        <div><strong>Upload:</strong> {{ $barang->created_at->format('d M Y H:i') }}</div>
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
                                    <h4 class="text-xl font-bold text-gray-700 dark:text-gray-300 mb-2">
                                        @if($barang->foto)
                                            Ganti Foto Utama Barang
                                        @else
                                            Upload Foto Utama Barang
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
                                        Preview Foto Utama Baru
                                    </h5>
                                    <div class="flex flex-col lg:flex-row lg:items-center lg:space-x-6">
                                        <img id="image-preview" src="" alt="Preview" class="preview-image mb-4 lg:mb-0">
                                        <div class="flex-1">
                                            <div id="file-info" class="text-sm text-green-700 dark:text-green-400 mb-4 space-y-1"></div>
                                            <button type="button" 
                                                    onclick="removeImage()" 
                                                    class="inline-flex items-center px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition-all transform hover:scale-105">
                                                <i class="fas fa-trash mr-2"></i>
                                                Hapus Foto Baru
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

                        {{-- Existing Photos Display --}}
                        @if($barang->fotos->where('is_primary', false)->count() > 0)
                        <div class="mb-6">
                            <div class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 border border-purple-200 dark:border-purple-700 rounded-xl p-6">
                                <h5 class="text-lg font-bold text-purple-800 dark:text-purple-300 mb-4 flex items-center">
                                    <i class="fas fa-images mr-2"></i>
                                    Foto Detail Saat Ini
                                    <span class="ml-2 text-sm bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 px-3 py-1 rounded-full">
                                        {{ $barang->fotos->where('is_primary', false)->count() }}/4
                                    </span>
                                </h5>
                                
                                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                                    @foreach($barang->fotos->where('is_primary', false)->sortBy('urutan') as $foto)
                                    <div class="relative group">
                                        <div class="aspect-square rounded-xl overflow-hidden border-2 border-purple-200 dark:border-purple-700 group-hover:border-purple-500 dark:group-hover:border-purple-400 transition-all shadow-md hover:shadow-xl">
                                            <img src="{{ asset('storage/' . $foto->foto) }}" 
                                                alt="Foto Detail {{ $foto->urutan }}" 
                                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-300">
                                        </div>
                                        
                                        <div class="absolute top-2 left-2 bg-white dark:bg-gray-800 bg-opacity-90 backdrop-blur-sm rounded-lg px-2 py-1 text-xs font-bold text-gray-700 dark:text-gray-300 shadow">
                                            Foto {{ $foto->urutan }}
                                        </div>
                                        
                                        @if($foto->keterangan)
                                        <div class="absolute bottom-2 left-2 right-2 bg-white dark:bg-gray-800 bg-opacity-90 backdrop-blur-sm rounded-lg px-2 py-1 text-xs text-gray-700 dark:text-gray-300 shadow truncate">
                                            {{ $foto->keterangan }}
                                        </div>
                                        @endif
                                        
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all rounded-xl flex items-center justify-center">
                                            <button type="button" 
                                                    onclick="deleteFotoDetail({{ $foto->id }})"
                                                    class="opacity-0 group-hover:opacity-100 bg-red-500 text-white p-3 rounded-full hover:bg-red-600 transition-all transform hover:scale-110 shadow-lg">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                
                                <div class="mt-4 p-3 bg-purple-100 dark:bg-purple-900/50 rounded-lg">
                                    <p class="text-xs text-purple-700 dark:text-purple-400 flex items-start">
                                        <i class="fas fa-info-circle mt-0.5 mr-2 flex-shrink-0"></i>
                                        <span>Foto yang dihapus akan langsung terhapus dari sistem. Foto baru yang diupload akan ditambahkan ke daftar foto detail.</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif

                        {{-- Upload New Photos --}}
                        @if($barang->fotos->where('is_primary', false)->count() < 4)
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border-2 border-blue-200 dark:border-blue-700 rounded-xl p-6 mb-6">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-lg">
                                        <i class="fas fa-plus-circle text-white text-xl"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                                        Tambah Foto Detail
                                    </h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                        Upload foto tambahan untuk menampilkan detail barang dari berbagai sudut pandang
                                        <span class="font-bold text-blue-600 dark:text-blue-400">
                                            (Sisa: {{ 4 - $barang->fotos->where('is_primary', false)->count() }} foto)
                                        </span>
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
                                            <span>Maksimal total 4 foto detail</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-file-image mr-2"></i>
                                            <span>Format: JPEG, PNG, JPG, GIF - Maksimal 2MB per file</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl p-6 mb-6 text-center">
                            <i class="fas fa-check-circle text-green-500 text-3xl mb-3"></i>
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                                Foto Detail Sudah Lengkap
                            </h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Anda sudah mengupload maksimal 4 foto detail. Hapus foto yang ada jika ingin mengganti dengan foto baru.
                            </p>
                        </div>
                        @endif

                        {{-- Preview Multiple Photos (New Uploads) --}}
                        <div id="multiple-preview-container" class="hidden">
                            <h5 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                                <i class="fas fa-images text-blue-600 dark:text-blue-400 mr-2"></i>
                                Preview Foto Baru
                                <span id="photo-counter" class="ml-2 text-sm bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 px-3 py-1 rounded-full">0/{{ 4 - $barang->fotos->where('is_primary', false)->count() }}</span>
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
                                    Hapus Semua Foto Baru
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

                    {{-- Field Lainnya --}}
                    <div class="floating-label">
                        <div class="input-group relative">
                            <textarea name="lainnya" 
                                      id="lainnya" 
                                      rows="4"
                                      class="form-input @error('lainnya') error @enderror"
                                      placeholder=" "
                                      data-original="{{ $barang->lainnya }}"
                                      onchange="trackChanges(this)"
                                      oninput="trackChanges(this)">{{ old('lainnya', $barang->lainnya) }}</textarea>
                            <label for="lainnya">Informasi Lainnya</label>
                            @if($barang->lainnya)
                                <div class="existing-data-indicator">EXISTING</div>
                            @endif
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

            {{-- Action Buttons --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 mb-8">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                            <i class="fas fa-info-circle text-blue-500 mr-2"></i>
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
                                <span id="submit-text">Update Barang</span>
                            </button>
                        </div>
                    </div>
                    
                    {{-- Save confirmation --}}
                    <div id="save-confirmation" class="hidden mt-4 p-4 bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-700 rounded-lg">
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
                                        Batal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
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

@if(session('info'))
<div id="notification" class="notification notification-info">
    <div class="flex items-start">
        <div class="flex-shrink-0">
            <div class="p-3 bg-blue-100 dark:bg-blue-900/50 rounded-xl">
                <i class="fas fa-info-circle text-blue-600 dark:text-blue-400 text-xl"></i>
            </div>
        </div>
        <div class="ml-4 flex-1">
            <h4 class="text-lg font-bold text-gray-900 dark:text-white">Info</h4>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ session('info') }}</p>
        </div>
        <button onclick="hideNotification(this)" class="ml-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 p-2 rounded-lg transition-colors">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
@endif

@if(session('warning'))
<div id="notification" class="notification notification-warning">
    <div class="flex items-start">
        <div class="flex-shrink-0">
            <div class="p-3 bg-yellow-100 dark:bg-yellow-900/50 rounded-xl">
                <i class="fas fa-exclamation-triangle text-yellow-600 dark:text-yellow-400 text-xl"></i>
            </div>
        </div>
        <div class="ml-4 flex-1">
            <h4 class="text-lg font-bold text-gray-900 dark:text-white">Peringatan!</h4>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ session('warning') }}</p>
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
// Change tracking variables
let changedFields = new Set();
let originalValues = {};
let confirmationPending = false;

// Global variables untuk foto detail (BARU)
let selectedDetailFiles = [];
const MAX_DETAIL_PHOTOS = 4;

// Initialize edit form
document.addEventListener('DOMContentLoaded', function() {
    // Store original values
    const formElements = document.querySelectorAll('#barang-form input, #barang-form select, #barang-form textarea');
    formElements.forEach(element => {
        if (element.dataset.original !== undefined) {
            originalValues[element.name] = element.dataset.original;
        }
    });
    
    // Setup drag and drop for file upload
    setupDragAndDrop();
    
    // Initialize progress as complete since we're editing existing data
    updateProgress();
    
    console.log('✅ Enhanced Barang edit form initialized successfully');
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
                const fieldElement = document.querySelector(`[name="${fieldName}"]`);
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
        'kategori_id': 'Kategori Barang',
        'nama_barang': 'Nama Barang',
        'merk': 'Merk/Brand',
        'type': 'Tipe/Model',
        'seri': 'Nomor Seri',
        'tahun_produksi': 'Tahun Produksi',
        'warna': 'Warna',
        'berat': 'Berat',
        'dimensi': 'Dimensi',
        'garansi': 'Masa Garansi',
        'spesifikasi': 'Spesifikasi Detail',
        'tanggal_pembelian': 'Tanggal Pembelian',
        'harga_beli': 'Harga Beli',
        'harga_sewa': 'Harga Sewa',
        'jumlah_total': 'Jumlah Total',
        'kondisi': 'Kondisi Barang',
        'lokasi': 'Lokasi Penyimpanan',
        'deskripsi': 'Deskripsi Tambahan',
        'lainnya': 'Informasi Lainnya',
        'foto': 'Foto Barang'
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
    
    // Reset file input if changed
    if (changedFields.has('foto')) {
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
        fieldCounter.classList.remove('text-gray-700');
        fieldCounter.classList.add('text-green-700');
    }
}

// File Upload Functions (adapted for edit)
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

// ==========================================
// CAMERA & GALLERY FUNCTIONS (BARU)
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

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    
    if (files.length > 0) {
        const fileInput = document.getElementById('foto');
        if (fileInput) {
            fileInput.files = files;
            previewImage(fileInput);
        }
    }
}

async function previewImage(input) {
    const file = input.files[0];
    const previewContainer = document.getElementById('image-preview-container');
    
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
            
            // Display preview immediately
            if (previewContainer) {
                previewContainer.innerHTML = `
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-700 rounded-xl p-6 animate-fade-in">
                        <h5 class="text-lg font-bold text-green-800 dark:text-green-300 mb-4 flex items-center">
                            <i class="fas fa-eye mr-2"></i>
                            Preview Foto Utama Baru
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
                                    Hapus Foto Baru
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                
                previewContainer.classList.remove('hidden');
                previewContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
            
            // Track change
            trackChanges(input);
            
            showNotification('🎉 Foto berhasil dimuat!', 'success');
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

function removeNewImage() {
    const fileInput = document.getElementById('foto');
    const previewContainer = document.getElementById('image-preview-container');
    
    if (fileInput) {
        fileInput.value = '';
        // Remove from changed fields if it was there
        changedFields.delete('foto');
        updateChangesUI();
    }
    if (previewContainer) previewContainer.classList.add('hidden');
    
    showNotification('Foto baru berhasil dihapus', 'success');
}

// ==========================================
// DELETE EXISTING FOTO DETAIL (BARU)
// ==========================================
async function deleteFotoDetail(fotoId) {
    if (!confirm('Hapus foto ini? Foto akan langsung dihapus dari sistem.')) {
        return;
    }
    
    try {
        const response = await fetch(`/admin/barang/{{ $barang->id }}/foto/${fotoId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            showNotification('✅ ' + data.message, 'success');
            // Reload page to refresh foto list
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            showNotification('❌ ' + data.message, 'error');
        }
        
    } catch (error) {
        console.error('Error deleting foto:', error);
        showNotification('❌ Gagal menghapus foto', 'error');
    }
}

// Make global
window.deleteFotoDetail = deleteFotoDetail;

// ==========================================
// MULTIPLE IMAGES HANDLER (FIXED VERSION)
// ==========================================
async function handleMultipleImages(input) {
    const files = Array.from(input.files);
    
    if (files.length === 0) {
        showNotification('ℹ️ Tidak ada file yang dipilih', 'info');
        return;
    }
    
    console.log('📸 handleMultipleImages called');
    console.log('📁 Files from input:', files.length);
    console.log('📦 Current selectedDetailFiles BEFORE:', selectedDetailFiles.length);
    
    // ✅ HITUNG BATAS
    const existingCount = {{ $barang->fotos->where('is_primary', false)->count() }};
    const MAX_TOTAL = 4;
    const remainingSlots = MAX_TOTAL - existingCount - selectedDetailFiles.length;
    
    console.log('📊 Photo calculation:', {
        existingInDB: existingCount,
        currentlySelected: selectedDetailFiles.length,
        remainingSlots: remainingSlots,
        newFilesCount: files.length
    });
    
    if (files.length > remainingSlots) {
        showNotification(
            `⚠️ Maksimal ${MAX_TOTAL} foto detail!<br>` +
            `📊 Sudah ada: ${existingCount} foto di database<br>` +
            `📊 Dipilih sekarang: ${selectedDetailFiles.length} foto<br>` +
            `📊 Sisa slot: ${remainingSlots}`, 
            'warning'
        );
        files.splice(remainingSlots);
    }
    
    if (files.length === 0) {
        showNotification('⚠️ Tidak ada slot foto tersisa', 'warning');
        return;
    }
    
    // Validasi files
    const validFiles = [];
    const invalidFiles = [];
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
            console.log('✅ Valid file:', file.name);
        } else {
            invalidFiles.push({ name: file.name, reason: reason });
            console.log(`❌ Invalid file: ${file.name} - ${reason}`);
        }
    }
    
    // ✅ CRITICAL: JANGAN RESET INPUT!
    // Biarkan input.value tetap ada agar files tetap attached
    // input.value = ''; // ← JANGAN UNCOMMENT INI!
    
    if (validFiles.length > 0) {
        // ✅ Add to selectedDetailFiles array
        selectedDetailFiles = selectedDetailFiles.concat(validFiles);
        
        console.log('✅ Files added to selectedDetailFiles');
        console.log('📦 Total selectedDetailFiles AFTER:', selectedDetailFiles.length);
        console.log('📋 selectedDetailFiles array:', selectedDetailFiles.map(f => f.name));
        
        // ✅ Update preview
        updateMultiplePreview();
        
        // ✅ Force changedFields update untuk bypass validasi
        if (!changedFields.has('foto_detail')) {
            changedFields.add('foto_detail_new');
            console.log('✅ Added foto_detail_new to changedFields');
        }
        
        let message = `✅ ${validFiles.length} foto berhasil ditambahkan!`;
        if (invalidFiles.length > 0) {
            message += `<br>⚠️ ${invalidFiles.length} foto gagal`;
        }
        showNotification(message, 'success');
    } else if (invalidFiles.length > 0) {
        let errorMsg = `❌ ${invalidFiles.length} foto gagal:<br>`;
        invalidFiles.slice(0, 3).forEach(f => {
            errorMsg += `• ${f.name} (${f.reason})<br>`;
        });
        showNotification(errorMsg, 'error');
    }
}

// Make global
window.handleMultipleImages = handleMultipleImages;

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
    
    // ✅ UPDATE COUNTER dengan existing photos
    const existingCount = {{ $barang->fotos->where('is_primary', false)->count() }};
    const MAX_TOTAL = 4;
    const remainingSlots = MAX_TOTAL - existingCount;
    
    if (counter) {
        counter.textContent = `${selectedDetailFiles.length}/${remainingSlots}`;
        counter.className = selectedDetailFiles.length >= remainingSlots
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

// Make functions global
window.handleMultipleImages = handleMultipleImages;
window.removeDetailPhoto = removeDetailPhoto;
window.clearAllDetailPhotos = clearAllDetailPhotos;

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

// Currency Formatting
function formatRupiah(input) {
    let value = input.value.replace(/[^\d]/g, '');
    
    if (value) {
        // Simple validation for reasonable amounts
        const numValue = parseInt(value);
        if (numValue > 999999999999) { // 999 billion limit
            showNotification('Nilai terlalu besar', 'warning');
            input.value = '999999999999';
            return;
        }
        input.value = value;
    }
}

/// Form Submission with confirmation
document.getElementById('barang-form').addEventListener('submit', function(e) {
    // ✅ CEK 1: Apakah ada foto detail baru?
    const hasFotoDetailBaru = selectedDetailFiles.length > 0;
    
    // ✅ CEK 2: Apakah ada foto utama baru?
    const fotoUtamaInput = document.getElementById('foto');
    const hasFotoUtamaBaru = fotoUtamaInput && fotoUtamaInput.files.length > 0;
    
    // ✅ TOTAL CHANGES (termasuk foto)
    const totalChanges = changedFields.size + (hasFotoDetailBaru ? selectedDetailFiles.length : 0) + (hasFotoUtamaBaru ? 1 : 0);
    
    console.log('🚀 FORM SUBMIT CHECK:', {
        'changedFields.size': changedFields.size,
        'selectedDetailFiles.length': selectedDetailFiles.length,
        'hasFotoDetailBaru': hasFotoDetailBaru,
        'hasFotoUtamaBaru': hasFotoUtamaBaru,
        'totalChanges': totalChanges,
        'selectedDetailFiles': selectedDetailFiles.map(f => f.name)
    });
    
    // ✅ VALIDASI: Jika TIDAK ada perubahan sama sekali
    if (totalChanges === 0) {
        e.preventDefault();
        showNotification('⚠️ Tidak ada perubahan yang perlu disimpan', 'warning');
        return false;
    }
    
    // ✅ Jika belum konfirmasi, tampilkan konfirmasi dulu
    if (!confirmationPending) {
        e.preventDefault();
        showSaveConfirmation();
        return false;
    }
    
    // ✅ Validasi form required fields
    if (!validateFormComplete()) {
        e.preventDefault();
        confirmationPending = false;
        return false;
    }
    
    // ✅ CRITICAL: Attach foto detail files ke input SEBELUM submit
    const fotoDetailInput = document.getElementById('foto_detail');
    if (fotoDetailInput && selectedDetailFiles.length > 0) {
        try {
            const dt = new DataTransfer();
            selectedDetailFiles.forEach(file => {
                dt.items.add(file);
            });
            fotoDetailInput.files = dt.files;
            
            console.log('✅ Foto detail attached to input:', fotoDetailInput.files.length, 'files');
            console.log('📋 Attached files:', Array.from(fotoDetailInput.files).map(f => f.name));
            
        } catch (error) {
            console.error('❌ Error attaching files:', error);
            e.preventDefault();
            showNotification('❌ Gagal melampirkan foto detail. Coba lagi.', 'error');
            confirmationPending = false;
            return false;
        }
    }
    
    // ✅ Show loading overlay
    const loadingOverlay = document.getElementById('loading-overlay');
    if (loadingOverlay) {
        loadingOverlay.classList.remove('hidden');
    }
    
    // ✅ Update submit button
    const submitBtn = document.getElementById('submit-btn');
    const submitText = document.getElementById('submit-text');
    
    if (submitBtn && submitText) {
        submitBtn.disabled = true;
        submitText.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
    }
    
    // ✅ Timeout handler (60 detik)
    const timeoutHandler = setTimeout(() => {
        if (!this.submitted) {
            if (loadingOverlay) {
                loadingOverlay.classList.add('hidden');
            }
            if (submitBtn && submitText) {
                submitBtn.disabled = false;
                submitText.innerHTML = '<i class="fas fa-check-circle mr-2"></i>Update Barang';
            }
            showNotification('⏱️ Terjadi timeout. Silakan coba lagi.', 'error');
        }
    }, 60000);
    
    this.submitted = true;
    this.timeoutHandler = timeoutHandler;
    
    console.log('✅ Form submission allowed - Processing...');
});

function showSaveConfirmation() {
    const confirmationDiv = document.getElementById('save-confirmation');
    const changesPreview = document.getElementById('changes-preview');
    
    if (confirmationDiv && changesPreview) {
        // ✅ CEK semua jenis perubahan
        const fotoDetailInput = document.getElementById('foto_detail');
        const hasFotoDetailBaru = selectedDetailFiles.length > 0;
        
        const fotoUtamaInput = document.getElementById('foto');
        const hasFotoUtamaBaru = fotoUtamaInput && fotoUtamaInput.files.length > 0;
        
        let message = '<div class="space-y-3">';
        
        // ✅ 1. Field Changes
        if (changedFields.size > 0) {
            const changesList = Array.from(changedFields).map(fieldName => {
                const label = getFieldLabel(fieldName);
                return `• ${label}`;
            }).join('<br>');
            
            message += `
                <div>
                    <p class="mb-2 font-bold text-orange-800 dark:text-orange-300">
                        📝 ${changedFields.size} Field Diubah:
                    </p>
                    <div class="bg-orange-100 dark:bg-orange-900/30 p-3 rounded-lg text-xs">
                        ${changesList}
                    </div>
                </div>
            `;
        }
        
        // ✅ 2. Foto Utama Baru
        if (hasFotoUtamaBaru) {
            const fileName = fotoUtamaInput.files[0].name;
            const fileSize = (fotoUtamaInput.files[0].size / 1024 / 1024).toFixed(2);
            message += `
                <div class="flex items-start p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
                    <i class="fas fa-image text-blue-600 dark:text-blue-400 mr-3 mt-1"></i>
                    <div class="text-xs">
                        <p class="font-bold text-blue-800 dark:text-blue-300 mb-1">📸 Foto Utama Baru:</p>
                        <p class="text-blue-700 dark:text-blue-400">${fileName} (${fileSize} MB)</p>
                    </div>
                </div>
            `;
        }
        
        // ✅ 3. Foto Detail Baru
        if (hasFotoDetailBaru) {
            message += `
                <div class="flex items-start p-3 bg-green-50 dark:bg-green-900/30 rounded-lg">
                    <i class="fas fa-images text-green-600 dark:text-green-400 mr-3 mt-1"></i>
                    <div class="text-xs">
                        <p class="font-bold text-green-800 dark:text-green-300 mb-1">
                            🖼️ ${selectedDetailFiles.length} Foto Detail Baru
                        </p>
                        <div class="text-green-700 dark:text-green-400 space-y-1">
                            ${selectedDetailFiles.map((file, i) => 
                                `<div>• ${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)</div>`
                            ).join('')}
                        </div>
                    </div>
                </div>
            `;
        }
        
        message += '</div>';
        
        // ✅ Summary
        const totalItems = changedFields.size + (hasFotoUtamaBaru ? 1 : 0) + (hasFotoDetailBaru ? selectedDetailFiles.length : 0);
        message = `
            <p class="mb-3 text-orange-800 dark:text-orange-300 font-bold">
                ⚠️ Anda akan menyimpan ${totalItems} perubahan:
            </p>
        ` + message;
        
        changesPreview.innerHTML = message;
        
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
    document.getElementById('barang-form').submit();
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
    
    // Validate file if uploaded
    const fileInput = document.getElementById('foto');
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

// Enhanced notification system with dark mode
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

// Toggle "Dapat Dipinjam" Checkbox Handler (sama seperti create)
document.addEventListener('DOMContentLoaded', function() {
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
        
        // Initial state
        updateDapatDipinjamUI();
        
        // Update on change
        dapatDipinjamCheckbox.addEventListener('change', function() {
            updateDapatDipinjamUI();
            trackChanges(this); // Sudah ada function trackChanges di form edit
            
            const message = this.checked 
                ? 'Barang akan dapat dipinjam oleh user' 
                : 'Barang tidak akan muncul di katalog peminjaman';
            
            showNotification(message, 'info');
        });
        
        console.log('✅ Dapat dipinjam checkbox handler initialized (EDIT mode)');
    }
});

// Auto hide existing notifications
@if(session('success') || session('error'))
setTimeout(() => {
    const notification = document.getElementById('notification');
    if (notification) hideNotification(notification);
}, 5000);
@endif

</script>
@endpush
