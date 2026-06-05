<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GalleryItem extends Model
{
    protected $guarded = ['id'];

    /* ---- Relations ---- */
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    /* ---- Accessors ---- */
    public function getUrlAttribute(): ?string
    {
        if ($this->type === 'video') {
            return $this->video_url;
        }
        return $this->file_path ? asset('storage/' . $this->file_path) : null;
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail_path ? asset('storage/' . $this->thumbnail_path) : null;
    }

    public function getIsVideoAttribute(): bool
    {
        return $this->type === 'video';
    }
}
