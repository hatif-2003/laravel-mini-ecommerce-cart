@extends('landing.publiclayout')
@section('title')
@section('content')

    <x-Banner-Component />
    <!-- Hot Collection -->
    <section class="p-8 max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-center mb-8">Hot Collection</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow hover:scale-105 transform transition p-4">
                <img src="https://picsum.photos/seed/unique/300/200
                              " alt="Milford Collection"
                    class="rounded mb-4">
                <h3 class="text-xl font-semibold text-center">Milford Collection</h3>
            </div>
            <div class="bg-white rounded-xl shadow hover:scale-105 transform transition p-4">
                <img src="https://picsum.photos/seed/unique/300/200
                     " alt="Mozart Collection"
                    class="rounded mb-4">
                <h3 class="text-xl font-semibold text-center">Mozart Collection</h3>
            </div>
            <div class="bg-white rounded-xl shadow hover:scale-105 transform transition p-4">
                <img src="https://picsum.photos/300/200?random=1
" alt="Massif Collection" class="rounded mb-4">
                <h3 class="text-xl font-semibold text-center">Massif Collection</h3>
            </div>
        </div>
    </section>

    <section class="p-8 max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-center mb-8">New Launches</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach ($products as $product)
                <div
                    class="bg-white border border-gray-200 rounded-lg shadow-sm p-3 flex flex-col justify-between h-full  transform transition-transform duration-300 hover:-translate-y-2 hover:shadow-lg">

                    <a href="#">
                        <img class="rounded-lg mx-auto h-36 object-contain"
                            src="{{ asset('uploads/products/' . $product->product_image) }}"
                            alt="{{ $product->product_name }}">
                    </a>

                    <div class="mt-3 flex-grow flex flex-col justify-between">
                        <div>
                            <h5 class="text-md font-semibold text-gray-800">{{ $product->product_name }}</h5>
                            <p class="text-xs text-gray-500">{{ $product->category->cat_name ?? 'No Category' }}</p>

                            <div class="flex items-center space-x-1 my-1">
                                @for ($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 text-yellow-300" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044...Z" />
                                    </svg>
                                @endfor
                            </div>

                            <div class="mt-1">
                                @if ($product->product_discount)
                                    <span class="text-lg font-bold text-green-600">₹{{ $product->product_discount }}</span>
                                    <span class="text-sm text-gray-500 line-through">₹{{ $product->product_price }}</span>
                                @else
                                    <span class="text-lg font-bold text-gray-900">₹{{ $product->product_price }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mt-3">
                       

                                <a href="{{ route('show-product', $product->id) }}"
                                    class="w-full inline-block text-center bg-blue-600 text-white text-sm font-medium py-2 rounded-lg shadow hover:bg-blue-700 hover:shadow-md transition duration-200">
                                    View
                                </a>
                          
                               
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>



@endsection
