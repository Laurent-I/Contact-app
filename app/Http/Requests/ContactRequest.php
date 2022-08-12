<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' =>'required',
            'last_name' =>'required',
            'email' =>'required|email',
            'address' =>'required',
            'company_id' =>'required|exists:companies,id'
        ];
    }

    public function attributes()
    {
        return [
            'company_id' => 'company',
            'email' => 'email address'
        ];

    }

    public function messages()
    {
        return [
          'email.email' => 'The email you entered is invalid',
            '*.required'=> 'Please enter your :attribute'
        ];
    }
}
