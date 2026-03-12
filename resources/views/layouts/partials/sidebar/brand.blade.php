<div class="p-6 border-b border-gray-200 dark:border-gray-700">
    <div class="flex items-center" :class="{ 'justify-center': sidebarCollapsed && window.innerWidth >= 1024 }">
        <!-- Logo -->
        <div class="w-12 h-12 flex items-center justify-center flex-shrink-0">
            <img src="/images/logo ctp.png" alt="Pelita App Logo" class="w-12 h-12 object-contain">
        </div>
        
        <!-- Brand Text - Hide saat collapsed di desktop, tapi tetap show di mobile -->
        <div x-show="!sidebarCollapsed || window.innerWidth < 1024" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-x-4"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 -translate-x-4"
             class="ml-3 overflow-hidden">
            <h1 class="text-xl font-bold text-gradient dark:text-white whitespace-nowrap">Pelita App</h1>
            <p class="text-xs text-gray-500 dark:text-gray-400 font-medium whitespace-nowrap">Asset Management System</p>
        </div>
        
        <!-- Close Button (Mobile Only) -->
        <button @click="mobileMenuOpen = false" 
                class="ml-auto lg:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
</div>

<style>
/* Gradient text effect */
.text-gradient {
    background: linear-gradient(135deg, #0EA5E9 0%, #3B82F6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.dark .text-gradient {
    background: linear-gradient(135deg, #60A5FA 0%, #93C5FD 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
</style>