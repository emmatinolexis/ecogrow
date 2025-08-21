@extends('website.master')
@section('content')
<div class="mn-main-content">
    <div class="mn-breadcrumb m-b-30">
        <div class="row">
            <div class="col-12">
                <div class="row gi_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="mn-breadcrumb-title">Blog Page</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <!-- mn-breadcrumb-list start -->
                        <ul class="mn-breadcrumb-list">
                            <li class="mn-breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                            <li class="mn-breadcrumb-item active">Blog Page</li>
                        </ul>
                        <!-- mn-breadcrumb-list end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-b-30">
        <div class="mn-blogs-rightside col-md-12">
            <!-- Blog content Start -->
            <div class="mn-blogs-content">
                <div class="mn-blogs-inner">
                    <div class="mn-single-blog-item">
                        <div class="single-blog-info">
                            <figure class="blog-img"><a href="#"><img
                                        src="{{ asset('storage/' . $blog->display_image) }}"
                                        style="width: fit-content; height: fix-content;" alt="news imag"></a>
                            </figure>
                            <div class="single-blog-detail">
                                <label>Created: {{ $blog->created_at }}</label>
                                <h3>{{ $blog->title }}</h3>
                                {!! nl2br(e($blog->blog_details)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection