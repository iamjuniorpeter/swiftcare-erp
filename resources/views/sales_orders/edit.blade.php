<x-layouts.master title="Edit Sales Order" menutitle="Edit Sales Order">
    <div id="content" class="main-content">
      <div class="layout-px-spacing">
          <div class="card mt-3">
              <div class="card-header">
                  <h3>Edit Sales Order</h3>
              </div>
              <div class="card-body">
                  <form action="{{ route('sales_orders.update', $sales_order->sn) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                          <label for="customerID">Customer ID</label>
                          <input type="text" class="form-control" id="customerID" name="customerID" value="{{ $sales_order->customerID }}" required>
                      </div>
                      <div class="form-group">
                          <label for="order_date">Order Date</label>
                          <input type="date" class="form-control" id="order_date" name="order_date" value="{{ $sales_order->order_date }}" required>
                      </div>
                      <!-- Add other fields as needed -->
                      <button type="submit" class="btn btn-primary mt-3">Update Sales Order</button>
                  </form>
              </div>
          </div>
      </div>
    </div>
</x-layouts.master>
