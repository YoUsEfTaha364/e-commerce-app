<?php

use App\Http\Middleware\AdminAuthorization;
use App\Http\Middleware\ApiAuthorizationMiddleware;
use App\Http\Middleware\check;
use App\Http\Middleware\CustomAuth;
use App\Http\Middleware\CustomGuest;
use App\Http\Middleware\CustomSanctum;
use App\Http\Middleware\guest;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Auth\Middleware\Authenticate;
// use Illuminate\Auth\Middleware\guest;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Guid\Guid;



return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function(){
            Route::middleware("web")->prefix("admin")->name("admin.")->group(base_path("routes/admin.php"));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            "c-auth"=>CustomAuth::class,"c-guest"=>CustomGuest::class,"guest2"=>guest::class,"authorize-admin"=>AdminAuthorization::class,"check"=>check::class,"c-sanctum"=>CustomSanctum::class,"is-admin"=>IsAdminMiddleware::class,"authorize-api"=>ApiAuthorizationMiddleware::class
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
