<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\IntegrationService;
use App\Http\Requests\GetOauthUrlIntegrationRequest;
use App\Http\Requests\StoreIntegrationRequest;
use App\Http\Requests\UpdateIntegrationRequest;
use App\Models\Integration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class IntegrationController extends Controller
{
    public function __construct(protected IntegrationService $service)
    {
    }

    public function index(Request $request)
    {
        return $this->service->index();
    }

    public function store(StoreIntegrationRequest $request): Model|Collection
    {
        return $this->service->store($request->validated());
    }

    public function update(UpdateIntegrationRequest $request, Integration $integration): Model
    {
        return $this->service->update($integration, $request->validated());
    }

    /**
     * @throws \Exception
     */
    public function destroy(Integration $integration): void
    {
        $this->service->destroy($integration);
    }

    public function getOauthUrl(GetOauthUrlIntegrationRequest $request)
    {
        return $this->service->getOauthUrl($request->validated());
    }
}
