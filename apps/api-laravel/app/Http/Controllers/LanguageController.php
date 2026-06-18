<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\LanguageService;
use Illuminate\Database\Eloquent\Collection;

class LanguageController extends Controller
{
    public function __construct(protected LanguageService $service)
    {
    }

    public function index(): Collection
    {
        return $this->service->index();
    }
}
