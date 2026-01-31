<?php

use App\Http\Middleware\AdminAuthorization;
use App\Http\Middleware\check;
use App\Http\Middleware\CustomAuth;
use App\Http\Middleware\CustomGuest;
use App\Http\Middleware\guest;
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
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function(){
            Route::middleware("web")->prefix("admin")->name("admin.")->group(base_path("routes/admin.php"));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            "c-auth"=>CustomAuth::class,"c-guest"=>CustomGuest::class,"guest2"=>guest::class,"authorize-admin"=>AdminAuthorization::class,"check"=>check::class
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
