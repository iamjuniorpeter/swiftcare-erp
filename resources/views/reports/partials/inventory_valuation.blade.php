
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Item</th>
            <th>Available Quantity</th>
            <th>Unit Cost</th>
            <th>Total Value</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->available_quantity }}</td>
                <td>{{ $item->cost_price }}</td>
                <td>{{ $item->available_quantity * $item->cost_price }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
