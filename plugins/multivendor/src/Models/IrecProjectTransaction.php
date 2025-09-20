<?php

namespace Plugin\Multivendor\Models;

use Core\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IrecProjectTransaction extends Model
{
    protected $table = 'tl_multivendor_irec_project_transactions';

    protected $fillable = [
        'project_id',
        'buyer_id',
        'quantity_mwh',
        'price_per_mwh',
        'total_amount',
        'redeemed_quantity_mwh',
        'remaining_quantity_mwh',
        'transaction_status',
        'transaction_date',
    ];

    protected $casts = [
        'quantity_mwh' => 'decimal:2',
        'price_per_mwh' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'redeemed_quantity_mwh' => 'decimal:2',
        'remaining_quantity_mwh' => 'decimal:2',
        'transaction_date' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Initialize remaining quantity to total quantity for new transactions
            if ($model->remaining_quantity_mwh === null) {
                $model->remaining_quantity_mwh = $model->quantity_mwh;
            }
            
            // Initialize redeemed quantity to 0 for new transactions
            if ($model->redeemed_quantity_mwh === null) {
                $model->redeemed_quantity_mwh = 0.00;
            }
        });
    }

    /**
     * Get the project that was transacted
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(IrecProject::class, 'project_id');
    }

    /**
     * Get the buyer who made the transaction
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    /**
     * Check if transaction is completed
     */
    public function isCompleted(): bool
    {
        return $this->transaction_status === 'completed';
    }

    /**
     * Check if transaction is pending
     */
    public function isPending(): bool
    {
        return $this->transaction_status === 'pending';
    }

    /**
     * Check if transaction is cancelled
     */
    public function isCancelled(): bool
    {
        return $this->transaction_status === 'cancelled';
    }

    /**
     * Get redemptions for this transaction
     */
    public function redemptions()
    {
        return $this->hasMany(IrecRedemption::class, 'transaction_id');
    }

    /**
     * Get remaining quantity available for redemption
     */
    public function getRemainingQuantityAttribute(): float
    {
        if ($this->remaining_quantity_mwh !== null) {
            return $this->remaining_quantity_mwh;
        }

        // Calculate remaining quantity if not set
        $redeemed = $this->redemptions()->where('redemption_status', 'approved')->sum('quantity_mwh');
        return max(0, $this->quantity_mwh - $redeemed);
    }

    /**
     * Get total redeemed quantity
     */
    public function getTotalRedeemedAttribute(): float
    {
        if ($this->redeemed_quantity_mwh !== null) {
            return $this->redeemed_quantity_mwh;
        }

        return $this->redemptions()->where('redemption_status', 'approved')->sum('quantity_mwh');
    }

    /**
     * Check if transaction has remaining quantity for redemption
     */
    public function hasRemainingQuantity(): bool
    {
        return $this->getRemainingQuantityAttribute() > 0;
    }

    /**
     * Check if transaction can be redeemed
     */
    public function canBeRedeemed(): bool
    {
        return $this->isCompleted() && $this->hasRemainingQuantity();
    }

    /**
     * Get formatted remaining quantity
     */
    public function getFormattedRemainingQuantityAttribute(): string
    {
        return number_format($this->getRemainingQuantityAttribute(), 2) . ' MWh';
    }

    /**
     * Get formatted total redeemed quantity
     */
    public function getFormattedTotalRedeemedAttribute(): string
    {
        return number_format($this->getTotalRedeemedAttribute(), 2) . ' MWh';
    }
}
