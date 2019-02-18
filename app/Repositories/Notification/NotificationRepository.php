<?php

namespace App\Repositories\Notification;

use App\Models\Notification\Notification;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Mockery\Matcher\NotAnyOf;

/**
* Class NotificationRepository.
*/
class NotificationRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;

    public function __construct(Notification $model)
    {
        $this->model = $model;
    }


    public function getAllNotifications($notifications)
    {
        $notifications_list = [];
        $notification_item = [];
        foreach ($notifications as $notification){
            $notification_item['message'] = $notification->message;
            $notification_item['image'] = $notification->image;
            $notification_item['date'] = Carbon::parse($notification['created_at'])->diffForHumans();
            $notifications_list[] = $notification_item;
        }
        return $notifications_list;
    }

    public function getAll()
    {
        $notifications = Notification::with('user')->get();
        return $notifications;
    }

    public function create(array $input)
    {
        $notification_image = $input['notification_image'];
        $notification = Notification::create([
            'image' => $notification_image,
            'target' => $input['target'],
            'status' => 1,
            'ar' => ['title' => $input['title_ar'], 'message' => $input['text_ar']],
            'en' => ['title' => $input['title_en'], 'message' => $input['text_en']]
        ]);
        //If notification saved successfully then return true
        if ($notification) {
            return $notification;
        }

        return false;
    }
}