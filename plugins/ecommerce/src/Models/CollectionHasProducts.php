<?php

namespace Plugin\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Plugin\Ecommerce\Models\Product;

class CollectionHasProducts extends Model
{

    protected $table = "tl_com_colletions_has_products";

    protected $fillable = ['product_id', 'collection_id', 'id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
