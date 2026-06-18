<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\PlanService;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function __construct(protected PlanService $service)
    {
    }

    public function index()
    {
        return $this->service->index();
    }
}
