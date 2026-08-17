@extends('layouts.app')
@section('title', 'L\'association — AMFDF')
@section('description', $page->meta_description)

@section('content')
<x-page-hero title="L'association" quote="Avec la foi, tout est possible" />

<section class="py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <x-section-kicker>Qui sommes-nous</x-section-kicker>
        <div class="prose prose-lg mx-auto prose-headings:font-display prose-headings:text-brand-blue mt-2">
            @if($page->body)
                {!! $page->body !!}
            @else
                <p class="text-ink-grey">Le contenu de cette page sera bient&ocirc;t disponible. Vous pouvez le r&eacute;diger depuis l'<a href="/admin" class="text-brand-blue">espace d'administration</a>.</p>
            @endif
        </div>
    </div>
</section>

{{-- Vision / mission / actions / les femmes du mouvement --}}
<section class="bg-paper-blue/40 py-16 lg:py-24">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 lg:gap-6">
            <div class="bg-white rounded-2xl p-7 shadow-sm border border-stone-100">
                <div class="w-12 h-12 mb-4 rounded-xl bg-paper-gold flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                </div>
                <h3 class="font-display text-lg font-bold text-brand-blue-dk mb-2">Notre vision</h3>
                <p class="text-sm text-ink-grey leading-relaxed">« Avec la foi, tout est possible. » Nous sommes des femmes unies par des valeurs de solidarité, d'entraide, de compassion, d'humanité, de foi et d'espérance.</p>
            </div>
            <div class="bg-white rounded-2xl p-7 shadow-sm border border-stone-100">
                <div class="w-12 h-12 mb-4 rounded-xl bg-paper-blue flex items-center justify-center">
                    <svg class="w-6 h-6 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="font-display text-lg font-bold text-brand-blue-dk mb-2">Notre mission</h3>
                <p class="text-sm text-ink-grey leading-relaxed">Nous soutenons les enfants orphelins, les personnes en situation de handicap, les personnes âgées, les veuves, les personnes isolées et toute personne en situation de vulnérabilité.</p>
            </div>
            <div class="bg-white rounded-2xl p-7 shadow-sm border border-stone-100">
                <div class="w-12 h-12 mb-4 rounded-xl bg-paper-gold flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <h3 class="font-display text-lg font-bold text-brand-blue-dk mb-2">Nos actions</h3>
                <p class="text-sm text-ink-grey leading-relaxed">Distribution de denrées alimentaires, de vêtements, de fournitures scolaires, et accompagnement moral et humain — en France et à l'international.</p>
            </div>
            <div class="bg-white rounded-2xl p-7 shadow-sm border border-stone-100">
                <div class="w-12 h-12 mb-4 rounded-xl bg-paper-blue flex items-center justify-center">
                    <svg class="w-6 h-6 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <h3 class="font-display text-lg font-bold text-brand-blue-dk mb-2">Les femmes du mouvement</h3>
                <p class="text-sm text-ink-grey leading-relaxed">La femme est source de vie, d'amour et d'espérance. Par sa foi et son engagement, elle contribue à transformer des vies.</p>
            </div>
        </div>
    </div>
</section>

{{-- Équipe --}}
<section class="bg-white py-16 lg:py-24">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header kicker="Nos équipes" title="Au Cameroun et en France" />
        <div class="grid sm:grid-cols-2 gap-6">
            <div class="rounded-2xl overflow-hidden shadow-lg">
                <img src="{{ asset('images/team/equipe-france-01.jpg') }}" alt="Équipe France du Mouvement des Femmes de Foi"
                     class="w-full aspect-[4/3] object-cover" loading="lazy">
                <div class="bg-white px-5 py-3 border border-t-0 border-stone-100 rounded-b-2xl">
                    <p class="font-display font-semibold text-brand-blue-dk">Équipe France</p>
                    <p class="text-sm text-ink-grey">Guyancourt (78)</p>
                </div>
            </div>
            <div class="rounded-2xl overflow-hidden shadow-lg">
                <img src="{{ asset('storage/gallery/orphelinat-misericorde-divine-2026/equipe-cameroun-01.jpg') }}" alt="Équipe Cameroun du Mouvement des Femmes de Foi"
                     class="w-full aspect-[4/3] object-cover" loading="lazy">
                <div class="bg-white px-5 py-3 border border-t-0 border-stone-100 rounded-b-2xl">
                    <p class="font-display font-semibold text-brand-blue-dk">Équipe Cameroun</p>
                    <p class="text-sm text-ink-grey">Yaoundé</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Fondement spirituel + identité légale --}}
<section class="bg-brand-blue-dk py-14 text-white text-center">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <blockquote class="font-display italic text-xl lg:text-2xl leading-relaxed mb-2">
            « Jésus est le chemin, la vérité et la vie »
        </blockquote>
        <cite class="not-italic text-brand-gold-lt text-sm font-medium tracking-wider">— Jean 14:6</cite>
    </div>
</section>

<section class="bg-paper-gold/30 py-10">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-ink-grey">
        <p>Association loi 1901 · RNA {{ setting('rna_number', 'W784011796') }} · {{ setting('address') }}</p>
    </div>
</section>

{{-- CTA --}}
<section class="bg-white py-16 text-center">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-2xl sm:text-3xl font-bold text-brand-blue-dk mb-3">Rejoignez-nous</h2>
        <p class="text-ink-grey mb-8">Ensemble, redonnons espoir aux plus vulnérables.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <x-button :href="route('volunteer.create')" icon>Devenir bénévole</x-button>
            <x-button :href="route('donate')" variant="blue">Faire un don</x-button>
        </div>
    </div>
</section>
@endsection
