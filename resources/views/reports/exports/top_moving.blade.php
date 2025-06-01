<table class="table style-2 dt-table-hover non-hover myDataTable" style="width:100%">
    <thead>
        <tr>
            <th colspan="4" class="text-center" style="padding: 1rem;">
                <h3 style="margin: 0;">Top Moving Items Report</h3>
            </th>
        </tr>
        <tr>
            <th colspan="5" class="text-center" style="padding: 1rem;">
                <h4 style="margin: 0;">Report Period: {{ $report_period ?? 'All Time' }}</h4>
            </th>
        </tr>
        <tr style="border-top: 2px solid #dee2e6;">
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