<x-layouts.master title="Inventory Reports" menutitle="Reports">

    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="{{ asset('@assets/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
    </x-slot>

    <div id="content" class="main-content">
        <div class="container-fluid p-4">
            <div class="col-8 offset-2 mt-5">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h5 class="text-white">Select Report</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('reports.generate') }}" name="">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="report_type" class="form-label">Report Type</label>
                                    <select class="form-control form-select cmbSelect2" id="report_type"
                                        name="report_type" required>
                                        <option value="">-- Select Report Type --</option>
                                        {{-- <option value="stock_summary">Stock Summary</option> --}}
                                        <option value="low_stock">Low Stock</option>
                                        <!--option value="stock_movement">Stock Movement</option-->
                                        <option value="top_moving">Top Moving Inventory</option>
                                        <option value="slow_moving">Slow/Idle Inventory</option>
                                        <option value="inventory_valuation">Inventory Valuation</option>
                                        <!--<option value="import_history">Import/Upload History</option>-->
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="date_range" class="form-label">Date Range (optional)</label>
                                    <input type="date" name="start_date" class="form-control mb-2"
                                        placeholder="Start Date">
                                </div>
                                <div class="col-md-3">
                                    <label for="date_range" class="form-label">Date Range (optional)</label>
                                    <input type="date" name="end_date" class="form-control" placeholder="End Date">
                                </div>
                            </div>

                            <div class="text-end mt-3 text-right">
                                <button type="submit" class="btn btn-lg btn-primary">Generate Report</button>

                                @if (request()->has('report_type'))
                                    <a href="{{ route('reports.export', request()->query()) }}"
                                        class="btn btn-success ms-2">
                                        Export to Excel
                                    </a>
                                @endif
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            @isset($view)
                <div class="col-8 offset-2 mt-5">
                    <div class="card mt-4">
                        {{-- <div class="card-header bg-secondary text-white">
                            <h6 class="mb-0">Report: {{ ucwords(str_replace('_', ' ', $report_type)) }}</h6>
                        </div> --}}
                        <div class="card-body">
                            @include($view)

                            {{-- @if ($report_type == 'low_stock')
                                @include('reports.partials.low_stock', ['items' => $data])
                            @elseif($report_type == 'top_moving')
                                @include('reports.partials.top_moving', ['items' => $data])
                            @elseif($report_type == 'slow_moving')
                                @include('reports.partials.slow_moving', ['items' => $data])
                            @elseif($report_type == 'inventory_valuation')
                                @include('reports.partials.inventory_valuation', ['items' => $data])
                            @else
                                <p>No report type selected.</p>
                            @endif --}}
                        </div>
                    </div>
                </div>
            @endisset



        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('@assets/plugins/select2/select2.min.js') }}"></script>
        <script src="{{ asset('@assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
        <script>
            applySelect2([".cmbSelect2"]);
            applyDataTable();
            saveUnit();
        </script>
    </x-slot>

</x-layouts.master>
