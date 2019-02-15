<?php

namespace App\Http\Controllers\Backend;

use function App\Helpers\getRouteUrl;
use App\Http\Requests\Backend\Category\StoreCategoryRequest;
use App\Http\Requests\Backend\Category\UpdateCategoryRequest;
use App\Models\Category\Category;
use App\Models\Message\Message;
use App\Models\Order\Order;
use App\Models\Product\Product;
use App\Models\ProductImage\ProductImage;
use App\Models\Setting\Setting;
use App\Models\Shop\Shop;
use App\Models\SubCategory\SubCategory;
use App\Models\User\User;
use App\Repositories\Setting\SettingRepository;
use Carbon\Carbon;
use function GuzzleHttp\Psr7\parse_header;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CategoryController extends Controller
{


    public function index(){
        $categories = Category::get();
        return view('backend.pages.category.index',compact('categories'));
    }


    public function show($category_id){
        $category = Category::where('id',$category_id)->first();
        return view('backend.pages.category.show',compact('category'));
    }


    public function create(){
        return view('backend.pages.category.create');
    }

    public function edit($category_id){
        $category = Category::where('id',$category_id)->first();
        return view('backend.pages.category.edit',compact('category'));
    }

    public function update($category_id,UpdateCategoryRequest $request){
        $category = Category::where('id',$category_id)->first();
        $category->translate('ar')->name = $request->name_ar;
        $category->translate('en')->name = $request->name_en;
        $category->category_image = $request->category_image;
        $category->save();
        return redirect('admin/category');
    }

     public function store(StoreCategoryRequest $request){
        $category = new Category();
        $category->create([
                'category_image' => $request->category_image,
                'ar' => ["name" => $request->name_ar],
                'en' => ["name" => $request->name_en]
            ]);


            return redirect('admin/category');
        }


    public function destroy($category_id){
        Category::where('id',$category_id)->delete();
        return redirect('admin/category');
    }

    public function deleteProduct($category_id){
        Category::where('id',$category_id)->delete();
        return redirect('admin/category');
    }


    public function updateStatus(Request $request){
        $product = Product::whereId($request->product_id)->first();
        $product->status = $request->status;
        $product->save();
        $result = array(
            'success' => true,
            'status' => $product->status
        );
        return response()->json($result,200);
    }

    public function deleteImage($image_id){
        $image = ProductImage::whereId($image_id)->destroy();
        $result = array(
            'success' => truedeleteImage
        );
        return response()->json($result,200);
    }


}
