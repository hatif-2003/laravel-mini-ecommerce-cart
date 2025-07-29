@extends('landing.publiclayout')
@section('title', 'success')
@section('content')
    @if (session($ordersuccess))
    
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 p-4">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-md text-center">
            <!-- Tick animation -->
            <div
                class="w-24 h-24 rounded-full border-4 border-green-500 flex items-center justify-center mx-auto animate-bounce">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" stroke-width="3"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-gray-800 mt-6">Order Placed Successfully!</h2>
            <p class="text-gray-600 mt-2">Thank you for your purchase. Your order has been received and is being
                processed.</p>

            <a href="{{ route('home') }}"
                class="mt-6 inline-block bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">Go to
                Home</a>
        </div>
    </div>
@else
    <div class="min-h-screen flex flex-col items-center  justify-center bg-gray-100 p-4">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-md text-center">
            <h2 class="text-2xl font-bold text-red-600">No Order Found!</h2>
            <p class="text-gray-600 mt-2">It looks like you haven't placed an order yet.</p>
            <a href="{{ route('home') }}"
                class="mt-6 inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Go to
                Home</a>
        </div>
    </div>
@endif
@endsection
