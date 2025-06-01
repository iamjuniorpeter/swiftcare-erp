<x-layouts.master title="Transaction Logs" menutitle="Transaction Logs">
    <div id="content" class="main-content">
       <div class="layout-px-spacing">
           <div class="card mt-3">
               <div class="card-header">
                   <h3>Transaction Logs</h3>
               </div>
               <div class="card-body">
                   <table class="table table-bordered">
                       <thead>
                           <tr>
                               <th>ID</th>
                               <th>Merchant ID</th>
                               <th>Item ID</th>
                               <th>Warehouse ID</th>
                               <th>Type</th>
                               <th>Quantity</th>
                               <th>Actions</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach($transaction_logs as $log)
                           <tr>
                               <td>{{ $log->sn }}</td>
                               <td>{{ $log->merchantID }}</td>
                               <td>{{ $log->itemID }}</td>
                               <td>{{ $log->warehouseID }}</td>
                               <td>{{ $log->transaction_type }}</td>
                               <td>{{ $log->quantity }}</td>
                               <td>
                                   <a href="{{ route('transaction_logs.show', $log->sn) }}" class="btn btn-info btn-sm">View</a>
                                   <a href="{{ route('transaction_logs.edit', $log->sn) }}" class="btn btn-warning btn-sm">Edit</a>
                                   <form action="{{ route('transaction_logs.destroy', $log->sn) }}" method="POST" style="display:inline-block;">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this log?');">Delete</button>
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
