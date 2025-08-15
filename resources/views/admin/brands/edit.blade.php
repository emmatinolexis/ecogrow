@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Brand</h2>
        <form action="{{ route('brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $brand->name) }}" required>
                @error('name')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ old('description', $brand->description) }}</textarea>
                @error('description')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label>Logo</label>
                <input type="file" name="logo" class="form-control">
                @if($brand->logo_url)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $brand->logo_url) }}" alt="Logo" height="50">
                    </div>
                @endif
                @error('logo')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('brands.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection