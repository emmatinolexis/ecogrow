@extends('website.master')
@section('content')
<div class="mn-main-content">
    <h2 class="mb-4">My Profile</h2>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('website.profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', auth()->user()->name) }}" required>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}"
                        disabled>
                </div>
            </div>
        </div>
        <hr>
        <h5>Change Password</h5>
        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" name="current_password" id="current_password" class="form-control">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm New Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
        <button type="submit" class="btn btn-success"><span class="material-icons"
                style="vertical-align:middle;">save</span> Update Profile</button>
    </form>
</div>
@endsection