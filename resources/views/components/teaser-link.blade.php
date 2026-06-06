{{--
    Lien d'exploration avec flèche animée — usage massif pour pousser
    le visiteur à cliquer vers d'autres pages.

    Usage:
        <x-teaser-link :href="route('actions')">Voir toutes nos actions</x-teaser-link>
        <x-teaser-link :href="route('gallery.index')" variant="light">Explorer la galerie</x-teaser-link>
--}}
@props([
    'href' => '#',
    'variant' => 'default', // 'default' | 'light' | 'gold'
])

@php
    $base = 'group inline-flex items-center gap-2 font-semibold text-sm transition';
    $variantClass = match($variant) {
        'light' => 'text-white hover:text-brand-gold-lt',
        'gold'  => 'text-brand-gold hover:text-brand-gold-lt',
        default => 'text-brand-blue hover:text-brand-blue-dk',
    };
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => "$base $variantClass"]) }}>
    <span>{{ $slot }}</span>
    <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1"
         fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
    </svg>
</a>
