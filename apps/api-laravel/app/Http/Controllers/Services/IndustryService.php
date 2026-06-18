<?php

namespace App\Http\Controllers\Services;

use App\Contracts\ServiceContract;
use App\Http\Controllers\FetchManagers\IndustriesFetchManager;
use App\Models\Industry;
use Illuminate\Database\Eloquent\Model;

class IndustryService implements ServiceContract
{
    public function index()
    {
        return (new IndustriesFetchManager())->apply()->get();
    }

    public function store(array $payload): Model
    {
        return Industry::query()->create($payload);
    }

    public function update($id, array $payload): Model
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}
