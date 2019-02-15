<?php

namespace App\Http\Controllers\Backend;

use function App\Helpers\getRouteUrl;
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

class SubCategoryController extends Controller
{


    public function index(){
        $categories = SubCategory::with('category')->get();
        return view('backend.pages.subcategory.index',compact('categories'));
    }


    public function show($category_id){
        $category = SubCategory::where('id',$category_id)->first();
        return view('backend.pages.subcategory.show',compact('category'));
    }


    public function create(){
        $supercategory = Category::get();

        return view('backend.pages.subcategory.create',compact('supercategory'));
    }

    public function edit($category_id){
        $category = SubCategory::where('id',$category_id)->first();
        $supercategory = Category::get();
        return view('backend.pages.subcategory.edit',compact('category','supercategory'));
    }

    public function update($category_id,Request $request){
        $category = SubCategory::where('id',$category_id)->first();
        $category->translate('ar')->name = $request->name_ar;
        $category->translate('en')->name = $request->name_en;
        $category->category_image = $request->category_image;
        $category->category_id = $request->category_id;
        $category->save();
        return redirect('admin/subcategory');
    }

     public function store(Request $request){
        $category = new SubCategory();
        $category->create([
                'category_image' => $request->category_image,
                'category_id' => $request->category_id,
                'ar' => ["name" => $request->name_ar],
                'en' => ["name" => $request->name_en]
            ]);
            return redirect('admin/subcategory');
        }


    public function destroy($category_id){
        SubCategory::where('id',$category_id)->delete();
        return redirect('admin/subcategory');
    }

    public function deleteProduct($category_id){
        SubCategory::where('id',$category_id)->delete();
        return redirect('admin/subcategory');
    }


}
