<x-layouts.master title="View Purchase Order" menutitle="View Purchase Order">
    <div id="content" class="main-content">
       <div class="layout-px-spacing">
          <div class="card mt-3">
              <div class="card-header">
                  <h3>Purchase Order Details</h3>
              </div>
              <div class="card-body">
                  <p><strong>PO ID:</strong> {{ $purchase_order->po_id }}</p>
                  <p><strong>Merchant ID:</strong> {{ $purchase_order->merchantID }}</p>
                  <p><strong>Supplier ID:</strong> {{ $purchase_order->supplierID }}</p>
                  <p><strong>Order Date:</strong> {{ $purchase_order->order_date }}</p>
                  <p><strong>Status:</strong> {{ $purchase_order->status }}</p>
                  <a href="{{ route('purchase_orders.edit', $purchase_order->sn) }}" class="btn btn-warning">Edit Purchase Order</a>
                  <a href="{{ route('purchase_orders.index') }}" class="btn btn-secondary">Back to List</a>
              </div>
          </div>
       </div>
    </div>
</x-layouts.master>
