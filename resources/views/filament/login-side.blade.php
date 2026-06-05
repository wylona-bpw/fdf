{{-- Panneau brand affiché uniquement sur la page de login --}}
@if(request()->routeIs('filament.admin.auth.*'))
<aside class="fdf-login-side" aria-hidden="true">
    <div class="fdf-login-side__overlay"></div>

    <div class="fdf-login-side__inner">
        {{-- Logo en haut --}}
        <div class="fdf-login-side__logo">
            <svg viewBox="0 0 90 90" xmlns="http://www.w3.org/2000/svg" width="80" height="80">
                <circle cx="45" cy="45" r="43" fill="none" stroke="#D9A521" stroke-width="1.5" opacity="0.9"/>
                <circle cx="45" cy="45" r="35" fill="#D9A521" opacity="0.08"/>
                <text x="45" y="56" text-anchor="middle"
                      font-family="Playfair Display, Georgia, serif"
                      font-size="28" font-weight="700"
                      fill="#D9A521" letter-spacing="1">FDF</text>
                <path d="M45 12 L47.4 18 L53.8 18.4 L48.9 22.6 L50.5 28.8 L45 25.4 L39.5 28.8 L41.1 22.6 L36.2 18.4 L42.6 18 Z"
                      fill="#D9A521"/>
            </svg>
        </div>

        <div class="fdf-login-side__title">
            <h1>Mouvement des<br><span>Femmes de Foi</span></h1>
            <p class="fdf-login-side__tagline">Espace d'administration</p>
        </div>

        <div class="fdf-login-side__verse">
            <span class="fdf-login-side__quote-mark">&ldquo;</span>
            <p class="fdf-login-side__verse-text">Je suis le chemin, la vérité et la vie.</p>
            <p class="fdf-login-side__verse-ref">— Jean 14:6</p>
        </div>

        <div class="fdf-login-side__footer">
            <p>Avec la foi, tout est possible.</p>
            <p class="fdf-login-side__copyright">© {{ date('Y') }} AMFDF · Tous droits réservés</p>
        </div>
    </div>

    <svg class="fdf-login-side__pattern" viewBox="0 0 600 800" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <defs>
            <pattern id="dots" x="0" y="0" width="40" height="40" patternUnits="userSpaceOnUse">
                <circle cx="20" cy="20" r="1" fill="#D9A521" opacity="0.15"/>
            </pattern>
        </defs>
        <rect width="600" height="800" fill="url(#dots)"/>
        <circle cx="500" cy="700" r="200" fill="none" stroke="#D9A521" stroke-width="0.5" opacity="0.2"/>
        <circle cx="500" cy="700" r="140" fill="none" stroke="#D9A521" stroke-width="0.5" opacity="0.15"/>
        <circle cx="100" cy="100" r="80" fill="none" stroke="#D9A521" stroke-width="0.5" opacity="0.2"/>
    </svg>
</aside>

{{-- Marque la page comme étant la page de login pour le CSS --}}
<script>
    document.documentElement.classList.add('fdf-is-login');
</script>
@endif
