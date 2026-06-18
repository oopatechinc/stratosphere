<?php

namespace App\Http\Controllers\Services;

use App\Models\Domain;
use Illuminate\Database\Eloquent\Model;

class DomainControllerService
{
    public function getDomainByUrl(string $domain): Model
    {
        return Domain::query()->where('domain', $domain)->firstOrFail();
    }
}
