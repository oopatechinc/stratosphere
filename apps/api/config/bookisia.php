<?php

return [
    'trial_period_days' => 30,
    'active_countries_iso' => [
        \App\Models\Country::ISO_CANADA_CA,
        \App\Models\Country::ISO_UNITED_STATES_US
    ],
    'site_domain' => env('APP_SITE_DOMAIN'),
    'admin_url' => env('APP_ADMIN_URL'),
    'plans' => [
        'solo' => 2999, //$29.99
        'teams' => 1999, //$19.99/seat
    ],
];
