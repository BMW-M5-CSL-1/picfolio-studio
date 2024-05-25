<?php

namespace App\Http\Requests\Locations;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function rules()
  {
    $rules = [
      'name' => 'required|string|max:255|unique:locations,name',
      'house' => 'required',
      'shop' => 'required',
      'school' => 'required',
      'park' => 'required',
    ];
    return $rules;
  }

  public function messages()
  {
    $rulesMessage = [
      'name.required' => 'The Name field is required.',
      'name.unique' => 'The Name has already been taken.',
      'house.required' => 'The House field is required.',
      'shop.required' => 'The Shops field is required.',
      'school.required' => 'The Educational Institutes field is required.',
      'park.required' => 'The Parks field is required.',
    ];

    return $rulesMessage;
  }
}
