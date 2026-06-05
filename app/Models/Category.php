<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(fn (self $c) => $c->slug = $c->slug ?: Str::slug($c->name));
    }

    /* ---- Relations ---- */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /* ---- Scopes ---- */
    public function scopeActive($q)
    {
        return $q->where('is_active', true);
    }

    public function scopeOrdered($q)
    {
        return $q->orderBy('sort_order')->orderBy('name');
    }
}
