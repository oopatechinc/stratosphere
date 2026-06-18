<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Integration extends Model
{

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    const PLATFORM_ZOOM_NAME = 'Zoom';
    const PLATFORM_GOOGLE_CALENDAR_NAME = 'Google Calendar';
    const PLATFORM_GOOGLE_MEET_NAME = 'Google Meet';
    const PLATFORM_STRIPE_NAME = 'Stripe';

    const PLATFORM_TYPE_ZOOM = 'zoom';
    const PLATFORM_TYPE_GOOGLE_CALENDAR = 'google-calendar';
    const PLATFORM_TYPE_GOOGLE_MEET = 'google-meet';
    const PLATFORM_TYPE_STRIPE = 'stripe';

    const PLATFORM_TYPE_NAME_MAPPINGS = [
        self::PLATFORM_TYPE_ZOOM => self::PLATFORM_ZOOM_NAME,
        self::PLATFORM_TYPE_GOOGLE_CALENDAR => self::PLATFORM_GOOGLE_CALENDAR_NAME,
        self::PLATFORM_TYPE_GOOGLE_MEET => self::PLATFORM_GOOGLE_MEET_NAME,
        self::PLATFORM_TYPE_STRIPE => self::PLATFORM_STRIPE_NAME,
    ];

    const PLATFORM_TYPES_VIDEO_CONFERENCE_MAPPINGS = [
        self::PLATFORM_TYPE_ZOOM,
        self::PLATFORM_TYPE_GOOGLE_MEET
    ];

    const PLATFORM_TYPES_GOOGLE_MAPPINGS = [
        self::PLATFORM_TYPE_GOOGLE_CALENDAR,
        self::PLATFORM_TYPE_GOOGLE_MEET
    ];

    const PLATFORM_TYPES_GOOGLE_NAME_MAPPINGS = [
        self::PLATFORM_TYPE_GOOGLE_CALENDAR => self::PLATFORM_GOOGLE_CALENDAR_NAME,
        self::PLATFORM_TYPE_GOOGLE_MEET => self::PLATFORM_GOOGLE_MEET_NAME,
    ];

    protected $fillable = [
        'integrable_id',
        'integrable_type',
        'platform',
        'platform_pretty_name',
        'access_token',
        'refresh_token',
        'platform_account_id',
        'platform_user_id',
        'primary_resource_id',
        'status',
        'token_expires_in',
        'token_created_at',
    ];

    protected $hidden = [
        'access_token',
        'refresh_token',
        'token_expires_in',
        'token_created_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function resources(): HasMany
    {
        return $this->hasMany(IntegrationResource::class);
    }
}
