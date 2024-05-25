<?php

namespace App\Http\Requests\PaperType;

use Illuminate\Foundation\Http\FormRequest;

class PaperTypeRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:paper_types,name',
            'paper_guage' => 'required|string',
            'side' => 'required|string|max:255',
            'price' => 'required|string',
            'type' => 'required',
        ];
        return $rules;
    }

    public function messages()
    {
        $rulesMessage = [
            'name.required' => 'The Name Name field is required.',
            'name.unique' => 'The Name Name has already been taken.',
            'guage.required' => 'The Paper Guage field is required.',
            'side.required' => 'The Paper Side field is required.',
            'price.required' => 'The Price field is required.',
            'type.required' => 'The Paper For field is required.',
        ];

        return $rulesMessage;
    }
}
