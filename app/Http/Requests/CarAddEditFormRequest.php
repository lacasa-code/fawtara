<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarAddEditFormRequest extends FormRequest
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
              
            'manufacturing' => 'required',            
            'registration' => 'required',            
            'manufacturing_date' => 'required',            
            'chassis' => 'required|min:17|max:17',            
            'model' => 'required',            
            'kilometers' => 'required',
            'customer_id',    
            'reg_chars'=>'required'        

        ];
    }


    public function messages()
    {
        return [
            
            'manufacturing.required' => trans('manufacturing field is required.'),
            'registration.required' => trans('registration field is required.'),
            'manufacturing_date.required' => trans('app.manufacturing_date field is required.'),
            'chassis.required' => trans('app.chassis field is required.'),
            'model.required' => trans('app.model field is required.'),
            'kilometers.required' => trans('app.kilometers field is required.'),
            'chassis.min' => trans('chassis number must be 17 digits.'),
            'chassis.max' => trans('chassis number must be 17 digits.'),

        ];

    }
    
}
