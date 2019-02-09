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

class ProductController extends Controller
{


    public function index(){
        $products = Product::with('shop')->get();
        return view('backend.pages.product.index',compact('products'));
    }


    public function show($product_id){
        $product = Product::with('shop','product_images','hot_offer')->where('id',$product_id)->first();
        $images = ProductImage::where('product_id',$product_id)->get();
        return view('backend.pages.product.show',compact('product','images'));
    }


    public function create(){
        $shops = Shop::get();
        $categories = Category::get();
        $subcategory = SubCategory::get();
        return view('backend.pages.product.create',compact('shops','categories','subcategory'));
    }

    public function edit($product_id){
        $product = Product::with('shop','product_images','hot_offer','category','subcategory')->where('id',$product_id)->first();
        $images = ProductImage::where('product_id',$product_id)->get();
        $shops = Shop::get();
        $categories = Category::get();
        $subcategory = SubCategory::get();
        return view('backend.pages.product.edit',compact('product','images','shops','categories','subcategory'));
    }

    public function update($product_id,Request $request){
        $product = Product::where('id',$product_id)->first();
        $product->translate('ar')->name = $request->name_ar;
        $product->translate('en')->name = $request->name_en;
        $product->translate('ar')->description = $request->description_ar;
        $product->translate('en')->description = $request->description_en;
        $product->product_image = $request->product_image;
        $product->shop_id = $request->shop_id;
        $product->price = $request->price;
        $product->product_stock= $request->product_stock;
        $product->category_id= $request->category_id;
        $product->subcategory_id= $request->subcategory_id;
        $product->save();
        if($request->discounted_price){
            $product->hot_offer()->create([
                'from_date'  => $request->from_date,
                'to_date'  => $request->to_date,
                'discounted_price'  => $request->discounted_price
            ]);
        }
        return redirect('admin/products');
    }

     public function store(Request $request){
            $product = new Product();
            $product = $product->create([
                'price' => $request->price,
                'product_image' => $request->product_image,
                'shop_id' => $request->shop_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_stock' => $request->product_stock,
                'name' => str_replace(" ","",$request->name_en),
                'en' => ['name' => $request->name_en ,'description' => $request->description_en],
                'ar' => ['name' => $request->name_ar ,'description' => $request->description_ar],
            ]);
            if($request->discounted_price){
                $product->hot_offer()->create([
                    'from_date'  => $request->from_date,
                    'to_date'  => $request->to_date,
                    'discounted_price'  => $request->discounted_price
                ]);
            }
            foreach ($request->product_images as $image){
                $product->product_images()->create([
                   'product_id' => $product->id,
                   'image_name' => $image
                ]);
            }


            return redirect('admin/products');
        }


    public function destroy($product_id){
        Product::where('id',$product_id)->delete();
        return redirect('admin/products');
    }

    public function deleteProduct($product_id){
        Product::where('id',$product_id)->delete();
        return redirect('admin/products');
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
        ProductImage::whereId($image_id)->delete();
        return redirect()->back();
    }


}
