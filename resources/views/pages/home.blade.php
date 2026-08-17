{{--
    PAGE D'ACCUEIL — 8 blocs (réduite depuis 12, cf. audit UI/UX 2026 §6.1).
    Aucune donnée de démonstration : chaque section s'appuie sur les vraies
    données ($albums, $testimonials) ou disparaît si elles sont vides.

    Fournies par HomeController :
        $albums       : Album::published() (le plus récent alimente aussi "Dernière mission")
        $testimonials : Testimonial::published() (section masquée si vide)
        $articles     : Article::published() (non affiché ici, réservé à /actualites)
--}}
@extends('layouts.app')

@section('title', 'Accueil — AMFDF')

@section('content')
<div x-data="{ mobileMenu: false }">

    {{-- ════════════════════════════════════════════════════════════
         HERO — collage interactif + headline émotionnel
         ════════════════════════════════════════════════════════════ --}}
    <section class="hero-bg text-white">

        {{-- Pattern doré décoratif --}}
        <svg class="absolute inset-0 w-full h-full opacity-[0.08] z-0" aria-hidden="true">
            <defs>
                <pattern id="hero-pattern" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                    <circle cx="30" cy="30" r="1.5" fill="#D9A521"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#hero-pattern)"/>
        </svg>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                {{-- COLONNE GAUCHE : texte + CTAs --}}
                <div>
                    {{-- Badge --}}
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/10 border border-brand-gold/30
                                 rounded-full text-brand-gold text-xs font-bold uppercase tracking-[0.18em] mb-7">
                        <span class="w-1.5 h-1.5 bg-brand-gold rounded-full"></span>
                        Association humanitaire · Loi 1901
                    </span>

                    {{-- Headline --}}
                    <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl font-bold leading-[1.1] tracking-tight mb-6">
                        Chaque geste d'amour<br>
                        <span class="italic text-brand-gold-lt">redonne espoir</span>
                    </h1>

                    {{-- Sous-titre --}}
                    <p class="text-white/80 text-lg leading-relaxed mb-8 max-w-xl">
                        Nous sommes des femmes engagées qui apportent soutien, espoir et aide concrète aux personnes les plus
                        vulnérables — partout où le besoin se fait sentir.
                    </p>

                    {{-- CTAs --}}
                    <div class="flex flex-col sm:flex-row gap-3 mb-8">
                        <x-button :href="route('donate')" icon>Faire un don</x-button>
                        <x-button :href="route('volunteer.create')" variant="secondary">Devenir bénévole</x-button>
                    </div>

                    {{-- Trust micro-statement --}}
                    <p class="text-white/70 text-xs italic">
                        🔒 Don sécurisé via HelloAsso · Reçu fiscal disponible
                    </p>
                </div>

                {{-- COLONNE DROITE : collage interactif — chaque carte est un raccourci --}}
                <div class="relative">
                    <div class="grid grid-cols-2 gap-4">

                        {{-- Carte 1 : Nos actions (grande, haut-gauche) --}}
                        <a href="{{ route('actions') }}"
                           class="group relative col-span-2 sm:col-span-1 aspect-[4/5] overflow-hidden rounded-2xl
                                  shadow-2xl hover:shadow-brand-gold/20 hover:shadow-2xl transition-all duration-500">
                            <img src="{{ asset('storage/gallery/orphelinat-misericorde-divine-2026/distribution-17.jpg') }}"
                                 alt="Distribution de denrées alimentaires à l'orphelinat La Miséricorde Divine"
                                 class="absolute inset-0 w-full h-full object-cover" loading="eager" fetchpriority="high">
                            <div class="absolute inset-0 bg-gradient-to-t from-brand-blue-dk via-brand-blue-dk/40 to-transparent opacity-90"></div>
                            <div class="absolute inset-0 flex flex-col justify-end p-6">
                                <span class="text-brand-gold-lt text-xs font-bold uppercase tracking-wider mb-1">Découvrir</span>
                                <h3 class="font-display text-xl font-bold mb-3 text-white">Nos actions sur le terrain</h3>
                                <span class="inline-flex items-center gap-1.5 text-white text-sm font-semibold opacity-0
                                             group-hover:opacity-100 -translate-y-1 group-hover:translate-y-0 transition-all duration-300">
                                    Explorer
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </span>
                            </div>
                        </a>

                        {{-- Carte 2 : L'association (petite, haut-droite) --}}
                        <a href="{{ route('association') }}"
                           class="group relative aspect-square overflow-hidden rounded-2xl shadow-xl
                                  hover:shadow-brand-gold/20 hover:shadow-2xl transition-all duration-500
                                  hidden sm:block">
                            <img src="{{ asset('images/team/equipe-france-01.jpg') }}"
                                 alt="Équipe France du Mouvement des Femmes de Foi"
                                 class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-brand-blue-dk via-brand-blue-dk/30 to-transparent opacity-90"></div>
                            <div class="absolute inset-0 flex flex-col justify-end p-5">
                                <span class="text-brand-gold-lt text-xs font-bold uppercase tracking-wider mb-1">L'asso</span>
                                <h3 class="font-display text-base font-bold text-white leading-tight">Notre équipe</h3>
                            </div>
                        </a>

                        {{-- Carte 3 : Galerie (petite, bas-droite) --}}
                        <a href="{{ route('gallery.index') }}"
                           class="group relative aspect-square overflow-hidden rounded-2xl shadow-xl
                                  hover:shadow-brand-gold/20 hover:shadow-2xl transition-all duration-500
                                  hidden sm:block">
                            <img src="{{ asset('storage/gallery/orphelinat-misericorde-divine-2026/equipe-cameroun-02.jpg') }}"
                                 alt="Mission au Cameroun — galerie photo"
                                 class="absolute inset-0 w-full h-full object-cover" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-brand-blue-dk via-brand-blue-dk/30 to-transparent opacity-90"></div>
                            <div class="absolute inset-0 flex flex-col justify-end p-5">
                                <span class="text-brand-gold-lt text-xs font-bold uppercase tracking-wider mb-1">Galerie</span>
                                <h3 class="font-display text-base font-bold text-white leading-tight">Voir nos missions</h3>
                            </div>
                        </a>
                    </div>

                    {{-- Badge flottant "X enfants aidés" --}}
                    <div class="hidden sm:block absolute -bottom-6 -left-6 bg-brand-gold text-brand-blue-dk
                                px-5 py-3 rounded-2xl shadow-2xl rotate-[-4deg] z-10">
                        <div class="text-2xl font-display font-bold leading-none">{{ setting('stat_people_helped', '50') }}</div>
                        <div class="text-xs font-bold uppercase tracking-wider mt-1">enfants aidés</div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    {{-- Vague décorative entre hero et stats --}}
    <div class="wave-divider text-paper-gold relative -mt-px">
        <svg viewBox="0 0 1440 80" fill="currentColor" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,40 C320,80 720,0 1440,40 L1440,80 L0,80 Z"/>
        </svg>
    </div>

    {{-- ════════════════════════════════════════════════════════════
         STATS — chiffres d'impact
         ════════════════════════════════════════════════════════════ --}}
    <section class="bg-paper-gold py-14 lg:py-20 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                @php
                    $statsData = [
                        ['icon' => 'users',  'value' => setting('stat_people_helped', '50'), 'label' => 'Enfants aidés'],
                        ['icon' => 'heart',  'value' => setting('stat_volunteers', '20'),    'label' => 'Bénévoles actifs'],
                        ['icon' => 'box',    'value' => setting('stat_actions', '3'),         'label' => 'Actions menées'],
                        ['icon' => 'globe',  'value' => setting('stat_countries', '2'),       'label' => 'Pays touchés'],
                    ];
                    $statIcons = [
                        'users'  => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                        'heart'  => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                        'box'    => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
                        'globe'  => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                    ];
                @endphp

                @foreach($statsData as $stat)
                    <div class="text-center group">
                        <div class="w-14 h-14 mx-auto mb-3 rounded-2xl bg-white shadow-md flex items-center justify-center
                                    transition-transform group-hover:scale-110 group-hover:rotate-3">
                            <svg class="w-7 h-7 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $statIcons[$stat['icon']] ?? $statIcons['box'] }}"/>
                            </svg>
                        </div>
                        <div class="font-display text-4xl sm:text-5xl font-bold text-brand-blue-dk leading-none mb-2"
                             data-counter="{{ $stat['value'] }}">
                            {{ $stat['value'] }}
                        </div>
                        <div class="text-sm text-ink-grey font-medium">
                            {{ $stat['label'] }}
                        </div>
                    </div>
                @endforeach
            </div>

            <p class="text-center text-xs text-ink-grey italic mt-10">
                Depuis la création du mouvement — chiffres mis à jour régulièrement
            </p>
        </div>
    </section>

    {{-- ════════════════════════════════════════════════════════════
         DERNIÈRE MISSION — sentiment d'asso vivante
         ════════════════════════════════════════════════════════════ --}}
    @php
        $latestAlbum = $albums->first() ?? null;
        $latestMission = $latestAlbum ? [
            'title' => $latestAlbum->title,
            'kicker' => ($latestAlbum->event_date?->isoFormat('MMMM YYYY') ?? '') . ($latestAlbum->location ? ' · ' . $latestAlbum->location : ''),
            'description' => $latestAlbum->description,
            'photo' => 'storage/' . $latestAlbum->cover_image,
            'stats' => [
                ['value' => setting('stat_people_helped', '50'), 'label' => 'enfants accompagnés'],
                ['value' => $latestAlbum->items_count, 'label' => 'photos & vidéos'],
                ['value' => setting('stat_volunteers', '20'), 'label' => 'bénévoles mobilisés'],
            ],
            'href' => route('gallery.show', $latestAlbum->slug),
        ] : null;
    @endphp
    <x-latest-mission :mission="$latestMission" />

    {{-- ════════════════════════════════════════════════════════════
         CAMPAGNE ACTIVE — urgence + conversion
         (s'affiche uniquement si une campagne active existe en base)
         ════════════════════════════════════════════════════════════ --}}
    <x-active-campaign :campaign="$activeCampaign ?? null" />

    {{-- ════════════════════════════════════════════════════════════
         QUI SOMMES-NOUS
         ════════════════════════════════════════════════════════════ --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                {{-- Texte --}}
                <div>
                    <x-section-kicker>Qui sommes-nous</x-section-kicker>
                    <h2 class="reveal font-display text-3xl sm:text-4xl lg:text-5xl font-bold text-brand-blue-dk leading-tight mb-6">
                        Des femmes engagées,<br>
                        <span class="italic text-brand-blue">unies par la foi</span>
                    </h2>
                    <p class="text-ink-dark leading-relaxed mb-4">
                        Le Mouvement des Femmes de Foi est une association humanitaire à but non lucratif (loi 1901).
                        Nous croyons que chaque être humain mérite une vie meilleure.
                    </p>
                    <p class="text-ink-dark leading-relaxed mb-6">
                        La femme est source de vie, d'amour et d'espérance. Par leur foi, leur courage et leur générosité,
                        les femmes du mouvement transforment des vies au quotidien.
                    </p>

                    {{-- Citation --}}
                    <blockquote class="border-l-4 border-brand-gold pl-5 my-7 italic text-brand-blue-dk font-display text-lg">
                        « Avec la foi, tout est possible »
                    </blockquote>

                    {{-- CTA --}}
                    <x-button :href="route('association')" variant="blue" icon>Découvrir notre histoire</x-button>
                </div>

                {{-- Photo équipe --}}
                <div class="relative">
                    <img src="{{ asset('images/team/equipe-france-02.jpg') }}"
                         alt="Équipe du Mouvement des Femmes de Foi"
                         class="w-full aspect-[4/3] object-cover rounded-2xl shadow-xl" loading="lazy">
                    {{-- Badge décoratif --}}
                    <div class="absolute -bottom-5 -right-5 bg-white shadow-2xl rounded-xl p-4 hidden sm:block">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-brand-gold/20 flex items-center justify-center">
                                <svg class="w-5 h-5 text-brand-gold" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-xs text-ink-grey">Depuis</div>
                                <div class="font-display font-bold text-brand-blue-dk">2025</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════════════════════
         NOS ACTIONS — 3 axes principaux, détail complet sur /nos-actions
         ════════════════════════════════════════════════════════════ --}}
    <section class="bg-paper-gold/30 py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <x-section-header kicker="Ce que nous faisons" title="Nos actions sur le terrain"
                subtitle="Chaque mois, nous intervenons avec une aide concrète et humaine. Cliquez pour découvrir chaque mission." />

            {{-- 3 axes principaux — le détail complet est sur /nos-actions --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 lg:gap-6">
                <x-action-card
                    icon="cake"
                    color="amber"
                    title="Distribution alimentaire"
                    subtitle="Familles & personnes âgées"
                    description="Denrées de première nécessité distribuées lors de nos missions de terrain."
                    href="{{ route('actions') }}" />

                <x-action-card
                    icon="book"
                    color="purple"
                    title="Fournitures scolaires"
                    subtitle="Enfants orphelins"
                    description="Cartables, cahiers, stylos — nous équipons les enfants pour leur scolarité."
                    href="{{ route('actions') }}" />

                <x-action-card
                    icon="hand"
                    color="rose"
                    title="Accompagnement moral"
                    subtitle="Veuves & personnes isolées"
                    description="Visites, écoute et présence pour rompre la solitude."
                    href="{{ route('actions') }}" />
            </div>

            {{-- CTA "Voir toutes les actions" --}}
            <div class="text-center mt-12">
                <a href="{{ route('actions') }}"
                   class="group inline-flex items-center gap-2 px-6 py-3 border-2 border-brand-blue text-brand-blue
                          font-semibold rounded-lg hover:bg-brand-blue hover:text-white transition">
                    <span>Voir toutes nos actions en détail</span>
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════════════════════
         TÉMOIGNAGES — n'apparaît que si des témoignages réels existent
         ════════════════════════════════════════════════════════════ --}}
    @if($testimonials->isNotEmpty())
    <section class="bg-paper-gold/40 py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <x-section-header kicker="Ils témoignent" title="Ils nous font confiance" />

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($testimonials as $testimonial)
                    <x-testimonial-card
                        quote="{{ $testimonial->content }}"
                        name="{{ $testimonial->name }}"
                        role="{{ $testimonial->role }}"
                        :photo="$testimonial->photo"
                        href="{{ route('testimonials.index') }}" />
                @endforeach
            </div>

            {{-- CTA --}}
            <div class="text-center mt-12">
                <x-teaser-link :href="route('testimonials.index')">
                    Lire tous les témoignages
                </x-teaser-link>
            </div>
        </div>
    </section>
    @endif

    {{-- ════════════════════════════════════════════════════════════
         TRANSPARENCE — avec liens vers la vraie page transparence
         ════════════════════════════════════════════════════════════ --}}
    <section class="bg-white py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <x-section-header kicker="Notre engagement" title="Transparence totale"
                subtitle="Chaque don est suivi et orienté vers les actions de terrain. Nous vous rendons compte." />

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 lg:gap-6 max-w-5xl mx-auto">

                {{-- Carte 1 : 100% terrain --}}
                <div class="bg-paper-blue/70 rounded-2xl p-7 text-center border border-paper-blue">
                    <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-white shadow-sm flex items-center justify-center">
                        <svg class="w-7 h-7 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-display text-xl font-bold text-brand-blue-dk mb-2">100% terrain</h3>
                    <p class="text-sm text-ink-grey mb-3">Chaque don sert directement aux actions de terrain.</p>
                </div>

                {{-- Carte 2 : Comptes vérifiés --}}
                <div class="bg-paper-blue/70 rounded-2xl p-7 text-center border border-paper-blue">
                    <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-white shadow-sm flex items-center justify-center">
                        <svg class="w-7 h-7 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="font-display text-xl font-bold text-brand-blue-dk mb-2">Comptes vérifiés</h3>
                    <p class="text-sm text-ink-grey mb-3">Association loi 1901, gestion rigoureuse et contrôlée.</p>
                </div>

                {{-- Carte 3 : Rapport annuel --}}
                <div class="bg-paper-blue/70 rounded-2xl p-7 text-center border border-paper-blue">
                    <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-white shadow-sm flex items-center justify-center">
                        <svg class="w-7 h-7 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-display text-xl font-bold text-brand-blue-dk mb-2">Rapport annuel</h3>
                    <p class="text-sm text-ink-grey mb-3">Bilan d'activité disponible sur demande.</p>
                </div>
            </div>

            {{-- CTA principal vers la page Transparence --}}
            <div class="text-center mt-10">
                <x-teaser-link :href="route('transparency')">
                    Comprendre l'utilisation des dons
                </x-teaser-link>
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════════════════════
         CTA FINAL : REJOIGNEZ LE MOUVEMENT
         ════════════════════════════════════════════════════════════ --}}
    <section class="hero-bg py-16 lg:py-24 text-white">

        <div class="relative max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="reveal font-display text-3xl sm:text-4xl lg:text-5xl font-bold mb-4 leading-tight">
                Rejoignez le mouvement
            </h2>
            <p class="text-white/80 text-lg mb-3 leading-relaxed">
                Ensemble, redonnons espoir aux plus vulnérables.
            </p>
            <p class="text-brand-gold-lt font-display italic mb-10">
                « Femmes, rejoignez-nous en masse. »
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <x-button :href="route('donate')" icon>Faire un don</x-button>
                <x-button :href="route('volunteer.create')" variant="secondary">Devenir bénévole</x-button>
            </div>

            {{-- Moment spirituel — coda, plutôt qu'une section séparée --}}
            <div class="mt-14 pt-10 border-t border-white/10">
                <blockquote class="font-display italic text-xl lg:text-2xl leading-relaxed mb-3">
                    « Jésus est le chemin, la vérité et la vie »
                </blockquote>
                <cite class="not-italic text-brand-gold-lt text-sm font-medium tracking-wider">— Jean 14:6</cite>
            </div>
        </div>
    </section>

</div>

{{-- 🆕 Sticky CTA mobile — apparaît après le scroll --}}
<x-mobile-sticky-cta />

@endsection
