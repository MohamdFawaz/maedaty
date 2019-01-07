<?php

namespace App\Models\SubCategory;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];

    protected $table ="subcategories";

    public $translationModel = 'App\Models\SubCategory\SubCategoryTranslation';

    protected $fillable = ['code','category_id'];

    public function superCategory()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

}
