<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category\Category;
use App\Models\Order\Order;
use App\Models\SubCategory\SubCategory;
use App\Repositories\Order\OrderRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        $orders = Order::with('user')->where('order_status','<>','0')->get();
        return view('backend.pages.order.index',compact('orders'));
    }


    public function show($order_id){
        $order = Order::with('user','address')->where('id',$order_id)->first();
        $order_products = $this->repository->getOrderProducts($order->products);
        return view('backend.pages.order.show',compact('order','order_products'));
    }


    public function create(){
        $supercategory = Category::get();

        return view('backend.pages.order.create',compact('supercategory'));
    }

    public function edit($order_id){
        $order = Order::with('user','address')->where('id',$order_id)->first();
        $order_products = $this->repository->getOrderProducts($order->products);
        return view('backend.pages.order.edit',compact('order','order_products'));
    }

    public function update($category_id,Request $request){
        $category = SubCategory::where('id',$category_id)->first();
        $category->translate('ar')->name = $request->name_ar;
        $category->translate('en')->name = $request->name_en;
        $category->category_image = $request->category_image;
        $category->category_id = $request->category_id;
        $category->save();
        return redirect('admin/order');
    }

     public function store(Request $request){
        $category = new SubCategory();
        $category->create([
                'category_image' => $request->category_image,
                'category_id' => $request->category_id,
                'ar' => ["name" => $request->name_ar],
                'en' => ["name" => $request->name_en]
            ]);


            return redirect('admin/order');
        }


    public function destroy($category_id){
        SubCategory::where('id',$category_id)->delete();
        return redirect('admin/order');
    }

    public function deleteProduct($category_id){
        SubCategory::where('id',$category_id)->delete();
        return redirect('admin/order');
    }


}
