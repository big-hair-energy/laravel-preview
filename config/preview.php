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

    'mail' => [
        'default' => env('PREVIEW_MAIL_MAILER', 'smtp'),
        'mailers' => [
            'smtp' => [
                'transport' => 'smtp',
                'host' => env('PREVIEW_MAIL_HOST', 'smtp.mailgun.org'),
                'port' => env('PREVIEW_MAIL_PORT', 587),
                'encryption' => env('PREVIEW_MAIL_ENCRYPTION', 'tls'),
                'username' => env('PREVIEW_MAIL_USERNAME'),
                'password' => env('PREVIEW_MAIL_PASSWORD'),
                'timeout' => null,
            ],

            'ses' => [
                'transport' => 'ses',
            ],

            'mailgun' => [
                'transport' => 'mailgun',
            ],

            'postmark' => [
                'transport' => 'postmark',
            ],

            'sendmail' => [
                'transport' => 'sendmail',
                'path' => '/usr/sbin/sendmail -bs',
            ],

            'log' => [
                'transport' => 'log',
                'channel' => env('MAIL_LOG_CHANNEL'),
            ],

            'array' => [
                'transport' => 'array',
            ],
        ],
        'from' => [
            'address' => env('PREVIEW_MAIL_FROM_ADDRESS', 'hello@example.com'),
            'name' => env('PREVIEW_MAIL_FROM_NAME', 'Example'),
        ],
    ],
];
