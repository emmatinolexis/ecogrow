@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Customers</h2>
    <div class="mb-3">
        <input type="text" id="customerSearch" class="form-control" placeholder="Search customers...">
    </div>
    <table id="customersTable" class="table table-striped table-bordered" style="width:100%">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Registered At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->created_at }}</td>
                <td>
                    <a href="{{ route('admin.customers.show', $customer->id) }}" class="btn btn-info btn-sm">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div id="customPagination" class="d-flex justify-content-center mt-3"></div>
</div>
@endsection
@section('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.material.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.material.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#customersTable').DataTable({
        responsive: true,
        dom: 'rt', // Remove DataTables default search and pagination
        pageLength: 10
    });
    // Custom search
    $('#customerSearch').on('keyup', function() {
        table.search(this.value).draw();
    });
    // Custom pagination
    function renderPagination() {
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
        $('#customPagination').html(pagination);
    }
    renderPagination();
    $('#customersTable').on('draw.dt', function() {
        renderPagination();
    });
    $('#customPagination').on('click', 'a.page-link', function(e) {
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