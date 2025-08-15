@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Product</h2>
    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}"
                        required>
                    @error('name')<div class=" text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label>Price</label>
                    <input type="number" step="0.01" name="price" class="form-control"
                        value="{{ old('price', $product->price) }}" required>
                    @error('price')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control"
                        value="{{ old('quantity', $product->quantity) }}" required>
                    @error('quantity')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label>Description</label>

                    <textarea name="description" id="productDescription"
                        class="form-control">{{ old('description', $product->description) }}</textarea>
                    @error('description')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label>Brand</label>
                    <select name="brand_id" class="form-control">
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->id }}"
                            {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('brand_id')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>
                            Inactive</option>
                    </select>
                    @error('status')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label>Product Images</label>
                    <input type="file" name="images[]" class="form-control" multiple>
                    @error('images.*')<div class="text-danger">{{ $message }}</div>@enderror
                    <div class="mt-2">
                        @foreach($product->images as $idx => $img)
                        <div class="d-inline-block me-2 text-center">
                            <img src="{{ asset('storage/' . $img->image_url) }}" alt="Image" height="40"><br>
                            <button type="button" class="btn btn-sm btn-danger mt-1 delete-image-btn"
                                data-image-id="{{ $img->id }}">Delete</button>
                            <div>
                                <input type="radio" name="main_image" value="{{ $idx }}" @if($img->is_main) checked
                                @endif> Main
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-3">
                    <label>Discount</label>
                    <select name="discount_id" class="form-control">
                        <option value="">No Discount</option>
                        @foreach($discounts as $discount)
                        <option value="{{ $discount->id }}"
                            {{ $product->discounts->first() && $product->discounts->first()->id == $discount->id ? 'selected' : '' }}>
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
            @if($product->options && count($product->options))
            @foreach($product->options as $idx => $option)
            <div class="row mb-2">
                <div class="col-3">
                    <input type="text" name="options[{{ $idx }}][option_type]" class="form-control"
                        placeholder="Option Type (e.g. size)" value="{{ $option->option_type }}">
                </div>
                <div class="col-3">
                    <input type="text" name="options[{{ $idx }}][option_value]" class="form-control"
                        placeholder="Option Value (e.g. M)" value="{{ $option->option_value }}">
                </div>
                <div class="col-3">
                    <input type="number" name="options[{{ $idx }}][quantity]" class="form-control"
                        placeholder="Quantity" value="{{ $option->quantity }}">
                </div>
                <div class="col-3">
                    <button type="button" class="btn btn-danger remove-option">-</button>
                </div>
            </div>
            @endforeach
            @else
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
            @endif
        </div>
        <button type="button" class="btn btn-success add-option">Add Option</button>
        <button type="submit" class="btn btn-primary mt-3">Update Product</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</div>
@push('scripts')
<script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('productDescription', {
    height: 300,
    removePlugins: 'easyimage,cloudservices',
    toolbar: [{
            name: 'document',
            items: ['Source', '-', 'Preview']
        },
        {
            name: 'clipboard',
            items: ['Undo', 'Redo']
        },
        {
            name: 'styles',
            items: ['Format', 'Font', 'FontSize']
        },
        {
            name: 'basicstyles',
            items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat']
        },
        {
            name: 'paragraph',
            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
        },
        {
            name: 'links',
            items: ['Link', 'Unlink']
        },
        {
            name: 'insert',
            items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar']
        },
        {
            name: 'tools',
            items: ['Maximize']
        }
    ]
});
</script>
@endpush
@endsection
@section('scripts')
<script src="{{ asset('js/product-edit.js') }}"></script>
@endsection