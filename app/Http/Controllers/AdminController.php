<?php

namespace App\Http\Controllers;

use App\Models\orders;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalProduct = Product::count();
        $totalOrder = orders::count();
         $recentOrders = orders::with('user')->latest()->take(10)->get();
        return view('admin.dashboard', compact('totalUsers', 'totalProduct', 'totalOrder', 'recentOrders'));
    }

    public function orderList()
    {
          $ordersList = orders::with('user')->latest()->paginate(20);
        return view('admin.orders-list', compact('ordersList'));
    }
}
