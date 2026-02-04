<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CartService;
class CartController extends Controller
{

    public function index(){
        
        $cart = Cart::where("user_id", Auth::user()->id)->with("cart_items.product.images")->first();

         return view("customer.carts.index",compact("cart"));

    }

    public function store(Product $product,CartService $addProduct){


         $addProduct->addItem($product);

         return redirect()->route("cart.index");

    }

   public function delete($id)
{
    CartItem::destroy($id);

    // Reload updated cart
    $cart = Cart::where("user_id", Auth::id())
                ->with('cart_items.product.images')
                ->first();

    return view("customer.carts.index", compact("cart"));
}






    public function increment($id)
{
    // dd($id);
    $cartItem = CartItem::findOrFail($id);
    $cartItem->quantity+=1;
    $cartItem->save();

   return redirect()->back();
}
  public function decrement($id)
{
    //  dd($id);
    $cartItem = CartItem::findOrFail($id);

    if ($cartItem->quantity > 1) {
        $cartItem->quantity -=1;
    $cartItem->save();
 
    } 

    // dd(1);

    return redirect()->back();
}


}
