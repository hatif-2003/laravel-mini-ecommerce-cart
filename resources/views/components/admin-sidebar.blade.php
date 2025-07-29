<div>
     <aside class="w-64 bg-blue-800 text-white flex flex-col space-y-6 py-6 px-4 fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition duration-200 ease-in-out z-30" id="sidebar">
            <div class="text-2xl font-bold text-center">Admin Panel</div>
            <nav class="flex flex-col space-y-4">
                <a href="#" class="hover:bg-blue-700 px-3 py-2 rounded">Dashboard</a>
                <a href="#" class="hover:bg-blue-700 px-3 py-2 rounded">Users</a>
                <a href="{{ route('categories.index') }}" class="hover:bg-blue-700 px-3 py-2 rounded">Category</a>
                <a href="{{ route('products.index') }}" class="hover:bg-blue-700 px-3 py-2 rounded">Products</a>

                <a href="{{ route('order.list') }}" class="hover:bg-blue-700 px-3 py-2 rounded">Orders</a>
                <a href="#" class="hover:bg-blue-700 px-3 py-2 rounded">Settings</a>
            </nav>
        </aside>
</div>