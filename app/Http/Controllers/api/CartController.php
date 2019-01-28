<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\UserCart\DeleteCartRequest;
use App\Http\Requests\UserCart\UpdateCartRequest;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use App\Http\Requests\UserCart\StoreCartRequest;
use App\Models\UserCart\UserCart;

class CartController extends APIController
{

    protected $repository;


    public function __construct(Request $request, CartRepository $repository)
    {
        $this->repository = $repository;
        $this->setLang($request->header('lang'));
        $request->headers->set('Accept', 'application/json');
    }

    public function index($user_id){
        $cart_items =  UserCart::where('user_id',$user_id)->get();
        $item_details = $this->repository->getCartItemDetails($cart_items);
        return $this->respond(
            200,
            trans('messages.cart.list'),
            $item_details
            );
    }
    public function store(StoreCartRequest $request){
            if($request->cart_item_id){
                if($this->repository->update($request->except('jwt_token'))){
                    return $this->respondWithMessage(trans('messages.cart.updated'));
                }else{
                    return $this->respondWithError(trans('messages.cart.over_available_stock'));
                }
            }else{
                $ifExists = $this->repository->checkIfProductExists($request->user_id,$request->product_id);
                if($ifExists){
                    return $this->respondWithError(trans('messages.cart.already_in_cart'));
                }
                $cart_item = $request->except('jwt_token');
                if($this->repository->create($cart_item)){
                    return $this->respondWithMessage(trans('messages.cart.added'));
                }else{
                    return $this->respondWithError(trans('messages.cart.over_available_stock'));
                }
            }
    }

    public function update(UpdateCartRequest $request){
        if($this->repository->delete($request->cart_item_id)){
            return $this->respondWithMessage(trans('messages.cart.removed'));
        }
        return $this->respondWithError(trans('messages.cart.missing_details'));
    }

    public function delete(DeleteCartRequest $request){
        if($this->repository->delete($request->cart_item_id)){
            return $this->respondWithMessage(trans('messages.cart.removed'));
        }
        return $this->respondWithError(trans('messages.cart.missing_details'));
    }

}
