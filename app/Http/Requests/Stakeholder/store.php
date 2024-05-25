<?php

namespace App\Http\Requests\Stakeholder;

use Illuminate\Foundation\Http\FormRequest;

class store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'fullName' => 'required|string|max:255',
            'fatherName' => 'required|string|max:255',
            'cnic' => 'required|numeric|max_digits:14|unique:users,cnic',
            'dob' => 'required|date',
            'gender' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'contact' => 'required|numeric|max_digits:10',
            'country' => 'required|string',
            'state' => 'required|string',
            'address' => 'required|string',
            'role' => 'required|array',
        ];
        return $rules;
    }

    public function messages()
    {
        $rulesMessage = [
            'fullName.required' => 'The Full Name field is required.',
            'fatherName.required' => 'The Father Name field is required.',
            'cnic.required' => 'The CNIC field is required.',
            'cnic.unique' => 'The CNIC has already been taken.',
            'cnic.max_digits' => 'The CNIC should not be more than 14 digits.',
            'contact.required' => 'The Contact Number field is required.',
            'contact.max_digits' => 'The Contact Number should not be more than 10 digits.',
            'dob.required' => 'The Date of Birth field is required.',
            'gender.required' => 'The Gender field is required.',
            'email.required' => 'The Email field is required.',
            'email.unique' => 'The Email has already been taken.',
            'country.required' => 'The Country field is required.',
            'state.required' => 'The State field is required.',
            'address.required' => 'The Address field is required.',
            'role.required' => 'The Role field is required.',
        ];
        return $rulesMessage;
    }
}
