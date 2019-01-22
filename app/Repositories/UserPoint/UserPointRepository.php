<?php

namespace App\Repositories\UserPoint;

use App\Exceptions\GeneralException;
use App\Models\Category\Category;
use App\Models\SubCategory\SubCategory;
use App\Models\UserPoint\UserPoint;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

/**
* Class NotificationRepository.
*/
class UserPointRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;

    public function __construct(UserPoint $model)
    {
        $this->model = $model;
    }

    public function getUserPointSum($user_id){
        return $this->model->where('user_id',$user_id)->sum('value');
    }
    public function getUserPoint($user_id){
        return $this->model->where('user_id',$user_id)->get();
    }

    public function update($input){
        if($input['redeem'] == true){
            $updated = $this->model->where('user_id',$input['user_id'])->update(['redeemed' => 1]);
        }else{
            $updated = $this->model->where('user_id',$input['user_id'])->update(['redeemed' => 0]);
        }
        if($updated){
            return true;
        }
        return false;
    }
}