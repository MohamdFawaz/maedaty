<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;

class ShopBranches extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['shop_id','address','lat','lng'];

    public function shop()
    {
        return $this->belongsTo(Shop::class , 'shop_id');
    }
    public function getActionAttribute()
    {
        $action = "";
        $action .= "<a href=".route('backend.shop_branch.show',$this->id).">
                    <button type=\"button\" class=\"btn btn-success btn-condensed active\"> <i class='glyphicon glyphicon-eye-open' ></i></button>
                    </a>";
        $action .= "<a href=".route('backend.shop_branch.edit',$this->id).">
                    <button type=\"button\" class=\"btn btn-success btn-condensed active\"> <i class='glyphicon glyphicon-pencil' ></i></button>
                    </a>";
        $action .= '<a href="#" class="mb-control delete-branch-btn" data-name="'.$this->address.'" data-id="'.$this->id.'"><button  class="btn btn-danger btn-condensed ">'.trans("backend.action.delete").'</button></a>';

        return $action;
    }

}
