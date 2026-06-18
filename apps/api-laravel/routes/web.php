<?php

use App\Http\Controllers\Auth\StaffAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Greatness awaits!';
});

Route::webhooks('webhooks/stripe', 'stripe');
Route::webhooks('webhooks/zoom', 'zoom');
