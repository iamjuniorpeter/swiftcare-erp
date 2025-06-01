<x-layouts.master title="Item Batches" menutitle="Item Batches">
    <x-slot name="styles">
        <!-- Add any page-specific styles here -->
    </x-slot>

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="col-10 offset-1 mt-3 mb-3">
                <div class="card mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Item Batches</h3>
                        <a href="{{ route('item_batches.create') }}" class="btn btn-primary">Add New Batch</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Item ID</th>
                                    <th>Batch Number</th>
                                    <th>Warehouse ID</th>
                                    <th>Expiry Date</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($item_batches as $batch)
                                <tr>
                                    <td>{{ $batch->sn }}</td>
                                    <td>{{ $batch->itemID }}</td>
                                    <td>{{ $batch->batch_number }}</td>
                                    <td>{{ $batch->warehouseID }}</td>
                                    <td>{{ $batch->expiry_date }}</td>
                                    <td>{{ $batch->quantity }}</td>
                                    <td>
                                        <a href="{{ route('item_batches.show', $batch->sn) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('item_batches.edit', $batch->sn) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('item_batches.destroy', $batch->sn) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this batch?');">
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
    </div>

    <x-slot name="scripts">
        <!-- Add any page-level scripts here -->
    </x-slot>
</x-layouts.master>
