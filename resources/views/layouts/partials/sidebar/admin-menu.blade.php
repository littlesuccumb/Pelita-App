<!-- Peminjaman Menu (Admin) -->
<a href="{{ route('admin.peminjaman.index') }}" 
   @click="if (window.innerWidth < 1024) mobileMenuOpen = false"
   class="sidebar-item group flex items-center w-full p-3 text-gray-700 dark:text-gray-300 
          hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 
          rounded-lg transition-all relative
          {{ request()->routeIs('admin.peminjaman.*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-semibold' : '' }}"
   x-data="{ showTooltip: false }"
   @mouseenter="if (sidebarCollapsed && window.innerWidth >= 1024) showTooltip = true"
   @mouseleave="showTooltip = false">
   
    <!-- Icon -->
    <div class="flex-shrink-0">
        <svg class="icon w-5 h-5 {{ request()->routeIs('admin.peminjaman.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400' }}" 
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
        </svg>
    </div>
    
    <!-- Text - Hide saat collapsed di desktop -->
    <span x-show="!sidebarCollapsed || window.innerWidth < 1024" 
          x-transition:enter="transition ease-out duration-200"
          x-transition:enter-start="opacity-0"
          x-transition:enter-end="opacity-100"
          x-transition:leave="transition ease-in duration-150"
          x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0"
          class="text ml-3 whitespace-nowrap">
        Peminjaman
    </span>
    
    <!-- Tooltip untuk collapsed state (Desktop only) -->
    <div x-show="showTooltip" 
         x-transition
         class="absolute left-full ml-2 px-3 py-2 bg-gray-900 dark:bg-gray-700 text-white text-sm rounded-lg 
                whitespace-nowrap z-50 hidden lg:block pointer-events-none">
        Peminjaman
        <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 
                    border-t-4 border-t-transparent
                    border-b-4 border-b-transparent  
                    border-r-4 border-r-gray-900 dark:border-r-gray-700"></div>
    </div>
</a>

<!-- Permohonan Menu (Admin) -->
<a href="{{ route('admin.permohonan.index') }}" 
   @click="if (window.innerWidth < 1024) mobileMenuOpen = false"
   class="sidebar-item group flex items-center w-full p-3 text-gray-700 dark:text-gray-300 
          hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 
          rounded-lg transition-all relative
          {{ request()->routeIs('admin.permohonan.*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-semibold' : '' }}"
   x-data="{ showTooltip: false }"
   @mouseenter="if (sidebarCollapsed && window.innerWidth >= 1024) showTooltip = true"
   @mouseleave="showTooltip = false">
   
    <!-- Icon -->
    <div class="flex-shrink-0">
        <svg class="icon w-5 h-5 {{ request()->routeIs('admin.permohonan.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400' }}" 
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
    </div>
    
    <!-- Text -->
    <span x-show="!sidebarCollapsed || window.innerWidth < 1024" 
          x-transition:enter="transition ease-out duration-200"
          x-transition:enter-start="opacity-0"
          x-transition:enter-end="opacity-100"
          x-transition:leave="transition ease-in duration-150"
          x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0"
          class="text ml-3 whitespace-nowrap">
        Permohonan
    </span>
    
    <!-- Tooltip -->
    <div x-show="showTooltip" 
         x-transition
         class="absolute left-full ml-2 px-3 py-2 bg-gray-900 dark:bg-gray-700 text-white text-sm rounded-lg 
                whitespace-nowrap z-50 hidden lg:block pointer-events-none">
        Permohonan
        <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 
                    border-t-4 border-t-transparent
                    border-b-4 border-b-transparent  
                    border-r-4 border-r-gray-900 dark:border-r-gray-700"></div>
    </div>
</a>

<!-- Pembayaran Menu (Admin) -->
<a href="{{ route('admin.pembayaran.index') }}" 
   @click="if (window.innerWidth < 1024) mobileMenuOpen = false"
   class="sidebar-item group flex items-center w-full p-3 text-gray-700 dark:text-gray-300 
          hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 
          rounded-lg transition-all relative
          {{ request()->routeIs('admin.pembayaran.*') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-semibold' : '' }}"
   x-data="{ showTooltip: false }"
   @mouseenter="if (sidebarCollapsed && window.innerWidth >= 1024) showTooltip = true"
   @mouseleave="showTooltip = false">
   
    <!-- Icon -->
    <div class="flex-shrink-0">
        <svg class="icon w-5 h-5 {{ request()->routeIs('admin.pembayaran.*') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400' }}" 
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
        </svg>
    </div>
    
    <!-- Text -->
    <span x-show="!sidebarCollapsed || window.innerWidth < 1024" 
          x-transition:enter="transition ease-out duration-200"
          x-transition:enter-start="opacity-0"
          x-transition:enter-end="opacity-100"
          x-transition:leave="transition ease-in duration-150"
          x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0"
          class="text ml-3 whitespace-nowrap">
        Pembayaran
    </span>
    
    <!-- Tooltip -->
    <div x-show="showTooltip" 
         x-transition
         class="absolute left-full ml-2 px-3 py-2 bg-gray-900 dark:bg-gray-700 text-white text-sm rounded-lg 
                whitespace-nowrap z-50 hidden lg:block pointer-events-none">
        Pembayaran
        <div class="absolute right-full top-1/2 -translate-y-1/2 w-0 h-0 
                    border-t-4 border-t-transparent
                    border-b-4 border-b-transparent  
                    border-r-4 border-r-gray-900 dark:border-r-gray-700"></div>
    </div>
</a>

<style>
/* Smooth transitions untuk sidebar items */
.sidebar-item {
    overflow: visible !important;
}

/* Active state enhancement */
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

/* Mobile: auto-close sidebar setelah klik */
@media (max-width: 1023px) {
    .sidebar-item {
        -webkit-tap-highlight-color: transparent;
    }
}
</style>