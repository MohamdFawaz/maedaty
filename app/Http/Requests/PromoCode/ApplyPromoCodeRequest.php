<?php

namespace App\Http\Requests\PromoCode;

use App\Http\Requests\Request;

/**
 * Class ManageSettingsRequest.
 */
class ApplyPromoCodeRequest extends Request
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
            'promo_code' => 'required',
            'order_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'promo_code.required' => trans('validation.promo_code'),
            'order_id.required' => trans('validation.order_id'),

        ];
    }
}
