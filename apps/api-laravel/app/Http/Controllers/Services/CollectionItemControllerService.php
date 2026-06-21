<?php

namespace App\Http\Controllers\Services;

use App\Models\CollectionItem;
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

    public function destroy(int $id)
    {
        CollectionItem::query()->findOrFail($id)->delete();
    }
}
