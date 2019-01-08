<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name','description'];

    public $translationModel = 'App\Models\Product\ProductTranslation';

    protected $fillable = ['name','price','product_image','category_id','subcategory_id'];

    public function getProductImageAttribute($value)
    {
        if ($value) {
            return asset('public/images/products/' . $value);
        } else {
            return asset('public/images/products/no-product.png');
        }
    }
}
