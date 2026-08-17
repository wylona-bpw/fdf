{{--
    En-tête de section centré (kicker + titre + sous-titre) — remplace le
    même bloc à trois lignes répété dans quasiment chaque section de la home.

    Usage :
        <x-section-header kicker="Ce que nous faisons" title="Nos actions sur le terrain"
                           subtitle="Chaque mois, nous intervenons..." />
--}}
@props([
    'kicker' => null,
    'title',
    'subtitle' => null,
])

<div class="text-center mb-12 lg:mb-14">
    @if($kicker)
        <x-section-kicker>{{ $kicker }}</x-section-kicker>
    @endif
    <h2 class="reveal font-display text-3xl sm:text-4xl lg:text-5xl font-bold text-brand-blue-dk">{{ $title }}</h2>
    @if($subtitle)
        <p class="text-ink-grey mt-3 max-w-2xl mx-auto">{{ $subtitle }}</p>
    @endif
</div>
