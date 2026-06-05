@extends('layouts.app')
@section('title', 'Actualités — AMFDF')

@section('content')
<section class="bg-brand-blue py-12 text-center">
    <h1 class="font-display text-3xl md:text-4xl font-bold text-white">Actualit&eacute;s</h1>
    <p class="text-white/60 mt-2">Suivez nos actions et nos projets</p>
</section>

<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($articles->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articles as $article)
                <x-article-card :article="$article" />
            @endforeach
        </div>
        <div class="mt-12">{{ $articles->links() }}</div>
        @else
        <p class="text-center text-ink-grey py-12">Aucune actualit&eacute; pour le moment. Revenez bient&ocirc;t !</p>
        @endif
    </div>
</section>
@endsection
