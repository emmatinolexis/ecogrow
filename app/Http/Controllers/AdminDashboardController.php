<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\User;
use App\Models\Discount;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $categoryCount = Category::count();
        $brandCount = Brand::count();
        $userCount = User::count();
        $adminCount = User::where('user_type', 'admin')->count();
        $customerCount = User::where('user_type', 'user')->count();
        $discountCount = Discount::count();
        $orderCount = \App\Models\Order::count();

        // Order analytics
        $ordersToday = \App\Models\Order::whereDate('created_at', now()->toDateString())->count();
        $ordersThisMonth = \App\Models\Order::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        $ordersCompleted = \App\Models\Order::where('order_status', 'completed')->count();
        $ordersPending = \App\Models\Order::where('order_status', 'pending')->count();

        // Last 10 orders
        $lastOrders = \App\Models\Order::with('user')->latest()->take(10)->get();

        // Products with low stock (e.g., quantity <= 5)
        $lowStockProducts = Product::where('quantity', '<=', 5)->orderBy('quantity', 'asc')->take(10)->get();

        // Orders per month for the last 12 months
        $ordersPerMonthLabels = [];
        $ordersPerMonthData = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $label = $month->format('M Y');
            $count = \App\Models\Order::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->count();
            $ordersPerMonthLabels[] = $label;
            $ordersPerMonthData[] = $count;
        }

        return view('admin.dashboard', compact(
            'productCount',
            'categoryCount',
            'brandCount',
            'userCount',
            'adminCount',
            'customerCount',
            'discountCount',
            'orderCount',
            'ordersToday',
            'ordersThisMonth',
            'ordersCompleted',
            'ordersPending',
            'lastOrders',
            'lowStockProducts',
            'ordersPerMonthLabels',
            'ordersPerMonthData'
        ));
    }
}
