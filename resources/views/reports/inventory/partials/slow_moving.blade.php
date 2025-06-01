<div class="card">
    <div class="card-header">
        <h5>Slow Moving / Idle Inventory Report</h5>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Last Movement Date</th>
                    <th>Days Idle</th>
                    <th>Holding Cost Estimate</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                    <tr>
                        <td>{{ $record->name }}</td>
                        <td>{{ $record->last_movement_date }}</td>
                        <td>{{ $record->days_idle }}</td>
                        <td>{{ number_format($record->holding_cost, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
