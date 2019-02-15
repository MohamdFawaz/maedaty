<?php

namespace App\Models\UserReview;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;

class UserReview extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','product_id','comment','rate_value'];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class , 'product_id');
    }

    public function getActionAttribute()
    {
        $action = "";
        $action .= '<a href="#" class="mb-control delete-review-btn" data-name="'.$this->user->full_name.'" data-id="'.$this->id.'"><button  class="btn btn-danger btn-condensed ">'.trans("backend.action.delete").'</button></a>';

        $action .= "";
        return $action;
    }

    public function getRateValueStarsAttribute()
    {
        $rate = "";
        for ($i=0; $i < $this->rate_value;$i++){
            $rate .= "<span class=\"fa fa-star checked\"></span>";
        }

        return $rate;

    }
}
