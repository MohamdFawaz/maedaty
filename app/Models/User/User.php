<?php

namespace App\Models\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\SocialLogin\SocialLogin;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $with = ['socialaccount'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','phone','location','lat','lng','firebase_token','name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }
    public function getJWTCustomClaims() {
        return [];
    }

    public function getUseImageAttribute($value)
    {
        if ($value) {

            return asset('public/images/profile/' . $value);
        } else {
            return asset('public/images/profile/no-image.jpg');
        }
    }

    public function socialaccount(){
        return $this->hasOne(SocialLogin::class, 'user_id');
    }

}
