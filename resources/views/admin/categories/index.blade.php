@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Categories</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <a href="{{ route('categories.create') }}" class="btn btn-create mb-3">Add Category</a>
        <div class="mb-3">
            <input type="text" id="categoriesSearch" class="form-control" placeholder="Search categories...">
        </div>
        <table id="categoriesTable" class="table table-striped table-bordered" style="width:100%">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Parent</th>
                    <th>Icon</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->parent ? $category->parent->name : 'None' }}</td>
                        <td>
                            @if($category->icon_url)
                                <img src="{{ $category->icon_url }}" alt="icon" width="32" height="32">
                            @endif
                        </td>
                        <td>{{ ucfirst($category->status) }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-edit btn-sm">Edit</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div id="customPaginationCategories" class="d-flex justify-content-center mt-3"></div>

        @push('scripts')
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.material.min.css">
            <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.6/js/dataTables.material.min.js"></script>
            <script>
                $(document).ready(function () {
                    var table = $('#categoriesTable').DataTable({
                        responsive: true,
                        dom: 'rt', // Remove DataTables default search and pagination
                        pageLength: 10
                    });
                    // Custom search
                    $('#categoriesSearch').on('keyup', function () {
                        table.search(this.value).draw();
                    });
                    // Custom pagination
                    function renderPaginationCategories() {
                        var info = table.page.info();
                        var pagination = '';
                        pagination += '<ul class="pagination pagination-lg">';
                        pagination += '<li class="page-item' + (info.page === 0 ? ' disabled' : '') + '"><a class="page-link" href="#" data-page="prev">&laquo;</a></li>';
                        for (var i = 0; i < info.pages; i++) {
                            pagination += '<li class="page-item' + (info.page === i ? ' active' : '') + '"><a class="page-link" href="#" data-page="' + i + '">' + (i + 1) + '</a></li>';
                        }
                        pagination += '<li class="page-item' + (info.page === info.pages - 1 ? ' disabled' : '') + '"><a class="page-link" href="#" data-page="next">&raquo;</a></li>';
                        pagination += '</ul>';
                        $('#customPaginationCategories').html(pagination);
                    }
                    renderPaginationCategories();
                    $('#categoriesTable').on('draw.dt', function () {
                        renderPaginationCategories();
                    });
                    $('#customPaginationCategories').on('click', 'a.page-link', function (e) {
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
        @endpush
    </div>
@endsection