<?php

namespace App\Repositories\Cart;

use App\Models\UserCart\UserCart;
use App\Repositories\BaseRepository;
use App\Repositories\Product\ProductRepository;

/**
* Class NotificationRepository.
 *
 *
*/
class CartRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;
    public $productRepository;



    public function __construct(UserCart $model, ProductRepository $productRepository)
    {
        $this->model = $model;
        $this->productRepository = $productRepository;
    }

    public function getCartItemDetails($items){
        $cart_items_list = [];
        $cart_item = [];
        foreach ($items as $item){
            $stock_status = $this->updateQtyToStock($item);
            $cart_item['cart_item_id'] = $item->id;
            $cart_item['qty'] = $item->qty;
            $cart_item['product'] = $this->productRepository->getProductDetails($item->product);
            $cart_item['product_stock'] = $item->product->product_stock;
            $cart_item['is_out_of_stock'] = $stock_status;
            $cart_items_list[] = $cart_item;
        }
        return $cart_items_list;
    }

    public function create($input){
        $input['qty'] = 1;
        if($input['qty'] > $this->productRepository->getProductStock($input['product_id'])){
            return false;
        }
        if(UserCart::create($input)){
            return true;
        }
        return false;
    }

    public function update($input){
        $cart_item = UserCart::where('id',$input['cart_item_id'])->first();
            if(isset($input['plus'])  == true){
                $new_qty = $cart_item->qty++;
                if($new_qty > $cart_item->product->product_stock){
                    return false;
                }else{
                    $new_qty;
                }
            }elseif(isset($input['plus']) == false){
                $cart_item->qty--;
            }

        if($cart_item->save()){
            return true;
        }
        return false;
    }

    public function delete($input){
        if(UserCart::destroy($input)){
            return true;
        }
        return false;
    }
    public function deleteAllCartItems($user_id){
        $deleted = UserCart::where('user_id',$user_id)->delete();
        if($deleted){
            return true;
        }
        return false;
    }


    public function updateQtyToStock($cart_item){
        if($cart_item->product->product_stock == 0){
            return 1;
        }
        if($cart_item->product->product_stock < $cart_item->qty) {
            $cart_item->qty = $cart_item->product->product_stock;
            $cart_item->save();
        }
        return 0;
    }

    public function getCartProducts($user_cart_items){
        $data=array();
        foreach ($user_cart_items as $cart_item){
            $cart_items['product_id']=utf8_encode($cart_item->product_id);
            $cart_items['qty']=$cart_item->qty;
            $cart_items['purchase_price']=$cart_item->product->price;
            array_push($data,$cart_items);
        }

        return $data;
    }

    public function checkIfProductExists($user_id,$product_id){
        $check = UserCart::where('user_id',$user_id)->where('product_id',$product_id)->exists();
        return $check;
    }
}