<x-layouts.master title="Edit Supplier" menutitle="Edit Supplier">
    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="col-12 mt-3 mb-3" style="text-align:right">
                <a href="{{ route('suppliers.index') }}" class="btn-lg btn btn-info">View Suppliers</a>
            </div>

            <div class="col-8 offset-2 mt-5 mb-3">
                <div class="card mt-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white">Edit Supplier</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('suppliers.update', $supplier->supplier_id) }}" method="POST" id="frmSaveSupplier" name="frmSaveSupplier">
                            @csrf
                            @method('PUT')

                            <!-- Supplier Name -->
                            <div class="form-group">
                                <label for="name">Supplier Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $supplier->name) }}" required>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <!-- Contact Person -->
                                    <div class="form-group">
                                        <label for="contact_person">Contact Person</label>
                                        <input type="text" class="form-control" id="contact_person" name="contact_person" value="{{ old('contact_person', $supplier->contact_person) }}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <!-- Phone -->
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $supplier->phone) }}">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <!-- Email -->
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $supplier->email) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <!-- Supplier Type -->
                                    <div class="form-group">
                                        <label for="type">Supplier Type</label>
                                        <select class="form-control" id="type" name="type" required>
                                            <option value="">-- Select Type --</option>
                                            <option value="inventory" {{ $supplier->type == 'inventory' ? 'selected' : '' }}>Inventory</option>
                                            <option value="service" {{ $supplier->type == 'service' ? 'selected' : '' }}>Service</option>
                                            <option value="both" {{ $supplier->type == 'both' ? 'selected' : '' }}>Both</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <!-- Status -->
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="active" {{ $supplier->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $supplier->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <!-- Address -->
                                    <div class="form-group">
                                        <label for="address">Supplier Address</label>
                                        <textarea class="form-control" id="address" name="address" rows="2">{{ old('address', $supplier->address) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <!-- Notes -->
                                    <div class="form-group">
                                        <label for="notes">Notes / Description</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="2">{{ old('notes', $supplier->notes) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Hidden merchantID and Submit -->
                            <div class="text-right">
                                <input type="hidden" name="merchantID" value="{{ $supplier->merchantID }}">
                                <button type="submit" class="btn btn-lg btn-primary mt-3" id="btnSaveSupplier">Update Supplier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('@assets/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script>
            saveSupplier();
        </script>
    </x-slot>
</x-layouts.master>
