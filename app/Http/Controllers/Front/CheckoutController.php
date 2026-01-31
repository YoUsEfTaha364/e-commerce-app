<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use App\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Cashier;

class CheckoutController extends Controller
{
    public function storeAddress(Request $request)
    {
        // dd($request->all());
        $cart = Cart::where("user_id", Auth::user()->id)->first();

        if (count($cart->cart_items) == 0) {
            abort(404);
        }
        $address_id = $request->address;
        //    dd($address_id);
        session([
            "address_id" => $address_id
        ]);

        if ($request->input("payment_method") == "card") {
            return redirect()->route("checkout.checkout");
        }

        // paymob 

        return redirect()->route("paymob.checkout");
    }
    public function checkout()
    {

        $cart = Cart::where("user_id", Auth::user()->id)->first();


        if (count($cart->cart_items) == 0) {
            abort(404);
        }

        $subtotal = $cart->getSubtotalAttribute();
        $order = "";
        DB::transaction(function () use ($subtotal, &$order) {


            $order = Order::create([
                "user_id" => Auth::user()->id,
                "order_number" => "ZSC-" . now()->year . "-" . now()->day . "-" . now()->minute . "-" . now()->second . "-" . fake()->randomElement,
                "status" => OrderStatus::Pending,
                "payment_method" => "stripe-card",
                "payment_status" => "unpaid",
                "subtotal" => $subtotal,
                "total" => $subtotal+50,

            ]);

            $address = Address::find(session("address_id"));


            $add = OrderAddress::create([
                "order_id" => $order->id,
                "full_name" => $address->full_name,
                "phone" => $address->phone,
                "address" => $address->address,
                "city" => $address->city,
                "state" => $address->state,

            ]);

            $cart = Cart::where("user_id", Auth::user()->id)->first();

            foreach ($cart->cart_items as $item) {
                OrderItem::create([
                    "order_id" => $order->id,
                    "product_id" => $item->product->id,
                    "product_name" => $item->product->name,
                    "price" => $item->product->sale_price,
                    "quantity" => $item->quantity,
                    "total" => $item->quantity * $item->product->sale_price,
                ]);
            }
        });


        $items = $cart->cart_items->map(function ($product) {
            return [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product->product->name,
                    ],
                    'unit_amount' => $product->product->sale_price * 100,
                ],
                'quantity' => $product->quantity,
                // 'adjustable_quantity' => [
                //     'enabled' => true,
                //     'maximum' => 100,
                //     'minimum' => 1,
                // ],
            ];
        })->toArray();




        $sessionOptions = [
            "success_url" => route("checkout.success") . '?session_id={CHECKOUT_SESSION_ID}',
            "cancel_url" => route("checkout.cancel") . '?session_id={CHECKOUT_SESSION_ID}',
            "line_items" => $items,
            // "metadata" => ["order_id"=>$order->id]
            'payment_intent_data' => [
                'metadata' => [
                    'order_id' => $order->id,
                    'user_id'  => Auth::id(),
                    'cart_id'  => $cart->id,
                    'address_id'  => session("address_id"),
                ]
            ]

        ];

        return Auth::user()->checkout([], $sessionOptions);
    }


    public function success(Request $request)
    {
        // dd(1);
        $sessionId = $request->get('session_id');

        if ($sessionId === null) {
            return;
        }

        $session = Cashier::stripe()->checkout->sessions->retrieve($sessionId);


        return view('customer.checkout.success', [
            'session' => $session ?? null,
            'order'   => $order ?? null,
        ]);
    }




    public function cancel(Request $request)
    {

        dd(session("address_id"));

        dd(1);
    }
}
