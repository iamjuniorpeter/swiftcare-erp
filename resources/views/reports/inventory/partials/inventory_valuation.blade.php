<div class="card">
    <div class="card-header">
        <h5>Inventory Valuation Report</h5>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Unit Cost</th>
                    <th>Quantity</th>
                    <th>Total Inventory Value</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                    <tr>
                        <td>{{ $record->name }}</td>
                        <td>{{ number_format($record->unit_cost, 2) }}</td>
                        <td>{{ $record->quantity }}</td>
                        <td>{{ number_format($record->total_value, 2) }}</td>
                        <td>{{ $record->category_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
