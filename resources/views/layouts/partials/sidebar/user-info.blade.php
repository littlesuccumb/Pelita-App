<!-- Expanded State - Full User Info -->
<div x-show="!sidebarCollapsed || window.innerWidth < 1024" 
     x-cloak
     class="user-info-section p-4 border-t border-gray-200 dark:border-gray-700 bg-gradient-to-br from-slate-50 to-gray-50 dark:from-gray-800 dark:to-gray-900">
    <div class="relative overflow-hidden bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-all duration-300">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-gradient-to-br from-slate-500/5 to-indigo-500/5 dark:from-slate-400/5 dark:to-indigo-400/5"></div>
        
        <!-- Main Content -->
        <div class="relative p-4">
            <div class="flex items-center space-x-4">
                <!-- Enhanced Avatar -->
                <div class="flex-shrink-0 relative">
                    @if(Auth::user()->avatar)
                        <div class="w-12 h-12 rounded-xl overflow-hidden shadow-md ring-2 ring-slate-200 dark:ring-slate-600">
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" 
                                 alt="{{ Auth::user()->name }}" 
                                 class="w-full h-full object-cover"
                                 loading="eager"
                                 decoding="sync"
                                 style="image-rendering: -webkit-optimize-contrast; image-rendering: crisp-edges;">
                        </div>
                    @else
                        <div class="w-12 h-12 bg-gradient-to-br from-slate-600 to-slate-700 dark:from-slate-500 dark:to-slate-600 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-md">
                            {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                        </div>
                    @endif
                    <!-- Status Indicator -->
                    <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-emerald-500 rounded-full border-2 border-white dark:border-gray-800 shadow-sm">
                        <div class="w-full h-full bg-emerald-400 rounded-full animate-pulse-smooth"></div>
                    </div>
                </div>
                
                <!-- User Info -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-center space-x-2 mb-1">
                        <p class="text-sm font-bold text-gray-900 dark:text-gray-100 truncate">
                            {{ Auth::user()->name ?? 'User' }}
                        </p>
                        <!-- Role Badge -->
                        @if(Auth::user()?->hasRole('super_admin'))
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-md text-xs font-medium bg-gradient-to-r from-purple-100 to-indigo-100 dark:from-purple-900/50 dark:to-indigo-900/50 text-purple-700 dark:text-purple-300 border border-purple-200 dark:border-purple-700">
                                Super
                            </span>
                        @elseif(Auth::user()?->hasRole('admin'))
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-md text-xs font-medium bg-gradient-to-r from-blue-100 to-indigo-100 dark:from-blue-900/50 dark:to-indigo-900/50 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-700">
                                Admin
                            </span>
                        @elseif(Auth::user()?->hasRole('pengurus_aset'))
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-md text-xs font-medium bg-gradient-to-r from-green-100 to-emerald-100 dark:from-green-900/50 dark:to-emerald-900/50 text-green-700 dark:text-green-300 border border-green-200 dark:border-green-700">
                                Pengurus
                            </span>
                        @else
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded-md text-xs font-medium bg-gradient-to-r from-gray-100 to-slate-100 dark:from-gray-700 dark:to-slate-700 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-600">
                                User
                            </span>
                        @endif
                    </div>
                    
                    <!-- Role Title -->
                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-2 flex items-center truncate">
                        <svg class="w-3 h-3 mr-1 flex-shrink-0 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m8 0v2m0-2a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2m0 0V6"></path>
                        </svg>
                        @if(Auth::user()?->hasRole('super_admin'))
                            Super Administrator
                        @elseif(Auth::user()?->hasRole('admin'))
                            Administrator
                        @elseif(Auth::user()?->hasRole('pengurus_aset'))
                            Pengurus Aset
                        @else
                            Member
                        @endif
                    </p>
                    
                    <!-- Quick Stats -->
                    <div class="flex items-center space-x-3 text-xs text-gray-500 dark:text-gray-400">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-emerald-400 rounded-full mr-1 animate-pulse-smooth"></div>
                            Online
                        </div>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ now()->format('H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Collapsed State - Only Avatar with Tooltip -->
<div x-show="sidebarCollapsed && window.innerWidth >= 1024" 
     x-cloak
     class="user-info-section p-2 border-t border-gray-200 dark:border-gray-700 hidden lg:block">
    <div class="flex justify-center relative group">
        @if(Auth::user()->avatar)
            <div class="w-10 h-10 rounded-lg overflow-hidden shadow-md relative ring-2 ring-slate-200 dark:ring-slate-600 cursor-pointer">
                <img src="{{ Storage::url(Auth::user()->avatar) }}" 
                     alt="{{ Auth::user()->name }}" 
                     class="w-full h-full object-cover"
                     loading="eager"
                     decoding="sync"
                     style="image-rendering: -webkit-optimize-contrast; image-rendering: crisp-edges;">
                <!-- Status Indicator for collapsed state -->
                <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-emerald-500 rounded-full border-2 border-white dark:border-gray-800 shadow-sm z-10">
                    <div class="w-full h-full bg-emerald-400 rounded-full animate-pulse-smooth"></div>
                </div>
            </div>
        @else
            <div class="w-10 h-10 bg-gradient-to-br from-slate-600 to-slate-700 dark:from-slate-500 dark:to-slate-600 rounded-lg flex items-center justify-center text-white font-bold text-sm shadow-md relative cursor-pointer">
                {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                <!-- Status Indicator for collapsed state -->
                <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-emerald-500 rounded-full border-2 border-white dark:border-gray-800 shadow-sm">
                    <div class="w-full h-full bg-emerald-400 rounded-full animate-pulse-smooth"></div>
                </div>
            </div>
        @endif
        
        <!-- Tooltip on Hover (Collapsed State) -->
        <div class="absolute left-full ml-2 bottom-0 min-w-64 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-xl z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 p-4 pointer-events-none group-hover:pointer-events-auto">
            <div class="flex items-center space-x-3 mb-3">
                @if(Auth::user()->avatar)
                    <div class="w-12 h-12 rounded-lg overflow-hidden shadow-md ring-2 ring-slate-200 dark:ring-slate-600 flex-shrink-0">
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" 
                             alt="{{ Auth::user()->name }}" 
                             class="w-full h-full object-cover"
                             loading="eager"
                             decoding="sync"
                             style="image-rendering: -webkit-optimize-contrast; image-rendering: crisp-edges;">
                    </div>
                @else
                    <div class="w-12 h-12 bg-gradient-to-br from-slate-600 to-slate-700 dark:from-slate-500 dark:to-slate-600 rounded-lg flex items-center justify-center text-white font-bold text-lg shadow-md flex-shrink-0">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                    </div>
                @endif
                
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-gray-900 dark:text-gray-100 truncate">
                        {{ Auth::user()->name ?? 'User' }}
                    </p>
                    <p class="text-xs text-gray-600 dark:text-gray-400 truncate">
                        @if(Auth::user()?->hasRole('super_admin'))
                            Super Administrator
                        @elseif(Auth::user()?->hasRole('admin'))
                            Administrator
                        @elseif(Auth::user()?->hasRole('pengurus_aset'))
                            Pengurus Aset
                        @else
                            Member
                        @endif
                    </p>
                </div>
            </div>
            
            <div class="flex items-center justify-between pt-3 border-t border-gray-200 dark:border-gray-700">
                <span class="text-xs text-gray-500 dark:text-gray-400 flex items-center">
                    <div class="w-2 h-2 bg-emerald-400 rounded-full mr-1.5 animate-pulse-smooth"></div>
                    Online
                </span>
                <span class="text-xs text-gray-500 dark:text-gray-400">
                    {{ now()->format('H:i') }}
                </span>
            </div>
        </div>
    </div>
</div>

<style>
/* ============================================
   SMOOTH ANIMATIONS & IMAGE OPTIMIZATION
============================================ */

/* ✅ Fix Layout Shift - Reserve Space */
.user-info-section {
    min-height: 120px; /* Expanded state height */
    will-change: opacity;
    transform: translateZ(0); /* GPU acceleration */
    backface-visibility: hidden;
}

@media (min-width: 1024px) {
    .sidebar.collapsed .user-info-section {
        min-height: 72px; /* Collapsed state height */
    }
}

/* ✅ Smooth Pulse Animation - No Lag */
@keyframes pulse-smooth {
    0%, 100% {
        opacity: 1;
        transform: scale(1);
    }
    50% {
        opacity: 0.6;
        transform: scale(0.98);
    }
}

.animate-pulse-smooth {
    animation: pulse-smooth 2.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

/* ✅ Image Quality Optimization */
.user-info-section img {
    /* High quality rendering */
    image-rendering: -webkit-optimize-contrast;
    image-rendering: crisp-edges;
    
    /* Smooth scaling */
    transform: translateZ(0);
    backface-visibility: hidden;
    
    /* Prevent blur during animation */
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/* ✅ Alpine.js Cloak - Prevent Flash */
[x-cloak] {
    display: none !important;
    opacity: 0 !important;
}

/* ✅ Smooth Transitions */
.user-info-section * {
    transition-property: opacity, transform, background-color, border-color, color;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 200ms;
}

/* ✅ Tooltip Arrow - Collapsed State */
.group:hover > div:last-child::before {
    content: '';
    position: absolute;
    right: 100%;
    top: 20px;
    width: 0;
    height: 0;
    border-top: 6px solid transparent;
    border-bottom: 6px solid transparent;
    border-right: 6px solid;
    border-right-color: inherit;
}

.dark .group:hover > div:last-child::before {
    border-right-color: rgb(31, 41, 55);
}

/* ✅ Prevent Content Jump on Load */
.user-info-section > div {
    opacity: 1;
    animation: fadeInSmooth 0.3s ease-out;
}

@keyframes fadeInSmooth {
    from {
        opacity: 0;
        transform: translateY(5px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ✅ Mobile Optimization */
@media (max-width: 1023px) {
    .lg\:block {
        display: none !important;
    }
    
    .user-info-section {
        min-height: auto; /* Let content determine height on mobile */
    }
}

/* ✅ Reduced Motion Support */
@media (prefers-reduced-motion: reduce) {
    .user-info-section,
    .user-info-section *,
    .animate-pulse-smooth {
        animation: none !important;
        transition: none !important;
    }
}

/* ✅ High Performance Mode - Force GPU */
.user-info-section,
.user-info-section img,
.user-info-section .relative {
    transform: translate3d(0, 0, 0);
    -webkit-transform: translate3d(0, 0, 0);
}

/* ✅ Prevent Text Flash */
.user-info-section p,
.user-info-section span {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-rendering: optimizeLegibility;
}

/* ✅ Status Indicator Smooth Animation */
.user-info-section .bg-emerald-500,
.user-info-section .bg-emerald-400 {
    transition: all 0.3s ease;
}

/* ✅ Avatar Container Optimization */
.user-info-section .rounded-xl,
.user-info-section .rounded-lg {
    overflow: hidden;
    transform: translateZ(0);
    backface-visibility: hidden;
}

/* ✅ Shadow Optimization - No Flicker */
.user-info-section .shadow-sm,
.user-info-section .shadow-md,
.user-info-section .shadow-xl {
    transition: box-shadow 0.2s ease;
}
</style>

<!-- ✅ Preload Critical Images -->
@if(Auth::user()->avatar)
<link rel="preload" as="image" href="{{ Storage::url(Auth::user()->avatar) }}">
@endif