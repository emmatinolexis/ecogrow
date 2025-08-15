@extends('layouts.app')
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.material.min.css">
@endsection
@section('content')
<div class="container">
    <h2>Users</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add User</a>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="mb-3">
        <input type="text" id="usersSearch" class="form-control" placeholder="Search users...">
    </div>
    <div class="table-responsive">
        <table id="usersTable" class="table table-striped table-bordered datatable" style="width:100%">
            <thead class="table-primary">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->user_type) }}</td>
                    <td>{{ ucfirst($user->status) }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="customPaginationUsers" class="d-flex justify-content-center mt-3"></div>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    var table = $('#usersTable').DataTable({
        responsive: true,
        dom: 'rt', // Remove DataTables default search and pagination
        pageLength: 10
    });
    // Custom search
    $('#usersSearch').on('keyup', function() {
        table.search(this.value).draw();
    });
    // Custom pagination
    function renderPaginationUsers() {
        var info = table.page.info();
        var pagination = '';
        pagination += '<ul class="pagination pagination-lg">';
        pagination += '<li class="page-item' + (info.page === 0 ? ' disabled' : '') +
            '"><a class="page-link" href="#" data-page="prev">&laquo;</a></li>';
        for (var i = 0; i < info.pages; i++) {
            pagination += '<li class="page-item' + (info.page === i ? ' active' : '') +
                '"><a class="page-link" href="#" data-page="' + i + '">' + (i + 1) + '</a></li>';
        }
        pagination += '<li class="page-item' + (info.page === info.pages - 1 ? ' disabled' : '') +
            '"><a class="page-link" href="#" data-page="next">&raquo;</a></li>';
        pagination += '</ul>';
        $('#customPaginationUsers').html(pagination);
    }
    renderPaginationUsers();
    $('#usersTable').on('draw.dt', function() {
        renderPaginationUsers();
    });
    $('#customPaginationUsers').on('click', 'a.page-link', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        var info = table.page.info();
        if (page === 'prev' && info.page > 0) {
            table.page(info.page - 1).draw('page');
        } else if (page === 'next' && info.page < info.pages - 1) {
            table.page(info.page + 1).draw('page');
        } else if (typeof page === 'number') {
            table.page(page).draw('page');
        }
    });
});
</script>
@endsection