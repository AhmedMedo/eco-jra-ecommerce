<?php

namespace Plugin\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Plugin\Ecommerce\Models\TaxRate;

class TaxProfile extends Model
{
    protected $table = "tl_com_tax_profiles";

    public function rates()
    {
        return $this->hasMany(TaxRate::class, 'profile_id');
    }
}
