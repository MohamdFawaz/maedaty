<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\User\AdminSendMessageRequest;
use App\Models\Message\Message;
use App\Models\Order\Order;
use App\Models\OrderStatus\OrderStatus;
use App\Models\SubCategory\SubCategory;
use App\Repositories\Message\MessageRepository;
use App\Repositories\Order\OrderRepository;
use App\Models\User\User;
use App\Repositories\PushNotification\NotificationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{

    protected $repository;
    protected $notificationRepository;

    public function __construct(MessageRepository $repository,NotificationRepository $notificationRepository)
    {
        $this->repository = $repository;
        $this->notificationRepository = $notificationRepository;
    }

    public function index(){
        $inbox_users = Message::where('user','<>','admin')->orderBy('created_at','DESC')->groupBy('user')->get();
        $inbox_users = $this->repository->getLatestMessage($inbox_users);
        return view('backend.pages.message.index',compact('inbox_users'));
    }


    public function listMessages(Request $request){
        $messages = Message::where('user',$request->user_id)->orWhere('target',$request->user_id)->orderBy('created_at','ASC')->get();
        return response()->json($messages);
    }


    public function sendMessage(AdminSendMessageRequest $request){
        $sent = $this->repository->createAdminMessage($request->all());
        if($sent){
            $user = User::whereId($request->user_id)->first();
            $this->notificationRepository->sendGCM($request->body,'chat',$user->firebase_token);
            $status = ['status' => true,'message' => $sent];
            return response()->json($status);
        }else{
            $status = ['status' => false];
            return response()->json($status);
        }

    }





}
