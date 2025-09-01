<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Blog;

class HomeController extends Controller
{
    public function index()
    {
        $lastProducts = Product::orderBy('created_at', 'desc')->take(8)->get();
        $categories = Category::with('children')->where('status', 'active')->whereNull('parent_category_id')->get();
        $blogs = Blog::where('status', 'published')->orderBy('created_at', 'desc')->take(3)->get();
        $customerReviews = \App\Models\CustomerReview::where('status', 'approved')->orderBy('created_at', 'desc')->take(6)->get();

        return view('website.home', compact('lastProducts', 'categories', 'blogs', 'customerReviews'));
    }
}