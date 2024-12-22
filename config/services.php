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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

//  // V2 config:
//not used feel free to change or delete config
//     'google' => [
//     'recaptcha' => [
//         'site_key' => env('RECAPTCHA_SITE_KEY'),
//         'secret_key' => env('RECAPTCHA_SECRET_KEY'),
//         'version' => 'v2',
//         'size' => 'normal', // 'normal', 'compact' or 'invisible'.
//         'theme' => 'light', // 'light' or 'dark'.
//     ],
//     ],

    // 'recaptcha' => [
    //     'public_key' => env('RECAPCHA_SITEKEY'),
    //     'secret_key' => env('RECAPTCHA_SECRETKEY'),
    // ],

    'weather' => [
        'key' => env('WEATHER_API_KEY'),
    ],

];
