<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CartItemsRequest;
use App\Http\Requests\Api\UpdateCartItemRequest;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Services\api_response;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {

        $user = $request->user();

        $cart = $user->cart;

        if (!$cart) {
            return api_response::Response(
                404,
                'not found',
                null
            );
        }

        $data = [
            "items" => $cart->cart_items
            
            
        ];

        return api_response::Response(
            200,
            'cart is found',
            $data
        );
    }
    public function store(CartItemsRequest $request)
    {
        /**
         * 1- Get the authenticated user
         * (token → Sanctum → user)
         */
        $user = $request->user();

        /**
         * 2- Get the product or fail
         * If product does not exist → 404 automatically
         */
        $product = Product::findOrFail($request->product_id);

        /**
         * 3- Get user's cart or create a new one
         * Cart is created ONLY when the first item is added
         */
        $cart = Cart::firstOrCreate([
            'user_id' => $user->id,
        ]);

        /**
         * 4- Check if this product already exists in the cart
         */
        $item = $cart->cart_items()
            ->where('product_id', $product->id)
            ->first();

        /**
         * 5- Determine the new quantity
         * If item exists → add quantities
         * If not → use requested quantity
         */
        $newQuantity = $request->quantity;

        if ($item) {
            $newQuantity = $item->quantity + $request->quantity;
        }

        /**
         * 6- Check stock availability
         * Backend ALWAYS validates stock
         */
        if ($newQuantity > $product->quantity) {
            return api_response::Response(
                422,
                'Quantity exceeds available stock',
                [
                    'available_quantity' => $product->quantity,
                    'requested_quantity' => $newQuantity,
                ]
            );
        }

        /**
         * 7- Update existing cart item OR create a new one
         */
        if ($item) {
            // Update quantity if item already exists
            $item->update([
                'quantity' => $newQuantity,
            ]);
        } else {
            // Create new cart item
            $item = $cart->cart_items()->create([
                'product_id' => $product->id,
                'quantity'   => $request->quantity,
            ]);
        }

        /**
         * 8- Return success response
         */
        return api_response::Response(
            201,
            'Item added to cart',
            $item
        );
    }

    public function update(UpdateCartItemRequest $request, string $id)
    {

        $errors = [];

        $user = $request->user();

        //  Ensure user has a cart
        $cart = $user->cart;

        if (! $cart) {
            return api_response::Response(
                404,
                'Cart not found',
                null
            );
        }

        //  Find cart item inside user's cart
        $cartitem = $cart->cart_items()
            ->where('id', $id)
            ->first();






        if (!$cartitem) {
            $errors["item"] = "invalid item";

            return api_response::Response(
                422,
                'invalid',
                $errors
            );
        }

        if ($request->quantity > $cartitem->product->quantity) {
            $errors["quantity"] = "more than available quantity";
        } else {
            $cartitem->quantity = $request->quantity;
        }





        if ($errors) {

            return api_response::Response(
                422,
                'invalid',
                $errors
            );
        }


        $cartitem->save();

        return api_response::Response(
            200,
            'quantity changed successfully',
            $cartitem
        );
    }

    public function destroy(Request $request, string $id)
    {
        $cart = $request->user()->cart;

        if (! $cart) {
            return api_response::Response(
                404,
                'Cart not found',
                null
            );
        }

        $cartItem = $cart->cart_items()
            ->where('id', $id)
            ->first();

        if (! $cartItem) {
            return api_response::Response(
                404,
                'Cart item not found',
                null
            );
        }

        $cartItem->delete();

        return api_response::Response(
            200,
            'Item removed from cart',
            null
        );
    }

    public function clear(Request $request)
    {
        
        $cart = $request->user()->cart;

     

        if (! $cart) {
            return api_response::Response(
                200,
                'Cart already empty',
                null
            );
        }

        $cart->cart_items()->delete();

        $cart->delete();

        return api_response::Response(
            200,
            'Cart cleared successfully',
            null
        );
    }
}
