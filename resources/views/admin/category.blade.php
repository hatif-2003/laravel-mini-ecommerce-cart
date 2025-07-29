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
                <h1 class="text-2xl font-semibold">Insert Category</h1>


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
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data"
                        class="bg-white p-6 rounded shadow-md space-y-4 w-full">
                        @csrf

                        <h2 class="text-xl font-bold text-gray-800 mb-4">Create New Category</h2>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Category Name:</label>
                            <input type="text" name="cat_name" placeholder="Category Name"
                                class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @error('cat_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Description:</label>
                            <textarea name="cat_description" placeholder="Description"
                                class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                            @error('cat_description')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Category Image:</label>
                            <label
                                class="flex items-center justify-center w-full px-4 py-2 bg-gray-100 border-2 border-dashed border-gray-300 rounded cursor-pointer hover:bg-gray-200">
                                <svg class="w-6 h-6 text-gray-600 mr-2" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 16.5V19a2 2 0 002 2h14a2 2 0 002-2v-2.5"></path>
                                    <path d="M7 16l5-5 5 5"></path>
                                    <path d="M12 11V3"></path>
                                </svg>
                                <span class="text-gray-600">Click to upload image</span>
                                <input type="file" name="cat_image" class="hidden">
                            </label>
                            @error('cat_image')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>


                        <button type="submit"
                            class="bg-blue-500 text-white px-5 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">Create</button>
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
                                    <th class="p-3">Category Name</th>
                                    <th class="p-3">Category Description</th>

                                    <th class="p-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $cat)
                                    <tr class="border-b">
                                        <td class="p-3">{{ $cat->id }}</td>
                                        <td class="p-3">
                                            @if ($cat->cat_image)
                                                <img src="{{ asset('uploads/catImage/' . $cat->cat_image) }}"
                                                    alt="Category Image" class="w-16 h-16 object-cover">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td class="p-3">{{ $cat->cat_name }}</td>
                                        <td class="p-3">{{ $cat->cat_description }}</td>
                                        <td class="p-3 space-x-2">
                                            <a href="{{ route('categories.edit', $cat->id) }}"
                                                class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">Edit</a>
                                            <form action="{{ route('categories.destroy', $cat->id) }}" method="POST"
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
                        {{ $categories->links('pagination::tailwind') }}

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
@endsection
