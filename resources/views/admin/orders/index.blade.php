@extends('admin.layouts.master')
@section('orders-active', 'active')
@section('main')

<div class="bg-white shadow rounded-xl overflow-hidden">

    {{-- Header --}}
    <div class="p-6 border-b">
        <h2 class="text-xl font-semibold text-gray-800">Orders</h2>
        <p class="text-sm text-gray-500 mt-1">Manage and track customer orders</p>
    </div>

    {{-- Filters --}}
    <div class="p-6 border-b bg-gray-50">
        <form method="POST" action="{{ route('admin.orders.filter') }}"
              class="flex flex-col md:flex-row md:items-end gap-4">
            @csrf

            <div class="w-full md:w-64">
                <label class="block text-sm font-medium text-gray-700 mb-1">Sort</label>
                <select name="sort"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <option {{$key=="latest" ? "selected" : ""}} value="latest">Latest</option>
                    <option {{$key=="min_total" ? "selected" : ""}} value="min_total">min total</option>
                    <option {{$key=="max_total" ? "selected" : ""}} value="max_total">max total</option>
                    <option {{$key=="paid_status" ? "selected" : ""}} value="paid_status">paid status</option>
                </select>
            </div>

            <div class="w-full md:w-auto">
                <button type="submit"
                        class="w-full md:w-auto px-6 py-2.5 rounded-lg bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700 transition">
                    Filter
                </button>
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-white text-gray-500 border-b">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Order #</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Customer</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Total</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Payment</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase">Date</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse ($orders as $order)
                    @php
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

                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-semibold text-gray-800">
                            {{ $order->order_number }}
                        </td>

                        <td class="px-6 py-4 text-gray-700">
                            {{ $order->user->firstname . ' ' . $order->user->lastname }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-gray-900">
                            {{ number_format($order->total, 2) }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="inline-flex px-3 py-1 text-xs rounded-full font-semibold {{ $statusBadge }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <span class="inline-flex px-3 py-1 text-xs rounded-full font-semibold {{ $paymentBadge }}">
                                {{ ucfirst($paymentStatus) }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            {{ $order->created_at->format('Y-m-d') }}
                        </td>

                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.orders.show', $order) }}"
                               class="text-indigo-600 hover:text-indigo-800 font-semibold">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                            No orders found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
