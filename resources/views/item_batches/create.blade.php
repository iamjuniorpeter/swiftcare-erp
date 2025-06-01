<x-layouts.master title="Add Item Batch" menutitle="Add Item Batch">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="col-12 mt-3 mb-3 mt-3 pull-right" style="text-align:right">
                    <a href="{{ route('items.index') }}" class="btn-lg btn btn-info">View Item</a>
            </div>
            <div class="col-10 offset-1 mt-3 mb-3">
                <div class="card mt-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white">Add New Item Batch</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('item_batches.store') }}" method="POST" name="frmSaveItemBatch" id="frmSaveItemBatch">
                            @csrf
                            {{-- <div class="form-group">
                                <label for="batch_number">Batch Number</label>
                                <input type="text" class="form-control" id="batch_number" name="batch_number" required>
                            </div> --}}
                            {{-- <div class="form-group">
                                <label for="warehouseID">Warehouse ID</label>
                                <input type="text" class="form-control" id="warehouseID" name="warehouseID" required>
                            </div> --}}
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="expiry_date">Expiry Date</label>
                                        <input type="date" class="form-control" id="expiry_date" name="expiry_date">
                                    </div>
                                </div>
                                <div class="col-6">
                                     <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" step="0.01" class="form-control" id="quantity" name="quantity" required>
                                    </div>
                                </div>
                            </div>
                            
                           

                            <input type="hidden" id="item_id" name="item_id" class="form-control" value="{{ $item_id }}" />
                            <input type="hidden" id="merchantID" name="merchantID" class="form-control" value="{{ Auth::user()->accountID }}">
                            <div class="text-right">
                                <button type="submit"  name="btnSaveItemBatch" id="btnSaveItemBatch" class="btnSaveItemBatch btn btn-lg btn-primary mt-3">Save Batch</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-10 offset-1 mt-3 mb-3">
                <div class="card mt-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Item Batches</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered myDataTable">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Batch Number</th>
                                    <th>Expiry Date</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($item_batches as $batch)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $batch->batch_number }}</td>
                                    <td>{{ $batch->expiry_date }}</td>
                                    <td>{{ $batch->quantity }}</td>
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
        <script src="{{ asset('@assets/plugins/table/datatable/datatables.js') }}"></script>
        <script src="{{ asset('@assets/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script>
            applySelect2([".cmbSelect2"]);
            applyDataTable();
            saveItemBatch();
        </script>
    </x-slot>

</x-layouts.master>
