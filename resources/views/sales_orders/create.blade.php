<x-layouts.master title="Add Sales Order" menutitle="Add Sales Order">
    <div id="content" class="main-content">
      <div class="layout-px-spacing">
          <div class="card mt-3">
              <div class="card-header">
                  <h3>Add New Sales Order</h3>
              </div>
              <div class="card-body">
                  <form action="{{ route('sales_orders.store') }}" method="POST">
                      @csrf
                      <div class="form-group">
                          <label for="so_id">SO ID</label>
                          <input type="text" class="form-control" id="so_id" name="so_id" required>
                      </div>
                      <div class="form-group">
                          <label for="merchantID">Merchant ID</label>
                          <input type="text" class="form-control" id="merchantID" name="merchantID" required>
                      </div>
                      <div class="form-group">
                          <label for="customerID">Customer ID</label>
                          <input type="text" class="form-control" id="customerID" name="customerID" required>
                      </div>
                      <div class="form-group">
                          <label for="order_date">Order Date</label>
                          <input type="date" class="form-control" id="order_date" name="order_date" required>
                      </div>
                      <!-- Optional fields: billing_address, payment details, etc. -->
                      <button type="submit" class="btn btn-primary mt-3">Save Sales Order</button>
                  </form>
              </div>
          </div>
      </div>
    </div>
</x-layouts.master>
