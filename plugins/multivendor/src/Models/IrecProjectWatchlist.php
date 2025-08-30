<?php

namespace Plugin\Multivendor\Models;

use Core\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IrecProjectWatchlist extends Model
{
    protected $table = 'tl_multivendor_irec_project_watchlist';

    protected $fillable = [
        'project_id',
        'buyer_id',
    ];

    /**
     * Get the project in the watchlist
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(IrecProject::class, 'project_id');
    }

    /**
     * Get the buyer who added the project to watchlist
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}
