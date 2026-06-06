{{--
    Back to top — bouton flottant en bas-droite
    --------------------------------------------
    - Apparaît après 500px de scroll
    - Smooth scroll vers le haut au clic
    - Positionné au-dessus du sticky CTA mobile (bottom-20 sur mobile)
    - Couleurs brand : bleu + halo doré au hover

    À placer juste avant </body> dans le layout.
--}}
<button
    x-data="{
        visible: false,
        progress: 0,
        update() {
            this.visible = window.scrollY > 500;
            const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
            this.progress = maxScroll > 0 ? Math.min(window.scrollY / maxScroll, 1) : 0;
        }
    }"
    x-init="
        update();
        window.addEventListener('scroll', () => update(), { passive: true });
        window.addEventListener('resize', () => update(), { passive: true });
    "
    @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
    x-show="visible"
    x-cloak
    x-transition:enter="transition-all duration-300 ease-out"
    x-transition:enter-start="opacity-0 translate-y-3 scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    x-transition:leave="transition-all duration-200 ease-in"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 translate-y-3 scale-95"
    class="back-to-top fixed z-30 group
           bottom-20 right-4 lg:bottom-6 lg:right-6
           w-12 h-12 lg:w-14 lg:h-14
           rounded-full
           bg-brand-blue text-white
           shadow-lg hover:shadow-2xl
           hover:bg-brand-blue-dk
           hover:-translate-y-1
           transition-all duration-200
           flex items-center justify-center
           border-2 border-brand-gold/0 hover:border-brand-gold/70
           focus:outline-none focus:ring-4 focus:ring-brand-gold/30"
    aria-label="Retour en haut de la page">

    {{-- Flèche --}}
    <svg class="w-5 h-5 lg:w-6 lg:h-6 relative z-10 transition-transform duration-200 group-hover:-translate-y-0.5"
         fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"/>
    </svg>

    {{-- Anneau de progression du scroll (subtil) --}}
    <svg class="absolute inset-0 w-full h-full -rotate-90 pointer-events-none"
         viewBox="0 0 56 56" aria-hidden="true">
        <circle cx="28" cy="28" r="25"
                fill="none"
                stroke="rgba(217, 165, 33, 0.25)"
                stroke-width="2.5"/>
        <circle cx="28" cy="28" r="25"
                fill="none"
                stroke="#D9A521"
                stroke-width="2.5"
                stroke-linecap="round"
                stroke-dasharray="157"
                :style="`stroke-dashoffset: ${157 - (progress * 157)}; transition: stroke-dashoffset 0.15s ease-out;`"/>
    </svg>
</button>
