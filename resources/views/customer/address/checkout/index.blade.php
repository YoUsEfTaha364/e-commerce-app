@extends("customer.layouts.master")
@section("cart-active","bg-white shadow-md")


@section("main")
 {{-- ===========================
     address --}}

     
<div class="max-w-3xl mx-auto mt-10 space-y-6">

    <!-- Add New Address -->
    <a style="text-decoration: none"
       href="{{ route('checkout.address.create') }}"
       class="flex items-center justify-center gap-2 w-full border-2 border-dashed
              border-blue-400 text-blue-600 rounded-xl py-4
              hover:bg-blue-50 transition">
        <span class="text-2xl">+</span>
        <span class="font-semibold">Add New Address</span>
    </a>

    @if (count($addresses) > 0)

        <!-- Title -->
        <h3 class="text-lg font-semibold text-gray-800">
            Saved Addresses
        </h3>

        <form method="POST" action="{{ route('checkout.address.session') }}">
            @csrf

            @foreach ($addresses as $address)
                <label
                    class="flex items-start justify-between gap-4 p-5 border rounded-xl
                           cursor-pointer transition
                           hover:border-blue-500
                           has-[:checked]:border-blue-600
                           has-[:checked]:bg-blue-50"
                >
                    <input
                        value="{{ $address->id }}"
                        type="radio"
                        name="address"
                        class="mt-2 accent-blue-600"
                        @checked($loop->first)
                    >

                    <div class="flex-1 space-y-2">
                        <div class="flex items-center gap-2">
                            <h4 class="font-semibold text-gray-900">
                                {{ $address->state }}
                            </h4>
                        </div>

                        <p class="text-sm text-gray-600">
                            {{ $address->address }}
                        </p>

                        <p class="text-sm text-gray-700 font-medium">
                            {{ $address->phone }}
                            <span class="text-xs bg-blue-600 text-white px-2 py-0.5 rounded">
                                {{ $address->full_name }}
                            </span>
                        </p>
                    </div>

                    <div class="shrink-0">
                        <div class="w-10 h-10 flex items-center justify-center
                                    rounded-full bg-gray-100 text-gray-600">
                            🏠
                        </div>
                    </div>
                </label>
            @endforeach

            <!-- Payment Buttons -->
            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <button
                    type="submit"
                    name="payment_method"
                    value="card"
                    class="w-full flex items-center justify-center gap-2
                           bg-yellow-400 hover:bg-yellow-500
                           text-black font-semibold py-4 rounded-xl transition
                           shadow-sm"
                >
                    💳 Pay with Card
                </button>

                <button
                    type="submit"
                    name="payment_method"
                    value="wallet"
                    class="w-full flex items-center justify-center gap-2
                           bg-blue-600 hover:bg-blue-700
                           text-white font-semibold py-4 rounded-xl transition
                           shadow-sm"
                >
                    📱 Pay with Wallet
                </button>
            </div>

        </form>
    @endif

</div>

@endsection

