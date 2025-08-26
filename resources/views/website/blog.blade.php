@extends('website.master')
@php($search = $search ?? '')
@section('content')

    <!-- Main Content -->
    <div class="mn-main-content">
        <div class="mn-breadcrumb m-b-30">
            <div class="row">
                <div class="col-12">
                    <div class="row gi_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="mn-breadcrumb-title">Insights</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- mn-breadcrumb-list start -->
                            <ul class="mn-breadcrumb-list">
                                <li class="mn-breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                                <li class="mn-breadcrumb-item active">Insights</li>
                            </ul>
                            <!-- mn-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-b-30">
            <div class="mn-blogs-rightside col-lg-8 col-md-12">
                <!-- Blog content Start -->
                <div class="mn-blogs-content mn-blog">
                    <form method="GET" action="{{ route('website.blog') }}" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search Our Blog"
                                value="{{ $search }}">
                            <button class="btn btn-success" type="submit"><i class="ri-search-line"></i> Search</button>
                        </div>
                    </form>
                    <div class="mn-blogs-inner">
                        <div class="row">
                            @forelse($blogs as $blog)
                                <div class="col-sm-6 col-12 mn-blog-block m-b-24">
                                    <div class="mn-blog-card">
                                        <div class="blog-info">
                                            <figure class="blog-img">
                                                <a href="{{ route('website.blog.details', $blog->id) }}">
                                                    @if($blog->display_image)
                                                        <img src="{{ asset('storage/' . $blog->display_image) }}" alt="blog image">
                                                    @else
                                                        <img src="https://via.placeholder.com/350x200?text=No+Image" alt="No image">
                                                    @endif
                                                </a>
                                            </figure>
                                            <div class="detail">
                                                <label>{{ $blog->created_at->format('M d, Y') }}</label>
                                                <h3><a
                                                        href="{{ route('website.blog.details', $blog->id) }}">{{ $blog->title }}</a>
                                                </h3>
                                                <div class="more-info">
                                                    <a href="{{ route('website.blog.details', $blog->id) }}">Read More<i
                                                            class="ri-arrow-right-double-line"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-warning">No blogs found.</div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <!-- Pagination Start -->
                    <div class="mn-pro-pagination">
                        <span>Showing {{ $blogs->firstItem() }}-{{ $blogs->lastItem() }} of {{ $blogs->total() }}
                            items</span>
                        <div>
                            {{ $blogs->links() }}
                        </div>
                    </div>
                    <!-- Pagination End -->
                </div>
                <!--Blog content End -->
            </div>

            <!-- Sidebar Area Start -->
            <div class="mn-blogs-sidebar mn-blogs-leftside col-lg-4 col-md-12 m-t-991">
                <!-- Recent Products Sidebar -->
                <div class="mn-blog-sidebar-wrap">
                    <div class="mn-sidebar-block mn-sidebar-recent-blog">
                        <div class="mn-sb-title">
                            <h3 class="mn-sidebar-title">Recent Products</h3>
                        </div>
                        <div class="mn-blog-block-content mn-sidebar-dropdown">
                            @forelse($recentProducts as $product)
                                <div class="mn-sidebar-block-item mb-2">
                                    <div class="mn-sidebar-block-img">
                                        <img src="{{ $product->images->first() ? asset('storage/' . $product->images->first()->image_url) : asset('images/default.png') }}"
                                            alt="{{ $product->name }}">
                                    </div>
                                    <div class="mn-sidebar-block-detial">
                                        <h5 class="mn-blog-title"><a
                                                href="{{ route('website.product.details', $product->id) }}">{{ $product->name }}</a>
                                        </h5>
                                        <div class="mn-blog-date">GHS {{ number_format($product->price, 2) }}</div>
                                        <a
                                            href="{{ route('website.product.details', $product->id) }}">{{ $product->category->name ?? '' }}</a>
                                    </div>
                                </div>
                            @empty
                                <div class="mn-sidebar-block-item">No recent products found.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection