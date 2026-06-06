/**
 * Counter animation — compte de 0 à la valeur cible au scroll
 *
 * Usage HTML:
 *     <div data-counter="150+">150+</div>
 *     <div data-counter="12">12</div>
 *
 * Le texte initial sert de fallback no-JS.
 * L'animation se déclenche quand l'élément entre dans le viewport,
 * une seule fois, puis applique .counter-pop pour le petit pulse final.
 *
 * À importer dans resources/js/app.js :
 *     import './counter-init.js';
 *
 * Ou en script defer dans le layout :
 *     <script src="{{ asset('js/counter-init.js') }}" defer></script>
 */

(function () {
    'use strict';

    // Si l'utilisateur préfère réduire les animations, on saute la phase 0
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.querySelectorAll('[data-counter]').forEach(el => {
            el.textContent = el.dataset.counter;
        });
        return;
    }

    // Fallback : pas d'IntersectionObserver disponible
    if (!('IntersectionObserver' in window)) {
        document.querySelectorAll('[data-counter]').forEach(el => {
            el.textContent = el.dataset.counter;
        });
        return;
    }

    /**
     * Anime un compteur de 0 à sa cible
     */
    const animateCounter = (el) => {
        const target = el.dataset.counter || el.textContent;

        // Extraire la partie numérique et le suffixe (ex: "150+" → 150 et "+")
        const numericMatch = target.match(/-?\d+(?:[.,]\d+)?/);
        if (!numericMatch) {
            el.textContent = target;
            return;
        }

        const numeric = parseFloat(numericMatch[0].replace(',', '.'));
        const prefix = target.substring(0, numericMatch.index);
        const suffix = target.substring(numericMatch.index + numericMatch[0].length);

        // Pour les nombres très petits (≤ 10), on anime quand même mais plus lentement
        const duration = numeric > 20 ? 1500 : 1100;
        const start = performance.now();

        const tick = (now) => {
            const elapsed = now - start;
            const progress = Math.min(elapsed / duration, 1);

            // Ease-out cubic — démarre vite, ralentit à la fin
            const eased = 1 - Math.pow(1 - progress, 3);
            const current = Math.floor(eased * numeric);

            el.textContent = prefix + current + suffix;

            if (progress < 1) {
                requestAnimationFrame(tick);
            } else {
                // Valeur finale exacte + petit pulse
                el.textContent = target;
                el.classList.add('counter-pop');

                // Retire la classe après l'animation pour pouvoir la rejouer
                setTimeout(() => el.classList.remove('counter-pop'), 500);
            }
        };

        requestAnimationFrame(tick);
    };

    /**
     * Observer qui déclenche l'animation quand un compteur devient visible
     */
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);  // animer une seule fois
            }
        });
    }, {
        root: null,
        rootMargin: '0px 0px -50px 0px',
        threshold: 0.4,  // se déclenche quand 40% du compteur est visible
    });

    /**
     * Initialise tous les compteurs présents dans le DOM
     */
    function init() {
        document.querySelectorAll('[data-counter]:not(.counter-init)').forEach(el => {
            el.classList.add('counter-init');
            el.textContent = '0';   // reset visuel avant l'animation
            observer.observe(el);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Re-init pour les éléments ajoutés dynamiquement (Livewire, etc.)
    if (typeof window.Livewire !== 'undefined') {
        document.addEventListener('livewire:navigated', init);
    }
})();
