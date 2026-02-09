<?php
//10|5CBf3o9ui3KedzJOkv7wqjrIJ6ffRL2qwbjVmzKy1cbe79a8
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\Admin\AdminAuthController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Api\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\Api\Admin\UserController;
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




 });
   // payment callback
 Route::match(['get', 'post'], '/payments/paymob/callback', [PaymentController::class, 'callBack']);



   // start admin routes


    Route::controller(AdminAuthController::class)->group(function(){

       Route::post("/admin/login","login");

    });

    

    Route::middleware(["c-sanctum:sanctum","is-admin"])->prefix("/admin/")->controller(AdminProductController::class)->group(function(){

       Route::get("products","index");
       Route::get("products/{id}","show");
       Route::post("products","store");
       Route::put("products/{id}","update");

    });

    Route::middleware(["c-sanctum:sanctum","is-admin"])->prefix("/admin/")->controller(AdminOrderController::class)->group(function(){

       Route::get("orders","index");
       Route::get("orders/{id}",action: "show");
       Route::put("orders/{id}/status","updateStatus");
   

    });


    Route::middleware(["c-sanctum:sanctum","is-admin"])->prefix("/admin/")->controller(DashboardController::class)->group(function(){

       Route::get("dashboard","index");

   

    });

    Route::middleware(["c-sanctum:sanctum","is-admin"])->prefix("/admin/")->controller(UserController::class)->group(function(){

       Route::get("users","index");
       Route::post("users/{id}","show");
       Route::post("users/{id}/assign-role","assignRole");

   

    });

    Route::middleware(["c-sanctum:sanctum","is-admin"])->prefix("/admin/")->controller(RoleController::class)->group(function(){

       Route::get("roles","index");
      //  Route::post("roles/assign-role/{id}","assign_role");
       Route::post("roles","store");
       Route::put("roles/{id}","update");
      
      

   

    });

    Route::middleware(["c-sanctum:sanctum","is-admin"])->prefix("/admin/")->controller(RoleController::class)->group(function(){

       Route::get("roles","index");
     
       Route::post("roles","store");
       Route::put("roles/{id}","update");
      
      

   

    });


