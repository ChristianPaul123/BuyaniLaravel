<?php

//this returns the captcha configuration from the .env file
return [
    'secret' => env('RECAPTCHA_SECRETKEY'),
    'sitekey' => env('RECAPCHA_SITEKEY'),
    'options' => [
        'timeout' => 50,
    ],
];
