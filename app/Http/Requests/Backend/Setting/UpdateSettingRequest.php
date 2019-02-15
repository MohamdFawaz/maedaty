<?php

namespace App\Http\Requests\Backend\Setting;

use App\Http\Requests\Backend\Request;
use Illuminate\Validation\Rule;
/**
 * Class ManageSettingsRequest.
 */
class UpdateSettingRequest extends Request
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
            'terms_and_conditions_ar' => 'required',
            'terms_and_conditions_en' => 'required',
            'about_us_en' => 'required',
            'about_us_ar' => 'required',
            'sms_username' => 'required',
            'sms_password' => 'required',
            'sms_message' => 'required',
            'sms_sender' => 'required',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}
