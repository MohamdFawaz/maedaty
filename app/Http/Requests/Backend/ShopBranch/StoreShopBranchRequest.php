<?php

namespace App\Http\Requests\Backend\ShopBranch;

use App\Http\Requests\Backend\Request;

/**
 * Class ManageSettingsRequest.
 */
class StoreShopBranchRequest extends Request
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
            'shop_id'       => 'required',
            'address'       => 'required',
            'lat'       => 'required',
            'lng'       => 'required'
        ];
    }

    public function messages()
    {
        return [
           //
        ];
    }
}
