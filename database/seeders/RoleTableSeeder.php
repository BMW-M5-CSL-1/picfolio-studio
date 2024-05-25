<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'super_admin',
                'guard_name' => 'web'
            ], [
                'name' => 'User',
                'slug' => 'user',
                'guard_name' => 'web'
            ], [
                'name' => 'Photographer',
                'slug' => 'photographer',
                'guard_name' => 'web'
            ], 
        ];

        foreach ($roles as $role) {
            $check = Role::where('name', $role['name'])->first();
            if (!isset($check)) {
                Role::create([
                    'name' => $role['name'],
                    'slug' => $role['slug'],
                    'guard_name' => $role['guard_name'],
                ]);
            }
        }
    }
}
