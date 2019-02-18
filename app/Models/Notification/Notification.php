<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;

class Notification extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['title','message'];

    public $translationModel = 'App\Models\Notification\NotificationTranslation';

    protected $fillable = ['code','target','status','image'];


    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('public/images/notification/' . $value);
        } else {
            return asset('public/images/notification/maedaty-logo.jpg');
        }
    }

    public function setImageAttribute($value)
    {
        if($value){
            $img_name = time().rand(1111,9999).'.'.$value->getClientOriginalExtension();
            $value->move(public_path('images/notification/'),$img_name);
            $this->attributes['image'] = $img_name ;
        }
    }

    public function getTargetUserAttribute()
    {
        if ($this->target == 'all') {
            return trans('backend.notification.all');
        } else {
            return $this->user->full_name;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class,'target');
    }

    public function getActionAttribute()
    {
        $action = "";
        if ($this->status == 1) {
            $action .=  "<label class='switch switch-small' >
                    <input title=".trans('backend.action.show_in_app')." type='checkbox' checked='' value='$this->status'  id='$this->id' class='status'>
                    <span></span>
                    </label>";
        } else {
            $action .=  "<label class='switch switch-small'>
                    <input title=".trans('backend.action.show_in_app')." type='checkbox'  value='$this->status' id='$this->id' class='status'>
                    <span></span>
                    </label>";
        }

        $action .= '<a href="#" class="mb-control delete-notification-btn" data-id="'.$this->id.'"><button  class="btn btn-danger btn-condensed ">'.trans("backend.action.delete").'</button></a>';

        $action .= "";
        return $action;
    }
}
