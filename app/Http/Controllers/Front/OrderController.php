<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        $orders=Order::where("user_id",Auth::user()->id)->orderBy("created_at","desc")->get();

         return view("customer.order.index",compact("orders"));
    }
    public function show(Order $order){
    //   dd($order);

         return view("customer.order.show",compact("order"));
    }
    
}
