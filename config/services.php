<?php

return [
    'ses'    => [
        'key'    => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'twilio' => [
        'sid'   => env('TWILIO_SID'),
        'token' => env('TWILIO_AUTH_TOKEN'),
        'from'  => env('TWILIO_PHONE_NUMBER'),
    ],

    'stripe' => [
        'secret' => env('STRIPE_SECRET'),
        'key'    => env('STRIPE_KEY'),
    ],
];
