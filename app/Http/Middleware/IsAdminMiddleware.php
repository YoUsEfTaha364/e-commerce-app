<?php

namespace App\Http\Middleware;

use App\Services\api_response;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $is_admin = $request->user()->is_admin;
        if (!$is_admin) {
            return api_response::Response(403, "you are not permitted", null);
        }
        return $next($request);
    }
}
