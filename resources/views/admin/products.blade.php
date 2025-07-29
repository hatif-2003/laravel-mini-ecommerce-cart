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



                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"
                        class="bg-white p-6 rounded shadow-md space-y-4 max-w-lg mx-auto">
                        @csrf



                        <div>
                            <label for="category" class="block text-gray-700 font-bold mb-2">Category</label>
                            <select name="category_id" id="category" class="w-full p-2 border border-gray-300 rounded">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->cat_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Product Name</label>
                            <input type="text" name="product_name" class="w-full p-2 border border-gray-300 rounded"
                                value="{{ old('product_name') }}">
                            @error('product_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Description</label>
                            <textarea name="product_description" class="w-full p-2 border border-gray-300 rounded">{{ old('product_description') }}</textarea>
                            @error('product_description')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Price</label>
                            <input type="number" name="product_price" class="w-full p-2 border border-gray-300 rounded"
                                step="0.01" value="{{ old('product_price') }}">
                            @error('product_price')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                          <div>
                            <label class="block text-gray-700 font-bold mb-2">Stock</label>
                            <input type="number" name="stock" class="w-full p-2 border border-gray-300 rounded"
                                step="0.01" value="{{ old('stock') }}">
                            @error('stock')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Discount Price</label>
                            <input type="number" name="product_discount" class="w-full p-2 border border-gray-300 rounded"
                                step="0.01" value="{{ old('product_discount') }}">
                            @error('product_discount')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Product Image</label>
                            <label
                                class="flex items-center justify-center w-full px-4 py-2 bg-gray-100 border-2 border-dashed border-gray-300 rounded cursor-pointer hover:bg-gray-200">
                                <svg class="w-6 h-6 text-gray-600 mr-2" fill="none" stroke="currentColor"
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

                            @error('product_image')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>


                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add
                            Product</button>
                    </form>

                </div>

                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-4">Recent Orders</h2>
                    <div class="bg-white rounded shadow overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="p-3">Id</th>
                                    <th class="p-3">Image</th>
                                    <th class="p-3">Products Name</th>
                                    <th class="p-3">Products Description</th>
                                    <th class="p-3">Product Category</th>
                                    <th class="p-3">Products Price</th>
                                    <th class="p-3">Stock</th>


                                    <th class="p-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

   @foreach ($products as $index => $product)
                                <tr class="border-b">
                                 
                                        <td class="p-3">{{ $index + 1 }}</td>
                                        <td class="p-3">
                                            @if ($product->product_image)
                                                <img src="{{ asset('uploads/products/' . $product->product_image) }}"
                                                    alt="Category Image" class="w-16 h-16 object-cover">
                                            @else
                                                <p class="text-red-500"> No Image</p>
                                            @endif

                                        </td>
                                        <td class="p-3">{{ $product->product_name }}</td>
                                        <td class="p-3">{{ $product->product_description }}</td>
                                        <td class="p-3">{{ $product->category->cat_name ?? 'N/A' }}</td>
                                        <td class="p-3 text-green-500 font-bold">{{ $product->product_discount }}
                                            <del class="text-red-500 font-semibold">{{ $product->product_price }}</del>
                                        </td>
                                        <td class="p-3">{{ $product->stock }}</td>



                                        <td class="p-3 space-x-2 flex ">
                                            <a href="{{route('products.edit', $product->id)}}"
                                                class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">Edit</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this category?')";
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                                            </form>
                                        </td>
                               


                                </tr>
                                     @endforeach




                            </tbody>
                        </table>


                    </div>
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
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('imagePreview');
                output.innerHTML =
                    `<img src="${reader.result}" class="mt-2 w-32 h-32 object-cover rounded" alt="Preview Image">`;
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>

@endsection
