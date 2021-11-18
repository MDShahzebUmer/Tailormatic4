<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'name' =>  'required|alpha',
            'landmark'    =>  'required',
            'address' =>    'required',
            'country_id' =>    'required',
            'state' =>    'required',
            'phone' =>   'required|min:10|max:10',
            'zipcode' =>  'required|min:6|max:6',
        ];
    }
    public function messages()
    {
        return [
           
            'name.required' => 'Field cannot be left blank.',
            'name.alpha' => 'Name field Only Letter.',
            'landmark.required' => 'Field cannot be left blank.',
            'country_id.required' => 'Select country Name.',
            'state.required' => 'Select State Name.',
            'address.required' => 'Field cannot be left blank.',
            'phone.required' => 'Field cannot be left blank.',
            'zipcode.required' => 'Field cannot be left blank.',
            'phone.min' => 'Mobile No Only 10 Digit.',
            'zipcode.min' => 'Zipcode No Only 6 Digit.',
            'zipcode.max' => 'Zipcode No Only 6 Digit.',
            'phone.max' => 'Mobile No Only 10 Digit.',
            
        ];
    }
}
