@extends('layouts.app')
@section('title', 'Témoignages — AMFDF')
@section('description', "Témoignages des bénévoles, bénéficiaires et partenaires du Mouvement des Femmes de Foi.")

@section('content')
<x-page-hero title="Témoignages" subtitle="Ils nous font confiance" />

<section class="py-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($page?->body)
        <div class="prose prose-lg max-w-none prose-headings:font-display prose-headings:text-brand-blue mb-12">
            {!! $page->body !!}
        </div>
        @endif

        @if($testimonials->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($testimonials as $testimonial)
                <x-testimonial-card
                    quote="{{ $testimonial->content }}"
                    name="{{ $testimonial->name }}"
                    role="{{ $testimonial->role }}"
                    :photo="$testimonial->photo"
                    href="{{ route('testimonials.show', $testimonial) }}" />
            @endforeach
        </div>
        <div class="mt-12">{{ $testimonials->links() }}</div>
        @else
        <x-empty-state icon="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                        title="Les témoignages seront bientôt publiés ici"
                        description="Vous êtes bénévole ou bénéficiaire ? Partagez votre expérience."
                        action-label="Nous écrire"
                        :action-href="route('contact.create')" />
        @endif
    </div>
</section>
@endsection
