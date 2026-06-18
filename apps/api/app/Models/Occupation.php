<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    protected $guarded = [];
    const ARRAY_VALIDATION_RULES = [
        'occupations' => 'required|array',
        'occupations.*.id' => 'required|exists:occupations,id',
        'occupations.*.tenant_id' => 'required|exists:tenants,id',
        'occupations.*.title' => 'required|string',
        'occupations.*.is_active' => 'required|boolean',
    ];
}
