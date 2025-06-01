<x-layouts.master title="Edit Inventory" menutitle="Edit Inventory">
    <x-slot name="styles"></x-slot>

    <div id="content" class="main-content">
       <div class="layout-px-spacing">
           <div class="card mt-3">
               <div class="card-header">
                   <h3>Edit Inventory Record</h3>
               </div>
               <div class="card-body">
                   <form action="{{ route('inventory.update', $inventory->sn) }}" method="POST">
                       @csrf
                       @method('PUT')
                       <div class="form-group">
                           <label for="quantity">Quantity</label>
                           <input type="number" step="0.01" class="form-control" id="quantity" name="quantity" value="{{ $inventory->quantity }}" required>
                       </div>
                       <!-- You can add other fields if needed -->
                       <button type="submit" class="btn btn-primary mt-3">Update Inventory</button>
                   </form>
               </div>
           </div>
       </div>
    </div>

    <x-slot name="scripts"></x-slot>
</x-layouts.master>
