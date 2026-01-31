@extends("customer.layouts.master")

@section("main")
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="lg:grid lg:grid-cols-2 lg:gap-x-8">

        <div class="lg:col-span-1">
            {{-- <div class="bg-gray-100 rounded-lg overflow-hidden mb-4">
                
                <img src="/path/to/main-image.jpg" alt="Rechargeable Digital Hearing Aids with case open" class="w-full h-auto object-cover">
            </div> --}}

            <div class="flex space-x-2 overflow-x-auto pb-2">
                <div class="w-50 h-50 flex-shrink-0 border-2 border-indigo-900 rounded-md cursor-pointer">
                    <img src="{{ asset("storage/products/" . $product->images->first()->path) }}" alt="Hearing Aids View 1" class="w-full h-full object-cover rounded-md">
                </div>
                {{-- <div class="w-20 h-20 flex-shrink-0 border border-gray-300 rounded-md cursor-pointer">
                    <img src="/path/to/thumb2.jpg" alt="Hearing Aids View 2" class="w-full h-full object-cover rounded-md">
                </div> --}}
                </div>
        </div>

        <div class="mt-8 lg:mt-0 lg:col-span-1">
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
                {{$product->description}}
            </h1>

            <div class="mt-2 flex items-center">
                <div class="flex items-center">
                    <span class="text-yellow-400">★★★★★</span>
                </div>
                <p class="ml-2 text-sm text-gray-500">(44)</p>
            </div>

            <p class="text-3xl text-gray-900 mt-4 font-extrabold">${{$product->price}}</p>

            <div class="mt-6 space-y-3">
                <p class="flex items-center text-base text-gray-700">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Clear sound & noise cancellation!
                </p>
                <p class="flex items-center text-base text-gray-700">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    All-day battery life reliability!
                </p>
                <p class="flex items-center text-base text-gray-700">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Comfortable, lightweight design!
                </p>
                <p class="flex items-center text-base text-gray-700">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Easy, seamless Bluetooth pairing!
                </p>
            </div>

            <div class="mt-6 p-4 bg-white border border-gray-200 rounded-lg">
                <p class="text-sm italic text-gray-600">
                    "MagicHearing offers exceptional sound clarity and comfort with a long-lasting battery."
                </p>
                <p class="mt-2 text-xs font-semibold text-gray-800">- Claire M. ⭐⭐⭐⭐⭐</p>
            </div>


            <div class="mt-8">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                <div class="mt-1 flex items-center">
                    <button class="px-3 py-1 border border-gray-300 rounded-l-md text-gray-700 hover:bg-gray-100">-</button>
                    <input type="text" id="quantity" name="quantity" value="1" readonly class="w-12 text-center border-t border-b border-gray-300 focus:ring-0 focus:border-gray-300">
                    <button class="px-3 py-1 border border-gray-300 rounded-r-md text-gray-700 hover:bg-gray-100">+</button>
                </div>
            </div>

            <div class="mt-6 flex items-center text-sm text-gray-600">
                <svg class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                Get it between **Friday, January 10th** and **Sunday, January 12th**.
            </div>
       
            <div class="mt-6">
                    <form 
                method="post" 
                action="{{ route('cart.store', $product->id) }}" 
               
            >
                @csrf
                 <button type="submit" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10 shadow-md">
                    Add To cart
                    
                </button>
            </form>

                {{-- <button type="button" class="mt-3 w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-purple-700 hover:bg-purple-800 md:py-4 md:text-lg md:px-10 shadow-md">
                    Buy with <span class="ml-1 font-bold">shop</span><span class="ml-0.5 text-sm font-normal">Pay</span>
                </button> --}}
            </div>
            
            <p class="mt-3 text-center text-sm text-gray-500">More payment options</p>
        </div>
    </div>
</div>
@endsection

