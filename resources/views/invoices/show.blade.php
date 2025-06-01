<x-layouts.master title="View Invoice" menutitle="View Invoice">
    <div id="content" class="main-content">
       <div class="layout-px-spacing">
           <div class="card mt-3">
               <div class="card-header">
                   <h3>Invoice Details</h3>
               </div>
               <div class="card-body">
                   <p><strong>Invoice ID:</strong> {{ $invoice->invoice_id }}</p>
                   <p><strong>Merchant ID:</strong> {{ $invoice->merchantID }}</p>
                   <p><strong>Invoice Date:</strong> {{ $invoice->invoice_date }}</p>
                   <p><strong>Total Amount:</strong> {{ $invoice->total_amount }}</p>
                   <p><strong>Status:</strong> {{ $invoice->status }}</p>
                   <a href="{{ route('invoices.edit', $invoice->sn) }}" class="btn btn-warning">Edit Invoice</a>
                   <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Back to List</a>
               </div>
           </div>
       </div>
    </div>
</x-layouts.master>
