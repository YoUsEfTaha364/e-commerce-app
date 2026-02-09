<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\api_response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

use Illuminate\Routing\Controllers\HasMiddleware;
class OrderController extends Controller
{

        public static function middleware(): array
    {
        return [
            "c-sanctum:sanctum",
            "is-admin",

            new Middleware("authorize-api:orders.update_status,orders.view,orders.cancel"),
        ];
    }
      public function index()
    {
        $orders = Order::with([
            'user',
            'order_items',
            'order_address',
        ])
        ->latest()
        ->paginate(15);

        return api_response::Response(
            200,
            'Orders fetched successfully',
            $orders
        );
    }


    public function show($id)
{
    $order = Order::with([
        'user',
        'order_items.product',
        'order_address',
    ])->find($id);

    if (! $order) {
        return api_response::Response(
            404,
            'Order not found',
            null
        );
    }

    return api_response::Response(
        200,
        'Order details fetched successfully',
        $order
    );
}


public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => ['required', 'in:pending,paid,shipped,delivered,cancelled'],
    ]);

    $order = Order::find($id);

    if (! $order) {
        return api_response::Response(404, 'Order not found', null);
    }

    $currentStatus  =$order->status->value;
    $newStatus     = $request->status;

    // 🔒 Allowed transitions map
    $allowedTransitions = [
        'pending'   => ['processing', 'cancelled'],
        'processing'      => ['shipped'],
        'shipped'   => ['delivered'],
        'delivered' => [],
        'cancelled' => [],
    ];

    
    if (! in_array($newStatus, $allowedTransitions[$currentStatus])) {
        return api_response::Response(
            422,
            "Cannot change status from {$currentStatus} to {$newStatus}",
            null
        );
    }

    $order->update([
        'status' => $newStatus,
    ]);

    return api_response::Response(
        200,
        'Order status updated successfully',
        $order
    );
}


}
