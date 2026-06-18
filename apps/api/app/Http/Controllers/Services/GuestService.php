<?php

namespace App\Http\Controllers\Services;

use App\Contracts\ServiceContract;
use App\Http\Controllers\FetchManagers\GuestFetchManager;
use App\Models\Guest;
use Illuminate\Database\Eloquent\Model;

class GuestService
{
    public function index()
    {
        return (new GuestFetchManager())->apply()->get();
    }

    public function store(array $payload): Model
    {
        return Guest::query()->create($payload);
    }
}
