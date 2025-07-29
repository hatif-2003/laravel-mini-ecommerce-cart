@extends('landing.publiclayout')
@section('title', 'Cart')
@section('content')
    <div class="container mx-auto mt-10 px-4">
        <h2 class="text-2xl font-bold mb-6">Shopping Cart</h2>
        @if ($cartItems->isEmpty())
            <div class="text-center py-20 bg-white rounded shadow-sm">
                <h3 class="text-lg font-semibold text-gray-700">Your cart is empty 🛒</h3>
                <p class="text-gray-500 mt-2">Looks like you haven't added anything yet.</p>
                <a href="{{ route('home') }}"
                    class="mt-4 inline-block bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700">Continue
                    Shopping</a>
            </div>
        @else
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items -->
                <div class="flex-1 space-y-6">
                    @foreach ($cartItems as $item)
                        <div class="flex items-center justify-between bg-white p-4 rounded shadow-sm border">
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset('uploads/products/' . $item->product->product_image) }}"
                                    alt="{{ $item->product->product_name }}" class="w-24 h-24 rounded">

                                <div>
                                    <h3 class="text-lg font-medium">{{ $item->product->product_name }}</h3>
                                    <p class="text-gray-500">{{ $item->product->category->cat_name ?? '' }}</p>
                                    <p class="text-gray-700 font-semibold">
                                        ₹{{ $item->product->product_discount ?? $item->product->product_price }}
                                    </p>
                                    <p class="text-green-500 mt-1">In Stock</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-2">
                                <form action="{{ route('cart.decrease', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-2 py-1 bg-gray-300 rounded">-</button>
                                </form>

                                <span>{{ $item->quantity }}</span>

                                <form action="{{ route('cart.increase', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-2 py-1 bg-gray-300 rounded"
                                        {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>+</button>
                                </form>
                            </div>

                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500 text-xl"><i
                                        class="fa-solid fa-trash text-gray-400"></i></button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <!-- Order Summary -->
                <div class="w-full lg:w-1/3 mb-3  bg-white p-6 rounded shadow-sm border h-fit">
                    <h3 class="text-xl font-bold mb-3">Order summary</h3>

                    <div class="flex justify-between py-2 border-b">
                        <span>Subtotal</span>
                        <span>₹{{ $totalPrice }}</span>
                    </div>

                    <div class="flex justify-between py-2 border-b">
                        <span>Shipping estimate</span>
                        <span>₹0.00</span> {{-- If you want dynamic shipping cost, add logic --}}
                    </div>

                    <div class="flex justify-between py-2 border-b">
                        <span>Tax estimate</span>
                        <span>₹0.00</span> {{-- Add tax logic if needed --}}
                    </div>

                    <div class="flex justify-between py-2 font-bold text-lg">
                        <span>Order total</span>
                        <span>₹{{ $totalPrice }}</span>
                    </div>
                    <div class="flex justify-center items-center ">
                        <a href="{{ route('order.index') }}"
                            class="mt-4 w-full text-center p-2  bg-purple-600 text-white py-2 rounded hover:bg-purple-700">Checkout</a>
                    </div>


                </div>
            </div>
            @endif
    </div>

@endsection
