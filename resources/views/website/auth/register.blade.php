@extends('website.master')
@section('content')
    <!-- Main Content -->
    <div class="mn-main-content">
        <div class="mn-breadcrumb m-b-30">
            <div class="row">
                <div class="col-12">
                    <div class="row gi_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="mn-breadcrumb-title">Register Page</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- mn-breadcrumb-list start -->
                            <ul class="mn-breadcrumb-list">
                                <li class="mn-breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="mn-breadcrumb-item active">Register Page</li>
                            </ul>
                            <!-- mn-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Register section -->
        <section class="mn-register p-b-15">
            <div class="mn-title d-none">
                <h2>Register<span></span></h2>
                <p>Best place to buy and sell digital products.</p>
            </div>
            <div class="row">
                <div class="mn-register-wrapper">
                    <div class="mn-register-container">
                        <div class="mn-register-form">
                            <form action="{{ route('customer.register.submit') }}" method="POST">
                                @csrf
                                <span class="mn-register-wrap">
                                    <label>Name*</label>
                                    <input type="text" name="name" placeholder="Enter your name" required
                                        value="{{ old('name') }}">
                                    @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
                                </span>
                                <span class="mn-register-wrap">
                                    <label>Email*</label>
                                    <input type="email" name="email" placeholder="Enter your email" required
                                        value="{{ old('email') }}">
                                    @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
                                </span>
                                <span class="mn-register-wrap">
                                    <label>Password*</label>
                                    <input type="password" name="password" placeholder="Enter password" required>
                                    @error('password')<div class="text-danger small">{{ $message }}</div>@enderror
                                </span>
                                <span class="mn-register-wrap">
                                    <label>Confirm Password*</label>
                                    <input type="password" name="password_confirmation" placeholder="Confirm password"
                                        required>
                                </span>
                                <span class="mn-register-wrap mn-register-btn">
                                    <span>Have an account? <a href="{{ route('login') }}">Login</a></span>
                                    <button class="mn-btn-1" type="submit"><span>Register</span></button>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection