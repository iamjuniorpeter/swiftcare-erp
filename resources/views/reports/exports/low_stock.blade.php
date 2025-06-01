<table class="table style-2 dt-table-hover non-hover myDataTable" style="width:100%">
    <thead>
        <tr>
            <th colspan="4" class="text-center" style="padding: 1rem;">
                <h3 style="margin: 0;">Low Stock Report</h3>
            </th>
        </tr>
        <tr>
            <th colspan="5" class="text-center" style="padding: 1rem;">
                <h4 style="margin: 0;">Report Period: {{ $report_period ?? 'All Time' }}</h4>
            </th>
        </tr>
        <tr style="border-top: 2px solid #dee2e6;">
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
                <td>{{ $record->current_stock }}</td>
                <td>{{ $record->reorder_level }}</td>
                <td>{{ $record->suggested_reorder ?? 0 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>