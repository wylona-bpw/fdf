@extends('layouts.app')
@section('title', 'Mouvement des Femmes de Foi — Avec la foi, tout est possible')

@section('content')

{{-- ====== HERO ====== --}}
<section class="hero-bg {{ setting('hero_image') ? 'has-image' : '' }}" @if(setting('hero_image')) style="background-image: url('{{ asset('storage/' . setting('hero_image')) }}')" @endif>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 lg:py-28">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            {{-- Left: text --}}
            <div>
                <span class="inline-block px-4 py-1.5 bg-brand-gold/20 text-brand-gold text-sm font-semibold rounded-full tracking-wide uppercase mb-5">Association humanitaire &bull; Loi 1901</span>
                <h1 class="font-display text-4xl md:text-5xl lg:text-[3.4rem] font-bold text-white leading-[1.1] mb-5">
                    Chaque geste d'amour<br>
                    <span class="text-brand-gold-lt italic">redonne espoir</span>
                </h1>
                <p class="text-white/75 text-lg leading-relaxed max-w-lg mb-8">
                    Nous sommes des femmes engag&eacute;es qui apportent soutien, espoir et aide concr&egrave;te
                    aux personnes les plus vuln&eacute;rables &mdash; partout o&ugrave; le besoin se fait sentir.
                </p>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('donate') }}" class="group px-7 py-3.5 bg-brand-gold text-brand-blue-dk font-bold rounded-xl hover:bg-brand-gold-lt transition shadow-lg text-center">
                        Faire un don <span class="inline-block ml-1 group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </a>
                    <a href="{{ route('volunteer.create') }}" class="px-7 py-3.5 border-2 border-white/30 text-white font-semibold rounded-xl hover:bg-white/10 transition text-center">
                        Devenir b&eacute;n&eacute;vole
                    </a>
                </div>
            </div>
            {{-- Right: photo collage placeholder --}}
            <div class="hidden lg:block relative h-[420px]">
                <div class="absolute top-0 right-0 w-56 h-72 bg-white/5 backdrop-blur-sm rounded-2xl border border-white/10 shadow-xl transform rotate-3 overflow-hidden">
                    <div class="w-full h-full flex flex-col items-center justify-center text-white/25 gap-2">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z"/></svg>
                        <span class="text-xs">Photo d'action</span>
                    </div>
                </div>
                <div class="absolute top-16 right-48 w-48 h-64 bg-brand-gold/10 backdrop-blur-sm rounded-2xl border border-brand-gold/20 shadow-lg transform -rotate-3 overflow-hidden">
                    <div class="w-full h-full flex flex-col items-center justify-center text-brand-gold/30 gap-2">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z"/></svg>
                        <span class="text-xs">Photo d'&eacute;quipe</span>
                    </div>
                </div>
                <div class="absolute bottom-0 right-16 w-52 h-60 bg-white/8 backdrop-blur-sm rounded-2xl border border-white/15 shadow-lg transform rotate-1 overflow-hidden">
                    <div class="w-full h-full flex flex-col items-center justify-center text-white/20 gap-2">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z"/></svg>
                        <span class="text-xs">B&eacute;n&eacute;ficiaires</span>
                    </div>
                </div>
                {{-- FDF badge --}}
                <div class="absolute top-8 right-44 w-14 h-14 bg-brand-gold rounded-xl flex items-center justify-center shadow-lg transform -rotate-6 z-10">
                    <span class="text-brand-blue-dk font-display font-bold text-lg">FDF</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Wave --}}
<div class="wave-divider bg-paper-gold">
    <svg viewBox="0 0 1440 48" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
        <path d="M0 48V16C360 0 720 32 1080 24C1260 20 1380 8 1440 0V48H0Z" fill="var(--color-brand-blue)"/>
    </svg>
</div>

{{-- ====== IMPACT ====== --}}
<section id="impact" class="bg-paper-gold py-14 md:py-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            @php $stats = [
                ['target' => 150, 'suffix' => '+', 'label' => 'Familles aid&eacute;es',  'icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>'],
                ['target' => 50,  'suffix' => '+', 'label' => 'B&eacute;n&eacute;voles actifs',   'icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>'],
                ['target' => 12,  'suffix' => '',  'label' => 'Actions men&eacute;es',    'icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>'],
                ['target' => 5,   'suffix' => '',  'label' => 'Pays touch&eacute;s',      'icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5a17.92 17.92 0 01-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>'],
            ]; @endphp
            @foreach($stats as $s)
            <div x-data="counter({{ $s['target'] }})" x-intersect.once="start()" class="text-center reveal">
                <div class="w-14 h-14 mx-auto rounded-xl bg-brand-blue/10 flex items-center justify-center text-brand-blue mb-3">{!! $s['icon'] !!}</div>
                <div class="font-display text-4xl md:text-5xl font-bold text-brand-blue">
                    <span x-text="value">0</span><span class="text-brand-gold">{!! $s['suffix'] !!}</span>
                </div>
                <p class="text-ink-grey text-sm mt-1 font-medium">{!! $s['label'] !!}</p>
            </div>
            @endforeach
        </div>
        <p class="text-center text-ink-grey/50 text-xs mt-6 italic">Depuis la cr&eacute;ation du mouvement &mdash; mis &agrave; jour r&eacute;guli&egrave;rement</p>
    </div>
</section>

{{-- ====== QUI SOMMES-NOUS ====== --}}
<section class="py-16 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-12 lg:gap-16 items-center">
            <div class="reveal">
                <span class="text-brand-gold font-semibold text-sm uppercase tracking-[0.15em]">Qui sommes-nous</span>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-brand-blue mt-2 mb-5 leading-tight">
                    Des femmes engag&eacute;es,<br>unies par la foi
                </h2>
                <p class="text-ink-grey leading-relaxed mb-3">
                    Le Mouvement des Femmes de Foi est une association humanitaire &agrave; but non lucratif
                    (loi 1901). Nous croyons que chaque &ecirc;tre humain m&eacute;rite une vie meilleure.
                </p>
                <p class="text-ink-grey leading-relaxed mb-5">
                    La femme est source de vie, d'amour et d'esp&eacute;rance. Par leur foi, leur courage et leur
                    g&eacute;n&eacute;rosit&eacute;, les femmes du mouvement transforment des vies au quotidien.
                </p>
                <blockquote class="border-l-4 border-brand-gold pl-4 py-1 mb-6">
                    <p class="font-display italic text-brand-blue text-lg">&laquo; Avec la foi, tout est possible &raquo;</p>
                </blockquote>
                <a href="{{ route('association') }}" class="group inline-flex items-center gap-2 px-5 py-2.5 bg-brand-blue text-white font-semibold rounded-xl hover:bg-brand-blue-dk transition text-sm">
                    D&eacute;couvrir notre histoire
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="reveal">
                <div class="aspect-[4/3] rounded-2xl overflow-hidden bg-gradient-to-br from-brand-blue to-brand-blue-dk flex items-center justify-center shadow-lg relative">
                    <div class="text-center px-8">
                        <div class="text-white/20 mb-3"><svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z"/></svg></div>
                        <p class="text-white/30 font-display">Photo de l'&eacute;quipe</p>
                        <p class="text-white/15 text-xs mt-1">Uploadez-la via Filament</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ====== ACTIONS ====== --}}
<section class="py-16 md:py-20 bg-paper-blue">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 reveal">
            <span class="text-brand-gold font-semibold text-sm uppercase tracking-[0.15em]">Ce que nous faisons</span>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-brand-blue mt-2">Nos actions sur le terrain</h2>
            <p class="text-ink-grey mt-2 max-w-xl mx-auto">Chaque mois, nous intervenons avec une aide concr&egrave;te et humaine.</p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php $acts = [
                ['icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.871c1.355 0 2.697.056 4.024.166C17.155 8.51 18 9.473 18 10.608v2.513M15 8.25v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.379a48.474 48.474 0 00-6-.371c-2.032 0-4.034.126-6 .371m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.169c0 .621-.504 1.125-1.125 1.125H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12M12.265 3.11a.375.375 0 11-.53 0L12 2.845l.265.265z"/></svg>', 'title' => 'Distribution alimentaire', 'who' => 'Familles &amp; personnes &acirc;g&eacute;es', 'desc' => 'Denr&eacute;es de premi&egrave;re n&eacute;cessit&eacute; distribu&eacute;es chaque mois aux familles en difficult&eacute;.', 'bg' => 'bg-orange-50'],
                ['icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/></svg>', 'title' => 'Fournitures scolaires', 'who' => 'Enfants orphelins', 'desc' => 'Cartables, cahiers, stylos &mdash; nous &eacute;quipons les enfants pour leur scolarit&eacute;.', 'bg' => 'bg-blue-50'],
                ['icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>', 'title' => 'V&ecirc;tements', 'who' => 'Toute personne vuln&eacute;rable', 'desc' => 'Collecte et distribution de v&ecirc;tements sans distinction.', 'bg' => 'bg-purple-50'],
                ['icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 10-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 013.15 0v1.5m-3.15 0l.075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 013.15 0V15M6.9 7.575a1.575 1.575 0 10-3.15 0v8.175a6.75 6.75 0 006.75 6.75h2.018a5.25 5.25 0 003.712-1.538l1.732-1.732a5.25 5.25 0 001.538-3.712l.003-2.024a.668.668 0 00-.659-.677c-.577 0-1.1.332-1.353.862L16.5 15"/></svg>', 'title' => 'Accompagnement moral', 'who' => 'Veuves &amp; personnes isol&eacute;es', 'desc' => 'Visites, &eacute;coute et pr&eacute;sence pour rompre la solitude.', 'bg' => 'bg-rose-50'],
                ['icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"/></svg>', 'title' => 'Soutien au handicap', 'who' => 'Personnes en situation de handicap', 'desc' => 'Aide mat&eacute;rielle et accompagnement au quotidien.', 'bg' => 'bg-teal-50'],
                ['icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>', 'title' => 'Solidarit&eacute; internationale', 'who' => 'Communaut&eacute;s locales', 'desc' => 'Op&eacute;rations de solidarit&eacute; dans les pays d\'origine et au-del&agrave;.', 'bg' => 'bg-amber-50'],
            ]; @endphp
            @foreach($acts as $a)
            <div class="bg-white rounded-2xl p-7 hover-lift reveal">
                <div class="w-12 h-12 rounded-xl {!! $a['bg'] !!} flex items-center justify-center text-brand-blue mb-4">{!! $a['icon'] !!}</div>
                <h3 class="font-display text-lg font-semibold text-brand-blue mb-1">{!! $a['title'] !!}</h3>
                <p class="text-brand-gold text-sm font-medium mb-2">{!! $a['who'] !!}</p>
                <p class="text-ink-grey text-sm leading-relaxed">{!! $a['desc'] !!}</p>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-10 reveal">
            <a href="{{ route('actions') }}" class="inline-flex items-center gap-2 text-brand-blue font-semibold hover:text-brand-gold transition">
                D&eacute;couvrir toutes nos actions
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ====== GALERIE (toujours visible) ====== --}}
<section class="py-16 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 reveal">
            <span class="text-brand-gold font-semibold text-sm uppercase tracking-[0.15em]">Sur le terrain</span>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-brand-blue mt-2">Nos derni&egrave;res missions en images</h2>
        </div>
        @if($albums->count())
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 reveal">
            @foreach($albums as $album)
                <x-album-card :album="$album" />
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('gallery.index') }}" class="inline-flex items-center gap-2 text-brand-blue font-semibold hover:text-brand-gold transition">
                Voir toute la galerie <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        @else
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 reveal">
            @for($i = 0; $i < 4; $i++)
            <div class="aspect-[4/3] rounded-xl bg-gradient-to-br from-paper-blue to-gray-100 flex flex-col items-center justify-center text-ink-grey/30 gap-2">
                <div class="text-ink-grey/20"><svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z"/></svg></div>
                <span class="text-xs">Bient&ocirc;t disponible</span>
            </div>
            @endfor
        </div>
        <p class="text-center text-ink-grey/50 text-sm mt-6">Les photos de nos actions seront bient&ocirc;t publi&eacute;es ici.</p>
        @endif
    </div>
</section>

{{-- ====== TEMOIGNAGES ====== --}}
<section class="py-16 md:py-20 bg-paper-gold">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 reveal">
            <span class="text-brand-gold font-semibold text-sm uppercase tracking-[0.15em]">Ils t&eacute;moignent</span>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-brand-blue mt-2">Ils nous font confiance</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @if($testimonials->count())
                @foreach($testimonials as $t)
                <div class="bg-white rounded-2xl p-7 shadow-sm hover-lift reveal">
                    <svg class="w-10 h-10 text-brand-gold/30" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10H14.017zM0 21v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151C7.563 6.068 6 8.789 6 11h4v10H0z"/></svg>
                    <p class="text-ink-grey leading-relaxed italic my-4">&laquo; {{ $t->content }} &raquo;</p>
                    <div class="flex items-center gap-3 pt-4 border-t border-gray-50">
                        @if($t->photo)
                        <img src="{{ asset('storage/' . $t->photo) }}" alt="{{ $t->name }}" class="w-11 h-11 rounded-full object-cover ring-2 ring-brand-gold/20">
                        @else
                        <div class="w-11 h-11 rounded-full bg-gradient-to-br from-brand-blue to-brand-blue-dk flex items-center justify-center text-white font-bold text-sm">{{ mb_substr($t->name, 0, 1) }}</div>
                        @endif
                        <div>
                            <p class="font-semibold text-sm text-ink-dark">{{ $t->name }}</p>
                            @if($t->role)<p class="text-xs text-ink-grey">{{ $t->role }}</p>@endif
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                @php $ph = [
                    ['n' => 'Marie Kouam', 'r' => 'B&eacute;n&eacute;vole &bull; Paris', 't' => 'Rejoindre le mouvement a transform&eacute; ma vision du monde. Ensemble, nous faisons vraiment la diff&eacute;rence pour les familles dans le besoin.'],
                    ['n' => 'Famille Ndongo', 'r' => 'B&eacute;n&eacute;ficiaire &bull; Yaound&eacute;', 't' => 'Gr&acirc;ce &agrave; l\'association, nos enfants ont pu reprendre l\'&eacute;cole avec des fournitures neuves. Nous sommes infiniment reconnaissants.'],
                    ['n' => 'Pasteur Jean M.', 'r' => 'Partenaire &bull; Lyon', 't' => 'Le Mouvement des Femmes de Foi est un mod&egrave;le de g&eacute;n&eacute;rosit&eacute;. Leur foi se traduit en actes concrets chaque jour.'],
                ]; @endphp
                @foreach($ph as $p)
                <div class="bg-white rounded-2xl p-7 shadow-sm hover-lift reveal">
                    <svg class="w-10 h-10 text-brand-gold/30" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10H14.017zM0 21v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151C7.563 6.068 6 8.789 6 11h4v10H0z"/></svg>
                    <p class="text-ink-grey leading-relaxed italic my-4">&laquo; {!! $p['t'] !!} &raquo;</p>
                    <div class="flex items-center gap-3 pt-4 border-t border-gray-50">
                        <div class="w-11 h-11 rounded-full bg-gradient-to-br from-brand-blue to-brand-blue-dk flex items-center justify-center text-white font-bold text-sm">{{ mb_substr($p['n'], 0, 1) }}</div>
                        <div>
                            <p class="font-semibold text-sm text-ink-dark">{!! $p['n'] !!}</p>
                            <p class="text-xs text-ink-grey">{!! $p['r'] !!}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

{{-- ====== ACTUALITES ====== --}}
@if($articles->count())
<section class="py-16 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 reveal">
            <span class="text-brand-gold font-semibold text-sm uppercase tracking-[0.15em]">Blog</span>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-brand-blue mt-2">Derni&egrave;res actualit&eacute;s</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6 reveal">
            @foreach($articles as $article)
                <x-article-card :article="$article" />
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ====== VALEURS ====== --}}
<section class="py-14 md:py-16 bg-paper-blue">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 reveal">
            <span class="text-brand-gold font-semibold text-sm uppercase tracking-[0.15em]">Ce qui nous anime</span>
            <h2 class="font-display text-3xl md:text-4xl font-bold text-brand-blue mt-2">Nos valeurs</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 reveal">
            @php $vals = [
                ['icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m9.86-4.568a4.5 4.5 0 00-6.364 0l-4.5 4.5a4.5 4.5 0 006.364 6.364l1.757-1.757"/></svg>', 'n' => 'Solidarit&eacute;', 'd' => 'Agir ensemble pour ceux qui en ont besoin.'],
                ['icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 10-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 013.15 0v1.5m-3.15 0l.075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 013.15 0V15M6.9 7.575a1.575 1.575 0 10-3.15 0v8.175a6.75 6.75 0 006.75 6.75h2.018a5.25 5.25 0 003.712-1.538l1.732-1.732a5.25 5.25 0 001.538-3.712l.003-2.024a.668.668 0 00-.659-.677c-.577 0-1.1.332-1.353.862L16.5 15"/></svg>', 'n' => 'Entraide', 'd' => 'Tendre la main, sans rien attendre en retour.'],
                ['icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/></svg>', 'n' => 'Compassion', 'd' => 'Ressentir l\'autre comme soi-m&ecirc;me.'],
                ['icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5a17.92 17.92 0 01-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418"/></svg>', 'n' => 'Humanit&eacute;', 'd' => 'Chaque &ecirc;tre m&eacute;rite dignit&eacute;.'],
                ['icon' => '<svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.455 2.456L21.75 6l-1.036.259a3.375 3.375 0 00-2.455 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z"/></svg>', 'n' => 'Foi &amp; Esp&eacute;rance', 'd' => 'Croire que le meilleur est possible.'],
            ]; @endphp
            @foreach($vals as $v)
            <div class="text-center p-5 bg-white rounded-xl shadow-sm hover-lift">
                <div class="w-11 h-11 mx-auto rounded-lg bg-brand-blue/10 flex items-center justify-center text-brand-blue mb-3">{!! $v['icon'] !!}</div>
                <h3 class="font-display font-semibold text-brand-blue text-sm mb-1">{!! $v['n'] !!}</h3>
                <p class="text-ink-grey text-xs">{!! $v['d'] !!}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ====== TRANSPARENCE ====== --}}
<section class="py-14 md:py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
        <span class="text-brand-gold font-semibold text-sm uppercase tracking-[0.15em]">Notre engagement</span>
        <h2 class="font-display text-3xl font-bold text-brand-blue mt-2 mb-8">Transparence totale</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 bg-paper-blue rounded-xl">
                <div class="w-12 h-12 mx-auto rounded-xl bg-brand-blue/10 flex items-center justify-center text-brand-blue mb-3"><svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                <p class="font-display font-semibold text-brand-blue mb-1">100% terrain</p>
                <p class="text-ink-grey text-sm">Chaque don sert directement aux actions de terrain.</p>
            </div>
            <div class="p-6 bg-paper-blue rounded-xl">
                <div class="w-12 h-12 mx-auto rounded-xl bg-brand-blue/10 flex items-center justify-center text-brand-blue mb-3"><svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg></div>
                <p class="font-display font-semibold text-brand-blue mb-1">Comptes v&eacute;rifi&eacute;s</p>
                <p class="text-ink-grey text-sm">Association loi 1901, gestion rigoureuse et contr&ocirc;l&eacute;e.</p>
            </div>
            <div class="p-6 bg-paper-blue rounded-xl">
                <div class="w-12 h-12 mx-auto rounded-xl bg-brand-blue/10 flex items-center justify-center text-brand-blue mb-3"><svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg></div>
                <p class="font-display font-semibold text-brand-blue mb-1">Rapport annuel</p>
                <p class="text-ink-grey text-sm">Bilan d'activit&eacute; disponible sur demande.</p>
            </div>
        </div>
    </div>
</section>

{{-- ====== CTA FINAL (2 boutons seulement) ====== --}}
<section class="py-16 md:py-20 hero-bg relative overflow-hidden">
    <div class="relative z-10 max-w-3xl mx-auto px-4 text-center">
        <h2 class="font-display text-3xl md:text-4xl font-bold text-white mb-3 reveal">Rejoignez le mouvement</h2>
        <p class="text-white/70 text-lg mb-4 reveal">Ensemble, redonnons espoir aux plus vuln&eacute;rables.</p>
        <p class="font-display text-brand-gold italic text-lg mb-8 reveal">&laquo; Femmes, rejoignez-nous en masse. &raquo;</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 reveal">
            <a href="{{ route('donate') }}" class="w-full sm:w-auto px-10 py-4 bg-brand-gold text-brand-blue-dk font-bold rounded-xl hover:bg-brand-gold-lt transition shadow-lg text-lg">Faire un don</a>
            <a href="{{ route('volunteer.create') }}" class="w-full sm:w-auto px-10 py-4 border-2 border-white/30 text-white font-semibold rounded-xl hover:bg-white/10 transition text-lg">Devenir b&eacute;n&eacute;vole</a>
        </div>
    </div>
</section>

{{-- ====== VERSET ====== --}}
<section class="bg-brand-blue-dk py-8 text-center">
    <blockquote class="font-display text-white/70 text-lg italic max-w-2xl mx-auto px-4">
        &laquo; J&eacute;sus est le chemin, la v&eacute;rit&eacute; et la vie &raquo;
    </blockquote>
    <cite class="text-brand-gold text-sm mt-1 block not-italic">&mdash; Jean 14:6</cite>
</section>

@endsection
