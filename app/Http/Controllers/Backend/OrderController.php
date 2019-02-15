<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order\Order;
use App\Models\OrderStatus\OrderStatus;
use App\Models\SubCategory\SubCategory;
use App\Repositories\Order\OrderRepository;
use App\Repositories\PushNotification\NotificationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    protected $repository;
    protected $notificationRepository;

    public function __construct(OrderRepository $repository,NotificationRepository $notificationRepository)
    {
        $this->repository = $repository;
        $this->notificationRepository= $notificationRepository;
    }

    public function index(){
        $orders = Order::with('user')->where('order_status','<>','0')->get();
        return view('backend.pages.order.index',compact('orders'));
    }


    public function show($order_id){
        $order = Order::with('user','address')->where('id',$order_id)->first();
        $order_products = $this->repository->getOrderProducts($order->products);
        $order_status = OrderStatus::get();
        return view('backend.pages.order.show',compact('order','order_products','order_status'));
    }


    public function edit($order_id){
        $order = Order::with('user','address')->where('id',$order_id)->first();
        $order_products = $this->repository->getOrderProducts($order->products);
        return view('backend.pages.order.edit',compact('order','order_products'));
    }


    public function changeOrderStatus(Request $request){
        $order = $this->repository->getOrderByID($request->order_id);
        $order->order_status = $request->order_status;
        if($request->shipping_fees){
            $order->shipping_fees = $request->shipping_fees;
        }
        if($order->save()){
            app()->setLocale($order->user->lang);
            $this->notificationRepository->sendGCM("".trans('messages.order_updated')."".$order->order_status_string."",'notification',$order->user->firebase_token);
            return redirect(route('backend.order.show',$order->id));
        }
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
