@extends('layouts.app')
@section('title', $album->title . ' — Galerie AMFDF')

@section('content')
<x-page-hero :title="$album->title" :subtitle="$album->event_date ? $album->event_date->isoFormat('D MMMM YYYY') . ($album->location ? ' • ' . $album->location : '') : null" />

@php $total = $album->items->count(); @endphp

<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($album->description)
        <p class="text-ink-grey max-w-2xl mb-8">{{ $album->description }}</p>
        @endif

        <div x-data="{
                open: false,
                index: 0,
                total: {{ $total }},
                openAt(i) { this.index = i; this.open = true; },
                close() { this.open = false; },
                next() { if (this.index < this.total - 1) this.index++; },
                prev() { if (this.index > 0) this.index--; },
                touchStartX: 0,
                onTouchStart(e) { this.touchStartX = e.changedTouches[0].clientX; },
                onTouchEnd(e) {
                    const dx = e.changedTouches[0].clientX - this.touchStartX;
                    if (dx > 60) this.prev();
                    else if (dx < -60) this.next();
                },
             }">

            {{-- Grille de vignettes — vrais boutons, accessibles au clavier --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($album->items as $i => $item)
                <button type="button"
                        @click="openAt({{ $i }})"
                        aria-label="{{ $item->is_video ? 'Voir la vidéo' : 'Voir la photo' }} {{ $i + 1 }} sur {{ $total }}{{ $item->caption ? ' — ' . $item->caption : '' }}"
                        class="group relative rounded-lg overflow-hidden aspect-square focus-visible:ring-2 focus-visible:ring-brand-gold focus-visible:ring-offset-2">
                    @if($item->is_video)
                        <img src="{{ $item->thumbnail_url ?? $item->url }}" alt=""
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <span class="absolute inset-0 bg-black/25 flex items-center justify-center">
                            <span class="w-12 h-12 rounded-full bg-white/90 flex items-center justify-center shadow-lg">
                                <svg class="w-5 h-5 text-brand-blue-dk translate-x-0.5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
                            </span>
                        </span>
                    @else
                        <img src="{{ $item->url }}" alt=""
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @endif
                </button>
                @endforeach
            </div>

            {{-- Lightbox --}}
            <div x-show="open"
                 x-cloak
                 x-trap.inert.noscroll="open"
                 role="dialog"
                 aria-modal="true"
                 :aria-label="'{{ addslashes($album->title) }} — photo ' + (index + 1) + ' sur {{ $total }}'"
                 @keydown.escape.window="open && close()"
                 @keydown.arrow-left.window="open && prev()"
                 @keydown.arrow-right.window="open && next()"
                 @touchstart="onTouchStart($event)"
                 @touchend="onTouchEnd($event)"
                 @click.self="close()"
                 class="fixed inset-0 z-50 bg-black/90 flex items-center justify-center p-4">

                <button type="button" @click="close()" aria-label="Fermer"
                        class="absolute top-4 right-4 text-white/80 hover:text-white p-2 focus-visible:ring-2 focus-visible:ring-brand-gold rounded-lg">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>

                {{-- Compteur --}}
                <p class="absolute top-4 left-4 text-white/70 text-sm font-medium tabular-nums" aria-live="polite">
                    <span x-text="index + 1"></span> / {{ $total }}
                </p>

                @foreach($album->items as $i => $item)
                    <div x-show="index === {{ $i }}" class="max-w-full max-h-[85vh] flex flex-col items-center gap-3">
                        @if($item->is_video)
                            <video x-show="index === {{ $i }}" src="{{ $item->url }}" controls playsinline
                                   class="max-w-full max-h-[75vh] rounded-lg"></video>
                        @else
                            <img src="{{ $item->url }}" alt="{{ $item->caption }}"
                                 class="max-w-full max-h-[75vh] rounded-lg object-contain">
                        @endif
                        @if($item->caption)
                            <p class="text-white/70 text-sm text-center">{{ $item->caption }}</p>
                        @endif
                    </div>
                @endforeach

                <button type="button" @click="prev()" :disabled="index === 0" :aria-disabled="(index === 0).toString()"
                        aria-label="Photo précédente"
                        class="absolute left-2 sm:left-4 text-white p-3 rounded-full hover:bg-white/10 focus-visible:ring-2 focus-visible:ring-brand-gold transition disabled:opacity-30 disabled:pointer-events-none">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button type="button" @click="next()" :disabled="index === total - 1" :aria-disabled="(index === total - 1).toString()"
                        aria-label="Photo suivante"
                        class="absolute right-2 sm:right-4 text-white p-3 rounded-full hover:bg-white/10 focus-visible:ring-2 focus-visible:ring-brand-gold transition disabled:opacity-30 disabled:pointer-events-none">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        <div class="mt-8">
            <a href="{{ route('gallery.index') }}" class="text-brand-blue font-semibold hover:text-brand-gold transition">&larr; Retour &agrave; la galerie</a>
        </div>
    </div>
</section>
@endsection
