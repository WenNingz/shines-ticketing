<?php

/* --- Guest --- */
Route::get('home', function () {
    return view('guest.home');
});

Route::get('events', function () {
    return view('guest.event');
});

Route::get('event-detail', function () {
    return view('guest.event-detail');
});

Route::get('signup', function () {
    return view('guest.signup');
});

Route::get('login', function () {
    return view('guest.login');
});

/* --- Attendee --- */
Route::get('dashboard', function () {
    return view('attendee.dashboard');
});

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
Route::get('profile', function () {
    return view('attendee.profile');
});

Route::get('password', function () {
    return view('attendee.password');
});

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

Route::get('manage-users', function () {
    return view('admin.manage-users');
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