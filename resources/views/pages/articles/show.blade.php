@extends('layouts.app')
@section('title', $article->meta_title ?: $article->title . ' — AMFDF')
@section('description', $article->meta_description ?: $article->excerpt)

@section('content')
<article class="py-12 md:py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($article->category)
        <a href="{{ route('articles.index') }}" class="text-brand-gold font-semibold text-sm uppercase tracking-wider hover:underline">{{ $article->category->name }}</a>
        @endif

        <h1 class="font-display text-3xl md:text-4xl font-bold text-brand-blue mt-2 mb-4">{{ $article->title }}</h1>

        <div class="flex items-center gap-4 text-sm text-ink-grey mb-8">
            <time datetime="{{ $article->published_at?->toDateString() }}">{{ $article->published_at?->isoFormat('D MMMM YYYY') }}</time>
            <span>&bull;</span>
            <span>{{ $article->reading_time }} min de lecture</span>
        </div>

        @if($article->cover_url)
        <img src="{{ $article->cover_url }}" alt="{{ $article->title }}" class="w-full rounded-xl mb-8 shadow-md">
        @endif

        <div class="prose prose-lg max-w-none prose-headings:font-display prose-headings:text-brand-blue prose-a:text-brand-blue">
            {!! $article->body !!}
        </div>

        <!-- Related -->
        @if($related->count())
        <div class="mt-16 pt-8 border-t border-gray-100">
            <h2 class="font-display text-2xl font-bold text-brand-blue mb-6">Articles li&eacute;s</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($related as $r)
                    <x-article-card :article="$r" />
                @endforeach
            </div>
        </div>
        @endif

        <div class="mt-8">
            <a href="{{ route('articles.index') }}" class="text-brand-blue font-semibold hover:text-brand-gold transition">&larr; Retour aux actualit&eacute;s</a>
        </div>
    </div>
</article>
@endsection
