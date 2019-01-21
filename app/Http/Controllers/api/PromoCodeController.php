<?php

namespace App\Http\Controllers\api;

use App\Models\PromoCode\PromoCode;
use App\Models\UserApplyPromo\UserApplyPromo;
use App\Repositories\PromoCode\PromoCodeRepository;
use App\Repositories\UserApplyPromo\UserApplyPromoRepository;
use Carbon\Carbon;
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
        $this->userApplyPromoRepository= $userApplyPromoRepository;

    }


    public function store(Request $request){
//        $data['promo'] = PromoCode::create([
//            'code' => '2fa7',
//            'valid_times'=> 4,
//            'valid_from' => Carbon::now(),
//            'valid_to' => Carbon::now()->addWeek(1),
//            'status' => 1
//        ]);
        $code = $this->repository->getPromoCode($request->promo_code);
//        $data['apply'] = UserApplyPromo::create([
//            'user_id' => $request->user_id,
//            'promo_id' => $code->id,
//            'order_id' => $request->order_id
//        ]);
        $number_of_uses = $this->userApplyPromoRepository->getNumberOfUses($request->user_id, $request->promo_id, $request->order_id);
        if($number_of_uses >= $code->valid_times){
            return $this->respondWithError(trans('messages.promo_code.used_before'));
        }else{
           return $this->respondWithMessage(trans('messages.promo_code.added'));
        }
    }

}
