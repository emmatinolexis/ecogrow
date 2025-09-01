<?php
namespace App\Http\Controllers;

use App\Models\CustomerReview;
use Illuminate\Http\Request;

class CustomerReviewController extends Controller
{
    public function index()
    {
        $reviews = CustomerReview::orderBy('created_at', 'desc')->get();
        return view('admin.customer_reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('admin.customer_reviews.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'review' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('customer_reviews', 'public');
        }
        CustomerReview::create($data);
        return redirect()->route('admin.customer_reviews.index')->with('success', 'Review added successfully.');
    }

    public function edit($id)
    {
        $review = CustomerReview::findOrFail($id);
        return view('admin.customer_reviews.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = CustomerReview::findOrFail($id);
        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'review' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('customer_reviews', 'public');
        }
        $review->update($data);
        return redirect()->route('admin.customer_reviews.index')->with('success', 'Review updated successfully.');
    }

    public function destroy($id)
    {
        $review = CustomerReview::findOrFail($id);
        $review->delete();
        return redirect()->route('admin.customer_reviews.index')->with('success', 'Review deleted successfully.');
    }
}
