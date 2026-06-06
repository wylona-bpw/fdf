{{--
    Sticky CTA mobile — barre fixe en bas qui apparaît dès qu'on scroll
    au-delà du hero. Affichée uniquement sur mobile (lg:hidden).

    Inclut dans le layout principal, après le </footer>.
--}}
<div x-data="{ visible: false }"
     x-init="
        window.addEventListener('scroll', () => {
            visible = window.scrollY > 400;
        }, { passive: true });
     "
     x-show="visible"
     x-cloak
     x-transition:enter="transition transform duration-300"
     x-transition:enter-start="translate-y-full"
     x-transition:enter-end="translate-y-0"
     x-transition:leave="transition transform duration-200"
     x-transition:leave-start="translate-y-0"
     x-transition:leave-end="translate-y-full"
     class="lg:hidden fixed bottom-0 inset-x-0 z-40 bg-white border-t border-stone-200
            shadow-[0_-4px_20px_rgba(8,21,56,0.08)] px-4 py-3"
     style="padding-bottom: max(0.75rem, env(safe-area-inset-bottom));">

    <div class="flex items-center gap-2">
        {{-- Bouton "Faire un don" — primaire (or) --}}
        <a href="{{ route('donate') }}"
           class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-3
                  bg-brand-gold text-brand-blue-dk font-bold rounded-lg text-sm
                  shadow-md active:scale-95 transition-transform">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <span>Faire un don</span>
        </a>

        {{-- Bouton "Bénévole" — secondaire (outline) --}}
        <a href="{{ route('volunteer.create') }}"
           class="px-4 py-3 border border-brand-blue text-brand-blue font-semibold
                  rounded-lg text-sm active:scale-95 transition-transform">
            Bénévole
        </a>
    </div>
</div>
