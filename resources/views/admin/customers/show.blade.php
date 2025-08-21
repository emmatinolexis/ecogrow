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
        <div class="card mb-3">
            <div class="card-header">Shipping Addresses</div>
            <div class="card-body">
                @if($shippingAddresses->count())
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Address Line 1</th>
                                <th>Address Line 2</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Postal Code</th>
                                <th>Phone Number</th>
                                <th>Default</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shippingAddresses as $address)
                                <tr>
                                    <td>{{ $address->address_line_1 }}</td>
                                    <td>{{ $address->address_line_2 }}</td>
                                    <td>{{ $address->city }}</td>
                                    <td>{{ $address->state }}</td>
                                    <td>{{ $address->country }}</td>
                                    <td>{{ $address->postal_code }}</td>
                                    <td>{{ $address->phone_number }}</td>
                                    <td>{{ $address->is_default ? 'Yes' : 'No' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No shipping addresses found for this customer.</p>
                @endif
            </div>
        </div>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">Back to Customers</a>
    </div>
@endsection