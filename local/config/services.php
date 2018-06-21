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
        'redirect' =>'http://localhost:8000/site/login/facebook/callback'
    ],
    'google' => [
        'client_id' => '261991818437-fpmvjc88lkl4e4qmgfpjpp9dl3f6o513.apps.googleusercontent.com',        
        'client_secret' => 'Y7WV5v4aD_eH1UAFPecnLrDi', 
        'redirect' =>'http://localhost:8000/site/login/google/callback'
    ],

];
