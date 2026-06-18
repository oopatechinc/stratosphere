<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\FetchManagers\TemplatesFetchManager;
use App\Models\Template;
use Illuminate\Database\Eloquent\Collection;

class TemplateService
{
    public function index(): Collection
    {
        return (new TemplatesFetchManager())->apply()->get();
    }
}
