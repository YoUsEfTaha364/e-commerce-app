@extends('admin.layouts.master')
@section('dashboard-active', 'active')
@section('main')
    <div class="space-y-6">

        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- Total Orders --}}
            <div class="bg-white shadow rounded-xl overflow-hidden">
                <div class="p-5">
                    <p class="text-sm text-gray-500">Total Orders</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $data['orders_count'] }}</p>
                    <p class="text-sm text-green-600 mt-2">+12% this month</p>
                </div>
            </div>

            {{-- Total Sales --}}
            <div class="bg-white shadow rounded-xl overflow-hidden">
                <div class="p-5">
                    <p class="text-sm text-gray-500">Total Sales</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">EGP {{ $data['total_revenue'] }}</p>
                    <p class="text-sm text-green-600 mt-2">+8% this month</p>
                </div>
            </div>

            {{-- Pending Orders --}}
            <div class="bg-white shadow rounded-xl overflow-hidden">
                <div class="p-5">
                    <p class="text-sm text-gray-500">Pending Orders</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $data['pending_orders'] }}</p>
                    <p class="text-sm text-orange-600 mt-2">Needs review</p>
                </div>
            </div>

            {{-- Low Stock Products --}}
            <div class="bg-white shadow rounded-xl overflow-hidden">
                <div class="p-5">
                    <p class="text-sm text-gray-500">Low Stock Products</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $data['low_products'] }}</p>
                    <p class="text-sm text-red-600 mt-2">Restock soon</p>
                </div>
            </div>

        </div>

        {{-- Latest Orders --}}
        <div class="bg-white shadow rounded-xl overflow-hidden">
            <div class="p-5 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Latest Orders</h2>
                <p class="text-sm text-gray-500 mt-1">Recent orders summary</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="text-left p-4">Order ID</th>
                            <th class="text-left p-4">Customer</th>
                            <th class="text-left p-4">Total</th>
                            <th class="text-left p-4">Status</th>
                            <th class="text-left p-4">payment_Status</th>
                            <th class="text-left p-4">Date</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @foreach ($data['latest_orders'] as $order)
                            @php
                                $status = is_object($order->status) ? $order->status->value : $order->status;

                                $statusClasses = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'processing' => 'bg-blue-100 text-blue-800',
                                    'shipped' => 'bg-green-100 text-green-800',
                                    'canceled' => 'bg-red-100 text-red-800',
                                ];

                                $classes = $statusClasses[$status] ?? 'bg-gray-100 text-gray-800';

                                $paymentStatus = is_object($order->payment_status)
                                    ? $order->payment_status->value
                                    : $order->payment_status;

                                $paymentClasses = [
                                    'paid' => 'bg-green-100 text-green-800',
                                    'unpaid' => 'bg-red-100 text-red-800',
                                    'failed' => 'bg-red-100 text-red-800',
                                    'refunded' => 'bg-gray-100 text-gray-800',
                                ];

                                $paymentBadge = $paymentClasses[$paymentStatus] ?? 'bg-gray-100 text-gray-800';
                            @endphp


                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                    {{ $order->order_number }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $order->user->firstname . ' ' . $order->user->lastname }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-800 font-semibold">
                                    {{ $order->total }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs rounded-full {{ $classes }}">
                                        {{ $status }}
                                    </span>

                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs rounded-full {{ $paymentBadge }}">
                                        {{ $order->payment_status }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $order->created_at }}
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                        class="text-blue-600 hover:underline text-sm font-medium">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="p-5 border-t flex justify-end">
                
                    <a href="{{ route('admin.orders.index') }}"
                        class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                        View all orders →
                    </a>
              

            </div>
        </div>



    </div>
@endsection
