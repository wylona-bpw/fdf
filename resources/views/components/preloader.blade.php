{{--
    Preloader / Intro animation
    ----------------------------
    - S'affiche une seule fois par session (sessionStorage)
    - Auto-dismiss après 2.8s
    - Dismissable au clic ou via touche Escape
    - Respecte prefers-reduced-motion (animation simplifiée)
    - z-index très haut pour passer au-dessus de tout

    À placer juste après <body> dans resources/views/layouts/app.blade.php
--}}
<div
    x-data="{
        visible: !sessionStorage.getItem('amfdf_preloader_shown'),
        leaving: false,
        init() {
            if (!this.visible) return;
            sessionStorage.setItem('amfdf_preloader_shown', '1');
            document.body.style.overflow = 'hidden';

            // Durée selon prefers-reduced-motion
            const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const duration = reduced ? 800 : 2800;

            setTimeout(() => this.dismiss(), duration);
        },
        dismiss() {
            if (this.leaving) return;
            this.leaving = true;
            setTimeout(() => {
                this.visible = false;
                document.body.style.overflow = '';
            }, 700);
        }
    }"
    x-show="visible"
    x-cloak
    @click="dismiss()"
    @keydown.escape.window="dismiss()"
    :class="{ 'preloader-leaving': leaving }"
    class="preloader hero-bg fixed inset-0 z-[9999] flex items-center justify-center cursor-pointer overflow-hidden"
    role="status"
    aria-live="polite"
    aria-label="Chargement du site Mouvement des Femmes de Foi">

    {{-- Particules dorées flottantes en fond --}}
    <div class="preloader-particles" aria-hidden="true">
        @for($i = 0; $i < 14; $i++)
            <span class="preloader-particle" style="--i: {{ $i }};"></span>
        @endfor
    </div>

    {{-- Contenu central --}}
    <div class="preloader-content relative z-10 text-center text-white px-6 max-w-md">

        {{-- Logo avec halo --}}
        <div class="preloader-logo relative inline-block mb-7">
            <img src="{{ asset('images/logo-amfdf-256.png') }}"
                 alt="AMFDF"
                 width="140"
                 height="140"
                 class="block w-32 h-32 sm:w-36 sm:h-36 relative z-10"
                 loading="eager">
            {{-- Halo doré pulsant --}}
            <span class="preloader-halo absolute inset-0 rounded-full" aria-hidden="true"></span>
        </div>

        {{-- Wordmark --}}
        <h1 class="preloader-wordmark font-display text-4xl sm:text-5xl font-bold text-white mb-2">
            AMFDF
        </h1>

        {{-- Sous-titre --}}
        <p class="preloader-subtitle text-brand-gold-lt text-[11px] sm:text-xs uppercase font-semibold tracking-[0.3em] mb-7">
            Mouvement des Femmes de Foi
        </p>

        {{-- Séparateur or --}}
        <div class="preloader-divider w-16 h-px bg-brand-gold/60 mx-auto mb-6" aria-hidden="true"></div>

        {{-- Tagline biblique --}}
        <p class="preloader-tagline font-display italic text-lg sm:text-xl text-white/90 leading-relaxed">
            « Avec la foi,<br>tout est possible »
        </p>

        {{-- Loading dots --}}
        <div class="preloader-dots mt-10 inline-flex gap-2" aria-hidden="true">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    {{-- Hint discret en bas --}}
    <p class="absolute bottom-8 inset-x-0 text-center text-white/30 text-xs preloader-hint">
        Cliquez pour entrer
    </p>
</div>
