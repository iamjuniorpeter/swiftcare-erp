<x-layouts.master title="View Inventory" menutitle="View Inventory">
    <x-slot name="styles"></x-slot>

    <div id="content" class="main-content">
       <div class="layout-px-spacing">
           <div class="card mt-3">
               <div class="card-header">
                   <h3>Inventory Record Details</h3>
               </div>
               <div class="card-body">
                   <p><strong>Inventory ID:</strong> {{ $inventory->inventory_id }}</p>
                   <p><strong>Merchant ID:</strong> {{ $inventory->merchantID }}</p>
                   <p><strong>Item ID:</strong> {{ $inventory->itemID }}</p>
                   <p><strong>Warehouse ID:</strong> {{ $inventory->warehouseID }}</p>
                   <p><strong>Quantity:</strong> {{ $inventory->quantity }}</p>
                   <a href="{{ route('inventory.edit', $inventory->sn) }}" class="btn btn-warning">Edit Inventory</a>
                   <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Back to List</a>
               </div>
           </div>
       </div>
    </div>

    <x-slot name="scripts"></x-slot>
</x-layouts.master>
