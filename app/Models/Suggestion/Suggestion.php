<?php

namespace App\Models\Suggestion;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;

class Suggestion extends Model
{
    protected $with = ['user'];
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

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->toDateString();
    }

    public function getActionAttribute()
    {
        $action = "";
        $action .= '<a href="#" class="mb-control delete-suggestion-btn" data-name="'.$this->user->full_name.'" data-id="'.$this->id.'"><button  class="btn btn-danger btn-condensed ">'.trans("backend.action.delete").'</button></a>';
        $action .= "";
        return $action;
    }
}
