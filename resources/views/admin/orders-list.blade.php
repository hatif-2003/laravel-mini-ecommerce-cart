@extends('admin.adminlayout')
@section('title', 'orderlist')
@section('content')
    <div class="flex min-h-screen bg-gray-50 pt-16">
        <!-- Admin Sidebar -->
        <div class="w-64">
            <x-admin-sidebar />
        </div>

        <!-- Main Content -->
        <div class="flex-1 px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 space-y-4 sm:space-y-0">
                <!-- Heading -->
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">All Orders</h2>

                <!-- Search + Filter -->
                <div class="flex items-center space-x-3">
                    <!-- Search input -->
                    <input type="text" name="search" id="search" placeholder="Search orders..."
                        class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <!-- Filter Dropdown -->
                    <select name="statusFilter" id="statusFilter"
                        class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
            </div>



            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100 text-gray-700 text-sm uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">Order ID</th>
                            <th class="px-6 py-3 text-left">User</th>
                            <th class="px-6 py-3 text-left">Products</th>
                            <th class="px-6 py-3 text-left">Payment</th>
                            <th class="px-6 py-3 text-left">Amount</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Date</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100 text-sm text-gray-700">
                        @forelse ($ordersList as $order)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-semibold text-gray-900">#{{ $order->id }}</td>

                                <td class="px-6 py-4">
                                    <div class="font-medium">{{ $order->user->name ?? 'Guest' }}</div>
                                    <div class="text-xs text-gray-500">{{ $order->user->email ?? '-' }}</div>
                                </td>

                                <td class="px-6 py-4">
                                    @foreach ($order->items as $item)
                                        <div class="text-sm">{{ $item->product->product_name ?? '-' }}</div>
                                    @endforeach
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-block px-2 py-1 text-xs font-medium rounded 
                                    {{ $order->payment_method == 'Online' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                                        {{ $order->payment_method }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">₹{{ number_format($order->total_price) }}</td>

                                <td
                                    class="px-6 py-4 {{ $order->status == 'Completed'
                                        ? 'text-green-600'
                                        : ($order->status == 'Pending'
                                            ? 'text-yellow-600'
                                            : ($order->status == 'Cancelled'
                                                ? 'text-red-600'
                                                : 'text-gray-600')) }}">
                                    {{ $order->status }}
                                </td>

                                <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                    {{ $order->created_at->format('d M, Y h:i A') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center px-6 py-6 text-gray-500">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 mb-6">
                {{ $ordersList->links('pagination::tailwind') }}
            </div>
        </div>
    </div>



@endsection
