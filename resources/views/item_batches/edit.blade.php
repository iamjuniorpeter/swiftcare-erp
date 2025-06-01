<x-layouts.master title="Edit Item Batch" menutitle="Edit Item Batch">
    <x-slot name="styles">
        <!-- Page-specific styles -->
    </x-slot>

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="col-10 offset-1 mt-3 mb-3">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3>Edit Item Batch</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('item_batches.update', $batch->sn) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="itemID">Item ID</label>
                                <input type="text" class="form-control" id="itemID" name="itemID" value="{{ $batch->itemID }}" required>
                            </div>
                            <div class="form-group">
                                <label for="batch_number">Batch Number</label>
                                <input type="text" class="form-control" id="batch_number" name="batch_number" value="{{ $batch->batch_number }}" required>
                            </div>
                            <div class="form-group">
                                <label for="warehouseID">Warehouse ID</label>
                                <input type="text" class="form-control" id="warehouseID" name="warehouseID" value="{{ $batch->warehouseID }}" required>
                            </div>
                            <div class="form-group">
                                <label for="expiry_date">Expiry Date</label>
                                <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="{{ $batch->expiry_date }}">
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" step="0.01" class="form-control" id="quantity" name="quantity" value="{{ $batch->quantity }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Update Batch</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <!-- Page-level scripts -->
    </x-slot>
</x-layouts.master>
