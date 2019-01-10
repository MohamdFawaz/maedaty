<?php

namespace App\Models\SocialLogin;

use Illuminate\Database\Eloquent\Model;

class SocialLogin extends Model
{
    protected $table = "social_login";
    protected $fillable = ['user_id','provider','auth_id','username','email','profile_picture'];
}
