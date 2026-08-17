{{--
    Carte témoignage améliorée — avec slot photo, plus de contexte,
    et lien vers la version complète du témoignage.

    Usage:
        <x-testimonial-card
            quote="Rejoindre le mouvement a transformé ma vision..."
            name="Marie Kouam"
            role="Bénévole"
            location="Paris"
            :photo="$testimonial->photo"
            :href="route('testimonials.show', $testimonial)"
        />
--}}
@props([
    'quote' => '',
    'name' => '',
    'role' => '',
    'location' => '',
    'photo' => null,         // chemin relatif au disque "public" (ex: testimonials/xxx.jpg), sinon avatar avec initiale
    'href' => null,          // lien vers le témoignage complet (optionnel)
])

@php
    $initial = mb_substr($name, 0, 1);
@endphp

<article class="group bg-white rounded-2xl border border-stone-200/70 shadow-sm hover:shadow-lg
                transition-all duration-300 hover:-translate-y-1 p-6 sm:p-7 flex flex-col">

    {{-- Guillemets décoratifs --}}
    <svg class="w-9 h-9 text-amber-200 mb-4 shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z"/>
    </svg>

    {{-- Citation en italique Playfair --}}
    <blockquote class="text-ink-dark italic font-display text-base leading-relaxed mb-6 flex-grow">
        « {{ $quote }} »
    </blockquote>

    {{-- Auteur --}}
    <div class="flex items-center gap-4 pt-5 border-t border-stone-100">
        {{-- Photo ou avatar avec initiale --}}
        @if($photo)
            <img src="{{ asset('storage/' . $photo) }}"
                 alt="{{ $name }}"
                 class="w-12 h-12 rounded-full object-cover shrink-0 border-2 border-brand-gold/20">
        @else
            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-brand-blue-dk to-brand-blue
                        text-white flex items-center justify-center font-bold text-lg shrink-0
                        border-2 border-brand-gold/20">
                {{ $initial }}
            </div>
        @endif

        <div class="flex-grow min-w-0">
            <p class="font-bold text-brand-blue-dk text-sm">{{ $name }}</p>
            <p class="text-xs text-ink-grey">
                @if($role){{ $role }}@endif
                @if($role && $location) · @endif
                @if($location){{ $location }}@endif
            </p>
        </div>
    </div>

    {{-- Lien "Lire son témoignage" (si fourni) --}}
    @if($href)
        <a href="{{ $href }}"
           class="inline-flex items-center gap-1.5 text-xs font-semibold text-brand-blue
                  hover:text-brand-blue-dk transition mt-4 self-start">
            <span>Lire son témoignage</span>
            <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:translate-x-0.5"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    @endif
</article>
