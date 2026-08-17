@extends('layouts.app')
@section('title', 'Nos actions — AMFDF')
@section('description', $page->meta_description)

@section('content')
<x-page-hero title="Nos actions" subtitle="Soutien, espoir et assistance" />

<section class="py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="prose prose-lg mx-auto prose-headings:font-display prose-headings:text-brand-blue">
            @if($page->body)
                {!! $page->body !!}
            @else
                <p class="text-ink-grey">Le contenu de cette page sera bient&ocirc;t disponible.</p>
            @endif
        </div>
    </div>
</section>

{{-- Domaines d'intervention --}}
<section class="bg-paper-gold/30 py-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header kicker="Nos domaines" title="Ce que nous faisons concrètement" />

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6">
            <x-action-card icon="cake" color="amber" title="Distribution alimentaire"
                subtitle="Familles & personnes âgées"
                description="Denrées de première nécessité distribuées lors de nos missions de terrain."
                :href="route('gallery.index')" />
            <x-action-card icon="book" color="purple" title="Fournitures scolaires"
                subtitle="Enfants orphelins"
                description="Cartables, cahiers, stylos — nous équipons les enfants pour leur scolarité."
                :href="route('gallery.index')" />
            <x-action-card icon="shopping-bag" color="pink" title="Vêtements"
                subtitle="Toute personne vulnérable"
                description="Collecte et distribution de vêtements sans distinction."
                :href="route('gallery.index')" />
            <x-action-card icon="hand" color="rose" title="Accompagnement moral"
                subtitle="Veuves & personnes isolées"
                description="Visites, écoute et présence pour rompre la solitude."
                :href="route('gallery.index')" />
            <x-action-card icon="smile" color="green" title="Soutien au handicap"
                subtitle="Personnes en situation de handicap"
                description="Aide matérielle et accompagnement au quotidien."
                :href="route('gallery.index')" />
            <x-action-card icon="heart" color="blue" title="Solidarité internationale"
                subtitle="Cameroun & France"
                description="Missions de terrain menées dans nos deux pays d'action."
                :href="route('gallery.index')" />
        </div>
    </div>
</section>

{{-- Mission phare, avec vraies photos --}}
<section class="bg-white py-16 lg:py-24">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            <div class="lg:col-span-7 grid grid-cols-2 gap-3">
                <img src="{{ asset('storage/gallery/orphelinat-misericorde-divine-2026/distribution-17.jpg') }}"
                     alt="Distribution de denrées alimentaires à l'orphelinat"
                     class="col-span-2 aspect-[16/9] w-full object-cover rounded-2xl shadow-lg" loading="lazy">
                <img src="{{ asset('storage/gallery/orphelinat-misericorde-divine-2026/distribution-07.jpg') }}"
                     alt="Enfants de l'orphelinat La Miséricorde Divine"
                     class="aspect-square w-full object-cover rounded-2xl shadow-lg" loading="lazy">
                <img src="{{ asset('storage/gallery/orphelinat-misericorde-divine-2026/equipe-cameroun-01.jpg') }}"
                     alt="Équipe Mouvement des Femmes de Foi au Cameroun"
                     class="aspect-square w-full object-cover rounded-2xl shadow-lg" loading="lazy">
            </div>
            <div class="lg:col-span-5">
                <x-section-kicker>Notre première grande mission</x-section-kicker>
                <h2 class="font-display text-2xl sm:text-3xl font-bold text-brand-blue-dk leading-tight mb-4">
                    Orphelinat La Miséricorde Divine
                </h2>
                <p class="text-ink-dark leading-relaxed mb-6">
                    En avril 2026, notre équipe s'est rendue à l'orphelinat La Miséricorde Divine, à Yaoundé-Ayéné
                    (Cameroun), pour une distribution de denrées de première nécessité : riz, œufs, boissons et
                    produits d'hygiène. <strong>50 enfants</strong> ont été accompagnés lors de cette mission.
                </p>
                <x-button :href="route('gallery.show', 'orphelinat-misericorde-divine-2026')" variant="blue" icon>
                    Voir le reportage complet
                </x-button>
            </div>
        </div>
    </div>
</section>

@if(!empty($albums) && $albums->count())
<section class="bg-paper-blue/40 py-16 lg:py-24">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header kicker="Sur le terrain" title="En images" />
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($albums as $album)
                <x-album-card :album="$album" />
            @endforeach
        </div>
        <div class="text-center mt-10">
            <x-teaser-link :href="route('gallery.index')">Voir toute la galerie</x-teaser-link>
        </div>
    </div>
</section>
@endif
@endsection
