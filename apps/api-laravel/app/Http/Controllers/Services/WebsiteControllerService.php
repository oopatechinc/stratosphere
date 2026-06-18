<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\FetchManagers\WebsitesFetchManager;
use App\Models\Website;
use App\Models\WebsiteContent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class WebsiteControllerService
{
    public function index()
    {
        return (new WebsitesFetchManager())->apply()->get();
    }

    public function show($id): Model
    {
        return Website::with(['theme.blueprint'])->findOrFail($id);
    }

    public function update(array $payload, int $website): void
    {
        $website = Website::findOrFail($website);
        $website->update([
            'active_config' => $payload,
        ]);
    }
}
