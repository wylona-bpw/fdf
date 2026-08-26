@extends('layouts.app')
@section('title', $event->title . ' — AMFDF')
@section('description', $event->excerpt)

@section('content')
<article class="py-12 md:py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <span class="text-brand-gold font-semibold text-sm uppercase tracking-wider">
            {{ $event->is_past ? 'Événement passé' : 'Événement à venir' }}
        </span>

        <h1 class="font-display text-3xl md:text-4xl font-bold text-brand-blue mt-2 mb-4">{{ $event->title }}</h1>

        <div class="flex flex-wrap items-center gap-4 text-sm text-ink-grey mb-8">
            <time datetime="{{ $event->event_date->toDateString() }}">{{ $event->event_date->isoFormat('dddd D MMMM YYYY') }}</time>
            @if($event->event_time)
            <span>&bull;</span>
            <span>{{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }}</span>
            @endif
            @if($event->location)
            <span>&bull;</span>
            <span>{{ $event->location }}</span>
            @endif
        </div>

        @if($event->cover_url)
        <img src="{{ $event->cover_url }}" alt="{{ $event->title }}" class="w-full rounded-xl mb-8 shadow-md">
        @endif

        @if($event->excerpt)
        <p class="text-lg text-ink-dark leading-relaxed mb-6">{{ $event->excerpt }}</p>
        @endif

        @if($event->body)
        <div class="prose prose-lg max-w-none prose-headings:font-display prose-headings:text-brand-blue prose-a:text-brand-blue">
            {!! $event->body !!}
        </div>
        @endif

        @if($event->registration_url && !$event->is_past)
        <div class="mt-8">
            <a href="{{ $event->registration_url }}" target="_blank" rel="noopener noreferrer"
               class="inline-flex items-center gap-2 px-8 py-4 bg-brand-gold text-brand-blue-dk font-bold rounded-lg
                      hover:bg-brand-gold-lt transition shadow-lg">
                S'inscrire à cet événement
            </a>
        </div>
        @endif

        <div class="mt-10">
            <a href="{{ route('events.index') }}" class="text-brand-blue font-semibold hover:text-brand-gold transition">&larr; Retour aux événements</a>
        </div>
    </div>
</article>
@endsection
