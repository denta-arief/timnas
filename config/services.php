<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
<<<<<<< HEAD
    'redirect' => env('GOOGLE_REDIRECT_URI'),
],

'telegram' => [
    'client_id' => env('TELEGRAM_BOT_TOKEN2'),
    'client_secret' => env('TELEGRAM_BOT_SECRET'),
    'redirect' => env('TELEGRAM_REDIRECT_URI'),
    'bot_token' => env('TELEGRAM_BOT_TOKEN2'),
],


=======
    'redirect' => env('GOOGLE_REDIRECT'),
    ],

    'telegram' => [
    'callback_url' => env('TELEGRAM_WEBHOOK_URL'),
],

>>>>>>> 59d3e6f2d953766e051eacb53911e5e1b6335155
];
