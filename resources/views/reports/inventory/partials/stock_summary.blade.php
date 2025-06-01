<div class="card">
    <div class="card-header">
        <h5>Stock Summary Report</h5>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Item Name / SKU</th>
                    <th>Quantity on Hand</th>
                    <th>Unit Cost</th>
                    <th>Total Value</th>
                    <th>Stock Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                    <tr>
                        <td>{{ $record->name }}</td>
                        <td>{{ $record->quantity }}</td>
                        <td>{{ number_format($record->cost_price, 2) }}</td>
                        <td>{{ number_format($record->total_value, 2) }}</td>
                        <td>{{ $record->stock_status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
