<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConatctRequest extends FormRequest
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
            'con_subject' =>  'required',
            'con_name'    =>  'required|string',
            'con_email' =>    'required|email',
            'con_mobile' =>   'required|min:10|max:10',
            'con_country_code' =>   'required',
            'con_message' =>  'required|max:255',
        ];
    }
    public function messages()
    {
        return [
            'con_subject.required' => 'Field cannot be left blank.',
            'con_name.required' => 'Field cannot be left blank.',
            'con_name.alpha' => 'Name field Only Letter.',
            'con_email.required' => 'Field cannot be left blank.',
            'con_email.email' => 'Field email Not Correct.',
            'con_mobile.required' => 'Field cannot be left blank.',
            'con_mobile.min' => 'Mobile No Only 10 Digit.',
            'con_mobile.max' => 'Mobile No Only 10 Digit.',
            'con_message.required' => 'Field cannot be left blank.'
        ];
    }
}
