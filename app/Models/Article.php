<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at'  => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $a) {
            $a->slug = $a->slug ?: Str::slug($a->title);
            if ($a->is_published && ! $a->published_at) {
                $a->published_at = now();
            }
        });
    }

    /* ---- Relations ---- */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /* ---- Scopes ---- */
    public function scopePublished($q)
    {
        return $q->where('is_published', true)
                  ->where('published_at', '<=', now());
    }

    public function scopeLatest($q)
    {
        return $q->orderByDesc('published_at');
    }

    /* ---- Accessors ---- */
    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover_image ? asset('storage/' . $this->cover_image) : null;
    }

    public function getReadingTimeAttribute(): int
    {
        return max(1, (int) ceil(str_word_count(strip_tags($this->body)) / 200));
    }
}
