@extends(auth()->check() && auth()->user()->role === 'user' ? 'layouts.user' : 'layouts.app')

@section('title', 'Edit Profil')

@push('styles')
<style>
/* ===== IMPROVED ENTRANCE ANIMATIONS ===== */

/* Smooth Fade In with Scale */
@keyframes smoothFadeIn {
    0% { 
        opacity: 0; 
        transform: scale(0.95) translateY(20px);
        filter: blur(10px);
    }
    100% { 
        opacity: 1; 
        transform: scale(1) translateY(0);
        filter: blur(0);
    }
}

/* Elegant Slide from Bottom */
@keyframes elegantSlideUp {
    0% { 
        opacity: 0; 
        transform: translateY(40px);
    }
    60% {
        opacity: 0.8;
        transform: translateY(-5px);
    }
    100% { 
        opacity: 1; 
        transform: translateY(0);
    }
}

/* Smooth Slide from Right */
@keyframes smoothSlideRight {
    0% { 
        opacity: 0; 
        transform: translateX(50px);
    }
    100% { 
        opacity: 1; 
        transform: translateX(0);
    }
}

/* Gentle Scale with Fade */
@keyframes gentleScale {
    0% { 
        opacity: 0; 
        transform: scale(0.9);
    }
    50% {
        opacity: 0.5;
    }
    100% { 
        opacity: 1; 
        transform: scale(1);
    }
}

/* Shimmer Animation */
@keyframes shimmer {
    0% { background-position: -1000px 0; }
    100% { background-position: 1000px 0; }
}

/* Float Animation */
@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(2deg); }
}

/* Pulse Animation */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
}

/* Spin Animation */
@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Stagger Animation Classes */
.animate-smooth-fade {
    animation: smoothFadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    opacity: 0;
}

.animate-elegant-slide {
    animation: elegantSlideUp 0.7s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    opacity: 0;
}

.animate-gentle-scale {
    animation: gentleScale 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    opacity: 0;
}

.animate-smooth-slide-right {
    animation: smoothSlideRight 0.7s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    opacity: 0;
}

/* Staggered Delay System */
.delay-100 { animation-delay: 0.1s; }
.delay-200 { animation-delay: 0.2s; }
.delay-300 { animation-delay: 0.3s; }
.delay-400 { animation-delay: 0.4s; }
.delay-500 { animation-delay: 0.5s; }
.delay-600 { animation-delay: 0.6s; }

/* Form Group Animations */
.form-group { 
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    will-change: transform;
    animation: elegantSlideUp 0.5s ease-out forwards;
    opacity: 0;
}

.form-group:nth-child(1) { animation-delay: 0.05s; }
.form-group:nth-child(2) { animation-delay: 0.1s; }
.form-group:nth-child(3) { animation-delay: 0.15s; }
.form-group:nth-child(4) { animation-delay: 0.2s; }
.form-group:nth-child(5) { animation-delay: 0.25s; }
.form-group:nth-child(6) { animation-delay: 0.3s; }
.form-group:nth-child(7) { animation-delay: 0.35s; }
.form-group:nth-child(8) { animation-delay: 0.4s; }

.form-group:focus-within { 
    transform: translateX(6px) scale(1.01);
}

/* Header dengan tema Cimahi Technopark - Enhanced */
.edit-header {
    background: linear-gradient(135deg, #0C4A6E 0%, #0369A1 25%, #0EA5E9 50%, #38BDF8 75%, #7DD3FC 100%);
    position: relative;
    overflow: hidden;
    border-radius: 28px;
    box-shadow: 0 20px 60px rgba(14, 165, 233, 0.25);
}

.dark .edit-header {
    background: linear-gradient(135deg, #1E3A8A 0%, #1E40AF 25%, #2563EB 50%, #3B82F6 75%, #60A5FA 100%);
    box-shadow: 0 20px 60px rgba(37, 99, 235, 0.3);
}

.edit-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(255,255,255,0.25) 0%, transparent 70%);
    animation: float 10s ease-in-out infinite;
}

.edit-header::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);
    animation: float 12s ease-in-out infinite reverse;
}

/* Buttons - Enhanced with better transitions */
.btn-primary {
    background: linear-gradient(135deg, #0EA5E9 0%, #0284C7 100%);
    border: none;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
    position: relative;
    overflow: hidden;
}

.dark .btn-primary {
    background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn-primary:hover::before {
    left: 100%;
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 24px rgba(14, 165, 233, 0.4);
}

.dark .btn-primary:hover {
    box-shadow: 0 12px 24px rgba(59, 130, 246, 0.5);
}

.btn-primary:active {
    transform: translateY(-1px);
}

.btn-danger {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    border: none;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    position: relative;
    overflow: hidden;
}

.btn-danger::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.btn-danger:hover::before {
    left: 100%;
}

.btn-danger:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 24px rgba(239, 68, 68, 0.4);
}

.btn-danger:active {
    transform: translateY(-1px);
}

/* Tabs - Enhanced */
.tab-btn { 
    position: relative; 
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    font-size: 15px;
    padding: 18px 24px;
}

.tab-btn:hover {
    background: rgba(14, 165, 233, 0.03);
}

.dark .tab-btn:hover {
    background: rgba(59, 130, 246, 0.1);
}

.tab-btn.active {
    color: #0EA5E9;
    background: rgba(14, 165, 233, 0.08);
}

.dark .tab-btn.active {
    color: #60A5FA;
    background: rgba(59, 130, 246, 0.15);
}

.tab-btn.active::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #0EA5E9, #0284C7);
    border-radius: 3px 3px 0 0;
    animation: smoothSlideRight 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

.dark .tab-btn.active::after {
    background: linear-gradient(90deg, #3B82F6, #2563EB);
}

/* Info Sections - Enhanced */
.info-section {
    background: white;
    border-radius: 24px;
    padding: 0;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    border: 1px solid #f1f5f9;
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}

.dark .info-section {
    background: #1F2937;
    border-color: #374151;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.info-section:hover {
    box-shadow: 0 16px 48px rgba(0, 0, 0, 0.12);
    transform: translateY(-6px);
}

.dark .info-section:hover {
    box-shadow: 0 16px 48px rgba(0, 0, 0, 0.4);
}

/* Themed Headers */
.info-header.blue {
    background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
    padding: 24px 28px;
    border-bottom: 2px solid #93C5FD;
    position: relative;
    overflow: hidden;
}

.dark .info-header.blue {
    background: linear-gradient(135deg, #1E3A8A 0%, #1E40AF 100%);
    border-bottom-color: #2563EB;
}

.info-header.blue::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -5%;
    width: 150px;
    height: 150px;
    background: radial-gradient(circle, rgba(14, 165, 233, 0.1) 0%, transparent 70%);
    animation: float 8s ease-in-out infinite;
}

.info-header.purple {
    background: linear-gradient(135deg, #F5F3FF 0%, #EDE9FE 100%);
    padding: 24px 28px;
    border-bottom: 2px solid #C4B5FD;
    position: relative;
    overflow: hidden;
}

.dark .info-header.purple {
    background: linear-gradient(135deg, #5B21B6 0%, #6D28D9 100%);
    border-bottom-color: #7C3AED;
}

.info-header.purple::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -5%;
    width: 150px;
    height: 150px;
    background: radial-gradient(circle, rgba(139, 92, 246, 0.1) 0%, transparent 70%);
    animation: float 8s ease-in-out infinite;
}

.info-header.red {
    background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
    padding: 24px 28px;
    border-bottom: 2px solid #FCA5A5;
    position: relative;
    overflow: hidden;
}

.dark .info-header.red {
    background: linear-gradient(135deg, #991B1B 0%, #B91C1C 100%);
    border-bottom-color: #DC2626;
}

.info-header.red::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -5%;
    width: 150px;
    height: 150px;
    background: radial-gradient(circle, rgba(239, 68, 68, 0.1) 0%, transparent 70%);
    animation: float 8s ease-in-out infinite;
}

.info-title {
    font-size: 20px;
    font-weight: 800;
    display: flex;
    align-items: center;
    gap: 12px;
}

.info-title.blue { color: #1E3A8A; }
.dark .info-title.blue { color: #E0F2FE; }

.info-title.purple { color: #5B21B6; }
.dark .info-title.purple { color: #EDE9FE; }

.info-title.red { color: #991B1B; }
.dark .info-title.red { color: #FEE2E2; }

.info-icon {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

.info-section:hover .info-icon {
    transform: scale(1.1) rotate(5deg);
}

.info-icon.blue {
    background: linear-gradient(135deg, #0EA5E9 0%, #0284C7 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
}

.dark .info-icon.blue {
    background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
}

.info-icon.purple {
    background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
}

.info-icon.red {
    background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
    color: white;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

.info-body {
    padding: 32px;
}

/* Form Inputs - Enhanced */
.form-control {
    padding: 14px 18px;
    font-size: 15px;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    background: white;
}

.dark .form-control {
    background: #374151;
    border-color: #4B5563;
    color: #F3F4F6;
}

.form-control:focus {
    border-color: #0EA5E9;
    box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.12);
    outline: none;
    background: #fafafa;
}

.dark .form-control:focus {
    border-color: #3B82F6;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
    background: #4B5563;
}

.form-control:hover:not(:focus) {
    border-color: #cbd5e1;
}

.dark .form-control:hover:not(:focus) {
    border-color: #6B7280;
}

/* Notification - Enhanced */
.notification {
    backdrop-filter: blur(12px);
    border-left: 4px solid;
    animation: smoothSlideRight 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}

.notification.success { border-left-color: #10b981; }
.notification.error { border-left-color: #ef4444; }

.otp-input {
    font-size: 28px;
    letter-spacing: 12px;
    text-align: center;
    font-family: 'Courier New', monospace;
    font-weight: bold;
}

/* Avatar Upload Section - Enhanced */
.avatar-upload-section {
    background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
    border: 2px dashed #93C5FD;
    border-radius: 16px;
    padding: 24px;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

.dark .avatar-upload-section {
    background: linear-gradient(135deg, #1E3A8A 0%, #1E40AF 100%);
    border-color: #2563EB;
}

.avatar-upload-section:hover {
    background: linear-gradient(135deg, #DBEAFE 0%, #BFDBFE 100%);
    border-color: #0EA5E9;
    transform: scale(1.01);
}

.dark .avatar-upload-section:hover {
    background: linear-gradient(135deg, #1E40AF 0%, #2563EB 100%);
    border-color: #3B82F6;
}

/* Avatar Preview Enhanced */
#avatar-preview {
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

#avatar-preview:hover {
    transform: scale(1.05);
}

/* Tab Content Transition */
.tab-content {
    animation: elegantSlideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}

/* Modal Enhanced */
#delete-modal {
    animation: smoothFadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

#delete-modal > div {
    animation: gentleScale 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    background: white;
}

.dark #delete-modal > div {
    background: #1F2937;
}

/* Loading State */
.btn-loading {
    position: relative;
    color: transparent !important;
}

.btn-loading::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    top: 50%;
    left: 50%;
    margin-left: -10px;
    margin-top: -10px;
    border: 3px solid rgba(255,255,255,0.3);
    border-radius: 50%;
    border-top-color: white;
    animation: spin 0.8s linear infinite;
}

/* Smooth Page Transitions */
.page-transition {
    animation: smoothFadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

/* Buttons maintain relative positioning for internal elements */
button, .btn-primary, .btn-danger {
    position: relative;
}

.focused {
    animation: pulse 2s ease-in-out infinite;
}

/* Label colors in dark mode */
.dark label {
    color: #E5E7EB;
}

.dark .text-gray-700 {
    color: #D1D5DB;
}

.dark .text-gray-600 {
    color: #9CA3AF;
}

.dark .text-gray-900 {
    color: #F3F4F6;
}

/* Info boxes in dark mode */
.dark .bg-blue-50 {
    background: #1E3A8A;
}

.dark .border-blue-200 {
    border-color: #2563EB;
}

.dark .text-blue-600,
.dark .text-blue-700,
.dark .text-blue-900 {
    color: #93C5FD !important;
}

.dark .bg-green-50 {
    background: #14532D;
}

.dark .border-green-200 {
    border-color: #15803D;
}

.dark .text-green-600,
.dark .text-green-700,
.dark .text-green-900 {
    color: #86EFAC !important;
}

.dark .bg-red-50 {
    background: #991B1B;
}

.dark .border-red-200 {
    border-color: #DC2626;
}

.dark .text-red-600,
.dark .text-red-700,
.dark .text-red-800,
.dark .text-red-900 {
    color: #FCA5A5 !important;
}

/* Tab border in dark mode */
.dark .border-b {
    border-color: #374151;
}

.dark .border-gray-200 {
    border-color: #4B5563;
}

.dark .border-gray-100 {
    border-color: #374151;
}

/* Button borders in dark mode */
.dark .border-gray-300 {
    border-color: #4B5563;
}

.dark .hover\:bg-gray-50:hover {
    background-color: #374151;
}

/* Modal background in dark mode */
.dark .bg-black {
    background-color: rgba(0, 0, 0, 0.7);
}

/* ===== MOBILE RESPONSIVE - AVATAR UPLOAD ONLY ===== */

@media (max-width: 640px) {
    /* Avatar Upload Container */
    .avatar-upload-section {
        padding: 1rem;
        border-radius: 12px;
    }
    
    /* Avatar Upload Flex Layout - Ubah jadi Column */
    .avatar-upload-section .flex.items-center.space-x-6 {
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        margin-left: 0 !important;
        margin-right: 0 !important;
    }
    
    /* Remove space-x on mobile */
    .avatar-upload-section .space-x-6 > * + * {
        margin-left: 0 !important;
    }
    
    /* Avatar Preview - Center & Smaller */
    .avatar-upload-section .relative {
        margin-bottom: 0;
    }
    
    #avatar-preview {
        width: 96px;
        height: 96px;
        border-width: 3px;
    }
    
    /* Camera Icon Badge */
    .avatar-upload-section .relative > div.absolute {
        padding: 0.625rem;
        bottom: -0.25rem;
        right: -0.25rem;
    }
    
    .avatar-upload-section .relative > div.absolute i {
        font-size: 0.875rem;
    }
    
    /* Controls Container - Full Width */
    .avatar-upload-section .flex-1 {
        width: 100%;
        text-align: center;
    }
    
    /* Button Container - Stack Vertically */
    .avatar-upload-section .flex.space-x-3 {
        flex-direction: column;
        width: 100%;
        gap: 0.625rem;
        margin-left: 0 !important;
        margin-right: 0 !important;
    }
    
    /* Remove space-x from buttons */
    .avatar-upload-section .space-x-3 > * + * {
        margin-left: 0 !important;
    }
    
    /* Buttons - Full Width & Smaller */
    .avatar-upload-section button {
        width: 100%;
        justify-content: center;
        padding: 0.625rem 1rem;
        font-size: 0.8125rem;
        font-weight: 600;
    }
    
    .avatar-upload-section button i {
        font-size: 0.875rem;
    }
    
    /* Info Text - Smaller */
    .avatar-upload-section p.text-sm {
        font-size: 0.75rem;
        text-align: center;
        margin-top: 0.625rem;
    }
    
    .avatar-upload-section p.text-sm i {
        font-size: 0.75rem;
    }
    
    /* Filename Display */
    #avatar-filename {
        font-size: 0.75rem;
        text-align: center;
    }
    
    /* Label */
    .avatar-upload-section > label {
        font-size: 0.8125rem;
        margin-bottom: 0.75rem;
        text-align: center;
        display: block;
    }
}

/* Tablet - Medium Screen (641px - 768px) */
@media (min-width: 641px) and (max-width: 768px) {
    .avatar-upload-section {
        padding: 1.25rem;
    }
    
    #avatar-preview {
        width: 112px;
        height: 112px;
    }
    
    .avatar-upload-section button {
        font-size: 0.875rem;
        padding: 0.75rem 1.25rem;
    }
}

/* Reduce Motion for Accessibility */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* Responsive */
@media (max-width: 1024px) {
    .edit-header {
        border-radius: 20px;
    }
}


</style>
@endpush

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 lg:py-4">       
        
        <!-- Breadcrumb -->
        <nav class="breadcrumb-modern mb-8 animate-smooth-fade" aria-label="Breadcrumb">
            <a href="{{ route('dashboard') }}" class="breadcrumb-link flex items-center gap-2">
                <i class="fas fa-home mr-2"></i>
                Dashboard
            </a>
            <i class="fas fa-chevron-right text-gray-400 dark:text-gray-600 text-xs"></i>
            <a href="{{ route('profile.index') }}" class="breadcrumb-link flex items-center">
                <i class="fas fa-user mr-2"></i>
                Profil Saya
            </a>
            <i class="fas fa-chevron-right text-gray-400 dark:text-gray-600 text-xs"></i>
            <span class="text-gray-900 dark:text-gray-100 font-bold flex items-center">
                <i class="fas fa-edit mr-2"></i>
                Edit Profil
            </span>
        </nav>
 
        <!-- Header Section -->
        <div class="edit-header mb-8 animate-gentle-scale delay-100">
            <div class="relative z-10 px-8 py-10">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="mb-6 lg:mb-0">
                        <h1 class="text-4xl font-black text-white mb-3 tracking-tight drop-shadow-lg">Edit Profil</h1>
                        <p class="text-white/95 text-lg font-medium drop-shadow">Perbarui informasi profil dan pengaturan akun Anda</p>
                    </div>
                    <a href="{{ route('profile.index') }}" class="inline-flex items-center px-6 py-3 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm text-sky-600 dark:text-blue-400 rounded-xl hover:bg-white dark:hover:bg-gray-800 transition-all font-bold shadow-lg hover:shadow-xl border-2 border-white/50 dark:border-gray-700">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Profil
                    </a>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 mb-8 animate-elegant-slide delay-200">
            <div class="border-b border-gray-200 dark:border-gray-700">
                <nav class="flex -mb-px">
                    <button onclick="showTab('profile')" id="tab-profile" class="tab-btn active flex-1 text-center border-b-2 border-transparent font-bold text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                        <i class="fas fa-user mr-2"></i> Informasi Profil
                    </button>
                    <button onclick="showTab('password')" id="tab-password" class="tab-btn flex-1 text-center border-b-2 border-transparent font-bold text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                        <i class="fas fa-lock mr-2"></i> Ubah Password
                    </button>
                    <button onclick="showTab('danger')" id="tab-danger" class="tab-btn flex-1 text-center border-b-2 border-transparent font-bold text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all">
                        <i class="fas fa-exclamation-triangle mr-2"></i> Zona Bahaya
                    </button>
                </nav>
            </div>
        </div>

        <!-- Profile Information Form -->
        <div id="content-profile" class="tab-content animate-elegant-slide delay-300">
            <div class="info-section">
                <div class="info-header blue">
                    <div class="info-title blue">
                        <div class="info-icon blue">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <span>Informasi Profil</span>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="info-body">
                    @csrf
                    @method('PATCH')
                    
                    <!-- Avatar Upload Section -->
                    <div class="mb-8 avatar-upload-section">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-4">Foto Profil</label>
                        <div class="flex items-center space-x-6">
                            <!-- Avatar Preview -->
                            <div class="relative">
                                <img id="avatar-preview" 
                                     src="{{ $user->avatar_url }}" 
                                     alt="{{ $user->name }}"
                                     class="w-32 h-32 rounded-full object-cover border-4 border-white dark:border-gray-700 shadow-xl">
                                <div class="absolute -bottom-2 -right-2 bg-gradient-to-br from-sky-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 text-white rounded-full p-3 shadow-lg">
                                    <i class="fas fa-camera"></i>
                                </div>
                            </div>
                            
                            <!-- Upload Controls -->
                            <div class="flex-1">
                                <input type="file" 
                                       name="avatar" 
                                       id="avatar-input" 
                                       accept="image/jpeg,image/png,image/jpg,image/gif"
                                       class="hidden">
                                
                                <div class="space-y-3">
                                    <div class="flex space-x-3">
                                        <button type="button" 
                                                onclick="document.getElementById('avatar-input').click()" 
                                                class="px-5 py-2.5 bg-gradient-to-r from-sky-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 text-white text-sm font-bold rounded-xl hover:shadow-lg transition-all">
                                            <i class="fas fa-upload mr-2"></i>Upload Foto Baru
                                        </button>
                                        
                                        @if($user->avatar)
                                        <button type="button" 
                                                onclick="deleteAvatar()" 
                                                class="px-5 py-2.5 bg-gradient-to-r from-red-500 to-rose-600 text-white text-sm font-bold rounded-xl hover:shadow-lg transition-all">
                                            <i class="fas fa-trash mr-2"></i>Hapus Foto
                                        </button>
                                        @endif
                                    </div>
                                    
                                    <p class="text-sm text-gray-600 dark:text-gray-400 font-medium">
                                        <i class="fas fa-info-circle mr-1 text-sky-500 dark:text-blue-400"></i>
                                        Format: JPG, PNG, GIF. Maksimal 2MB
                                    </p>
                                    
                                    <div id="avatar-filename" class="text-sm text-gray-700 dark:text-gray-300 font-semibold hidden"></div>
                                </div>
                                
                                @error('avatar')
                                    <p class="text-red-500 text-sm mt-2 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="border-t-2 border-gray-200 dark:border-gray-700 pt-8 mb-8"></div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- Nama Lengkap -->
                        <div class="form-group md:col-span-2">
                            <label for="name" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name', $user->name) }}"
                                   required
                                   class="form-control block w-full @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group md:col-span-2">
                            <label for="email" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email', $user->email) }}"
                                   required
                                   class="form-control block w-full @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No. Telepon -->
                        <div class="form-group">
                            <label for="no_telp" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                No. Telepon
                            </label>
                            <input type="text" 
                                   name="no_telp" 
                                   id="no_telp" 
                                   value="{{ old('no_telp', $user->no_telp) }}"
                                   placeholder="08xxxxxxxxxx"
                                   maxlength="20"
                                   class="form-control block w-full @error('no_telp') border-red-500 @enderror">
                            @error('no_telp')
                                <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No. KTP -->
                        <div class="form-group">
                            <label for="no_ktp" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                No. KTP
                            </label>
                            <input type="text" 
                                   name="no_ktp" 
                                   id="no_ktp" 
                                   value="{{ old('no_ktp', $user->no_ktp) }}"
                                   placeholder="16 digit"
                                   maxlength="16"
                                   class="form-control block w-full @error('no_ktp') border-red-500 @enderror">
                            @error('no_ktp')
                                <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div class="form-group md:col-span-2">
                            <label for="alamat" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Alamat Lengkap
                            </label>
                            <textarea name="alamat" 
                                      id="alamat" 
                                      rows="3"
                                      placeholder="Jl. Contoh No. 123"
                                      class="form-control block w-full @error('alamat') border-red-500 @enderror">{{ old('alamat', $user->alamat) }}</textarea>
                            @error('alamat')
                                <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kelurahan -->
                        <div class="form-group">
                            <label for="kelurahan" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Kelurahan
                            </label>
                            <input type="text" 
                                   name="kelurahan" 
                                   id="kelurahan" 
                                   value="{{ old('kelurahan', $user->kelurahan) }}"
                                   class="form-control block w-full @error('kelurahan') border-red-500 @enderror">
                            @error('kelurahan')
                                <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kecamatan -->
                        <div class="form-group">
                            <label for="kecamatan" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Kecamatan
                            </label>
                            <input type="text" 
                                   name="kecamatan" 
                                   id="kecamatan" 
                                   value="{{ old('kecamatan', $user->kecamatan) }}"
                                   class="form-control block w-full @error('kecamatan') border-red-500 @enderror">
                            @error('kecamatan')
                                <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kabupaten -->
                        <div class="form-group">
                            <label for="kabupaten" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Kabupaten/Kota
                            </label>
                            <input type="text" 
                                   name="kabupaten" 
                                   id="kabupaten" 
                                   value="{{ old('kabupaten', $user->kabupaten) }}"
                                   class="form-control block w-full @error('kabupaten') border-red-500 @enderror">
                            @error('kabupaten')
                                <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kode Pos -->
                        <div class="form-group">
                            <label for="kode_pos" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Kode Pos
                            </label>
                            <input type="text" 
                                   name="kode_pos" 
                                   id="kode_pos" 
                                   value="{{ old('kode_pos', $user->kode_pos) }}"
                                   maxlength="10"
                                   class="form-control block w-full @error('kode_pos') border-red-500 @enderror">
                            @error('kode_pos')
                                <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jabatan -->
                        <div class="form-group">
                            <label for="jabatan" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Jabatan
                            </label>
                            <input type="text" 
                                   name="jabatan" 
                                   id="jabatan" 
                                   value="{{ old('jabatan', $user->jabatan) }}"
                                   class="form-control block w-full @error('jabatan') border-red-500 @enderror">
                            @error('jabatan')
                                <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Instansi -->
                        <div class="form-group">
                            <label for="instansi" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Instansi
                            </label>
                            <input type="text" 
                                   name="instansi" 
                                   id="instansi" 
                                   value="{{ old('instansi', $user->instansi) }}"
                                   class="form-control block w-full @error('instansi') border-red-500 @enderror">
                            @error('instansi')
                                <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Organisasi -->
                        <div class="form-group md:col-span-2">
                            <label for="nama_organisasi" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Nama Organisasi
                            </label>
                            <input type="text" 
                                   name="nama_organisasi" 
                                   id="nama_organisasi" 
                                   value="{{ old('nama_organisasi', $user->nama_organisasi) }}"
                                   class="form-control block w-full @error('nama_organisasi') border-red-500 @enderror">
                            @error('nama_organisasi')
                                <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-8 pt-6 border-t-2 border-gray-200 dark:border-gray-700 flex justify-end space-x-4">
                        <a href="{{ route('profile.index') }}" class="px-8 py-3.5 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all font-bold text-base">
                            Batal
                        </a>
                        <button type="submit" class="btn-primary px-8 py-3.5 text-white rounded-xl font-bold text-base">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Change Password Form dengan OTP -->
        <div id="content-password" class="tab-content hidden">
            <div class="info-section">
                <div class="info-header purple">
                    <div class="info-title purple">
                        <div class="info-icon purple">
                            <i class="fas fa-lock"></i>
                        </div>
                        <span>Ubah Password</span>
                    </div>
                </div>
                
                <!-- Step 1: Request OTP -->
                <div id="step-request-otp" class="info-body">
                    <div class="bg-blue-50 dark:bg-blue-900/20 border-2 border-blue-200 dark:border-blue-800 rounded-xl p-5 mb-6">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-blue-600 dark:text-blue-400 text-xl mt-1 mr-4"></i>
                            <div>
                                <h4 class="text-base font-bold text-blue-900 dark:text-blue-300 mb-2">Keamanan Akun</h4>
                                <p class="text-sm text-blue-700 dark:text-blue-400 leading-relaxed">
                                    Untuk keamanan, Anda akan menerima kode OTP melalui email untuk verifikasi perubahan password.
                                </p>
                            </div>
                        </div>
                    </div>

                    <form id="form-request-otp">
                        @csrf
                        <div class="form-group">
                            <label for="current_password_otp" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                Password Lama <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="password" 
                                       name="current_password" 
                                       id="current_password_otp" 
                                       required
                                       class="form-control block w-full pr-14">
                                <button type="button" onclick="togglePassword('current_password_otp')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-lg">
                                    <i class="fas fa-eye" id="icon-current_password_otp"></i>
                                </button>
                            </div>
                            <div id="current-password-error" class="text-red-500 text-sm mt-1 font-semibold hidden"></div>
                        </div>

                        <div class="mt-8 flex justify-end space-x-4">
                            <button type="button" onclick="showTab('profile')" class="px-8 py-3.5 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all font-bold text-base">
                                Batal
                            </button>
                            <button type="submit" id="btn-request-otp" class="btn-primary px-8 py-3.5 text-white rounded-xl font-bold text-base">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Kode OTP
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Step 2: Verify OTP & Change Password -->
                <div id="step-verify-otp" class="info-body hidden">
                    <div class="bg-green-50 dark:bg-green-900/20 border-2 border-green-200 dark:border-green-800 rounded-xl p-5 mb-6">
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-xl mt-1 mr-4"></i>
                            <div>
                                <h4 class="text-base font-bold text-green-900 dark:text-green-300 mb-2">Kode OTP Terkirim</h4>
                                <p class="text-sm text-green-700 dark:text-green-400 leading-relaxed">
                                    Kami telah mengirim kode OTP ke email <strong id="user-email">{{ auth()->user()->email }}</strong>
                                    <br>Kode berlaku selama <strong>10 menit</strong>.
                                </p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('profile.password.update') }}">
                        @csrf
                        @method('PATCH')
                        
                        <div class="space-y-6">
                            <!-- OTP Input -->
                            <div class="form-group">
                                <label for="otp" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    Kode OTP <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="otp" 
                                       id="otp" 
                                       required
                                       maxlength="6"
                                       placeholder="000000"
                                       class="otp-input form-control block w-full @error('otp') border-red-500 @enderror">
                                @error('otp')
                                    <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- New Password -->
                            <div class="form-group">
                                <label for="password" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    Password Baru <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" 
                                           name="password" 
                                           id="password" 
                                           required
                                           class="form-control block w-full pr-14 @error('password') border-red-500 @enderror">
                                    <button type="button" onclick="togglePassword('password')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-lg">
                                        <i class="fas fa-eye" id="icon-password"></i>
                                    </button>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 font-medium">Minimal 8 karakter</p>
                                @error('password')
                                    <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group">
                                <label for="password_confirmation" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                                    Konfirmasi Password Baru <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="password" 
                                           name="password_confirmation" 
                                           id="password_confirmation" 
                                           required
                                           class="form-control block w-full pr-14">
                                    <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 text-lg">
                                        <i class="fas fa-eye" id="icon-password_confirmation"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t-2 border-gray-200 dark:border-gray-700 flex justify-between items-center">
                            <button type="button" onclick="resetPasswordForm()" class="text-base text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 underline font-bold">
                                <i class="fas fa-redo mr-2"></i> Kirim Ulang Kode OTP
                            </button>
                            <div class="flex space-x-4">
                                <button type="button" onclick="showTab('profile')" class="px-8 py-3.5 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition-all font-bold text-base">
                                    Batal
                                </button>
                                <button type="submit" class="btn-primary px-8 py-3.5 text-white rounded-xl font-bold text-base">
                                    <i class="fas fa-key mr-2"></i> Ubah Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Danger Zone -->
        <div id="content-danger" class="tab-content hidden">
            <div class="info-section">
                <div class="info-header red">
                    <div class="info-title red">
                        <div class="info-icon red">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div>
                            <span>Zona Bahaya</span>
                            <p class="text-sm text-red-600 dark:text-red-400 mt-1 font-semibold">Tindakan di area ini bersifat permanen</p>
                        </div>
                    </div>
                </div>
                
                <div class="info-body">
                    <div class="bg-red-50 dark:bg-red-900/20 border-2 border-red-200 dark:border-red-800 rounded-xl p-5 mb-6">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-circle text-red-600 dark:text-red-400 text-xl mt-1 mr-4"></i>
                            <div>
                                <h4 class="text-base font-bold text-red-900 dark:text-red-300 mb-2">Hapus Akun</h4>
                                <p class="text-sm text-red-700 dark:text-red-400 leading-relaxed">
                                    Menghapus akun akan menghapus semua data Anda secara permanen. 
                                    Tindakan ini tidak dapat dibatalkan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <button type="button" onclick="showDeleteModal()" class="btn-danger px-8 py-3.5 text-white rounded-xl font-bold text-base">
                        <i class="fas fa-trash-alt mr-2"></i> Hapus Akun Saya
                    </button>
                </div>
            </div>
        </div>

    </div>

    <!-- Delete Account Modal -->
    <div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border-0 w-11/12 max-w-lg shadow-2xl rounded-2xl bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-xl mr-3">
                            <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-gray-900 dark:text-gray-100">Konfirmasi Hapus Akun</h3>
                    </div>
                    <button onclick="closeDeleteModal()" class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
                
                <form method="POST" action="{{ route('profile.destroy') }}" id="delete-form">
                    @csrf
                    @method('DELETE')
                    
                    <div class="mb-6 p-5 bg-red-50 dark:bg-red-900/20 rounded-xl border-2 border-red-200 dark:border-red-800">
                        <p class="text-sm text-red-800 dark:text-red-300 mb-3 font-bold">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Peringatan: Tindakan ini akan menghapus semua data Anda secara permanen termasuk:
                        </p>
                        <ul class="text-sm text-red-700 dark:text-red-400 space-y-2 ml-4 font-semibold">
                            <li>• Informasi profil</li>
                            <li>• Riwayat permohonan</li>
                            <li>• Riwayat peminjaman</li>
                            <li>• Data pembayaran</li>
                        </ul>
                    </div>

                    <div class="mb-6">
                        <label for="delete_password" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">
                            Konfirmasi dengan Password Anda <span class="text-red-500">*</span>
                        </label>
                        <input type="password" 
                               name="password" 
                               id="delete_password" 
                               required
                               placeholder="Masukkan password"
                               class="form-control block w-full">
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeDeleteModal()" 
                                class="px-6 py-3 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-xl font-bold transition-all text-base">
                            Batal
                        </button>
                        <button type="submit" 
                                class="btn-danger px-6 py-3 text-white rounded-xl font-bold text-base">
                            Ya, Hapus Akun Saya
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Notifications -->
    @if(session('success'))
    <div id="notification" class="fixed top-6 right-6 z-50 animate-scale-in max-w-md">
        <div class="notification success bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm rounded-xl shadow-2xl border-2 border-gray-100 dark:border-gray-700 p-5">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-xl">
                        <i class="fas fa-check-circle text-green-600 dark:text-green-400 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <h4 class="text-base font-black text-gray-900 dark:text-gray-100">Berhasil!</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 font-semibold">{{ session('success') }}</p>
                </div>
                <button onclick="hideNotification()" class="ml-auto text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-2 rounded-lg transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div id="notification" class="fixed top-6 right-6 z-50 animate-scale-in max-w-md">
        <div class="notification error bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm rounded-xl shadow-2xl border-2 border-gray-100 dark:border-gray-700 p-5">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-xl">
                        <i class="fas fa-exclamation-circle text-red-600 dark:text-red-400 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <h4 class="text-base font-black text-gray-900 dark:text-gray-100">Error!</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 font-semibold">{{ $errors->first() }}</p>
                </div>
                <button onclick="hideNotification()" class="ml-auto text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-2 rounded-lg transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
// Tab switching with smooth animation
function showTab(tabName) {
    // Hide all content with fade out
    document.querySelectorAll('.tab-content').forEach(content => {
        content.style.opacity = '0';
        content.style.transform = 'translateY(20px)';
        setTimeout(() => content.classList.add('hidden'), 150);
    });
    
    // Remove active from all tabs
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    
    // Show selected content with fade in
    setTimeout(() => {
        const selectedContent = document.getElementById('content-' + tabName);
        selectedContent.classList.remove('hidden');
        setTimeout(() => {
            selectedContent.style.opacity = '1';
            selectedContent.style.transform = 'translateY(0)';
        }, 10);
    }, 150);
    
    // Set active tab
    document.getElementById('tab-' + tabName).classList.add('active');
}

// Toggle password visibility
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById('icon-' + fieldId);
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Delete modal functions with animation
function showDeleteModal() {
    const modal = document.getElementById('delete-modal');
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.style.opacity = '1';
    }, 10);
}

function closeDeleteModal() {
    const modal = document.getElementById('delete-modal');
    modal.style.opacity = '0';
    setTimeout(() => {
        modal.classList.add('hidden');
        document.getElementById('delete_password').value = '';
    }, 300);
}

// Close modal on backdrop/ESC
document.addEventListener('click', function(event) {
    const deleteModal = document.getElementById('delete-modal');
    if (event.target === deleteModal) closeDeleteModal();
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeDeleteModal();
});

// Notification functions with smooth hide
function hideNotification() {
    const notification = document.getElementById('notification');
    if (notification) {
        notification.style.transform = 'translateX(400px)';
        notification.style.opacity = '0';
        setTimeout(() => notification.remove(), 400);
    }
}

@if(session('success') || $errors->any())
setTimeout(() => hideNotification(), 5000);
@endif

// Request OTP Form
document.getElementById('form-request-otp').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const btn = document.getElementById('btn-request-otp');
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.classList.add('btn-loading');
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
    
    const formData = new FormData(this);
    
    try {
        const response = await fetch('{{ route("profile.password.request-otp") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Hide step 1 with animation
            const step1 = document.getElementById('step-request-otp');
            step1.style.opacity = '0';
            step1.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                step1.classList.add('hidden');
                
                // Show step 2 with animation
                const step2 = document.getElementById('step-verify-otp');
                step2.classList.remove('hidden');
                step2.style.opacity = '0';
                step2.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    step2.style.opacity = '1';
                    step2.style.transform = 'translateY(0)';
                }, 50);
            }, 300);
            
            showNotification('success', data.message);
        } else {
            document.getElementById('current-password-error').textContent = data.message;
            document.getElementById('current-password-error').classList.remove('hidden');
        }
    } catch (error) {
        showNotification('error', 'Terjadi kesalahan. Silakan coba lagi.');
    } finally {
        btn.disabled = false;
        btn.classList.remove('btn-loading');
        btn.innerHTML = originalText;
    }
});

// Reset password form with animation
function resetPasswordForm() {
    const step2 = document.getElementById('step-verify-otp');
    step2.style.opacity = '0';
    step2.style.transform = 'translateY(-20px)';
    setTimeout(() => {
        step2.classList.add('hidden');
        
        const step1 = document.getElementById('step-request-otp');
        step1.classList.remove('hidden');
        step1.style.opacity = '0';
        step1.style.transform = 'translateY(20px)';
        setTimeout(() => {
            step1.style.opacity = '1';
            step1.style.transform = 'translateY(0)';
        }, 50);
        
        document.getElementById('current_password_otp').value = '';
    }, 300);
}

// Show notification helper
function showNotification(type, message) {
    const notification = document.createElement('div');
    notification.id = 'notification';
    notification.className = 'fixed top-6 right-6 z-50 max-w-md';
    notification.style.opacity = '0';
    notification.style.transform = 'translateX(400px)';
    notification.innerHTML = `
        <div class="notification ${type} bg-white/95 dark:bg-gray-800/95 backdrop-blur-sm rounded-xl shadow-2xl border-2 border-gray-100 dark:border-gray-700 p-5">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="p-3 ${type === 'success' ? 'bg-green-100 dark:bg-green-900/30' : 'bg-red-100 dark:bg-red-900/30'} rounded-xl">
                        <i class="fas ${type === 'success' ? 'fa-check-circle text-green-600 dark:text-green-400' : 'fa-exclamation-circle text-red-600 dark:text-red-400'} text-xl"></i>
                    </div>
                </div>
                <div class="ml-4 flex-1">
                    <h4 class="text-base font-black text-gray-900 dark:text-gray-100">${type === 'success' ? 'Berhasil!' : 'Error!'}</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 font-semibold">${message}</p>
                </div>
                <button onclick="hideNotification()" class="ml-auto text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-2 rounded-lg transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
        </div>
    `;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.opacity = '1';
        notification.style.transform = 'translateX(0)';
    }, 10);
    
    setTimeout(() => hideNotification(), 5000);
}

// Avatar upload preview with animation
document.getElementById('avatar-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Validate file size (2MB)
        if (file.size > 2 * 1024 * 1024) {
            showNotification('error', 'Ukuran file maksimal 2MB');
            this.value = '';
            return;
        }
        
        // Validate file type
        const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        if (!validTypes.includes(file.type)) {
            showNotification('error', 'Format file harus JPG, PNG, atau GIF');
            this.value = '';
            return;
        }
        
        // Preview image with fade animation
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('avatar-preview');
            preview.style.opacity = '0';
            preview.style.transform = 'scale(0.9)';
            setTimeout(() => {
                preview.src = e.target.result;
                preview.style.opacity = '1';
                preview.style.transform = 'scale(1)';
            }, 200);
        };
        reader.readAsDataURL(file);
        
        // Show filename with animation
        const filenameDiv = document.getElementById('avatar-filename');
        filenameDiv.textContent = '📁 ' + file.name;
        filenameDiv.style.opacity = '0';
        filenameDiv.classList.remove('hidden');
        setTimeout(() => {
            filenameDiv.style.opacity = '1';
        }, 100);
    }
});

// Delete avatar function with animation
async function deleteAvatar() {
    if (!confirm('Apakah Anda yakin ingin menghapus foto profil?')) {
        return;
    }
    
    try {
        const response = await fetch('{{ route("profile.avatar.delete") }}', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            const preview = document.getElementById('avatar-preview');
            preview.style.opacity = '0';
            preview.style.transform = 'scale(0.9)';
            setTimeout(() => {
                preview.src = data.avatar_url;
                preview.style.opacity = '1';
                preview.style.transform = 'scale(1)';
            }, 200);
            
            showNotification('success', data.message);
            
            // Reload page to update avatar everywhere
            setTimeout(() => location.reload(), 1500);
        } else {
            showNotification('error', data.message);
        }
    } catch (error) {
        showNotification('error', 'Terjadi kesalahan saat menghapus avatar');
    }
}

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tab content opacity
    document.querySelectorAll('.tab-content').forEach(content => {
        if (!content.classList.contains('hidden')) {
            content.style.opacity = '1';
            content.style.transform = 'translateY(0)';
        }
    });
    
    // OTP input - only numbers
    const otpInput = document.getElementById('otp');
    if (otpInput) {
        otpInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    }
    
    // Phone validation
    const phoneInput = document.getElementById('no_telp');
    if (phoneInput) {
        phoneInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    }
    
    // KTP validation
    const ktpInput = document.getElementById('no_ktp');
    if (ktpInput) {
        ktpInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    }
    
    // Postal code validation
    const postalInput = document.getElementById('kode_pos');
    if (postalInput) {
        postalInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    }
    
    // Password confirmation match
    const passwordInput = document.getElementById('password');
    const confirmPassword = document.getElementById('password_confirmation');
    
    if (confirmPassword && passwordInput) {
        confirmPassword.addEventListener('input', function() {
            if (this.value !== passwordInput.value) {
                this.setCustomValidity('Password tidak cocok');
            } else {
                this.setCustomValidity('');
            }
        });
        
        passwordInput.addEventListener('input', function() {
            if (confirmPassword.value && confirmPassword.value !== this.value) {
                confirmPassword.setCustomValidity('Password tidak cocok');
            } else {
                confirmPassword.setCustomValidity('');
            }
        });
    }
    
    // Delete form confirmation
    const deleteForm = document.getElementById('delete-form');
    if (deleteForm) {
        deleteForm.addEventListener('submit', function(e) {
            const confirmed = confirm('⚠️ PERINGATAN!\n\nAnda akan menghapus akun secara permanen.\nSemua data akan hilang dan tidak dapat dikembalikan.\n\nApakah Anda yakin?');
            if (!confirmed) {
                e.preventDefault();
                return false;
            }
        });
    }
    
    // Prevent double submission with loading state
    let isSubmitting = false;
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (isSubmitting && form.id !== 'form-request-otp') {
                e.preventDefault();
                return false;
            }
            if (form.id !== 'form-request-otp') {
                isSubmitting = true;
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    const originalText = submitBtn.innerHTML;
                    
                    // Add loading animation
                    submitBtn.classList.add('btn-loading');
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
                    
                    setTimeout(() => {
                        isSubmitting = false;
                        submitBtn.disabled = false;
                        submitBtn.classList.remove('btn-loading');
                        submitBtn.innerHTML = originalText;
                    }, 10000);
                }
            }
        });
    });
    
    // Add smooth scroll to error fields
    const firstError = document.querySelector('.border-red-500');
    if (firstError) {
        setTimeout(() => {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstError.focus();
        }, 500);
    }
    
    /* Enhanced form input animations */
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });
    
    // Animate notifications on page load
    const notification = document.getElementById('notification');
    if (notification) {
        notification.style.opacity = '0';
        notification.style.transform = 'translateX(400px)';
        setTimeout(() => {
            notification.style.opacity = '1';
            notification.style.transform = 'translateX(0)';
        }, 300);
    }
});

// Add intersection observer for form groups
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe all form groups for scroll animations
document.querySelectorAll('.form-group').forEach((group, index) => {
    group.style.opacity = '0';
    group.style.transform = 'translateY(20px)';
    group.style.transition = `all 0.5s cubic-bezier(0.16, 1, 0.3, 1) ${index * 0.05}s`;
    observer.observe(group);
});

// Add keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + S to save (if on profile tab)
    if ((e.ctrlKey || e.metaKey) && e.key === 's') {
        e.preventDefault();
        const profileTab = document.getElementById('content-profile');
        if (!profileTab.classList.contains('hidden')) {
            profileTab.querySelector('form').submit();
        }
    }
    
    // Ctrl/Cmd + K to focus search/first input
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        const firstInput = document.querySelector('.tab-content:not(.hidden) input:not([type="hidden"])');
        if (firstInput) firstInput.focus();
    }
});

// Console log
console.log('%c✨ Profile Edit Page with Dark Mode', 'color: #3B82F6; font-size: 20px; font-weight: bold;');
console.log('%c🌓 Dark Mode Support Active!', 'color: #10B981; font-size: 12px;');
</script>
@endpush