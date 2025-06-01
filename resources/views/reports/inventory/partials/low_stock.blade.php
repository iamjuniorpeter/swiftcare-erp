<div class="card">
    <div class="card-header">
        <h5>Low Stock Report</h5>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Current Stock</th>
                    <th>Minimum Threshold</th>
                    <th>Suggested Reorder Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                    <tr>
                        <td>{{ $record->name }}</td>
                        <td>{{ $record->quantity }}</td>
                        <td>{{ $record->reorder_level }}</td>
                        <td>{{ $record->suggested_reorder }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
