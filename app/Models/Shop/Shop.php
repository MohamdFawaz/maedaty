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

}
