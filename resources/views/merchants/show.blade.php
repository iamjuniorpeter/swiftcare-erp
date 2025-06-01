<x-layouts.master title="View Merchant" menutitle="View Merchant">
    <x-slot name="styles">
        <!-- Page-specific styles -->
    </x-slot>
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="card mt-3">
                <div class="card-header">
                    <h3>Merchant Details</h3>
                </div>
                <div class="card-body">
                    <p><strong>Merchant ID:</strong> {{ $merchant->merchantID }}</p>
                    <p><strong>Name:</strong> {{ $merchant->name }}</p>
                    <p><strong>Email:</strong> {{ $merchant->email }}</p>
                    <!-- Add more fields as needed -->
                    <a href="{{ route('merchants.edit', $merchant->id) }}" class="btn btn-warning">Edit Merchant</a>
                    <a href="{{ route('merchants.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        <!-- Page-level scripts -->
    </x-slot>
</x-layouts.master>
