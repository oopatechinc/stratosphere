<?php

namespace App\Http\Controllers\Services;

use App\Contracts\ServiceContract;
use App\Http\Controllers\FetchManagers\TenantsFetchManager;
use App\Models\Domain;
use App\Models\Plugin;
use App\Models\Tenant;
use App\Models\Language;
use App\Models\Occupation;
use App\Models\Staff;
use App\Models\Vertical;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TenantService implements ServiceContract
{
    public function index()
    {
        return (new TenantsFetchManager())->apply()->get();
    }
    public function show(Tenant $tenant)
    {
        return (new TenantsFetchManager($tenant->id))->apply()->get();
    }

    public function store(array $payload): Model
    {
        $language = Language::query()
            ->where('language', Language::LANGUAGE_ENGLISH)
            ->firstOrFail();

            $tenant =  Tenant::query()->create(array_merge($payload, ['language_id' => $language->id]));

            $tenant->run(function () use ($tenant) {
                //create staff record
                $staff = Staff::query()->create([
                    'user_id' => auth()->id(),
                    'status' => Staff::STATUS_ACTIVE
                ]);

                $occupation = Occupation::query()->create([
                    'title' => 'Owner',
                    'is_active' => true
                ]);

                $staff->occupations()->attach($occupation->id);
            });


        // update the user with the tenant id
        auth()->user()->update(['tenant_id' => $tenant->id]);

        return $this->show($tenant);
    }

    public function update(Model $model, array $payload): Model
    {
        $model->update($payload);
        return $model->refresh();
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}
