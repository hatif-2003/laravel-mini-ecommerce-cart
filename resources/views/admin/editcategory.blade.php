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
                <h1 class="text-2xl font-semibold">Edit Category</h1>


            </header>

            <main class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                   
                    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data"
                        class="bg-white p-6 rounded shadow-md space-y-4 max-w-lg mx-auto">
                        @csrf
                        @method('PUT')

                       

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Category Name:</label>
                            <input type="text" name="cat_name" placeholder="Category Name"
                                class="w-full p-2 border border-gray-300 rounded" value="{{$category->cat_name ?? ''}}">
                            @error('cat_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Description:</label>
                            <textarea name="cat_description" placeholder="Description" class="w-full p-2 border border-gray-300 rounded" >{{$category->cat_description ?? ''}}</textarea>
                            @error('cat_description')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Category Image:</label>
                            <input type="file" name="cat_image" class="w-full">
                            @if(isset($category) && $category->cat_image)
                                <img src="{{ asset('uploads/catImage/' . $category->cat_image) }}" alt="Category Image" class="mt-2 w-32 h-32 object-cover">
                            @endif
                            @error('cat_image')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                    </form>
                </div>

              
            </main>
        </div>
    </div>
@endsection
