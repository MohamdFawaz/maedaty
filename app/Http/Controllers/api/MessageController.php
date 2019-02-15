<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\User\SendMessageRequest;
use App\Models\User\User;
use App\Repositories\Message\MessageRepository;
use App\Models\Message\Message;
use App\Repositories\PushNotification\NotificationRepository;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Models\SubCategory\SubCategory;
use App\Http\Requests\Category\ListCategoryRequest;
use App\Repositories\Category\CategoryRepository;


class MessageController extends APIController
{

    protected $repository;
    protected $notificationRepository;


    public function __construct(Request $request, MessageRepository $repository,NotificationRepository $notificationRepository)
    {
        $this->setLang($request->header('lang'));
        $request->headers->set('Accept', 'application/json');
        $this->repository = $repository;
        $this->notificationRepository = $notificationRepository;

    }


    public function index($user_id){
        $message = Message::where('user',$user_id)->orWhere('target',$user_id)->get();
        $data = $this->repository->listMessages($message,$user_id);
        return $this->respond(
            200,
            trans('messages.message.list'),
            $data
            );
    }

    public function sendMessage(SendMessageRequest $request){
        $messageSent = $this->repository->create($request->except('jwt_token'));
        if($messageSent){
            // TODO send Push Notification
            return $this->respondWithMessage(trans('messages.message.send'));
        }else{
            return $this->respondWithError(trans('messages.something_went_wrong'));
        }

    }

    public function sendAdminMessage(SendMessageRequest $request){
        $messageSent = $this->repository->create($request->all());
        $user = User::where('id',$request->user_id)->first();
        if($messageSent){
            $this->notificationRepository->sendGCM($messageSent->body,'chat',$user->firebase_token);
            return $this->respondWithMessage(trans('messages.message.send'));
        }else{
            return $this->respondWithError(trans('messages.something_went_wrong'));
        }

    }

}
