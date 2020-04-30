<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Preview Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where users will be redirected for preview auth.
    |
    */

    'path' => env('PREVIEW_PATH', 'preview'),

    /*
    |--------------------------------------------------------------------------
    | Preview Storage Driver
    |--------------------------------------------------------------------------
    |
    | This configuration options determines the storage driver that will
    | be used to store Preview data. In addition, you may set any
    | custom options as needed by the particular driver you choose.
    |
    */

    'driver' => env('PREVIEW_DRIVER', 'database'),

    'storage' => [
        'database' => [
            'connection' => env('DB_CONNECTION', 'mysql'),
            'chunk' => 1000,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preview Master Switch
    |--------------------------------------------------------------------------
    |
    | This option may be used to disable preview mode.
    |
    */

    'enabled' => env('PREVIEW_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | Preview Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to the preview route, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => [
        'web',
    ],

    'mailer' => env('PREVIEW_MAILER', 'smtp'),
];
