<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
}
