<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\ServiceService;
use App\Http\Requests\ToggleCategoryServiceRequest;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ServiceController extends Controller
{
    public function __construct(protected ServiceService $service)
    {
    }

    public function index(): Collection
    {
        return $this->service->index();
    }

    public function store(StoreServiceRequest $request): Model
    {
        return $this->service->store($request->validated());
    }

    public function update(UpdateServiceRequest $request, Service $service): Model
    {
        return $this->service->update($service, $request->validated());
    }

    public function destroy(Service $service): void
    {
        $this->service->destroy($service->id);
    }

    public function toggleCategories(ToggleCategoryServiceRequest $request, Service $service): Model
    {
        return $this->service->toggleCategories($service, $request->validated('categories'));
    }
}
