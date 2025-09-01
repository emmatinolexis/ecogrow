@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Add Customer Review</h2>
    <form action="{{ route('admin.customer_reviews.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" name="customer_name" id="customer_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image (optional)</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="mb-3">
            <label for="review" class="form-label">Review</label>
            <textarea name="review" id="review" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">
            <span class="material-icons" style="vertical-align:middle;">rate_review</span> Add Review
        </button>
    </form>
</div>
@endsection