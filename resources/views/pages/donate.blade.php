@extends('layouts.app')
@section('title', 'Faire un don — AMFDF')

@section('content')
<x-page-hero title="Faire un don" subtitle="Chaque don compte et change des vies" />

<section class="py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="prose prose-lg max-w-none prose-headings:font-display prose-headings:text-brand-blue mb-10">
            @if($page->body)
                {!! $page->body !!}
            @else
                <p>{{ setting('donation_text', 'Votre g&eacute;n&eacute;rosit&eacute; nous permet d\'agir concr&egrave;tement aupr&egrave;s des plus vuln&eacute;rables.') }}</p>
            @endif
        </div>

        @if(setting('donation_url'))
        <a href="{{ setting('donation_url') }}" target="_blank" rel="noopener noreferrer"
           class="inline-block px-10 py-4 bg-brand-gold text-brand-blue-dk font-bold text-lg rounded-xl hover:bg-brand-gold-lt transition shadow-lg">
            Faire un don en ligne
        </a>
        <p class="text-ink-grey text-sm mt-4">Vous serez redirig&eacute;(e) vers notre plateforme s&eacute;curis&eacute;e (HelloAsso).</p>
        @else
        <div class="bg-paper-gold rounded-xl p-8">
            <p class="text-ink-dark font-semibold">Le lien de don en ligne sera bient&ocirc;t disponible.</p>
            <p class="text-ink-grey text-sm mt-2">En attendant, contactez-nous &agrave; <strong>{{ setting('email', 'contact@amfdf.org') }}</strong>.</p>
        </div>
        @endif

        <p class="text-ink-grey text-sm mt-4">Un re&ccedil;u fiscal, ouvrant droit &agrave; r&eacute;duction d'imp&ocirc;t, est disponible pour chaque don.</p>
    </div>
</section>
@endsection
