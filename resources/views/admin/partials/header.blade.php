<header class="bg-white shadow-md p-4 sticky top-0 z-10">
    <div class="flex items-center justify-between max-w-full lg:max-w-7xl mx-auto">

        <h1 class="text-xl font-semibold text-gray-800"></h1>

        <div class="flex items-center space-x-4">

           

            <button class="relative p-2 text-gray-500 hover:text-purple-600 rounded-full transition">
                <i class="fas fa-bell text-lg"></i>
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs px-1 rounded-full">3</span>
            </button>

            <div class="flex items-center space-x-2 border-l pl-4">
          @auth('admin')
<div class="flex items-center gap-4">
    
    <span class="font-medium text-gray-700">
        {{ Auth::guard('admin')->user()->name }}
    </span>

    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button 
            type="submit"
            class="px-4 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm rounded-md transition">
            Logout
        </button>
    </form>

</div>
@endauth

                
            </div>

        </div>

    </div>
</header>



