<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderCancelsRequest extends FormRequest
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
              'reason' => 'required',
              'id' => 'required',
              'decs_reason' => 'required',
        ];
    }
    public function messages()
    {
        return [
           
            'reason.required' => 'Reason field is required.',
            'id.required' => '',
            'decs_reason.required' => 'Reason Comment field is required.',
           
        ];
    }
}
