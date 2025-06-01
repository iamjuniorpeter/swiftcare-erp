<x-layouts.master title="View Transaction Log" menutitle="View Transaction Log">
    <div id="content" class="main-content">
       <div class="layout-px-spacing">
         <div class="card mt-3">
             <div class="card-header">
                 <h3>Transaction Log Details</h3>
             </div>
             <div class="card-body">
                 <p><strong>ID:</strong> {{ $transaction_log->sn }}</p>
                 <p><strong>Merchant ID:</strong> {{ $transaction_log->merchantID }}</p>
                 <p><strong>Item ID:</strong> {{ $transaction_log->itemID }}</p>
                 <p><strong>Warehouse ID:</strong> {{ $transaction_log->warehouseID }}</p>
                 <p><strong>Transaction Type:</strong> {{ $transaction_log->transaction_type }}</p>
                 <p><strong>Quantity:</strong> {{ $transaction_log->quantity }}</p>
                 <a href="{{ route('transaction_logs.edit', $transaction_log->sn) }}" class="btn btn-warning">Edit Log</a>
                 <a href="{{ route('transaction_logs.index') }}" class="btn btn-secondary">Back to List</a>
             </div>
         </div>
       </div>
    </div>
</x-layouts.master>
