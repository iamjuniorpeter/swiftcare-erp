<x-layouts.master title="View Sales Order Item" menutitle="View Sales Order Item">
    <div id="content" class="main-content">
       <div class="layout-px-spacing">
          <div class="card mt-3">
              <div class="card-header">
                  <h3>Sales Order Item Details</h3>
              </div>
              <div class="card-body">
                  <p><strong>SOI ID:</strong> {{ $sales_order_item->soi_id }}</p>
                  <p><strong>SO ID:</strong> {{ $sales_order_item->soID }}</p>
                  <p><strong>Item ID:</strong> {{ $sales_order_item->itemID }}</p>
                  <p><strong>Quantity:</strong> {{ $sales_order_item->quantity }}</p>
                  <p><strong>Unit Price:</strong> {{ $sales_order_item->unit_price }}</p>
                  <a href="{{ route('sales_order_items.edit', $sales_order_item->sn) }}" class="btn btn-warning">Edit Item</a>
                  <a href="{{ route('sales_order_items.index') }}" class="btn btn-secondary">Back to List</a>
              </div>
          </div>
       </div>
    </div>
</x-layouts.master>
