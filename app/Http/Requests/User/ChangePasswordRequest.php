<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;


/**
 * Class ManageSettingsRequest.
 */
class ChangePasswordRequest extends Request
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
            'old_password'       => 'required_if:from,==,profile',
            'new_password'       => 'required',
            'from'       => 'required',
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
            'user_id.required' => trans('validation.user_id'),
            'old_password.required' => trans('validation.old_password'),
            'new_password.required' => trans('validation.new_password'),
        ];
    }
}
