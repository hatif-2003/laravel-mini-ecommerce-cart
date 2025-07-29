@extends('landing.publiclayout')
@section('title', 'My Wishlist')

@section('content')
    <div class="max-w-7xl mx-auto py-8">
        <h2 class="text-2xl font-bold mb-6">Home / Products / <span class="text-blue-600">Favourites</span></h2>
        @if (session('success'))
            <div id="flash-message"
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 w-50 mx-auto "
                role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button onclick="dismissFlash()" class="absolute top-0 bottom-0 right-0 px-4 py-3 text-green-900">
                    &times;
                </button>
            </div>
        @endif

        @if (session('error'))
            <div id="flash-message"
                class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 mx-auto w-50"
                role="alert">
                <strong>Error!</strong> {{ session('error') }}
                <button onclick="dismissFlash()" class="absolute top-0 bottom-0 right-0 px-4 py-3 text-red-900">
                    &times;
                </button>
            </div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($wishlistItems as $item)
                <div class="bg-white border rounded-lg shadow p-4 relative">
                    <img src="{{ asset('uploads/products/' . $item->product->product_image) }}"
                        alt="{{ $item->product->product_name }}" class="w-full h-48 object-contain rounded bg-gray-100 p-2">


                    <!-- Remove Button -->
                    <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" class="absolute top-2 right-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-gray-200 p-1 rounded-full hover:bg-gray-300">
                            <i class="fa-solid fa-trash text-gray-400"></i>
                        </button>
                    </form>

                    <h3 class="text-lg font-semibold mt-3">{{ $item->product->product_name }}</h3>
                    <p class="text-gray-600">₹{{ $item->product->product_price }}</p>




                    <form action="{{ route('cart.add', $item->product->id) }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit"
                            class="w-full bg-black text-white py-2 rounded hover:bg-gray-800 flex items-center justify-center space-x-2">
                            <span>🛒</span> <span>Add to cart</span>
                        </button>
                    </form>
                </div>
            @empty
                <p class="col-span-4 text-center text-gray-500">No items in wishlist.</p>
            @endforelse
        </div>
    </div>
@endsection
