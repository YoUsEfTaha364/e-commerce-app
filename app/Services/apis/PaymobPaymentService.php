<?php

namespace App\Services\apis;

use App\Interfaces\PaymentGatewayInterface;
use App\Models\Order;
use App\Services\api_response;
use App\Services\BasePaymentService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymobPaymentService extends BasePaymentService implements PaymentGatewayInterface
{
    protected $integrations_id;
    protected $api_key;

    public  $order;


    public  function __construct()
    {
        $this->base_url = env("PAYMOB_Base_Url");
        $this->api_key = env("PAYMOB_API_KEY");

        $this->header = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];


        $this->integrations_id = [5462635, 5461952];
    }



    public function generateToken()
    {



        $response = $this->buildRequest("post", "/api/auth/tokens", ["api_key" => $this->api_key]);

        return $response->getData(true)["data"]["token"];
    }

    public function sendPayment()
    {

        $items = $this->order->order_items->map(function ($item) {

            return
                [
                    "name" => $item->product->name,
                    "amount_cents" => (int)$item->product->sale_price * 100,
                    "quantity" => $item->quantity,
                    "description" => $item->product->description
                ];
        })->toArray();

        $shipping_data = [
            "first_name" => $this->order->order_address->full_name,
            "last_name" => "-",
            "phone_number" => $this->order->order_address->phone,
            "email" => "y@gmail.com"
        ];


        $data = [
            "auth_token" => $this->generateToken(),
            "delivery_needed" => false,
            "amount_cents" => $this->order->total * 100,
            "api_source" => "INVOICE",
            "currency" => "EGP",
            "items" => [],
            "integrations" => $this->integrations_id,

        ];

        $data["shipping_data"] = $shipping_data;
        $data["items"] = $items;

        $response = $this->buildRequest("post", "/api/ecommerce/orders", $data);

        if (!$response->getData(true)["success"]) {
            return false;
        }


        return $response->getData(true)["data"];
    }


  public function callBack(Request $request)
{
    

    $paymentId = (int) (
        $request->input('obj.order.id')
        ?? $request->input('order')
    );

    if (! $paymentId) {
        
        return response()->json(['status' => 'ignored'], 200);
    }

    $order = Order::where('payment_reference', $paymentId)->first();

    if (! $order) {
      
        return response()->json(['status' => 'ignored'], 200);
    }

    // 🔐 Prevent double execution
    if ($order->payment_status !== 'pending') {
        return response()->json(['status' => 'already_processed'], 200);
    }

    $success =
        $request->input('obj.success')
        ?? $request->input('success');

    if ($success === true || $success === 'true') {
        $order->update([
            'payment_status' => 'paid',
            'status' => 'processing',
        ]);
    } else {
        $order->update([
            'payment_status' => 'failed',
            'status' => 'failed',
        ]);
    }

    return response()->json(['status' => 'ok'], 200);
}

}
