<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\CollectionItemControllerService;
use App\Http\Requests\StorePropertyRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PropertyController extends Controller
{
    public function __construct(protected CollectionItemControllerService $service)
    {
    }

    public function index(): Collection
    {
        return $this->service->index();
    }

    public function store(StorePropertyRequest $request): Model
    {
        return $this->service->store($request->validated());
    }
}
