<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\StaffService;
use App\Http\Requests\GetTimesStaffRequest;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\SyncServicesStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function __construct(protected StaffService $service)
    {
    }

    public function index(): Collection
    {
        return $this->service->index();
    }

    public function store(StoreStaffRequest $request): Model
    {
        return $this->service->store($request->validated());
    }

    public function update(UpdateStaffRequest $request, Staff $staff): Model
    {
        return $this->service->update($staff, $request->validated());
    }

    public function destroy(Staff $staff): void
    {
        $this->service->destroy($staff->id);
    }

    public function syncServices(SyncServicesStaffRequest $request, Staff $staff): Model
    {
        return $this->service->syncServices($staff, $request->validated('services'));
    }

    public function getTimes(GetTimesStaffRequest $request, Staff $staff): array
    {
        return $this->service->getTimes($staff, $request->validated());
    }
}
