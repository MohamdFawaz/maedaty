<?php

namespace App\Http\Controllers\api;

use App\Models\Notification\Notification;
use App\Repositories\Notification\NotificationRepository;
use Illuminate\Http\Request;
use App\Models\Category\Category;



class NotificationController extends APIController
{

    protected $repository;

    public function __construct(Request $request,NotificationRepository $repository)
    {
        $this->setLang($request->header('lang'));
        $request->headers->set('Accept', 'application/json');
        $this->repository = $repository;

    }


    public function index($user_id = null){
        $result = Notification::whereStatus(1)->whereIn('target',['all',$user_id])->latest()->get();
        $notifications = $this->repository->getAllNotifications($result);
        return $this->respond(
            200,
            trans('messages.notification.list'),
            $notifications
        );
    }

    public function store(Request $request){
        $new_notification = Notification::create([
            'code' => 'test for user',
            'target' => $request->user_id,
            'ar' => ['title' => 'اختبار الاشعار', 'message' => 'اختبار الاشعار لمستخدم واحد'],
            'en' => ['title' => 'testing notifications ', 'message' => 'this is a test notification per user']
        ]);
        return $this->respond(
            trans('status.success'),
            trans('messages.category.list'),
            $new_notification
            );
    }
}
