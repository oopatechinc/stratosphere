<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\WebsiteControllerService;
use App\Http\Requests\UpdateWebsiteRequest;
use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function __construct(protected WebsiteControllerService $service)
    {
    }

    public function index()
    {
        return $this->service->index();
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function update(UpdateWebsiteRequest $request, $website)
    {
        $this->service->update($request->validated('active_config'), $website);
    }
}
