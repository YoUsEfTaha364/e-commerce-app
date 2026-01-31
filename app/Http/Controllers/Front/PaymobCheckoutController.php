<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\PaymentGatewayInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class paymobCheckoutController extends Controller
{
    public function checkout(PaymentGatewayInterface $pay){
 
//   dd(5);
       $url= $pay->sendPayment();

       return redirect()->away($url);
        

    }
    public function callback(Request $request,PaymentGatewayInterface $pay){

     $order= $pay->callBack($request);
return view('customer.checkout.success', [
    'session' => $session ?? null,
    'order'   => $order ?? null,
]);
       

      //  dd($request->all());
        

    }
}
