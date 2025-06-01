<x-layouts.master title="Sales Order Items" menutitle="Sales Order Items">
    <div id="content" class="main-content">
      <div class="layout-px-spacing">
          <div class="card mt-3">
              <div class="card-header d-flex justify-content-between align-items-center">
                  <h3>Sales Order Items</h3>
                  <a href="{{ route('sales_order_items.create') }}" class="btn btn-primary">Add Item</a>
              </div>
              <div class="card-body">
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th>SOI ID</th>
                              <th>SO ID</th>
                              <th>Item ID</th>
                              <th>Quantity</th>
                              <th>Unit Price</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($sales_order_items as $soi)
                          <tr>
                              <td>{{ $soi->soi_id }}</td>
                              <td>{{ $soi->soID }}</td>
                              <td>{{ $soi->itemID }}</td>
                              <td>{{ $soi->quantity }}</td>
                              <td>{{ $soi->unit_price }}</td>
                              <td>
                                  <a href="{{ route('sales_order_items.show', $soi->sn) }}" class="btn btn-info btn-sm">View</a>
                                  <a href="{{ route('sales_order_items.edit', $soi->sn) }}" class="btn btn-warning btn-sm">Edit</a>
                                  <form action="{{ route('sales_order_items.destroy', $soi->sn) }}" method="POST" style="display:inline-block;">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this item?');">Delete</button>
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
</x-layouts.master>
