<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;



class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findorFail($productId);

        //check product stock is greater than 0 
        if ($product->stock <= 1) {
            return redirect()->back()->with('error', 'Product is out of stock!');
        }

        $cartItem = Cart::where('user_id', auth()->id())->where('product_id', $productId)->first();

        if ($cartItem) {
            if ($cartItem->quantity < $product->stock) {
                $cartItem->quantity += 1;
                $cartItem->save();
                return redirect()->back()->with('success', 'Product quantity updated in cart!');
            } else {
                return redirect()->back()->with('error', 'Cannot add more than available stock!');
            }
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'quantity' => 1,
            ]);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
    }

    public function index()
    {
        $categories = Category::with('products')->get();
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
   

        $totalPrice = $cartItems->sum(function ($item) {
            $product = $item->product;

            $price = (!is_null($product->product_discount) && $product->product_discount > 0)
                ? $product->product_discount
                : $product->product_price;
                       

            return $price * $item->quantity;


        });



        return view('landing.cart', compact('cartItems', 'categories', 'totalPrice'));
    }

    public function increaseQuantity($id)
    {
        $cartItem = Cart::findorFail($id);
        if ($cartItem->quantity < $cartItem->product->stock) {
            $cartItem->increment('quantity');
        }
        return back();
    }

    public function decreaseQuantity($id)
    {
        $cartItem = Cart::findorFail($id);
        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        }
        return back();
    }

    public function destroycartItem($id)
    {
        $cartItem = Cart::findorFail($id);
        $cartItem->delete();
        return back()->with('success', 'Cart item removed successfully!');
    }
}
