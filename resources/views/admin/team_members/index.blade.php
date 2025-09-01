@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Team Members</h2>
            <a href="{{ route('admin.team_members.create') }}" class="btn btn-success">
                <span class="material-icons" style="vertical-align:middle;">person_add</span> Add Member
            </a>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>LinkedIn</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teamMembers as $member)
                    <tr>
                        <td>
                            @if($member->image)
                                <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" width="50" height="50"
                                    class="rounded-circle">
                            @else
                                <span class="material-icons">person</span>
                            @endif
                        </td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->position }}</td>
                        <td>
                            @if($member->linkedin_url)
                                <a href="{{ $member->linkedin_url }}" target="_blank">
                                    <span class="material-icons" style="vertical-align:middle;">linkedin</span>
                                </a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.team_members.edit', $member->id) }}"
                                class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.team_members.destroy', $member->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this member?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No team members found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection