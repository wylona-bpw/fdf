<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Album extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_published' => 'boolean',
        'event_date'   => 'date',
    ];

    protected static function booted(): void
    {
        static::creating(fn (self $a) => $a->slug = $a->slug ?: Str::slug($a->title));
    }

    /* ---- Relations ---- */
    public function items(): HasMany
    {
        return $this->hasMany(GalleryItem::class)->orderBy('sort_order');
    }

    public function photos(): HasMany
    {
        return $this->items()->where('type', 'photo');
    }

    public function videos(): HasMany
    {
        return $this->items()->where('type', 'video');
    }

    /* ---- Scopes ---- */
    public function scopePublished($q)
    {
        return $q->where('is_published', true);
    }

    public function scopeOrdered($q)
    {
        return $q->orderByDesc('event_date')->orderBy('sort_order');
    }

    /* ---- Accessors ---- */
    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover_image ? asset('storage/' . $this->cover_image) : null;
    }

    public function getItemsCountAttribute(): int
    {
        return $this->items()->count();
    }
}
