@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Product</h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label>Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}"
                        required>
                    @error('price')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" required>
                    @error('quantity')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="description" id="productDescription"
                        class="form-control">{{ old('description') }}</textarea>
                    @error('description')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label>Brand</label>
                    <select name="brand_id" class="form-control">
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('brand_id')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label>Product Images</label>
                    <input type="file" name="images[]" class="form-control" multiple>
                    @error('images.*')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label>Main Image</label>
                    <input type="number" name="main_image" class="form-control" min="0"
                        placeholder="Index of main image (0 for first)">
                    <small class="form-text text-muted">Set the index of the main image (0 for first image).</small>
                </div>
                <div class="mb-3">
                    <label>Discount</label>
                    <select name="discount_id" class="form-control">
                        <option value="">No Discount</option>
                        @foreach($discounts as $discount)
                        <option value="{{ $discount->id }}" {{ old('discount_id') == $discount->id ? 'selected' : '' }}>
                            {{ $discount->code }} ({{ $discount->discount_percent }}% - {{ $discount->description }})
                        </option>
                        @endforeach
                    </select>
                    @error('discount_id')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>
        <hr>
        <h4>Product Options</h4>
        <div id="product-options-section">
            <div class="row mb-2">
                <div class="col-3">
                    <input type="text" name="options[0][option_type]" class="form-control"
                        placeholder="Option Type (e.g. size)">
                </div>
                <div class="col-3">
                    <input type="text" name="options[0][option_value]" class="form-control"
                        placeholder="Option Value (e.g. M)">
                </div>
                <div class="col-3">
                    <input type="number" name="options[0][quantity]" class="form-control" placeholder="Quantity">
                </div>
                <div class="col-3">
                    <button type="button" class="btn btn-success add-option">+</button>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection