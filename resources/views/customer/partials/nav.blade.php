 

 <nav class="border-b border-gray-200 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex space-x-6 md:space-x-8 lg:space-x-10 overflow-x-auto py-2">
                <a style="text-decoration: none" href="{{ route("customer.home") }}" class="py-2 text-sm font-medium text-gray-500 hover:text-purple-700 transition duration-150 whitespace-nowrap">All Categories</a>
               

                {{-- display categories --}}
                @foreach ( $categories as $category )
                 <a style="text-decoration: none" href="{{ route("customer.categories.show",$category->id) }}" class="py-2 @yield("active-".$category->name) text-sm font-medium text-gray-500 hover:text-purple-700 transition duration-150 whitespace-nowrap">{{ $category->name }}</a>
                @endforeach
               
                
            </div>
        </div>
    </nav>
