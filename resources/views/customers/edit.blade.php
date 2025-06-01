<x-layouts.master title="Edit Customer" menutitle="Edit Customer">
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="card mt-3">
                <div class="card-header">
                    <h3>Edit Customer</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('customers.update', $customer->sn) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="customer_id">Customer ID</label>
                            <input type="text" class="form-control" id="customer_id" name="customer_id" value="{{ $customer->customer_id }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="merchantID">Merchant ID</label>
                            <input type="text" class="form-control" id="merchantID" name="merchantID" value="{{ $customer->merchantID }}" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Customer Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="contact_person">Contact Person (optional)</label>
                            <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{ $customer->contact_person }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone (optional)</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $customer->phone }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email (optional)</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}">
                        </div>
                        <div class="form-group">
                            <label for="address">Address (optional)</label>
                            <textarea class="form-control" id="address" name="address">{{ $customer->address }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" class="form-control" id="status" name="status" value="{{ $customer->status }}">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update Customer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.master>
