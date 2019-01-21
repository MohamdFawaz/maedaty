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

    public function create(array $input)
    {
        $input['password'] = Hash::make($input['password']);
        $input['jwt_token'] = str_random(25);

        //If user saved successfully, then return true
        if ($user = Category::create($input)) {
            return $input['jwt_token'];
        }

        return false;
    }
}