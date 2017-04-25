<?php

/* --- Guest --- */
Route::get('/signup', 'SignUpController@index');

Route::post('/signup', 'SignUpController@submit');

Route::get('/signup/verify/{email_token}', 'SignUpController@confirm');

Route::get('/login', 'SessionController@index');

Route::post('/login', 'SessionController@submit');

Route::get('/logout', 'SessionController@destroy');

Route::get('/reset-password', 'SessionController@getReset');

Route::post('/reset-password', 'SessionController@postReset');

Route::get('/reset-password/verify/{email_token}', 'SessionController@confirmReset');

/* --- Errors --- */
Route::get('error-email-token', 'ErrorController@errorEmailToken');

/* --- Users - Common --- */
Route::get('/dashboard', 'DashboardController@index');

Route::get('/manage-attendee', 'User\AttendeeController@index');

Route::put('/suspend-user', 'User\AttendeeController@edit');

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

Route::get('/payment-history', 'Payment\PaymentController@index');

Route::get('/payment-details/{id}', 'Payment\PaymentController@show');

/* --- Super-Admin --- */
Route::get('/manage-admin', 'User\AdminController@index');

Route::get('/add-admin', 'User\AdminController@create');

Route::post('/add-admin', 'User\AdminController@submit');

Route::put('/suspend', 'User\AdminController@edit');

Route::get('/sync-events', 'Event\SyncController@index');

Route::get('/edit-event/{id}', 'Event\SyncController@show');

Route::post('/edit-event/{id}', 'Event\SyncController@update');

Route::post('/image', 'ImageController@store');

Route::get('event-list', 'Event\EventController@index');

Route::get('event-details/{id}', 'Event\EventController@show');

/* --- Admin --- */
Route::get('/setup', 'SetupController@index');

Route::post('/setup', 'SetupController@submit');

/* --- Attendee --- */
Route::get('/new-ticket', 'Support\TicketController@create');

Route::post('/new-ticket', 'Support\TicketController@submit');

Route::get('/purchase-details/{id}', 'DashboardController@show');

Route::get('/print-ticket/{id}', 'DashboardController@view');

Route::get('/linked-accounts', 'Account\SocialAuthController@index');

Route::post('/delete', 'Account\SocialAuthController@delete');

/* --- Web --- */
Route::get('/', 'Website\WebController@index');

Route::get('/browse-events', 'Website\WebController@browse');

Route::get('/view-event/{id}', 'Website\WebController@show');

Route::post('/buy-tickets/{id}', array('as' => 'payment', 'uses' => 'PaypalController@postPayment',));

Route::get('payment/status', array('as' => 'payment.status', 'uses' => 'PaypalController@getPaymentStatus',));

Route::get('/about-us', 'Website\WebController@about');

Route::get('/privacy-policy', 'Website\WebController@privacyPolicy');

Route::get('/terms-of-service', 'Website\WebController@termsOfService');

Route::get('/support', 'Website\WebController@support');

Route::get('/support-search', 'Website\WebController@supportSearch');

Route::get('/support-article', 'Website\WebController@supportArticle');

Route::get('/new-request', 'Website\WebController@supportContact');

/* --- Social --- */
Route::get('/redirect/{provider}', 'Account\SocialAuthController@redirect');

Route::get('/{provider}/callback', 'Account\SocialAuthController@callback');

Route::get('test', function () {

    $super_admin = App\Role::where('name', 'super-admin')->first();
    $admin = App\Role::where('name', 'admin')->first();
    $attendee = App\Role::where('name', 'attendee')->first();

//    $permission = App\Permission::where('name', 'event-create')->first();
//    $permission = App\Permission::create([
//        'name' => 'social-delete',
//        'display_name' => 'Delete Social Account',
//        'description' => 'Remove linked social account'
//    ]);
//    $super_admin->attachPermission($permission);
//    $admin->attachPermission($permission);
//    $attendee->attachPermission($permission);

//    $lul = new \Intervention\Image\ImageManager();
//    $lul->make('https://s-media-cache-ak0.pinimg.com/originals/5d/71/39/5d7139a3e90dd2b88e94e4a51e900164.jpg')->fit(300, 200)->save('storage/lul.jpg');
//    \App\Event::create([
//        'name' => 'BYOC Collaborative Coding Challenge',
//        'date' => '2017-04-26 18:00:00',
//        'venue' => 'Politeknik Negeri Batam, Batam Center, Jl. Ahmad Yani Tlk. Tering',
//        'status' => 2,
//        'ext_id' => 1
//    ]);
//    \App\Ticket::create([
//        'name' => 'Early Bird',
//        'event_id' => 1,
//        'total' => 40,
//        'available' => 40,
//        'ext_id' => 1,
//    ]);
//
//    \App\Ticket::create([
//        'name' => 'Regular',
//        'event_id' => 1,
//        'total' => 30,
//        'price' => 10.00,
//        'available' => 30,
//        'ext_id' => 1,
//    ]);
//
});