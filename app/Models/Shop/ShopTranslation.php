<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class ShopTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description'];

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getDescriptionAttribute($value)
    {
        return ucwords($value);
    }
}
