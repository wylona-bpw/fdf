<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    /* ---- Scopes ---- */
    public function scopePending($q)
    {
        return $q->where('status', 'pending');
    }

    public function scopeUnread($q)
    {
        return $q->whereNull('read_at');
    }

    /* ---- Accessors ---- */
    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    /* ---- Helpers ---- */
    public function markAsRead(): void
    {
        if (! $this->read_at) {
            $this->update(['read_at' => now()]);
        }
    }
}
