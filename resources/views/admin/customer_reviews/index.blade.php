@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Customer Reviews</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <a href="{{ route('admin.customer_reviews.create') }}" class="btn btn-create mb-3">Add Review</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Review</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reviews as $review)
                    <tr>
                        <td>{{ $review->id }}</td>
                        <td>{{ $review->customer_name }}</td>
                        <td>
                            @if($review->image)
                                <img src="{{ asset('storage/' . $review->image) }}" alt="image" width="40" height="40">
                            @endif
                        </td>
                        <td>{{ $review->review }}</td>
                        <td>{{ ucfirst($review->status) }}</td>
                        <td>
                            <a href="{{ route('admin.customer_reviews.edit', $review) }}" class="btn btn-edit btn-sm">Edit</a>
                            <form action="{{ route('admin.customer_reviews.destroy', $review) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection