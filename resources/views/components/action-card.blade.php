{{--
    Carte d'action cliquable.
    Chaque carte est un lien vers la page détaillée de l'action.

    Usage:
        <x-action-card
            icon="cake"
            title="Distribution alimentaire"
            subtitle="Familles & personnes âgées"
            description="Denrées de première nécessité distribuées chaque mois..."
            :href="route('actions.show', 'distribution-alimentaire')"
            color="amber"
        />
--}}
@props([
    'icon' => 'gift',
    'title' => '',
    'subtitle' => '',
    'description' => '',
    'href' => '#',
    'color' => 'amber',  // amber | purple | pink | blue | green | rose
])

@php
    $colorMap = [
        'amber'  => ['bg' => 'bg-paper-gold',  'icon' => 'text-amber-700'],
        'purple' => ['bg' => 'bg-purple-50', 'icon' => 'text-purple-700'],
        'pink'   => ['bg' => 'bg-pink-50',   'icon' => 'text-pink-700'],
        'blue'   => ['bg' => 'bg-paper-blue',   'icon' => 'text-brand-blue'],
        'green'  => ['bg' => 'bg-emerald-50','icon' => 'text-emerald-700'],
        'rose'   => ['bg' => 'bg-rose-50',   'icon' => 'text-rose-700'],
    ];
    $c = $colorMap[$color] ?? $colorMap['amber'];

    $icons = [
        'cake'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 12V3m0 0L9 6m3-3l3 3M4 12h16v8a2 2 0 01-2 2H6a2 2 0 01-2-2v-8z M4 12V9a2 2 0 012-2h12a2 2 0 012 2v3"/>',
        'book'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>',
        'shopping-bag' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>',
        'hand'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"/>',
        'smile'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        'heart'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
        'gift'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>',
        'globe'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    ];
    $iconSvg = $icons[$icon] ?? $icons['gift'];
@endphp

<a href="{{ $href }}"
   class="group block relative overflow-hidden bg-white rounded-2xl border border-stone-200/70 hover:border-brand-gold/50
          hover-lift shadow-sm p-6 sm:p-7">

    {{-- Icône colorée --}}
    <div class="w-12 h-12 rounded-xl {{ $c['bg'] }} {{ $c['icon'] }} flex items-center justify-center mb-5
                transition-transform duration-300 group-hover:scale-110">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            {!! $iconSvg !!}
        </svg>
    </div>

    {{-- Contenu --}}
    <h3 class="font-display text-xl font-bold text-brand-blue-dk mb-1.5 group-hover:text-brand-blue transition-colors">
        {{ $title }}
    </h3>
    @if($subtitle)
        <p class="text-sm font-semibold text-amber-700 mb-3">{{ $subtitle }}</p>
    @endif
    @if($description)
        <p class="text-sm text-ink-grey leading-relaxed mb-5">{{ $description }}</p>
    @endif

    {{-- CTA "Découvrir" qui apparaît au hover --}}
    <div class="inline-flex items-center gap-1.5 text-sm font-semibold text-brand-blue
                opacity-70 group-hover:opacity-100 transition-opacity">
        <span>Découvrir cette action</span>
        <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
        </svg>
    </div>

    {{-- Accent doré coin haut-droit (visible au hover) --}}
    <div class="absolute top-0 right-0 w-20 h-20 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,0 L100,0 L100,100 Z" fill="url(#corner-grad)" opacity="0.08"/>
            <defs>
                <linearGradient id="corner-grad" x1="0" y1="0" x2="1" y2="1">
                    <stop offset="0%" stop-color="#D9A521"/>
                    <stop offset="100%" stop-color="#D9A521" stop-opacity="0"/>
                </linearGradient>
            </defs>
        </svg>
    </div>
</a>
