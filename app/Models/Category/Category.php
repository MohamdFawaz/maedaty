<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory\SubCategory;

class Category extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];

    public $translationModel = 'App\Models\Category\ProductTranslation';

    protected $fillable = ['code'];

    public function subcategory(){
        return $this->hasMany(SubCategory::class, 'category_id');
    }
}
