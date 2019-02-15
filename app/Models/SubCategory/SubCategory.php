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

    protected $fillable = ['code','category_id','category_image'];

    public function getCategoryImageAttribute($value)
    {
        if ($value) {
            return asset('public/images/subcategory/' . $value);
        } else {
            return asset('public/images/subcategory/no-category.jpg');
        }
    }

    public function setCategoryImageAttribute($value)
    {
        if($value){
            $img_name = time().rand(1111,9999).'.'.$value->getClientOriginalExtension();
            $value->move(public_path('images/subcategory/'),$img_name);
            $this->attributes['category_image'] = $img_name ;
        }
    }

    public function get_category($value)
    {
            $category = Category::where('id', $value)->first();
        return $category;
    }

    public function category(){

        return $this->belongsTo(Category::class, 'category_id');

    }
    public function getActionAttribute()
    {
        $action = "";

        $action .= "<a href=".url()->current()."/".$this->id.">
                    <button type=\"button\" class=\"btn btn-success btn-condensed active\"> <i class='glyphicon glyphicon-eye-open' ></i></button>
                    </a>";
        $action .= "<a href=".url()->current()."/".$this->id."/edit".">
                    <button type=\"button\" class=\"btn btn-success btn-condensed active\"> <i class='glyphicon glyphicon-pencil' ></i></button>
                    </a>";
        $action .= '<a href="#" class="mb-control delete-subcategory-btn" data-name="'.$this->name.'" data-id="'.$this->id.'"><button  class="btn btn-danger btn-condensed ">'.trans("backend.action.delete").'</button></a>';

        $action .= "";
        return $action;
    }
}
