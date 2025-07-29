@extends('admin.adminlayout')
@section('title', 'Admin Dashboard')
@section('content')
    <div class="flex min-h-screen pt-16">
        <x-admin-sidebar />


        <!-- Content -->
        <div class="flex-1 ml-0 md:ml-64">
            <header class="bg-white shadow p-4 flex items-center justify-between">
                <button class="md:hidden text-gray-600 focus:outline-none" id="menu-btn">
                    &#9776;
                </button>
                <h1 class="text-2xl font-semibold">Dashboard</h1>
            </header>

            <main class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded shadow p-4">
                        <h2 class="text-lg font-semibold mb-2">Total Users</h2>
                        <p class="text-3xl font-bold">{{ $totalUsers }}</p>
                    </div>
                    <div class="bg-white rounded shadow p-4">
                        <h2 class="text-lg font-semibold mb-2">Total Products</h2>
                        <p class="text-3xl font-bold">{{ $totalProduct }}</p>
                    </div>
                    <div class="bg-white rounded shadow p-4">
                        <h2 class="text-lg font-semibold mb-2">Total Orders</h2>
                        <p class="text-3xl font-bold">{{ $totalOrder }}</p>
                    </div>
                </div>

                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-4">Recent Orders</h2>
                    <div class="bg-white rounded shadow overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="p-3">Order ID</th>
                                    <th class="p-3">Customer</th>
                                    <th class="p-3">Amount</th>
                                    <th class="p-3">payment_method</th>

                                    <th class="p-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                    <tr class="border-b">
                                        <td class="p-3">#{{ $order->id }}</td>
                                        <td class="p-3">{{ $order->user->name ?? 'Unknown' }}</td>
                                        <td class="p-3">₹{{ $order->total_price }}</td>
                                        @php
                                            $paymentColor =
                                                $order->payment_method == 'Online'
                                                    ? 'text-blue-600'
                                                    : 'text-purple-600';
                                        @endphp
                                        <td class="p-3" {{ $paymentColor }}>

                                           <span>{{ $order->payment_method }}</span>


                                        </td>

                                        <td
                                            class="p-3 {{ $order->status == 'Completed'
                                                ? 'text-green-600'
                                                : ($order->status == 'Pending'
                                                    ? 'text-yellow-600'
                                                    : ($order->status == 'Cancelled'
                                                        ? 'text-red-600'
                                                        : 'text-gray-600')) }}">
                                            {{ $order->status }}
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="p-3 text-center text-gray-500">No recent orders found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>

@endsection
