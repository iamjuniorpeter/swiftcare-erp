<table class="table table-bordered">
    <thead>
        <tr>
            <th>Item</th>
            <th>Total Sold</th>
            <th>Total Quantity Sold</th>
            <th>Total Sales Value</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->sales_count }}</td>
                <td>{{ number_format($item->total_quantity_sold, 2) }}</td>
                <td>{{ number_format($item->total_sales_value, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
