<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\FetchManagers\CountriesFetchManager;

class CountryService
{
    public function index()
    {
        return (new CountriesFetchManager())->apply()->get();
    }
}
