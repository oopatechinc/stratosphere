<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\StatService;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function __construct(protected StatService $service)
    {
    }

    public function getStats(Request $request)
    {
        return $this->service->getStats($request->toArray());
    }
}
