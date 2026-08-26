<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Campaign extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_active'      => 'boolean',
        'starts_at'      => 'date',
        'ends_at'        => 'date',
        'goal_amount'    => 'decimal:2',
        'raised_amount'  => 'decimal:2',
        'donors_count'   => 'integer',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $c) {
            $c->slug = $c->slug ?: Str::slug($c->title);
        });
    }

    public function scopeActive($q)
    {
        return $q->where('is_active', true);
    }

    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover_image ? asset('storage/' . $this->cover_image) : null;
    }

    public function getPercentRaisedAttribute(): int
    {
        $goal = (float) $this->goal_amount;

        return (int) min(100, round(((float) $this->raised_amount / max(1, $goal)) * 100));
    }

    public function getDaysLeftAttribute(): ?int
    {
        if (! $this->ends_at) {
            return null;
        }

        return max(0, (int) now()->startOfDay()->diffInDays($this->ends_at->copy()->startOfDay(), false));
    }
}
