<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order\Order;
use App\Models\ORderStatus\OrderStatus;
use App\Models\SubCategory\SubCategory;
use App\Models\UserReview\UserReview;
use App\Repositories\Order\OrderRepository;
use App\Repositories\PushNotification\NotificationRepository;
use App\Repositories\UserReview\UserReviewRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserReviewsController extends Controller
{

    protected $repository;

    public function __construct(UserReviewRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        $userReviews = $this->repository->getAll();

        return view('backend.pages.user_review.index',compact('userReviews'));
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


    public function destroy($review_id){
        UserReview::where('id',$review_id)->delete();
        return redirect('admin/review');
    }

    public function deleteProduct($category_id){
        SubCategory::where('id',$category_id)->delete();
        return redirect('admin/order');
    }


}
