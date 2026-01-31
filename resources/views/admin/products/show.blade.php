@extends("admin.layouts.master")
@section("products-active","active")


@section("main")


<div class="p-4 sm:p-6 bg-gray-50 min-h-screen">
  <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg border border-gray-100 p-6 sm:p-8">

    <!-- Header -->
                @if (session('change-status'))
                <div class="alert alert-success">
                    {{ session('change-status') }}
                </div>
            @endif
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-xl font-semibold text-gray-800">View Product</h2>

      <a
        href="#"
        class="px-4 py-2 rounded-lg bg-gray-700 text-white text-sm font-medium hover:bg-gray-800 transition"
      >
        Back
      </a>
    </div>

    <!-- Product Card -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Left: Image -->
      <div class="border border-gray-100 rounded-xl overflow-hidden bg-gray-50">
        <div class="h-72 w-full flex items-center justify-center">
          <img
           src="{{ $product->images->count() > 0 ? asset('storage/products/' . $product->images->first()->path) : 'https://via.placeholder.com/50' }}"
                                        alt="{{ $product->name }}"
            class="w-full h-full object-cover"
          />
        </div>

        <div class="p-4 border-t border-gray-100 bg-white">
          <p class="text-sm text-gray-600">
            Main product image preview
          </p>
        </div>
      </div>

      <!-- Right: Info -->
      <div class="space-y-5">
        <!-- ID -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Product ID</label>
          <input
            readonly
            type="text"
            value="{{$product->id}}"
            class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none"
          />
        </div>

        <!-- Name -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
          <input
            readonly
            type="text"
            value="{{$product->name}}"
            class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none"
          />
        </div>

        <!-- Category -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
          <input
            readonly
            type="text"
            value="{{$product->category->name}}"
            class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none"
          />
        </div>

        <!-- Status + Quantity -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <div class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 flex items-center justify-between">
              <span class="text-sm text-gray-800">{{$product->status}}</span>
              <span class="px-3 py-1 text-xs rounded-full{{$product->status=="active" ? " bg-green-100" : "bg-red-100" }} {{$product->status=="active" ? " text-green-800" : " text-red-800" }} ">{{$product->status}}</span>
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
            <input
              readonly
              type="text"
              value="{{$product->quantity}}"
              class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none"
            />
          </div>
        </div>

        <!-- Price + Sale Price -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
            <input
              readonly
              type="text"
              value="{{$product->price}}"
              class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none"
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Sale Price</label>
            <input
              readonly
              type="text"
              value="{{$product->sale_price}}"
              class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none"
            />
          </div>
        </div>
      </div>
    </div>

    <!-- Description -->
    <div class="mt-8">
      <label class="block text-sm font-medium text-gray-700 mb-2">
        Description
      </label>

      <div class="w-full min-h-[120px] px-4 py-3 rounded-lg border border-gray-200 bg-gray-50 text-sm text-gray-700 leading-relaxed">
    {{$product->description}}
      </div>
    </div>

    <!-- Meta -->
    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Created At</label>
        <input
          readonly
          type="text"
          value="{{$product->created_at}}"
          class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none"
        />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Updated At</label>
        <input
          readonly
          type="text"
          value="{{$product->updated_at}}"
          class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none"
        />
      </div>
    </div>

    <!-- Actions -->
    <div class="mt-8 flex items-center gap-3">
      <a
        href="{{ route("admin.products.edit",$product) }}"
        class="px-5 py-2.5 rounded-lg bg-green-600 text-white text-sm font-medium hover:bg-green-700 transition"
      >
        Edit Product
      </a>



      <form method="post" action="{{ route("admin.products.change-status",$product) }}">
        @csrf

      <button
        type="submit"
        
        class="px-5 py-2.5 rounded-lg {{ $product->status == "active" ? "bg-red-600" : "bg-green-600" }} text-white text-sm font-medium hover:bg-red-700 transition"
      >
        Mark as @if ($product->status == "active")
                  {{ "inactive" }}
                  @else
                  {{ "active" }}
        
              @endif
      </button>
      </form>

      
      <form action="">

      <button
        type="button"
        class="px-5 py-2.5 rounded-lg bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition"
      >
        Delete Product
      </button>
      </form>
    </div>

  </div>
</div>

@endsection