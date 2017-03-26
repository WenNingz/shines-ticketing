<?php

/* --- Guest --- */
Route::get('/signup', 'SignUpController@index');

Route::post('/signup', 'SignUpController@submit');

Route::get('/signup/verify/{email_token}', 'SignUpController@confirm');

Route::get('/login', 'SessionController@index');

Route::post('/login', 'SessionController@submit');

Route::get('/logout', 'SessionController@destroy');

/* --- Errors --- */
Route::get('error-email-token', 'ErrorController@errorEmailToken');

/* --- Users - Common --- */
Route::get('/dashboard', 'DashboardController@index');

Route::get('/manage-attendee', 'User\AttendeeController@index');

Route::put('/suspend', 'User\AttendeeController@edit');

Route::get('/profile', 'Account\ProfileController@index');

Route::post('/profile', 'Account\ProfileController@edit');

Route::get('/change-password', 'Account\PasswordController@index');

Route::post('/change-password', 'Account\PasswordController@edit');

    /* --- Super-Admin --- */
Route::get('/manage-admin', 'User\AdminController@index');

Route::get('/add-admin', 'User\AdminController@create');

Route::post('/add-admin', 'User\AdminController@submit');

Route::put('/suspend', 'User\AdminController@edit');


    /* --- Admin --- */
Route::get('/setup', 'SetupController@index');

Route::post('/setup', 'SetupController@submit');








Route::get('home', function () {
    return view('guest.home');
});

Route::get('events', function () {
    return view('guest.event');
});

Route::get('event-detail', function () {
    return view('guest.event-detail');
});


/* --- Attendee --- */

Route::get('event-details', function () {
    return view('attendee.event-detail');
});

/* --- Support Section --- */
Route::get('support', function () {
    return view('attendee.support');
});

Route::get('support-new-ticket', function () {
    return view('attendee.support-new-ticket');
});

Route::get('support-ticket', function () {
    return view('attendee.support-ticket');
});

/* --- Account Information Section --- */

Route::get('linked-account', function () {
    return view('attendee.linked-account');
});

Route::get('payments', function () {
    return view('attendee.payments');
});

/* --- Admin --- */
Route::get('admin-dashboard', function () {
    return view('admin.dashboard');
});

Route::get('event-list', function () {
    return view('admin.event-list');
});

Route::get('admin-event-detail', function () {
    return view('admin.event-detail');
});

Route::get('admin-event-edit', function () {
    return view('admin.event-edit');
});

Route::get('sync-event', function () {
    return view('admin.sync-event');
});


Route::get('ticket-list', function () {
    return view('admin.support-list');
});

Route::get('ticket-details', function () {
    return view('admin.support-ticket-details');
});

Route::get('my-ticket', function () {
    return view('admin.support-ticket');
});

Route::get('admin-profile', function () {
    return view('admin.profile');
});

Route::get('admin-password', function () {
    return view('admin.password');
});

Route::get('admin-payments', function () {
    return view('admin.payments');
});

Route::get('test', function (){

    $super_admin = App\Role::where('name', 'super-admin')->first();
    $admin = App\Role::where('name', 'admin')->first();
    $attendee = App\Role::where('name', 'attendee')->first();

    $password_edit = App\Permission::create([
        'name' => 'password-edit',
        'display_name' => 'Edit Password',
        'description' => 'Change password'
    ]);

    $super_admin->attachPermission($password_edit);
    $admin->attachPermission($password_edit);
    $attendee->attachPermission($password_edit);
});