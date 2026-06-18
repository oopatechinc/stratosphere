<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpeningHour extends Model
{
    protected $fillable = [
        'opening_day_id',
        'opening_hour_able_id',
        'opening_hour_able_type',
        'opens_at',
        'closes_at',
    ];
}
