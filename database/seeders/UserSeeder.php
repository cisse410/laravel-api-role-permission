<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_list = Permission::create(['name' => 'users.list']);
        $user_view = Permission::create(['name' => 'users.view']);
        $user_create = Permission::create(['name' => 'users.create']);
        $user_update = Permission::create(['name' => 'users.update']);
        $user_delete = Permission::create(['name' => 'users.delete']);

        $admin_role = Role::create(['name' => 'admin']);

        $admin_role->givePermissionTo([
            $user_list,
            $user_view,
            $user_create,
            $user_update,
            $user_delete,
        ]);

        $admin = User::create([
            'name' => 'Mouhamedoune FALL',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
        ]);

        $admin->assignRole($admin_role);

        $admin->givePermissionTo([
            $user_list,
            $user_view,
            $user_create,
            $user_update,
            $user_delete,
        ]);

        $user_role = Role::create(['name' => 'user']);

        $user = User::create([
            'name' => 'Mouhamedoune',
            'email' => 'user@user.com',
            'password' => Hash::make('user123'),
        ]);

        $user->assignRole($user_role);

        $user->givePermissionTo([
            $user_list,
        ]);
    }
}