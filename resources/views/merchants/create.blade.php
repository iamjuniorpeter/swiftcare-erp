<x-layouts.master title="Add Merchant" menutitle="Add Merchant">
    <x-slot name="styles">
        <!-- Page-level styles -->
    </x-slot>
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="card mt-3">
                <div class="card-header">
                    <h3>Add New Merchant</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('merchants.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="merchantID">Merchant ID</label>
                            <input type="text" class="form-control" id="merchantID" name="merchantID" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Merchant Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email (optional)</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <!-- Add additional fields as needed -->
                        <button type="submit" class="btn btn-primary mt-3">Save Merchant</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        <!-- Page-level scripts -->
    </x-slot>
</x-layouts.master>
