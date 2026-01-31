




@extends("customer.layouts.master")
{{-- @section("wishlist-active","bg-white shadow-md") --}}
@section("main")
{{-- ===========================
     MAIN CART CONTAINER
     =========================== --}}
<div class="max-w-4xl mx-auto px-4 py-10 bg-gray-50 min-h-screen">

    <h1 class="text-3xl font-semibold text-gray-900 mb-8">
        My Profile
    </h1>

    <!-- User Info -->
<div class="bg-white rounded-xl shadow-sm p-6 mb-6 relative">
    <h2 class="text-lg font-semibold mb-4">Personal Information</h2>

    <p><strong>Name:</strong> {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
    <p>
        <strong>Phone:</strong>
        @if (count(Auth::user()->addresses) > 0)
            {{ Auth::user()->addresses[0]->phone }}
        @else
            <span class="text-gray-400">Not set</span>
        @endif
    </p>

    <div class="flex items-center justify-between mt-4">
        <p class="text-sm text-gray-500">
            Member since {{ Auth::user()->created_at->diffForHumans() }}
        </p>

        <a style="text-decoration: none" href="#"
           class="text-sm font-medium text-blue-600 hover:text-blue-800 hover:underline">
            Edit
        </a>
    </div>
</div>

    <!-- Quick Links -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">Quick Access</h2>

        <div class="flex flex-wrap gap-4">
            <a style="text-decoration: none" href="{{ route("order.index") }}" class="text-blue-600 hover:underline">My Orders</a>
    <a style="text-decoration: none" href="{{ route("profile.address.index") }}" class="text-blue-600 hover:underline">My Addresses</a>
            <a style="text-decoration: none" href="{{ route("wishlist.index") }}" class="text-blue-600 hover:underline">Wishlist</a>
            <a style="text-decoration: none" href="#" class="text-blue-600 hover:underline">Change Password</a>
        </div>
    </div>

    <!-- Address -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">Default Address</h2>

             <p> {{ !Auth::user()->defaultAddress() ? ' ' : Auth::user()->defaultAddress()->address }}</p>
        <p>{{ !Auth::user()->defaultAddress() ? " " : Auth::user()->defaultAddress()->state." ," }} {{ !Auth::user()->defaultAddress() ? " " : Auth::user()->defaultAddress()->city }}</p>
        {{-- <p>Cairo, Egypt</p> --}}

        <a style="text-decoration: none" href="{{ route("profile.address.index") }}" class="text-blue-600 hover:underline mt-2 inline-block">
            Manage Addresses
        </a>
    </div>

</div>

@endsection

