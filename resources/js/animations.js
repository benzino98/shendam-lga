/**
 * Animation Utilities
 * Reusable animation functions for the Shendam LGA website
 */

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

/**
 * Fade in element on scroll
 */
export function fadeInOnScroll(selector, options = {}) {
    const defaults = {
        opacity: 0,
        y: 30,
        duration: 0.8,
        ease: 'power2.out',
        start: 'top 85%',
    };

    const config = { ...defaults, ...options };

    gsap.utils.toArray(selector).forEach((element) => {
        gsap.from(element, {
            opacity: config.opacity,
            y: config.y,
            duration: config.duration,
            ease: config.ease,
            scrollTrigger: {
                trigger: element,
                start: config.start,
                toggleActions: 'play none none reverse',
            },
        });
    });
}

/**
 * Slide up element on scroll
 */
export function slideUpOnScroll(selector, options = {}) {
    const defaults = {
        opacity: 0,
        y: 50,
        duration: 0.8,
        ease: 'power2.out',
        start: 'top 85%',
    };

    const config = { ...defaults, ...options };

    gsap.utils.toArray(selector).forEach((element) => {
        gsap.from(element, {
            opacity: config.opacity,
            y: config.y,
            duration: config.duration,
            ease: config.ease,
            scrollTrigger: {
                trigger: element,
                start: config.start,
                toggleActions: 'play none none reverse',
            },
        });
    });
}

/**
 * Stagger animation for list items
 */
export function staggerOnScroll(containerSelector, itemSelector = '.stagger-item', options = {}) {
    const defaults = {
        opacity: 0,
        y: 30,
        duration: 0.6,
        stagger: 0.1,
        ease: 'power2.out',
        start: 'top 85%',
    };

    const config = { ...defaults, ...options };

    gsap.utils.toArray(containerSelector).forEach((container) => {
        const items = container.querySelectorAll(itemSelector);
        gsap.from(items, {
            opacity: config.opacity,
            y: config.y,
            duration: config.duration,
            stagger: config.stagger,
            ease: config.ease,
            scrollTrigger: {
                trigger: container,
                start: config.start,
                toggleActions: 'play none none reverse',
            },
        });
    });
}

/**
 * Animate counter from 0 to target
 */
export function animateCounter(element, target, options = {}) {
    const defaults = {
        duration: 2000,
        suffix: '',
        decimals: 0,
    };

    const config = { ...defaults, ...options };

    let start = 0;
    const increment = target / (config.duration / 16); // 60fps

    const timer = setInterval(() => {
        start += increment;
        if (start >= target) {
            if (config.decimals > 0) {
                element.textContent = target.toFixed(config.decimals) + config.suffix;
            } else {
                element.textContent = Math.floor(target) + config.suffix;
            }
            clearInterval(timer);
        } else {
            if (config.decimals > 0) {
                element.textContent = start.toFixed(config.decimals) + config.suffix;
            } else {
                element.textContent = Math.floor(start) + config.suffix;
            }
        }
    }, 16);

    return timer;
}

/**
 * Parallax effect for background elements
 */
export function parallaxOnScroll(selector, options = {}) {
    const defaults = {
        speed: 0.5,
        start: 'top bottom',
        end: 'bottom top',
    };

    const config = { ...defaults, ...options };

    gsap.utils.toArray(selector).forEach((element) => {
        gsap.to(element, {
            yPercent: -50 * config.speed,
            ease: 'none',
            scrollTrigger: {
                trigger: element,
                start: config.start,
                end: config.end,
                scrub: true,
            },
        });
    });
}

/**
 * Scale in animation
 */
export function scaleInOnScroll(selector, options = {}) {
    const defaults = {
        scale: 0.8,
        opacity: 0,
        duration: 0.8,
        ease: 'power2.out',
        start: 'top 85%',
    };

    const config = { ...defaults, ...options };

    gsap.utils.toArray(selector).forEach((element) => {
        gsap.from(element, {
            scale: config.scale,
            opacity: config.opacity,
            duration: config.duration,
            ease: config.ease,
            scrollTrigger: {
                trigger: element,
                start: config.start,
                toggleActions: 'play none none reverse',
            },
        });
    });
}
