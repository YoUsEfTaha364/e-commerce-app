

@php
use App\Models\Cart;
$count=0;
 $cart=  Auth::check() ? Cart::where("user_id",Auth::user()->id)->first() : null;

  if($cart && count($cart->cart_items)>0) {
    $count=count($cart->cart_items);
  }




    
@endphp
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<header class="top-gradient-bg border-b border-gray-200 shadow-sm sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between">
            <div class="flex items-center space-x-6 w-1/3">
                <div class="text-2xl font-black text-purple-700">MLC</div>

                {{-- search part --}}


               <div class="relative flex-grow hidden md:block max-w-sm">
    <!-- Search Icon -->
    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

    <!-- Search Input -->
   <form id="searchForm" method="POST" action="{{ route('search.store') }}">
    @csrf

    <div class="relative">
        <input 
            id="search" 
            name="search"
            type="text" 
            placeholder="Search products..." 
            autocomplete="off"
            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-xl 
                   focus:border-purple-500 focus:ring-purple-500 transition duration-150"
        >

        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>

        <ul 
            id="suggestions"
            class="absolute left-0 right-0 bg-white shadow-lg rounded-lg mt-2 
                   border border-gray-200 z-50 max-h-60 overflow-y-auto hidden"
        ></ul>
    </div>
</form>


    <!-- Suggestions Box -->

               </div>

            </div>

            <div class="flex items-center space-x-6 text-sm">
                <a style="text-decoration: none" href="{{ route("order.index") }}" class="text-gray-600 hover:text-purple-600 transition duration-150 rounded-full p-2 hidden sm:flex items-center @yield("order-active") space-x-2">
                    <i class="fas fa-box-open"></i> <span class="hidden lg:inline">Orders</span>
                </a>
                <a style="text-decoration: none" href="{{ route("wishlist.index") }}" class=" @yield("wishlist-active") text-gray-600 hover:text-purple-600 transition duration-150 rounded-full p-2 hidden sm:flex items-center space-x-2">
                    <i style="color: red" class="fas fa-heart"></i> <span class="hidden lg:inline">Favourites</span>
                </a>
                <a style="text-decoration: none" href="{{ route("cart.index") }}" class="text-gray-600 hover:text-purple-600 transition duration-150 rounded-full p-2 flex items-center space-x-2 @yield("cart-active") >
                    <i class="fas fa-shopping-cart"></i> <span class="font-semibold text-purple-700">Cart</span>
                    <span class="ml-1 text-xs bg-red-500 text-white rounded-full h-5 w-5 flex items-center justify-center">{{ $count }}</span>
                    </a>
@auth
<div class="dropdown">

    <!-- Avatar Button -->
    <button
        class="btn d-flex align-items-center justify-content-center rounded-circle fw-bold text-white"
        style="width:42px;height:42px;background:#facc15;"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
    >
        {{ strtoupper(substr(Auth::user()->firstname, 0, 1)) }}
    </button>

    <!-- Dropdown Menu -->
    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2"
        style="min-width:220px;border-radius:12px;">

        <!-- User Info -->
        <li class="px-3 py-2">
            <p class="mb-0 fw-semibold text-dark">
                {{ Auth::user()->firstname }}
            </p>
            <p class="mb-0 text-muted small">
                {{ Auth::user()->email ?? 'Signed in user' }}
            </p>
        </li>

        <li><hr class="dropdown-divider my-2"></li>

        <!-- Links -->
        <li>
            <a style="text-decoration: none" href="{{ route("profile.index") }}"  class="dropdown-item d-flex align-items-center gap-2" >
                <i class="fas fa-user text-muted"></i>
                Profile
            </a>
        </li>

        <li>
            <a style="text-decoration: none" href="{{ route('order.index') }}" class="dropdown-item d-flex align-items-center gap-2" >
                <i class="fas fa-box text-muted"></i>
                My Orders
            </a>
        </li>

        <li>
            <a class="dropdown-item d-flex align-items-center gap-2" href="#">
                <i class="fas fa-cog text-muted"></i>
                Settings
            </a>
        </li>

        <li><hr class="dropdown-divider my-2"></li>

        <!-- Logout -->
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="dropdown-item d-flex align-items-center gap-2 text-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </form>
        </li>

    </ul>
</div>
@endauth

@guest
    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm me-2">Login</a>
    <a href="{{ route('register') }}" class="btn btn-purple text-white btn-sm"
       style="background-color:#6b21a8;">Register</a>
@endguest

            </div>
        </div>
    </header>
<script src="{{ asset("js/front/search.js") }}">

</script>
