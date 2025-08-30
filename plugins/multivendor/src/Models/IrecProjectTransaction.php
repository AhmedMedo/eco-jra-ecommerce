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
        'transaction_status',
        'transaction_date',
    ];

    protected $casts = [
        'quantity_mwh' => 'decimal:2',
        'price_per_mwh' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'transaction_date' => 'datetime',
    ];

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
}
