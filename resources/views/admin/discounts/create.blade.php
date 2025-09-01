@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Add Discount</h2>
        <form action="{{ route('discounts.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Code</label>
                <input type="text" name="code" class="form-control" required value="{{ old('code') }}">
                @error('code')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label>Description</label>
                <input type="text" name="description" class="form-control" value="{{ old('description') }}">
                @error('description')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label>Discount Percent</label>
                <input type="number" name="discount_percent" class="form-control" min="0" max="100" step="0.01" required
                    value="{{ old('discount_percent') }}">
                @error('discount_percent')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label>Valid From</label>
                <input type="date" name="valid_from" class="form-control" required value="{{ old('valid_from') }}">
                @error('valid_from')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label>Valid To</label>
                <input type="date" name="valid_to" class="form-control" required value="{{ old('valid_to') }}">
                @error('valid_to')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')<div class="text-danger">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-success">
                <span class="material-icons" style="vertical-align:middle;">local_offer</span> Add Discount
            </button>
            <a href="{{ route('discounts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection