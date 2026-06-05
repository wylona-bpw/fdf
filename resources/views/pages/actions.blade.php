@extends('layouts.app')
@section('title', 'Nos actions — AMFDF')

@section('content')
<section class="bg-brand-blue py-12 text-center">
    <h1 class="font-display text-3xl md:text-4xl font-bold text-white">Nos actions</h1>
    <p class="text-white/60 mt-2">Soutien, espoir et assistance</p>
</section>

<section class="py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 prose prose-lg max-w-none prose-headings:font-display prose-headings:text-brand-blue">
        @if($page->body)
            {!! $page->body !!}
        @else
            <p class="text-ink-grey">Le contenu de cette page sera bient&ocirc;t disponible.</p>
        @endif
    </div>
</section>
@endsection
