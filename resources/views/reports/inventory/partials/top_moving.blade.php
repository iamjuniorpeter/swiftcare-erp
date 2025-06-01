<div class="card">
    <div class="card-header">
        <h5>Top Moving Items Report</h5>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity Moved</th>
                    <th>Movement Frequency</th>
                    <th>Last Movement Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                    <tr>
                        <td>{{ $record->name }}</td>
                        <td>{{ $record->quantity_moved }}</td>
                        <td>{{ $record->movement_frequency }}</td>
                        <td>{{ $record->last_movement_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
