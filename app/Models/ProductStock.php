<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PreventDemoModeChanges;

class ProductStock extends Model
{
    use PreventDemoModeChanges;

    protected $fillable = ['product_id', 'variant', 'gold_carat' ,'gold_rate', 'gold_qty', 'diamond_carat', 'diamond_rate', 'diamond_qty', 'sku', 'price', 'qty', 'image'];
    //
    public function product(){
    	return $this->belongsTo(Product::class);
    }

    public function wholesalePrices() {
        return $this->hasMany(WholesalePrice::class);
    }
}
