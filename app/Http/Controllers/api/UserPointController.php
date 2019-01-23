<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\UserPoint\RedeemUserPointRequest;
use App\Http\Requests\UserPoint\RedeemUserPointsRequest;
use App\Models\UserPoint\UserPoint;
use App\Repositories\Order\OrderRepository;
use App\Repositories\UserPoint\UserPointRepository;
use Illuminate\Http\Request;


class UserPointController extends APIController
{


    protected $repository;
    protected $orderRepository;

    public function __construct(Request $request, UserPointRepository $repository, OrderRepository $orderRepository)
    {
        $this->setLang($request->header('lang'));
        $request->headers->set('Accept', 'application/json');
        $this->repository = $repository;
        $this->orderRepository = $orderRepository;
    }

    public function store(RedeemUserPointsRequest $request){

        $redeemed  = $this->repository->update($request->except('jwt_token'));
        $order = $this->orderRepository->getOrderByID($request->order_id);
        $pointsCount = $this->repository->getUserPointSum($request->user_id);
        $data = [];
        if($redeemed == 'redeemed'){
            $data['subtotal'] = $this->repository->getPointsDiscount($order->subtotal_fees,intval($pointsCount));
            $message = trans('messages.points.redeemed');

        }elseif($redeemed == 'revoked'){
            $data['subtotal'] = $order->subtotal_fees;
            $message = trans('messages.points.removed');
        }
        return $this->respond(
            200,
            $message,
            $data
        );
    }


}
