<?php

namespace App\Http\Requests\Favorite;

use App\Http\Requests\Request;

/**
 * Class ManageSettingsRequest.
 */
class StoreFavoriteRequest extends Request
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
            'jwt_token' => 'required',
            'product_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'jwt_token.required' => trans('validation.jwt'),
            'product_id' =>trans('validation.product_id')
        ];
    }
}
