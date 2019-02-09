<?php

namespace App\Models\Order;

use App\Models\Address\Address;
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


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function address()
    {
        return $this->belongsTo(Address::class,'delivery_address_id');
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

    public function getOrderStatusLabelAttribute()
    {
        if($this->order_status == 0){
            return trans('status.order.unconfirmed_order');
        }else{
            return trans('status.order.missing_info');
        }
    }


    public function getActionAttribute()
    {
        $action = "";

        $action .= "<a href=".url()->current()."/".$this->id.">
                    <button type=\"button\" class=\"btn btn-success btn-condensed active\"> <i class='glyphicon glyphicon-eye-open' ></i></button>
                    </a>";
//        $action .= "<a href=".url()->current()."/".$this->id."/edit".">
//                    <button type=\"button\" class=\"btn btn-success btn-condensed active\"> <i class='glyphicon glyphicon-pencil' ></i></button>
//                    </a>";
//        $action .= '<a href="'.route('backend.order.destroy',$this->id).'"><button  class="btn btn-danger btn-condensed ">'.trans("backend.action.delete").'</button></a>';

        $action .= "";
        return $action;
    }

    public function getUsedPromoLabelAttribute()
    {
        if($this->used_promo == 1){
            return "<span class='label label-form label-success'>".trans('backend.action.yes')."</span>";
        }else{
            return "<span class='label label-form label-danger'>".trans('backend.action.no')."</span>";
        }
    }

    public function getUsedPointsLabelAttribute()
    {
        if($this->used_points == 1){
            return "<span class='label label-form label-success'>".trans('backend.action.yes')."</span>";
        }else{
            return "<span class='label label-form label-danger'>".trans('backend.action.no')."</span>";
        }
    }

    public function scopePerDay($query){

        $query->groupBy('created_at');
        return $query;

    }
}
