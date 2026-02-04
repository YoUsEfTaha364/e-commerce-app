<?php

namespace App\Http\Middleware;

use App\Services\api_response;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomSanctum extends Authenticate
{
    protected function unauthenticated($request, array $guards)
    {
        throw new HttpResponseException(
            api_response::Response(401, 'Unauthenticated', null)
        );
    }
}
