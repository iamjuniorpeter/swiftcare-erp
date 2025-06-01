<div class="card">
    <div class="card-header">
        <h5>Stock Movement Report</h5>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Item</th>
                    <th>Quantity In/Out</th>
                    <th>Action Type</th>
                    <th>Performed By</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                    <tr>
                        <td>{{ $record->date }}</td>
                        <td>{{ $record->item_name }}</td>
                        <td>{{ $record->quantity }}</td>
                        <td>{{ ucfirst($record->action_type) }}</td>
                        <td>{{ $record->performed_by }}</td>
                        <td>{{ $record->notes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
