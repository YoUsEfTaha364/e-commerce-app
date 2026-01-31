<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\OrderFilterService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class OrderController extends Controller implements HasMiddleware
{
     public static function middleware(): array
    {
        return [
            "c-auth",
            new Middleware("authorize-admin:orders.update-status,orders.view")
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index(OrderFilterService $filter,$key=null)
    {

        $orders=$filter->getOrders($key);
        // dd($orders);
        return view("admin.orders.index",compact("orders","key"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        
        return view("admin.orders.show",compact("order"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }

    public function update_status(Request $request,Order $order)
    {
       
        $order->update([
            "status"=>$request->status
        ]);

        return redirect()->route("admin.orders.index");
    }

    public function filter(Request $request){
     

      
      
          return redirect()->route('admin.orders.index', $request->sort);

    }
}
