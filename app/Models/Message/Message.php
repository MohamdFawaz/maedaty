<?php

namespace App\Models\Message;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','body'];

    protected $with = ['user'];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
