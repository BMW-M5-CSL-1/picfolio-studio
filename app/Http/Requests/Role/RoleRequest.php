<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
  public function rules()
  {
    $rules = [
      'role_name' => 'required|string|max:255|unique:roles,name',
      'slug_name' => 'required|string|max:255|unique:roles,slug',
      'guard_name' => 'required|string|between:1,254',
    ];

    return $rules;
  }

  public function messages()
  {
    $rulesMessage = [
      'role_name.required' => 'The Role Name field is required.',
      'role_name.unique' => 'The Role Name has already been taken.',
      'slug_name.required' => 'The Slug Name field is required.',
      'slug_name.unique' => 'The Slug Name has already been taken.',
    ];

    return $rulesMessage;
  }
}
