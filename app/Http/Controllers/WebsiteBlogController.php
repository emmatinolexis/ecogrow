<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Product;

class WebsiteBlogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $blogs = Blog::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%$search%")
                    ->orWhere('blog_details', 'like', "%$search%");
            })
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        $recentProducts = Product::orderBy('created_at', 'desc')->take(5)->get();

        return view('website.blog', compact('blogs', 'recentProducts', 'search'));
    }

    public function show($id)
    {
        $blog = Blog::where('status', 'published')->findOrFail($id);
        return view('website.blog_details', compact('blog'));
    }


}