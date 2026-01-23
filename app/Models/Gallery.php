<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gallery extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'type',
    ];

    /**
     * Get the user that owns the gallery.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the images for the gallery.
     */
    public function images(): HasMany
    {
        return $this->hasMany(GalleryImage::class);
    }
}
