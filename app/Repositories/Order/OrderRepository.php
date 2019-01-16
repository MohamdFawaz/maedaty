<?php

namespace App\Repositories\Order;

use App\Models\Order\Order;
use App\Repositories\BaseRepository;
use App\Repositories\Product\ProductRepository;
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
    public $productRepository;



    public function __construct(Order $model, ProductRepository $productRepository)
    {
        $this->model = $model;
        $this->productRepository = $productRepository;
    }


    public function create($input, $cart){
        $order_number = rand(100000,999999);
        $input['order_number'] = $order_number;
        $input['products'] = $cart;
        if(Order::create($input)){
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
            $product_item['purchase_price'] = $order_product['purchase_price'];
            $product_item['product'] = $this->productRepository->getProductById($order_product['product_id']);
            $product_list[] = $product_item;
        }


        return $product_list;
    }
}