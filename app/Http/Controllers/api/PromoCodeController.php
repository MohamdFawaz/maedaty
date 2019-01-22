<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\PromoCode\ApplyPromoCodeRequest;
use App\Repositories\PromoCode\PromoCodeRepository;
use App\Repositories\UserApplyPromo\UserApplyPromoRepository;
use Illuminate\Http\Request;



class PromoCodeController extends APIController
{

    protected $repository;
    protected $userApplyPromoRepository;

    public function __construct(Request $request,PromoCodeRepository $repository, UserApplyPromoRepository $userApplyPromoRepository)
    {
        $this->setLang($request->header('lang'));
        $request->headers->set('Accept', 'application/json');
        $this->repository = $repository;
        $this->userApplyPromoRepository = $userApplyPromoRepository;

    }


    public function store(ApplyPromoCodeRequest $request){
        $promo_code = $this->repository->getPromoCode($request->promo_code);
        if(!$promo_code){
            return $this->respondWithError(trans('messages.promo_code.not_exists_or_expired'));
        }

        $number_of_uses = $this->userApplyPromoRepository->getNumberOfUses($request->user_id, $request->promo_id, $request->order_id);
        if($number_of_uses >= $promo_code->valid_times){
            return $this->respondWithError(trans('messages.promo_code.used_before'));
        }else{
           $data['discounted_price'] = $this->userApplyPromoRepository->create($request->only('user_id','order_id'), $promo_code);
           return $this->respond(
               200,
               trans('messages.promo_code.added'),
               $data
           );
        }
    }

}
