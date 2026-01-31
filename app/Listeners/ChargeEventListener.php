<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Session;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use App\Models\User;
use App\OrderStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Events\WebhookReceived;

class ChargeEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WebhookReceived $event): void
    {
        if ($event->payload['type'] === "charge.succeeded") {
            $data = $event->payload["data"]["object"]["metadata"];
            // Log::info($data);
            // exit();


            if ($event->payload["data"]["object"]["status"] == "succeeded") {
                // update order to paid


                DB::transaction(function () use ($data) {




                    $order = Order::find($data["order_id"]);
                    // Log::info($order);

                    $order->update([
                        "payment_status" => "paid",
                        "status" => OrderStatus::Processing
                       
                    ]);
                    // delete sessions data
                    session()->forget('address_id');




                    // todo complete deleting cart
                     $cart = Cart::find($data["cart_id"]);
                    $cart->cart_items()->delete();
                    $cart->delete();
                });
            }
        }
    }
}
