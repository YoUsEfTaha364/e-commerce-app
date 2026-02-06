<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use App\Services\api_response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{


    public function index(Request $request)
    {
        $user = $request->user();

        $orders = $user->orders;

        if ($orders->isEmpty()) {
            return api_response::Response(404, "no orders found", null);
        }

        return api_response::Response(200, "get orders", data: $orders);
    }

    public function store(Request $request)
    {
        // get auth user
        $user = $request->user();
        // get user address and check
        $address = $user->addresses()->where("id", $request->address_id)->first();

        if (!$address) {
            return api_response::Response(404, "address not found", null);
        }

        // get user cart and check
        $cart = $user->cart;

        if (!$cart) {
            return api_response::Response(404, "user has no cart", null);
        }

        // get cart items and check
        $items = $cart->cart_items;

        if ($items->isEmpty()) {
            return api_response::Response(404, "cart is empty", null);
        }

        $order = "";

        $subtotal = $cart->getSubtotalAttribute();
        try {
            DB::transaction(function () use ($cart, &$order, $subtotal, $user, $items, $address) {

                //1-create order

                $order_number = "ZSC-" . now()->year . "-" . now()->day . "-" . now()->minute . "-" . now()->second . "-" . fake()->randomElement;

                $order = Order::create([
                    "user_id" => $user->id,
                    "order_number" => $order_number,
                    "status" => "pending",
                    "payment_status" => "unpaid",
                    "subtotal" => $subtotal,
                    "total" => $subtotal + 50,

                ]);

                //2- create order_items and update product quantity

                foreach ($items as $item) {
                    $product = $item->product;
                    if ($item->quantity > $item->product->quantity) {
                        throw new \Exception("in appropriate quantity with stock for {$product->name}");
                    }

                    $price = $product->sale_price ?? $product->price;

                    OrderItem::create([
                        "order_id" => $order->id,
                        "product_id" => $product->id,
                        "product_name" => $product->name,
                        "price" => $price,
                        "quantity" => $item->quantity,
                        "total" => $item->quantity * $product->sale_price,
                    ]);

                    $product->decrement('quantity', $item->quantity);
                }

                //3- order address
                $add = OrderAddress::create([
                    "order_id" => $order->id,
                    "full_name" => $address->full_name,
                    "phone" => $address->phone,
                    "address" => $address->address,
                    "city" => $address->city,
                    "state" => $address->state,

                ]);

                $cart->delete();
            });
        } catch (\Throwable $e) {
            return api_response::Response(
                422,
                'Order could not be created',
                ['error' => $e->getMessage()]
            );
        }

        $data = [
            "order_id" => $order->id,
            "total" => $order->total,
        ];

        return api_response::Response(201, "order created successfully", $data);
    }

    public function show(Request $request)
    {
        $order_id = $request->id;

        $user = $request->user();

        $order = $user->orders()->find($order_id);

        if (!$order) {
            return api_response::Response(404, "order not found", null);
        }


        return api_response::Response(201, "get order", $order);
    }
}
