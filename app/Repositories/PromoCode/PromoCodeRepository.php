<?php

namespace App\Repositories\PromoCode;

use App\Models\PromoCode\PromoCode;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

/**
* Class NotificationRepository.
*/
class PromoCodeRepository  extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;

    public function __construct(PromoCode $model)
    {
        $this->model = $model;
    }

    /**
     * @param object $model
     */
    public function getPromoCode($promoCode)
    {
        $promo = PromoCode::whereCode($promoCode)
            ->whereStatus(1)
            ->where('valid_from', '<=', Carbon::now())
            ->where('valid_to', '>=', Carbon::now())
            ->first();
        return $promo;

    }

    public function getPromoCodeByID($promo_id)
    {
        $promo = PromoCode::whereId($promo_id)->first();
        return $promo;

    }

    public function create($input)
    {

        //If user saved successfully, then return true
        if ($user = PromoCode::create($input)) {
            return true;
        }

        return false;
    }
}