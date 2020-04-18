<?php

return [

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
];
