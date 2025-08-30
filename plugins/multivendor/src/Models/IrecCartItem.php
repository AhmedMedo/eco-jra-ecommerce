<?php

namespace Plugin\Multivendor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class IrecCartItem extends Model
{
    protected $table = 'tl_multivendor_irec_cart_items';
    
    protected $fillable = [
        'buyer_id',
        'project_id',
        'uid',
        'quantity_mwh',
        'price_per_mwh',
        'total_amount',
        'project_snapshot',
    ];
    
    protected $casts = [
        'project_snapshot' => 'array',
        'quantity_mwh' => 'decimal:2',
        'price_per_mwh' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];
    
    /**
     * Generate unique ID for cart item
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->uid)) {
                $model->uid = Str::uuid();
            }
            
            // Calculate total amount
            $model->total_amount = $model->quantity_mwh * $model->price_per_mwh;
        });
        
        static::updating(function ($model) {
            // Recalculate total amount on update
            $model->total_amount = $model->quantity_mwh * $model->price_per_mwh;
        });
    }
    
    /**
     * Get the buyer who owns this cart item
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(\Core\Models\User::class, 'buyer_id');
    }
    
    /**
     * Get the IREC project for this cart item
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(IrecProject::class, 'project_id');
    }
    
    /**
     * Get formatted total amount
     */
    public function getFormattedTotalAttribute(): string
    {
        return 'EGP ' . number_format($this->total_amount, 2);
    }
    
    /**
     * Get formatted quantity
     */
    public function getFormattedQuantityAttribute(): string
    {
        return number_format($this->quantity_mwh, 2) . ' MWh';
    }
}
