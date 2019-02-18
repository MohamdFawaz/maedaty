<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;

class NotificationTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title','message'];

    public function getTitleAttribute($value)
    {
        return ucwords($value);
    }

    public function getMessageAttribute($value)
    {
        return ucwords($value);
    }
}
