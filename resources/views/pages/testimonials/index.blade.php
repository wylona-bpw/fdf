@extends('layouts.app')
@section('title', 'Témoignages — AMFDF')
@section('description', "Témoignages des bénévoles, bénéficiaires et partenaires du Mouvement des Femmes de Foi.")

@section('content')
<section class="bg-brand-blue py-12 text-center">
    <h1 class="font-display text-3xl md:text-4xl font-bold text-white">Témoignages</h1>
    <p class="text-white/60 mt-2">Ils nous font confiance</p>
</section>

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
        <p class="text-center text-ink-grey py-12">Les témoignages seront bientôt publiés ici.</p>
        @endif
    </div>
</section>
@endsection
