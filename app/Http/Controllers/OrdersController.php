<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\orders;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Razorpay\Api\Api;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Order;

class OrdersController extends Controller
{
    public function index()
    {
        $cartItems = auth()->user()->cart;
        $totalPrice = $cartItems->sum(function ($items) {

            $price = $items->product->product_discount ?? $items->product->product_price;
            return $price * $items->quantity;
        });
        $categories = Category::with('products')->get();
        return view('landing.order', compact('cartItems', 'totalPrice', 'categories'));
    }

    public function placeOrder(Request $request)
    {
        Log::info('placeOrder called', $request->all());

        $request->validate([
            'name' => 'required|string|max:255|min:3|regex:/^[a-zA-Z\s\-\'\.]{2,100}$/',
            'phone' => 'required|string|regex:/^\+?[0-9\s\-\(\)]{10,20}$/',
            'address' => 'required|string|regex:/^[a-zA-Z0-9\s,\-#\/\.\'()]{5,255}$/',
            'city' => 'required|regex:/^[a-zA-Z\s\-\'\.]{2,100}$/',
            'pincode' => 'required|regex:/^[a-zA-Z0-9\s\-]{3,12}$/',
            'state' => 'required|regex:/^[a-zA-Z\s\-]{2,100}$/',
            'payment_method' => 'required|in:COD,Online',
            'total_price' => 'required|numeric|min:0.01', // Ensure total_price is valid
        ]);

      
        
        $order = new Orders();
        $order->user_id = auth()->id();
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->pincode = $request->pincode;
        $order->payment_method = $request->payment_method;
        $order->total_price = $request->total_price;
        $order->status = 'pending';
        $order->payment_id = $request->razorpay_payment_id ?? null;
        $order->save();

        $cartItems = auth()->user()->cart;
        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->product_discount ?? $item->product->product_price,
            ]);
        }

        auth()->user()->cart()->delete();
        Log::info('Order placed successfully:', ['order_id' => $order->id]);
        return redirect()->route('order.success')->with('success', 'Order successfully placed!');
    }
   
    public function createRazorpayOrder(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'receipt' => uniqid(),
            'amount' => $request->amount * 100, // in paise
            'currency' => 'INR',
        ]);

        return response()->json([
            'order_id' => $order->id,
            'amount' => $order->amount
       ]);
}

 public function store(Request $request)
{
    
      
    try {
        $order = new Orders();
        $order->user_id = Auth::id();
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->pincode = $request->pincode;
        $order->total_price = $request->total_price;
        $order->payment_method = 'Online'; // kyunki Razorpay se hua
        $order->status = 'Processing';
        $order->payment_id = $request->payment_id;

        $order->save();
        
         $cartItems = auth()->user()->cart;
        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->product_discount ?? $item->product->product_price,
            ]);
        }

        auth()->user()->cart()->delete();

        return redirect()->route('order.success');
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Order failed: ' . $e->getMessage()
        ]);
    }
}
 public function success()
 {
     $categories = Category::with('products')->get();
    return view('landing.success', compact('categories'))->with('ordersuccess', true);
 }



    
   
}