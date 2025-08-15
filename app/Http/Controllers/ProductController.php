<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Discount;

class ProductController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $path = $request->file('file')->store('products', 'public');
        return response()->json(['path' => $path, 'url' => asset('storage/' . $path)]);
    }

    /**
     * Show the product details page.
     */
    public function show($id)
    {
        $product = Product::with(['images', 'category', 'discounts', 'options'])->findOrFail($id);

        // Related products: random products from the same category, excluding the current product
        $relatedProducts = Product::with(['images', 'category', 'discounts'])
            ->where('status', 'active')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(8)
            ->get();
        // For sidebar filter
        $categories = Category::with('children')->where('status', 'active')->get();


        return view('website.product_details', compact('product', 'relatedProducts', 'categories'));
    }

    // Website product listing
    public function websiteIndex()
    {
        $query = Product::with(['category', 'brand', 'images', 'discounts'])->where('status', 'active');

        // Search filter
        if (request('search')) {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhereHas('category', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%")
                            ->orWhereHas('parent', function ($q3) use ($search) {
                                $q3->where('name', 'like', "%$search%");
                            });
                    });
            });
        }

        // Category filter
        if (request('category')) {
            $query->whereHas('category', function ($q) {
                $q->where('id', request('category'));
            });
        }

        // Price filter
        if (request('price_min')) {
            $query->where('price', '>=', request('price_min'));
        }
        if (request('price_max')) {
            $query->where('price', '<=', request('price_max'));
        }

        // Sorting
        if (request('sort') === 'az') {
            $query->orderBy('name', 'asc');
        } elseif (request('sort') === 'za') {
            $query->orderBy('name', 'desc');
        }

        $products = $query->paginate(10)->appends(request()->query());

        // Get filter options
        $categories = Category::where('status', 'active')->get();


        return view('website.products', compact('products', 'categories'));
    }
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand', 'images', 'options']);
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhereHas('category', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%");
                    })
                    ->orWhereHas('brand', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%");
                    })
                    ->orWhere('quantity', 'like', "%$search%")
                    ->orWhere('price', 'like', "%$search%");
            });
        }
        $products = $query->paginate(10);
        $products->appends($request->query());
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $discounts = Discount::where('status', 'active')->get();
        return view('admin.products.create', compact('categories', 'brands', 'discounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'status' => 'required|in:active,inactive',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'main_image' => 'nullable|integer',
            'discount_id' => 'nullable|exists:discounts,id',
        ]);

        DB::beginTransaction();
        try {
            $product = Product::create($request->only(['name', 'description', 'price', 'quantity', 'category_id', 'brand_id', 'status']));
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $idx => $image) {
                    $path = $image->store('products', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_url' => $path,
                        'is_main' => $request->main_image == $idx ? 1 : 0,
                    ]);
                }
            }
            // Assign discount if selected
            if ($request->filled('discount_id')) {
                $product->discounts()->sync([$request->discount_id]);
            }

            // Save product options
            if ($request->has('options')) {
                foreach ($request->input('options') as $option) {
                    if (!empty($option['option_type']) && !empty($option['option_value']) && isset($option['quantity'])) {
                        $product->options()->create([
                            'option_type' => $option['option_type'],
                            'option_value' => $option['option_value'],
                            'quantity' => $option['quantity'],
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('products.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to create product.']);
        }
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $discounts = \App\Models\Discount::where('status', 'active')->get();
        $product->load(['images', 'discounts']);
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'discounts'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'status' => 'required|in:active,inactive',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'main_image' => 'nullable|integer',
            'discount_id' => 'nullable|exists:discounts,id',
        ]);
        DB::beginTransaction();
        try {
            $product->update($request->only(['name', 'description', 'price', 'quantity', 'category_id', 'brand_id', 'status']));
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $idx => $image) {
                    $path = $image->store('products', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_url' => $path,
                        'is_main' => $request->main_image == $idx ? 1 : 0,
                    ]);
                }
            }
            // Update main image
            if ($request->main_image !== null) {
                foreach ($product->images as $idx => $img) {
                    $img->is_main = ($request->main_image == $idx);
                    $img->save();
                }
            }
            // Sync discount
            if ($request->filled('discount_id')) {
                $product->discounts()->sync([$request->discount_id]);
            } else {
                $product->discounts()->detach();
            }

            // Update product options
            $existingOptionIds = $product->options()->pluck('id')->toArray();
            $submittedOptionIds = [];
            if ($request->has('options')) {
                foreach ($request->input('options') as $idx => $option) {
                    if (
                        !empty($option['option_type']) &&
                        !empty($option['option_value']) &&
                        isset($option['quantity'])
                    ) {
                        // If option has an id, update it; else, create new
                        if (isset($option['id']) && in_array($option['id'], $existingOptionIds)) {
                            $productOption = $product->options()->find($option['id']);
                            if ($productOption) {
                                $productOption->update([
                                    'option_type' => $option['option_type'],
                                    'option_value' => $option['option_value'],
                                    'quantity' => $option['quantity'],
                                ]);
                                $submittedOptionIds[] = $option['id'];
                            }
                        } else {
                            $newOption = $product->options()->create([
                                'option_type' => $option['option_type'],
                                'option_value' => $option['option_value'],
                                'quantity' => $option['quantity'],
                            ]);
                            $submittedOptionIds[] = $newOption->id;
                        }
                    }
                }
            }
            // Delete removed options
            $toDelete = array_diff($existingOptionIds, $submittedOptionIds);
            if (!empty($toDelete)) {
                $product->options()->whereIn('id', $toDelete)->delete();
            }

            DB::commit();
            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to update product.']);
        }
    }

    public function destroy(Product $product)
    {
        // Delete all images from storage
        foreach ($product->images as $image) {
            if ($image->image_url && \Storage::disk('public')->exists($image->image_url)) {
                \Storage::disk('public')->delete($image->image_url);
            }
        }
        // Delete images from DB
        $product->images()->delete();
        // Delete the product
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function destroyImage($id)
    {
        $image = \App\Models\ProductImage::findOrFail($id);
        // Delete the file from storage
        if ($image->image_url && \Storage::disk('public')->exists($image->image_url)) {
            \Storage::disk('public')->delete($image->image_url);
        }
        $image->delete();
        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }
        return back()->with('success', 'Image deleted successfully.');
    }
}