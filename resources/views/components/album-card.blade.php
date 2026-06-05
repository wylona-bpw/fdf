@props(['album'])
<a href="{{ route('gallery.show', $album->slug) }}" class="group block rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow">
    @if($album->cover_url)
    <div class="aspect-[4/3] overflow-hidden relative">
        <img src="{{ $album->cover_url }}" alt="{{ $album->title }}"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
        <div class="absolute bottom-3 left-4 right-4 text-white">
            <h3 class="font-display font-semibold text-lg">{{ $album->title }}</h3>
            <p class="text-white/70 text-sm">{{ $album->items_count }} photos &bull; {{ $album->event_date?->isoFormat('MMM YYYY') }}</p>
        </div>
    </div>
    @else
    <div class="aspect-[4/3] bg-gradient-to-br from-brand-blue to-brand-blue-dk flex flex-col items-center justify-center text-white p-6">
        <h3 class="font-display font-semibold text-lg text-center">{{ $album->title }}</h3>
        <p class="text-white/50 text-sm mt-1">{{ $album->items_count }} &eacute;l&eacute;ments</p>
    </div>
    @endif
</a>
