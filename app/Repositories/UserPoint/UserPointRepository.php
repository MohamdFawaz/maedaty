<?php

namespace App\Repositories\UserPoint;

use App\Models\Setting\Setting;
use App\Models\UserPoint\UserPoint;
use App\Repositories\BaseRepository;
use phpDocumentor\Reflection\Types\Integer;

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

    public function getPointsDiscount($subtotal, $pointsCount){
        $pointsRules = Setting::where('key','points')->first();
        $pointsRules = json_decode($pointsRules->value);
        $rules_list = [];

        foreach ($pointsRules as $pointsRule){
            $rules_list[] = [
                'range' => explode('-',$pointsRule->range),
                'amount' => $pointsRule->amount
            ];
        }

        for($i = 0; $i < count($rules_list); $i++){
            if($pointsCount >= intval($rules_list[$i]['range'][0]) && $pointsCount <= intval($rules_list[$i]['range'][1])){
                $new_subtotal = $subtotal - $rules_list[$i]['amount'];
            }
        }
        return (string)max($new_subtotal,0);
    }

    public function update($input){
        if($input['redeem'] == true){
            $this->model->where('user_id',$input['user_id'])->update(['redeemed' => 1]);
            return 'redeemed';
        }elseif($input['redeem'] == false){
            $this->model->where('user_id',$input['user_id'])->update(['redeemed' => 0]);
            return 'revoked';
        }
        return false;
    }
}