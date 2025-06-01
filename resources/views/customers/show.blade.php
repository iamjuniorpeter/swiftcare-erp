<x-layouts.master title="View Customer" menutitle="View Customer">
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="card mt-3">
                <div class="card-header">
                    <h3>Customer Details</h3>
                </div>
                <div class="card-body">
                    <p><strong>Customer ID:</strong> {{ $customer->customer_id }}</p>
                    <p><strong>Merchant ID:</strong> {{ $customer->merchantID }}</p>
                    <p><strong>Name:</strong> {{ $customer->name }}</p>
                    <p><strong>Contact Person:</strong> {{ $customer->contact_person }}</p>
                    <p><strong>Phone:</strong> {{ $customer->phone }}</p>
                    <p><strong>Email:</strong> {{ $customer->email }}</p>
                    <p><strong>Address:</strong> {{ $customer->address }}</p>
                    <p><strong>Status:</strong> {{ $customer->status }}</p>
                    <a href="{{ route('customers.edit', $customer->sn) }}" class="btn btn-warning">Edit Customer</a>
                    <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.master>
