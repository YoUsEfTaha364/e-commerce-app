<?php


namespace App\Services;
use Illuminate\Support\Facades\Session;
use App\Interfaces\PaymentGatewayInterface;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderItem;
use App\OrderStatus;
use Exception;

use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Pest\Laravel\session;

class PaymobPaymentService extends BasePaymentService implements PaymentGatewayInterface {


    protected $api_key;
    protected $integrations_id;

    public function __construct(){
        $this->base_url=env('PAYMOB_Base_Url');
        $this->header=[
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $this->api_key=env('PAYMOB_API_KEY');

        $this->integrations_id=[5462635];

    }


    protected function generateToken(){

       $response= $this->buildRequest("post","/api/auth/tokens",['api_key' => $this->api_key]);

      return $response->getData(true)['data']['token'];

    }

    public function sendPayment(){
         
    
 


$addressId = Session::get('address_id');
$address = Address::findOrFail($addressId);


   
         $cart = Cart::where("user_id", Auth::user()->id)->first();
         

         
         $subtotal = $cart->getSubtotalAttribute();


        $user=Auth::user();

        //    dd(1);
        
 

        // $this->header["Authorization"]="Bearer " . $this->generateToken();
        $cart=Cart::where("user_id",Auth::user()->id)->with("cart_items.product")->first();

                $shipping_data=[
            "first_name"=>$address->full_name,
            "last_name"=>"-",
            "phone_number"=>$address->phone,
            "email"=>$user->email
        ];

        $items=$cart->cart_items->map(function($item){

            return 
                [
                 "name"=> $item->product->name,
                 "amount_cents"=> (int)$item->product->sale_price*100,
                 "quantity"=> $item->quantity,
                 "description"=> $item->product->description   
                ];
            

        })->toArray();

        // dd($cart->getSubtotalAttribute());

        
      

        $data["auth_token"]= $this->generateToken();
        $data["api_source"]= "INVOICE";
        $data["amount_cents"]= (int)$cart->getSubtotalAttribute() * 100;
        $data["currency"]= "EGP";
        $data["shipping_data"]=$shipping_data; 
        $data["integrations"]=$this->integrations_id; 
        $data["items"]=$items; 
        $data["delivery_needed"]= false;

        // dd($data);


     $response = $this->buildRequest('POST', '/api/ecommerce/orders', $data);
    
    //   dd($response->getData(true));

       if ($response->getData(true)['success']) {

        // dd($response->getData(true));

       $paymobOrderId = $response->getData(true)['data']['id'];

            $order = Order::create([
                "user_id" => $user->id,
                "order_number" => "ZSC-" . now()->year . "-" . now()->day . "-" . now()->minute . "-" . now()->second . "-" . fake()->randomElement,
                "status" => OrderStatus::Pending,
                "payment_method" => "paymob-wallet",
                "payment_status" => "unpaid",
                "subtotal" => $subtotal,
                "total" => $subtotal,
                "payment_reference" => $paymobOrderId,

            ]);

         $addressId = Session::get('address_id');

        $address=Address::find($addressId);
        

         $add= OrderAddress::create([
                "order_id" => $order->id,
                "full_name" => $address->full_name,
                "phone" => $address->phone,
                "address" => $address->address,
                "city" => $address->city,
                "state" => $address->state,

            ]);


        
  
      $url = $response->getData(true)['data']['url'];

        return $url;




        }else{
            dd(100);
        }
        


        
    }
  
    
public function callBack(Request $request)
{
    $response = $request->all();

    $id = $response['order'] ?? null;

    if (!$id) {
        abort(400, 'Missing order id');
    }

    $order = Order::where('payment_reference', $id)->first();

    if (!$order) {
        abort(404);
    }

    DB::transaction(function () use ($order) {

        // ✅ Update order
        $order->update([
            "total" => $order->subtotal + $order->shipping,
            "payment_status" => "paid",
            "status" => OrderStatus::Processing,
        ]);

        // ✅ Get user cart
        $cart = Cart::where("user_id", $order->user_id)
            ->with("cart_items.product")
            ->first();

        if (!$cart || $cart->cart_items->isEmpty()) {
            // If cart is empty, you can decide to throw exception or just stop.
            // throw new \Exception("Cart is empty");
            return;
        }

        // ✅ Create order items
        foreach ($cart->cart_items as $item) {
            OrderItem::create([
                "product_id"   => $item->product_id,
                "order_id"     => $order->id,
                "product_name" => $item->product->name,
                "price"        => $item->product->sale_price,
                "quantity"     => $item->quantity,
                "total"        => $item->quantity * $item->product->sale_price,
            ]);
        }

        //  Delete cart
        $cart->delete();
    });

    // delete address id 
    Session::forget('address_id');

    return $order;
}



}






