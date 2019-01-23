<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;

class ShopBranches extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['shop_id','address','lat','lng'];

    public function shop()
    {
        return $this->belongsTo(Shop::class , 'shop_id');
    }
}
