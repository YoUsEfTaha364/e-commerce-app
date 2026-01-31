@extends("admin.layouts.master")
@section("orders-active","active")
@section("main")

<div class="max-w-5xl mx-auto space-y-6">

    <!-- Header -->
    <div class="bg-white rounded-xl shadow p-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">
                Order #{{$order->order_number}}
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                {{$order->created_at}}
            </p>
        </div>

        <span class="px-4 py-2 text-sm rounded-full bg-blue-100 text-blue-700 font-medium">
           {{$order->status}}
        </span>
    </div>

    <!-- Customer & Address -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Customer Info -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Customer Information</h2>

            <p><strong>Name:</strong> {{$order->user->firstname." ".$order->user->lastname}}</p>
            <p><strong>Email:</strong> {{$order->user->email}}</p>
            <p><strong>Phone:</strong> {{$order->order_address->phone}}</p>
        </div>

        <!-- Shipping Address -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold mb-4">Shipping Address</h2>

            <p> {{$order->order_address->address}}</p>
            <p>{{$order->order_address->city}}</p>
            <p>{{$order->order_address->state}}</p>
        </div>
    </div>

    <!-- Order Items -->
    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="p-6 border-b">
            <h2 class="text-lg font-semibold">Order Items</h2>
        </div>

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Product
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase">
                        Qty
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">
                        Price
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase">
                        Total
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 bg-white">
                @foreach ($order->order_items as $item )
                         <tr>
                    <td class="px-6 py-4 text-sm text-gray-800">
                       {{ $item->product->name}}
                    </td>
                    <td class="px-6 py-4 text-center text-sm">
                         {{ $item->quantity}}
                    </td>
                    <td class="px-6 py-4 text-right text-sm">
                        {{ $item->product->sale_price}}
                    </td>
                    <td class="px-6 py-4 text-right text-sm font-semibold">
                        {{ $item->total}}
                    </td>
                </tr>

                @endforeach
       
              
            </tbody>
        </table>
    </div>

    <!-- Order Summary -->
    <div class="bg-white rounded-xl shadow p-6 max-w-md ml-auto">
        <h2 class="text-lg font-semibold mb-4">Order Summary</h2>

        <div class="space-y-2 text-sm">
            <div class="flex justify-between">
                <span>Subtotal</span>
                <span> {{ $order->subtotal}} EGP</span>
            </div>

            <div class="flex justify-between">
                <span>Shipping</span>
                <span>{{ $order->shipping}} EGP</span>
            </div>

            <div class="border-t pt-2 flex justify-between font-semibold text-base">
                <span>Total</span>
                <span>{{ $order->total}} EGP</span>
            </div>
        </div>
    </div>

    <!-- Admin Actions -->
    <div class="flex gap-3 justify-end">


    <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="flex gap-2">
        @csrf
  

        <button type="submit" value="shipped" name="status"
            class="px-4 py-2 rounded-lg bg-green-600 text-white text-sm hover:bg-green-700">
            Mark as Shipped
        </button>

        <button type="submit" value="canceled" name="status"
            class="px-4 py-2 rounded-lg bg-red-600 text-white text-sm hover:bg-red-700">
            Cancel Order
        </button>
    </form>



    </div>

</div>

@endsection