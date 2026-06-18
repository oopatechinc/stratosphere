<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\CountryService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct(protected CountryService $service)
    {
    }

    public function index(): Collection
    {
        return $this->service->index();
    }
}
