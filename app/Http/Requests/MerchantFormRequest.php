<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MerchantFormRequest extends FormRequest
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

        $request = app()->make('request');

        return [
            
             'name' => 'required',
             'merchant_id' => 'required',
             'website' => 'required',
             'email' => 'required|unique:merchants,email,'.$request->id,

        ];
    }

    public function messages()
    {
        return [
            'mobile_no.required' => 'The mobile number is required.',
            'phone_no.required' => 'The phone number is required.'
        ];
    }
}
