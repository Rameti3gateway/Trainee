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
    'facebook' => [
        'client_id' => '445249842605114',
        'client_secret' => '5f3ef4225d5b9b6869f803dc9dd6b5d7',
        'redirect' => 'http://localhost/site/login/facebook/callback'
    ],
    'google' => [
        'client_id' => '266891001278-r819pt5augk1u0mu6f47u3kg2ppnhnb2.apps.googleusercontent.com',
        'client_secret' => 'Benjwa2EO7hXftqnG2NPStQc',
        'redirect' => 'http://localhost/site/login/google/callback'
    ],
];
