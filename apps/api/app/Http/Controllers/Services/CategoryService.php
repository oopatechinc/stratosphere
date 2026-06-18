<?php

namespace App\Http\Controllers\Services;

use App\Contracts\ServiceContract;
use App\Http\Controllers\FetchManagers\CategoriesFetchManager;
use App\Http\Controllers\FetchManagers\ServicesFetchManager;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryService implements ServiceContract
{
    public function index()
    {
        return (new CategoriesFetchManager())->apply()->get();
    }

    public function store(array $payload): Model
    {
        $category =  Category::query()->create($payload);

        if (!empty($payload['services'])) {
            foreach ($payload['services'] as $service) {
                $category->services()->attach($service['id']);
            }
        }

        return $category->fresh('services');
    }

    public function update(Category|Model $model, array $payload): Model
    {
        $model->update($payload);

        if ($payload['services']) {
            $model->services()->detach();
            foreach ($payload['services'] as $service) {
                $model->services()->attach($service['id']);
            }
        }

        return $model->fresh('services');
    }

    public function destroy(Model $model)
    {
        $model->delete();
    }
}
