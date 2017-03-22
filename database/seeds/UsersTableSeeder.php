<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
//        $super_admin_role = new Role();
//        $super_admin_role->name = 'super-admin';
//        $super_admin_role->display_name = 'Super Admin';
//        $super_admin_role->description = 'Full Access';
//        $super_admin_role->save();
//
//        $admin_role = new Role();
//        $admin_role->name = 'admin';
//        $admin_role->display_name = 'Admin';
//        $admin_role->description = '';
//        $admin_role->save();
//
//        $attendee_role = new Role();
//        $attendee_role->name = 'attendee';
//        $attendee_role->display_name = 'Attendee';
//        $attendee_role->description = '';
//        $attendee_role->save();

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
            'first_name' => 'super-admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('super-secret'),
            'verified' => 1
        ]);
        $super_admin->attachRole($super_admin_role);

        $admin = User::create([
            'first_name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret'),
            'verified' => 1
        ]);
        $admin->attachRole($admin_role);


        /* --- SUPER ADMIN --- */
        $super_dashboard_index = Permission::create([
            'name' => 'super-dashboard-index',
            'display_name' => 'Super Admin Dashboard',
            'description' => 'Show Super Admin dashboard'
        ]);

        $super_admin_role->attachPermissions(array(
            $super_dashboard_index

        ));

        /* --- ADMIN --- */
        $admin_dashboard_index = Permission::create([
            'name' => 'admin-dashboard-index',
            'display_name' => 'Admin Dashboard',
            'description' => 'Show Admin dashboard'
        ]);

        $admin_role->attachPermissions(array(
            $admin_dashboard_index
        ));

        /* --- ATTENDEE --- */
        $attendee_dashboard_index = Permission::create([
            'name' => 'attendee-dashboard-index',
            'display_name' => 'Attendee Dashboard',
            'description' => 'Show Attendee dashboard'
        ]);

        $attendee_role->attachPermissions(array(
            $attendee_dashboard_index
        ));
    }
}

//create-store-show-update-destroy-edit