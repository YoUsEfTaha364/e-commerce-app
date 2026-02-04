

@extends("customer.layouts.master")





@section("main")
 <div class="grid grid-cols-1 lg:grid-cols-8 gap-6">

            <section class="lg:col-span-9">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

 @foreach ($products as $product)
<div class="bg-white rounded-xl shadow-lg overflow-hidden transition transform hover:scale-[1.01] hover:shadow-xl duration-300 relative border border-gray-100 group">

    <!-- Wishlist Icon -->
    <form method="post" action="{{ route("wishlist.store",$product) }}">
        @csrf
    <button type="submit"
        class="absolute top-3 right-3 text-gray-300 hover:text-red-500 text-xl transition duration-150 z-10 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"
        aria-label="Add to wishlist"
       
    >
            <i class="far fa-heart"></i>
    </button>


    </form>

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
                    : "#" }}"
                alt="no"
                class="max-h-full max-w-full object-contain transition duration-300 group-hover:scale-105"
                loading="lazy"
            >
        </a>
    </div>

    <!-- Product Info -->
    <div class="p-4">
        
        <!-- Product Name (Clickable) -->
        <a 
            href="{{ route('customer.products.show', $product) }}" 
            class="block"
            aria-label="View {{ $product->name }}"
        >
            <h4  class="text-base  font-semibold text-gray-700  mb-2  transition duration-150">
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
                action="{{ route('cart.store', $product) }}" 
                class="inline"
              
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

