<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\AdminHome;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\ProductController as FrontProductController;
use App\Http\Controllers\Front\CategoryController as FrontCategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('products/export/test', [ProductController::class, 'testExport'])
    ->name('products.export.test');


Route::get("dashboard",DashboardController::class)->middleware("c-auth")->name("dashboard");


Route::controller(CustomerController::class)->middleware("c-auth")->prefix("/customer")->name("customers.")->group(function(){

Route::get("/{sort?}","index")->name("index");
Route::get("/show/{user}","show")->name("show");
Route::post("/filter","filter")->name("filter");

});


//    products for admins



   Route::resource("products",ProductController::class);

   
Route::post('products/{product}/change-status', [ProductController::class, 'change_status'])
    ->name('products.change-status');



   Route::middleware("c-auth")->prefix("admin/")->resource("admins",AdminController::class);

   //orders

   Route::middleware("c-auth")->group(function(){
     
       

         Route::resource("orders",OrderController::class)->except("index");

         Route::get("/order/{sort?}",[OrderController::class,"index"])->name("orders.index");


       Route::post("/order/update-status/{order}",[OrderController::class,"update_status"])->name("orders.update-status");

       Route::post("/filter",[OrderController::class,"filter"])->name("orders.filter");
   });
   


   //roles

  Route::middleware("c-auth")->controller(RoleController::class)->prefix("/roles")->name("roles.")->group(function (){

       Route::get("/","index")->name("index");
       Route::get("/create","create")->name("create");
       Route::get("/edit/{role}","edit")->name("edit");
       Route::post("/store","store")->name("store");
       Route::patch("/update/{role}","update")->name("update");
       Route::get("/view/{role}","view")->name("view");
       Route::delete("/delete/{role}","delete")->name("delete");
  });
   
 Route:: middleware("c-auth")->get("/home",AdminHome::class)->name("home");

 require __DIR__.'/adminauth.php';

?>