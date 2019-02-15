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
    protected $fillable = ['user_id','first_name','last_name','phone','address','lat','lng'];

    public function getFirstNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getLastNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getFullNameAttribute()
    {
        return ucwords($this->first_name)." ".ucwords($this->last_name);
    }

    public function getGoogleLocationAttribute()
    {
        return 'http://maps.google.com/maps?q=loc:'.$this->lat.','.$this->lng.'';
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

}
