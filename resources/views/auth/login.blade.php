@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 400px;">
        <div class="text-center mb-4">
            <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo" class="mb-2"
                style="border-radius: 50px; height: 200px; width: 200px;">
        </div>
        <h2 class="mb-4">Admin Login</h2>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required
                    autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
@endsection