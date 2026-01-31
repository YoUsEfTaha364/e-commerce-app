@extends("customer.layouts.master")
@section("active-". $category->name," text-purple-700 border-b-2")


@section("main")
 <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <aside class="lg:col-span-3 bg-white p-6 rounded-xl shadow-lg h-fit border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Filters</h3>

                <div class="mb-6 pb-4 border-b border-gray-100">
                    <div class="flex justify-between items-center mb-2">
                        <h4 class="font-semibold text-gray-700">Price Range</h4>
                        <button class="text-xs text-gray-400 hover:text-purple-600">Reset</button>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg h-32 flex items-center justify-center text-sm text-purple-700 font-medium">
                        [Price Range Graph / Slider UI]
                    </div>
                    <div class="flex justify-between text-xs mt-2 text-gray-500">
                        <span>$20</span>
                        <span>$1130</span>
                    </div>
                    <p class="text-xs text-gray-400 mt-2">The average price is $300</p>
                </div>

                <div class="mb-6 pb-4 border-b border-gray-100">
                    <h4 class="font-semibold text-gray-700 mb-2">Star Rating</h4>
                    <div class="flex items-center space-x-2">
                        <span class="text-yellow-400 text-lg">★★★★☆</span>
                        <span class="text-sm text-gray-500">4 Stars & up</span>
                    </div>
                </div>

                <div class="mb-6 pb-4 border-b border-gray-100">
                    <div class="flex justify-between items-center mb-3">
                        <h4 class="font-semibold text-gray-700">Brand</h4>
                        <button class="text-xs text-gray-400 hover:text-purple-600">Reset</button>
                    </div>
                    <ul class="space-y-2 text-sm">
                        <li class="flex justify-between items-center">
                            <label class="flex items-center space-x-2 text-gray-600">
                                <i class="fas fa-shoe-prints text-red-500"></i>
                                <span>Adidas</span>
                            </label>
                            <input type="checkbox" checked class="rounded text-purple-600 focus:ring-purple-500">
                        </li>
                        <li class="flex justify-between items-center">
                            <label class="flex items-center space-x-2 text-gray-600">
                                <i class="fas fa-mountain text-blue-500"></i>
                                <span>Columbia</span>
                            </label>
                            <input type="checkbox" checked class="rounded text-purple-600 focus:ring-purple-500">
                        </li>
                        <li class="flex justify-between items-center">
                            <label class="flex items-center space-x-2 text-gray-600">
                                <i class="fas fa-shoe-prints text-yellow-500"></i>
                                <span>New Balance</span>
                            </label>
                            <input type="checkbox" checked class="rounded text-purple-600 focus:ring-purple-500">
                        </li>
                    </ul>
                    <a href="#" class="text-xs text-purple-600 mt-3 block hover:underline">More Brand</a>
                </div>

                <div class="mb-0">
                    <h4 class="font-semibold text-gray-700">Delivery Options</h4>
                    <p class="text-xs text-gray-400 mt-1">[Other Filter Elements]</p>
                </div>

            </aside>

            <section class="lg:col-span-9">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

                    {{-- product card --}}
                              @foreach ($products as $product)
<div class="bg-white rounded-xl shadow-lg overflow-hidden transition transform hover:scale-[1.01] hover:shadow-xl duration-300 relative border border-gray-100 group">

    <!-- Wishlist Icon -->
    <button 
        class="absolute top-3 right-3 text-gray-300 hover:text-red-500 text-xl transition duration-150 z-10 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"
        aria-label="Add to wishlist"
       
    >
        <i class="far fa-heart"></i>
    </button>

    <!-- Product Image (Clickable) -->
    <div class="h-56 bg-gray-50 flex items-center justify-center p-4">
        <a 
            href="{{ route('customer.products.show', $product->id) }}" 
            class="block w-full h-full"
            aria-label="View {{ $product->name }}"
        >
            <img 
                src="{{ $product->images->count() > 0 
                    ? asset('storage/products/' . $product->images->first()->path)
                    : 'https://via.placeholder.com/300x300?text=No+Image' }}"
                alt="{{ $product->name }}"
                class="max-h-full max-w-full object-contain transition duration-300 group-hover:scale-105"
                loading="lazy"
            >
        </a>
    </div>

    <!-- Product Info -->
    <div class="p-4">
        
        <!-- Product Name (Clickable) -->
        <a 
            href="{{ route('customer.products.show', $product->id) }}" 
            class="block"
            aria-label="View {{ $product->name }}"
        >
            <h4 class="text-base font-semibold text-gray-700 truncate mb-2 hover:text-purple-600 transition duration-150">
                {{ $product->name }}
            </h4>
        </a>

        <!-- Price and Add to Cart Button -->
        <div class="flex justify-between items-center">
            <span class="text-lg font-bold text-purple-700">
                ${{ number_format($product->price, 2) }}
            </span>
            <form 
                method="post" 
                action="{{ route('cart.store', $product->id) }}" 
                class="inline"
                onsubmit="return handleAddToCart(event, this)"
            >
                @csrf
                <button 
                    type="submit"
                    class="bg-purple-100 text-purple-600 text-sm py-1 px-3 rounded-full hover:bg-purple-200 focus:bg-purple-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transition duration-150 disabled:opacity-50 disabled:cursor-not-allowed"
                    aria-label="Add {{ $product->name }} to cart"
                >
                    <i class="fas fa-plus"></i>
                    <span class="sr-only">Add to Cart</span>
                </button>
            </form>
        </div>

        <!-- Optional: Add a short description or rating if available -->
        @if($product->description)
            <p class="text-sm text-gray-500 mt-2 line-clamp-2">
                {{ Str::limit($product->description, 100) }}
            </p>
        @endif

        <!-- Optional: Rating stars if product has ratings -->
        {{-- @if(isset($product->average_rating))
            <div class="flex items-center mt-2">
                <div class="flex text-yellow-400">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= $product->average_rating ? '' : 'text-gray-300' }}"></i>
                    @endfor
                </div>
                <span class="text-sm text-gray-500 ml-2">({{ $product->reviews_count ?? 0 }})</span>
            </div>
        @endif --}}

    </div>

</div>

@endforeach


                    <div class="md:col-span-3 text-center py-8 text-gray-500">
                        --- More Products Here (Archery, Hoodie, Shoes) ---
                    </div>

                </div>
            </section>
</div>
@endsection

