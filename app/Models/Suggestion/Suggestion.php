<?php

namespace App\Models\Suggestion;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;

class Suggestion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','comment'];


    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

}
