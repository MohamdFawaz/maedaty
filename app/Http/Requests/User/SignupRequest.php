<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

/**
 * Class ManageSettingsRequest.
 */
class SignupRequest extends Request
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
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'location' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => trans('validation.phone'),
            'password.required' => trans('validation.password'),
            'first_name.required' => trans('validation.first_name'),
            'last_name.required' => trans('validation.last_name'),
            'email.required' => trans('validation.email'),
            'location.required' => trans('validation.location'),
            'lat.required' => trans('validation.lat'),
            'lng.required' => trans('validation.lng')
        ];
    }
}
