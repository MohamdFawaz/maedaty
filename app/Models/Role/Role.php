<?php

namespace App\Models\Role;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

}
