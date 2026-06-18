<?php

namespace App\Http\Controllers\Services;

use App\Contracts\ServiceContract;
use App\Http\Controllers\FetchManagers\OccupationFetchManager;
use App\Models\Occupation;
use Illuminate\Database\Eloquent\Model;

class OccupationService implements ServiceContract
{
    public function index()
    {
        return (new OccupationFetchManager())->apply()->get();
    }
    public function show(Occupation $occupation)
    {
        return $occupation;
    }

    public function store(array $payload): Model
    {
        return Occupation::query()->updateOrCreate($payload);
    }

    public function update($id, array $payload): Model
    {
        // TODO: Implement update() method.
    }

    public function destroy(Model $model): void
    {
        $model->delete();
    }

    private function getSubdomainFromUrl(string $url)
    {
        if (config('app.env') === 'local') {
            $subdomain = 'localhost:3000';
        } else {
            $scheme = config('app.env') === 'local' ? 'http' : 'https';
            $subdomain = explode('.', explode("$scheme://", $url)[1])[0];
        }

        return $subdomain;
    }
}
