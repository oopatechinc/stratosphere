<?php

namespace App\Models;


use App\Traits\HasCalendarEvent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;


class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasFactory, HasCalendarEvent, SoftDeletes, HasDatabase, HasDomains;

    /** Status */
    const STATUS_ACTIVE    = 'active';

    protected $fillable = [
        'vertical_id',
        'language_id',
        'name',
    ];

    protected $appends = [
        'remaining_trial_period_days',
    ];

    public function remainingTrialPeriodDays(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => ceil(
                abs(config('bookisia.trial_period_days') - $this->created_at->diffInDays(Carbon::now()))
            )
        );
    }

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'vertical_id',
            'language_id',
            'name',
            'description',
            'business_number',
            'status',
            'logo_path',
            'created_at',
            'updated_at',
        ];
    }

    /*
     * Relationships
     */

    public function staff(): HasMany
    {
        return $this->hasMany(Staff::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }

    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class);
    }

    public function plugins(): BelongsToMany
    {
        return $this->belongsToMany(Plugin::class)->withTimestamps();
    }

    public function vertical(): BelongsTo
    {
        return $this->belongsTo(Vertical::class);
    }
}
