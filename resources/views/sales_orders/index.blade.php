<x-layouts.master title="Sales Orders" menutitle="Sales Orders">
    <div id="content" class="main-content">
      <div class="layout-px-spacing">
         <div class="card mt-3">
             <div class="card-header d-flex justify-content-between align-items-center">
                 <h3>Sales Orders</h3>
                 <a href="{{ route('sales_orders.create') }}" class="btn btn-primary">Add Sales Order</a>
             </div>
             <div class="card-body">
                 <table class="table table-bordered">
                     <thead>
                         <tr>
                             <th>SO ID</th>
                             <th>Merchant ID</th>
                             <th>Customer ID</th>
                             <th>Order Date</th>
                             <th>Status</th>
                             <th>Actions</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach($sales_orders as $so)
                         <tr>
                             <td>{{ $so->so_id }}</td>
                             <td>{{ $so->merchantID }}</td>
                             <td>{{ $so->customerID }}</td>
                             <td>{{ $so->order_date }}</td>
                             <td>{{ $so->status }}</td>
                             <td>
                                <a href="{{ route('sales_orders.show', $so->sn) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('sales_orders.edit', $so->sn) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('sales_orders.destroy', $so->sn) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this sales order?');">Delete</button>
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
