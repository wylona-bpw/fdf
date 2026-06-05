<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'read_at'    => 'datetime',
        'replied_at' => 'datetime',
    ];

    /* ---- Scopes ---- */
    public function scopeUnread($q)
    {
        return $q->where('status', 'unread');
    }

    /* ---- Helpers ---- */
    public function markAsRead(): void
    {
        if ($this->status === 'unread') {
            $this->update(['status' => 'read', 'read_at' => now()]);
        }
    }

    public function markAsReplied(): void
    {
        $this->update(['status' => 'replied', 'replied_at' => now()]);
    }
}
