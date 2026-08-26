@props(['event'])
<article class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-shadow overflow-hidden group">
    <a href="{{ route('events.show', $event->slug) }}">
        @if($event->cover_url)
        <div class="aspect-[16/9] overflow-hidden relative">
            <img src="{{ $event->cover_url }}" alt="{{ $event->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            @if(!$event->is_past)
            <span class="absolute top-3 left-3 px-3 py-1 bg-brand-gold text-brand-blue-dk text-xs font-bold uppercase tracking-wider rounded-full">À venir</span>
            @endif
        </div>
        @else
        <div class="aspect-[16/9] bg-gradient-to-br from-brand-blue to-brand-blue-dk flex items-center justify-center relative">
            <span class="text-brand-gold/30 font-display text-4xl">FDF</span>
            @if(!$event->is_past)
            <span class="absolute top-3 left-3 px-3 py-1 bg-brand-gold text-brand-blue-dk text-xs font-bold uppercase tracking-wider rounded-full">À venir</span>
            @endif
        </div>
        @endif
    </a>
    <div class="p-5">
        <span class="text-xs font-semibold text-brand-gold uppercase tracking-wider">
            {{ $event->event_date->isoFormat('D MMMM YYYY') }}{{ $event->event_time ? ' · ' . \Carbon\Carbon::parse($event->event_time)->format('H:i') : '' }}
        </span>
        <h3 class="font-display text-lg font-semibold mt-1 mb-2 line-clamp-2">
            <a href="{{ route('events.show', $event->slug) }}" class="hover:text-brand-blue transition">{{ $event->title }}</a>
        </h3>
        @if($event->excerpt)
        <p class="text-ink-grey text-sm line-clamp-3">{{ $event->excerpt }}</p>
        @endif
        @if($event->location)
        <div class="flex items-center gap-1.5 mt-4 text-xs text-ink-grey">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <span>{{ $event->location }}</span>
        </div>
        @endif
    </div>
</article>
