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
        'client_id' => '120789161852828',
        'client_secret' => 'd55ec0c543b49cc168b02cb160e4f0d6',
        'redirect' => 'http://blog.dev/login/facebook/callback',
    ],
    
    'twitter' => [
        'client_id' => '3BNPBYR663jaCjhZXQE7yth8t',
        'client_secret' => 'pEjEjcbhBZ8LoQGpXnBwrBfM1hnrFvgZAPd5tY1Qvn58DnH9FH',
        'redirect' => 'http://blog.dev/login/twitter/callback',
    ],
    
     'google' => [
        'client_id' => '823265601944-4b8n182rd2a2s7turpjgv1mmko4l67pv.apps.googleusercontent.com',
        'client_secret' => 'nAk1-TTA1RXm801Tz3Z_ctG5',
        'redirect' => 'http://blog.dev/login/google/callback',
    ],
];
