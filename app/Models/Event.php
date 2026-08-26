<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_published' => 'boolean',
        'event_date'   => 'date',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $e) {
            $e->slug = $e->slug ?: Str::slug($e->title);
        });
    }

    public function scopePublished($q)
    {
        return $q->where('is_published', true);
    }

    public function scopeUpcoming($q)
    {
        return $q->where('event_date', '>=', now()->startOfDay())->orderBy('event_date');
    }

    public function scopePast($q)
    {
        return $q->where('event_date', '<', now()->startOfDay())->orderByDesc('event_date');
    }

    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover_image ? asset('storage/' . $this->cover_image) : null;
    }

    public function getIsPastAttribute(): bool
    {
        return $this->event_date->lt(now()->startOfDay());
    }
}
