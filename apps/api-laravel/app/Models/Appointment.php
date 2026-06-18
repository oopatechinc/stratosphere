<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    protected $fillable = [
        'location_id',
        'staff_id',
        'customer_timezone_id',
        'customerable_id',
        'customerable_type',
        'date',
        'start_time',
        'end_time',
        'status',
        'booking_fee',
        'tip',
        'service_total',
        'tax',
        'total'
    ];

    const STATUS_PENDING = 'pending';

    const VALIDATION_RULES = [
        'id' => 'exclude_if:id,-1|integer|exists:appointments,id',
        'location_id' => 'required|integer|exists:locations,id',
        'staff_id' => 'required|integer|exists:staff,id',
        'customer_timezone_id' => 'required|integer|exists:timezones,id',
        'customerable_id' => 'required|integer',
        'customerable_type' => 'required|string',
        'date' => 'required|date',
        'start_time' => 'required|string',
        'end_time' => 'required|string',
        'status' => 'nullable|string',
        'booking_fee' => 'nullable|string',
        'tip' => 'nullable|string',
        'service_total' => 'nullable|string',
        'tax' => 'nullable|string',
        'total' => 'nullable|string',
        'service_variations' => 'required|array',
    ];

    /**
     * Relationships
     */
    public function serviceVariations(): BelongsToMany
    {
        return $this->belongsToMany(ServiceVariation::class)->withTimestamps();
    }
}
