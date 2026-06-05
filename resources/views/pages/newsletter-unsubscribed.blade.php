@extends('layouts.app')
@section('title', 'Désinscription — AMFDF')

@section('content')
<section class="py-20 text-center">
    <div class="max-w-lg mx-auto px-4">
        <h1 class="font-display text-2xl font-bold text-brand-blue mb-4">D&eacute;sinscription confirm&eacute;e</h1>
        <p class="text-ink-grey">Vous ne recevrez plus notre newsletter. Vous pouvez vous r&eacute;inscrire &agrave; tout moment depuis notre site.</p>
        <a href="{{ route('home') }}" class="inline-block mt-8 px-6 py-3 bg-brand-blue text-white font-semibold rounded-xl hover:bg-brand-blue-dk transition">Retour &agrave; l'accueil</a>
    </div>
</section>
@endsection
