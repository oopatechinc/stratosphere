<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\ServiceVariationService;
use App\Http\Requests\StoreServiceVariationRequest;
use App\Http\Requests\UpdateServiceVariationRequest;
use App\Models\ServiceVariation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ServiceVariationController extends Controller
{
    public function __construct(protected ServiceVariationService $service)
    {
    }

    public function store(StoreServiceVariationRequest $request): Collection
    {
        return $this->service->store($request->validated('variations'));
    }

    public function update(UpdateServiceVariationRequest $request, ServiceVariation $serviceVariation): Model
    {
        return $this->service->update($serviceVariation, $request->validated());
    }

    public function destroy(ServiceVariation $service): void
    {
        $this->service->destroy($service->id);
    }
}
