<?php

namespace App\Repositories\UserApplyPromo;

use App\Models\PromoCode\PromoCode;
use App\Models\UserApplyPromo\UserApplyPromo;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

/**
* Class NotificationRepository.
*/
class UserApplyPromoRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;

    public function __construct(UserApplyPromo $model)
    {
        $this->model = $model;
    }

    public function getNumberOfUses($user_id,$promo_id,$order_id = null){
        return $this->model->where(['user_id' => $user_id,'promo_id' => $promo_id, 'order_id' => $order_id])->count();
    }
    public function create($input)
    {
        //If user saved successfully, then return true
        if ($user = UserApplyPromo::create($input)) {
            return true;
        }

        return false;
    }
}