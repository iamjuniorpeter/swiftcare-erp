<x-layouts.master title="Edit Purchase Order Item" menutitle="Procurement">
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>

    <div class="container-fluid mt-5 mb-5">
        <div class="col-12 mb-5 mt-5 pull-right" style="text-align:right">
            <a href="{{ route('purchase_order_items.create', $purchaseOrderItem->poID) }}" class="btn btn-info">View Purchase Order Items</a>
        </div>
        <div class="col-lg-8 offset-lg-2">
            <div class="card shadow rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0 text-white">Edit Purchase Order Item</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('purchase_order_items.update', $poi_id) }}" id="frmSavePurchaseOrderItem" name="frmSavePurchaseOrderItem">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Item</label>
                            <select class="form-control select2" name="itemID" required>
                                @foreach($items as $item)
                                    <option value="{{ $item->item_id }}" {{ $purchaseOrderItem->itemID == $item->item_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Quantity</label>
                            <input type="number" step="0.01" name="quantity" value="{{ $purchaseOrderItem->quantity }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Unit Price</label>
                            <input type="number" step="0.01" name="unit_price" value="{{ $purchaseOrderItem->unit_price }}" class="form-control" required>
                        </div>

                        <div class="text-right">
                            <input type="hidden" name="po_id" class="form-control" value="{{ $purchaseOrderItem->poID }}">
                            <input type="hidden" name="poi_id" class="form-control" value="{{ $poi_id }}">
                            <button type="submit" class="btn btn-primary btn-lg mt-3 mb-3" id="btnSavePurchaseOrderItem">Update Item</button>
                        </div>
                    </form>
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