@extends('layouts.app')
@section('title', 'Mouvement des Femmes de Foi — Avec la foi, tout est possible')

@section('content')

{{-- ====== HERO ====== --}}
<section class="hero-bg {{ setting('hero_image') ? 'has-image' : '' }}" @if(setting('hero_image')) style="background-image: url('{{ asset('storage/' . setting('hero_image')) }}')" @endif>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-36 lg:py-44">
        <div class="max-w-3xl">
            <span class="inline-block px-4 py-1.5 bg-brand-gold/20 text-brand-gold text-sm font-semibold rounded-full tracking-wide uppercase mb-6">Association humanitaire &bull; Loi 1901</span>

            <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-[1.1] mb-6">
                Chaque geste d'amour<br>
                <span class="text-brand-gold-lt">redonne espoir</span>
            </h1>

            <p class="text-white/80 text-lg md:text-xl leading-relaxed max-w-xl mb-10">
                Nous sommes des femmes engag&eacute;es qui apportent soutien, espoir et aide concr&egrave;te
                aux personnes les plus vuln&eacute;rables &mdash; partout o&ugrave; le besoin se fait sentir.
            </p>

            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('donate') }}" class="group px-8 py-4 bg-brand-gold text-brand-blue-dk font-bold rounded-xl hover:bg-brand-gold-lt transition shadow-lg text-lg text-center">
                    Faire un don
                    <span class="inline-block ml-1 group-hover:translate-x-1 transition-transform">&rarr;</span>
                </a>
                <a href="{{ route('volunteer.create') }}" class="px-8 py-4 border-2 border-white/30 text-white font-semibold rounded-xl hover:bg-white/10 hover:border-white/50 transition text-lg text-center backdrop-blur-sm">
                    Devenir b&eacute;n&eacute;vole
                </a>
            </div>
        </div>

        {{-- Floating decorative elements --}}
        <div class="hidden lg:block absolute top-20 right-16 w-20 h-20 border-2 border-brand-gold/15 rounded-full float-slow"></div>
        <div class="hidden lg:block absolute bottom-32 right-40 w-12 h-12 bg-brand-gold/10 rounded-lg rotate-45 float-med"></div>
        <div class="hidden lg:block absolute top-40 right-60 w-3 h-3 bg-brand-gold/30 rounded-full float-med"></div>
    </div>

    {{-- Scroll indicator --}}
    <div class="relative z-10 flex justify-center pb-8">
        <a href="#impact" class="text-white/40 hover:text-white/70 transition animate-bounce">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
        </a>
    </div>
</section>

{{-- Wave transition --}}
<div class="wave-divider bg-paper-gold">
    <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 60V20C240 0 480 40 720 30C960 20 1200 0 1440 20V60H0Z" fill="var(--color-brand-blue)"/>
    </svg>
</div>

{{-- ====== IMPACT NUMBERS ====== --}}
<section id="impact" class="bg-paper-gold py-16 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12">
            @php $stats = [
                ['target' => 150, 'suffix' => '+', 'label' => 'Familles aid&eacute;es',  'icon' => '&#128106;'],
                ['target' => 50,  'suffix' => '+', 'label' => 'B&eacute;n&eacute;voles actifs',   'icon' => '&#129309;'],
                ['target' => 12,  'suffix' => '',  'label' => 'Actions men&eacute;es',    'icon' => '&#128230;'],
                ['target' => 5,   'suffix' => '',  'label' => 'Pays touch&eacute;s',      'icon' => '&#127758;'],
            ]; @endphp
            @foreach($stats as $i => $s)
            <div x-data="counter({{ $s['target'] }})" x-intersect.once="start()"
                 class="text-center reveal reveal-d{{ $i + 1 }}">
                <div class="text-3xl mb-2">{!! $s['icon'] !!}</div>
                <div class="font-display text-4xl md:text-5xl font-bold text-brand-blue">
                    <span x-text="value">0</span><span class="text-brand-gold">{!! $s['suffix'] !!}</span>
                </div>
                <p class="text-ink-grey text-sm mt-2 font-medium">{!! $s['label'] !!}</p>
            </div>
            @endforeach
        </div>
        <p class="text-center text-ink-grey/60 text-xs mt-8 italic">Chiffres depuis la cr&eacute;ation de l'association</p>
    </div>
</section>

{{-- ====== QUI SOMMES-NOUS ====== --}}
<section class="py-20 md:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div class="reveal">
                <span class="text-brand-gold font-semibold text-sm uppercase tracking-[0.15em]">Qui sommes-nous</span>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-brand-blue mt-3 mb-6 leading-tight">
                    Des femmes engag&eacute;es,<br>unies par la foi
                </h2>
                <p class="text-ink-grey leading-relaxed mb-4 text-lg">
                    Le Mouvement des Femmes de Foi est une association humanitaire &agrave; but non lucratif
                    r&eacute;gie par la loi du 1<sup>er</sup> juillet 1901. Nous croyons que chaque &ecirc;tre
                    humain m&eacute;rite une vie meilleure, quelle que soit sa situation.
                </p>
                <p class="text-ink-grey leading-relaxed mb-6">
                    La femme est source de vie, d'amour et d'esp&eacute;rance. Par leur foi, leur courage et leur
                    g&eacute;n&eacute;rosit&eacute;, les femmes du mouvement transforment des vies au quotidien.
                </p>
                <blockquote class="border-l-4 border-brand-gold pl-5 py-2 mb-8">
                    <p class="font-display italic text-brand-blue text-lg">&laquo; Avec la foi, tout est possible &raquo;</p>
                </blockquote>
                <a href="{{ route('association') }}" class="group inline-flex items-center gap-2 px-6 py-3 bg-brand-blue text-white font-semibold rounded-xl hover:bg-brand-blue-dk transition">
                    D&eacute;couvrir notre histoire
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="reveal reveal-d2">
                <div class="relative">
                    <div class="aspect-[4/5] rounded-2xl overflow-hidden bg-gradient-to-br from-brand-blue to-brand-blue-dk flex items-center justify-center shadow-xl">
                        <div class="text-center px-8">
                            <div class="text-6xl mb-4 opacity-30">&#128247;</div>
                            <p class="text-white/40 font-display text-xl">Photo de l'&eacute;quipe</p>
                            <p class="text-white/20 text-sm mt-2">Ajoutez-la depuis l'administration</p>
                        </div>
                    </div>
                    {{-- Decorative offset --}}
                    <div class="absolute -bottom-4 -right-4 w-full h-full bg-brand-gold/10 rounded-2xl -z-10"></div>
                    <div class="absolute -top-3 -left-3 w-16 h-16 bg-brand-gold rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-brand-blue-dk font-display font-bold text-xl">FDF</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ====== NOS ACTIONS — HISTOIRES ====== --}}
<section class="py-20 md:py-28 bg-paper-blue">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 reveal">
            <span class="text-brand-gold font-semibold text-sm uppercase tracking-[0.15em]">Ce que nous faisons</span>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-brand-blue mt-3">Nos actions sur le terrain</h2>
            <p class="text-ink-grey mt-3 max-w-2xl mx-auto">Chaque mois, nous intervenons aupr&egrave;s des personnes les plus vuln&eacute;rables avec une aide concr&egrave;te et humaine.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php $actions = [
                ['icon' => '&#127859;', 'title' => 'Distribution alimentaire', 'who' => 'Familles &amp; personnes &acirc;g&eacute;es', 'desc' => 'Chaque mois, nous distribuons des denr&eacute;es alimentaires de premi&egrave;re n&eacute;cessit&eacute; &agrave; des familles en difficult&eacute;.', 'color' => 'from-orange-500/10 to-orange-500/5'],
                ['icon' => '&#128218;', 'title' => 'Fournitures scolaires', 'who' => 'Enfants orphelins', 'desc' => 'Cartables, cahiers, stylos &mdash; nous &eacute;quipons les enfants pour qu\'ils puissent poursuivre leur scolarit&eacute;.', 'color' => 'from-blue-500/10 to-blue-500/5'],
                ['icon' => '&#128090;', 'title' => 'V&ecirc;tements &amp; habits', 'who' => 'Toute personne vuln&eacute;rable', 'desc' => 'Collecte et distribution de v&ecirc;tements aux personnes dans le besoin, sans distinction.', 'color' => 'from-purple-500/10 to-purple-500/5'],
                ['icon' => '&#129303;', 'title' => 'Accompagnement moral', 'who' => 'Veuves &amp; personnes isol&eacute;es', 'desc' => 'Visites, &eacute;coute et pr&eacute;sence humaine pour rompre la solitude et redonner courage.', 'color' => 'from-rose-500/10 to-rose-500/5'],
                ['icon' => '&#9855;',   'title' => 'Soutien au handicap', 'who' => 'Personnes en situation de handicap', 'desc' => 'Aide mat&eacute;rielle et accompagnement pour am&eacute;liorer le quotidien.', 'color' => 'from-teal-500/10 to-teal-500/5'],
                ['icon' => '&#10084;&#65039;', 'title' => 'Actions de solidarit&eacute;', 'who' => 'Communaut&eacute;s locales', 'desc' => 'Op&eacute;rations ponctuelles de solidarit&eacute; dans les pays d\'origine des membres et au-del&agrave;.', 'color' => 'from-brand-gold/15 to-brand-gold/5'],
            ]; @endphp
            @foreach($actions as $i => $a)
            <div class="bg-white rounded-2xl p-8 hover-lift reveal reveal-d{{ ($i % 3) + 1 }}">
                <div class="w-14 h-14 rounded-xl bg-gradient-to-br {{ $a['color'] }} flex items-center justify-center text-2xl mb-5">{!! $a['icon'] !!}</div>
                <h3 class="font-display text-xl font-semibold text-brand-blue mb-1">{!! $a['title'] !!}</h3>
                <p class="text-brand-gold text-sm font-medium mb-3">{!! $a['who'] !!}</p>
                <p class="text-ink-grey text-sm leading-relaxed">{!! $a['desc'] !!}</p>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12 reveal">
            <a href="{{ route('actions') }}" class="group inline-flex items-center gap-2 px-7 py-3.5 bg-brand-blue text-white font-semibold rounded-xl hover:bg-brand-blue-dk transition shadow-md">
                D&eacute;couvrir toutes nos actions
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ====== GALERIE — visible sur l'accueil ====== --}}
@if($albums->count())
<section class="py-20 md:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 reveal">
            <span class="text-brand-gold font-semibold text-sm uppercase tracking-[0.15em]">Sur le terrain</span>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-brand-blue mt-3">Nos derni&egrave;res actions en images</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 reveal">
            @foreach($albums as $album)
                <x-album-card :album="$album" />
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('gallery.index') }}" class="text-brand-blue font-semibold hover:text-brand-gold transition inline-flex items-center gap-2">
                Voir toute la galerie
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ====== TEMOIGNAGES ====== --}}
<section class="py-20 md:py-28 bg-paper-gold">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 reveal">
            <span class="text-brand-gold font-semibold text-sm uppercase tracking-[0.15em]">Ils t&eacute;moignent</span>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-brand-blue mt-3">Ils nous font confiance</h2>
        </div>

        @if($testimonials->count())
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($testimonials as $i => $t)
            <div class="bg-white rounded-2xl p-8 shadow-sm hover-lift reveal reveal-d{{ $i + 1 }}">
                <div class="flex items-center gap-1 text-brand-gold mb-4">
                    @for($s = 0; $s < 5; $s++) <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg> @endfor
                </div>
                <p class="text-ink-grey leading-relaxed italic mb-6">&laquo; {{ $t->content }} &raquo;</p>
                <div class="flex items-center gap-3 pt-4 border-t border-gray-50">
                    @if($t->photo)
                    <img src="{{ asset('storage/' . $t->photo) }}" alt="{{ $t->name }}" class="w-12 h-12 rounded-full object-cover ring-2 ring-brand-gold/20">
                    @else
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-brand-blue to-brand-blue-dk flex items-center justify-center text-white font-bold">{{ mb_substr($t->name, 0, 1) }}</div>
                    @endif
                    <div>
                        <p class="font-semibold text-ink-dark">{{ $t->name }}</p>
                        @if($t->role)<p class="text-sm text-ink-grey">{{ $t->role }}</p>@endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="grid md:grid-cols-3 gap-8">
            @php $placeholders = [
                ['name' => 'Marie K.', 'role' => 'B&eacute;n&eacute;vole', 'text' => 'Rejoindre le mouvement a transform&eacute; ma fa&ccedil;on de voir le monde. Ensemble, nous faisons vraiment la diff&eacute;rence.'],
                ['name' => 'Famille Ndo', 'role' => 'B&eacute;n&eacute;ficiaire', 'text' => 'Gr&acirc;ce &agrave; l\'association, nos enfants ont pu reprendre l\'&eacute;cole avec des fournitures neuves. Merci infiniment.'],
                ['name' => 'Pasteur J.', 'role' => 'Partenaire', 'text' => 'Le Mouvement des Femmes de Foi est un mod&egrave;le de g&eacute;n&eacute;rosit&eacute; et d\'engagement. Leur foi se traduit en actes.'],
            ]; @endphp
            @foreach($placeholders as $i => $p)
            <div class="bg-white rounded-2xl p-8 shadow-sm hover-lift reveal reveal-d{{ $i + 1 }}">
                <div class="flex items-center gap-1 text-brand-gold mb-4">
                    @for($s = 0; $s < 5; $s++) <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg> @endfor
                </div>
                <p class="text-ink-grey leading-relaxed italic mb-6">&laquo; {!! $p['text'] !!} &raquo;</p>
                <div class="flex items-center gap-3 pt-4 border-t border-gray-50">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-brand-blue to-brand-blue-dk flex items-center justify-center text-white font-bold">{{ mb_substr($p['name'], 0, 1) }}</div>
                    <div>
                        <p class="font-semibold text-ink-dark">{!! $p['name'] !!}</p>
                        <p class="text-sm text-ink-grey">{!! $p['role'] !!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

{{-- ====== ACTUALITES ====== --}}
@if($articles->count())
<section class="py-20 md:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 reveal">
            <span class="text-brand-gold font-semibold text-sm uppercase tracking-[0.15em]">Blog</span>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-brand-blue mt-3">Derni&egrave;res actualit&eacute;s</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-8 reveal">
            @foreach($articles as $article)
                <x-article-card :article="$article" />
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('articles.index') }}" class="text-brand-blue font-semibold hover:text-brand-gold transition inline-flex items-center gap-2">
                Toutes les actualit&eacute;s
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ====== VALEURS (déplacées en bas) ====== --}}
<section class="py-20 md:py-24 bg-paper-blue">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 reveal">
            <span class="text-brand-gold font-semibold text-sm uppercase tracking-[0.15em]">Ce qui nous anime</span>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-brand-blue mt-3">Nos valeurs</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6 reveal">
            @php $values = [
                ['icon' => '&#129309;', 'name' => 'Solidarit&eacute;',       'desc' => 'Agir ensemble pour ceux qui en ont besoin.'],
                ['icon' => '&#128588;', 'name' => 'Entraide',                'desc' => 'Tendre la main, sans rien attendre en retour.'],
                ['icon' => '&#128156;', 'name' => 'Compassion',              'desc' => 'Ressentir la souffrance de l\'autre comme la sienne.'],
                ['icon' => '&#127758;', 'name' => 'Humanit&eacute;',         'desc' => 'Chaque &ecirc;tre humain m&eacute;rite dignit&eacute; et respect.'],
                ['icon' => '&#10022;',  'name' => 'Foi &amp; Esp&eacute;rance', 'desc' => 'Croire que le meilleur est toujours possible.'],
            ]; @endphp
            @foreach($values as $v)
            <div class="text-center p-6 bg-white rounded-2xl shadow-sm hover-lift">
                <div class="text-4xl mb-3">{!! $v['icon'] !!}</div>
                <h3 class="font-display font-semibold text-brand-blue mb-2">{!! $v['name'] !!}</h3>
                <p class="text-ink-grey text-sm">{!! $v['desc'] !!}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ====== CTA FINAL — avec barre de progression dons ====== --}}
<section class="py-20 md:py-28 hero-bg relative overflow-hidden">
    <div class="relative z-10 max-w-3xl mx-auto px-4 text-center">
        <h2 class="font-display text-3xl md:text-5xl font-bold text-white mb-4 reveal">Rejoignez le mouvement</h2>
        <p class="text-white/70 text-lg mb-6 reveal reveal-d1">Ensemble, redonnons espoir aux plus vuln&eacute;rables.</p>

        <p class="font-display text-brand-gold italic text-xl mb-10 reveal reveal-d2">&laquo; Femmes, rejoignez-nous en masse. &raquo;</p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 reveal reveal-d3">
            <a href="{{ route('donate') }}" class="w-full sm:w-auto px-10 py-4 bg-brand-gold text-brand-blue-dk font-bold rounded-xl hover:bg-brand-gold-lt transition shadow-lg text-lg">Faire un don</a>
            <a href="{{ route('volunteer.create') }}" class="w-full sm:w-auto px-10 py-4 border-2 border-white/30 text-white font-semibold rounded-xl hover:bg-white/10 transition text-lg">Devenir b&eacute;n&eacute;vole</a>
            <a href="{{ route('contact.create') }}" class="w-full sm:w-auto px-10 py-4 border-2 border-brand-gold/30 text-brand-gold font-semibold rounded-xl hover:bg-brand-gold/10 transition text-lg">Nous contacter</a>
        </div>
    </div>

    {{-- Floating elements --}}
    <div class="absolute top-10 left-[10%] w-24 h-24 border border-brand-gold/10 rounded-full float-slow"></div>
    <div class="absolute bottom-10 right-[15%] w-16 h-16 border border-white/5 rounded-full float-med"></div>
</section>

{{-- ====== BIBLE VERSE BAND ====== --}}
<section class="bg-brand-blue-dk py-10 text-center">
    <div class="max-w-2xl mx-auto px-4">
        <blockquote class="font-display text-white/80 text-lg italic">
            &laquo; J&eacute;sus est le chemin, la v&eacute;rit&eacute; et la vie &raquo;
        </blockquote>
        <cite class="text-brand-gold text-sm mt-2 block not-italic">&mdash; Jean 14:6</cite>
    </div>
</section>

@endsection
