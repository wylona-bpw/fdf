@extends('layouts.app')
@section('title', $testimonial->name . ' — Témoignage AMFDF')
@section('description', \Illuminate\Support\Str::limit(strip_tags($testimonial->content), 155))

@section('content')
<section class="bg-brand-blue py-12 text-center">
    <h1 class="font-display text-3xl md:text-4xl font-bold text-white">Témoignage</h1>
</section>

<section class="py-16">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <article class="bg-white rounded-2xl border border-stone-200/70 shadow-sm p-8 sm:p-10">
            <svg class="w-10 h-10 text-amber-200 mb-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M9.983 3v7.391c0 5.704-3.731 9.57-8.983 10.609l-.995-2.151c2.432-.917 3.995-3.638 3.995-5.849h-4v-10h9.983zm14.017 0v7.391c0 5.704-3.748 9.571-9 10.609l-.996-2.151c2.433-.917 3.996-3.638 3.996-5.849h-3.983v-10h9.983z"/>
            </svg>
            <blockquote class="text-ink-dark italic font-display text-xl leading-relaxed mb-8">
                « {{ $testimonial->content }} »
            </blockquote>
            <div class="flex items-center gap-4 pt-6 border-t border-stone-100">
                @if($testimonial->photo)
                    <img src="{{ asset($testimonial->photo) }}" alt="{{ $testimonial->name }}"
                         class="w-14 h-14 rounded-full object-cover shrink-0 border-2 border-brand-gold/20">
                @else
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-brand-blue-dk to-brand-blue
                                text-white flex items-center justify-center font-bold text-xl shrink-0
                                border-2 border-brand-gold/20">
                        {{ mb_substr($testimonial->name, 0, 1) }}
                    </div>
                @endif
                <div>
                    <p class="font-bold text-brand-blue-dk">{{ $testimonial->name }}</p>
                    <p class="text-sm text-ink-grey">{{ $testimonial->role }}</p>
                </div>
            </div>
        </article>

        @if($related->isNotEmpty())
        <div class="mt-14">
            <h2 class="font-display text-xl font-bold text-brand-blue-dk mb-6">Autres témoignages</h2>
            <div class="grid sm:grid-cols-2 gap-5">
                @foreach($related as $r)
                    <x-testimonial-card
                        quote="{{ $r->content }}"
                        name="{{ $r->name }}"
                        role="{{ $r->role }}"
                        :photo="$r->photo"
                        href="{{ route('testimonials.show', $r) }}" />
                @endforeach
            </div>
        </div>
        @endif

        <div class="mt-10">
            <a href="{{ route('testimonials.index') }}" class="text-brand-blue font-semibold hover:text-brand-gold transition">&larr; Tous les témoignages</a>
        </div>
    </div>
</section>
@endsection
