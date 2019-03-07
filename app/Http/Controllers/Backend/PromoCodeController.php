<?php

namespace App\Http\Controllers\Backend;

use App\Models\Notification\Notification;
use App\Models\Notification\NotificationTranslation;
use App\Models\PromoCode\PromoCode;
use App\Models\User\User;
use App\Repositories\Notification\NotificationRepository;
use App\Repositories\PromoCode\PromoCodeRepository;
use App\Repositories\PushNotification\NotificationRepository as PushNotificationRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromoCodeController extends Controller
{

    protected $repository;

    public function __construct(PromoCodeRepository $repository,PushNotificationRepository $pushNotificationRepository,UserRepository $userRepository)
    {
        $this->repository = $repository;
    }

    public function index(){
        $promoCodes = $this->repository->getAll();
        return view('backend.pages.promo_code.index',compact('promoCodes'));
    }

    public function store(Request $request){
        $this->repository->create($request->except('_token','_method'));
        return redirect('admin/promo');
    }

    public function delete($promo_id){
        $this->repository->delete($promo_id);
        return redirect('admin/promo');
    }

    public function updateStatus(Request $request){
        $promoCode = $this->repository->getPromoCodeByID($request->promo_id);
        $promoCode->status = $request->status;
        $promoCode->save();
        $result = array(
            'success' => true,
            'status' => $promoCode->status
        );
        return response()->json($result,200);
    }



}
