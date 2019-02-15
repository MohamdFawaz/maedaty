<?php

namespace App\Http\Requests\Category;

use App\Http\Requests\Request;

/**
 * Class ManageSettingsRequest.
 */
class ListCategoryRequest extends Request
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
//            'jwt_token'       => 'required',
        ];
    }

    public function messages()
    {
        return [
            'jwt_token.required' => trans('validation.jwt')
        ];
    }
}
