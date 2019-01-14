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
            if($input['qty'] == 0){
                $update = $cart_item->delete();
            }else{
                if($input['qty'] > $cart_item->product->product_stock){
                    return false;
                }
                $cart_item->qty = $input['qty'];
                $update = $cart_item->save();
            }
        if($update){
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
}