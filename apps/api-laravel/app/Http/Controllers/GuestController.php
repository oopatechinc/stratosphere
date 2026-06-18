<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\GuestService;
use App\Http\Requests\StoreGuestRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function __construct(protected GuestService $service)
    {
    }

    public function store(StoreGuestRequest $request): Model
    {
        return $this->service->store($request->validated());
    }
}
