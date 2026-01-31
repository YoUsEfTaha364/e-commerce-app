@extends('customer.layouts.master')
@section('cart-active', 'bg-white shadow-md')


@section('main')
    {{-- ===========================
     MAIN CART CONTAINER
     =========================== --}}
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-8 bg-gray-50">

        <!-- Page Title -->
        <h1 class="text-3xl font-semibold text-gray-900 mb-8">
            Shopping Cart
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- ================= LEFT SIDE: CART ITEMS ================= --}}
            <div class="lg:col-span-8 space-y-6">

                @if ($cart && $cart->cart_items->count())

                    @foreach ($cart->cart_items as $item)
                        <div class="bg-white rounded-xl shadow-sm p-6">

                            <div class="flex flex-col sm:flex-row gap-6">

                                <!-- Product Image -->
                                <div
                                    class="w-28 h-28 sm:w-32 sm:h-32 bg-gray-100 rounded-lg
                                       flex items-center justify-center overflow-hidden">
                                    <img src="{{ $item->product->images->count() ? asset('storage/products/' . $item->product->images->first()->path) : '#' }}"
                                        alt="{{ $item->product->name }}" class="w-full h-full object-contain">
                                </div>

                                <!-- Product Details -->
                                <div class="flex-1 space-y-2">

                                    <h2 class="text-lg font-semibold text-gray-900">
                                        {{ $item->product->name }}
                                    </h2>

                                    <p class="text-sm text-gray-500">
                                        Category · {{ $item->product->category->name }}
                                    </p>

                                    <p class="text-sm text-gray-600">
                                        FREE delivery available at checkout
                                    </p>

                                    <!-- Actions -->
                                    <div class="flex flex-wrap items-center gap-4 pt-2 text-sm">

                                        <!-- Quantity -->
                                        <div class="flex items-center gap-2 border rounded-lg px-2 py-1 bg-gray-50">

                                            @if ($item->quantity > 1)
                                                <form method="post" action="{{ route('cart.decrement', $item->id) }}">
                                                    @csrf
                                                    <button
                                                        class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-200">
                                                        −
                                                    </button>
                                                </form>
                                            @else
                                                <form method="post" action="{{ route('cart.delete', $item->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button
                                                        class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-200">
                                                        🗑
                                                    </button>
                                                </form>
                                            @endif

                                            <span class="w-6 text-center font-medium">
                                                {{ $item->quantity }}
                                            </span>

                                            <form method="post" action="{{ route('cart.increment', $item->id) }}">
                                                @csrf
                                                <button
                                                    class="w-8 h-8 flex items-center justify-center rounded hover:bg-gray-200">
                                                    +
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Remove -->
                                        <form method="post" action="{{ route('cart.delete', $item->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button class="text-red-600 hover:underline">
                                                Remove
                                            </button>
                                        </form>

                                        <span class="text-gray-300">|</span>

                                        <button class="text-blue-600 hover:underline">
                                            Save for later
                                        </button>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="text-right shrink-0">
                                    <p class="text-xl font-semibold text-gray-900">
                                        EGP {{ $item->product->sale_price }}
                                    </p>

                                    @if ($item->product->sale_price != $item->product->price)
                                        <p class="text-sm text-gray-500 line-through">
                                            EGP {{ $item->product->price }}
                                        </p>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @endforeach

                    <!-- Subtotal -->
                    <div class="flex justify-end text-lg font-semibold">
                        Subtotal ({{ $cart->cart_items->count() }} items):
                        <span class="ml-2">EGP {{ $cart->subtotal }}</span>
                    </div>
                @else
                    <!-- EMPTY CART -->
                    <div class="min-h-[70vh] flex items-center justify-center">
                        <div class="bg-white rounded-2xl shadow-sm p-10 text-center max-w-md w-full">

                            <h2 class="text-xl font-semibold text-gray-900 mb-4">
                                Your cart is empty
                            </h2>

                            <p class="text-gray-600 mb-6">
                                Looks like you haven’t added anything to your cart yet.
                            </p>

                            <a style="text-decoration: none" href="{{ route('customer.home') }}"
                                class="inline-block bg-yellow-400 hover:bg-yellow-500
                  text-black font-semibold px-8 py-3 rounded-xl transition">
                                Continue Shopping
                            </a>

                        </div>
                    </div>

                @endif
            </div>

            {{-- ================= RIGHT SIDE: SUMMARY (ONLY IF CART HAS ITEMS) ================= --}}
            @if ($cart && $cart->cart_items->count())
                <div class="lg:col-span-4 space-y-6">

                    <!-- Checkout Summary -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <p class="text-lg mb-4">
                            Subtotal ({{ $cart->cart_items->count() }} items)
                        </p>

                        <p class="text-2xl font-semibold mb-6">
                            EGP {{ $cart->subtotal }}
                        </p>

                        <a style="text-decoration: none" href="{{ route('checkout.address.index') }}"
                            class="block w-full bg-yellow-400 hover:bg-yellow-500
                               text-center text-black font-semibold py-4 rounded-xl transition">
                            Proceed to Checkout
                        </a>
                    </div>

                    <!-- Free Shipping -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
                        <p class="text-green-600 font-medium">
                            ✔ Your order qualifies for FREE Shipping
                        </p>
                    </div>

                </div>
            @endif

        </div>
    </div>

@endsection
