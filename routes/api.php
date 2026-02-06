<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProductController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

 Route::middleware("c-sanctum:sanctum")->controller(ProductController::class)->
 group(function (){
    route::get("/products","index");
    route::get("/products/{id}","show");
 });


 Route::post("/register",[AuthController::class,"register"]);
 Route::post("/login",[AuthController::class,"login"]);

 Route::middleware("c-sanctum:sanctum")->controller(CartController::class)->group(function (){

 Route::get("/cart/items","index");
 Route::post("/cart/items","store");
 Route::put("/cart/items/{id}","update");
 Route::delete("/cart/items/{id}","destroy");
 Route::delete("/cart","clear");

 });

 Route::middleware("c-sanctum:sanctum")->controller(AddressController::class)->group(function (){

 Route::get("/addresses","index");
 Route::post("/addresses","store");
 Route::put("/addresses/{id}","update");

 Route::delete("/addresses/{id}",action: "destroy");


 });


 Route::middleware("c-sanctum:sanctum")->controller(OrderController::class)->group(function (){

 Route::get("/orders","index");
 Route::post("/orders","store");
 Route::get("/orders/{id}","show");



 });
 Route::middleware("c-sanctum:sanctum")->controller(PaymentController::class)->group(function (){

 Route::post("/payments/paymob","init");


//  Route::put("/addresses/{id}","update");

//  Route::delete("/addresses/{id}",action: "destroy");


 });

 Route::match(['get', 'post'], '/payments/paymob/callback', [PaymentController::class, 'callBack']);
