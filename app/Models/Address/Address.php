<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;

class Address extends Model
{
    protected $with = ['user'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','first_name','last_name','phone','address'];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

}
