<x-layouts.master title="Add Inventory" menutitle="Add Inventory">
    <x-slot name="styles"></x-slot>

    <div id="content" class="main-content">
       <div class="layout-px-spacing">
            <div class="col-12 mt-3 mb-3 pull-right" style="text-align:right">
                <a href="{{ route('inventory.index') }}" class="btn btn-info">View Inventory</a>
            </div>
           <div class="card mt-3">
               <div class="card-header">
                   <h3>Add New Inventory Record</h3>
               </div>
               <div class="card-body">
                   <form action="{{ route('inventory.store') }}" method="POST">
                       @csrf
                       <div class="form-group">
                           <label for="inventory_id">Inventory ID</label>
                           <input type="text" class="form-control" id="inventory_id" name="inventory_id" required>
                       </div>
                       <div class="form-group">
                           <label for="merchantID">Merchant ID</label>
                           <input type="text" class="form-control" id="merchantID" name="merchantID" required>
                       </div>
                       <div class="form-group">
                           <label for="itemID">Item ID</label>
                           <input type="text" class="form-control" id="itemID" name="itemID" required>
                       </div>
                       <div class="form-group">
                           <label for="warehouseID">Warehouse ID</label>
                           <input type="text" class="form-control" id="warehouseID" name="warehouseID" required>
                       </div>
                       <div class="form-group">
                           <label for="quantity">Quantity</label>
                           <input type="number" step="0.01" class="form-control" id="quantity" name="quantity" required>
                       </div>
                       <button type="submit" class="btn btn-primary mt-3">Save Inventory</button>
                   </form>
               </div>
           </div>
       </div>
    </div>

    <x-slot name="scripts"></x-slot>
</x-layouts.master>
