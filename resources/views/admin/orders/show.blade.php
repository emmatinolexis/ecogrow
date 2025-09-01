@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2>Order Details</h2>
            <button class="btn btn-success" onclick="window.printOrderDetails()">
                <span class="material-icons" style="vertical-align:middle;">print</span> Print
            </button>
        </div>
        <div id="orderDetailsPrint">
            <div class="card mb-3">
                <div class="card-header">Order #{{ $order->id }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p><strong>User:</strong> {{ $order->user->name ?? 'N/A' }}</p>
                            <p><strong>Total Amount:</strong> {{ $order->total_amount }}</p>
                            <p><strong>Status:</strong> {{ $order->order_status }}</p>
                            <p><strong>Created At:</strong> {{ $order->created_at }}</p>
                        </div>
                        <div class="col-6">
                            <p><strong>Shipping Address:</strong><br>
                                {{ $order->shippingAddress->address_line_1 ?? '' }}<br>
                                @if($order->shippingAddress->address_line_2)
                                    {{ $order->shippingAddress->address_line_2 }}<br>
                                @endif
                                {{ $order->shippingAddress->city ?? '' }}, {{ $order->shippingAddress->state ?? '' }}<br>
                                {{ $order->shippingAddress->country ?? '' }}<br>
                                @if($order->shippingAddress->postal_code)
                                    Postal Code: {{ $order->shippingAddress->postal_code }}<br>
                                @endif
                                @if($order->shippingAddress->phone_number)
                                    Phone: {{ $order->shippingAddress->phone_number }}<br>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <h4>Order Items</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Options</th>
                        <th>Quantity</th>
                        <th>Price at Purchase</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name ?? 'N/A' }}</td>
                            <td>
                                @if($item->options && $item->options->count())
                                    <ul class="mb-0 ps-3">
                                        @foreach($item->options as $option)
                                            <li>
                                                <strong>{{ ucfirst($option->option_type) }}:</strong> {{ $option->option_value }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted">No options</span>
                                @endif
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->price_at_purchase }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
    </div>
@endsection

@section('scripts')
    <script>
        window.printOrderDetails = function () {
            var printContents = document.getElementById('orderDetailsPrint').innerHTML;
            var printWindow = window.open('', '', 'height=800,width=900');
            printWindow.document.write('<html><head><title>Order Details</title>');
            printWindow.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">');
            printWindow.document.write('<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">');
            printWindow.document.write('<style>body{background:#f5f7fa;} .card{box-shadow:0 4px 24px rgba(0,0,0,0.08);} .table{background:#fff;} </style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(printContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.focus();
            setTimeout(function () { printWindow.print(); printWindow.close(); }, 500);
        }
    </script>
@endsection