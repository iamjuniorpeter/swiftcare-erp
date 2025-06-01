<x-layouts.master title="View Item Batch" menutitle="View Item Batch">
    <x-slot name="styles">
        <!-- Page-specific styles -->
    </x-slot>

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="card mt-3">
                <div class="card-header">
                    <h3>Item Batch Details</h3>
                </div>
                <div class="card-body">
                    <p><strong>SN:</strong> {{ $batch->sn }}</p>
                    <p><strong>Item ID:</strong> {{ $batch->itemID }}</p>
                    <p><strong>Batch Number:</strong> {{ $batch->batch_number }}</p>
                    <p><strong>Warehouse ID:</strong> {{ $batch->warehouseID }}</p>
                    <p><strong>Expiry Date:</strong> {{ $batch->expiry_date }}</p>
                    <p><strong>Quantity:</strong> {{ $batch->quantity }}</p>
                    <a href="{{ route('item_batches.edit', $batch->sn) }}" class="btn btn-warning">Edit Batch</a>
                    <a href="{{ route('item_batches.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <!-- Add any necessary page scripts here -->
    </x-slot>
</x-layouts.master>
