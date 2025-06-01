<x-layouts.master title="View Warehouse" menutitle="View Warehouse">
    <div id="content" class="main-content">
       <div class="layout-px-spacing">
          <div class="card mt-3">
              <div class="card-header">
                  <h3>Warehouse Details</h3>
              </div>
              <div class="card-body">
                  <p><strong>Warehouse ID:</strong> {{ $warehouse->warehouse_id }}</p>
                  <p><strong>Merchant ID:</strong> {{ $warehouse->merchantID }}</p>
                  <p><strong>Name:</strong> {{ $warehouse->name }}</p>
                  <p><strong>Location:</strong> {{ $warehouse->location }}</p>
                  <a href="{{ route('warehouses.edit', $warehouse->sn) }}" class="btn btn-warning">Edit Warehouse</a>
                  <a href="{{ route('warehouses.index') }}" class="btn btn-secondary">Back to List</a>
              </div>
          </div>
       </div>
    </div>
</x-layouts.master>
