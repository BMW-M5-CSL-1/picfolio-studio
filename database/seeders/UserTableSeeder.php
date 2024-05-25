<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            [
                'name' => 'Umer Dar',
                'email' => 'umer@example.com',
                'password' => Hash::make('password')
            ], [
                'name' => 'Hamza Ali',
                'email' => 'hamza@example.com',
                'password' => Hash::make('password')
            ], [
                'name' => 'User',
                'email' => 'user@example.com',
                'password' => Hash::make('password')
            ], 
        ];

        foreach ($users as $user) {
            $check = User::where('email', $user['email'])->first();
            if (!isset($check)) {
                User::create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                ]);
            }
        }

        // Assigning Roles Statically to users
        $user = User::find(2);
        $role = Role::find(2);
        $user->assignRole($role['id']);

        $printer = User::find(3);
        $role = Role::find(3);
        $printer->assignRole($role['id']);
    }
}
