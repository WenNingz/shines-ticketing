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
            'description' => 'View admins list'
        ]);

        $user_admin_create = Permission::create([
            'name' => 'user-admin-create',
            'display_name' => 'Add Admin',
            'description' => 'Add a new admin'
        ]);

        $user_admin_edit = Permission::create([
            'name' => 'user-admin-edit',
            'display_name' => 'Edit Status',
            'description' => 'Activate or suspend an admin'
        ]);

        $user_attendee_index = Permission::create([
            'name' => 'user-attendee-index',
            'display_name' => 'Attendee List',
            'description' => 'View attendees list'
        ]);

        $user_attendee_edit = Permission::create([
            'name' => 'user-attendee-edit',
            'display_name' => 'Edit Status',
            'description' => 'Activate or suspend an attendee'
        ]);

        $profile_index = Permission::create([
            'name' => 'profile-index',
            'display_name' => 'View Profile',
            'description' => 'View profile'
        ]);

        $profile_edit = Permission::create([
            'name' => 'profile-edit',
            'display_name' => 'Edit Profile',
            'description' => 'Edit profile'
        ]);

        $password_index = Permission::create([
            'name' => 'password-index',
            'display_name' => 'Password View',
            'description' => 'View change password page'
        ]);

        $password_edit = Permission::create([
            'name' => 'password-edit',
            'display_name' => 'Edit Password',
            'description' => 'Change password'
        ]);

        $queue_index = Permission::create([
            'name' => 'queue-index',
            'display_name' => 'New Tickets List',
            'description' => 'View all new requested ticket'
        ]);

        $ticket_index = Permission::create([
            'name' => 'ticket-index',
            'display_name' => 'Users Ticket List',
            'description' => 'View all requested ticket'
        ]);

        $ticket_create = Permission::create([
            'name' => 'ticket-create',
            'display_name' => 'Create Ticket',
            'description' => 'Create a new ticket'
        ]);

        $ticket_submit = Permission::create([
            'name' => 'ticket-submit',
            'display_name' => 'Submit Ticket',
            'description' => 'Submit new ticket'
        ]);

        $ticket_show = Permission::create([
            'name' => 'ticket-show',
            'display_name' => 'Ticket Detail',
            'description' => 'View created ticket details'
        ]);

        $ticket_store = Permission::create([
            'name' => 'ticket-store',
            'display_name' => 'Reply Ticket',
            'description' => 'Reply support request'
        ]);

        $super_admin_role->attachPermissions(array(
            $dashboard_index, $user_admin_index,
            $user_admin_create, $user_admin_edit,
            $user_attendee_index, $user_attendee_edit,
            $profile_index, $profile_edit,
            $password_index, $password_edit,
            $queue_index, $ticket_index,
            $ticket_show, $ticket_store
        ));

        $admin_role->attachPermissions(array(
            $dashboard_index, $user_attendee_index,
            $user_attendee_edit, $profile_index,
            $profile_edit, $password_index,
            $password_edit, $queue_index,
            $ticket_index, $ticket_show,
            $ticket_store
        ));

        $attendee_role->attachPermissions(array(
            $dashboard_index, $profile_index,
            $profile_edit, $password_index,
            $password_edit, $ticket_index,
            $ticket_create, $ticket_submit,
            $ticket_show, $ticket_store
        ));

    }
}

