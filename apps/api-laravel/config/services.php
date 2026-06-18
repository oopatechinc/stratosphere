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

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'aws' => [
        'access_key' => env('AWS_ACCESS_KEY_ID'),
        'secret_access_key' => env('AWS_SECRET_ACCESS_KEY'),
        'default_region' => env('AWS_DEFAULT_REGION'),
        'bucket' => env('AWS_BUCKET'),
        'private_bucket' => env('AWS_PRIVATE_BUCKET'),
        'public_bucket' => env('AWS_PUBLIC_BUCKET'),
        'private_filesystem_disk' => env('AWS_PRIVATE_FILESYSTEM_DISK'),
        'url' => env('AWS_URL'),
        'bucket_url' => env('AWS_BUCKET_URL'),
        'private_bucket_url' => env('AWS_PRIVATE_BUCKET_URL'),
        'public_bucket_url' => env('AWS_PUBLIC_BUCKET_URL'),
        'site_hosted_zone_id' => env('AWS_SITE_HOSTED_ZONE_ID')
    ],

    'stripe' => [
        'secret_key' => env('STRIPE_SECRET_KEY'),
        'trial_period_days' => env('STRIPE_TRIAL_PERIOD_DAYS'),
        'redirect_uri'  => env('STRIPE_REDIRECT_URI'),
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('FACEBOOK_REDIRECT_URI')
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI'),
        'admin' => [
            'app_name' => env('GOOGLE_ADMIN_APP_NAME'),
            'client_id' => env('GOOGLE_ADMIN_CLIENT_ID'),
            'client_secret' => env('GOOGLE_ADMIN_CLIENT_SECRET'),
            'redirect' => env('GOOGLE_ADMIN_REDIRECT_URL')
        ]
    ],

    'zoom' => [
        'client_id'     => env('ZOOM_CLIENT_ID'),
        'client_secret' => env('ZOOM_CLIENT_SECRET'),
        'redirect_uri'  => env('ZOOM_REDIRECT_URI'),
        'base_uri'      => env('ZOOM_BASE_URI'),
        'webhook_secret' => env('ZOOM_WEBHOOK_SECRET')
    ],

    'twilio' => [
        'sid' => env('TWILIO_SID'),
        'token' => env('TWILIO_TOKEN'),
        'phone_number' => env('TWILIO_PHONE_NUMBER')
    ]

];
