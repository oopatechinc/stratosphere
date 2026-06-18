<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\FetchManagers\TimezonesFetchManager;
use Illuminate\Database\Eloquent\Collection;

class TimezoneService
{
    public function index(): Collection
    {
        return (new TimezonesFetchManager())->apply()->get();
    }
}
