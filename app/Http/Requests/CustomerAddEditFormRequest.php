<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerAddEditFormRequest extends FormRequest
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
            'name' => 'required|regex:/^[(a-zA-Z\s)\p{L}]+$/u|max:50',
            'mail' => 'required|email|unique:users,mail,'.$this->id,
            'phone' => 'required|min:9|max:14|regex:/^[- +()]*[0-9][- +()0-9]*$/',
            'address' => 'required',            
        ];
    }


    public function messages()
    {
        return [
            'name.required' => trans('app.customer name is required.'),
            'name.regex'  => trans('app.customer name is only alphabets and space.'),
            'name.max' => trans('app.customer name should not more than 50 character.'),

    
            'mail.required' => trans('app.Email is required.'),
            'mail.email'  => trans('app.Please enter a valid email address. Like : sales@dasinfomedia.com'),
            'mail.unique' => trans('app.Email you entered is already registered.'),

            'phone.required' => trans('app.Contact number is required.'),
            'phone.min' => trans('app.Contact number minimum 9 digits.'),
            'phone.max' => trans('app.Contact number maximum 14 digits.'),
            'phone.regex' => trans('app.Contact number must be number, plus, minus and space only.'),

            'address.required'  => trans('app.Address field is required.'),            
        ];

    }
    
}
