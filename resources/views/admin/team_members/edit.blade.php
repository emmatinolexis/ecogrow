@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Edit Team Member</h2>
        <form action="{{ route('admin.team_members.update', $teamMember->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $teamMember->name) }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" name="position" id="position" class="form-control"
                    value="{{ old('position', $teamMember->position) }}" required>
            </div>
            <div class="mb-3">
                <label for="linkedin_url" class="form-label">LinkedIn URL</label>
                <input type="url" name="linkedin_url" id="linkedin_url" class="form-control"
                    value="{{ old('linkedin_url', $teamMember->linkedin_url) }}">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @if($teamMember->image)
                    <img src="{{ asset('storage/' . $teamMember->image) }}" alt="{{ $teamMember->name }}" width="80" height="80"
                        class="rounded-circle mt-2">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update Member</button>
            <a href="{{ route('admin.team_members.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection