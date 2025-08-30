<?php

namespace Plugin\Multivendor\Models;

use Core\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class IrecProject extends Model
{
    protected $table = 'tl_multivendor_irec_projects';

    protected $fillable = [
        'project_id',
        'seller_id',
        'project_name',
        'description',
        'energy_type',
        'country',
        'vintage_year',
        'capacity_mwh',
        'available_quantity_mwh',
        'total_irecs',
        'price_per_mwh',
        'vat_included',
        'project_image',
        'project_link',
        'status',
        'coordinates_lat',
        'coordinates_lng',
        'address',
        'city',
        'region',
        'postal_code',
        'evident_id',
        'issuance_date',
        'expiry_date',
        'technology',
        'project_capacity',
        'capacity_unit',
    ];

    protected $casts = [
        'vat_included' => 'boolean',
        'coordinates_lat' => 'decimal:8',
        'coordinates_lng' => 'decimal:8',
        'capacity_mwh' => 'decimal:2',
        'available_quantity_mwh' => 'decimal:2',
        'price_per_mwh' => 'decimal:2',
        'project_capacity' => 'decimal:2',
        'issuance_date' => 'date',
        'expiry_date' => 'date',
    ];

    /**
     * Get the seller that owns the project
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * Get the project certifications
     */
    public function certifications(): HasMany
    {
        return $this->hasMany(IrecProjectCertification::class, 'project_id');
    }

    /**
     * Get the project images
     */
    public function images(): HasMany
    {
        return $this->hasMany(IrecProjectImage::class, 'project_id');
    }

    /**
     * Get the main project image
     */
    public function mainImage(): HasMany
    {
        return $this->hasMany(IrecProjectImage::class, 'project_id')->where('image_type', 'main');
    }

    /**
     * Get the project transactions
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(IrecProjectTransaction::class, 'project_id');
    }

    /**
     * Get the project watchlist entries
     */
    public function watchlistEntries(): HasMany
    {
        return $this->hasMany(IrecProjectWatchlist::class, 'project_id');
    }

    /**
     * Check if project is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if project has available quantity
     */
    public function hasAvailableQuantity(): bool
    {
        return $this->available_quantity_mwh > 0;
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'EGP ' . number_format($this->price_per_mwh, 2) . ' /MWh' . ($this->vat_included ? ' (VAT incl.)' : '');
    }

    /**
     * Get formatted capacity
     */
    public function getFormattedCapacityAttribute(): string
    {
        return number_format($this->project_capacity, 0) . ' ' . $this->capacity_unit;
    }
}
