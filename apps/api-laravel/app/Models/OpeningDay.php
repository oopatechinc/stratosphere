<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OpeningDay extends Model
{
    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $fillable = [
        'location_id',
        'day_of_week',
        'is_active'
    ];

    const ARRAY_VALIDATION_RULES = [
        'opening_days' => 'required|array',
        'opening_days.*.location_id' => 'required|exclude_if:opening_days.*.location_id,-1|integer|exists:locations,id',
        'opening_days.*.day_of_week' => 'required|integer|between:0,6',
        'opening_days.*.is_active' => 'required|boolean:',
        'opening_days.*.opening_hours' => 'required|array',
        'opening_days.*.opening_hours.*.opens_at' => 'required|string',
        'opening_days.*.opening_hours.*.closes_at' => 'required|string',
    ];

    public function openingHours(): HasMany
    {
        return $this->hasMany(OpeningHour::class);
    }
}
