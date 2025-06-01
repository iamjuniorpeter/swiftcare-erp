<table class="table style-2 dt-table-hover non-hover myDataTable" style="width:100%">
    <thead>
        <tr>
            <th colspan="5" class="text-center" style="padding: 1rem;">
                <h3 style="margin: 0;">Slow Moving Items Report</h3>
            </th>
        </tr>
        <tr>
            <th colspan="5" class="text-center" style="padding: 1rem;">
                <h4 style="margin: 0;">Report Period: {{ $report_period ?? 'All Time' }}</h4>
            </th>
        </tr>
        <tr style="border-top: 2px solid #dee2e6;">
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
                <td>{{ number_format($record->holding_cost_estimate, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>