@extends('landing.publiclayout')
@section('title', 'myoreder')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-6 text-center">🛒 My Orders</h2>

        @if ($myOrders->isEmpty())
            <div class="text-center text-gray-500">You have no orders yet.</div>
        @else
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full table-auto border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">#</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Product</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Amount</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Payment</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Status</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($myOrders as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">
                                    @foreach ($order->items as $item)
                                        <p> {{ $item->product->product_name }}</p>
                                    @endforeach
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-800">₹{{ number_format($order->total_price, 2) }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ ucfirst($order->payment_method) }}</td>
                                <td class="px-4 py-2 text-sm">
                                    @if ($order->status == 'pending')
                                        <span class="text-yellow-500 font-semibold">Pending</span>
                                    @elseif($order->status == 'completed')
                                        <span class="text-green-600 font-semibold">Completed</span>
                                    @else
                                        <span class="text-red-500 font-semibold">{{ ucfirst($order->status) }}</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-600">{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
