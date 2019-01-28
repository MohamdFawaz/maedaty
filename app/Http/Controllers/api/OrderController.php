<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\UserCart\DeleteCartRequest;
use App\Repositories\Address\AddressRepository;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Order\OrderRepository;
use App\Repositories\UserPoint\UserPointRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\UserCart\UserCart;
use App\Models\Order\Order;

class OrderController extends APIController
{

    protected $repository;
    protected $cartRepository;
    protected $addressRepository;
    protected $userPointRepository;


    public function __construct(Request $request,
                                OrderRepository $repository,
                                CartRepository $cartRepository,
                                AddressRepository $addressRepository,
                                UserPointRepository $userPointRepository)
    {
        $this->repository = $repository;
        $this->cartRepository = $cartRepository;
        $this->addressRepository = $addressRepository;
        $this->userPointRepository = $userPointRepository;
        $this->setLang($request->header('lang'));
        $request->headers->set('Accept', 'application/json');
    }

    public function orderInfo($user_id){
       $cart_items = UserCart::select('product_id','qty')->where('user_id',$user_id)->get();
       $cart = $this->cartRepository->getCartProducts($cart_items);
       $new_order_id = $this->repository->create($user_id, $cart);
       $user_address_list = $this->addressRepository->getAllUserAddress($user_id);
       $data['order_id'] = $new_order_id;
       $data['shipping'] = $this->repository->getShippingFees($cart);
       $data['user_points'] = (string)$this->userPointRepository->getUserPointSum($user_id);
       $data['address_list'] = $this->addressRepository->getAllAddressDetails($user_address_list);
        return $this->respond(
            200,
            trans('messages.order.info'),
            $data
        );
    }

    public function listOrder($user_id){
        $orders= Order::where('user_id',$user_id)->latest()->get();
        $data = $this->repository->getAllOrdersList($orders);
        return $this->respond(
            200,
            trans('messages.order.info'),
            $data
        );
    }

    public function listOrderProducts($order_id){
        $order= Order::whereId($order_id)->first();
        $data = $this->repository->getOrderProducts($order->products);
        return $this->respond(
            200,
            trans('messages.order.info'),
            $data
        );
    }
    public function store(StoreOrderRequest $request){
                $updated = $this->repository->update($request->except('jwt_token'));
                if($updated){
                //function to delete all items in user cart
                //$this->cartRepository->deleteAllCartItems($request->user_id);
                    return $this->respondWithMessage(trans('messages.order.completed'));
                }else{
                    return $this->respondWithError(trans('messages.something_went_wrong'));
                }
    }

    public function delete(DeleteCartRequest $request){
        if($this->repository->delete($request->cart_item_id)){
            return $this->respondWithMessage(trans('messages.cart.removed'));
        }
        return $this->respondWithError(trans('messages.cart.missing_details'));
    }

}
