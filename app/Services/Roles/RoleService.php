<?php

namespace App\Services\Roles;

use App\Models\Role;
use App\Services\Roles\RoleInterface;

class RoleService implements RoleInterface
{
  public function model()
  {
    return new Role();
  }

  public function store($inputs)
  {
    // dd($inputs);

    $recordData = (new Role())->create([
      'name' => $inputs['role_name'],
      'slug' => $inputs['slug_name'],
      'guard_name' => $inputs['guard_name'],
    ]);

    return redirect()->route('roles.index')->withSuccess(__('lang.commons.data_saved'));
    // return getTreeData(collect($roles), $this->model());
  }
}
