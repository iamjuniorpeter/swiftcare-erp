<x-layouts.master title="Add Purchase Order Item" menutitle="Procurement">
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>

    <div class="container-fluid mt-5 mb-5">
        <div class="col-12 mb-5 mt-5 pull-right" style="text-align:right">
            <a href="{{ route('purchase_orders.create') }}" class="btn btn-info">View Purchase Orders</a>
        </div>
        <div class="col-lg-8 offset-lg-2 mt-5">
            <div class="card shadow rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0 text-white">Add Purchase Order Item</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('purchase_order_items.store') }}" id="frmSavePurchaseOrderItem" name="frmSavePurchaseOrderItem">
                        @csrf

                        <div class="mb-3">
                            <label>Item</label>
                            <select class="form-control select2" name="itemID" required>
                                <option value="">Select Item</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->item_id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label>Quantity</label>
                            <input type="number" step="0.01" name="quantity" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Unit Price</label>
                            <input type="number" step="0.01" name="unit_price" class="form-control" required>
                        </div>

                        <div class="text-right">
                            <input type="hidden" name="po_id" class="form-control" value="{{ $po_id }}">
                            <button type="submit" class="btn btn-lg btn-primary mt-3 mb-3" id="btnSavePurchaseOrderItem">Save Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-10 offset-1 mt-5">
            <div class="card shadow rounded-4">
                <div class="card-header bg-primary rounded-top-4 d-flex justify-content-between align-items-center">
                    <h4 class="text-white mb-0">Purchase Order Items</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>PO Number</th>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchaseOrderItems as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->purchaseOrder->po_number ?? 'N/A' }}</td>
                                <td>{{ $item->item->name ?? 'N/A' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->unit_price }}</td>
                                <td>
                                    <a href="{{ route('purchase_order_items.edit', $item->poi_id) }}" class="btn btn-sm btn-warning">
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

    <x-slot name="scripts">
        <script src="{{ asset('@assets/plugins/select2/select2.min.js') }}"></script>
        <script>
            applySelect2(['.select2']);
            savePurchaseOrderItem();
        </script>
    </x-slot>
</x-layouts.master>