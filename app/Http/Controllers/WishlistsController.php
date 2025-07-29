<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlists;
use Illuminate\Http\Request;

class WishlistsController extends Controller
{
    public function index()
    {
         $wishlistItems = Wishlists::with('product')->where('user_id', auth()->id())->get();
         $categories = Category::with('products')->get();
        return view('landing.wishlist', compact('wishlistItems', 'categories'));
    }

    public function addToWishlist($productId)
    {
        $exits = Wishlists::where('user_id', auth()->id())->where('product_id', $productId)->exists();

        if (!$exits){
            Wishlists::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
            ]);
            return redirect()->back()->with('success', 'Product added to wishlist successfully!');
        } else {
            return redirect()->back()->with('error', 'Product already exists in your wishlist!');
        }

    }
    public function removeFromWishlist($id)
    {
        Wishlists::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Product removed from wishlist successfully!');
    }
}
