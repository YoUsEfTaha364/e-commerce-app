<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $orders_count=Order::count();

        $total_revenue=Order::where("status","<>","pending")->sum("subtotal");
        $pending_orders=Order::where("status","pending")->count();

        $low_product_count=Product::where("quantity","<",5)->count();

        $latest_orders=Order::orderBy("created_at","desc")->limit(4)->get();
        

        // dd($latest_orders);

        $data=[
            "orders_count"=>$orders_count,
            "total_revenue"=>$total_revenue,
            "pending_orders"=>$pending_orders,
            "low_products"=>$low_product_count,
            "latest_orders"=>$latest_orders,
        ];
        
        
        return view("admin.dashboard.index",compact("data"));
    }
}
