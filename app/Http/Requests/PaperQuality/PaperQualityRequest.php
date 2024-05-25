<?php

namespace App\Http\Requests\PaperQuality;

use Illuminate\Foundation\Http\FormRequest;

class PaperQualityRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function rules()
  {
    $rules = [
      'name' => 'required|string|max:255|unique:paper_qualities,name',
      'slug' => 'required|string|max:255|unique:paper_qualities,slug',
    ];
    return $rules;
  }

  public function messages()
  {
    $rulesMessage = [
      'name.required' => 'The Name field is required.',
      'name.unique' => 'The Name has already been taken.',
      'slug.required' => 'The Slug field is required.',
      'slug.unique' => 'The Slug has already been taken.',
    ];

    return $rulesMessage;
  }
}
