<?php

namespace Plugin\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Plugin\Ecommerce\Models\Colors;

class ProductHasColors extends Model
{

    protected $table = "tl_com_product_has_colors";

    protected $fillable = ['product_id', 'color_id'];

    public function color()
    {
        return $this->belongsTo(Colors::class, 'id', 'color_id');
    }
}
