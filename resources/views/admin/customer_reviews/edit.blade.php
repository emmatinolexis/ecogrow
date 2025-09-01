@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Edit Customer Review</h2>
        <form action="{{ route('admin.customer_reviews.update', $review) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="customer_name" class="form-label">Customer Name</label>
                <input type="text" name="customer_name" id="customer_name" class="form-control"
                    value="{{ $review->customer_name }}" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image (optional)</label>
                <input type="file" name="image" id="image" class="form-control">
                @if($review->image)
                    <img src="{{ asset('storage/' . $review->image) }}" alt="image" width="40" height="40">
                @endif
            </div>
            <div class="mb-3">
                <label for="review" class="form-label">Review</label>
                <textarea name="review" id="review" class="form-control" required>{{ $review->review }}</textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="pending" @if($review->status == 'pending') selected @endif>Pending</option>
                    <option value="approved" @if($review->status == 'approved') selected @endif>Approved</option>
                    <option value="rejected" @if($review->status == 'rejected') selected @endif>Rejected</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update Review</button>
        </form>
    </div>
@endsection