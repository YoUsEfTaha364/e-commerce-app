<?php

namespace App\Http\Middleware;

use App\Services\api_response;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthorizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$permissions): Response
    {
        
        $user=$request->user();
        
        if(!$user->hasAnyPermission($permissions)){
            return api_response::Response(403,"you are not permitted",null);
        }
        return $next($request);
    }
}
