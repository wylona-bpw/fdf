{{--
    Bouton d'action — remplace les ~8 boutons "Faire un don" / "Devenir
    bénévole" dupliqués (header desktop/mobile, hero, CTA final).

    Usage :
        <x-button :href="route('donate')" icon>Faire un don</x-button>
        <x-button :href="route('volunteer.create')" variant="secondary">Devenir bénévole</x-button>
        <x-button :href="route('association')" variant="blue" size="sm" icon>Découvrir notre histoire</x-button>
--}}
@props([
    'href' => '#',
    'variant' => 'primary', // 'primary' (or, sur fond sombre) | 'secondary' (contour blanc, sur fond sombre) | 'blue' (bleu plein, sur fond clair)
    'size' => 'lg',         // 'sm' (nav/header) | 'lg' (hero, CTA final)
    'icon' => false,        // flèche animée au hover
])

@php
    $isLg = $size === 'lg';
    $sizeClass = $isLg ? 'px-7 py-4' : 'px-4 py-2 text-sm';
    $liftClass = $isLg ? 'hover:-translate-y-0.5' : '';
    $variantClass = match($variant) {
        'secondary' => 'border-2 border-white/30 text-white font-semibold hover:bg-white/10 hover:border-white/50',
        'blue' => 'bg-brand-blue text-white font-semibold hover:bg-brand-blue-dk shadow-md',
        default => $isLg
            ? 'bg-brand-gold text-brand-blue-dk font-bold hover:bg-brand-gold-lt shadow-xl hover:shadow-2xl'
            : 'bg-brand-gold text-brand-blue-dk font-bold hover:bg-brand-gold-lt shadow-md',
    };
@endphp

<a href="{{ $href }}"
   {{ $attributes->merge(['class' => "group inline-flex items-center justify-center gap-2 $sizeClass rounded-lg transition transition-transform $liftClass $variantClass"]) }}>
    <span>{{ $slot }}</span>
    @if($icon)
        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1"
             fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
        </svg>
    @endif
</a>
