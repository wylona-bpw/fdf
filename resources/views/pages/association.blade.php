@extends('layouts.app')
@section('title', 'L\'association — AMFDF')

@section('content')
<section class="bg-brand-blue py-12 text-center">
    <h1 class="font-display text-3xl md:text-4xl font-bold text-white">L'association</h1>
    <p class="text-brand-gold-lt italic font-display mt-2">&laquo; Avec la foi, tout est possible &raquo;</p>
</section>

<section class="py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 prose prose-lg max-w-none prose-headings:font-display prose-headings:text-brand-blue">
        @if($page->body)
            {!! $page->body !!}
        @else
            <p class="text-ink-grey">Le contenu de cette page sera bient&ocirc;t disponible. Vous pouvez le r&eacute;diger depuis l'<a href="/admin" class="text-brand-blue">espace d'administration</a>.</p>
        @endif
    </div>
</section>

{{-- Équipe --}}
<section class="bg-paper-gold/30 py-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <x-section-kicker>Nos équipes</x-section-kicker>
            <h2 class="font-display text-2xl sm:text-3xl font-bold text-brand-blue-dk">Au Cameroun et en France</h2>
        </div>
        <div class="grid sm:grid-cols-2 gap-6">
            <div class="rounded-2xl overflow-hidden shadow-lg">
                <img src="{{ asset('images/team/equipe-france-01.jpg') }}" alt="Équipe France du Mouvement des Femmes de Foi"
                     class="w-full aspect-[4/3] object-cover" loading="lazy">
                <div class="bg-white px-5 py-3">
                    <p class="font-display font-semibold text-brand-blue-dk">Équipe France</p>
                    <p class="text-sm text-ink-grey">Guyancourt (78)</p>
                </div>
            </div>
            <div class="rounded-2xl overflow-hidden shadow-lg">
                <img src="{{ asset('storage/gallery/orphelinat-misericorde-divine-2026/equipe-cameroun-01.jpg') }}" alt="Équipe Cameroun du Mouvement des Femmes de Foi"
                     class="w-full aspect-[4/3] object-cover" loading="lazy">
                <div class="bg-white px-5 py-3">
                    <p class="font-display font-semibold text-brand-blue-dk">Équipe Cameroun</p>
                    <p class="text-sm text-ink-grey">Yaoundé</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
