<x-layouts.master title="Add Warehouse" menutitle="Add Warehouse">
    <div id="content" class="main-content">
       <div class="layout-px-spacing">
            <div class="col-8 offset-2 mt-3 mb-3">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3>Add New Warehouse</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('warehouses.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="warehouse_id">Warehouse ID</label>
                                <input type="text" class="form-control" id="warehouse_id" name="warehouse_id" required>
                            </div>
                            <div class="form-group">
                                <label for="merchantID">Merchant ID</label>
                                <input type="text" class="form-control" id="merchantID" name="merchantID" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Warehouse Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="location">Location (optional)</label>
                                <input type="text" class="form-control" id="location" name="location">
                            </div>
                            <!-- Other fields such as contact_person, phone, email -->
                            <div class="text-right">
                                <button type="submit" class="btn btn-lg btn-primary mt-3 btnSaveWarehouse" id="btnSaveWarehouse">Save Warehouse</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
       </div>
    </div>
</x-layouts.master>
