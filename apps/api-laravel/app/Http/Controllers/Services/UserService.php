<?php

namespace App\Http\Controllers\Services;

use App\Contracts\ServiceContract;
use App\Http\Controllers\FetchManagers\UserFetchManager;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserService implements ServiceContract
{
    public function index()
    {
        return (new UserFetchManager())->apply()->get();
    }

    public function show(User $user)
    {
        return (new UserFetchManager($user->id))->apply()->get();
    }

    public function store(array $payload): Model
    {
        return User::query()->create($payload);
    }

    public function update(Model $model, array $payload): Model
    {
        $model->update($payload);
        return $model;
    }

    public function destroy(Model $model)
    {
        return $model->delete();
    }

    public function checkPhoneNumberExists($phone) :bool
    {
        return User::query()->where('phone', $phone)->exists();
    }
}
