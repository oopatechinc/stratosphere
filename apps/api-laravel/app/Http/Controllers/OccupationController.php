<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\OccupationService;
use App\Http\Requests\StoreOccupationRequest;
use App\Http\Requests\UpdateOccupationRequest;
use App\Models\Occupation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OccupationController extends Controller
{
    public function __construct(protected OccupationService $service)
    {
    }

    public function index(): Collection
    {
        return $this->service->index();
    }

    public function show(Occupation $occupation): Model
    {
        return $occupation;
    }

    public function store(StoreOccupationRequest $request): Model
    {
        return $this->service->store($request->validated());
    }

    public function update(UpdateOccupationRequest $request, Occupation $occupation): Model
    {
        return $this->service->update($occupation, $request->validated());
    }

    public function destroy(Occupation $occupation): void
    {
        $this->service->destroy($occupation);
    }
}
