<?php

namespace App\Models\HotOffersProduct;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Product;

class HotOffersProduct extends Model
{
    protected $with = ['product'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id','discounted_price','from_date','to_date'];


    public function product()
    {
        return $this->belongsTo(Product::class , 'product_id');
    }

}
