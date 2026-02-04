<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AdminHome;
use App\Http\Controllers\front\AddressController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\front\OrderController;
use App\Http\Controllers\Front\paymobCheckoutController;
use App\Http\Controllers\Front\ProductController as FrontProductController;
use App\Http\Controllers\Front\CategoryController as FrontCategoryController;
use App\Http\Controllers\Front\CheckoutAddressController;
use App\Http\Controllers\front\CheckoutController;

use App\Http\Controllers\Front\SearchController;
use App\Http\Controllers\Front\WishlistController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/index', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




   //products for customer

   Route::controller(FrontProductController::class)->group(function(){
      Route::get("/","index")->name("customer.home");
      Route::get("products/show/{product}","show")->name("customer.products.show");
   });


   //categories for customer

   Route::controller(FrontCategoryController::class)->group(function(){
    
      Route::get("categories/show/{id}","show")->name("customer.categories.show");
   });





   //  cart

   Route::controller(CartController::class)->prefix("/cart")->name("cart.")->middleware("auth")->group(function(){


    Route::get('/',  'index')->name('index');
    Route::post("/store/{product}","store")->name("store");

    Route::post("/decrement/{id}","decrement")->name("decrement");

    Route::post("/increment/{id}","increment")->name("increment");


    Route::delete("/deleteItem/{id}","delete")->name("delete");

   });

   



    
    // search part
    Route::controller(SearchController::class)->prefix("/search")->group(function (){
           Route::get("/suggestions","getSuggestions")->name("search.suggestions");

         Route::get("/","index")->name("search.index");
   
     
     Route::post("/store","getSearchedProducts")->name(name: "search.store");
   
    });

    // wishlist
    Route::middleware("auth")->controller(WishlistController::class)->prefix("/wishlist")->group(function(){
        Route::get("/","index")->name("wishlist.index");
        Route::post("/store/{product}","store")->name("wishlist.store");
        Route::delete("/delete/{id}","delete")->name("wishlist.delete");
    });


    // paymob


    Route::controller(paymobCheckoutController::class)->prefix("paymob/")->name("paymob.")->middleware("auth")->group(function(){
      Route::get("checkout","checkout")->name("checkout");
      Route::match(["Post","Get"],"checkout/callback","callBack")->name("callback");
    });




    //   checkout stripe



    Route::controller(CheckoutController::class)->middleware("auth")->prefix("/checkout")->name("checkout.")->group(function(){

    
        Route::post("/address/session","storeAddress")->name("address.session");
        Route::get("/","checkout")->name("checkout");
        Route::get("/success","success")->name("success");
        Route::get("/cancel","cancel")->name("cancel");


        //   checkout address

           Route::controller(CheckoutAddressController::class)->middleware("auth")->prefix("/address")->name("address.")->group(function(){

        Route::get("/","index")->name("index");
        Route::get("/create","create")->name("create");

        Route::post("/store","store")->name("store");
      
    });

     
       
    });


    //    orders


       Route::controller(OrderController::class)->prefix("/order")->name("order.")->middleware("auth")->group(function(){


            Route::get('/',  'index')->name('index');
            Route::get('/show/{order}',  'show')->name('show');

       });


    //    address

   Route::prefix("profile/")->name("profile.")->group(function(){
          Route::resource("address",AddressController::class);

            Route::post("/set-default/{address}",[AddressController::class,"SetDefault"])->name("address.setDefault");
   })->middleware("auth");
  
 
require __DIR__.'/auth.php';


