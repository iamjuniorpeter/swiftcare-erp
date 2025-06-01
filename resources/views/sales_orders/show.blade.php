<x-layouts.master title="View Sales Order" menutitle="View Sales Order">
    <div id="content" class="main-content">
       <div class="layout-px-spacing">
           <div class="card mt-3">
               <div class="card-header">
                   <h3>Sales Order Details</h3>
               </div>
               <div class="card-body">
                   <p><strong>SO ID:</strong> {{ $sales_order->so_id }}</p>
                   <p><strong>Merchant ID:</strong> {{ $sales_order->merchantID }}</p>
                   <p><strong>Customer ID:</strong> {{ $sales_order->customerID }}</p>
                   <p><strong>Order Date:</strong> {{ $sales_order->order_date }}</p>
                   <p><strong>Status:</strong> {{ $sales_order->status }}</p>
                   <a href="{{ route('sales_orders.edit', $sales_order->sn) }}" class="btn btn-warning">Edit Sales Order</a>
                   <a href="{{ route('sales_orders.index') }}" class="btn btn-secondary">Back to List</a>
               </div>
           </div>
       </div>
    </div>
</x-layouts.master>
