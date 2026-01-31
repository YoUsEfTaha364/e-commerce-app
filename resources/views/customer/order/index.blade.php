@extends("customer.layouts.master")
@section("order-active","bg-white shadow-md")


@section("main")
{{-- ===========================
     MAIN CART CONTAINER
     =========================== --}}
 {{-- @dd($orders) --}}
<div class="max-w-5xl mx-auto px-4 py-10 bg-gray-50 min-h-screen">

    <!-- Page Title -->
    <h1 class="text-3xl font-semibold text-gray-900 mb-8">
        My Orders
    </h1>

    <!-- Orders List -->
    <div class="space-y-6">

        <!-- Order Card -->
        @if($orders &&count($orders)>0)
        @foreach ( $orders as $order )
           <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>
                    <p class="text-sm text-gray-500">Order Number</p>
                    <p class="font-semibold text-gray-900">{{$order->order_number}}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Date</p>
                    <p class="font-medium">{{$order->created_at->format("y-m-d")}}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm
                                 bg-blue-100 text-blue-700">
                        {{$order->status}}
                    </span>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Total</p>
                    <p class="font-semibold"> EGP{{$order->total}}</p>
                </div>

                <div class="sm:text-right">
                    <a href="{{ route("order.show",$order) }}" style="text-decoration: none" class="text-blue-600 hover:underline font-medium">
                        View Details →
                    </a>
                </div>

            </div>
        </div>
        @endforeach
       @else

          <div class="min-h-[70vh] flex items-center justify-center">
                        <div class="bg-white rounded-2xl shadow-sm p-10 text-center max-w-md w-full">

                            <h2 class="text-xl font-semibold text-gray-900 mb-4">
                                Orders
                            </h2>

                            <p class="text-gray-600 mb-6">
                                you did not make any orders
                            </p>

                            <a style="text-decoration: none" href="{{ route('customer.home') }}"
                                class="inline-block bg-yellow-400 hover:bg-yellow-500
                  text-black font-semibold px-8 py-3 rounded-xl transition">
                                Go to Shopping
                            </a>

                        </div>
                    </div>
        @endif
     

  
        {{-- 
        <!-- Order Card -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                <div>
                    <p class="text-sm text-gray-500">Order Number</p>
                    <p class="font-semibold text-gray-900">ZSC-2025-000102</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Date</p>
                    <p class="font-medium">Jan 15, 2025</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Status</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm
                                 bg-red-100 text-red-700">
                        Cancelled
                    </span>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Total</p>
                    <p class="font-semibold">EGP 450</p>
                </div>

                <div class="sm:text-right">
                    <button class="text-blue-600 hover:underline font-medium">
                        View Details →
                    </button>
                </div>

            </div>
        </div> --}}

    </div>

</div>

@endsection

