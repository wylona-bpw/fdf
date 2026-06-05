<header class="bg-brand-blue sticky top-0 z-50 shadow-lg">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0">
                <span class="text-brand-gold font-display text-xl lg:text-2xl font-bold tracking-tight">AMFDF</span>
                <span class="hidden sm:block text-white/80 text-sm font-light leading-tight">Mouvement des<br>Femmes de Foi</span>
            </a>

            <!-- Desktop nav -->
            <div class="hidden lg:flex items-center gap-1">
                <a href="{{ route('home') }}" class="px-3 py-2 text-sm text-white/90 hover:text-brand-gold-lt transition font-medium">Accueil</a>
                <a href="{{ route('association') }}" class="px-3 py-2 text-sm text-white/90 hover:text-brand-gold-lt transition font-medium">L'association</a>
                <a href="{{ route('actions') }}" class="px-3 py-2 text-sm text-white/90 hover:text-brand-gold-lt transition font-medium">Nos actions</a>
                <a href="{{ route('articles.index') }}" class="px-3 py-2 text-sm text-white/90 hover:text-brand-gold-lt transition font-medium">Actualit&eacute;s</a>
                <a href="{{ route('gallery.index') }}" class="px-3 py-2 text-sm text-white/90 hover:text-brand-gold-lt transition font-medium">Galerie</a>
                <a href="{{ route('contact.create') }}" class="px-3 py-2 text-sm text-white/90 hover:text-brand-gold-lt transition font-medium">Contact</a>
            </div>

            <!-- Desktop CTAs -->
            <div class="hidden lg:flex items-center gap-3">
                <a href="{{ route('volunteer.create') }}" class="px-4 py-2 text-sm font-semibold text-white border border-white/30 rounded-lg hover:bg-white/10 transition">Devenir b&eacute;n&eacute;vole</a>
                <a href="{{ route('donate') }}" class="px-5 py-2 text-sm font-bold bg-brand-gold text-brand-blue-dk rounded-lg hover:bg-brand-gold-lt transition shadow-md">Faire un don</a>
            </div>

            <!-- Mobile toggle -->
            <button @click="mobileMenu = !mobileMenu" class="lg:hidden text-white p-2" aria-label="Menu">
                <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileMenu" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Mobile menu -->
        <div x-show="mobileMenu" x-cloak x-transition.opacity class="lg:hidden pb-6 border-t border-white/10">
            <div class="flex flex-col gap-1 pt-4">
                <a href="{{ route('home') }}" class="px-3 py-2 text-white/90 hover:text-brand-gold-lt transition">Accueil</a>
                <a href="{{ route('association') }}" class="px-3 py-2 text-white/90 hover:text-brand-gold-lt transition">L'association</a>
                <a href="{{ route('actions') }}" class="px-3 py-2 text-white/90 hover:text-brand-gold-lt transition">Nos actions</a>
                <a href="{{ route('articles.index') }}" class="px-3 py-2 text-white/90 hover:text-brand-gold-lt transition">Actualit&eacute;s</a>
                <a href="{{ route('gallery.index') }}" class="px-3 py-2 text-white/90 hover:text-brand-gold-lt transition">Galerie</a>
                <a href="{{ route('contact.create') }}" class="px-3 py-2 text-white/90 hover:text-brand-gold-lt transition">Contact</a>
                <div class="flex flex-col gap-2 mt-4 px-3">
                    <a href="{{ route('volunteer.create') }}" class="text-center px-4 py-2.5 font-semibold text-white border border-white/30 rounded-lg">Devenir b&eacute;n&eacute;vole</a>
                    <a href="{{ route('donate') }}" class="text-center px-4 py-2.5 font-bold bg-brand-gold text-brand-blue-dk rounded-lg">Faire un don</a>
                </div>
            </div>
        </div>
    </nav>
</header>
