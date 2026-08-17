@extends('layouts.app')
@section('title', 'Faire un don — AMFDF')
@section('description', $page->meta_description)

@section('content')
<x-page-hero title="Faire un don" subtitle="Chaque don compte et change des vies" />

<section class="py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="prose prose-lg mx-auto prose-headings:font-display prose-headings:text-brand-blue mb-10">
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

{{-- Où va votre don --}}
<section class="bg-paper-blue/40 py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header kicker="Utilisation des dons" title="Où va votre don" />
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm border border-stone-100">
                <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-paper-gold flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                </div>
                <p class="text-sm font-semibold text-brand-blue-dk">Denrées alimentaires</p>
            </div>
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm border border-stone-100">
                <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-paper-blue flex items-center justify-center">
                    <svg class="w-6 h-6 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422A12.083 12.083 0 0112 21a12.083 12.083 0 01-6.16-10.422L12 14z"/></svg>
                </div>
                <p class="text-sm font-semibold text-brand-blue-dk">Fournitures scolaires</p>
            </div>
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm border border-stone-100">
                <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-paper-gold flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <p class="text-sm font-semibold text-brand-blue-dk">Vêtements &amp; hygiène</p>
            </div>
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm border border-stone-100">
                <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-paper-blue flex items-center justify-center">
                    <svg class="w-6 h-6 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <p class="text-sm font-semibold text-brand-blue-dk">Accompagnement moral</p>
            </div>
        </div>
        <p class="text-center text-sm text-ink-grey mt-6">Voir le détail de notre gestion sur la page <a href="{{ route('transparency') }}" class="text-brand-blue underline hover:text-brand-gold">Transparence</a>.</p>
    </div>
</section>

{{-- FAQ --}}
<section class="bg-white py-16 lg:py-24">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header kicker="Questions fréquentes" title="Avant de faire un don" />

        <div x-data="{ open: 1 }" class="space-y-3">
            @php
                $donorEmail = setting('email', 'contact@amfdf.org');
                $faq = [
                    ['q' => "Mon don est-il déductible des impôts ?", 'a' => "Oui. Un reçu fiscal ouvrant droit à réduction d'impôt vous est délivré pour chaque don."],
                    ['q' => "Comment mon don est-il utilisé ?", 'a' => "Il finance directement nos actions de terrain : distribution alimentaire, fournitures scolaires, vêtements et accompagnement moral, au Cameroun comme en France. Le détail est expliqué sur notre page Transparence."],
                    ['q' => "Le paiement en ligne est-il sécurisé ?", 'a' => "Les dons en ligne sont traités par HelloAsso, plateforme de paiement sécurisée dédiée aux associations."],
                    ['q' => "Puis-je faire un don autrement qu'en ligne ?", 'a' => "Oui, contactez-nous directement à {$donorEmail} pour convenir d'une autre modalité."],
                    ['q' => "Je ne peux pas donner, puis-je aider autrement ?", 'a' => "Bien sûr — devenir bénévole est tout aussi précieux pour l'association."],
                ];
            @endphp
            @foreach($faq as $i => $item)
                <div class="border border-stone-200 rounded-xl overflow-hidden">
                    <button type="button" @click="open = (open === {{ $i }} ? null : {{ $i }})"
                            :aria-expanded="(open === {{ $i }}).toString()"
                            aria-controls="faq-{{ $i }}"
                            class="w-full flex items-center justify-between gap-4 px-5 py-4 text-left font-semibold text-brand-blue-dk hover:bg-paper-blue/40 transition focus-visible:ring-2 focus-visible:ring-brand-gold">
                        <span>{{ $item['q'] }}</span>
                        <svg class="w-5 h-5 shrink-0 transition-transform" :class="open === {{ $i }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div id="faq-{{ $i }}" x-show="open === {{ $i }}" x-collapse x-cloak class="px-5 pb-4 text-sm text-ink-grey">
                        {{ $item['a'] }}
                    </div>
                </div>
            @endforeach
        </div>

        <p class="text-center text-sm text-ink-grey mt-8">
            Une autre question ? <a href="{{ route('contact.create') }}" class="text-brand-blue underline hover:text-brand-gold">Contactez-nous</a>.
        </p>
    </div>
</section>
@endsection
