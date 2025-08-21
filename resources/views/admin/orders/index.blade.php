@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.material.min.css">
@endsection

@section('content')
    <div class="container">
        <h2>All Orders</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="mb-3">
            <input type="text" id="ordersSearch" class="form-control" placeholder="Search orders...">
        </div>
        <div class="table-responsive">
            <table id="ordersTable" class="table table-striped table-bordered" style="width:100%">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                            <td>{{ $order->total_amount }}</td>
                            <td>{{ $order->order_status }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-edit btn-sm">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="customPaginationOrders" class="d-flex justify-content-center mt-3"></div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var table = $('#ordersTable').DataTable({
                responsive: true,
                dom: 'rt', // Remove DataTables default search and pagination
                pageLength: 10
            });
            // Custom search
            $('#ordersSearch').on('keyup', function () {
                table.search(this.value).draw();
            });
            // Custom pagination
            function renderPaginationOrders() {
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
                $('#customPaginationOrders').html(pagination);
            }
            renderPaginationOrders();
            $('#ordersTable').on('draw.dt', function () {
                renderPaginationOrders();
            });
            $('#customPaginationOrders').on('click', 'a.page-link', function (e) {
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