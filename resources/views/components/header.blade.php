@php
    $navItems = [
        ['route' => 'home',            'label' => 'Accueil'],
        ['route' => 'association',     'label' => 'Qui sommes-nous'],
        ['route' => 'actions',         'label' => 'Nos actions'],
        ['route' => 'transparency',    'label' => 'Impact'],
        ['route' => 'articles.index',  'label' => 'Actualités'],
        ['route' => 'gallery.index',   'label' => 'Galerie'],
        ['route' => 'contact.create',  'label' => 'Contact'],
    ];
@endphp
<header class="bg-brand-blue sticky top-0 z-50 shadow-lg">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"
         @click.outside="mobileMenu = false"
         @keydown.escape.window="mobileMenu = false">
        <div class="flex items-center justify-between h-16 lg:h-20">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0 group">
                <img src="{{ asset('images/logo-amfdf-128.png') }}"
                     alt="AMFDF"
                     width="60" height="60"
                     class="w-11 h-11 lg:w-14 lg:h-14 object-contain shrink-0 transition-transform duration-200 group-hover:scale-105"
                     loading="eager">
                <span class="flex flex-col leading-tight">
                    <span class="text-brand-gold font-display text-xl lg:text-2xl font-bold tracking-tight">AMFDF</span>
                    <span class="hidden sm:block text-white/80 text-xs lg:text-sm font-light mt-0.5">Mouvement des Femmes de Foi</span>
                </span>
            </a>

            <!-- Desktop nav -->
            <div class="hidden lg:flex items-center gap-1">
                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                       @if(request()->routeIs($item['route'])) aria-current="page" @endif
                       class="px-3 py-2 text-sm text-white/90 hover:text-brand-gold-lt transition font-medium">{{ $item['label'] }}</a>
                @endforeach
            </div>

            <!-- Desktop CTAs -->
            <div class="hidden lg:flex items-center gap-3">
                <x-button :href="route('volunteer.create')" variant="secondary" size="sm">Nous rejoindre</x-button>
                <x-button :href="route('donate')" variant="primary" size="sm">Faire un don</x-button>
            </div>

            <!-- Mobile toggle -->
            <button @click="mobileMenu = !mobileMenu"
                    class="lg:hidden text-white p-2"
                    :aria-label="mobileMenu ? 'Fermer le menu' : 'Ouvrir le menu'"
                    :aria-expanded="mobileMenu.toString()"
                    aria-controls="mobile-menu">
                <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileMenu" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" x-show="mobileMenu" x-cloak x-transition.opacity
             x-trap.noscroll="mobileMenu"
             class="lg:hidden pb-6 border-t border-white/10">
            <div class="flex flex-col gap-1 pt-4">
                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                       @click="mobileMenu = false"
                       @if(request()->routeIs($item['route'])) aria-current="page" @endif
                       class="px-3 py-2 text-white/90 hover:text-brand-gold-lt transition">{{ $item['label'] }}</a>
                @endforeach
                <div class="flex flex-col gap-2 mt-4 px-3">
                    <x-button :href="route('volunteer.create')" variant="secondary" size="sm" class="w-full">Nous rejoindre</x-button>
                    <x-button :href="route('donate')" variant="primary" size="sm" class="w-full">Faire un don</x-button>
                </div>
            </div>
        </div>
    </nav>
</header>
