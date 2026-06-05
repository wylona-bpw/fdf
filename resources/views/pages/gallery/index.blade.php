@extends('layouts.app')
@section('title', 'Galerie — AMFDF')

@section('content')
<section class="bg-brand-blue py-12 text-center">
    <h1 class="font-display text-3xl md:text-4xl font-bold text-white">Galerie</h1>
    <p class="text-white/60 mt-2">Nos actions en images</p>
</section>

<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($albums->count())
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($albums as $album)
                <x-album-card :album="$album" />
            @endforeach
        </div>
        <div class="mt-12">{{ $albums->links() }}</div>
        @else
        <p class="text-center text-ink-grey py-12">La galerie sera bient&ocirc;t disponible.</p>
        @endif
    </div>
</section>
@endsection
