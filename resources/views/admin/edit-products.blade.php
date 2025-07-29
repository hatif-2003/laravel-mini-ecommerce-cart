@extends('admin.adminlayout')
@section('title', 'Category ')
@section('content')
    <div class="flex min-h-screen pt-16">
        <x-admin-sidebar />


        <!-- Content -->
        <div class="flex-1 ml-0 md:ml-64">
            <header class="bg-white shadow p-4 flex items-center justify-between">
                <button class="md:hidden text-gray-600 focus:outline-none" id="menu-btn">
                    &#9776;
                </button>
                <h1 class="text-2xl font-semibold">Insert Products</h1>


            </header>

            <main class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @if (session('success'))
                        <div id="flash-message-success"
                            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"
                                onclick="document.getElementById('flash-message-success').remove()">&times;</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <strong class="font-bold">Whoops! Something went wrong:</strong>
                            <ul class="list-disc pl-5 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif



                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
                        class="bg-white p-6 rounded shadow-md space-y-4 max-w-lg mx-auto">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="category" class="block text-gray-700 font-bold mb-2">Category</label>
                            <select name="category_id" id="category" class="w-full p-2 border border-gray-300 rounded">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->cat_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Product Name</label>
                            <input type="text" name="product_name" class="w-full p-2 border border-gray-300 rounded"
                                value="{{ $product->product_name }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Description</label>
                            <textarea name="product_description" class="w-full p-2 border border-gray-300 rounded">{{ $product->product_description }}</textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Price</label>
                            <input type="number" name="product_price" class="w-full p-2 border border-gray-300 rounded"
                                step="0.01" value="{{ $product->product_price }}">
                        </div>
                          <div>
                            <label class="block text-gray-700 font-bold mb-2">Stock</label>
                            <input type="number" name="stock" class="w-full p-2 border border-gray-300 rounded"
                                step="0.01" value="{{ $product->stock }}">
                            @error('stock')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Discount Price</label>
                            <input type="number" name="product_discount" class="w-full p-2 border border-gray-300 rounded"
                                step="0.01" value="{{ $product->product_discount }}">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Product Image</label>

                            @if ($product->product_image)
                                <div class="mb-3">
                                    <span class="block text-sm text-gray-500">Current Image:</span>
                                    <img src="{{ asset('uploads/products/' . $product->product_image) }}" width="120"
                                        class="rounded shadow-sm mb-2">
                                </div>
                            @endif

                            <label for="product_image"
                                class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded cursor-pointer hover:bg-gray-100 transition">
                                <svg class="w-8 h-8 text-gray-600 mb-1" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 16.5V19a2 2 0 002 2h14a2 2 0 002-2v-2.5"></path>
                                    <path d="M7 16l5-5 5 5"></path>
                                    <path d="M12 11V3"></path>
                                </svg>
                                <span class="text-gray-600">Click to upload image</span>
                                <input type="file" name="product_image" id="product_image" class="hidden"
                                    onchange="previewProductImage(event)">
                            </label>

                            <div id="imagePreview" class="mt-3"></div>
                        </div>


                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update
                            Product</button>
                    </form>

                </div>

            </main>
        </div>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                document.getElementById('flash-message-success')?.remove();
                document.getElementById('flash-message-error')?.remove();
            }, 3000);
        });
    </script>
    <script>
    function previewProductImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('imagePreview');
            output.innerHTML = '<img src="' + reader.result + '" class="rounded shadow-sm" width="120"/>';
        };
        if(event.target.files[0]){
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>


@endsection
