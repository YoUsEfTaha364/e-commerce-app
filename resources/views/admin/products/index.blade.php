@extends('admin.layouts.master')
@section('products-active', 'active')
@section('main')

    <div class="p-4 sm:p-6 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-lg border border-gray-100">

            <div class="flex justify-between items-center p-4 sm:p-6 border-b border-gray-200">
                <h1 class="text-2xl font-semibold text-gray-900">Products List</h1>
                <div class="flex space-x-2">
                    <button
                        class="flex items-center space-x-1 px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        <span>Import</span>
                    </button>
                    <button
                        class="flex items-center space-x-1 px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m-3-3h6m-8-2V9a2 2 0 012-2h6a2 2 0 012 2v2"></path>
                        </svg>
                        <span>Export</span>
                    </button>
                    <button
                        class="flex items-center space-x-1 px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span><a href="{{ route('admin.products.create') }}">Add Product</a></span>
                    </button>
                </div>
            </div>

            <div class="p-4 sm:p-6 flex flex-col md:flex-row items-center space-y-3 md:space-y-0 md:space-x-4">

                <div class="flex-grow max-w-sm w-full md:w-auto relative">
                    <input type="text" placeholder="Search"
                        class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition" />
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>



                <form method="GET" action="{{ route('admin.products.index') }}" class="flex items-center gap-3">

                    <!-- Status Filter -->
                    <div class="relative">
                        <select name="status"
                            class="appearance-none flex items-center px-3 py-2 pr-8 text-sm font-medium
                   text-gray-700 bg-white border border-gray-300 rounded-lg
                   hover:bg-gray-100 transition cursor-pointer">
                            <option value="">Status</option>
                            <option {{ $filter_data["status"] && $filter_data["status"] =="active" ? "selected" : "" }} value="active" @selected(request('status') === 'active')>Active</option>
                            <option {{ $filter_data["status"] && $filter_data["status"] =="inactive" ? "selected" : "" }} value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
                        </select>

                        <!-- Arrow -->
                        <svg class="w-3 h-3 text-gray-500 absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    <!-- Category Filter -->
                    <div class="relative">
                        <select name="category"
                            class="appearance-none flex items-center px-3 py-2 pr-8 text-sm font-medium
                   text-gray-700 bg-white border border-gray-300 rounded-lg
                   hover:bg-gray-100 transition cursor-pointer">
                            <option value="">Category</option>
                            @foreach ($categories as $category)
                                <option {{ $filter_data["category_id"] && $filter_data["category_id"] ==$category->id ? "selected" : "" }} value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Arrow -->
                        <svg class="w-3 h-3 text-gray-500 absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    <!-- Filter Button -->
                    <button type="submit"
                        class="flex items-center space-x-2 px-3 py-2 text-sm font-medium
               text-gray-700 bg-white border border-gray-300 rounded-lg
               hover:bg-gray-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        <span>Filter</span>
                    </button>

                </form>

            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <th class="p-4 w-10">
                                <input type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                            </th>
                            <th class="p-4 w-60">Product Name</th>
                            <th class="p-4">Category</th>
                            <th class="p-4">quantity</th>
                            <th class="p-4">Price</th>
                            <th class="p-4">Sale_Price</th>

                            <th class="p-4 flex items-center space-x-1">
                                <span>Status</span>
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </th>
                            <th class="p-4">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- table record --}}
                        @foreach ($products as $product)
                            <tr onclick="window.location='{{ route('admin.products.show', $product) }}'"
                                class="hover:bg-gray-50 transition cursor-pointer">
                                <td class="p-4" onclick="event.stopPropagation()">
                                    <input type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                </td>

                                <td class="p-4 flex items-center space-x-3">
                                    <img src="{{ $product->images->count() > 0 ? asset('storage/products/' . $product->images->first()->path) : 'https://via.placeholder.com/50' }}"
                                        alt="{{ $product->name }}" class="w-8 h-8 rounded object-cover" />
                                    <span class="text-sm font-medium text-gray-900">{{ $product->name }}</span>
                                </td>

                                <td class="p-4 text-sm text-gray-500">{{ $product->category->name }}</td>

                                <td class="p-4 text-sm">
                                    <span class="text-amber-600 font-semibold">{{ $product->quantity }}</span>
                                </td>

                                <td class="p-4 text-sm text-gray-900">{{ $product->price }}</td>
                                <td class="p-4 text-sm text-gray-900">{{ $product->sale_price }}</td>

                                <td class="p-4">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-2.5 h-2.5 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3"></circle>
                                        </svg>
                                        {{ $product->status }}
                                    </span>
                                </td>

                                <td class="p-4 text-gray-500" onclick="event.stopPropagation()">
                                    ...
                                </td>
                            </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
