@extends("customer.layouts.master")
@section("cart-active","bg-white shadow-md")


@section("main")
 {{-- ===========================
     address --}}

@php
    $session = $session ?? null;
    $order   = $order ?? null;

    $paymentStatus = $session?->payment_status ?? $order?->payment_status ?? '—';
    $email         = $session?->customer_details?->email ?? $order?->user?->email ?? '—';
    $amount        = $session ? number_format($session->amount_total / 100, 2) : ($order?->total ?? '—');
    $currency      = $session ? strtoupper($session->currency) : ($order?->currency ?? 'EGP');
@endphp

<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-lg p-8 text-center">

        <!-- Success Icon -->
        <div class="mx-auto mb-6 flex items-center justify-center
                    w-20 h-20 rounded-full bg-green-100 text-green-600 text-4xl">
            ✓
        </div>

        <!-- Title -->
        <h1 class="text-2xl font-bold text-gray-900 mb-2">
            Checkout Completed
        </h1>

        <!-- Subtitle -->
        <p class="text-gray-600 mb-6">
            Thank you for your purchase.
            <br>
            <span class="font-medium">
                Payment status: {{ ucfirst($paymentStatus) }}
            </span>
        </p>

        <!-- Info -->
        <div class="bg-gray-100 rounded-lg p-4 mb-6 text-left space-y-2">
            <p class="text-sm text-gray-700">
                <strong>Email:</strong> {{ $email }}
            </p>

            <p class="text-sm text-gray-700">
                <strong>Amount:</strong> {{ $amount }} {{ $currency }}
            </p>

            @if($order)
                <p class="text-sm text-gray-700">
                    <strong>Order Number:</strong> {{ $order->order_number ?? '—' }}
                </p>
            @endif
        </div>

        <p class="text-sm text-gray-600 mb-8 leading-relaxed">
            Your order is being processed.
            You will receive an email confirmation shortly.
        </p>

        <!-- Actions -->
        <div class="space-y-3">
            <a style="text-decoration: none" href="#"
               class="block w-full bg-yellow-400 hover:bg-yellow-500
                      text-black font-semibold py-3 rounded-xl transition">
                Track Order
            </a>

            <a style="text-decoration: none" href="{{ route('customer.home') }}"
               class="block w-full border border-gray-300
                      text-gray-700 font-semibold py-3 rounded-xl
                      hover:bg-gray-100 transition">
                Continue Shopping
            </a>
        </div>
    </div>
</div>

@endsection

