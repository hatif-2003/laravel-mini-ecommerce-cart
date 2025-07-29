<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::with('category')->get();
        $categories = Category::with('products')->get();
        return view('landing.home', compact('categories', 'products'));
    }
    public function categoryProducts($id)
    {
        $category = Category::with('products')->findorFail($id);
         $categories = Category::with('products')->get();

         
        return view('landing.category-products', compact('category', 'categories'));
    }

   
    public function showProduct($id)
    {
        $product = Product::with('category')->findOrFail($id);
          $categories = Category::with('products')->get();
          $relatedProducts = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->take(4)->get();
        return view('landing.product-details', compact('product', 'categories', 'relatedProducts'));
    }
}
