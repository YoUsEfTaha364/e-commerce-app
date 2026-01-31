<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(){

        $wishlist=Wishlist::where("user_id",Auth::user()->id)->with("wishlist_items.product.images")->first();

        return view("customer.wishlist.index",compact("wishlist"));
        
    }

    public function store(Product $product){
        $wishlist=Wishlist::firstOrCreate(["user_id"=>Auth::user()->id],["user_id"=>Auth::user()->id]);


        WishlistItem::create([
            "product_id"=>$product->id,
            "wishlist_id"=>$wishlist->id
        ]);





        return redirect()->route("wishlist.index");
        
        

    }

     public function delete($id){

     
        WishlistItem::destroy($id);

        return redirect()->route("wishlist.index");
        
    }

    
}
