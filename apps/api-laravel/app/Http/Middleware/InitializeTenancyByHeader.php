<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stancl\Tenancy\Exceptions\TenantDatabaseDoesNotExistException;

class InitializeTenancyByHeader
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $tenantId = $request->header('X-Tenant-ID');

        if ($tenantId) {
            try {
                tenancy()->initialize($tenantId);
            } catch (TenantDatabaseDoesNotExistException $e) {
                abort(404, 'Tenant business connection not found.');
            }
        } else {
            abort(400, 'Missing X-Tenant-ID header context.');
        }

        return $next($request);
    }
}
