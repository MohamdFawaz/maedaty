<?php

namespace App\Repositories\UserApplyPromo;


use App\Models\UserApplyPromo\UserApplyPromo;
use App\Repositories\BaseRepository;
use App\Repositories\Order\OrderRepository;


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
    public $orderRepository;

    public function __construct(UserApplyPromo $model, OrderRepository $orderRepository)
    {
        $this->model = $model;
        $this->orderRepository = $orderRepository;
    }

    public function getNumberOfUses($user_id,$promo_id,$order_id = null){
        return $this->model->where(['user_id' => $user_id,'promo_id' => $promo_id, 'order_id' => $order_id])->count();
    }



    public function create($input,$promo_code)
    {
        $input['promo_id'] = $promo_code->id;
        $discounted_price = $this->orderRepository->getDiscount($input['order_id'],$promo_code);
        //If promo code added successfully, then return true
        if ($user = UserApplyPromo::updateOrCreate($input)) {
            return $discounted_price;
        }

        return false;
    }

}