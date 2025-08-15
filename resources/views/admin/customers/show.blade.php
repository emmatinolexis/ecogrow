@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Customer Details</h2>
        <div class="card mb-3">
            <div class="card-header">Customer #{{ $customer->id }}</div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $customer->name }}</p>
                <p><strong>Email:</strong> {{ $customer->email }}</p>
                <p><strong>Registered At:</strong> {{ $customer->created_at }}</p>
                <p><strong>Status:</strong> {{ $customer->status ?? 'active' }}</p>
            </div>
        </div>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">Back to Customers</a>
    </div>
@endsection