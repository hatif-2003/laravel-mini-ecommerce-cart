@extends('landing.publiclayout')
@section('title', 'Category Products')
@section('content')
<h2 class="text-2xl font-bold mb-6 flex justify-center mt-5 underline text-grey-700 ">{{ $category->cat_name }} Products</h2>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse ($category->products as $product)
        <div class="bg-white rounded-lg shadow hover:shadow-md transition p-4 flex flex-col">
            <img src="{{ asset('uploads/products/' . $product->product_image) }}" 
                 alt="{{ $product->product_name }}" 
                 class="h-40 object-contain mb-4 rounded">

            <h3 class="text-lg font-semibold mb-1">{{ $product->product_name }}</h3>
            <p class="text-gray-500 text-sm mb-2">{{ Str::limit($product->product_description, 60) }}</p>
            
            <div class="flex items-center justify-between mt-auto">
                <span class="font-bold text-blue-600">₹{{ number_format($product->product_price) }}</span>

                <a href="{{ route('show-product', $product->id) }}" 
                   class="text-sm bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">
                    View
                </a>
            </div>
        </div>
    @empty
        <p>No Products in this category.</p>
    @endforelse
</div>


@endsection