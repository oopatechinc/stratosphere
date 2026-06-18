<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\DomainControllerService;
use Illuminate\Database\Eloquent\Model;

class DomainController extends Controller
{
    public function __construct(protected DomainControllerService $service)
    {
    }

    public function getDomainByUrl(string $domain): Model
    {
        return $this->service->getDomainByUrl($domain);
    }
}
