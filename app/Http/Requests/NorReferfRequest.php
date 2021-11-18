<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NorReferfRequest extends FormRequest
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
            'name'     =>  'required',
            'fname'     =>  'required',
            'femail'     =>  'required',
            'email'    =>  'required|email',
            'phone'    =>  'required|min:10|max:10',
            'message'  =>  'required|max:255',
        ];
    }
    public function refermesg()
    {
        return [
           
            'name.required'    => 'Field cannot be left blank.',
            'fname.required'    => 'Field cannot be left blank.',
            'name.alpha'       => 'Name field Only Letter.',
            'fname.alpha'       => 'Name field Only Letter.',
            'email.required'   => 'Field cannot be left blank.',
            'femail.required'   => 'Field cannot be left blank.',
            'email.email'      => 'Field email Not Correct.',
            'femail.email'      => 'Field email Not Correct.',
            'phone.required'   => 'Field cannot be left blank.',
            'phone.min'        => 'Mobile No Only 10 Digit.',
            'phone.max'        => 'Mobile No Only 10 Digit.',
            'message.required' => 'Field cannot be left blank.'
        ];
    }
}
