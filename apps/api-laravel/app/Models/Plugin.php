<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plugin extends Model
{
    // plugins are plugins that enhance user experience like integrations
    const PLUGIN_BOOKING_CALENDAR = 'PLUGIN_BOOKING_CALENDAR';
    const PLUGIN_INTEGRATIONS_GOOGLE_CALENDAR = 'PLUGIN_INTEGRATIONS_GOOGLE_CALENDAR';
    const PLUGIN_INTEGRATIONS_STRIPE = 'PLUGIN_INTEGRATIONS_STRIPE';

    CONST PLUGINS = [
        self::PLUGIN_BOOKING_CALENDAR,
        self::PLUGIN_INTEGRATIONS_GOOGLE_CALENDAR,
        self::PLUGIN_INTEGRATIONS_STRIPE,
    ];
}
