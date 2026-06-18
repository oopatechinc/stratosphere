<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\TimezoneService;
use Illuminate\Database\Eloquent\Collection;

class TimezoneController extends Controller
{
    public function __construct(protected TimezoneService $service)
    {
    }

    public function index(): Collection
    {
        return $this->service->index();
    }
}
