<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;
use App\Models\Product\Product;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number',
        'user_id',
        'subtotal_fees',
        'shipping_fees',
        'products',
        'delivery_address_id',
        'payment_method',
        'order_date',
        'order_time',
        'order_status'
    ];

    protected $casts = [
        'products' => 'array'
    ];

    public function getTotalFeesAttribute()
    {
        $total = $this->subtotal_fees + $this->shipping_fees;
        return $total.config('settings.currency_symbol');
    }

    public function getOrderStatusAttribute($value)
    {
        switch ($value){
            case 0:
                return trans('status.order.unconfirmed_order');
            break;
            case 1:
                return trans('status.order.new_order');
            break;
            case 2:
                return trans('status.order.processing');
            break;
            default:
                return trans('status.order.missing_info');
        }
    }
}
