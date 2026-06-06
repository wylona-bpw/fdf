/**
 * Scroll Reveal — active la classe .visible sur les éléments .reveal
 * lorsqu'ils entrent dans le viewport.
 *
 * À importer dans resources/js/app.js :
 *     import './reveal-init.js';
 *
 * Ou à charger en module dans le layout :
 *     <script src="{{ asset('js/reveal-init.js') }}" defer></script>
 */

(function () {
    'use strict';

    // Mark JS as available (for fallback CSS)
    document.documentElement.classList.remove('no-js');
    document.documentElement.classList.add('js');

    // Respect user motion preference
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.querySelectorAll('.reveal').forEach(el => el.classList.add('visible'));
        return;
    }

    // Fallback for browsers without IntersectionObserver
    if (!('IntersectionObserver' in window)) {
        document.querySelectorAll('.reveal').forEach(el => el.classList.add('visible'));
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        root: null,
        rootMargin: '0px 0px -60px 0px',  // déclenche un peu avant que ce soit complètement visible
        threshold: 0.1,
    });

    // Observe all .reveal elements
    function init() {
        document.querySelectorAll('.reveal:not(.visible)').forEach(el => {
            observer.observe(el);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Re-observe dynamically added elements (Livewire, etc.)
    if (typeof window.Livewire !== 'undefined') {
        document.addEventListener('livewire:navigated', init);
    }
})();
