<x-layouts.master title="Purchase Orders" menutitle="Procurement">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>

    <div id="content" class="main-content">
        <div class="container-fluid mt-4">
            <div class="col-12 mt-3 mb-3 mt-3 pull-right" style="text-align:right">
                <a href="{{ route('purchase_orders.create') }}" class="btn btn-info">New Purchase Order</a>
            </div>
            <div class="col-10 offset-1">
                <div class="card shadow rounded-4">
                    <div class="card-header bg-primary rounded-top-4 d-flex justify-content-between align-items-center">
                        <h4 class="text-white mb-0">Purchase Orders</h4>                        
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered myDataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>PO Number</th>
                                    <th>Supplier</th>
                                    <th>Order Date</th>
                                    <th>Expected Delivery</th>
                                    <th>Status</th>
                                    <th>Approval</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchaseOrders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->po_number }}</td>
                                    <td>{{ $order->supplier->name ?? 'N/A' }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ $order->expected_delivery_date }}</td>
                                    <td>{!! getStatusBadge($order->status) !!}</td>
                                    <td>{!! getStatusBadge($order->approval_status) !!}</td>
                                    <td>
                                        <a href="{{ route('purchase_order_items.create', $order->po_id) }}" class="btn btn-sm btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <!-- Box icon -->
                                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                                                <!-- Plus sign -->
                                                <line x1="12" y1="10" x2="12" y2="16" />
                                                <line x1="9" y1="13" x2="15" y2="13" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('purchase_orders.edit', $order->po_id) }}" class="btn btn-sm btn-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M12 20h9"></path>
                                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('@assets/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script>
            applyDataTable();
        </script>
    </x-slot>
</x-layouts.master>
