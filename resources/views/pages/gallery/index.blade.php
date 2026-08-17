@extends('layouts.app')
@section('title', 'Galerie — AMFDF')

@section('content')
<x-page-hero title="Galerie" subtitle="Nos actions en images" />

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
        <x-empty-state title="La galerie sera bientôt disponible"
                        description="Revenez après notre prochaine mission de terrain." />
        @endif
    </div>
</section>
@endsection
