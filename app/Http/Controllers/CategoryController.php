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
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'icon' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,webp|max:2048',
            'parent_category_id' => 'nullable|exists:categories,id',
        ]);

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $path = $file->store('category_icons', 'public');
            $url = asset('storage/' . $path);
            $validated['icon_url'] = $url;
        }

        Category::create($validated);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::where('id', '!=', $category->id)->get();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'icon' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,webp|max:2048',
            'parent_category_id' => 'nullable|exists:categories,id',
        ]);

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $path = $file->store('category_icons', 'public');
            $url = asset('storage/' . $path);
            $validated['icon_url'] = $url;
        }

        $category->update($validated);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}