<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory\SubCategory;

class Category extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name'];

    public $translationModel = 'App\Models\Category\CategoryTranslation';

    protected $fillable = ['code','category_image','category_id'];

    public function getCategoryImageAttribute($value)
    {
        if ($value) {
            return asset('public/images/category/' . $value);
        } else {
            return asset('public/images/category/no-category.jpg');
        }
    }



    public function setCategoryImageAttribute($value)
    {
        if($value){
            $img_name = time().rand(1111,9999).'.'.$value->getClientOriginalExtension();
            $value->move(public_path('images/category/'),$img_name);
            $this->attributes['category_image'] = $img_name ;
        }
    }


    public function subcategory(){
        return $this->hasMany(SubCategory::class, 'category_id');
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
        $action .= '<a href="'.route('backend.category.destroy',$this->id).'"><button  class="btn btn-danger btn-condensed ">'.trans("backend.action.delete").'</button></a>';

        $action .= "";
        return $action;
    }
}
