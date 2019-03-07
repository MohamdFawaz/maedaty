<?php

namespace App\Models\PromoCode;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromoCode extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'discount_type',
        'discount_amount',
        'valid_times',
        'valid_from',
        'valid_to',
        'status'
    ];

    public function getValidFromAttribute($value)
    {
        return Carbon::parse($value)->toDateString();
    }

    public function getValidToAttribute($value)
    {
        return Carbon::parse($value)->toDateString();
    }

    public function getDiscountTypeAttribute($value)
    {
        return trans('backend.promo.'.$value);
    }

    public function getActionAttribute()
    {
        $action = "";

        $action .= '<a href="#" class="mb-control delete-promo-btn" data-id="'.$this->id.'"><button  class="btn btn-danger btn-condensed ">'.trans("backend.action.delete").'</button></a>';

        $action .= "";
        return $action;
    }
    public function getStatusLabelAttribute()
    {
        $action = "";
        if ($this->status == 1) {
            $action .=  "<label class='switch switch-small' >
                    <input title=".trans('backend.action.show_in_app')." type='checkbox' checked='' value='$this->status'  id='$this->id' class='status'>
                    <span></span>
                    </label>";
        } else {
            $action .=  "<label class='switch switch-small'>
                    <input title=".trans('backend.action.show_in_app')." type='checkbox'  value='$this->status' id='$this->id' class='status'>
                    <span></span>
                    </label>";
        }
        return $action;
    }
}
