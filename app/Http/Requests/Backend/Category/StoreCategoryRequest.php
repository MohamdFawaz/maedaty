<?php

namespace App\Http\Requests\Backend\Category;

use App\Http\Requests\Backend\Request;
use Illuminate\Validation\Rule;
/**
 * Class ManageSettingsRequest.
 */
class StoreCategoryRequest extends Request
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
            'name_en' => 'required'
        ];
    }

    public function messages()
    {
        return [
           'name_ar.required' => trans('validation.name_ar'),
           'name_en.required' => trans('validation.name_en')
        ];
    }
}
