@extends('layouts.app')
@section('title', ($page->meta_title ?: $page->title) . ' — AMFDF')
@section('description', $page->meta_description)

@section('content')
@php
    // Sommaire auto-généré à partir des <h2> du contenu, et ajout d'ancres
    preg_match_all('/<h2>(.*?)<\/h2>/', (string) $page->body, $matches);
    $headings = $matches[1] ?? [];
    $bodyWithAnchors = (string) $page->body;
    foreach ($headings as $heading) {
        $bodyWithAnchors = str_replace(
            "<h2>{$heading}</h2>",
            '<h2 id="' . \Illuminate\Support\Str::slug($heading) . '">' . $heading . '</h2>',
            $bodyWithAnchors
        );
    }
@endphp

<x-page-hero :title="$page->title" />

<section class="py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-xs text-ink-grey uppercase tracking-wider mb-8">
            Dernière mise à jour : {{ $page->updated_at?->isoFormat('D MMMM YYYY') }}
        </p>

        @if(count($headings) > 1)
        <nav aria-label="Sommaire" class="bg-paper-blue/60 rounded-xl p-5 mb-10">
            <p class="text-xs font-semibold uppercase tracking-wider text-brand-blue mb-3">Sommaire</p>
            <ul class="space-y-1.5 text-sm">
                @foreach($headings as $heading)
                    <li><a href="#{{ \Illuminate\Support\Str::slug($heading) }}" class="text-brand-blue hover:text-brand-gold transition">{{ $heading }}</a></li>
                @endforeach
            </ul>
        </nav>
        @endif

        <div class="prose prose-lg max-w-none prose-headings:font-display prose-headings:text-brand-blue prose-headings:scroll-mt-24">
            @if($page->body)
                {!! $bodyWithAnchors !!}
            @else
                <p class="text-ink-grey">Le contenu de cette page sera bient&ocirc;t disponible.</p>
            @endif
        </div>
    </div>
</section>
@endsection
