<?php

namespace App\Http\Controllers\Services;

use App\Contracts\ServiceContract;
use App\Models\ServiceVariation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ServiceVariationService implements ServiceContract
{
    public function index()
    {
    }

    /*
     * This method assumes only bulk service variations
     * will be sent for storage
     */
    public function store(array $payload): Collection
    {
        //return safeguard
        if (!count($payload)) return new Collection();

        // first delete all entries as this store method acts
        // as both store and update
        ServiceVariation::query()
            ->where('service_id', $payload[0]['service_id'])
            ->delete();

        //currently failing because when updating and adding new variation, the service id must be updated and not -1

        foreach ($payload as $serviceVariation) {
            ServiceVariation::query()->create($serviceVariation);
        }

        return ServiceVariation::query()
            ->where('service_id', $payload[0]['service_id'])
            ->get();
    }

    public function update(Model $model, array $payload): Model
    {
        $model->update($payload);
        return $model->fresh();
    }

    public function destroy(Model $model)
    {
        $model->delete();
    }
}
