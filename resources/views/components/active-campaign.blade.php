{{--
    Section "Campagne active" — crée l'urgence et le mécanisme de conversion.
    Section s'affiche UNIQUEMENT si une campagne est active.

    Usage:
        <x-active-campaign :campaign="$activeCampaign" />

    Structure attendue:
        $activeCampaign = [
            'title' => 'Cantine scolaire de Yaoundé',
            'description' => 'Permettre à 50 enfants...',
            'photo' => 'images/campaigns/cantine.jpg',
            'goal' => 5000,
            'raised' => 3650,
            'donors' => 87,
            'days_left' => 27,
            'href' => route('donate', ['campaign' => 'cantine-yaounde']),
            'currency' => '€',
        ];

    Si null, la section ne s'affiche pas.
--}}
@props([
    'campaign' => null,
    'demo' => false,  // forcer l'affichage en mode démo pour développement
])

@php
    // Mode démo pour visualiser la section tant qu'il n'y a pas de vraie campagne
    if (!$campaign && $demo) {
        $campaign = [
            'title' => 'Cantine scolaire de Yaoundé',
            'description' => "Permettre à 50 enfants d'avoir un repas chaud chaque jour de classe jusqu'à la fin de l'année scolaire.",
            'photo' => null,
            'goal' => 5000,
            'raised' => 3650,
            'donors' => 87,
            'days_left' => 27,
            'href' => '#',
            'currency' => '€',
        ];
    }

    if (!$campaign) return;

    $percent = min(100, round(($campaign['raised'] / max(1, $campaign['goal'])) * 100));
    $currency = $campaign['currency'] ?? '€';
@endphp

<section class="bg-gradient-to-br from-brand-blue-dk via-brand-blue to-brand-blue-dk py-16 lg:py-20 relative overflow-hidden">

    {{-- Motif décoratif --}}
    <svg class="absolute inset-0 w-full h-full opacity-[0.06]" aria-hidden="true">
        <defs>
            <pattern id="campaign-pattern" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                <circle cx="30" cy="30" r="1.5" fill="#D9A521"/>
            </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#campaign-pattern)"/>
    </svg>

    {{-- Cercles décoratifs --}}
    <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-brand-gold/5 blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full bg-brand-gold/5 blur-3xl pointer-events-none"></div>

    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- En-tête --}}
        <div class="text-center mb-10">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-brand-gold/20 border border-brand-gold/30
                         rounded-full text-brand-gold-lt text-xs font-bold uppercase tracking-wider">
                <span class="w-2 h-2 bg-brand-gold rounded-full animate-pulse"></span>
                Campagne en cours
            </span>
        </div>

        <div class="grid lg:grid-cols-12 gap-8 items-center bg-white/5 backdrop-blur-sm
                    border border-white/10 rounded-3xl p-6 sm:p-10 lg:p-12">

            {{-- Photo (40%) --}}
            <div class="lg:col-span-5">
                @if(!empty($campaign['photo']))
                    <img src="{{ asset($campaign['photo']) }}"
                         alt="{{ $campaign['title'] }}"
                         class="w-full aspect-[4/3] object-cover rounded-2xl shadow-xl">
                @else
                    <x-photo-placeholder ratio="aspect-[4/3]" label="Photo de la campagne" variant="blue" />
                @endif
            </div>

            {{-- Contenu campagne (60%) --}}
            <div class="lg:col-span-7 text-white">

                <h2 class="font-display text-2xl sm:text-3xl lg:text-4xl font-bold mb-3 leading-tight">
                    {{ $campaign['title'] }}
                </h2>

                <p class="text-white/70 leading-relaxed mb-7">
                    {{ $campaign['description'] }}
                </p>

                {{-- Stats : collecté / objectif --}}
                <div class="flex items-baseline justify-between mb-2">
                    <div>
                        <span class="font-display text-3xl sm:text-4xl font-bold text-brand-gold">
                            {{ number_format($campaign['raised'], 0, ',', ' ') }}{{ $currency }}
                        </span>
                        <span class="text-white/60 text-sm ml-1">
                            collectés
                        </span>
                    </div>
                    <div class="text-right">
                        <div class="text-white text-sm font-semibold">
                            sur {{ number_format($campaign['goal'], 0, ',', ' ') }}{{ $currency }}
                        </div>
                        <div class="text-brand-gold-lt text-xs font-bold mt-0.5">
                            {{ $percent }}% atteint
                        </div>
                    </div>
                </div>

                {{-- Barre de progression — utilise .progress-fill pour l'animation --}}
                <div class="relative h-3 bg-white/10 rounded-full overflow-hidden mb-6">
                    <div class="progress-fill absolute inset-y-0 left-0 bg-gradient-to-r from-brand-gold to-brand-gold-lt rounded-full"
                         style="width: {{ $percent }}%">
                        {{-- Effet brillance/shimmer --}}
                        <div class="absolute inset-0 bg-gradient-to-b from-white/25 to-transparent"></div>
                        <div class="progress-shimmer absolute inset-y-0 w-20 bg-gradient-to-r from-transparent via-white/30 to-transparent"></div>
                    </div>
                </div>

                {{-- Méta : donateurs + jours restants --}}
                <div class="flex flex-wrap gap-6 mb-7 text-sm">
                    <div class="flex items-center gap-2 text-white/80">
                        <svg class="w-5 h-5 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span><strong class="text-white">{{ $campaign['donors'] }}</strong> donateurs</span>
                    </div>
                    <div class="flex items-center gap-2 text-white/80">
                        <svg class="w-5 h-5 text-brand-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span><strong class="text-white">{{ $campaign['days_left'] }}</strong> jours restants</span>
                    </div>
                </div>

                {{-- CTA principal --}}
                <a href="{{ $campaign['href'] }}"
                   class="group inline-flex items-center justify-center gap-2 w-full sm:w-auto
                          px-8 py-4 bg-brand-gold text-brand-blue-dk font-bold rounded-lg
                          hover:bg-brand-gold-lt transition shadow-xl hover:shadow-2xl
                          hover:-translate-y-0.5 transition-transform">
                    <span>Soutenir cette campagne</span>
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
