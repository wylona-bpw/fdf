{{--
    Kicker de section — petit titre au-dessus du titre principal.
    Couleur bronze sombre (text-amber-700) au lieu de l'or vif,
    pour réserver le brand-gold aux CTAs de conversion.

    Usage:
        <x-section-kicker>Qui sommes-nous</x-section-kicker>
        <x-section-kicker variant="light">Sur fond sombre</x-section-kicker>
--}}
@props([
    'variant' => 'default', // 'default' (sur fond clair) | 'light' (sur fond sombre)
])

@php
    $colorClass = match($variant) {
        'light' => 'text-brand-gold-lt',
        default => 'text-amber-700',
    };
@endphp

<span class="inline-block text-xs sm:text-sm font-semibold uppercase tracking-[0.2em] {{ $colorClass }} mb-3">
    {{ $slot }}
</span>
