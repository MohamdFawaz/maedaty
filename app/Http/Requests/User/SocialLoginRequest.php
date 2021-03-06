<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

/**
 * Class ManageSettingsRequest.
 */
class SocialLoginRequest extends Request
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
        return [
            'provider'       => 'required',
            'auth_id'       => 'required',
            'username'       => 'required',
            'email'       => 'required',
            'profile_picture'       => 'required',
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => trans('validation.phone'),
            'password.required' => trans('validation.password')
        ];
    }
}
