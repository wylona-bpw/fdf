@extends('layouts.app')
@section('title', 'Mouvement des Femmes de Foi — Avec la foi, tout est possible')

@section('content')

<!-- ====== HERO ====== -->
<section class="relative bg-brand-blue hero-pattern overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32 text-center">
        <p class="text-brand-gold font-semibold text-sm uppercase tracking-[0.2em] mb-4 fade-up">Association humanitaire</p>
        <h1 class="font-display text-4xl md:text-6xl lg:text-7xl font-bold text-white leading-tight fade-up fade-up-d1">
            Mouvement des<br>Femmes de Foi
        </h1>
        <p class="font-display text-xl md:text-2xl text-brand-gold-lt italic mt-6 fade-up fade-up-d2">
            &laquo; Avec la foi, tout est possible &raquo;
        </p>
        <p class="text-white/70 text-lg max-w-2xl mx-auto mt-4 fade-up fade-up-d2">
            Apporter soutien, espoir et assistance aux personnes les plus vuln&eacute;rables, partout o&ugrave; le besoin se fait sentir.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-10 fade-up fade-up-d3">
            <a href="{{ route('donate') }}" class="w-full sm:w-auto px-8 py-3.5 bg-brand-gold text-brand-blue-dk font-bold rounded-xl hover:bg-brand-gold-lt transition shadow-lg text-lg">
                Faire un don
            </a>
            <a href="{{ route('volunteer.create') }}" class="w-full sm:w-auto px-8 py-3.5 border-2 border-white/40 text-white font-semibold rounded-xl hover:bg-white/10 transition text-lg">
                Devenir b&eacute;n&eacute;vole
            </a>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
</section>

<!-- ====== VALEURS ====== -->
<section class="py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-center text-brand-blue mb-12">Nos valeurs</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
            @php $values = [
                ['icon' => '&#129309;', 'name' => 'Solidarit&eacute;'],
                ['icon' => '&#128588;', 'name' => 'Entraide'],
                ['icon' => '&#128156;', 'name' => 'Compassion'],
                ['icon' => '&#127758;', 'name' => 'Humanit&eacute;'],
                ['icon' => '&#10022;',  'name' => 'Foi &amp; Esp&eacute;rance'],
            ]; @endphp
            @foreach($values as $v)
            <div class="text-center p-6 rounded-xl bg-paper-blue hover:bg-paper-gold transition-colors">
                <div class="text-4xl mb-3">{!! $v['icon'] !!}</div>
                <h3 class="font-display font-semibold text-brand-blue">{!! $v['name'] !!}</h3>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ====== QUI SOMMES-NOUS (apercu) ====== -->
<section class="py-16 md:py-20 bg-paper-blue">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <p class="text-brand-gold font-semibold text-sm uppercase tracking-wider mb-2">Qui sommes-nous</p>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-brand-blue mb-6">Des femmes engag&eacute;es, unies par la foi</h2>
                <p class="text-ink-grey leading-relaxed mb-4">
                    Le Mouvement des Femmes de Foi est une association humanitaire &agrave; but non lucratif
                    r&eacute;gie par la loi du 1<sup>er</sup> juillet 1901. Port&eacute;es par des valeurs de solidarit&eacute;,
                    de compassion et d'esp&eacute;rance, nous croyons que chaque &ecirc;tre humain m&eacute;rite une vie meilleure.
                </p>
                <p class="text-ink-grey leading-relaxed mb-6">
                    La femme est source de vie, d'amour et d'esp&eacute;rance. Par leur foi, leur courage et leur
                    g&eacute;n&eacute;rosit&eacute;, les femmes du mouvement contribuent &agrave; transformer des vies.
                </p>
                <a href="{{ route('association') }}" class="inline-flex items-center gap-2 text-brand-blue font-semibold hover:text-brand-gold transition">
                    D&eacute;couvrir l'association
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="aspect-[4/3] rounded-2xl bg-gradient-to-br from-brand-blue to-brand-blue-dk flex items-center justify-center">
                <p class="text-white/30 font-display text-2xl text-center px-8">Photo de l'&eacute;quipe<br><span class="text-sm text-white/20">(ajouter via l'administration)</span></p>
            </div>
        </div>
    </div>
</section>

<!-- ====== NOS ACTIONS ====== -->
<section class="py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-brand-gold font-semibold text-sm uppercase tracking-wider text-center mb-2">Ce que nous faisons</p>
        <h2 class="font-display text-3xl md:text-4xl font-bold text-center text-brand-blue mb-12">Nos actions</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            @php $actions = [
                ['icon' => '&#128118;', 'title' => 'Enfants orphelins', 'desc' => 'Fournitures scolaires, v&ecirc;tements et accompagnement.'],
                ['icon' => '&#9855;',   'title' => 'Personnes handicap&eacute;es', 'desc' => 'Soutien mat&eacute;riel et moral.'],
                ['icon' => '&#128117;', 'title' => 'Personnes &acirc;g&eacute;es', 'desc' => 'Pr&eacute;sence, denr&eacute;es alimentaires et chaleur humaine.'],
                ['icon' => '&#128105;', 'title' => 'Veuves', 'desc' => 'Accompagnement dans les moments difficiles.'],
                ['icon' => '&#129303;', 'title' => 'Personnes isol&eacute;es', 'desc' => 'Rompre la solitude par la solidarit&eacute;.'],
                ['icon' => '&#10084;',  'title' => 'Toute personne vuln&eacute;rable', 'desc' => 'Aide alimentaire, vestimentaire et humaine.'],
            ]; @endphp
            @foreach($actions as $a)
            <div class="bg-white border border-gray-100 rounded-xl p-6 hover:shadow-md hover:border-brand-gold/30 transition text-center">
                <div class="text-3xl mb-3">{!! $a['icon'] !!}</div>
                <h3 class="font-display font-semibold text-brand-blue mb-2">{!! $a['title'] !!}</h3>
                <p class="text-ink-grey text-sm">{!! $a['desc'] !!}</p>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('actions') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-brand-blue text-white font-semibold rounded-xl hover:bg-brand-blue-dk transition">
                Toutes nos actions
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- ====== ACTUALITES ====== -->
@if($articles->count())
<section class="py-16 md:py-20 bg-paper-blue">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-brand-gold font-semibold text-sm uppercase tracking-wider text-center mb-2">Blog</p>
        <h2 class="font-display text-3xl md:text-4xl font-bold text-center text-brand-blue mb-12">Derni&egrave;res actualit&eacute;s</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($articles as $article)
                <x-article-card :article="$article" />
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 text-brand-blue font-semibold hover:text-brand-gold transition">
                Toutes les actualit&eacute;s
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- ====== GALERIE ====== -->
@if($albums->count())
<section class="py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-brand-gold font-semibold text-sm uppercase tracking-wider text-center mb-2">Sur le terrain</p>
        <h2 class="font-display text-3xl md:text-4xl font-bold text-center text-brand-blue mb-12">Galerie</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($albums as $album)
                <x-album-card :album="$album" />
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ====== TEMOIGNAGES ====== -->
@if($testimonials->count())
<section class="py-16 md:py-20 bg-paper-gold">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-center text-brand-blue mb-12">T&eacute;moignages</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($testimonials as $t)
            <div class="bg-white rounded-xl p-6 shadow-sm">
                <svg class="w-8 h-8 text-brand-gold/30 mb-3" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10H14.017zM0 21v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151C7.563 6.068 6 8.789 6 11h4v10H0z"/></svg>
                <p class="text-ink-grey leading-relaxed italic mb-4">{{ $t->content }}</p>
                <div class="flex items-center gap-3">
                    @if($t->photo)
                    <img src="{{ asset('storage/' . $t->photo) }}" alt="{{ $t->name }}" class="w-10 h-10 rounded-full object-cover">
                    @else
                    <div class="w-10 h-10 rounded-full bg-brand-blue flex items-center justify-center text-white font-bold text-sm">{{ substr($t->name, 0, 1) }}</div>
                    @endif
                    <div>
                        <p class="font-semibold text-sm text-ink-dark">{{ $t->name }}</p>
                        @if($t->role)<p class="text-xs text-ink-grey">{{ $t->role }}</p>@endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ====== CTA REJOINDRE ====== -->
<section class="py-16 md:py-24 bg-brand-blue hero-pattern text-center">
    <div class="max-w-3xl mx-auto px-4">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-white mb-4">Rejoignez le mouvement</h2>
        <p class="text-white/70 text-lg mb-8">Ensemble, redonnons espoir aux plus vuln&eacute;rables.</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('donate') }}" class="w-full sm:w-auto px-8 py-3.5 bg-brand-gold text-brand-blue-dk font-bold rounded-xl hover:bg-brand-gold-lt transition shadow-lg">Faire un don</a>
            <a href="{{ route('volunteer.create') }}" class="w-full sm:w-auto px-8 py-3.5 border-2 border-white/40 text-white font-semibold rounded-xl hover:bg-white/10 transition">Devenir b&eacute;n&eacute;vole</a>
        </div>
        <p class="text-brand-gold italic font-display mt-8">&laquo; Femmes, rejoignez-nous en masse. &raquo;</p>
    </div>
</section>

@endsection
