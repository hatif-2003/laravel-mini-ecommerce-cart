<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        $categories = Category::all();
        return view('admin.products', compact('categories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'product_name' => 'required|string|max:255',
            'product_description' => 'nullable|string|max:500',
            'product_price' => 'required|numeric|min:0',
            'product_discount' => 'nullable|numeric|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,AVIF|max:2048'
        ]);

        $imageName = null;
        if ($request->hasFile('product_image')){
            $imageName = time().'.'. $request->product_image->extension();
            $request->product_image->move(public_path('uploads/products'), $imageName);
        }

        Product::create([
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'product_price' => $request->product_price,
            'product_discount' => $request->product_discount,
            'product_image' => $imageName
        ]);
        return redirect()->back()->with('success', 'Product created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.edit-products', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
          $request->validate([
            'category_id' => 'required|exists:categories,id',
            'product_name' => 'required|string|max:255',
            'product_description' => 'nullable|string|max:500',
            'product_price' => 'required|numeric|min:0',
            'product_discount' => 'nullable|numeric|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,AVIF|max:2048',
            'stock' => 'required|integer|'
        ]);
         $imageName = $product->product_image;
        if ($request->hasFile('product_image')) {
            if ($imageName) {
                $oldImagePath = public_path('uploads/products/' . $imageName);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $imageName = time() . '.' . $request->product_image->extension();
            $request->product_image->move(public_path('uploads/products'), $imageName);
        }
        $product->update([
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'product_price' => $request->product_price,
            'product_discount' => $request->product_discount,
            'product_image' => $imageName,
            'stock' => $request->stock
        ]);
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
}
