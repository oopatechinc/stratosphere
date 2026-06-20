<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\FetchManagers\CollectionItemFetchManager;
use App\Models\CollectionItem;
use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CollectionItemControllerService
{
    public function index(string $type): Collection
    {
        return CollectionItem::query()
            ->where('collection_type', $type)
            ->with('images')
            ->get();
    }

    public function store(array $payload): Model
    {
        return CollectionItem::query()->create($payload);
    }
}
