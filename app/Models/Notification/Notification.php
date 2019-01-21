<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;

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

    public function getTitleAttribute($value)
    {
       return ucwords($value);
    }

    public function getMessageAttribute($value)
    {
       return ucwords($value);
    }

}
