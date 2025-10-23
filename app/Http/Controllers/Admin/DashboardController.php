<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $metrics = [
            'products' => Product::count(),
            'posts' => Post::count(),
            'orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
        ];

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        $latestProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('metrics', 'recentOrders', 'latestProducts'));
    }
}
