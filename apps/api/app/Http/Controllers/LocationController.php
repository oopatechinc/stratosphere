<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\LocationService;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class LocationController extends Controller
{
    public function __construct(protected LocationService $service)
    {
    }

    public function index(): Collection
    {
        return $this->service->index();
    }

    public function show(Location $location): Model
    {
        return $this->service->show($location);
    }

    public function showBySubdomain(string $subdomain): Model
    {
        return $this->service->showBySubdomain($subdomain);
    }

    public function store(StoreLocationRequest $request): Model
    {
        return $this->service->store($request->validated());
    }

    public function update(UpdateLocationRequest $request, Location $location): Model
    {
        return $this->service->update($location, $request->validated());
    }

    public function destroy(Location $location): void
    {
        $this->service->destroy($location);
    }
}
