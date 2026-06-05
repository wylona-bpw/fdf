<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(fn (self $p) => $p->slug = $p->slug ?: Str::slug($p->title));
    }

    /* ---- Scopes ---- */
    public function scopePublished($q)
    {
        return $q->where('is_published', true);
    }
}
