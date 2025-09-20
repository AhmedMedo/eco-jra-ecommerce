<?php

namespace Plugin\Multivendor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class IrecRedemption extends Model
{
    protected $table = 'tl_multivendor_irec_redemptions';
    
    protected $fillable = [
        'transaction_id',
        'buyer_id',
        'redemption_reference',
        'quantity_mwh',
        'remaining_quantity_mwh',
        'redemption_purpose',
        'notes',
        'redemption_status',
        'reviewed_by',
        'reviewed_at',
        'review_notes',
    ];
    
    protected $casts = [
        'quantity_mwh' => 'decimal:2',
        'remaining_quantity_mwh' => 'decimal:2',
        'reviewed_at' => 'datetime',
    ];
    
    /**
     * Generate unique redemption reference
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->redemption_reference)) {
                $model->redemption_reference = 'RED-' . strtoupper(Str::random(8));
            }
        });
    }
    
    /**
     * Get the transaction this redemption belongs to
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(IrecProjectTransaction::class, 'transaction_id');
    }
    
    /**
     * Get the buyer who made this redemption
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(\Core\Models\User::class, 'buyer_id');
    }
    
    /**
     * Get the admin who reviewed this redemption
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(\Core\Models\User::class, 'reviewed_by');
    }
    
    /**
     * Get formatted quantity
     */
    public function getFormattedQuantityAttribute(): string
    {
        return number_format($this->quantity_mwh, 2) . ' MWh';
    }

    public function getFormattedRemainingQuantityAttribute(): string
    {
        return number_format($this->remaining_quantity_mwh, 2) . ' MWh';
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->redemption_status) {
            'approved' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
    
    /**
     * Scope for pending redemptions
     */
    public function scopePending($query)
    {
        return $query->where('redemption_status', 'pending');
    }
    
    /**
     * Scope for approved redemptions
     */
    public function scopeApproved($query)
    {
        return $query->where('redemption_status', 'approved');
    }
    
    /**
     * Scope for rejected redemptions
     */
    public function scopeRejected($query)
    {
        return $query->where('redemption_status', 'rejected');
    }
}
