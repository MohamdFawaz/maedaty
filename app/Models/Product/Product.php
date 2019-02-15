<?php

namespace App\Models\Product;

use App\Models\Category\Category;
use App\Models\HotOffersProduct\HotOffersProduct;
use App\Models\ProductImage\ProductImage;
use App\Models\Shop\Shop;
use App\Models\SubCategory\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;


class Product extends Model
{
    use \Dimsav\Translatable\Translatable;

    use SoftDeletes;

    public $translatedAttributes = ['name','description'];

    public $translationModel = 'App\Models\Product\ProductTranslation';

    protected $fillable = ['name','price','product_image','category_id','subcategory_id','product_stock','shop_id'];

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

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }

    public function getNameAttribute($value)
    {
        ucwords($value);
    }

      public function getDescriptionAttribute($value)
    {
        ucwords($value);
    }

    public function getProductImageAttribute($value)
    {
        if ($value) {
            return asset('public/images/products/' . $value);
        } else {
            return asset('public/images/products/no-product.png');
        }
    }

    public function setProductImageAttribute($value)
    {
        if($value){
            $img_name = time().rand(1111,9999).'.'.$value->getClientOriginalExtension();
            $value->move(public_path('images/products/'),$img_name);
            $this->attributes['product_image'] = $img_name ;
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
            $action .=  "<label class='switch switch-small' >
                    <input type='checkbox' checked='' value='$this->status'  id='$this->id' class='status'>
                    <span></span>
                    </label>";
        } else {
            $action .=  "<label class='switch switch-small'>
                    <input type='checkbox'  value='$this->status' id='$this->id' class='status'>
                    <span></span>
                    </label>";
        }
        $action .= " ";

        $action .= "<a href=".url()->current()."/".$this->id.">
                    <button type=\"button\" class=\"btn btn-success btn-condensed active\"> <i class='glyphicon glyphicon-eye-open' ></i></button>
                    </a>";
        $action .= "<a href=".url()->current()."/".$this->id."/edit".">
                    <button type=\"button\" class=\"btn btn-success btn-condensed active\"> <i class='glyphicon glyphicon-pencil' ></i></button>
                    </a>";
        $action .= '<a href="#" class="mb-control delete-product-btn" data-name="'.$this->translate()->name.'" data-id="'.$this->id.'"><button  class="btn btn-danger btn-condensed ">'.trans("backend.action.delete").'</button></a>';

        $action .= "";
        return $action;
    }

}
