<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;

class NotificationTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title','message'];
}
