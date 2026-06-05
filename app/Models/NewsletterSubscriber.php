<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class NewsletterSubscriber extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'subscribed_at'   => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(fn (self $s) => $s->token = $s->token ?: Str::random(64));
    }

    /* ---- Scopes ---- */
    public function scopeActive($q)
    {
        return $q->whereNull('unsubscribed_at');
    }

    /* ---- Helpers ---- */
    public function unsubscribe(): void
    {
        $this->update(['unsubscribed_at' => now()]);
    }
}
