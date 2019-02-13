<?php

namespace App\Http\Controllers\Backend;

use App\Models\Message\Message;
use App\Models\Order\Order;
use App\Models\OrderStatus\OrderStatus;
use App\Models\SubCategory\SubCategory;
use App\Repositories\Order\OrderRepository;
use App\Repositories\PushNotification\NotificationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{

    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        $inbox_users = Message::groupBy('user')->where('user','<>','admin')->latest()->get();
        $messages = Message::get();
        return view('backend.pages.message.index',compact('inbox_users','messages'));
    }


    public function listMessages(Request $request){
        $messages = Message::where('user',$request->user_id)->orWhere('target',$request->user_id)->get();
        return response()->json($messages);
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




}
