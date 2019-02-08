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

    function sendGCM($message,$type, $token,$title = 'Maedaty') {


    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array (
            'registration_ids' => array (
                    $token
            ),
            'data' => array (
                    "title" => $title,
                    "message" => $message,
                    "type" => $type
            ),
            'notification' => array (
                    "title" => $title,
                    "message" => $message,
                    "type" => $type
            )
    );
    $fields = json_encode ( $fields );
    $headers = array (
            'Authorization: key=' . $this->settingRepository->getSettingByKey('FCM_Firebase_Token'),
            'Content-Type: application/json'
    );

    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $url );
    curl_setopt ( $ch, CURLOPT_POST, true );
    curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

    $result = curl_exec ( $ch );
    echo $result;
    curl_close ( $ch );
}

}