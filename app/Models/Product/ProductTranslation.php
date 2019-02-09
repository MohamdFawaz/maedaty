<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['name','description'];


    public function getNameAttribute($value){
        return ucwords($value);
    }

    public function getDescriptionAttribute($value){
        return ucwords($value);
    }

}
