<x-layouts.master title="Add Invoice" menutitle="Add Invoice">
    <div id="content" class="main-content">
       <div class="layout-px-spacing">
           <div class="card mt-3">
              <div class="card-header">
                  <h3>Add New Invoice</h3>
              </div>
              <div class="card-body">
                  <form action="{{ route('invoices.store') }}" method="POST">
                      @csrf
                      <div class="form-group">
                          <label for="invoice_id">Invoice ID</label>
                          <input type="text" class="form-control" id="invoice_id" name="invoice_id" required>
                      </div>
                      <div class="form-group">
                          <label for="merchantID">Merchant ID</label>
                          <input type="text" class="form-control" id="merchantID" name="merchantID" required>
                      </div>
                      <div class="form-group">
                          <label for="invoice_date">Invoice Date</label>
                          <input type="date" class="form-control" id="invoice_date" name="invoice_date" required>
                      </div>
                      <div class="form-group">
                          <label for="total_amount">Total Amount</label>
                          <input type="number" step="0.01" class="form-control" id="total_amount" name="total_amount" required>
                      </div>
                      <div class="form-group">
                          <label for="status">Status</label>
                          <input type="text" class="form-control" id="status" name="status" value="pending" required>
                      </div>
                      <!-- Optional: so_id, due_date, paid_amount -->
                      <button type="submit" class="btn btn-primary mt-3">Save Invoice</button>
                  </form>
              </div>
           </div>
       </div>
    </div>
</x-layouts.master>
