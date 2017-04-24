<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'paypal' => [
        'client_id' => 'AdTrTPbRNjzwmookf7ENEneHASNPb0aaVxunMltW8hQUw8UAzL9AMsGouH1gIYsXr4wdNRPJgNkSO1Z3',
        'secret' => 'EIElAIzZEGg3v9QXApN_iRhx11H09GnPcmZOygFU3s9iHKYSa2GchPcPkWIbudRSPvBEyKxM4NO2gBms'
    ],

    'facebook' => [
        'client_id' => getenv('FACEBOOK_CLIENT_ID'),
        'client_secret' => getenv('FACEBOOK_SECRET'),
        'redirect' => 'http://localhost:8000/callback'
    ],

];
