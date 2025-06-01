<x-layouts.master title="Edit Warehouse" menutitle="Edit Warehouse">
    <div id="content" class="main-content">
       <div class="layout-px-spacing">
            <div class="col-8 offset-2 mt-3 mb-3">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3>Edit Warehouse</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('warehouses.update', $warehouse->sn) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Warehouse Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $warehouse->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location" name="location" value="{{ $warehouse->location }}">
                            </div>
                            <!-- Add other fields as needed -->
                            <button type="submit" class="btn btn-primary mt-3">Update Warehouse</button>
                        </form>
                    </div>
                </div>
            </div>
       </div>
    </div>
</x-layouts.master>
