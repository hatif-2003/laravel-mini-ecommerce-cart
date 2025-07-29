<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyOrderController extends Controller
{
    public function myOrder()
    {
        $categories = Category::with('products')->get();
        $myOrders = Auth::user()->orders()->latest()->paginate(10);
       
        return view('landing.my-order', compact('categories', 'myOrders'));
    }
}
