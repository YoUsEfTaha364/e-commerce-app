@extends('admin.layouts.master')
@section('customers-active', 'active')
@section('main')
    <div class="space-y-6">

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Customers</h1>
                <p class="text-sm text-gray-500 mt-1">Manage your store customers</p>
            </div>
        </div>

        {{-- Filters --}}
        <div class="bg-white shadow rounded-xl overflow-hidden">
            <div class="p-5">
                <form method="post" action="{{ route("admin.customers.filter") }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    @csrf
{{-- 
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                        <input type="text" name="search" placeholder="Name, email, phone..."
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div> --}}

                  

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sort</label>
                        <select name="sort"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                             <option {{$key=="oldest" ? "selected" : ""}} value="oldest">Oldest</option>
                             
                            <option {{$key=="latest" ? "selected" : ""}} value="latest">Latest</option>
                           
                            <option {{$key=="orders_count" ? "selected" : ""}} value="orders_count">Most Orders</option>
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button type="submit"
                            class="w-full px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm hover:bg-indigo-700">
                            Filter
                        </button>
                    </div>

                </form>
            </div>
        </div>

        {{-- Customers Table --}}
        <div class="bg-white shadow rounded-xl overflow-hidden">
            <div class="p-5 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Customers List</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            
                            <th class="text-left p-4">ID</th>
                            <th class="text-left p-4">Customer</th>
                            <th class="text-left p-4">Phone</th>
                            <th class="text-left p-4">Orders</th>
                       
                            <th class="text-left p-4">Joined</th>
                            <th class="text-right p-4">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        {{-- Test Data --}}
                        @foreach ($customers as $customer)
                            <tr class="hover:bg-gray-50">
                                <td class="p-4 font-semibold">#{{ $customer->id }}</td>
                                <td class="p-4">
                                    <div class="font-semibold text-gray-800">
                                        {{ $customer->firstname . ' ' . $customer->lastname }}</div>
                                    <div class="text-xs text-gray-500">{{ $customer->email }}</div>
                                </td>


                                <td class="p-4">
                                    {{ count($customer->addresses) > 0 ? $customer->addresses[0]->phone : ' ' }}</td>



                                <td class="p-4 font-semibold">{{ count($customer->orders) > 0 ? count($customer->orders) : 0 }}</td>
                                
                                <td class="p-4 text-gray-500">{{$customer->created_at}}</td>
                                <td class="p-4 text-right">
                                    <a href="{{ route("admin.customers.show",$customer) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>

            {{-- Pagination (UI only) --}}
            <div class="p-5 border-t flex items-center justify-between">
                <p class="text-sm text-gray-500">Showing 1 to 3 of 3 customers</p>

                <div class="flex gap-2">
                    <button class="px-3 py-2 rounded-lg border text-sm text-gray-600 hover:bg-gray-50">
                        Previous
                    </button>
                    <button class="px-3 py-2 rounded-lg border text-sm text-gray-600 hover:bg-gray-50">
                        Next
                    </button>
                </div>
            </div>

        </div>

    </div>

@endsection
