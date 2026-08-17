@extends('layouts.app')
@section('title', $album->title . ' — Galerie AMFDF')

@section('content')
<section class="bg-brand-blue py-12 text-center">
    <h1 class="font-display text-3xl font-bold text-white">{{ $album->title }}</h1>
    @if($album->event_date)
    <p class="text-white/60 mt-1">{{ $album->event_date->isoFormat('D MMMM YYYY') }}@if($album->location) &bull; {{ $album->location }}@endif</p>
    @endif
</section>

<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($album->description)
        <p class="text-ink-grey max-w-2xl mb-8">{{ $album->description }}</p>
        @endif

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" x-data="{ lightbox: null }">
            @foreach($album->items as $i => $item)
            <div @click="lightbox = {{ $i }}" class="cursor-pointer rounded-lg overflow-hidden group aspect-square">
                @if($item->is_video)
                <div class="w-full h-full bg-ink-dark flex items-center justify-center relative">
                    <svg class="w-12 h-12 text-white/70" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                </div>
                @else
                <img src="{{ $item->url }}" alt="{{ $item->caption }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @endif
            </div>
            @endforeach

            <!-- Lightbox -->
            <template x-if="lightbox !== null">
                <div class="fixed inset-0 z-50 bg-black/90 flex items-center justify-center p-4" @click.self="lightbox = null" @keydown.escape.window="lightbox = null">
                    <button @click="lightbox = null" class="absolute top-4 right-4 text-white text-3xl">&times;</button>
                    @foreach($album->items as $i => $item)
                        @if($item->is_video)
                        <video x-show="lightbox === {{ $i }}" src="{{ $item->url }}" controls playsinline
                               class="max-w-full max-h-[85vh] rounded-lg"></video>
                        @else
                        <img x-show="lightbox === {{ $i }}" src="{{ $item->url }}" alt="{{ $item->caption }}"
                             class="max-w-full max-h-[85vh] rounded-lg object-contain">
                        @endif
                    @endforeach
                    <button @click="lightbox = Math.max(0, lightbox - 1)" class="absolute left-4 text-white text-4xl">&lsaquo;</button>
                    <button @click="lightbox = Math.min({{ count($album->items) - 1 }}, lightbox + 1)" class="absolute right-4 text-white text-4xl">&rsaquo;</button>
                </div>
            </template>
        </div>

        <div class="mt-8">
            <a href="{{ route('gallery.index') }}" class="text-brand-blue font-semibold hover:text-brand-gold transition">&larr; Retour &agrave; la galerie</a>
        </div>
    </div>
</section>
@endsection
