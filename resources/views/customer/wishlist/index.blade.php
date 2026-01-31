




@extends("customer.layouts.master")
@section("wishlist-active","bg-white shadow-md")
@section("main")
{{-- ===========================
     MAIN CART CONTAINER
     =========================== --}}
<div class="container mx-auto p-6 bg-gray-50 min-h-screen">

    {{-- PAGE TITLE --}}
    <h1 class="text-3xl font-semibold mb-8 text-center">Your Wishlist</h1>

    {{-- GRID LAYOUT --}}
    <div class="max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @if($wishlist && count($wishlist->wishlist_items))

        @foreach ($wishlist->wishlist_items as $item)

        {{-- CARD WRAPPER --}}
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition p-5 flex flex-col">

            {{-- PRODUCT IMAGE --}}
            <div class="w-full h-48 flex items-center justify-center mb-4">
                <img 
                    src="{{ $item->product->images->count() > 0 
                        ? asset('storage/products/' . $item->product->images->first()->path)
                        : 'https://via.placeholder.com/200' }}"
                    alt="{{ $item->product->name }}"
                    class="object-contain h-full"
                >
            </div>

            {{-- PRODUCT INFO --}}
            <h2 class="font-semibold text-lg text-gray-800 mb-1">
                {{ $item->product->name }}
            </h2>

            <p class="text-sm text-gray-500 mb-2">
                Category: <span class="text-gray-700">{{ $item->product->category->name }}</span>
            </p>

            {{-- PRICE --}}
            <div class="mb-3">
                <span class="text-xl font-bold text-gray-900">
                    ${{ $item->product->sale_price }}
                </span>

                @if($item->product->sale_price != $item->product->price)
                    <span class="text-sm line-through text-gray-400 ml-2">
                        ${{ $item->product->price }}
                    </span>
                @endif
            </div>

            {{-- STOCK --}}
            <p class="text-sm text-green-600 mb-4">
                In Stock
            </p>

            {{-- ACTION BUTTONS --}}
            <div class="mt-auto flex space-x-3">

                {{-- ADD TO CART --}}
                <form 
                    method="POST" 
                    action="{{ route('cart.store', $item->product->id) }}" 
                    class="flex-1"
                >
                    @csrf
                    <button 
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded-lg font-medium"
                    >
                        Add to Cart
                    </button>
                </form>

                {{-- DELETE FROM WISHLIST --}}
                <form 
                    method="POST" 
                    action="{{ route('wishlist.delete', $item->id) }}" 
                >
                    @csrf
                    @method('delete')
                    <button 
                        class="bg-red-100 text-red-600 hover:bg-red-200 p-2 rounded-lg"
                        title="Remove"
                    >
                        ✕
                    </button>
                </form>

            </div>

        </div>

        @endforeach

        @else

                   <div class="min-h-[70vh] flex items-center justify-center">
                        <div class="bg-white rounded-2xl shadow-sm p-10 text-center max-w-md w-full">

                            <h2 class="text-xl font-semibold text-gray-900 mb-4">
                                Your wishlist  is empty
                            </h2>

                            <p class="text-gray-600 mb-6">
                                Looks like you haven’t added anything to your wishlist yet.
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

</div>

@endsection

