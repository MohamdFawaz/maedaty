<?php

namespace App\Repositories\UserReview;

use App\Models\UserReview\UserReview;
use App\Repositories\BaseRepository;

/**
* Class NotificationRepository.
*/
class UserReviewRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;


    public function __construct(UserReview $model)
    {
        $this->model = $model;
    }

    public function create($input){
        if(UserReview::create($input)){
            return true;
        }
        return false;
    }

    public function delete($input){
        if(UserReview::destroy($input)){
            return true;
        }
        return false;
    }

}