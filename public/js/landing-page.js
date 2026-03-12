/**
 * Landing Page JavaScript - Pelita App
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS (Animate On Scroll)
    AOS.init({
        duration: 800,
        once: true,
        offset: 100,
        easing: 'ease-out-cubic'
    });

    // Counter Animation Class
    class ProfessionalCounter {
        constructor(element, options = {}) {
            this.element = element;
            this.endValue = parseInt(element.getAttribute('data-value') || 0);
            this.options = {
                duration: options.duration || 2.5,
                useEasing: true,
                useGrouping: true,
                separator: '.',
                ...options
            };
            this.hasAnimated = false;
        }

        init() {
            this.countUp = new countUp.CountUp(this.element, this.endValue, {
                duration: this.options.duration,
                useEasing: this.options.useEasing,
                useGrouping: this.options.useGrouping,
                separator: this.options.separator
            });

            if (!this.countUp.error) {
                this.setupObserver();
            } else {
                this.element.textContent = this.endValue;
            }
        }

        setupObserver() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !this.hasAnimated) {
                        this.startAnimation();
                    }
                });
            }, {
                threshold: 0.3,
                rootMargin: '0px 0px -100px 0px'
            });

            observer.observe(this.element);
        }

        startAnimation() {
            if (this.hasAnimated) return;
            
            this.hasAnimated = true;
            const statsCard = this.element.closest('.stats-card');
            
            if (statsCard) {
                statsCard.classList.add('counting');
            }
            
            setTimeout(() => {
                this.countUp.start(() => {
                    if (statsCard) {
                        statsCard.classList.remove('counting');
                    }
                });
            }, 200);
        }
    }

    // Initialize counters
    const counterElements = document.querySelectorAll('.counter-number');
    counterElements.forEach((element, index) => {
        const counter = new ProfessionalCounter(element, {
            duration: 2 + (index * 0.2)
        });
        counter.init();
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            
            // Skip if href is just "#"
            if (href === '#') {
                e.preventDefault();
                return;
            }
            
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Parallax effect for floating orbs
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                const scrolled = window.pageYOffset;
                const parallaxElements = document.querySelectorAll('.animate-float-slow, .animate-float-slower');
                
                parallaxElements.forEach((el, index) => {
                    const speed = 0.3 + (index * 0.1);
                    el.style.transform = `translateY(${scrolled * speed}px)`;
                });
                
                ticking = false;
            });
            ticking = true;
        }
    });

    // Product card hover effects
    const productCards = document.querySelectorAll('.product-card');
    productCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.zIndex = '200';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.zIndex = '1';
        });
    });

    // Lazy loading for images (optional performance boost)
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        imageObserver.unobserve(img);
                    }
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // Console welcome message
    console.log('%c🎉 Welcome to Pelita App! ', 'background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%); color: white; padding: 10px 20px; font-size: 16px; font-weight: bold; border-radius: 8px;');
    console.log('%cBuilt with ❤️ using Laravel & Tailwind CSS', 'color: #6366f1; font-size: 12px;');
});