@extends("customer.layouts.master")
@section("order-active","bg-white shadow-md")


@section("main")
{{-- ===========================
     MAIN CART CONTAINER
     =========================== --}}
 <div class="max-w-5xl mx-auto px-4 py-10 bg-gray-50 min-h-screen">

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-semibold text-gray-900">
            Order Details
        </h1>
        <p class="text-gray-600 mt-1">
            Order #{{$order->order_number}}
        </p>
    </div>

    <!-- Order Summary -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

            <div>
                <p class="text-sm text-gray-500">Order Date</p>
                <p class="font-medium">{{$order->created_at->format("y-m-d")}}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Order Status</p>
                <span class="inline-block mt-1 px-3 py-1 rounded-full text-sm
                             bg-blue-100 text-blue-700">
                    {{$order->status}}
                </span>
            </div>

            <div>
                <p class="text-sm text-gray-500">Payment Status</p>
                <span class="inline-block mt-1 px-3 py-1 rounded-full text-sm
                             bg-green-100 text-green-700">
                    {{$order->payment_status}}
                </span>
            </div>

        </div>
    </div>

    <!-- Shipping Address -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">
            Shipping Address
        </h2>

        <p class="font-medium text-gray-800">
            {{$order->order_address->full_name}}
        </p>
        <p class="text-gray-600">
            {{$order->order_address->address}}
        </p>
        <p class="text-gray-600">
            {{$order->order_address->state}}
            <span>{{$order->order_address->city}}</span>
        </p>
        <p class="text-gray-600 mt-1">
            Phone: {{$order->order_address->phone}}
        </p>
    </div>

    <!-- Order Items -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">
            Items in this Order
        </h2>

        <div class="divide-y">

            <!-- Item -->
            @foreach ($order->order_items as $item )
                <div class="flex justify-between py-4">
                <div>
                    <p class="font-medium text-gray-900">
                        {{ $item->product->name }}
                    </p>
                    <p class="text-sm text-gray-500">
                         quantity:{{ $item->quantity }}
                    </p>
                </div>

                <p class="font-semibold">
                    EGP {{ $item->price }}
                </p>
            </div>
            @endforeach
        

      
        </div>
    </div>

    <!-- Price Breakdown -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">
            Order Summary
        </h2>
      

        <div class="space-y-3 text-sm">

            <div class="flex justify-between">
                <span class="text-gray-600">Subtotal</span>
                <span>EGP {{$order->subtotal}}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-600">Shipping</span>
                <span class="text-green-600">{{ $order->shipping }}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-gray-600">Discount</span>
                <span>{{$order->discount}}</span>
            </div>

            <hr>

            <div class="flex justify-between text-lg font-semibold">
                <span>Total</span>
                <span>EGP {{$order->total}}</span>
            </div>

        </div>
    </div>

    <!-- Actions -->
    <div class="flex flex-col sm:flex-row gap-4">
        {{-- <button
            class="bg-yellow-400 hover:bg-yellow-500
                   text-black font-semibold px-6 py-3 rounded-xl transition">
            Download Invoice
        </button> --}}

        <a href="{{ route("order.index") }}" style="text-decoration: none"
            class="border border-gray-300 text-gray-700
                   font-semibold px-6 py-3 rounded-xl hover:bg-gray-100 transition">
            Back to Orders
        </a>
    </div>

</div>

@endsection

