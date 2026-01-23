import './bootstrap';

import Alpine from 'alpinejs';
import { gsap } from 'gsap';

// Make GSAP available globally
window.gsap = gsap;

// Note: Using Intersection Observer for scroll animations (works great, no premium plugins needed)
// ScrollTrigger can be added later if premium GSAP license is available

// Initialize Alpine
window.Alpine = Alpine;
Alpine.start();

// Initialize Lucide icons (helper function)
function initLucideIcons() {
    // Try multiple times in case CDN loads after DOM ready
    if (typeof lucide !== 'undefined' && lucide.createIcons) {
        lucide.createIcons();
        return true;
    }
    return false;
}

// Initialize animations on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    // Initialize Lucide icons (if available)
    if (!initLucideIcons()) {
        // Retry after a short delay in case CDN is still loading
        setTimeout(() => {
            initLucideIcons();
        }, 100);
    }
    
    // Initialize scroll animations
    initScrollAnimations();
    
    // Initialize counter animations
    initCounterAnimations();
    
    // Hero section specific animations
    initHeroAnimations();
});

// Re-initialize icons when new content is added (for dynamic content)
window.initLucideIcons = initLucideIcons;

/**
 * Initialize scroll-triggered animations using Intersection Observer
 * (Works great and doesn't require premium GSAP plugins)
 */
function initScrollAnimations() {
    initIntersectionObserverAnimations();
}

/**
 * Fallback animation system using Intersection Observer
 */
function initIntersectionObserverAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -15% 0px',
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const element = entry.target;
                
                if (element.classList.contains('fade-in-on-scroll')) {
                    gsap.to(element, {
                        opacity: 1,
                        y: 0,
                        duration: 1,
                        ease: 'power3.out',
                    });
                }
                
                if (element.classList.contains('slide-up-on-scroll')) {
                    gsap.to(element, {
                        opacity: 1,
                        y: 0,
                        duration: 1,
                        ease: 'power3.out',
                    });
                }
                
                observer.unobserve(element);
            }
        });
    }, observerOptions);

    // Observe all animation elements - More visible
    document.querySelectorAll('.fade-in-on-scroll, .slide-up-on-scroll').forEach((el) => {
        gsap.set(el, { opacity: 0, y: 50 });
        observer.observe(el);
    });

    // Handle stagger animations
    document.querySelectorAll('.stagger-on-scroll').forEach((container) => {
        const items = container.querySelectorAll('.stagger-item');
        items.forEach((item) => {
            gsap.set(item, { opacity: 0, y: 30 });
        });
        
        const containerObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    gsap.to(items, {
                        opacity: 1,
                        y: 0,
                        duration: 0.6,
                        stagger: 0.1,
                        ease: 'power2.out',
                    });
                    containerObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);
        
        containerObserver.observe(container);
    });

    // Section scroll reveal animations
    const sections = document.querySelectorAll('section.section-transition');
    const sectionObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px',
    });

    sections.forEach((section) => {
        sectionObserver.observe(section);
    });

    // Animate progress bars on scroll
    const progressBars = document.querySelectorAll('.progress-bar[data-progress]');
    const progressObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting && !entry.target.dataset.animated) {
                entry.target.dataset.animated = 'true';
                const targetProgress = parseInt(entry.target.dataset.progress);
                let currentProgress = 0;
                const increment = targetProgress / 60; // 60 frames for smooth animation
                
                const animate = () => {
                    currentProgress += increment;
                    if (currentProgress >= targetProgress) {
                        entry.target.style.width = targetProgress + '%';
                    } else {
                        entry.target.style.width = Math.floor(currentProgress) + '%';
                        requestAnimationFrame(animate);
                    }
                };
                
                setTimeout(() => {
                    animate();
                }, 200);
            }
        });
    }, { threshold: 0.3 });

    progressBars.forEach((bar) => {
        progressObserver.observe(bar);
    });

    // Initialize Lucide icons after DOM updates
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // Add signature logo animation on scroll
    const signatureLogos = document.querySelectorAll('.signature-logo');
    signatureLogos.forEach((logo) => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'float 3s ease-in-out infinite';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        observer.observe(logo);
    });
}

/**
 * Initialize counter animations for statistics
 * Only triggers when element scrolls into viewport from below (not on initial page load)
 */
function initCounterAnimations() {
    const counters = document.querySelectorAll('[data-counter]');
    
    counters.forEach((counter) => {
        // Reset counter to 0 initially
        const suffix = counter.getAttribute('data-suffix') || '';
        counter.textContent = '0' + suffix;
        
        // Check if counter has already been animated
        if (counter.dataset.animated === 'true') {
            return;
        }
        
        const target = parseInt(counter.getAttribute('data-counter'));
        const duration = parseInt(counter.getAttribute('data-duration')) || 2000;
        
        // Track if element was visible on page load
        const rect = counter.getBoundingClientRect();
        const wasVisibleOnLoad = rect.top < window.innerHeight && rect.top >= 0;
        let hasScrolled = false;
        
        // Track scroll to determine if element came into view via scroll
        const checkScroll = () => {
            if (window.scrollY > 10 || window.pageYOffset > 10) {
                hasScrolled = true;
                window.removeEventListener('scroll', checkScroll);
            }
        };
        window.addEventListener('scroll', checkScroll, { passive: true });
        
        // Use Intersection Observer - only trigger when scrolling brings element into view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting && counter.dataset.animated !== 'true') {
                    // If element was visible on page load, only animate after user scrolls
                    if (wasVisibleOnLoad && !hasScrolled) {
                        // Wait for scroll event
                        const animateOnScroll = () => {
                            if (hasScrolled || window.scrollY > 10) {
                                counter.dataset.animated = 'true';
                                animateCounter(counter, target, duration, suffix);
                                observer.unobserve(counter);
                                window.removeEventListener('scroll', animateOnScroll);
                            }
                        };
                        window.addEventListener('scroll', animateOnScroll, { once: true, passive: true });
                        return;
                    }
                    
                    // Element came into view via scroll - animate
                    counter.dataset.animated = 'true';
                    animateCounter(counter, target, duration, suffix);
                    observer.unobserve(counter);
                    window.removeEventListener('scroll', checkScroll);
                }
            });
        }, { 
            threshold: 0.3, // Trigger when 30% visible
            rootMargin: '0px 0px -80px 0px' // Trigger when element is 80px from entering viewport
        });
        
        observer.observe(counter);
    });
}

/**
 * Animate counter from 0 to target
 * Preserves inline styles (like color) during animation
 */
function animateCounter(element, target, duration, suffix) {
    // Save the current color style before animating
    const originalColor = element.style.color || window.getComputedStyle(element).color;
    
    let start = 0;
    const increment = target / (duration / 16); // 60fps
    const timer = setInterval(() => {
        start += increment;
        if (start >= target) {
            element.textContent = target + suffix;
            // Restore color if it was set
            if (originalColor && originalColor !== 'rgb(255, 255, 255)') {
                element.style.color = originalColor;
            }
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(start) + suffix;
            // Maintain color during animation
            if (originalColor && originalColor !== 'rgb(255, 255, 255)') {
                element.style.color = originalColor;
            }
        }
    }, 16);
}

/**
 * Initialize hero section specific animations - More Visible
 */
function initHeroAnimations() {
    // Animate hero headline on page load - More pronounced
    const headline = document.querySelector('.gradient-mesh h1');
    if (headline) {
        gsap.from(headline, {
            opacity: 0,
            y: 50,
            scale: 0.95,
            duration: 1.2,
            ease: 'power3.out',
            delay: 0.1,
        });
    }

    // Animate subtext - More visible
    const subtext = document.querySelector('.gradient-mesh p');
    if (subtext) {
        gsap.from(subtext, {
            opacity: 0,
            y: 40,
            duration: 1,
            ease: 'power2.out',
            delay: 0.3,
        });
    }

    // Animate CTA buttons - Make them very visible
    const ctas = document.querySelectorAll('.gradient-mesh a.btn-lift');
    if (ctas.length > 0) {
        gsap.set(ctas, { opacity: 0, y: 30 });
        gsap.to(ctas, {
            opacity: 1,
            y: 0,
            duration: 0.8,
            stagger: 0.15,
            ease: 'power2.out',
            delay: 0.5,
        });
    }

    // Animate stats cards - More visible entrance
    // Try multiple selectors to ensure we find the stats cards
    const statCards = document.querySelectorAll('.gradient-mesh .card-lift, .gradient-mesh [class*="bg-white/10"]');
    if (statCards.length > 0) {
        // Ensure they're visible first
        gsap.set(statCards, { opacity: 1, visibility: 'visible' });
        // Then animate from initial state
        gsap.from(statCards, {
            opacity: 0.5,
            scale: 0.9,
            y: 30,
            duration: 0.8,
            stagger: 0.12,
            ease: 'back.out(1.7)',
            delay: 0.7,
        });
    }
    
    // Also ensure the stats container is visible
    const statsContainer = document.querySelector('.gradient-mesh [class*="bg-white/15"]');
    if (statsContainer) {
        gsap.set(statsContainer, { opacity: 1, visibility: 'visible' });
        gsap.from(statsContainer, {
            opacity: 0.7,
            scale: 0.95,
            duration: 0.8,
            ease: 'power2.out',
            delay: 0.6,
        });
    }
}
