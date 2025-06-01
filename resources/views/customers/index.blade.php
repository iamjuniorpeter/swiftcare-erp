<x-layouts.master title="Customers" menutitle="Customers">
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Customers</h3>
                    <a href="{{ route('customers.create') }}" class="btn btn-primary">Add New Customer</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->customer_id }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>
                                    <a href="{{ route('customers.show', $customer->sn) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('customers.edit', $customer->sn) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('customers.destroy', $customer->sn) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                          onclick="return confirm('Delete this customer?');">
                                          Delete
                                        </button>
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
