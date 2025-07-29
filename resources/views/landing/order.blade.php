@extends('landing.publiclayout')
@section('title', 'order')
@section('content')
    <section class="bg-white py-10 antialiased dark:bg-gray-900 md:py-16">
        <form id="paymentForm" action="{{ route('place-order') }}" method="POST" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            @csrf
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Progress Bar -->
            <ol class="flex items-center w-full max-w-2xl mx-auto mb-8 text-sm font-medium text-gray-500 sm:text-base">
                <li class="flex items-center text-purple-700 dark:text-purple-500">
                    <svg class="w-4 h-4 mr-2 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2" d="M8.5 11.5 11 14l4-4" />
                    </svg>
                    Cart
                    <span class="hidden sm:inline-block mx-4">/</span>
                </li>
                <li class="flex items-center text-purple-700 dark:text-purple-500">
                    <svg class="w-4 h-4 mr-2 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2" d="M8.5 11.5 11 14l4-4" />
                    </svg>
                    Checkout
                    <span class="hidden sm:inline-block mx-4">/</span>
                </li>
                <li class="flex items-center text-gray-600 dark:text-gray-400">
                    <svg class="w-4 h-4 mr-2 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2" d="M8.5 11.5 11 14l4-4" />
                    </svg>
                    Order Summary
                </li>
            </ol>

            <div class="lg:flex lg:gap-12 xl:gap-16">
                <!-- Left: Delivery + Payment -->
                <div class="flex-1 space-y-8">
                    <!-- Delivery Details -->
                    <div class="bg-white shadow-xl rounded-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Delivery Details</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-600">Full Name</label>
                                <input type="text" name="name"
                                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-600"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-600">Phone</label>
                                <input type="text" name="phone"
                                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-600"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-600">City</label>
                                <input type="text" name="city"
                                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-600"
                                    value="{{ old('city') }}">
                                @error('city')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-600">State</label>
                                <input type="text" name="state"
                                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-600"
                                    value="{{ old('state') }}">
                                @error('state')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-gray-600">Pincode</label>
                                <input type="text" name="pincode"
                                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-600"
                                    value="{{ old('pincode') }}">
                                @error('pincode')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-gray-600">Full Address</label>
                                <textarea name="address" rows="4"
                                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-600">{{ old('address') }}</textarea>
                                @error('address')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Payment -->
                    <div class="bg-white shadow-xl rounded-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4">Payment Method</h2>
                        <input type="hidden" name="payment_id" id="payment_id">


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:border-purple-500">
                                <input type="radio" name="payment_method" value="Online" class="payment-method h-5 w-5"
                                    id="onlineRadio">
                                <span class="ml-3 text-gray-800 font-medium">Online Payment</span>
                            </label>
                            <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:border-purple-500">
                                <input type="radio" name="payment_method" value="COD" class="payment-method h-5 w-5"
                                    id="codRadio">
                                <span class="ml-3 text-gray-800 font-medium">Cash On Delivery</span>
                            </label>
                        </div>
                        @error('payment_method')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Right: Order Summary -->
                <div class="mt-8 lg:mt-0 lg:max-w-xs xl:max-w-md w-full">
                    <div class="bg-white shadow-xl rounded-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Order Summary</h2>
                        @php
                            $subtotal = 0;
                            $totalDiscount = 0;
                        @endphp
                        <div class="space-y-4">
                            @foreach ($cartItems as $item)
                                @php
                                    $original = $item->product->product_price;
                                    $discounted = $item->product->product_discount ?? $original;
                                    $qty = $item->quantity;
                                    $itemTotal = $discounted * $qty;
                                    $itemDiscount = ($original - $discounted) * $qty;
                                    $subtotal += $original * $qty;
                                    $totalDiscount += $itemDiscount;
                                @endphp
                                <div class="flex justify-between border-b pb-2">
                                    <div>
                                        <p class="font-medium text-gray-800">{{ $item->product->product_name }}</p>
                                        <p class="text-sm text-gray-500">Qty: {{ $qty }}</p>
                                        <div class="text-sm">
                                            @if ($item->product->product_discount)
                                                <span class="line-through text-gray-400">₹{{ $original }}</span>
                                                <span class="ml-2 text-green-600 font-semibold">₹{{ $discounted }}</span>
                                            @else
                                                <span class="text-gray-800">₹{{ $original }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-right font-medium text-gray-700">
                                        ₹{{ $itemTotal }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6 border-t pt-4 space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span>Subtotal:</span>
                                <span>₹{{ $subtotal }}</span>
                            </div>
                            <div class="flex justify-between text-green-600">
                                <span>Discount:</span>
                                <span>- ₹{{ $totalDiscount }}</span>
                            </div>
                            <div class="flex justify-between font-semibold text-lg border-t pt-2">
                                <span>Total:</span>
                                <span>₹{{ $subtotal - $totalDiscount }}</span>
                            </div>
                            <input type="hidden" name="total_price" value="{{ $subtotal - $totalDiscount }}">
                        </div>
                        <div class="mt-6">
                            <button type="submit" id="payBtn"
                                class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                                Place Order
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </form>


    </section>
      @php
            $totalAmount = 0;
            foreach (auth()->user()->cart as $item) {
                $price = $item->product->product_discount ?? $item->product->product_price;
                $totalAmount += $price * $item->quantity;
            }
            Log::info('Calculated total amount:', ['totalAmount' => $totalAmount]);
        @endphp


 
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const payBtn = document.getElementById('payBtn');
            const codRadio = document.getElementById('codRadio');
            const onlineRadio = document.getElementById('onlineRadio');
            const form = document.getElementById('paymentForm');

            payBtn.addEventListener('click', function(event) {
                if (onlineRadio.checked) {
                    event.preventDefault(); // Prevent default form submission

                    fetch("{{ route('razorpay.order') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                amount:   {{ $subtotal - $totalDiscount }}, // 100 paisa = ₹1
                                name: document.querySelector('input[name="name"]').value
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            var options = {
                                "key": "{{ env('RAZORPAY_KEY') }}", // Replace with your Razorpay Key
                                "amount": data.amount,
                                "currency": "INR",
                                "name": "{{env('APP_NAME')}}",
                                "description": "Payment",
                                "order_id": data.order_id,
                                "handler": function(response) {
                                    // Set payment_id hidden input value
                                    document.getElementById('payment_id').value = response
                                        .razorpay_payment_id;

                                    // Change form action and submit
                                    form.action = "{{ route('order.store') }}";
                                    form.submit();
                                },
                                "theme": {
                                    "color": "#F37254"
                                }
                            };
                            var rzp = new Razorpay(options);
                            rzp.open();
                        })
                        .catch(error => {
                            console.error("Razorpay order error:", error);
                            alert("Something went wrong while creating Razorpay order.");
                        });
                }
            });
        });
    </script>



@endsection
