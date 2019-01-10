<?php

namespace App\Models\TempUser;

use Illuminate\Database\Eloquent\Model;

class TempUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['device_id','firebase_token'];
}
