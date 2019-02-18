<?php

namespace App\Http\Controllers\Backend;

use App\Models\Notification\Notification;
use App\Models\Notification\NotificationTranslation;
use App\Models\User\User;
use App\Repositories\Notification\NotificationRepository;
use App\Repositories\PushNotification\NotificationRepository as PushNotificationRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{

    protected $repository;
    protected $pushNotificationRepository;
    protected $userRepository;

    public function __construct(NotificationRepository $repository,PushNotificationRepository $pushNotificationRepository,UserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->pushNotificationRepository = $pushNotificationRepository;
        $this->userRepository = $userRepository;
    }

    public function index(){
        $notifications = $this->repository->getAll();
        $users = $this->userRepository->getAll();
        return view('backend.pages.notification.index',compact('notifications','users'));
    }

    public function store(Request $request){
        $notification = $this->repository->create($request->all());
        if($notification){
            $users = $this->userRepository->getAll();
            $this->pushNotificationRepository->sendPushToAllUsers($users,$notification);
        }
        return redirect('admin/notification');
    }

    public function delete($notification_id){
        Notification::whereId($notification_id)->delete();
        NotificationTranslation::whereNotificationId($notification_id)->delete();
        return redirect('admin/notification');
    }

    public function updateStatus(Request $request){
        $notification = Notification::whereId($request->user_id)->first();
        $notification->status = $request->status;
        $notification->save();
        $result = array(
            'success' => true,
            'status' => $notification->status
        );
        return response()->json($result,200);
    }



}
