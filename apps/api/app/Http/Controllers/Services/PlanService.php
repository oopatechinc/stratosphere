<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\FetchManagers\PlanFetchManager;

class PlanService
{
    public function index()
    {
        return (new PlanFetchManager())->apply()->get();
    }
}
