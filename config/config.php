<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'database' => [
        'connection' => env('DB_AMAZON_ATTRIBUTION_API_CONNECTION'),
    ],

    'clientId' => env('AMAZON_ADVERTISING_API_CLIENTID'),
    'clientSecret' => env('AMAZON_ADVERTISING_API_CLIENTSECRET'),
];
