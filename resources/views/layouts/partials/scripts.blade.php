<script>
document.addEventListener('DOMContentLoaded', function() {
    // ============================================
    // AOS Animation Initialization
    // ============================================
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 600,
            once: true,
            offset: 50,
            easing: 'ease-out-cubic',
            disable: 'mobile'
        });
    }

    // ============================================
    // Alert Auto-Hide with Smooth Animation
    // ============================================
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px) scale(0.95)';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });

    // ============================================
    // Keyboard Shortcuts
    // ============================================
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + K for search
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            const searchInput = document.querySelector('.search-input');
            if (searchInput) {
                searchInput.focus();
            }
        }

        // Ctrl/Cmd + D for Dashboard
        if ((e.ctrlKey || e.metaKey) && e.key === 'd') {
            e.preventDefault();
            window.location.href = '{{ route("dashboard") }}';
        }

        // Ctrl/Cmd + P for Profile
        if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
            e.preventDefault();
            window.location.href = '{{ route("profile.index") }}';
        }

        // Escape key to close dropdowns and mobile menu
        if (e.key === 'Escape') {
            // Close Alpine.js dropdowns
            document.querySelectorAll('[x-data]').forEach(element => {
                if (element.__x && element.__x.$data.open !== undefined) {
                    element.__x.$data.open = false;
                }
                // Close mobile menu
                if (element.__x && element.__x.$data.mobileMenuOpen !== undefined) {
                    element.__x.$data.mobileMenuOpen = false;
                }
            });
        }

        // Alt + Left Arrow for back navigation
        if (e.altKey && e.key === 'ArrowLeft') {
            e.preventDefault();
            if (typeof goBack === 'function') {
                goBack();
            }
        }
    });

    // ============================================
    // Form Submit Loading States
    // ============================================
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn && !submitBtn.disabled) {
                const originalText = submitBtn.textContent;
                submitBtn.textContent = 'Memproses...';
                submitBtn.disabled = true;
                
                // Reset after 10 seconds as fallback
                setTimeout(() => {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                }, 10000);
            }
        });
    });
});

// ============================================
// ENHANCED THEME MANAGER CLASS WITH ANIMATION
// ============================================
class ThemeManager {
    constructor() {
        this.theme = this.getStoredTheme() || 'light'; // DEFAULT: Light mode
        this.init();
    }

    init() {
        // Apply theme immediately to prevent flash
        this.applyTheme(this.theme);
        
        // Listen for system theme changes
        this.watchSystemTheme();
        
        // Listen for storage changes (sync across tabs)
        this.watchStorageChanges();
    }

    getStoredTheme() {
        try {
            return localStorage.getItem('color-theme');
        } catch (error) {
            console.warn('Unable to access localStorage for theme preference');
            return null;
        }
    }

    getSystemTheme() {
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            return 'dark';
        }
        return 'light';
    }

    setTheme(theme) {
        this.theme = theme;
        
        try {
            localStorage.setItem('color-theme', theme);
        } catch (error) {
            console.warn('Unable to save theme preference to localStorage');
        }
        
        this.applyTheme(theme);
        
        // Dispatch custom event for other components
        window.dispatchEvent(new CustomEvent('themeChanged', { 
            detail: { theme } 
        }));
    }

    applyTheme(theme) {
        const html = document.documentElement;
        
        // Add theme-switching class to disable transitions temporarily
        html.classList.add('theme-switching');
        
        if (theme === 'dark') {
            html.classList.add('dark');
        } else {
            html.classList.remove('dark');
        }
        
        // Update meta theme-color for mobile browsers
        this.updateMetaThemeColor(theme);
        
        // Remove theme-switching class after theme is applied
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                html.classList.remove('theme-switching');
            });
        });
    }

    updateMetaThemeColor(theme) {
        let metaThemeColor = document.querySelector('meta[name="theme-color"]');
        
        if (!metaThemeColor) {
            metaThemeColor = document.createElement('meta');
            metaThemeColor.name = 'theme-color';
            document.head.appendChild(metaThemeColor);
        }
        
        // Set theme color based on current theme
        const color = theme === 'dark' ? '#1f2937' : '#ffffff';
        metaThemeColor.content = color;
    }

    toggleTheme() {
        const newTheme = this.theme === 'dark' ? 'light' : 'dark';
        this.setTheme(newTheme);
        return newTheme;
    }

    watchSystemTheme() {
        if (!window.matchMedia) return;
        
        const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
        
        const handleChange = (e) => {
            // Only auto-switch if user hasn't set a manual preference
            if (!this.getStoredTheme()) {
                this.setTheme(e.matches ? 'dark' : 'light');
            }
        };

        // Modern browsers
        if (mediaQuery.addEventListener) {
            mediaQuery.addEventListener('change', handleChange);
        } else if (mediaQuery.addListener) {
            // Fallback for older browsers
            mediaQuery.addListener(handleChange);
        }
    }

    watchStorageChanges() {
        window.addEventListener('storage', (e) => {
            if (e.key === 'color-theme' && e.newValue) {
                this.theme = e.newValue;
                this.applyTheme(e.newValue);
            }
        });
    }

    // Get current theme
    getCurrentTheme() {
        return this.theme;
    }

    // Check if current theme is dark
    isDark() {
        return this.theme === 'dark';
    }
}

// ============================================
// INITIALIZE THEME MANAGER
// ============================================
const themeManager = new ThemeManager();

// Make it available globally
window.themeManager = themeManager;

// ✅ ENHANCED: Global toggle function with animation support
window.toggleDarkMode = function() {
    return themeManager.toggleTheme();
};

// ✅ NEW: Enhanced toggle with SMOOTH ROLLING animation (called from topnav)
window.toggleDarkModeWithAnimation = function(button) {
    const html = document.documentElement;
    const slider = button.querySelector('.toggle-slider');
    const ripple = button.querySelector('.ripple-effect');
    const isDark = html.classList.contains('dark');
    
    // Trigger ripple effect
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
    
    // ✅ SMOOTH ROLLING ANIMATION - slider bergelinding pelan seperti bola
    if (slider) {
        const isMobile = button.id === 'theme-toggle-mobile';
        const distance = isMobile ? 38 : (window.innerWidth >= 640 ? 64 : 52);
        
        // Calculate rotation: jarak / keliling lingkaran * 360°
        const circumference = Math.PI * 24; // diameter = 24px
        const rotations = (distance / circumference) * 360;
        
        // Add rolling class for smooth animation
        slider.classList.add('rolling');
        
        if (isDark) {
            // Rolling back to light (kanan ke kiri) - rotate counter-clockwise
            slider.style.transform = `translateX(0) rotate(-${rotations}deg)`;
        } else {
            // Rolling to dark (kiri ke kanan) - rotate clockwise
            slider.style.transform = `translateX(${distance}px) rotate(${rotations}deg)`;
        }
        
        // Remove rolling class and reset rotation after animation (increased to 900ms)
        setTimeout(() => {
            slider.classList.remove('rolling');
            // Keep position but reset rotation to 0
            if (!isDark) {
                slider.style.transform = `translateX(${distance}px) rotate(0deg)`;
            } else {
                slider.style.transform = 'translateX(0) rotate(0deg)';
            }
        }, 900);
    }
    
    // Toggle theme using ThemeManager
    themeManager.toggleTheme();
};

// ============================================
// ALPINE.JS INTEGRATION
// ============================================
document.addEventListener('alpine:init', () => {
    // Theme Manager Data
    Alpine.data('themeManager', () => ({
        darkMode: themeManager.isDark(),
        
        toggleTheme() {
            const newTheme = themeManager.toggleTheme();
            this.darkMode = newTheme === 'dark';
        },
        
        init() {
            // Listen for theme changes
            window.addEventListener('themeChanged', (e) => {
                this.darkMode = e.detail.theme === 'dark';
            });
        }
    }));

    // Sidebar State Manager
    Alpine.data('sidebarManager', () => ({
        sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
        mobileMenuOpen: false,

        toggleSidebar() {
            this.sidebarCollapsed = !this.sidebarCollapsed;
            localStorage.setItem('sidebarCollapsed', this.sidebarCollapsed);
        },

        toggleMobileMenu() {
            this.mobileMenuOpen = !this.mobileMenuOpen;
            
            // Prevent body scroll when mobile menu is open
            if (this.mobileMenuOpen) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        },

        closeMobileMenu() {
            this.mobileMenuOpen = false;
            document.body.style.overflow = '';
        },

        init() {
            // Close mobile menu on window resize to desktop size
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024 && this.mobileMenuOpen) {
                    this.closeMobileMenu();
                }
            });

            // Restore collapsed state from localStorage
            const savedState = localStorage.getItem('sidebarCollapsed');
            if (savedState !== null) {
                this.sidebarCollapsed = savedState === 'true';
            }
        }
    }));

    // Dropdown Manager
    Alpine.data('dropdownManager', (initialState = false) => ({
        open: initialState,

        toggle() {
            this.open = !this.open;
        },

        close() {
            this.open = false;
        },

        init() {
            // Close on outside click
            this.$watch('open', value => {
                if (value) {
                    // Add event listener for outside clicks
                    setTimeout(() => {
                        const closeOnOutside = (e) => {
                            if (!this.$el.contains(e.target)) {
                                this.close();
                                document.removeEventListener('click', closeOnOutside);
                            }
                        };
                        document.addEventListener('click', closeOnOutside);
                    }, 10);
                }
            });
        }
    }));
});

// ============================================
// UTILITY FUNCTIONS
// ============================================

// Smooth Scroll to Element
window.scrollToElement = function(elementId, offset = 80) {
    const element = document.getElementById(elementId);
    if (element) {
        const elementPosition = element.getBoundingClientRect().top + window.pageYOffset;
        const offsetPosition = elementPosition - offset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
    }
};

// Copy to Clipboard
window.copyToClipboard = function(text, successMessage = 'Copied to clipboard!') {
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(text).then(() => {
            console.log(successMessage);
        }).catch(err => {
            console.error('Failed to copy:', err);
        });
    } else {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.opacity = '0';
        document.body.appendChild(textArea);
        textArea.select();
        try {
            document.execCommand('copy');
            console.log(successMessage);
        } catch (err) {
            console.error('Failed to copy:', err);
        }
        document.body.removeChild(textArea);
    }
};

// Format Number with Thousand Separator
window.formatNumber = function(number) {
    return new Intl.NumberFormat('id-ID').format(number);
};

// Format Currency (IDR)
window.formatCurrency = function(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
};

// Debounce Function
window.debounce = function(func, wait = 300) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
};

// ============================================
// PERFORMANCE MONITORING (Optional)
// ============================================
if (window.performance && window.performance.timing) {
    window.addEventListener('load', () => {
        setTimeout(() => {
            const perfData = window.performance.timing;
            const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
            console.log(`⚡ Page Load Time: ${pageLoadTime}ms`);
        }, 0);
    });
}

// ============================================
// CONSOLE BRANDING (Optional)
// ============================================
if (console && console.log) {
    const styles = [
        'color: #3b82f6',
        'font-size: 14px',
        'font-weight: bold',
        'text-shadow: 1px 1px 2px rgba(0,0,0,0.2)'
    ].join(';');
    
    console.log('%c🚀 Pelita App | Asset Management System', styles);
    console.log('%c📱 Fully Responsive | Made with ❤️', 'color: #6b7280; font-size: 12px;');
    console.log('%c🎨 Enhanced Dark Mode Toggle with Smooth Animation', 'color: #10b981; font-size: 12px;');
}

// Export for ES6 modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { ThemeManager, themeManager };
}
</script>