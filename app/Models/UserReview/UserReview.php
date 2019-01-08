<?php

namespace App\Models\UserReview;

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
}
