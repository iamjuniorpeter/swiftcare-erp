<x-layouts.master title="Add Sales Order Item" menutitle="Add Sales Order Item">
    <div id="content" class="main-content">
       <div class="layout-px-spacing">
          <div class="card mt-3">
              <div class="card-header">
                  <h3>Add New Sales Order Item</h3>
              </div>
              <div class="card-body">
                  <form action="{{ route('sales_order_items.store') }}" method="POST">
                      @csrf
                      <div class="form-group">
                          <label for="soi_id">SOI ID</label>
                          <input type="text" class="form-control" id="soi_id" name="soi_id" required>
                      </div>
                      <div class="form-group">
                          <label for="soID">SO ID</label>
                          <input type="text" class="form-control" id="soID" name="soID" required>
                      </div>
                      <div class="form-group">
                          <label for="itemID">Item ID</label>
                          <input type="text" class="form-control" id="itemID" name="itemID" required>
                      </div>
                      <div class="form-group">
                          <label for="quantity">Quantity</label>
                          <input type="number" step="0.01" class="form-control" id="quantity" name="quantity" required>
                      </div>
                      <div class="form-group">
                          <label for="unit_price">Unit Price</label>
                          <input type="number" step="0.01" class="form-control" id="unit_price" name="unit_price" required>
                      </div>
                      <button type="submit" class="btn btn-primary mt-3">Save Item</button>
                  </form>
              </div>
          </div>
       </div>
    </div>
</x-layouts.master>
