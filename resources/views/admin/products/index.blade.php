@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Products</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3 ripple-surface">Add Product</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" action="" class="row g-3 mb-4 align-items-end">
            <div class="col-md-4">
                <div class="form-outline" data-mdb-input-init>
                    <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" />
                    <label class="form-label" for="search">Search by name, category, brand, quantity, price</label>
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary ripple-surface">Search</button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary ripple-surface">Reset</a>
            </div>
        </form>

        <div class="row">
            @forelse($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card shadow-3-strong h-100" style="border-radius: 18px;">
                        @php $main = $product->images->where('is_main', 1)->first(); @endphp
                        @if($main)
                            <img src="{{ asset('storage/' . $main->image_url) }}" class="card-img-top" alt="Main Image"
                                style="height:180px;object-fit:cover;border-top-left-radius: 18px; border-top-right-radius: 18px;">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                style="height:180px; border-top-left-radius: 18px; border-top-right-radius: 18px;">
                                <span class="text-muted">No Image</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                            <p class="card-text mb-1"><span
                                    class="badge bg-primary bg-opacity-10 text-primary">{{ $product->category->name ?? '-' }}</span>
                            </p>
                            <p class="card-text mb-1"><span
                                    class="badge bg-success bg-opacity-10 text-success">{{ $product->brand->name ?? '-' }}</span>
                            </p>
                            @if($product->active_discount)
                                <p class="card-text mb-1">
                                    <strong>Original:</strong> <span class="text-muted text-decoration-line-through">GHC
                                        {{ number_format($product->price, 2) }}</span><br>
                                    <strong>Discounted:</strong> <span class="text-success fw-bold">GHC
                                        {{ number_format($product->discounted_price, 2) }}</span>
                                    <span class="badge bg-danger ms-2">-{{ $product->active_discount->discount_percent }}%</span>
                                </p>
                            @else
                                <p class="card-text mb-1"><strong>Price:</strong> <span class="text-primary">GHC
                                        {{ number_format($product->price, 2) }}</span></p>
                            @endif
                            <p class="card-text mb-1"><strong>Quantity:</strong> <span
                                    class="text-dark">{{ $product->quantity }}</span></p>
                            <p class="card-text mb-1"><strong>Status:</strong> <span
                                    class="{{ $product->status == 'active' ? 'text-success' : 'text-danger' }}">{{ ucfirst($product->status) }}</span>
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0 d-flex justify-content-between">
                            <a href="{{ route('products.edit', $product) }}"
                                class="btn btn-warning btn-rounded btn-sm ripple-surface">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-rounded btn-sm ripple-surface"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">No products found.</div>
                </div>
            @endforelse
        </div>
        <div class="d-flex justify-content-center mt-4">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection