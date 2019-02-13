<?php

namespace App\Models\Message;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;

class Message extends Model
{
    protected $with = ['owner'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user','body'];

    public function getHumanCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->toDateString();
    }

    public function owner(){
        return $this->belongsTo(User::class, 'user');
    }
}
