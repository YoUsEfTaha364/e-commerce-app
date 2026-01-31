@extends("customer.layouts.master")
{{-- @section("cart-active","bg-white shadow-md") --}}


@section("main")
 {{-- ===========================
     address --}}

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <h2 class="text-2xl font-semibold text-gray-900">
            My Addresses
        </h2>
 @if(count($addresses)>0)
        <a style="text-decoration: none" href="{{ route('profile.address.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5
                  bg-purple-600 text-white rounded-lg
                  hover:bg-purple-700 transition">
            <span class="text-xl">+</span>
            Add New Address
        </a>
        @endif
    </div>

    @if (session('address-update'))
    <div class="alert alert-success">
        {{ session('address-update') }}
    </div>
@endif


    @if (session('address-delete'))
    <div class="alert alert-success">
        {{ session('address-delete') }}
    </div>
@endif


    {{-- Addresses Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Address Card --}}
        @if(count($addresses)>0)
        @foreach($addresses as $address)
        <div class="relative p-6 border rounded-xl bg-white shadow-sm">
            
            {{-- Default Badge --}}
            @if($address->is_default ==1)
            <span class="absolute top-4 right-4
                         text-xs bg-green-600 text-white
                         px-2 py-1 rounded-full">
                Default
            </span>
            @endif

            <h3 class="font-semibold text-gray-900">
                {{$address->full_name}}
            </h3>

            <p class="text-sm text-gray-600 mt-1">
                {{$address->phone}}
            </p>

            <p class="text-sm text-gray-700 mt-3">
                {{$address->address}}
            </p>

            {{-- Actions --}}
            <div class="flex items-center gap-4 mt-6">
                <a style="text-decoration: none" href="{{ route("profile.address.edit",$address) }}"
                   class="text-sm text-blue-600 hover:underline">
                    Edit
                </a>


                 @if($address->is_default !=1)
               <form method="POST" action="{{ route("profile.address.setDefault",$address) }}">
                    @csrf
                    
                    <button
                        class="text-sm text-blue-600 hover:underline">
                        Set as default
                    </button>
                </form>
                @endif

          <form method="POST"
      action="{{ route('profile.address.destroy',$address) }}"
      onsubmit="return confirm('Are you sure you want to delete this address?');">
    @csrf
    @method('DELETE')

    <button class="text-sm text-red-600 hover:underline">
        Delete
    </button>
</form>

            </div>
        </div>
       
   @endforeach
   @else
  <div class="text-center py-20">
        <p class="text-gray-600 mb-4">
            You have no saved addresses yet
        </p>
        <a style="text-decoration: none" href="{{ route('profile.address.create') }}"
           class="inline-block px-6 py-3 bg-purple-600 text-white rounded-lg">
            Add Your First Address
        </a>
    </div>
    
         @endif
           
        </div>

    </div>

  
    


</div>

@endsection

