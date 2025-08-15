@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Admin Dashboard</h2>
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card text-center bg-secondary text-white shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <h3>{{ $orderCount ?? 0 }}</h3>
                    <hr>
                    <div class="small">Today: <b>{{ $ordersToday }}</b></div>
                    <div class="small">This Month: <b>{{ $ordersThisMonth }}</b></div>
                    <div class="small">Completed: <b>{{ $ordersCompleted }}</b></div>
                    <div class="small">Pending: <b>{{ $ordersPending }}</b></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-center bg-secondary text-white shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <h3>{{ $productCount }}</h3>
                    <hr>
                    <div class="small">Low Stock: <b>{{ $lowStockProducts->count() }}</b></div>
                    <div class="small">Active: <b>{{ $activeProductCount ?? '-' }}</b></div>
                    <div class="small">Inactive: <b>{{ $inactiveProductCount ?? '-' }}</b></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-center bg-secondary text-white shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <h3>{{ $userCount }}</h3>
                    <hr>
                    <div class="small">Admins: <b>{{ $adminCount ?? '-' }}</b></div>
                    <div class="small">Customers: <b>{{ $customerCount ?? '-' }}</b></div>
                    <div class="small">Active: <b>{{ $activeUserCount ?? '-' }}</b></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-center bg-secondary text-white shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Discounts</h5>
                    <h3>{{ $discountCount }}</h3>
                    <hr>
                    <div class="small">Active: <b>{{ $activeDiscountCount ?? '-' }}</b></div>
                    <div class="small">Expired: <b>{{ $expiredDiscountCount ?? '-' }}</b></div>
                    <div class="small">Upcoming: <b>{{ $upcomingDiscountCount ?? '-' }}</b></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Order Status Distribution</h5>
                </div>
                <div class="card-body">
                    <canvas id="orderStatusPie"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">User Types</h5>
                </div>
                <div class="card-body">
                    <canvas id="userTypePie"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Orders Per Month</h5>
                </div>
                <div class="card-body">
                    <canvas id="ordersBar"></canvas>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card border-info shadow">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Last 10 Orders</h5>
                </div>
                <div class="card-body p-0">
                    <div class="mb-3 p-3">
                        <input type="text" id="ordersDashboardSearch" class="form-control"
                            placeholder="Search orders...">
                    </div>
                    <table id="ordersDashboardTable" class="table table-striped table-bordered mb-0" style="width:100%">
                        <thead class="table-info">
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lastOrders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                                <td>{{ $order->total_amount }}</td>
                                <td>{{ $order->order_status }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                        class="btn btn-info btn-sm">View</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No recent orders!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div id="customPaginationOrdersDashboard" class="d-flex justify-content-center mt-3"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card border-danger shadow">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Products Getting Finished (Low Stock)</h5>
                </div>
                <div class="card-body p-0">
                    <div class="mb-3 p-3">
                        <input type="text" id="lowStockDashboardSearch" class="form-control"
                            placeholder="Search products...">
                    </div>
                    <table id="lowStockDashboardTable" class="table table-striped table-bordered mb-0"
                        style="width:100%">
                        <thead class="table-danger">
                            <tr>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>Brand</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lowStockProducts as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td><span class="badge bg-danger">{{ $product->quantity }}</span></td>
                                <td>{{ $product->category->name ?? '-' }}</td>
                                <td>{{ $product->brand->name ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No low stock products!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div id="customPaginationLowStockDashboard" class="d-flex justify-content-center mt-3"></div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// ======== Initialize Charts ========

// Prepare data from PHP as JSON-safe variables
const ordersCompleted = @json($ordersCompleted);
const ordersPending = @json($ordersPending);
const adminCount = @json($adminCount);
const customerCount = @json($customerCount);
const ordersPerMonthLabels = @json($ordersPerMonthLabels ?? []);
const ordersPerMonthData = @json($ordersPerMonthData ?? []);

// Order status pie chart
var orderStatusData = {
    labels: ['Completed', 'Pending'],
    datasets: [{
        data: [ordersCompleted, ordersPending],
        backgroundColor: ['#4caf50', '#ff9800'],
    }]
};

// User type pie chart
var userTypeData = {
    labels: ['Admins', 'Customers'],
    datasets: [{
        data: [adminCount, customerCount],
        backgroundColor: ['#1976d2', '#e91e63'],
    }]
};

// Orders per month bar chart
var ordersBarData = {
    labels: ordersPerMonthLabels,
    datasets: [{
        label: 'Orders',
        data: ordersPerMonthData,
        backgroundColor: '#2196f3',
    }]
};

document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('orderStatusPie')) {
        new Chart(document.getElementById('orderStatusPie'), {
            type: 'pie',
            data: orderStatusData,
            options: {
                responsive: true
            }
        });
    }

    if (document.getElementById('userTypePie')) {
        new Chart(document.getElementById('userTypePie'), {
            type: 'pie',
            data: userTypeData,
            options: {
                responsive: true
            }
        });
    }

    if (document.getElementById('ordersBar')) {
        new Chart(document.getElementById('ordersBar'), {
            type: 'bar',
            data: ordersBarData,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
});

// ======== DataTables ========
$(document).ready(function() {
    // --- Orders Table ---
    var ordersTable = $('#ordersDashboardTable').DataTable({
        responsive: true,
        scrollX: true,
        dom: 'rt',
        pageLength: 10
    });

    $('#ordersDashboardSearch').on('keyup', function() {
        ordersTable.search(this.value).draw();
    });

    function renderPaginationOrdersDashboard() {
        var info = ordersTable.page.info();
        var pagination = '<ul class="pagination pagination-lg">';
        pagination += '<li class="page-item' + (info.page === 0 ? ' disabled' : '') +
            '"><a class="page-link" href="#" data-page="prev">&laquo;</a></li>';
        for (var i = 0; i < info.pages; i++) {
            pagination += '<li class="page-item' + (info.page === i ? ' active' : '') +
                '"><a class="page-link" href="#" data-page="' + i + '">' + (i + 1) + '</a></li>';
        }
        pagination += '<li class="page-item' + (info.page === info.pages - 1 ? ' disabled' : '') +
            '"><a class="page-link" href="#" data-page="next">&raquo;</a></li></ul>';
        $('#customPaginationOrdersDashboard').html(pagination);
    }

    renderPaginationOrdersDashboard();
    $('#ordersDashboardTable').on('draw.dt', renderPaginationOrdersDashboard);

    $('#customPaginationOrdersDashboard').on('click', 'a.page-link', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        var info = ordersTable.page.info();
        if (page === 'prev' && info.page > 0) ordersTable.page(info.page - 1).draw('page');
        else if (page === 'next' && info.page < info.pages - 1) ordersTable.page(info.page + 1).draw(
            'page');
        else if (typeof page === 'number') ordersTable.page(page).draw('page');
    });

    // --- Low Stock Table ---
    var lowStockTable = $('#lowStockDashboardTable').DataTable({
        responsive: true,
        scrollX: true,
        dom: 'rt',
        pageLength: 10
    });

    $('#lowStockDashboardSearch').on('keyup', function() {
        lowStockTable.search(this.value).draw();
    });

    function renderPaginationLowStockDashboard() {
        var info = lowStockTable.page.info();
        var pagination = '<ul class="pagination pagination-lg">';
        pagination += '<li class="page-item' + (info.page === 0 ? ' disabled' : '') +
            '"><a class="page-link" href="#" data-page="prev">&laquo;</a></li>';
        for (var i = 0; i < info.pages; i++) {
            pagination += '<li class="page-item' + (info.page === i ? ' active' : '') +
                '"><a class="page-link" href="#" data-page="' + i + '">' + (i + 1) + '</a></li>';
        }
        pagination += '<li class="page-item' + (info.page === info.pages - 1 ? ' disabled' : '') +
            '"><a class="page-link" href="#" data-page="next">&raquo;</a></li></ul>';
        $('#customPaginationLowStockDashboard').html(pagination);
    }

    renderPaginationLowStockDashboard();
    $('#lowStockDashboardTable').on('draw.dt', renderPaginationLowStockDashboard);

    $('#customPaginationLowStockDashboard').on('click', 'a.page-link', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        var info = lowStockTable.page.info();
        if (page === 'prev' && info.page > 0) lowStockTable.page(info.page - 1).draw('page');
        else if (page === 'next' && info.page < info.pages - 1) lowStockTable.page(info.page + 1).draw(
            'page');
        else if (typeof page === 'number') lowStockTable.page(page).draw('page');
    });
});
</script>


@endsection