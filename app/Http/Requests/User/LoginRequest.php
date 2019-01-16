<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

/**
 * Class ManageSettingsRequest.
 */
class LoginRequest extends Request
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
            'phone'       => 'required',
            'password'       => 'required',
            'firebase_token'       => 'required'
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => trans('validation.phone'),
            'password.required' => trans('validation.password'),
            'firebase_token.required' => trans('validation.firebase_token'),
            'lang.required' => trans('validation.lang')
        ];
    }
}
