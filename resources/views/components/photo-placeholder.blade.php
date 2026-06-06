{{--
    Placeholder photo élégant — remplace les "Bientôt disponible" basiques.
    Affiche un gradient brand subtil avec motif de points dorés.

    Usage:
        <x-photo-placeholder ratio="aspect-square" label="Photo d'équipe" />
        <x-photo-placeholder ratio="aspect-[4/3]" label="Distribution alimentaire" />

    Pour intégrer une vraie photo, remplace par <img> simple.
--}}
@props([
    'ratio' => 'aspect-[4/3]',  // aspect-square, aspect-video, aspect-[4/3], etc.
    'label' => null,
    'variant' => 'default',     // 'default' (cream/beige) | 'blue' (sur fond clair) | 'subtle' (sur fond cream)
    'rounded' => 'rounded-2xl',
])

@php
    $variantClasses = match($variant) {
        'blue'   => 'bg-gradient-to-br from-brand-blue-dk via-brand-blue to-brand-blue-dk text-white/30',
        'subtle' => 'bg-gradient-to-br from-stone-100 via-stone-50 to-stone-100 text-stone-400',
        default  => 'bg-gradient-to-br from-amber-50 via-stone-50 to-amber-50/60 text-amber-700/40',
    };
@endphp

<div class="relative overflow-hidden {{ $ratio }} {{ $rounded }} {{ $variantClasses }} flex items-center justify-center">
    {{-- Motif décoratif points dorés --}}
    <svg class="absolute inset-0 w-full h-full opacity-30" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <defs>
            <pattern id="dot-pattern-{{ uniqid() }}" x="0" y="0" width="24" height="24" patternUnits="userSpaceOnUse">
                <circle cx="12" cy="12" r="1" fill="currentColor"/>
            </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#dot-pattern-{{ uniqid() }})"/>
    </svg>

    {{-- Cercle décoratif coin haut-droit --}}
    <svg class="absolute -top-12 -right-12 w-48 h-48 opacity-20" viewBox="0 0 200 200" aria-hidden="true">
        <circle cx="100" cy="100" r="90" fill="none" stroke="currentColor" stroke-width="1"/>
        <circle cx="100" cy="100" r="60" fill="none" stroke="currentColor" stroke-width="0.5"/>
    </svg>

    {{-- Contenu centré --}}
    <div class="relative z-10 text-center px-6">
        {{-- Icône photo stylisée --}}
        <svg class="w-12 h-12 mx-auto mb-2 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        @if($label)
            <p class="text-xs font-medium tracking-wider uppercase opacity-70">{{ $label }}</p>
        @endif
    </div>

    {{ $slot ?? '' }}
</div>
