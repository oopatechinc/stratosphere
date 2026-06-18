<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\TimezoneService;
use App\Models\TimeBlockFrequency;
use Illuminate\Database\Eloquent\Collection;

class TimeBlockFrequencyController extends Controller
{
    public function index(): Collection
    {
        return TimeBlockFrequency::all();
    }
}
