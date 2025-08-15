@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Brands</h2>
    <a href="{{ route('brands.create') }}" class="btn btn-primary mb-3">Add Brand</a>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="mb-3">
        <input type="text" id="brandsSearch" class="form-control" placeholder="Search brands...">
    </div>
    <table id="brandsTable" class="table table-striped table-bordered" style="width:100%">
        <thead class="table-primary">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Logo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
            <tr>
                <td>{{ $brand->name }}</td>
                <td>{{ $brand->description }}</td>
                <td>
                    @if($brand->logo_url)
                    <img src="{{ asset('storage/' . $brand->logo_url) }}" alt="Logo" height="40">
                    @endif
                </td>
                <td>
                    <a href="{{ route('brands.edit', $brand) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('brands.destroy', $brand) }}" method="POST" style="display:inline-block;">
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
    <div id="customPaginationBrands" class="d-flex justify-content-center mt-3"></div>
</div>
@endsection
@section('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.material.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.material.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('#brandsTable').DataTable({
        responsive: true,
        dom: 'rt', // Remove DataTables default search and pagination
        pageLength: 10
    });
    // Custom search
    $('#brandsSearch').on('keyup', function() {
        table.search(this.value).draw();
    });
    // Custom pagination
    function renderPaginationBrands() {
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
        $('#customPaginationBrands').html(pagination);
    }
    renderPaginationBrands();
    $('#brandsTable').on('draw.dt', function() {
        renderPaginationBrands();
    });
    $('#customPaginationBrands').on('click', 'a.page-link', function(e) {
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