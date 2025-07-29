<div>
    <!-- It is never too late to be what you might have been. - George Eliot -->
    <nav class="bg-gray-100 p-4 flex items-center shadow-sm mt-3 relative z-50">
    <div class="inline-flex space-x-4">
        @foreach ($categories as $cat)
            <div class="relative group">
                <a href="{{ route('category-products', $cat->id) }}"
                   class="border border-black px-4 py-2 rounded-full text-gray-700 hover:text-black hover:bg-gray-200 transition duration-300">
                    {{ $cat->cat_name }}
                </a>

                <!-- Dropdown -->
                <div
                    class="absolute left-0 top-full mt-2 w-72 bg-white border rounded shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity duration-300 ease-in-out z-50">
                    
                    @forelse ($cat->products as $product)
                        <a href="#"
                           class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-black transition duration-200">
                            {{ $product->product_name }}
                        </a>
                        <hr>
                    @empty
                        <span class="block px-4 py-2 text-gray-400">No Products</span>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
</nav>
</div>