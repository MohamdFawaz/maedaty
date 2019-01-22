<?php

namespace App\Http\Requests\UserPoint;

use App\Http\Requests\Request;

/**
 * Class ManageSettingsRequest.
 */
class RedeemUserPointRequest extends Request
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
            'redeem' => 'required|exists:[1,0]',
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
            'redeem.exists' => trans('validation.exists'),

        ];
    }
}
