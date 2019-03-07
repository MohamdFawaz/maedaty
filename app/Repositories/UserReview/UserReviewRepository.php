<?php

namespace App\Repositories\UserReview;

use App\Models\UserReview\UserReview;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

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

    public function getAll(){
        $userReviews = UserReview::with('user','product')->get();
        return $userReviews;
    }

    public function getStoreReviewAll(){
        $userReviews = UserReview::with('user')->whereHas('product',function ($query){
            $query->where('shop_id',Auth::user()->shop->id);
        })->get();
        return $userReviews;
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