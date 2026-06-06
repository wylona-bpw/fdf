{{--
    Carte mission pour la galerie d'accueil — chaque carte est un album cliquable.

    Usage:
        <x-mission-card
            title="Distribution fournitures"
            date="Mai 2026"
            location="Yaoundé"
            photo="images/missions/may-2026.jpg"
            :href="route('gallery.show', 'distribution-mai-2026')"
            :photoCount="24"
        />

    Si pas de photo, affiche un placeholder élégant.
--}}
@props([
    'title' => '',
    'date' => '',
    'location' => '',
    'photo' => null,
    'href' => '#',
    'photoCount' => null,
])

<a href="{{ $href }}"
   class="group block relative overflow-hidden rounded-2xl aspect-[4/5] shadow-md hover:shadow-2xl
          transition-all duration-500 hover:-translate-y-1">

    {{-- Photo ou placeholder --}}
    @if($photo)
        <img src="{{ asset($photo) }}"
             alt="{{ $title }}"
             class="absolute inset-0 w-full h-full object-cover
                    transition-transform duration-700 group-hover:scale-110">
    @else
        <x-photo-placeholder ratio="aspect-[4/5]" variant="subtle" rounded="" />
    @endif

    {{-- Overlay dégradé pour lisibilité du texte --}}
    <div class="absolute inset-0 bg-gradient-to-t from-brand-blue-dk/95 via-brand-blue-dk/60 to-transparent
                opacity-90 group-hover:opacity-100 transition-opacity"></div>

    {{-- Badge nombre de photos (top-right) --}}
    @if($photoCount)
        <div class="absolute top-4 right-4 bg-brand-gold/95 text-brand-blue-dk
                    text-xs font-bold px-3 py-1 rounded-full backdrop-blur-sm">
            {{ $photoCount }} photos
        </div>
    @endif

    {{-- Contenu en bas --}}
    <div class="absolute bottom-0 inset-x-0 p-5 text-white">
        @if($date || $location)
            <p class="text-xs font-medium text-brand-gold-lt mb-1.5 uppercase tracking-wider">
                @if($location){{ $location }}@endif
                @if($date && $location) · @endif
                @if($date){{ $date }}@endif
            </p>
        @endif
        <h3 class="font-display text-lg font-bold leading-tight mb-3">{{ $title }}</h3>

        {{-- "Voir l'album" qui apparaît au hover --}}
        <span class="inline-flex items-center gap-1.5 text-xs font-semibold
                     opacity-0 -translate-y-1 group-hover:opacity-100 group-hover:translate-y-0
                     transition-all duration-300">
            <span>Voir l'album</span>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </span>
    </div>
</a>
