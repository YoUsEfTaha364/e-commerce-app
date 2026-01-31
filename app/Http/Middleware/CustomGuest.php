<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomGuest  
{
    
        public function handle(Request $request, Closure $next)
    {
        

        
            if (Auth::guard("admin")->check()) {
                return redirect(route("admin.home"));
            
        }

        return $next($request);
    }

   
    }

