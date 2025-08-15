<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class AdminBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'display_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'blog_details' => 'required|string',
            'status' => 'required|string',
        ]);

        if ($request->hasFile('display_image')) {
            $path = $request->file('display_image')->store('blogs', 'public');
            $validated['display_image'] = $path;
        }

        Blog::create($validated);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'display_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'blog_details' => 'required|string',
            'status' => 'required|string',
        ]);

        if ($request->hasFile('display_image')) {
            $path = $request->file('display_image')->store('blogs', 'public');
            $validated['display_image'] = $path;
        }

        $blog->update($validated);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
