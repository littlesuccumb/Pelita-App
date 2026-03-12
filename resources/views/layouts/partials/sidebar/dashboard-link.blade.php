<div class="relative group" data-tooltip="Dashboard">
    <a href="{{ route('dashboard') }}" 
       class="sidebar-item flex items-center w-full p-3 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:text-blue-600 dark:hover:text-blue-400 rounded-lg transition-all {{ request()->routeIs('dashboard') ? 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 font-semibold' : '' }}">
        <svg class="icon w-5 h-5 flex-shrink-0 {{ request()->routeIs('dashboard') ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
        </svg>
        <span class="text ml-3"
              x-show="!sidebarCollapsed || window.innerWidth < 1024"
              x-transition:enter="transition ease-out duration-200"
              x-transition:enter-start="opacity-0"
              x-transition:enter-end="opacity-100"
              x-transition:leave="transition ease-in duration-150"
              x-transition:leave-start="opacity-100"
              x-transition:leave-end="opacity-0">Dashboard</span>
    </a>

    <!-- Tooltip untuk collapsed sidebar (Desktop only) -->
    <div class="collapsed-dropdown absolute left-full top-0 ml-2 min-w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 hidden lg:block"
         :class="{ 'lg:hidden': !sidebarCollapsed }">
        <div class="p-2">
            <div class="font-medium text-gray-800 dark:text-gray-200 px-3 py-2">Dashboard</div>
        </div>
    </div>
</div>

<style>
/* Active state indicator untuk dashboard */
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
}
</style>