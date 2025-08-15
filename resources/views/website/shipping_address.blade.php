@extends('website.master')
@section('content')
    <!-- Main Content -->
    <div class="mn-main-content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="mn-breadcrumb m-b-30">
            <div class="row">
                <div class="col-12">
                    <div class="row gi_breadcrumb_inner">
                        <div class="col-md-6 col-sm-12">
                            <h2 class="mn-breadcrumb-title">Shipping Address</h2>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <!-- mn-breadcrumb-list start -->
                            <ul class="mn-breadcrumb-list">
                                <li class="mn-breadcrumb-item"><a href="">Home</a></li>
                                <li class="mn-breadcrumb-item active">Shipping Address</li>
                            </ul>
                            <!-- mn-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- List existing addresses -->
        @if(isset($addresses) && $addresses->count())
            <table class="table table-bordered">
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($addresses as $address)
                        <tr>
                            <form action="{{ route('shipping_addresses.update', $address->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <td><input type="text" name="address_line_1" value="{{ $address->address_line_1 }}"
                                        class="form-control" required></td>
                                <td><input type="text" name="address_line_2" value="{{ $address->address_line_2 }}"
                                        class="form-control">
                                </td>
                                <td><input type="text" name="city" value="{{ $address->city }}" class="form-control" required></td>
                                <td><input type="text" name="state" value="{{ $address->state }}" class="form-control" required>
                                </td>
                                <td><input type="text" name="country" value="{{ $address->country }}" class="form-control" required>
                                </td>
                                <td><input type="text" name="postal_code" value="{{ $address->postal_code }}" class="form-control"
                                        required></td>
                                <td><input type="text" name="phone_number" value="{{ $address->phone_number }}"
                                        class="form-control"></td>
                                <td>
                                    <select name="is_default" class="form-control">
                                        <option value="0" {{ !$address->is_default ? 'selected' : '' }}>No
                                        </option>
                                        <option value="1" {{ $address->is_default ? 'selected' : '' }}>Yes
                                        </option>
                                    </select>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </form>
                            <form class="m-t-15" action="{{ route('shipping_addresses.destroy', $address->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm m-t-10"
                                    onclick="return confirm('Delete this address?')">Delete</button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No shipping addresses found.</p>
        @endif
        <hr>
        <!-- Add new address form -->
        <h4>Add New Address</h4>
        <form action="{{ route('shipping_addresses.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label>Address Line 1*</label>
                    <input type="text" name="address_line_1" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Address Line 2</label>
                    <input type="text" name="address_line_2" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>City*</label>
                    <input type="text" name="city" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>State*</label>
                    <input type="text" name="state" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Country*</label>
                    <input type="text" name="country" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Postal Code*</label>
                    <input type="text" name="postal_code" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Default</label>
                    <select name="is_default" class="form-control">
                        <option value="0" selected>No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success m-t-15 m-b-15">Add Address</button>
        </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    </div>
    </section>
    </div>
@endsection