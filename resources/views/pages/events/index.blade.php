@extends('layouts.app')
@section('title', 'Événements — AMFDF')

@section('content')
<x-page-hero title="Événements" subtitle="Rejoignez-nous lors de nos prochains rendez-vous" />

<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <h2 class="font-display text-2xl font-bold text-brand-blue mb-6">À venir</h2>
        @if($upcomingEvents->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @foreach($upcomingEvents as $event)
                <x-event-card :event="$event" />
            @endforeach
        </div>
        @else
        <x-empty-state icon="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                        title="Aucun événement à venir pour le moment"
                        description="Revenez bientôt — nos prochains rendez-vous seront annoncés ici." />
        @endif

        @if($pastEvents->count())
        <h2 class="font-display text-2xl font-bold text-brand-blue mb-6">Passés</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($pastEvents as $event)
                <x-event-card :event="$event" />
            @endforeach
        </div>
        <div class="mt-12">{{ $pastEvents->links() }}</div>
        @endif
    </div>
</section>
@endsection
