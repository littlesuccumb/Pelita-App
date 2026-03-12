<!-- Kategori Barang Menu (Pengurus Aset) -->
<div class="relative group" data-tooltip="Kategori Barang">
    <a href="{{ route('admin.kategori-barang.index') }}" 
       @click="if (window.innerWidth < 1024) mobileMenuOpen = false"
       class="sidebar-item flex items-center w-full p-3 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all 
        {{ request()->routeIs('admin.kategori-barang.*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-semibold' : '' }}">
        <svg class="icon w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.kategori-barang.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
        </svg>
        <span class="text ml-3"
              x-show="!sidebarCollapsed || window.innerWidth < 1024"
              x-transition:enter="transition ease-out duration-200"
              x-transition:enter-start="opacity-0"
              x-transition:enter-end="opacity-100"
              x-transition:leave="transition ease-in duration-150"
              x-transition:leave-start="opacity-100"
              x-transition:leave-end="opacity-0">Kategori Barang</span>
    </a>

    <!-- Tooltip untuk collapsed sidebar (Desktop only) -->
    <div class="collapsed-dropdown absolute left-full top-0 ml-2 min-w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 hidden lg:block"
         :class="{ 'lg:hidden': !sidebarCollapsed }">
        <div class="p-2">
            <div class="font-medium text-gray-800 dark:text-gray-200 px-3 py-2">Kategori Barang</div>
        </div>
    </div>
</div>

<!-- Barang Menu (Pengurus Aset) -->
<div class="relative group" data-tooltip="Barang">
    <a href="{{ route('admin.barang.index') }}" 
       @click="if (window.innerWidth < 1024) mobileMenuOpen = false"
       class="sidebar-item flex items-center w-full p-3 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all 
        {{ request()->routeIs('admin.barang.*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-semibold' : '' }}">
        <svg class="icon w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.barang.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
        </svg>
        <span class="text ml-3"
              x-show="!sidebarCollapsed || window.innerWidth < 1024"
              x-transition:enter="transition ease-out duration-200"
              x-transition:enter-start="opacity-0"
              x-transition:enter-end="opacity-100"
              x-transition:leave="transition ease-in duration-150"
              x-transition:leave-start="opacity-100"
              x-transition:leave-end="opacity-0">Barang</span>
    </a>

    <!-- Tooltip untuk collapsed sidebar (Desktop only) -->
    <div class="collapsed-dropdown absolute left-full top-0 ml-2 min-w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 hidden lg:block"
         :class="{ 'lg:hidden': !sidebarCollapsed }">
        <div class="p-2">
            <div class="font-medium text-gray-800 dark:text-gray-200 px-3 py-2">Barang</div>
        </div>
    </div>
</div>

<!-- Maintenance Menu (Pengurus Aset) -->
<div class="relative group" data-tooltip="Maintenance">
    <a href="{{ route('admin.maintenance.index') }}" 
       @click="if (window.innerWidth < 1024) mobileMenuOpen = false"
       class="sidebar-item flex items-center w-full p-3 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all 
        {{ request()->routeIs('admin.maintenance.*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-semibold' : '' }}">
        <svg class="icon w-5 h-5 flex-shrink-0 {{ request()->routeIs('admin.maintenance.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
        </svg>
        <span class="text ml-3"
              x-show="!sidebarCollapsed || window.innerWidth < 1024"
              x-transition:enter="transition ease-out duration-200"
              x-transition:enter-start="opacity-0"
              x-transition:enter-end="opacity-100"
              x-transition:leave="transition ease-in duration-150"
              x-transition:leave-start="opacity-100"
              x-transition:leave-end="opacity-0">Maintenance</span>
    </a>

    <!-- Tooltip untuk collapsed sidebar (Desktop only) -->
    <div class="collapsed-dropdown absolute left-full top-0 ml-2 min-w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 hidden lg:block"
         :class="{ 'lg:hidden': !sidebarCollapsed }">
        <div class="p-2">
            <div class="font-medium text-gray-800 dark:text-gray-200 px-3 py-2">Maintenance</div>
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

/* Mobile tap highlight */
@media (max-width: 1023px) {
    .sidebar-item {
        -webkit-tap-highlight-color: transparent;
    }
    
    .collapsed-dropdown {
        display: none !important;
    }
}

/* Desktop collapsed tooltip */
@media (min-width: 1024px) {
    .sidebar.collapsed .collapsed-dropdown {
        display: block;
    }
    
    .sidebar:not(.collapsed) .collapsed-dropdown {
        display: none !important;
    }
}
</style>