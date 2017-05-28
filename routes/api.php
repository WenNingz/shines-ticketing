<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('webhook', 'APIController@webhook');

Route::get('/approved/{payment_id}', 'APIController@approved');

Route::get('/declined/{payment_id}', 'APIController@declined');

Route::get('/used/{payment_id}/{number}', 'APIController@used');