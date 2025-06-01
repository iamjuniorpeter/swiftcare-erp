<x-layouts.master title="Add Customer" menutitle="Add Customer">
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="card mt-3">
                <div class="card-header">
                    <h3>Add New Customer</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('customers.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="customer_id">Customer ID</label>
                            <input type="text" class="form-control" id="customer_id" name="customer_id" required>
                        </div>
                        <div class="form-group">
                            <label for="merchantID">Merchant ID</label>
                            <input type="text" class="form-control" id="merchantID" name="merchantID" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Customer Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="contact_person">Contact Person (optional)</label>
                            <input type="text" class="form-control" id="contact_person" name="contact_person">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone (optional)</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="email">Email (optional)</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="address">Address (optional)</label>
                            <textarea class="form-control" id="address" name="address"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status (default: active)</label>
                            <input type="text" class="form-control" id="status" name="status" value="active">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Save Customer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.master>
