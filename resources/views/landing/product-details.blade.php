@extends('landing.publiclayout')

@section('title', 'Product Details')

@section('content')
@if (session('success'))
    <div id="flash-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 w-50 mx-auto " role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button onclick="dismissFlash()" class="absolute top-0 bottom-0 right-0 px-4 py-3 text-green-900">
            &times;
        </button>
    </div>
@endif

@if (session('error'))
    <div id="flash-message" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 mx-auto w-50" role="alert">
        <strong>Error!</strong> {{ session('error') }}
        <button onclick="dismissFlash()" class="absolute top-0 bottom-0 right-0 px-4 py-3 text-red-900">
            &times;
        </button>
    </div>
@endif
<script>
    function dismissFlash() {
        const flash = document.getElementById('flash-message');
        if(flash){
            flash.style.display = 'none';
        }
    }

    setTimeout(() => {
        dismissFlash();
    }, 3000);
</script>

    <!--
                          This example requires some changes to your config:
                          
                          ```
                          // tailwind.config.js
                          module.exports = {
                            // ...
                            theme: {
                              extend: {
                                gridTemplateRows: {
                                  '[auto,auto,1fr]': 'auto auto 1fr',
                                },
                              },
                            },
                          }
                          ```
                        -->
    <div class="bg-white py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav aria-label="Breadcrumb" class="mb-6">
                <ol class="flex items-center space-x-2 text-gray-500 text-sm">
                    <li><a href="#" class="hover:text-gray-700">Category</a></li>
                    <li>/</li>
                    <li>{{ $product->category->cat_name ?? 'No Category' }}</li>
                </ol>
            </nav>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
                <!-- Product Image -->
                <div class="border border-gray-200 rounded-lg p-4 bg-white shadow-sm">
                    <img src="{{ asset('uploads/products/' . $product->product_image) }}" alt="{{ $product->product_name }}"
                        class="rounded-lg object-cover w-70 h-[450px]">
                </div>

                <!-- Product Info -->
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $product->product_name }}</h1>
                    <p class="text-gray-500 mt-1">{{ $product->category->cat_name ?? 'No Category' }}</p>

                    <p class="text-gray-500 mt-1">
                        Stock:
                        @if ($product->stock > 0)
                            <span class="text-green-600 font-semibold">{{ $product->stock }}</span>
                        @else
                            <span class="text-red-600 font-semibold">Out of Stock</span>
                        @endif
                    </p>

                    @if ($product->stock > 0 && $product->stock <= 3)
                        <p class="text-yellow-500 mt-2 font-medium animate-pulse">
                            Hurry! Only {{ $product->stock }} left in stock.
                        </p>
                    @endif

                    <div class="mt-4">
                        @if ($product->product_discount)
                            <span class="text-3xl font-bold text-gray-900">₹{{ $product->product_discount }}</span>
                            <span class="text-lg text-gray-500 line-through ml-2">₹{{ $product->product_price }}</span>
                        @else
                            <span class="text-3xl font-bold text-gray-900">₹{{ $product->product_price }}</span>
                        @endif
                    </div>

                    <p class="mt-4 text-gray-700">{{ $product->product_description }}</p>

                    <div class="mt-6 flex space-x-3">
                        @if ($product->stock > 0)
                            <form action="{{ route('cart.add', $product->id)}}" method="POST">
                            @csrf
                            <button type="submit"
                                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                                Add to Cart
                            </button>
                            </form>
                            <form action="{{route('wishlist.add', $product->id)}}" method="POST">
                                @csrf
                            <button type="submit"
                                class="bg-pink-500 text-white px-5 py-2 rounded-lg hover:bg-pink-600 transition duration-200">
                                Wishlist
                            </button>
                            </form>
                            <button
                                class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition duration-200">
                                Check Out
                            </button>
                        @else
                            <span class="bg-red-500 text-white px-5 py-2 rounded-lg cursor-not-allowed">Out of Stock</span>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- Existing product details section here -->

    <!-- Related Products -->
    <div class=" mb-5 px-10 mt-7">
        <h2 class="text-2xl font-semibold text-gray-900 mb-6 text-center ">Related Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($relatedProducts as $related)
                <div class="border rounded-lg shadow-sm p-4 bg-white  ">
                    <img src="{{ asset('uploads/products/' . $related->product_image) }}"
                        alt="{{ $related->product_name }}" class="h-40 w-70 object-center rounded ">
                    <h3 class="mt-2 font-medium text-gray-800">{{ $related->product_name }}</h3>
                    <p class="text-gray-500 text-sm">{{ $related->category->cat_name ?? '' }}</p>
                    <p class="text-gray-900 font-bold mt-1">
                        ₹{{ $related->product_discount ?? $related->product_price }}</p>
                    <a href="{{ route('show-product', $related->id) }}"
                        class="inline-block mt-2 text-white py-2 px-2 rounded hover:bg-blue-700 text-sm border-blue-500 bg-blue-500">View
                        Product</a>
                </div>
            @endforeach
        </div>
    </div>




@endsection
