<?php

namespace App\Models\UserFavorite;

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

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
