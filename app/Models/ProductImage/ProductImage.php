<?php

namespace App\Models\ProductImage;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;

class ProductImage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id','image_name'];

    public function product()
    {
        return $this->belongsTo(Product::class , 'product_id');
    }

    public function getImageNameAttribute($value)
    {
        if ($value) {
            return asset('public/images/products/' . $value);
        } else {
            return asset('public/images/products/no-product.png');
        }
    }

}
