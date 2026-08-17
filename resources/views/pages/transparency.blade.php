@extends('layouts.app')
@section('title', 'Transparence — AMFDF')
@section('description', $page->meta_description)

@section('content')
<x-page-hero title="Transparence" subtitle="Notre engagement envers vous" />

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

{{-- Chiffres — mêmes données réelles que la home, sourcées --}}
<section class="bg-paper-gold py-14">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            @php
                $statsData = [
                    ['value' => setting('stat_people_helped', '50'), 'label' => 'Enfants aidés'],
                    ['value' => setting('stat_volunteers', '20'),    'label' => 'Bénévoles actifs'],
                    ['value' => setting('stat_actions', '3'),         'label' => 'Actions menées'],
                    ['value' => setting('stat_countries', '2'),       'label' => 'Pays touchés'],
                ];
            @endphp
            @foreach($statsData as $stat)
                <div class="text-center">
                    <div class="font-display text-3xl sm:text-4xl font-bold text-brand-blue-dk leading-none mb-2">{{ $stat['value'] }}</div>
                    <div class="text-sm text-ink-grey font-medium">{{ $stat['label'] }}</div>
                </div>
            @endforeach
        </div>
        <p class="text-center text-xs text-ink-grey italic mt-8">Depuis la création du mouvement (2025) — chiffres mis à jour après chaque mission.</p>
    </div>
</section>

{{-- Engagement --}}
<section class="bg-white py-16 lg:py-24">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header kicker="Notre engagement" title="Comment nous gérons les dons" />

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 lg:gap-6">
            <div class="bg-paper-blue/70 rounded-2xl p-7 text-center border border-paper-blue">
                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-white shadow-sm flex items-center justify-center">
                    <svg class="w-7 h-7 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="font-display text-xl font-bold text-brand-blue-dk mb-2">100% terrain</h3>
                <p class="text-sm text-ink-grey">Chaque don sert directement aux actions de terrain.</p>
            </div>
            <div class="bg-paper-blue/70 rounded-2xl p-7 text-center border border-paper-blue">
                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-white shadow-sm flex items-center justify-center">
                    <svg class="w-7 h-7 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h3 class="font-display text-xl font-bold text-brand-blue-dk mb-2">Association loi 1901</h3>
                <p class="text-sm text-ink-grey">RNA {{ setting('rna_number', 'W784011796') }} — gestion rigoureuse et contrôlée.</p>
            </div>
            <div class="bg-paper-blue/70 rounded-2xl p-7 text-center border border-paper-blue">
                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-white shadow-sm flex items-center justify-center">
                    <svg class="w-7 h-7 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="font-display text-xl font-bold text-brand-blue-dk mb-2">Rapport annuel</h3>
                <p class="text-sm text-ink-grey">Bilan d'activité disponible sur demande à {{ setting('email') }}.</p>
            </div>
        </div>
    </div>
</section>

{{-- Dernière mission financée --}}
<section class="bg-paper-blue/40 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden grid sm:grid-cols-5">
            <img src="{{ asset('storage/gallery/orphelinat-misericorde-divine-2026/distribution-17.jpg') }}"
                 alt="Distribution à l'orphelinat La Miséricorde Divine"
                 class="sm:col-span-2 w-full h-48 sm:h-full object-cover" loading="lazy">
            <div class="sm:col-span-3 p-7">
                <p class="text-xs font-semibold uppercase tracking-wider text-amber-700 mb-2">Avril 2026 · Yaoundé-Ayéné, Cameroun</p>
                <h3 class="font-display text-lg font-bold text-brand-blue-dk mb-2">Où est parti le dernier don ?</h3>
                <p class="text-sm text-ink-grey mb-4">Denrées de première nécessité (riz, œufs, boissons, produits d'hygiène) pour 50 enfants de l'orphelinat La Miséricorde Divine.</p>
                <x-teaser-link :href="route('gallery.show', 'orphelinat-misericorde-divine-2026')">Voir le reportage</x-teaser-link>
            </div>
        </div>
    </div>
</section>
@endsection
