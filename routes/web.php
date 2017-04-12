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

Route::get('/ticket-list', 'Support\QueueController@index');

Route::get('/my-tickets', 'Support\TicketController@index')->name('my-tickets');

Route::get('/solved-tickets', 'Support\TicketController@index')->name('solved-tickets');

Route::get('/ticket-details/{ticket_number}', 'Support\TicketController@show');

Route::post('/ticket-details/{ticket_number}', 'Support\TicketController@store');

Route::get('/my-tickets/{ticket_number}/close', 'Support\TicketController@close');

    /* --- Super-Admin --- */
Route::get('/manage-admin', 'User\AdminController@index');

Route::get('/add-admin', 'User\AdminController@create');

Route::post('/add-admin', 'User\AdminController@submit');

Route::put('/suspend', 'User\AdminController@edit');

Route::get('/sync-events', 'Event\SyncController@index');

Route::get('/edit-event/{id}', 'Event\SyncController@show');

Route::post('/edit-event/{id}', 'Event\SyncController@update');

Route::get('event-list', 'Event\EventController@index');

Route::get('event-details/{id}', 'Event\EventController@show');

    /* --- Admin --- */
Route::get('/setup', 'SetupController@index');

Route::post('/setup', 'SetupController@submit');

    /* --- Attendee --- */
Route::get('/new-ticket', 'Support\TicketController@create');

Route::post('/new-ticket', 'Support\TicketController@submit');

/* --- Web --- */
Route::get('/', 'Website\WebController@index');

Route::get('/browse-events', 'Website\WebController@browse');

Route::get('/view-event/{id}', 'Website\WebController@show');

Route::post('/buy-tickets/{id}', 'Website\WebController@checkout');


Route::get('home', function () {
    return view('guest.home');
});

Route::get('events', function () {
    return view('guest.event');
});


/* --- Support Section --- */


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


Route::get('admin-event-detail', function () {
    return view('admin.event-detail');
});

Route::get('admin-event-edit', function () {
    return view('admin.event-edit');
});


Route::get('admin-profile', function () {
    return view('admin.profile');
});

Route::get('admin-password', function () {
    return view('admin.password');
});

Route::get('403', function () {
    return view('errors.403');
});

Route::get('404', function () {
    return view('errors.404');
});

Route::get('500', function () {
    return view('errors.500');
});

Route::get('test', function (){

   /* $super_admin = App\Role::where('name', 'super-admin')->first();
    $admin = App\Role::where('name', 'admin')->first();
    $attendee = App\Role::where('name', 'attendee')->first();

//    $permission = App\Permission::where('name', 'event-create')->first();
    $permission = App\Permission::create([
        'name' => 'event-show',
        'display_name' => 'Show Event Details',
        'description' => 'View events details'
    ]);
    $super_admin->attachPermission($permission);
    $admin->attachPermission($permission);
//    $attendee->attachPermission($permission);*/
    return view('guest.payments');
//   $lul = new \Intervention\Image\ImageManager();
//   $lul->make('https://s-media-cache-ak0.pinimg.com/originals/5d/71/39/5d7139a3e90dd2b88e94e4a51e900164.jpg')->fit(300,200)->save('storage/lul.jpg');
});