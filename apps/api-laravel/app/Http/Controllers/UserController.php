<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\UserService;
use App\Http\Requests\CheckPhoneNumberExistsUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserController extends Controller
{
    public function __construct(protected UserService $service)
    {
    }

    public function index(): Collection
    {
        return $this->service->index();
    }

    public function show(User $user): Model
    {
        return $this->service->show($user);
    }

    public function store(StoreUserRequest $request): Model
    {
        return $this->service->store($request->validated());
    }

    public function update(UpdateUserRequest $request, User $user): Model
    {
        return $this->service->update($user, $request->validated());
    }

    public function destroy(User $user): void
    {
        $this->service->destroy($user);
    }

    public function checkPhoneNumberExists(CheckPhoneNumberExistsUserRequest $request): bool
    {
        return $this->service->checkPhoneNumberExists($request->validated('phone_number'));
    }
}
