<?php

declare(strict_types=1);

use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\WebsiteController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GoogleApiController;
use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OccupationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceVariationController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TimeBlockFrequencyController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'auth:sanctum',
    'tenancy.header',
//    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('tenants/{tenant}', [TenantController::class, 'show']);
    Route::get('/websites/{id}', [WebsiteController::class, 'show']);
    Route::put('/websites/{id}', [WebsiteController::class, 'update']);

    Route::get('/media', [MediaController::class, 'index']);
    Route::post('/media', [MediaController::class, 'store']);
    Route::delete('/media/{id}', [MediaController::class, 'destroy']);

    Route::get('time-block-frequencies', [TimeBlockFrequencyController::class, 'index']);

    Route::get('stats', [StatController::class, 'getStats']);
    Route::get('domains/url/{url}', [DomainController::class, 'getDomainByUrl']);

    Route::post('service/{service}/toggle-categories', [ServiceController::class, 'toggleCategories']);
    Route::post('staffs/{staff}/sync-services', [StaffController::class, 'syncServices']);


    Route::apiResource('users', UserController::class);
    Route::apiResource('staffs', StaffController::class);

    Route::apiResource('services', ServiceController::class);
    Route::apiResource('service-variations', ServiceVariationController::class)->except(['index']);
    Route::resource('categories', CategoryController::class);
    Route::prefix('files')->group(function () {
        Route::post('/upload', [FileController::class, 'upload']);
        Route::post('/delete', [FileController::class, 'delete']);
        Route::post('/replace', [FileController::class, 'replace']);
    });
    Route::apiResource('occupations', OccupationController::class);
    Route::apiResource('locations', LocationController::class);

    Route::apiResource('appointments', AppointmentController::class)->except(['store']);

    //Integrations
    Route::post('integrations/get-oauth-url', [IntegrationController::class, 'getOauthUrl']);
    Route::apiResource('integrations', IntegrationController::class);

    Route::get('google/get-calendar-by-integration-id/{integrationId}', [GoogleApiController::class, 'getCalendarsByIntegrationId']);
    Route::post('stripe/disconnect', [StripeController::class, 'disconnect']);
    Route::post('stripe/create-checkout-session', [StripeController::class, 'createCheckoutSession']);

    Route::post('stripe/check-subscription-status', [StripeController::class, 'checkSubscriptionStatus']);
});
