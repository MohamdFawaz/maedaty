<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;
/**
 * Class ManageSettingsRequest.
 */
class StoreOrderRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $jwt_token = $this->input('jwt_token');
        $user_id = $this->input('user_id');

        return [
            'user_id' => 'required|exists:users,id',
            'order_id' => 'required|exists:orders,id,order_status,0',
            'delivery_address_id' => 'required',
            'jwt_token' => [
                'required',
                Rule::exists('users')->where(function ($query) use ($user_id,$jwt_token) {
                    $query->where('id', $user_id);
                    $query->where('jwt_token', $jwt_token);
                })
            ],
        ];
    }

    public function messages()
    {
        return [
            'jwt_token.required' => trans('validation.jwt'),
            'product_id.required' =>trans('validation.product_id'),
            'user_id.required' =>trans('validation.user_id'),
            'order_id.exists' =>trans('validation.order_already_completed')

        ];
    }

   
}
