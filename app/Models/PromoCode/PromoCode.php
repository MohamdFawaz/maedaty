<?php

namespace App\Models\PromoCode;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'valid_times',
        'valid_from',
        'valid_to',
        'status'
    ];



}
