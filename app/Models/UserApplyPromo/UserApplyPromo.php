<?php

namespace App\Models\UserApplyPromo;

use App\Models\PromoCode\PromoCode;
use Illuminate\Database\Eloquent\Model;

class UserApplyPromo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'promo_id',
        'order_id'
    ];

    public function promo_code(){
        return $this->belongsTo(PromoCode::class,'promo_id');
    }
    
}
