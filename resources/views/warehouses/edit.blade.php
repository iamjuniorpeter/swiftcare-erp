<x-layouts.master title="Edit Warehouse" menutitle="Edit Warehouse">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>
    <div id="content" class="main-content">
       <div class="layout-px-spacing">
            <div class="col-12 mt-5 mb-3 mt-3 pull-right" style="text-align:right">
                <a href="{{ route('warehouses.create') }}" class="btn-lg btn btn-primary">Go Back to Locations</a>
            </div>

            <div class="col-8 offset-2 mt-5 mb-3">
                <div class="card mt-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white">Edit Warehouse</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('warehouses.update', $warehouse->warehouse_id) }}" method="POST" name="frmSaveWarehouse" id="frmSaveWarehouse">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="warehouse_name">Location Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $warehouse->name }}" required>
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label for="warehouse_type" class="form-label mb-2">Location Type (optional)</label>
                                    <a href="javascript:void(0)" class="text-end text-info text-bold" id="labelAddWarehouseType">Add New Location Type</a>
                                </div>
                                <select id="type" name="type" class="form-select @error('warehouse_type') is-invalid @enderror form-control cmbSelect2">
                                    <option value="">-- choose location type --</option>
                                    @foreach($warehouse_types as $warehouse_type)
                                        <option value="{{ $warehouse_type->sn }}"
                                            {{ $warehouse->typeID == $warehouse_type->sn ? 'selected' : '' }}>
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
                                <input type="text" class="form-control" id="location" name="location" value="{{ $warehouse->location }}">
                            </div>

                            <input type="hidden" id="merchantID" name="merchantID" class="form-control" value="{{ Auth::user()->accountID }}">
                            <div class="text-right">
                                <button type="submit" class="btn btn-lg btn-primary mt-3 btnSaveWarehouse" name="btnSaveWarehouse" id="btnSaveWarehouse">Update Location</button>
                            </div>
                            
                        </form>
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
            saveWarehouseType();
            saveWarehouse();
            showModal("#labelAddWarehouseType", "#addNewWarehouseTypeModal");
        </script>
    </x-slot>
</x-layouts.master>
