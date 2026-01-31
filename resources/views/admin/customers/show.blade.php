@extends('admin.layouts.master')
@section('customers-active', 'active')
@section('main')
    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Customer Details</h1>
                <p class="text-sm text-gray-500 mt-1">View customer information and orders</p>
            </div>

            <a href="{{ route('admin.customers.index') }}"
                class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 text-sm hover:bg-gray-200">
                ← Back to Customers
            </a>
        </div>

        {{-- Customer Info --}}
        <div class="bg-white shadow rounded-xl overflow-hidden">
            <div class="p-5 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Customer Information</h2>
            </div>

            <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-500">Full Name</p>
                        <p class="font-semibold text-gray-800">{{ $user->firstname . ' ' . $user->lastname }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-semibold text-gray-800">{{ $user->email }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Phone</p>
                        <p class="font-semibold text-gray-800">
                            {{ count($user->addresses) > 0 ? $user->addresses[0]->phone : ' ' }}</p>
                    </div>
                </div>

                <div class="space-y-3">


                    <div>
                        <p class="text-sm text-gray-500">Joined At</p>
                        <p class="font-semibold text-gray-800">{{ $user->created_at }}</p>
                    </div>

                </div>

            </div>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white shadow rounded-xl overflow-hidden">
                <div class="p-5">
                    <p class="text-sm text-gray-500">Total Orders</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ count($user->orders) }}</p>
                </div>
            </div>

            <div class="bg-white shadow rounded-xl overflow-hidden">
                <div class="p-5">
                    <p class="text-sm text-gray-500">Paid Orders</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ count($user->orders) > 0 ? $user->orders()->where('payment_status', 'paid')->count() : 0 }}</p>
                </div>
            </div>

            <div class="bg-white shadow rounded-xl overflow-hidden">
                <div class="p-5">
                    <p class="text-sm text-gray-500">Total Spent</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2"> EGP
                        {{ count($user->orders) > 0 && $user->orders()->where('status', '!=', 'pending') ? '   ' . $user->orders()->where('status', '!=', 'pending')->sum("subtotal") : '  0' }}
                    </p>
                </div>
            </div>



        </div>

        {{-- Latest Orders --}}
        <div class="bg-white shadow rounded-xl overflow-hidden">
            <div class="p-5 border-b flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">Latest Orders</h2>
                    <p class="text-sm text-gray-500 mt-1">Customer recent orders</p>
                </div>

                <a href="{{ route('admin.orders.index') }}"
                    class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                    View all orders →
                </a>
            </div>

           <div class="overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-600">
            <tr>
                <th class="text-left p-4">Order</th>
                <th class="text-left p-4">Customer</th>
                <th class="text-left p-4">Total</th>
                <th class="text-left p-4">Order Status</th>
                <th class="text-left p-4">Payment</th>
                <th class="text-left p-4">Date</th>
                <th class="text-right p-4">Action</th>
            </tr>
        </thead>

        <tbody class="divide-y">

            @forelse ($user->orders as $order)

                @php
                    // Get status value even if Enum
                    $status = $order->status instanceof \BackedEnum
                        ? $order->status->value
                        : $order->status;

                    $statusClasses = [
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'processing' => 'bg-blue-100 text-blue-800',
                        'shipped' => 'bg-green-100 text-green-800',
                        'canceled' => 'bg-red-100 text-red-800',
                    ];

                    $statusBadge = $statusClasses[$status] ?? 'bg-gray-100 text-gray-800';

                    // Payment status (Enum or string)
                    $paymentStatus = $order->payment_status instanceof \BackedEnum
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

                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-semibold text-gray-800">
                        {{ $order->order_number }}
                    </td>

                    <td class="p-4 text-gray-700">
                        {{ $order->user->firstname . ' ' . $order->user->lastname }}
                    </td>

                    <td class="p-4 font-semibold text-gray-800">
                        {{ number_format($order->total, 2) }}
                    </td>

                    <td class="p-4">
                        <span class="px-3 py-1 text-xs rounded-full {{ $statusBadge }}">
                            {{ ucfirst($status) }}
                        </span>
                    </td>

                    <td class="p-4">
                        <span class="px-3 py-1 text-xs rounded-full {{ $paymentBadge }}">
                            {{ ucfirst($paymentStatus) }}
                        </span>
                    </td>

                    <td class="p-4 text-gray-500">
                        {{ $order->created_at->format('Y-m-d') }}
                    </td>

                    <td class="p-4 text-right">
                        <a href="{{ route('admin.orders.show', $order) }}"
                           class="text-indigo-600 hover:text-indigo-800 font-semibold">
                            View
                        </a>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="7" class="p-6 text-center text-gray-500">
                        No orders found.
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>
</div>

        </div>

    </div>
@endsection
