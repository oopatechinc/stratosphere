<?php

namespace App\Http\Controllers\Services;

use App\Contracts\ServiceContract;
use App\Factories\IntegrationFactory;
use App\Http\Controllers\FetchManagers\IntegrationFetchManager;
use App\Models\Integration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class IntegrationService implements ServiceContract
{
    public function index()
    {
        return (new IntegrationFetchManager())->apply()->get();
    }

    public function getOauthUrl(array $payload)
    {
        $factory = (new IntegrationFactory())->getInstance($payload['platform']);
        return $factory->getOauthUrl($payload);
    }

    public function show(Integration $integration)
    {
        return (new IntegrationFetchManager($integration->id))->apply()->get();
    }

    public function store(array $payload): Model|Collection
    {
        $factory = (new IntegrationFactory())->getInstance($payload['platform']);
        return $factory->store($payload);
    }

    public function update(Model $model, array $payload): Model
    {
        $model->update($payload);
        return $model->fresh();
    }

    /**
     * @throws \Exception
     */
    public function destroy(Model $model)
    {
        /**@var \App\Models\Integration $model **/
        $factory = new IntegrationFactory();
        $factory->getInstance($model->platform)->destroy($model);
    }
}
