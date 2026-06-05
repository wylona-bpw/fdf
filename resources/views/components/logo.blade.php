{{--
    Composant logo réutilisable pour le site public.
    Usage :
        <x-logo />                              {{-- Logo + wordmark (header) --}}
        <x-logo size="small" />                 {{-- Petit (footer) --}}
        <x-logo :wordmark="false" />            {{-- Cercle seul --}}
        <x-logo class="text-white" />           {{-- Pour fond sombre --}}
--}}
@props([
    'size' => 'default',      // 'small' | 'default' | 'large'
    'wordmark' => true,       // Afficher le wordmark "AMFDF / Femmes de Foi"
    'link' => true,           // Wrapper avec lien vers /
])

@php
    $dims = match($size) {
        'small' => ['img' => 36, 'name' => '1rem', 'sub' => '0.55rem'],
        'large' => ['img' => 64, 'name' => '1.5rem', 'sub' => '0.7rem'],
        default => ['img' => 48, 'name' => '1.25rem', 'sub' => '0.625rem'],
    };
    $src = match($size) {
        'large' => asset('images/logo-amfdf-256.png'),
        default => asset('images/logo-amfdf-128.png'),
    };
@endphp

@if($link)
<a href="{{ url('/') }}" {{ $attributes->merge(['class' => 'inline-flex items-center gap-3 group']) }}
   aria-label="AMFDF — Mouvement des Femmes de Foi">
@else
<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-3']) }}>
@endif

    <img src="{{ $src }}"
         alt=""
         width="{{ $dims['img'] }}" height="{{ $dims['img'] }}"
         class="object-contain transition-opacity {{ $link ? 'group-hover:opacity-85' : '' }}"
         style="filter: drop-shadow(0 1px 3px rgba(8, 21, 56, 0.1));"
         loading="eager">

    @if($wordmark)
    <span class="flex flex-col leading-none">
        <span class="font-display font-bold tracking-wider"
              style="font-size: {{ $dims['name'] }}; letter-spacing: 0.08em; color: currentColor;">AMFDF</span>
        <span class="font-sans font-semibold uppercase mt-0.5 opacity-80"
              style="font-size: {{ $dims['sub'] }}; letter-spacing: 0.18em;">Femmes de Foi</span>
    </span>
    @endif

@if($link)</a>@else</span>@endif
