<?php

namespace App\Models\SubCategory;

use Illuminate\Database\Eloquent\Model;

class SubCategoryTranslation extends Model
{
    protected $table = "subcategory_translations";
    public $timestamps = false;
    protected $fillable = ['name','category_image'];
}
