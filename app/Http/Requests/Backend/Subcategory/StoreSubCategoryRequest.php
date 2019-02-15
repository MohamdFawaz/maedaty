<?php

namespace App\Http\Requests\Backend\Subcategory;

use App\Http\Requests\Backend\Request;
use Illuminate\Validation\Rule;
/**
 * Class ManageSettingsRequest.
 */
class StoreSubCategoryRequest extends Request
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
            'name_ar' => 'required',
            'name_en' => 'required',
            'category_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
           'name_ar.required' => trans('validation.name_ar'),
           'name_en.required' => trans('validation.name_en'),
           'category_id.required' => trans('validation.category_id')
        ];
    }
}
