<table class="table style-2 dt-table-hover non-hover myDataTable" style="width:100%">
    <thead>
        <tr>
            <th colspan="5" class="text-center" style="padding: 1rem;">
                <h3 style="margin: 0;">Stock Summary Report</h3>
            </th>
        </tr>
        <tr>
            <th colspan="5" class="text-center" style="padding: 1rem;">
                <h4 style="margin: 0;">Report Period: {{ $report_period ?? 'All Time' }}</h4>
            </th>
        </tr>
        <tr style="border-top: 2px solid #dee2e6;">
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
            <td>{{ number_format(($record->cost_price * $record->quantity), 2) }}</td>
            <td>{!! getStatusBadge($record->status) !!}</td>
        </tr>
        @endforeach
    </tbody>
</table>
