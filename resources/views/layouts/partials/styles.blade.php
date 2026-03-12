<style>
/* ============================================
   CSS VARIABLES & ROOT CONFIGURATION
============================================ */
:root {
    /* Primary Colors */
    --primary-50: #eff6ff;
    --primary-100: #dbeafe;
    --primary-200: #bfdbfe;
    --primary-300: #93c5fd;
    --primary-400: #60a5fa;
    --primary-500: #3b82f6;
    --primary-600: #2563eb;
    --primary-700: #1d4ed8;
    --primary-800: #1e40af;
    --primary-900: #1e3a8a;
    
    /* Gray Colors */
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
    --gray-900: #111827;
    
    /* Semantic Colors */
    --success-500: #10b981;
    --warning-500: #f59e0b;
    --error-500: #ef4444;
    
    /* Layout Sizes */
    --sidebar-width: 280px;
    --sidebar-collapsed-width: 80px;
    --topnav-height: 4rem;
}

/* Dark Mode Variables Override */
.dark {
    --gray-50: #111827;
    --gray-100: #1f2937;
    --gray-200: #374151;
    --gray-300: #4b5563;
    --gray-400: #6b7280;
    --gray-500: #9ca3af;
    --gray-600: #d1d5db;
    --gray-700: #e5e7eb;
    --gray-800: #f3f4f6;
    --gray-900: #f9fafb;
}

/* ============================================
   BASE STYLES
============================================ */

/* ✅ SMOOTH DARK MODE TRANSITION */
html {
    transition: background-color 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

html.theme-switching {
    transition: none !important;
}

html.theme-switching * {
    transition: none !important;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    min-height: 100vh;
    overflow-x: hidden;
}

.dark body {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
}

/* Alpine.js Cloak */
[x-cloak] {
    display: none !important;
}

/* ============================================
   SCROLLBAR CUSTOMIZATION
============================================ */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
    border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(156, 163, 175, 0.3);
    border-radius: 3px;
    transition: background 0.2s ease;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(156, 163, 175, 0.5);
}

.dark .custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(75, 85, 99, 0.5);
}

.dark .custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(75, 85, 99, 0.7);
}

/* ============================================
   GLASS MORPHISM EFFECTS
============================================ */
.glass {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.dark .glass {
    background: rgba(31, 41, 55, 0.95);
    border: 1px solid rgba(255, 255, 255, 0.05);
}

/* ============================================
   SIDEBAR LAYOUT (FLEXBOX)
============================================ */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: var(--sidebar-width);
    background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
    border-right: 1px solid var(--gray-200);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    z-index: 40;
    
    /* Flexbox layout untuk sidebar */
    display: flex !important;
    flex-direction: column !important;
    
    /* ✅ GPU Acceleration for smooth animation */
    will-change: transform, width;
    transform: translateZ(0);
    backface-visibility: hidden;
}

.dark .sidebar {
    background: linear-gradient(180deg, rgb(31, 41, 55) 0%, rgb(17, 24, 39) 100%);
    border-right-color: rgb(55, 65, 81);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
}

/* Collapsed State */
.sidebar.collapsed {
    width: var(--sidebar-collapsed-width);
}

/* Mobile State - Slide from left */
@media (max-width: 1023px) {
    .sidebar {
        transform: translateX(-100%);
        width: var(--sidebar-width) !important; /* Full width di mobile */
    }
    
    .sidebar.mobile-open {
        transform: translateX(0);
    }
}

/* ============================================
   SIDEBAR SECTIONS (FLEXBOX CHILDREN)
============================================ */

/* Brand Section - Fixed at top */
.brand-section {
    flex-shrink: 0 !important;
    border-bottom: 1px solid var(--gray-200);
    transition: all 0.3s ease;
}

.dark .brand-section {
    border-bottom-color: rgb(55, 65, 81);
}

/* Navigation Section - Scrollable content */
.nav-section {
    flex: 1 !important;
    overflow-y: auto;
    overflow-x: hidden;
    padding: 1rem 0;
}

/* User Info Section - Fixed at bottom */
.user-info-section {
    flex-shrink: 0 !important;
    border-top: 1px solid var(--gray-200);
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.dark .user-info-section {
    background: rgba(31, 41, 55, 0.9);
    border-top-color: rgb(55, 65, 81);
}

/* ============================================
   SIDEBAR MENU ITEMS - REDESIGNED ACTIVE STATE
============================================ */

/* Base Menu Item */
.sidebar-item {
    display: flex;
    align-items: center;
    padding: 0.875rem 1rem;
    margin: 0.25rem 0.75rem;
    border-radius: 0.875rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--gray-600);
    text-decoration: none;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    cursor: pointer;
    overflow: hidden;
}

/* Hover State */
.sidebar-item:hover {
    background: var(--primary-50);
    color: var(--primary-600);
    transform: translateX(4px);
}

.dark .sidebar-item:hover {
    background: rgba(59, 130, 246, 0.1);
    color: rgb(96, 165, 250);
}

/* ✨ ACTIVE STATE - MODERN DESIGN */
.sidebar-item.active,
.sidebar-item.bg-blue-50,
.dark .sidebar-item.bg-blue-900\/30 {
    background: linear-gradient(135deg, 
        rgba(59, 130, 246, 0.15) 0%, 
        rgba(37, 99, 235, 0.1) 100%);
    color: var(--primary-600);
    font-weight: 600;
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.15);
    border: 1px solid rgba(59, 130, 246, 0.2);
    transform: translateX(0);
}

.dark .sidebar-item.active,
.dark .sidebar-item.bg-blue-50 {
    background: linear-gradient(135deg, 
        rgba(59, 130, 246, 0.25) 0%, 
        rgba(37, 99, 235, 0.15) 100%);
    color: rgb(147, 197, 253);
    box-shadow: 0 2px 12px rgba(59, 130, 246, 0.3);
    border-color: rgba(59, 130, 246, 0.4);
}

/* Active Indicator - Left Border */
.sidebar-item.active::before,
.sidebar-item.bg-blue-50::before,
.dark .sidebar-item.bg-blue-900\/30::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 60%;
    background: linear-gradient(180deg, 
        var(--primary-500) 0%, 
        var(--primary-600) 100%);
    border-radius: 0 4px 4px 0;
    box-shadow: 0 0 8px rgba(59, 130, 246, 0.5);
}

.dark .sidebar-item.active::before,
.dark .sidebar-item.bg-blue-50::before {
    background: linear-gradient(180deg, 
        rgb(96, 165, 250) 0%, 
        rgb(59, 130, 246) 100%);
    box-shadow: 0 0 12px rgba(96, 165, 250, 0.6);
}

/* Active Icon Enhancement */
.sidebar-item.active .icon,
.sidebar-item.bg-blue-50 .icon,
.dark .sidebar-item.bg-blue-900\/30 .icon {
    color: var(--primary-600);
    filter: drop-shadow(0 2px 4px rgba(59, 130, 246, 0.3));
}

.dark .sidebar-item.active .icon,
.dark .sidebar-item.bg-blue-50 .icon {
    color: rgb(147, 197, 253);
    filter: drop-shadow(0 2px 6px rgba(96, 165, 250, 0.5));
}

/* Glow Effect on Active (Optional - Subtle) */
.sidebar-item.active::after,
.sidebar-item.bg-blue-50::after {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 0.875rem;
    background: radial-gradient(circle at 50% 50%, 
        rgba(59, 130, 246, 0.1) 0%, 
        transparent 70%);
    pointer-events: none;
    opacity: 0;
    animation: pulse-glow 2s ease-in-out infinite;
}

@keyframes pulse-glow {
    0%, 100% {
        opacity: 0;
    }
    50% {
        opacity: 1;
    }
}

/* Remove default hover transform on active */
.sidebar-item.active:hover,
.sidebar-item.bg-blue-50:hover {
    transform: translateX(0);
}

/* Icon Styles */
.sidebar-item .icon {
    width: 20px;
    height: 20px;
    flex-shrink: 0;
    margin-right: 0.75rem;
    transition: all 0.2s ease;
}

/* Text Styles */
.sidebar-item .text {
    transition: all 0.3s ease;
    overflow: hidden;
    white-space: nowrap;
}

/* ============================================
   COLLAPSED SIDEBAR STYLES
============================================ */
.sidebar.collapsed .sidebar-item {
    margin: 0.25rem 0.5rem;
    padding: 0.875rem 0.5rem;
    justify-content: center;
}

.sidebar.collapsed .sidebar-item .icon {
    margin-right: 0;
}

.sidebar.collapsed .sidebar-item .text {
    opacity: 0;
    width: 0;
    margin: 0;
}

/* Hover Transform in Collapsed State */
.sidebar.collapsed .sidebar-item:hover {
    transform: scale(1.05);
}

/* COLLAPSED SIDEBAR ACTIVE STATE */
.sidebar.collapsed .sidebar-item.active,
.sidebar.collapsed .sidebar-item.bg-blue-50 {
    background: linear-gradient(135deg, 
        rgba(59, 130, 246, 0.25) 0%, 
        rgba(37, 99, 235, 0.2) 100%);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

.dark .sidebar.collapsed .sidebar-item.active,
.dark .sidebar.collapsed .sidebar-item.bg-blue-50 {
    background: linear-gradient(135deg, 
        rgba(59, 130, 246, 0.35) 0%, 
        rgba(37, 99, 235, 0.25) 100%);
    box-shadow: 0 4px 16px rgba(59, 130, 246, 0.4);
}

/* Active dot indicator for collapsed state */
.sidebar.collapsed .sidebar-item.active::before,
.sidebar.collapsed .sidebar-item.bg-blue-50::before {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    top: 8px;
    left: 50%;
    transform: translateX(-50%);
    box-shadow: 0 0 12px rgba(59, 130, 246, 0.8);
}

/* ============================================
   COLLAPSED TOOLTIPS
============================================ */
.sidebar.collapsed .sidebar-item[data-tooltip]::after {
    content: attr(data-tooltip);
    position: absolute;
    left: calc(100% + 0.5rem);
    top: 50%;
    transform: translateY(-50%);
    background: var(--gray-800);
    color: white;
    padding: 0.5rem 0.75rem;
    border-radius: 0.5rem;
    font-size: 0.75rem;
    font-weight: 500;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all 0.2s ease;
    z-index: 1000;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
    pointer-events: none;
}

.dark .sidebar.collapsed .sidebar-item[data-tooltip]::after {
    background: rgb(55, 65, 81);
}

.sidebar.collapsed .sidebar-item:hover::after {
    opacity: 1;
    visibility: visible;
    left: calc(100% + 0.75rem);
}

/* ============================================
   DROPDOWN MENUS (SIDEBAR)
============================================ */
.sidebar-dropdown {
    position: relative;
}

.sidebar-dropdown .dropdown-arrow {
    transition: transform 0.3s ease;
}

.sidebar.collapsed .sidebar-dropdown .text,
.sidebar.collapsed .sidebar-dropdown .dropdown-arrow {
    opacity: 0;
    width: 0;
    margin: 0;
}

/* Collapsed Dropdown Tooltip */
.collapsed-dropdown {
    position: absolute;
    left: calc(100% + 0.5rem);
    top: 0;
    min-width: 12rem;
    background: white;
    border: 1px solid var(--gray-200);
    border-radius: 0.75rem;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    z-index: 1000;
    overflow: hidden;
}

.dark .collapsed-dropdown {
    background: rgb(31, 41, 55);
    border-color: rgb(55, 65, 81);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3), 0 4px 6px -2px rgba(0, 0, 0, 0.2);
}

/* Hide collapsed dropdown when sidebar not collapsed */
.sidebar:not(.collapsed) .collapsed-dropdown {
    display: none !important;
}

/* Submenu Styles */
.submenu {
    margin-left: 2.25rem;
    margin-top: 0.25rem;
    padding-left: 0.5rem;
}

.submenu-item {
    display: block;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    color: var(--gray-600);
    border-radius: 0.5rem;
    transition: all 0.15s ease;
    text-decoration: none;
}

.submenu-item:hover {
    background: var(--primary-100);
    color: var(--primary-600);
}

.dark .submenu-item:hover {
    background: rgba(59, 130, 246, 0.1);
    color: rgb(96, 165, 250);
}

/* SUBMENU ACTIVE STATE */
.submenu-item.active,
.submenu-item.bg-blue-100 {
    background: linear-gradient(135deg, 
        rgba(59, 130, 246, 0.2) 0%, 
        rgba(37, 99, 235, 0.15) 100%);
    color: var(--primary-600);
    font-weight: 600;
    border-left: 3px solid var(--primary-500);
    padding-left: calc(1rem - 3px);
}

.dark .submenu-item.active,
.dark .submenu-item.bg-blue-100 {
    background: linear-gradient(135deg, 
        rgba(59, 130, 246, 0.3) 0%, 
        rgba(37, 99, 235, 0.2) 100%);
    color: rgb(147, 197, 253);
    border-left-color: rgb(96, 165, 250);
}

/* ============================================
   MAIN CONTENT AREA
============================================ */
.main-content {
    margin-left: var(--sidebar-width);
    width: calc(100% - var(--sidebar-width));
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.main-content.expanded {
    margin-left: var(--sidebar-collapsed-width);
    width: calc(100% - var(--sidebar-collapsed-width));
}

/* Mobile: Full width */
@media (max-width: 1023px) {
    .main-content,
    .main-content.expanded {
        margin-left: 0 !important;
        width: 100% !important;
    }
}

/* ============================================
   TOP NAVIGATION BAR
============================================ */
.top-nav {
    height: var(--topnav-height);
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--gray-200);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 0;
    z-index: 30;
    
    /* ✅ GPU Acceleration */
    will-change: transform;
    transform: translateZ(0);
    backface-visibility: hidden;
}

.dark .top-nav {
    background: rgba(31, 41, 55, 0.95);
    border-bottom-color: rgb(55, 65, 81);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
}

/* Mobile topnav adjustment */
@media (max-width: 640px) {
    .top-nav {
        height: 3.5rem;
    }
    
    /* ✅ Reduce blur on mobile for better performance */
    .top-nav {
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }
}

/* Navigation Buttons */
.nav-button {
    padding: 0.75rem;
    border-radius: 0.75rem;
    color: var(--gray-500);
    transition: all 0.2s ease;
    background: transparent;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.nav-button:hover {
    background: var(--gray-100);
    color: var(--gray-700);
}

.dark .nav-button:hover {
    background: rgb(55, 65, 81);
    color: rgb(229, 231, 235);
}

/* ============================================
   DROPDOWNS (GENERAL)
============================================ */
.dropdown {
    position: absolute;
    top: calc(100% + 0.5rem);
    right: 0;
    min-width: 16rem;
    background: white;
    border: 1px solid var(--gray-200);
    border-radius: 1rem;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    z-index: 50;
    overflow: hidden;
}

.dark .dropdown {
    background: rgb(31, 41, 55);
    border-color: rgb(55, 65, 81);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
}

.dropdown-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    color: var(--gray-700);
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.dropdown-item:hover {
    background: var(--gray-50);
    color: var(--primary-600);
}

.dark .dropdown-item {
    color: rgb(229, 231, 235);
}

.dark .dropdown-item:hover {
    background: rgb(55, 65, 81);
    color: rgb(96, 165, 250);
}

/* ============================================
   USER AVATAR
============================================ */
.user-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-600) 100%);
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 0.875rem;
    box-shadow: 0 4px 8px rgba(59, 130, 246, 0.3);
    overflow: hidden;
    flex-shrink: 0;
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* ============================================
   NOTIFICATION BADGE
============================================ */
.notification-badge {
    position: absolute;
    top: -4px;
    right: -4px;
    min-width: 20px;
    height: 20px;
    padding: 0 6px;
    background: linear-gradient(135deg, var(--error-500) 0%, #dc2626 100%);
    color: white;
    font-size: 0.75rem;
    font-weight: 700;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid white;
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
}

.dark .notification-badge {
    border-color: rgb(31, 41, 55);
}

/* ============================================
   STATUS INDICATORS
============================================ */
.status-online {
    display: inline-flex;
    align-items: center;
    font-size: 0.875rem;
    color: var(--gray-600);
}

.status-dot {
    width: 8px;
    height: 8px;
    background: var(--success-500);
    border-radius: 50%;
    margin-right: 0.5rem;
    animation: pulse-dot 2s infinite;
}

@keyframes pulse-dot {
    0%, 100% { 
        opacity: 1; 
        transform: scale(1);
    }
    50% { 
        opacity: 0.5;
        transform: scale(0.95);
    }
}

/* ============================================
   ALERTS & NOTIFICATIONS
============================================ */
.alert {
    padding: 1rem 1.25rem;
    border-radius: 1rem;
    margin-bottom: 1.5rem;
    border: 1px solid;
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
}

.alert-success {
    background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    border-color: var(--success-500);
    color: #166534;
}

.dark .alert-success {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(16, 185, 129, 0.05) 100%);
    border-color: rgb(16, 185, 129);
    color: rgb(134, 239, 172);
}

.alert-error {
    background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
    border-color: var(--error-500);
    color: #991b1b;
}

.dark .alert-error {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%);
    border-color: rgb(239, 68, 68);
    color: rgb(252, 165, 165);
}

.alert-warning {
    background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
    border-color: var(--warning-500);
    color: #92400e;
}

.dark .alert-warning {
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(245, 158, 11, 0.05) 100%);
    border-color: rgb(245, 158, 11);
    color: rgb(253, 230, 138);
}

/* ============================================
   FOOTER
============================================ */
.footer-wrapper {
    margin-left: var(--sidebar-width);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    width: calc(100% - var(--sidebar-width));
}

.footer-wrapper.expanded {
    margin-left: var(--sidebar-collapsed-width);
    width: calc(100% - var(--sidebar-collapsed-width));
}

.footer {
    width: 100%;
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border-top: 1px solid var(--gray-200);
    margin-top: auto;
}

.dark .footer {
    background: linear-gradient(135deg, rgb(31, 41, 55) 0%, rgb(17, 24, 39) 100%);
    border-top-color: rgb(55, 65, 81);
}

@media (max-width: 1023px) {
    .footer-wrapper,
    .footer-wrapper.expanded {
        margin-left: 0 !important;
        width: 100% !important;
    }
}

/* ============================================
   MOBILE OVERLAY
============================================ */
.mobile-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 30;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    -webkit-tap-highlight-color: transparent;
}

.dark .mobile-overlay {
    background: rgba(0, 0, 0, 0.7);
}

.mobile-overlay.open {
    opacity: 1;
    visibility: visible;
}

@media (min-width: 1024px) {
    .mobile-overlay {
        display: none !important;
    }
}

/* ============================================
   MOBILE OPTIMIZATIONS FOR SIDEBAR
============================================ */
@media (max-width: 1023px) {
    .sidebar-item {
        padding: 1rem;
        margin: 0.375rem 1rem;
    }
    
    .sidebar-item.active,
    .sidebar-item.bg-blue-50 {
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
    }
    
    /* Larger touch target */
    .sidebar-item {
        min-height: 48px;
    }
}

/* ============================================
   ACCESSIBILITY
============================================ */
.sidebar-item:focus-visible {
    outline: 2px solid var(--primary-500);
    outline-offset: 2px;
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    .sidebar-item.active,
    .sidebar-item.bg-blue-50 {
        border: 2px solid var(--primary-600);
        background: var(--primary-100);
    }
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
    .sidebar-item,
    .sidebar-item::before,
    .sidebar-item::after {
        transition: none;
        animation: none;
    }
}

/* ============================================
   UTILITY CLASSES
============================================ */

/* Text Gradient */
.text-gradient {
    background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-800) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Brand Gradient */
.brand-gradient {
    background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-700) 100%);
}

/* Fade In Animation */
.fade-in {
    animation: fadeIn 0.5s ease-out forwards;
}

@keyframes fadeIn {
    from { 
        opacity: 0; 
        transform: translateY(10px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

/* Smooth Transitions */
* {
    -webkit-tap-highlight-color: transparent;
}

/* Focus Visible for Accessibility */
*:focus-visible {
    outline: 2px solid var(--primary-500);
    outline-offset: 2px;
    border-radius: 0.25rem;
}

/* ============================================
   RESPONSIVE BREAKPOINTS SUMMARY
============================================ */

/* Mobile: < 640px */
/* Tablet: 640px - 1023px */
/* Desktop: >= 1024px */
/* Large Desktop: >= 1280px */

/* ============================================
   PRINT STYLES
============================================ */
@media print {
    .sidebar,
    .top-nav,
    .footer,
    .mobile-overlay {
        display: none !important;
    }
    
    .main-content,
    .main-content.expanded {
        margin-left: 0 !important;
        width: 100% !important;
    }
}
</style>