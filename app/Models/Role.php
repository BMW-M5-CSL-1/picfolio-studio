<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as BaseModel;

class Role extends BaseModel
{
    use HasFactory;

    protected $fillables = [
        'name',
        'slug',
        'guard_name',
    ];

    // public function userRoles() {
    //   return $this->hasMany(User::class);
    // }
}
