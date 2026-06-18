<?php

use App\Http\Middleware\EnsureUserIsStaff;
use App\Http\Middleware\InitializeTenancyByHeader;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'ensure.staff' => EnsureUserIsStaff::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            'webhooks/*',
        ]);
        $middleware->alias([
            'tenancy.header' => InitializeTenancyByHeader::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
