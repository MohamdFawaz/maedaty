<?php

namespace App\Models\ORderStatus;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    public $timestamps = false;

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
}
