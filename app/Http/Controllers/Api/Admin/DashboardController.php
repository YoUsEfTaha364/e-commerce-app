<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Services\api_response;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $orders_count = Order::count();

        $total_revenue = Order::where("status", "<>", "pending")->sum("subtotal");
        $pending_orders = Order::where("status", "pending")->count();

        $low_product_count = Product::where("quantity", "<", 5)->count();

        $latest_orders = Order::orderBy("created_at", "desc")->limit(4)->get();


        // dd($latest_orders);

        $data = [
            "orders_count" => $orders_count,
            "total_revenue" => $total_revenue,
            "pending_orders" => $pending_orders,
            "low_products" => $low_product_count,
            "latest_orders" => $latest_orders,
        ];

        return  api_response::Response(200, "", $data);
    }
}
