<?php

namespace App\Models\Product;

use App\Models\HotOffersProduct\HotOffersProduct;
use App\Models\ProductImage\ProductImage;
use App\Models\Shop\Shop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;


class Product extends Model
{
    use \Dimsav\Translatable\Translatable;

    use SoftDeletes;

    public $translatedAttributes = ['name','description'];

    public $translationModel = 'App\Models\Product\ProductTranslation';

    protected $fillable = ['name','price','product_image','category_id','subcategory_id','product_stock'];

    public function hot_offer(){
        return $this->hasOne(HotOffersProduct::class, 'product_id')
            ->where('from_date','<',Carbon::now()->toDateString())
            ->where('to_date','>=',Carbon::now()->toDateString());
    }

    public function product_images(){
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function shop(){
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    public function getProductImageAttribute($value)
    {
        if ($value) {
            return asset('public/images/products/' . $value);
        } else {
            return asset('public/images/products/no-product.png');
        }
    }

    public function getStatusLabelAttribute()
    {
        if ($this->status == 1) {
            return "<span class=\"label label-success label-form\" id='label-$this->id'>".trans('backend.products.active')."</span>";
        } else {
            return "<span class=\"label label-danger label-form\" id='label-$this->id'>".trans('backend.products.not_active')."</span>";
        }
    }
    public function getActionAttribute()
    {
        $action = "";
        if ($this->status == 1) {
            $action .=  "<label class='switch'>
                    <input type='checkbox' checked='' value='$this->status'  id='$this->id' class='status'>
                    <span></span>
                    </label>";
        } else {
            $action .=  "<label class='switch'>
                    <input type='checkbox'  value='$this->status' id='$this->id' class='status'>
                    <span></span>
                    </label>";
        }
//        $action .= "<button class=\"btn btn-info btn-condensed\"><i class=\"glyphicon glyphicon-phone-alt\"></i></button>";
        return $action;
    }

}
