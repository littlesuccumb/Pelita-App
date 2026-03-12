<!-- Peminjaman Menu -->
<div class="relative group" data-tooltip="Peminjaman">
    <a href="{{ route('admin.peminjaman.index') }}" 
       class="sidebar-item flex items-center w-full p-3 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all 
        {{ request()->routeIs('admin.peminjaman.*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-semibold' : '' }}">
        <svg class="icon w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.peminjaman.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
        </svg>
        <span class="text ml-3"
              x-show="!sidebarCollapsed || window.innerWidth < 1024"
              x-transition>Peminjaman</span>
    </a>

    <!-- Tooltip collapsed -->
    <div class="collapsed-dropdown absolute left-full top-0 ml-2 min-w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 hidden lg:block"
         :class="{ 'lg:hidden': !sidebarCollapsed }">
        <div class="p-2">
            <div class="font-medium text-gray-800 dark:text-gray-200 px-3 py-2">Peminjaman</div>
        </div>
    </div>
</div>

<!-- Permohonan Menu -->
<div class="relative group" data-tooltip="Permohonan">
    <a href="{{ route('admin.permohonan.index') }}" 
       class="sidebar-item flex items-center w-full p-3 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all 
        {{ request()->routeIs('admin.permohonan.*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-semibold' : '' }}">
        <svg class="icon w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.permohonan.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <span class="text ml-3"
              x-show="!sidebarCollapsed || window.innerWidth < 1024"
              x-transition>Permohonan</span>
    </a>

    <!-- Tooltip collapsed -->
    <div class="collapsed-dropdown absolute left-full top-0 ml-2 min-w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 hidden lg:block"
         :class="{ 'lg:hidden': !sidebarCollapsed }">
        <div class="p-2">
            <div class="font-medium text-gray-800 dark:text-gray-200 px-3 py-2">Permohonan</div>
        </div>
    </div>
</div>

<!-- Pembayaran Menu -->
<div class="relative group" data-tooltip="Pembayaran">
    <a href="{{ route('admin.pembayaran.index') }}" 
       class="sidebar-item flex items-center w-full p-3 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all 
        {{ request()->routeIs('admin.pembayaran.*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-semibold' : '' }}">
        <svg class="icon w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.pembayaran.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
        <span class="text ml-3"
              x-show="!sidebarCollapsed || window.innerWidth < 1024"
              x-transition>Pembayaran</span>
    </a>

    <!-- Tooltip collapsed -->
    <div class="collapsed-dropdown absolute left-full top-0 ml-2 min-w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 hidden lg:block"
         :class="{ 'lg:hidden': !sidebarCollapsed }">
        <div class="p-2">
            <div class="font-medium text-gray-800 dark:text-gray-200 px-3 py-2">Pembayaran</div>
        </div>
    </div>
</div>

<!-- Manajemen Barang (dengan dropdown) -->
<div x-data="{ open: {{ request()->routeIs('admin.barang.*') || request()->routeIs('admin.kategori-barang.*') || request()->routeIs('admin.maintenance.*') ? 'true' : 'false' }} }" 
     class="relative sidebar-dropdown" 
     data-tooltip="Manajemen Barang">
    <button @click="open = !open" 
            class="sidebar-item flex items-center justify-between w-full p-3 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all 
            {{ request()->routeIs('admin.barang.*') || request()->routeIs('admin.kategori-barang.*') || request()->routeIs('admin.maintenance.*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-semibold' : '' }}">
        <div class="flex items-center">
            <svg class="icon w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.barang.*') || request()->routeIs('admin.kategori-barang.*') || request()->routeIs('admin.maintenance.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            <span class="text ml-3"
                  x-show="!sidebarCollapsed || window.innerWidth < 1024"
                  x-transition>Manajemen Barang</span>
        </div>
        <svg class="dropdown-arrow w-4 h-4 flex-shrink-0 transition-transform duration-300" 
             :class="{ 'rotate-180': open }" 
             x-show="!sidebarCollapsed || window.innerWidth < 1024"
             x-transition
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    
    <!-- Submenu -->
    <div x-show="open && (!sidebarCollapsed || window.innerWidth < 1024)" 
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 max-h-0"
         x-transition:enter-end="opacity-100 max-h-96"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 max-h-96"
         x-transition:leave-end="opacity-0 max-h-0"
         class="submenu mt-2 space-y-1 overflow-hidden">
        <a href="{{ route('admin.kategori-barang.index') }}" 
           class="submenu-item flex items-center px-4 py-2.5 ml-9 text-sm text-gray-600 dark:text-gray-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all {{ request()->routeIs('admin.kategori-barang.*') ? 'bg-blue-50 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 font-medium' : '' }}">
            <i class="fas fa-layer-group w-4 text-xs"></i>
            <span class="ml-3">Kategori Barang</span>
        </a>
        <a href="{{ route('admin.barang.index') }}" 
           class="submenu-item flex items-center px-4 py-2.5 ml-9 text-sm text-gray-600 dark:text-gray-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all {{ request()->routeIs('admin.barang.*') ? 'bg-blue-50 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 font-medium' : '' }}">
            <i class="fas fa-boxes w-4 text-xs"></i>
            <span class="ml-3">Daftar Barang</span>
        </a>
        <a href="{{ route('admin.maintenance.index') }}" 
           class="submenu-item flex items-center px-4 py-2.5 ml-9 text-sm text-gray-600 dark:text-gray-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all {{ request()->routeIs('admin.maintenance.*') ? 'bg-blue-50 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 font-medium' : '' }}">
            <i class="fas fa-tools w-4 text-xs"></i>
            <span class="ml-3">Maintenance</span>
        </a>
    </div>

    <!-- Dropdown collapsed -->
    <div class="collapsed-dropdown absolute left-full top-0 ml-2 min-w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 hidden lg:block"
         :class="{ 'lg:hidden': !sidebarCollapsed }">
        <div class="py-2">
            <div class="font-medium text-gray-800 dark:text-gray-200 px-3 py-2 border-b border-gray-100 dark:border-gray-700 mb-1">
                <i class="fas fa-box mr-2"></i>
                Manajemen Barang
            </div>
            <a href="{{ route('admin.kategori-barang.index') }}" class="flex items-center px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 rounded transition-all {{ request()->routeIs('admin.kategori-barang.*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-medium' : '' }}">
                <i class="fas fa-layer-group w-4 text-xs"></i>
                <span class="ml-2">Kategori Barang</span>
            </a>
            <a href="{{ route('admin.barang.index') }}" class="flex items-center px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 rounded transition-all {{ request()->routeIs('admin.barang.*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-medium' : '' }}">
                <i class="fas fa-boxes w-4 text-xs"></i>
                <span class="ml-2">Daftar Barang</span>
            </a>
            <a href="{{ route('admin.maintenance.index') }}" class="flex items-center px-3 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 rounded transition-all {{ request()->routeIs('admin.maintenance.*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-medium' : '' }}">
                <i class="fas fa-tools w-4 text-xs"></i>
                <span class="ml-2">Maintenance</span>
            </a>
        </div>
    </div>
</div>

<!-- Kelola User Menu -->
<div class="relative group" data-tooltip="Kelola User">
    <a href="{{ route('admin.users.index') }}" 
       @click="if (window.innerWidth < 1024) mobileMenuOpen = false"
       class="sidebar-item flex items-center w-full p-3 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all 
        {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-semibold' : '' }}">
        <svg class="icon w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.users.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
        </svg>
        <span class="text ml-3"
              x-show="!sidebarCollapsed || window.innerWidth < 1024"
              x-transition>Kelola User</span>
    </a>

    <!-- Tooltip collapsed -->
    <div class="collapsed-dropdown absolute left-full top-0 ml-2 min-w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 hidden lg:block"
         :class="{ 'lg:hidden': !sidebarCollapsed }">
        <div class="p-2">
            <div class="font-medium text-gray-800 dark:text-gray-200 px-3 py-2">Kelola User</div>
        </div>
    </div>
</div>

<style>
/* Active state indicator */
.sidebar-item.bg-blue-50::before,
.dark .sidebar-item.bg-blue-900\/30::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 70%;
    background: currentColor;
    border-radius: 0 4px 4px 0;
}

/* Submenu styling */
.submenu {
    position: relative;
}

.submenu::before {
    content: '';
    position: absolute;
    left: 28px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: rgba(14, 165, 233, 0.2);
}

.dark .submenu::before {
    background: rgba(96, 165, 250, 0.15);
}

.submenu-item {
    position: relative;
}

.submenu-item.bg-blue-50::before,
.dark .submenu-item.bg-blue-900\/40::before {
    content: '';
    position: absolute;
    left: -28px;
    top: 50%;
    transform: translateY(-50%);
    width: 8px;
    height: 8px;
    background: currentColor;
    border-radius: 50%;
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
}

.dark .submenu-item.bg-blue-900\/40::before {
    box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.1);
}

.submenu-item:hover {
    transform: translateX(2px);
}

/* Collapsed dropdown visibility */
@media (min-width: 1024px) {
    .sidebar.collapsed .collapsed-dropdown {
        display: block;
    }
    
    .sidebar:not(.collapsed) .collapsed-dropdown {
        display: none !important;
    }
}

@media (max-width: 1023px) {
    .collapsed-dropdown {
        display: none !important;
    }
}
</style>