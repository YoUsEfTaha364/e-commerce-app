<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\api_response;
use Illuminate\Http\Request;
use App\Services\apis\PaymobPaymentService;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $paymob;
   


    public function __construct(PaymobPaymentService $paymob)
    {
        $this->paymob = $paymob;
    }

    public function init(Request $request)
    {
        $user = $request->user();



        $order = $user->orders()->find($request->order_id);

        if (!$order) {
            return api_response::Response(404, "no order found", null);
        }

        $this->paymob->order = $order;
      

        $data = $this->paymob->sendPayment();

        if (!$data) {
            return api_response::Response(400, "payment error", null);
        }

        $payment_id = $data["id"];
        $url = $data["url"];

        $order->update([
            "payment_reference" => $payment_id
        ]);

        return api_response::Response(200, "", [
            "payment_url" => $url
        ]);
    }

    public function callback(Request $request){


        $this->paymob->callBack($request);
    }
}
