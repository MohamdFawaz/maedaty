<?php

namespace App\Repositories\Message;

use App\Models\Message\Message;
use App\Models\UserReview\UserReview;
use App\Repositories\BaseRepository;

/**
* Class NotificationRepository.
*/
class MessageRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;


    public function __construct(Message $model)
    {
        $this->model = $model;
    }


    public function listMessages($messages,$user_id){
        $message_item = [];
        $message_list = [];
        foreach ($messages as $message){
            $message_item['body'] = $message->body;
            $message_item['isAdmin'] = ($message->user == 'admin') ?? true;
            $message_list[] = $message_item;
        }
        return $message_list;
    }

    public function create($input){
        $message = new Message();
        $message->user = $input['user_id'];
        $message->target = 'admin';
        $message->body = $input['body'];
        if($message->save()){
            return $message;
        }
        return false;
    }

    public function delete($input){
        if(Message::destroy($input)){
            return true;
        }
        return false;
    }

}