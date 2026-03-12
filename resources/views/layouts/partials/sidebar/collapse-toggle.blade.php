<div class="hidden lg:block p-4 border-t border-gray-200 dark:border-gray-700">
    <button @click="sidebarCollapsed = !sidebarCollapsed; localStorage.setItem('sidebarCollapsed', sidebarCollapsed.toString())" 
            class="w-full p-2 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all duration-200 flex items-center justify-center group"
            :title="sidebarCollapsed ? 'Expand Sidebar' : 'Collapse Sidebar'">
        <!-- Collapse Icon (show when expanded) -->
        <svg x-show="!sidebarCollapsed" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 rotate-180"
             x-transition:enter-end="opacity-100 rotate-0"
             class="w-5 h-5" 
             fill="none" 
             stroke="currentColor" 
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
        </svg>
        
        <!-- Expand Icon (show when collapsed) -->
        <svg x-show="sidebarCollapsed" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -rotate-180"
             x-transition:enter-end="opacity-100 rotate-0"
             class="w-5 h-5" 
             fill="none" 
             stroke="currentColor" 
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
        </svg>
    </button>
</div>

<style>
/* Hover effect untuk collapse button */
.group:hover svg {
    transform: scale(1.1);
    transition: transform 0.2s ease;
}

/* Ensure button is hidden on mobile */
@media (max-width: 1023px) {
    .lg\:block {
        display: none !important;
    }
}
</style>