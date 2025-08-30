<?php

namespace Plugin\Multivendor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IrecProjectCertification extends Model
{
    protected $table = 'tl_multivendor_irec_project_certifications';

    protected $fillable = [
        'project_id',
        'certification_type',
        'certification_number',
        'issuance_date',
        'expiry_date',
        'verified_by',
    ];

    protected $casts = [
        'issuance_date' => 'date',
        'expiry_date' => 'date',
    ];

    /**
     * Get the project that owns the certification
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(IrecProject::class, 'project_id');
    }

    /**
     * Check if certification is expired
     */
    public function isExpired(): bool
    {
        if (!$this->expiry_date) {
            return false;
        }
        return $this->expiry_date->isPast();
    }

    /**
     * Check if certification is active
     */
    public function isActive(): bool
    {
        if (!$this->issuance_date || !$this->expiry_date) {
            return false;
        }
        return $this->issuance_date->isPast() && $this->expiry_date->isFuture();
    }
}
