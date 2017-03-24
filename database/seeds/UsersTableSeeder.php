<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run() {
        $super_admin_role = Role::create([
            'name' => 'super-admin',
            'display_name' => 'Super Admin',
            'description' => 'Full Access Control'
        ]);

        $admin_role = Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => ''
        ]);

        $attendee_role = Role::create([
            'name' => 'attendee',
            'display_name' => 'Attendee',
            'description' => ''
        ]);

        $super_admin = User::create([
            'first_name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('super-secret'),
        ]);

        $super_admin->attachRole($super_admin_role);

        $admin = User::create([
            'first_name' => 'Admin 1',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        $admin->attachRole($admin_role);


        /* --- PERMISSION --- */
        $dashboard_index = Permission::create([
            'name' => 'dashboard-index',
            'display_name' => 'User Dashboard',
            'description' => 'View user dashboard'
        ]);

        $user_admin_index = Permission::create([
            'name' => 'user-admin-index',
            'display_name' => 'Admin List',
            'description' => 'View admin list'
        ]);

        $user_admin_create = Permission::create([
            'name' => 'user-admin-create',
            'display_name' => 'Add Admin',
            'description' => 'Add a new admin'
        ]);

        $user_admin_confirm = Permission::create([
            'name' => 'user-admin-confirm',
            'display_name' => 'Verify Email',
            'description' => 'Add a new admin'
        ]);

        $user_admin_edit = Permission::create([
            'name' => 'user-admin-edit',
            'display_name' => 'Edit Status',
            'description' => 'Activate or suspend an admin'
        ]);

        $super_admin_role->attachPermissions(array(
            $dashboard_index,
            $user_admin_index,
            $user_admin_create,
            $user_admin_edit

        ));

        $admin_role->attachPermissions(array(
            $dashboard_index
        ));

        $attendee_role->attachPermissions(array(
            $dashboard_index
        ));

    }
}

