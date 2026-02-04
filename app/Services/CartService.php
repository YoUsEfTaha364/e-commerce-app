<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartService
{

    public function addItem($product)
    {
        $cart = Cart::firstOrCreate(["user_id" => Auth::user()->id], ["user_id" => Auth::user()->id]);


        $cart_item = CartItem::where("product_id", $product->id)->where("cart_id", $cart->id)->latest()->first();


        if ($cart_item) {
            $cart_item->quantity += 1;
            $cart_item->save();
        } else {
            CartItem::create([
                "cart_id" => $cart->id,
                "product_id" => $product->id,
                "quantity" => 1
            ]);
        }




       
        
    }

    public function decrementQuantity($productId) {

         $cart = Cart::firstOrCreate(["user_id" => Auth::user()->id], ["user_id" => Auth::user()->id]);


        $cart_item = CartItem::where("product_id", $productId)->where("cart_id", $cart->id)->latest()->first();


        if ($cart_item) {
            $cart_item->quantity -= 1;
            $cart_item->save();
        }

        
        $cart = Cart::where("user_id", Auth::user()->id)->with("cart_items.product.images")->first();

        return $cart;
    }
}
