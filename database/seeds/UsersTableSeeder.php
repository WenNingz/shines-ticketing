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
            'description' => 'Full Access Control except Add Admin'
        ]);

        $attendee_role = Role::create([
            'name' => 'attendee',
            'display_name' => 'Attendee',
            'description' => ''
        ]);

        $super_admin = User::create([
            'first_name' => 'Super Admin',
            'email' => 'superadmin@shinesservices.com',
            'password' => bcrypt('super-secret'),
            'status' => 3
        ]);

        $super_admin->attachRole($super_admin_role);

        $admin = User::create([
            'first_name' => 'Admin 1',
            'email' => 'admin@shinesservices.com',
            'password' => bcrypt('secret'),
        ]);

        $admin->attachRole($admin_role);

        /* --- PERMISSION --- */
        $dashboard_index = Permission::create([
            'name' => 'dashboard-index',
            'display_name' => 'User Dashboard',
            'description' => 'View dashboard'
        ]);

        $dashboard_show = Permission::create([
            'name' => 'dashboard-show',
            'display_name' => 'Attendee Purchase Details',
            'description' => 'VIew purchase details'
        ]);

        $dashboard_view = Permission::create([
            'name' => 'dashboard-view',
            'display_name' => 'Attendee Ticket',
            'description' => 'Print ticket'
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

        $ticket_close = Permission::create([
            'name' => 'ticket-close',
            'display_name' => 'Close Ticket',
            'description' => 'Close resolved ticket'
        ]);

        $sync_index = Permission::create([
            'name' => 'sync-index',
            'display_name' => 'Sync Event Index',
            'description' => 'View events list'
        ]);

        $sync_show = Permission::create([
            'name' => 'sync-show',
            'display_name' => 'Event Edit View',
            'description' => 'View edit event page'
        ]);

        $sync_update = Permission::create([
            'name' => 'sync-update',
            'display_name' => 'Update Event',
            'description' => 'Update new event'
        ]);

        $event_index = Permission::create([
            'name' => 'event-index',
            'display_name' => 'Event Index',
            'description' => 'View events list'
        ]);

        $event_show = Permission::create([
            'name' => 'event-show',
            'display_name' => 'Show Event Details',
            'description' => 'View events details'
        ]);

        $paypal_payment = Permission::create([
            'name' => 'paypal-payment',
            'display_name' => 'PayPal Payment',
            'description' => 'Pay with paypal'
        ]);

        $payment_index = Permission::create([
            'name' => 'payment-index',
            'display_name' => 'Payment Index',
            'description' => 'View payment history'
        ]);

        $payment_show = Permission::create([
            'name' => 'payment-show',
            'display_name' => 'Payment Show',
            'description' => 'Show payment history details'
        ]);

        $social_index = Permission::create([
            'name' => 'social-index',
            'display_name' => 'Social Account Index',
            'description' => 'View linked social account'
        ]);

        $social_delete = Permission::create([
            'name' => 'social-delete',
            'display_name' => 'Delete Social Account',
            'description' => 'Remove linked social account'
        ]);

        $super_admin_role->attachPermissions(array(
            $dashboard_index, $user_admin_index,
            $user_admin_create, $user_admin_edit,
            $user_attendee_index, $user_attendee_edit,
            $profile_index, $profile_edit,
            $password_index, $password_edit,
            $queue_index, $ticket_index,
            $ticket_show, $ticket_store,
            $sync_index,  $sync_show,
            $sync_update, $event_index,
            $event_show, $payment_index,
            $payment_show
        ));

        $admin_role->attachPermissions(array(
            $dashboard_index, $user_attendee_index,
            $user_attendee_edit, $profile_index,
            $profile_edit, $password_index,
            $password_edit, $queue_index,
            $ticket_index, $ticket_show,
            $ticket_store, $sync_index,
            $sync_show, $sync_update,
            $event_index, $event_show,
            $payment_index, $payment_show
        ));

        $attendee_role->attachPermissions(array(
            $dashboard_index, $profile_index,
            $profile_edit, $password_index,
            $password_edit, $ticket_index,
            $ticket_create, $ticket_submit,
            $ticket_show, $ticket_store,
            $ticket_close, $paypal_payment,
            $payment_index, $payment_show,
            $dashboard_show, $dashboard_view,
            $social_index, $social_delete
        ));

    }
}

