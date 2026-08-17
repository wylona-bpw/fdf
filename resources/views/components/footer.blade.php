<footer class="bg-brand-blue-dk text-white/80">

    {{-- Newsletter band --}}
    <div class="bg-brand-blue border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h3 class="font-display text-xl text-white font-semibold">Restez inform&eacute;(e)</h3>
                    <p class="text-white/60 text-sm mt-1">Recevez nos actualit&eacute;s et appels &agrave; la solidarit&eacute;.</p>
                </div>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex w-full md:w-auto gap-2">
                    @csrf
                    <input type="email" name="email" required placeholder="Votre adresse e-mail"
                        class="w-full md:w-72 px-4 py-2.5 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-brand-gold text-sm">
                    <button type="submit" class="px-6 py-2.5 bg-brand-gold text-brand-blue-dk font-bold rounded-lg hover:bg-brand-gold-lt transition text-sm whitespace-nowrap">S'inscrire</button>
                </form>
            </div>
        </div>
    </div>

    {{-- Main footer --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- About --}}
            <div>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 mb-5 group">
                    <img src="{{ asset('images/logo-amfdf-128.png') }}"
                         alt="AMFDF"
                         width="56" height="56"
                         class="w-14 h-14 object-contain shrink-0 transition-transform duration-200 group-hover:scale-105"
                         loading="lazy">
                    <span class="flex flex-col leading-tight">
                        <span class="text-white font-display text-xl font-bold tracking-tight">AMFDF</span>
                        <span class="text-brand-gold-lt text-[10px] uppercase tracking-widest font-semibold mt-1">Femmes de Foi</span>
                    </span>
                </a>
                <p class="text-sm leading-relaxed text-white/50 mb-3">Association humanitaire &agrave; but non lucratif (loi 1901). Apporter soutien, espoir et assistance aux personnes les plus vuln&eacute;rables.</p>
                <p class="text-brand-gold italic text-sm font-display">&laquo; Avec la foi, tout est possible &raquo;</p>
            </div>

            {{-- Navigation --}}
            <div>
                <h4 class="font-display text-lg text-white font-semibold mb-4">Navigation</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('association') }}" class="hover:text-brand-gold-lt transition">Qui sommes-nous</a></li>
                    <li><a href="{{ route('actions') }}" class="hover:text-brand-gold-lt transition">Nos actions</a></li>
                    <li><a href="{{ route('transparency') }}" class="hover:text-brand-gold-lt transition">Impact &amp; transparence</a></li>
                    <li><a href="{{ route('articles.index') }}" class="hover:text-brand-gold-lt transition">Actualit&eacute;s</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="hover:text-brand-gold-lt transition">Galerie</a></li>
                    <li><a href="{{ route('testimonials.index') }}" class="hover:text-brand-gold-lt transition">T&eacute;moignages</a></li>
                    <li><a href="{{ route('contact.create') }}" class="hover:text-brand-gold-lt transition">Contact</a></li>
                    <li><a href="{{ route('volunteer.create') }}" class="hover:text-brand-gold-lt transition">Nous rejoindre</a></li>
                    <li><a href="{{ route('donate') }}" class="hover:text-brand-gold-lt transition font-semibold text-brand-gold">Faire un don</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="font-display text-lg text-white font-semibold mb-4">Contact</h4>
                <ul class="space-y-2.5 text-sm">
                    @if(setting('email'))<li class="flex items-center gap-2"><svg class="w-4 h-4 text-brand-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>{{ setting('email') }}</li>@endif
                    @if(setting('phone'))<li class="flex items-center gap-2"><svg class="w-4 h-4 text-brand-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>{{ setting('phone') }}</li>@endif
                    <li class="flex items-center gap-2"><svg class="w-4 h-4 text-brand-gold shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>{{ setting('address', 'France / International') }}</li>
                </ul>
                {{-- Social --}}
                <div class="flex gap-3 mt-5">
                    @if(setting('facebook_url'))
                    <a href="{{ setting('facebook_url') }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center hover:bg-brand-gold/20 hover:text-brand-gold transition" aria-label="Facebook">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                    </a>
                    @endif
                    @if(setting('instagram_url'))
                    <a href="{{ setting('instagram_url') }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center hover:bg-brand-gold/20 hover:text-brand-gold transition" aria-label="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    @endif
                    @if(setting('whatsapp_number'))
                    <a href="https://wa.me/{{ setting('whatsapp_number') }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center hover:bg-brand-gold/20 hover:text-brand-gold transition" aria-label="WhatsApp">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>
                    @endif
                </div>
            </div>

            {{-- Spiritual + legal --}}
            <div>
                <h4 class="font-display text-lg text-white font-semibold mb-4">Notre fondement</h4>
                <blockquote class="text-sm italic text-white/50 border-l-2 border-brand-gold pl-4 mb-6">
                    &laquo; J&eacute;sus est le chemin, la v&eacute;rit&eacute; et la vie &raquo;
                    <cite class="not-italic text-brand-gold-lt text-xs mt-1 block">&mdash; Jean 14:6</cite>
                </blockquote>
                <div class="text-xs text-white/30 space-y-1">
                    <p>Association loi 1901</p>
                    <p>Si&egrave;ge : France / International</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom bar --}}
    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-white/40">
            <p>&copy; {{ date('Y') }} Mouvement des Femmes de Foi &mdash; Tous droits r&eacute;serv&eacute;s.</p>
            <div class="flex gap-4">
                <a href="{{ route('legal') }}" class="hover:text-white/70 transition">Mentions l&eacute;gales</a>
                <a href="{{ route('privacy') }}" class="hover:text-white/70 transition">Confidentialit&eacute;</a>
            </div>
            <p>Site par <a href="#" class="text-brand-gold/60 hover:text-brand-gold transition">Netverse Technology</a></p>
        </div>
    </div>
</footer>
