<x-layouts.master title="Add Warehouse" menutitle="Add Warehouse">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>

    <div id="content" class="main-content">
      <div class="layout-px-spacing">

        <div class="col-12 mt-3 mb-3 mt-3 pull-right" style="text-align:right">
                <a href="{{ route('items.index') }}" class="btn-lg btn btn-primary">Go Back to Products</a>
        </div>

        <div class="col-8 offset-2 mt-3 mb-3">
            <div class="card mt-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Add New Location</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('warehouses.store') }}" method="POST" name="frmSaveWarehouse" id="frmSaveWarehouse">
                        @csrf
                        <div class="form-group">
                            <label for="warehouse_name">Location Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="warehouse_type" class="form-label mb-2">Location Type (optional)</label>
                                <a href="javascript:void(0)" class="text-end text-info text-bold" id="labelAddWarehouseType">Add New Location Type</a>
                            </div>
                            <select id="type" name="type" class="form-select @error('warehouse_type') is-invalid @enderror form-control cmbSelect2">
                                <option value="">-- choose location type --</option>
                                @foreach($warehouse_types as $warehouse_type)
                                    <option value="{{ $warehouse_type->sn }}">
                                        {{ $warehouse_type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('unitID')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="abbreviation">Location (optional)</label>
                            <input type="text" class="form-control" id="location" name="location">
                        </div>

                        <input type="hidden" id="merchantID" name="merchantID" class="form-control" value="{{ Auth::user()->accountID }}">
                        <div class="text-right">
                            <button type="submit" class="btn btn-lg btn-primary mt-3 btnSaveWarehouse" name="btnSaveWarehouse" id="btnSaveWarehouse">Save Location</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

         <br/><hr/><br/>

        <div class="col-8 offset-2 mt-3 mb-3">
            <div class="card mt-0">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    <h3 class="text-white">View Location(s)</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered myDataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($warehouses as $warehouse)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $warehouse->name }}</td>
                                <td>{{ $warehouse->warehouseType->name }}</td>
                                <td>{{ $warehouse->location }}</td>
                                <td>
                                    <a href="{{ route('warehouses.edit', $warehouse->warehouse_id) }}" class="btn btn-info btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 20h9"></path>
                                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"></path>
                                        </svg>
                                    </a>
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

    <x-modal-add-new-warehouse-type />

    <x-slot name="scripts">
        <script src="{{ asset('@assets/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script>
            applySelect2([".cmbSelect2"]);
            applyDataTable();            
            saveWarehouseType();
            saveWarehouse();
            showModal("#labelAddWarehouseType", "#addNewWarehouseTypeModal");
        </script>
    </x-slot>
</x-layouts.master>

