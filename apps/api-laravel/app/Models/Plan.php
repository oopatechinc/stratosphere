<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    const SOLO_PLAN   = 'solo';
    const TEAMS_PLAN = 'teams';
    const ENTERPRISE_PLAN = 'enterprise';

    protected $guarded = [];

    public function prices()
    {
        return $this->hasMany(PlanPrice::class);
    }
}
