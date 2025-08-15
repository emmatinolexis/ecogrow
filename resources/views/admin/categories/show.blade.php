@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Category Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $category->name }}</h5>
            <p class="card-text">
                <strong>Parent Category:</strong>
                {{ $category->parent ? $category->parent->name : 'None' }}
            </p>
            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection