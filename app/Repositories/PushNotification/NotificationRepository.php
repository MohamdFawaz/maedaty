<?php

namespace App\Repositories\PushNotification;

use App\Models\PushNotification\PushNotification;
use App\Models\UserReview\UserReview;
use App\Repositories\BaseRepository;
use App\Repositories\Setting\SettingRepository;

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
    public $settingRepository;


    public function __construct(PushNotification $model,SettingRepository $settingRepository)
    {
        $this->model = $model;
        $this->settingRepository = $settingRepository;

    }

    public function sendPush($token,$message,$type){
        return $this->sendGCM($message,$type,$token);
    }

    public function sendPushToAllUsers($users,$notification){

        foreach ($users as $user){
            $this->sendGCM($notification->translate($user->lang)->message,'notification',$user->token,$notification->translate($user->lang)->title);
        }
    }



}