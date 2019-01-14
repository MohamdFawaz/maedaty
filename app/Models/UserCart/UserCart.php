<?php

namespace App\Models\UserCart;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;
use App\Models\Product\Product;

class UserCart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','product_id','qty'];

    protected $with = ['product'];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class , 'product_id');
    }
}
