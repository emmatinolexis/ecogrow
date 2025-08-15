@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Discounts</h2>
    <a href="{{ route('discounts.create') }}" class="btn btn-primary mb-3 ripple-surface">Add Discount</a>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="mb-3">
        <input type="text" id="discountsSearch" class="form-control" placeholder="Search discounts...">
    </div>
    <table id="discountsTable" class="table table-striped table-bordered" style="width:100%">
        <thead class="table-primary">
            <tr>
                <th>Code</th>
                <th>Description</th>
                <th>Percent</th>
                <th>Valid From</th>
                <th>Valid To</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($discounts as $discount)
            <tr>
                <td>{{ $discount->code }}</td>
                <td>{{ $discount->description }}</td>
                <td>{{ $discount->discount_percent }}%</td>
                <td>{{ $discount->valid_from }}</td>
                <td>{{ $discount->valid_to }}</td>
                <td>{{ ucfirst($discount->status) }}</td>
                <td>
                    <a href="{{ route('discounts.edit', $discount) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('discounts.destroy', $discount) }}" method="POST"
                        style="display:inline-block;">
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
    <div id="customPaginationDiscounts" class="d-flex justify-content-center mt-3"></div>
</div>
@endsection
@section('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.material.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.material.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#discountsTable').DataTable({
        responsive: true,
        dom: 'rt', // Remove DataTables default search and pagination
        pageLength: 10
    });
    // Custom search
    $('#discountsSearch').on('keyup', function() {
        table.search(this.value).draw();
    });
    // Custom pagination
    function renderPaginationDiscounts() {
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
        $('#customPaginationDiscounts').html(pagination);
    }
    renderPaginationDiscounts();
    $('#discountsTable').on('draw.dt', function() {
        renderPaginationDiscounts();
    });
    $('#customPaginationDiscounts').on('click', 'a.page-link', function(e) {
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