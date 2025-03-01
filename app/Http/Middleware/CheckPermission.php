<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permissionName): Response
    {
        try {
            if (!$request->user()->can($permissionName)) {
                UnauthorizedException::forPermissions($permissionName);
            }
            return $next($request);
        } catch (\Throwable $th) {
            UnauthorizedException::forPermissions($permissionName);
        }
    }
}
