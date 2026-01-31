@extends('admin.layouts.master')
@section('products-active', 'active')


@section('main')

    <div class="p-4 sm:p-6 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg border border-gray-100 p-6 sm:p-8">

            <!-- Header -->
            @if (session('update-prodcut'))
                <div class="alert alert-success">
                    {{ session('update-prodcut') }}
                </div>
            @endif

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Edit Product</h2>

                <a href="{{ route('admin.products.index') }}"
                    class="px-4 py-2 rounded-lg bg-gray-700 text-white text-sm font-medium hover:bg-gray-800 transition">
                    Back
                </a>
            </div>


            @if (session('update-prodcut'))
                <div class="alert alert-success">
                    {{ session('update-prodcut') }}
                </div>
            @endif


            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Product Card -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Left: Image -->
                    <div class="border border-gray-100 rounded-xl overflow-hidden bg-gray-50">
                        <div class="h-72 w-full flex items-center justify-center">
                            <img src="{{ $product->images->count() > 0 ? asset('storage/products/' . $product->images->first()->path) : 'https://via.placeholder.com/500' }}"
                                alt="{{ $product->name }}" class="w-full h-full object-cover" />
                        </div>

                        <div class="p-4 border-t border-gray-100 bg-white space-y-2">
                            <p class="text-sm text-gray-600">Main product image preview</p>

                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Change Image (optional)
                            </label>

                            <input type="file" name="image"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none" />

                            @error('image')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Right: Info -->
                    <div class="space-y-5">

                        <!-- ID -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Product ID</label>
                            <input readonly type="text" value="{{ $product->id }}"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none" />
                        </div>

                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none" />

                            @error('name')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>

                            <select name="category_id"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none">
                                <option value="">-- Select Category --</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status + Quantity -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>

                                <select name="status"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none">
                                    <option value="active" @selected(old('status', $product->status) === 'active')>Active</option>
                                    <option value="inactive" @selected(old('status', $product->status) === 'inactive')>Inactive</option>
                                </select>

                                @error('status')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                                <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none" />

                                @error('quantity')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Price + Sale Price -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                                <input type="number" step="0.01" name="price"
                                    value="{{ old('price', $product->price) }}"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none" />

                                @error('price')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Sale Price</label>
                                <input type="number" step="0.01" name="sale_price"
                                    value="{{ old('sale_price', $product->sale_price) }}"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none" />

                                @error('sale_price')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Description -->
                <div class="mt-8">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>

                    <textarea name="description" rows="5"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 bg-gray-50 text-sm text-gray-700 leading-relaxed outline-none">{{ old('description', $product->description) }}</textarea>

                    @error('description')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Meta -->
                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Created At</label>
                        <input readonly type="text" value="{{ $product->created_at }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Updated At</label>
                        <input readonly type="text" value="{{ $product->updated_at }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none" />
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 flex items-center gap-3">
                    <button type="submit"
                        class="px-5 py-2.5 rounded-lg bg-green-600 text-white text-sm font-medium hover:bg-green-700 transition">
                        Update Product
                    </button>

                    <a href="{{ route('admin.products.show', $product->id) }}"
                        class="px-5 py-2.5 rounded-lg bg-gray-700 text-white text-sm font-medium hover:bg-gray-800 transition">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

@endsection
