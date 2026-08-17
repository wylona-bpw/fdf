{{--
    Section "Dernière mission" — vitrine du dernier travail effectué.
    Crée un sentiment de "asso vivante et active".

    Usage:
        <x-latest-mission :mission="$latestMission" />

    Structure attendue (null = section masquée, jamais de fausses données) :
        $latestMission = [
            'title' => 'Distribution de fournitures scolaires',
            'kicker' => 'Mai 2026 · Yaoundé',
            'description' => 'En partenariat avec...',
            'photo' => 'images/missions/...jpg',
            'stats' => [
                ['value' => '45', 'label' => 'enfants accompagnés'],
                ['value' => '120', 'label' => 'cahiers distribués'],
                ['value' => '12', 'label' => 'bénévoles mobilisés'],
            ],
            'href' => route('articles.show', $slug),
        ];
--}}
@props([
    'mission' => null,
])

@if($mission)
<section class="bg-white py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- En-tête de section --}}
        <div class="text-center mb-12 lg:mb-16">
            <x-section-kicker>Dernière mission</x-section-kicker>
            <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-bold text-brand-blue-dk">
                L'association en action
            </h2>
            <p class="text-ink-grey mt-3 max-w-2xl mx-auto">
                Chaque mois, nous menons des missions concrètes sur le terrain. Voici la dernière.
            </p>
        </div>

        {{-- Bloc principal --}}
        <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-center">

            {{-- Photo (60% sur desktop) --}}
            <div class="lg:col-span-7">
                <div class="relative">
                    @if(!empty($mission['photo']))
                        <img src="{{ asset($mission['photo']) }}"
                             alt="{{ $mission['title'] }}"
                             class="w-full aspect-[4/3] object-cover rounded-2xl shadow-2xl">
                    @else
                        <x-photo-placeholder ratio="aspect-[4/3]" label="Photo de la mission" variant="subtle" />
                    @endif

                    {{-- Badge "EN DIRECT DU TERRAIN" en surimpression --}}
                    <div class="absolute top-5 left-5 bg-brand-gold text-brand-blue-dk
                                text-xs font-bold uppercase tracking-wider px-4 py-2 rounded-full shadow-lg
                                flex items-center gap-2">
                        <span class="w-2 h-2 bg-brand-blue-dk rounded-full animate-pulse"></span>
                        Sur le terrain
                    </div>
                </div>
            </div>

            {{-- Contenu (40% sur desktop) --}}
            <div class="lg:col-span-5">
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-amber-700 mb-3">
                    {{ $mission['kicker'] }}
                </p>

                <h3 class="font-display text-2xl sm:text-3xl font-bold text-brand-blue-dk leading-tight mb-5">
                    {{ $mission['title'] }}
                </h3>

                <p class="text-ink-grey leading-relaxed mb-8">
                    {{ $mission['description'] }}
                </p>

                {{-- Stats clés en ligne --}}
                <div class="grid grid-cols-3 gap-4 mb-8">
                    @foreach($mission['stats'] as $stat)
                        <div class="text-center sm:text-left">
                            <div class="font-display text-3xl font-bold text-brand-blue">
                                {{ $stat['value'] }}
                            </div>
                            <div class="text-xs text-ink-grey leading-tight mt-1">
                                {{ $stat['label'] }}
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- CTA principal --}}
                <a href="{{ $mission['href'] }}"
                   class="group inline-flex items-center gap-2 px-6 py-3 bg-brand-blue text-white
                          font-semibold rounded-lg hover:bg-brand-blue-dk transition shadow-md hover:shadow-lg">
                    <span>Voir le reportage complet</span>
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endif
