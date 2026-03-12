<header class="top-nav sticky top-0 z-30 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 shadow-sm">
    <div class="flex items-center justify-between h-16 px-3 sm:px-4 lg:px-8">
        <!-- Left Side -->
        <div class="flex items-center space-x-2 md:space-x-4">
            <!-- Mobile Menu Button (Hamburger) -->
            <button @click="mobileMenuOpen = true" 
                    class="p-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors lg:hidden"
                    aria-label="Open menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <!-- Desktop Sidebar Toggle -->
            <button @click="sidebarCollapsed = !sidebarCollapsed; localStorage.setItem('sidebarCollapsed', sidebarCollapsed.toString())" 
                    class="p-2 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors hidden lg:block"
                    :title="sidebarCollapsed ? 'Expand sidebar' : 'Collapse sidebar'"
                    aria-label="Toggle sidebar">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <!-- Modern Dark/Light Mode Toggle - DESKTOP VERSION -->
            <button onclick="toggleDarkModeWithAnimation(this)" 
                    id="theme-toggle-desktop"
                    class="relative group overflow-visible transition-all duration-300 hidden md:flex"
                    title="Toggle dark mode"
                    aria-label="Toggle dark mode">
                
                <!-- Background Gradient Glow Effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 via-orange-400 to-pink-400 opacity-0 group-hover:opacity-20 dark:from-blue-400 dark:via-purple-400 dark:to-pink-400 blur-xl transition-opacity duration-500"></div>
                
                <!-- Main Toggle Container -->
                <div class="relative flex items-center justify-center w-20 sm:w-24 h-8 bg-gray-200 dark:bg-gray-700 rounded-full p-1 transition-all duration-500 shadow-inner">
                    
                    <!-- Sliding Background with Rolling Animation -->
                    <div class="toggle-slider absolute left-1 w-6 h-6 bg-gradient-to-br from-yellow-400 to-orange-500 dark:from-blue-400 dark:to-purple-600 rounded-full shadow-lg transition-all duration-500 ease-out">
                        <div class="absolute inset-0 rounded-full bg-white opacity-30"></div>
                        <!-- Rotating marker for visual rolling effect -->
                        <div class="rolling-marker absolute top-1/2 left-1/2 w-1 h-3 -ml-0.5 -mt-1.5 bg-white/40 rounded-full"></div>
                    </div>
                    
                    <!-- Sun Icon -->
                    <div class="sun-icon relative z-10 w-6 h-6 transition-all duration-500">
                        <svg class="w-full h-full text-yellow-600 dark:text-gray-500 transition-all duration-500" 
                             fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" 
                                  clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    
                    <!-- Moon Icon -->
                    <div class="moon-icon relative z-10 w-6 h-6 ml-auto transition-all duration-500">
                        <svg class="w-full h-full text-gray-500 dark:text-blue-300 transition-all duration-500" 
                             fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <div class="absolute -top-1 -right-1 w-1 h-1 bg-yellow-300 rounded-full opacity-0 dark:opacity-100 transition-opacity duration-500 animate-pulse"></div>
                        <div class="absolute top-0 -left-2 w-0.5 h-0.5 bg-blue-300 rounded-full opacity-0 dark:opacity-100 transition-opacity duration-700 animate-pulse delay-100"></div>
                    </div>
                </div>
                
                <!-- Click Ripple Effect -->
                <div class="ripple-effect absolute inset-0 rounded-full bg-white opacity-0 scale-0 pointer-events-none"></div>
            </button>
        </div>

        <!-- Right Side -->
        <div class="flex items-center space-x-2 sm:space-x-3 md:space-x-4">
            <!-- Mobile Dark/Light Mode Toggle -->
            <button onclick="toggleDarkModeWithAnimation(this)" 
                    id="theme-toggle-mobile"
                    class="relative group overflow-visible transition-all duration-300 md:hidden flex items-center justify-center"
                    title="Toggle dark mode"
                    aria-label="Toggle dark mode">
                
                <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 via-orange-400 to-pink-400 opacity-0 group-hover:opacity-20 dark:from-blue-400 dark:via-purple-400 dark:to-pink-400 blur-xl transition-opacity duration-500"></div>
                
                <div class="relative flex items-center justify-center w-16 h-7 bg-gray-200 dark:bg-gray-700 rounded-full p-0.5 transition-all duration-500 shadow-inner">
                    <div class="toggle-slider absolute left-0.5 w-6 h-6 bg-gradient-to-br from-yellow-400 to-orange-500 dark:from-blue-400 dark:to-purple-600 rounded-full shadow-lg transition-all duration-500 ease-out">
                        <div class="absolute inset-0 rounded-full bg-white opacity-30"></div>
                        <!-- Rotating marker for visual rolling effect -->
                        <div class="rolling-marker absolute top-1/2 left-1/2 w-1 h-3 -ml-0.5 -mt-1.5 bg-white/40 rounded-full"></div>
                    </div>
                    
                    <div class="sun-icon relative z-10 w-5 h-5 transition-all duration-500">
                        <svg class="w-full h-full text-yellow-600 dark:text-gray-500 transition-all duration-500" 
                             fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" 
                                  clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    
                    <div class="moon-icon relative z-10 w-5 h-5 ml-auto transition-all duration-500">
                        <svg class="w-full h-full text-gray-500 dark:text-blue-300 transition-all duration-500" 
                             fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <div class="absolute -top-0.5 -right-0.5 w-0.5 h-0.5 bg-yellow-300 rounded-full opacity-0 dark:opacity-100 transition-opacity duration-500 animate-pulse"></div>
                    </div>
                </div>
                
                <div class="ripple-effect absolute inset-0 rounded-full bg-white opacity-0 scale-0 pointer-events-none"></div>
            </button>

            <!-- Professional Real-time Clock -->
            <div class="hidden sm:flex items-center space-x-4">
                <!-- Time Display -->
                <div class="flex items-center space-x-1.5">
                    <!-- Hour -->
                    <div class="flex items-center space-x-0.5">
                        <span class="professional-digit" id="hour-tens">0</span>
                        <span class="professional-digit" id="hour-ones">0</span>
                    </div>
                    
                    <!-- Separator -->
                    <span class="professional-separator">:</span>
                    
                    <!-- Minute -->
                    <div class="flex items-center space-x-0.5">
                        <span class="professional-digit" id="minute-tens">0</span>
                        <span class="professional-digit" id="minute-ones">0</span>
                    </div>
                    
                    <!-- Separator -->
                    <span class="professional-separator">:</span>
                    
                    <!-- Second -->
                    <div class="flex items-center space-x-0.5">
                        <span class="professional-digit" id="second-tens">0</span>
                        <span class="professional-digit" id="second-ones">0</span>
                    </div>
                    
                    <!-- Period (AM/PM) -->
                    <span class="professional-period" id="period">AM</span>
                </div>

                <!-- Divider -->
                <div class="h-8 w-px bg-gray-300 dark:bg-gray-600"></div>

                <!-- Date Display -->
                <div class="flex flex-col justify-center">
                    <span class="professional-day" id="day-name">Monday</span>
                    <span class="professional-date" id="date-display">10 Des 2025</span>
                </div>
            </div>

            <!-- Notifications -->
            @include('layouts.partials.topnav.notifications')

            <!-- User Menu -->
            @include('layouts.partials.topnav.user-menu')
        </div>
    </div>
</header>

<!-- JavaScript for Real-time Clock & Enhanced Dark Mode Toggle -->
<script>
    // Enhanced Real-time Date & Time
    function updateDateTime() {
        const now = new Date();
        
        // Get time components
        let hours = now.getHours();
        const minutes = now.getMinutes();
        const seconds = now.getSeconds();
        const period = hours >= 12 ? 'PM' : 'AM';
        
        // Convert to 12-hour format
        hours = hours % 12;
        hours = hours ? hours : 12;
        
        // Format with leading zeros
        const hourStr = hours.toString().padStart(2, '0');
        const minuteStr = minutes.toString().padStart(2, '0');
        const secondStr = seconds.toString().padStart(2, '0');
        
        // Update digits
        updateDigit('hour-tens', hourStr[0]);
        updateDigit('hour-ones', hourStr[1]);
        updateDigit('minute-tens', minuteStr[0]);
        updateDigit('minute-ones', minuteStr[1]);
        updateDigit('second-tens', secondStr[0]);
        updateDigit('second-ones', secondStr[1]);
        
        // Update period
        const periodElement = document.getElementById('period');
        if (periodElement && periodElement.textContent !== period) {
            periodElement.textContent = period;
        }
        
        // Update date
        const dayName = now.toLocaleDateString('id-ID', { weekday: 'long' });
        const dateStr = now.toLocaleDateString('id-ID', { 
            day: 'numeric',
            month: 'short', 
            year: 'numeric' 
        });
        
        const dayNameElement = document.getElementById('day-name');
        const dateElement = document.getElementById('date-display');
        
        if (dayNameElement) dayNameElement.textContent = dayName;
        if (dateElement) dateElement.textContent = dateStr;
    }

    // Update individual digit
    function updateDigit(elementId, newValue) {
        const element = document.getElementById(elementId);
        if (element && element.textContent !== newValue) {
            element.textContent = newValue;
        }
    }

    // Initialize clock
    if (document.getElementById('hour-tens')) {
        updateDateTime();
        setInterval(updateDateTime, 1000);
    }

    // ✅ ENHANCED DARK MODE TOGGLE WITH SMOOTH ROLLING ANIMATION
    function toggleDarkModeWithAnimation(button) {
        const html = document.documentElement;
        const slider = button.querySelector('.toggle-slider');
        const ripple = button.querySelector('.ripple-effect');
        const isDark = html.classList.contains('dark');
        
        // ✅ Trigger ripple effect
        if (ripple) {
            ripple.style.opacity = '0.6';
            ripple.style.transform = 'scale(0)';
            
            requestAnimationFrame(() => {
                ripple.style.transition = 'all 0.8s cubic-bezier(0.34, 1.56, 0.64, 1)';
                ripple.style.opacity = '0';
                ripple.style.transform = 'scale(2.5)';
            });
            
            setTimeout(() => {
                ripple.style.transition = 'none';
                ripple.style.opacity = '0';
                ripple.style.transform = 'scale(0)';
            }, 800);
        }
        
        // ✅ SMOOTH ROLLING ANIMATION
        if (slider) {
            const isMobile = button.id === 'theme-toggle-mobile';
            const distance = isMobile ? 38 : (window.innerWidth >= 640 ? 64 : 52);
            const circumference = Math.PI * 24;
            const rotations = (distance / circumference) * 360;
            
            slider.classList.add('rolling');
            
            if (isDark) {
                slider.style.transform = `translateX(0) rotate(-${rotations}deg)`;
            } else {
                slider.style.transform = `translateX(${distance}px) rotate(${rotations}deg)`;
            }
            
            setTimeout(() => {
                slider.classList.remove('rolling');
                if (!isDark) {
                    slider.style.transform = `translateX(${distance}px) rotate(0deg)`;
                } else {
                    slider.style.transform = 'translateX(0) rotate(0deg)';
                }
            }, 900);
        }
        
        html.classList.add('theme-switching');

        if (isDark) {
            html.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            html.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
        
        setTimeout(() => {
            html.classList.remove('theme-switching');
        }, 50);
    }

    // Initialize theme
    (function initTheme() {
        const html = document.documentElement;
        html.classList.add('transition-colors', 'duration-500');

        const savedTheme = localStorage.getItem('color-theme');
        
        if (savedTheme === 'dark') {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }
    })();
</script>

<style>
    /* ============================================
       ENHANCED TOGGLE ANIMATION STYLES
    ============================================ */
    
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .animate-spin-slow {
        animation: spin-slow 3s linear infinite;
    }
    
    .toggle-slider {
        transition: transform 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        transform-origin: center center;
    }
    
    .toggle-slider.rolling {
        transition: transform 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    
    html.dark #theme-toggle-desktop .toggle-slider {
        transform: translateX(52px) rotate(0deg);
    }

    @media (min-width: 640px) {
        html.dark #theme-toggle-desktop .toggle-slider {
            transform: translateX(64px) rotate(0deg);
        }
    }

    html.dark #theme-toggle-mobile .toggle-slider {
        transform: translateX(38px) rotate(0deg);
    }
    
    html:not(.dark) #theme-toggle-desktop .toggle-slider {
        transform: translateX(0) rotate(0deg);
    }
    
    html:not(.dark) #theme-toggle-mobile .toggle-slider {
        transform: translateX(0) rotate(0deg);
    }
    
    @keyframes ripple {
        0% {
            opacity: 0.6;
            transform: scale(0);
        }
        100% {
            opacity: 0;
            transform: scale(2.5);
        }
    }

    html:not(.dark) .sun-icon svg {
        transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    html:not(.dark) .sun-icon:hover svg {
        transform: rotate(180deg) scale(1.1);
    }

    html.dark .moon-icon svg {
        animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-4px); }
    }

    @keyframes pulse-glow {
        0%, 100% { 
            box-shadow: 0 0 5px rgba(96, 165, 250, 0.3);
        }
        50% { 
            box-shadow: 0 0 20px rgba(96, 165, 250, 0.6);
        }
    }
    
    html.dark .toggle-slider {
        animation: pulse-glow 2s ease-in-out infinite;
    }

    html:not(.dark) #theme-toggle-desktop:hover .moon-icon svg,
    html:not(.dark) #theme-toggle-mobile:hover .moon-icon svg {
        filter: drop-shadow(0 0 8px rgba(59, 130, 246, 0.8))
                drop-shadow(0 0 12px rgba(59, 130, 246, 0.6))
                drop-shadow(0 0 16px rgba(59, 130, 246, 0.4));
        transform: scale(1.1);
        transition: all 0.3s ease;
    }
    
    html.dark #theme-toggle-desktop:hover .sun-icon svg,
    html.dark #theme-toggle-mobile:hover .sun-icon svg {
        filter: drop-shadow(0 0 8px rgba(251, 191, 36, 0.8))
                drop-shadow(0 0 12px rgba(251, 191, 36, 0.6))
                drop-shadow(0 0 16px rgba(251, 191, 36, 0.4));
        transform: scale(1.1);
        transition: all 0.3s ease;
    }
    
    html:not(.dark) #theme-toggle-desktop:hover .moon-icon svg,
    html:not(.dark) #theme-toggle-mobile:hover .moon-icon svg {
        color: #3b82f6 !important;
    }
    
    html.dark #theme-toggle-desktop:hover .sun-icon svg,
    html.dark #theme-toggle-mobile:hover .sun-icon svg {
        color: #fbbf24 !important;
    }

    /* ============================================
       PROFESSIONAL CLOCK STYLES
    ============================================ */
    
    /* Professional Digit Styling */
    .professional-digit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 22px;
        height: auto;
        font-size: 20px;
        font-weight: 600;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
        color: #1f2937;
        transition: color 0.2s ease;
    }

    .dark .professional-digit {
        color: #f9fafb;
    }

    /* Professional Separator */
    .professional-separator {
        font-size: 20px;
        font-weight: 600;
        color: #6b7280;
        margin: 0 1px;
        animation: blink 2s ease-in-out infinite;
    }

    .dark .professional-separator {
        color: #9ca3af;
    }

    @keyframes blink {
        0%, 49%, 100% { opacity: 1; }
        50%, 99% { opacity: 0.3; }
    }

    /* Professional Period (AM/PM) */
    .professional-period {
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        margin-left: 4px;
        text-transform: uppercase;
    }

    .dark .professional-period {
        color: #9ca3af;
    }

    /* Professional Day */
    .professional-day {
        font-size: 10px;
        font-weight: 500;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        line-height: 1.2;
    }

    .dark .professional-day {
        color: #9ca3af;
    }

    /* Professional Date */
    .professional-date {
        font-size: 13px;
        font-weight: 600;
        color: #1f2937;
        line-height: 1.2;
    }

    .dark .professional-date {
        color: #f9fafb;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .professional-digit {
            min-width: 18px;
            font-size: 18px;
        }
        
        .professional-separator {
            font-size: 18px;
        }
        
        .professional-period {
            font-size: 11px;
        }
        
        .professional-day {
            font-size: 9px;
        }
        
        .professional-date {
            font-size: 12px;
        }
    }

    @media (max-width: 640px) {
        .top-nav {
            height: 3.5rem;
        }
    }
</style>