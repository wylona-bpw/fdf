@extends('layouts.app')
@section('title', 'Actualités — AMFDF')

@section('content')
<x-page-hero title="Actualités" subtitle="Suivez nos actions et nos projets" />

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
        <x-empty-state icon="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"
                        title="Aucune actualité pour le moment"
                        description="Revenez bientôt — nos prochaines missions y seront racontées." />
        @endif
    </div>
</section>
@endsection
