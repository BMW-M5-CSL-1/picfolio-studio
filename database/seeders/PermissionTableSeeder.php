<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'name' => 'dashboard',
                'guard_name' => 'web',
                'show_name' => 'Can View Dashboard',
                'title' => 'Dashboard'
            ],
            // Roles
            [
                'name' => 'roles.index',
                'guard_name' => 'web',
                'show_name' => 'Can View Roles',
                'title' => 'Roles',
            ],
            [
                'name' => 'roles.create',
                'guard_name' => 'web',
                'show_name' => 'Can Create Roles',
                'title' => 'Roles',
            ],
            [
                'name' => 'roles.edit',
                'guard_name' => 'web',
                'show_name' => 'Can Edit Roles',
                'title' => 'Roles',
            ],
            [
                'name' => 'roles.update',
                'guard_name' => 'web',
                'show_name' => 'Can Update Roles',
                'title' => 'Roles',
            ],
            [
                'name' => 'roles.store',
                'guard_name' => 'web',
                'show_name' => 'Can Save Roles',
                'title' => 'Roles',
            ],
            [
                'name' => 'roles.destroy',
                'guard_name' => 'web',
                'show_name' => 'Can Delete Roles',
                'title' => 'Roles',
            ],
            // Permissions
            [
                'name' => 'permissions.index',
                'guard_name' => 'web',
                'show_name' => 'Can View Permissions',
                'title' => 'Permissions'
            ],
            [
                'name' => 'permissions.assign-permission',
                'guard_name' => 'web',
                'show_name' => 'Can Assign Permissions',
                'title' => 'Permissions'
            ],
            [
                'name' => 'permissions.revoke-permission',
                'guard_name' => 'web',
                'show_name' => 'Can Revoke Permissions',
                'title' => 'Permissions'
            ],
            // User Management
            [
                'name' => 'stakeholders.index',
                'guard_name' => 'web',
                'show_name' => 'Can View Stakeholders',
                'title' => 'Stakeholders',
            ],
            [
                'name' => 'stakeholders.store',
                'guard_name' => 'web',
                'show_name' => 'Can Store Stakeholders',
                'title' => 'Stakeholders',
            ],
            [
                'name' => 'stakeholders.update',
                'guard_name' => 'web',
                'show_name' => 'Can Update Stakeholders',
                'title' => 'Stakeholders',
            ],
            [
                'name' => 'stakeholders.destroy',
                'guard_name' => 'web',
                'show_name' => 'Can Delete Stakeholders',
                'title' => 'Stakeholders',
            ],
            // Profile
            [
                'name' => 'profile.index',
                'guard_name' => 'web',
                'show_name' => 'Can View Profile',
                'title' => 'Profile',
            ],
            [
                'name' => 'profile.edit',
                'guard_name' => 'web',
                'show_name' => 'Can Edit Profile',
                'title' => 'Profile',
            ],
            [
                'name' => 'profile.update',
                'guard_name' => 'web',
                'show_name' => 'Can Update Profile',
                'title' => 'Profile',
            ],
            [
                'name' => 'profile.portfolio.delete',
                'guard_name' => 'web',
                'show_name' => 'Can Delete Portfolio',
                'title' => 'Profile',
            ],

            // Event
            [
                'name' => 'event.index',
                'guard_name' => 'web',
                'show_name' => 'Can View Events',
                'title' => 'Event',
            ],
            [
                'name' => 'event.create',
                'guard_name' => 'web',
                'show_name' => 'Can Create Events',
                'title' => 'Event',
            ],
            [
                'name' => 'event.store',
                'guard_name' => 'web',
                'show_name' => 'Can Store Event',
                'title' => 'Event',
            ],
            [
                'name' => 'event.edit',
                'guard_name' => 'web',
                'show_name' => 'Can Edit Event',
                'title' => 'Event',
            ],
            [
                'name' => 'event.update',
                'guard_name' => 'web',
                'show_name' => 'Can Update Event',
                'title' => 'Event',
            ],
            [
                'name' => 'event.delete',
                'guard_name' => 'web',
                'show_name' => 'Can Delete Event',
                'title' => 'Event',
            ],
        ];

        foreach ($data as $permission) {
            // $permission_exist = Permission::where('name', $permission['name'])->first();
            // if (!isset($permission_exist)) {
            Permission::updateOrCreate([
                'name' => $permission['name'],
                'guard_name' => $permission['guard_name'],
            ], [
                'show_name' => $permission['show_name'],
                'title' => $permission['title'],
            ]);
            // }
        }

        // (new Role())->find(1)->givePermissionTo((new Permission())->pluck('id'));
        // dd(Permission::pluck('id'));

        $admin = User::find(1);
        $role = Role::find(1);
        $admin->assignRole($role['id']);
        $role->givePermissionTo(Permission::pluck('id'));

        // $admin_permissions = Role::find(1)->givePermissionTo(Permission::pluck('id'));
        // foreach ($users as $user) {
        //     $user->givePermissionTo('dashboard');
        // }
        // $users[0]->givePermissionTo('profile.edit');
        // dd($users[4]->assignRole('admin'));
        // $admin = User::where('id', 1)->get();
        // dd($admin[0]->assignRole('admin'));
        // dd($admin_permissions);
    }
}
