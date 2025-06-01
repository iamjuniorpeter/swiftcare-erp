<x-layouts.master title="View Purchase Order Item" menutitle="Procurement">
    <div class="container-fluid mt-4">
        <div class="col-lg-8 offset-lg-2">
            <div class="card shadow rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h4 class="mb-0">Purchase Order Item Details</h4>
                </div>
                <div class="card-body">
                    <p><strong>PO Number:</strong> {{ $purchaseOrderItem->purchaseOrder->po_number ?? 'N/A' }}</p>
                    <p><strong>Item:</strong> {{ $purchaseOrderItem->item->name ?? 'N/A' }}</p>
                    <p><strong>Quantity:</strong> {{ $purchaseOrderItem->quantity }}</p>
                    <p><strong>Unit Price:</strong> ₦{{ number_format($purchaseOrderItem->unit_price, 2) }}</p>
                    <p><strong>Total Price:</strong> ₦{{ number_format($purchaseOrderItem->quantity * $purchaseOrderItem->unit_price, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.master>