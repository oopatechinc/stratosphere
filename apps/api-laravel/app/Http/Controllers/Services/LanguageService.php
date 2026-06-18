<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\FetchManagers\LanguagesFetchManager;
use Illuminate\Database\Eloquent\Collection;

class LanguageService
{
    public function index(): Collection
    {
        return (new LanguagesFetchManager())->apply()->get();
    }
}
