@extends('layouts.app')
@section('title', 'Nos actions — AMFDF')

@section('content')
<x-page-hero title="Nos actions" subtitle="Soutien, espoir et assistance" />

<section class="py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 prose prose-lg max-w-none prose-headings:font-display prose-headings:text-brand-blue">
        @if($page->body)
            {!! $page->body !!}
        @else
            <p class="text-ink-grey">Le contenu de cette page sera bient&ocirc;t disponible.</p>
        @endif
    </div>

    @if(!empty($albums) && $albums->count())
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-14">
        <h2 class="font-display text-2xl font-bold text-brand-blue mb-6">En images</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($albums as $album)
                <x-album-card :album="$album" />
            @endforeach
        </div>
        <div class="mt-8">
            <a href="{{ route('gallery.index') }}" class="text-brand-blue font-semibold hover:text-brand-gold transition">Voir toute la galerie &rarr;</a>
        </div>
    </div>
    @endif
</section>
@endsection
