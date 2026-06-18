<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\TemplateService;
use Illuminate\Database\Eloquent\Collection;

class TemplateController extends Controller
{
    public function __construct(protected TemplateService $service)
    {

    }
    public function index(): Collection
    {
        return $this->service->index();
    }
}
