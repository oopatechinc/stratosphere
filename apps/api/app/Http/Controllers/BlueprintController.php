<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blueprint;
use Illuminate\Http\Request;

class BlueprintController extends Controller
{
    public function index()
    {
        return response()->json(Blueprint::with('themes')->get());
    }

    public function show($vertical)
    {
        return response()
            ->json(Blueprint::with('themes')
                ->where('vertical', $vertical)
                ->firstOrFail()
            );
    }
}
