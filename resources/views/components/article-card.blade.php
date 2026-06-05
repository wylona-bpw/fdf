@props(['article'])
<article class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-shadow overflow-hidden group">
    <a href="{{ route('articles.show', $article->slug) }}">
        @if($article->cover_url)
        <div class="aspect-[16/9] overflow-hidden">
            <img src="{{ $article->cover_url }}" alt="{{ $article->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        </div>
        @else
        <div class="aspect-[16/9] bg-gradient-to-br from-brand-blue to-brand-blue-dk flex items-center justify-center">
            <span class="text-brand-gold/30 font-display text-4xl">FDF</span>
        </div>
        @endif
    </a>
    <div class="p-5">
        @if($article->category)
        <span class="text-xs font-semibold text-brand-gold uppercase tracking-wider">{{ $article->category->name }}</span>
        @endif
        <h3 class="font-display text-lg font-semibold mt-1 mb-2 line-clamp-2">
            <a href="{{ route('articles.show', $article->slug) }}" class="hover:text-brand-blue transition">{{ $article->title }}</a>
        </h3>
        @if($article->excerpt)
        <p class="text-ink-grey text-sm line-clamp-3">{{ $article->excerpt }}</p>
        @endif
        <div class="flex items-center justify-between mt-4 text-xs text-ink-grey">
            <time datetime="{{ $article->published_at?->toDateString() }}">{{ $article->published_at?->isoFormat('D MMM YYYY') }}</time>
            <span>{{ $article->reading_time }} min de lecture</span>
        </div>
    </div>
</article>
