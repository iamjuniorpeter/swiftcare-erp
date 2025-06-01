<x-layouts.master title="Bulk Upload Items" menutitle="Bulk Upload Items">
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
    </x-slot>

    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row">
                <div class="col-12 mt-3 mb-3" style="text-align:right">
                    <a href="{{ route('items.index') }}" class="btn btn-info btn-lg">View Items</a>
                </div>

                <div class="col-8 offset-2 mt-3 mb-3">
                    <div class="card mt-2">
                        <div class="card-header bg-primary">
                            <h3 class="text-white">Bulk Upload Items</h3>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('items.bulk_upload.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-4">
                                    <label for="excel_file" class="form-label">Upload Excel File <small class="text-danger">*</small></label>
                                    <input type="file" id="excel_file" name="excel_file" class="form-control" accept=".xlsx, .xls" required>
                                </div>

                                <div class="mb-3">
                                    <p class="text-muted">
                                        Please ensure you use the correct format. You can 
                                        <a href="{{ route('items.bulk_upload.template') }}" class="text-primary">download the Excel template here</a>.
                                    </p>
                                </div>

                                <div style="text-align:right">
                                    <button type="submit" class="btn btn-primary btn-lg">Upload Items</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('@assets/plugins/select2/select2.min.js') }}"></script>
        <script>
            applySelect2([".cmbSelect2"]);
        </script>
    </x-slot>
</x-layouts.master>
