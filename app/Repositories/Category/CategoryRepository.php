<?php

namespace App\Repositories\Category;

use App\Exceptions\GeneralException;
use App\Models\Category\Category;
use App\Models\SubCategory\SubCategory;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

/**
* Class NotificationRepository.
*/
class CategoryRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function getAllCategoryDetails($categories)
    {
        $categories_list = [];
        $category_item = [];
        foreach ($categories as $category){
            $category_item['id'] = $category->id;
            $category_item['name'] = $category->translate()->name;
            $category_item['category_image'] = $category->category_image;
            $categories_list[] = $category_item;
        }
        return $categories_list;
    }

    public function getAllCategoryDetailsWSub($categories)
    {
        $categories_list = [];
        $category_item = [];
        foreach ($categories as $category){
            $category_item['id'] = $category->id;
            $category_item['name'] = $category->translate()->name;
            $category_item['category_image'] = $category->category_image;
            $subCategories = SubCategory::where('category_id',$category->id)->get();
            $category_item['subcategory'] = array();
            foreach ($subCategories as $subCategory){
                $val['id'] = $subCategory->id;
                $val['name'] = $subCategory->translate()->name;
                $val['subcategory_image'] = $subCategory->category_image;
                array_push($category_item['subcategory'],$val);
            }
            $categories_list[] = $category_item;
        }
        return $categories_list;
    }

    public function create(array $input)
    {
        $input['password'] = Hash::make($input['password']);
        $input['jwt_token'] = str_random(25);

        //If user saved successfully, then return true
        if ($user = User::create($input)) {
            return $input['jwt_token'];
        }

        return false;
    }
}