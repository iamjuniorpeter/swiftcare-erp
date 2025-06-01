<x-layouts.master title="Edit Sales Order Item" menutitle="Edit Sales Order Item">
    <div id="content" class="main-content">
       <div class="layout-px-spacing">
          <div class="card mt-3">
              <div class="card-header">
                  <h3>Edit Sales Order Item</h3>
              </div>
              <div class="card-body">
                  <form action="{{ route('sales_order_items.update', $sales_order_item->sn) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                          <label for="quantity">Quantity</label>
                          <input type="number" step="0.01" class="form-control" id="quantity" name="quantity" value="{{ $sales_order_item->quantity }}" required>
                      </div>
                      <div class="form-group">
                          <label for="unit_price">Unit Price</label>
                          <input type="number" step="0.01" class="form-control" id="unit_price" name="unit_price" value="{{ $sales_order_item->unit_price }}" required>
                      </div>
                      <button type="submit" class="btn btn-primary mt-3">Update Item</button>
                  </form>
              </div>
          </div>
       </div>
    </div>
</x-layouts.master>
