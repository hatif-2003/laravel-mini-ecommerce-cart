<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.category', compact('categories'));
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
            'cat_name' => 'required|string|max:255',
            'cat_description' => 'nullable|string|max:500',
            'cat_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imageName = null;
        if ($request->hasFile('cat_image')) {
            $imageName = time() . '.' . $request->cat_image->extension();
            $request->cat_image->move(public_path('uploads/catImage'), $imageName);
        }

        Category::create([
            'cat_name' => $request->cat_name,
            'cat_description' => $request->cat_description,
            'cat_image' => $imageName
        ]);
        redirect()->back()->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.editcategory', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'cat_name' => 'required|string|max:255',
            'cat_description' => 'nullable|string|max:500',
            'cat_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imageName = $category->cat_image;
        if ($request->hasFile('cat_image')) {
            if ($imageName) {
                $oldImagePath = public_path('uploads/catImage/' . $imageName);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $imageName = time() . '.' . $request->cat_image->extension();
            $request->cat_image->move(public_path('uploads/catImage'), $imageName);
        }
        $category->update([
            'cat_name' => $request->cat_name,
            'cat_description' => $request->cat_description,
            'cat_image' => $imageName
        ]);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
}
