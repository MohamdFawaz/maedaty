<?php

namespace App\Models\Shop;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory\SubCategory;

class Shop extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name','description'];

    public $translationModel = 'App\Models\Shop\ShopTranslation';

    protected $fillable = ['user_id','image'];

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('public/images/shop/' . $value);
        } else {
            return asset('public/images/shop/no-image.jpg');
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function shop_branches()
    {
        return $this->hasMany(ShopBranches::class, 'shop_id');
    }

    public function getActionAttribute()
    {
        $action = "";

        $action .= "<a href=".route('backend.shop.show',$this->id).">
                    <button type=\"button\" class=\"btn btn-success btn-condensed active\"> <i class='glyphicon glyphicon-eye-open' ></i></button>
                    </a>";
        $action .= "<a href=".route('backend.shop.edit',$this->id).">
                    <button type=\"button\" class=\"btn btn-success btn-condensed active\"> <i class='glyphicon glyphicon-pencil' ></i></button>
                    </a>";
        $action .= '<a href="#" class="mb-control delete-shop-btn" data-name="'.$this->name.'" data-id="'.$this->id.'"><button  class="btn btn-danger btn-condensed ">'.trans("backend.action.delete").'</button></a>';

        $action .= "";
        return $action;
    }
}
