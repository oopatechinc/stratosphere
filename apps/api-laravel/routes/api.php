<?php

use App\Http\Controllers\BlueprintController;
use App\Http\Controllers\CollectionItemController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\StaffAuthController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GoogleApiController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OccupationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceVariationController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TimeBlockFrequencyController;
use App\Http\Controllers\TimezoneController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteOnboardingController;
use App\Http\Controllers\TemplateController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('timezones', [TimezoneController::class, 'index']);
Route::get('languages', [LanguageController::class, 'index']);
Route::get('tenants', [TenantController::class, 'index']);
Route::get('industries', [IndustryController::class, 'index']);
Route::get('countries', [CountryController::class, 'index']);
Route::get('/blueprints', [BlueprintController::class, 'index']);
Route::get('/blueprints/{vertical}', [BlueprintController::class, 'show']);
Route::get('locations/subdomain/{subdomain}', [LocationController::class, 'showBySubdomain']);
Route::get('staffs/{staff}/times', [StaffController::class, 'getTimes']);
Route::get('domains/{domain}', [DomainController::class, 'getDomainByUrl']);

Route::post('appointments', [AppointmentController::class, 'store']);
Route::post('check-phone-number-exists', [UserController::class, 'checkPhoneNumberExists']);

Route::prefix('auth')->group(function () {
    Route::post('/login', [StaffAuthController::class, 'login']);
    Route::post('/logout', [StaffAuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/signup', [StaffAuthController::class, 'signup']);
    Route::post('/send-verification-code', [AuthController::class, 'sendVerificationCode']);
    Route::post('/verify-code', [AuthController::class, 'verifyCode']);
    Route::post('/update-password', [AuthController::class, 'updatePassword']);
});

Route::apiResource('guests', GuestController::class);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        /**@var User $user **/
        $user =  $request->user();
        $user->load('tenant.vertical.industry');
        return $user;
    });

    Route::apiResource('tenants', TenantController::class)->except(['index', 'show']);
    Route::get('templates', [TemplateController::class, 'index']);
});


Route::middleware([
    'tenancy.header',
])->group(function () {
    Route::get('/websites/{id}', [WebsiteController::class, 'show']);
    Route::get('/collections/{type}', [CollectionItemController::class, 'index']);


    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('tenants/{tenant}', [TenantController::class, 'show']);

        Route::get('/websites', [WebsiteController::class, 'index']);
        Route::put('/websites/{id}', [WebsiteController::class, 'update']);

        Route::post('/website-onboarding', [WebsiteOnboardingController::class, 'store']);

        Route::get('/media', [MediaController::class, 'index']);
        Route::post('/media', [MediaController::class, 'store']);
        Route::delete('/media/{id}', [MediaController::class, 'destroy']);

        Route::get('time-block-frequencies', [TimeBlockFrequencyController::class, 'index']);

        Route::get('stats', [StatController::class, 'getStats']);
        Route::get('domains/url/{url}', [DomainController::class, 'getDomainByUrl']);

        Route::get('website-templates', [TemplateController::class, 'index']);

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

        Route::apiResource('/collections', CollectionItemController::class)->except(['index']);

    });
});

