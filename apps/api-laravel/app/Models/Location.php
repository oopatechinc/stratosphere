<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class Location extends Model
{
    use SoftDeletes;

    const TYPE_PHYSICAL = 'physical';
    const TYPE_ONLINE = 'online';

    protected $fillable = [
        'tenant_id',
        'website_template_id',
        'nickname',
        'type',
        'subdomain',
        'email',
        'phone',
        'x_account',
        'instagram_account',
        'facebook_account',
        'linkedin_account',
    ];

    const VALIDATION_RULES = [
        'tenant_id' => 'required|exists:tenants,id',
        'nickname' => 'required|string',
        'type' => 'required|string',
        'subdomain' => 'required|string',
        'email' => 'nullable|email',
        'phone' => 'nullable|string',
        'x_account' => 'nullable|string',
        'instagram_account' => 'nullable|string',
        'facebook_account' => 'nullable|string',
        'linkedin_account' => 'nullable|string',
        ...Address::VALIDATION_RULES,
        ...OpeningDay::ARRAY_VALIDATION_RULES,
        ...Service::ARRAY_VALIDATION_RULES,
        ...Staff::ARRAY_VALIDATION_RULES,
    ];

    /*
     * Relationships
     */

    public function staff(): BelongsToMany
    {
        return $this->belongsToMany(Staff::class)->withTimestamps();
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)
            ->withTimestamps()
            ->withPivot('id');
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function openingDays(): HasMany
    {
        return $this->hasMany(OpeningDay::class);
    }

    public function openingHourExceptions(): HasMany
    {
        return $this->hasMany(OpeningHourException::class);
    }

    public function website(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    }

    public function websiteContents(): HasMany
    {
        return $this->hasMany(WebsiteContent::class);
    }
}
