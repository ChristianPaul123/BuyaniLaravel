<?php

return [
    'secret' => env('RECAPTCHA_SECRETKEY'),
    'sitekey' => env('RECAPCHA_SITEKEY'),
    'options' => [
        'timeout' => 30,
    ],
];
