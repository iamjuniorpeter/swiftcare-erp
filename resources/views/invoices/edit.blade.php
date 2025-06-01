<x-layouts.master title="Edit Invoice" menutitle="Edit Invoice">
    <div id="content" class="main-content">
       <div class="layout-px-spacing">
           <div class="card mt-3">
              <div class="card-header">
                  <h3>Edit Invoice</h3>
              </div>
              <div class="card-body">
                  <form action="{{ route('invoices.update', $invoice->sn) }}" method="POST">
                      @csrf
                      @method('PUT')
                      <div class="form-group">
                          <label for="invoice_date">Invoice Date</label>
                          <input type="date" class="form-control" id="invoice_date" name="invoice_date" value="{{ $invoice->invoice_date }}" required>
                      </div>
                      <div class="form-group">
                          <label for="total_amount">Total Amount</label>
                          <input type="number" step="0.01" class="form-control" id="total_amount" name="total_amount" value="{{ $invoice->total_amount }}" required>
                      </div>
                      <div class="form-group">
                          <label for="status">Status</label>
                          <input type="text" class="form-control" id="status" name="status" value="{{ $invoice->status }}" required>
                      </div>
                      <!-- Optional fields -->
                      <button type="submit" class="btn btn-primary mt-3">Update Invoice</button>
                  </form>
              </div>
           </div>
       </div>
    </div>
</x-layouts.master>
