<?php

namespace App\Http\Controllers\Services;

use App\Contracts\ServiceContract;
use App\Http\Controllers\FetchManagers\ServicesFetchManager;
use App\Models\Service;
use App\Models\ServiceVariation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ServiceService implements ServiceContract
{
    public function index()
    {
        return (new ServicesFetchManager())->apply()->get();
    }

    public function store(array $payload): Model
    {
        $service = Service::query()->create($payload);

        if (!empty($payload['variations'])) {
            foreach ($payload['variations'] as $variation) {
                $variation['service_id'] = $service->id;
                ServiceVariation::query()->create($variation);
            }
        }

        if (!empty($payload['categories'])) {
            foreach ($payload['categories'] as $category) {
                $service->categories()->attach($category->id);
            }
        }

        return $service->refresh()->load('variations')->load('categories');
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

    public function toggleCategories(Service $service, array $categories): Model
    {
        $service->categories()->delete();
        $service->categories()->attach(Arr::pluck($categories, 'id'));
        return $service->fresh()->load('categories');
    }
}
