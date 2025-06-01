<x-layouts.master title="Invoices" menutitle="Invoices">
    <div id="content" class="main-content">
       <div class="layout-px-spacing">
          <div class="card mt-3">
              <div class="card-header d-flex justify-content-between align-items-center">
                  <h3>Invoices</h3>
                  <a href="{{ route('invoices.create') }}" class="btn btn-primary">Add Invoice</a>
              </div>
              <div class="card-body">
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th>Invoice ID</th>
                              <th>Merchant ID</th>
                              <th>SO ID</th>
                              <th>Invoice Date</th>
                              <th>Total Amount</th>
                              <th>Status</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($invoices as $invoice)
                          <tr>
                              <td>{{ $invoice->invoice_id }}</td>
                              <td>{{ $invoice->merchantID }}</td>
                              <td>{{ $invoice->so_id }}</td>
                              <td>{{ $invoice->invoice_date }}</td>
                              <td>{{ $invoice->total_amount }}</td>
                              <td>{{ $invoice->status }}</td>
                              <td>
                                  <a href="{{ route('invoices.show', $invoice->sn) }}" class="btn btn-info btn-sm">View</a>
                                  <a href="{{ route('invoices.edit', $invoice->sn) }}" class="btn btn-warning btn-sm">Edit</a>
                                  <form action="{{ route('invoices.destroy', $invoice->sn) }}" method="POST" style="display:inline-block;">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this invoice?');">Delete</button>
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
