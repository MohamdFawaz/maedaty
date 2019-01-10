<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Models\SubCategory\SubCategory;
use App\Http\Requests\Category\ListCategoryRequest;
use App\Repositories\Category\CategoryRepository;


class CategoryController extends APIController
{

    protected $categoryRepository;


    public function __construct(Request $request, CategoryRepository $categoryRepository)
    {
        $this->setLang($request->header('lang'));
        $request->headers->set('Accept', 'application/json');
        $this->categoryRepository = $categoryRepository;

    }


    public function index(ListCategoryRequest $request){
        $categories = Category::get();
        $data = $this->categoryRepository->getAllCategoryDetailsWSub($categories);
        return $this->respond(
            200,
            trans('messages.category.list'),
            $data
            );
    }

    public function test(Request $request){
        $allcategories = Category::get();
        $categories = $this->categoryRepository->getAllCategoryDetailsWSub($allcategories);
//        $data = [
//            'code' => 'frozen chicken',
//            'category_id' => '7',
//            'ar' => ['name' => 'الدجاج المجمد'],
//            'en' => ['name' => 'Frozen Chicken']
//        ];
//        SubCategory::create($data);
        $message  = $categories;
//        foreach ($allcategories as $category){
//            $message[] = $category;
//        }
        return $this->respond(
            trans('status.success'),
            trans('messages.category.list'),
            $message
            );
    }
}
