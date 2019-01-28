<?php

namespace App\Http\Requests\UserCart;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;
/**
 * Class ManageSettingsRequest.
 */
class UpdateCartRequest extends Request
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
            'cart_item_id' => 'required|exists:user_cart,id',
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
            'user_id.required' => trans('validation.user_id'),
            'qty.required' => trans('validation.qty'),
            'cart_item_id.required' => trans('validation.cart_item_id')
        ];
    }
}
