<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function scopePublished($q)
    {
        return $q->where('is_published', true);
    }

    public function scopeOrdered($q)
    {
        return $q->orderBy('sort_order');
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }
}
