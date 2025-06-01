<x-layouts.master title="Create Purchase Order" menutitle="Procurement">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>

    <div id="content" class="main-content">
        <div class="container-fluid mt-4">
            <div class="col-12 mt-3 mb-3 mt-3 pull-right" style="text-align:right">
                <a href="{{ route('purchase_orders.index') }}" class="btn btn-info">View Purchase Order</a>
            </div>
            <div class="col-lg-10 offset-lg-1">
                <div class="card shadow rounded-4 mb-5">
                    <div class="card-header bg-primary rounded-top-4">
                        <h4 class="text-white mb-0">New Purchase Order</h4>
                    </div>
                    <form method="POST" action="{{ route('purchase_orders.store') }}" id="frmSavePurchaseOrder" name="frmSavePurchaseOrder">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label for="supplierID" class="form-label">Supplier</label>
                                    <select name="supplier_id" id="supplier_id" class="form-control cmbSelect2" required>
                                        <option value="">-- Select Supplier --</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->supplier_id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-4">
                                    <label for="order_date" class="form-label">Order Date</label>
                                    <input type="date" name="order_date" id="order_date" class="form-control" required>
                                </div>

                                <div class="mb-3 col-4">
                                    <label for="expected_delivery_date" class="form-label">Expected Delivery Date</label>
                                    <input type="date" name="expected_delivery_date" id="expected_delivery_date" class="form-control">
                                </div>

                                <div class="mb-3 col-4">
                                    <label for="actual_delivery_date" class="form-label">Actual Delivery Date</label>
                                    <input type="date" name="actual_delivery_date" id="actual_delivery_date" class="form-control">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="mb-3 col-4">
                                    <label for="payment_terms" class="form-label">Payment Terms</label>
                                    <input type="text" name="payment_terms" id="payment_terms" class="form-control">
                                </div>

                                <div class="mb-3 col-4">
                                    <label for="approval_status" class="form-label">Approval Status</label>
                                    <select name="approval_status" class="form-control cmbSelect2">
                                        <option value="pending">Pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-4">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-control cmbSelect2">
                                        <option value="pending">Pending</option>
                                        <option value="received">Received</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-4">
                                    <label for="delivery_address" class="form-label">Delivery Address</label>
                                    <textarea name="delivery_address" class="form-control" rows="2"></textarea>
                                </div>

                                <div class="mb-3 col-4">
                                    <label for="shipping_details" class="form-label">Shipping Details</label>
                                    <textarea name="shipping_details" class="form-control" rows="2"></textarea>
                                </div>

                                <div class="mb-3 col-4">
                                    <label for="remarks" class="form-label">Remarks</label>
                                    <textarea name="remarks" class="form-control" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="text-end text-right">
                                <input type="hidden" id="merchantID" name="merchantID" class="form-control" value="{{ Auth::user()->accountID }}">

                                <button type="submit" class="btn btn-lg btn-primary mt-3" id="btnSavePurchaseOrder">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('@assets/plugins/select2/select2.min.js') }}"></script>
        <script>
            applySelect2([".cmbSelect2"]);
            savePurchaseOrder();
        </script>
    </x-slot>
</x-layouts.master>
