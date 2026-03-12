<!-- Mobile Backdrop Overlay -->
<div x-show="mobileMenuOpen" 
     x-cloak
     @click="mobileMenuOpen = false"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 bg-black/50 dark:bg-black/70 z-30 lg:hidden">
</div>

<!-- Sidebar -->
<aside class="sidebar fixed top-0 left-0 h-screen z-40
              bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 
              transition-all duration-300 ease-in-out
              -translate-x-full lg:translate-x-0 flex flex-col" 
       :class="{ 
           'collapsed': sidebarCollapsed && window.innerWidth >= 1024,
           '!translate-x-0': mobileMenuOpen
       }">
    
    <!-- Brand Header -->
    <div class="brand-section flex-shrink-0 border-b border-gray-200 dark:border-gray-700">
        @include('layouts.partials.sidebar.brand')
    </div>

    <!-- Navigation Menu - Scrollable -->
    <nav class="nav-section flex-1 p-4 space-y-2 overflow-y-auto overflow-x-hidden custom-scrollbar">
        <!-- Dashboard -->
        @include('layouts.partials.sidebar.dashboard-link')

        <!-- Admin Menu -->
        @if(Auth::user()?->hasRole('admin'))
            @include('layouts.partials.sidebar.admin-menu')
        @endif

        <!-- Super Admin Menu -->
        @if(Auth::user()?->hasRole('super_admin'))
            @include('layouts.partials.sidebar.super-admin-menu')
        @endif

        <!-- Pengurus Aset Menu -->
        @if(Auth::user()?->hasRole('pengurus_aset'))
            @include('layouts.partials.sidebar.pengurus_aset-menu')
        @endif
    </nav>

    <!-- Sidebar Footer - User Info - Sticky at bottom -->
    <div class="user-info-section flex-shrink-0 border-t border-gray-200 dark:border-gray-700">
        @include('layouts.partials.sidebar.user-info')
    </div>

</aside>

<style>
/* ===== PREVENT FOUC (Flash of Unstyled Content) ===== */
[x-cloak] {
    display: none !important;
}

/* ===== SIDEBAR BASE STYLES ===== */
.sidebar {
    width: 280px;
}

.sidebar.collapsed {
    width: 80px;
}

/* ===== CENTER ITEMS WHEN COLLAPSED ===== */
.sidebar.collapsed .sidebar-item {
    justify-content: center !important;
}

.sidebar.collapsed .logout-btn {
    justify-content: center !important;
}

/* ===== LOGOUT BUTTON STYLES ===== */
.logout-btn {
    position: relative;
}

.logout-btn:hover {
    transform: translateX(2px);
}

.logout-btn:active {
    transform: scale(0.98);
}

.sidebar.collapsed .logout-btn:hover {
    transform: none;
}

/* ===== MOBILE RESPONSIVE ===== */
@media (max-width: 1023px) {
    .sidebar {
        width: 280px !important;
    }
    
    .sidebar.collapsed {
        width: 280px !important;
    }
    
    .sidebar.\!translate-x-0 {
        transform: translateX(0) !important;
    }
}

/* ===== CUSTOM SCROLLBAR ===== */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(156, 163, 175, 0.3);
    border-radius: 3px;
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
</style>