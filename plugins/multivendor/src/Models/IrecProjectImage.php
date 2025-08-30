<?php

namespace Plugin\Multivendor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IrecProjectImage extends Model
{
    protected $table = 'tl_multivendor_irec_project_images';

    protected $fillable = [
        'project_id',
        'image_path',
        'image_type',
        'alt_text',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * Get the project that owns the image
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(IrecProject::class, 'project_id');
    }

    /**
     * Get the full image URL
     */
    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }

    /**
     * Check if this is the main image
     */
    public function isMainImage(): bool
    {
        return $this->image_type === 'main';
    }
}
