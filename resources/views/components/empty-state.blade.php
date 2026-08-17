{{--
    État vide honnête — remplace les divers "sera bientôt disponible" éparpillés
    et incohérents entre les pages (galerie, actualités, témoignages...).

    Usage :
        <x-empty-state
            title="La galerie sera bientôt disponible"
            description="Revenez après notre prochaine mission de terrain."
            action-label="Nous contacter"
            :action-href="route('contact.create')" />
--}}
@props([
    'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
    'title',
    'description' => null,
    'actionLabel' => null,
    'actionHref' => null,
])

<div class="text-center py-16 px-4">
    <div class="w-14 h-14 mx-auto mb-5 rounded-2xl bg-paper-blue flex items-center justify-center">
        <svg class="w-7 h-7 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $icon }}"/>
        </svg>
    </div>
    <p class="font-display text-lg font-bold text-brand-blue-dk mb-2">{{ $title }}</p>
    @if($description)
        <p class="text-ink-grey text-sm max-w-md mx-auto">{{ $description }}</p>
    @endif
    @if($actionLabel && $actionHref)
        <a href="{{ $actionHref }}"
           class="inline-flex items-center gap-1.5 mt-5 text-sm font-semibold text-brand-blue hover:text-brand-gold transition">
            {{ $actionLabel }}
        </a>
    @endif
</div>
