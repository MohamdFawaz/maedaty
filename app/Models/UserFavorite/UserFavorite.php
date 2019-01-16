<?php

namespace App\Models\UserFavorite;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;

class UserFavorite extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class , 'user_id');
    }
}
