<?php

namespace Plugin\Multivendor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavedFilter extends Model
{
    protected $table = 'tl_multivendor_saved_filters';
    
    protected $fillable = [
        'buyer_id',
        'filter_name',
        'filter_data',
    ];
    
    protected $casts = [
        'filter_data' => 'array',
    ];
    
    protected $appends = [
        'formatted_filters',
    ];
    
    /**
     * Get the buyer who saved this filter
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(\Core\Models\User::class, 'buyer_id');
    }
    
    /**
     * Get formatted filter data for display
     */
    public function getFormattedFiltersAttribute(): array
    {
        $formatted = [];
        
        if (!empty($this->filter_data['energy_type']) && $this->filter_data['energy_type'] !== 'all') {
            $formatted[] = 'Energy: ' . ucfirst($this->filter_data['energy_type']);
        }
        
        if (!empty($this->filter_data['country']) && $this->filter_data['country'] !== 'all') {
            $formatted[] = 'Country: ' . $this->filter_data['country'];
        }
        
        if (!empty($this->filter_data['vintage_year']) && $this->filter_data['vintage_year'] !== 'all') {
            $formatted[] = 'Vintage: ' . $this->filter_data['vintage_year'];
        }
        
        if (!empty($this->filter_data['search'])) {
            $formatted[] = 'Search: "' . $this->filter_data['search'] . '"';
        }
        
        if (!empty($this->filter_data['min_price']) || !empty($this->filter_data['max_price'])) {
            $priceRange = [];
            if (!empty($this->filter_data['min_price'])) {
                $priceRange[] = 'Min: ' . $this->filter_data['min_price'];
            }
            if (!empty($this->filter_data['max_price'])) {
                $priceRange[] = 'Max: ' . $this->filter_data['max_price'];
            }
            $formatted[] = 'Price: ' . implode(', ', $priceRange);
        }
        
        return $formatted;
    }
}
