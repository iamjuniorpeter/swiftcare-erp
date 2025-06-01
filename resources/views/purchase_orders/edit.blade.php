<x-layouts.master title="Edit Purchase Order" menutitle="Procurement">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>

    <div id="content" class="main-content">
        <div class="container-fluid mt-4">
            <div class="col-12 mt-3 mb-3 mt-3 pull-right" style="text-align:right">
                <a href="{{ route('purchase_orders.index') }}" class="btn btn-info">View Purchase Orders</a>
            </div>
            <div class="col-lg-8 offset-lg-2 mb-5">
                <div class="card shadow rounded-4">
                    <div class="card-header bg-primary rounded-top-4">
                        <h4 class="text-white mb-0">Edit Purchase Order</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('purchase_orders.update', $purchaseOrder->po_id) }}" method="POST" id="frmSavePurchaseOrder" name="frmSavePurchaseOrder">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="supplierID" class="form-label">Supplier</label>
                                <select class="form-control cmbSelect2" name="supplier_id" required>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->supplier_id }}" {{ $purchaseOrder->supplierID == $supplier->supplier_id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row mt-3">
                                <div class="mb-3 col-4">
                                    <label for="order_date" class="form-label">Order Date</label>
                                    <input type="date" class="form-control" name="order_date" value="{{ $purchaseOrder->order_date }}">
                                </div>

                                <div class="mb-3 col-4">
                                    <label for="expected_delivery_date" class="form-label">Expected Delivery Date</label>
                                    <input type="date" class="form-control" name="expected_delivery_date" value="{{ $purchaseOrder->expected_delivery_date }}">
                                </div>

                                <div class="mb-3 col-4">
                                    <label for="actual_delivery_date" class="form-label">Actual Delivery Date</label>
                                    <input type="date" class="form-control" name="actual_delivery_date" value="{{ $purchaseOrder->actual_delivery_date }}">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="mb-3 col-4">
                                    <label for="payment_terms" class="form-label">Payment Terms</label>
                                    <input type="text" class="form-control" name="payment_terms" value="{{ $purchaseOrder->payment_terms }}">
                                </div>

                                <div class="mb-3 col-4">
                                    <label for="approval_status" class="form-label">Approval Status</label>
                                    <select name="approval_status" class="form-control">
                                        <option value="pending" {{ $purchaseOrder->approval_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ $purchaseOrder->approval_status == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ $purchaseOrder->approval_status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="pending" {{ $purchaseOrder->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="received" {{ $purchaseOrder->status == 'received' ? 'selected' : '' }}>Received</option>
                                        <option value="cancelled" {{ $purchaseOrder->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                            </div>

                             <div class="row mt-3">
                                <div class="mb-3 col-4">
                                    <label for="delivery_address" class="form-label">Delivery Address</label>
                                    <textarea name="delivery_address" class="form-control">{{ $purchaseOrder->delivery_address }}</textarea>
                                </div>

                                <div class="mb-3 col-4">
                                    <label for="shipping_details" class="form-label">Shipping Details</label>
                                    <textarea name="shipping_details" class="form-control">{{ $purchaseOrder->shipping_details }}</textarea>
                                </div>

                                <div class="mb-3 col-4">
                                    <label for="remarks" class="form-label">Remarks</label>
                                    <textarea name="remarks" class="form-control">{{ $purchaseOrder->remarks }}</textarea>
                                </div>
                            </div>
                            

                            <div class="text-right">
                                <input type="hidden" class="form-control" name="po_number" value="{{ $purchaseOrder->po_number }}">
                                <input type="hidden" id="merchantID" name="merchantID" class="form-control" value="{{ Auth::user()->accountID }}">
                                <button type="submit" class="btn btn-lg btn-primary mt-3" id="btnSavePurchaseOrder">Update Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('@assets/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script>
            applySelect2([".cmbSelect2"]);
            savePurchaseOrder();
        </script>
    </x-slot>
</x-layouts.master>
