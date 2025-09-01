@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Add Team Member</h2>
        <form action="{{ route('admin.team_members.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" name="position" id="position" class="form-control" value="{{ old('position') }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="linkedin_url" class="form-label">LinkedIn URL</label>
                <input type="url" name="linkedin_url" id="linkedin_url" class="form-control"
                    value="{{ old('linkedin_url') }}">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Add Member</button>
            <a href="{{ route('admin.team_members.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection