<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\TenantService;
use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TenantController extends Controller
{
    public function __construct(protected TenantService $service)
    {
    }

    public function index(): Collection
    {
        return $this->service->index();
    }

    public function show(Tenant $tenant): Model
    {
        return $this->service->show($tenant);
    }

    public function store(StoreTenantRequest $request): Model
    {
        return $this->service->store($request->validated());
    }

    public function update(UpdateTenantRequest $request, Tenant $tenant): Model
    {
        return $this->service->update($tenant, $request->validated());
    }

    public function destroy(Tenant $tenant): void
    {
        $this->service->destroy($tenant->id);
    }
}
