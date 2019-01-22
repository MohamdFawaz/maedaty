<?php

namespace App\Models\UserPoint;

use Illuminate\Database\Eloquent\Model;

class UserPoint extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'value',
        'redeemed'
    ];

    

}
