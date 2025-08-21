<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $lastProducts = Product::orderBy('created_at', 'desc')->take(8)->get();
        $categories = Category::with('children')->where('status', 'active')->whereNull('parent_category_id')->get();
        return view('website.home', compact('lastProducts', 'categories'));
    }
}
