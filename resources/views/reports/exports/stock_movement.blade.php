<table class="table style-2 dt-table-hover non-hover myDataTable" style="width:100%">
    <thead>
        <tr>
            <th colspan="6" class="text-center" style="padding: 1rem;">
                <h3 style="margin: 0;">Stock Movement Report</h3>
            </th>
        </tr>
        <tr>
            <th colspan="5" class="text-center" style="padding: 1rem;">
                <h4 style="margin: 0;">Report Period: {{ $report_period ?? 'All Time' }}</h4>
            </th>
        </tr>
        <tr style="border-top: 2px solid #dee2e6;">
            <th>Date</th>
            <th>Item</th>
            <th>Quantity</th>
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
                <td>{{ $record->action_type }}</td>
                <td>{{ $record->performed_by }}</td>
                <td>{{ $record->notes ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>