<?php

namespace App\Http\Requests\Address;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;
/**
 * Class ManageSettingsRequest.
 */
class StoreAddressRequest extends Request
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
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'user_id' => 'required|exists:users,id',
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
            'product_id' =>trans('validation.product_id'),
            'user_id' =>trans('validation.user_id')
        ];
    }
}
