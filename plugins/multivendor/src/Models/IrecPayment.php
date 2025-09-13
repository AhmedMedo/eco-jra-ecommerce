<?php

namespace Plugin\Multivendor\Models;

use Core\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IrecPayment extends Model
{
    protected $table = 'tl_multivendor_irec_payments';

    protected $fillable = [
        'buyer_id',
        'transaction_id',
        'bank_name',
        'iban',
        'account_number',
        'account_holder_name',
        'receipt_path',
        'payment_status',
        'submitted_at',
        'reviewed_at',
        'reviewed_by',
        'notes',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    /**
     * Get the buyer who submitted the payment
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    /**
     * Get the transaction this payment is for
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(IrecProjectTransaction::class, 'transaction_id');
    }

    /**
     * Get the admin who reviewed the payment
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Check if payment is pending
     */
    public function isPending(): bool
    {
        return $this->payment_status === 'pending';
    }

    /**
     * Check if payment is approved
     */
    public function isApproved(): bool
    {
        return $this->payment_status === 'approved';
    }

    /**
     * Check if payment is rejected
     */
    public function isRejected(): bool
    {
        return $this->payment_status === 'rejected';
    }

    /**
     * Get status label with styling
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->payment_status) {
            'pending' => 'Pending Review',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            default => 'Unknown'
        };
    }

    /**
     * Get status badge class for styling
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->payment_status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'approved' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
}
