<?php

namespace App\Repositories\Order;

use App\Models\Order\Order;
use App\Models\UserApplyPromo\UserApplyPromo;
use App\Repositories\BaseRepository;
use App\Repositories\UserApplyPromo\UserApplyPromoRepository;
use Carbon\Carbon;

/**
* Class NotificationRepository.
 *
 *
*/
class OrderRepository extends BaseRepository
{

/**
* related model of this repositery.
*
* @var object
*/
    public $model;



    public function __construct(Order $model)
    {
        $this->model = $model;
    }


    public function create($user_id  , $cart){
        $order_number = rand(100000,999999);
        $input['order_number'] = $order_number;
        $input['products'] = $cart;
        $input['user_id'] = $user_id;
        if($order = Order::create($input)){
            return $order->id;
        }
        return false;
    }

    public function update($input){
        $hasPromo = $this->ifOrderHasPromoCode($input['order_id']);
        if($hasPromo){
            $new_price = $this->getDiscount($input['order_id'],$hasPromo->promo_code);
        }
        $order = Order::whereId($input['order_id'])->first();
        $order->order_time = $input['order_time'];
        $order->order_date = $input['order_date'];
        $order->payment_method = $input['payment_method'];
        $order->delivery_address_id = $input['delivery_address_id'];
        $order->subtotal_fees = $new_price['new_subtotal'];
        $order->order_status = 1;
        if($order->save()){
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
     public function getOrderByID($order_id){
          return Order::whereId($order_id)->first();
    }


    public function ifOrderHasPromoCode($order_id){
        $checkCode = UserApplyPromo::with('promo_code')->where('order_id',$order_id)->first();
        return $checkCode;
    }

    public function getDiscount($order_id,$promo_code){
        $order = $this->getOrderByID($order_id);
        if($promo_code->discount_type == 'fixed'){
            $order->subtotal_fees = $order->subtotal_fees - $promo_code->discount_amount;
        }elseif($promo_code->disount_type =='percentage'){
            $order->subtotal_fees = $order->subtotal_fees * (100*$promo_code->discount_amount);
        }
        if($order->subtotal_fees < 0){
            $order->subtotal_fees = 0;
        }
        return [
            'total_fees' => ($order->subtotal_fees + $order->shipping_fees),
            'new_subtotal' => $order->subtotal_fees
            ];
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

    public function getAllOrdersList($orders)
    {
        $orders_list = [];
        $order_item = [];
        foreach ($orders as $order){
            $order_item['id'] = $order->id;
            $order_item['order_number'] = $order->order_number;
            $order_item['order_date'] = $order->order_date;
            $order_item['total_fees'] = $order->total_fees;
            $order_item['order_status'] = $order->order_status;
            $orders_list[] = $order_item;
        }
        return $orders_list;
    }

    public function getOrderProducts($order_products)
    {
            $product_list = [];
            $product_item = [];
            foreach ($order_products as $order_product) {
                $product_item['qty'] = $order_product['qty'];
                $product_item['purchase_price'] = (double)$order_product['purchase_price'];
                $product_item['product'] = $this->productRepository->getProductById($order_product['product_id']);
                $product_list[] = $product_item;
            }
            return $product_list;
    }
}