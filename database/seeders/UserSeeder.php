<?php

namespace Database\Seeders;

use App\Models\Formateur;
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

        $organisme_create = Permission::create(['name' => 'organisme.create']);

        $formateur_create = Permission::create(['name' => 'formateur.create']);
        $formateur_update = Permission::create(['name' => 'formateur.update']);

        $admin_role = Role::create(['name' => 'admin']);
        $super_admin_role = Role::create(['name' => 'super_admin']);
        $formateur_role = Role::create(['name' => 'formateur']);

        $admin = Role::create(['name' => 'admin']);
        $super_admin_role->givePermissionTo([
            $formateur_create,
            $formateur_update,
        ]);
        $admin->givePermissionTo([
            $formateur_create,
            $formateur_update,
        ]);


        $super_admin_role->givePermissionTo([
            $organisme_create,
        ]);
        $formateur_role->givePermissionTo([$organisme_create]);

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

        $user_role->givePermissionTo([
            $user_list,
        ]);
    }
}