@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Category</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $category->name) }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="parent_category_id" class="form-label">Parent Category</label>
                <select name="parent_category_id" id="parent_category_id" class="form-control">
                    <option value="">None</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('parent_category_id', $category->parent_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control"
                    id="description">{{ old('description', $category->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="icon" class="form-label">Icon</label>
                <input type="file" name="icon" class="form-control" id="icon">
                @if($category->icon_url)
                    <img src="{{ $category->icon_url }}" alt="icon" width="32" height="32" class="mt-2">
                @endif
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="active" {{ old('status', $category->status) == 'active' ? 'selected' : '' }}>Active
                    </option>
                    <option value="inactive" {{ old('status', $category->status) == 'inactive' ? 'selected' : '' }}>Inactive
                    </option>
                </select>
            </div>
            <button type="submit" class="btn btn-update">Update</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection