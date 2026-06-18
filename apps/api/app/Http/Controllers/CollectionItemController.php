<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\CollectionItemControllerService;
use App\Http\Requests\StoreCollectionItemRequest;

class CollectionItemController extends Controller
{
    public function __construct(protected CollectionItemControllerService $service)
    {
    }

    /**
     * Display a listing of the collection items.
     */
    public function index(string $type)
    {
        return $this->service->index($type);
    }

    public function store(StoreCollectionItemRequest $request)
    {
        return $this->service->store($request->validated());
    }
}
