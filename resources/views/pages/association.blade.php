@extends('layouts.app')
@section('title', 'L\'association — AMFDF')

@section('content')
<section class="bg-brand-blue py-12 text-center">
    <h1 class="font-display text-3xl md:text-4xl font-bold text-white">L'association</h1>
    <p class="text-brand-gold-lt italic font-display mt-2">&laquo; Avec la foi, tout est possible &raquo;</p>
</section>

<section class="py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 prose prose-lg max-w-none prose-headings:font-display prose-headings:text-brand-blue">
        @if($page->body)
            {!! $page->body !!}
        @else
            <p class="text-ink-grey">Le contenu de cette page sera bient&ocirc;t disponible. Vous pouvez le r&eacute;diger depuis l'<a href="/admin" class="text-brand-blue">espace d'administration</a>.</p>
        @endif
    </div>
</section>
@endsection
