{{--
    En-tête de page secondaire — bandeau bleu titre + sous-titre.
    Remplace le même bloc dupliqué sur 9 pages (association, actions, dons,
    galerie, témoignages, bénévolat, actualités...).

    Usage :
        <x-page-hero title="Nos actions" subtitle="Soutien, espoir et assistance" />
        <x-page-hero title="L'association" quote="Avec la foi, tout est possible" />
--}}
@props([
    'title',
    'subtitle' => null,
    'quote' => null,
])

<section class="bg-brand-blue py-12 text-center">
    <h1 class="font-display text-3xl md:text-4xl font-bold text-white">{{ $title }}</h1>
    @if($quote)
        <p class="text-brand-gold-lt italic font-display mt-2">&laquo; {{ $quote }} &raquo;</p>
    @elseif($subtitle)
        <p class="text-white/60 mt-2">{{ $subtitle }}</p>
    @endif
</section>
