<x-layouts.master title="Inventory" menutitle="Inventory">
    <x-slot name="styles"></x-slot>

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="card mt-3">
              <div class="card-header d-flex justify-content-between align-items-center">
                  <h3>Inventory Records</h3>
                  <a href="{{ route('inventory.create') }}" class="btn btn-primary">Add Inventory</a>
              </div>
              <div class="card-body">
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th>Inventory ID</th>
                              <th>Merchant ID</th>
                              <th>Item ID</th>
                              <th>Warehouse ID</th>
                              <th>Quantity</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($inventory as $inv)
                          <tr>
                              <td>{{ $inv->inventory_id }}</td>
                              <td>{{ $inv->merchantID }}</td>
                              <td>{{ $inv->itemID }}</td>
                              <td>{{ $inv->warehouseID }}</td>
                              <td>{{ $inv->quantity }}</td>
                              <td>
                                  <a href="{{ route('inventory.show', $inv->sn) }}" class="btn btn-info btn-sm">View</a>
                                  <a href="{{ route('inventory.edit', $inv->sn) }}" class="btn btn-warning btn-sm">Edit</a>
                                  <form action="{{ route('inventory.destroy', $inv->sn) }}" method="POST" style="display:inline-block;">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this inventory record?');">Delete</button>
                                  </form>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
            </div>
        </div>
    </div>
    
    <x-slot name="scripts"></x-slot>
</x-layouts.master>
