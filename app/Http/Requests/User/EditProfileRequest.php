<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;


/**
 * Class ManageSettingsRequest.
 */
class EditProfileRequest extends Request
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
            'user_id'       => 'required|exists:users,id',
            'first_name'       => 'required',
            'last_name'       => 'required',
            'phone'       => 'required',
            'email'       => 'required|email',
            'location'       => 'required',
            'lat'       => 'required',
            'lng'       => 'required',
            'jwt_token' => [
                    'required',
                    Rule::exists('users')->where(function ($query) use ($user_id,$jwt_token) {
                        $query->where('id', $user_id);
                        $query->where('jwt_token', $jwt_token);
                })
            ]
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => trans('validation.phone'),
            'user_id.required' => trans('validation.user_id'),
            'first_name.required' => trans('validation.first_name'),
            'last_name.required' => trans('validation.last_name'),
            'email.required' => trans('validation.email'),
        ];
    }
}
